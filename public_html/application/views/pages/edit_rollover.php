<style type="text/css">
body {
    background-color: #000000;
}

</style>

            <h2 class="page-title">Edit Rollover Payment<small> Late Payments</small></h2><div class="row">
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
                        <form id="user-form" class="form-horizontal" novalidate method="post" data-parsley-priority-enabled="false" data-parsley-excluded="" action="<?php echo site_url(); ?>/reports/edit_rollover/<?php echo $rollover->id; ?>">
                            <fieldset>
                               <legend class="section">Contact Details</legend>
                               <div class="form-group">
                                    <label class="control-label col-sm-4 input-lg" for="user-name">Amount <span class="required"></span></label>
                                  <div class="col-sm-6 input-group"><span class="input-group-addon"><i class="fa fa-usd"></i></span>
                                  <input type="text" id="amount" name="amount" class="form-control input-lg" data-parsley-trigger="change" required="required" value="<?php echo $rollover->amount; ?>" ></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4 input-lg" for="cost">Cost <span class="required"></span></label>
                                  <div class="col-sm-6 input-group"><span class="input-group-addon"><i class="fa fa-usd"></i></span>
                                  <input type="text" id="cost" name="cost" value="<?php echo $rollover->cost; ?>" class="form-control input-lg" data-parsley-trigger="change" required="required"  ></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4 input-lg" for="user-type">Payee <span class="required"></span></label>
                                  <div class="col-sm-6 input-group"><span class="input-group-addon"><i class="fa fa-user"></i></span>
                                  <select class="select2 form-control input-lg" data-placeholder="Select Payee"  id="payee" name="payee" required value="" >
                                    <option value></option>
                                    <?php foreach ($payees as $payee) : ?>
                                    <option value="<?php echo $payee->id; ?>"><?php echo $payee->name; ?></option>
                                    <?php endforeach; ?>
                                </select></div>
                                <script>
                                  $('#payee').val(<?php echo $rollover->payee; ?>);
                                </script>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4 input-lg" for="gst">GST Amount <span class=""></span></label>
                                  <div class="col-sm-6 input-group"><span class="input-group-addon"><i class="fa fa-usd"></i></span>
                                  <input type="text" id="gst" name="gst" class="form-control input-lg" data-parsley-trigger="change" required="required"  data-parsley-id="2" data-parsley-type="number" value="<?php echo $rollover->gst; ?>"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4 input-lg" for="user-type">Shipment Allocation <span class="required"></span></label>
                                  <div class="col-sm-6 input-group"><span class="input-group-addon"><i class="fa fa-user"></i></span>
                                  <select class="select2 form-control input-lg" data-placeholder="Select Shipment" tabindex="-1" id="shipment" name="shipment" required>
                                    <option value></option>
                                    <?php foreach ($shipments as $shipment) : ?>
                                    <option value="<?php echo $shipment->id ?>"><?php echo ($shipment->from_date . ' - ' . $shipment->to_date); ?></option>
                                    <?php endforeach; ?>
                                </select></div>
                                <script>
                                  $('#shipment').val('<?php echo $rollover->shipment ?>');
                                </script>
                                </div>
                            </fieldset>
                            <fieldset>
                               <legend class="section">Description</legend>
                                <div class="form-group">
                                  <label class="control-label col-sm-4 input-lg" for="address">Description <span class="required"></span></label>
                                  <div class="col-sm-6 input-group"><span class="input-group-addon"><i class="fa fa-edit"></i></span>
                                  <textarea type="text" id="description" name="description" class="form-control input-lg" data-parsley-trigger="change" data-parsley-maxlength="500"><?php echo $rollover->description; ?></textarea></div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-sm-4 input-lg" for="suburb">Attachment <span class="required"></span></label>
                                  <div class="col-sm-6 input-group slim">
                                    <img src="<?php echo base_url() . 'rollovers/' . $rollover->id . '/' . $rollover->image; ?>" />
                                   <input type="file" class="uploadImg" accept="image/*" capture="environment" name="images" id="images" /></div>
                                </div>
                            </fieldset>
                                <script>
                                   $('.slim').slim({
                                      size: { width: 680, height: 800 },
                                      label: 'Drop image here / Select from computer',
                                      download: true
                                    });
                                 </script>
                            
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
  $('#amount').keyup(function () {

        var _amount = parseFloat( $('#amount').val() ); 
        var gst =  Math.round(_amount/11,2);
        $('#gst').val(gst);

     });
  </script>
    <!-- page specific scripts -->
        <!-- page libs -->


