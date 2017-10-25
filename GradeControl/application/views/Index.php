<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- BEGIN META -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
    <link rel="icon" type="image/png" href="<?php echo base_url();?>pictures/favicon.ico">
		<title>GradeControl - Database</title>

		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<!-- END META -->

		<!-- BEGIN STYLESHEETS -->
		<link href='http://fonts.googleapis.com/css?family=Roboto:300italic,400italic,300,400,500,700,900' rel='stylesheet' type='text/css'/>
		<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/theme-default/bootstrap.css?1422792965" />
		<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/theme-default/materialadmin.css?1425466319" />
		<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/theme-default/font-awesome.min.css?1422529194" />
		<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/theme-default/material-design-iconic-font.min.css?1421434286" />
		<!-- END STYLESHEETS -->

	</head>
	<body class="menubar-hoverable header-fixed ">

		<!-- BEGIN LOGIN SECTION -->
		<section class="section-account">
			<div class="img-backdrop" style="background-image: url('<?php echo base_url();?>assets/img/img160.jpg')"></div>
			<div class="spacer"></div>
			<div class="card contain-sm style-transparent">
				<div class="card-body">
					<div class="row">
						<div class="col-sm-12">
							<br/>
							<span class="text-lg text-bold text-primary">GRADE CONTROL DATABASE</span>
							<br/><br/>
							<form class="form floating-label" action="<?php echo base_url().'Login' ?>" accept-charset="utf-8" method="post">
								<div class="form-group">
									<input type="text" autocomplete="off" class="form-control" id="username" name="username">
									<label for="username">Username</label>
								</div>
								<div class="form-group">
									<input type="password" class="form-control" id="password" name="password">
									<label for="password">Password</label>
								</div>
								<br/>
								 <div class="social-or-login center" style="color:red;">
						    						<span class="bigger-110" style="color:red;"><?php
						                                echo "".$message;
						                            ?>
						                            	
						                            </span>
    											</div>
								<div class="row">
									<div class="col-xs-6 text-left">
									</div><!--end .col -->
									<div class="col-xs-6 text-right">
										<button class="btn btn-primary btn-raised" type="submit">Login</button>
									</div><!--end .col -->
								</div><!--end .row -->
							</form>
						</div><!--end .col -->
					</div><!--end .card -->
				</section>
				<!-- END LOGIN SECTION -->

				<!-- BEGIN JAVASCRIPT -->
				<script src="<?php echo base_url();?>assets/js/libs/jquery/jquery-1.11.2.min.js"></script>
				<script src="<?php echo base_url();?>assets/js/libs/jquery/jquery-migrate-1.2.1.min.js"></script>
				<script src="<?php echo base_url();?>assets/js/libs/bootstrap/bootstrap.min.js"></script>
				<script src="<?php echo base_url();?>assets/js/libs/spin.js/spin.min.js"></script>
				<script src="<?php echo base_url();?>assets/js/libs/autosize/jquery.autosize.min.js"></script>
				<script src="<?php echo base_url();?>assets/js/libs/nanoscroller/jquery.nanoscroller.min.js"></script>
				<script src="<?php echo base_url();?>assets/js/core/source/App.js"></script>
				<script src="<?php echo base_url();?>assets/js/core/source/AppNavigation.js"></script>
				<script src="<?php echo base_url();?>assets/js/core/source/AppOffcanvas.js"></script>
				<script src="<?php echo base_url();?>assets/js/core/source/AppCard.js"></script>
				<script src="<?php echo base_url();?>assets/js/core/source/AppForm.js"></script>
				<script src="<?php echo base_url();?>assets/js/core/source/AppNavSearch.js"></script>
				<script src="<?php echo base_url();?>assets/js/core/source/AppVendor.js"></script>
				<script src="<?php echo base_url();?>assets/js/core/demo/Demo.js"></script>
				<!-- END JAVASCRIPT -->

			</body>
		</html>
