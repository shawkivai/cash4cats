<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Cats extends CI_Controller
{

    public function update()
    {

        $cat_id = $this->input->post('cat-id');

        // Create array for product table + insert
        $cat_array = array('name' => $this->input->post('cat_name'),
                           'sample_number' => $this->input->post('cat_sample_no'),
                           'description' => $this->input->post('desc'),
                           'final_price' => $this->input->post('cat_override'),
                            'category_id' => $this->input->post('category_id')
                          );

        $this->load->model('catalogue_model');
        $result_cat_update = $this->catalogue_model->update_cat($cat_id, $cat_array);

        // Create array for product_attribute table + insert
        $cat_attr_array = array(
            'weight_cat' => $this->input->post('weight_cat'),
            'weight_ceramic' => $this->input->post('weight_ceramic'),
            'pt_content' => $this->input->post('pt_content'),
            'pd_content' => $this->input->post('pd_content'),
            'rh_content' => $this->input->post('rh_content')
        );

        $result_array_cat_update = $this->catalogue_model->update_cat_attr($cat_id, $cat_attr_array);

        $this->load->model('benchmarks_model');
            
            
        $this->benchmarks_model->update_cat_price($cat_id);
            

        //handle main image upload - mainImg

                $config['upload_path'] = './temp';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';

                $this->load->library('upload', $config);

                $errors = false;



        if ($_FILES['mainImg']['tmp_name'] != "") {
            error_log($_FILES['mainImg']['tmp_name']);
        // If error occurs
            if (! $this->upload->do_upload('mainImg')) {
                $this->session->set_flashdata('notice', $this->upload->display_errors());
                $errors = true;
                redirect(site_url() . '/pages/view/edit_cat/' . $cat_id);
            } else {
                $mainImage = $this->upload->data();
                //$this->session->set_flashdata('notice', $this->upload->data('file_name'));
                // Resize the image
                // Delete the original
            }



            if ($errors) {
            // There was errors, we have to delete the uploaded files
                @unlink($mainImage['full_path']);
            } else {
                //error_log(var_export($files, true));
                $this->load->library('image_lib');

                //Create folder
                //$dir_path = './inv_images/' . $invoice_id;

                // Check if directory exists
                //if(!is_dir($dir_path)){
                //  mkdir($dir_path, 0777);
                //}


                // Set up Image Manipulation
                    $config_m['image_library'] = 'gd2';
                    $config_m['maintain_ratio'] = true;
                    $config_m['width'] = 600;
                    $config_m['source_image'] = $mainImage['full_path'];

                    $this->image_lib->clear();
                    $this->image_lib->initialize($config_m);
                    $this->image_lib->resize();

                    $image_filename = $mainImage['file_name'];
                    $new_path = './' . 'cat_img/resized_cat_images_600/' . $image_filename;
                    rename($mainImage['full_path'], $new_path);

                    // Save thumbnail
                    // Copy Image
                    $new_path_300 = './cat_img/resized_cat_images_300/' . $image_filename;
                    copy($new_path, $new_path_300);

                    $this->image_lib->clear();
                    $config_m['image_library'] = 'gd2';
                    $config_m['maintain_ratio'] = true;
                    $config_m['width'] = 300;
                    $config_m['source_image'] = $new_path_300;
                    $this->image_lib->initialize($config_m);
                    $this->image_lib->resize();

                    //Save to database
                    $img_array = array( 'image' => $image_filename );
                    $this->load->model('catalogue_model');
                    $result_image = $this->catalogue_model->update_image($cat_id, $img_array);
            }
        }

            // End Image Processing

        if ($result_cat_update && $result_array_cat_update) {
            $this->session->set_flashdata('notice', 'Cat Updated Successfully');
        } else {
            $this->session->set_flashdata('notice', 'Error updating Cat');
        }
            redirect(site_url() . '/pages/catalogue_view/' . $cat_array['category_id']);
    }



    public function save()
    {

        // Create array for product table + insert
        $cat_array = array('name' => $this->input->post('cat_name'),
                           'sample_number' => $this->input->post('cat_sample_no'),
                           'description' => $this->input->post('desc'),
                           'final_price' => $this->input->post('cat_override'),
                             'category_id' => $this->input->post('category_id')
                          );
        $this->load->model('catalogue_model');
        $cat_id = $this->catalogue_model->save_cat($cat_array);

        $weight_casing = floatval($this->input->post('weight_cat')) - floatval($this->input->post('weight_ceramic'));

        // Create array for product_attribute table + insert
        $cat_attr_array = array(
            'product_id' => $cat_id,
            'weight_cat' => $this->input->post('weight_cat'),
            'weight_ceramic' => $this->input->post('weight_ceramic'),
            'weight_casing' => $weight_casing,
            'pt_content' => $this->input->post('pt_content'),
            'pd_content' => $this->input->post('pd_content'),
            'rh_content' => $this->input->post('rh_content')
        );

        $result_array_cat_save = $this->catalogue_model->save_cat_attr($cat_attr_array);

        $this->load->model('benchmarks_model');
        $this->benchmarks_model->update_cat_price($result_array_cat_save);

        //handle main image upload - mainImg

                $config['upload_path'] = './temp';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';

                $this->load->library('upload', $config);

                $errors = false;
                $result = true;


        if ($_FILES['mainImg']['tmp_name'] != "") {
            error_log($_FILES['mainImg']['tmp_name']);
    // If error occurs
            if (! $this->upload->do_upload('mainImg')) {
                $this->session->set_flashdata('notice', $this->upload->display_errors());
                $errors = true;
                redirect(site_url() . '/pages/view/edit_cat/' . $cat_id);
                //redirect(site_url() . '/pages/view/add_cat/');
            } else {
                $mainImage = $this->upload->data();
                //$this->session->set_flashdata('notice', $this->upload->data('file_name'));
                // Resize the image
                // Delete the original
            }



            if ($errors) {
            // There was errors, we have to delete the uploaded files
                @unlink($mainImage['full_path']);
            } else {
                //error_log(var_export($files, true));
                $this->load->library('image_lib');

                //Create folder
                //$dir_path = './inv_images/' . $invoice_id;

                // Check if directory exists
                //if(!is_dir($dir_path)){
                //  mkdir($dir_path, 0777);
                //}


                // Set up Image Manipulation
                    $config_m['image_library'] = 'gd2';
                    $config_m['maintain_ratio'] = true;
                    $config_m['width'] = 600;
                    $config_m['source_image'] = $mainImage['full_path'];

                    $this->image_lib->clear();
                    $this->image_lib->initialize($config_m);
                    $this->image_lib->resize();

                    $image_filename = $mainImage['file_name'];
                    $new_path = './' . 'cat_img/resized_cat_images_600/' . $image_filename;
                    rename($mainImage['full_path'], $new_path);

                    // Save thumbnail
                    // Copy Image
                    $new_path_300 = './cat_img/resized_cat_images_300/' . $image_filename;
                    copy($new_path, $new_path_300);

                    $this->image_lib->clear();
                    $config_m['image_library'] = 'gd2';
                    $config_m['maintain_ratio'] = true;
                    $config_m['width'] = 300;
                    $config_m['source_image'] = $new_path_300;
                    $this->image_lib->initialize($config_m);
                    $this->image_lib->resize();

                    //Save to database
                    $img_array = array( 'image' => $image_filename );
                    $this->load->model('catalogue_model');
                    $result_image = $this->catalogue_model->update_image($cat_id, $img_array);
            }
        }

            // End Image Processing

        if ($cat_id && $result_array_cat_save && $result_image) {
            $this->session->set_flashdata('notice', 'Cat Insert: ' . $cat_id .'<br />Attributes: ' . $result_array_cat_save . '<br />Image:' . $result_image);
        } else {
            $this->session->set_flashdata('notice', 'Cat Insert: ' . $cat_id .'<br />Attributes: ' . $result_array_cat_save . '<br />Image:' . $result_image);
        }
            redirect(site_url() . '/pages/view/edit_cat/' . $cat_id);
            //redirect(site_url() . '/pages/view/add_cat/');
    }

    public function delete_product($product_id, $category_id)
    {
        $this->load->model('catalogue_model');
        $result = $this->catalogue_model->delete_cat($product_id);
        if ($result) {
                    $this->session->set_flashdata('notice', 'Cat Successfully Deleted');
        } else {
                    $this->session->set_flashdata('notice', 'Error deleting Cat');
        }
        
        $redirect = site_url() .'/pages/catalogue_view/' . $category_id;
        redirect($redirect);

    }
}
