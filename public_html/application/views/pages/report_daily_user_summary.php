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


<style type="text/css">
    .dataTables_filter{
        float: right;
    }
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
    .width-200{width:200px;}.dataTables_paginate{float:right;text-align:right;padding-top:0.25em}.dataTables_wrapper .dataTables_paginate .paginate_button{box-sizing:border-box;display:inline-block;min-width:1.5em;padding:0.5em 1em;margin-left:2px;text-align:center;text-decoration:none !important;cursor:pointer;*cursor:hand;color:#333 !important;border:1px solid transparent;border-radius:2px}.dataTables_wrapper .dataTables_paginate .paginate_button.current,.dataTables_wrapper .dataTables_paginate .paginate_button.current:hover{color:#333 !important;background-color:#eeeeee;.dataTables_wrapper .dataTables_paginate .paginate_button.disabled,.dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover,.dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active{cursor:default;color:#666 !important;border:1px solid transparent;background:transparent;box-shadow:none}.dataTables_wrapper .dataTables_paginate .paginate_button:hover{color:white !important;border:1px solid #111;background-color:#585858;background:-webkit-gradient(linear, left top, left bottom, color-stop(0%, #585858), color-stop(100%, #111));background:-webkit-linear-gradient(top, #585858 0%, #111 100%);background:-moz-linear-gradient(top, #585858 0%, #111 100%);background:-ms-linear-gradient(top, #585858 0%, #111 100%);background:-o-linear-gradient(top, #585858 0%, #111 100%);background:linear-gradient(to bottom, #585858 0%, #111 100%)}.dataTables_wrapper .dataTables_paginate .paginate_button:active{outline:none;background-color:#2b2b2b;background:-webkit-gradient(linear, left top, left bottom, color-stop(0%, #2b2b2b), color-stop(100%, #0c0c0c));background:-webkit-linear-gradient(top, #2b2b2b 0%, #0c0c0c 100%);background:-moz-linear-gradient(top, #2b2b2b 0%, #0c0c0c 100%);background:-ms-linear-gradient(top, #2b2b2b 0%, #0c0c0c 100%);background:-o-linear-gradient(top, #2b2b2b 0%, #0c0c0c 100%);background:linear-gradient(to bottom, #2b2b2b 0%, #0c0c0c 100%);box-shadow:inset 0 0 3px #111}.dataTables_wrapper .dataTables_paginate .ellipsis{padding:0 1em}.dataTables_wrapper .dataTables_processing{position:absolute;top:50%;left:50%;width:100%;height:40px;margin-left:-50%;margin-top:-25px;padding-top:20px;text-align:center;font-size:1.2em;background-color:white;background:-webkit-gradient(linear, left top, right top, color-stop(0%, rgba(255,255,255,0)), color-stop(25%, rgba(255,255,255,0.9)), color-stop(75%, rgba(255,255,255,0.9)), color-stop(100%, rgba(255,255,255,0)));background:-webkit-linear-gradient(left, rgba(255,255,255,0) 0%, rgba(255,255,255,0.9) 25%, rgba(255,255,255,0.9) 75%, rgba(255,255,255,0) 100%);background:-moz-linear-gradient(left, rgba(255,255,255,0) 0%, rgba(255,255,255,0.9) 25%, rgba(255,255,255,0.9) 75%, rgba(255,255,255,0) 100%);background:-ms-linear-gradient(left, rgba(255,255,255,0) 0%, rgba(255,255,255,0.9) 25%, rgba(255,255,255,0.9) 75%, rgba(255,255,255,0) 100%);background:-o-linear-gradient(left, rgba(255,255,255,0) 0%, rgba(255,255,255,0.9) 25%, rgba(255,255,255,0.9) 75%, rgba(255,255,255,0) 100%);background:linear-gradient(to right, rgba(255,255,255,0) 0%, rgba(255,255,255,0.9) 25%, rgba(255,255,255,0.9) 75%, rgba(255,255,255,0) 100%)}.dataTables_wrapper .dataTables_length,.dataTables_wrapper .dataTables_filter,.dataTables_wrapper .dataTables_info,.dataTables_wrapper .dataTables_processing,.dataTables_wrapper .dataTables_paginate{color:#333}.dataTables_wrapper .dataTables_scroll{clear:both}.dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody{*margin-top:-1px;-webkit-overflow-scrolling:touch}.dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody th,.dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody td{vertical-align:middle}.dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody th>div.dataTables_sizing,.dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody td>div.dataTables_sizing{height:0;overflow:hidden;margin:0 !important;padding:0 !important}.dataTables_wrapper.no-footer .dataTables_scrollBody{border-bottom:1px solid #111}.dataTables_wrapper.no-footer div.dataTables_scrollHead table,.dataTables_wrapper.no-footer div.dataTables_scrollBody table{border-bottom:none}.dataTables_wrapper:after{visibility:hidden;display:block;content:"";clear:both;height:0}@media screen and (max-width: 767px){.dataTables_wrapper .dataTables_info,.dataTables_wrapper .dataTables_paginate{float:none;text-align:center}.dataTables_wrapper .dataTables_paginate{margin-top:0.5em}}@media screen and (max-width: 640px){.dataTables_wrapper .dataTables_length,.dataTables_wrapper .dataTables_filter{float:none;text-align:center}.dataTables_wrapper .dataTables_filter{margin-top:0.5em}

</style>

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
