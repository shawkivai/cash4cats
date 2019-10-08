<?php
 $pt_sum = 0;
 $pd_sum = 0;
 $rh_sum = 0;
 $qty_sum = 0;
 $buy_sum = 0;
 $sell_sum = 0;
 $profit_sum = 0;
 $profit_sum_s = 0;
 $profit_s = 0;
 $gst_sum = 0;
 $customer_array = array();
 $price_array = array();
 $sales_array = array();
 $inv_calc = 0;
 $date_s = 0;
 $business_s = 0;
 $comm_s = 0;
 $new_list = array();
?>

    <h2 class="page-title">User Summary Report - <?php echo $staff; ?> <small></small></h2>

    <div class="row">

    <div class="col-md-12">
        <section class="widget">
            <header>
            </header>
            <div class="body">
                <?php
                if ($this->session->flashdata('notice')) {
                    echo '<span class="label label-important">' . $this->session->flashdata('notice');
                } ?></span>

                <section class="widget">
    <header>
    </header>
    <div class="body">
        <div class="mt">
            <h1>Summary of Sales - <?php echo $staff; ?> </h1>
            <div id="datatable-table_wrapper" class="dataTables_wrapper form-inline no-footer">
                <table id="datatable-table_2" class="table table-striped table-hover dataTable no-footer" role="grid" aria-describedby="datatable-table_info">
                <thead>
                <tr role="row">

                <th class="sorting_desc" tabindex="0" aria-controls="datatable-table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Id: activate to sort column descending" style="width:12%">DATE</th>

                <th class="hidden-xs sorting" tabindex="0" aria-controls="datatable-table" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width:8%">INV#</th>



                <th class="hidden-xs sorting" tabindex="0" aria-controls="datatable-table" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width:8%">CUSTOMER</th>

                <th class="no-sort hidden-xs sorting_disabled" rowspan="1" colspan="1" aria-label="Info" style="width:8%">AMOUNT</th>

                <th class="hidden-xs sorting" tabindex="0" aria-controls="datatable-table" rowspan="1" colspan="1" aria-label="Description: activate to sort column ascending" style="width:5%;">PROCESSED BY</th>
                </tr>
                </thead>
                <tbody>
                        <?php if ($report_items == false) : ?>
                    <span class="label label-important">No invoices have been entered.</span><br /><br />

                        <?php else : ?>
                                <?php
                                foreach ($report_items as $report_item) : ?>
                                            <?php
                                            if (array_key_exists($report_item->business_name, $customer_array)) {
                                                    $customer_array[$report_item->business_name] = $report_item->QTY + $customer_array[$report_item->business_name];
                                            } else {
                                                $customer_array[$report_item->business_name] = $report_item->QTY;
                                            }

                                            for ($i=0; $i<$report_item->QTY; $i++) {
                                                $price_array[] = $report_item->PRICE;
                                            }

                                            if ($inv_calc != $report_item->purchase_id) {
                                                $profit_sum_s = 0;
                                            }
                                            $profit_s = $report_item->value - $report_item->PRICE;
                                            $profit_s = $profit_s*$report_item->QTY;
                                            $profit_sum_s += $profit_s;
                                            $profit_sum_s = round($profit_sum_s, 2);
                            //error_log($profit_s);

                                            if ($report_item->commission == 1) {
                                                $comm_s = "Staff";
                                            } elseif ($report_item->commission) {
                                                $comm_s = "Staff & Admin";
                                            } elseif ($report_item->commission) {
                                                $comm_s = "Admin";
                                            } else {
                                                $comm_s = "None Selected";
                                            }

                                            $sales_array[$report_item->purchase_id] = array($report_item->date, $report_item->business_name, $comm_s, $report_item->Total);
                                            $inv_calc = $report_item->purchase_id;

                                            ?>
                                <?php endforeach; ?>

                                <?php foreach ($sales_array as $key => $value) : ?>
                        <tr role="row" class="odd">
                            <td class=""><?php echo $value[0]; ?></td>
                            <td class=""><?php echo $key; ?></td>
                            <td class=""><?php echo $value[1]; ?></td>
                            <td class=""><?php echo $value[3]; ?></td>
                            <td class=""><?php echo $value[2]; ?></td>
                        </tr>
                                <?php endforeach ?>
                        <?php endif; ?>
                </tbody>
                </table>
            </div>
            <hr style="clear:right" />
            <h1>Cats per Customer - <?php echo $staff; ?> </h1>

                <div id="datatable-table_wrapper" class="dataTables_wrapper form-inline no-footer">
                <table id="datatable-table_3" class="table table-striped table-hover dataTable no-footer" role="grid" aria-describedby="datatable-table_info">
                <thead>
                <tr role="row">

                <th class="sorting_desc" tabindex="0" aria-controls="datatable-table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Id: activate to sort column descending" style="width:50%">Customer</th>

                <th class="hidden-xs sorting" tabindex="0" aria-controls="datatable-table" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width:50%"># of CATs purchased</th>


                </tr>
                </thead>
                <tbody>
                <?php
                    //$client_count = array_count_values($customer_array);
                ?>
                    <?php foreach ($customer_array as $key => $value) : ?>
                    <tr role="row" class="odd">
                            <td class=""><?php echo $key; ?></td>
                            <td class=""><?php echo $value; ?></td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
                </table>
            </div>

            <hr style="clear:right" />
            <h1>Cats per Price Group - <?php echo $staff; ?> </h1>
                <div id="datatable-table_wrapper" class="dataTables_wrapper form-inline no-footer">
                <table id="datatable-table_4" class="table table-striped table-hover dataTable no-footer" role="grid" aria-describedby="datatable-table_info">
                <thead>
                <tr role="row">

                <th class="sorting_desc" tabindex="0" aria-controls="datatable-table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Id: activate to sort column descending" style="width:50%">Price</th>

                <th class="hidden-xs sorting" tabindex="0" aria-controls="datatable-table" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width:50%"># of CATs purchased</th>


                </tr>
                </thead>
                <tbody>
                <?php
                    $price_count = array_count_values($price_array);
                ?>
                    <?php foreach ($price_count as $key => $value) : ?>
                    <tr role="row" class="odd">
                            <td class=""><?php echo $key; ?></td>
                            <td class=""><?php echo $value; ?></td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
                </table>
            </div>



            <hr style="clear:right" />

        </div>
    </div>
        </section>
    </div>
</div>

</div>


<script type="text/javascript">
    $(window).load(function(){
        $('#datatable-table').DataTable({
        "order": [[ 0, "desc" ]]
    });
        $('#datatable-table_2').DataTable({
        "order": [[ 0, "desc" ]]
    });
        $('#datatable-table_3').DataTable({
        "order": [[ 0, "desc" ]]
    });
        $('#datatable-table_4').DataTable({
        "order": [[ 0, "desc" ]]
    });
    $('input[type=search]').addClass("form-control ml-sm");
    $('select').addClass("btn dropdown-toggle btn-default");
    });

</script>
