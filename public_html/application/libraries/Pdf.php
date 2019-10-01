<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'tcpdf/tcpdf.php';

class Pdf extends TCPDF
{
	public $_fonts_list = array();
	protected $last_page_flag = false;
	function __construct($orientation='P', $unit='mm', $format='A4', $unicode=true, $encoding='UTF-8', $diskcache=false, $pdfa=false)
	{
		parent::__construct($orientation, $unit, $format, $unicode, $encoding, $diskcache, $pdfa);
		$lg = array();
		$lg['a_meta_charset'] = 'UTF-8';
		// set some language-dependent strings (optional)
		$this->setLanguageArray($lg);
		$this->_fonts_list = $this->fontlist;;
	}
	public function Close() {
		$this->last_page_flag = true;
		parent::Close();
	}
	public function Header() {
		$this->SetFont('helvetica', 'B', 20);
	}
	public function Footer() {
        // Position at 15 mm from bottom
		$this->SetY(-15);
        // Set font
		$this->SetFont('helvetica', 'I', 8);
        // Page number
	}
	public function get_fonts_list(){
		return $this->_fonts_list;
	}

	public function create_a_pdf($invoice){
		$pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Cash 4 Cats');
		$pdf->SetTitle('Cash 4 Cats Invoice');
		$pdf->SetSubject('Invoice PDFs');
		//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

		// set default header data
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

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
		$pdf->AddPage();

				// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
				// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

				// create some HTML content
			$final_result = array();
            foreach ($invoice->rows as $row){
                $price_to_add = $row->PRICE;
                
                if ($row->OVERRIDE_PRICE != 0.00){
                    $price_to_add = $row->OVERRIDE_PRICE;
                }
                
                for ($i = 0; $i < $row->QTY; $i++){
                    $final_result[] = $price_to_add;
                }
                
                
            }
            
            $final_result = array_count_values($final_result);
            $gst = round( ($invoice->Total/1.1)*0.1 , 2 );

	ob_start(); //---------------------------------------------------------------- 
	?>
	 <h2 class="">Cash 4 Cats Pty Ltd.</h2> <small>PURCHASE ORDER</small> <br />
                            <address><abbr title="Salesperson">Salesperson:</abbr> <?php echo $invoice->first_name; ?><br><abbr title="Work email">E-mail:</abbr> <a href="mailto:<?php echo $invoice->email; ?>"><?php echo $invoice->email; ?></a><br><abbr title="Work Fax">Phone:</abbr> <?php echo $invoice->phone ?><br><abbr title="Work Fax">Mobile:</abbr> <?php echo $invoice->mobile; ?></address>           
      <section class="widget">
            <div class="body no-margin" style="margin-top: -50px">
                        <div class="invoice-number text-align-right" style="font-size: 12px;">Invoice #<?php echo $invoice->purchase_id; ?> <br />
                            <?php $phpdate = strtotime( $invoice->date ); $phpdate = date( 'l d-m-Y H:i:s', $phpdate ); echo $phpdate; ?>
                        </div>
                <hr><h3 class="client-name">Purchased From: <?php echo $invoice->business_name; ?></h3> 
                                <abbr title="Address">Address:</abbr> <?php echo $invoice->address; ?> <br /><abbr title="Work email">E-mail:</abbr> <a href="mailto:<?php echo $invoice->email; ?>"><?php echo $invoice->email; ?></a><br /><abbr title="Work Phone">Phone:</abbr> <?php echo $invoice->office_phone; ?></address><br /><br /><br />
                                <hr />
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
                    <?php foreach ($final_result as $amount => $quantity) : ?>
                    <?php $amount = floatval($amount); $quantity = intval($quantity); ?>
                    <tr style="height: 24px">
                        <td style="height: 24px"><?php echo $amount; ?></td>
                        <td><?php echo $quantity; ?></td>
                        <td><?php echo $amount*$quantity; ?></td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <hr />
                <div class="row">
                    <table>
                    <tr><td style="width:150px"><strong>Total GST Inclusive:</strong></td><td style="width: 150px">$<?php echo $invoice->Total; ?></td></tr>
                    <tr><td style="width:150px"><strong>GST:</strong></td><td style="width: 150px">$<?php echo $gst; ?></td></tr>
                    </table>
                </div>
                
                <?php if ($invoice->images != false) : ?>
                                    <div id="img_container" style="margin:20px;">
                                    <h3>Purchase Images:</h3>
                                    <?php foreach ($invoice->images as $image) : ?>
                                        
                                            <div class="thumbnail col-sm-3">                            
                                                <img src="<?php echo base_url() . 'inv_images/' . $invoice->purchase_id . '/' . $image->image; ?>">
                                            </div>
                                        
                                    <?php endforeach; ?>
                                    </div>
                                    <?php endif; ?>
            </div>
        </section>      


		<?php //--------------------------------------------------------------------------------------------
		$html = ob_get_clean();

		$pdf->writeHTML($html, true, false, true, false, '');

		// reset pointer to the last page
		$pdf->lastPage();

		$file_name = $invoice->purchase_id;
		$dir = FCPATH . '/pdf_report/' . $file_name . '.pdf'; 
		//Close and output PDF document
		$pdf->Output($dir , 'F');
		return $dir;
		}

}

/* End of file Pdf.php */
/* Location: ./application/libraries/Pdf.php */
