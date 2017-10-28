<!DOCTYPE html>
<html lang="en">
	<head>
		<?php $this->load->view('lib/Headlib'); ?>
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
						<?php
							$totalbidang = 0;
						?>
						['Bidang', 'Total Cost'],
					<?php foreach ($Category as $category): ?>
						<?php $valuebidang = 0; ?>
								<?php foreach ($AdditionalCost as $additionalcost): ?>
									<?php if ($additionalcost->category == $category->id): ?>
										<?php $valuebidang = $valuebidang + $additionalcost->total?>
									<?php endif; ?>
								<?php endforeach; ?>
								<?php foreach ($BackCharge as $backcharge): ?>
									<?php if ($backcharge->category == $category->id): ?>
										<?php $valuebidang = $valuebidang + $backcharge->total?>
									<?php endif; ?>
								<?php endforeach; ?>
								<?php foreach ($PengambilanBarang as $penambilanbarang): ?>
									<?php if ($penambilanbarang->category == $category->id): ?>
										<?php $valuebidang = $valuebidang + $penambilanbarang->total?>
									<?php endif; ?>
								<?php endforeach; ?>
								<?php foreach ($MealBox as $mealbox): ?>
									<?php if ($mealbox->category == $category->id): ?>
										<?php $valuebidang = $valuebidang + $mealbox->total?>
									<?php endif; ?>
								<?php endforeach; ?>
								<?php foreach ($WorkOrder as $workorder): ?>
									<?php if ($workorder->category == $category->id): ?>
										<?php $valuebidang = $valuebidang + $workorder->total?>
									<?php endif; ?>
								<?php endforeach; ?>
								<?php foreach ($ITRequest as $itrequest): ?>
									<?php if ($itrequest->category == $category->id): ?>
										<?php $valuebidang = $valuebidang + $itrequest->total?>
									<?php endif; ?>
								<?php endforeach; ?>
								<?php foreach ($PermohonanDana as $permohonandana): ?>
									<?php if ($permohonandana->category == $category->id): ?>
										<?php $valuebidang = $valuebidang + $permohonandana->total?>
									<?php endif; ?>
								<?php endforeach; ?>
						<?php $totalbidang = $totalbidang + $valuebidang ?>
						['<?php echo $category->category?> (<?php echo "Rp.". number_format($totalbidang, "2", ",",".").", -" ?>)', <?php echo $totalbidang ?>],
					<?php endforeach; ?>
        ]);

        var options = {
          title: '',
					is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
	</head>

	<body class="no-skin">
		<?php $this->load->view('lib/Header'); ?>

		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			<?php $this->load->view('lib/Navigation'); ?>

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="<?php echo base_url().'Dashboard' ;?>">Home</a>
							</li>
							<li class="active">Daily Activity</li>
						</ul><!-- /.breadcrumb -->

					</div>

					<div class="page-content">

						<div class="page-header">
							<h1>
								Rekap
							</h1>
						</div><!-- /.page-header -->

								<!-- PAGE CONTENT BEGINS -->
								<form class="form-horizontal" method="post" action="<?php echo base_url().'Daily/Rekap/Filter'?>" enctype="multipart/form-data">
									</br>
									<div class="row">
										<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Start </label>
												<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
													<div class="input-group">
															<input class="form-control date-picker" name="start" required="on" value="<?php echo $start ?>" id="id-date-picker-1" type="text" data-date-format="yyyy-mm-dd" />
															<span class="input-group-addon">
																<i class="fa fa-calendar bigger-110"></i>
															</span>
														</div>
												</div>
											</div>
										</div>

										<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Finish </label>
												<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
													<div class="input-group">
															<input class="form-control date-picker" name="finish" required="on" value="<?php echo $finish ?>" id="id-date-picker-1" type="text" data-date-format="yyyy-mm-dd" />
															<span class="input-group-addon">
																<i class="fa fa-calendar bigger-110"></i>
															</span>
														</div>
												</div>
											</div><!-- /.span -->
										</div>

										<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
											<button type="submit" id="submit" class="btn btn-sm btn-primary">
												<i class="ace-icon fa fa-filter"></i>
												Filter
											</button>
											<?php if ($export == 1): ?>
												<a target="_blank" href="<?php echo base_url().'Daily/Rekap/Export?start=' .$start.'&finish='.$finish?>" id="export" class="btn btn-sm btn-success">
													<i class="ace-icon fa fa-print"></i>
													Print
												</a>
											<?php endif; ?>
										</div>
									</div>
								</form>
								</br>
								<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
										<div class="widget-box transparent">
											<div class="widget-header">
												<h4 class="widget-title">Pie Chart Total Cost</h4>

												<div class="widget-toolbar">
													<a href="#" data-action="collapse">
														<i class="ace-icon fa fa-chevron-up"></i>
													</a>
												</div>
											</div>

											<div class="widget-body">
												<div class="widget-main" style="overflow:auto;direction:rtl;">
													<div id="piechart" style="width: 1400px; height: 500px;"></div>
												</div>
											</div>
										</div>
									</div>
								</div>
								</br>
								<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
										<div class="widget-box transparent">
											<div class="widget-header">
												<h4 class="widget-title">Total Cost Table</h4>

												<div class="widget-toolbar">
													<a href="#" data-action="collapse">
														<i class="ace-icon fa fa-chevron-up"></i>
													</a>
												</div>
											</div>

											<div class="widget-body">
												<div class="widget-main">
													<table id="dynamic-table" class="table  table-bordered table-hover">
														<thead>
															<tr>
																<th>Bidang</th>
																<th>Sub Bidang</th>
																<th>Sub-sub Bidang</th>
																<th>Cost</th>
															</tr>
														</thead>

														<tbody>
															<?php
																$totalbidang = 0;
															?>
															<?php foreach ($Category as $category): ?>
																<?php $valuebidang = 0; ?>
																<tr>
																	<tr>
																		<td>
																			<?php echo $category->category; ?>
																		</td>
																		<td></td>
																		<td></td>
																		<td style="background-color:yellow ;text-align:right;"">
																			<?php foreach ($AdditionalCost as $additionalcost): ?>
																				<?php if ($additionalcost->category == $category->id): ?>
																					<?php $valuebidang = $valuebidang + $additionalcost->total?>
																				<?php endif; ?>
																			<?php endforeach; ?>
																			<?php foreach ($BackCharge as $backcharge): ?>
																				<?php if ($backcharge->category == $category->id): ?>
																					<?php $valuebidang = $valuebidang + $backcharge->total?>
																				<?php endif; ?>
																			<?php endforeach; ?>
																			<?php foreach ($PengambilanBarang as $penambilanbarang): ?>
																				<?php if ($penambilanbarang->category == $category->id): ?>
																					<?php $valuebidang = $valuebidang + $penambilanbarang->total?>
																				<?php endif; ?>
																			<?php endforeach; ?>
																			<?php foreach ($MealBox as $mealbox): ?>
																				<?php if ($mealbox->category == $category->id): ?>
																					<?php $valuebidang = $valuebidang + $mealbox->total?>
																				<?php endif; ?>
																			<?php endforeach; ?>
																			<?php foreach ($WorkOrder as $workorder): ?>
																				<?php if ($workorder->category == $category->id): ?>
																					<?php $valuebidang = $valuebidang + $workorder->total?>
																				<?php endif; ?>
																			<?php endforeach; ?>
																			<?php foreach ($ITRequest as $itrequest): ?>
																				<?php if ($itrequest->category == $category->id): ?>
																					<?php $valuebidang = $valuebidang + $itrequest->total?>
																				<?php endif; ?>
																			<?php endforeach; ?>
																			<?php foreach ($PermohonanDana as $permohonandana): ?>
																				<?php if ($permohonandana->category == $category->id): ?>
																					<?php $valuebidang = $valuebidang + $permohonandana->total?>
																				<?php endif; ?>
																			<?php endforeach; ?>
																			<?php echo "Rp.". number_format($valuebidang, "2", ",",".").", -"  ?>
																		</td>
																	</tr>
																</tr>
																<?php $totalbidang = $totalbidang + $valuebidang ?>
																<?php foreach ($SubCategory as $subcategory): ?>
																	<?php $valuesubbidang = 0; ?>
																	<?php if ($subcategory->category == $category->id): ?>
																	<tr>
																		<td></td>
																		<td>
																			<?php echo $subcategory->subcategory; ?>
																		</td>
																		<td>
																		</td>
																		<td style="text-align:right;">
																			<?php foreach ($SubAdditionalCost as $additionalcost): ?>
																				<?php if ($additionalcost->subcategory == $subcategory->id): ?>
																					<?php $valuesubbidang = $valuesubbidang + $additionalcost->total?>
																				<?php endif; ?>
																			<?php endforeach; ?>
																			<?php foreach ($SubBackCharge as $backcharge): ?>
																				<?php if ($backcharge->subcategory == $subcategory->id): ?>
																					<?php $valuesubbidang = $valuesubbidang + $backcharge->total?>
																				<?php endif; ?>
																			<?php endforeach; ?>
																			<?php foreach ($SubPengambilanBarang as $penambilanbarang): ?>
																				<?php if ($penambilanbarang->subcategory == $subcategory->id): ?>
																					<?php $valuesubbidang = $valuesubbidang + $penambilanbarang->total?>
																				<?php endif; ?>
																			<?php endforeach; ?>
																			<?php foreach ($SubMealBox as $mealbox): ?>
																				<?php if ($mealbox->subcategory == $subcategory->id): ?>
																					<?php $valuesubbidang = $valuesubbidang + $mealbox->total?>
																				<?php endif; ?>
																			<?php endforeach; ?>
																			<?php foreach ($SubWorkOrder as $workorder): ?>
																				<?php if ($workorder->subcategory == $subcategory->id): ?>
																					<?php $valuesubbidang = $valuesubbidang + $workorder->total?>
																				<?php endif; ?>
																			<?php endforeach; ?>
																			<?php foreach ($SubITRequest as $itrequest): ?>
																				<?php if ($itrequest->subcategory == $subcategory->id): ?>
																					<?php $valuebidang = $valuebidang + $itrequest->total?>
																				<?php endif; ?>
																			<?php endforeach; ?>
																			<?php foreach ($SubPermohonanDana as $permohonandana): ?>
																				<?php if ($permohonandana->subcategory == $subcategory->id): ?>
																					<?php $valuebidang = $valuebidang + $permohonandana->total?>
																				<?php endif; ?>
																			<?php endforeach; ?>
																			<?php echo "Rp.". number_format($valuesubbidang, "2", ",",".").", -" ?>
																		</td>
																	</tr>
																	<?php endif; ?>
																		<?php
																			$totalsubsubbidang = 0;
																		?>
																		<?php foreach ($SubSubCategory as $subsubcategory): ?>
																			<?php $valuesubsubbidang = 0; ?>
																			<?php if ($subsubcategory->subcategory == $subcategory->id && $subsubcategory->category == $category->id): ?>
																				<tr>
																				<td></td>
																				<td></td>
																				<td>
																						<?php echo $subsubcategory->subsubcategory ?>
																				</td>
																				<td style="text-align:right;">
																					<?php foreach ($SubSubAdditionalCost as $additionalcost): ?>
																						<?php if ($additionalcost->subsubcategory == $subsubcategory->id): ?>
																							<?php $valuesubsubbidang = $valuesubsubbidang + $additionalcost->total?>
																						<?php endif; ?>
																					<?php endforeach; ?>
																					<?php foreach ($SubSubBackCharge as $backcharge): ?>
																						<?php if ($backcharge->subsubcategory == $subsubcategory->id): ?>
																							<?php $valuesubsubbidang = $valuesubsubbidang + $backcharge->total?>
																						<?php endif; ?>
																					<?php endforeach; ?>
																					<?php foreach ($SubSubPengambilanBarang as $penambilanbarang): ?>
																						<?php if ($penambilanbarang->subsubcategory == $subsubcategory->id): ?>
																							<?php $valuesubsubbidang = $valuesubsubbidang + $penambilanbarang->total?>
																						<?php endif; ?>
																					<?php endforeach; ?>
																					<?php foreach ($SubSubMealBox as $mealbox): ?>
																						<?php if ($mealbox->subsubcategory == $subsubcategory->id): ?>
																							<?php $valuesubsubbidang = $valuesubsubbidang + $mealbox->total?>
																						<?php endif; ?>
																					<?php endforeach; ?>
																					<?php foreach ($SubSubWorkOrder as $workorder): ?>
																						<?php if ($workorder->subsubcategory == $subsubcategory->id): ?>
																							<?php $valuesubsubbidang = $valuesubsubbidang + $workorder->total?>
																						<?php endif; ?>
																					<?php endforeach; ?>
																					<?php foreach ($SubSubITRequest as $itrequest): ?>
																						<?php if ($itrequest->subsubcategory == $subsubcategory->id): ?>
																							<?php $valuebidang = $valuebidang + $itrequest->total?>
																						<?php endif; ?>
																					<?php endforeach; ?>
																					<?php foreach ($SubSubPermohonanDana as $permohonandana): ?>
																						<?php if ($permohonandana->subsubcategory == $subsubcategory->id): ?>
																							<?php $valuebidang = $valuebidang + $permohonandana->total?>
																						<?php endif; ?>
																					<?php endforeach; ?>
																					<?php echo "Rp.". number_format($valuesubsubbidang, "2", ",",".").", -" ?>
																				</td>
																			</tr>
																			<?php endif; ?>
																			<?php $totalsubsubbidang = $totalsubsubbidang + $valuesubsubbidang ?>
																		<?php endforeach; ?>
																<?php endforeach; ?>
															<?php endforeach; ?>
																<tr style="text-align:center;">
																	<td colspan="3">Total Cost</td>
																	<td style="text-align:right;"><?php echo "Rp.". number_format($totalbidang, "2", ",",".").", -" ?></td>
																</tr>
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			<?php $this->load->view('lib/Footer'); ?>

		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<?php $this->load->view('lib/Footlib'); ?>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
				//datepicker plugin
				//link
				$('.date-picker').datepicker({
					autoclose: true,
					todayHighlight: true
				})

			});
		</script>
	</body>
</html>
