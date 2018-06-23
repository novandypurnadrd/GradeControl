<!DOCTYPE html>
<html lang="en">
	<head>

    <!-- HEADLIB -->
		<?php $this->load->view('lib/Headlib'); ?>
		<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/theme-default/libs/bootstrap-datepicker/datepicker3.css?1424887858" />
		<!-- END HEADLIB -->

	</head>
	<body onload="StockpileChange()" class="menubar-hoverable header-fixed ">

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
            <form class="form" class="form-horizontal" role="form" action="<?php echo base_url().'Orefeed/Input/GetGrade' ?>" method="post">
  						<div class="row">
  							<div class="col-lg-5">
  								<h2 class="text-primary">Detail Orefeed</h2>
  							</div><!--end .col -->
  								<div class="col-lg-6">
  									<h2 class="text-primary">Grade</h2>
  								</div><!--end .col -->
  						</div><!--end .row -->
  						<!-- END TITLE -->
  						<div class="row">
  							<div class="col-md-5 col-sm-5">
  								<div class="card">
  									<div class="card-body">
											<div class="form-horizontal">
											<div class="form-group">
													<div class="col-md-6 col-sm-6">
														<label for="Aggt" class="col-sm-2 control-label">Date</label>
														<div class="col-sm-10">
															<div class="input-group date" id="demo-date">
																<div class="input-group-content">
																	<input type="text" class="form-control" id="Date" name="Date" autocomplete="off" onchange="StockpileChange()" value="<?php echo $Datedetails ?>">
																</div>
																<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
															</div>
														</div>
													</div>
														<div class="col-md-6 col-sm-6">
														<label for="Aggt" class="col-sm-4 control-label">Stockpile</label>
														<div class="col-sm-8">
															 <select id="Stockpile1" name="Stockpile1" class="form-control" required="" onchange="StockpileChange()">
                                <option value="">&nbsp;</option>
                                <?php foreach ($Stockpile as $stockpile): ?>
                                  <option value="<?php echo $stockpile->id ?>" <?php if($stockpile->id == $Stockpiledetails){echo "selected='true'";}?>><?php echo $stockpile->Nama ?></option>
                                <?php endforeach; ?>
      												</select>
														</div>
													</div>
												</div>
												<br>
												
											<!-- 	<div class="form-group">
													<div class="col-md-6 col-sm-6">
														<label for="Aggt" class="col-sm-4 control-label">Remarks</label>
														<div class="col-sm-8">
															<select id="Remarks" name="Remarks" class="form-control" required="" onchange="StatusChange()">
																<option value="Continue">Continue</option>
																<option value="Completed">Completed</option>
															</select>
														</div>
													</div>
													<div class="col-md-6 col-sm-6">
														<div class="col-md-4 col-sm-4">
														</div>
														<div class="col-md-8 col-sm-8">
															 <button type="submit" class="btn ink-reaction btn-raised btn-primary" id="button" name="button" onclick="SetValueGrade()"><i class="md md-save"></i>Grade</button>
														</div>

														
												</div>

												<div class="col-md-6 col-sm-6">
														<label for="Aggt" class="col-sm-4 control-label">Shift</label>
														<div class="col-sm-8">
															<select id="Shift" name="Shift" class="form-control">
																<option value="AM">AM</option>
																<option value="PM">PM</option>
																<option value="DAY">DAY</option>
															</select>
													</div>
												</div>
													
												</div> -->
											
												<div class="form-group">
													<div class="col-md-6 col-sm-6">
  													<label for="DryTonFF" class="col-sm-2 control-label">Note</label>
  													<div class="col-sm-10">
  														<textarea rows="3" id="Note" name="Note"></textarea>
  													</div>
  												</div>
  													
												</div>
				
											<br>
											<br>
											<br>
											<br>
											<br>

											</div>
  									</div><!--end .card-body -->
  								</div><!--end .card -->
  							</div><!--end .col -->
  						</form>

  						 <form class="form" class="form-horizontal" role="form" action="<?php echo base_url().'Orefeed/Input/InputOreFeed' ?>" method="post">
  							<div class="col-md-7 col-sm-7">
  								<div class="card">
  									<div class="card-body">
  										<div class="form-horizontal">
												<div class="form-group">
													
													<div class="col-md-3 col-sm-3">
														<label for="Au" class="col-sm-2 control-label">Au</label>
														<div class="col-sm-8">
															<!-- <?php //foreach ($Grade as $grade): ?> -->
															<input type="text" class="form-control" id="Au" name="Au" readonly="" autocomplete="off">
															<!-- <?php //endforeach; ?> -->
														</div>
													</div>
													<div class="col-md-3 col-sm-3">
														<label for="Ag" class="col-sm-4 control-label">Ag</label>
														<div class="col-sm-8">
														<!-- 	<?php //foreach ($Grade as $grade): ?> -->
															<input type="text" class="form-control" id="Ag" name="Ag" readonly="" autocomplete="off">
															<!-- <?php //endforeach; ?> -->
														</div>
													</div>
													<div class="col-md-3 col-sm-3">
														<label for="Ag" class="col-sm-4 control-label">AuEq75</label>
														<div class="col-sm-8">
															<!-- <?php //foreach ($Grade as $grade): ?> -->
															<input type="text" class="form-control" id="AuEq75" name="AuEq75" readonly="" autocomplete="off" >
															<!-- <?php //endforeach; ?> -->
														</div>
													</div>
													<div class="col-md-3 col-sm-3">
														<label for="Ag" class="col-sm-4 control-label">Class</label>
														<div class="col-sm-8">
															<!-- <?php //foreach ($Grade as $grade): ?> -->
															<input type="text" class="form-control" id="Class" name="Class" readonly="" autocomplete="off" >
															<!-- <?php //endforeach; ?> -->
														</div>
													</div>
													
												</div>
												<div class="form-group">
													<div class="col-md-6 col-sm-6">
														<label for="DryTonBM" class="col-sm-4 control-label">Tonnes</label>
														<div class="col-sm-7">
															<input type="text" class="form-control" id="DryTonBM" name="DryTonBM" readonly="" autocomplete="off" >
														</div>
													</div>
													<div class="col-md-6 col-sm-6">
														<label for="Density" class="col-sm-4 control-label">Density</label>
														<div class="col-sm-8">
															<input type="text" class="form-control" id="Density" name="Density" readonly="" autocomplete="off" >
														</div>
													</div>
												</div>
												<div class="form-group">
												<div class="col-md-6 col-sm-6">
														<label for="DryTonBM" class="col-sm-4 control-label">Adjusment Tonnes</label>
														<div class="col-sm-7">
															<input type="text" class="form-control" id="Adjtonnes" name="Adjtonnes" autocomplete="off">
														</div>
													</div>
													<div class="col-md-6 col-sm-6">
														<label for="DryTonBM" class="col-sm-4 control-label">Volume</label>
														<div class="col-sm-7">
															<input type="text" class="form-control" id="Volume" name="Volume" readonly="" autocomplete="off" >
														</div>
													</div>
													
												</div>
													<div class="form-group">
												<div class="col-md-6 col-sm-6">
														<label for="DryTonBM" class="col-sm-4 control-label">Adjusment Au</label>
														<div class="col-sm-4">
															<input type="text" class="form-control" id="AdjAuPersen" name="AdjAuPersen" autocomplete="off" onkeyup="AdjusmentAu()" required="">
															
														</div>
														<span class="input-group-addon">%</span>

													</div>
													<div class="col-md-6 col-sm-6">
														<label for="DryTonBM" class="col-sm-4 control-label">Adjusment Au</label>
														<div class="col-sm-7">
															<input type="text" class="form-control" id="AdjAu" name="AdjAu" autocomplete="off">
														</div>
													</div>
													
												</div>
													<div class="form-group">
												<div class="col-md-6 col-sm-6">
														<label for="DryTonBM" class="col-sm-4 control-label">Adjusment Ag</label>
														<div class="col-sm-4">
															<input type="text" class="form-control" id="AdjAgPersen" name="AdjAgPersen" autocomplete="off" onkeyup="AdjusmentAg()" required="">
															
														</div>
														<span class="input-group-addon">%</span>
													</div>
													<div class="col-md-6 col-sm-6">
														<label for="DryTonBM" class="col-sm-4 control-label">Adjusment Ag</label>
														<div class="col-sm-7">
															<input type="text" class="form-control" id="AdjAg" name="AdjAg" autocomplete="off">
														</div>
													</div>
													
												</div>
												<div class ="form-group">
													
												
														
													
														 <div class="col-md-1">
                       										<div class="form-group">
                          										<label class="col-sm-4 control-label"></label>
                          										<div class="col-sm-8">
                            										<input autocomplete="off" type="hidden" class="form-control" id="dateOrefeed" name="dateOrefeed" type="text" placeholder="">
                          										</div>
                        									</div> 
                     									</div>
                     									 <div class="col-md-1">
                       										<div class="form-group">
                          										<label class="col-sm-4 control-label"></label>
                          										<div class="col-sm-8">
                            										<input autocomplete="off" type="hidden" class="form-control" id="stockpileOrefeed" name="stockpileOrefeed" type="text" placeholder="">
                          										</div>
                        									</div> 
                     									</div>
                     									 <div class="col-md-1">
                       										<div class="form-group">
                          										<label class="col-sm-4 control-label"></label>
                          										<div class="col-sm-8">
                            										<input autocomplete="off" type="hidden" class="form-control" id="shiftOrefeed" name="shiftOrefeed" type="text" placeholder="">
                          										</div>
                        									</div> 
                     									</div>

                     									<div class="col-md-1">
                       										<div class="form-group">
                          										<label class="col-sm-4 control-label"></label>
                          										<div class="col-sm-8">
                            										<input autocomplete="off" type="hidden" class="form-control" id="noteOrefeed" name="noteOrefeed" type="text" placeholder="">
                          										</div>
                        									</div> 
                     									</div>

                     										<div class="col-md-1">
                       										<div class="form-group">
                          										<label class="col-sm-4 control-label"></label>
                          										<div class="col-sm-8">
                            										<input autocomplete="off" type="hidden" class="form-control" id="remarksOrefeed" name="remarksOrefeed" type="text" placeholder="">
                          										</div>
                        									</div> 
                     									</div>
												
												</div>
											
  										</div>
  										<br>
  									</div><!--end .card-body -->
  								</div><!--end .card -->
  							</div><!--end .col -->
  						</div><!--end .row -->
  						<div class="row">
  							<div class="col-lg-8">
  								<h2 class="text-primary">Choose Loader</h2>
  							</div><!--end .col -->
  								<div class="col-lg-4">
  									<h2 class="text-primary">Tonnes to Crush</h2>
  								</div><!--end .col -->
  						</div><!--end .row -->
  						<!-- END TITLE -->
  						<div class="row">
  							<div class="col-md-8 col-sm-8">
  								<div class="card">
  									<div class="card-body">
  										<div class="form-horizontal">
											
												<div class="form-group">
													<div class="col-md-4 col-sm-4">
														<label for="Aggt" class="col-sm-4 control-label">Loader</label>
														<div class="col-sm-8">
															 <select id="Loader" name="Loader" class="form-control" required="" onchange="SetLoader()">
                                <option value="">&nbsp;</option>
                                <?php foreach ($Loader as $loader): ?>
                                  <option value="<?php echo $loader->Equipment ?>"><?php echo $loader->Equipment ?></option>
                                <?php endforeach; ?>
      												</select>
														</div>
													</div>

														<div class="col-md-4 col-sm-4">
														<label for="Aggt" class="col-sm-4 control-label">Material</label>
														<div class="col-sm-8">
															 <select id="material" name="material" class="form-control" required="" onchange="SetValueOrefeed()" >
                                <option value="">&nbsp;</option>
                                <?php foreach ($Material as $material): ?>
                                  <option value="<?php echo $material->material ?>"><?php echo $material->material ?></option>
                                <?php endforeach; ?>
      												</select>
														</div>
													</div>

														<div class="col-md-4 col-sm-4">
														<label for="Aggt" class="col-sm-4 control-label">Percentage</label>
														<div class="col-sm-8">
															 <select id="percentage" name="percentage" class="form-control" required="" onchange="PercentageChange()">
                                <option value="">&nbsp;</option>
                                <?php foreach ($Percentage as $percentage): ?>
                                  <option value="<?php echo $percentage->percentage ?>"><?php echo $percentage->percentage ?></option>
                                <?php endforeach; ?>
      												</select>
														</div>
													</div>

												</div>

												<div class="form-group">

													<div class="col-md-4 col-sm-4">
														<label for="DryTonBM" class="col-sm-4 control-label">Bucket</label>
														<div class="col-sm-7">
															<input type="text" class="form-control" id="Bucket" name="Bucket"  autocomplete="off" onkeyup="PercentageChange()">
														</div>
													</div>

													<div class="col-md-4 col-sm-4">
														<label for="Aggt" class="col-sm-4 control-label">Type</label>
														<div class="col-sm-8">
															<select id="Type" name="Type" class="form-control" required="" onchange="SetValueOrefeed()">
																<option value="">Choose</option>
																<option value="Oremill">Ore Mill</option>
																<option value="Bypass">Bypass</option>
															</select>
														</div>
													</div>


												</div>
											
												<br>
												<br>
												<br>
												<br>
												<br>
												<br>

											</div>		
  											
  										
  									</div><!--end .card-body -->
  								</div><!--end .card -->
  							</div><!--end .col -->
  						
  							<div class="col-md-4 col-sm-4">
  								<div class="card">
  									<div class="card-body">
  										<div class="form-horizontal">
											
												<div class="form-group">
													<div class="col-md-6 col-sm-6">
														<label for="DryTonBM" class="col-sm-4 control-label">Tonnes</label>
														<div class="col-sm-7">
															<input type="text" class="form-control" id="Tonnes2" name="Tonnes2" readonly="" autocomplete="off">
														</div>
													</div>
													<div class="col-md-6 col-sm-6">
														<label for="Density" class="col-sm-4 control-label">Density</label>
														<div class="col-sm-8">
															<input type="text" class="form-control" id="Density2" name="Density2" readonly="" autocomplete="off">
														</div>
													</div>
												</div>
												<div class="form-group">
													<div class="col-md-6 col-sm-6">
														<label for="DryTonBM" class="col-sm-4 control-label">Total</label>
														<div class="col-sm-8">
															<input type="text" class="form-control" id="Total" name="Total" readonly="" autocomplete="off">
														</div>
													</div>
													<div class="col-md-6 col-sm-6">
														<label for="DryTonBM" class="col-sm-4 control-label">Stock</label>
														<div class="col-sm-8">
															<input type="text" class="form-control" id="Stock" name="Stock" readonly="" autocomplete="off">
														</div>
													</div>
												</div>
												<br>
												<div class="form-group">
													<!-- <div class="col-md-6 col-sm-6">
														<label for="Operator" class="col-sm-4 control-label">Operator</label>
														<div class="col-sm-8">
															<select id="Operator" name="Operator" class="form-control" required="">
																<option value="+">+</option>
																<option value="-">-</option>
															</select>
														</div>
														
													</div> -->

													<div class="col-md-6 col-sm-6">
														<label for="DryTonBM" class="col-sm-4 control-label">Act.</label>
														<div class="col-sm-8">
															<input type="text" class="form-control" id="Act" name="Act" autocomplete="off" onkeyup="ActTonnes()">
														</div>
													</div>
												</div>

												<div class="form-group">	
						                            <div class="col-md-12 col-sm-12">
														
														<div class="col-sm-12">
															<input type="text" class="form-control" style="color:red; font-size:100%;text-align: center;" centre="" id="message" name="message" readonly="" autocomplete="off">
														</div>
													</div>
 
    											</div>
													
												</div>
												
												<br>
												
											
  										</div>
  									</div><!--end .card-body -->
  								</div><!--end .card -->
  							</div><!--end .col -->
  						</div><!--end .row -->
  						
  					
              <div class="row" style="text-align:center">
  							<div class="col-md-12 col-sm-12">
                  <div class="form-group">
                    <button type="submit" class="btn ink-reaction btn-raised btn-primary" id="button" name="button"><i class="md md-save"></i> Insert</button>
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
			$('#TruckTally').on('change keyup', function() {
			  var sanitized = $(this).val().replace(/[^0-9,.]/g, '');
			  $(this).val(sanitized);
			});
		</script>
    <script type="text/javascript">
      


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

      function StockpileChange() {
       	var StockpileVar = document.getElementById("Stockpile1");
        var Au = document.getElementById("Au");
        var Ag = document.getElementById("Ag");
        var DryTonBM = document.getElementById("DryTonBM");
		var Density = document.getElementById("Density");
		var Volume = document.getElementById("Volume");
        var Bucket = document.getElementById("Bucket");
        var Tgl = document.getElementById("Date");
        var AuEq75 = document.getElementById("AuEq75");
        var Class = document.getElementById("Class");
        
        var Dates = "";
        var vAu = 0;
        var vAg = 0;
        var vTonnes = 0;
        var vDensity = 0;
        var vVolume = 0;
        var totAu = 0;
        var totAg = 0;
        var totTonnes = 0;
        var totDensity = 0;
        var totVolume = 0;

        var convertDate = function(usDate) {
  		var dateParts = usDate.split(/(\d{1,2})\/(\d{1,2})\/(\d{4})/);
  		return dateParts[3] + "-" + dateParts[1] + "-" + dateParts[2];
		}

		var inDate = Tgl.value;
		var outDate = convertDate(inDate);

        <?php foreach ($ToStockpile as $tostockpile): ?>
       
			

          if ("<?php echo $tostockpile->Stockpile ?>" == StockpileVar.value) {

				Au.value = "<?php echo $tostockpile->Au ?>";
	   			Ag.value = "<?php echo $tostockpile->Ag ?>";
	   			AuEq75.value = "<?php echo $tostockpile->AuEq75 ?>";
	   			Class.value = "<?php echo $tostockpile->Class ?>";

	
				DryTonBM.value = parseFloat("<?php echo $tostockpile->Tonnes ?>").toFixed(2);
				Density.value = parseFloat("<?php echo $tostockpile->Density ?>").toFixed(2);
				vVolume = "<?php echo $tostockpile->Volume ?>";
				Volume.value = parseFloat(vVolume).toFixed(2) ;
				return;
          }else {
            Au.value = "";
            Ag.value = "";
            DryTonBM.value = "";
            Density.value = "";
            Bucket.value = "";
            Volume.value ="";

          }


        <?php endforeach; ?>
      }


      function SetLoader(){
      	var Loader = document.getElementById("Loader");
      	var Material = document.getElementById("material");
        var Percentage = document.getElementById("percentage");
        var Tonnes = document.getElementById("Tonnes2");
		var Density = document.getElementById("Density2");

         <?php foreach ($Loader as $loader): ?>
          if ("<?php echo $loader->Equipment ?>" == Loader.value) {

          		Material.value = "<?php echo $loader->Material ?>";
          		Percentage.value = "<?php echo $loader->Percentage ?>";
          	}


          if ("<?php echo $loader->Equipment ?>" == Loader.value && "<?php echo $loader->Material ?>" == Material.value && "<?php echo $loader->Percentage ?>" == Percentage.value ) {

          		Tonnes.value = "<?php echo $loader->Tonnageper ?>";
				Density.value = "<?php echo $loader->Density ?>";
          }

          <?php endforeach ?>


      }


       function PercentageChange() {
        var Loader = document.getElementById("Loader");
        var Material = document.getElementById("material");
        var Percentage = document.getElementById("percentage");
        var Tonnes = document.getElementById("Tonnes2");
		var Density = document.getElementById("Density2");
		var Total = document.getElementById("Total");
        var Bucket = document.getElementById("Bucket");
        var Stock = document.getElementById("Stock");
        var DryTonBM = document.getElementById("DryTonBM");

        
        var vTonnes = 0;
        var vDensity = 0;
        var vVolume = 0;
      
        var totTonnes = 0;
        var totDensity = 0;
        var totVolume = 0;

        <?php foreach ($Loader as $loader): ?>
          if ("<?php echo $loader->Equipment ?>" == Loader.value && "<?php echo $loader->Material ?>" == Material.value && "<?php echo $loader->Percentage ?>" == Percentage.value ) {

				// Au.value = "<?php //echo $tostockpile->Au ?>";
	   			// Ag.value = "<?php //echo $tostockpile->Ag ?>";

	   		
	
				Tonnes.value = "<?php echo $loader->Tonnageper ?>";
				Density.value = "<?php echo $loader->Density ?>";
				Percentage.value = "<?php echo $loader->Percentage ?>";
				Total.value = parseFloat(Bucket.value * Tonnes.value).toFixed(4);
				Stock.value = parseFloat(DryTonBM.value - Total.value).toFixed(4);
				return;
          }else {
       
            Tonnes.value = "";
            Density.value = "";
            Total.value = "";
         	Stock.value ="";
          }

        var Total = document.getElementById("Total");
        var DryTonBM = document.getElementById("DryTonBM");

        if (parseInt(Stock.value) < 0) {
          document.getElementById("button").disabled = true;
        }else {
          document.getElementById("button").disabled = false;
        }



        <?php endforeach; ?>
      }

      function AdjusmentAu(){
      	var Au = document.getElementById("Au");
      	
      	var AdjAuAg =  document.getElementById("AdjAuPersen");
      	var AdjAu = document.getElementById("AdjAu");
      	

      	AdjAu.value = parseFloat(AdjAuAg.value/100*Au.value).toFixed(2);
      }

       function AdjusmentAg(){
      	
      	var Ag = document.getElementById("Ag");
      	var AdjAuAg =  document.getElementById("AdjAgPersen");
      	
      	var AdjAg = document.getElementById("AdjAg");

      	
      	AdjAg.value = parseFloat(AdjAuAg.value/100*Ag.value).toFixed(2);
      }

      function ActTonnes(){



      	var Loader = document.getElementById("Loader");
        var Material = document.getElementById("material");
        var Percentage = document.getElementById("percentage");
        var Tonnes = document.getElementById("Tonnes2");
		var Density = document.getElementById("Density2");
		var Total = document.getElementById("Total");
        var Bucket = document.getElementById("Bucket");
        var Stock = document.getElementById("Stock");
        var DryTonBM = document.getElementById("DryTonBM");

        var Act = document.getElementById("Act");
		var v_Act = parseFloat(Act.value);

        
        var vTonnes = 0;
        var vDensity = 0;
        var vVolume = 0;
      
        var totTonnes = 0;
        var totDensity = 0;
        var totVolume = 0;

        <?php foreach ($Loader as $loader): ?>
          if ("<?php echo $loader->Equipment ?>" == Loader.value && "<?php echo $loader->Material ?>" == Material.value && "<?php echo $loader->Percentage ?>" == Percentage.value ) {

				// Au.value = "<?php //echo $tostockpile->Au ?>";
	   			// Ag.value = "<?php //echo $tostockpile->Ag ?>";

	   		
	
				Tonnes.value = "<?php echo $loader->Tonnageper ?>";
				Density.value = "<?php echo $loader->Density ?>";
				Percentage.value = "<?php echo $loader->Percentage ?>";
				Total.value = parseFloat(Bucket.value * Tonnes.value).toFixed(4);

				if(!v_Act)
				{
					v_Act = 0;
				}

				
				Total.value = parseFloat((Bucket.value * Tonnes.value) + v_Act) .toFixed(4);
				Stock.value = parseFloat(DryTonBM.value - Total.value).toFixed(4);

							if (Stock.value >= 0)
					        {
					            var message = document.getElementById("message");
					            message.value = "";
					          
					        }
					        else
					        {
					        	var message = document.getElementById("message");
					            message.value = "Stock not allowed minus";
					         
					        }
				return;
          }else {
       
            Tonnes.value = "";
            Density.value = "";
            Total.value = "";
         	Stock.value ="";
          }

          <?php endforeach; ?>

      // 	var Stock = document.getElementById("Stock");
      // 	var Act = document.getElementById("Act");
      // 	var Adjtonnes = document.getElementById("Adjtonnes");
      // 	var Total = document.getElementById("Total");
      // 	var Operator = document.getElementById("Operator");

      // 	var v_Stock = parseFloat(Stock.value);
      // 	var v_Act = parseInt(Act.value);
      // 	var v_Total = parseInt(Total.value);


      	

     	// if(Operator.value == "-"){

     	// 	Total.value = (v_Total - v_Act);

     	// }
     	// else{

     	// 	Total.value = (v_Total + v_Act);
     	// }

      // 	//Adjtonnes.value = parseFloat(v_Stock + v_Act).toFixed(2);


      }

        function SetValueOrefeed() {
        var masterDate = document.getElementById("Date");
        var masterStockpile = document.getElementById("Stockpile1");
        var masterNote = document.getElementById("Note");

        var orefeedDate = document.getElementById("dateOrefeed");
        var orefeedStockpile = document.getElementById("stockpileOrefeed");
        var orefeedRemarks = document.getElementById("remarksOrefeed");
        var orefeedNote = document.getElementById("noteOrefeed");
        var orefedShift = document.getElementById("shiftOrefeed");

        orefeedDate.value = masterDate.value;
        orefeedStockpile.value = masterStockpile.value;
        orefeedNote.value = masterNote.value;
      }


    </script>

      <script type="text/javascript">
    $('#Bucket').on('change keyup',function()
    {
        
        var stock;
        
        stock = parseFloat(document.getElementById('Stock').value);
        
        if (stock > 0)
        {
            var message = document.getElementById("message");
            message.value = "";
            return false;
        }
        else
        {
        	var message = document.getElementById("message");
            message.value = "Stock not allowed minus";
            return false;
        }
    });

     $('#Adjtonnes').on('change keyup', function() {
			  var sanitized = $(this).val().replace(/[^0-9^.]/g, '');
			  $(this).val(sanitized);
			});
	$('#AdjAu').on('change keyup', function() {
			  var sanitized = $(this).val().replace(/[^0-9^.]/g, '');
			  $(this).val(sanitized);
			});
       $('#AdjAg').on('change keyup', function() {
			  var sanitized = $(this).val().replace(/[^0-9^.]/g, '');
			  $(this).val(sanitized);
			});
       $('#AdjAgPersen').on('change keyup', function() {
			  var sanitized = $(this).val().replace(/[^0-9^.]/g, '');
			  $(this).val(sanitized);
			});
       $('#AdjAuPersen').on('change keyup', function() {
			  var sanitized = $(this).val().replace(/[^0-9^.]/g, '');
			  $(this).val(sanitized);
			});


        function SetValueGrade() {
        var masterAuEq75 = document.getElementById("AuEq75");
        var masterClass = document.getElementById("Class");
        var masterTonnes = document.getElementById("Tonnes");
        var masterVolume = document.getElementById("Volume");
        var masterDensity = document.getElementById("Density");

        var valueAuEq75 = document.getElementById("valueAuEq75");
        var valueClass = document.getElementById("valueClass");
        var valueTonnes = document.getElementById("valueTonnes");
        var valueDensity = document.getElementById("valueDensity");
        var valueVolume = document.getElementById("valueVolume");


        valueAuEq75.value = masterAuEq75.value;
        valueClass.value = masterClass.value;
        valueTonnes.value = masterTonnes.value;
        valueDensity.value = masterDensity.value;
        valueVolume.value = masterDensity.value;
        
      }


</script>
		<!-- END JAVASCRIPT -->

	</body>
</html>
