<style type="text/css">
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

            <h2 class="page-title">Override Price Log<small></small></h2><div class="row">
            <div class="col-md-12">
                <section class="widget">
                    <header>
                    </header>
                    <div class="body">
                       <?php
						if ($this->session->flashdata('notice'))
						{
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
                        <th>ID</th>
                        <th style="" class="sorting_disabled" tabindex="0" rowspan="" colspan="">Time</th>
                        <th class="sorting_disabled" tabindex="0" rowspan="" colspan="" aria-label="Name: activate to sort column ascending" style="">Customer</th>
												<th class="sorting_disabled" tabindex="0" aria-controls="datatable-table" rowspan="" colspan="" aria-label="Name: activate to sort column ascending" style="">Sold By</th>
                        <th class="sorting_disabled" tabindex="0" aria-controls="datatable-table" rowspan="" colspan="" aria-label="Name: activate to sort column ascending" style="">CAT</th>
                        <th class="sorting_disabled" rowspan="" colspan="" aria-label="Info" style="">Original Price</th>
                        <th class="sorting" tabindex="0" aria-controls="datatable-table" rowspan="" colspan="" aria-label="Description: activate to sort column ascending" style="">Entererd Price</th>
                        <th class=" sorting_disabled" tabindex="0" aria-controls="datatable-table" rowspan="" colspan="" aria-label="Date: activate to sort column ascending" style="">C4C Sell Price**</th>
                        <th class="no-sort sorting_disabled" rowspan="" colspan="" aria-label="Status" style="">Delete</th>
                        </tr>
                        </thead>
                        <tbody>

													<?php if ($log) : ?>
													<?php foreach ($log as $item) : ?>
													<tr>
													<th><?php echo $item->id; ?></th>
													<th class="sorting_disabled" tabindex="0" rowspan="" colspan=""><?php echo date( 'd/m/y - g:i a', strtotime($item->date_current) ) ?></th>
													<th class="sorting_disabled" tabindex="0" rowspan="" colspan="" aria-label="Name: activate to sort column ascending" style="width: ;">
													<?php echo $item->business_name; ?></th>
													<th class="sorting_disabled" tabindex="0" aria-controls="datatable-table" rowspan="" colspan="" aria-label="Name: activate to sort column ascending" style="width: ;"><?php echo $item->admin_id ?></th>
													<th class="sorting_disabled" tabindex="0" aria-controls="datatable-table" rowspan="" colspan="" aria-label="Name: activate to sort column ascending" style="width: ;">
														<?php
															echo $item->name;
														?>
													</th>
													<th class="sorting_disabled" rowspan="" colspan="" aria-label="Info" style="width: ;"><strong>$<span style="color:green"><?php echo $item->old_price ?></span></strong></th>
													<th class="sorting" tabindex="0" aria-controls="datatable-table" rowspan="" colspan="" aria-label="Description: activate to sort column ascending" style="width: ;"><strong>$<span style="color:red"><?php echo $item->price ?></span></strong></th>
													<th class=" sorting_disabled" tabindex="0" aria-controls="datatable-table" rowspan="" colspan="" aria-label="Date: activate to sort column ascending" style="width: ;"><strong>$
														<?php
															echo $item->value;
														 ?>
														</strong></th>
													<th class="no-sort sorting_disabled" rowspan="" colspan="" aria-label="Status" style="width: ;">
														<button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal_<?php echo $item->id ?>">Delete</button>

															<div id="myModal_<?php echo $item->id ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
																    <div class="modal-dialog">
																        <div class="modal-content">

																            <div class="modal-header">
																                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
																                <h4 class="modal-title" id="myModalLabel">Are you sure you want to delete this price?<br />It will no longer be saved for future reference.</h4>
																            </div>
																            <div class="modal-footer">
																                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
																								<a href="<?php echo (site_url() .'/invoicing/delete_override/' . $item->id) ?>">
																									<button type="button" class="btn btn-primary" style="margin-left:20px">Yes</button>
																								</a>
																            </div>

																        </div><!-- /.modal-content -->
																    </div>
																	</div><!-- /.modal-dialog -->

													</th>
												</tr>
													<?php endforeach; ?>

												<?php endif; ?>
                       </tbody>

                    </table>
                    </div>
										<strong>** C4C Sell Price is the current Cash4Cats sell price</strong>
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
	$(window).load(function(){$('#datatable-table').DataTable({"order": [[ 0, "desc" ]]});
	$('input[type=search]').addClass("form-control ml-sm");
	$('select').addClass("btn dropdown-toggle btn-default");
	});

</script>
