<style type="text/css">
body {
	background-color: #000000;
}
</style>

            <h2 class="page-title">Customer<small></small></h2>

	<div class="row">
            <div class="col-md-7">
                <section class="widget">
                    <header>
                        <h4><i class="fa fa-user"></i> Account Profile <small></small></h4>
                    </header>
                    <div class="body">
                        <form id="user-form" action="<?php echo site_url(); ?>/customers/add_customer" class="form-horizontal form-label-left" novalidate method="post" data-parsley-priority-enabled="false" data-parsley-excluded="input[name=gender]">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="text-align-center">
                                        <img class="img-circle" src="<?php echo base_url(); ?>customer_images/customer.png" alt="Customer Image" style="height: 112px;">
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <h3 class="mt-sm mb-xs"></h3>
                                    <address>
                                    </address>
                                </div>
                            </div>
                            <fieldset class="mt-sm">
                                <legend>Edit Customer <small></small></legend>
                            </fieldset>
							 <fieldset>
                                <legend class="section">Company Info</legend>
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="company-name">Company Name<span class="required">*</span></label>
                                    <div class="col-sm-8"><input type="text" id="company-name" name="company-name" class="form-control" required="required" data-parsley-maxlength="70" data-parsley-id="40"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="company-address">Company Address<span class="required">*</span></label>
                                    <div class="col-sm-8"><input type="text" id="company-address" name="company-address" required="required" data-parsley-maxlength="100" class="form-control" data-parsley-id="41"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="company-abn">Company ABN</label>
                                    <div class="col-sm-8"><input type="text" id="company-abn" name="company-abn" class="form-control" data-parsley-maxlength="20" data-parsley-id="42"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="office-phone">Office Phone</label>
                                    <div class="col-sm-8"><input type="text" id="office-phone" name="office-phone" class="form-control" data-parsley-maxlength="15" data-parsley-id="43"></div>
                                </div>
                                <div class="form-group">
                                    <label for="mobile-phone" class="control-label col-sm-4">Mobile Phone</label>
                                    <div class="col-sm-8"><input id="mobile-phone" class="form-control" type="text" name="mobile-phone" value="" data-parsley-maxlength="15" data-parsley-id="44"></div>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="control-label col-sm-4">Email</label>
                                    <div class="col-sm-8"><input id="email" class="form-control" type="email" name="email" value="" data-parsley-maxlength="45" data-parsley-id="45"></div>
                                </div>
                            </fieldset>
							<fieldset>								
                                <div class="form-group">
                                    <label for="checkbox-isactive" class="control-label col-sm-4">Active
                                            </label>
                                    <div class="checkbox-inline checkbox-ios">
                                                <input type="checkbox" name="isactive" id="isactive" checked="" data-switchery="true" style="display: none;" value="1">
                                        </div>
                                </div>
							</fieldset>
                            <fieldset>
                                <legend class="section">Company Representative</legend>
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="position">Position</label>
                                    <div class="col-sm-4"><input type="text" id="position" name="position" class="form-control" data-parsley-maxlength="15" data-parsley-id="50"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="rep-first-name">Rep First Name</label>
                                    <div class="col-sm-8"><input type="text" id="rep-first-name" name="rep-first-name" class="form-control" data-parsley-maxlength="25" data-parsley-id="51"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="rep-last-name">Rep Last Name</label>
                                    <div class="col-sm-8"><input type="text" id="rep-last-name" name="rep-last-name" class="form-control" data-parsley-maxlength="25" data-parsley-id="52"></div>
                                </div>
                                <div class="form-group">
                                    <label for="rep-phone" class="control-label col-sm-4">Rep Contact #</label>
                                    <div class="col-sm-8"><input id="rep-phone" class="form-control" type="text" name="rep-phone" value="" data-parsley-maxlength="15" data-parsley-id="53"></div>
                                </div>
                                <div class="form-group">
                                    <label for="rep-email" class="control-label col-sm-4">Rep Email</label>
                                    <div class="col-sm-8"><input id="rep-email" class="form-control" type="email" name="rep-email" value="" data-parsley-maxlength="45" data-parsley-id="54"></div>
                                </div>
                            </fieldset>
							
							
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-sm-8 col-sm-offset-4">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
            
        </div>

        <script>
			var elem = document.querySelector('#isactive');
			var init = new Switchery(elem);
		</script>
       	</div> 
</div> 
    

    <!-- page specific scripts -->
        <!-- page libs -->
       

	