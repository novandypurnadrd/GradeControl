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
						<div class="section-body">
							<div class="row">
								<div class="col-xs-12">
									<!-- PAGE CONTENT BEGINS -->
									<div>
										<!-- <div id="user-profile-1" class="user-profile row">
												<div class="col-xs-12 col-sm-3 center">
														<div>
																<span class="profile-picture">
														<img id="avatar" class="editable img-responsive" alt="Alex's Avatar" src="<?php echo base_url();?>assets/images/avatars/user.png" />
													</span>
													<!-- <div class="space-4"></div> -->
													<!-- <div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
															<div class="inline position-relative">
																		<i class="ace-icon fa fa-circle light-green"></i>
																		&nbsp;
															<span class="white"><?php //echo $this->session->userdata('nameGradeControl');?></span>
														</div>
													</div>
												</div>
												<div class="space-6"></div>
												<div class="hr hr16 dotted"></div>
											</div>
										</div> -->
										
										
										<div class="col-xs-12 col-sm-9">
											<div class="card">
												<div class="card-heard text-lg text-bold text-primary">
												<header align="center">Profile User</header>
											</div>
											<!-- end card head -->
											<div class="card-body height-9">
												<div class="row">
													<div class="col-sm-12 hidden-xs">
														<form class="form floating-label" method="post" action="<?php echo base_url().'Profile/UpdateProfile' ?>" enctype="multipart/form-data">
															<div class="form-group">
																<input type="text" autocomplete="off" class="form-control" id="username" name="username" readonly autocomplete="off" value="<?php echo $this->session->userdata('usernameGradeControl') ?>">
																<label for="username">Username</label>
															</div>
															<div class="form-group">
																<input type="password" class="form-control" id="password" required name="password">
																<label for="password">New Password</label>
															</div>
															<div class="form-group">
																<input type="text" autocomplete="off" class="form-control" id="role" name="role" readonly autocomplete="off" value="<?php echo $this->session->userdata('GradeControl') ?>">
																<label for="username">Role</label>
															</div>
															<br/>
															
															<div class="profile-info-row" style="text-align:center;">
																<div class="profile-info-name"></div>
																<div class="profile-info-value">
																	<button type="submit" class="btn btn-white btn-info btn-bold">
																	<i class="ace-icon fa fa-floppy-o bigger-120 blue"></i>
																	Update
																	</button>
																	<button type="reset" class="btn btn-white btn-warning btn-bold">
																	<i class="ace-icon fa fa-refresh bigger-120 orange"></i>
																	Reset
																	</button>
																</div>
															</div> <br/>
															<?php echo $this->session->flashdata('message');?>
														</form>
														</div><!--end .col -->
													</div>
												</div>
											</div>
										</div>
										<!-- PAGE UPLOAD FOTO BEGINS -->
										<div class="col-xs-12 col-sm-3">
											<div class="card">
												<!-- begin end head -->
												<div class="card-heard text-lg text-bold text-primary">
												<header align="center">Upload Foto</header>
											</div>
											<!-- end card head -->
											<div class="card-body no-padding height-9">
												<div class="row">
													<div class="col-sm-12 hidden-xs">
														<form action="<?php echo base_url().'Profile/InsertImage' ?>" method="post" enctype="multipart/form-data">
															<table class="table table-striped">
																<tr>
																	<td style="width:15%;">File Foto</td>
																	<td>
																		<div class="col-sm-12">
																			<input type="file" name="filefoto" class="form-control">
																		</div>
																	</td>
																</tr>
																
																<tr>
																	<td colspan="2">
																		
																		<div class="profile-info-row" style="text-align:center;">
																			<div class="profile-info-name"></div>
																			<div class="profile-info-value">
																				<button type="submit" class="btn btn-white btn-success btn-bold">
																				<i class="ace-icon fa fa-floppy-o bigger-120 blue"></i>
																				Upload
																				</button>
																				<button type="reset" class="btn btn-white btn-warning btn-bold">
																				<i class="ace-icon fa fa-refresh bigger-120 orange"></i>
																				Cancel
																				</button>
																			</div>
																		</div>
																	</td>
																</tr>
															</table>
														</form>
													</div>	<?php echo $this->session->flashdata('pesan');?>
												</div>
												<!-- UPLOAD FOTO ENDS -->
											</div>
											<!-- PAGE CONTENT ENDS -->
											</div><!-- /.col -->
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
										<script>
										function myFunction() {
										var button = document.getElementById("submit");
										var x = document.getElementById("password");
										if (x.value == "<?php echo $this->session->userdata('passwordCSR') ?>") {
										submit.disabled = false;
										}
										else {
										submit.disabled = true;
										}
										}
										</script>
									</body>
								</html>