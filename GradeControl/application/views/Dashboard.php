<!DOCTYPE html>
<html lang="en">
	<head>

		<!-- HEADLIB -->
		<?php $this->load->view('lib/Headlib'); ?>
		<!-- END HEADLIB -->

	</head>
	<body class="menubar-hoverable header-fixed ">

		<!-- BEGIN HEADER-->
		<?php $this->load->view('lib/Header'); ?>
		<!-- END HEADER-->

		<!-- BEGIN BASE-->
		<div id="base">

			<!-- BEGIN OFFCANVAS LEFT -->
			<div class="offcanvas">
			</div><!--end .offcanvas-->
			<!-- END OFFCANVAS LEFT -->

			<!-- BEGIN CONTENT-->
			<div id="content">
				<section>
					<div class="section-body">
						<div class="row">

							<!-- BEGIN ALERT - REVENUE -->
							<div class="col-md-3 col-sm-6">
								<div class="card">
									<div class="card-body no-padding">
										<div class="alert alert-callout alert-info no-margin">
											
											<strong class="text-xl"><?php echo $openingstock ?></strong><br/>
											<span class="opacity-50"><strong class="text-lg">Opening Stock</strong></span>
											<div class="stick-bottom-left-right">
												<div class="height-2 sparkline-revenue" data-line-color="#bdc1c1"></div>
											</div>
										</div>
									</div><!--end .card-body -->
								</div><!--end .card -->
							</div><!--end .col -->
							<!-- END ALERT - REVENUE -->

							<!-- BEGIN ALERT - VISITS -->
							<div class="col-md-3 col-sm-6">
								<div class="card">
									<div class="card-body no-padding">
										<div class="alert alert-callout alert-warning no-margin">
											
											<strong class="text-xl"><?php echo $closingstock ?></strong><br/>
											<span class="opacity-50"><strong class="text-lg">Closing Stock</strong></span>
											<div class="stick-bottom-right">
												<div class="height-1 sparkline-visits" data-bar-color="#e5e6e6"></div>
											</div>
										</div>
									</div><!--end .card-body -->
								</div><!--end .card -->
							</div><!--end .col -->
							<!-- END ALERT - VISITS -->

							<!-- BEGIN ALERT - BOUNCE RATES -->
							<div class="col-md-3 col-sm-6">
								<div class="card">
									<div class="card-body no-padding">
										<div class="alert alert-callout alert-danger no-margin">
											
											<strong class="text-xl"><?php echo $totalblock ?></strong><br/>
											<span class="opacity-50"><strong class="text-lg">Total Block</strong></span>
											<div class="stick-bottom-left-right">
												
											</div>
										</div>
									</div><!--end .card-body -->
								</div><!--end .card -->
							</div><!--end .col -->
							<!-- END ALERT - BOUNCE RATES -->

							<!-- BEGIN ALERT - TIME ON SITE -->
							<div class="col-md-3 col-sm-6">
								<div class="card">
									<div class="card-body no-padding">
										<div class="alert alert-callout alert-success no-margin">
										
											<strong class="text-xl"><?php echo $feedtocrush ?></strong><br/>
											<span class="opacity-50"><strong class="text-lg">Ore Feed to Crusher</strong></span>
										</div>
									</div><!--end .card-body -->
								</div><!--end .card -->
							</div><!--end .col -->
							<!-- END ALERT - TIME ON SITE -->

						</div><!--end .row -->
						<div class="row">

							

							<!-- BEGIN SERVER STATUS -->
							<div class="col-md-3">
								<div class="card">
									<div class="card-head">
										<header class="text-primary">Feed Material (%)</header>
									</div><!--end .card-head -->
									<div class="card-body height-4">
										<div class="pull-left text-center">
											<em class="text-primary">Fresh Material &nbsp; &nbsp; &nbsp;: &nbsp;<?php echo $PersenFresh ?> </em>
											<br/>
											<br>
											<em class="text-primary">Transisi Material &nbsp; &nbsp;:&nbsp;<?php echo $PersenTransisi ?> </em>
											<br>
											<br>
											<em class="text-primary">Clay Material &nbsp; &nbsp; &nbsp; &nbsp;:&nbsp;<?php echo $PersenClay ?> </em>
										</div>
									</div><!--end .card-body -->
									<div class="card-body height-4 no-padding">
										<div class="stick-bottom-left-right">
											<div id="rickshawGraph" class="height-4" data-color1="#0aa89e" data-color2="rgba(79, 89, 89, 0.2)"></div>
										</div>
									</div><!--end .card-body -->
								</div><!--end .card -->
							</div><!--end .col -->
							<!-- END SERVER STATUS -->

						</div><!--end .row -->
						<div class="row">

					

						</div><!--end .row -->
					</div><!--end .section-body -->
				</section>
			</div><!--end #content-->
			<!-- END CONTENT -->

			<!-- NAVIGATION-->

			<!-- END NAVIGATION -->
			<?php $this->load->view('lib/Navigation'); ?>
			<!-- FOOTER -->
	    <?php $this->load->view('lib/Footer'); ?>
	    <!-- /#END FOOTER -->

		</div><!--end #base-->
		<!-- END BASE -->

		<!-- FOOTLIB -->
			<?php $this->load->view('lib/Footlib') ?>
		<!-- END FOOTLIB -->

	</body>
</html>
