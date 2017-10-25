<!DOCTYPE html>
<html lang="en">
	<head>
		<?php $this->load->view('lib/Headlib'); ?>
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
								Daily Activity
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Purchase Request
                  <small>
  									<i class="ace-icon fa fa-angle-double-right"></i>
  									Table
  								</small>
								</small>
							</h1>
						</div><!-- /.page-header -->

              <!-- MAIN CONTENT BEGIN -->
								<form class="form-horizontal" method="post" action="<?php echo base_url().'Daily/PurchaseRequest/Table/Filter'?>" enctype="multipart/form-data">
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
										</div>
									</div>
								</form>
								<hr />

								<div class="row">
									<div class="col-xs-12">

										<div class="clearfix">
											<div class="pull-right tableTools-container"></div>
										</div>
										<div class="table-header">
											Table Data PurchaseRequest
										</div>

										<!-- div.table-responsive -->

										<!-- div.dataTables_borderWrap -->
										<div>
											<table id="dynamic-table" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th>
															<i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
															Date Mate
														</th>
														<th>No. PR</th>
														<th>Cost Code</th>
														<th>Item Code</th>
														<th>PR Pronto</th>
														<th>PR Manual</th>
														<th>No. PO</th>
														<th>Jenis Barang</th>
														<th>QTY</th>
														<th>UOM</th>
														<th>Bidang</th>
														<th>Sub Bidang</th>
														<th>Sub-sub Bidang</th>
														<th>Program</th>
														<th>Keterangan</th>
														<th>Status</th>
														<th>Date Complete</th>
														<th>Lampiran</th>
														<th>Action</th>
													</tr>
												</thead>

												<tbody>
													<?php foreach ($Table as $table): ?>
														<?php
															$date = $table->date;
															$date = date("d-M-Y", strtotime($date));
															$datecomplete = $table->datecomplete;
															if ($datecomplete != null) {
																$datecomplete = date("d-M-Y", strtotime($datecomplete));
															}
															else {
																$datecomplete = "";
															}

														 ?>
														<tr>
															<td><?php echo $date ?></td>
															<td><?php echo $table->no ?></td>
															<td><?php echo $table->costcode ?></td>
															<td><?php echo $table->itemcode ?></td>
															<?php
																if ($table->pr == "1") { ?>
																	<td><?php echo "O" ?></td>
																	<td></td>
																<?php }
																else { ?>
																	<td></td>
																	<td><?php echo "O" ?></td>
																<?php }
															 ?>
														  <td><?php echo $table->po ?></td>
															<td><?php echo $table->jenisbarang ?></td>
															<td><?php echo $table->qty ?></td>
															<td>
																<?php foreach ($UOM as $uom): ?>
																	<?php if ($uom->id == $table->uom): ?>
																		<?php echo $uom->description ?>
																	<?php endif; ?>
																<?php endforeach; ?>
															</td>
															<td>
																<?php foreach ($Category as $category): ?>
																	<?php if ($category->id == $table->category): ?>
																		<?php echo $category->category ?>
																	<?php endif; ?>
																<?php endforeach; ?>
															</td>
															<td>
																<?php foreach ($SubCategory as $subcategory): ?>
																	<?php if ($subcategory->id == $table->subcategory): ?>
																		<?php echo $subcategory->subcategory ?>
																	<?php endif; ?>
																<?php endforeach; ?>
															</td>
															<td>
																<?php foreach ($SubSubCategory as $subsubcategory): ?>
																	<?php if ($subsubcategory->id == $table->subsubcategory): ?>
																		<?php echo $subsubcategory->subsubcategory ?>
																	<?php endif; ?>
																<?php endforeach; ?>
															</td>
															<td>
																<?php foreach ($Program as $program): ?>
																	<?php if ($program->id == $table->program): ?>
																		<?php echo $program->program ?>
																	<?php endif; ?>
																<?php endforeach; ?>
															</td>
															<td><?php echo $table->keterangan ?></td>
															<td>
																<?php
																	if ($table->status == 1) {
																		echo "Completed";
																	}
																	else {
																		echo "Progress";
																	}
																?>
															</td>
															<td><?php echo $datecomplete ?></td>
															<td>
																<?php if($table->file != ""){ ?>
																	<a target="_blank" href="<?php echo base_url().$table->file ?>"><?php echo explode('/',$table->file)[3]; ?></a>
																<?php } ?>
                              </td>
															<td>
																<div class="hidden-sm hidden-xs action-buttons">
										              <?php if ($this->session->userdata('roleGradeControl') == "1"): ?>
																		<a class="green" href="<?php echo base_url().'Daily/PurchaseRequest/Update/pageUpdate/'.$table->id ?>">
																			<i class="ace-icon fa fa-pencil bigger-130"></i>
																		</a>

																		<a class="red" data-toggle="modal" data-target="#subsub<?php echo $table->id; ?>">
																			<i class="ace-icon fa fa-trash-o bigger-130"></i>
																		</a>
																	<?php endif; ?>
																</div>
															</td>
														</tr>

														<div class="modal fade" id="subsub<?php echo $table->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          												<div class="modal-dialog" role="document">
          													<div class="modal-content">
          														<div class="modal-body">
          															<h3>Are you sure? </h3>
          														</div>
          														<div class="modal-footer">
          															<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          															<a> <?php echo anchor('/Daily/PurchaseRequest/Table/DeletePurchaseRequest/'.$table->id,'<button type="button" class="btn btn-danger">Delete</button>') ?></a>
          														</div>
          													</div>
          												</div>
  				                      </div>
													<?php endforeach; ?>
												</tbody>
											</table>
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
		<script type="text/javascript">
			$("#subcategory").chained("#category");
      $("#subsubcategory").chained("#subcategory");
    </script>

		<script type="text/javascript">
			jQuery(function($) {
				//initiate dataTables plugin
				var myTable =
				$('#dynamic-table')
				//.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
				.DataTable( {
					bAutoWidth: false,
					"aoColumns": [
					  null,
					  null, null,null, null, null, null,null, null, null,null,null,null,null,null,null,null,null,
					  { "bSortable": false }
					],
					"aaSorting": [],


					//"bProcessing": true,
			        //"bServerSide": true,
			        //"sAjaxSource": "http://127.0.0.1/table.php"	,

					//,
					//"sScrollY": "200px",
					//"bPaginate": false,

					"sScrollX": "100%",
					"sScrollXInner": "100%",
					"bScrollCollapse": true,
					//Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
					//you may want to wrap the table inside a "div.dataTables_borderWrap" element

					//"iDisplayLength": 50


					select: {
						style: 'multi'
					}
			    } );



				$.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';

				new $.fn.dataTable.Buttons( myTable, {
					buttons: [
					  {
						"extend": "colvis",
						"text": "<i class='fa fa-search bigger-110 blue'></i> <span class='hidden'>Show/hide columns</span>",
						"className": "btn btn-white btn-primary btn-bold",
						columns: ':not(:first):not(:last)'
					  },
					  {
						"extend": "copy",
						"text": "<i class='fa fa-copy bigger-110 pink'></i> <span class='hidden'>Copy to clipboard</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "csv",
						"text": "<i class='fa fa-database bigger-110 orange'></i> <span class='hidden'>Export to CSV</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "print",
						"text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Print</span>",
						"className": "btn btn-white btn-primary btn-bold",
						autoPrint: false,
						message: 'This print was produced using the Print button for DataTables'
					  }
					]
				} );
				myTable.buttons().container().appendTo( $('.tableTools-container') );

				//style the message box
				var defaultCopyAction = myTable.button(1).action();
				myTable.button(1).action(function (e, dt, button, config) {
					defaultCopyAction(e, dt, button, config);
					$('.dt-button-info').addClass('gritter-item-wrapper gritter-info gritter-center white');
				});


				var defaultColvisAction = myTable.button(0).action();
				myTable.button(0).action(function (e, dt, button, config) {

					defaultColvisAction(e, dt, button, config);


					if($('.dt-button-collection > .dropdown-menu').length == 0) {
						$('.dt-button-collection')
						.wrapInner('<ul class="dropdown-menu dropdown-light dropdown-caret dropdown-caret" />')
						.find('a').attr('href', '#').wrap("<li />")
					}
					$('.dt-button-collection').appendTo('.tableTools-container .dt-buttons')
				});

				////

				setTimeout(function() {
					$($('.tableTools-container')).find('a.dt-button').each(function() {
						var div = $(this).find(' > div').first();
						if(div.length == 1) div.tooltip({container: 'body', title: div.parent().text()});
						else $(this).tooltip({container: 'body', title: $(this).text()});
					});
				}, 500);





				myTable.on( 'select', function ( e, dt, type, index ) {
					if ( type === 'row' ) {
						$( myTable.row( index ).node() ).find('input:checkbox').prop('checked', true);
					}
				} );
				myTable.on( 'deselect', function ( e, dt, type, index ) {
					if ( type === 'row' ) {
						$( myTable.row( index ).node() ).find('input:checkbox').prop('checked', false);
					}
				} );




				/////////////////////////////////
				//table checkboxes
				$('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);

				//select/deselect all rows according to table header checkbox
				$('#dynamic-table > thead > tr > th input[type=checkbox], #dynamic-table_wrapper input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header

					$('#dynamic-table').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) myTable.row(row).select();
						else  myTable.row(row).deselect();
					});
				});

				//select/deselect a row when the checkbox is checked/unchecked
				$('#dynamic-table').on('click', 'td input[type=checkbox]' , function(){
					var row = $(this).closest('tr').get(0);
					if(this.checked) myTable.row(row).deselect();
					else myTable.row(row).select();
				});



				$(document).on('click', '#dynamic-table .dropdown-toggle', function(e) {
					e.stopImmediatePropagation();
					e.stopPropagation();
					e.preventDefault();
				});



				//And for the first simple table, which doesn't have TableTools or dataTables
				//select/deselect all rows according to table header checkbox
				var active_class = 'active';
				$('#simple-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header

					$(this).closest('table').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
						else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
					});
				});

				//select/deselect a row when the checkbox is checked/unchecked
				$('#simple-table').on('click', 'td input[type=checkbox]' , function(){
					var $row = $(this).closest('tr');
					if($row.is('.detail-row ')) return;
					if(this.checked) $row.addClass(active_class);
					else $row.removeClass(active_class);
				});



				/********************************/
				//add tooltip for small view action buttons in dropdown menu
				$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});

				//tooltip placement on right or left
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('table')
					var off1 = $parent.offset();
					var w1 = $parent.width();

					var off2 = $source.offset();
					//var w2 = $source.width();

					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}




				/***************/
				$('.show-details-btn').on('click', function(e) {
					e.preventDefault();
					$(this).closest('tr').next().toggleClass('open');
					$(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
				});
				/***************/





				/**
				//add horizontal scrollbars to a simple table
				$('#simple-table').css({'width':'2000px', 'max-width': 'none'}).wrap('<div style="width: 1000px;" />').parent().ace_scroll(
				  {
					horizontal: true,
					styleClass: 'scroll-top scroll-dark scroll-visible',//show the scrollbars on top(default is bottom)
					size: 2000,
					mouseWheelLock: true
				  }
				).css('padding-top', '12px');
				*/


			})
		</script>

	</body>
</html>
