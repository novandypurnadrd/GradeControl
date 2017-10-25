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
            <form class="form" class="form-horizontal" role="form" action="<?php echo base_url().'OtherSampling/AcidSample/InputAcidSample' ?>" method="post">
              <div class="row">
                <div class="col-lg-6">
                  <h2 class="text-primary">Acid Sample</h2>
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
                            <label for="DryTonFF" class="col-sm-4 control-label">From Hole ID</label>
                            <div class="col-sm-6">
                              <div class="input-group">
                                <div class="input-group-content">
                                  <input type="text" class="form-control" id="fromholeid" name="fromholeid">
                                </div>
                               
                              </div>
                            </div>
                          </div>
                           <div class="col-md-3 col-sm-3">
                            <label for="DryTonFF" class="col-sm-4 control-label">From Sample</label>
                            <div class="col-sm-6">
                              <div class="input-group">
                                <div class="input-group-content">
                                  <input type="text" class="form-control" id="fromsample" name="fromsample">
                                </div>
                               
                              </div>
                            </div>
                          </div>
                       
                
                        </div>
                        <br>
                        <div class="form-group">
                        <div class="col-md-3 col-sm-3">
                            <label for="Aggt" class="col-sm-2 control-label">Prospect</label>
                            <div class="col-sm-8">
                               <select id="location" name="prospect" class="form-control" required="">
                                <option value="">&nbsp;</option>
                                <?php foreach ($Prospect as $prospect): ?>
                                  <option value="<?php echo $prospect->Id ?>"><?php echo $prospect->Nama ?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                          </div>
                           <div class="col-md-3 col-sm-3">
                            <label for="DryTonFF" class="col-sm-4 control-label">To Hole ID</label>
                            <div class="col-sm-6">
                              <div class="input-group">
                                <div class="input-group-content">
                                  <input type="text" class="form-control" id="toholeid" name="toholeid">
                                </div>
                               
                              </div>
                            </div>
                          </div>
                             <div class="col-md-3 col-sm-3">
                            <label for="totalsample" class="col-sm-4 control-label">To Sample</label>
                            <div class="col-sm-6">
                              <div class="input-group">
                                <div class="input-group-content">
                                  <input type="text" class="form-control" id="tosample" name="tosample" onkeyup="TotalSample()" >
                                </div>
                               
                              </div>
                            </div>
                          </div>
                         
                        </div>
                        <br>
                        <div class="form-group">
                          <div class="col-md-3 col-sm-3">
                            <label for="Aggt" class="col-sm-2 control-label">Location</label>
                            <div class="col-sm-8">
                               <select id="location" name="location" class="form-control" required="">
                                <option value="">&nbsp;</option>
                                <?php foreach ($Location as $location): ?>
                                  <option value="<?php echo $location->Id ?>"><?php echo $location->Nama ?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                          </div>
                           <div class="col-md-3 col-sm-3">
                            <label for="DryTonFF" class="col-sm-4 control-label">Total Hole</label>
                            <div class="col-sm-6">
                              <div class="input-group">
                                <div class="input-group-content">
                                  <input type="text" class="form-control" id="totalhole" name="totalhole">
                                </div>
                               
                              </div>
                            </div>
                          </div>
                             <div class="col-md-3 col-sm-3">
                            <label for="totalsample" class="col-sm-4 control-label">Total Sample</label>
                            <div class="col-sm-6">
                              <div class="input-group">
                                <div class="input-group-content">
                                  <input type="text" class="form-control" id="totalsample" name="totalsample" >
                                </div>
                               
                              </div>
                            </div>
                          </div>
                            <div class="col-md-3 col-sm-3">
                            <label for="DryTonFF" class="col-sm-4 control-label">Remarks</label>
                            <div class="col-sm-4">
                              <div class="input-group">
                                <div class="input-group-content">
                                  <textarea rows=2 id="remarks" name="remarks"></textarea>
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
                </form>
                    
                      </div>
                    </div><!--end .card-body -->
                  </div><!--end .card -->
                </div><!--end .col -->
              </div><!--end .row -->
              
              <div class="row" style="text-align:center">
                
              </div><!--end .row -->


               

              <!-- BEGIN TABLE -->
            <div class="row">
              <div class="col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-12 col-lg-12 col-xl-12">
                        <h4>Table</h4>
                      </div><!--end .col -->
                      <form class="form-horizontal" role="form" action ="<?php echo base_url('OtherSampling/AcidSample/Delete_multiple'); ?>" method="post">
                      <div class="col-lg-12">
                       <div class="table-responsive">
                          <table id="datatable1" class="table table-striped table-hover">
                            <thead>
                              <tr>
                                <th width="10px"><center> <div class="">
                                                <input type="checkbox" id="checkAll" name="checkAll" >
                                                <label></label>
                                            </div></center></th>
                                <th>Date</th>
                                <th>Prospect</th> 
                                <th>Location</th>
                               
                                <th>From Hole ID</th>
                                <th>To Hole ID</th>
                                <th>Total Hole</th>
                                <th>From Sample</th>
                                <th>To Sample</th>
                                <th>Total Sample</th>
                                <th>Remarks</th>
                                
                                    
                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach ($Table as $table) { $Date = date("d-F-Y", strtotime($table->Date));
                              ?>
                                <tr class="gradeX">

                                       <td><center> <div class="">
                                                <input type="checkbox" name="msg[]" value="<?php echo $table->id; ?>">
                                                <label></label></center> </td>
                                 <!--  <?php //if ($this->session->userdata('roleGradeControl') == "Admin" || $this->session->userdata('GE')): ?>
                                    <td class="center">
                                    <center>
                                      <a>
                                        <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#<?php //echo $table->id; ?>"><span class="fa fa-trash"></span>
                                        </button>
                                      </a>
                                     
                                    </center>
                                  </td>
                                  <?php //endif; ?> -->
                                  <td><?php echo $Date; ?></td>
                                  <td><?php echo $table->Prospect; ?></td>
                  
                                  <td><?php echo $table->Location; ?></td>
                             

                                  <td><?php echo $table->FromHoleID; ?></td>
                                  <td><?php echo $table->ToHoleID; ?></td>
                                  <td><?php echo $table->TotalHole; ?></td>
                                  <td><?php echo $table->FromSample; ?></td>
                                  <td><?php echo $table->ToSample; ?></td>
                                  <td><?php echo $table->TotalSample; ?></td>
                                  <td><?php echo $table->Remarks; ?></td>

                                </tr>
                                <div class="modal fade" id="<?php echo $table->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-body">
                                        <h3>Are you sure? </h3>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                        <a> <?php echo anchor('OtherSampling/AcidSample/DeleteAcidSample/'.$table->id,'<button type="button" class="btn btn-danger">Delete</button>') ?></a>
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
      
        function TotalSample(){
        
        var From = document.getElementById("fromsample");
        var To =  document.getElementById("tosample");
        
        var TotalSample = document.getElementById("totalsample");

        
        TotalSample.value = parseFloat(To.value - From.value)+1;
      }
    </script>
  
    <!-- END JAVASCRIPT -->

  </body>
</html>
