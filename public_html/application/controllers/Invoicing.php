<?php
defined('BASEPATH') or exit('No direct script access allowed');
    error_reporting(E_ERROR);
class Invoicing extends CI_Controller
{

    public function delete_override($over_id)
    {

        $this->load->model('invoice_model');
        $success = $this->invoice_model->delete_override($over_id);

        if ($success) {
            $this->session->set_flashdata('notice', 'Prices Successfully Updated.');
        } else {
            $this->session->set_flashdata('notice', 'Error updating prices');
        }
        redirect(site_url() . '/pages/view/log');
    }

    //Returns TRUE if CAT will be sold at loss
    public function sold_at_loss()
    {
                $buying_price = $this->input->get('price');
                // get selling price
                $cat_id = $this->input->get('id');
                $this->load->model('invoice_model');
                $selling_price = $this->invoice_model->get_cat_price($cat_id);

                // Change to floats
                $buying_price = floatval($buying_price);
                $selling_price = floatval($selling_price);

        if ($selling_price < $buying_price) {
            echo 'loss';
        } else {
            echo 'profit';
        }
    }

    // Delete Invoice
    public function delete_invoice($id)
    {
        $this->load->model('invoice_model');
        $result = $this->invoice_model->delete_invoice($id);
        if ($result) {
                    $this->session->set_flashdata('notice', 'Invoice Successfully Deleted');
        } else {
                    $this->session->set_flashdata('notice', 'Error deleting invoice');
        }
        $redirect = site_url() .'/pages/view/view_invoices';
        redirect($redirect);
    }

    // A function to call the Invoice Model to return the html to be used in the AJAX call. Returns rows of Products

    public function ajax_cats()
    {

        $this->load->model('catalogue_model');
        $result = $this->catalogue_model->ajax_cats();
        if ($result != false) {
            echo $result;
        } else {
            echo 'No results found, check your search query';
        }
        //echo 'Omer Siddique';
    }

    public function update_invoice()
    {

        // Make 4 arrays to save the data to the 4 tables

        // Get the number of rows in the invoice table
        $rows = $this->input->post('counter');

        if ($rows == 0) {
            $this->session->set_flashdata('notice', 'No items were selected for the invoice');
            $redirect = site_url() . '/pages/view/invoice';
            redirect($redirect);
        }

        // Get the current logged in user

        $invoice_id = $this->input->post('inv-id');

        $current_admin = $this->session->userdata('username');

        // Main Invoice Table
        $new_invoice = array(
                'customer_id' => $this->input->post('customer'),
                'status' => $this->input->post('inv-status'),
                'Total' => $this->input->post('total'),
                'admin_id' => $current_admin,
                'commission' => $this->input->post('comm')
            );
        $this->load->model('invoice_model');
        $result_invoice_update = $this->invoice_model->update_invoice($new_invoice, $invoice_id);

        // Invoice Attributes Table



        // Get an array of all current rows for this invoice.
        // Delete these rows to add new ones again
        $rows_to_delete = $this->invoice_model->get_invoice_rows($invoice_id);

        foreach ($rows_to_delete as $delete_row) {
            $this->invoice_model->delete_row($delete_row->ID);
        }

        // Get total cats
        $cats_total = 0;
        for ($i = 1; $i <= $rows; $i++) {
            // Get the current row isActive input
            $isActive_input = 'isActive' . $i;
            // Check whether the row is active
            $isActive = $this->input->post($isActive_input);

            if ($isActive == 0) {
                // Row is not active, so skip
                continue;
            } else {
                //Continue with script
                $invoice_lines++;

                // Instantiate Array to save as row
                $current_invoice_row = array();
                $line_num_input = 'line-number' . $i;
                $current_invoice_row['line_num'] = $this->input->post($line_num_input);

                $current_invoice_row['inv_id'] = $invoice_id;

                // Get all the current row values
                $name_row_input = 'cat-id' . $i;
                $current_invoice_row['product'] = $this->input->post($name_row_input);

                $price_row_input = 'cat-price' . $i;
                $current_invoice_row['price'] = $this->input->post($price_row_input);

                $catname_row_input ='cat-name' . $i;

                $over_row_input = 'cat-price-override' . $i;
                // Check if override price entered
                $override =$this->input->post($over_row_input);
                if (! $override == 0) {
                    // Override price exists
                    $current_invoice_row['override_price'] = $override;

                    $override_notes .= '<br />**OVERRIDE PRICE UPDATE FOR <strong>' . $this->input->post($catname_row_input) . '</strong> WITH THE PRICE OF <strong>$' . $this->input->post($over_row_input) . '</strong> ON ' . date('l jS \of F Y h:i:s A') . ' <br />';

                    // Save Override CAT Price in override_prices
                    $new_override = array(
                        'customer_id' => $this->input->post('customer'),
                        'cat_id' => $current_invoice_row['product'],
                        'price' => $override,
                        'old_price' => $current_invoice_row['price'],
                        'admin_id' => $current_admin
                     );

                    $result_cat_override = $this->invoice_model->override_cat_customer_price($new_override);
                }

                $qty_row_input = 'cat-qty' . $i;
                $current_invoice_row['qty'] = $this->input->post($qty_row_input);
                $cats_total += (int)$current_invoice_row['qty'];


                $total_row_input = 'cat-total' . $i;
                $current_invoice_row['total_row'] = $this->input->post($total_row_input);

                $invoice_item_id = 'item-id' . $i;
                $invoice_item_id_row = $this->input->post($invoice_item_id);



                $result_invoice_rows_update = $this->invoice_model->add_invoice_rows($current_invoice_row);




                if (!$result_invoice_rows_update) {
                    break; // Error occurred
                }
            } // End else block
        } // End For Loop

        // Update the total cat quantity into the invoice table
        $total_cats = array('qty' => $cats_total);
        $result_cat_qty = $this->invoice_model->update_cat_qty($total_cats, $invoice_id);

        $result_note_add = true;
        // Notes Table

        if ((strlen(trim($_POST['notes'])) > 0) || $override_notes != '') {
            $result_note_add = false;
            $old_note = $this->invoice_model->get_note_by_invoice($invoice_id);

            if (!$old_note) {// If no old note exists make a new note
                $inv_note = '<br />' . $this->input->post('notes') . $override_notes;

                $add_note = array(
                'note' => $inv_note ,
                'customer' => $this->input->post('customer'),
                'inv_id' => $invoice_id
                );

                $result_note_add = $this->invoice_model->add_note($add_note);
            } else {// If old note exits concatenate to the end of this one
                $inv_note = '<br />' . $this->input->post('notes') . $override_notes . $old_note->note;

                $add_note = array(
                'note' => $inv_note ,
                'customer' => $this->input->post('customer')
                );

                $result_note_add = $this->invoice_model->update_note($add_note, $old_note->id);
            }
        } // end if statement

        // Images Table
                // Process the upload
                $config['upload_path'] = './temp';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';

                $this->load->library('upload', $config);



                $files = array();
                $errors = false;



        foreach ($_FILES as $key => $value) {
            if (!empty($value['name'])) {
                        // If error occurs
                if (! $this->upload->do_upload($key)) {
                    $this->session->set_flashdata('notice', $this->upload->display_errors());
                    $errors = true;
                } else {
                    $files[] = $this->upload->data();
                    //$this->session->set_flashdata('notice', $this->upload->data('file_name'));
                    // Resize the image
                    // Delete the original
                }
            }
        }

        if ($errors) {
                    // There was errors, we have to delete the uploaded files
            foreach ($files as $key => $file) {
                    @unlink($file['full_path']);
            }
        } else {
            //error_log(var_export($files, true));
            $this->load->library('image_lib');

                //Create folder
            $dir_path = './inv_images/' . $invoice_id;

            // Check if directory exists
            if (!is_dir($dir_path)) {
                mkdir($dir_path, 0777);
            }

            foreach ($files as $key => $file) {
                // Set up Image Manipulation
                $config_m['image_library'] = 'gd2';
                $config_m['maintain_ratio'] = true;
                $config_m['width'] = 600;
                $config_m['source_image'] = $file['full_path'];

                $this->image_lib->clear();
                $this->image_lib->initialize($config_m);
                $this->image_lib->resize();

                $new_path = $dir_path . '/' . $file['file_name'];
                rename($file['full_path'], $new_path);
                //Save to database
                $this->load->model('invoice_model');
                $result_image = $this->invoice_model->add_image($invoice_id, $file['file_name']);
            }
        }


        if ($result_invoice_update && $result_note_add && $result_invoice_rows_update && $result_image) {
            $this->session->set_flashdata('notice', 'Invoice Successfully Updated');
        } else {
            if ($result_invoice_update) {
                $result_invoice_update  = "OK";
            }
            if ($result_invoice_rows_update) {
                $result_invoice_rows_update  = "OK";
            }
            if ($result_note_add) {
                $result_note_add  = "OK";
            }
            if ($result_image) {
                $result_image  = "OK";
            }
            $err = 'Invoice Update Result<br />INVOICE ADD = ' . $result_invoice_update . '<br />ROWS ADD = ' . $result_invoice_rows_update . '<br />NOTES ADD = ' . $result_note_add . '<br />IMAGES ADD = ' . $result_image;
            $this->session->set_flashdata('notice', $err);
        }
                    $redirect = ( site_url() . '/pages/view/edit_invoice/' . $invoice_id);
                    redirect($redirect);
    } // end update_invoice


    public function save_invoice()
    {

        //error_log(APPPATH . 'libraries/slim/slim.php');
        require_once(APPPATH . 'libraries/slim/slim.php');

        $gst = 1.1;
        // Get the number of rows in the invoice table
        $rows = $this->input->post('counter');
        $override_flag = false;
        $loss = false;

        if ($rows == 0) {
            $this->session->set_flashdata('notice', 'No items were selected for the invoice');
            $redirect = site_url() . '/pages/view/invoice';
            redirect($redirect);
        }

        // Make 4 arrays to save the data to the 4 tables

        // Get the current logged in user

        $current_admin = $this->session->userdata('username');


        $now_date = date("Y-m-d H:i:s");
        //error_log($now_date);
        // Main Invoice Table
        $new_invoice = array(
                'customer_id' => $this->input->post('customer'),
                'status' => $this->input->post('inv-status'),
                'Total' => $this->input->post('total'),
                'admin_id' => $current_admin,
              'commission' => $this->input->post('comm'),
                'date' => $now_date
            );
        $this->load->model('invoice_model');
        $result_invoice_add = $this->invoice_model->save_invoice($new_invoice);

        // Invoice Attributes Table


        $override_notes = '';
        $invoice_lines = 0; // Store the number of invoice items
        // Loop through the rows
        // Get total cats
        $cats_total = 0;

        for ($i = 1; $i <= $rows; $i++) {
            // Get the current row isActive input
            $isActive_input = 'isActive' . $i;
            // Check whether the row is active
            $isActive = $this->input->post($isActive_input);

            if ($isActive == 0) {
                // Row is not active, so skip
                continue;
            } else {
                //Continue with script
                $invoice_lines++;

                // Instantiate Array to save as row
                $current_invoice_row = array();
                $line_num_input = 'line-number' . $i;
                $current_invoice_row['line_num'] = $this->input->post($line_num_input);

                $current_invoice_row['inv_id'] = $result_invoice_add;

                // Get all the current row values
                $name_row_input = 'cat-id' . $i;
                $current_invoice_row['product'] = $this->input->post($name_row_input);

                $price_row_input = 'cat-price' . $i;
                $current_invoice_row['price'] = $this->input->post($price_row_input);

                $catname_row_input = 'cat-name' . $i;
                //$catname_row_input = $this->input->post($catname_row_input);
                //error_log($catname_row_input);

                $over_row_input = 'cat-price-override' . $i;

                // Check if override price entered
                $override =$this->input->post($over_row_input);

                $override_ok = true;
                if ($override == '' || !isset($override) || $override == 0) {
                    $override_ok = false;
                } else {
                    $override = $override*$gst;
                }
                    
                if ($override_ok) {
                    // Override price exists
                    $current_invoice_row['override_price'] = $override;

                    $override_notes .= '<br />*** OVERRIDE PRICE ENTERED FOR <strong>' . $this->input->post($catname_row_input) . '</strong> WITH THE PRICE OF <strong>$' . $this->input->post($over_row_input) . '</strong> ON ' . date('l jS \of F Y h:i:s A') . ' <br />';

                    //error_log($override_notes);
                    // Save Override CAT Price in override_prices
                    //$new_override = array(
                    //  'customer_id' => $this->input->post('customer'),
                    //  'cat_id' => $current_invoice_row['product'],
                    //  'price' => $override
                    // );
                    // $result_cat_override = $this->invoice_model->override_cat_customer_price($new_override);

                    // Before ending the loop, check if a loss would be incurred by this row.
                    // Determine final buying price
                    $buying_price = $current_invoice_row['price'];

                    // if override price was entered, update price:
                    if (!$override == 0) {
                        $buying_price = $override;
                    }


                    // get selling price
                    $selling_price = $this->invoice_model->get_cat_price($current_invoice_row['product']);
                    $selling_price = $selling_price;

                    // Change to floats
                    $buying_price = floatval($buying_price);
                    $selling_price = floatval($selling_price)*$gst;
                    /*ob_start();
                    var_dump($buying_price);
                    var_dump($selling_price);
                    $html = ob_get_clean();
                    error_log($html); */
                    // If so, send an email with details to Cash 4 Cats Admin.
                    if ($selling_price < $buying_price) {
                        // Send the email
                        $this->load->library('email');
                        $config['protocol'] = 'sendmail';
                        $config['mailpath'] = '/usr/sbin/sendmail';
                        $config['charset'] = 'iso-8859-1';
                        $config['wordwrap'] = true;
                        $config['mailtype'] = 'html';

                        $this->email->initialize($config);

                        $to_email = 'nash@cash4cats.com.au';
                        $this->email->bcc('mr.omersiddique@gmail.com');

                        $this->email->from('no-reply@cash4cats.com.au', 'Cash 4 Cats');
                        $this->email->to($to_email);
                        /*
                        if (isset($_GET['cc_email'] ) ){
                            $this->email->cc( $this->input->get('cc_email') );
                        }

                        if (isset($_GET['bcc_email'] ) ){
                            $this->email->bcc( $this->input->get('bcc_email') );
                        }
                        */
                        $this->email->subject('Invoice with Loss Entered into System');
                        $message = '<html>
						Dear Cash 4 Cats Admin<br />
						An invoice was entered with product procuring a loss.<br />
						Product Name - ' . $catname_row_input . '<br />
						Click the link below to view the invoice:<br />
						<ul>
						<li><a href="' .site_url() . '/pages/view/edit_invoice/' . $result_invoice_add . '">View Invoice - Invoice #' .  $result_invoice_add. '</a></li>
						</ul>
						</html>
						';
                        $this->email->message($message);
                        //$this->email->attach($filename);
                        //error_log($message);
                        $result = $this->email->send();

                        // Also ensure invoice is saved as quote only
                        $change_status = array(
                        'status' => 0
                            );
                        $this->load->model('invoice_model');
                        $result_invoice_alter_status = $this->invoice_model->update_purchase($change_status, $result_invoice_add);

                        // Set loss flag
                        $loss = true;
                        $override_flag = true;
                    }


                    //Save Override CAT Price in override_prices
                    if (!$loss) {
                        $new_override = array(
                            'customer_id' => $this->input->post('customer'),
                            'cat_id' => $current_invoice_row['product'],
                            'price' => $override,
                            'old_price' => $current_invoice_row['price'],
                            'admin_id' => $current_admin,
                            'date_current' => $now_date
                         );

                         $result_cat_override = $this->invoice_model->override_cat_customer_price($new_override);
                    }
                }

                $qty_row_input = 'cat-qty' . $i;
                $current_invoice_row['qty'] = $this->input->post($qty_row_input);
                $cats_total += $this->input->post($qty_row_input);

                $total_row_input = 'cat-total' . $i;
                $current_invoice_row['total_row'] = $this->input->post($total_row_input);

                // For each row, insert as entry into database

                $result_invoice_rows_add = $this->invoice_model->add_invoice_rows($current_invoice_row);


                if (!$result_invoice_rows_add) {
                    break; // Error occurred
                }
            } // End else block
        } // End For Loop

        // Update the total cat quantity into the invoice table
        $total_cats = array('qty' => $cats_total);
        $result_cat_qty = $this->invoice_model->update_cat_qty($total_cats, $result_invoice_add);

        // Notes Table

        // Check if a new note has been entered and no override notes

        if ((strlen(trim($_POST['notes'])) > 0) || $override_notes != '') {
                $inv_note = $this->input->post('notes') . $override_notes;

                // Check if over-ride price has been activated

                $add_note = array(
                    'note' => $inv_note ,
                    'customer' => $this->input->post('customer'),
                    'inv_id' => $result_invoice_add
                );

                $result_note_add = $this->invoice_model->add_note($add_note);

                if ($override_flag && $result_invoice_add) {
                    $this->session->set_flashdata('notice', 'Invoice has overpriced cats. Please get permission to view invoice');
                } elseif (!$override_flag && $result_invoice_add) {
                    $this->session->set_flashdata('notice', 'New Invoice Successfully Added');
                } else {
                    $this->session->set_flashdata('notice', 'Error adding new invoice');
                }
        }


                // Images Table
                // Process the upload
                //$config['upload_path'] = './temp';
                //$config['allowed_types'] = 'gif|jpg|png|jpeg';

                //$this->load->library('upload', $config);


                $files = array();
                $errors = false;

                $images_slim = Slim::getImages('images');

        if ($images_slim  != false) {
        //Create folder
            $dir_path = './inv_images/' . $result_invoice_add;
            mkdir($dir_path, 0777);

            foreach ($images_slim as $image) {
                      // $files = array();

                       // save output data if set
                if (isset($image['output']['data'])) {
                  // Save the file
                    $name = $image['output']['name'];

                  // We'll use the output crop data
                    $data = $image['output']['data'];

                  // If you want to store the file in another directory pass the directory name as the third parameter.
                  // $file = Slim::saveFile($data, $name, 'my-directory/');

                  // If you want to prevent Slim from adding a unique id to the file name add false as the fourth parameter.
                  // $file = Slim::saveFile($data, $name, 'tmp/', false);
                    $output = Slim::saveFile($data, $name, $dir_path, false);

                  //array_push($files, $output);
                  //Save to database
                    $this->load->model('invoice_model');
                    $this->invoice_model->add_image($result_invoice_add, $name);
                }
            }
        }

                //error_log( $images_slim[0]['output']['name'] );

                /*
                    foreach ($images_slim as $key => $value){

                        if (!empty($value['name']))
                        {
                            // If error occurs
                        if (! $this->upload->do_upload($key)){
                            //$this->session->set_flashdata('notice', $this->upload->display_errors());
                            $errors = true;
                            }

                        else{

                            $files[] = $this->upload->data();
                            //$this->session->set_flashdata('notice', $this->upload->data('file_name'));
                            // Resize the image
                            // Delete the original

                            }
                        }

                    }


                        if($errors)
                        // There was errors, we have to delete the uploaded files
                        {
                            foreach($files as $key => $file)
                            {
                                @unlink($file['full_path']);
                            }
                        }
                        else{

                            //error_log(var_export($files, true));
                            $this->load->library('image_lib');

                                //Create folder
                            $dir_path = './inv_images/' . $result_invoice_add;
                            mkdir($dir_path, 0777);

                            foreach ($files as $key => $file){

                            // Set up Image Manipulation
                                $config_m['image_library'] = 'gd2';
                                $config_m['maintain_ratio'] = TRUE;
                                $config_m['width'] = 600;
                                $config_m['source_image'] = $file['full_path'];

                                $this->image_lib->clear();
                                $this->image_lib->initialize($config_m);
                                $this->image_lib->resize();

                                $new_path = $dir_path . '/' . $file['file_name'];
                                rename($file['full_path'], $new_path);
                                //Save to database
                                $this->load->model('invoice_model');
                                $this->invoice_model->add_image($result_invoice_add, $file['file_name']);
                            }
                    } */


            $redirect = ( site_url() . '/pages/view/view_invoices');
            redirect($redirect);
    } // end save_invoice()
}
