<style type="text/css">
body {
    background-color: #000000;
}
</style>

            <h2 class="page-title">Add a Contact <small></small></h2><div class="row">
            <div class="col-md-12">
                <section class="widget">
                    <header>
                    </header>
                    <div class="body">
                       <?php echo validation_errors('<span class="label label-important">'); ?></span>
                        <?php
                        if ($this->session->flashdata('notice') && validation_errors() == '') {
                            echo('<span class="label label-important">' . $this->session->flashdata('notice'));
                        } ?></span>
                        <form id="user-form" class="form-horizontal" novalidate method="post" data-parsley-priority-enabled="false" data-parsley-excluded="" action="<?php echo site_url(); ?>/users/add_contact">
                            <fieldset>
                               <legend class="section">Contact Details</legend>
                               <div class="form-group">
                                    <label class="control-label col-sm-4 input-lg" for="user-name">Name <span class="required"></span></label>
                                  <div class="col-sm-6 input-group"><span class="input-group-addon"><i class="fa fa-user"></i></span>
                                  <input type="text" id="user-name" name="user-name" class="form-control input-lg" data-parsley-trigger="change" required="required" data-parsley-maxlength="15" data-parsley-id="1"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4 input-lg" for="user-type">Contact Type <span class="required"></span></label>
                                  <div class="col-sm-6 input-group"><span class="input-group-addon"><i class="fa fa-user"></i></span>
                                  <select class="select2 form-control input-lg" data-placeholder="Select Contact Type" tabindex="-1" id="user-type" name="user-type" required data-parsley-trigger="change" data-parsley-id="15">
                                    <option value></option>
                                    <option value="0">Employee</option>
                                    <option value="1">Business</option>
                                    <option value="2">Buyer</option>
                                </select></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4 input-lg" for="phone">Phone <span class="required"></span></label>
                                  <div class="col-sm-6 input-group"><span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                  <input type="text" id="phone" name="phone"  class="form-control input-lg" data-parsley-trigger="change" data-parsley-maxlength="15" data-parsley-id="9"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4 input-lg" for="emergency">Emergency <span class="required"></span></label>
                                  <div class="col-sm-6 input-group"><span class="input-group-addon"><i class="fa fa-edit"></i></span>
                                  <input type="text" id="emergency" name="emergency"  class="form-control input-lg" data-parsley-trigger="change" data-parsley-maxlength="15" data-parsley-id="10"></div>
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
                            <fieldset>
                               <legend class="section">Payment Frequency</legend>
                                
                                <div class="form-group">
                                    <label class="control-label col-sm-4 input-lg" for="password">Payment Frequency<span class="required"></span></label>
                                  <div class="col-sm-6 input-group"><span class="input-group-addon"><i class="fa fa-edit"></i></span>
                                  <select class="select2 form-control" data-placeholder="Set Frequency" tabindex="-1" id="visit_frequency" name="visit_frequency" data-parsley-trigger="change" data-parsley-id="70">
                                    <option></option>
                                    <option value="7">Weekly</option>
                                    <option value="14">Fortnightly</option>
                                    <option value="30">Monthly</option>
                                    <option value="90">Quarterly</option>
                                    <option value="180">Bi-Annually</option>
                                    <option value="365">Annually</option>
                                  </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                    <label for="next-visit" class="control-label col-sm-4">Next Payment</label>
                                    <div class="col-sm-6 input-group">
                                      <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                                      <input id="next-visit" class="form-control" type="text" name="next-visit" value="<?php // echo $customer->next_visit ?>" data-parsley-id="72">
                                    </div>
                                </div>                               
                            </fieldset>
                                        <fieldset>
                              <legend class="section">Business Details</legend>
                                <div class="form-group">
                                    <label class="control-label col-sm-4 input-lg" for="abn">ABN <span class="required"></span></label>
                                    <div class="col-sm-6 input-group"><span class="input-group-addon"><i class="fa fa-edit"></i></span>
                                    <input type="text" data-parsley-trigger="change" data-parsley-maxlength="40" id="abn" name="abn" class="form-control input-lg" data-parsley-id="6"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4 input-lg" for="acn">ACN <span class="required"></span></label>
                                    <div class="col-sm-6 input-group"><span class="input-group-addon"><i class="fa fa-edit"></i></span><input type="text" id="acn" name="acn" class="form-control input-lg" data-parsley-trigger="change" data-parsley-maxlength="40" data-parsley-id="8"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4 input-lg" for="acno">ACCOUNT # <span class="required"></span></label>
                                    <div class="col-sm-6 input-group"><span class="input-group-addon"><i class="fa fa-edit"></i></span><input type="text" id="acno" name="acno" class="form-control input-lg" data-parsley-trigger="change" data-parsley-maxlength="40" data-parsley-id="118"></div>
                                </div>
                            </fieldset>

                            <fieldset>
                              <legend class="section">Employee Details</legend>
                                <div class="form-group">
                                    <label class="control-label col-sm-4 input-lg" for="tfn">TFN <span class="required"></span></label>
                                    <div class="col-sm-6 input-group"><span class="input-group-addon"><i class="fa fa-edit"></i></span>
                                    <input type="text" data-parsley-trigger="change" data-parsley-maxlength="40" id="tfn" name="tfn" class="form-control input-lg" data-parsley-id="119"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4 input-lg" for="dob">D.O.B <span class="required"></span></label>
                                    <div class="col-sm-6 input-group"><span class="input-group-addon"><i class="fa fa-edit"></i></span><input type="text" id="dob" name="dob" class="form-control input-lg" data-parsley-trigger="change" data-parsley-maxlength="40" data-parsley-id="120"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4 input-lg" for="super">Superannuation Ref <span class="required"></span></label>
                                    <div class="col-sm-6 input-group"><span class="input-group-addon"><i class="fa fa-edit"></i></span><input type="text" id="super" name="super" class="form-control input-lg" data-parsley-trigger="change" data-parsley-maxlength="40" data-parsley-id="121"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4 input-lg" for="income">Income Tax Ref <span class="required"></span></label>
                                    <div class="col-sm-6 input-group"><span class="input-group-addon"><i class="fa fa-edit"></i></span><input type="text" id="income" name="income" class="form-control input-lg" data-parsley-trigger="change" data-parsley-maxlength="40" data-parsley-id="122"></div>
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


 <script>
   window.onload = function(){
    $('#next-visit').datetimepicker({format: 'DD/MM/YYYY'});
    $('#dob').datetimepicker({format: 'DD/MM/YYYY'});
}
  </script>
    <!-- page specific scripts -->
        <!-- page libs -->
