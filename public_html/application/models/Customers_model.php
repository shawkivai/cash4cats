<?php

	class Customers_model extends CI_model{

		public function add_note($note){
			$result = $this->db->insert('notes', $note);
			if ($result){
				return true;
			}
			else{
				return false;
			}
			
		}

		public function add_customer_image($id, $name){
			$image = array('image' => $name);
			$this->db->where('id', $id);
			return $this->db->update('stockist', $image);
		}

		public function get_notes($id){
			$this->db->where('customer', $id);
			$result = $this->db->get('notes');
			if ($result->num_rows() > 0){
				return $result->result();
			}
			else return false;
		}

		public function get_invoices($id){
			$this->db->where('customer_id', $id);
			$result = $this->db->get('purchase');
			if ($result->num_rows() > 0){
				return $result->result();
			}
			else return false;
		}
		
		public function update_type($customer_type, $id){
			$this->db->where('id', $id);
			$result =$this->db->update('stockist', $customer_type);
			return $result;
		}
		
		public function update_customer($customer, $customer_id){
			$this->db->where('id', $customer_id);
			$result = $this->db->update('stockist', $customer);
			return $result;
		}
		
		public function get_all_customers(){
			$result = $this->db->get('stockist');
			return $result->result();
		}
		
			public function get_all_customers_names(){
			$this->db->select('business_name, id, customer_type');
			$result = $this->db->get('stockist');
			return $result->result();
		}
		
		public function add_new_customer($new_customer){
			$result = $this->db->insert('stockist', $new_customer);
			
			if ($result){
				return $this->db->insert_id(); 
				// return the id of the recently added customer
			}
			else {
				return $result;
			}
		}
		
		public function recall_customer($customer_id){
			$this->db->where('id', $customer_id);
			$row = $this->db->get('stockist');	
			if ($row->num_rows() == 1){
				return $row->row();				
			}
			else{
				return 'That customer does not exist';
			}
		}
		
		public function save_freq($new_freq, $customer_id){
			$this->db->where('id', $customer_id);
			$update_row = $this->db->update('stockist', $new_freq);
			return $update_row;
		}
		
	
	}
?>