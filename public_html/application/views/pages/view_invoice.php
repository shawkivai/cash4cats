<?php 
// invoice parameters
$current_url = explode('/', current_url());
$id_from_url = end($current_url);
$purchase_id = isset($invoice->purchase_id) && !empty($invoice->purchase_id) ? $invoice->purchase_id : $id_from_url;
$date = isset($invoice->date) && !empty($invoice->date) ? $invoice->date : '';
$invoiceTotal = isset($invoice->Total) && !empty($invoice->Total) ? $invoice->Total : 0;

// Customers parameters
$business_name = isset($customer->business_name) && !empty($customer->business_name) ? $customer->business_name: '';
$address = isset($customer->address) && !empty($customer->address) ? $customer->address: '';
$email = isset($customer->email) && !empty($customer->email) ? $customer->email: '';
$office_phone = isset($customer->office_phone) && !empty($customer->office_phone) ? $customer->office_phone: '';
$rep_firstname = isset($customer->rep_firstname) && !empty($customer->rep_firstname) ? $customer->rep_firstname: '';
$rep_lastname = isset($customer->rep_lastname) && !empty($customer->rep_lastname) ? $customer->rep_lastname: '';
$rep_email = isset($customer->rep_email) && !empty($customer->rep_email) ? $customer->rep_email: '';
$rep_contact = isset($customer->rep_contact) && !empty($customer->rep_contact) ? $customer->rep_contact: '';
$image = isset($images->image) && !empty($images->image) ? $images->image : '';
$img_link = $purchase_id && $image ? base_url() . 'inv_images/' . $purchase_id . '/' . $image : ''; 
$print = $purchase_id ? site_url() .'/pdf_contr/generate_pdf_report/' . $purchase_id : '';
$customer_id = isset($customer->id) && !empty($customer->id) ? $customer->id : null;
$email_url = $purchase_id && $customer_id ? site_url() .'/pages/view/email_invoice/' . $purchase_id . '/' . $customer->id : '';

?>

<style type="text/css">
    
body {
    background-color: #000000;
}
.omersBorder{
    border: 1px solid #1e556c;
    border-radius: 3px;
    padding: 2%;
    -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    -webkit-transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
    -o-transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
    transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
}

    #show_searched_cats {
        display: none;
        overflow: scroll;
        height: 450px !important;
    }
</style>         
        <h2 class="page-title">View Invoice<small> <?php
        if ($this->session->flashdata('notice')) {
            echo('<span class="label label-important">' . $this->session->flashdata('notice'));
        } ?></span></small></h2>
        <?php
            $final_result = array();
        foreach ($rows as $row) {
            $price_to_add = $row->PRICE;
            if ($row->OVERRIDE_PRICE != 0.00) {
                $price_to_add = $row->OVERRIDE_PRICE;
                
            }
                
            for ($i = 0; $i < $row->QTY; $i++) {
                $final_result[] = $price_to_add;
            }
        }
            
            $final_result = array_count_values($final_result);
            
        ?>
            
      <section class="widget">
            <div class="body no-margin">
                <div class="row">
                    <div class="col-sm-6 col-print-6">
                        <h2>Cash 4 Cats Pty Ltd.</h2>
                        <h5>PURCHASE ORDER</h5>
                    </div>
                    <div class="col-sm-6 col-print-6">
                        <div class="invoice-number text-align-right">
                            Invoice #<?php echo $purchase_id; ?> <br />
                            <?php $phpdate = strtotime($date);
                            $phpdate = date('l d-m-Y H:i:s', $phpdate);
                            echo $phpdate; ?>
                        </div>
                        <div class="invoice-number-info text-align-right">
                        </div>
                    </div>
                </div>
                <hr>
                <section class="invoice-info well">
                    <div class="row">
                        <div class="col-sm-6 col-print-6">
                            <h4 class="details-title">Company Information</h4>
                            <h3 class="company-name">
                                Cash 4 Cats Pty Ltd.
                            </h3>
                            <address>
                                <strong>Chipping Norton</strong><br>
                                <abbr title="Work email">e-mail:</abbr> <a href="mailto:#">info@cash4cats.com.au</a><br>
                                <abbr title="Work Fax">mobile:</abbr> 0412 345 678
                            </address>
                        </div>
                        <div class="col-sm-6 col-print-6 client-details">
                            <h4 class="details-title">Client Information</h4>
                            <h3 class="client-name">
                                <?php echo $business_name; ?>
                            </h3> 
                                <abbr title="Address">address:</abbr> <?php echo $address; ?> <br />                         
                                <abbr title="Work email">e-mail:</abbr> <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a><br>
                                <abbr title="Work Phone">phone:</abbr> <?php echo $office_phone; ?><br>
                                <div class="separator line"></div>
                                <!-- <p class="margin-none"><strong>Note:</strong><br>Some nights I stay up cashing in my bad luck.
                                    Some nights I call it a draw</p> -->
                            </address><br />
                            <address>
                                <strong>Contact Person: </strong> 
                                <strong><a href="#"><?php echo $rep_firstname . ' ' . $rep_lastname; ?></a></strong><br>
                                <abbr title="Customer email">e-mail:</abbr> <a href="mailto:<?php echo $rep_email ?>"><?php echo $rep_email ?></a><br>
                                <abbr title="Work Phone">phone:</abbr> <?php echo $rep_contact; ?><br>
                                <div class="separator line"></div>
                            </address>
                        </div>
                    </div>
                </section>
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th class="hidden-xs">Price per Unit</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $invoiceSubtotal = array();
                    $count = 0;
                    foreach ($final_result as $amount => $quantity) : 
                        $count++;
                        $amount = floatval($amount);
                        $quantity = intval($quantity);
                        $invoiceSubtotal[$count] = $amount*$quantity;
                        ?>
                    <tr>
                        <td><?php echo $amount; ?></td>
                        <td><?php echo $quantity; ?></td>
                        <td><?php echo $amount*$quantity; ?></td>
                    </tr>
                    <?php endforeach; 
                    $invoice_subtotal = array_sum($invoiceSubtotal);
                    ?>

                    </tbody>
                </table>
                <div class="row">
                    <div class="col-sm-6 col-print-6">
                        <!--<blockquote class="blockquote-sm">
                            <strong>Note:</strong> Keep in mind, sometimes bad things happen. But it's just sometimes.
                        </blockquote>-->
                    </div>
                    <div class="col-sm-6 col-print-6">
                        <div class="row text-align-right">
                            <div class="col-xs-6"></div> <!-- instead of offset -->
                            <div class="col-xs-3">
                                <p>Subtotal</p>
                                <p>GST</p>
                                <p class="no-margin"><strong>Total</strong></p>
                            </div>
                            <div class="col-xs-3">
                                <!-- FIxed GST Issue -->
                                <p><?php echo round($invoice_subtotal, 2); ?></p>
                                <p><?php $gst = $invoice_subtotal * .10;
                                        echo round($gst, 2);
                                ?>
                                
                                </p>
                                <p class="no-margin"><strong>$<?php echo round($invoice_subtotal + $gst, 2); ?></strong></p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <?php if ($images) :?>

                    <div id="img_container" style="margin:20px;">
                    <h3>Purchase Images:</h3>
                    <?php foreach ($images as $image) : ?>
                            <div class="thumbnail col-sm-3">                            
                                <img src="<?php echo base_url() . 'inv_images/' . $purchase_id . '/' . $image->image;?>">
                            </div>
                        
                    <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                                    
                                    
                <!--<p class="text-align-right mt-lg mb-xs">
                    Marketing Consultant
                </p>
                <p class="text-align-right">
                    <span class="fw-semi-bold">Bob Smith</span>
                </p> -->
                <div class="btn-toolbar mt-lg text-align-right hidden-print" style="clear:left">
                    <a href="<?php echo $print ?>"><button id="print" class="btn btn-default">
                        <i class="fa fa-print"></i>
                        &nbsp;&nbsp;
                        Print
                    </button></a>
                    <a href="<?php echo $email_url; ?>"><button  style="margin-left:6px" class="btn btn-danger">
                        Email
                        &nbsp;
                        <i class="fa fa-arrow-right"></i>
                    </button></a>
                </div>
            </div>
        </section>      
            

<!-- close divs opened in header -->
        </div> 
   </div> 


    <!-- page specific scripts -->
        <!-- page libs -->
       

    
