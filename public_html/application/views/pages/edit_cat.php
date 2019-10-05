<style type="text/css">
body {
    background-color: #000000;
}
    input{
        text-align: right;
    }
</style>

            <h2 class="page-title"><?php echo $cat->name; ?> - <small>View Cat</small></h2>

    <div class="row">
            <div class="col-md-7">
               <form class="form-horizontal form-label-left" method="post" action="<?php echo (site_url() . '/cats/update') ?>" enctype="multipart/form-data">
                <section class="widget">
                    <?php if ($this->session->flashdata('notice')) {
                            echo('<span class="label label-important">' . $this->session->flashdata('notice'));
                    } ?></span>
                    <header>
                        <h4><i class="fa fa-user"></i> Cat Image & Description <small></small></h4>
                        <div style="margin-top:20px;margin-bottom:30px"><img  style="width:100%" src="<?php echo base_url() . 'cat_img/resized_cat_images_600/' . $cat->image; ?>"/>
                        Update Image: <input type="file" class="" name="mainImg" id="mainImg" /></div>
                        <h3 style="margin-bottom:15px">Name: <input type="text" name="cat_name" id="cat_name" value="<?php echo $cat->name ?>"></h3>
                        <h3 style="margin-bottom:15px">Sample #: <input type="text" name="cat_sample_no" id="cat_sample_no" value="<?php echo $cat->sample_number ?>"></h3>
                        <h3 style="margin-bottom:15px">Price: $<?php echo $cat->value; ?></h2>
                        <h3 style="margin-bottom:15px">Override Price: $ <input type="text" name="cat_override" id="cat_override" value="<?php echo $cat->final_price ?>"></h3><small>Note: A value set for Override Price will override any other price even after all calculations!</small>
                                                <h3 style="margin-bottom:15px;margin-top:15px">Category: </h3>
                                                    <select class="xs-pull-right select2 form-control input-lg" data-placeholder="Select Cat Brand" tabindex="-1" id="category_id" name="category_id" required data-parsley-trigger="change" data-parsley-id="15">
                                                    <option value></option>
                                                    <?php foreach ($category_names as $category) : ?>
                                                        <option value="<?php echo $category->category_id; ?>"><?php echo $category->name; ?></option>
                                                    <?php endforeach; ?>
                                                    </select>
                                                      <script>$('#category_id').val('<?php echo $cat->category_id; ?>');</script>
                                                <fieldset>
                        <h4 style="margin-top:15px">Converter Description</h4>
                        <textarea id="desc" name="desc" style="width:100%;margin-top:20px; height:300px"><?php echo $cat->description; ?></textarea>
                        <input type="hidden" id="cat-id" name="cat-id" value="<?php echo $cat->id; ?>" />
                        </fieldset>
                    </header>
                    <div class="body">
                    </div>

                    <div class="form-actions">
                                <div class="row">
                                  <div class="col-sm-6 col-sm-offset-5">
                                        <button type="submit" class="btn btn-primary input-lg" >Update Cat</button>
                                    </div>
                        </div>
                  </div>

                </section>
            </div>
            <div class="col-md-5">
                <section class="widget">
                    <?php if ($this->session->flashdata('notice_freq')) {
                            echo('<span class="label label-important">' . $this->session->flashdata('notice_freq'));
                    } ?></span>
                    <header>
                        <h4><i class="fa fa-clock-o"></i> Cat Specifications</h4>
                        <div class="actions">
                        </div>
                    </header>
                    <div class="body">
                         <table>
                        <tr><td colspan="2"><h4>Weight of Cat&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h4></td><td colspan="2"></td>
                        <th><input type="text" name="weight_cat" class="form-control" id="weight_cat" value="<?php echo ' ' . $cat->weight_cat; ?>" /></th></tr>
                        <tr><td colspan="2"><h4>Weight of Ceramic</h4></td><td colspan="2"></td><th><input class="form-control" type="text" name="weight_ceramic" id="weight_ceramic" value="<?php echo ' ' . $cat->weight_ceramic; ?>"   /></th></tr>
                        <tr><td colspan="2"><h4>Weight of Casing</h4></td><td colspan="2"></td><th><input class="form-control" type="text" name="weight_casing" id="weight_casing"  disabled  value="<?php echo ' ' . $cat->weight_casing; ?>" /></th></tr>

                        <tr><td colspan="2"><h4>PT Content</h4></td><td colspan="2"></td><th><input class="form-control" type="text" name="pt_content" id="pt_content" value="<?php echo ' ' . $cat->pt_content ?>"  /></th></tr>
                        <tr><td colspan="2"><h4>PD Content</h4></td><td colspan="2"></td><th><input class="form-control" type="text" name="pd_content" id="pd_content" value="<?php echo ' ' . $cat->pd_content; ?>"  /></th></tr>
                        <tr><td colspan="2"><h4>RH Content</h4></td><td colspan="2"></td><th><input class="form-control" type="text" name="rh_content" id="rh_content" value="<?php echo ' ' . $cat->rh_content; ?>"  /></th></tr>

                        <tr><td colspan="2"><h4>PT Kg</h4></td><td colspan="2"></td><th><input class="form-control" type="text" name="pt_kg" id="pt_kg" value="<?php echo ' ' . $cat->pt; ?>" disabled="" /></th></tr>
                        <tr><td colspan="2"><h4>PD Kg</h4></td><td colspan="2"></td><th><input class="form-control" type="text" name="pd_kg" id="pd_kg" value="<?php echo ' ' . $cat->pd; ?>" disabled="" /></th></tr>
                        <tr><td colspan="2"><h4>RH Kg</h4></td><td colspan="2"></td><th><input class="form-control" type="text" name="rh_kg" id="rh_kg" value="<?php echo ' ' . $cat->rh; ?>" disabled /></th></tr>

                        
                        </table>
                    </div>
                </section>

            </form>
            </div>
        </div>

        <script>
            var elem = document.querySelector('#isactive');
            var init = new Switchery(elem);
            $("#visit_frequency").val("<?php echo $customer->visit_frequency; ?>");
        </script>
        </div>
</div>


    <!-- page specific scripts -->
        <!-- page libs -->
