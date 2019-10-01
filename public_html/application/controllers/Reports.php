<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Reports extends CI_Controller{

			public function delete_rollover($id){
				$this->load->model('reports_model');
				$result = $this->reports_model->delete_rollover($id);

				if ($result){
							// Set successful date message
							$this->session->set_flashdata('notice', 'Rollover Succesfully Deleted!');
						}
						else{
							// Set unsuccesful data message
							$this->session->set_flashdata('notice', 'Error deleting Rollover');
						}

				redirect(site_url() . '/pages/view/view_rollovers');
			}

			public function edit_rollover($id){

				// Save Image
				require_once(APPPATH . 'libraries/slim/slim.php');
				$this->load->model('reports_model');

				$images_slim = Slim::getImages('images');

				if ($images_slim != false){
					// Create folder
					$dir_path = './rollovers/' . $id;
					mkdir($dir_path, 0777);


						if (isset($images_slim[0]['output']['data'])){
							$image_filename = $images_slim[0]['output']['name'];
							$data = $images_slim[0]['output']['data'];
							$output = Slim::saveFile($data, $image_filename, $dir_path, false);
							// Save to database
							$img_upload = $this->reports_model->add_rollover_image($id, $image_filename);
						}

				}

				$new_rollover = array(
					'amount' => $this->input->post('amount'),
					'payee' => $this->input->post('payee'),
					'gst' => $this->input->post('gst'),
					'shipment' => $this->input->post('shipment'),
					'description' => $this->input->post('description')
				);


				$result_id = $this->reports_model->update_rollover($new_rollover, $id);

				if ($result_id){
					$this->session->set_flashdata('notice', 'Rollover Successfully Saved');
				}
				else{
					$this->session->set_flashdata('notice', 'Error adding Rollover');
				}

				$redirect = ( site_url() . '/pages/view/edit_rollover/' . $id);
				redirect($redirect);
			}

			public function add_rollover(){

				$new_rollover = array(
					'amount' => $this->input->post('amount'),
					'payee' => $this->input->post('payee'),
					'gst' => $this->input->post('gst'),
					'shipment' => $this->input->post('shipment'),
					'description' => $this->input->post('description'),
					'date' => date("Y-m-d H:i:s"),
					'cost' => $this->input->post('cost')
				);

				$this->load->model('reports_model');
				$result_id = $this->reports_model->save_rollover($new_rollover);

				// Save Image
				require_once(APPPATH . 'libraries/slim/slim.php');
				$image_filename = '';
				$images_slim = Slim::getImages('images');

				if ($images_slim != false){
					// Create folder
					$dir_path = './rollovers/' . $result_id;
					mkdir($dir_path, 0777);

					foreach ($images_slim as $image){
						if (isset($image['output']['data'])){
							$image_filename = $image['output']['name'];
							$data = $image['output']['data'];
							$output = Slim::saveFile($data, $image_filename, $dir_path, false);
							// Save to database
							$img_upload = $this->reports_model->add_rollover_image($result_id, $image_filename);
						}
					}
				}

				if ($result_id){
					$this->session->set_flashdata('notice', 'Rollover Successfully Saved');
				}
				else{
					$this->session->set_flashdata('notice', 'Error adding Rollover');
				}

				$redirect = ( site_url() . '/pages/view/edit_rollover/' . $result_id);
				redirect($redirect);

			}

			public function get_overrides(){
				$this->load->model('reports_model');
				$result = $this->reports_model->pop_overrides();
				$result_json = json_encode($result);
				//error_log($result_json);
				echo $result_json;
			}

			public function pop_cats(){
				$this->load->model('reports_model');
				$result = $this->reports_model->pop_cats();
				if ($result != false){
					echo $result;
				}
				else{
					echo 'No cats found for this customer';
				}
			}

			public function get_notes(){
				$this->load->model('reports_model');
				$result = $this->reports_model->pop_notes();
				if ($result != false){
					echo $result;
				}
				else{
					echo 'No Notes found for this customer';
				}
			}

			public function update_shipment(){
				$new_shipment = array(
				'from_date' => $this->input->post('from_date'),
				'to_date' => $this->input->post('to_date'),
				'qty' =>  $this->input->post('quantity_sum'),
				'expenses' => $this->input->post('expense'),
				'profit' => $this->input->post('calc_profit'),
				'actual_profit' => $this->input->post('actual_profit') ,
				'gst' => $this->input->post('gst_sum')
			);
				$this->load->model('reports_model');
				$result = $this->reports_model->update_shipment($new_shipment, $this->input->post('shipment_id'));

			//error_log($result);

		    if ($result){
				$this->session->set_flashdata('notice', 'Shipment Successfully Updated');
			}
				else{
					$this->session->set_flashdata('notice', 'Error Updating Shipment');
				}
			$redirect = (site_url() . '/pages/view/login_report_shipment_summary/');
			redirect($redirect);

			}

			public function save_shipment(){
			$new_shipment = array(
				'from_date' => $this->input->post('from_date'),
				'to_date' => $this->input->post('to_date'),
				'qty' =>  $this->input->post('quantity_sum'),
				'expenses' => $this->input->post('expense'),
				'profit' => $this->input->post('calc_profit'),
				'actual_profit' => $this->input->post('actual_profit') ,
				'gst' => $this->input->post('gst_sum'),
				'cat_sales' => $this->input->post('income'),
				'rollover' => $this->input->post('rollover'),
				'gst_sales' => $this->input->post('gst_sales'),
				'gst_rollover' => $this->input->post('gst_rollover')
			);
			$this->load->model('reports_model');
			$result = $this->reports_model->save_shipment($new_shipment);
			$this->reports_model->update_rollover_allocation($result);
			$this->reports_model->commit_cat_sale_price( $new_shipment['from_date'], $new_shipment['to_date'] );
		    if ($result){
				$this->session->set_flashdata('notice', 'Shipment Successfully Submitted');
			}
				else{
					$this->session->set_flashdata('notice', 'Error Submitting Shipment');
				}
			$redirect = (site_url() . '/pages/view/login_report_shipment_summary/');
			redirect($redirect);
		}


	}

?>
