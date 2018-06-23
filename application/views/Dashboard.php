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
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		<script type="text/javascript">
		google.charts.load('current', {'packages':['corechart']});
		google.charts.setOnLoadCallback(drawChart);
		function drawChart() {
		var data = google.visualization.arrayToDataTable([
		
		
		['Material', 'Percentage'],
		['<?php echo "Clay"?>', <?php echo $clay ?>],
		['<?php echo "Fresh"?>', <?php echo $fresh ?>],
		['<?php echo "Transisi"?>', <?php echo $transisi ?>],
		
		]);
		var options = {
		title: '',
		
		};
		var chart = new google.visualization.PieChart(document.getElementById('piechart'));
		chart.draw(data, options);
		}
		
		google.charts.load('current', {'packages':['corechart']});
		google.charts.setOnLoadCallback(drawVisualization);
		
		function drawVisualization() {
		var data = google.visualization.arrayToDataTable([
		
		
		['Stockpile', 'Tonnes',  {role: 'style'} ],
		<?php foreach ($ListStockpile as $ls): ?>
		
		<?php $date = date("Y-m-d") ?> 
		<?php $ToStockpileStatus = $this->Stockpile_model->GetStockpileByDateandStockpileReport($date,$ls->id); ?>

		<?php if($ToStockpileStatus !=null){ ?>
		<?php foreach ($ToStockpileStatus as $stockstatus) { ?>
		<?php $Stockpile = $ls->Nama; ?>
		<?php $Tonnes = round($stockstatus->Tonnes,2); ?>

		<?php

				$AuEq75 = $stockstatus->AuEq75;

				if(0.5 <= $AuEq75 && $AuEq75 < 0.65){
                    $Warna =  '#0000FF';
                }
                elseif (0.65 <= $AuEq75 && $AuEq75 < 2){
                    $Warna =  '#00FF00';
                }
                elseif (2 <= $AuEq75 && $AuEq75 < 4){
                    $Warna =  '#FF0000';
                }
                elseif ( 4 <= $AuEq75 && $AuEq75 < 6){
                    $Warna =  '#FF00FF';
                }
                elseif ( $AuEq75 > 6){
                    $Warna =  '#FF7F00';
                }
                else{
                	$Warna = '#F0F8FF';
                } 

		 ?>
		
		<?php } ?>
		['<?php echo $Stockpile ?>', <?php echo $Tonnes ?>, '<?php echo $Warna ?>'],
		
		<?php } else{ ?>
		<?php	$Stockpile = $ls->Nama; ?>
		<?php	$Tonnes = 0; ?>
		<?php	$Warna = ""; ?>
			['<?php echo $Stockpile ?>', <?php echo $Tonnes ?>, '<?php echo $Warna ?>'],
		<?php } ?>
		<?php endforeach; ?>
		
		]);
		
		var view = new google.visualization.DataView(data);
		view.setColumns([0, 1,
		{ calc: "stringify",
		sourceColumn: 1,
		type: "string",
		role: "annotation" },
		2]);
		var options = {
		title: "",
		width: 1200,
		height: 375,
		bar: {groupWidth: "95%"},
		legend: { position: "none" },
		};
		var chart = new google.visualization.ColumnChart(document.getElementById('StockStatusChart'));
		chart.draw(view, options);
		}
		</script>
		<!-- BEGIN BASE-->
		<div id="base">
			<!-- BEGIN OFFCANVAS LEFT -->
			<div class="offcanvas">
				</div><!--end .offcanvas-->
				<!-- END OFFCANVAS LEFT -->
				<!-- BEGIN CONTENT-->
				<div id="content">
					<section>
						<div class="section-body">
							<div class="row">
								<!-- BEGIN ALERT - REVENUE -->
								<div class="col-md-3 col-sm-6">
									<div class="card">
										<div class="card-body no-padding">
											<div class="alert alert-callout alert-info no-margin">
												
												<strong class="text-xl"><?php echo $openingstock ?></strong><br/>
												<span class="opacity-50"><strong class="text-lg">Opening Stock</strong></span>
												<div class="stick-bottom-left-right">
													<div class="height-2 sparkline-revenue" data-line-color="#bdc1c1"></div>
												</div>
											</div>
											</div><!--end .card-body -->
											</div><!--end .card -->
											</div><!--end .col -->
											<!-- END ALERT - REVENUE -->
											<!-- BEGIN ALERT - VISITS -->
											<div class="col-md-3 col-sm-6">
												<div class="card">
													<div class="card-body no-padding">
														<div class="alert alert-callout alert-warning no-margin">
															
															<strong class="text-xl"><?php echo $closingstock ?></strong><br/>
															<span class="opacity-50"><strong class="text-lg">Closing Stock</strong></span>
															<div class="stick-bottom-right">
																<div class="height-1 sparkline-visits" data-bar-color="#e5e6e6"></div>
															</div>
														</div>
														</div><!--end .card-body -->
														</div><!--end .card -->
														</div><!--end .col -->
														<!-- END ALERT - VISITS -->
														<!-- BEGIN ALERT - BOUNCE RATES -->
														<div class="col-md-3 col-sm-6">
															<div class="card">
																<div class="card-body no-padding">
																	<div class="alert alert-callout alert-danger no-margin">
																		
																		<strong class="text-xl"><?php echo $totalmined ?></strong><br/>
																		<span class="opacity-50"><strong class="text-lg">Total Ore Mined</strong></span>
																		<div class="stick-bottom-left-right">
																			
																		</div>
																	</div>
																	</div><!--end .card-body -->
																	</div><!--end .card -->
																	</div><!--end .col -->
																	<!-- END ALERT - BOUNCE RATES -->
																	<!-- BEGIN ALERT - TIME ON SITE -->
																	<div class="col-md-3 col-sm-6">
																		<div class="card">
																			<div class="card-body no-padding">
																				<div class="alert alert-callout alert-success no-margin">
																					
																					<strong class="text-xl"><?php echo $feedtocrush ?></strong><br/>
																					<span class="opacity-50"><strong class="text-lg">Ore Feed to Crusher</strong></span>
																				</div>
																				</div><!--end .card-body -->
																				</div><!--end .card -->
																				</div><!--end .col -->
																				<!-- END ALERT - TIME ON SITE -->
							</div><!--end .row -->

						<div class="row">
  							<div class="col-lg-3">
  								<h2 class="text-primary">Feed Material (%)</h2>
  							</div><!--end .col -->
  							<div class="col-lg-6">
  								<h2 class="text-primary">Stockpile Status</h2>
  							</div><!--end .col -->
  						</div><!--end .row -->

																	<div class="row">
																					
															
																			<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
																				<div class="widget-box transparent">
																					
																					<div class="widget-body">
																						<div class="widget-main" style="">
																							<div id="piechart" style="width: 375px; height: 375px;">
																							</div>
																						</div>
																					</div>
																				</div>
																			</div>

																			<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
																				<div class="widget-box transparent">
																					
																					<div class="widget-body">
																						<div class="widget-main" style="">
																							<div id="StockStatusChart" style="width: 50px; height: 0px;">
																							</div>
																						</div>
																					</div>
																				</div>
																			</div>

																		
																	
																			<!-- END SERVER STATUS -->
																	</div><!--end .row -->
																			<div class="row">
																				
																				</div><!--end .row -->
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
																			<?php $this->load->view('lib/Footlib') ?>
																			<!-- END FOOTLIB -->
																		</body>
																	</html>