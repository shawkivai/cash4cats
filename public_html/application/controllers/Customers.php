<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	class Customers extends CI_Controller{

		public function update_customer_type(){
			$this->load->model('customers_model');
			$customer_type = array(
				'customer_type' => $this->input->post('cus_type')
			);
			$result = $this->customers_model->update_type($customer_type, $this->input->post('customer-id'));

			if ($result){
				$this->session->set_flashdata('notice_type', 'Customer Type Updated');
			}
			else{
				$this->session->set_flashdata('notice_type', 'Error Updating Customer Type');
			}

			$this->edit_customer($this->input->post('customer-id'));
		}


		public function update_customer(){
			$this->load->model('customers_model');
			require_once(APPPATH . 'libraries/slim/slim.php');

			$update_this_customer =  $this->get_customer_data_from_form();
			$customers_id = $this->input->post('customer-id');

			$query = $this->customers_model->update_customer($update_this_customer, $customers_id );

			//Save image
			$images_slim = Slim::getImages('images');

			if ($images_slim != false){
				// Create folder
				$dir_path = './customer_images/' . $customers_id;
				if (!file_exists( $dir_path )){
					mkdir($dir_path, 0777);
				}				

				foreach ($images_slim as $image){
					if (isset($image['output']['data'])){
						//var_dump($image);
						$name = $image['output']['name'];
						$data = $image['output']['data'];
						$output = Slim::saveFile($data, $name, $dir_path, false);

						//error_log($name);
						$img_upload = $this->customers_model->add_customer_image($customers_id, $name);
					}
				}
			}

			if ($query){
				$this->session->set_flashdata('notice', 'Customer Successfully Updated');
			}
			else{
				$this->session->set_flashdata('notice', 'Error Updating Customer');
			}

			// Redirect to Edit Customers Page
			$this->edit_customer($customers_id);

		}

		public function save_freq(){
			// Saves the frequency data for a customer
			$this->load->model('customers_model');
			$new_freq = array(
							'visit_frequency' => $this->input->post('visit_frequency'),
							'next_visit' => $this->input->post('next-visit')
						);
			$customer_id = $this->input->post('customer-id');

			$query = $this->customers_model->save_freq($new_freq, $customer_id);

			if ($query){
				$this->session->set_flashdata('notice_freq', 'Customer Frequency Info Updated');
			}
			else{
				$this->session->set_flashdata('notice_freq', 'Error Updating Customer Frequency Info ');
			}

			// Reload Page
			$this->edit_customer($customer_id);
		}

		public function view_customers(){

			$this->load->model('customers_model');
			$data = array('customers' => $this->customers_model->get_all_customers() );

			$this->load->model('catalogue_model');
			$menu_data['categories'] = $this->catalogue_model->get_all_categories();

			$pagedata['page'] = 'view_customers';

			$this->load->view('includes/header', $pagedata);
			$this->load->view('includes/side_menu', $menu_data);
			$this->load->view('includes/top_right_menu');
			$this->load->view('pages/view_customers', $data);
            $this->load->view('includes/footer');
		}

		public function get_customer_data_from_form(){
				// Find is_active checkbox value

				if ( isset($_POST['isactive'])){
					$is_active = 1;
				}
				else {
					$is_active = 0;
				}

				$new_customer =  array(
						'business_name' => $this->input->post('company-name'),
						'business_abn' =>  $this->input->post('company-abn'),
						'rep_firstname' => $this->input->post('rep-first-name'),
						'rep_position' => $this->input->post('position'),
						'email' => $this->input->post('email'),
						'mobile_phone' => $this->input->post('mobile-phone'),
						'address' => $this->input->post('company-address'),
						'office_phone' => $this->input->post('office-phone'),
						'rep_contact' => $this->input->post('rep-phone'),
						'rep_email' => $this->input->post('rep-email'),
						'rep_lastname' => $this->input->post('rep-last-name'),
						'active' => $is_active, // value from above
					);

				return $new_customer;
		}

		public function add_customer(){

			// Check if valid session data exists
			if ($this->session->userdata('is_logged_in') == true){

				$this->load->model('customers_model');

				$new_customer = $this->get_customer_data_from_form();

				$query = $this->customers_model->add_new_customer($new_customer);

				if ($query){
					$this->session->set_flashdata('notice', 'Customer Successfully Added');
				}
				else{
					$this->session->set_flashdata('notice', 'Error Adding Customer');
				}

				$redirect = (site_url() . '/customers/edit_customer/' . $query );
				redirect($redirect);
			}

			else { // not logged in

				redirect (site_url());
			}


		}

		public function assign_customer(){

			// Check if valid session data exists
			if ($this->session->userdata('is_logged_in') == true){

				$assigned = array( 'assigned_to' => $this->input->post('ass_to') );
				$this->load->model('users_model');
				$result = $this->users_model->assign($assigned, $this->input->post('customer-id'));

				if ($result){
					$this->session->set_flashdata('notice_assign', 'Staff Successfully Assigned');
				}
				else{
					$this->session->set_flashdata('notice_assign', 'Error Assigning Staff');
				}

				$redirect = (site_url() . '/customers/edit_customer/' . $this->input->post('customer-id') );
				redirect($redirect);

			}
		}

		public function add_note(){
			$new_note = array(
				'note' => $this->input->post('add_note'),
				'customer' => $this->input->post('customer-id')
				);
			$this->load->model('customers_model');
			$result = $this->customers_model->add_note($new_note);
			if ($result){
				$this->session->set_flashdata('notice_notes', 'Note Successfully Saved');
			}
			else{
				$this->session->set_flashdata('notice_notes', 'Error Saving Note');
			}
			$this->edit_customer($new_note['customer']);
		}

		public function edit_customer($customer_id){

			// Check if valid session data exists
			if ($this->session->userdata('is_logged_in') == true){

			$this->load->model('catalogue_model');
			$menu_data['categories'] = $this->catalogue_model->get_all_categories();

			// Load all staff members
			$this->load->model('users_model');
			$data['users'] = $this->users_model->get_all_staffs();
			//error_log($data['users']);
			// Load Model
			$this->load->model('customers_model');
			// Get User
			$data['customer'] = $this->customers_model->recall_customer($customer_id);

			// Load Note Data
			$data['notes'] = $this->customers_model->get_notes($customer_id);

			// Load Invoice Data
			$data['invoices'] = $this->customers_model->get_invoices($customer_id);

			// Send User Data to View
			if (!is_string($data)){

			$pagedata['page'] = 'edit_customer';

			$this->load->view('includes/header', $pagedata);
			$this->load->view('includes/side_menu', $menu_data);
			$this->load->view('includes/top_right_menu');
			$this->load->view('pages/edit_customer', $data);
            $this->load->view('includes/footer');
			}

			else{
				echo $data;
				}
			}

			else{
				// Not logged int
				redirect( site_url() );
			}

		}

	}

?>
