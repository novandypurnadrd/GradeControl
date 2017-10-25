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
					<div class="section-body contain-lg">

						<!-- BEGIN BASIC ELEMENTS -->
						<!-- BEGIN TITLE -->
            <form class="form" class="form-horizontal" role="form" action="<?php echo base_url().'Closingstock/Boulder/InputBoulder' ?>" method="post">
  						<div class="row">
  							<div class="col-lg-6">
  								<h2 class="text-primary">Boulder</h2>
  							</div><!--end .col -->
  					
  						</div><!--end .row -->
  						<!-- END TITLE -->
  						<div class="row">

  							<div class="col-md-12 col-sm-12">
  								<div class="card">
  									<div class="card-body">
  										<div class="form-horizontal">
                      </br>
  											<div class="form-group">
                          <div class="col-md-3 col-sm-3">
                            <label for="Date" class="col-sm-2 control-label">Date</label>
                            <div class="col-sm-8">
                              <div class="input-group date" id="demo-date">
                                <div class="input-group-content">
                                  <input type="text" class="form-control" id="Date" name="Date" autocomplete="off" value="<?php echo $date?>">
                                </div>
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                              </div>
                            </div>
                          </div>
  												<div class="col-md-3 col-sm-3">
  													<label for="DryTonFF" class="col-sm-4 control-label">Dry Ton</label>
  													<div class="col-sm-8">
  														<input type="text" class="form-control" id="DryTonFF" name="DryTonFF" onkeyup="Counter()" required="" autocomplete="off">
  													</div>
  												</div>
                          <div class="col-md-3 col-sm-3">
                            <label for="DryTonFF" class="col-sm-4 control-label">Au (g/t)</label>
  													<div class="col-sm-4">
                              <div class="input-group">
      													<div class="input-group-content">
      														<input type="text" class="form-control" id="Augt" name="Augt">
      													</div>
      													
      												</div>
  													</div>
  												</div>
                           <div class="col-md-3 col-sm-3">
                            <label for="DryTonFF" class="col-sm-4 control-label">Ag (g/t)</label>
                            <div class="col-sm-4">
                              <div class="input-group">
                                <div class="input-group-content">
                                  <input type="text" class="form-control" id="Aggt" name="Aggt">
                                </div>
                               
                              </div>
                            </div>
                          </div>
              

  											</div>
                <br>
  							<div class= "col-md-5 col-sm-5">
                </div>			
  						  <div class="col-md-3 col-sm-3">
                  <div class="form-group">
                    <button type="submit" class="btn ink-reaction btn-raised btn-primary"><i class="md md-save"></i> Insert</button>
                  </div>
                </div><!--end .col -->
                    
  										</div>
  									</div><!--end .card-body -->
  								</div><!--end .card -->
  							</div><!--end .col -->
  						</div><!--end .row -->
  						
              <div class="row" style="text-align:center">
  							
  						</div><!--end .row -->


                <!-- <div class="row">

                <div class="col-md-12 col-sm-12">
                  <div class="card">
                    <div class="card-body">

                   
               
                      <div class="col-md-5 col-lg-5 col-xl-5">
                        <div class="form-group">
                        
                          <label for="Date" class="col-sm-2 control-label">Date</label>
                            <div class="col-sm-8">
                              <div class="input-group date" id="demo-date">
                                <div class="input-group-content">
                                  <input type="text" class="form-control" id="Date" name="Date" autocomplete="off" value="<?php //echo $date?>">
                                </div>
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                              </div>
                            </div>

                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <button type="submit" class="btn ink-reaction btn-raised btn-primary"><i class="md md-center-focus-strong"></i> Filter</button>
                        </div>
                      </div>
                      

                    </div><!--end .card-body -->
                  <!-- </div>end .card  -->
                <!-- </div>end .col  -->
              <!-- </div>end .row  --> 

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
                                <th>Date</th>
                                <th>Stockpile</th> 
                                <th>Tonnes</th>
                                <th>Au</th>
                                <th>Ag</th>
                                
                                    
                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach ($Table as $table) { $Date = date("d-F-Y", strtotime($table->Date));
                              ?>
                                <tr class="gradeX">
                                  <?php if ($this->session->userdata('roleGradeControl') == "Admin" || $this->session->userdata('GE')): ?>
                                    <td class="center">
                                    <center>
                                      <a>
                                        <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#<?php echo $table->Id; ?>"><span class="fa fa-trash"></span>
                                        </button>
                                      </a>
                                     
                                    </center>
                                  </td>
                                  <?php endif; ?>
                                  <td><?php echo $Date; ?></td>
                                  <td><?php echo $table->Stockpile; ?></td>
                  
                                  <td><?php echo $table->Tonnes; ?></td>
                                  <td><?php echo $table->Au; ?></td>
                                  <td><?php echo $table->Ag; ?></td>

                                </tr>
                                <div class="modal fade" id="<?php echo $table->Id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-body">
                                        <h3>Are you sure? </h3>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                        <a> <?php echo anchor('Closingstock/Boulder/DeleteBoulder/'.$table->Id,'<button type="button" class="btn btn-danger">Delete</button>') ?></a>
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

            </form>
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


  
		<!-- END JAVASCRIPT -->

	</body>
</html>
