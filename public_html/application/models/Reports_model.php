<?php

class Reports_model extends CI_model
{

    public function get_final_date()
    {
        $this->db->limit(1);
        $this->db->order_by('id', 'desc');
        $result = $this->db->get('shipments');
        if ($result->num_rows() > 0) {
            $date_last = $result->row()->to_date;

            $new_to_date = new DateTime($date_last);
            //$new_to_date->modify('+1 day');
            $new_to_date = $new_to_date->format('Y-m-d H:i');

            return $new_to_date;
        } else {
            return '';
        }
    }

    public function commit_cat_sale_price($from, $to)
    {
            
        // get a reference to all cats within date range
        $this->db->select('purchase_attribute.ID, purchase_attribute.INV_ID, purchase_attribute.PRODUCT, product_attribute.product_id, product_attribute.VALUE, purchase.date, purchase.purchase_id');
        $this->db->from('purchase_attribute');
        $this->db->join('product_attribute', 'purchase_attribute.PRODUCT = product_attribute.product_id');
        $this->db->join('purchase', 'purchase_attribute.INV_ID = purchase.purchase_id');
        $this->db->where('purchase.date >', $from);
        $this->db->where('purchase.date <=', $to);
        $rows_to_commit = $this->db->get()->result();


        foreach ($rows_to_commit as $row) {
            $new_entry = array('SOLD_PRICE' => $row->VALUE);
            $this->db->where('ID', $row->ID);
            $this->db->update('purchase_attribute', $new_entry);
        }

        // for each get the sell price and save it purchase_attribute
    }

    public function update_shipment($new_shipment, $shipment_id)
    {
        $this->db->where('id', $shipment_id);
        $result = $this->db->update('shipments', $new_shipment);
        return $result;
    }

    public function update_rollover($new, $id)
    {
        $this->db->where('id', $id);
        return $this->db->update('rollovers', $new);
    }

    public function delete_rollover($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('rollovers');
    }

    public function get_single_rollover($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('rollovers')->row();
    }

    public function get_single_shipment($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('shipments')->row();
    }

    public function get_all_shipments()
    {
        $this->db->order_by("id", "DESC");
        $result = $this->db->get('shipments');
        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return 0;
        }
    }

    public function get_shipment_by_date($from, $to)
    {
        $this->db->select('shipments.*');
        $this->db->where('to_date >=', $from);
        $this->db->where('to_date <=', $to);
        return $this->db->get('shipments')->result();
    }

    public function save_shipment($new_shipment) 
    {
        $result = $this->db->insert('shipments', $new_shipment);
        if ($result) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    public function save_rollover($new)
    {
        $result = $this->db->insert('rollovers', $new);
        if ($result) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    public function update_rollover_allocation($id)
    {
        $new = array('is_allocated' => 1, 'shipment_allocated' => $id);
        $this->db->where('is_allocated', 0);
        return $this->db->update('rollovers', $new);
    }

    public function get_unallocated_rollovers()
    {
        //$this->db->select() accepts an optional second parameter. If you set it to FALSE, CodeIgniter will not try to protect your field or table names. This is useful if you need a compound select statement where automatic escaping of fields may break them.
        $this->db->select('(SELECT SUM(rollovers.amount) FROM rollovers WHERE rollovers.is_allocated =0) AS total_rollover', false);
        return $this->db->get('rollovers')->row();
    }

    public function get_unallocated_rollovers_with_id($id)
    {
        //$this->db->select_sum('amount');
        $this->db->select('(SELECT SUM(amount) FROM rollovers WHERE shipment_allocated = ' . $id . ') AS total_rollover', false);
        //$this->db->where('shipment_allocated', $id);
        return $this->db->get('rollovers')->row();
    }

    public function get_unallocated_rollovers_gst()
    {
        $this->db->select('(SELECT SUM(rollovers.gst) FROM rollovers WHERE rollovers.is_allocated=0 ) AS rollover_gst', false);
        return $this->db->get('rollovers')->row();
    }

    public function get_unallocated_rollovers_gst_with_id($id)
    {
        $this->db->select('(SELECT SUM(gst) FROM rollovers WHERE shipment_allocated = ' . $id . ') AS rollover_gst', false);
        return $this->db->get('rollovers')->row();
    }

    public function get_rollovers_by_date($from, $to)
    {
        $this->db->select_sum('amount');
        $this->db->where('date >', $from);
        $this->db->where('date <=', $to);
        return $this->db->get('rollovers')->row();
    }

    public function get_rollovers_by_shipment($shipment, $from, $to)
    {
        $this->db->select_sum('amount');
        $this->db->where('date >', $from);
        $this->db->where('date <=', $to);
        $this->db->where('shipment', $shipment);
        //var_dump($this->db->get('rollovers')->row());
        return $this->db->get('rollovers')->row();
    }

    public function get_rollovers_gst_by_shipment($shipment, $from, $to)
    {
        $this->db->select_sum('gst');
        $this->db->where('date >', $from);
        $this->db->where('date <=', $to);
        $this->db->where('shipment', $shipment);
        return $this->db->get('rollovers')->row();
    }
    public function get_rollovers_by_shipment_only($shipment)
    {
        $this->db->select_sum('amount');
        $this->db->where('shipment', $shipment);
        return $this->db->get('rollovers')->row();
    }
    public function get_rollovers_gst_by_shipment_only($shipment)
    {
        $this->db->select_sum('gst');
        $this->db->where('shipment', $shipment);
        return $this->db->get('rollovers')->row();
    }
    public function get_rollovers_gst_by_date($from, $to)
    {
        $this->db->select_sum('gst');
        $this->db->where('date >', $from);
        $this->db->where('date <=', $to);
        return $this->db->get('rollovers')->row();
    }

    public function get_expense_gst($from, $to)
    {
        $this->db->select_sum('gst');
        $this->db->where('date >', $from);
        $this->db->where('date <=', $to);
        return $this->db->get('expenses')->row();
    }

    public function add_rollover_image($id, $name)
    {
        $image_entry = array('image' => $name);
        $this->db->where('id', $id);
        return $this->db->update('rollovers', $image_entry);
    }

    public function get_rollovers()
    {
        $this->db->select('rollovers.*, shipments.from_date, shipments.to_date, contacts.name');
        $this->db->from('rollovers');
        $this->db->join('shipments', 'rollovers.shipment = shipments.id', 'left');
        $this->db->join('contacts', 'rollovers.payee = contacts.id');
        $this->db->order_by('shipments.to_date', 'DESC');
        return $this->db->get()->result();
    }

    public function get_expenses_from($from, $to)
    {
        $this->db->select('expenses.*, contacts.name');
        $this->db->where('date >=', $from);
        $this->db->where('date <=', $to);
        $this->db->join('contacts', 'expenses.supplier = contacts.id');
        return $this->db->get('expenses')->result();
    }

    public function shipment_summary_report($from, $to)
    {

        $this->db->select('purchase_attribute.PRICE, purchase_attribute.OVERRIDE_PRICE, purchase_attribute.QTY, purchase_attribute.SOLD_PRICE, product.id, product.name, purchase.date, purchase.status, product_attribute.monolight_dry_weight_net, product_attribute.metal_content_pd, product_attribute.metal_content_pt, product_attribute.metal_content_rh, product_attribute.value');
        $this->db->from('purchase_attribute');
        $this->db->join('product', 'purchase_attribute.PRODUCT = product.id');
        $this->db->join('purchase', 'purchase_attribute.INV_ID = purchase.purchase_id');
        $this->db->join('product_attribute', 'purchase_attribute.PRODUCT = product_attribute.product_id');
        $this->db->where('purchase.date >', $from);
        $this->db->where('purchase.date <=', $to);
        $this->db->where('purchase.status', 2);
        $rows = $this->db->get()->result();
        return $rows;
    }

    public function pdf_report($from, $to)
    {
        $this->db->select('purchase.purchase_id, purchase.date, purchase.admin_id, purchase.Total, stockist.business_name, stockist.office_phone, stockist.address, stockist.email, stockist.rep_contact, stockist.rep_email, users.first_name, users.email, users.phone, users.mobile');
        $this->db->from('purchase');
        $this->db->join('stockist', 'purchase.customer_id = stockist.id');
        $this->db->join('users', 'purchase.admin_id = users.username');
        $this->db->where('purchase.status', 2);
        $this->db->where('purchase.date >=', $from);
        $this->db->where('purchase.date <', $to);
        $rows = $this->db->get();
        if ($rows->num_rows() > 0) {
            return $rows->result();
        } else {
            return false;
        }
    }

    public function pdf_report_single($inv_id)
    {
        $this->db->select('purchase.purchase_id, purchase.date, purchase.Total, stockist.business_name, stockist.office_phone, stockist.address, stockist.email, stockist.rep_contact, stockist.rep_email');
        $this->db->from('purchase');
        $this->db->join('stockist', 'purchase.customer_id = stockist.id');
        //$this->db->where('purchase.status', 2);
        $this->db->where('purchase.purchase_id', $inv_id);
        $rows = $this->db->get();
        if ($rows->num_rows() > 0) {
            return $rows->row();
        } else {
            return false;
        }
    }

    public function get_total_expense($from, $to)
    {
        $this->db->select_sum('amount', 'sum');
        $this->db->where('date >=', $from);
        $this->db->where('date <', $to);
        $result = $this->db->get('expenses');
        $result = $result->row()->sum;
        if ($result) {
            return $result;
        } else {
            return 0;
        }
    }

    public function get_all_staffs()
    {
        $result = $this->db->get('users');
        return $result->result();
    }


    public function pop_overrides()
    {
        $customer = $this->input->get('term');
        $this->db->where('customer_id', $customer);
        //$this->db->order_by('date_current', 'DESC');
        $query = $this->db->get('override_prices');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return 'No Entries';
        }
    }

    public function pop_notes()
    {
        $customer = $this->input->get('term');
        $this->db->where('customer', $customer);
        $this->db->order_by('DATE', 'DESC');
        $query = $this->db->get('notes');

        if ($query->num_rows() > 0) {
            $query = $query->result();
            $result = '';
            foreach ($query as $row) {
                $result .= '<tr role="row">
                        <th style="width:85%">' . $row->note . '</th>
                        <th style="with:15%">' . $row->Date . '</th>
                 		</tr>';
            }

            return $result;
        } else {
            return false;
        }
    }

    public function shipment_summary_report_user($staff, $from, $to)
    {
        $this->db->select('purchase_attribute.PRICE, purchase_attribute.QTY, purchase_attribute.SOLD_PRICE, product.id, product.name, purchase.purchase_id, purchase.Total, purchase.commission, purchase.date, purchase.status, product_attribute.monolight_dry_weight_net, product_attribute.metal_content_pd, product_attribute.metal_content_pt, product_attribute.metal_content_rh, product_attribute.value, stockist.business_name');
        $this->db->from('purchase');
        $this->db->where('admin_id', $staff);
        $this->db->where('purchase.status', 2);
        $this->db->where('purchase.date >=', $from);
        $this->db->where('purchase.date <', $to);
        $this->db->join('purchase_attribute', 'purchase.purchase_id = purchase_attribute.INV_ID');
        $this->db->join('product', 'purchase_attribute.PRODUCT = product.id');
        $this->db->join('product_attribute', 'purchase_attribute.PRODUCT = product_attribute.product_id');
        $this->db->join('stockist', 'purchase.customer_id = stockist.id');
        $this->db->order_by('purchase.date', 'DESC');
        $rows = $this->db->get()->result();
        return $rows;
    }

    public function pop_cats()
    {
        $customer = $this->input->get('term');
        $query = 'purchase_attribute.product, purchase_attribute.id, purchase_attribute.QTY, purchase.customer_id, product.id, product.name, product.description, product.sample_number, product.image, product.final_price, product_attribute.value, product_attribute.price_1, product_attribute.price_2, product_attribute.price_3, status, SUM(purchase_attribute.QTY ) AS Popularity
			FROM `purchase_attribute`
			INNER JOIN `purchase`
				ON purchase.purchase_id=purchase_attribute.INV_ID AND STATUS=2 AND purchase.customer_id =' . $customer .
        ' INNER JOIN `product`
				ON purchase_attribute.PRODUCT=product.id
			INNER JOIN `product_attribute`
				ON product.id=product_attribute.product_id
			GROUP BY PRODUCT ORDER BY product.name ASC LIMIT 70';
        $this->db->select($query);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            // Loop through all the results and concatenate to a string
            $cats = $query->result_array();

            // Variable to store result
            $result = '';

            for ($i = 0; $i < count($cats); $i++) {
                // Check if it doesn't have an image
                if ($cats[$i]['image'] == '') {
                    $image_string = base_url() . 'cat_img/no_image.jpg';
                } else {
                    $image_string = base_url() . 'cat_img/resized_cat_images_300/' . $cats[$i]['image'];
                }
                if ($i % 4 == 0) {
                    $result .= '<div class="row">
										<div class="col-md-12">
											<ul class="row thumbnails">';
                }
                if ($cats[$i]['final_price'] != 0) {
                                                    $cats[$i]['price_1'] = $cats[$i]['final_price'];
                                                    $cats[$i]['price_2'] = $cats[$i]['final_price'];
                                                    $cats[$i]['price_3'] = $cats[$i]['final_price'];
                }
                $result .= '<li class="col-sm-3">
                        <div class="thumbnail">
                            <img src="' . $image_string . '" />
                            <div class="caption data-holder">
                                <h4>' . $cats[$i]['name'] . '</h4>
                                <h6><strong>' . $cats[$i]['sample_number']  . '</strong></h6>
								<p>Price: <strong>$<span class="price_holder">' . '</span></strong></p>
								<input style="margin-bottom:25px" class="form-control" type="number" placeholder="QTY" onchange="updateThisQuantity(this)" data-qty-id="' . $cats[$i]['id'] . '" data-name="' .  $cats[$i]['name'] . '" />

								<a data-id="' . $cats[$i]['id'] . '" data-name="' . $cats[$i]['name'] . '" data-price="' . $cats[$i]['value'] . '" data-image="' . $image_string . '" data-price1 = "' . $cats[$i]['price_1'] . '" data-price2 = "' . $cats[$i]['price_2'] . '" data-price3="' . $cats[$i]['price_3'] . '" class="btn btn-inverse invoice_add" onclick="addToInvoice(this)">Add</a>

								<a data-fancybox="iframe" data-src="' . site_url() . '/pages/view/preview_cat/' . $cats[$i]['id'] . '" data-type="iframe" class="btn btn-inverse">Info</a>
                            </div>
                        </div>
                    </li>';

                if ($i % 4 == 3) {
                    $result .= '
                </ul>
            </div>
       	 </div>';
                }
            } // end for loop
            return $result;
        } else {
            return false;
        }
    }
}
