<!DOCTYPE html>
<html lang="en">
	<head>

    <!-- HEADLIB -->
		<?php $this->load->view('lib/Headlib'); ?>
		<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/theme-default/libs/DataTables/jquery.dataTables.css?1423553989" />
		<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/theme-default/libs/DataTables/extensions/dataTables.colVis.css?1423553990" />
		<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/theme-default/libs/DataTables/extensions/dataTables.tableTools.css?1423553990" />
		<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/buttons.dataTables.min.css"/>
		<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/theme-default/libs/bootstrap-datepicker/datepicker3.css?1424887858" />
		<!-- END HEADLIB -->

	</head>
	<body onload="StockpileChange()" class="menubar-hoverable header-fixed ">

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
					<div class="section-body contain-lg">

						<!-- BEGIN BASIC ELEMENTS -->
						<!-- BEGIN TITLE -->

			<!-- START TITLE -->
              <div class="row">
              	<div class="col-lg-2">
                  <h2 class="text-primary"></h2>
                </div><!--end .col -->
                <div class="col-lg-6">
                  <h2 class="text-primary">Update Bleding Plan</h2>
                </div><!--end .col -->
                
              </div><!--end .row -->
              <!-- END TITLE -->

			<?php foreach ($Table as $tbl) { ?>


					<form class="form" class="form-horizontal" role="form" action="<?php echo base_url().'BlendingPlan/Input/UpdateValue/'.$tbl->id ?>" method="post">
  						
  						
  						<div class="row">
  							<div class="col-md-2 col-sm-2 col-lg-2 col-xl-2">
  							</div>

  							<div class="col-md-6 col-sm-6">
  								<div class="card">
  									<div class="card-body">
  										<div class="form-horizontal">

						  						
											
												<div class="form-group">
													<div class="col-md-12 col-sm-12">
														<label for="DryTonBM" class="col-sm-2 control-label">Blending</label>
														<div class="col-sm-10">
															<input type="text" class="form-control" id="Blending" name="Blending" autocomplete="off" required="" value = "<?php echo $tbl->Blending; ?>">
														</div>
													</div>
												
												</div>
												<div class="form-group">
													<div class="col-md-6 col-sm-6">
														<label for="DryTonBM" class="col-sm-4 control-label">Au(g/t)</label>
														<div class="col-sm-8">
															<input type="text" class="form-control" id="Augt" name="Augt" autocomplete="off" required value = "<?php echo $tbl->Augt; ?>">
														</div>
													</div>
													<div class="col-md-6 col-sm-6">
														<label for="DryTonBM" class="col-sm-4 control-label">Ag(g/t)</label>
														<div class="col-sm-8">
															<input type="text" class="form-control" id="Aggt" name="Aggt" autocomplete="off" onkeyup="CalculateAuEq()" required="" value = "<?php echo $tbl->Aggt; ?>">
														</div>
													</div>
												</div>
												<br>
												<div class="form-group">
												

													<div class="col-md-6 col-sm-6">
														<label for="DryTonBM" class="col-sm-4 control-label">AuEq75</label>
														<div class="col-sm-8">
															<input type="text" class="form-control" id="AuEq75" name="AuEq75" autocomplete="off" readonly="" value = "<?php echo $tbl->AuEq75; ?>">
														</div>
													</div>

													<div class="col-md-6 col-sm-6">
						                            <label for="Date" class="col-sm-4 control-label">Date</label>
						                            <div class="col-sm-8">
						                              <div class="input-group date" id="demo-date">
						                                <div class="input-group-content">
						                                  <input type="text" class="form-control" id="Date" name="Date" autocomplete="off" required="" value="<?php echo explode('-',$tbl->Date)[1].'/'.explode('-',$tbl->Date)[2].'/'.explode('-',$tbl->Date)[0] ?>">
						                                </div>
						                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
						                              </div>
						                            </div>
						                          </div>

												</div>

												<br>
												<br>

												<div class="form-group">	
						                            <div class="col-md-12 col-sm-12">

														<div class = "col-md-4 col-sm-4 col-lg-4">
														</div>
														 <div class="col-md-6 col-sm-6 col-lg-6">
                    											<button type="submit" class="btn ink-reaction btn-raised btn-primary" id="button" name="button"><i class="md md-save"></i> Update</button>
                    											<a class="btn ink-reaction btn-raised btn-information" href="<?php echo base_url().'BlendingPlan/Input' ?>">Cancel
                    											</a>
                										</div>
													</div>
 
    											</div>
													
												</div>
												
											
												
											
  								
  									</div><!--end .card-body -->
  								</div><!--end .card -->
  							</div><!--end .col -->
  							</form>



			<?php } ?>
            

  						
                     
               
              

    	</div><!--end .row -->
  
    			

    			
						<!-- END BASIC ELEMENTS -->

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

		<!-- BEGIN JAVASCRIPT -->
		<?php $this->load->view('lib/Footlib'); ?>
   		<script src="<?php echo base_url();?>assets/js/libs/jquery/jquery-1.11.2.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/libs/jquery/jquery-migrate-1.2.1.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/libs/bootstrap/bootstrap.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/libs/spin.js/spin.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/libs/autosize/jquery.autosize.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/libs/nanoscroller/jquery.nanoscroller.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/core/source/App.js"></script>
		<script src="<?php echo base_url();?>assets/js/core/source/AppNavigation.js"></script>
		<script src="<?php echo base_url();?>assets/js/core/source/AppForm.js"></script>
		<script src="<?php echo base_url();?>assets/js/libs/bootstrap-datepicker/bootstrap-datepicker.js"></script>
		<script src="<?php echo base_url();?>assets/js/core/demo/DemoFormComponents.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery-1.12.4.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/dataTables.buttons.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/buttons.flash.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/jszip.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/pdfmake.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/vfs_fonts.js"></script>
		<script src="<?php echo base_url();?>assets/js/buttons.html5.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/buttons.print.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/core/demo/DemoTableDynamic.js"></script>
		
    <script type="text/javascript">
      

	 function CalculateAuEq(){
      	
      	var Augt = document.getElementById("Augt");
      	var Aggt =  document.getElementById("Aggt");
      	
      	var AuEq75 = document.getElementById("AuEq75");

      	
      	AuEq75.value = (parseFloat(Augt.value) + parseFloat(Aggt.value/75)).toFixed(2);
      }


	</script>
		<!-- END JAVASCRIPT -->

	</body>
</html>
