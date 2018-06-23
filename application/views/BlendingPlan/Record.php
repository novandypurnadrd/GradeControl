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

         
            <!-- START TITLE -->
              <div class="row">
                <div class="col-lg-6">
                  <h2 class="text-primary">Record Bleding Plan</h2>
                </div><!--end .col -->
                
              </div><!--end .row -->
              <!-- END TITLE -->

               

              <!-- BEGIN TABLE -->

            <div class="row">
              <div class="col-md-12 col-sm-12">
                <div class="card">
                  <div class="card-body">
                    <form class="form" role="form" action="<?php echo base_url().'BlendingPlan/Record/Filter' ?>" method="post">
                      <div class="col-md-1">

                      </div>
              
                     <div class="col-md-4 col-lg-4 col-xl-4">
                        <div class="form-group floating-label">
                        
                          <label for="Date" class="col-sm-4 control-label">Date Range</label>
                            <div class="col-sm-10">
                              <div class="input-daterange input-group" id="demo-date-range">
                                <div class="input-group-content">
                                <input type="text" class="form-control" name="start" id="start" required="" autocomplete="off" value="<?php echo $dateStart ?>" />
                                
                                </div>
                          <span class="input-group-addon">to</span>
                                <div class="input-group-content">
                                  <input type="text" class="form-control" name="end" id="end" required autocomplete="off" value="<?php echo $dateEnd ?>" />
                                  <div class="form-control-line"></div>
                                </div>
                              </div>
                            </div>

                 </div>
                      </div>
                     
                      <div class="col-md-3">
                        <div class="form-group">
                          <button type="submit" class="btn ink-reaction btn-raised btn-info"><i class="md md-center-focus-strong"></i> Filter</button>
                        </div>
                      </div>
                    </form>
                  </div><!--end .card-body -->
                </div><!--end .card -->
              </div><!--end .col -->
            </div><!--end .row -->

            <div class="row">
              <div class="col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-12 col-lg-12 col-xl-12">
                        <h4>Table</h4>
                      </div><!--end .col -->
                      <form class="form-horizontal" role="form" action ="<?php echo base_url('BlendingPlan/Record/Delete_multiple'); ?>" method="post">
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
                                <th>Blending</th> 
                                <th>Au (g/t)</th>
                               
                                <th>Ag (g/t)</th>
                                <th>AuEq75 (g/t)</th>
                              
                                
                                    
                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach ($Table as $table) { $Date = date("d-F-Y", strtotime($table->Date));
                              ?>
                                <tr class="gradeX">

                                       <td><center> <div class="">
                                                <input type="checkbox" name="msg[]" value="<?php echo $table->id; ?>">
                                                <label></label></center> </td>
                              
                                  <td><?php echo $Date; ?></td>
                                  <td><?php echo $table->Blending; ?></td>
                  
                                  <td><?php echo $table->Augt; ?></td>
                             

                                  <td><?php echo $table->Aggt; ?></td>
                                  <td><?php echo $table->AuEq75; ?></td>
                                 

                                </tr>
                            
                                <?php }
                              ?>
                            </tbody>
                          </table>
                        </div><!--end .table-responsive -->
                      </div><!--end .col -->
                       <div class="col-sm-6">
                                                 
                                                    <button type="sumbit" class="btn btn-danger btn-bordered"><i class="md md-delete"></i>Delete</button>
                                                    
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

        
        TotalSample.value = (parseFloat(To.value - From.value)+1).toFixed(1);
      }

       function TotalHole(){
        
        var From = document.getElementById("fromholeid");
        var To =  document.getElementById("toholeid");
        
        var TotalHole = document.getElementById("totalhole");

        
        TotalHole.value = (parseFloat(To.value - From.value)+1).toFixed(1);
      }
    </script>
  
    <!-- END JAVASCRIPT -->

  </body>
</html>
