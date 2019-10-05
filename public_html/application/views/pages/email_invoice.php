<style type="text/css">
body {
    background-color: #000000;
}
    #datatable-table_filter input{
        height:32px;
        margin-left:10px;
    }
</style>

            <h2 class="page-title">Email Invoice<small></small></h2><div class="row">
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
                        
                        <form id="user-form" class="form-horizontal" novalidate method="get" data-parsley-priority-enabled="false" data-parsley-excluded="" action="<?php echo site_url(); ?>/pdf_contr/send_email/<?php echo $invoice; ?>" >
                            <fieldset>
                               <legend class="section">Email To <?php echo $contact->business_name; ?></legend>
                                <div class="form-group">
                                    <label class="control-label col-sm-4 input-lg" for="to_email">To: <span class="required"></span></label>
                                  <div class="col-sm-6 input-group">
                                  <input type="text" name="to_email" id="to_email" value="<?php echo $contact->email; ?>" class="form-control" required="required" data-parsley-id="40" />
                                  </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label col-sm-4 input-lg" for="amount">CC: <span class="required"></span></label>
                                  <div class="col-sm-6 input-group">
                                  <input type="text" name="cc_email" id="cc_email" value="<?php echo $contact->rep_email; ?>" class="form-control"  />
                                  </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-4 input-lg" for="amount">BCC: <span class="required"></span></label>
                                  <div class="col-sm-6 input-group">
                                  <input type="text" name="bcc_email" id="bcc_email" class="form-control" />
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
</div> 
    

    <!-- page specific scripts -->
        <!-- page libs -->
<script>
$(window).load(function() {   
  $('#user-form').parsley(); 
});
</script>     

    
