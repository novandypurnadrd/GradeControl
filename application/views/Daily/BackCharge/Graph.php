<!DOCTYPE html>
<html lang="en">
	<head>
		<?php $this->load->view('lib/Headlib'); ?>
	</head>

	<body class="no-skin">
		<?php $this->load->view('lib/Header'); ?>

		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			<?php $this->load->view('lib/Navigation'); ?>

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="<?php echo base_url().'Dashboard' ;?>">Home</a>
							</li>
							<li class="active">Daily Activity</li>
						</ul><!-- /.breadcrumb -->

					</div>

					<div class="page-content">

						<div class="page-header">
							<h1>
								Daily Activity
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Back Charge
                  <small>
  									<i class="ace-icon fa fa-angle-double-right"></i>
  									Graph
  								</small>
								</small>
							</h1>
						</div><!-- /.page-header -->

              <!-- MAIN CONTENT BEGIN -->

							<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			<?php $this->load->view('lib/Footer'); ?>

		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<?php $this->load->view('lib/Footlib'); ?>

		<!-- inline scripts related to this page -->

	</body>
</html>
