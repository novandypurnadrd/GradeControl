<!DOCTYPE html>
<html lang="en">
  <head>

    <!-- HEADLIB -->
    <?php $this->load->view('lib/Headlib'); ?>
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
            <form class="form" class="form-horizontal" role="form" action="<?php echo base_url().'Closingstock/Transfer/InsertTransfer' ?>" method="post">
              <div class="row">
                <div class="col-lg-6">
                  <h2 class="text-primary">Source Stockpile</h2>
                </div><!--end .col -->
                  <div class="col-lg-6">
                    <h2 class="text-primary">Destination Stockpile</h2>
                  </div><!--end .col -->
              </div><!--end .row -->
              <!-- END TITLE -->
              <div class="row">
              <div class="col-md-6 col-sm-6">
                  <div class="card">
                    <div class="card-body">
                      <div class="form-horizontal">
                        <div class="form-group">
                          <div class="col-md-6 col-sm-6">
                          
                        
                          <label for="Date" class="col-sm-4 control-label">Date</label>
                            <div class="col-sm-8">
                              <div class="input-group date" id="demo-date">
                                <div class="input-group-content">
                                  <input type="text" class="form-control" id="Date" name="Date" autocomplete="off" required="">
                                </div>
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                              </div>
                            </div>


                      </div>
                            <div class="col-md-6 col-sm-6">
                            <label for="Aggt" class="col-sm-4 control-label">Stockpile</label>
                            <div class="col-sm-8">
                              <select id="StockpileSource" name="StockpileSource" class="form-control" required="" onclick="StockpileChange()">
                                <option value="">&nbsp;</option>
                                <?php foreach ($Stockpile as $stockpile): ?>
                                  <option value="<?php echo $stockpile->id ?>"><?php echo $stockpile->Nama ?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                          </div>
                        </div>

                      <div class="form-group">
                        <div class="col-md-6 col-sm-6">
                            <label for="Au" class="col-sm-4 control-label">Au</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="sourceau" name="sourceau" readonly="" autocomplete="off">
                            </div>
                          </div>
                          <div class="col-md-6 col-sm-6">
                            <label for="Au" class="col-sm-4 control-label">Ag</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="sourceag" name="sourceag" readonly="" autocomplete="off">
                            </div>
                          </div>
                        </div>

                         <div class="form-group">
                        <div class="col-md-6 col-sm-6">
                            <label for="Au" class="col-sm-4 control-label">AuEq75</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="sourceaueq75" name="sourceaueq75" readonly="" autocomplete="off">
                            </div>
                          </div>
                          <div class="col-md-6 col-sm-6">
                            <label for="Au" class="col-sm-4 control-label">Class</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="sourceclass" name="sourceclass" readonly autocomplete="off">
                            </div>
                          </div>
                        </div>

                         <div class="form-group">
                        <div class="col-md-6 col-sm-6">
                            <label for="Au" class="col-sm-4 control-label">Density</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="sourcedensity" name="sourcedensity" readonly="" autocomplete="off">
                            </div>
                          </div>
                          <div class="col-md-6 col-sm-6">
                            <label for="Au" class="col-sm-4 control-label">Volume</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="sourcevolume" name="sourcevolume" readonly="" autocomplete="off">
                            </div>
                          </div>
                        </div>

                        <div class="form-group">
                        <div class="col-md-6 col-sm-6">
                            <label for="Au" class="col-sm-4 control-label">Tonnes</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="sourcetones" name="sourcetones" readonly="" autocomplete="off">
                            </div>
                          </div>
                          <div class="col-md-6 col-sm-6">
                            <label for="Au" class="col-sm-4 control-label">Transfer</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="transfertones" name="transfertones" required="" onkeyup="TransferTonnes()" autocomplete="off">
                            </div>
                          </div>
                        </div>

                         <div class="form-group">
                        <div class="col-md-6 col-sm-6">
                            <label for="Au" class="col-sm-4 control-label">Note</label>
                            <div class="col-sm-8">
                              <textarea type="text" class="form-control" id="note" name="note" autocomplete="off" rows="3"> </textarea>
                            </div>
                          </div>

                          <div class="col-md-6 col-sm-6">
                             <label for="Au" class="col-sm-4 control-label">*</label>
                             <div class="col-sm-8 col-lg-8 col-xl-8">
                                <a> You must select Destination Stockpile before filling the tonnase transfer value</a>
                            </div>
                          </div>
                      
                        </div>
                        <br>
                    
                       
             

                      </div>
                    </div><!--end .card-body -->
                  </div><!--end .card -->
                </div><!--end .col -->

               <div class="col-md-6 col-sm-6">
                  <div class="card">
                    <div class="card-body">
                      <div class="form-horizontal">
                        <div class="form-group">
                      
                            <div class="col-md-6 col-sm-6">
                            <label for="Aggt" class="col-sm-4 control-label">Stockpile</label>
                            <div class="col-sm-8">
                              <select id="StockpileDes" name="StockpileDes" class="form-control" required="" onclick="StockpileChangeDestination()">
                                <option value="">&nbsp;</option>
                                <?php foreach ($Stockpile as $stockpile): ?>
                                  <option value="<?php echo $stockpile->id ?>"><?php echo $stockpile->Nama ?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                        <div class="col-md-6 col-sm-6">
                            <label for="Au" class="col-sm-4 control-label">B.Tonnes</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="btones" name="btones" readonly="" autocomplete="off">
                            </div>
                          </div>
                          <div class="col-md-6 col-sm-6">
                            <label for="Au" class="col-sm-4 control-label">A.Tonnes</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="atones" name="atones" readonly autocomplete="off">
                            </div>
                          </div>
                        </div>

                        <div class="form-group">
                        <div class="col-md-6 col-sm-6">
                            <label for="Au" class="col-sm-4 control-label">B.Au</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="bau" name="bau" readonly="" autocomplete="off">
                            </div>
                          </div>
                          <div class="col-md-6 col-sm-6">
                            <label for="Au" class="col-sm-4 control-label">A.Au</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="aau" name="aau" readonly="" autocomplete="off">
                            </div>
                          </div>
                        </div>

                         <div class="form-group">
                        <div class="col-md-6 col-sm-6">
                            <label for="Au" class="col-sm-4 control-label">B.Ag</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="bag" name="bag" readonly="" autocomplete="off">
                            </div>
                          </div>
                          <div class="col-md-6 col-sm-6">
                            <label for="Au" class="col-sm-4 control-label">A.Ag</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="aag" name="aag" readonly="" autocomplete="off">
                            </div>
                          </div>
                        </div>

                         <div class="form-group">
                        <div class="col-md-6 col-sm-6">
                            <label for="Au" class="col-sm-4 control-label">B.AuEq75</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="baueq75" name="baueq75" readonly="" autocomplete="off">
                            </div>
                          </div>
                          <div class="col-md-6 col-sm-6">
                            <label for="Au" class="col-sm-4 control-label">A.AuEq75</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="aaueq75" name="aaueq75" readonly="" autocomplete="off">
                            </div>
                          </div>
                        </div>

                         <div class="form-group">
                        <div class="col-md-6 col-sm-6">
                            <label for="Au" class="col-sm-4 control-label">B.Class</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="bclass" name="bclass" readonly="" autocomplete="off">
                            </div>
                          </div>
                          <div class="col-md-6 col-sm-6">
                            <label for="Au" class="col-sm-4 control-label">B.Class</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="aclass" name="aclass" readonly="" autocomplete="off">
                            </div>
                          </div>
                        </div>

                          <div class="form-group">
                        <div class="col-md-6 col-sm-6">
                            <label for="Au" class="col-sm-4 control-label">B.Density</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="bdensity" name="bdensity" readonly="" autocomplete="off">
                            </div>
                          </div>
                          <div class="col-md-6 col-sm-6">
                            <label for="Au" class="col-sm-4 control-label">A.Density</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="adensity" name="adensity" readonly="" autocomplete="off">
                            </div>
                          </div>
                        </div>
                  
                        <br>
                      
                  

                      </div>
                    </div><!--end .card-body -->
                  </div><!--end .card -->
                </div><!--end .col -->
              </div><!--end .row -->
              <!-- BEGIN TITLE -->
              
              <!-- END TITLE -->
              
              </div><!--end .row -->
              <br>
          
              <div class="row" style="text-align:center">
                <div class="col-md-12 col-sm-12">
                  <div class="form-group">
                    <button type="submit" class="btn ink-reaction btn-raised btn-primary"><i class="md md-save"></i> Transfer Stockpile</button>
                  </div>
                </div><!--end .col -->
              </div><!--end .row -->

            </form>

            <br>
            <br>
             <!-- BEGIN TABLE -->
             <form class="form" class="form-horizontal" role="form" action="<?php echo base_url().'Closingstock/Transfer/Filter' ?>" method="post">
            <div class="row">
               <div class="col-md-2 col-lg-2 col-xl-2">
               </div>
              <div class="col-md-8 col-lg-8 col-xl-8">
                <div class="card">
                  <div class="card-body">
                    <div class="row">

                    <div class="col-md-12 col-lg-12 col-xl-12">
                     
                       <div class="col-md-4 col-lg-4 col-xl-4">
                        <div class="form-group floating-label">
                        
                          <label for="Date" class="col-sm-4 control-label">Date Range</label>
                            <div class="col-sm-10">
                              <div class="input-daterange input-group" id="demo-date-range">
                                <div class="input-group-content">
                                <input type="text" class="form-control" name="start" id="start" required autocomplete="off" value="<?php echo $dateStart ?>" />
                                
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

                      
                  </div>
                  <br>
                  <br>
                  <br>

                  <div class="col-lg-12 col-sm-12 col-xl-12">
                    <div class="col-lg-1 col-sm-1 col-xl-1">
                    </div>
                    <div class="col-md-3 col-lg-3 col-xl-3">
                        <div class="form-group">
                          <button type="submit" class="btn ink-reaction btn-raised btn-info"><i class="md md-center-focus-strong"></i> Filter</button>
                        </div>
                      </div>
                  </div>
                </form>


          
                      <div class="col-md-12 col-lg-12 col-xl-12">
                        <h4>.</h4>
                      </div><!--end .col -->
                      <div class="col-lg-12">
                        <div class="table-responsive">
                          <table id="datatable1" class="table table-striped table-hover">
                            <thead>
                              <tr>
                                <th>Action</th>
                                <th>Date</th>
                                <th>Source Stockpile</th> 
                                <th>Destination Stockpile</th>
                                <th>Tonnes Transfer</th>
                                <th>Au Transfer</th>
                                <th>Ag Transfer</th>
                                <th>AuEq75</th>
                                <th>Class</th>
                                <th>Note</th>
                                    
                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach ($Table as $table) { $Date = date("d-F-Y", strtotime($table->date));
                              ?>
                                <tr class="gradeX">
                                  <?php if ($this->session->userdata('roleGradeControl') == "Admin" || $this->session->userdata('GE')): ?>
                                    <td class="center">
                                    <center>
                                      <a>
                                        <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#<?php echo $table->id; ?>"><span class="fa fa-trash"></span>
                                        </button>
                                      </a>
                                  <!--      <a href="<?php //echo base_url().'ClosingStock/Boulder/index_update/'.$table->id ?>">
                                        <button type="button" class="btn btn-xs btn-info"><span class="fa fa-edit"></span>
                                        </button>
                                      </a> -->

                                    </center>
                                  </td>
                                  <?php endif; ?>
                                  <td><?php echo $Date; ?></td>
                                  <td><?php echo $table->stockpile_source; ?></td>
                                  <td><?php echo $table->stockpile_destination; ?></td>
                  
                                  <td><?php echo $table->tonase_transfer; ?></td>
                                  <td><?php echo $table->au_transfer; ?></td>
                                  <td><?php echo $table->ag_transfer; ?></td>
                                  <td><?php echo $table->aueq_transfer; ?></td>
                                  <td><?php echo $table->class_transfer; ?></td>
                                  <td><?php echo $table->note; ?></td>

                                </tr>
                                <div class="modal fade" id="<?php echo $table->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-body">
                                        <h3>Are you sure? </h3>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                        <a> <?php echo anchor('Closingstock/Transfer/DeleteTransfer/'.$table->id,'<button type="button" class="btn btn-danger">Delete</button>') ?></a>
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
    <script src="<?php echo base_url();?>assets/js/jquery.chained.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/libs/bootstrap-datepicker/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url();?>assets/js/libs/inputmask/jquery.inputmask.bundle.min.js"></script>
    <script type="text/javascript">
      $("#Block").chained("#Pit");
      $("#program").chained("#subsubcategory");
      $('#DryTonFF').on('change keyup', function() {
        var sanitized = $(this).val().replace(/[^0-9,.]/g, '');
        $(this).val(sanitized);
      });
      $('#Achievement').on('change keyup', function() {
        var sanitized = $(this).val().replace(/[^0-9,.]/g, '');
        $(this).val(sanitized);
      });
    </script>
    <script type="text/javascript">
      

      function StockpileChange() {
        var StockpileVar = document.getElementById("StockpileSource");
        var SourceAu = document.getElementById("sourceau");
        var SourceAg = document.getElementById("sourceag");
        var SourceTonnes = document.getElementById("sourcetones");
        var SourceAuEq75 = document.getElementById("sourceaueq75");
        var SourceClass = document.getElementById("sourceclass");
        var SourceDensity = document.getElementById("sourcedensity");
        var SourceVolume = document.getElementById("sourcevolume");
        
        var Dates = "";
        var vAu = 0;
        var vAg = 0;
        var vTonnes = 0;
 
        var totAu = 0;
        var totAg = 0;
        var totTonnes = 0;
     

        var convertDate = function(usDate) {
        var dateParts = usDate.split(/(\d{1,2})\/(\d{1,2})\/(\d{4})/);
        return dateParts[3] + "-" + dateParts[1] + "-" + dateParts[2];
    }

        // var inDate = Tgl.value;
        // var outDate = convertDate(inDate);

        <?php foreach ($ToStockpile as $tostockpile): ?>
       
      

          if ("<?php echo $tostockpile->Stockpile ?>" == StockpileVar.value) {

          SourceAu.value = "<?php echo $tostockpile->Au ?>";
          SourceAg.value = "<?php echo $tostockpile->Ag ?>";
          SourceAuEq75.value = "<?php echo $tostockpile->AuEq75 ?>";
          SourceClass.value = "<?php echo $tostockpile->Class ?>";
          SourceTonnes.value = parseFloat("<?php echo $tostockpile->Tonnes ?>").toFixed(2);
          SourceDensity.value = "<?php echo $tostockpile->Density ?>";
          SourceVolume.value = "<?php echo $tostockpile->Volume ?>";
       
        return;
          }else {
          
          SourceAu.value = "-";
          SourceAg.value = "-";
          SourceAuEq75.value = "-";
          SourceClass.value = "-";
          SourceTonnes.value = "-";
          SourceDensity.value = "-";
          SourceVolume.value = "-";

          }


        <?php endforeach; ?>
      }



      function StockpileChangeDestination() {
        var StockpileVar = document.getElementById("StockpileDes");
        var BAu = document.getElementById("bau");
        var BAg = document.getElementById("bag");
        var BTonnes = document.getElementById("btones");
        var BAuEq75 = document.getElementById("baueq75");
        var BClass = document.getElementById("bclass");
        var BDensity = document.getElementById("bdensity");
        
        var Dates = "";
        var vAu = 0;
        var vAg = 0;
        var vTonnes = 0;
 
        var totAu = 0;
        var totAg = 0;
        var totTonnes = 0;
     

        var convertDate = function(usDate) {
        var dateParts = usDate.split(/(\d{1,2})\/(\d{1,2})\/(\d{4})/);
        return dateParts[3] + "-" + dateParts[1] + "-" + dateParts[2];
    }

        // var inDate = Tgl.value;
        // var outDate = convertDate(inDate);

        <?php foreach ($ToStockpile as $tostockpile): ?>
       
      

          if ("<?php echo $tostockpile->Stockpile ?>" == StockpileVar.value) {

          BAu.value = "<?php echo $tostockpile->Au ?>";
          BAg.value = "<?php echo $tostockpile->Ag ?>";
          BAuEq75.value = "<?php echo $tostockpile->AuEq75 ?>";
          BClass.value = "<?php echo $tostockpile->Class ?>";
          BTonnes.value = parseFloat("<?php echo $tostockpile->Tonnes ?>").toFixed(2);
          BDensity.value = "<?php echo $tostockpile->Density ?>";


        return;
          }else {
          
          BTonnes.value = 0;
          BAu.value = 0;
          BAg.value = 0;
          BAuEq75.value = 0;
          BClass.value = "-";
          BDensity.value = 0;

          }


        <?php endforeach; ?>
      }


      function TransferTonnes(){


        var SourceAu = document.getElementById("sourceau");
        var SourceAg = document.getElementById("sourceag");
        var SourceTonnes = document.getElementById("sourcetones");
        var SourceAuEq75 = document.getElementById("sourceaueq75");
        var SourceClass = document.getElementById("sourceclass");
        var SourceDensity = document.getElementById("sourcedensity");
        var SourceVolume = document.getElementById("sourcevolume");

        var BAu = document.getElementById("bau");
        var BAg = document.getElementById("bag");
        var BTonnes = document.getElementById("btones");
        var BAuEq75 = document.getElementById("baueq75");
        var BClass = document.getElementById("bclass");
        var BDensity = document.getElementById("bdensity");


        var AAu = document.getElementById("aau");
        var AAg = document.getElementById("aag");
        var ATonnes = document.getElementById("atones");
        var AAuEq75 = document.getElementById("aaueq75");
        var AClass = document.getElementById("aclass");
        var ADensity = document.getElementById("adensity");

        var TTones = document.getElementById("transfertones");


        var v_SourceAu = parseFloat(SourceAu.value);
        var v_SourceAg =parseFloat(SourceAg.value);
        var v_Sourcetonnes = parseFloat(SourceTonnes.value);
        var v_SourceDensity = parseFloat(SourceDensity.value);

        var v_BAu = parseFloat(BAu.value);
        var v_BAg =parseFloat(BAg.value);
        var v_Btonnes = parseFloat(BTonnes.value);
        var v_BDensity = parseFloat(BDensity.value);

        var v_TTones = parseFloat(TTones.value);


        ATonnes.value = parseFloat(parseFloat(TTones.value) + parseFloat(BTonnes.value)).toFixed(2);

        //AAu.value = parseFloat(((v_SourceAu * v_Sourcetonnes) + (v_BAu * v_Btonnes))/ATonnes).toFixed(2);
        AAu.value = parseFloat((parseFloat(v_SourceAu * v_TTones) + parseFloat(v_BAu * v_Btonnes))/ATonnes.value).toFixed(2);
        AAg.value = parseFloat((parseFloat(v_SourceAg * v_TTones) + parseFloat(v_BAg * v_Btonnes))/ATonnes.value).toFixed(2);

        AAuEq75.value = parseFloat(parseFloat(AAu.value) + parseFloat(AAg.value/75)).toFixed(2);

        ADensity.value = parseFloat((parseFloat(v_SourceDensity * v_TTones) + parseFloat(v_BDensity * v_Btonnes))/ATonnes.value).toFixed(2);


        var AuEq75 = "";
        AuEq75 = parseFloat(AAuEq75.value);

        var Class = "";

            if (0.65 <= AuEq75 && AuEq75 < 2.00){
              Class="Marginal";
            }
            else if(2<=AuEq75 && AuEq75<4.00){
              Class="Medium Grade";
            }
            else if(4<=AuEq75 && AuEq75<6.00){
              Class="High Grade";
            }
            else if(AuEq75 >= 6.00){
              Class="SHG";
            }
            else{
              Class = "Min.Waste";
            }

      AClass.value =Class;

      }
      

    </script>

  
    <!-- END JAVASCRIPT -->

  </body>
</html>
