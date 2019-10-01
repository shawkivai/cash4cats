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
?>


<style type="text/css">
	hr {border-top: 5px solid #eeeeee; color: black;}
	.inv-button { margin-bottom:5px; margin-right:5px; }
body {
	background-color: #000000;
}
	#datatable-table_filter{
    float: right;
    margin-top: -30px;
    margin-bottom: 15px;
	}
	.width-200{width:200px;}.dataTables_paginate{float:right;text-align:right;padding-top:0.25em}.dataTables_wrapper .dataTables_paginate .paginate_button{box-sizing:border-box;display:inline-block;min-width:1.5em;padding:0.5em 1em;margin-left:2px;text-align:center;text-decoration:none !important;cursor:pointer;*cursor:hand;color:#333 !important;border:1px solid transparent;border-radius:2px}.dataTables_wrapper .dataTables_paginate .paginate_button.current,.dataTables_wrapper .dataTables_paginate .paginate_button.current:hover{color:#333 !important;background-color:#eeeeee;.dataTables_wrapper .dataTables_paginate .paginate_button.disabled,.dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover,.dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active{cursor:default;color:#666 !important;border:1px solid transparent;background:transparent;box-shadow:none}.dataTables_wrapper .dataTables_paginate .paginate_button:hover{color:white !important;border:1px solid #111;background-color:#585858;background:-webkit-gradient(linear, left top, left bottom, color-stop(0%, #585858), color-stop(100%, #111));background:-webkit-linear-gradient(top, #585858 0%, #111 100%);background:-moz-linear-gradient(top, #585858 0%, #111 100%);background:-ms-linear-gradient(top, #585858 0%, #111 100%);background:-o-linear-gradient(top, #585858 0%, #111 100%);background:linear-gradient(to bottom, #585858 0%, #111 100%)}.dataTables_wrapper .dataTables_paginate .paginate_button:active{outline:none;background-color:#2b2b2b;background:-webkit-gradient(linear, left top, left bottom, color-stop(0%, #2b2b2b), color-stop(100%, #0c0c0c));background:-webkit-linear-gradient(top, #2b2b2b 0%, #0c0c0c 100%);background:-moz-linear-gradient(top, #2b2b2b 0%, #0c0c0c 100%);background:-ms-linear-gradient(top, #2b2b2b 0%, #0c0c0c 100%);background:-o-linear-gradient(top, #2b2b2b 0%, #0c0c0c 100%);background:linear-gradient(to bottom, #2b2b2b 0%, #0c0c0c 100%);box-shadow:inset 0 0 3px #111}.dataTables_wrapper .dataTables_paginate .ellipsis{padding:0 1em}.dataTables_wrapper .dataTables_processing{position:absolute;top:50%;left:50%;width:100%;height:40px;margin-left:-50%;margin-top:-25px;padding-top:20px;text-align:center;font-size:1.2em;background-color:white;background:-webkit-gradient(linear, left top, right top, color-stop(0%, rgba(255,255,255,0)), color-stop(25%, rgba(255,255,255,0.9)), color-stop(75%, rgba(255,255,255,0.9)), color-stop(100%, rgba(255,255,255,0)));background:-webkit-linear-gradient(left, rgba(255,255,255,0) 0%, rgba(255,255,255,0.9) 25%, rgba(255,255,255,0.9) 75%, rgba(255,255,255,0) 100%);background:-moz-linear-gradient(left, rgba(255,255,255,0) 0%, rgba(255,255,255,0.9) 25%, rgba(255,255,255,0.9) 75%, rgba(255,255,255,0) 100%);background:-ms-linear-gradient(left, rgba(255,255,255,0) 0%, rgba(255,255,255,0.9) 25%, rgba(255,255,255,0.9) 75%, rgba(255,255,255,0) 100%);background:-o-linear-gradient(left, rgba(255,255,255,0) 0%, rgba(255,255,255,0.9) 25%, rgba(255,255,255,0.9) 75%, rgba(255,255,255,0) 100%);background:linear-gradient(to right, rgba(255,255,255,0) 0%, rgba(255,255,255,0.9) 25%, rgba(255,255,255,0.9) 75%, rgba(255,255,255,0) 100%)}.dataTables_wrapper .dataTables_length,.dataTables_wrapper .dataTables_filter,.dataTables_wrapper .dataTables_info,.dataTables_wrapper .dataTables_processing,.dataTables_wrapper .dataTables_paginate{color:#333}.dataTables_wrapper .dataTables_scroll{clear:both}.dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody{*margin-top:-1px;-webkit-overflow-scrolling:touch}.dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody th,.dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody td{vertical-align:middle}.dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody th>div.dataTables_sizing,.dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody td>div.dataTables_sizing{height:0;overflow:hidden;margin:0 !important;padding:0 !important}.dataTables_wrapper.no-footer .dataTables_scrollBody{border-bottom:1px solid #111}.dataTables_wrapper.no-footer div.dataTables_scrollHead table,.dataTables_wrapper.no-footer div.dataTables_scrollBody table{border-bottom:none}.dataTables_wrapper:after{visibility:hidden;display:block;content:"";clear:both;height:0}@media screen and (max-width: 767px){.dataTables_wrapper .dataTables_info,.dataTables_wrapper .dataTables_paginate{float:none;text-align:center}.dataTables_wrapper .dataTables_paginate{margin-top:0.5em}}@media screen and (max-width: 640px){.dataTables_wrapper .dataTables_length,.dataTables_wrapper .dataTables_filter{float:none;text-align:center}.dataTables_wrapper .dataTables_filter{margin-top:0.5em}

</style>

            <h2 class="page-title">Shipment Summary Report <small></small></h2>

            <div class="row">
      <?php if (!isset($_GET['action']) ) : ?>
         <div class="col-md-12">
                <section class="widget">
        <?php
						if ($this->session->flashdata('notice'))
						{
							echo('<span class="label label-important">' . $this->session->flashdata('notice'));
		} ?></span>
                    <header>
                    </header>
                    <div class="body">
                            <fieldset>
                                <legend class="section">BENCHMARKS</legend>
                                <div class="form-group">
                                    <div class="col-sm-4 control-label"><h3>Exchange Rate:</h3></div>
                                    <div class="col-sm-7">
                                        <h3> <?php echo $benchmarks->value_a ?></h3>
                                    </div>
                                </div>

                            </fieldset>
                            <fieldset>
                                <div class="form-group">
									<div class="col-sm-4 control-label"><h3>Platinum: </h3></div>
                                    <div class="col-sm-7">
                                         <h3>$US <?php echo $benchmarks->us_per_ounce_pt; ?></h3>
                                    </div>
                                </div>
                                <div class="form-group">
                                   <div class="col-sm-4 control-label"><h3>Palladium: </h3></div>
                                    <div class="col-sm-7">
                                         <h3>$US <?php echo $benchmarks->us_per_ounce_pd; ?></h3>
                                    </div>
                                </div>
                                <div class="form-group">

                                   <div class="col-sm-4 control-label"><h3>Rhodium: </h3></div>
                                    <div class="col-sm-7">
                                         <h3>$US <?php echo $benchmarks->us_per_ounce_rh; ?></h3>
                                    </div>
                                </div>
                            </fieldset>
                    </div>

        </div> <!-- End Row -->


        <?php endif; ?>


            <div class="row">

            <div class="col-md-12">
                <section class="widget" style="">
                    <header>
                    </header>
                    <div class="body">
                       <?php
						if ($this->session->flashdata('notice'))
						{
							echo('<span class="label label-important">' . $this->session->flashdata('notice'));
						} ?></span>

                        <section class="widget">
            <header>
            </header>
            <div class="body">
                <?php //if (!isset($_GET['action']) ) : ?>
                <div class="mt">
                    <div id="datatable-table_wrapper" class="dataTables_wrapper form-inline no-footer">
                       <table id="datatable-table" class="table table-striped table-hover dataTable no-footer" role="grid" aria-describedby="datatable-table_info">
                        <thead>
                        <tr role="row">

                        <th class="sorting_desc" tabindex="0" aria-controls="datatable-table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Id: activate to sort column descending" style="width:9%">NAME</th>

                        <th class="hidden-xs sorting" tabindex="0" aria-controls="datatable-table" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width:8%">PT</th>

                        <th class="hidden-xs sorting" tabindex="0" aria-controls="datatable-table" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width:8%">PD</th>

                        <th class="no-sort hidden-xs sorting_disabled" rowspan="1" colspan="1" aria-label="Info" style="width:8%">RH</th>

                        <th class="hidden-xs sorting" tabindex="0" aria-controls="datatable-table" rowspan="1" colspan="1" aria-label="Description: activate to sort column ascending" style="width:5%;">Monolith D.W</th>
                        <th class="hidden-xs sorting" tabindex="0" aria-controls="datatable-table" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width:5%">QTY</th>
                         <th class="" tabindex="0" aria-controls="datatable-table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Id: activate to sort column descending" style="width:8%">BUY PRICE EA.</th>
                         <th class="no-sort hidden-xs sorting_disabled" rowspan="1" colspan="1" aria-label="Info" style="width:8%">TOTAL BUY</th>
                        <th class="no-sort hidden-xs sorting_disabled" rowspan="1" colspan="1" aria-label="Info" style="width:8%">SELL PRICE</th>
                        <th class="no-sort hidden-xs sorting_disabled" rowspan="1" colspan="1" aria-label="Info" style="width:8%">PROFIT/LOSS</th>

                        <th class="no-sort hidden-xs sorting_disabled" rowspan="1" colspan="1" aria-label="Info" style="width:8%">GST</th>

                        </tr>
                        </thead>
                        <tbody>

                        <?php if($report_items == false) : ?>
							<span class="label label-important">No invoices have been entered.</span><br /><br />

						<?php else : ?>
							<?php
								// For items that have the same ID and buy price, we need to merge them.
								foreach ($report_items as $item){
                                    // If first item, add straight on
									if ( empty($new_list) ){
                                        if ($item->OVERRIDE_PRICE != "0.00"){
                                            $item->PRICE = $item->OVERRIDE_PRICE;
                                        }
										$new_list[] = $item;
										//error_log(var_export($item));
									}
									else{
										// Array is not empty. Need to compare the id with each element in the array
										foreach ($new_list as $new){
											if ($new->id == $item->id) {
												// The ids are matching. Now compare the buy price for final verification
                                                // Check if there is an override price
                                                if ($item->OVERRIDE_PRICE != "0.00"){
                                                    $item->PRICE = $item->OVERRIDE_PRICE;
                                                }
												if ($new->PRICE == $item->PRICE){
													// The same cat already exists, so merge them
													$new->QTY += $item->QTY;
													continue(2);
												}
											}
										}
										$new_list[] = $item;
									}
								}
							?>

							<?php foreach ($new_list as $report_item) : ?>
								<tr role="row" class="odd">
									<td class=""><?php echo $report_item->name; ?></td>
									<td class=""><?php echo $report_item->metal_content_pt; ?></td>
									<td class=""><?php echo $report_item->metal_content_pd; ?></td>
									<td class=""><?php echo $report_item->metal_content_rh; ?></td>
									<td class=""><?php echo $report_item->monolight_dry_weight_net; ?></td>
									<td class=""><?php echo $report_item->QTY; ?></td>
									<td class=""><?php echo $report_item->PRICE; ?></td>

									<?php $total_buy = $report_item->QTY*$report_item->PRICE;
										$buy_sum += $total_buy;
									?>
									<td class=""><?php echo $total_buy; ?></td>

									<?php $total_sell = $report_item->value*$report_item->QTY;
											$sell_sum += $total_sell;
									?>
									<td class=""><?php echo $total_sell; ?></td>

									<?php $profit = $report_item->value - $report_item->PRICE;
										$profit = $profit*$report_item->QTY;
									    $profit_sum += $profit;
										$profit = round($profit,2);
									?>

									<td class=""><?php echo $profit;  ?></td>
									<?php $gst = ($report_item->PRICE / 1.1 )*0.1*$report_item->QTY;
										  $gst_sum += $gst;
										  $gst = round($gst,2);
									?>
									<td class=""><?php echo $gst; ?></td>
								</tr>
								<?php
									 $pt_sum += $report_item->metal_content_pt;
									 $pd_sum += $report_item->metal_content_pd;
									 $rh_sum += $report_item->metal_content_rh;
									 $qty_sum += $report_item->QTY;

								?>
							<?php endforeach; ?>
						<?php endif; ?>
									<?php
										$profit_sum = round($profit_sum, 2);
										$gst_sum = round($gst_sum, 2);
									?>
                       </tbody>

                    </table>
                    </div>
                </div>
            <?php //endif; ?>
            </div>
                   <div style="height:580px">
                    <?php //if (!isset($_GET['action']) ) : ?>
                   <h1>Forecast</h1>
                       <table id="datatable-table" class="table table-striped table-hover dataTable no-footer" role="grid" aria-describedby="datatable-table_info">
                        <thead>
                        <tr role="row">

                        <th class="" tabindex="0" aria-controls="datatable-table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Id: activate to sort column descending" style="width:9%"></th>

                        <th class="hidden-xs " tabindex="0" aria-controls="datatable-table" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width:8%">PT</th>

                        <th class="hidden-xs " tabindex="0" aria-controls="datatable-table" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width:8%">PD</th>

                        <th class="no-sort hidden-xs sorting_disabled" rowspan="1" colspan="1" aria-label="Info" style="width:8%">RH</th>

                        <th class="hidden-xs " tabindex="0" aria-controls="datatable-table" rowspan="1" colspan="1" aria-label="Description: activate to sort column ascending" style="width:5%;"></th>
                        <th class="hidden-xs " tabindex="0" aria-controls="datatable-table" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width:5%">QTY</th>
                         <th class="no-sort hidden-xs sorting_disabled" rowspan="1" colspan="1" aria-label="Info" style="width:8%">TOTAL BUY</th>
                         <th class="" tabindex="0" aria-controls="datatable-table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Id: activate to sort column descending" style="width:8%">GST<sub>BUY</sub></th>
                        <th class="no-sort hidden-xs sorting_disabled" rowspan="1" colspan="1" aria-label="Info" style="width:8%">SELL PRICE</th>
                         <th class="" tabindex="0" aria-controls="datatable-table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Id: activate to sort column descending" style="width:8%">GST<sub>SELL</sub></th>
                        <th class="no-sort hidden-xs sorting_disabled" rowspan="1" colspan="1" aria-label="Info" style="width:8%">PROFIT/LOSS</th>

                        <th class="no-sort hidden-xs sorting_disabled" rowspan="1" colspan="1" aria-label="Info" style="width:8%">GST<sub>SELL-BUY</sub></th>

                        </tr>
                        </thead>
                        <tbody>
                    	<tr role="row" class="odd">
									<td class=""></td>
									<td class=""><?php echo $pt_sum; ?></td>
									<td class=""><?php echo $pd_sum; ?></td>
									<td class=""><?php echo $rh_sum; ?></td>
									<td class=""><?php ?></td>
									<td class=""><?php echo $qty_sum; ?></td>
									<td class=""><?php echo $buy_sum; ?></td>
                                    <td class=""><?php echo $gst_sum; ?></td>
									<td class=""><?php echo $sell_sum; ?></td>
                                    <td class=""><?php $sell_gst_sum = round($sell_sum/11,2); echo $sell_gst_sum; ?></td>
									<td class=""><?php echo $profit_sum; ?></td>
									<td class=""><?php echo ($sell_gst_sum - $gst_sum); ?></td>
								</tr>
                   </tbody>

                    </table>
                <?php //endif; ?>
                  			<?php
					   			$form_action = site_url() . '/reports/';
					   			if (isset($_GET['action'])) {
									$form_action .= 'update_shipment';
                                    //$sell_gst_sum = 0;
								}
					   			else{
									$form_action .= 'save_shipment';
								}
					   		?>
                            <h1>Actual Totals</h1>
                   			<form method="post" action="<?php echo $form_action; ?>">
                    		<div style="margin-top:50px;padding-bottom: 250px">
                            <table class="table table-striped table-hover dataTable no-footer">
                                <thead>
                                    <tr><th></th><th>Revenue</th><th>Rollover</th><th>Total Sell</th><th>Expenses</th><th>Total Buy</th><th>P/L inc GST</th><th>P/L ex GST</th></tr></thead>
                                    
                                        <?php
                                    if (isset($_GET['action'])) {
                                        $profit_sum = $shipment->cat_sales;
                                    }
                                ?>


                                 <?php 
                                  $gst_income = round($profit_sum/11 ,2); 
                                  if (isset($_GET['action'])) {
                                    $roll_gst = $rollover_gst->gst;
                                  } 
                                  else{
                                    $roll_gst = 0; 
                                    } 
                                    $revenue_gst = $gst_income + $roll_gst; 
                                    $expense_gst = $expense_gst->gst; 
                                    $buy_gst = round($buy_sum/11,2); 
                                    $gst_final = $revenue_gst + $expense_gst - $buy_gst; ?>


                            <tr>
                                    <td><!-- Empty Cell --></td>
                                <td><!-- Revenue -->$
                                <?php if (isset($_GET['action'])) : ?>
                                    <?php echo ( $shipment->actual_profit != 0.00 ) ? $profit_sum = $shipment->actual_profit : $profit_sum; ?></td>
                                <?php else : ?>
                                    <?php echo $profit_sum = $sell_sum; ?>
                                <?php endif; ?>

                                <td><!-- Rollover -->
                                    $<?php echo (isset($_GET['action'])) ? $rollover = $rollovers->amount : $rollover = 0; ?>
                                </td>

                                <td><!-- Actual Sell Price -->
                                    $<?php echo ($revenue = $profit_sum + $rollover); ?>
                                </td>

                                <td><!-- Expenses -->
                                    $<?php echo ($actual_expense = $expense); ?>
                                </td>

                                <td><!-- Total Buy -->
                                    $<?php echo $buy_sum; ?>
                                </td>

                                <td><!-- P/L inc GST -->
                                    $<?php $pl_inc_gst = $revenue - ($expense + $buy_sum); echo $pl_inc_gst;  ?>
                                </td>

                                <td><!-- P/L ex GST -->
                                    <strong>$<?php echo $pl_inc_gst - $gst_final; ?></strong>
                                </td>
                            </tr>
                            <tr>
                                    <td>GST</td>
                                    <td>$ <?php echo $gst_income ; ?></td>
                                    <td>$ <?php echo $roll_gst; ?></td>
                                    <td>$ <?php echo $revenue_gst; ?></td>
                                    <td>$ <?php echo $expense_gst; ?></td>
                                    <td>$ <?php echo $buy_gst; ?></td>
                                    <td>TOTAL GST OWING = $<?php echo $gst_final; ?></td>
                            </tr>
                            </table>
                            <div style="height:100px"></div>
							<div class="col-sm-2">
								<h4 style="text-align:right;">From:</h4>
								<h4 style="text-align:right">To:</h4>
								<!--<h3 style="text-align:right">QTY:</h3>
								<h3 style="text-align:right">GST:</h3>-->

							</div>
							<div class="col-sm-2">

								<h4 style="text-align:left;border:none"><input type="text" id="from_date" name="from_date" value="<?php echo $this->input->get('from'); ?>" readonly /></h4>
								<h4 style="text-align:left;border:none"><input type="text" id="to_date" name="to_date" value="<?php echo $this->input->get('to'); ?>" readonly /></h4>
								<!--<h3 style="text-align:left"><?php echo $qty_sum; ?></h3>-->

							</div>

                  			<div class="col-sm-2">
								<h4 style="text-align:right">Actual Profit $</h4>

							</div>

                 			<div class="col-sm-2">
                          <?php if (isset($_GET['action']) ) : ?>
                  				<input type="hidden" id="income" name="income" value="<?php echo $shipment->cat_sales; ?>" />
                  				<input type="hidden" id="rollover" name="rollover" value="<?php echo $shipment->rollover; ?>" />
                  				<input type="hidden" id="gst_sales" name="gst_sales" value="<?php echo $shipment->gst_sales; ?>" />
                  				<input type="hidden" id="gst_rollover" name="gst_rollover" value="<?php echo $shipment->gst_rollover; ?>" />
                         <?php endif; ?>

                         <input type="hidden" id="income" name="income" value="<?php echo $profit_sum; ?>" />
                         <input type="hidden" id="rollover" name="rollover" value="<?php echo $rollover ?>" />
                         <input type="hidden" id="gst_sales" name="gst_sales" value="<?php echo $gst_final ?>" />
                         <input type="hidden" id="gst_rollover" name="gst_rollover" value="<?php echo $roll_gst ?>" />

                  				<input type="hidden" id="gst_sum" name="gst_sum" value="<?php echo ($gst); ?>" />
                  				<input type="hidden" id="quantity_sum" name="quantity_sum" value="<?php echo $qty_sum; ?>" />
                  				<input type="hidden" id="calc_profit" name="calc_profit" value="<?php echo 0; ?>" />
                  				<input type="hidden" id="expense" name="expense" value="<?php echo $buy_sum; ?>" />
                  				<input type="text" name="actual_profit" id="actual_profit" value="<?php if ( isset($_GET['profit']) )  echo $_GET['profit']; ?>" class="form-control input-lg" style="" />
                  				<?php if ( isset ($_GET['action'] )) : ?>
                  				<input type="hidden" id="shipment_id" name="shipment_id" value="<?php echo $_GET['shipment_id']; ?>" />
                  				<input type="submit" class="form-control input-lg" value="Update Shipment" style="margin-top:50px"/>

                  				<?php else : ?>
								<input type="submit" class="form-control input-lg" value="Close Shipment" style="margin-top:50px"/>

                  				<?php endif; ?>
							</div>

                   			</div>
                   			</form>
                    </div>
                </section>
            </div>
        </div>

       	</div>
</div>

<script type="text/javascript">
	$(window).load(function(){
		$('#datatable-table').DataTable({
        "order": [[ 0, "asc" ]],
		"pageLength": -1
    });
	$('input[type=search]').addClass("form-control ml-sm");
	$('select').addClass("btn dropdown-toggle btn-default");
    $('#from_date').datetimepicker({format: 'YYYY-MM-DD HH:mm'});
    $('#to_date').datetimepicker({format: 'YYYY-MM-DD HH:mm'});

	});

</script>
