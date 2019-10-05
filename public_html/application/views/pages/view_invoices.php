<style type="text/css">
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

            <h2 class="page-title">View Invoices <small></small></h2><div class="row">
            <div class="col-md-12">
                <section class="widget">
                    <header>
                    </header>
                    <div class="body">
                       <?php
                       if ($this->session->flashdata('notice')) {
                           echo('<span class="label label-important">' . $this->session->flashdata('notice'));
                       } ?></span>

                        <section class="widget">
            <header>
            </header>
            <div class="body">
                <div class="mt">
                    <div id="datatable-table_wrapper" class="dataTables_wrapper form-inline no-footer">
                       <table id="datatable-table" class="table table-striped table-hover dataTable no-footer" role="grid" aria-describedby="datatable-table_info">
                        <thead>
                        <tr role="row">
                        <th class="sorting_desc" tabindex="0" aria-controls="datatable-table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Id: activate to sort column descending" style="width:4%">INV#</th>
                        <th class="" tabindex="0" aria-controls="datatable-table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Id: activate to sort column descending" style="">Date</th>
                        <th class="hidden-xs sorting" tabindex="0" aria-controls="datatable-table" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width:30%">Customer</th>
                        <th class="hidden-xs sorting" tabindex="0" aria-controls="datatable-table" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width:30%">Staff</th>
                        <th class="hidden-xs sorting" tabindex="0" aria-controls="datatable-table" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width:30%">Qty</th>
                        <th class="no-sort hidden-xs sorting_disabled" rowspan="1" colspan="1" aria-label="Info" style="width:20%">Total</th>
                        <th class="hidden-xs sorting" tabindex="0" aria-controls="datatable-table" rowspan="1" colspan="1" aria-label="Description: activate to sort column ascending" style="width: 10%;">Status</th>
                        <th class="no-sort sorting_disabled" rowspan="1" colspan="1" aria-label="Status" style="width: 15%;">Operations</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php if ($invoices == false) {
                            echo('<span class="label label-important">No invoices have been entered.</span><br /><br />');
                        } else {
                            foreach ($invoices as $invoice) {
                                echo ('<tr role="row" class="odd">
							<td class="sorting_1">');
                                echo $invoice->purchase_id;
                                echo ('</td>
                            <td class="sorting_1">');
                                echo $invoice->date;
                                echo ('</td>
                            <td><span class="fw-semi-bold">');
                                echo $invoice->customer_name;
                                echo ('</span></td>
							<td><span class="fw-semi-bold">');
                                echo $invoice->admin_id;
                                echo ('</span></td>
							<td><span class="fw-semi-bold">');
                                echo $invoice->qty;
                                echo ('</span></td>
                            <td class="hidden-xs">
                            <span class="fw-semi-bold">');
                                echo $invoice->Total;
                                echo '</span></td>';
                                echo '<td class="hidden-xs">';
                                echo $invoice->status;
                                echo '</td>
                            <td class="width-200">
							<a href="';
                                echo (site_url() .'/pages/view/view_invoice/' . $invoice->purchase_id);
                                echo '"><button class="btn btn-success inv-button">View</button></a>';


                                if ($this->session->userdata('user_type') == 'admin') {
                                    echo '<a href="';
                                    echo (site_url() .'/pages/view/edit_invoice/' . $invoice->purchase_id);
                                    echo '"><button class="btn btn-success inv-button" style="background-color:#13a148">Edit</button></a>';
                                }

                                echo '<a href="';
                                echo (site_url() .'/pages/view/email_invoice/' . $invoice->purchase_id . '/' . $invoice->customer_id);
                                echo '"><button class="btn btn-success inv-button" style="background-color:#0f7d38">Email</button></a>';

                                echo '<a href="';
                                echo (site_url() .'/pdf_contr/generate_pdf_report/' . $invoice->purchase_id);
                                echo '"><button class="btn btn-success inv-button" style="background-color:#41ce75">Download</button></a>';

                                if ($this->session->userdata('user_type') == 'admin') {
                                    echo '<button class="btn btn-success inv-button" data-toggle="modal" data-target="#myModal_' . $invoice->purchase_id;
                                    echo '" style="background-color:#f31a1a">Delete</button>';

                                    echo '</td>';

                                    echo '<div id="myModal_';
                                    echo $invoice->purchase_id;
                                    echo '" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title" id="myModalLabel">Are you sure you want to delete this invoice?</h4>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>';
                                    echo '<a href="';
                                    echo (site_url() .'/invoicing/delete_invoice/' . $invoice->purchase_id);
                                    echo '"><button type="button" class="btn btn-primary" style="margin-left:20px">Yes</button></a>
                                    </div>

                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->';
                                } // end if statement
                            } //endloop
                        } //end foreach
                        ?>

                       </tbody>

                    </table>
                    <?php echo '<script>var elems = Array.prototype.slice.call(document.querySelectorAll(".js-switch"));
    elems.forEach(function(html) {
								  var switchery = new Switchery(html, { disabledOpacity : 1 });
});</script>'; ?>
                    </div>
                </div>
            </div>
        </section>

                    </div>
                </section>
            </div>
        </div>

        </div>
</div>

<script type="text/javascript">
    $(window).load(function(){$('#datatable-table').DataTable({
        "order": [[ 0, "desc" ]]
    });
    $('input[type=search]').addClass("form-control ml-sm");
    $('select').addClass("btn dropdown-toggle btn-default");
    });

</script>
