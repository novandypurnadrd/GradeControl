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

		 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([

      
           
            ['Material', 'Percentage'],
            ['<?php echo "Clay"?>', <?php echo $clay ?>],
            ['<?php echo "Fresh"?>', <?php echo $fresh ?>],
            ['<?php echo "Transisi"?>', <?php echo $transisi ?>],
         
        ]);

        var options = {
          title: 'Feed Material All Stockpile',
         
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
      </script>

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
								<h1 class="text-primary">Orefeed activity record</h1>
							</div><!--end .col -->
						</div><!--end .row -->
						<!-- END INTRO -->

						<!-- BEGIN BASIC ELEMENTS -->
						<div class="row">
							<div class="col-md-12 col-sm-12">
								<div class="card">
									<div class="card-body">
										<form class="form" role="form" action="<?php echo base_url().'OreFeed/Table/Filter' ?>" method="post">
                      <div class="col-md-1">

                      </div>
                      <div class="col-md-4 col-lg-4 col-xl-4">
                        <div class="form-group floating-label">
  											
  												<label for="Date" class="col-sm-2 control-label">Date</label>
														<div class="col-sm-10">
															<div class="input-group date" id="demo-date">
																<div class="input-group-content">
																	<input type="text" class="form-control" id="Date" name="Date" autocomplete="off" required="" value="<?php echo $date?>">
																</div>
																<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
															</div>
														</div>

						     </div>
                      </div>
                      <div class="col-md-4 col-lg-4 col-xl-4">
                        <div class="form-group floating-label">
                        	<label for="select2">Stockpile</label>
  												<select id="select2" name="Stockpile" class="form-control">
  													<option value="All">All</option>
                            <?php foreach ($Stockpile as $stockpile): ?>
                              <option value="<?php echo $stockpile->id ?>" <?php if($stockpile->id == $selectedstockpile){echo "selected='true'";}?>><?php echo $stockpile->Nama ?></option>
                            <?php endforeach; ?>
  												</select>
  												
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
<!-- 
					

						

						<!-- BEGIN TABLE -->
						<div class="row">
							<div class="col-md-8 col-lg-8 col-xl-8">
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
										<th>Date</th>
                                		<th>Stockpile</th>
				                        <th>Au</th>
				                        <th>Ag</th>
				                        <th>AuEq75</th>
				                        <th>Tonnes</th>
				                        <th>Adj Au(Persen)</th>
				                        <th>Adj Au</th>
				                        <th>Adj Ag(Persen)</th>
                                		<th>Adj Ag</th>
				                        <th>Density</th>
				                        <th>Volume</th>
				                        <th>Loader</th>
				                        <th>Tonnes to Crush</th>
															</tr>
														</thead>
														<tbody>
															<?php foreach ($Table as $table) {$tanggal = date("d-F-Y", strtotime($table->tanggal)); ?>
																<tr class="gradeX">
																	<?php if ($this->session->userdata('roleGradeControl') == "Admin" || $this->session->userdata('GE')): ?>
																		<td class="center">
																		<center>
																			<a>
																				<button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#<?php echo $table->id; ?>"><span class="fa fa-trash"></span>
																				</button>
																			</a>
																			<!-- <a href="<?php //echo base_url().'OreFeed/Table/Update/'.$table->id ?>">
																			 	<button type="button" class="btn btn-xs btn-info"><span class="fa fa-edit"></span>
																				</button>
																			</a> -->
																		</center>
																	</td>
																	<?php endif; ?>
				                          <td><?php echo $tanggal; ?></td>
				                          <td><?php echo $table->Stockpile; ?></td>
																	
				                          <td><?php echo $table->Au; ?></td>
										  <td><?php echo $table->Ag; ?></td>
										  <td><?php echo $table->AuEq75; ?></td>
				                          <td><?php echo $table->Tonnes; ?></td>
										  <td><?php echo $table->AdjAuPersen; ?></td>
										  <td><?php echo $table->AdjAu; ?></td>
										  <td><?php echo $table->AdjAgPersen; ?></td>
										  <td><?php echo $table->AdjAg; ?></td>
										  <td><?php echo $table->Density; ?></td>
										  <td><?php echo $table->Volume; ?></td>
										  <td><?php echo $table->Loader; ?></td>
										  <td><?php echo $table->Tonnestocrush; ?></td>

																</tr>
																<div class="modal fade" id="<?php echo $table->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
																	<div class="modal-dialog" role="document">
																		<div class="modal-content">
																			<div class="modal-body">
																				<h3>Are you sure? </h3>
																			</div>
																			<div class="modal-footer">
																				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
																				<a> <?php echo anchor('OreFeed/Table/DeleteOreFeed/'.$table->id,'<button type="button" class="btn btn-danger">Delete</button>') ?></a>
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
							 <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <div class="widget-box transparent">
             
                      <div class="widget-body">
                        <div class="widget-main" style="">
                          <div id="piechart" style="width: 385px; height: 250px;"></div>
                        </div>
                      </div>
                    </div>
                  </div>
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
