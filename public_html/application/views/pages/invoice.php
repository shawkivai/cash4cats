<style type="text/css">

body {
  background-color: #000000;
}
.omersBorder{
  border: 1px solid #1e556c;
    border-radius: 3px;
  padding: 2%;
    -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    -webkit-transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
    -o-transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
    transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
}

  #show_searched_cats {
    display: none;
    overflow: scroll;
    height: 450px !important;
  }
  #show_all_cats  {
    overflow: scroll;
    height: 450px !important;
  }
  table#summary {
    border-collapse: collapse;
    width: 100%;
}

 #summary th, td {
    text-align: left;
    padding: 8px;
}

#summary tr:nth-child(even){background-color: #f2f2f2}

 #summary th {
    background-color: #4CAF50;
    color: white;
}
  #summary{
    margin-bottom:50px;
  }
  .uploadImg{
    margin-bottom: 10px !important;
    width: 400px;
  }
</style>
<div id="errorbox" style="">
</div>
        <h2 class="page-title">New Invoice<small> <?php
        if ($this->session->flashdata('notice')) {
            echo('<span class="label label-important">' . $this->session->flashdata('notice'));
        } ?></span></small></h2>

          <div class="row" onClick="pageload()">

            <div class="col-lg-12">

                <form id="user-form" class="form-horizontal form-label-left" method="post" action="<?php echo (site_url() . '/invoicing/save_invoice') ?>" data-parsley-priority-enabled="false" data-parsley-excluded="" novalidate enctype="multipart/form-data">
                <section class="widget" >

                    <header>
                        <?php if ($customers == false) : ?>
                          <span class="label label-important">No Customers have been registered. Please register customers first before continuing</span>
                        <?php endif; ?>
                        <h4><i class="fa fa-user"></i> Select Customer</h4>
                    </header>
                  <div class="body">

                    <fieldset>
                                <legend class="section"></legend>
                                <div class="form-group">
                                    <label for="customer" class="control-label col-sm-2">Select Customer</label>
                                    <div class="col-sm-10">
                                        <select onChange="groupPrices(this)" data-parsley-id="1" id="customer" name="customer" data-style="btn-success" data-width="80%" required required="required" data-parsley-trigger="change" class="select2 form-control optionBox" disabled>
                                            <option value="0" style="width:100%"></option>
                                            <?php foreach ($customers as $customer) : ?>
                                            <option value="<?php echo $customer->id ?>" style="width:100%" data-type="<?php echo $customer->customer_type; ?>"><?php echo $customer->business_name ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                 <div class="form-group">
                                    <label for="comm" class="control-label col-sm-2">Processed By</label>
                                    <div class="col-sm-10">
                                        <select id="comm" name="comm" data-style="btn-success" data-width="80%" required required="required" data-parsley-trigger="change" class="select2 form-control optionBox" >
                                            <option value="1" style="width:100%">Staff</option>
                                            <option value="2" style="width:100%">Staff & Admin</option>
                                            <option value="3" style="width:100%">Admin</option>
                                        </select>
                                    </div>
                                </div>
                            </fieldset>

                  </div>
                </section>

                <section id="popSection" class="widget">

                    <header id="popheader" onClick="expand(this)" class="" style="cursor:pointer">

                        <h4><i class="fa fa-user"></i> Purchase History</h4>

                        <div class="widget-controls" >
                            <a data-widgster="collapse" title="Collapse" href="#" style="display: inline;"><i class="glyphicon glyphicon-chevron-down"></i></a>
                            <a data-widgster="expand" title="Expand" href="#" style="display: none;"><i class="glyphicon glyphicon-chevron-up"></i></a>
                        </div>

                    </header>
                  <div class="body">

                    <fieldset>
                                <legend class="section"></legend>
                                <div class="form-group">
                                    <label for="pop_cats" class="control-label col-sm-2">Popular Catalytic Converters for this Customer
                                    <button onclick="recall_prices_again()" type="button" class="btn btn-warning" style="display:block;margin-top:15px"><i class="fa fa-refresh" aria-hidden="true"></i>       Refresh Prices</button>
                                    </label>
                                    <div id="popular_cats" class="col-sm-10">
                                        <p>Select a customer to view popular cats...</p>
                                    </div>
                                </div>
                            </fieldset>

                    </div>
                  </section>

                  <section class="widget">

                       <header>
                        <h4><i class="fa fa-user"></i> Select Catalytic Converter</h4>
                    </header>
                      <div class="body">

                        <div class="form-group">
                                    <label for="cat_search" class="control-label col-sm-2">Search for a Catalytic Converter</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="cat_search" name="cat_search" data-style="btn-success" data-width="80%" class="form-control" placeholder="Start searching for a cat here...">
                                    </div>
                          <div class="col-sm-10 col-sm-offset-2" style="margin-top: 20px" id="show_searched_cats"></div>
                        </div>

                      
                  </div>
                </section>

                <section class="widget">

                    <header>
                        <h4><i class="fa fa-user"></i> Selected Catalytic Converters</h4>
                    </header>
                  <div class="body">

                    <fieldset>
                                <legend class="section"></legend>
                                <div class="form-group">
                                    <table class="table table-striped">
                            <thead>
                            <tr>
                                <th class="hidden-xs">Picture</th>
                                <th>Item</th>
                                <th class="">Price</th>
                                <th class="">QTY</th>
                                <th class="">Total</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody id="invoice_body">
                            <tr data-name="" data-override="" data-ids="" data-qtys="1" data-active=true id="row-id1" class="inv-row">
                                <td class="hidden-xs">
                                    <img class="img-rounded" id="inv-img1" src="" height="100px" />
                                </td>
                                <td>
                                    <input type="text" id="cat-name1" name="cat-name1"  class="form-control" readonly>
                                </td>
                                <td> <div class="input-group">
                                            <span class="input-group-addon">$</span>
                                    <input type="text" class="prices form-control" id="cat-price1" name="cat-price1" readonly></div>
                                    <div class="input-group" style="margin-top:10px">
                                            <span class="input-group-addon">$</span>
                                    <input type="text" id="cat-price-override1" name="cat-price-override1" data-over="1" class="form-control override" placeholder="Override Price" >   </div>
                                 </td>
                                <td class="text-muted">
                                    <input type="text" id="cat-qty1" name="cat-qty1" data-qty="1"  class="form-control qty_field" >
                                </td>
                                <td class="text-muted">
                                    <input type="text" id="cat-total1" name="cat-total1"  class="form-control" readonly>
                                </td>
                                <td><a data-num="1" class="fa fa-times" onClick="removeRow(this)"></a>
                                  <input type="hidden" id="isActive1" name="isActive1" value="1" />
                                  <input type="hidden" id="cat-id1" name="cat-id1" value="" />
                                  <input type="hidden" class="lines" id="line-number1" name="line-number1" value="1" />
                                </td>
                            </tr>



                            </tbody>

                        </table>

                                <div style="padding:20px">
                  <h4 style="text-align: left;margin-top: 5px">INVOICE SUMMARY: </h4>
                  <table id="summary" style="width:99%">

                  </table>
                  <h4 style="text-align: left;margin-top: 5px">INVOICE TOTALS: </h4>
                                <div class="input-group" style="margin-top:10px">
                                  <span class="input-group-addon" >CATS TOTAL: <br /><div style="font-weight:bold" id="catTotalSummary"></div></span>
                                  <span class="input-group-addon" >GST: <br /><div style="font-weight:bold" id="gstTotalSummary"></div></span>
                                            <span class="input-group-addon">TOTAL DUE: $</span><input type="text" id="total" name="total"  class="form-control" style="font-size: 22px;height: 50px;" readonly></div>                                </div>
                                </div>
                            </fieldset>
                  </div>
                </section>


                <section class="widget">

                    <header id="historyheader" onClick="expand(this)" class="" style="cursor:pointer">

                        <h4><i class="fa fa-user"></i> Notes History</h4>

                        <div class="widget-controls" >
                            <a data-widgster="collapse" title="Collapse" href="#" style="display: inline;"><i class="glyphicon glyphicon-chevron-down"></i></a>
                            <a data-widgster="expand" title="Expand" href="#" style="display: none;"><i class="glyphicon glyphicon-chevron-up"></i></a>
                        </div>

                    </header>
                  <div class="body">
                      <div id="datatable-table_wrapper" class="dataTables_wrapper form-inline no-footer">
                       <table id="datatable-table" class="table table-striped table-hover dataTable no-footer" role="grid" aria-describedby="datatable-table_info">
                        <thead>
                        <tr role="row">
                        <th class="sorting_desc" tabindex="0" aria-controls="datatable-table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Id: activate to sort column descending" style="width:85%">Note</th>
                        <th class="" tabindex="0" aria-controls="datatable-table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Id: activate to sort column descending" style="with:15%">Date</th>
                        </tr>
                        </thead>
                          <tbody id="notes_table">
                          </tbody>
                      </table>
                    </div>
                  </div>

                </section>


                  <section class="widget">

                    <header>
                        <h4><i class="fa fa-user"></i> Other Info</h4>
                    </header>
                  <div class="body">

                    <fieldset>
                                <legend class="section"></legend>
                                <div class="form-group">
                                    <label for="inv-status" class="control-label col-sm-2">Invoice Status</label>
                                    <div class="col-sm-10">
                                        <select id="inv-status" name="inv-status" data-style="btn-success" data-width="80%" class="select2">
                                            <option value="2" style="width:100%">Paid</option>
                                            <option value="0" style="width:100%">Quote</option>
                                            <option value="1" style="width:100%">Unpaid</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                  <label for="notes" class="control-label col-sm-2">Notes</label>
                                  <div class="col-sm-10">
                                    <textarea class="form-control" name="notes" id="notes"></textarea>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label for="images" class="control-label col-sm-2">Images</label>
                                  <div class="col-sm-10">

                                  <input type="file" class="uploadImg" accept="image/*" capture="environment" name="images[]" id="images1" />
                                    <input type="file" class="uploadImg" accept="image/*" name="images[]" id="images2" />
                                    <input type="file" class="uploadImg" accept="image/*" name="images[]" id="images3" />
                                    <input type="file" class="uploadImg" accept="image/*" name="images[]" id="images4" />
                                    <input type="file" class="uploadImg" accept="image/*" name="images[]" id="images5" />
                                  </div>
                                </div>

                            </fieldset>
                            <input type="hidden" id="counter" name="counter" />
                            <div class="form-actions">
                                <div class="row">
                                  <div class="col-sm-6">
                                    <div id="warning" style="color:red">WARNING: Invoice may have cats that are overpriced. If so, you will need permission to process the invoice.</div>
                                    <input style="width:22px;float:left;margin-right:12px" type="checkbox" id="complete" name="complete" class="form-control" /> <p style="margin-top:9px">Invoice is ready to submit.</p>
                                  </div>
                                  <div class="col-sm-6">
                                        <button id="submit-button" type="submit" class="btn btn-primary input-lg" onClick="before_submit()" disabled="true">Submit Invoice</button>
                                    </div>
                                </div>
                            </div>
            </div>
          </section>

                </form>


            </div>

      </div>

        </div>
   </div>


<script type="text/javascript">
  var counter = 1;
  var customer_type;
  var added_items_array = [];
  var new_results;
  var customer_id;
  var image_uploaded = false;

  $('#warning').hide();

  $('.uploadImg').change(function() {
    image_uploaded = true;
    change_complete_box_upload();
  });

   $('#complete').change(function() {
    change_complete_box();
  });

  function recall_prices_again(){
    $('#customer').change();
  }

  function change_complete_box_upload(){
    if ( $('#complete').is(":checked") ){
      $('#submit-button').prop('disabled', false);
    }
  }

  function change_complete_box(){
    $('#submit-button').prop('disabled', function(i, v) {
        if (image_uploaded && v==true){
          return false;
        }
        else if (image_uploaded && v==false) {
          return true;
        }
    });
  }

  window.onbeforeunload = function() {
    return "Leaving this page will reset the wizard";
  };

  function hide_pop_row(){
    $('#popSection').widgster('collapse');
    $('#popSection').addClass("hidden_row");
  }

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

  $('#user-form').submit( function( event ) {
    if ( $('#customer').val() == 0) {
      alert('Please Select a Customer Before Submitting the form');
      event.preventDefault();
    }
  });

      function update_quantity_on_selected_item(item){
      var selected = $(item).attr('data-qty');
       var qty_container = '#cat-qty' + selected;

       var price_container = '#cat-price-override' + selected;

       if ( !$(price_container).val()){
         // Get the actual price
         var price_container = '#cat-price' + selected;
       }
       else{
           var price_container = '#cat-price-override' + selected;
       }

       var total_container = '#cat-total' + selected;

       var qty =  parseInt($(qty_container).val());
       var price = parseFloat( $(price_container).val());

       $(total_container).val(qty_update(qty, price));
       update_totals();

       // Update data-qtys attribute
      $(item).parent().parent().attr('data-qtys', qty);
      add_summary();
    }

  function before_submit(){
    window.onbeforeunload = null;
    var rows = counter - 1;
    $("#counter").val(rows);

    var line_nums = 1;
    $('.inv-row').each(function() {

      //alert(this.getAttribute('data-name'));
      //var rowNum = '#line-number' + line_nums;

      $(".lines", this).val(line_nums);
      //$(rowNum).val(line_nums);

      line_nums++;
    });
  }

  function round(value, decimals) {
    return Number(Math.round(value+'e'+decimals)+'e-'+decimals);
  }


  function update_totals(){
    var running_total = 0;

    for (i=1; i <= counter-1; i++){
      var current_row_totals_box = '#cat-total' + i;
      var current_row_total = parseFloat( $(current_row_totals_box).val() );

      running_total += current_row_total;
    }

    running_total = round(running_total, 2);
    $('#catTotalSummary').html('$' + running_total);
    var current_gst = round(running_total*0.1,2);
    $('#gstTotalSummary').html('$' + current_gst);
    $('#total').val(round(running_total*1.1,2));
  }

  function groupPrices(selected){
    new_results = {};
    customer_type = $(selected).find(':selected').data('type');
    customer_id =  $(selected).find(':selected').val();
    //alert(customer_type);
    // Get Popular Cats
    // Do the AJAX Query
    $("#popular_cats").html('');
           jQuery.ajax({
         url: '<?php echo site_url(); ?>/reports/pop_cats',
         data: { term : customer_id },
         dataType: 'text',
         error: function() {
              $("#popular_cats").html('No Cats to Display');
            },
         success: function(results) {
              /* display the new results */
           $("#popular_cats").html(results);
           /*$("#show_searched_cats").show(); */
            groupPopPrices();
         }
        });

           // jQuery.ajaxSetup({async:true});
    //getNotes();
      jQuery.ajax({
         url: '<?php echo site_url(); ?>/reports/get_notes',
         data: { term : customer_id },
         dataType: 'text',
         error: function() {
              $("#notes_table").html('No Notes to Display');
            },
         success: function(results) {
              /* display the new results */
           $("#notes_table").html(results);
           /*$("#show_searched_cats").show(); */
         }
        });

      //getOverridePrices
      jQuery.ajax({
         url: '<?php echo site_url(); ?>/reports/get_overrides',
         data: { term : customer_id },
         dataType: 'json',
         error: function(results) {
              console.log(results);
              groupAllPrices(null, false);
            },
         success: function(results) {
            var results_exist;

             results = JSON.parse(JSON.stringify(results) );

            for (i = 0; i < results.length; i++){
              var newId = results[i].cat_id;
              new_results[newId] = results[i];
            }
            if (results.length > 0){
              results_exist = true;
            }
            else{
              results_exist = false;
            }


           groupAllPrices(new_results, results_exist);
         }

        });

  }

  function groupPopPrices(){
            var results_exist;
            var new_results = [];
      //console.log(customer_id);
       //jQuery.ajaxSetup({async:false});
          jQuery.ajax({
         url: '<?php echo site_url(); ?>/reports/get_overrides',
         data: { term : customer_id },
         dataType: 'json',
         error: function(results) {
             // console.log(results);
              set_popular_cat_prices(null, false);
            },
         success:  function(results) {

            results = JSON.parse(JSON.stringify(results) );
           //console.log("Length: ");
           //console.log('Length', results.length);
           //console.log(results);
           
            /*if (results.length > 0){
              results_exist = true;
            }
            else{
              results_exist = false;
            } */
            if (results == 'No Entries'){
              results_exist = false;
            }
            else{
              results_exist = true;
               for (i = 0; i < results.length; i++){
              var newId = results[i].cat_id;
              new_results[newId] = results[i];
             //console.log(results[i]);
              }
            }
            //console.log('Results:', new_results);
           // new_results = results;
           set_popular_cat_prices(new_results, results_exist);
         }

        });   // end Ajax call


  }

  function set_popular_cat_prices(new_priced, results_exist){
    var correct_price = 'price' + customer_type;
    var allPrices = $("#popular_cats .data-holder");
    // console.log(results_exist);

    allPrices.each(function() {
     
      var id_if_override = $(this).find("a").attr("data-id");
      console.log(id_if_override);

      if (results_exist && new_priced[id_if_override]){
          console.log(id_if_override + ': Cat is overriden');
        $(this).find("a").attr("data-price", new_priced[id_if_override].price );
        $(this).find(".price_holder").html(new_priced[id_if_override].price);
      }

      else{
        console.log('No Override');
        var correct_price_grouped = $(this).find("a").data(correct_price);
        $(this).find("a").attr("data-price", correct_price_grouped);
        $(this).find(".price_holder").html(correct_price_grouped);
      }

    });
    
  }


  function groupAllPrices(new_priced, results_exist){
    //console.log(new_priced);
   // console.log( new_priced[2]);
    var correct_price = 'price' + customer_type;
    var allPrices = $("#show_all_cats .data-holder");
    //console.log(correct_price);
    allPrices.each(function() {

      // check of customer override price exists
      var id_if_override = $(this).find("a").attr("data-id");

      if (results_exist && typeof new_priced != undefined && new_priced[id_if_override] != undefined){
          //console.log(id_if_override + ': Cat is overriden');
        $(this).find("a").attr("data-price", new_priced[id_if_override].price );
        $(this).find(".price_holder").html(new_priced[id_if_override].price);
      }


      else{
        //console.log('Cat Exists');
        var correct_price_grouped = $(this).find("a").data(correct_price);
        $(this).find("a").attr("data-price", correct_price_grouped);
        $(this).find(".price_holder").html(correct_price_grouped);
      }
      //console.log($(this).find("a"));
    });

  }

  function groupAjaxPrices(){

      jQuery.ajax({
         url: '<?php echo site_url(); ?>/reports/get_overrides',
         data: { term : customer_id },
         dataType: 'json',
         error: function(results) {
              console.log(results);
              groupAllPrices(null, false);
            },
         success: function(results) {
            var results_exist;

             results = JSON.parse(JSON.stringify(results) );

            for (i = 0; i < results.length; i++){
              var newId = results[i].cat_id;
              new_results[newId] = results[i];
            }
            if (results.length > 0){
              results_exist = true;
            }
            else{
              results_exist = false;
            }
            //console.log(new_results.length);
           // new_results = results;
           set_searched_cats_prices(new_results, results_exist);
         }

        });
  }


  function set_searched_cats_prices(new_priced, results_exist){
    //console.log(new_results);
    var correct_price = 'price' + customer_type;
    var allPrices = $("#show_searched_cats .data-holder");
    //console.log(correct_price);
    allPrices.each(function() {

      var id_if_override = $(this).find("a").attr("data-id");

      if (results_exist && typeof new_priced != undefined && new_priced[id_if_override] != undefined){
          //console.log(id_if_override + ': Cat is overriden');
        $(this).find("a").attr("data-price", new_priced[id_if_override].price );
        $(this).find(".price_holder").html(new_priced[id_if_override].price);
      }


      else{
        //console.log('Cat Exists');
        var correct_price_grouped = $(this).find("a").data(correct_price);
        $(this).find("a").attr("data-price", correct_price_grouped);
        $(this).find(".price_holder").html(correct_price_grouped);
      }

    });

  }


  function pageload(){

     jQuery('.override').keyup(function () {
       var price;
       var selected = $(this).attr('data-over');
       var qty_container = '#cat-qty' + selected;

       var price_container = '#cat-price-override' + selected;
       var total_container = '#cat-total' + selected;

       var id_container = '#cat-id' + selected;
       var id_to_check = $(this).parent().parent().parent().find(id_container).val();
       //console.log(id_to_check);

       // Check if override container is empty
       if ( !$(price_container).val()){

         $(this).parent().parent().parent().attr('data-override', 0);
         // Get the actual price
         var true_price_container = '#cat-price' + selected;
         var price = parseFloat( $(true_price_container).val() );
       }
       else{
         price = parseFloat( $(price_container).val());
         price = price.toFixed(2);

          $(this).parent().parent().parent().attr('data-override', price);

       }

       var qty =  parseInt($(qty_container).val());

       $(total_container).val(qty_update(qty, price));

       // Check whether after override, cat will be sold at lost.

       // Get price of override. price variable. Get cat id -> id_to_check
       // Send to ajax query
       var container_row = $(this);

       jQuery.ajax({
         url: '<?php echo site_url(); ?>/invoicing/sold_at_loss',
         data: { price : price, id : id_to_check },
         dataType: 'text',
         error: function() {
              console.log('error');
            },
         success: function(result) {
            if (result == 'loss'){
              $(container_row).parent().parent().parent().addClass("red-back");
              $('#warning').show();
            }
            else{
               $(container_row).parent().parent().parent().removeClass("red-back");
            }
         }
        });


       // End loss Check

       update_totals();


       add_summary();
     });

    jQuery('.qty_field').keyup(function () {
       update_quantity_on_selected_item(this);
     });
  }

   $(window).load(function() {

      $("#popheader").click();
      $("#historyheader").click();

      $('.uploadImg').slim({
        size: { width: 640, height:480 },
        label: 'Drop image here or Click to select'
      });

     jQuery('#cat_search').keyup(function(){
       var search_term = $(this).val();

       if (search_term.length > 2){

        // Hide all the Cats
        $("#show_all_cats").hide();

         // Do the AJAX Query
           jQuery.ajax({
         url: '<?php echo site_url(); ?>/invoicing/ajax_cats',
         data: { term : search_term },
         dataType: 'text',
         error: function() {
              $("#show_searched_cats").html('No Cats to Display');
            },
         success: function(results) {
              /* display the new results */
           $("#show_searched_cats").html(results);
           $("#show_searched_cats").show();
             groupAjaxPrices();
         }
        });
       }

       else{
         $("#show_all_cats").show();
         $("#show_searched_cats").empty();
         $("#show_searched_cats").hide();
       }
     });
     $('#customer').prop('disabled',false);
   });


  function qty_update(price, qty){
    var total = qty*price;
    total = round(total, 2);
    return total;
  }

  function removeRow(row){
    var id = $(row).attr('data-num');
    var row_to_delete = '#row-id' + id;
    var total_to_delete = '#cat-total' + id;
    var is_active = '#isActive' + id;
    $(is_active).val(0);
    $(row_to_delete).hide();
    $(row_to_delete).attr('data-active', false);
    $(total_to_delete).val(0);
    // remove this item from added_items_array
    var cat_id_delete = $(row_to_delete).data('ids');
    added_items_array = jQuery.grep(added_items_array, function(value){
      return value != cat_id_delete;
    });
    update_totals();
    add_summary();
  }

  function updateThisQuantity(item){
    var updated_qty = $(item).val();
    var id_to_update = $(item).attr('data-qty-id');
    var row_to_change = $("*[data-ids=" + id_to_update + "]");
    var selected_quantity_input = $(row_to_change).find(".qty_field");
    $(selected_quantity_input).val(updated_qty);
    update_quantity_on_selected_item(selected_quantity_input);
    //console.log(updated_qty);
  }

  function addToInvoice(item){
    var id = $(item).attr('data-id');
    var price = $(item).attr('data-price');
    var name = $(item).attr('data-name');
    var image = $(item).attr('data-image');


    if (counter === 1){
      counter++;
      //Populate first row of invoice items:
      $('#inv-img1').attr("src", image);
      $('#cat-name1').val(name);
      $('#cat-price1').val(price);
      //$('#cat-qty1').val(1);
      $('#cat-total1').val(price);
      $('#cat-id1').val(id);
      $('#row-id1').attr('data-name', price);
      $('#row-id1').attr('data-ids', id);
      $('#line-number1').val(1);

      // Check if quantity has any value.
        //var qty_input_field = $("*[data-qty-id=" + id + "]");
        //console.log(qty_input_field);
        //var qty_input_selected = qty_input_field.val();

        //
        var qty_input_selected = $(item).parent().find("*[data-qty-id=" + id + "]").val();
        //console.log(qty_input_selected);

        // If it does not have value, set to 1
        if (qty_input_selected == 0){
          $('#cat-qty1').val(1);
        }

        else{
          $('#cat-qty1').val(qty_input_selected);
        }

      added_items_array.push(id);
    }
    else{
      var isInArray = ( jQuery.inArray(id, added_items_array) > -1 );
      if ( !isInArray ){
        var newRow = '<tr data-name="'+ price +'" data-override="" data-ids="' + id + '" data-qtys="1" data-active=true class="inv-row" id="row-id' + counter + '"> <td class="hidden-xs">  <img class="img-rounded" id="inv-img' + counter + '" src="" alt="" height="100">' +
                                '</td>  <td>  <input type="text" id="cat-name' + counter + '" name="cat-name' + counter + '" class="form-control" readonly>  </td>' +
                                '<td> <div class="input-group">' +
                                            '<span class="input-group-addon">$</span>' +
                                    '<input type="text" class="prices form-control" id="cat-price' + counter + '" name="cat-price' + counter + '" readonly></div>' +
                                    '<div class="input-group" style="margin-top:10px">' +
                                            '<span class="input-group-addon">$</span>' +
                                    '<input type="text" id="cat-price-override' + counter + '" data-over="' + counter + '" name="cat-price-override' + counter + '"  class="form-control override"' + 'placeholder="Override Price" >   </div>' +
                                 '</td>' +
                                '<td class="text-muted">' +
                                    '<input type="text" id="cat-qty' + counter + '" name="cat-qty' + counter + '" data-qty="' + counter + '"  class="form-control qty_field" >' +
                                '</td>' +
                                '<td class="text-muted">' +
                                    '<input type="text" id="cat-total' + counter + '" name="cat-total' + counter + '"  class="form-control" readonly>' +
                                '</td>' +
                                '<td><a data-num="' + counter + '" class="fa fa-times" onClick="removeRow(this)"></a>' +
                '<input type="hidden" id="isActive' + counter + '" name="isActive' + counter + '" value="1" />' +
                '<input type="hidden" id="cat-id' + counter + '" name="cat-id' + counter + '" value="" />' +
                '<input type="hidden" class="lines" id="line-number' + counter + '" name="line-number' + counter + '" value="" />' +
                '</td>' +
                            '</tr>';


        $("#invoice_body").append(newRow);


        var image_container = '#inv-img' + counter;
        $(image_container).attr("src", image);

        var name_container = '#cat-name' + counter;
        $(name_container).val(name);

        var price_container = '#cat-price' + counter;
        $(price_container).val(price);

        var qty_container = '#cat-qty' + counter;

        // Check if quantity has any value.
       // var qty_input_field = $("*[data-qty-id=" + id + "]");
        var qty_input_field = $(item).parent().find("*[data-qty-id=" + id + "]");
        var qty_input_selected = qty_input_field.val();

        // If it does not have value, set to 1
        if (qty_input_selected == 0){
          $(qty_container).val(1);
        }

        // Else get value and set it and call function
        else{
          $(qty_container).val(qty_input_selected);
          //qty_input_field = $(qty_container);
          //console.log(qty_input_field);
          //update_quantity_on_selected_item(qty_input_field);
        }


        var total_container = '#cat-total' + counter;
        $(total_container).val(price);

        var id_container = '#cat-id' + counter;
        $(id_container).val(id);
        counter++;

      //Lets create an array
      var sort_inv = $('.inv-row').sort(sortIt);
      //sort_inv.each(function() {alert('Salams');});
      $('#invoice_body').html(sort_inv);

      added_items_array.push(id);
      } //ends if added item is new to the invoice
      else{
        alert('Item already added. To increase, update the quantity field');
      }
    }
    //update_totals();

    //add_summary();


    var row_to_change = $("*[data-ids=" + id + "]");
    var selected_quantity_input = $(row_to_change).find(".qty_field");
    update_quantity_on_selected_item(selected_quantity_input);


  }

  function sortIt(a,b){
      //alert('called');
      //var firstPrice = a.find('#cat-price1');
      //alert('hey');
      //console.log(firstPrice.val());
      //var secondPrice =  b.find('.prices').val();
      //alert(firstPrice.val());
        var an = parseInt(a.getAttribute('data-name'));
        var bn = parseInt(b.getAttribute('data-name'));

        if(an > bn) {
          return 1;
        }
        if(an < bn) {
          return -1;
        }
        return 0;
    }

  function add_summary(){
    // Add Invoice Summary
    // Get All Invoice Rows
    var all_rows = $('.inv-row');
    // Create a new array with just prices
    var prices_summary = new Array();
    $.each(all_rows, function(index, value){
      // We only want to add the row if it is Active
      var row_is_active = value.getAttribute('data-active');
      //alert(row_is_active);
      if (row_is_active == 'true'){
        var the_quantity = value.getAttribute('data-qtys');
        var override = value.getAttribute('data-override');
      if ( override == 0 ){
        for (var i = 0; i < the_quantity; i++){
          prices_summary.push(value.getAttribute('data-name'));
        }
      }
      else{
        for (var i = 0; i < the_quantity; i++){
        prices_summary.push(value.getAttribute('data-override'));
        }
      }
      }
    });

    prices_summary = array_count_values(prices_summary);

    $('#summary').html('<tr id="summaryHeader"><th style="width:33%">Cat Value</th><th style="width:33%">Count</th><th style="width:33%">Total</th></tr>');

    var sum_contents = '';

    $.each(prices_summary, function(index, value){
      sum_contents += '<tr><td>'+ index +'</td><td>' + value +'</td><td>' + index*value +'</td></tr>';
    });

    $('#summaryHeader').after(sum_contents);


  }

  function array_count_values (array) { // eslint-disable-line camelcase
  //  discuss at: http://locutus.io/php/array_count_values/
  // original by: Ates Goral (http://magnetiq.com)
  // improved by: Michael White (http://getsprink.com)
  // improved by: Kevin van Zonneveld (http://kvz.io)
  //    input by: sankai
  //    input by: Shingo
  // bugfixed by: Brett Zamir (http://brett-zamir.me)
  //   example 1: array_count_values([ 3, 5, 3, "foo", "bar", "foo" ])
  //   returns 1: {3:2, 5:1, "foo":2, "bar":1}
  //   example 2: array_count_values({ p1: 3, p2: 5, p3: 3, p4: "foo", p5: "bar", p6: "foo" })
  //   returns 2: {3:2, 5:1, "foo":2, "bar":1}
  //   example 3: array_count_values([ true, 4.2, 42, "fubar" ])
  //   returns 3: {42:1, "fubar":1}
  var tmpArr = {}
  var key = ''
  var t = ''
  var _getType = function (obj) {
    // Objects are php associative arrays.
    var t = typeof obj
    t = t.toLowerCase()
    if (t === 'object') {
      t = 'array'
    }
    return t
  }
  var _countValue = function (tmpArr, value) {
    if (typeof value === 'number') {
      if (Math.floor(value) !== value) {
        return
      }
    } else if (typeof value !== 'string') {
      return
    }
    if (value in tmpArr && tmpArr.hasOwnProperty(value)) {
      ++tmpArr[value]
    } else {
      tmpArr[value] = 1
    }
  }
  t = _getType(array)
  if (t === 'array') {
    for (key in array) {
      if (array.hasOwnProperty(key)) {
        _countValue.call(this, tmpArr, array[key])
      }
    }
  }
  return tmpArr
}

</script>
    <!-- page specific scripts -->
        <!-- page libs -->
