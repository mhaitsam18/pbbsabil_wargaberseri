<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<title>Admin Warga Berseri</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
	<meta content="Coderthemes" name="author" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />

	<?php $this->load->view('admin/layouts/link'); ?>

</head>

<body>

	<!-- Begin page -->
	<div id="wrapper">

		<!-- Topbar Start -->
		<div class="navbar-custom">
			<ul class="list-unstyled topnav-menu float-right mb-0">

				<li class="dropdown notification-list">
					<a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
						<img src="<?php echo base_url() ?>assets/admin/images/users/default.jpg" alt="user-image" class="rounded-circle">
						<span class="pro-user-name ml-1">
							<?php echo $this->session->email ?> <i class="mdi mdi-chevron-down"></i>
						</span>
					</a>
					<div class="dropdown-menu dropdown-menu-right profile-dropdown ">
						<!-- item-->
						<div class="dropdown-header noti-title">
							<h6 class="text-overflow m-0" style="font-size: 15px;">Selamat Datang !</h6>
						</div>

						<!-- item-->
						<a href="<?php echo base_url('admin/user') ?>" class="dropdown-item notify-item">
							<i class="fe-user"></i>
							<span>Akun Saya</span>
						</a>

						<div class="dropdown-divider"></div>

						<!-- item-->
						<a href="<?php echo base_url('admin/auth/logout') ?>" class="dropdown-item notify-item">
							<i class="fe-log-out"></i>
							<span>Logout</span>
						</a>

					</div>
				</li>


			</ul>

			<!-- LOGO -->
			<div class="logo-box">
				<a href="<?= base_url('admin/dashboard') ?>" class="logo text-center">
					<span class="logo-lg">
						<img src="<?php echo base_url() ?>assets/admin/images/pbb-logo.png" alt="" height="35">
					</span>
					<span class="logo-sm">
						<img src="<?php echo base_url() ?>assets/admin/images/pbb-logo.png" alt="" height="24">
					</span>
				</a>
			</div>

			<ul class="list-unstyled topnav-menu topnav-menu-left m-0">
				<li>
					<button class="button-menu-mobile waves-effect waves-light">
						<i class="fe-menu"></i>
					</button>
				</li>
			</ul>
		</div>
		<!-- end Topbar -->
		<?php $this->load->view('admin/layouts/sidebar'); ?>
