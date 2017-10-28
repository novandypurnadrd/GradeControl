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
								<h1 class="text-primary">Loader</h1>
							</div><!--end .col -->
						</div><!--end .row -->
						<!-- END INTRO -->

						<!-- BEGIN BASIC ELEMENTS -->
						<div class="row">
							<div class="col-md-12 col-sm-12">
								<div class="card">
									<div class="card-body">
										<form class="form" role="form" action="<?php echo base_url().'References/Loader/InputLoader' ?>" method="post">
                      <div class="row">
                        <div class="col-md-3 col-lg-3 col-xl-3">
                          <div class="form-group floating-label">
    												<input type="text" autocomplete="off" class="form-control" id="Capacity" name="Capacity" onkeyup="Counter()" required>
    												<label for="regular2">Bucket capacity (m3)</label>
    											</div>
                        </div>
                        <div class="col-md-3 col-lg-3 col-xl-3">
                          <div class="form-group floating-label">
                            <input type="text" autocomplete="off" class="form-control" id="Density" name="Density" onkeyup="Counter()" required>
                            <label for="regular2">Density (LCM)</label>
                          </div>
                        </div>
                        <div class="col-md-3 col-lg-3 col-xl-3">
                          <div class="form-group floating-label">
                            <input type="text" autocomplete="off" class="form-control" id="Tonnage" name="Tonnage" readonly="" placeholder="Tonnage">
                            <label for="regular2"></label>
                          </div>
                        </div>
                        <div class="col-md-3 col-lg-3 col-xl-3">
                          <div class="form-group floating-label">
    												<input type="text" autocomplete="off" class="form-control" id="Percentage" name="Percentage" onkeyup="Counter()" required>
    												<label for="regular2">Percentage Bucket</label>
    											</div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-3 col-lg-3 col-xl-3">
                          <div class="form-group floating-label">
                            <input type="text" autocomplete="off" class="form-control" id="Tonnageper" name="Tonnageper" readonly="" placeholder="Tonnage per Bucket" required>
                            <label for="regular2"></label>
                          </div>
                        </div>
                        <div class="col-md-3 col-lg-3 col-xl-3">
                          <div class="form-group floating-label">
                            <input type="text" autocomplete="off" class="form-control" id="Material" name="Material" required>
                            <label for="regular2">Material</label>
                          </div>
                        </div>
                        <div class="col-md-3 col-lg-3 col-xl-3">
                          <div class="form-group floating-label">
                            <input type="text" autocomplete="off" class="form-control" id="Equipment" name="Equipment" required>
                            <label for="regular2">Equipment</label>
                          </div>
                        </div>
                        <div class="col-md-3 col-lg-3 col-xl-3">
                          <div class="form-group">
                            <button type="submit" class="btn ink-reaction btn-raised btn-primary"><i class="md md-save"></i> Insert</button>
                          </div>
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
							   <form class="form-horizontal" role="form" action ="<?php echo base_url('References/Loader/Delete_multiple'); ?>" method="post">
                                    
							<div class="col-lg-12">
								<div class="table-responsive">
									<table id="datatable1" class="table table-striped table-hover">
										<thead>
											<tr>
											 <th width="75px"><center> <div class="">
                                                <input type="checkbox" id="checkAll" name="checkAll" >
                                                <label></label>
                                            </div></center></th>
												<!-- <?php //if ($this->session->userdata('roleGradeControl') == "Admin" || $this->session->userdata('GE')): ?>
													<th>Action</th>
												<?php //endif; ?> -->
                        <th>Bucket capacity (m3)</th>
                        <th>Density (LCM)</th>
                        <th>Tonnage</th>
                        <th>Percentage bucket (/100)</th>
                        <th>Tonnage per bucket</th>
                        <th>Material Type</th>
												<th>Equipment</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($Table as $table) { ?>
												<tr class="gradeX">
												  <td><center> <div class="">
                                                <input type="checkbox" name="msg[]" value="<?php echo $table->id; ?>">
                                                <label></label></center> </td>
													<!-- <?php //if ($this->session->userdata('roleGradeControl') == "Admin" || $this->session->userdata('GE')): ?>
														<td class="center">
														<center>
															<a>
															<button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#<?php //echo $table->id; ?>"><span class="fa fa-trash"></span>
															</button>
															</a>
														</center>
													</td>
													<?php //endif; ?> -->
                          <td><?php echo $table->Capacity; ?></td>
                          <td><?php echo $table->Density; ?></td>
                          <td><?php echo $table->Tonnage; ?></td>
                          <td><?php echo $table->Percentage; ?></td>
                          <td><?php echo $table->Tonnageper; ?></td>
                          <td><?php echo $table->Material; ?></td>
													<td><?php echo $table->Equipment; ?></td>
												</tr>
												<div class="modal fade" id="<?php echo $table->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
													<div class="modal-dialog" role="document">
														<div class="modal-content">
															<div class="modal-body">
																<h3>Are you sure? </h3>
															</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
																<a> <?php echo anchor('References/Loader/Delete/'.$table->id,'<button type="button" class="btn btn-danger">Delete</button>') ?></a>
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
									<div class="col-sm-6">
                                                 
                                                    <button type="sumbit" class="btn btn-danger btn-bordered"><i class=" mdi mdi-delete"></i>Delete</button>
                                                    
                                                </div>
							</form>
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
    <script type="text/javascript">
			$('#Capacity').on('change keyup', function() {
			  var sanitized = $(this).val().replace(/[^0-9,.]/g, '');
			  $(this).val(sanitized);
			});
			$('#Density').on('change keyup', function() {
			  var sanitized = $(this).val().replace(/[^0-9,.]/g, '');
			  $(this).val(sanitized);
			});
			$('#Percentage').on('change keyup', function() {
			  var sanitized = $(this).val().replace(/[^0-9,.]/g, '');
			  $(this).val(sanitized);
			});
		</script>
    <script type="text/javascript">
      function Counter(){
        var Capacity = document.getElementById("Capacity").value;
        var Density = document.getElementById("Density").value
        var Percentage = document.getElementById("Percentage").value;
        var Tonnage = document.getElementById("Tonnage");
        var Tonnageper = document.getElementById("Tonnageper");

        Tonnage.value = (Capacity*Density).toFixed(2);
        Tonnageper.value = (Tonnage.value*Percentage).toFixed(2);
      }
    </script>
		<!-- END JAVASCRIPT -->
		<!-- END FOOTLIB -->

	</body>
</html>
