<style type="text/css">
body {
    background-color: #000000;
}
    #datatable-table_filter input{
        height:32px;
        margin-left:10px;
    }
</style>

            <h2 class="page-title">Shipment Summary Report<small></small></h2><div class="row">
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

                        <form id="user-form" class="form-horizontal" novalidate method="get" data-parsley-priority-enabled="false" data-parsley-excluded="" action="<?php echo site_url(); ?>/pages/view/report_shipment_summary">
                            <fieldset>
                               <legend class="section">Select Date Range</legend>
                                <div class="form-group">
                                    <label class="control-label col-sm-4 input-lg" for="from">From <span class="required"></span><br />
                                    <small>From date is <strong>NOT INCLUSIVE</strong>, select 1 day before the required date</small></label>
                                  <div class="col-sm-6 input-group">
                                  <input type="text" name="from" id="from" value="<?php echo $last_date; ?>" class="form-control form_datetime" <?php if ($shipments) {
                                        echo 'readonly=readonly';
                                                                                  } ?>  />
                                  </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-4 input-lg" for="amount">To <span class="required"></span><br />
                                    <small>To date <strong>IS INCLUSIVE</strong></small></label>
                                  <div class="col-sm-6 input-group">
                                  <input type="text" name="to" id="to" class="form-control form_datetime" />
                                  </div>
                                </div>

                            </fieldset>
                            <div class="form-actions">
                                <div class="row">
                                  <div class="col-sm-6 col-sm-offset-4">
                                        <button type="submit" class="btn btn-primary input-lg">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>

        <h2 class="page-title">Closed Shipment Summaries<small></small></h2><div class="row">
            <div class="col-md-12">
                <section class="widget">
                    <header>
                        <?php
                        if ($this->session->flashdata('shipment') && validation_errors() == '') {
                            echo('<span class="label label-important">' . $this->session->flashdata('shipment'));
                        } ?>
                    </header>
                    <div class="body">

                       <table id="datatable-table" class="table table-striped table-hover dataTable no-footer" role="grid" aria-describedby="datatable-table_info">
                        <thead>
                        <tr role="row">

                        <th style="width:8%">Shipment ID</th>
                        <th class="" tabindex="0" aria-controls="datatable-table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Id: activate to sort column descending" style="width:10%">From</th>

                        <th class="hidden-xs " tabindex="0" aria-controls="datatable-table" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width:10%">To</th>

                        <th class="hidden-xs " tabindex="0" aria-controls="datatable-table" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style=""># Cats</th>
                        <th class="hidden-xs " tabindex="0" aria-controls="datatable-table" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="">Actual Profit</th>
                         <th class="" tabindex="0" aria-controls="datatable-table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Id: activate to sort column descending" style=""></th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php $new_from;
                                $new_to;
                        ?>
                        <?php if ($shipments) : ?>
                            <?php foreach ($shipments as $shipment) : ?>
                        <tr role="row" class="odd">
                        <td><?php echo $shipment->id; ?></td>
                                    <td class="">
                                    <?php
                                        $new_from = date_create_from_format('Y-m-d H:i:s', $shipment->from_date);
                                        echo $new_from = date_format($new_from, 'Y/m/d H:i');  ?>
                                        </td>
                                    <td class="">
                                    <?php
                                        $new_to = date_create_from_format('Y-m-d H:i:s', $shipment->to_date);
                                        echo $new_to = date_format($new_to, 'Y/m/d H:i');
                                    ?></td>
                                    <td class=""><?php echo $shipment->qty; ?></td>
                                    <td class=""><?php echo $shipment->actual_profit; ?></td>
                                    <td class="">
                    <a href="<?php echo site_url(); ?>/pages/view/report_shipment_summary?from=<?php echo $new_from; ?>&to=<?php echo $new_to ?>&profit=<?php echo $shipment->actual_profit ?>&action=view&shipment_id=<?php echo $shipment->id ?>">
                      <button class="btn btn-success inv-button">View</button></a>

                      <button class="btn btn-danger inv-button" data-toggle="modal" data-target="#myModal_">Delete</button>

                    <div id="myModal_" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myModalLabel">Are you sure you want to delete this shipment?</h4>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                            <a href="<?php echo site_url(); ?>/pages/delete_shipment/<?php echo $shipment->id . '/' . $shipment->from_date . '/' . $shipment->to_date; ?>">
                            <button type="button" class="btn btn-primary" style="margin-left:20px">Yes</button></a>
                          </div>
                        </div><!-- /.modal-content -->
                      </div><!-- /.modal-dialog -->
                    </div>

                  </td>
                        </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                   </tbody>

                    </table>

                    </div>
                </section>
            </div>
        </div>


        </div>
</div>


    <!-- page specific scripts -->
        <!-- page libs -->
<script>
$(window).load(function() {
       $('#datatable-table').DataTable({
    "order": [[ 0, "desc" ]]
    });
       $('#from').datetimepicker({format: 'YYYY-MM-DD HH:mm'});
       $('#to').datetimepicker({format: 'YYYY-MM-DD HH:mm'});

});
</script>
