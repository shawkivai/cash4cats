<?php
 $pt_sum = 0;
 $pd_sum = 0;
 $rh_sum = 0;
 $qty_sum = 0;
 $buy_sum = 0;
 $sell_sum = 0;
 $profit_sum = 0;
 $gst_sum = 0;
 $new_list = array();
?>


<style type="text/css">
    hr {border-top: 5px solid #eeeeee; color: black;}
    .inv-button { margin-bottom:5px; margin-right:5px; }
body {
    background-color: #000000;
}
    #datatable-table_filter{
    float: right;
    margin-top: -30px;
    margin-bottom: 15px;
    }
  .pointy{
    cursor: pointer;
  }
  #datatable-table1_info{
    padding-bottom: 20px;
  }
  #datatable-table1_paginate{
    top: -34px;
position: relative;
  }
    .width-200{width:200px;}
  .dataTables_paginate{float:right;text-align:right;padding-top:0.25em} .dataTables_wrapper .dataTables_paginate .paginate_button{box-sizing:border-box;display:inline-block;min-width:1.5em;padding:0.5em 1em;margin-left:2px;text-align:center;text-decoration:none !important;cursor:pointer;*cursor:hand;color:#333 !important;border:1px solid transparent;border-radius:2px}
  .dataTables_wrapper .dataTables_paginate .paginate_button.current,.dataTables_wrapper .dataTables_paginate .paginate_button.current:hover{color:#333 !important;
    background-color:#eeeeee;
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled,.dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover,.dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active{cursor:default;color:#666 !important;border:1px solid transparent;background:transparent;box-shadow:none}.dataTables_wrapper .dataTables_paginate .paginate_button:hover{color:white !important;border:1px solid #111;background-color:#585858;background:-webkit-gradient(linear, left top, left bottom, color-stop(0%, #585858), color-stop(100%, #111));background:-webkit-linear-gradient(top, #585858 0%, #111 100%);background:-moz-linear-gradient(top, #585858 0%, #111 100%);background:-ms-linear-gradient(top, #585858 0%, #111 100%);background:-o-linear-gradient(top, #585858 0%, #111 100%);background:linear-gradient(to bottom, #585858 0%, #111 100%)}.dataTables_wrapper .dataTables_paginate .paginate_button:active{outline:none;background-color:#2b2b2b;background:-webkit-gradient(linear, left top, left bottom, color-stop(0%, #2b2b2b), color-stop(100%, #0c0c0c));background:-webkit-linear-gradient(top, #2b2b2b 0%, #0c0c0c 100%);background:-moz-linear-gradient(top, #2b2b2b 0%, #0c0c0c 100%);background:-ms-linear-gradient(top, #2b2b2b 0%, #0c0c0c 100%);background:-o-linear-gradient(top, #2b2b2b 0%, #0c0c0c 100%);background:linear-gradient(to bottom, #2b2b2b 0%, #0c0c0c 100%);box-shadow:inset 0 0 3px #111}.dataTables_wrapper .dataTables_paginate .ellipsis{padding:0 1em}.dataTables_wrapper .dataTables_processing{position:absolute;top:50%;left:50%;width:100%;height:40px;margin-left:-50%;margin-top:-25px;padding-top:20px;text-align:center;font-size:1.2em;background-color:white;background:-webkit-gradient(linear, left top, right top, color-stop(0%, rgba(255,255,255,0)), color-stop(25%, rgba(255,255,255,0.9)), color-stop(75%, rgba(255,255,255,0.9)), color-stop(100%, rgba(255,255,255,0)));background:-webkit-linear-gradient(left, rgba(255,255,255,0) 0%, rgba(255,255,255,0.9) 25%, rgba(255,255,255,0.9) 75%, rgba(255,255,255,0) 100%);background:-moz-linear-gradient(left, rgba(255,255,255,0) 0%, rgba(255,255,255,0.9) 25%, rgba(255,255,255,0.9) 75%, rgba(255,255,255,0) 100%);background:-ms-linear-gradient(left, rgba(255,255,255,0) 0%, rgba(255,255,255,0.9) 25%, rgba(255,255,255,0.9) 75%, rgba(255,255,255,0) 100%);background:-o-linear-gradient(left, rgba(255,255,255,0) 0%, rgba(255,255,255,0.9) 25%, rgba(255,255,255,0.9) 75%, rgba(255,255,255,0) 100%);background:linear-gradient(to right, rgba(255,255,255,0) 0%, rgba(255,255,255,0.9) 25%, rgba(255,255,255,0.9) 75%, rgba(255,255,255,0) 100%)}.dataTables_wrapper .dataTables_length,.dataTables_wrapper .dataTables_filter,.dataTables_wrapper .dataTables_info,.dataTables_wrapper .dataTables_processing,.dataTables_wrapper .dataTables_paginate{color:#333}.dataTables_wrapper .dataTables_scroll{clear:both}.dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody{*margin-top:-1px;-webkit-overflow-scrolling:touch}.dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody th,.dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody td{vertical-align:middle}.dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody th>div.dataTables_sizing,.dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody td>div.dataTables_sizing{height:0;overflow:hidden;margin:0 !important;padding:0 !important}.dataTables_wrapper.no-footer .dataTables_scrollBody{border-bottom:1px solid #111}.dataTables_wrapper.no-footer div.dataTables_scrollHead table,.dataTables_wrapper.no-footer div.dataTables_scrollBody table{border-bottom:none}.dataTables_wrapper:after{visibility:hidden;display:block;content:"";clear:both;height:0}@media screen and (max-width: 767px){.dataTables_wrapper .dataTables_info,.dataTables_wrapper .dataTables_paginate{float:none;text-align:center}.dataTables_wrapper .dataTables_paginate{margin-top:0.5em}}@media screen and (max-width: 640px){.dataTables_wrapper .dataTables_length,.dataTables_wrapper .dataTables_filter{float:none;text-align:center}.dataTables_wrapper .dataTables_filter{margin-top:0.5em}

</style>

            <h2 class="page-title">Profit & Loss Query <small></small></h2>


        

         <div class="row">

            <div class="col-md-12">
                <section class="widget" style="">
                    <header onClick="expand(this)" class="pointy hidden_row">
              <h4>
                  <i class="fa fa-align-left"></i>
                 Expenses
              </h4>
              <div class="widget-controls" >
                  <a data-widgster="collapse" title="Collapse" href="#" style="display: inline;"><i class="glyphicon glyphicon-chevron-down"></i></a>
                  <a data-widgster="expand" title="Expand" href="#" style="display: none;"><i class="glyphicon glyphicon-chevron-up"></i></a>
              </div>
            </header>
            <div class="body">
              <h2>Expenses</h2>
                <div id="datatable-table_wrapper1" class="dataTables_wrapper form-inline no-footer">
                       <table id="datatable-table1" class="table table-striped table-hover dataTable no-footer" role="grid" aria-describedby="datatable-table_info">
                        <thead>
                          <tr>
                            <th>Date</th>
                            <th>Paid to:</th>
                            <th>Amount</th>
                            <th>GST</th>
                            <th>Super</th>
                            <th>Total</th>
                          </tr>
                        </thead>
                      <tbody>
                        <?php $gst_exp_total = 0.00;
                        $super_exp_total = 0.00;
                        $tax_exp_total = 0.00;
                        $total_exp_amount = 0.00; ?>
                        <?php if (isset($expenses)) : ?>
                            <?php foreach ($expenses as $exp) : ?>
                            <tr>
                              <th><?php echo substr($exp->date, 0, 10); ?></th>
                              <th><?php echo $exp->name; ?></th>
                              <th><?php $this_exp = ($exp->amount_ini == 0) ? $exp->amount : $exp->amount_ini;
                                echo $this_exp; ?></th>
                              <th><?php echo $exp->gst; ?></th>
                              <th><?php echo $exp->super; ?></th>
                              <th><?php echo $exp->amount; ?></th>
                            </tr>
                                <?php $gst_exp_total += $exp->gst;
                                $super_exp_total += $exp->super;
                                $total_exp_amount += $exp->amount; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                      </tbody>
                      <tr>
                          <th><strong>TOTALS:</strong></th>
                          <th></th>
                          <th><strong>$<?php echo $gst_exp_total; ?></strong></th>
                          <th><strong>$<?php echo $super_exp_total; ?></strong></th>
                          <th><strong>$<?php echo $total_exp_amount; ?></strong></th>
                        </tr>
                    </table>
                  </div>
            </div>
          </section>
        </div>
      </div>

            <div class="row">

            <div class="col-md-12">
                <section class="widget hide_start" style="">
                    <header onClick="expand(this)" class="pointy hidden_row">
              <h4>
                  <i class="fa fa-align-left"></i>
                 Shipments
              </h4>
              <div class="widget-controls" >
                  <a data-widgster="collapse" title="Collapse" href="#" style="display: inline;"><i class="glyphicon glyphicon-chevron-down"></i></a>
                  <a data-widgster="expand" title="Expand" href="#" style="display: none;"><i class="glyphicon glyphicon-chevron-up"></i></a>
              </div>
            </header>
            <div class="body">
              <h2>Shipments</h2>
                <div class="mt">
                    <div id="datatable-table_wrapper" class="dataTables_wrapper form-inline no-footer">
                       <table id="datatable-table" class="table table-striped table-hover dataTable no-footer" role="grid" aria-describedby="datatable-table_info">
                        <thead>
                        <tr role="row">

                        <th class="sorting_desc" tabindex="0" aria-controls="datatable-table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Id: activate to sort column descending" style="width:8%">SHIPMENT ID</th>

                        <th class="hidden-xs sorting" tabindex="0" aria-controls="datatable-table" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="">FROM</th>

                        <th class="hidden-xs sorting" tabindex="0" aria-controls="datatable-table" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="">TO</th>

                        <th class="no-sort hidden-xs sorting_disabled" rowspan="1" colspan="1" aria-label="Info" style="">CAT. QTY</th>

                        <th class="hidden-xs sorting" tabindex="0" aria-controls="datatable-table" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="">REVENUE</th>
                         <th class="" tabindex="0" aria-controls="datatable-table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Id: activate to sort column descending" style="">ROLLOVER AMOUNT</th>
                         <th class="no-sort hidden-xs sorting_disabled" rowspan="1" colspan="1" aria-label="Info" style="">TOTAL REVENUE</th>
                        <th class="no-sort hidden-xs sorting_disabled" rowspan="1" colspan="1" aria-label="Info" style="">BUY COST</th>
                        </tr>
                        </thead>
                        <tbody style="margin-top:10px">

                        <?php if (!$shipments) : ?>
                            <span class="label label-important">No shipments have been entered.</span><br /><br />

                        <?php else : ?>
                                        <?php $total_revenue = 0.00;
                                        $total_gst = 0.00;
                                        $total_rollover = 0.00;
                                        $total_rollover_gst = 0.00;
                                        $total_buy = 0.00; ?>
                                        <?php foreach ($shipments as $shipment) : ?>
                                <tr role="row" class="odd">
                                    <td class=""><?php echo $shipment->id; ?></td>
                                    <td class=""><?php $new_from = new DateTime($shipment->from_date);
                                    $new_from->modify('+1 day');
                                    $new_from = $new_from->format('Y-m-d H:i:s');
                                    echo $new_from; ?></td>
                                    <td class=""><?php echo $shipment->to_date; ?></td>
                                    <td class=""><?php echo $shipment->qty; ?></td>
                                    <td class=""><?php $total_revenue += ($shipment->actual_profit != 0.00 ) ? $revenue = $shipment->actual_profit : $revenue = $shipment->cat_sales;
                                    echo $revenue; ?></td>
                                    <td class=""><?php $total_rollover += $shipment->rollover;
                                    echo $shipment->rollover;  ?></td>
                                    <td class=""><?php echo ($revenue + $shipment->rollover);  ?></td>
                                    <td class=""><?php $total_buy += $shipment->expenses;
                                    echo $shipment->expenses; ?></td>
                </tr>
                                        <?php endforeach; ?>
                        <?php endif; ?>
                       </tbody>

                    </table>
                    </div>
                </div>
                   <div style="">
                      
                            <?php
                                $form_action = site_url() . '/pdf_contr/generate_profit_loss_pdf';
                            ?>
                </div>
                  </div>

                  <h1>Actual Totals</h1>
                   <table class="table table-striped table-hover dataTable no-footer">
                                <thead>
                                    <tr><th></th><th>Revenue</th><th>Rollover</th><th>Total Sell</th><th>Expenses</th><th>Total Buy</th><th>P/L inc GST</th><th>P/L ex GST</th></tr>
                                </thead>
                                    <?php

                                    $gst_income = round($total_revenue/11, 2);
                                    $revenue_gst = $gst_income + $total_rollover_gst;
                                    $buy_gst = round($total_buy/11, 2);
                                    $gst_final = $revenue_gst + $gst_exp_total - $buy_gst; ?>
                                                                    


                            <tr>
                                    <td><!-- Empty Cell --></td>
                                <td><!-- Revenue -->
                                $ <?php echo $total_revenue; ?>
                                  
                                </td>

                                <td><!-- Rollover -->
                                    $<?php echo $total_rollover; ?>
                                </td>

                                <td><!-- Actual Sell Price -->
                                    $<?php  echo ($revenue = $total_revenue + $total_rollover); ?>
                                </td>

                                <td><!-- Expenses -->
                                    $<?php  echo $total_exp_amount; ?>
                                </td>

                                <td><!-- Total Buy -->
                                    $<?php echo $total_buy; ?>
                                </td>

                                <td><!-- P/L inc GST -->
                                    $<?php $pl_inc_gst = $revenue - ($total_exp_amount + $total_buy);
                                    echo $pl_inc_gst;  ?>
                                </td>

                                <td><!-- P/L ex GST -->
                                    <strong>$<?php echo $pl_inc_gst - $gst_final; ?></strong>
                                </td>
                            </tr>
                            <tr>
                                    <td>GST</td>
                                    <td>$ <?php echo $gst_income ; ?></td>
                                    <td>$ <?php echo $total_rollover_gst; ?></td>
                                    <td>$ <?php echo $revenue_gst; ?></td>
                                    <td>$ <?php echo $gst_exp_total; ?></td>
                                    <td>$ <?php echo $buy_gst; ?></td>
                                    <td>TOTAL GST OWING = $<?php  echo $gst_final; ?></td>
                            </tr>
                    </table>
                  </section>
              </div>
          </div>
    </div>

<div class="row" style="max-width:100%">
    <div class="col-md-12">
           <section class="widget" style="height:50px;text-align: center">
                            <form method="get" action="<?php echo $form_action; ?>">                        
                            <div class="col-sm-2">
                        <input type="hidden" value="<?php echo $this->input->get('from'); ?>" name="from" />
                        <input type="hidden" value="<?php echo $this->input->get('to'); ?>" name="to" />
                                <input type="submit" class="form-control input-lg" value="Print" style="margin:0 auto"/>
                            </div>

                            </div>
                            </form>
                      </section>
                    </div>
                  </div>





<script type="text/javascript">
    $(window).load(function(){
        $('#datatable-table').DataTable({
        "order": [[ 0, "asc" ]] });
    $('#datatable-table1').DataTable({
        "order": [[ 0, "desc" ]] });

  

    $('input[type=search]').addClass("form-control ml-sm");
    $('select').addClass("btn dropdown-toggle btn-default");
    $('#from_date').datetimepicker({format: 'YYYY-MM-DD HH:mm'});
    $('#to_date').datetimepicker({format: 'YYYY-MM-DD HH:mm'});

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
</script>
