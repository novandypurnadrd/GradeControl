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
								<h1 class="text-primary">Stockpile activity record</h1>
							</div><!--end .col -->
						</div><!--end .row -->
						<!-- END INTRO -->

						<!-- BEGIN BASIC ELEMENTS -->
						<div class="row">
							<div class="col-md-12 col-sm-12">
								<div class="card">
									<div class="card-body">
										<form class="form" role="form" action="<?php echo base_url().'Oremined/ToStockpile/Filter' ?>" method="post">
                      <div class="col-md-1">

                      </div>
                      <!--  <div class="col-md-4 col-lg-4 col-xl-4">
                        <div class="form-group floating-label">
  											
  												<label for="Date" class="col-sm-2 control-label">Date</label>
														<div class="col-sm-10">
															<div class="input-group date" id="demo-date">
																<div class="input-group-content">
																	<input type="text" class="form-control" id="Date" name="Date" autocomplete="off" required value="<?php //echo $date?>">
																</div>
																<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
															</div>
														</div>

						     </div>
                      </div> -->
                      <div class="col-md-4 col-lg-4 col-xl-4">
                        <div class="form-group floating-label">
  												<select id="select2" name="Stockpile" required class="form-control">
  													<option value="">&nbsp;</option>
                            <?php foreach ($Stockpile as $stockpile): ?>
                              <option value="<?php echo $stockpile->id ?>" <?php if($stockpile->id == $selectedstockpile){echo "selected='true'";}?>><?php echo $stockpile->Nama ?></option>
                            <?php endforeach; ?>
  												</select>
  												<label for="select2">Stockpile</label>
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


						<?php foreach ($Table2 as $table2): ?> 
						
						<div class="col-md-12 col-sm-12">
						 <div class="col-md-2 col-sm-2">
                            <label for="Fresh" class="col-sm-4 control-label">Tonnes:</label>
                            <div class="col-sm-6">
                              <div class="input-group">
                                <div class="input-group-content">
                                  <input type="text" class="form-control" id="Tonnes" readonly="" name="Tonnes" value="<?php echo $table2->Tonnes ?>">
                                </div>
                               
                              </div>
                            </div>
                             
                          </div>
                           <div class="col-md-2 col-sm-2">
                            <label for="Clay" class="col-sm-4 control-label">Au:</label>
                            <div class="col-sm-6">
                              <div class="input-group">
                                <div class="input-group-content">
                                  <input type="text" class="form-control" id="Au" readonly="" name="Au" value="<?php echo $table2->Au ?>">
                                </div>
                               
                              </div>
                            </div>
                             
                              
                          </div>
                           <div class="col-md-2 col-sm-2">
                            <label for="Transisi" class="col-sm-4 control-label">Ag:</label>
                            <div class="col-sm-6">
                              <div class="input-group">
                                <div class="input-group-content">
                                  <input type="text" class="form-control" readonly="" id="Ag" name="Ag" value="<?php echo $table2->Ag ?>">
                                </div>
                               
                              </div>
                            </div>
                          
                             
                           </div>

                           <div class="col-md-2 col-sm-2">
                            <label for="Clay" class="col-sm-4 control-label">AuEq75:</label>
                            <div class="col-sm-6">
                              <div class="input-group">
                                <div class="input-group-content">
                                  <input type="text" class="form-control" id="AuEq75" readonly="" name="AuEq75" value="<?php echo $table2->AuEq75 ?>">
                                </div>
                               
                              </div>
                            </div>
                             
                              
                          </div>

                          <div class="col-md-2 col-sm-2">
                            <label for="Clay" class="col-sm-4 control-label">Class:</label>
                            <div class="col-sm-6">
                              <div class="input-group">
                                <div class="input-group-content">
                                  <input type="text" class="form-control" id="Class" readonly="" name="Class" value="<?php echo $table2->Class ?>">
                                </div>
                               
                              </div>
                            </div>
                             
                              
                          </div>

                          <div class="col-md-2 col-sm-2">
                            <label for="Clay" class="col-sm-4 control-label">Volume:</label>
                            <div class="col-sm-6">
                              <div class="input-group">
                                <div class="input-group-content">
                                  <input type="text" class="form-control" id="Volume" readonly="" name="Volume" value="<?php echo $table2->Volume ?>">
                                </div>
                               
                              </div>
                            </div>
                             
                              
                          </div>


						</div>
						<?php endforeach; ?>
						</div><!--end .row -->
						<br>
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
				                        <th>RL</th>
				                       
				                        <th>Density</th>
				                        <th>Tonnes (Dry)</th>
                                		<th>Au (g/t)</th>
				                        <th>Ag (g/t)</th>
				                        <th>AuEq75</th>
				                        <th>Class</th>
															</tr>
														</thead>
														<tbody>
															<?php foreach ($Table as $table) {
                                $Date = date("d-F-Y", strtotime($table->Start));
                                ?>
																<tr class="gradeX">
																
                                  <td><?php echo $Date; ?></td>
				                  <td><?php echo $table->RL; ?></td>
				                  
								  <td><?php echo number_format(round($table->Dbdensity*0.8,2), "2", ".",","); ?></td>
				                  <td><?php echo number_format($table->DryTonFF, "2", ".",","); ?></td>
                                  <td><?php echo number_format($table->Au, "2", ".",","); ?></td>
								  <td><?php echo number_format($table->Ag, "2", ".",","); ?></td>
								  <td><?php echo $table->AuEq75; ?></td>
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
