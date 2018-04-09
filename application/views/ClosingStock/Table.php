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
		<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/theme-default/libs/DataTables/jquery.dataTables.css?1423553989" />
		<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/theme-default/libs/DataTables/extensions/dataTables.colVis.css?1423553990" />
		<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/theme-default/libs/DataTables/extensions/dataTables.tableTools.css?1423553990" />
		<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/buttons.dataTables.min.css"/>
		<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/theme-default/libs/bootstrap-datepicker/datepicker3.css?1424887858" />

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

						<!-- BEGIN INTRO -->
						<div class="row">
							<div class="col-lg-12">
								<h1 class="text-primary">Closingstock record</h1>
							</div><!--end .col -->
						</div><!--end .row -->
						<!-- END INTRO -->

						<!-- BEGIN BASIC ELEMENTS -->
						<div class="row">
							<div class="col-md-12 col-sm-12">
								<div class="card">
									<div class="card-body">
										<form class="form" role="form" action="<?php echo base_url().'Closingstock/Table/Filter' ?>" method="post">
                      <div class="col-md-1">

                      </div>
              
                       <div class="col-md-4 col-lg-4 col-xl-4">
                        <div class="form-group floating-label">
  											
  												<label for="Date" class="col-sm-2 control-label">Date</label>
														<div class="col-sm-10">
															<div class="input-group date" id="demo-date">
																<div class="input-group-content">
																	<input type="text" class="form-control" id="Date" name="Date" required="" autocomplete="off" value="<?php echo $date?>">
																</div>
																<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
															</div>
														</div>

						     </div>
                      </div>
                      <div class="col-md-4 col-lg-4 col-xl-4">
                        <div class="form-group floating-label">
  											
  						 <div class="col-md-12 col-sm-12">
                            <label for="Aggt" class="col-sm-3 control-label">Stockpile</label>
                            <div class="col-sm-9">
                              <select id="Stockpile" name="Stockpile" class="form-control" required="">
                                <option value="All">All</option>
                                <?php foreach ($Stockpile as $stockpile): ?>
                                  <option value="<?php echo $stockpile->id ?>" <?php if($stockpile->id == $selectedstockpile){echo "selected='true'";}?> ><?php echo $stockpile->Nama ?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                          </div>

						     </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <button type="submit" class="btn ink-reaction btn-raised btn-primary"><i class="md md-center-focus-strong"></i> Filter</button>
                        </div>
                      </div>
										</form>
									</div><!--end .card-body -->
								</div><!--end .card -->
							</div><!--end .col -->
						</div><!--end .row -->
						<!-- END BASIC ELEMENTS -->

						<!-- BEGIN TABLE -->
						<div class="row">
							<div class="col-md-12 col-lg-12 col-xl-12">
								<div class="card">
									<div class="card-body">
										<div class="row">
											<div class="col-md-12 col-lg-12 col-xl-12">
												<h4>Table</h4>
											</div><!--end .col -->
											<div class="col-lg-12">
												<div class="table-responsive">
													<table id="datatable1" class="table table-striped table-hover">
														<thead>
															<tr>
										
										<th>Date</th>
                                		<th>Stockpile</th>
				                       <!--  <th>Volume</th>
				                        <th>Density</th> -->
				                        <th>Tonnes</th>
				                        <th>Au</th>
				                        <th>Ag</th>
				                        <th>AuEq75</th>
				                        <th>Class</th>
                                		
															</tr>
														</thead>
														<tbody>
															<?php foreach ($Table as $table) {

																if($date == null){
																	$tanggal = date("d-F-Y", strtotime($table->Date));	
																}
																else{
																	$tanggal = date("d-F-Y", strtotime($date));	
																}

																 


																?>


																<tr class="gradeX">

																<?php 

																//$Volume = $table->Volume;
										

																// if($table->Volume == 0){
																// 	$Volume = "-";

																// }
																// $Density = $table->Density;
																// if ($table->Density == 0) {
																// 	$Density = "-";
																// }
																$Tonnes = $table->Tonnes;
																if ($table->Tonnes == 0) {
																	$Tonnes = "-";
																}
																$Au = $table->Au;
																if ($table->Au == 0) {
																	$Au = "-";
																}
																$Ag = $table->Ag;
																if ($table->Ag == 0) {
																	$Ag = "-";
																}
																$AuEq75 = $table->AuEq75;
																if ($table->AuEq75 == 0) {
																	$AuEq75 = "-";
																}  

																 ?>
																	
				                          <td><?php echo $tanggal; ?></td>
				                          <td><?php echo $table->Stockpile; ?></td>
																	
				                         <!--  <td><?php //echo $Volume; ?></td>
										  <td><?php //echo $Density; ?></td> -->
										  <td><?php echo $Tonnes; ?></td>
				                          <td><?php echo $Au; ?></td>
										  <td><?php echo $Ag; ?></td>
										  <td><?php echo $AuEq75; ?></td>
										  <td><?php echo $table->Class; ?></td>
									

																</tr>
															
																<?php }
															?>
														</tbody>
													</table>
												</div><!--end .table-responsive -->
											</div><!--end .col -->
										</div><!--end .row -->
									</div><!--end .card-body -->
								</div><!--end .card -->
							</div><!--end .col -->
						</div><!--end .row -->
						<!-- END TABLE -->

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
		<!-- END JAVASCRIPT -->
		<!-- END FOOTLIB -->

	</body>
</html>
