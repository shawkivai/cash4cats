<?php


 $pt_sum = 0;
 $pd_sum = 0;
 $rh_sum = 0;
 $qty_sum = 0;
 $buy_sum = 0;
 $sell_sum = 0;
 $profit_sum = 0;
 $gst_sum = 0;
 $new_list = array();


//============================================================+
// File name   : invoice_pdf
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * 
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: WriteHTML and RTL support
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
//require_once('../tcpdf_include.php');

// create new PDF document
$pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Cash 4 Cats');
$pdf->SetTitle('Cash 4 Cats Profit&Loss');
$pdf->SetSubject('Profit&Loss');
//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('dejavusans', '', 10);

// add a page
$pdf->AddPage('L', 'A3');

// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

// create some HTML content


ob_start(); //---------------------------------------------------------------- 
?>
  <h2 class="page-title">Profit & Loss Query - <?php echo $dates[0]; ?> to <?php echo $dates[1]; ?><small></small></h2>


      <div class="row">

            <div class="col-md-12">
                <section class="widget" style="">
                   
            <div class="body">
              <h2>Expenses</h2>
                <div id="datatable-table_wrapper1" class="dataTables_wrapper form-inline no-footer">
                       <table id="datatable-table1" class="table table-striped table-hover dataTable no-footer" role="grid" aria-describedby="datatable-table_info">
                        <thead>
                          <tr>
                            <th>Date</th>
                            <th>Paid to:</th>
                            <th>Amount</th>
                            <th>GST</th>
                            <th>Super</th>
                            <th>Total</th>
                          </tr>
                        </thead>
                      <tbody>
                        <?php $gst_exp_total = 0.00; $super_exp_total = 0.00; $tax_exp_total = 0.00; $total_exp_amount = 0.00; ?>
                        <?php if (isset($expenses)) : ?>
                          <?php foreach ($expenses as $exp) : ?>
                            <tr>
                              <th><?php echo substr($exp->date, 0, 10); ?></th>
                              <th><?php echo $exp->name; ?></th>
                              <th><?php $this_exp = ($exp->amount_ini == 0) ? $exp->amount : $exp->amount_ini; echo $this_exp; ?></th>
                              <th><?php echo $exp->gst; ?></th>
                              <th><?php echo $exp->super; ?></th>
                              <th><?php echo $exp->amount; ?></th>
                            </tr>
                            <?php $gst_exp_total += $exp->gst; $super_exp_total += $exp->super; $total_exp_amount += $exp->amount; ?>
                          <?php endforeach; ?>
                        <?php endif; ?>
                      </tbody>
                      <tr>
                          <th><strong>TOTALS:</strong></th>
                          <th></th>
                          <th><strong>$<?php echo $gst_exp_total; ?></strong></th>
                          <th><strong>$<?php echo $super_exp_total; ?></strong></th>
                          <th><strong>$<?php echo $total_exp_amount; ?></strong></th>
                        </tr>
                    </table>
                  </div>
            </div>
          </section>
        </div>
      </div>

            <div class="row">

            <div class="col-md-12">
                <section class="widget hide_start" style="">
                    
            <div class="body">
              <h2>Shipments</h2>
                <div class="mt">
                    <div id="datatable-table_wrapper" class="dataTables_wrapper form-inline no-footer">
                       <table id="datatable-table" class="table table-striped table-hover dataTable no-footer" role="grid" aria-describedby="datatable-table_info">
                        <thead>
                        <tr role="row">

                        <th class="sorting_desc" tabindex="0" aria-controls="datatable-table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Id: activate to sort column descending" style="width:8%">SHIPMENT ID</th>

                        <th class="hidden-xs sorting" tabindex="0" aria-controls="datatable-table" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="float:right;margin-left:30px;position:relative;display:block;left:50px">FROM</th>

                        <th class="hidden-xs sorting" tabindex="0" aria-controls="datatable-table" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="">TO</th>

                        <th class="no-sort hidden-xs sorting_disabled" rowspan="1" colspan="1" aria-label="Info" style="">CAT. QTY</th>

                        <th class="hidden-xs sorting" tabindex="0" aria-controls="datatable-table" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="">REVENUE</th>
                         <th class="" tabindex="0" aria-controls="datatable-table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Id: activate to sort column descending" style="">ROLLOVER AMOUNT</th>
                         <th class="no-sort hidden-xs sorting_disabled" rowspan="1" colspan="1" aria-label="Info" style="">TOTAL REVENUE</th>
                         <th class="no-sort hidden-xs sorting_disabled" rowspan="1" colspan="1" aria-label="Info" style="">BUY COST</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php if(!$shipments) : ?>
              <span class="label label-important">No shipments have been entered.</span><br /><br />

                        <?php else : ?>
                    
             <?php $total_revenue = 0.00; $total_gst = 0.00; $total_rollover = 0.00; $total_rollover_gst = 0.00; $total_buy = 0.00; ?>
              <?php foreach ($shipments as $shipment) : ?>
                <tr role="row" class="odd">
                  <td class=""><?php echo $shipment->id; ?></td>
                  <td class=""><?php $new_from = new DateTime($shipment->from_date); $new_from->modify('+1 day'); $new_from = $new_from->format('Y-m-d H:i:s'); echo $new_from; ?></td>
                  <td class=""><?php echo $shipment->to_date; ?></td>
                  <td class=""><?php echo $shipment->qty; ?></td>
                  <td class=""><?php $total_revenue += ($shipment->actual_profit != 0.00 ) ? $revenue = $shipment->actual_profit : $revenue = $shipment->cat_sales; echo $revenue; ?></td>
                  <td class=""><?php $total_rollover += $shipment->rollover; echo $shipment->rollover;  ?></td>
                  <td class=""><?php echo ($revenue + $shipment->rollover);  ?></td>
                  <td class=""><?php $total_buy += $shipment->expenses; echo $shipment->expenses; ?></td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
                       </tbody>

                    </table>
                    </div>
                </div>
                   <div style="">
                   <h1>Totals</h1>
                       <table class="table table-striped table-hover dataTable no-footer">
                                <thead>
                                    <tr><th></th><th>Revenue</th><th>Rollover</th><th>Total Sell</th><th>Expenses</th><th>Total Buy</th><th>P/L inc GST</th><th>P/L ex GST</th></tr>
                                </thead>
                                   <?php 

                                    $gst_income = round($total_revenue/11 ,2);
                                    $revenue_gst = $gst_income + $total_rollover_gst; 
                                    $buy_gst = round($total_buy/11,2); 
                                    $gst_final = $revenue_gst + $gst_exp_total - $buy_gst; ?>
                                                                    


                            <tr>
                                    <td><!-- Empty Cell --></td>
                                <td><!-- Revenue -->
                                $ <?php echo $total_revenue; ?>
                                  
                                </td>

                                <td><!-- Rollover -->
                                    $<?php echo $total_rollover; ?>
                                </td>

                                <td><!-- Actual Sell Price -->
                                    $<?php  echo ($revenue = $total_revenue + $total_rollover); ?>
                                </td>

                                <td><!-- Expenses -->
                                    $<?php  echo $total_exp_amount; ?>
                                </td>

                                <td><!-- Total Buy -->
                                    $<?php echo $total_buy; ?>
                                </td>

                                <td><!-- P/L inc GST -->
                                    $<?php $pl_inc_gst = $revenue - ($total_exp_amount + $total_buy); echo $pl_inc_gst;  ?>
                                </td>

                                <td><!-- P/L ex GST -->
                                    <strong>$<?php echo $pl_inc_gst - $gst_final; ?></strong>
                                </td>
                            </tr>
                            <tr>
                                    <td>GST</td>
                                    <td>$ <?php echo $gst_income ; ?></td>
                                    <td>$ <?php echo $total_rollover_gst; ?></td>
                                    <td>$ <?php echo $revenue_gst; ?></td>
                                    <td>$ <?php echo $gst_exp_total; ?></td>
                                    <td>$ <?php echo $buy_gst; ?></td>
                                    <td>TOTAL GST OWING = $<?php  echo $gst_final; ?></td>
                            </tr>
                    </table>
                </div>
                  </div>
                  </section>
              </div>
          </div>
    </div>

<?php //--------------------------------------------------------------------------------------------
$html = ob_get_clean();

$pdf->writeHTML($html, true, false, true, false, '');

// reset pointer to the last page
$pdf->lastPage();

$file_name = 'Profit & Loss.pdf';

//Close and output PDF document
$pdf->Output($file_name , 'I');

//============================================================+
// END OF FILE
//============================================================+