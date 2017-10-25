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
								<h1 class="text-primary">Oremined</h1>
							</div><!--end .col -->
						</div><!--end .row -->
						<!-- END INTRO -->

						<!-- BEGIN BASIC ELEMENTS -->
						<div class="row">
							<div class="col-md-12 col-sm-12">
								<div class="card">
									<div class="card-body">
										<form class="form" role="form" action="<?php echo base_url().'Oremined/Table/Filter' ?>" method="post">
                      <div class="col-md-1 col-lg-1 col-xl-1">

                      </div>
                      <div class="col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group floating-label">
  												<select id="select2" name="Pit" class="form-control">
  													<option value="">&nbsp;</option>
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
																<?php if ($this->session->userdata('roleGradeControl') == "Admin" || $this->session->userdata('GE')): ?>
																	<th>Action</th>
																<?php endif; ?>
				                        <th>Block</th>
				                        <th>RL</th>
				                        <th>Au</th>
				                        <th>Ag</th>
				                        <th>Dry Ton BM</th>
				                        <th>Truck Tally</th>
				                        <th>Density</th>
																<th>to Stockpile</th>
																<th>Remarks</th>
															</tr>
														</thead>
														<tbody>
															<?php foreach ($Table as $table) { ?>
																<tr class="gradeX">
																	<?php if ($this->session->userdata('roleGradeControl') == "Admin" || $this->session->userdata('GE')): ?>
																		<td class="center">
																		<center>
																			<a>
																				<button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#<?php echo $table->id; ?>"><span class="fa fa-trash"></span>
																				</button>
																			</a>
																			<a href="<?php echo base_url().'Oremined/Table/Update/'.$table->id ?>">
																			 	<button type="button" class="btn btn-xs btn-info"><span class="fa fa-edit"></span>
																				</button>
																			</a>
																		</center>
																	</td>
																	<?php endif; ?>
				                          <td><?php echo $table->Block; ?></td>
				                          <td><?php echo $table->RL; ?></td>
																	<?php
																		if ($table->Status == "Continue") { ?>
																			<td><?php echo $table->Au; ?></td>
						                          <td><?php echo $table->Ag; ?></td>
																		<?php }else { ?>
																			<td><?php echo $table->Augt; ?></td>
						                          <td><?php echo $table->Aggt; ?></td>
																		<?php }
																	?>
				                          <td><?php echo $table->DryTon; ?></td>
																	<td><?php echo $table->TruckTally; ?></td>
				                          <td><?php echo $table->Dbdensity; ?></td>
																	<td><?php echo $table->Stockpile; ?></td>
																	<td><?php echo $table->Status; ?></td>
																</tr>
																<div class="modal fade" id="<?php echo $table->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
																	<div class="modal-dialog" role="document">
																		<div class="modal-content">
																			<div class="modal-body">
																				<h3>Are you sure? </h3>
																			</div>
																			<div class="modal-footer">
																				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
																				<a> <?php echo anchor('Oremined/Table/DeleteOremined/'.$table->id,'<button type="button" class="btn btn-danger">Delete</button>') ?></a>
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
		<script src="<?php echo base_url();?>assets/js/libs/DataTables/jquery.dataTables.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/libs/DataTables/extensions/ColVis/js/dataTables.colVis.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/libs/DataTables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/libs/nanoscroller/jquery.nanoscroller.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/core/source/App.js"></script>
		<script src="<?php echo base_url();?>assets/js/core/source/AppNavigation.js"></script>
		<script src="<?php echo base_url();?>assets/js/core/source/AppOffcanvas.js"></script>
		<script src="<?php echo base_url();?>assets/js/core/source/AppCard.js"></script>
		<script src="<?php echo base_url();?>assets/js/core/source/AppForm.js"></script>
		<script src="<?php echo base_url();?>assets/js/core/source/AppNavSearch.js"></script>
		<script src="<?php echo base_url();?>assets/js/core/source/AppVendor.js"></script>
		<script src="<?php echo base_url();?>assets/js/core/demo/DemoTableDynamic.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery-1.12.4.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/dataTables.buttons.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/buttons.flash.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/jszip.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/vfs_fonts.js"></script>
		<script src="<?php echo base_url();?>assets/js/buttons.html5.min.js"></script>
		<script type="text/javascript">
		$(document).ready(function() {
			$('#datatable1').DataTable( {
					dom: 'Bfrtip',
					buttons: [
							'copy', 'csv', 'excel', 'pdf', 'print'
					]
			} );
		} );
		</script>
		<!-- END JAVASCRIPT -->
		<!-- END FOOTLIB -->

	</body>
</html>
