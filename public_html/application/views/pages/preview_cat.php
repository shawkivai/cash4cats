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
            <div class="col-md-12">
               <form class="form-horizontal form-label-left" method="post" action="<?php echo (site_url() . '/cats/update') ?>" enctype="multipart/form-data">
                <section class="widget">
                  <?php if ($this->session->flashdata('notice'))
						{
							echo('<span class="label label-important">' . $this->session->flashdata('notice'));
						} ?></span>
                    <header>
                        <h4><i class="fa fa-user"></i> Cat Image & Description <small></small></h4>
                        <div style="margin-top:20px;margin-bottom:30px"><img  style="width:100%" src="<?php echo base_url() . 'cat_img/resized_cat_images_600/' . $cat->image; ?>"/>
                        </div>
                        <h3 style="margin-bottom:15px">Name: <?php echo $cat->name ?></h3>
                      <h3 style="margin-bottom:15px">Weight: <?php echo $cat->monolight_dry_weight_net; ?></h2>                      
												<h3 style="margin-bottom:15px;margin-top:15px">Category: </h3>
													<select disabled class="xs-pull-right select2 form-control input-lg" data-placeholder="Select Cat Brand" tabindex="-1" id="category_id" name="category_id" required data-parsley-trigger="change" data-parsley-id="15">
													<option value></option>
													<?php foreach ($category_names as $category) : ?>
														<option value="<?php echo $category->category_id; ?>"><?php echo $category->name; ?></option>
													<?php endforeach; ?>
													</select>
													  <script>$('#category_id').val('<?php echo $cat->category_id; ?>');</script>
												<fieldset>
                        <h4 style="margin-top:15px">Converter Description</h4>
                        <?php echo $cat->description; ?>
                        <input type="hidden" id="cat-id" name="cat-id" value="<?php echo $cat->id; ?>" />
                        </fieldset>
                    </header>
                    <div class="body">
                    </div>



                </section>
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
