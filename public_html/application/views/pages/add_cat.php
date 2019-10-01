<style type="text/css">
body {
	background-color: #000000;
}
	input{
		text-align: right;
	}
	tr{
		margin-bottom:20px;
	}
</style>

            <h2 class="page-title">Add New Cat<small></small></h2>

	<div class="row">
            <div class="col-md-12">
               <form class="form-horizontal form-label-left" method="post" action="<?php echo (site_url() . '/cats/save') ?>" enctype="multipart/form-data" data-parsley-validate="">
                <section class="widget">
                  <?php if ($this->session->flashdata('notice'))
						{
							echo('<span class="label label-important">' . $this->session->flashdata('notice'));
						} ?></span>
                    <header>
                        <h4><i class="fa fa-user"></i> Cat Image & Description <small></small></h4>
                        <div style="margin-top:20px;margin-bottom:30px"><img  style="width:100%" src=""/>
                        Cat Image: <input type="file" class="" name="mainImg" id="mainImg" /></div>
                        <h3 style="margin-bottom:15px">Name: <input type="text" name="cat_name" id="cat_name" value="" required></h3>
                        <h3 style="margin-bottom:15px">Sample #: <input type="text" name="cat_sample_no" id="cat_sample_no" value="" ></h3>
                        <h3 style="margin-bottom:15px">Override Price: $ <input type="text" name="cat_override" id="cat_override" value="" disabled></h3><small>Note: A value set for Override Price will override any other price even after all calculations!</small>
												<h3 style="margin-bottom:15px;margin-top:15px">Category: </h3>
													<select class="xs-pull-right select2 form-control input-lg" data-placeholder="Select Cat Brand" id="category_id" name="category_id" >
														<option value="34">Draft</option>
													</select>
												<fieldset>
                        <h4 style="margin-top:15px">Converter Description</h4>
                        <textarea id="desc" name="desc" style="width:100%;margin-top:20px; height:300px" required></textarea>
                        </fieldset>

                    <div class="specs">
                        <table>
						<tr><td colspan="2"><h4>Weight of Cat&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h4></td><td colspan="2"></td>
						<th><input type="text" name="weight_cat" class="form-control" id="weight_cat" value="" /></th></tr>
						<tr><td colspan="2"><h4>Weight of Ceramic</h4></td><td colspan="2"></td><th><input class="form-control" type="text" name="weight_ceramic" id="weight_ceramic" value=""   /></th></tr>
						<tr><td colspan="2"><h4>Weight of Casing</h4></td><td colspan="2"></td><th><input class="form-control" type="text" name="weight_casing" id="weight_casing"  disabled  value="" /></th></tr>

						<tr><td colspan="2"><h4>PT Content</h4></td><td colspan="2"></td><th><input class="form-control" type="text" name="pt_content" id="pt_content" value="0"  /></th></tr>
						<tr><td colspan="2"><h4>PD Content</h4></td><td colspan="2"></td><th><input class="form-control" type="text" name="pd_content" id="pd_content" value="0"  /></th></tr>
						<tr><td colspan="2"><h4>RH Content</h4></td><td colspan="2"></td><th><input class="form-control" type="text" name="rh_content" id="rh_content" value="0"  /></th></tr>

						<tr><td colspan="2"><h4>PT Kg</h4></td><td colspan="2"></td><th><input class="form-control" type="text" name="pt_kg" id="pt_kg" value="" disabled="" /></th></tr>
						<tr><td colspan="2"><h4>PD Kg</h4></td><td colspan="2"></td><th><input class="form-control" type="text" name="pd_kg" id="pd_kg" value="" disabled="" /></th></tr>
						<tr><td colspan="2"><h4>RH Kg</h4></td><td colspan="2"></td><th><input class="form-control" type="text" name="rh_kg" id="rh_kg" value="" disabled /></th></tr>

						
                        </table>
                    </div>
										<div class="form-actions">
                                <div class="row">
                                  <div class="col-sm-6 col-sm-offset-5">
                                        <button type="submit" class="btn btn-primary input-lg" >Save Cat</button>
                                        <!--<h4><strong>NOTE: You will need to recalculate prices on the calculator page after adding a cat to generate its price</strong></h4>-->
                                    </div>
                        </div>
                  </div>
                </section>

			</form>
            </div>
        </div>

        <script>
			var elem = document.querySelector('#isactive');
			var init = new Switchery(elem);
			$("#visit_frequency").val("<?php echo $customer->visit_frequency; ?>");
		</script>
       	</div>
</div>


    <!-- page specific scripts -->
        <!-- page libs -->
