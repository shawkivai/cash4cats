<style type="text/css">
body {
    background-color: #000000;
}
.employee{
  display: none;
  color: green;
}
#total_holder{
  font-weight: bold;
    margin-top: 5px;
    font-size: 16px;
}
</style>
<?php
$amount = '';
$amount_ini = '';
$gst = 0.00;
$gst_app = '';
$supplier = '';
$date = '';
$invoiceRef = '';
$super = '';
if (isset($action) && $action == 'edit') {
     $amount_ini = $expense->amount_ini;
    $amount = $expense->amount;
       $gst= $expense->gst;
       $supplier = $expense->supplier;
       $date = $expense->date;
       $invoiceRef = $expense->ref;
       $super = $expense->super;
       $image = $expense->image;
       $id = $_GET['expense_id'];
}
?>
            <h2 class="page-title">Add Expense <small></small></h2><div class="row">
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

                        <form id="user-form" class="form-horizontal" novalidate method="post" data-parsley-priority-enabled="false" data-parsley-excluded="" enctype="multipart/form-data" action="<?php echo site_url(); ?>/pages/add_expense">
                            <fieldset>
                               <legend class="section">Enter Expense Details Here</legend>
                               <div class="form-group">
                                  <label class="control-label col-sm-4 input-lg" for="amount">Pay To <span class="required"></span></label>
                                  <select onChange="switch_emp(this)" id="supplier" name="supplier" required="required" class="select2 form-control optionBox" style="width:83%">
                                            <option value="0"></option>
                                            <?php if ($contacts) : ?>
                                                <?php foreach ($contacts as $contact) : ?>
                                              <option value="<?php echo $contact->id ?>" data-type="<?php echo $contact->contact_type; ?>"><?php
                                                echo $contact->name; ?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                  </select>
                               </div>
                               <div class="form-group">
                                    <label class="control-label col-sm-4 input-lg" for="invoice-ref">Invoice# Reference</label>
                                  <div class="col-sm-6 input-group">
                                  <input type="text" id="invoice-ref" name="invoice-ref" class="form-control input-lg" data-parsley-trigger="change" value="<?php echo $invoiceRef; ?>"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4 input-lg" for="amount">Total Amount <span class="required"></span></label>
                                  <div class="col-sm-6 input-group">
                                  <input type="text" id="amount" name="amount" class="form-control input-lg" data-parsley-trigger="change" required="required"  data-parsley-type="number" value="<?php echo $amount_ini; ?>"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4 input-lg" for="gst">GST Amount <span class="required"></span></label>
                                  <div class="col-sm-6 input-group">
                                  <input type="text" id="gst" name="gst" class="form-control input-lg" data-parsley-trigger="change" required="required"   data-parsley-type="number" value="<?php echo $gst; ?>"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4 input-lg" for="gst_check">GST Not Applicable </label>
                                  <div class="col-sm-6 input-group">
                                  <input type="checkbox" id="gst_check" name="gst_check" style="width:5%" class="form-control input-lg" data-parsley-trigger="change"  onClick="gst_clicked()"></div>
                                <script>
                                            <?php if (isset($action) && $action == 'edit') : ?>
                                            var gst_appl = <?php  echo $gst; ?>;
                                            if ( gst_appl == 0 ){
                                                $('#gst_check').click();
                                            }

                                            <?php endif; ?>
                                                 </script>
                                </div>
                                <div class="form-group employee">
                                    <label class="control-label col-sm-4 input-lg" for="super">Superannuation <span class="required"></span><br /><small><?php echo $options[0]['option-value']; ?>%</small></label>
                                  <div class="col-sm-6 input-group">
                                  <input type="text" id="super" name="super" class="form-control input-lg" data-parsley-type="number" value="<?php echo $super; ?>"></div>
                                </div>
                               <!-- <div class="form-group employee">
                                    <label class="control-label col-sm-4 input-lg" for="tax">Income Tax <span class="required"></span><br /><small><?php echo $options[1]['option-value']; ?>%</small></label>
                                  <div class="col-sm-6 input-group">
                                  <input type="text" id="tax" name="tax" class="form-control input-lg" data-parsley-type="number" value="<?php echo $tax; ?>"></div>
                                </div> -->
                                <div class="form-group">
                                    <label class="control-label col-sm-4 input-lg" for="date">Date </label>
                                  <div class="col-sm-6 input-group">
                                  <input type="text" id="date" name="date" required="required" class="form-control input-lg" value="<?php echo $date; ?>"></div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-4 input-lg" for="image">Image </label>
                                  <div class="col-sm-6 input-group slim">
                                                                    <?php	if (isset($action) && $action == 'edit') : ?>
                                                                        <img src="<?php echo base_url() . '/exp_images/' . $id . '/' . $image; ?>" />
                                                                    <?php endif; ?>
                                  <input type="file" class="uploadImg" accept="image/*" capture="environment" name="images" id="images"  />
                                  </div>
                                </div>
                                <script>
                                   $('.slim').slim({
                                      size: { width: 680, height: 800 },
                                      label: 'Drop image here / Select from computer',
                                                                            download: true
                                    });
                                 </script>

                                 <div class="form-group">
                                    <label class="control-label col-sm-4 input-lg" for="date">Total: </label>
                                  <div class="col-sm-6 input-group">
                                  <p id="total_holder"><?php echo $amount; ?></p>
                                  <input type="hidden" id="total_amount" name="total_amount" required="required" class="form-control input-lg" data-parsley-trigger="change" value="<?php echo $amount; ?>"></div>
                                </div>

                            </fieldset>
                            <div class="form-actions">
                                <div class="row">
                                  <div class="col-sm-6 col-sm-offset-4">
                                        <?php if (isset($action) && $action == 'edit') : ?>
                                       <input type="hidden" id="isUpdate" name="isUpdate" value=true />
                                       <input type="hidden" id="expense_id" name="expense_id" value="<?php echo $_GET['expense_id'] ?>" />
                                       <button type="submit" class="btn btn-primary input-lg">Update</button>
                                        <?php else : ?>
                                       <input type="hidden" id="isUpdate" name="isUpdate" value=false />
                                        <button type="submit" onClick="before_submit()" class="btn btn-primary input-lg">Submit</button>
                                        <?php endif; ?>
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
 var is_emp = false;
 var supera = <?php echo $options[0]['option-value']; ?>;
 supera = parseFloat(supera);
 var income = <?php echo $options[1]['option-value']; ?>;
 income = parseFloat(income);
 var final_amount;
    <?php if (isset($action) && $action == 'edit') : ?>
     var supplier = <?php echo $supplier ?>;
     $('#supplier').val(supplier);
     $('#supplier').change();
    <?php endif; ?>


$(window).load(function() {
        var gst_amount;
    $('#super').attr('readonly','readonly');

       $('#date').datetimepicker({format: 'YYYY/MM/DD'});
       $('#amount').keyup(function () {

      if (!$('#gst_check').is(":checked")){
           gst_amount = cal_gst();
           $('#gst').val(gst_amount);
     }

                 ini_amount = parseFloat( $('#amount').val() );
                 $('#total_holder').html( '$' + ini_amount );
                 $('#total_amount').val(ini_amount);
                 if (is_emp){
                     var superanu = parseFloat( ( ini_amount * (supera/100) ).toFixed(2) );
                     //var incomeu = parseFloat( (ini_amount * (income/100)).toFixed(2) );

                     $('#super').val(superanu);
                     //$('#tax').val(incomeu);
                     final_amount = (ini_amount + superanu).toFixed(2);
                     $('#total_holder').html( '$' + final_amount  );
                     $('#total_amount').val(final_amount);
                 }


       });


});

  function before_submit(){
    if (is_emp){
      var final_amount = parseFloat($('#amount').val()) + parseFloat($('#super').val());
    }
    else{
      var final_amount = $('#amount').val();
    }
    
    $('#total_amount').val( final_amount );
  }

  function switch_emp(selected){
    $('.employee').hide();
    is_emp = false;
    var type = $(selected).find(':selected').data('type');
    if (type == 0){
      // Show employee fields
      $('.employee').show();
      is_emp = true;
      $("#images").prop('required',false);
    }
    else{
      $("#images").prop('required',true);
    }

  }
    function cal_gst(){
        gst_amount = ($('#amount').val() / 1.1)*0.1;
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
            $('#gst').val(gst);
            $('#gst').removeAttr('readonly');
        }
    }
</script>
