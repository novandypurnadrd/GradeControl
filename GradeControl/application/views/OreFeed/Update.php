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
						<?php foreach ($Table as $table): ?>
            <form class="form" class="form-horizontal" role="form" action="<?php echo base_url().'Orefeed/Input/InputOreFeed' ?>" method="post">
  						<div class="row">
  							<div class="col-lg-6">
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
																	<input type="text" class="form-control" id="Date" name="Date" autocomplete="off" onchange="StockpileChange()" value="<?php echo explode('-',$table->Date)[1].'/'.explode('-',$table->Date)[2].'/'.explode('-',$table->Date)[0] ?>">
																</div>
																<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
															</div>
														</div>
													</div>
														<div class="col-md-6 col-sm-6">
														<label for="Aggt" class="col-sm-4 control-label">Stockpile</label>
														<div class="col-sm-8">
															 <select id="Stockpile1" name="Stockpile1" class="form-control" required="" onchange="StockpileChange()" value="<?php echo $table->Nama ?>">
                                <option value="">&nbsp;</option>
                                <?php foreach ($Stockpile as $stockpile): ?>
                                  <option value="<?php echo $stockpile->id ?>"><?php echo $stockpile->Nama ?></option>
                                <?php endforeach; ?>
      												</select>
														</div>
													</div>
												</div>
												<br>
												
												<div class="form-group">
													<div class="col-md-6 col-sm-6">
														<label for="Aggt" class="col-sm-4 control-label">Remarks</label>
														<div class="col-sm-8">
															<select id="Remarks" name="Remarks" class="form-control" required="" onchange="StatusChange()">
																 <option value="Continue" <?php if($table->Remarks == "Continue"){echo "selected='true'";}?>>Continue</option>
                                								 <option value="Completed" <?php if($table->Remarks == "Completed"){echo "selected='true'";}?>>Completed</option>
															</select>
														</div>
													</div>
													<div class="col-md-6 col-sm-6">
														<label for="Aggt" class="col-sm-4 control-label">Shift</label>
														<div class="col-sm-8">
															<select id="Shift" name="Shift" class="form-control">
															 <option value="AM" <?php if($table->shift == "AM"){echo "selected='true'";}?>>AM</option>
                                							 <option value="PM" <?php if($table->shift == "PM"){echo "selected='true'";}?>>PM</option>
                                							 <option value="DAY" <?php if($table->shift == "DAY"){echo "selected='true'";}?>>DAY</option>
															</select>
													</div>
												</div>
													
												</div>
												<br>
												<div class="form-group">
													<div class="col-md-12 col-sm-12">
  													<label for="DryTonFF" class="col-sm-2 control-label">Note</label>
  													<div class="col-sm-10">
  														<input type="text" class="form-control" id="Note" name="Note" disabled autocomplete="off" value="<?php echo $table->Note ?>" >
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
  							<div class="col-md-7 col-sm-7">
  								<div class="card">
  									<div class="card-body">
  										<div class="form-horizontal">
												<div class="form-group">
													<div class="col-md-3 col-sm-3">
														<label for="Au" class="col-sm-2 control-label">Au</label>
														<div class="col-sm-8">
															<input type="text" class="form-control" id="Au" name="Au" readonly="" autocomplete="off" value="<?php echo $table->Au ?>" >
														</div>
													</div>
													<div class="col-md-3 col-sm-3">
														<label for="Ag" class="col-sm-4 control-label">Ag</label>
														<div class="col-sm-8">
															<input type="text" class="form-control" id="Ag" name="Ag" readonly="" autocomplete="off" value="<?php echo $table->Ag ?>" >
														</div>
													</div>
													<div class="col-md-3 col-sm-3">
														<label for="Ag" class="col-sm-4 control-label">AuEq75</label>
														<div class="col-sm-8">
															<input type="text" class="form-control" id="AuEq75" name="AuEq75" readonly="" autocomplete="off" value="<?php echo $table->AuEq75 ?>" >
														</div>
													</div>
													<div class="col-md-3 col-sm-3">
														<label for="Ag" class="col-sm-4 control-label">Class</label>
														<div class="col-sm-8">
															<input type="text" class="form-control" id="Class" name="Class" readonly="" autocomplete="off" value="<?php echo $table->Class ?>" >
														</div>
													</div>
												</div>
												<div class="form-group">
													<div class="col-md-6 col-sm-6">
														<label for="DryTonBM" class="col-sm-4 control-label">Tonnes</label>
														<div class="col-sm-7">
															<input type="text" class="form-control" id="DryTonBM" name="DryTonBM" readonly="" autocomplete="off" value="<?php echo $table->DryTonBM ?>" >
														</div>
													</div>
													<div class="col-md-6 col-sm-6">
														<label for="Density" class="col-sm-4 control-label">Density</label>
														<div class="col-sm-8">
															<input type="text" class="form-control" id="Density" name="Density" readonly="" autocomplete="off" value="<?php echo $table->Density ?>">
														</div>
													</div>
												</div>
												<div class="form-group">
												<div class="col-md-6 col-sm-6">
														<label for="DryTonBM" class="col-sm-4 control-label">Adjusment Tonnes</label>
														<div class="col-sm-7">
															<input type="text" class="form-control" id="Adjtonnes" name="Adjtonnes" autocomplete="off" >
														</div>
													</div>
													<div class="col-md-6 col-sm-6">
														<label for="DryTonBM" class="col-sm-4 control-label">Volume</label>
														<div class="col-sm-7">
															<input type="text" class="form-control" id="Volume" name="Volume" readonly="" autocomplete="off" value="<?php echo $table->Volume ?>">
														</div>
													</div>
													
												</div>
													<div class="form-group">
												<div class="col-md-6 col-sm-6">
														<label for="DryTonBM" class="col-sm-4 control-label">Adjusment Au</label>
														<div class="col-sm-4">
															<input type="text" class="form-control" id="AdjAuPersen" name="AdjAuPersen" autocomplete="off" onchange="AdjusmentAu()">
															
														</div>
														<span class="input-group-addon">%</span>

													</div>
													<div class="col-md-6 col-sm-6">
														<label for="DryTonBM" class="col-sm-4 control-label">Adjusment Au</label>
														<div class="col-sm-7">
															<input type="text" class="form-control" id="AdjAu" name="AdjAu" readonly="" autocomplete="off">
														</div>
													</div>
													
												</div>
													<div class="form-group">
												<div class="col-md-6 col-sm-6">
														<label for="DryTonBM" class="col-sm-4 control-label">Adjusment Ag</label>
														<div class="col-sm-4">
															<input type="text" class="form-control" id="AdjAgPersen" name="AdjAgPersen" autocomplete="off" onchange="AdjusmentAg()">
															
														</div>
														<span class="input-group-addon">%</span>
													</div>
													<div class="col-md-6 col-sm-6">
														<label for="DryTonBM" class="col-sm-4 control-label">Adjusment Ag</label>
														<div class="col-sm-7">
															<input type="text" class="form-control" id="AdjAg" name="AdjAg" readonly="" autocomplete="off">
														</div>
													</div>
													
												</div>
											
  										</div>
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
															 <select id="Loader" name="Loader" class="form-control" required="" onchange="PercentageChange()" >
                                <option value="">&nbsp;</option>
                                <?php foreach ($Loader as $loader): ?>
                                  <option value="<?php echo $loader->Equipment?>" <?php if($table->Loader == $loader->Equipment){echo "selected='true'";}?>><?php echo $loader->Equipment ?></option>
                                <?php endforeach; ?>
      												</select>
														</div>
													</div>

														<div class="col-md-4 col-sm-4">
														<label for="Aggt" class="col-sm-4 control-label">Material</label>
														<div class="col-sm-8">
															 <select id="material" name="material" class="form-control" required="" onchange="PercentageChange()" >
                                <option value="">&nbsp;</option>
                                <?php foreach ($Material as $material): ?>
                                  <option value="<?php echo $material->material?>" <?php if($table->Material == $material->material){echo "selected='true'";}?>><?php echo $material->material ?></option>
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
                                  <option value="<?php echo $percentage->percentage?>" <?php if($table->Percentage == $percentage->percentage){echo "selected='true'";}?>><?php echo $percentage->percentage ?></option>
                                <?php endforeach; ?>
      												</select>
														</div>
													</div>

												</div>

												<div class="form-group">

													<div class="col-md-4 col-sm-4">
														<label for="DryTonBM" class="col-sm-4 control-label">Bucket</label>
														<div class="col-sm-7">
															<input type="text" class="form-control" id="Bucket" name="Bucket"  autocomplete="off" onchange="PercentageChange()" value="<?php echo $table->Bucket ?>">
														</div>
													</div>

													<div class="col-md-4 col-sm-4">
														<label for="Aggt" class="col-sm-4 control-label">Type</label>
														<div class="col-sm-8">
															<select id="Type" name="Type" class="form-control" required="" onchange="StatusChange()">
																<option value="Continue">Ore Mill</option>
																<option value="Completed">Bypass</option>
															</select>
														</div>
													</div>


												</div>
											
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
															<input type="text" class="form-control" id="Tonnes2" name="Tonnes2" readonly="" autocomplete="off" >
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
															<input type="text" class="form-control" id="Total" name="Total" readonly="" autocomplete="off" value="<?php echo $table->Tonnestocrush ?>">
														</div>
													</div>
													<div class="col-md-6 col-sm-6">
														<label for="DryTonBM" class="col-sm-4 control-label">Stock</label>
														<div class="col-sm-8">
															<input type="text" class="form-control" id="Stock" name="Stock" readonly="" autocomplete="off">
														</div>
													</div>

													
						                            <div class="col-md-12 col-sm-12">
														
														<div class="col-sm-12">
															<input type="text" class="form-control" style="color:red; font-size:100%;text-align: center;" centre="" id="message" name="message" readonly="" autocomplete="off">
														</div>
													</div>
						                            	
						                            </span>
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
       
			

          if ("<?php echo $tostockpile->Stockpile ?>" == StockpileVar.value && "<?php echo $tostockpile->Date ?>" == outDate) {

				Au.value = "<?php echo $tostockpile->Au ?>";
	   			Ag.value = "<?php echo $tostockpile->Ag ?>";
	   			AuEq75.value = "<?php echo $tostockpile->AuEq75 ?>";
	   			Class.value = "<?php echo $tostockpile->Class ?>";

	   			// vAu = "<?php //echo $tostockpile->Au ?>";
	   			// vAg = "<?php //echo $tostockpile->Ag ?>";

	      //      	vTonnes = "<?php //echo $tostockpile->Tonnes ?>";
	      //      	vDensity = "<?php //echo $tostockpile->Density ?>";
	      //      	vVolume = "<?php //echo $tostockpile->Volume ?>";

	      //      	totAu = ((parseFloat(totAu) + parseFloat(vTonnes * vAu)).toFixed(2));
	      //      	totAg = ((parseInt(totAg) + parseInt(vTonnes * vAg)).toFixed(2));

	      //      	totTonnes = ((parseInt(totTonnes) + parseInt(vTonnes)).toFixed(2));
	      //      	totDensity = ((parseFloat(totDensity) + parseFloat(vDensity)).toFixed(2));
	      //      	totVolume = ((parseFloat(totVolume) + parseFloat(vVolume)).toFixed(2));
	
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
            // totAu = "";
            // totAg = "";
            // totTonnes = "";
            // totDensity = "";
            // totVolume = "";
          }

          // Au.value = (parseFloat(totAu)/totTonnes).toFixed(2);
          // Ag.value = (parseFloat(totAg)/totTonnes).toFixed(2);
          // DryTonBM.value = totTonnes;
          // Density.value = totDensity;
          // Volume.value = totVolume;

        <?php endforeach; ?>
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

	   		
	
				Tonnes.value = "<?php echo $loader->Tonnage ?>";
				Density.value = "<?php echo $loader->Density ?>";
				Total.value = parseFloat(Bucket.value * Tonnes.value * Density.value).toFixed(2);
				Stock.value = parseFloat(DryTonBM.value - Total.value).toFixed(2);
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

    </script>

      <script type="text/javascript">
    $('#Bucket').on('change keyup',function()
    {
        
        var stock;
        
        stock = parseFloat(document.getElementById('Stock').value);
        
        if (stock > 0)
        {
            //we're ok
        }
        else
        {
        	var message = document.getElementById("message");
            message.value = "Stock not allowed minus";
            return false;
        }
    });
</script>
		<!-- END JAVASCRIPT -->

	</body>
</html>
