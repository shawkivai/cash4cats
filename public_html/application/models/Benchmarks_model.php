<?php

class Benchmarks_model extends CI_model
{

    public $price_groups;

    function __construct()
    {
        // Get Customer Discounts table
        $this->db->order_by('upper_limit', 'ASC');
        $this->price_groups = $this->db->get('price_categories')->result_array();
        //error_log(var_export($price_groups));
        parent::__construct();
    }

    public function get_options()
    {
        $result = $this->db->get('options')->result_array();
        return $result;
    }

    public function save_option($option, $value)
    {
        $this->db->where('option-name', $option);
        return $this->db->update('options', $value);
    }

    public function update_discounts($new)
    {
        $this->db->where('id', 1);
        return $this->db->update('customer_discounts', $new);
    }

    public function update_price_groupings($update, $id)
    {
        $this->db->where('id', $id);
        $result = $this->db->update('price_categories', $update);
        return $result;
    }

    public function get_benchmarks()
    {
        $row = $this->db->get('benchmark');
        if ($row->num_rows() == 1) {
            return $row->row();
        } else {
            return false;
        }
    }

    public function update_conversion_rate()
    {
        $new_conversion_rate = array(
            'value_a' => $this->input->post('exchange-rate')
        );

        $this->db->where('benchmark_id', 1);
        $result = $this->db->update('benchmark', $new_conversion_rate);
        return $result;
    }

    public function update_market_values()
    {

        $us_ounce_pt = $this->input->post('platinum');
        $us_ounce_pd = $this->input->post('palladium');
        $us_ounce_rh = $this->input->post('rhodium');
            

        $new_market_rates = array(
            'us_per_ounce_pt' => $us_ounce_pt,
            'us_per_ounce_pd' => $us_ounce_pd,
            'us_per_ounce_rh' => $us_ounce_rh
        );

        $this->db->where('benchmark_id', 1);
        $result = $this->db->update('benchmark', $new_market_rates);
        return $result;
    }


    public function update_other_values()
    {

        $new_other_rates = array(
            'monolith_dry_weight' => $this->input->post('monolith_dry_weight'),
            'metal_returned_pd' => $this->input->post('metal_returned_palladium'),
            'metal_returned_pt' => $this->input->post('metal_returned_platinum'),
            'metal_returned_rh' => $this->input->post('metal_returned_rhodium'),
            'process_charges_us_tc' => $this->input->post('process_charge')
        );

        $this->db->where('benchmark_id', 1);
        $result = $this->db->update('benchmark', $new_other_rates);
        return $result;
    }

    public function update_cat_price($cat_id)
    {
        // Benchmarks

        $benchmarks = $this->get_benchmarks();

        if ($benchmarks != false) {
            $monolith_dry_weight    = $benchmarks->monolith_dry_weight;
            $metal_returned_pd      = $benchmarks->metal_returned_pd;
            $metal_returned_pt      = $benchmarks->metal_returned_pt;
            $metal_returned_rh      = $benchmarks->metal_returned_rh;
            $price_pd_per_kilo      = $benchmarks->us_per_ounce_pd;
            $price_pt_per_kilo      = $benchmarks->us_per_ounce_pt;
            $price_rh_per_kilo      = $benchmarks->us_per_ounce_rh;
            $process_charges_us_tc  = $benchmarks->process_charges_us_tc;
            $value_exchangerate     = $benchmarks->value_a;
        } else {
            return false;
        }

        // Get Customer Discounts table
            $discounts = $this->db->get('customer_discounts')->row();
            // Product Attributes:
            $this->db->where('id', $cat_id);
            $row = $this->db->get('product_attribute')->result_array()[0];

            $id = $row['id'];

            $weight_casing = $row['weight_cat'] - $row['weight_ceramic'];

            $weight_ceramic = $row['weight_ceramic'];

            $pt_content = $row['pt_content'];
            $pd_content = $row['pd_content'];
            $rh_content = $row['rh_content'];

            $pt = round(( ($weight_ceramic*$pt_content/1000000)/100 )*$metal_returned_pt, 6);
            $pd = round(( ($weight_ceramic*$pd_content/1000000)/100 )*$metal_returned_pd, 6);
            $rh = round(( ($weight_ceramic*$rh_content/1000000)/100)*$metal_returned_rh, 6);

            $value = ($pt*$price_pt_per_kilo) + ($pd*$price_pd_per_kilo) + ($rh*$price_rh_per_kilo) - ($process_charges_us_tc*$weight_ceramic);
            $value = $value/$value_exchangerate;

            $price_1 = $this->place_price($value - $discounts->one);
            $price_2 = $this->place_price($value - $discounts->two);
            $price_3 = $this->place_price($value - $discounts->three);

            $sql_update = array(
                'pd' => $pd
                ,'pt' => $pt
                ,'rh' => $rh
                ,'weight_casing' => $weight_casing
                ,'value' => $value
                ,'price_1' => $price_1
                ,'price_2' => $price_2
                ,'price_3' => $price_3
            );

            $this->db->where('id', $id);
            $result_update = $this->db->update('product_attribute', $sql_update);

            // Update price on Products Table
            /*$price_update = array (
                    'price' => $value_a_attribute
                );

                $this->db->where('id', $row['product_id']);
            $result_price_update = $this->db->update('product', $price_update);*/


            // If Error updating to database
            if ($result_update == false) {
                //$row->free_result();
                return false;
            }

            //$row->free_result();
            return true;
    }


    public function update_all_cat_prices()
    {

        // Benchmarks

        $benchmarks = $this->get_benchmarks();

        if ($benchmarks != false) {
            $monolith_dry_weight    = $benchmarks->monolith_dry_weight;
            $metal_returned_pd      = $benchmarks->metal_returned_pd;
            $metal_returned_pt      = $benchmarks->metal_returned_pt;
            $metal_returned_rh      = $benchmarks->metal_returned_rh;
            $price_pd_per_kilo      = $benchmarks->us_per_ounce_pd;
            $price_pt_per_kilo      = $benchmarks->us_per_ounce_pt;
            $price_rh_per_kilo      = $benchmarks->us_per_ounce_rh;
            $process_charges_us_tc  = $benchmarks->process_charges_us_tc;
            $value_exchangerate     = $benchmarks->value_a;
        } else {
            return false;
        }


        // Get Customer Discounts table
        $discounts = $this->db->get('customer_discounts')->row();

        // Product Attributes:
        $result = $this->db->get('product_attribute');


        foreach ($result->result_array() as $row) {
            $id = $row['id'];

            $weight_ceramic = $row['weight_ceramic'];

            $pt_content = $row['pt_content'];
            $pd_content = $row['pd_content'];
            $rh_content = $row['rh_content'];

            $pt = round(( ($weight_ceramic*$pt_content/1000000)/100 )*$metal_returned_pt, 6);
            $pd = round(( ($weight_ceramic*$pd_content/1000000)/100 )*$metal_returned_pd, 6);
            $rh = round(( ($weight_ceramic*$rh_content/1000000)/100)*$metal_returned_rh, 6);

            $value = ($pt*$price_pt_per_kilo) + ($pd*$price_pd_per_kilo) + ($rh*$price_rh_per_kilo) - ($process_charges_us_tc*$weight_ceramic);
            $value = $value/$value_exchangerate;

            $price_1 = $this->place_price($value - $discounts->one);
            $price_2 = $this->place_price($value - $discounts->two);
            $price_3 = $this->place_price($value - $discounts->three);
            /*
                $price_1 = $value - $discounts->one;
                $price_2 = $value - $discounts->two;
                $price_3 = $value - $discounts->three;
            */


            /* OLD SYSTEM
                $monolith_dry_weight_attribute = $row['gross_weight_monolith']*$monolith_dry_weight;

                $monolight_metal = $row['gross_weight_monolith']*0;
                $monolight_net = $row['gross_weight_monolith']-$monolith_dry_weight_attribute-$monolight_metal;

                $accepted_pd = $row['analysis_accepted_pd'];
                $accepted_pt = $row['analysis_accepted_pt'];
                $accepted_rh = $row['analysis_accepted_rh'];

                $metal_pd = $row['monolight_dry_weight_net']* ($accepted_pd/1000);
                $metal_pt = $row['monolight_dry_weight_net']* ($accepted_pt/1000);
                $metal_rh = $row['monolight_dry_weight_net']* ($accepted_rh/1000);

                $metal_returned_pd_attribute = $metal_pd* ($metal_returned_pd/100);
                $metal_returned_pt_attribute = $metal_pt* ($metal_returned_pt/100);
                $metal_returned_rh_attribute = $metal_rh* ($metal_returned_rh/100);

                $value_returned_pd = $metal_returned_pd_attribute*$value_returned_usgm_pd;
                $value_returned_pt = $metal_returned_pt_attribute*$value_returned_usgm_pt;
                $value_returned_rh = $metal_returned_rh_attribute*$value_returned_usgm_rh;
                $value_returned_total = $value_returned_pd+$value_returned_pt+$value_returned_rh;

                $refining_charges_pd = $metal_returned_pd_attribute*0/1000;
                $refining_charges_pt = $metal_returned_pt_attribute*0/1000;
                $refining_charges_rh = $metal_returned_rh_attribute*0/1000;

                $process_charges_us_tc_attribute = $row['gross_weight_monolith']*$process_charges_us_tc;
                $process_charges_decan_attribute = $row['gross_weight_converter']*0;
                $process_charges_comm_attribute = $monolight_net*0;
                $process_charges_lot_attribute = 0/1000;

                $sales_charges_pd = $metal_returned_pd_attribute/31.1034768*0;
                $sales_charges_pt = $metal_returned_pt_attribute/31.1034768*0;
                $sales_charges_rh = $metal_returned_rh_attribute/31.1034768*0;

                $interest = $value_returned_total*0.8*160/360*0;
                $total = $refining_charges_pd+$refining_charges_pt+$refining_charges_rh+$process_charges_us_tc_attribute+$process_charges_decan_attribute+$process_charges_comm_attribute+$process_charges_lot_attribute+$sales_charges_pd+$sales_charges_pt+$sales_charges_rh+$interest;
                $converter = $value_returned_total-$total;
                $value_a_attribute = $converter/$value_a;

                //Add GST
                $value_a_attribute *= 1.1;



                $price_1 = $this->place_price($value_a_attribute-($row['monolight_dry_weight_net']*$discounts->one));
                $price_2 = $this->place_price($value_a_attribute-($row['monolight_dry_weight_net']*$discounts->two));
                $price_3 = $this->place_price($value_a_attribute-($row['monolight_dry_weight_net']*$discounts->three));

            */

            // Round the value to 2 decimal places
            //$value_a_attribute = round($value_a_attribute, 2);

            /*// Round it down to the nearest five cents
                $newvalue;

                $valueInString = strval($value_a_attribute);
                if (strpos($valueInString, ".") == 0) $valueInString = $valueInString.".00";

                $valueArray = explode(".", $valueInString);
                $substringValue = substr($valueArray[1], 1);

                if ($substringValue >= 0 && $substringValue <= 4) {
                $tempValue = str_replace(substr($valueArray[1], 1), 0, substr($valueArray[1], 1));
                $tempValue = substr($valueArray[1],0,1).$tempValue;
                $newvalue = floatval($valueArray[0].".".$tempValue);
                }
                else {
                $tempValue = str_replace(substr($valueArray[1], 1), 5, substr($valueArray[1], 1));
                $tempValue = substr($valueArray[1],0,1).$tempValue;
                $newvalue = floatval($valueArray[0].".".$tempValue);
                }
                $value_a_attribute = $newvalue;
            */


            $sql_update = array(
                'pd' => $pd
                ,'pt' => $pt
                ,'rh' => $rh
                ,'value' => $value
                ,'price_1' => $price_1
                ,'price_2' => $price_2
                ,'price_3' => $price_3
            );

            $this->db->where('id', $id);
            $result_update = $this->db->update('product_attribute', $sql_update);

            // Update price on Products Table
            /*$price_update = array (
                    'price' => $value_a_attribute
                );

                $this->db->where('id', $row['product_id']);
            $result_price_update = $this->db->update('product', $price_update);*/


            // If Error updating to database
            if ($result_update == false) {
                $result->free_result();
                return false;
            }
        } // end foreach loop

        $result->free_result();
        //TEST CALL
        //$test_variable = $this->place_price(500);
        //error_log($test_variable);
        return true;
    }

    public function place_price($price)
    {
        $prev_upper_limit = $this->price_groups[0]['upper_limit'];
        foreach ($this->price_groups as $group) {
            if ($price > $group['upper_limit']) {
                $prev_upper_limit = $group['upper_limit'];
                continue;
            } else {
                // price is less than the next upperlimit so drop back
                return $prev_upper_limit;
            }
        }
        return $prev_upper_limit;
    }
}
