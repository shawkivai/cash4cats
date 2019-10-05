<?php

class Catalogue_model extends CI_model
{

    public function get_log_data()
    {

        $this->db->select('override_prices.*, stockist.business_name, product.name, product_attribute.value');
        $this->db->from('override_prices');
        $this->db->join('stockist', 'override_prices.customer_id = stockist.id');
        $this->db->join('product', 'override_prices.cat_id = product.id');
        $this->db->join('product_attribute', 'override_prices.cat_id = product_attribute.product_id');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function save_cat($cat)
    {
        $result = $this->db->insert('product', $cat);

        if ($result) {
                return $this->db->insert_id();
        } else {
            return false;
        }
    }

    public function get_all_category_names()
    {
        $this->db->select('category_id, name');
        $row = $this->db->get('category');
        if ($row->num_rows() > 0) {
            return $row->result();
        } else {
            return false;
        }
    }

    public function get_discounts()
    {
        return $this->db->get('customer_discounts')->row();
    }

    public function get_price_groupings()
    {
        return $this->db->get('price_categories')->result();
    }

    public function update_image($cat_id, $img)
    {
        $this->db->where('id', $cat_id);
        return $this->db->update('product', $img);
    }

    public function update_cat_attr($cat_id, $cat_attr_array)
    {
        $this->db->where('product_id', $cat_id);
        return $this->db->update('product_attribute', $cat_attr_array);
    }

    public function save_cat_attr($cat_attr_array)
    {
        $result = $this->db->insert('product_attribute', $cat_attr_array);
        if ($result) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }


    public function update_cat($cat_id, $cat_array)
    {
        $this->db->where('id', $cat_id);
        return $this->db->update('product', $cat_array);
    }

    public function get_all_categories()
    {
        $row = $this->db->get('category');
        if ($row->num_rows() > 0) {
            return $row->result();
        } else {
            return false;
        }
    }

    public function ajax_cats()
    {
        $this->db->select('product.id, product.name, product.description, product.sample_number, product.image, product.final_price, product_attribute.value, product_attribute.price_1, product_attribute.price_2, product_attribute.price_3');
        $this->db->from('product');
        $this->db->like('name', $this->input->get('term'));
        $this->db->join('product_attribute', 'product_attribute.product_id = product.id');
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

    public function get_cats_in_category($id)
    {
        $this->db->where('category_id', $id);
        $rows = $this->db->get('product');
        if ($rows->num_rows() > 0) {
            return $rows->result_array();
        } else {
            return false;
        }
    }

    public function get_cats_in_category_and_price($id)
    {
        $this->db->select('product.id, product.name, product.description, product.image, product_attribute.value');
        $this->db->from('product');
        $this->db->where('category_id', $id);
        $this->db->join('product_attribute', 'product_attribute.product_id = product.id');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function get_all_cats()
    {
        $rows = $this->db->get('product');
        if ($rows->num_rows() > 0) {
            return $rows->result();
        } else {
            return false;
        }
    }

    public function get_all_cats_as_array()
    {
        $rows = $this->db->query('SELECT product.id, product.name, product.sample_number, product.description, product.image, product.final_price, product_attribute.value, product_attribute.price_1, product_attribute.price_2, product_attribute.price_3
			FROM product INNER JOIN product_attribute WHERE product.id = product_attribute.product_id ORDER BY product.name ASC');
        //$this->db->select('product.id, product.name, product.description, product.image, product_attribute.value');
        //$this->db->from('product p2');
        //$this->db->join('product_attribute', 'product_attribute.product_id = p2.id', 'inner');
        //$this->db->limit(5000);
        //$rows = $this->db->get('product');
        if ($rows->num_rows() > 0) {
            return $rows->result_array();
        } else {
            return false;
        }
    }

    public function get_all_cat_data($id)
    {
        $query = 'SELECT * FROM product INNER JOIN product_attribute WHERE product.id = ' . $id . ' AND product.id = product_attribute.product_id';
        $row = $this->db->query($query);
        if ($row->num_rows() == 1) {
            return $row->row();
        } else {
            return false;
        }
    }

    public function get_cat_data($id)
    {
        $query = 'SELECT * FROM product WHERE product.id = ' . $id;
        $row = $this->db->query($query);
        if ($row->num_rows() == 1) {
            return $row->row();
        } else {
            return false;
        }
    }

    public function update_image_string($product_id, $new_image)
    {
        $new_image = array('image' => $new_image);
        $this->db->where('id', $product_id);
        $this->db->update('product', $new_image);
    }
}
