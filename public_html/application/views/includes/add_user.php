<style type="text/css">
body {
	background-color: #000000;
}
</style>

            <h2 class="page-title">Add a New User <small></small></h2><div class="row">
            <div class="col-md-12">
                <section class="widget">
                    <header>
                    </header>
                    <div class="body">
                       <?php echo validation_errors('<span class="label label-important">'); ?></span>
                       <?php 
						if ($this->session->flashdata('notice') && validation_errors() == '') 
						{
							echo('<span class="label label-important">' . $this->session->flashdata('notice'));
						} ?></span>
                       	
                        <form id="user-form" class="form-horizontal form-label-left" novalidate method="post" data-parsley-priority-enabled="false" data-parsley-excluded="" action="<?php echo site_url(); ?>/users/add_user">
                            <fieldset>
                               <legend class="section">Username & Password</legend>
                                <div class="form-group">
                                    <label class="control-label col-sm-4 input-lg" for="user-name">User Name <span class="required">*</span></label>
                                  <div class="col-sm-6 input-group"><span class="input-group-addon"><i class="fa fa-user"></i></span>
                                  <input type="text" id="user-name" name="user-name" class="form-control input-lg" data-parsley-trigger="change" required="required" data-parsley-maxlength="15" data-parsley-id="1"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4 input-lg" for="password">Password <span class="required">*</span></label>
                                  <div class="col-sm-6 input-group"><span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                  <input type="password" id="password" name="password" required="required" class="form-control input-lg" data-parsley-trigger="change" data-parsley-maxlength="32" data-parsley-id="2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4 input-lg" for="c-password">Confirm Password <span class="required">*</span></label>
                                  <div class="col-sm-6 input-group"><span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                  <input type="password" id="c-password" name="c-password" required="required" class="form-control input-lg" data-parsley-trigger="change" data-parsley-maxlength="32" data-parsley-equalto="#password" data-parsley-id="3"></div>
                                </div>
                         		 <div class="form-group">
                                    <label class="control-label col-sm-4 input-lg" for="user-type">User Type <span class="required">*</span></label>
                                  <div class="col-sm-6 input-group"><span class="input-group-addon"><i class="fa fa-user"></i></span>
                                  <select class="select2 form-control input-lg" data-placeholder="Select User Type" tabindex="-1" id="user-type" name="user-type" required data-parsley-trigger="change" data-parsley-id="15"> 
									<option value></option> 
									<option value="staff">Staff</option>
									<option value="admin">Admin</option>		  
                               </select></div>
                                </div>
                            </fieldset>  
							<fieldset>
                              <legend class="section">Personal Info</legend>
                                <div class="form-group">
                                    <label class="control-label col-sm-4 input-lg" for="first-name">First Name <span class="required"></span></label>
                                    <div class="col-sm-6 input-group"><span class="input-group-addon"><i class="fa fa-edit"></i></span>
                                    <input type="text" data-parsley-trigger="change" data-parsley-maxlength="40" id="first-name" name="first-name" class="form-control input-lg" data-parsley-id="6"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4 input-lg" for="last-name">Last Name <span class="required"></span></label>
                                    <div class="col-sm-6 input-group"><span class="input-group-addon"><i class="fa fa-edit"></i></span><input type="text" id="last-name" name="last-name" class="form-control input-lg" data-parsley-trigger="change" data-parsley-maxlength="40" data-parsley-id="8"></div>
                                </div>
                            </fieldset>
                            <fieldset>
                               <legend class="section">Contact Details</legend>
                                <div class="form-group">
                                    <label class="control-label col-sm-4 input-lg" for="phone">Phone <span class="required"></span></label>
                                  <div class="col-sm-6 input-group"><span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                  <input type="text" id="phone" name="phone"  class="form-control input-lg" data-parsley-trigger="change" data-parsley-maxlength="15" data-parsley-id="9"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4 input-lg" for="mobile">Mobile <span class="required"></span></label>
                                  <div class="col-sm-6 input-group"><span class="input-group-addon"><i class="fa fa-edit"></i></span>
                                  <input type="text" id="mobile" name="mobile"  class="form-control input-lg" data-parsley-trigger="change" data-parsley-maxlength="15" data-parsley-id="10"></div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-sm-4 input-lg" for="email">Email <span class="required"></span></label>
                                  <div class="col-sm-6 input-group"><span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                                  <input type="email" id="email" name="email" class="form-control input-lg" data-parsley-trigger="change" data-parsley-maxlength="50" data-parsley-id="11"></div>
                                </div>
                            </fieldset>
                            <fieldset>
                               <legend class="section">Address Details</legend>
                                <div class="form-group">
                                  <label class="control-label col-sm-4 input-lg" for="address">Address <span class="required"></span></label>
                                  <div class="col-sm-6 input-group"><span class="input-group-addon"><i class="fa fa-edit"></i></span>
                                  <input type="text" id="address" name="address"  class="form-control input-lg" data-parsley-trigger="change" data-parsley-maxlength="50" data-parsley-id="12"></div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-sm-4 input-lg" for="suburb">Suburb <span class="required"></span></label>
                                  <div class="col-sm-6 input-group"><span class="input-group-addon"><i class="fa fa-edit" aria-hidden="true"></i></span><input type="text" id="suburb" name="suburb"  class="form-control input-lg" data-parsley-trigger="change" data-parsley-maxlength="15" data-parsley-id="13"></div>
                                </div>
                            </fieldset>
                            <div class="form-actions">
                                <div class="row">
                                  <div class="col-sm-6 col-sm-offset-4">
                                        <button type="submit" class="btn btn-primary input-lg">Submit</button>
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
    

    <!-- page specific scripts -->
        <!-- page libs -->
       

	