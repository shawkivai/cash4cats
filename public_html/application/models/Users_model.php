<?php

	class Users_model extends CI_model{

		public function update_date($date, $id){
			$this->db->where('id', $id);
			return $this->db->update('stockist', $date);
		}

		public function update_expense_date($id_change, $date_array){
			$this->db->where('id', $id_change);
			return $this->db->update('contacts', $date_array);
		}

		public function rectify_sold_prices($from, $to){
			// get a reference to all cats within date range
			$this->db->select('purchase_attribute.ID, purchase_attribute.INV_ID, purchase_attribute.PRODUCT, purchase.date, purchase.purchase_id');
			$this->db->from('purchase_attribute');
			//$this->db->join('product_attribute', 'purchase_attribute.PRODUCT = product_attribute.product_id' );
			$this->db->join('purchase', 'purchase_attribute.INV_ID = purchase.purchase_id');
			$this->db->where('purchase.date >', $from);
			$this->db->where('purchase.date <=', $to);
			$rows_to_commit = $this->db->get()->result();


			foreach ($rows_to_commit as $row){			
				$new_entry = array('SOLD_PRICE' => 0.00);
				$this->db->where('ID', $row->ID);
				$this->db->update('purchase_attribute', $new_entry);
			}

			// for each get the sell price and save it purchase_attribute
		}

		public function get_expense_contacts(){
			$this->db->where('is_active', 1);
			$this->db->where('contact_type !=', 2);
			$this->db->select('id, name, contact_type');
			return $this->db->get('contacts')->result();
		}

		public function get_expenses(){
			$this->db->where('is_active', 1);
			$this->db->where('contact_type !=', 2);
			$this->db->select('id, name, phone, payment_freq, payment_next');
			return $this->db->get('contacts')->result();
		}

		public function get_all_contacts(){
			$this->db->where('is_active', 1);
			$this->db->select('id, name, contact_type, phone, email, payment_next');
			return $this->db->get('contacts')->result();
		}

		public function get_payees(){
			$this->db->where('is_active', 1 );
			$this->db->where('contact_type', 2 );
			$this->db->select('id, name');
			return $this->db->get('contacts')->result();
		}

		public function get_shipments(){
			$this->db->select('id, from_date, to_date');
			$this->db->order_by('to_date', 'DESC');
			return $this->db->get('shipments')->result();
		}

		public function get_assigned_customers($user){
			$this->db->select('id, business_name, visit_frequency, next_visit');
			$this->db->where('assigned_to', $user);
			$result = $this->db->get('stockist');
			if ($result->num_rows() > 0){
				return $result->result();
			}
			else {
				return false;
			}
		}

		public function get_user_id($username){
			$this->db->where('username', $username);
			$result = $this->db->get('users');
			if ($result->num_rows() > 0){
				return $result->row()->id;
			}
			else{
				return false;
			}
		}

		public function assign($assign, $id){
			$this->db->where('id', $id);
			return $this->db->update('stockist', $assign);
		}

		public function get_all_staffs(){
			//$this->db->where('user_type', 'staff');
			$query = $this->db->get('users');

			if($query->num_rows() > 1){
				return $query->result();
			}
			else{
				return false;
			}
		}

		public function validate(){

			$this->db->where('username', $this->input->post('user'));
			//print_r($this->input->post('user'));
			$this->db->where('password', $this->input->post('password'));
			//print_r($this->input->post('password'));
			$this->db->where('is_active', true);
			$query = $this->db->get('users');
			//print_r($query->result());
			//print_r( $query->result());

			if($query->num_rows() == 1){
				$result = $query->result_array();
				return $result[0]['user_type'];
			}
			else{
				return false;
			}
		}

		public function update_user(){

			$new_user_row = array(
				'password' => $this->input->post('password'),
				'first_name' => $this->input->post('first-name'),
				'last_name' => $this->input->post('last-name'),
				'email' => $this->input->post('email'),
				'user_type' => $this->input->post('user-type') ,
				'phone' => $this->input->post('phone') ,
				'mobile' => $this->input->post('mobile') ,
				'address' => $this->input->post('address'),
				'suburb' =>  $this->input->post('suburb')
			);
			$this->db->where('id', $this->input->post('id'));
			$result = $this->db->update('users', $new_user_row);
			return $result;

		}

		public function save_new_contact($new_contact){
			$result = $this->db->insert('contacts', $new_contact);

			if ($result){
				return $this->db->insert_id();
			}
			else{
				return false;
			}

		}

		public function update_new_contact($contact_id, $new_contact){
			$this->db->where('id', $contact_id);
			$result = $this->db->update('contacts', $new_contact);

			if ($result){
				return true;
			}
			else{
				return false;
			}

		}

		public function save_new_user(){

			$new_user_row = array(
				'username' => $this->input->post('user-name'),
				'password' => $this->input->post('password'),
				'first_name' => $this->input->post('first-name'),
				'last_name' => $this->input->post('last-name'),
				'email' => $this->input->post('email'),
				'user_type' => $this->input->post('user-type') ,
				'phone' => $this->input->post('phone') ,
				'mobile' => $this->input->post('mobile') ,
				'address' => $this->input->post('address'),
				'suburb' =>  $this->input->post('suburb')
			);

			$result = $this->db->insert('users', $new_user_row);
			return $result;
		}

		public function recall_user($user_id){
			$this->db->where('id', $user_id);
			$row = $this->db->get('users');
			if ($row->num_rows() == 1){
				return $row->row();
			}
			else{
				return 'That user does not exist';
			}
		}

		public function get_all_users(){
			$all_users = $this->db->get('users');
			if ($all_users->num_rows() == 0){
				return '';
			}
			return $all_users->result();
		}

		public function get_active_users(){
			$this->db->where('is_active', 1);
			$all_users = $this->db->get('users');
			if ($all_users->num_rows() == 0){
				return '';
			}
			return $all_users->result();
		}

		public function delete_user($user_id){
			$data = array('is_active' => 0);
			$this->db->where('id', $user_id);
			$row = $this->db->update('users', $data);
			return $row;
		}

		public function delete_contact($contact_id){
			$data = array('is_active' => 0);
			$this->db->where(id, $contact_id);
			return $this->db->update('contacts', $data);
		}

		public function delete_shipment($ship_id){
			$this->db->where('id', $ship_id);
			return $this->db->delete('shipments');
		}

		public function rectify_rollovers($id){
			$new = array('is_allocated' => 0, 'shipment_allocated' => 0);
			$this->db->where('shipment_allocated', $id);
			return $this->db->update('rollovers', $new);
		}

		public function insert_expense($expense){
			$result = $this->db->insert('expenses', $expense );

			if ($result){
				return $this->db->insert_id();
			}
			else{
				return false;
			}
		}

		public function delete_expense($id){
			$this->db->where('id', $id);
			return $this->db->delete('expenses');
		}

		public function update_expense($expense, $id){
			$this->db->where('id', $id);
			$result = $this->db->update('expenses', $expense );

			if ($result){
				return true;
			}
			else{
				return false;
			}
		}

		public function add_expense_image($id, $name){
			$image = array('image' => $name);
			$this->db->where('id', $id);
			return $this->db->update('expenses', $image);
		}

		public function get_all_expenses(){
			$this->db->select('expenses.*, contacts.name');
			$this->db->from('expenses');
			$this->db->join('contacts', 'expenses.supplier = contacts.id');
			$this->db->order_by('date', 'DESC');
			$result = $this->db->get();

			if ($result){
				return $result->result();
			}
			else{
				return false;
			}
		}

		public function get_contact($id){
			$this->db->where('id', $id);
			return $this->db->get('contacts')->row();
		}

		public function get_expense($id){
			$this->db->where('id', $id);
			$result = $this->db->get('expenses');

			if ($result->num_rows() > 0){
				return $result->row();
			}
			else{
				return false;
			}
		}

	}
?>
