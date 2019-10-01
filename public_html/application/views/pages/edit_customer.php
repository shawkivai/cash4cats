<style type="text/css">
body {
	background-color: #000000;
}
.dataTables_filter{
    float: right;
}
#notes-table{
    color: black !important;
}
</style>

            <h2 class="page-title"><?php echo $customer->business_name; ?> - <small>View Customer</small></h2>

	<div class="row">
            <div class="col-md-7">
                <section class="widget">
                  <?php if ($this->session->flashdata('notice'))
						{
							echo('<span class="label label-important">' . $this->session->flashdata('notice'));
						} ?></span>
                    <header>
                        <h4><i class="fa fa-user"></i> Account Profile <small></small></h4>
                    </header>
                    <div class="body">
                        <form id="user-form" class="form-horizontal form-label-left" novalidate method="post" data-parsley-priority-enabled="false" action="<?php echo site_url() .'/customers/update_customer' ?>">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="text-align-center slim">
                                        <img class="" src="<?php echo base_url(); ?>customer_images/<?php echo $customer->id . '/' . $customer->image; ?>" alt="Customer Image">
                                        <input type="file" class="uploadImg" accept="image/jpeg,image/png,image/gif,image/bmp" capture="environment" name="images" id="images"  />
                                    </div>
                                </div>
                                  <script>
                                   $('.slim').slim({
                                      size: { width: 1000, height: 600 },
                                      label: 'Drop image here / Select from computer',
                                                                            download: true
                                    });
                                 </script>
                                <div class="col-sm-8">
                                    <h3 class="mt-sm mb-xs"><?php echo $customer->business_name ?></h3>
                                    <address>
                                        <strong><?php echo $customer->address ?></strong><br>
                                        <abbr title="Work Phone">phone:</abbr> <?php echo $customer->office_phone ?><br>
                                        <abbr title="Work email">e-mail:</abbr> <a href="<?php echo 'mailto:'.$customer->email ?>"><?php echo $customer->email ?></a>
                                    </address>
                                </div>
                            </div>
                            <fieldset class="mt-sm">
                                <legend>Edit Customer <small></small></legend>
                            </fieldset>
							 <fieldset>
                                <legend class="section">Company Info</legend>
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="company-name">Company Name<span class="required">*</span></label>
                                    <div class="col-sm-8"><input type="text" id="company-name" name="company-name" class="form-control" required="required" data-parsley-maxlength="70" data-parsley-id="40" value="<?php echo $customer->business_name ?>"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="company-address">Company Address<span class="required">*</span></label>
                                    <div class="col-sm-8"><input type="text" id="company-address" name="company-address" required="required" data-parsley-maxlength="100" class="form-control" data-parsley-id="41" value="<?php echo $customer->address ?>"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="company-abn">Company ABN</label>
                                    <div class="col-sm-8"><input type="text" id="company-abn" name="company-abn" class="form-control" data-parsley-maxlength="20" data-parsley-id="42" value="<?php echo $customer->business_abn ?>"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="office-phone">Office Phone</label>
                                    <div class="col-sm-8"><input type="text" value="<?php echo $customer->office_phone ?>" id="office-phone" name="office-phone" class="form-control" data-parsley-maxlength="15" data-parsley-id="43"></div>
                                </div>
                                <div class="form-group">
                                    <label for="mobile-phone" class="control-label col-sm-4">Mobile Phone</label>
                                    <div class="col-sm-8"><input id="mobile-phone" class="form-control" type="text" value="<?php echo $customer->mobile_phone ?>" name="mobile-phone" value="" data-parsley-maxlength="15" data-parsley-id="44"></div>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="control-label col-sm-4">Email</label>
                                    <div class="col-sm-8"><input id="email" class="form-control" type="email" value="<?php echo $customer->email ?>" name="email" value="" data-parsley-maxlength="45" data-parsley-id="45"></div>
                                </div>
                            </fieldset>
							<fieldset>
                                <div class="form-group">
                                    <label for="checkbox-isactive" class="control-label col-sm-4">Active </label>
                                    <div class="checkbox-inline checkbox-ios">
                                              	<input type="checkbox" name="isactive" id="isactive" data-switchery="true" style="display: none;"
                                               <?php if ($customer->active) : ?>
                                                 checked="checked">
                                                <?php else : ?>
                                                >
                                                <?php endif; ?>
                                        </div>
                                </div>
							</fieldset>
                            <fieldset>
                                <legend class="section">Company Representative</legend>
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="position">Position</label>
                                    <div class="col-sm-4"><input type="text" id="position" name="position" value="<?php echo $customer->rep_position ?>" class="form-control" data-parsley-maxlength="15" data-parsley-id="50"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="rep-first-name">Rep First Name</label>
                                    <div class="col-sm-8"><input type="text" id="rep-first-name" name="rep-first-name" value="<?php echo $customer->rep_firstname; ?>"class="form-control" data-parsley-maxlength="25" data-parsley-id="51"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="rep-last-name">Rep Last Name</label>
                                    <div class="col-sm-8"><input type="text" id="rep-last-name" name="rep-last-name" value="<?php echo $customer->rep_lastname; ?>" class="form-control" data-parsley-maxlength="25" data-parsley-id="52"></div>
                                </div>
                                <div class="form-group">
                                    <label for="rep-phone" class="control-label col-sm-4">Rep Contact #</label>
                                    <div class="col-sm-8"><input id="rep-phone" class="form-control" type="text" value="<?php echo $customer->rep_contact; ?>" name="rep-phone" value="" data-parsley-maxlength="15" data-parsley-id="53"></div>
                                </div>
                                <div class="form-group">
                                    <label for="rep-email" class="control-label col-sm-4">Rep Email</label>
                                    <div class="col-sm-8"><input id="rep-email" class="form-control" type="email" value="<?php echo $customer->rep_email; ?>" name="rep-email" value="" data-parsley-maxlength="45" data-parsley-id="54"></div>
                                </div>
                            </fieldset>

							<input type="hidden" name="customer-id" id="customer-id" value="<?php echo $customer->id ?>" />
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-sm-8 col-sm-offset-4">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>

                 <section class="widget">
                    <?php if ($this->session->flashdata('notice_notes_table'))
                        {
                            echo('<span class="label label-important">' . $this->session->flashdata('notice_table'));
                        } ?></span>
                    <header>
                        <h4><i class="fa fa-user"></i> Customer Notes</h4><small>All Customer Notes</small>
                        <div class="actions">
                        </div>
                    </header>
                    <div class="body">

                        <div id="datatable-table_wrapper" class="dataTables_wrapper form-inline no-footer">
                           <table id="notes-table" class="table table-striped table-hover dataTable no-footer" role="grid" aria-describedby="datatable-table_info">
                            <thead>
                            <tr role="row">
                            <th class="sorting_asc" tabindex="0" aria-controls="datatable-table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Id: activate to sort column descending" style="width:10%">Date</th>
                            <th class="hidden-xs sorting" tabindex="0" aria-controls="datatable-table" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width:15%">INV #</th>
                            <th class="no-sort hidden-xs sorting_disabled" rowspan="1" colspan="1" aria-label="Info" style="width:75%">Note</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php if(!$notes) {
                                echo('<span class="label label-important">No customers are currently registered.</span><br /><br />');
                            }
                                else{

                                foreach ($notes as $note)
                                {
                                echo ('<tr role="row" class="odd">
                                <td class="sorting_1">');
                                echo $note->Date;
                                echo ('</td>
                                <td><span class="fw-semi-bold">');
                                echo '<a style="cursor:pointer" data-fancybox="iframe" data-src="' . site_url() . '/pages/view/view_invoice/' . $note->inv_id . '" data-type="iframe">' . $note->inv_id . '</a>';
                                echo ('</span></td>
                                <td class="">
                                <span class="fw-semi-bold">');
                                echo $note->note;
                                echo ('</span></td>');

                                } //endloop
                            } //end foreach
                            ?>

                           </tbody>

                        </table>
                        </div>
                    </div>
                </section>

                  <section class="widget">
                    <?php if ($this->session->flashdata('notice_invoice_table'))
                        {
                            echo('<span class="label label-important">' . $this->session->flashdata('notice_invoice_table'));
                        } ?></span>
                    <header>
                        <h4><i class="fa fa-user"></i> Invoices</h4><small>All Customer Invoices</small>
                        <div class="actions">
                        </div>
                    </header>
                    <div class="body">

                        <div class="dataTables_wrapper form-inline no-footer">
                           <table id="inv-table" class="table table-striped table-hover dataTable no-footer" role="grid" aria-describedby="datatable-table_info">
                            <thead>
                            <tr role="row">
                            <th class="sorting_asc" tabindex="0" aria-controls="datatable-table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Id: activate to sort column descending" style="width:10%">Date</th>
                            <th class="hidden-xs sorting" tabindex="0" aria-controls="datatable-table" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width:10%">INV #</th>
                            <th class="no-sort hidden-xs sorting_disabled" rowspan="1" colspan="1" aria-label="Info" style="width:10%">Status</th>
                             <th class="no-sort hidden-xs sorting_disabled" rowspan="1" colspan="1" aria-label="Info" style="width:10%">QTY</th>
                             <th class="no-sort hidden-xs sorting_disabled" rowspan="1" colspan="1" aria-label="Info" style="width:20%">Amount</th>
                             <th class="no-sort hidden-xs sorting_disabled" rowspan="1" colspan="1" aria-label="Info" style="width:10%">Staff</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php if(!$invoices) : ?>
                                <span class="label label-important">No invoices currently registered.</span><br /><br />

                            <?php else : ?>

                                <?php foreach ($invoices as $invoice) : ?>
                                <tr role="row" class="odd">
                                <td class="sorting_1">
                                <?php echo $invoice->date;  ?>
                                </td>
                                <td><span class="fw-semi-bold">
                                <a href="<?php echo site_url() . '/pages/view/view_invoice/' . $invoice->purchase_id; ?>"><?php echo $invoice->purchase_id; ?></a>

                                </span></td>
                                <td class="hidden-xs">
                                <span class="fw-semi-bold">
                                <?php switch ($invoice->status){
                                    case (0): echo 'Quote';
                                    break;
                                    case (1): echo 'Unpaid';
                                    break;
                                    case (2): echo 'Paid';
                                    break;
                                }
                                 ?>
                                </span></td>
                                <td><span class="fw-semi-bold">
                                <?php echo $invoice->qty; ?>
                                </span></td>
                                <td><span class="fw-semi-bold">
                                <?php echo $invoice->Total; ?>
                                </span></td>
                                <td><span class="fw-semi-bold">
                                <?php echo $invoice->admin_id; ?>
                                </span></td>
                                <?php endforeach ?>

                            <?php endif; ?>

                           </tbody>

                        </table>
                        </div>
                    </div>
                </section>

            </div>
            <div class="col-md-5">
                <section class="widget">
                    <?php if ($this->session->flashdata('notice_freq'))
						{
							echo('<span class="label label-important">' . $this->session->flashdata('notice_freq'));
						} ?></span>
                    <header>
                        <h4><i class="fa fa-clock-o"></i> Company Visits</h4>
                        <div class="actions">
                        </div>
                    </header>
                    <div class="body">
                        <form method="post"  action="<?php echo site_url() .'/customers/save_freq' ?>">
                            <fieldset>
                                <div class="form-group">
                                    <label for="visit_frequency" class="control-label col-sm-4">Visit Frequency </label>
                                    	<div class="col-sm-6"><select class="select2 form-control" data-placeholder="Set Frequency" tabindex="-1" id="visit_frequency" name="visit_frequency" required data-parsley-trigger="change" data-parsley-id="70" <?php // if ($this->session->userdata('user_type') != 'admin') echo 'disabled' ?>>
											<option value></option>
											<option value="weekly">Weekly</option>
											<option value="fortnightly">Fortnightly</option>
											<option value="monthly">Monthly</option>
											<option value="3-monthly">Quarterly</option>
											<option value="6-monthly">Bi-Annually</option>
											<option value="12-monthly">Annually</option>
											</select></div>
                                </div>
                                <div style="height:30px"></div>
                                <div class="form-group">
                                    <label for="next-visit" class="control-label col-sm-4">Last Visit</label>
                                    <div class="col-sm-6"><input id="next-visit" class="form-control" required="required" type="text" name="next-visit" value="<?php echo $customer->next_visit ?>" data-parsley-id="72" <?php // if ($this->session->userdata('user_type') != 'admin') echo 'disabled' ?>>
                                    </div>
                                </div>
                            </fieldset>
                            <input type="hidden" name="customer-id" id="customer-id" value="<?php echo $customer->id ?>" />
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-sm-8 col-sm-offset-4">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>

                 <section class="widget">
                    <?php if ($this->session->flashdata('notice_type'))
						{
							echo('<span class="label label-important">' . $this->session->flashdata('notice_type'));
						} ?></span>
                    <header>
                        <h4><i class="fa fa-user"></i> Customer Type</h4><small>Changes customer pricing</small>
                        <div class="actions">
                        </div>
                    </header>
                    <div class="body">
                        <form method="post" action="<?php echo site_url() .'/customers/update_customer_type' ?>">
                            <fieldset>
                                <div class="form-group">
                                    <label for="cus_type" class="control-label col-sm-4">Customer Type</label>
                                    	<div class="col-sm-6"><select class="select2 form-control" data-placeholder="Set Type" tabindex="-1" id="cus_type" name="cus_type" required data-parsley-trigger="change" data-parsley-id="80" <?php if ($this->session->userdata('user_type') != 'admin') echo 'disabled' ?>>
											<option value></option>
											<option value="1">Best Customers</option>
											<option value="2">Average Customers</option>
											<option value="3">Rare Customers</option>
											</select></div>
                                </div>
                            </fieldset>
                            <input type="hidden" name="customer-id" id="customer-id" value="<?php echo $customer->id ?>" />
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-sm-8 col-sm-offset-4">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>

                 <section class="widget">
                    <?php if ($this->session->flashdata('notice_assign'))
						{
							echo('<span class="label label-important">' . $this->session->flashdata('notice_assign'));
						} ?></span>
                    <header>
                        <h4><i class="fa fa-user"></i> Assign Customer</h4><small>Assign Customer to Staff Member</small>
                        <div class="actions">
                        </div>
                    </header>
                    <div class="body">
                        <form method="post" action="<?php echo site_url() .'/customers/assign_customer' ?>">
                            <fieldset>
                                <div class="form-group">
                                    <label for="cus_type" class="control-label col-sm-4">Assigned To: </label>
                                    	<div class="col-sm-6"><select class="select2 form-control" data-placeholder="Set Type" tabindex="-1" id="ass_to" name="ass_to" required data-parsley-trigger="change" data-parsley-id="90" <?php if ($this->session->userdata('user_type') != 'admin') echo 'disabled' ?>>
											<option value></option>
											<?php foreach ($users as $user) : ?>
											<option value="<?php echo $user->id; ?>"><?php echo $user->username; ?></option>
											<?php endforeach; ?>
											</select></div>
                                </div>
                            </fieldset>
                            <input type="hidden" name="customer-id" id="customer-id" value="<?php echo $customer->id ?>" />
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-sm-8 col-sm-offset-4">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>

                     <section class="widget">
                    <?php if ($this->session->flashdata('notice_notes'))
                        {
                            echo('<span class="label label-important">' . $this->session->flashdata('notice_notes'));
                        } ?></span>
                    <header>
                        <h4><i class="fa fa-user"></i> Customer Notes</h4><small>View Customer Notes</small>
                        <div class="actions">
                        </div>
                    </header>
                    <div class="body">
                        <form method="post" action="<?php echo site_url() .'/customers/add_note' ?>">
                            <fieldset>
                                <div class="form-group">
                                    <label for="cus_type" class="control-label col-sm-4">New Note: </label>
                                        <div class="col-sm-6">
                                            <textarea id="add_note" name="add_note" class="form-control">
                                            </textarea>
                                        </div>
                                </div>
                            </fieldset>
                            <input type="hidden" name="customer-id" id="customer-id" value="<?php echo $customer->id ?>" />
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-sm-8 col-sm-offset-4">
                                        <button type="submit" class="btn btn-primary">Add Note</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>

            </div>
        </div>

        <script>
			var elem = document.querySelector('#isactive');
			var init = new Switchery(elem);
			$("#visit_frequency").val("<?php echo $customer->visit_frequency; ?>");
			$("#cus_type").val("<?php echo $customer->customer_type; ?>");
			$("#ass_to").val("<?php echo $customer->assigned_to; ?>");
            $(window).load(function(){
                $('#notes-table').DataTable({"order": [[ 0, "desc" ]]});
		            $('#inv-table').DataTable({"order": [[ 0, "desc" ]]});
                $('#next-visit').datetimepicker({format: 'DD/MM/YYYY'});
            });
		</script>
       	</div>
</div>


    <!-- page specific scripts -->
        <!-- page libs -->
