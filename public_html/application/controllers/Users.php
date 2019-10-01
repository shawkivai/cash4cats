<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Users extends CI_Controller{

		
		public function edit_contact(){
			// Check if valid session data exists
			if ($this->session->userdata('is_logged_in') == true){


				$timestamp_next = $this->input->post('next-visit');
				//$timestamp_next = str_replace('/', '-', $this->input->post('next-visit'));
				//$timestamp_next = strtotime($timestamp_next);
				//$timestamp_next = date("Y-m-d",$timestamp_next);

				$timestamp_dob = $this->input->post('dob');
				//$timestamp_dob = str_replace('/', '-', $this->input->post('dob'));
				//$timestamp_dob = strtotime($timestamp_dob);
				//$timestamp_dob = date("Y-m-d",$timestamp_dob);

				$new_contact = array(
					'name' => $this->input->post('user-name'),
					'contact_type' => $this->input->post('user-type'),
					'phone' => $this->input->post('phone'),
					'emergency' => $this->input->post('emergency'),
					'email' => $this->input->post('email'),
					'address' => $this->input->post('address'),
					'suburb' => $this->input->post('suburb'),
					'payment_freq' => $this->input->post('visit_frequency'),
					'payment_next' => $timestamp_next,
					'abn' => $this->input->post('abn'),
					'acn' => $this->input->post('acn'),
					'account' => $this->input->post('acno'),
					'tfn' => $this->input->post('tfn'),
					'dob' => $timestamp_dob,
					'super' => $this->input->post('super'),
					'income_tax' => $this->input->post('income'),
				);

				$contact_id = $this->input->post('contact-id');
				//error_log($contact_id);

				$this->load->model('users_model');
				$result = $this->users_model->update_new_contact($contact_id, $new_contact);

				if ($result == true){
							// Set successful date message
							$this->session->set_flashdata('notice', 'Contact Succesfully Updated!');
						}
						else{
							// Set unsuccesful data message
							$this->session->set_flashdata('notice', 'Error updating Contact');
						}

				redirect(site_url() . '/pages/view/edit_contact/' . $contact_id);

			}
			else{
				redirect( site_url() );	
			}
		}

		public function add_contact(){
			// Check if valid session data exists
			if ($this->session->userdata('is_logged_in') == true){


				$timestamp_next = $this->input->post('next-visit');
				//$timestamp_next = str_replace('/', '-', $this->input->post('next-visit'));
				//$timestamp_next = strtotime($timestamp_next);
				//$timestamp_next = date("Y-m-d",$timestamp_next);

				$timestamp_dob = $this->input->post('dob');
				//$timestamp_dob = str_replace('/', '-', $this->input->post('dob'));
				//$timestamp_dob = strtotime($timestamp_dob);
				//$timestamp_dob = date("Y-m-d",$timestamp_dob);

				$new_contact = array(
					'name' => $this->input->post('user-name'),
					'contact_type' => $this->input->post('user-type'),
					'phone' => $this->input->post('phone'),
					'emergency' => $this->input->post('emergency'),
					'email' => $this->input->post('email'),
					'address' => $this->input->post('address'),
					'suburb' => $this->input->post('suburb'),
					'payment_freq' => $this->input->post('visit_frequency'),
					'payment_next' => $timestamp_next,
					'abn' => $this->input->post('abn'),
					'acn' => $this->input->post('acn'),
					'account' => $this->input->post('acno'),
					'tfn' => $this->input->post('tfn'),
					'dob' => $timestamp_dob,
					'super' => $this->input->post('super'),
					'income_tax' => $this->input->post('income'),
				);

				$this->load->model('users_model');
				$result = $this->users_model->save_new_contact($new_contact);

				if ($result == true){
							// Set successful date message
							$this->session->set_flashdata('notice', 'New Contact Succesfully Added!');
						}
						else{
							// Set unsuccesful data message
							$this->session->set_flashdata('notice', 'Error adding new Contact');
						}

						/*$this->load->model('catalogue_model');
						$menu_data['categories'] = $this->catalogue_model->get_all_categories();

						$this->load->view('includes/header');
						$this->load->view('includes/side_menu', $menu_data);
						$this->load->view('includes/top_right_menu');
						$this->load->view('pages/view/edit_contact/' . $result);
                        $this->load->view('includes/footer');
                        */
                        redirect(site_url() . '/pages/view/edit_contact/' . $result);

			}
			else{
				redirect( site_url() );	
			}
		}

		public function add_user(){

			// Check if valid session data exists
			if ($this->session->userdata('is_logged_in') == true){

			$this->load->library('form_validation');
			$this->load->model('catalogue_model');
			$menu_data['categories'] = $this->catalogue_model->get_all_categories();
			// validation rules
			$this->form_validation->set_rules('user-name', 'Username', 'alpha_numeric|trim|required|is_unique[users.username]');
			$this->form_validation->set_rules('password', 'Password', 'trim');

			 if ($this->form_validation->run() == FALSE)
                {

                        $this->load->view('includes/header');
						$this->load->view('includes/side_menu', $menu_data);
						$this->load->view('includes/top_right_menu');
						$this->load->view('pages/add_user');
                        $this->load->view('includes/footer');
                }
                else
                {
					    // Proceed to save entry into database
						$this->load->model('users_model');

						$query = $this->users_model->save_new_user();

						if ($query == true){
							// Set successful date message
							$this->session->set_flashdata('notice', 'New User Succesfully Added!');
						}
						else{
							// Set unsuccesful data message
							$this->session->set_flashdata('notice', 'Error adding new User');
						}

						$this->load->view('includes/header');
						$this->load->view('includes/side_menu', $menu_data);
						$this->load->view('includes/top_right_menu');
						$this->load->view('pages/add_user');
                        $this->load->view('includes/footer');
                }

		}
			else{
				redirect( site_url() );
			}
		}

		public function update_user(){

			// Check if valid session data exists
			if ($this->session->userdata('is_logged_in') == true){

			$this->load->library('form_validation');


			// validation rules
			$this->form_validation->set_rules('password', 'Password', 'trim');


			 if ($this->form_validation->run() == FALSE)
                {

						redirect( site_url() . '/users/edit_user/'. $this->input->post('id'));
                }
                else
                {
					    // Proceed to save entry into database

						$this->load->model('users_model');
						$query = $this->users_model->update_user();

						if ($query == true){
							// Set successful date message
							$this->session->set_flashdata('notice', 'User Succesfully Updated!');
						}
						else{
							// Set unsuccesful data message
							$this->session->set_flashdata('notice', 'Error updating User');
						}

						redirect( site_url() . '/users/edit_user/'. $this->input->post('id'));
                }

			}

			else{
				redirect( site_url() );

			}

		}
		public function edit_user($user_id){

			// Check if valid session data exists
			if ($this->session->userdata('is_logged_in') == true){

			$this->load->model('catalogue_model');
			$menu_data['categories'] = $this->catalogue_model->get_all_categories();

			// Load Model
			$this->load->model('users_model');
			// Get User
			$data = $this->users_model->recall_user($user_id);

			// Send User Data to View
			if (!is_string($data)){
				$this->load->view('includes/header');
				$this->load->view('includes/side_menu', $menu_data);
				$this->load->view('includes/top_right_menu');
				$this->load->view('pages/edit_user', $data);
	            $this->load->view('includes/footer');
			}

			else{
				echo 'That user does not exist';
				}
			}

			else{
				redirect( site_url() );
			}

		}

		public function view_users(){

			// Check if valid session data exists
			if ($this->session->userdata('is_logged_in') == true){


			$this->load->model('users_model');
			$data = array('users' => $this->users_model->get_active_users() );

			$this->load->model('catalogue_model');
			$menu_data['categories'] = $this->catalogue_model->get_all_categories();

			$this->load->view('includes/header');
			$this->load->view('includes/side_menu', $menu_data);
			$this->load->view('includes/top_right_menu');
			$this->load->view('pages/view_users', $data);
            $this->load->view('includes/footer');
			}

			else{
				redirect( site_url() );
			}
		}

		public function delete_contact($contact_id){
			$this->load->model('users_model');
			$success =  $this->users_model->delete_contact($contact_id);

			if ($success == true){
							// Set successful date message
							$this->session->set_flashdata('notice', 'Contact Succesfully Deleted.');
			}
			else {
				// Set unsuccesful data message
				$this->session->set_flashdata('notice', 'Error deleting Contact. Contact Administrator.');
				}
			redirect( site_url() . '/pages/view/view_contacts');
		}

		public function delete($user_id){

			// Check if valid session data exists
			if ($this->session->userdata('is_logged_in') == true){

			$this->load->model('users_model');
			$success =  $this->users_model->delete_user($user_id);
			if ($success == true){
							// Set successful date message
							$this->session->set_flashdata('notice', 'User Succesfully Deleted.');
						}
						else{
							// Set unsuccesful data message
							$this->session->set_flashdata('notice', 'Error deleting User. Contact Administrator.');
						}
			redirect( site_url() . '/users/view_users');
		}
			else{
				redirect( site_url() );
			}

		}

	}

?>
