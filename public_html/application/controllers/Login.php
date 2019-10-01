<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	class Login extends CI_Controller{

		public function index(){

			$pagedata['page'] = 'home';
			$this->load->view('includes/header', $pagedata);
			$this->load->view('pages/login_form');
			$this->load->view('includes/footer');
		}

		public function validate(){

			$this->load->model('users_model');
			$result = $this->users_model->validate();

			if ($result !== false){
				$data = array(
				'username' => $this->input->post('user'),
				'is_logged_in' => true,
				'user_type' => $result);

				// If the user is not an admin, set an extended session expiration time
				if ($result != "admin"){
				$this->session->sess_expiration = '3600';
				}

				$this->session->set_userdata($data);
				redirect( site_url() . '/pages/view/home');
			}

			else{
				// Logout Session - If login fails logout session
				$this->session->unset_userdata('is_logged_in');
				$this->session->set_flashdata('notice', 'Login failed. Please try again.');
				$this->index();
			}
		}

		public function logout(){
				$this->session->unset_userdata('is_logged_in');
				$this->session->set_flashdata('notice', 'You have been successfully logged out.');
				$this->index();
		}
	}

?>
