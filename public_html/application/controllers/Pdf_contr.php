<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pdf_contr extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Pdf');
    }

    public function send_email($inv_id)
    {

                $this->load->model('reports_model');
                
                //Get invoice info from invoice table
                $invoices = $this->reports_model->pdf_report_single($inv_id);

        if (!$invoices) {
            var_dump($invoices);
        } else {
            $dir = getcwd() . '/pdf_report';
            if (is_dir($dir)) {
                $this->load->helper('file');
                delete_files($dir, true);
                rmdir($dir);
            }

            mkdir($dir, 0777);

            $this->load->model('invoice_model');

                $invoices->rows = $this->invoice_model->get_invoice_rows($invoices->purchase_id);
                $invoices->images = $this->invoice_model->get_invoice_images($invoices->purchase_id);
                $filename = $this->pdf->create_a_pdf($invoices);

        // Send the email
            $this->load->library('email');
            $config['protocol'] = 'sendmail';
            $config['mailpath'] = '/usr/sbin/sendmail';
            $config['charset'] = 'iso-8859-1';
            $config['wordwrap'] = true;

            $this->email->initialize($config);

            $to_email = $this->input->get('to_email');

            $this->email->from('no-reply@cash4cats.com.au', 'Cash 4 Cats');
            $this->email->to($to_email);

            if (isset($_GET['cc_email'])) {
                $this->email->cc($this->input->get('cc_email'));
            }
                    
            if (isset($_GET['bcc_email'])) {
                $this->email->bcc($this->input->get('bcc_email'));
            }

            $this->email->subject('Invoice from Cash4Cats');
            $this->email->message('Please find your invoice attached');
            $this->email->attach($filename);

            $result = $this->email->send();

            if ($result) {
                $this->session->set_flashdata('notice', 'Email Successfully Sent');
            } else {
                $msg = 'Error Sending Invoice - ' . $result;
                $this->session->set_flashdata('notice', $msg);
            }
            $redirect = site_url() .'/pages/view/view_invoices';
            redirect($redirect);
        }
    }

    public function generate_pdf_report($inv_id)
    {
                $this->load->model('invoice_model');
                
                //Get invoice info from invoice table
                $data['invoice'] = $this->invoice_model->get_invoice($inv_id);
                
                //Get all invoice rows from attributes table
                $rows = $this->invoice_model->get_invoice_rows($inv_id);
                
                // For each invoice row append the product name and product image
                
        foreach ($rows as $row) {
            $row->name = $this->invoice_model->get_product_name($row->PRODUCT);
            $row->image = $this->invoice_model->get_product_image($row->PRODUCT);
        }
                
        $data['rows'] = $rows;
        
        // Customer Data
        $this->load->model('customers_model');
        $customer_invoice = isset($data['invoice']) && !empty($data['invoice']) ? $data['invoice']->customer_id : null;
        $data['customer'] =$this->customers_model->recall_customer($customer_invoice);
        // Get all images
        $data['images'] = $this->invoice_model->get_invoice_images($inv_id);
        
        $this->load->view('pages/invoice_pdf', $data);
    }

    public function generate_profit_loss_pdf()
    {

                $from = $_GET['from'];
                $to = $_GET['to'];
                $new_to_date = new DateTime($to);
                $new_to_date->modify('+1 day');
                $new_to_date = $new_to_date->format('Y-m-d H:i:s');

                $this->load->model('reports_model');
                
                $data['expenses'] = $this->reports_model->get_expenses_from($from, $new_to_date);

                $data['expense'] = $this->reports_model->get_total_expense($from, $new_to_date);
                $data['expense_gst'] = $this->reports_model->get_expense_gst($from, $new_to_date);

                    // Get an object with all the required data:

                    //$data['rollovers'] = $this->reports_model->get_rollovers_by_date($from, $new_to_date);
                    //$data['rollover_gst'] = $this->reports_model->get_rollovers_gst_by_date($from, $new_to_date);

                    $data['dates'] = array($from, $to);

                    $shipments= $this->reports_model->get_shipment_by_date($from, $new_to_date);

        foreach ($shipments as $shipment) {
            $shipment->rollover = $this->reports_model->get_rollovers_by_shipment($shipment->id, $from, $new_to_date)->amount;
            $shipment->gst_roll = $this->reports_model->get_rollovers_gst_by_shipment($shipment->id, $from, $new_to_date)->gst;
        }
                    $data['shipments'] = $shipments;

                    $this->load->view('pages/profit_loss_pdf', $data);
    }

    public function bulk_pdf_export()
    {
                $from = $this->input->get('from');
                $to = $this->input->get('to');

                $new_to_date = new DateTime($to);
                $new_to_date->modify('+1 day');
                $new_to_date = $new_to_date->format('Y-m-d');

                $this->load->model('reports_model');
                
                //Get invoice info from invoice table
                $invoices = $this->reports_model->pdf_report($from, $new_to_date);

        if (!$invoices) {
            echo 'No invoices in date period. Go back and try another date range';
        } else {
            $dir = getcwd() . '/pdf_report';
            if (is_dir($dir)) {
                $this->load->helper('file');
                delete_files($dir, true);
                rmdir($dir);
            }

            mkdir($dir, 0777);

            $this->load->model('invoice_model');
            //Get all invoice rows from attributes table
            foreach ($invoices as $invoice) {
                $invoice->rows = $this->invoice_model->get_invoice_rows($invoice->purchase_id);
                $invoice->images = $this->invoice_model->get_invoice_images($invoice->purchase_id);
                //$invoice->salesperson = $this->invoice_model->get_invoice_salesperson($invoice->purchase_id);
                $this->pdf->create_a_pdf($invoice);
            }

        // Add to Zip
            $this->load->library('zip');
            $this->zip->read_dir($dir, false);
            $this->zip->download('bulk_pdf_export.zip');
        }
    }
}
