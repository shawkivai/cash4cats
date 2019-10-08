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
    <table id="datatable-table1" class="table table-striped table-hover dataTable no-footer"
      role="grid" aria-describedby="datatable-table_info">
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
      <?php 
        $gst_exp_total = 0.00;
        $super_exp_total = 0.00;
        $tax_exp_total = 0.00;
        $total_exp_amount = 0.00;
        if (isset($expenses)) :
            foreach ($expenses as $exp) : ?>
                <tr>
                <th><?php echo substr($exp->date, 0, 10); ?></th>
                <th><?php echo $exp->name; ?></th>
                <th><?php $this_exp = ($exp->amount_ini == 0) ? $exp->amount : $exp->amount_ini;
                echo $this_exp; ?></th>
                <th><?php echo $exp->gst; ?></th>
                <th><?php echo $exp->super; ?></th>
                <th><?php echo $exp->amount; ?></th>
                </tr>
                <?php 
                  $gst_exp_total += $exp->gst;
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
          <?php 
            $total_revenue = 0.00;
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
          $total_rollover_gst = isset($total_rollover_gst) && !empty($total_rollover_gst) ? $total_rollover_gst : 0;
          $total_revenue = isset($total_revenue) && !empty($total_revenue) ? $total_revenue : 0;
          $total_buy = isset($total_buy) && !empty($total_buy) ? $total_buy : 0;
          $total_rollover = isset($total_rollover) && !empty($total_rollover) ? $total_rollover : 0;
          $gst_income = round($total_revenue/11, 2);
          $revenue_gst = $gst_income + $total_rollover_gst;
          $buy_gst = round($total_buy/11, 2);
          $gst_final = $revenue_gst + $gst_exp_total - $buy_gst; 
        ?>
                                        


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
