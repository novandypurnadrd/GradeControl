<!DOCTYPE html>
<html lang="en">
  <head>

    <!-- HEADLIB -->
    <?php $this->load->view('lib/Headlib'); ?>
    <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/theme-default/libs/bootstrap-datepicker/datepicker3.css?1424887858" />
    <!-- END HEADLIB -->

  </head>
  <body class="menubar-hoverable header-fixed " onload="Loader()">

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
            <?php foreach ($Table as $table): ?>
              <form class="form" class="form-horizontal" role="form" action="<?php echo base_url().'OreInventory/Update/UpdateOreInventory/'.$id ?>" method="post">
              <div class="row">
                <div class="col-lg-6">
                  <h2 class="text-primary">Choose Pit & Block</h2>
                </div><!--end .col -->
                  <div class="col-lg-6">
                    <h2 class="text-primary">Final Figure</h2>
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
                            <label for="Aggt" class="col-sm-4 control-label">Pit</label>
                            <div class="col-sm-8">
                              <select id="Pit" name="Pit" class="form-control" required="">
                                <option value="">&nbsp;</option>
                                <?php foreach ($Pit as $pit): ?>
                                 <option value="<?php echo $pit->id ?>" <?php if($table->Pit == $pit->id){echo "selected='true'";}?>><?php echo $pit->Nama ?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-6 col-sm-6">
                            <label for="Aggt" class="col-sm-4 control-label">Type</label>
                            <div class="col-sm-8">
                              <select id="Type" name="Type" class="form-control"onchange="TypeChange()" required="">
                                <option value="Ore" <?php if($table->Type == "Ore"){echo "selected='true'";} ?>>Ore</option>
                                <option value="Visual" <?php if($table->Type == "Visual"){echo "selected='true'";} ?>>Visual</option>
                                <option value="Mineralized Waste" <?php if($table->Type == "Mineralized Waste"){echo "selected='true'";} ?>>Mineralized Waste</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-md-6 col-sm-6">
                            <label for="Aggt" class="col-sm-4 control-label" id="ore">Block</label>
                            <div class="col-sm-8">
                              <select id="Block" name="Block" class="form-control" required="" onchange="BlockChange()" required="">
                                <option value="">&nbsp;</option>
                                 <?php foreach ($Oreline as $oreline): ?>
                                    <option value="<?php echo $oreline->id ?>" class="<?php echo $oreline->pit ?>" <?php if($table->Block == $oreline->id){echo "selected='true'";}?>><?php echo $oreline->File ?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-6 col-sm-6">
                            <label for="Au" class="col-sm-4 control-label" id="nonore"></label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="Nonore" name="Nonore" disabled="" autocomplete="off">
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-md-6 col-sm-6">
                            <label for="Au" class="col-sm-4 control-label">RL</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="RL" name="RL" autocomplete="off" value="<?php echo $table->RL ?>">
                            </div>
                          </div>
                        </div>
                        <br>
                        <br>
                        <br>

                      </div>
                    </div><!--end .card-body -->
                  </div><!--end .card -->
                </div><!--end .col -->
                <div class="col-md-6 col-sm-6">
                  <div class="card">
                    <div class="card-body">
                      <div class="form-horizontal">
                      </br>
                        <div class="form-group">
                          <div class="col-md-6 col-sm-6">
                            <label for="DryTonFF" class="col-sm-4 control-label">Dry Ton</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="DryTonFF" name="DryTonFF" onkeyup="Counter()" required="" autocomplete="off" value="<?php echo $table->DryTonFF ?>">
                            </div>
                          </div>
                          <div class="col-md-6 col-sm-6">
                            <label for="DryTonFF" class="col-sm-4 control-label">Achievement</label>
                            <div class="col-sm-4">
                              <div class="input-group">
                                <div class="input-group-content">
                                  <input type="text" class="form-control" id="Achievement" name="Achievement" readonly="" value="<?php echo $table->Achievement ?>">
                                </div>
                                <span class="input-group-addon">%</span>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-md-6 col-sm-6">
                            <label for="Augr" class="col-sm-4 control-label">Au (gr)</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="Augr" name="Augr" readonly="">
                            </div>
                          </div>
                          <div class="col-md-6 col-sm-6">
                            <label for="Augt" class="col-sm-4 control-label">Au (gr/t)</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="Augt" name="Augt" readonly="">
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-md-6 col-sm-6">
                            <label for="Aggr" class="col-sm-4 control-label">Ag (gr)</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="Aggr" name="Aggr" readonly="">
                            </div>
                          </div>
                          <div class="col-md-6 col-sm-6">
                            <label for="Aggt" class="col-sm-4 control-label">Ag (gr/t)</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="Aggt" name="Aggt" readonly="">
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                        <div class="col-md-6 col-sm-6">
                            
                          </div>
                          <div class="col-md-6 col-sm-6">
                            <label for="Aggt" class="col-sm-4 control-label">AuEq75 (gr/t)</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="AuEq75gr" name="AuEq75gr" readonly="">
                            </div>
                          </div>
                        </div>
                    
                      </div>
                    </div><!--end .card-body -->
                  </div><!--end .card -->
                </div><!--end .col -->
              </div><!--end .row -->
              <!-- BEGIN TITLE -->
              <div class="row">
                <div class="col-lg-6">
                  <h2 class="text-primary">Block Model</h2>
                </div><!--end .col -->
                <div class="col-lg-6">
                  <h2 class="text-primary">Mine Details</h2>
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
                            <label for="Au" class="col-sm-4 control-label">Au</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="Au" name="Au" readonly="" value="<?php echo $table->Au ?>">
                            </div>
                          </div>
                          <div class="col-md-6 col-sm-6">
                            <label for="Ag" class="col-sm-4 control-label">Ag</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="Ag" name="Ag" readonly="" value="<?php echo $table->Ag ?>">
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-md-6 col-sm-6">
                            <label for="Ag" class="col-sm-4 control-label">AuEq75</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="AuEq75" name="AuEq75" readonly="" value="<?php echo $table->AuEq75 ?>">
                            </div>
                          </div>
                          <div class="col-md-6 col-sm-6">
                          <label for="Ag" class="col-sm-4 control-label">Class</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="Class" name="Class" readonly="" value="<?php echo $table->Class ?>">
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-md-6 col-sm-6">
                            <label for="DryTonBM" class="col-sm-4 control-label">Dry Ton BM</label>
                            <div class="col-sm-7">
                              <input type="text" class="form-control" id="DryTonBM" name="DryTonBM" readonly="" value="<?php echo $table->Tonnes ?>">
                            </div>
                          </div>
                          <div class="col-md-6 col-sm-6">
                            <label for="Density" class="col-sm-4 control-label">Density</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="Density" name="Density" readonly="" value="<?php echo $table->Density ?>">
                            </div>
                          </div>
                        </div>
                      </br>
                      </br>
                      </br>
                      </br>
                     
                      </div>
                    </div><!--end .card-body -->
                  </div><!--end .card -->
                </div><!--end .col -->
                <div class="col-md-6 col-sm-6">
                  <div class="card">
                    <div class="card-body">
                      <div class="form-horizontal">
                        <div class="form-group">
                          <div class="col-md-12 col-sm-12">
                            <div class="input-daterange input-group" id="demo-date-range">
                              <div class="input-group-content">
                                <input type="text" class="form-control" name="Start" id="Start" required=""  autocomplete="off" value="<?php echo explode('-',$table->Start)[1].'/'.explode('-',$table->Start)[2].'/'.explode('-',$table->Start)[0] ?>"/>
                                <label>(Date) Start</label>
                              </div>
                              <span class="input-group-addon">Finish</span>
                              <div class="input-group-content">
                              <?php if ($table->Finish != null) { ?>
                                  <input type="text" class="form-control" name="Finish" id="Finish" required="" autocomplete="off" disabled="true" value="<?php echo explode('-',$table->Finish)[1].'/'.explode('-',$table->Finish)[2].'/'.explode('-',$table->Finish)[0] ?>"/>
                                <?php } else {?>
                                  <input type="text" class="form-control" name="Finish" id="Finish" required="" autocomplete="off" disabled="true"/>
                                  <?php } ?>
                                
                                <div class="form-control-line"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-md-6 col-sm-6">
                            <label for="Aggt" class="col-sm-4 control-label">Start Hour</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control time-mask" id="StartHour" required="" name="StartHour" autocomplete="off" value="<?php echo $table->StartHour ?>">
                            </div>
                            <p class="help-block">Time: 24h</p>
                          </div>
                          <div class="col-md-6 col-sm-6">
                            <label for="Aggt" class="col-sm-4 control-label">Finish Hour</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control time-mask" id="FinishHour" required="" name="FinishHour" autocomplete="off" disabled="true" value="<?php echo $table->FinishHour ?>">
                            </div>
                            <p class="help-block">Time: 24h</p>
                          </div>
                        </div>

                      </br>
                       <div class="form-group">
                      <div class="col-md-6 col-sm-6">
                            <label for="Aggt" class="col-sm-4 control-label">Stockpile</label>
                            <div class="col-sm-8">
                              <select id="Stockpile" name="Stockpile" class="form-control" required="" readonly onchange="StatusChange()">
                                <option value="">&nbsp;</option>
                                <?php foreach ($Stockpile as $stockpile): ?>
                                  <option value="<?php echo $stockpile->id ?>" <?php if($table->Stockpile == $stockpile->id){echo "selected='true'";} ?> ><?php echo $stockpile->Nama ?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                          </div>
                             <div class="col-md-6 col-sm-6">
                            <label for="Aggt" class="col-sm-4 control-label">Value</label>
                            <div class="col-sm-8">
                              <select id="Value" name="Value" class="form-control" required="" >
                                <option value="Block Model">Block Model</option>
                                <option value="Final Figure">Final Figure</option>
                              </select>
                            </div>
                          </div>
                      </div>
                      <br>
                        <div class="form-group">
                          <div class="col-md-6 col-sm-6">
                            <label for="Aggt" class="col-sm-4 control-label">Status</label>
                            <div class="col-sm-8">
                              <select id="Status" name="Status" class="form-control" required="" onchange="StatusChange()">
                                <option value="Continue" <?php if($table->Status == "Continue"){echo "selected='true'";}?>>Continue</option>
                                <option value="Completed" <?php if($table->Status == "Completed"){echo "selected='true'";}?>>Completed</option>
                              </select>
                            </div>
                          </div>
                           <div class="col-md-6 col-sm-6">

                            <label for="DryTonFF" class="col-sm-4 control-label">Note</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="Note" value="<?php echo $table->Note ?>" name="Note" autocomplete="off">
                            </div>
                          
                          </div>
                        </div>
                      </div>
                    </div><!--end .card-body -->
                  </div><!--end .card -->
                </div><!--end .col -->
              </div><!--end .row -->
              <div class="row" style="text-align:center">
                <div class="col-md-12 col-sm-12">
                  <div class="form-group">
                    <button type="submit" class="btn ink-reaction btn-raised btn-primary"><i class="md md-system-update-tv"></i> Update</button>
                  </div>
                </div><!--end .col -->
              </div><!--end .row -->

            </form>
            <?php endforeach; ?>
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
      function StatusChange() {
        var Status = document.getElementById("Status");
        var Finish = document.getElementById("Finish");
        var FinishHour = document.getElementById("FinishHour");
        var Note = document.getElementById("Note");

        if (Status.value == "Continue") {
          Finish.disabled = true;
          FinishHour.disabled = true;
          

        }else {
          Finish.disabled = false;
          FinishHour.disabled = false;
          
        }
      }

      function BlockChange(){
        var Block = document.getElementById("Block");
        var Au = document.getElementById("Au");
        var Ag = document.getElementById("Ag");
        var DryTonBM = document.getElementById("DryTonBM");
        var Density = document.getElementById("Density");
        var Augr = document.getElementById("Augr");
        var Aggr = document.getElementById("Aggr");

        <?php foreach ($Oreline as $oreline): ?>
          if ("<?php echo $oreline->id ?>" == Block.value) {
            Au.value = "<?php echo $oreline->Au ?>";
            Ag.value = "<?php echo $oreline->Ag ?>";
            DryTonBM.value = "<?php echo $oreline->Actual ?>";
            Density.value = "<?php echo $oreline->Dbdensity ?>";
            var x = Au.value * DryTonBM.value;
            var y = Ag.value * DryTonBM.value;
            Augr.value = x.toFixed(3);
            Aggr.value = y.toFixed(3);
          }
        <?php endforeach; ?>
      }

       function TypeChange() {
    var Type = document.getElementById("Type");
        var Block = document.getElementById("Block");
    var Nonore = document.getElementById("Nonore");
        var Au = document.getElementById("Au");
        var Ag = document.getElementById("Ag");
        var DryTonBM = document.getElementById("DryTonBM");
        var Density = document.getElementById("Density");
        var RL = document.getElementById("RL");

        if (Type.value == "Ore") {
          Nonore.disabled = true;
                Block.disabled = false;
          document.getElementById('ore').innerHTML = 'Block';
          document.getElementById('nonore').innerHTML = '';
          $("#Au").prop('readonly', true);
          $("#Ag").prop('readonly', true);
          $("#DryTonBM").prop('readonly', true);
          $("#Density").prop('readonly', true);
          $("#RL").prop('readonly', true);
          $("#AuEq75").prop('readonly', true);
          $("#Class").prop('readonly', true);
          $("#Augr").prop('readonly', true);
          $("#Aggr").prop('readonly', true);
        }else {
          Nonore.disabled = false;
          Block.value = "";
                Block.disabled = true;
          document.getElementById('ore').innerHTML = '';
          document.getElementById('nonore').innerHTML = 'Block';
          $("#Au").prop('readonly', false);
          $("#Ag").prop('readonly', false);
          $("#DryTonBM").prop('readonly', false);
          $("#Density").prop('readonly', false);
          $("#RL").prop('readonly', false);
          $("#AuEq75").prop('readonly', false);
          $("#Class").prop('readonly', false);
          $("#Augr").prop('readonly', false);
          $("#Aggr").prop('readonly', false);
        }
      }

      function Counter(){
        var DryTonFF = document.getElementById("DryTonFF").value;
        var DryTonBM = document.getElementById("DryTonBM").value
        var Augr = document.getElementById("Augr").value;
        var Augt = document.getElementById("Augt");
        var Aggr = document.getElementById("Aggr").value;
        var Aggt = document.getElementById("Aggt");
        var Achievement = document.getElementById("Achievement");
        var AuEq75gr = document.getElementById("AuEq75gr");

        var x = Augr / DryTonFF ;
        var y = Aggr / DryTonFF ;
        var z = DryTonFF / DryTonBM * 100;
        Augt.value = x.toFixed(2);
        Aggt.value = y.toFixed(2);
        var a = (x+(y/75));
        AuEq75gr.value = a.toFixed(2);
        Achievement.value = z.toFixed(0);
      }

      function Loader(){
        StatusChange();
        BlockChange();
        Counter();
      }
    </script>
    <!-- END JAVASCRIPT -->

  </body>
</html>
