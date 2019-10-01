<?php date_default_timezone_set("Australia/Sydney"); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Cash 4 Cats</title>
<!-- <link rel="stylesheet" href="http://localhost/cash4cats/theme/css/application.css" type="text/css" /> -->
<link rel="stylesheet" href="<?php echo base_url(); ?>theme/css/application.css" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.css" />
<link rel="stylesheet" href="<?php echo (base_url() . 'theme/lib/slim/slim.css'); ?>" />

<script>
        /* yeah we need this empty stylesheet here. It's cool chrome & chromium fix
           chrome fix https://code.google.com/p/chromium/issues/detail?id=167083
                      https://code.google.com/p/chromium/issues/detail?id=332189
        */
</script>
				<!-- common libraries. required for every page-->
<script src="<?php echo (base_url(). 'theme/lib/jquery/dist/jquery.min.js'); ?>"></script>
<script src="<?php echo (base_url(). 'theme/lib/jquery-pjax/jquery.pjax.js'); ?>"></script>
<script src="<?php echo (base_url(). 'theme/lib/bootstrap-sass/assets/javascripts/bootstrap.min.js'); ?>"></script>
<script src="<?php echo (base_url(). 'theme/lib/widgster/widgster.js'); ?>"></script>
<script src="<?php echo (base_url(). 'theme/lib/underscore/underscore.js'); ?>"></script>

<!-- common application js -->
<!-- <script src="<?php echo (base_url(). 'theme/js/app.js'); ?>"></script> -->
<script src="<?php echo (base_url(). 'theme/js/settings.js'); ?>"></script>
<script src="<?php echo base_url(); ?>theme/lib/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script src="<?php echo base_url(); ?>theme/lib/select2/select2.min.js"></script>
<script src="<?php echo base_url(); ?>theme/lib/moment/moment.js"></script>
<script src="<?php echo base_url(); ?>theme/lib/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<script src="<?php echo base_url(); ?>theme/lib/parsleyjs/dist/parsley.min.js"></script>
<script src="<?php echo base_url(); ?>theme/js/forms-account.js"></script>
<script src="<?php echo (base_url() . 'theme/lib/slimScroll/jquery.slimscroll.min.js'); ?>"></script>
<script src="<?php echo (base_url() . 'theme/lib/jquery.sparkline/index.js'); ?>"></script>
<script src="<?php echo (base_url() . 'theme/lib/backbone/backbone.js'); ?>"></script>
<script src="<?php echo (base_url() . 'theme/lib/backbone.localStorage/backbone.localStorage-min.js'); ?>"></script>
<script src="<?php echo (base_url() . 'theme/lib/d3/d3.min.js'); ?>"></script>
<script src="<?php echo (base_url() . 'theme/lib/nvd3/build/nv.d3.min.js'); ?>"></script>
<script src="<?php echo (base_url() . 'theme/js/index.js'); ?>"></script>
<script src="<?php echo (base_url() . 'theme/js/chat.js'); ?>"></script>

<script src="<?php echo (base_url() . 'theme/lib/backbone.paginator/lib/backbone.paginator.min.js'); ?>"></script>
<script src="<?php echo (base_url() . 'theme/lib/backgrid/lib/backgrid.min.js'); ?>"></script>
<script src="<?php echo (base_url() . 'theme/lib/backgrid-paginator/backgrid-paginator.js'); ?>"></script>
<script src="<?php echo (base_url() . 'theme/lib/datatables/media/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo (base_url() . 'theme/lib/switchery/dist/switchery.min.js'); ?>"></script>
<script src="<?php echo (base_url() . 'theme/lib/jquery-autosize/dist/autosize.min.js'); ?>"></script>
<script src="<?php echo (base_url() . 'theme/lib/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.all.min.js'); ?>"></script>
<script src="<?php echo (base_url() . 'theme/lib/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js'); ?>"></script>
<script src="<?php echo (base_url() . 'theme/lib/jquery.maskedinput/dist/jquery.maskedinput.min.js'); ?>"></script>
<script src="<?php echo (base_url() . 'theme/lib/seiyria-bootstrap-slider/dist/bootstrap-slider.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo (base_url() . 'theme/js/omersScript.js'); ?>"></script>
<script type="text/javascript" src="<?php echo (base_url() . 'theme/lib/fullcalendar/dist/fullcalendar.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo (base_url() . 'theme/lib/slim/slim.jquery.min.js'); ?>"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.js"></script>



			<!-- page application js -->
<script src="<?php echo (base_url() . 'theme/js/tables-dynamic.js'); ?>"></script>
<style>
	@media screen and (max-width:767px){
	#side-nav{
		background-color:black;
	}

	}
</style>
</head>
<body class="<?php echo ( isset($page) ? $page : '' ); ?>">
<div class="logo">
        <h4><a href="<?= base_url() ?>">Cash 4 <strong>Cats</strong></a></h4>
</div>
