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
						<?php foreach ($Table as $table):
							$Date = explode('-', $table->Date)[1].'/'.explode('-', $table->Date)[2].'/'.explode('-', $table->Date)[0];
							if ($table->Type == "Ore") {
								if ($table->Remarks == "Continue") {
									$Au = $table->AuBM;
									$Ag = $table->AgBM;
									$DryTon = $table->DryTonBM;
								}
								else {
									if ($table->Achievement >= 80) {
										$Au = $table->AuFF;
										$Ag = $table->AgFF;
										$DryTon = $table->DryTonFF;
									}
									else {
										$Au = $table->AuBM;
										$Ag = $table->AgBM;
										$DryTon = $table->DryTonBM;
									}
								}
								$Density = $table->Dbdensity;
							}
							else {
								$Au = $table->Au;
								$Ag = $table->Ag;
								$Density = $table->Density;
								$DryTon = $table->DryTon;
							}
							?>
							<form class="form" class="form-horizontal" role="form" action="<?php echo base_url().'Oremined/Update/UpdateOremined/'.$id.'/'.$date.'/'.$stockpile ?>" method="post">
	  						<div class="row">
	  							<div class="col-lg-6">
	  								<h2 class="text-primary">Choose Pit & Block</h2>
	  							</div><!--end .col -->
	  								<div class="col-lg-6">
	  									<h2 class="text-primary">Grade</h2>
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
																	<option value="Ore" <?php if($table->Type=="Ore"){echo "selected='true'";}?>>Ore</option>
																	<option value="Visual" <?php if($table->Type=="Visual"){echo "selected='true'";}?>>Visual</option>
																	<option value="Mineralized Waste" <?php if($table->Type=="Mineralized Waste"){echo "selected='true'";}?>>Mineralized Waste</option>
																</select>
															</div>
														</div>
													</div>
													<div class="form-group">
														<div class="col-md-6 col-sm-6">
															<label for="Aggt" class="col-sm-4 control-label" id="ore">Block</label>
															<div class="col-sm-8">
																<select id="Block" name="Block" class="form-control" onchange="BlockChange()" required="">
			  													<option value="">&nbsp;</option>
			                            <?php foreach ($Oreline as $oreline): ?>
			                              <option value="<?php echo $oreline->id ?>" class="<?php echo $oreline->pit ?>" <?php if($table->Block == $oreline->id){echo "selected='true'";}?>><?php echo $oreline->id ?></option>
			                            <?php endforeach; ?>
			  												</select>
															</div>
														</div>
														<div class="col-md-6 col-sm-6">
															<label for="Au" class="col-sm-4 control-label" id="nonore"></label>
															<div class="col-sm-8">
																<?php if($table->Type != "Ore"){ ?>
																	<input type="text" class="form-control" id="Nonore" name="Nonore" disabled="" value="<?php echo $table->Block?>">
																<?php }
																else { ?>
																	<input type="text" class="form-control" id="Nonore" name="Nonore" disabled="" >
																<?php } ?>

															</div>
														</div>
													</div>
													<div class="form-group">
														<div class="col-md-6 col-sm-6">
															<label for="Au" class="col-sm-4 control-label">RL</label>
															<div class="col-sm-8">
																<input type="text" class="form-control" id="RL" name="RL" readonly="" autocomplete="off" value="<?php echo $table->RL ?>">
															</div>
														</div>
													</div>
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
															<label for="Au" class="col-sm-4 control-label">Au</label>
															<div class="col-sm-8">
																<input type="text" class="form-control" id="Au" name="Au" readonly="" autocomplete="off" value="<?php echo $Au ?>">
															</div>
														</div>
														<div class="col-md-6 col-sm-6">
															<label for="Ag" class="col-sm-4 control-label">Ag</label>
															<div class="col-sm-8">
																<input type="text" class="form-control" id="Ag" name="Ag" readonly="" value="<?php echo $Ag ?>">
															</div>
														</div>
													</div>
													<div class="form-group">
														<div class="col-md-6 col-sm-6">
															<label for="DryTonBM" class="col-sm-4 control-label">Dry Ton BM</label>
															<div class="col-sm-7">
																<input type="text" class="form-control" id="DryTonBM" name="DryTonBM" readonly="" value="<?php echo $DryTon ?>">
															</div>
														</div>
														<div class="col-md-6 col-sm-6">
															<label for="Density" class="col-sm-4 control-label">Density</label>
															<div class="col-sm-8">
																<input type="text" class="form-control" id="Density" name="Density" readonly="" value="<?php echo $Density ?>">
															</div>
														</div>
													</div>
												</br>
												</br>
	  										</div>
	  									</div><!--end .card-body -->
	  								</div><!--end .card -->
	  							</div><!--end .col -->
	  						</div><!--end .row -->
	  						<!-- BEGIN TITLE -->
	  						<div class="row">
	  							<div class="col-lg-12">
	  								<h2 class="text-primary">Details Oremined</h2>
	  							</div><!--end .col -->
	  						</div><!--end .row -->
	  						<!-- END TITLE -->
	  						<div class="row">
	  							<div class="col-md-12 col-sm-12">
	  								<div class="card">
	  									<div class="card-body">
	  										<div class="form-horizontal">
													<div class="form-group">
	  												<div class="col-md-4 col-sm-4">
	  													<label for="DryTonFF" class="col-sm-4 control-label">Truck Tally</label>
	  													<div class="col-sm-8">
	  														<input type="text" class="form-control" id="TruckTally" name="TruckTally" required="" autocomplete="off" value="<?php echo $table->TruckTally ?>">
	  													</div>
	  												</div>
														<div class="col-md-4 col-sm-4">
	                            <label for="Aggt" class="col-sm-4 control-label">Stockpile</label>
	  													<div class="col-sm-8">
	                              <select id="Stockpile" name="Stockpile" class="form-control" required="" onchange="StatusChange()">
	                                <option value="">&nbsp;</option>
	                                <?php foreach ($Stockpile as $stockpile): ?>
	                                  <option value="<?php echo $stockpile->id ?>" <?php if($table->Stockpile == $stockpile->id){echo "selected='true'";}?>><?php echo $stockpile->Nama ?></option>
	                                <?php endforeach; ?>
	      												</select>
	                            </div>
	  												</div>
	  											</div>
													<div class="form-group">
														<div class="col-md-4 col-sm-4">
															<label for="Aggt" class="col-sm-4 control-label">Date</label>
															<div class="col-sm-8">
																<div class="input-group date" id="demo-date">
																	<div class="input-group-content">
																		<input type="text" class="form-control" id="Date" name="Date" autocomplete="off" value="<?php echo $Date ?>">
																	</div>
																	<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
																</div>
															</div>
														</div>
														<div class="col-md-4 col-sm-4">
															<label for="Aggt" class="col-sm-4 control-label">Remarks</label>
															<div class="col-sm-8">
																<select id="Remarks" name="Remarks" class="form-control" required="" onchange="StatusChange()">
																	<option value="Continue" <?php if($table->Remarks == "Continue"){echo "selected='true'";}?>>Continue</option>
																	<option value="Completed" <?php if($table->Remarks == "Completed"){echo "selected='true'";}?>>Completed</option>
																</select>
															</div>
														</div>
														<div class="col-md-4 col-sm-4">
	  													<label for="DryTonFF" class="col-sm-4 control-label">Note</label>
	  													<div class="col-sm-8">
	  														<input type="text" class="form-control" id="Note" name="Note" disabled autocomplete="off" value="<?php echo $table->Note ?>">
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
	                    <button type="submit" class="btn ink-reaction btn-raised btn-primary"><i class="md md-save"></i> Update</button>
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
			$('#TruckTally').on('change keyup', function() {
			  var sanitized = $(this).val().replace(/[^0-9,.]/g, '');
			  $(this).val(sanitized);
			});
		</script>
    <script type="text/javascript">
      function StatusChange() {
        var Remarks = document.getElementById("Remarks");
        var Note = document.getElementById("Note");

        if (Remarks.value == "Continue") {
          Note.disabled = true;
        }else {
          Note.disabled = false;
        }
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
        }
      }

      function BlockChange(){
        var Block = document.getElementById("Block");
        var Au = document.getElementById("Au");
        var Ag = document.getElementById("Ag");
        var DryTonBM = document.getElementById("DryTonBM");
				var Density = document.getElementById("Density");
        var RL = document.getElementById("RL");

        <?php foreach ($OreInventory as $oreinventory): ?>
          if ("<?php echo $oreinventory->Block ?>" == Block.value) {
						if (<?php echo $oreinventory->Achievement ?> < 80) {
							Au.value = "<?php echo $oreinventory->Au ?>";
	            Ag.value = "<?php echo $oreinventory->Ag ?>";
						}
						else {
							Au.value = "<?php echo $oreinventory->Augt ?>";
	            Ag.value = "<?php echo $oreinventory->Aggt ?>";
						}
            DryTonBM.value = "<?php echo $oreinventory->DryTon ?>";
						Density.value = "<?php echo $oreinventory->Dbdensity ?>";
            RL.value = "<?php echo $oreinventory->RL ?>";
          }else {
            Au.value = "";
            Ag.value = "";
            DryTonBM.value = "";
            Density.value = "";
            RL.value = "";
          }
        <?php endforeach; ?>
      }

			function Loader(){
				TypeChange();
			}

    </script>
		<!-- END JAVASCRIPT -->

	</body>
</html>
