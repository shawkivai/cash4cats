<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Benchmarks extends CI_Controller
{

    public function update_discounts()
    {

        $this->load->model('benchmarks_model');
        $new = array(
                'one' => $this->input->post('bestCustomers'),
                'two' => $this->input->post('avgCustomers'),
                'three' => $this->input->post('rareCustomers')
            );
        $result = $this->benchmarks_model->update_discounts($new);

        if ($result) {
            $this->session->set_flashdata('notice_discounts', 'Exchange Rate Successfully Updated');
        } else {
            $this->session->set_flashdata('notice_discounts', 'Error setting exchange rate to Database');
        }
        redirect(site_url() . '/pages/view/calculator');
    } //end function

    public function update_price_groupings()
    {
        $this->load->model('benchmarks_model');
        $redirect = site_url() . '/pages/view/calculator';

        $new_groups = array();
        for ($i = 1; $i < 81; $i++) {
            $new_groups['upper_limit'] = $this->input->post('g'.$i);
            $result = $this->benchmarks_model->update_price_groupings($new_groups, $i);
            if (!$result) {
                $this->session->set_flashdata('notice_groupings', 'Error updating price groupings: ' . $this->input->post('g'.$i));
                redirect($redirect);
            }
        } // End For Loop
        $this->session->set_flashdata('notice_groupings', 'Price Groupings Successfully Updated');
        redirect($redirect);
    }

    public function update_options()
    {
        $this->load->model('benchmarks_model');
        $value1 = array(
            'option-value' => $this->input->post('super')
        );
        $result1 = $this->benchmarks_model->save_option('super', $value1);

        $value2 = array(
            'option-value' => $this->input->post('tax')
        );
        $result2 = $this->benchmarks_model->save_option('income', $value2);

        if ($result1 && $result2) {
            $this->session->set_flashdata('options', 'Options Successfully Updated');
        } else {
            $this->session->set_flashdata('options', 'Options Successfully Updated');
        }
        redirect(site_url() . '/pages/view/calculator');
    }

    public function update_conversion_rate()
    {

        $this->load->model('benchmarks_model');
        $result = $this->benchmarks_model->update_conversion_rate();
        $this->update_all_cat_values();

        if ($result) {
            $this->session->set_flashdata('notice', 'Exchange Rate Successfully Updated');
        } else {
            $this->session->set_flashdata('notice', 'Error setting exchange rate to Database');
        }
        redirect(site_url() . '/pages/view/calculator');
    }

    public function update_market_values()
    {

        $this->load->model('benchmarks_model');
        $result = $this->benchmarks_model->update_market_values();
        $this->update_all_cat_values();

        if ($result) {
            $this->session->set_flashdata('notice_market', 'Market Values Successfully Updated');
        } else {
            $this->session->set_flashdata('notice_market', 'Error updating Market Values to Database');
        }
        redirect(site_url() . '/pages/view/calculator');
    }

    public function update_other_values()
    {

        $this->load->model('benchmarks_model');
        $result = $this->benchmarks_model->update_other_values();
        $this->update_all_cat_values();

        if ($result) {
            $this->session->set_flashdata('notice_other', 'Values Successfully Updated');
        } else {
            $this->session->set_flashdata('notice_other', 'Error Updating Values');
        }
        redirect(site_url() . '/pages/view/calculator');
    }

    public function update_all_cat_values()
    {

        // This function will update all cat attributes once any of the benchmarks are changed.
        $this->load->model('benchmarks_model');
        $result = $this->benchmarks_model->update_all_cat_prices();

        if ($result) {
            $this->session->set_flashdata('notice_update', 'Cat Prices Have Been Updated.');
        } else {
            $this->session->set_flashdata('notice_update', 'Error updating Cat Prices');
        }
    }
}
