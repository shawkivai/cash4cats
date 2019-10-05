<style type="text/css">
body {
    background-color: #000000;
}
</style>

            <h2 class="page-title">Staff Member Report<small></small></h2><div class="row">
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
                        
                        <form id="user-form" class="form-horizontal" novalidate method="post" data-parsley-priority-enabled="false" data-parsley-excluded="" action="<?php echo site_url(); ?>/pages/view/report_user_summary">
                            <fieldset>
                               <legend class="section">Select Staff Member and Date Range</legend>
                                <div class="form-group">
                                    <label class="control-label col-sm-4 input-lg" for="amount">Staff Member <span class="required"></span></label>
                                  <div class="col-sm-6 input-group">
                                  <select id="staff" name="staff" class="form-control input-lg" data-parsley-trigger="change" required  data-parsley-id="1" >
                                    
                                    <?php foreach ($staffs as $staff) : ?>
                                    <option value="<?php echo $staff->username ?>"><?php echo $staff->username ?></option>
                                    <?php endforeach; ?>
                                  </select>
                                  </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label col-sm-4 input-lg" for="from">From <span class="required"></span></label>
                                  <div class="col-sm-6 input-group">
                                  <input type="text" name="from" id="from" class="form-control" />
                                  </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label col-sm-4 input-lg" for="amount">To <span class="required"></span></label>
                                  <div class="col-sm-6 input-group">
                                  <input type="text" name="to" id="to" class="form-control" />
                                  </div>
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
<script>
$(window).load(function() {
    
       $('#from').datetimepicker({format: 'YYYY/MM/DD'});
       $('#to').datetimepicker({format: 'YYYY/MM/DD'});
       $('#amount').keyup(function () {
           gst_amount = cal_gst();
           $('#gst').val(gst_amount);
       });
});
    function cal_gst(){
        var gst_amount = ($('#amount').val() / 1.1)*0.1;
        gst_amount = gst_amount.toFixed(2);
        return gst_amount;
    }
    function gst_clicked(){
        if ($('#gst_check').is(":checked")){
            $('#gst').val(0.00);
            $('#gst').attr('readonly','readonly');
        }
        else{
            var gst = cal_gst();
            $('#gst').val(gst_amount);
            $('#gst').removeAttr('readonly');
        }
    }
</script>     

    
