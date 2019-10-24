<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Pages extends CI_Controller
{
    public function view($page = 'login_form', $inv_id = false, $cust_id = false)
    {
        // Check if view exits
        if (!file_exists(APPPATH.'views/pages/' . $page . '.php')) {
            show_404();
        }


        if ($page == 'login_form') {
            redirect(site_url());
        }

        // Check if valid session data exists
        if ($this->session->userdata('is_logged_in') == true) {
            $this->load->model('catalogue_model');
            $menu_data['categories'] = $this->catalogue_model->get_all_categories();

            $data['title'] = ucfirst($page);

            if ($page == 'add_contact') {
                //
            }

            if ($page == 'add_rollover') {
                // Get Payee
                $this->load->model('users_model');
                $data['payees'] = $this->users_model->get_payees();
                // Get Shipments
                $data['shipments'] = $this->users_model->get_shipments();
            }

            if ($page == 'view_rollovers') {
                $this->load->model('reports_model');
                $data['rollovers'] = $this->reports_model->get_rollovers();
            }

            if ($page == 'edit_rollover') {
                // Get Payee
                $this->load->model('users_model');
                $data['payees'] = $this->users_model->get_payees();
                // Get Shipments
                $data['shipments'] = $this->users_model->get_shipments();
                // Get Rollover
                $this->load->model('reports_model');
                $data['rollover'] = $this->reports_model->get_single_rollover($inv_id);
            }

            if ($page == 'view_contacts') {
                // Get all contacts
                $this->load->model('users_model');
                $data['contacts'] = $this->users_model->get_all_contacts();
            }
            if ($page == 'edit_contact') {
                $this->load->model('users_model');
                $data['contact'] = $this->users_model->get_contact($inv_id);
            }

            if ($page == 'email_invoice') {
                $this->load->model('customers_model');
                $data['invoice'] = $inv_id;
                $data['contact'] = $this->customers_model->recall_customer($cust_id);
            } elseif ($page == 'log') {
                $data['log'] = $this->catalogue_model->get_log_data();
            } elseif ($page == 'add_cat') {
                /*$data['category_names'] = $this->catalogue_model->get_all_category_names();*/
            } elseif ($page == 'home') {
                // Set Up Calendar
                // Get the user's id
                $this->load->model('users_model');
                $username = $this->session->userdata('username');
                $username_id = $this->users_model->get_user_id($username);
                $customers = $this->users_model->get_assigned_customers($username_id);
                /*foreach ($customers as $customer){
                    $new_to_date = new DateTime($customer->next_visit);
                    //$new_to_date->modify('+1 day');
                    $customer->next_visit = $new_to_date->format('d/m/Y');
                }*/
                $data['customers'] = $customers;
                $data['expenses'] = $this->users_model->get_expenses();
            } elseif ($page == 'report_daily_user_summary') {
                $from = date('Y/m/d');
                $to = $from;

                $new_to_date = new DateTime($to);
                $new_to_date->modify('+1 day');
                $new_to_date = $new_to_date->format('Y-m-d');

                $this->load->model('reports_model');
                $data['report_items'] = $this->reports_model->shipment_summary_report_user($inv_id, $from, $new_to_date);
                $data['staff'] = $inv_id;
                $data['expense'] = $this->reports_model->get_total_expense($from, $new_to_date);
            } elseif ($page == 'login_report_bulk_pdf') {
                $this->load->model('reports_model');
                $data['last_date'] = $this->reports_model->get_final_date();
            } elseif ($page == 'profit_loss_query') {
                $this->load->model('reports_model');
                $from = new DateTime($this->input->get('from'));
                $from = $from->format('Y-m-d');

                $to = $this->input->get('to');
                $new_to_date = new DateTime($to);
                $new_to_date->modify('+1 day');
                
                $new_to_date = $new_to_date->format('Y-m-d');
                
                $data['expenses'] = $this->reports_model->get_expenses_from($from, $new_to_date);
                

                //$data['expense'] = $this->reports_model->get_total_expense($from, $new_to_date);
                //$data['expense_gst'] = $this->reports_model->get_expense_gst($from, $new_to_date);

                    // Get an object with all the required data:
                    //$data['report_items'] = $this->reports_model->shipment_summary_report($from, $new_to_date);

                    //$data['rollovers'] = $this->reports_model->get_rollovers_by_date($from, $new_to_date);
                    //$data['rollover_gst'] = $this->reports_model->get_rollovers_gst_by_date($from, $new_to_date);

                $shipments= $this->reports_model->get_shipment_by_date($from, $new_to_date);

                foreach ($shipments as $shipment) {
                    $shipment->rollover = $this->reports_model->get_rollovers_by_shipment($shipment->id, $from, $new_to_date)->amount;
                    $shipment->gst_roll = $this->reports_model->get_rollovers_gst_by_shipment($shipment->id, $from, $new_to_date)->gst;
                }
                $data['shipments'] = $shipments;
            } elseif ($page == 'report_shipment_summary') {
                $this->load->model('reports_model');
                $from = new DateTime($this->input->get('from'));
                $from = $from->format('Y-m-d H:i:s');

                $to = $this->input->get('to');
                $new_to_date = new DateTime($to);
                $new_to_date->modify('+1 day');
                $new_to_date = $new_to_date->format('Y-m-d H:i:s');

                $data['expense'] = $this->reports_model->get_total_expense($from, $new_to_date);
                $data['expense_gst'] = $this->reports_model->get_expense_gst($from, $new_to_date);

                if (isset($_GET['shipment_id']) && $_GET['action'] == 'view') {
                    //$data['rollovers'] = $this->reports_model->get_unallocated_rollovers_with_id($_GET['shipment_id']);
                    //$data['rollover_gst'] = $this->reports_model->get_unallocated_rollovers_gst_with_id($_GET['shipment_id']);
                    $data['shipment'] = $this->reports_model->get_single_shipment($_GET['shipment_id']);

                        // Get Rollovers by Shipment ID
                    $data['rollovers'] = $this->reports_model->get_rollovers_by_shipment_only($_GET['shipment_id']);
                    $data['rollover_gst'] = $this->reports_model->get_rollovers_gst_by_shipment_only($_GET['shipment_id']);
                } else {
                    $this->load->model('benchmarks_model');
                    $data['benchmarks'] = $this->benchmarks_model->get_benchmarks();

                    // Get an object with all the required data:
                    //$data['rollovers'] = $this->reports_model->get_unallocated_rollovers();
                    //$data['rollover_gst'] = $this->reports_model->get_unallocated_rollovers_gst();
                }
                $data['report_items'] = $this->reports_model->shipment_summary_report($from, $new_to_date);
                //$data['rollovers'] = $this->reports_model->get_rollovers_by_date($from, $new_to_date);
                //$data['rollover_gst'] = $this->reports_model->get_rollovers_gst_by_date($from, $new_to_date);
            } elseif ($page == 'login_report_shipment_summary') {
                $this->load->model('reports_model');
                $data['shipments'] = $this->reports_model->get_all_shipments();
                $data['last_date'] = $this->reports_model->get_final_date();
            } elseif ($page == 'login_report_user_summary') {
                $this->load->model('reports_model');
                $data['staffs'] = $this->reports_model->get_all_staffs();
            } elseif ($page == 'report_user_summary') {
                $from = $this->input->post('from');
                $to = $this->input->post('to');

                $new_to_date = new DateTime($to);
                $new_to_date->modify('+1 day');
                $new_to_date = $new_to_date->format('Y-m-d');

                $this->load->model('reports_model');
                $data['report_items'] = $this->reports_model->shipment_summary_report_user($this->input->post('staff'), $from, $new_to_date);
                $data['staff'] = $this->input->post('staff');
                $data['expense'] = $this->reports_model->get_total_expense($from, $new_to_date);
            }

            // Get the benchmark values from the database if the calculator page is called:
            elseif ($page == 'calculator') {
                $this->load->model('benchmarks_model');
                $data['benchmarks'] = $this->benchmarks_model->get_benchmarks();
                if ($data['benchmarks'] == false) {
                    echo 'Error Retrieving Benchmark Values from Database';
                }
                // Now get all pricing groups
                $this->load->model('catalogue_model');
                $data['pricing'] = $this->catalogue_model->get_price_groupings();
                if ($data['pricing'] == false) {
                    echo 'Error Retrieving Price Grouping Values from Database';
                }
                // Get customer discounts
                $data['discounts'] = $this->catalogue_model->get_discounts();
                if ($data['discounts'] == false) {
                    echo 'Error Retrieving Customer Discount Values from Database';
                }
                // Get Options
                $data['options'] = $this->benchmarks_model->get_options();
            } elseif ($page == 'add_expense') {
                // Get Contacts
                $this->load->model('users_model');
                $data['contacts'] = $this->users_model->get_expense_contacts();

                // Get Options
                $this->load->model('benchmarks_model');
                $data['options'] = $this->benchmarks_model->get_options();

                // If edit page
                if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['expense_id'])) {
                    // Get expense data
                    $data['expense'] = $this->users_model->get_expense($_GET['expense_id']);
                    $data['action'] = 'edit';
                }
            } elseif ($page == 'view_expense') {
                $this->load->model('users_model');
                $data['expenses'] = $this->users_model->get_all_expenses();
            } elseif ($page == 'edit_cat') {
                $this->load->model('catalogue_model');
                $data['cat'] = $this->catalogue_model->get_all_cat_data($inv_id);
                $data['category_names'] = $this->catalogue_model->get_all_category_names();
            } elseif ($page == 'preview_cat') {
                $this->load->model('catalogue_model');
                $data['cat'] = $this->catalogue_model->get_all_cat_data($inv_id);
                $data['category_names'] = $this->catalogue_model->get_all_category_names();
            } elseif ($page == 'invoice') {
                // Get all the customers to populate new invoice field
                $this->load->model('customers_model');
                $customers = $this->customers_model->get_all_customers_names();
                if (count($customers) > 0) {
                    $data['customers'] = $customers;
                } else {
                    $data['customers'] = false;
                }
                /*$this->load->model('catalogue_model');
                $data['cats'] = $this->catalogue_model->get_all_cats_as_array();*/
            } elseif ($page == 'edit_invoice') {
                if ($inv_id == false) {
                    $this->session->set_flashdata('notice', 'No invoice selected');
                    redirect(site_url() . '/pages/view/view_invoices');
                }

                // Get all the customers to populate new invoice field
                $this->load->model('customers_model');
                $customers = $this->customers_model->get_all_customers_names();
                if (count($customers) > 0) {
                    $data['customers'] = $customers;
                } else {
                    $data['customers'] = false;
                }
                /*$data['cats'] = $this->catalogue_model->get_all_cats_as_array();*/

                $this->load->model('invoice_model');

                //Get invoice info from invoice table
                $data['invoice'] = $this->invoice_model->get_invoice($inv_id);

                //Get all invoice rows from attributes table
                $rows = $this->invoice_model->get_invoice_rows($inv_id);

                // For each invoice row append the product name and product image

                foreach ($rows as $row) {
                    $row->name = $this->invoice_model->get_product_name($row->PRODUCT);
                    $row->image = $this->invoice_model->get_product_image($row->PRODUCT);
                }

                $data['rows'] = $rows;

                // Get all notes from notes table
                $data['notes'] = $this->invoice_model->get_invoice_notes($inv_id);

                // Get all images
                $data['images'] = $this->invoice_model->get_invoice_images($inv_id);
            } elseif ($page == 'view_invoices') {
                // Get invoice data from model
                $this->load->model('invoice_model');
                $invoices = $this->invoice_model->get_all_invoices();
                if (count($invoices) > 0) {
                    // Change customer's id to customer's name
                    foreach ($invoices as $invoice) {
                        $customer_name = $this->invoice_model->get_customer_name($invoice->customer_id);

                        if ($customer_name) {
                            $invoice->customer_name = $customer_name;
                        } else {
                            $invoice->customer_name = '***NO CUSTOMER SELECTED***';
                        }

                        //Change status value
                        switch ($invoice->status) {
                            case 0:
                                $invoice->status = 'Quote';
                                break;
                            case 1:
                                $invoice->status = 'Unpaid';
                                break;
                            case 2:
                                $invoice->status = 'Paid';
                                break;
                            default:
                                $invoice->status = 'Error getting status';
                        }
                    }
                    //$data['invoices'] = $invoices;
                    $data = array('invoices' => $invoices);
                } else {
                    $data['invoices'] = false;
                }
            } elseif ($page == 'view_invoice') {
                if ($inv_id == false) {
                    $this->session->set_flashdata('notice', 'No invoice selected');
                    redirect(site_url() . '/pages/view/view_invoices');
                }

                // Invoice data
                // Invoice Rows data
                $this->load->model('invoice_model');

                //Get invoice info from invoice table
                $data['invoice'] = $this->invoice_model->get_invoice($inv_id);

                //Get all invoice rows from attributes table
                $rows = $this->invoice_model->get_invoice_rows($inv_id);
                

                // For each invoice row append the product name and product image

                $invoicePrices = array();
                $i= 0;
                foreach ($rows as $row) {
                    $i++;
                    $row->name = $this->invoice_model->get_product_name($row->PRODUCT);
                    $row->image = $this->invoice_model->get_product_image($row->PRODUCT);
                    $row->INV_ID = (int)$row->INV_ID;
                    $row->PRODUCT = (int)$row->PRODUCT;
                    $row->TOTAL_ROW = (int)$row->TOTAL_ROW;
                    $row->SOLD_PRICE = (float)$row->SOLD_PRICE;
                    $row->QTY = (int)$row->QTY;

                    $invoicePrices[$i] = $row->PRICE;
                }
                

                $data['rows'] = $rows;
                
                // Customer Data
                $this->load->model('customers_model');
                $invoice = isset($data['invoice']) && !empty($data['invoice']) ? $data['invoice']->customer_id : null;
                // var_dump($data['invoice']);
               
                $data['customer'] = $this->customers_model->recall_customer($invoice);
                // Get all images
                $data['images'] = $this->invoice_model->get_invoice_images($inv_id);
            }

            $pagedata['page'] = $page;

            $this->load->view('includes/header', $pagedata);
            $this->load->view('includes/side_menu', $menu_data);
            $this->load->view('includes/top_right_menu');
            $this->load->view('pages/' .$page, $data);
            $this->load->view('includes/footer');
        } else {
            redirect(site_url());
        }
    }

    public function catalogue_view($id)
    {

        // Check if valid session data exists
        if ($this->session->userdata('is_logged_in') == true) {
            $this->load->model('catalogue_model');
            $menu_data['categories'] = $this->catalogue_model->get_all_categories();

            $this->load->model('catalogue_model');
            $data['cats'] = $this->catalogue_model->get_cats_in_category_and_price($id);

            $pagedata['page'] = 'catalogue_view';

            $this->load->view('includes/header', $pagedata);
            $this->load->view('includes/side_menu', $menu_data);
            $this->load->view('includes/top_right_menu');
            $this->load->view('pages/catalogue', $data);
            $this->load->view('includes/footer');

            /*$all_products = $this->catalogue_model->get_all_cats();
            foreach ($all_products as $cat){
            $new_string = str_replace(' ','-', $cat->image);
            $this->catalogue_model->update_image_string($cat->id, $new_string);
            } */
        } else {
            redirect(site_url());
        }
    }

    public function delete_shipment($id, $from, $to)
    {
        $this->load->model('users_model');

        $this->users_model->rectify_rollovers($id);
        $this->users_model->rectify_sold_prices(urldecode($from), urldecode($to));
        $result = $this->users_model->delete_shipment($id);
        if ($result) {
                $this->session->set_flashdata('shipment', 'Shipment Successfully Deleted');
        } else {
            $this->session->set_flashdata('shipment', 'Error deleting Shipment');
        }

            $redirect = ( site_url() . '/pages/view/login_report_shipment_summary');
            redirect($redirect);
    }

    public function delete_expense()
    {
        $this->load->model('users_model');
        $result = $this->users_model->delete_expense($this->input->get('expense_id'));
        if ($result) {
                $this->session->set_flashdata('notice', 'Expense Successfully Deleted');
        } else {
            $this->session->set_flashdata('notice', 'Error deleting Expense');
        }

            $redirect = ( site_url() . '/pages/view/view_expense');
            redirect($redirect);
    }

    public function add_expense()
    {

        $result;
        require_once(APPPATH . 'libraries/slim/slim.php');

        $new_expense = array(
            'amount' => $this->input->post('total_amount'),
            'amount_ini' => $this->input->post('amount'),
            'gst' => $this->input->post('gst'),
            'supplier' => $this->input->post('supplier'),
            'date' => $this->input->post('date'),
            'ref' => $this->input->post('invoice-ref'),
            'super' => $this->input->post('super')
        );
        $this->load->model('users_model');

        if ($this->input->post('isUpdate') == 'true') {
            $result_update = $this->users_model->update_expense($new_expense, $this->input->post('expense_id'));
            $result = $this->input->post('expense_id');
        } else {
            $result = $this->users_model->insert_expense($new_expense);
        }

        //Save image
        $images_slim = Slim::getImages('images');

        if ($images_slim != false) {
            // Create folder
            $dir_path = './exp_images/' . $result;
            mkdir($dir_path, 0777);

            foreach ($images_slim as $image) {
                if (isset($image['output']['data'])) {
                    $name = $image['output']['name'];
                    $data = $image['output']['data'];
                    $output = Slim::saveFile($data, $name, $dir_path, false);

                    //error_log($name);
                    $img_upload = $this->users_model->add_expense_image($result, $name);
                }
            }
        }


        if ($result) {
                $this->session->set_flashdata('notice', 'Expense Successfully Updated');
        } else {
            $this->session->set_flashdata('notice', 'Error adding Expense');
        }

            $redirect = ( site_url() . '/pages/view/add_expense?action=edit&expense_id=' . $result);
            //$redirect = ( site_url() . '/pages/view/add_expense');
            redirect($redirect);
    }

    public function update_expense_date()
    {
        $this->load->model('users_model');
        $id_change = $this->input->post('expense_id');
        // Get the old date
        $old_date = $this->input->post('last_payment');
        // Add amount to old date
        $amount = $this->input->post('frequency') . ' days';
        $format = 'd/m/Y';
        $old_date = DateTime::createFromFormat($format, $old_date);
        date_add($old_date, date_interval_create_from_date_string($amount));
        // Change to string
        $new_date = $old_date->format('d/m/Y');
        // Save to database
        $date_array = array('payment_next' => $new_date );
        $result = $this->users_model->update_expense_date($id_change, $date_array);

        if ($result) {
                $this->session->set_flashdata('expenses', 'Date Updated');
        } else {
            $this->session->set_flashdata('expenses', 'Error Updating Date');
        }
            $redirect = $redirect = ( site_url() . '/pages/view/home');
            redirect($redirect);
    }

    public function update_date()
    {
        $this->load->model('users_model');
        $new_date = array('next_visit' => $this->input->post('lastvisit'));
        $result = $this->users_model->update_date($new_date, $this->input->post('customer_id'));

        if ($result) {
                $this->session->set_flashdata('notice', 'Date Updated');
        } else {
            $this->session->set_flashdata('notice', 'Error Updating Date');
        }
            $redirect = $redirect = ( site_url() . '/pages/view/home');
            redirect($redirect);
    }
}
