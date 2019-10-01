<?php

	class Invoice_model extends CI_model{

		public function delete_override($over_id){
			$this->db->where('id', $over_id);
			return $this->db->delete('override_prices');
		}

		public function update_purchase($new_status, $inv_id){
			$this->db->where('purchase_id', $inv_id);
			return $this->db->update('purchase', $new_status);
		}


		public function get_cat_price($id){
			$this->db->where('product_id', $id);
			$result = $this->db->get('product_attribute');

			if ($result->num_rows() > 0){
				return $result->row()->value;
			}
			else{
				return false;
			}
		}

		public function delete_invoice($id){
			// Delete Invoice from Purchase Table
			$this->db->where('purchase_id', $id);
			$result1 = $this->db->delete('purchase');
			// Delete Invoice Rows from Purchase Attribute
			$this->db->where('inv_id', $id);
			$this->db->delete('purchase_attribute');
			$this->db->where('inv_id', $id);
			$this->db->delete('purchase_images');
			$this->db->where('inv_id', $id);
			$this->db->delete('notes');
			if ($result1){
				return true;
			}
			else{
				return false;
			}
		}

		public function get_all_invoices_in_date(){
			$result = $this->db->get('purchase');
			if ($result->num_rows() > 0){
				return $result->result();
			}
			else{
				return false;
			}
		}

		public function get_invoice_images($inv_id){
			$this->db->where('inv_id', $inv_id);
			$result = $this->db->get('purchase_images');
			if ($result->num_rows() > 0){
				return $result->result();
			}
			else{
				return false;
			}
		} // end get_invoice_images

		public function update_cat_qty($total_cats, $result_invoice_add){

			$this->db->where('purchase_id', $result_invoice_add);
			return $result = $this->db->update('purchase', $total_cats);

		} // end update_cat_qty

		public function add_image($id, $image){
			$row = array('inv_id' => $id,
						'image' => $image);

			$result = $this->db->insert('purchase_images', $row);
			if ($result){
				return true;
			}
			else{
				return false;
			}
		}// end add_image

		public function get_product_name($product_id){
			$this->db->select('name');
			$this->db->where('id' , $product_id);
			$result = $this->db->get('product');
			if ($result->num_rows() == 1){
				return $result->row()->name;
			}
			else{
				return '****ERROR-NO PRODUCT****';
			}
		}

		public function get_product_image($product_id){
			$this->db->select('image');
			$this->db->where('id', $product_id);
			$result = $this->db->get('product');
			if ($result->num_rows() == 1){
				$image_string = 'cat_img/resized_cat_images_300/' . $result->row()->image;
				return $image_string;
			}
			else {
				return 'cat_img/no_image.jpg';
			}
		}

		public function get_invoice($inv_id){
			$this->db->select('purchase.*, users.username, users.email, users.first_name, users.phone, users.mobile');
			$this->db->from('purchase');
			$this->db->where('purchase_id', $inv_id);
			$this->db->join('users', 'purchase.admin_id = users.username');
			$result = $this->db->get();
			return $result->row();
		} // end get_invoice()

		public function delete_row($id){
			$this->db->where('ID', $id);
			$this->db->delete('purchase_attribute');
		} // end delete_row()

		public function get_invoice_rows($inv_id){
			 $this->db->where('inv_id', $inv_id);
			 $this->db->order_by('LINE_NUM', 'ASC');
			 $result = $this->db->get('purchase_attribute');
			 return $result->result();
		} // end get_invoice_rows()

		public function get_invoice_rows_as_array($inv_id){
			 $this->db->where('inv_id', $inv_id);
			 $result = $this->db->get('purchase_attribute');
			 return $result->result_array();
		} // end get_invoice_rows()

		public function get_invoice_notes($inv_id){
			$this->db->where('inv_id', $inv_id);
			$this->db->limit(15);
			$result = $this->db->get('notes');
			return $result->row();
		} // end get_invoice_notes

		public function save_invoice($invoice){

			$result = $this->db->insert('purchase', $invoice);

			if ($result){
				return $this->db->insert_id();
			}
			else{
				return false;
			}

		} // End save_invoice()

		public function override_cat_customer_price($override){

			// check if entry currently exists
			$this->db->where('cat_id', $override['cat_id'] );
			$this->db->where('customer_id', $override['customer_id']  );
			$result_old = $this->db->get('override_prices');
			if ( $result_old->num_rows() > 0 ){
				$result = $this->db->update('override_prices', $override);
				return $result;
			}
			else{
				$result = $this->db->insert('override_prices', $override);
				return $result;
			}


		}

		public function update_invoice($invoice, $id){

			$this->db->where('purchase_id', $id);
			$result = $this->db->update('purchase', $invoice);

			if ($result){
				return true;
			}
			else{
				return false;
			}

		} // End update_invoice()

		public function add_invoice_rows($row){

			$result = $this->db->insert('purchase_attribute', $row);

			if ($result){
				return $this->db->insert_id();
			}

			else{
				return false;
			}
		} // End add_invoice_rows()

		public function update_invoice_row($row, $id){

			$this->db->where('ID', $id);
			$result = $this->db->update('purchase_attribute', $row);
			if ($result){
				return true;
			}

			else{
				return false;
			}


		} // End update_invoice_row()

		public function update_note($note, $id){
			$this->db->where('id', $id);
			$result = $this->db->update('notes', $note);
			if ($result){
				return true;
			}
			else{
				return false;
			}
		}


		public function add_note($note){

			$result = $this->db->insert('notes', $note);
			return $result;

		} // end add_note()

		public function get_all_invoices(){

			// If user is a worker, only return invoices with status: PAID
			if ($this->session->userdata('user_type') != 'admin'){
				$this->db->where_not_in('status', 0); // Do not display Quote Invoices
			}

			$result = $this->db->get('purchase');
			return $result->result();
		} // end all_invioces()

			public function get_note_by_invoice($invoice_id){
			$this->db->where('inv_id', $invoice_id);
			$result = $this->db->get('notes');
			if ($result->num_rows() > 0){
				return $result->row();
			}
			else{
				return false;
			}
		} // end get_note_by_invoice_id

		public function get_note_id_by_invoice($invoice_id){
			$this->db->select('id');
			$this->db->where('inv_id', $invoice_id);
			// TODO it won't have an ID, currently it does but it shouldn't. Remove entry if empty and if no id return ''; Same goes for above
		}

		public function get_customer_name($id){
			$this->db->select('business_name');
			$this->db->where('id', $id);
			$result = $this->db->get('stockist')->row_array();
			//echo $result->row(); echo '<br />';
			return $result['business_name'];
		} // end get_customer_name
	}
?>
