<style type="text/css">
body {
	background-color: #000000;
}
</style>

        <h2 class="page-title">Calculator<small> <?php
						if ($this->session->flashdata('notice_update'))
						{
							echo('<span class="label label-important">' . $this->session->flashdata('notice_update'));
		} ?></span></small></h2>

        <div class="row">

         <div class="col-md-6">
                <section class="widget">
        <?php
						if ($this->session->flashdata('notice'))
						{
							echo('<span class="label label-important">' . $this->session->flashdata('notice'));
		} ?></span>
                    <header>
                        <h4>
                            <i class="fa fa-align-left"></i>
                            Currency Exchange Rate - USD to AUD
                        </h4>
                    </header>
                    <div class="body">
                        <form id="exchange-rate-form" class="form-horizontal" novalidate method="post" data-parsley-priority-enabled="false" data-parsley-excluded="" action="<?php echo site_url(); ?>/benchmarks/update_conversion_rate">
                            <fieldset>
                                <legend class="section">USD to AUD</legend>
                                <div class="form-group">
                                    <label for="exchange-rate" class="col-sm-4 control-label">Exchange Rate: </label><span class="required"></span>
                                    <div class="col-sm-7 input-group">
                                        <input type="text" id="exchange-rate" name="exchange-rate" class="form-control" placeholder="" data-parsley-trigger="change"  data-parsley-type="number" required="required" data-parsley-id="1" value="<?php echo $benchmarks->value_a ?>">
                                    </div>
                                </div>

                            </fieldset>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-sm-offset-4 col-sm-7">
                                        <div class="btn-toolbar">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </section>
            </div>


           <div class="col-md-6">
                <section class="widget">
                    <?php
						if ($this->session->flashdata('notice_market'))
						{
							echo('<span class="label label-important">' . $this->session->flashdata('notice_market'));
						} ?></span>
                    <header>
                        <h4>
                            <i class="fa fa-align-left"></i>
                            Current Market Values
                        </h4>
                    </header>
                    <div class="body">
                        <form id="metal-prices-form" class="form-horizontal" method="post" role="form" data-parsley-priority-enabled="false" action="<?php echo site_url(); ?>/benchmarks/update_market_values">
                            <fieldset>
                                <legend class="section">Metal Prices $US/KG</legend>
                                <div class="form-group">
                                    <label for="platinum" class="col-sm-4 control-label">Platinum: </label>
                                    <div class="col-sm-7">
                                       <div class="input-group">
                                            <span class="input-group-addon">$</span>
                                        <input type="text" id="platinum" name="platinum" class="form-control parsley-error" placeholder="" data-parsley-type="number" required="required" value="<?php echo $benchmarks->us_per_ounce_pt; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="palladium" class="col-sm-4 control-label">Palladium: </label>
                                    <div class="col-sm-7">
                                       <div class="input-group">
                                       <span class="input-group-addon">$</span>
                                        <input type="text" id="palladium" name="palladium" class="form-control parsley-error" placeholder="" data-parsley-type="number" required="required" value="<?php echo $benchmarks->us_per_ounce_pd; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="rhodium" class="col-sm-4 control-label">Rhodium: </label>
                                    <div class="col-sm-7">
                                       <div class="input-group">
                                       <span class="input-group-addon">$</span>
                                        <input type="text" id="rhodium" name="rhodium" class="form-control parsley-error" placeholder="" data-parsley-type="number" required="required" value="<?php echo $benchmarks->us_per_ounce_rh; ?>">
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-sm-offset-4 col-sm-7">
                                        <div class="btn-toolbar">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
            </div>


        </div> <!-- End Row -->

         <div class="row">

         <div class="col-md-12 omersBox">
                <section class="widget othervalues">
                    <?php
						if ($this->session->flashdata('notice_other'))
						{
							echo('<span class="label label-important">' . $this->session->flashdata('notice_other'));
						} ?></span>
                    <header onClick="expand(this)" class="hidden_row">
                        <h4>
                            <i class="fa fa-align-left"></i>
                            Other Values
                        </h4>
                        <div class="widget-controls" >
                            <a data-widgster="collapse" title="Collapse" href="#" style="display: inline;"><i class="glyphicon glyphicon-chevron-down"></i></a>
                            <a data-widgster="expand" title="Expand" href="#" style="display: none;"><i class="glyphicon glyphicon-chevron-up"></i></a>
                        </div>
                    </header>
                    <div class="body">

                    <form id="other-values-form" class="form-horizontal" method="post" role="form" data-parsley-priority-enabled="false" action="<?php echo site_url(); ?>/benchmarks/update_other_values">
                            <fieldset>
                                <legend class="section"></legend>
                                <div class="form-group">
                                    <label for="monolith_dry_weight" class="col-sm-4 control-label">Monolith Dry Weight: </label>
                                    <div class="col-sm-7">
                                       <div class="input-group">
                                        <input type="text" id="monolith_dry_weight" name="monolith_dry_weight" class="form-control parsley-error" placeholder="" data-parsley-type="number" required="required" value="<?php echo $benchmarks->monolith_dry_weight; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="metal_returned_palladium" class="col-sm-4 control-label">Metal Returned Pd: </label>
                                    <div class="col-sm-7">
                                       <div class="input-group">
                                        <input type="text" id="metal_returned_palladium" name="metal_returned_palladium" class="form-control parsley-error" placeholder="" data-parsley-type="number" required="required" value="<?php echo $benchmarks->metal_returned_pd; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="metal_returned_platinum" class="col-sm-4 control-label">Metal Returned Pt: </label>
                                    <div class="col-sm-7">
                                       <div class="input-group">
                                        <input type="text" id="metal_returned_platinum" name="metal_returned_platinum" class="form-control parsley-error" placeholder="" data-parsley-type="number" required="required" value="<?php echo $benchmarks->metal_returned_pt; ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="metal_returned_rhodium" class="col-sm-4 control-label">Metal Returned Rh: </label>
                                    <div class="col-sm-7">
                                       <div class="input-group">
                                        <input type="text" id="metal_returned_rhodium" name="metal_returned_rhodium" class="form-control parsley-error" placeholder="" data-parsley-type="number" required="required" value="<?php echo $benchmarks->metal_returned_rh; ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="process_charge" class="col-sm-4 control-label">Process Charges USD TC: </label>
                                    <div class="col-sm-7">
                                       <div class="input-group">
                                        <input type="text" id="process_charge" name="process_charge" class="form-control parsley-error" placeholder="" data-parsley-type="number" required="required" value="<?php echo $benchmarks->process_charges_us_tc; ?>">
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-sm-offset-4 col-sm-7">
                                        <div class="btn-toolbar">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

					</div>
			 </section>
       </div>
</div>

        <div class="row">

         <div class="col-md-12 omersBox">
                <section class="widget price_categories">
                    <?php
						if ($this->session->flashdata('notice_groupings'))
						{
							echo('<span class="label label-important">' . $this->session->flashdata('notice_groupings'));
						} ?></span>
                    <header onClick="expand(this)" class="hidden_row">
                        <h4>
                            <i class="fa fa-align-left"></i>
                            Price Groups
                        </h4>
                        <div class="widget-controls" >
                            <a data-widgster="collapse" title="Collapse" href="#" style="display: inline;"><i class="glyphicon glyphicon-chevron-down"></i></a>
                            <a data-widgster="expand" title="Expand" href="#" style="display: none;"><i class="glyphicon glyphicon-chevron-up"></i></a>
                        </div>
                    </header>
                    <div class="body">

                    <form id="price-categories-form" class="form-horizontal" method="post" role="form" data-parsley-priority-enabled="false" action="<?php echo site_url(); ?>/benchmarks/update_price_groupings">
                            <fieldset>
                                <legend class="section"></legend>
                                <?php $count = 1; ?>
                                <?php foreach ($pricing as $price) : ?>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label"><?php echo $count; ?>: </label>
                                    <div class="col-sm-7">
                                       <div class="input-group">
                                        <input type="text" id="g<?php echo $count  ?>" name="g<?php echo $count;  ?>" class="form-control parsley-error" placeholder="" data-parsley-type="number" required="required" value="<?php echo $price->upper_limit; ?>">
                                        </div>
                                    </div>
                                </div>
                                <?php $count++; endforeach; ?>
                            </fieldset>
                            <input type="hidden" id="count" name="count" value="<?php echo $count ?>" />
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-sm-offset-4 col-sm-7">
                                        <div class="btn-toolbar">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

					</div>
			 </section>
       </div>
</div>

<div class="row">

         <div class="col-md-12 omersBox">
                <section class="widget customer_categories">
                    <?php
						if ($this->session->flashdata('notice_discounts'))
						{
							echo('<span class="label label-important">' . $this->session->flashdata('notice_discounts'));
						} ?></span>
                    <header onClick="expand(this)" class="hidden_row">
                        <h4>
                            <i class="fa fa-align-left"></i>
                            Customer Price Groups
                        </h4>
                        <div class="widget-controls" >
                            <a data-widgster="collapse" title="Collapse" href="#" style="display: inline;"><i class="glyphicon glyphicon-chevron-down"></i></a>
                            <a data-widgster="expand" title="Expand" href="#" style="display: none;"><i class="glyphicon glyphicon-chevron-up"></i></a>
                        </div>
                    </header>
                    <div class="body">

                    <form id="customer-categories-form" class="form-horizontal" method="post" role="form" data-parsley-priority-enabled="false" action="<?php echo site_url(); ?>/benchmarks/update_discounts">
                            <fieldset>
                                <legend class="section"></legend>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Best Customers: </label>
                                    <div class="col-sm-7">
                                       <div class="input-group">
                                        <input type="text" id="bestCustomers" name="bestCustomers" class="form-control parsley-error" placeholder="" data-parsley-type="number" required="required" value="<?php echo $discounts->one; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Average Customers: </label>
                                    <div class="col-sm-7">
                                       <div class="input-group">
                                        <input type="text" id="avgCustomers" name="avgCustomers" class="form-control parsley-error" placeholder="" data-parsley-type="number" required="required" value="<?php echo $discounts->two; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Rare Customers: </label>
                                    <div class="col-sm-7">
                                       <div class="input-group">
                                        <input type="text" id="rareCustomers" name="rareCustomers" class="form-control parsley-error" placeholder="" data-parsley-type="number" required="required" value="<?php echo $discounts->three; ?>">
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-sm-offset-4 col-sm-7">
                                        <div class="btn-toolbar">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

					</div>
			 </section>
       </div>
</div>

<div class="row">

         <div class="col-md-12 omersBox">
                <section class="widget options">
                    <?php
						if ($this->session->flashdata('options'))
						{
							echo('<span class="label label-important">' . $this->session->flashdata('options'));
						} ?></span>
                    <header onClick="expand(this)" class="hidden_row">
                        <h4>
                            <i class="fa fa-align-left"></i>
	                          Other Options
                        </h4>
                        <div class="widget-controls" >
                            <a data-widgster="collapse" title="Collapse" href="#" style="display: inline;"><i class="glyphicon glyphicon-chevron-down"></i></a>
                            <a data-widgster="expand" title="Expand" href="#" style="display: none;"><i class="glyphicon glyphicon-chevron-up"></i></a>
                        </div>
                    </header>
                    <div class="body">

                    <form id="options-form" class="form-horizontal" method="post" role="form" data-parsley-priority-enabled="false" action="<?php echo site_url(); ?>/benchmarks/update_options">
                            <fieldset>
                                <legend class="section"></legend>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Superannuation(%): </label>
                                    <div class="col-sm-7">
                                       <div class="input-group">
                                        <input type="text" id="super" name="super" class="form-control parsley-error" placeholder="" data-parsley-type="number" required="required" value="<?php echo $options[0]['option-value'];  ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Income Tax(%): </label>
                                    <div class="col-sm-7">
                                       <div class="input-group">
                                        <input type="text" id="tax" name="tax" class="form-control parsley-error" placeholder="" data-parsley-type="number" required="required" value="<?php echo $options[1]['option-value'];  ?>">
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-sm-offset-4 col-sm-7">
                                        <div class="btn-toolbar">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </div>
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
   $('#exchange-rate-form').parsley();
   $('#metal-prices-form').parsley();
   $('#other-values-form').parsley();
   $(window).load(function() {$('.othervalues').widgster('collapse'); $('.price_categories').widgster('collapse');
							  $('.customer_categories').widgster('collapse');
								$('.options').widgster('collapse');
							 	$("#price-categories-form").parsley();
							  $("#customer-categories-form").parsley();
							 });
   function expand(row){
	   if ($(row).hasClass("hidden_row")){
		   $(row).parent().widgster('expand');
		   $(row).removeClass("hidden_row");
	   }
	   else{
		   $(row).parent().widgster('collapse');
		   $(row).addClass("hidden_row");
	   }
   }
</script>
    <!-- page specific scripts -->
        <!-- page libs -->
