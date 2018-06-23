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
								<h1 class="text-primary">General Record Ore</h1>
							</div><!--end .col -->
						</div><!--end .row -->
						<!-- END INTRO -->

						<!-- BEGIN BASIC ELEMENTS -->
						<div class="row">
							<div class="col-md-12 col-sm-12">
								<div class="card">
									<div class="card-body">
										<form class="form" role="form" action="<?php echo base_url().'OreInventory/Table/FilterGeneral' ?>" method="post">
                        <div class="col-md-4 col-lg-4 col-xl-4">
                        <div class="form-group floating-label">
  											
  												<label for="Date" class="col-sm-4 control-label">Date Range</label>
														<div class="col-sm-10">
															<div class="input-daterange input-group" id="demo-date-range">
																<div class="input-group-content">
																<input type="text" class="form-control" name="start" id="start" value="<?php echo $dateStart ?>" />
																
																</div>
													<span class="input-group-addon">to</span>
																<div class="input-group-content">
																	<input type="text" class="form-control" name="end" id="end" value="<?php echo $dateEnd ?>" />
																	<div class="form-control-line"></div>
																</div>
															</div>
														</div>

						     </div>
                      </div>
                      <div class="col-md-4 col-lg-4 col-xl-4">
                        <div class="form-group floating-label">
  												<select id="select2" name="Pit" class="form-control">
  													<option value="All">All</option>
                            <?php foreach ($Pit as $pit): ?>
                              <option value="<?php echo $pit->id ?>" <?php if($pit->id == $pitselected){echo "selected='true'";}?>><?php echo $pit->Nama ?></option>
                            <?php endforeach; ?>
  												</select>
  												<label for="select2">Select Pit</label>
						            </div>
                      </div>
                      <div class="col-md-1 col-lg-1 col-xl-1">

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

							<div class="row">
							<div class="col-md-6 col-sm-6">
								<div class="card">
									<div class="card-body">
										<form class="form" role="form" action="<?php echo base_url().'OreInventory/Table/SearchBlock' ?>" method="post">

                        <div class="col-md-8 col-sm-8">
                        	<div class="form-group floating-label">
  											
  								
                            <label for="Au" class="col-sm-4 control-label" id="nonore">Block</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="block" name="block" autocomplete="off" value="<?php echo $Block ?>">
                            </div>
                        </div>

                      </div>
                   
                      <div class="col-md-3">
                        <div class="form-group">
                          <button type="submit" class="btn ink-reaction btn-raised btn-primary"><i class="md md-center-focus-strong"></i> Search</button>
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
																
																
																	<th>Start Date</th>
																	<th>Finish Date</th>
																	<th>Stockpile</th>
											                        <th>Block</th>
											                        <th>RL</th>
											                        <th>Au</th>
											                        <th>Ag</th>
											                        <th>AuEq75</th>
											                        <th>Class</th>
											                        <th>Dry Ton BM</th>
											                        <th>Dry Ton (Final Figure)</th>
											                        <th>Density</th>
											                        <th>Value</th>
											                        <th>Achievement</th>
																	<th>Status</th>
																	<th>Comment</th>
															</tr>
														</thead>
														<tbody>

														<?php

															foreach ($TableDistinct as $distinct) {
																$jmltonnes =0;
																$first = "0000-00-00";
																foreach ($Table as $table) {

																	if($distinct->Block == $table->Block){
																		$jmltonnes = $jmltonnes + $table->DryTonFF;

																		$datestart = $table->Start;

																if($first == "0000-00-00"){
																	$first = $table->Start;
																}

																
																if($first <= $datestart){
																	$datestart = $first;
																}
																else{
																	
																	$datestart = $table->Start;
																}

																

																$first = $table->Start;

																if($table->Finish != null){
																	$datefinish = date("d-F-Y", strtotime($table->Finish));
																}
																else{
																	$datefinish = "-";
																}

																$Stockpile = $table->Stockpile;
																$Block = $table->Block;
																$RL = $table->RL;
																$Au = $table->Au;
																$Ag = $table->Ag;
																$Augt = $table->Augt;
																$Aggt = $table->Aggt;

																$AuEq75 = $table->AuEq75;
																$Class  = $table->Class;
																$DryTonBM = $table->DryTonBM;
																$DryTonFF = $jmltonnes;
																$Dbdensity = $table->Dbdensity;
																$Value = $table->Value;
																$Achievement = $table->Achievement;
																$Status = $table->Status;
																$Note = $table->Note;


																	}
																
																}
																?>

																<tr>
																

										  <td><?php echo date("d-F-Y", strtotime($datestart)); ?></td>
										  <td><?php echo $datefinish; ?></td>
										  <td><?php echo $Stockpile; ?></td>
				                          <td><?php echo $Block; ?></td>
				                          <td><?php echo $RL; ?></td>
																	<?php
																		if ($Status == "Continue") { ?>
																			<td><?php echo $Au; ?></td>
						                          							<td><?php echo $Ag; ?></td>
																		<?php }else {
																			if ($table->Achievement >= 80) { ?>
																				<td><?php echo $Augt; ?></td>
							                          							<td><?php echo $Aggt; ?></td>
																			<?php }else { ?>
																				<td><?php echo $Au; ?></td>
							                          							<td><?php echo $Ag; ?></td>
																			<?php }
																			 }
																	?>
										  <td><?php echo $AuEq75; ?></td>
										  <td><?php echo $Class; ?></td>
				                          <td><?php echo $DryTonBM; ?></td>
											<td><?php echo $DryTonFF; ?></td>
				                          <td><?php echo $Dbdensity; ?></td>
				                          <td><?php echo $Value; ?></td>
				                          							<td><?php echo $Achievement."%"; ?></td>
																	<td><?php echo $Status; ?></td>
																	<td><?php echo $Note; ?></td>
																</tr>



														

														
																
																<div class="modal fade" id="<?php echo $table->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
																	<div class="modal-dialog" role="document">
																		<div class="modal-content">
																			<div class="modal-body">
																				<h3>Are you sure? </h3>
																			</div>
																			<div class="modal-footer">
																				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
																				<a> <?php echo anchor('OreInventory/Table/DeleteOreInventory/'.$table->id,'<button type="button" class="btn btn-danger">Delete</button>') ?></a>
																			</div>
																		</div>
																	</div>
																</div>
																<?php 


															}

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
	<!-- 	<script type="text/javascript">


			$(document).ready(function() {
				$('#datatable1').DataTable( {
						dom: 'Bfrtip',
						buttons: [
								'copy', 'csv', 'excel', 'pdf', 'print'
						]
				} );
			} );
		</script> -->

		
		<!-- END JAVASCRIPT -->
		<!-- END FOOTLIB -->

	</body>
</html>
