<style>
	body {

		background: #f5f6fa;
	}

	.dropify-message {
		text-align: center;
		font-size: 2px;
		visibility: hidden;
	}

	.account-settings .user-profile {
		margin: 0 0 1rem 0;
		padding-bottom: 1rem;
		text-align: center;
	}

	.account-settings .user-profile .user-avatar {
		margin: 0 0 1rem 0;
	}

	.account-settings .user-profile .user-avatar img {
		width: 90px;
		height: 90px;
		-webkit-border-radius: 100px;
		-moz-border-radius: 100px;
		border-radius: 100px;
	}

	.account-settings .user-profile h5.user-name {
		margin: 0 0 0.5rem 0;
	}

	.account-settings .user-profile h6.user-email {
		margin: 0;
		font-size: 15px;
		font-weight: 400;
		color: #9fa8b9;
	}

	.account-settings .about {
		margin: 2rem 0 0 0;
		text-align: center;
	}

	.account-settings .about h5 {
		margin: 0 0 15px 0;
		color: #007ae1;
	}

	.account-settings .about p {
		font-size: 0.825rem;
	}

	.card {
		background: #ffffff;
		-webkit-border-radius: 5px;
		-moz-border-radius: 5px;
		border-radius: 5px;
		border: 0;
		margin-bottom: 1rem;
	}
</style>

<div class="main-wrapper">
	<section class="page-title bg-2">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 text-center">
					<ul class="list-inline mb-0">
						<li class="list-inline-item"><a href="index.html" class="text-sm letter-spacing text-white text-uppercase font-weight-bold">Home</a></li>
						<li class="list-inline-item"><span class="text-white">|</span></li>
						<li class="list-inline-item"><a href="#" class="text-color text-uppercase text-sm letter-spacing">Info Hunian</a></li>
					</ul>
					<h1 class="text-lg text-white mt-2">Info Hunian</h1>
				</div>
			</div>
		</div>
	</section>
	<div class="col mt-5">
		<div class="row justify-content-center">
			<div class="col-12 col-md-8 mb-3">
				<div class="card">
					<div class="card-body">
						<div class="e-profile">
							<div class="row">
								<div class="col-12 col-sm-auto mb-3">
									<div class="mx-auto" style="width: 140px;">
										<div class="d-flex justify-content-center align-items-center rounded" style="height: 140px; background-color: rgb(233, 236, 239);">
											<?php if ($hunian->foto_profile == NULL || $hunian->foto_profile == '') { ?>
												<span style="color: rgb(166, 168, 170); font: bold 8pt Arial;">140x140</span>
											<?php } else { ?>
												<img src="<?= base_url('uploads/profile/' . $hunian->foto_profile) ?>" class="img-fluid rounded" alt="">
											<?php	} ?>
										</div>
									</div>
								</div>
								<div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
									<div class="text-center text-sm-left mb-2 mb-sm-0">
										<h4 class="pt-sm-2 pb-1 mb-0 text-nowrap"><?= $hunian->nama_warga ?></h4>
										<p class="mb-0"><?= $hunian->no_hp ?></p>
										<div class="text-muted"><small>Anggota Hunian</small></div>
									</div>
								</div>
							</div>
							<ul class="nav nav-tabs">
								<li class="nav-item"><a href="javascript:void(0)" class="active nav-link">Info Hunian</a></li>
							</ul>
							<div class="tab-content pt-3">
								<div class="tab-pane active">
									<form class="form" enctype="multipart/form-data" action="<?= base_url('user/warga/proses_update_anggota_warga') ?>" method="POST">
										<div class="row">
											<div class="col">
												<h6 class="mb-2 text-primary">Data Personal</h6>
												<div class="row">
													<div class="col">
														<div class="form-group">
															<label>Nama Lengkap</label>
															<input disabled type="text" class="form-control" name="nama_warga" value="<?php echo $hunian->nama_warga ?>">
														</div>
													</div>
													<div class="col">
														<div class="form-group">
															<label>Nomor Induk Kependudukan</label>
															<input disabled type="number" class="form-control" name="nik" value="<?php echo $hunian->nik ?>">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col">
														<div class="form-group">
															<label for="firstname">Tempat Lahir</label>
															<input disabled type="text" class="form-control" name="tempat_lahir" value="<?php echo $hunian->tempat_lahir ?>">
														</div>
													</div>
													<div class="col">
														<div class="form-group">
															<label for="firstname">Tanggal Lahir</label>
															<div class="input-group date">
																<input disabled type="date" class="form-control" name="tanggal_lahir" value="<?php echo $hunian->tanggal_lahir ?>">
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col">
														<div class="form-group">
															<label for="firstname">No Handphone</label>
															<input disabled type="number" class="form-control" name="no_hp" value="<?php echo $hunian->no_hp ?>">
														</div>
													</div>
													<div class="col">
														<div class="form-group">
															<label for="firstname">Agama</label>
															<input disabled type="text" class="form-control" name="nama_warga" value="<?php echo  $hunian->agama ?>">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col">
														<div class="form-group">
															<label for="firstname">Jenis Kelamin</label>
															<input disabled type="text" class="form-control" name="nama_warga" value="<?php echo $hunian->jenis_kelamin ?>">
														</div>
													</div>
													<div class="col">
														<div class="form-group">
															<label for="firstname">Status Perkawinan</label>
															<input disabled type="text" class="form-control" name="nama_warga" value="<?php echo $hunian->status_perkawinan ?>">
														</div>
													</div>
												</div>
												<h6 class="mb-2 text-primary">Hubungan Keluarga</h6>
												<div class="row">
													<div class="col">
														<div class="form-group">
															<label for="firstname">Sebagai</label>
															<input disabled type="text" class="form-control" name="nama_warga" value="<?php echo $hunian->hubungan_keluarga ?>">
														</div>
													</div>
													<div class="col">
														<div class="form-group">
															<label for="firstname">Status Hunian</label>
															<input disabled type="text" class="form-control" name="nama_warga" value="<?php echo $hunian->status_hunian ?>">
														</div>
													</div>
												</div>
												<h6 class="mb-2 text-primary">Info Pekerjaan</h6>
												<div class="row">
													<div class="col">
														<div class="form-group">
															<label for="companyname">Pendidikan</label>
															<input disabled type="text" class="form-control" name="nama_warga" value="<?php echo $hunian->pendidikan ?>">
														</div>
													</div>
													<div class="col">
														<div class="form-group">
															<label for="cwebsite">Pekerjaan</label>
															<input disabled type="text" class="form-control" name="nama_warga" value="<?php echo $hunian->pekerjaan ?>">
														</div>
													</div>
												</div>
												<h6 class="mb-2 text-primary">Foto KTP atau Foto Akta Kelahiran</h6>
												<div class="row">
													<?php if ($hunian->file_ktp != NULL || $hunian->file_ktp != '') { ?>
														<div class="col-6">
															<div class="form-group">
																<label for="firstname">Foto Identitas Terkini</label>
																<input type="file" disabled class="dropify" data-default-file="<?= base_url('uploads/ktp/' . $hunian->file_ktp) ?>">
															</div>
														</div>
													<?php	} ?>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
