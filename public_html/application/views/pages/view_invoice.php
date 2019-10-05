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
                            Invoice #<?php echo $invoice->purchase_id; ?> <br />
                            <?php $phpdate = strtotime($invoice->date);
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
                                <?php echo $customer->business_name; ?>
                            </h3> 
                                <abbr title="Address">address:</abbr> <?php echo $customer->address; ?> <br />                         
                                <abbr title="Work email">e-mail:</abbr> <a href="mailto:<?php echo $customer->email; ?>"><?php echo $customer->email; ?></a><br>
                                <abbr title="Work Phone">phone:</abbr> <?php echo $customer->office_phone; ?><br>
                                <div class="separator line"></div>
                                <!-- <p class="margin-none"><strong>Note:</strong><br>Some nights I stay up cashing in my bad luck.
                                    Some nights I call it a draw</p> -->
                            </address><br />
                            <address>
                                <strong>Contact Person: </strong> 
                                <strong><a href="#"><?php echo $customer->rep_firstname . ' ' . $customer->rep_lastname; ?></a></strong><br>
                                <abbr title="Customer email">e-mail:</abbr> <a href="mailto:<?php echo $customer->rep_email ?>"><?php echo $customer->rep_email ?></a><br>
                                <abbr title="Work Phone">phone:</abbr> <?php echo $customer->rep_contact; ?><br>
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
                    <?php foreach ($final_result as $amount => $quantity) : ?>
                        <?php $amount = floatval($amount);
                        $quantity = intval($quantity); ?>
                    <tr>
                        <td><?php echo $amount; ?></td>
                        <td><?php echo $quantity; ?></td>
                        <td><?php echo $amount*$quantity; ?></td>
                    </tr>
                    <?php endforeach; ?>
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
                                <p><?php echo $subtotal = $invoice->Total/1.1; ?></p>
                                <p><?php echo $invoice->Total - $subtotal; ?></p>
                                <p class="no-margin"><strong>$<?php echo $invoice->Total; ?></strong></p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <?php if ($images != false) : ?>
                                    <div id="img_container" style="margin:20px;">
                                    <h3>Purchase Images:</h3>
                                    <?php foreach ($images as $image) : ?>
                                            <div class="thumbnail col-sm-3">                            
                                                <img src="<?php echo base_url() . 'inv_images/' . $invoice->purchase_id . '/' . $image->image; ?>">
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
                    <a href="<?php echo site_url() .'/pdf_contr/generate_pdf_report/' . $invoice->purchase_id ?>"><button id="print" class="btn btn-default">
                        <i class="fa fa-print"></i>
                        &nbsp;&nbsp;
                        Print
                    </button></a>
                    <a href="<?php echo site_url() .'/pages/view/email_invoice/' . $invoice->purchase_id . '/' . $customer->id; ?>"><button  style="margin-left:6px" class="btn btn-danger">
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
       

    
