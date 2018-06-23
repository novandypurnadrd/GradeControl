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
								<h1 class="text-primary">Import Ore Inventory (CSV)</h1>
							</div><!--end .col -->
						</div><!--end .row -->
						<!-- END INTRO -->

						<!-- BEGIN BASIC ELEMENTS -->
						<div class="row">
							<div class="col-md-12 col-sm-12">
								<div class="card">
									<div class="card-body">
										<form class="form" role="form" action="<?php echo base_url().'Oreline/Import/ImportOreline' ?>" method="post" enctype="multipart/form-data">
                 
                      <div class="col-md-4 col-lg-4 col-xl-4">
                        <div class="form-group floating-label">
  												<select id="select2" name="Pit" class="form-control" required="">
  													<option value="">&nbsp;</option>
                            <?php foreach ($Pit as $pit): ?>
                              <option value="<?php echo $pit->id ?>"><?php echo $pit->Nama ?></option>
                            <?php endforeach; ?>
  												</select>
  												<label for="select2">Select Pit</label>
						            </div>
                      </div>
                <!--       <div class="col-md-1 col-lg-1 col-xl-1">

                      </div> -->
                      <div class="col-md-2 col-lg-2 col-xl-2">
                        <div class="form-group">
                          <input type="file" name="file" id="file" class="inputfile" required="" />
                        </div>
                      </div>
                      <div class="col-md-1 col-lg-1 col-xl-1">

                      </div>
                      <div class="col-md-1 col-lg-1 col-xl-1">
                        <div class="form-group">
                          <button type="submit" class="btn ink-reaction btn-raised btn-primary"><i class="md md-save"></i> Import</button>
                        </div>
                      </div>
                       <div class="col-md-2 col-lg-2 col-xl-2">

                      </div>

                      <br>


                      <div class="col-md-8 col-lg-8 col-xl-8">
                      
						    						<span class="bigger-110" style="color:blue;"><?php
						                                echo "".$msg;
						                            ?>
						                            	
						                            </span>
    											
    				  </div>
										</form>
									</div><!--end .card-body -->
								</div><!--end .card -->
							</div><!--end .col -->
						</div><!--end .row -->

						<div class="row">
							<div class="col-lg-12">
								<h4 class="text-info">*Make Sure that data oreline on row 17.</h4>
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

		<!-- FOOTLIB -->
		<?php $this->load->view('lib/Footlib'); ?>
		<!-- END JAVASCRIPT -->
		<!-- END FOOTLIB -->

	</body>
</html>
