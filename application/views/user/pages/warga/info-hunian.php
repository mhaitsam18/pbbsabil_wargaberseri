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

<!-- Start Modal Update Profile -->
<div class="modal fade overflow-auto" id="updateProfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<?= form_open_multipart('user/warga/update_profile', array('method' => 'POST')) ?>
			<input type="hidden" name="id_detail_warga" value="<?= $hunian->id_detail_warga ?>">
			<input type="hidden" name="old_profile" value="<?= $hunian->foto_profile ?>">
			<div class="modal-header">
				<h5 class="modal-title">Update Foto Profile</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label>Foto Profile</label>
					<input type="file" name="foto_profile" id="foto_profile" class="form-control dropify" onchange="doAfterSelectProfile(this)">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" name="submit" class="btn btn-primary">Upload</button>
			</div>
		</div>
		<?= form_close() ?>
	</div>
</div>
<!-- End Modal Update Profile -->


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
					<h1 class="text-lg text-white mt-2">Sunting Hunian</h1>
				</div>
			</div>
		</div>
	</section>

	<div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
	<?php unset($_SESSION['flash']); ?>
	<div class="flash-profile" data-flashprofile="<?= $this->session->flashdata('profile'); ?>"></div>
	<?php unset($_SESSION['profile']); ?>


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
										<div class="mt-2">
											<button class="btn btn-primary" type="button" data-toggle="modal" data-target="#updateProfile">
												<i class="fa fa-fw fa-camera"></i>
												<span>Ganti Foto Profile</span>
											</button>
										</div>
									</div>
								</div>
							</div>
							<ul class="nav nav-tabs">
								<li class="nav-item"><a href="javascript:void(0)" class="active nav-link">Sunting Hunian</a></li>
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
															<input type="text" class="form-control" name="nama_warga" value="<?php echo $hunian->nama_warga ?>">
															<span class="form-text text-danger"><?= form_error('nama_warga'); ?></span>
														</div>
													</div>
													<div class="col">
														<div class="form-group">
															<label>Nomor Induk Kependudukan</label>
															<input type="number" class="form-control" name="nik" value="<?php echo $hunian->nik ?>">
															<span class="form-text text-danger"><?= form_error('nik'); ?></span>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col">
														<div class="form-group">
															<label for="firstname">Tempat Lahir</label>
															<input type="text" class="form-control" name="tempat_lahir" value="<?php echo $hunian->tempat_lahir ?>">
															<span class="form-text text-danger"><?= form_error('tempat_lahir'); ?></span>
														</div>
													</div>
													<div class="col">
														<div class="form-group">
															<label for="firstname">Tanggal Lahir</label>
															<div class="input-group date">
																<input type="date" class="form-control" name="tanggal_lahir" value="<?php echo $hunian->tanggal_lahir ?>">
																<span class="form-text text-danger"><?= form_error('tanggal_lahir'); ?></span>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col">
														<div class="form-group">
															<label for="firstname">No Handphone</label>
															<input type="number" class="form-control" name="no_hp" value="<?php echo $hunian->no_hp ?>">
															<span class="form-text text-danger"><?= form_error('no_hp'); ?></span>
														</div>
													</div>
													<div class="col">
														<div class="form-group">
															<label for="firstname">Agama</label>
															<input type="hidden" name="agama" value="<?php echo $hunian->agama ?>">
															<select class="form-control" name="agama">
																<?php if ($hunian->agama) { ?>
																	<option disabled selected><?php echo $hunian->agama ?></option>
																<?php } else { ?>
																	<option disabled selected>Agama</option>
																<?php } ?>
																<option value="Islam" <?php echo set_select('agama', 'Islam', (!empty($data) && $data == "Islam" ? TRUE : FALSE)); ?>>Islam</option>
																<option value="Kristen" <?php echo set_select('agama', 'Kristen', (!empty($data) && $data == "Kristen" ? TRUE : FALSE)); ?>>Kristen</option>
																<option value="Katolik" <?php echo set_select('agama', 'Katolik', (!empty($data) && $data == "Katolik" ? TRUE : FALSE)); ?>>Katolik</option>
																<option value="Hindu" <?php echo set_select('agama', 'Hindu', (!empty($data) && $data == "Hindu" ? TRUE : FALSE)); ?>>Hindu</option>
																<option value="Buddha" <?php echo set_select('agama', 'Buddha', (!empty($data) && $data == "Buddha" ? TRUE : FALSE)); ?>>Buddha</option>
																<option value="Konghucu" <?php echo set_select('agama', 'Konghucu', (!empty($data) && $data == "Konghucu" ? TRUE : FALSE)); ?>>Konghucu</option>
															</select>
															<span class="form-text text-danger"><?= form_error('agama'); ?></span>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col">
														<div class="form-group">
															<label for="firstname">Jenis Kelamin</label>
															<input type="hidden" name="jenis_kelamin" value="<?php echo $hunian->jenis_kelamin ?>">
															<select class="form-control" name="jenis_kelamin">
																<?php if ($hunian->jenis_kelamin) { ?>
																	<option disabled selected><?php echo $hunian->jenis_kelamin ?></option>
																<?php } else { ?>
																	<option disabled selected>Jenis Kelamin</option>
																<?php } ?>
																<option value="Laki-laki" <?php echo set_select('jenis_kelamin', 'Laki-laki', (!empty($data) && $data == "Laki-laki" ? TRUE : FALSE)); ?>>Laki-laki</option>
																<option value="Perempuan" <?php echo set_select('jenis_kelamin', 'Perempuan', (!empty($data) && $data == "Perempuan" ? TRUE : FALSE)); ?>>Perempuan</option>
															</select>
															<span class="form-text text-danger"><?= form_error('jenis_kelamin'); ?></span>
														</div>
													</div>
													<div class="col">
														<div class="form-group">
															<label for="firstname">Status Perkawinan</label>
															<input type="hidden" name="status_perkawinan" value="<?php echo $hunian->status_perkawinan ?>">
															<select class="form-control" name="status_perkawinan">
																<?php if ($hunian->status_perkawinan) { ?>
																	<option disabled selected><?php echo $hunian->status_perkawinan ?></option>
																<?php } else { ?>
																	<option disabled selected>Status Perkawinan</option>
																<?php } ?>
																<option value="Belum Kawin" <?php echo set_select('status_perkawinan', 'Belum Kawin', (!empty($data) && $data == "Belum Kawin" ? TRUE : FALSE)); ?>>Belum Kawin</option>
																<option value="Kawin" <?php echo set_select('status_perkawinan', 'Kawin', (!empty($data) && $data == "Kawin" ? TRUE : FALSE)); ?>>Kawin</option>
																<option value="Janda" <?php echo set_select('status_perkawinan', 'Janda', (!empty($data) && $data == "Janda" ? TRUE : FALSE)); ?>>Janda</option>
																<option value="Duda" <?php echo set_select('status_perkawinan', 'Duda', (!empty($data) && $data == "Duda" ? TRUE : FALSE)); ?>>Duda</option>
															</select>
															<span class="form-text text-danger"><?= form_error('status_perkawinan'); ?></span>
														</div>
													</div>
												</div>
												<h6 class="mb-2 text-primary">Hubungan Keluarga</h6>
												<div class="row">
													<div class="col">
														<div class="form-group">
															<label for="firstname">Sebagai</label>
															<input type="hidden" name="hubungan_keluarga" value="<?php echo $hunian->hubungan_keluarga ?>">
															<select class="form-control" name="hubungan_keluarga">
																<?php if ($hunian->hubungan_keluarga) { ?>
																	<option disabled selected><?php echo $hunian->hubungan_keluarga ?></option>
																<?php } else { ?>
																	<option disabled selected>Hubungan Keluarga</option>
																<?php } ?>
																<option value="Anak" <?php echo set_select('hubungan_keluarga', 'Anak', (!empty($data) && $data == "Anak" ? TRUE : FALSE)); ?>>Anak</option>
																<option value="Istri" <?php echo set_select('hubungan_keluarga', 'Istri', (!empty($data) && $data == "Istri" ? TRUE : FALSE)); ?>>Istri</option>
																<option value="Suami" <?php echo set_select('hubungan_keluarga', 'Suami', (!empty($data) && $data == "Suami" ? TRUE : FALSE)); ?>>Suami</option>
																<option value="Kerabat" <?php echo set_select('hubungan_keluarga', 'Kerabat', (!empty($data) && $data == "Kerabat" ? TRUE : FALSE)); ?>>Kerabat</option>
																<option value="Adik" <?php echo set_select('hubungan_keluarga', 'Adik', (!empty($data) && $data == "Adik" ? TRUE : FALSE)); ?>>Adik</option>
																<option value="Kaka" <?php echo set_select('hubungan_keluarga', 'Kaka', (!empty($data) && $data == "Kaka" ? TRUE : FALSE)); ?>>Kaka</option>
																<option value="Orang Tua" <?php echo set_select('hubungan_keluarga', 'Orang Tua', (!empty($data) && $data == "Orang Tua" ? TRUE : FALSE)); ?>>Orang Tua</option>
															</select>
															<span class="form-text text-danger"><?= form_error('hubungan_keluarga'); ?></span>
														</div>
													</div>
													<div class="col">
														<div class="form-group">
															<label for="firstname">Status Hunian</label>
															<input type="hidden" name="status_hunian" value="<?php echo $hunian->status_hunian ?>">
															<select class="form-control" name="status_hunian">
																<?php if ($hunian->status_hunian) { ?>
																	<option disabled selected><?php echo $hunian->status_hunian ?></option>
																<?php } else { ?>
																	<option disabled selected>Status hunian</option>
																<?php } ?>
																<option value="KTP lengkong tinggal di Lengkong" <?php echo set_select('status_hunian', 'KTP lengkong tinggal di Lengkong', (!empty($data) && $data == "KTP lengkong tinggal di Lengkong" ? TRUE : FALSE)); ?>>KTP lengkong tinggal di Lengkong</option>
																<option value="KTP luar tinggal di Lengkong" <?php echo set_select('status_hunian', 'KTP luar tinggal di Lengkong', (!empty($data) && $data == "KTP luar tinggal di Lengkong" ? TRUE : FALSE)); ?>>KTP luar tinggal di Lengkong</option>
																<option value="KTP lengkong tinggal di luar" <?php echo set_select('status_hunian', 'KTP lengkong tinggal di luar', (!empty($data) && $data == "KTP lengkong tinggal di luar" ? TRUE : FALSE)); ?>>KTP lengkong tinggal di luar</option>
															</select>
															<span class="form-text text-danger"><?= form_error('status_hunian'); ?></span>
														</div>
													</div>
												</div>
												<h6 class="mb-2 text-primary">Info Pekerjaan</h6>
												<div class="row">
													<div class="col">
														<div class="form-group">
															<label for="companyname">Pendidikan</label>
															<input type="hidden" name="pendidikan" value="<?php echo $hunian->pendidikan ?>">
															<select class="form-control" name="pendidikan">
																<?php if ($hunian->pendidikan) { ?>
																	<option disabled selected><?php echo $hunian->pendidikan ?></option>
																<?php } else { ?>
																	<option disabled selected>Pendidikan</option>
																<?php } ?>
																<option value="Belum Sekolah" <?php echo set_select('pendidikan', 'Belum Sekolah', (!empty($data) && $data == "Belum Sekolah" ? TRUE : FALSE)); ?>>Belum Sekolah</option>
																<option value="TK" <?php echo set_select('pendidikan', 'TK', (!empty($data) && $data == "TK" ? TRUE : FALSE)); ?>>TK</option>
																<option value="SD" <?php echo set_select('pendidikan', 'SD', (!empty($data) && $data == "SD" ? TRUE : FALSE)); ?>>SD</option>
																<option value="SMP" <?php echo set_select('pendidikan', 'SMP', (!empty($data) && $data == "SMP" ? TRUE : FALSE)); ?>>SMP</option>
																<option value="SMA" <?php echo set_select('pendidikan', 'SMA', (!empty($data) && $data == "SMA" ? TRUE : FALSE)); ?>>SMA</option>
																<option value="Diploma" <?php echo set_select('pendidikan', 'Diploma', (!empty($data) && $data == "Diploma" ? TRUE : FALSE)); ?>>Diploma</option>
																<option value="S1" <?php echo set_select('pendidikan', 'S1', (!empty($data) && $data == "S1" ? TRUE : FALSE)); ?>>S1</option>
																<option value="S2" <?php echo set_select('pendidikan', 'S2', (!empty($data) && $data == "S2" ? TRUE : FALSE)); ?>>S2</option>
																<option value="S3" <?php echo set_select('pendidikan', 'S3', (!empty($data) && $data == "S3" ? TRUE : FALSE)); ?>>S3</option>
															</select>
															<span class="form-text text-danger"><?= form_error('pendidikan'); ?></span>
														</div>
													</div>
													<div class="col">
														<div class="form-group">
															<label for="cwebsite">Pekerjaan</label>
															<input type="hidden" name="pekerjaan" value="<?php echo $hunian->pekerjaan ?>">
															<select class="form-control" id="pekerjaan" name="pekerjaan">
																<?php if ($hunian->pekerjaan) { ?>
																	<option disabled selected><?php echo $hunian->pekerjaan ?></option>
																<?php } else { ?>
																	<option disabled selected>Pekerjaan</option>
																<?php } ?>
																<option value="Wiraswasta" <?php echo set_select('pekerjaan', 'Wiraswasta', (!empty($data) && $data == "Wiraswasta" ? TRUE : FALSE)); ?>>Wiraswasta</option>
																<option value="Buruh Harian Lepas" <?php echo set_select('pekerjaan', 'Buruh Harian Lepas', (!empty($data) && $data == "Buruh Harian Lepas" ? TRUE : FALSE)); ?>>Buruh Harian Lepas</option>
																<option value="Pegawai Negeri" <?php echo set_select('pekerjaan', 'Pegawai Negeri', (!empty($data) && $data == "Pegawai Negeri" ? TRUE : FALSE)); ?>>Pegawai Negeri</option>
																<option value="Pegawai Swasta" <?php echo set_select('pekerjaan', 'Pegawai Swasta', (!empty($data) && $data == "Pegawai Swasta" ? TRUE : FALSE)); ?>>Pegawai Swasta</option>
																<option value="Guru" <?php echo set_select('pekerjaan', 'Guru', (!empty($data) && $data == "Guru" ? TRUE : FALSE)); ?>>Guru</option>
																<option value="Petani" <?php echo set_select('pekerjaan', 'Petani', (!empty($data) && $data == "Petani" ? TRUE : FALSE)); ?>>Petani</option>
																<option value="Mahasiswa" <?php echo set_select('pekerjaan', 'Mahasiswa', (!empty($data) && $data == "Mahasiswa" ? TRUE : FALSE)); ?>>Mahasiswa</option>
																<option value="Tidak Bekerja" <?php echo set_select('pekerjaan', 'Tidak Bekerja', (!empty($data) && $data == "Tidak Bekerja" ? TRUE : FALSE)); ?>>Tidak Bekerja</option>
																<option value="Ibu Rumah Tangga" <?php echo set_select('pekerjaan', 'Ibu Rumah Tangga', (!empty($data) && $data == "Ibu Rumah Tangga" ? TRUE : FALSE)); ?>>Ibu Rumah Tangga</option>
															</select>
															<span class="form-text text-danger"><?= form_error('pekerjaan'); ?></span>
														</div>
													</div>
												</div>
												<h6 class="mb-2 text-primary">Foto KTP atau Foto Identitas</h6>
												<div class="row">
													<div class="col-6">
														<div class="form-group">
															<label for="file_ktp">Sunting Foto Identitas</label>
															<input type="file" id="file_ktp" name="file_ktp" class="dropify" onchange="doAfterSelectImage(this)">
														</div>
													</div>
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
										<div class="row">
											<div class="col d-flex justify-content-end">
												<input type="hidden" name="id_detail_warga" value="<?= $hunian->id_detail_warga ?>">
												<input type="hidden" name="status" value="<?= $hunian->status ?>">
												<button class="btn btn-primary" type="submit">Simpan Perubahan</button>
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" integrity="sha512-aEe/ZxePawj0+G2R+AaIxgrQuKT68I28qh+wgLrcAJOz3rxCP+TwrK5SPN+E5I+1IQjNtcfvb96HDagwrKRdBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.1/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url('assets/js/sweetalert2.all.min.js') ?>"></script>
<script>
	const flashData = $('.flash-data').data('flashdata');
	console.log(flashData);
	if (flashData) {
		Swal.fire({
			icon: 'success',
			title: 'Data Hunian',
			text: 'Berhasil ' + flashData
		});
	}
</script>
<script>
	$('.hapus').on('click', function(e) {
		e.preventDefault();
		const href = $(this).attr('href');
		Swal.fire({
			title: 'Anda yakin ingin menghapus Foto?',
			text: "Data tidak dapat kembali setelah dihapus!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya, hapus foto!'
		}).then((result) => {
			if (result.isConfirmed) {
				document.location.href = href;
			}
		});
	});
</script>

<script>
	const flashProfile = $('.flash-profile').data('flashprofile');
	if (flashProfile) {
		Swal.fire({
			icon: 'warning',
			title: 'Data Hunian Belum Lengkap!',
			text: flashProfile
		});
	}
</script>

<script>
	function doAfterSelectImage(input) {
		let fileData = input.files[0];
		let imgtype = fileData.type;
		let match = ['image/jpeg', 'image/jpg', 'image/png'];
		if (!(imgtype == match[0] || imgtype == match[1] || imgtype == match[2])) {
			Swal.fire({
				icon: 'warning',
				title: 'File yang harus diupload hanya berupa Foto!',
			});
			document.getElementById('file_ktp').value = "";
		}
	}
</script>

<script>
	function doAfterSelectProfile(input) {
		let fileData = input.files[0];
		let imgtype = fileData.type;
		let match = ['image/jpeg', 'image/jpg', 'image/png'];
		if (!(imgtype == match[0] || imgtype == match[1] || imgtype == match[2])) {
			Swal.fire({
				icon: 'warning',
				title: 'File yang harus diupload hanya berupa Foto!',
			});
			document.getElementById('foto_profile').value = "";
		}
	}
</script>

<script>
	var m = moment(new Date());

	$('#datetimepicker').datetimepicker({
		minDate: m.add(1, 'days').startOf('day'),
		ignoreReadonly: true,
		format: 'DD/MM/YYYY',
		allowInputToggle: true,
		defaultDate: false,
		useCurrent: false
	});
</script>
