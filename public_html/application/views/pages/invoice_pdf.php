<?php

// Include the main TCPDF library (search for installation path).
//require_once('../tcpdf_include.php');

// create new PDF document
$pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Cash 4 Cats');
$pdf->SetTitle('Cash 4 Cats Invoice');
$pdf->SetSubject('Invoice PDFs');
//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);

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
$pdf->AddPage();

// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

// Checking All Variables if they consist data
$current_url = explode('/', current_url());
$id_from_url = end($current_url);
$purchase_id = isset($invoice->purchase_id) && !empty($invoice->purchase_id) ? $invoice->purchase_id : $id_from_url;
$invoice_total = $invoice ? $invoice->Total : 0;
$invoice_first_name = $invoice ? $invoice->first_name : '';
$invoice_email = $invoice ? $invoice->email : '';
$invoice_phone = $invoice ? $invoice->phone : null;
$invoice_mobile = $invoice ? $invoice->mobile : null;
$invoice_date = $invoice ? $invoice->date : null;

// create some HTML content
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
    // $gst = round($invoice_total*0.1, 2);

ob_start(); //----------------------------------------------------------------
?>
 <h2 class="">Cash 4 Cats Pty Ltd.</h2> <small>PURCHASE ORDER</small> <br />
                            <address><abbr title="Salesperson">Salesperson:</abbr> <?php echo $invoice_first_name; ?><br><abbr title="Work email">E-mail:</abbr> <a href="mailto:<?php echo $invoice_email; ?>"><?php echo $invoice->email; ?></a><br><abbr title="Work Fax">Phone:</abbr> <?php echo $invoice_phone ?><br><abbr title="Work Fax">Mobile:</abbr> <?php echo $invoice_mobile; ?></address>              
      <section class="widget">
            <div class="body no-margin" style="margin-top: -50px">
                        <div class="invoice-number text-align-right" style="font-size: 12px;">Invoice #<?php echo $purchase_id; ?> <br />
                            <?php $phpdate = strtotime($invoice_date);
                            $phpdate = date('l d-m-Y H:i:s', $phpdate);
                            echo $phpdate; ?>
                        </div>
                <hr><h3 class="client-name">Purchased From: <?php echo $customer->business_name; ?></h3> 
                                <abbr title="Address">Address:</abbr> <?php echo $customer->address; ?> <br /><abbr title="Work email">E-mail:</abbr> <a href="mailto:<?php echo $customer->email; ?>"><?php echo $customer->email; ?></a><br /><abbr title="Work Phone">Phone:</abbr> <?php echo $customer->office_phone; ?></address><br /><br /><br />
                    <table class="">
                    <thead>
                    <tr style="border: 1px solid black">
                        <th style="height: 24px">Price per Unit</th>
                        <th style="height: 24px">Quantity</th>
                        <th style="height: 24px">Total</th>
                    </tr>
                    </thead>
                        <hr />
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
                    <tr style="height: 24px">
                        <td style="height: 24px"><?php echo $amount; ?></td>
                        <td><?php echo $quantity; ?></td>
                        <td><?php echo $amount*$quantity; ?></td>
                    </tr>
                    <?php endforeach; 
                    $invoice_final_subtotal = array_sum($invoiceSubtotal);
                    $final_gst = ($invoice_final_subtotal * .10);
                    ?>
                    </tbody>
                </table>
                <hr />
                <div class="row">
                    <table>
                    <tr><td style="width:150px"><strong>Total GST Inclusive:</strong></td><td style="width: 150px">$<?php echo $invoice_final_subtotal + $final_gst; ?></td></tr>
                    <tr><td style="width:150px"><strong>GST:</strong></td><td style="width: 150px">$<?php echo $final_gst; ?></td></tr>
                    </table>
                </div>
                
                <?php if ($images != false) : ?>
                    <div id="img_container" style="margin:20px;">
                    <h3>Purchase Images:</h3>
                    <?php foreach ($images as $image) : ?>
                        <div class="thumbnail col-sm-3">                            
                            <img src="<?php echo base_url() . 'inv_images/' . $purchase_id . '/' . $image->image; ?>">
                        </div>
                    <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>      


<?php //--------------------------------------------------------------------------------------------
$html = ob_get_clean();

$pdf->writeHTML($html, true, false, true, false, '');
// $pdf->Image('inv_images/' . $purchase_id . '/' . $image->image, '', '', 150, 100, '', '', 'T', false, 300, '', false, false, 1, false, false, false);

// reset pointer to the last page
$pdf->lastPage();

$file_name = $purchase_id;

//Close and output PDF document
$pdf->Output($file_name, 'I');

//============================================================+
// END OF FILE
//============================================================+
