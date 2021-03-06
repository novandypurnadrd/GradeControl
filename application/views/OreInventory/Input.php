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
            <form class="form" class="form-horizontal" role="form" action="<?php echo base_url().'OreInventory/Input/InputOreInventory' ?>" method="post">
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
                                  <option value="<?php echo $pit->id ?>"><?php echo $pit->Nama ?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-6 col-sm-6">
                            <label for="Aggt" class="col-sm-4 control-label">Type</label>
                            <div class="col-sm-8">
                              <select id="Type" name="Type" class="form-control" onchange="TypeChange()" required="">
                                <option value="Ore">Ore</option>
                                <option value="Visual">Visual</option>
                                <option value="Mineralized Waste">Mineralized Waste</option>
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
                                  <option value="<?php echo $oreline->File ?>" class="<?php echo $oreline->pit ?>"><?php echo $oreline->File ?></option>
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
                              <input type="text" class="form-control" id="RL" name="RL" required="" autocomplete="off">
                            </div>
                          </div>
                            <div class="col-md-6 col-sm-6">
                            <label for="Au" class="col-sm-4 control-label">Tonnes</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="akumulasitones" name="akumulasitones" readonly="" autocomplete="off">
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
                              <input type="text" class="form-control" id="DryTonFF" name="DryTonFF" onkeyup="Counter()" required="" autocomplete="off">
                            </div>
                          </div>
                          <div class="col-md-6 col-sm-6">
                            <label for="DryTonFF" class="col-sm-4 control-label">Achievement</label>
                            <div class="col-sm-4">
                              <div class="input-group">
                                <div class="input-group-content">
                                  <input type="text" class="form-control" id="Achievement" name="Achievement" readonly="">
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
                              <input type="text" class="form-control" id="Au" name="Au" readonly="" required="">
                            </div>
                          </div>
                          <div class="col-md-6 col-sm-6">
                            <label for="Ag" class="col-sm-4 control-label">Ag</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="Ag" name="Ag" readonly="" required="">
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-md-6 col-sm-6">
                            <label for="Ag" class="col-sm-4 control-label">AuEq75</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="AuEq75" name="AuEq75" readonly="">
                            </div>
                          </div>
                          <div class="col-md-6 col-sm-6">
                            <label for="Density" class="col-sm-4 control-label">Class</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="Class" name="Class" readonly="">
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-md-6 col-sm-6">
                            <label for="DryTonBM" class="col-sm-4 control-label">Dry Ton BM</label>
                            <div class="col-sm-7">
                              <input type="text" class="form-control" id="DryTonBM" name="DryTonBM" readonly="" required="" onkeyup="CounterBlockModel()">
                            </div>
                          </div>
                          <div class="col-md-6 col-sm-6">
                            <label for="Density" class="col-sm-4 control-label">Density</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="Density" name="Density" required="" readonly="">
                            </div>
                          </div>
                        </div>
                      </br>
                      </br>
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
                                <input type="text" class="form-control" name="Start" id="Start" required=""  autocomplete="off"/>
                                <label>(Date) Start</label>
                              </div>
                              <span class="input-group-addon">Finish</span>
                              <div class="input-group-content">
                                <input type="text" class="form-control" name="Finish" id="Finish" required="" autocomplete="off" disabled="true"/>
                                <div class="form-control-line"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-md-6 col-sm-6">
                            <label for="Aggt" class="col-sm-4 control-label">Start Hour</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control time-mask" id="StartHour" required="" name="StartHour" autocomplete="off">
                            </div>
                            <p class="help-block">Time: 24h</p>
                          </div>
                          <div class="col-md-6 col-sm-6">
                            <label for="Aggt" class="col-sm-4 control-label">Finish Hour</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control time-mask" id="FinishHour" required="" name="FinishHour" autocomplete="off" disabled="true">
                            </div>
                            <p class="help-block">Time: 24h</p>
                          </div>
                        </div>
                      </br>
                      <div class="form-group">
                      <div class="col-md-6 col-sm-6">
                            <label for="Aggt" class="col-sm-4 control-label">Stockpile</label>
                            <div class="col-sm-8">
                              <select id="Stockpile" name="Stockpile" class="form-control" required="">
                                <option value="">&nbsp;</option>
                                <?php foreach ($Stockpile as $stockpile): ?>
                                  <option value="<?php echo $stockpile->id ?>"><?php echo $stockpile->Nama ?></option>
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
                                <option value="Continue">Continue</option>
                                <option value="Completed">Completed</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-6 col-sm-6">

                            <label for="DryTonFF" class="col-sm-4 control-label">Note</label>
                            <div class="col-sm-8">
                              <textarea type="text" class="form-control" id="Note" name="Note" autocomplete="off" rows="3"></textarea>
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
                    <button type="submit" class="btn ink-reaction btn-raised btn-primary"><i class="md md-save"></i> Insert</button>
                  </div>
                </div><!--end .col -->
              </div><!--end .row -->

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

        var Status = document.getElementById("Status");
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
        var AuEq75 = document.getElementById("AuEq75");
        var Class = document.getElementById("Class");
        var DryTonBM = document.getElementById("DryTonBM");
        var Density = document.getElementById("Density");
        var Augr = document.getElementById("Augr");
        var Aggr = document.getElementById("Aggr");
        var RL = document.getElementById("RL");
        var Akumulasitones = document.getElementById("akumulasitones");
        var StartHour = document.getElementById("StartHour");
        var Start =  document.getElementById("Start");
        var akumulasiTonnesValue = 0;

        <?php foreach ($Oreline as $oreline): ?>
          if ("<?php echo $oreline->File ?>" == Block.value) {
            <?php foreach ($OreInventory as $oreinventory): ?>

            if("<?php echo $oreinventory->Block ?>" == Block.value){
              if ("<?php echo $oreinventory->RL ?>" != null){
                RL.value = "<?php echo $oreinventory->RL ?> ";
                RL.readonly = true;
              }

              
              akumulasiTonnesValue = parseInt("<?php echo $oreinventory->DryTonFF ?>") + akumulasiTonnesValue;
            
              Akumulasitones.value = akumulasiTonnesValue;
            }
             <?php endforeach; ?>
            Au.value = "<?php echo $oreline->Au ?>";
            Ag.value = "<?php echo $oreline->Ag ?>";
            DryTonBM.value = "<?php echo $oreline->Actual ?>";
            Density.value = "<?php echo $oreline->Dbdensity ?>";
            AuEq75.value = "<?php echo $oreline->Aueq ?>";
            Class.value = "<?php echo $oreline->Class ?>";
            var x = Au.value * DryTonBM.value;
            var y = Ag.value * DryTonBM.value;
            Augr.value = x.toFixed(3);
            Aggr.value = y.toFixed(3);
            return;
          }else {
            Au.value = "";
            Ag.value = "";
            DryTonBM.value = "";
            Density.value = "";
            Augr.value = "";
            Aggr.value = "";
            RL.value ="";
            AuEq75.value = "";
            Class.value ="";
            Akumulasitones.value = "";
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
        var Achievement = document.getElementById("Achievement");
        var Value = document.getElementById("Value");
        var Class = document.getElementById("Class");

        if (Type.value == "Ore") {
          Nonore.disabled = true;
          Block.disabled = false;
          document.getElementById('ore').innerHTML = 'Block';
          document.getElementById('nonore').innerHTML = '';
          $("#Au").prop('readonly', false);
          $("#Ag").prop('readonly', false);
          $("#DryTonBM").prop('readonly', true);
          $("#DryTonFF").prop('readonly', false);
          $("#Density").prop('readonly', false);
          $("#RL").prop('readonly', false);
          $("#AuEq75").prop('readonly', true);
          $("#Class").prop('readonly', true);
          $("#Augr").prop('readonly', false);
          $("#Aggr").prop('readonly', false);
          $("#Augt").prop('readonly', true);
          $("#Aggt").prop('readonly', true);

        }else {
          Nonore.disabled = false;
          Block.value = "";
          Block.disabled = true;
          document.getElementById('ore').innerHTML = '';
          document.getElementById('nonore').innerHTML = 'Block';
          Achievement.value = "100";
          var Class = document.getElementById("Class");


          $("#Au").prop('readonly', false);
          $("#Ag").prop('readonly', false);
          $("#DryTonBM").prop('readonly', false);
          $("#DryTonFF").prop('readonly', true);
          $("#Density").prop('readonly', false);
          $("#RL").prop('readonly', false);
          $("#AuEq75").prop('readonly', true);
          $("#Class").prop('readonly', true);
          $("#Augr").prop('readonly', true);
          $("#Aggr").prop('readonly', true);
          $("#Augt").prop('readonly', true);
          $("#Aggt").prop('readonly', true);
        }
      }

      function Counter(){
         var Type = document.getElementById("Type");

         if(Type.value == "Ore"){


        var DryTonFF = document.getElementById("DryTonFF").value;
        var DryTonBM = document.getElementById("DryTonBM").value;
        var Augr = document.getElementById("Augr").value;
        var Augt = document.getElementById("Augt");
        var Aggr = document.getElementById("Aggr").value;
        var Aggt = document.getElementById("Aggt");
        var AuEq75gr = document.getElementById("AuEq75gr");
        var Achievement = document.getElementById("Achievement");
        var Class = document.getElementById("Class");
        var Akumulasitones = document.getElementById("akumulasitones").value;
      
      if(Akumulasitones == ""){
          var aa = parseFloat(DryTonFF);
        }
        else{
          var aa = parseFloat(Akumulasitones)+parseFloat(DryTonFF);
        }

        var x = Augr / aa;
        var y = Aggr / aa;
        
        var z = (aa / DryTonBM)*100;
        Augt.value = x.toFixed(2);
        Aggt.value = y.toFixed(2);
        Achievement.value = z.toFixed(1);
        AuEq75gr.value = parseFloat(x+(y/75)).toFixed(2);

         }else{
          

        var DryTonFF = document.getElementById("DryTonFF").value;
        var DryTonBM = document.getElementById("DryTonBM");
        var Augr = document.getElementById("Augr").value;
        var Augt = document.getElementById("Augt");
        var Aggr = document.getElementById("Aggr").value;
        var Aggt = document.getElementById("Aggt");
        var AuEq75gr = document.getElementById("AuEq75gr");

        var x = Augr / DryTonFF ;
        var y = Aggr / DryTonFF ;

        Augt.value = x.toFixed(2);
        Aggt.value = y.toFixed(2);

        AuEq75gr.value = parseFloat(parseFloat(x+(parseFloat(y)/75)).toFixed(2));


         }

       
      }


        function CounterBlockModel(){
        var Type = document.getElementById("Type");

        var DryTonFF = document.getElementById("DryTonFF");
        var DryTonBM = document.getElementById("DryTonBM");
        var Au = document.getElementById("Au");
        var Ag = document.getElementById("Ag");
        var Augr = document.getElementById("Augr");
        var Augt = document.getElementById("Augt");
        var Aggr = document.getElementById("Aggr");
        var Aggt = document.getElementById("Aggt");
        var AuEq75gr = document.getElementById("AuEq75gr");
        var AuEq75 = document.getElementById("AuEq75");
        var Class = document.getElementById("Class");
        var Density = document.getElementById("Density");


        var x = Au.value ;
        var y = Ag.value ;
        var z = DryTonBM.value;
        
        

    
       var z1 = parseFloat(parseFloat(x)+(parseFloat(y)/75)).toFixed(2);
       

       var AuEq = z1;
     

        if(AuEq<0.65){
          Class.value="Waste";
        }
        else if (0.65<=AuEq && AuEq<2.00){
          Class.value="Marginal";
        }
        else if(2<=AuEq && AuEq<4.00){
          Class.value="Medium Grade";
        }
        else if(4<=AuEq && AuEq<6.00){
          Class.value="High Grade";
        }
        else{
          Class.value="SHG";
        }
     
       
        AuEq75.value = z1;


        var a = Augr.value / z ;
        var b = Aggr.value / z ;

        Augt.value = a.toFixed(2);
        Aggt.value = b.toFixed(2);

        AuEq75gr.value = parseFloat(parseFloat(a+(parseFloat(b)/75)).toFixed(2));

        //EDITED, no calculation

        var a = Au.value;
        var b = Ag.value;

        Augt.value = a;
        Aggt.value = b;
        AuEq75gr.value = AuEq75.value;


        var e = a * z;
        var f = b * z;



        Augr.value = e.toFixed(2);
        Aggr.value = f.toFixed(2);
        DryTonFF.value = z;

       
      }




      function Visual(){

        var Au = document.getElementById("Au").value;
        var Ag = document.getElementById("Ag").value;
        var Class = document.getElementById("Class");
        var AuEq75 = document.getElementById("AuEq75");
        var x = Au;
        var y = Ag/75;
        var z = parseFloat(x+y).toFixed(2);
        var AuEq75gr = z;

        var Class="";
        if(AuEq75gr<0.65){
          Class="Waste";
        }
        else if (0.65<=AuEq75gr && AuEq75gr<2.00){
          Class="Marginal";
        }
        else if(2<=AuEq75gr && AuEq75gr<4.00){
          Class="Medium Grade";
        }
        else if(4<=AuEq75gr && AuEq75gr<6.00){
          Class="High Grade";
        }
        else{
          Class="SHG";
        }
        AuEq75.value = AuEq75gr;
        Class.value = Class;

      }

       $('#DryTonFF').on('change keyup', function() {
        var sanitized = $(this).val().replace(/[^0-9^.]/g, '');
        $(this).val(sanitized);
      });

    </script>

  
    <!-- END JAVASCRIPT -->

  </body>
</html>
