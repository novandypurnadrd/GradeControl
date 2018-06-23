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
								<h1 class="text-primary">General Record Mineralized Waste</h1>
							</div><!--end .col -->
						</div><!--end .row -->
						<!-- END INTRO -->

						<!-- BEGIN BASIC ELEMENTS -->
						<div class="row">
							<div class="col-md-12 col-sm-12">
								<div class="card">
									<div class="card-body">
										<form class="form" role="form" action="<?php echo base_url().'OreInventory/Table/FilterGeneralMinWaste' ?>" method="post">
                        <div class="col-md-4 col-lg-4 col-xl-4">
                        <div class="form-group floating-label">
  											
  												<label for="Date" class="col-sm-2 control-label">Date</label>
														<div class="col-sm-10">
															<div class="input-group date" id="demo-date">
																<div class="input-group-content">
																	<input type="text" class="form-control" id="Date" name="Date" autocomplete="off" value="<?php echo $date?>">
																</div>
																<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
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
																
																	<th>Action</th>
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




															<?php foreach ($Table as $table) {$datestart = date("d-F-Y", strtotime($table->Start)); 

																if($table->Finish != null){
																	$datefinish = date("d-F-Y", strtotime($table->Finish));
																}
																else{
																	$datefinish = "-";
																}
																							  ?>
																<tr>

																	<?php if ($this->session->userdata('roleGradeControl') == "Admin" || $this->session->userdata('GE')): ?>
																		<td class="center">

																		<center>
																			<a>
																				<button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#<?php echo $table->id; ?>"><span class="fa fa-trash"></span>
																				</button>
																			</a>
																			<a href="<?php echo base_url().'OreInventory/Table/UpdateMinWaste/'.$table->id ?>">
																			 	<button type="button" class="btn btn-xs btn-info"><span class="fa fa-edit"></span>
																				</button>
																			</a>
																		</center>
																	</td>
																	<?php endif; ?>
																

										  <td><?php echo $datestart; ?></td>
										  <td><?php echo $datefinish; ?></td>
										  <td><?php echo $table->Stockpile; ?></td>
				                          <td><?php echo $table->Block; ?></td>
				                          <td><?php echo $table->RL; ?></td>
																	<?php
																		if ($table->Status == "Continue") { ?>
																			<td><?php echo $table->Au; ?></td>
						                          							<td><?php echo $table->Ag; ?></td>
																		<?php }else {
																			if ($table->Achievement >= 80) { ?>
																				<td><?php echo $table->Augt; ?></td>
							                          							<td><?php echo $table->Aggt; ?></td>
																			<?php }else { ?>
																				<td><?php echo $table->Au; ?></td>
							                          							<td><?php echo $table->Ag; ?></td>
																			<?php }
																			 }
																	?>
										  <td><?php echo $table->AuEq75; ?></td>
										  <td><?php echo $table->Class; ?></td>
				                          <td><?php echo $table->DryTonBM; ?></td>
											<td><?php echo $table->DryTonFF; ?></td>
				                          <td><?php echo $table->Dbdensity; ?></td>
				                          <td><?php echo $table->Value; ?></td>
				                          							<td><?php echo $table->Achievement."%"; ?></td>
																	<td><?php echo $table->Status; ?></td>
																	<td><?php echo $table->Note; ?></td>
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
