<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<link rel="shortcut icon" href="<?php echo base_url() ?>assets/user/images/pbb.png">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="pendataan">

	<meta name="author" content="Themefisher.com">

	<title>Warga Berseri</title>

	<?php $this->load->view('user/layouts/link'); ?>

</head>

<body>
	<!-- Section Menu Start -->
	<!-- Header Start -->
	<nav class="navbar navbar-expand-lg navigation fixed-top" id="navbar">
		<div class="container-fluid">
			<a class="navbar-brand" href="<?php echo base_url('user') ?>">
				<h2 class="text-white text-capitalize"></i>Warga
					<span class="text-color"> Berseri</span>
				</h2>
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsid" aria-controls="navbarsid" aria-expanded="false" aria-label="Toggle navigation">
				<span class="ti-view-list"></span>
			</button>
			<div class="collapse text-center navbar-collapse" id="navbarsid">
				<ul class="navbar-nav mx-auto">
					<li class="nav-item active">
						<a class="nav-link" href="<?php echo base_url('user') ?>">Beranda<span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Iuran</a>
						<ul class="dropdown-menu">
							<li>
								<a class="dropdown-item" href="<?php echo base_url(); ?>user/iuran">Data Iuran</a>
							</li>
							<li>
								<a class="dropdown-item" href="<?php echo base_url(); ?>user/iuran/riwayat_iuran">Riwayat Pembayaran Iuran</a>
							</li>
							<li>
								<a class="dropdown-item" href="<?php echo base_url(); ?>user/iuran/data_penggunaan">Info Keuangan</a>
							</li>
						</ul>
					</li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url('user/aspirasi') ?>">Keluhan & Aspirasi</a></li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Struktur Organisasi</a>
						<ul class="dropdown-menu">
							<li><a class="dropdown-item" href="<?php echo base_url('user/dashboard/strukturOrganisasiRW') ?>">Struktur Organisasi RW</a></li>
							<li><a class="dropdown-item" href="<?php echo base_url('user/dashboard/strukturOrganisasi') ?>">Struktur Organisasi RT</a></li>
							<li><a class="dropdown-item" href="<?php echo base_url('user/dashboard/strukturOrganisasiKeamanan') ?>">Struktur Organisasi Keamanan</a></li>
						</ul>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Surat</a>
						<ul class="dropdown-menu">
							<li>
								<a class="dropdown-item" href="<?php echo base_url(); ?>user/surat">Pengajuan Surat</a>
							</li>
							<li>
								<a class="dropdown-item" href="<?php echo base_url(); ?>user/surat/template_surat">Penyediaan Surat</a>
							</li>
						</ul>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?php echo base_url('user/warga') ?>">Pendataan Warga</a>
					</li>
					<?php if (!$this->session->id_warga) : ?>
						<li class="nav-item">
							<a class="nav-link" href="<?php echo base_url('user/auth/') ?>">Login</a>
						</li>
					<?php endif; ?>
					<?php if ($this->session->id_warga) : ?>
						<li class="nav-item text-white">Hallo <?= $this->session->nama_warga; ?> |
							<a class="nav-link" href="<?php echo base_url('user/auth/logout') ?>">Logout</a>
						</li>
					<?php endif; ?>
				</ul>
			</div>
		</div>
	</nav>
	<!-- Header Close -->
