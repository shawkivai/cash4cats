<?php 
  $current_url = explode('/', current_url());
  $id_from_url = end($current_url);
  $purchase_id = isset($invoice->purchase_id) && !empty($invoice->purchase_id) ? $invoice->purchase_id : $id_from_url;
?>

<h2 class="page-title">Edit Invoice<small>

<?php if ($this->session->flashdata('notice')) {
      echo('<span class="label label-important">' . $this->session->flashdata('notice'));
      } 
      
?></span></small></h2>

          <div class="row" onClick="pageload()">

              <div class="col-lg-12">

              <form id="new-invoice" class="form-horizontal form-label-left" enctype="multipart/form-data" method="post" action="<?php echo (site_url() . '/invoicing/update_invoice') ?>">
              <section class="widget">

                  <header>
                      <?php if ($customers == false) : ?>
                          <span class="label label-important">
                          No Customers have been registered. 
                          Please register customers first before continuing
                          </span>
                      <?php endif; ?>
                      <h4><i class="fa fa-user"></i> Select Customer</h4>
                  </header>
                  <div class="body">

                      <fieldset>
                              <legend class="section"></legend>
                              <div class="form-group">
                                  <label for="customer" 
                                    class="control-label col-sm-2">
                                    Select Customer
                                  </label>
                                  <div class="col-sm-10">
                                      <select onChange="groupPrices(this)" 
                                              id="customer" name="customer" 
                                              data-style="btn-success" 
                                              data-width="80%" 
                                              class="select2 optionBox" >
                                          <option value="0" style="width:100%">
                                          </option>
                                          <?php foreach ($customers as $customer) : ?>
                                          <option value="<?php echo $customer->id ?>" style="width:100%" data-type="<?php echo $customer->customer_type; ?>"><?php echo $customer->business_name ?></option>
                                          <?php endforeach; ?>
                                      </select>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label for="comm" class="control-label col-sm-2">
                                    Processed By
                                  </label>
                                  <div class="col-sm-10">
                                      <select id="comm" name="comm" 
                                        data-style="btn-success" 
                                        data-width="80%" 
                                        required required="required" 
                                        data-parsley-trigger="change" 
                                        class="select2 form-control optionBox" >
                                          <option value="1" style="width:100%">\
                                          Staff</option>
                                          <option value="2" style="width:100%">
                                          Staff & Admin</option>
                                          <option value="3" style="width:100%">
                                          Admin</option>
                                      </select>
                                  </div>
                              </div>

                          </fieldset>
                          <script>$('#customer').val('<?php echo $invoice->customer_id ?>');
                                  $('#comm').val('<?php echo $invoice->commission; ?>');
                      </script>

                  </div>
              </section>

                <section class="widget">

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
                          <label for="pop_cats" class="control-label col-sm-2">
                            Popular Catalytic Converters for this Customer\
                          </label>
                          <div id="popular_cats" class="col-sm-10">
                              <p>Coming Soon...</p>
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
                    <label for="article-status" class="control-label col-sm-2">
                      Search for a Catalytic Converter
                    </label>
                    <div class="col-sm-10">
                        <input type="text" id="cat_search" name="cat_search" 
                        data-style="btn-success" data-width="80%" 
                        class="form-control" 
                        placeholder="Start searching for a cat here...">
                    </div>
                    <div class="col-sm-10 col-sm-offset-2" 
                      style="margin-top: 20px" id="show_searched_cats">
                    </div>
                  </div>                          

                  </div>
              </section>

              <section class="widget">

                  <header>
                      <h4><i class="fa fa-user">
                        </i> Selected Catalytic Converters
                      </h4>
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

                      <?php $count = 1; ?>
                      
                        <?php 
                        foreach ($rows as $row) : 
                            if (preg_match('/(\.jpg|\.png|\.bmp|\.jpeg)$/i', $row->image))
                            {
                                  $product_image = $row->image;
                            } else {
                                  $product_image = 'cat_img/no_image.jpg';
                            }
                        ?>

                          <tr data-name="<?php echo $row->PRICE; ?>" class="inv-row" id="row-id<?php echo $count; ?>">
                              <td class="hidden-xs">
                                    <img class="img-rounded" id="inv-img<?php echo $count ?>" src="<?php echo base_url() . $product_image; ?>" height="100px" />
                              </td>
                              <td>
                                  <input type="text"
                                        id="cat-name<?php echo $count ?>"
                                        name="cat-name<?php echo $count; ?>"
                                        class="form-control"
                                        value="<?php echo $row->name ?>"
                                        readonly>
                              </td>

                              <td> 
                                  <div class="input-group">
                                      <span class="input-group-addon">$</span>
                                      <input type="text" 
                                            value="<?php echo $row->PRICE; ?>" 
                                            id="cat-price<?php echo $count; ?>" 
                                            name="cat-price<?php echo $count; ?>"  
                                            class="form-control <?php echo ($row->OVERRIDE_PRICE == 0.00) ? '' : 'striked'; ?> "
                                            readonly>
                                  </div>
                                  <div class="input-group" style="margin-top:10px">
                                      <span class="input-group-addon">$</span>
                                  <input type="text" 
                                        value="<?php echo ($row->OVERRIDE_PRICE == 0.00) ? '' : $row->OVERRIDE_PRICE; ?>" 
                                        id="cat-price-override<?php echo $count; ?>" 
                                        name="cat-price-override<?php echo $count; ?>" data-over="<?php echo $count; ?>" 
                                        class="form-control override" 
                                        placeholder="Override Price" >   
                                  </div>
                                </td>


                              <td class="text-muted">
                                  <input type="text" value="<?php echo $row->QTY; ?>" id="cat-qty<?php echo $count; ?>" name="cat-qty<?php echo $count; ?>" data-qty="<?php echo $count; ?>"  class="form-control qty_field" >
                              </td>
                              <td class="text-muted">
                                  <input type="text" value="<?php echo $row->TOTAL_ROW; ?>" id="cat-total<?php echo $count; ?>" name="cat-total<?php echo $count; ?>"  class="form-control" readonly>
                              </td>
                              <td><a data-num="<?php echo $count; ?>" class="fa fa-times" onClick="removeRow(this)"></a>
                                  <input type="hidden" id="isActive<?php echo $count; ?>" name="isActive<?php echo $count; ?>" value="1" />
                                  <input type="hidden" id="item-id<?php echo $count; ?>" name="item-id<?php echo $count; ?>" value="<?php echo $row->ID; ?>" />
                                  <input type="hidden" id="cat-id<?php echo $count; ?>" name="cat-id<?php echo $count; ?>" value="<?php echo $row->PRODUCT; ?>" />
                                  <input type="hidden" class="lines" id="line-number<?php echo $count; ?>" name="line-number<?php echo $count; ?>" value="<?php echo $row->LINE_NUM; ?>" />
                              </td>
                          </tr>
                          <?php $count++; ?>
                      <?php endforeach; ?>


                          </tbody>

                      </table>

                              <div style="padding:20px"><h4 style="text-align: left;margin-top: 5px; font-weight:600; font-size:18px">INVOICE TOTAL: </h4>
                              <div class="input-group" style="margin-top:10px">
                                  <span class="input-group-addon">$</span><input value="<?php echo $invoice->Total;?>" type="text" id="total" name="total"  class="form-control input-lg" readonly></div>                                </div>
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
                                      <select id="inv-status" name="inv-status" data-style="btn-success" data-width="80%" class="select2 form-control">
                                          <option value="0" style="width:100%">Quote</option>
                                          <option value="1" style="width:100%">Unpaid</option>
                                          <option value="2" style="width:100%">Paid</option>
                                      </select>
                                  </div>
                              </div>

                          <script> $("#inv-status").val("<?php echo $invoice->status; ?>"); </script>
                              <div class="form-group">
                                  <label for="notes" class="control-label col-sm-2">Notes</label>
                                  <div class="col-sm-10">
                                      <div id="note_hold"><?php if ($notes != false) {
                                          echo $notes->note;
                                                          } ?></div><br />
                                      <textarea class="form-control" name="notes" id="notes"></textarea>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label for="images" class="control-label col-sm-2">Images</label>
                                  <div class="col-sm-10">
                                      <input type="file" class="" name="images1" id="images1" />
                                      <input type="file" class="" name="images2" id="images2" />
                                      <input type="file" class="" name="images3" id="images3" />
                                      <input type="file" class="" name="images4" id="images4" />
                                      <input type="file" class="" name="images5" id="images5" />
                                  </div>
                                  <?php if ($images != false) : ?>
                                  <div id="img_container">
                                      <?php foreach ($images as $image) : ?>
                                          <div class="thumbnail col-sm-3">
                                              <img src="<?php echo base_url() . 'inv_images/' . $purchase_id . '/' . $image->image; ?>">
                                          </div>

                                      <?php endforeach; ?>
                                  </div>
                                  <?php endif; ?>
                              </div>

                          </fieldset>
                          <input type="hidden" id="counter" name="counter" />
                          <input type="hidden" id="inv-id" name="inv-id" value="<?php echo $purchase_id; ?>" />
                          <div class="form-actions">
                              <div class="row">
                                <div class="col-sm-6 col-sm-offset-5">
                                      <button type="submit" class="btn btn-primary input-lg" onClick="before_submit()">Update Invoice</button>
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

$('#new-invoice').parsley();
  var customer_type;
var added_items_array = [];
var new_results;
var customer_id;
  var counter = <?php echo $count; ?>;


  window.onbeforeunload = function() {
  return "Leaving this page will reset the wizard";
};

$('#complete').change(function() {
  $('#submit-button').prop('disabled', function(i, v) { return !v; });
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

  $('#new-invoice').submit( function( event ) {
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

      function groupPrices(selected){
      customer_type = $(selected).find(':selected').data('type');
      var customer_id =  $(selected).find(':selected').val();
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

      groupAllPrices();
  }

function groupAllPrices(new_priced, results_exist){
  //console.log(new_priced);
  // console.log( new_priced[2]);
  var correct_price = 'price' + customer_type;
  var allPrices = $(".data-holder");
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

  function groupAjaxPrices(customer_id){
//console.log(customer_id);
var new_results = [];

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
        // console.log(results);
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

function groupPopPrices(){

  var c_price = 'price' + customer_type;
  var popPrices = $("#popular_cats .data-holder");
  //alert(c_price);

  popPrices.each(function() {
    //alert($(this).find("a").data(c_price));
    var correct_price_grouped = $(this).find("a").data(c_price);
    $(this).find("a").attr("data-price", correct_price_grouped);
    $(this).find(".price_holder").html(correct_price_grouped);
    //console.log($(this).find("a"));
  });
}

  function update_totals(){
      var running_total = 0;

      for (i=1; i <= counter-1; i++){
          var current_row_totals_box = '#cat-total' + i;
          var current_row_total = parseFloat( $(current_row_totals_box).val() );

          running_total += current_row_total;
      }

      running_total = round(running_total, 2);
      $('#total').val(running_total);
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
        update_quantity_on_selected_item
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
  var new_results = [];
  var customer_id =  <?php echo $invoice->customer_id; ?>;

  $("#popheader").click();
  $("#historyheader").click();

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
                  groupAjaxPrices(customer_id);
              }
          });
          }
          else{
        $("#show_all_cats").show();
              $("#show_searched_cats").empty();
              $("#show_searched_cats").hide();
          }
      });
      customer_type = $('#customer').find(':selected').data('type');
      groupAllPrices();
      //$('#customer').prop('disabled',false);


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
        //console.log(results);
          var results_exist;

            results = JSON.parse(JSON.stringify(results) );
          if (results.length > 0){

          for (i = 0; i < results.length; i++){
            var newId = results[i].cat_id;
            new_results[newId] = results[i];
            }

              results_exist = true;
          }
          else{
            results_exist = false;
          }


          groupAllPrices(new_results, results_exist);
        }

      });



  });

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
      $(total_to_delete).val(0);
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
