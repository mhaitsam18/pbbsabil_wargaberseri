<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->

<!-- Start Modal Update Profile -->
<div class="modal fade overflow-auto" id="updateProfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<?= form_open_multipart('admin/warga/update_profile', array('method' => 'POST')) ?>
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
					<input type="file" name="foto_profile" id="foto_profile" onchange="doAfterSelectProfile(this)" class="form-control dropify">
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

<!-- Start Modal Update KTP -->
<div class="modal fade overflow-auto" id="updateKtp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<?= form_open_multipart('admin/warga/update_ktp', array('method' => 'POST')) ?>
			<input type="hidden" name="id_detail_warga" value="<?= $hunian->id_detail_warga ?>">
			<input type="hidden" name="old_ktp" value="<?= $hunian->file_ktp ?>">
			<div class="modal-header">
				<h5 class="modal-title">Update Foto Profile</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label>Foto Ktp</label>
					<input type="file" name="file_ktp" class="form-control dropify" id="file_ktp" onchange="doAfterSelectImage(this)">
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
<!-- End Modal Update KTP -->

<div class="content-page">
	<div class="content">
		<!-- Start Content-->
		<div class="container-fluid">
			<div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
			<?php unset($_SESSION['flash']); ?>
			<!-- start page title -->
			<div class="row">
				<div class="col-12">
					<div class="page-title-box">
						<div class="page-title-right">
							<ol class="breadcrumb m-0">
								<li class="breadcrumb-item"><a href="javascript: void(0);">Warga Berseri</a></li>
								<li class="breadcrumb-item"><a href="javascript: void(0);">Sunting Hunian</a></li>
							</ol>
						</div>
						<h4 class="page-title">Sunting Hunian</h4>
					</div>
				</div>
			</div>
			<!-- end page title -->

			<div class="row">
				<div class="col-lg-4 col-xl-4">
					<div class="card-box text-center">
						<h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-account-circle mr-1"></i> Foto Profile</h5>
						<?php if ($hunian->foto_profile == '' || $hunian->foto_profile == NULL) { ?>
							<img src="<?php echo base_url('assets/admin/images/users/default.jpg') ?>" class="rounded-circle avatar-xxl img-thumbnail" alt="profile-image">
						<?php } else { ?>
							<img src="<?php echo base_url('uploads/profile/' . $hunian->foto_profile) ?>" class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">
						<?php } ?>

						<h4 class="mb-0"><?php echo $hunian->nama_warga ?></h4>

						<button data-toggle="modal" data-target="#updateProfile" class="btn btn-success btn-xs waves-effect mb-2 mt-3 waves-light">Ubah Foto</button>
						<?php if ($hunian->foto_profile != '' || $hunian->foto_profile != NULL) { ?>
							<a href="<?php echo base_url('admin/warga/hapus_profile/' . $hunian->id_detail_warga . '/' . $hunian->foto_profile) ?>" class="btn btn-danger btn-xs waves-effect mb-2 mt-3 waves-light hapus">Hapus Foto</a>
						<?php	} else { ?>
							<a href="javascript: void(0);" class="btn btn-danger btn-xs waves-effect mb-2 mt-3 waves-light">Hapus Foto</a>
						<?php	} ?>
					</div>
					<div class="card-box text-center">
						<h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-account-card-details mr-1"></i> Foto KTP</h5>
						<?php if ($hunian->file_ktp == '' || $hunian->file_ktp == NULL) { ?>
							<img src="<?php echo base_url('assets/admin/images/users/default.jpg') ?>" class="img-thumbnail" alt="profile-image">
						<?php } else { ?>
							<img src="<?php echo base_url('uploads/ktp/' . $hunian->file_ktp) ?>" class="img-thumbnail" alt="profile-image">
						<?php } ?>

						<button data-toggle="modal" data-target="#updateKtp" class="btn btn-success btn-xs waves-effect mb-2 mt-3 waves-light">Ubah Foto</button>
						<?php if ($hunian->file_ktp != '' || $hunian->file_ktp != NULL) { ?>
							<a href="<?php echo base_url('admin/warga/hapus_ktp/' . $hunian->id_detail_warga . '/' . $hunian->file_ktp) ?>" class="btn btn-danger btn-xs waves-effect mb-2 mt-3 waves-light hapus">Hapus Foto</a>
						<?php	} else { ?>
							<a href="javascript: void(0);" class="btn btn-danger btn-xs waves-effect mb-2 mt-3 waves-light">Hapus Foto</a>
						<?php	} ?>


					</div>
					<!-- end card-box -->
				</div>
				<!-- end col-->

				<div class="col-lg-8 col-xl-8">
					<div class="card-box">
						<div class="tab-content">
							<?= form_open_multipart('admin/warga/proses_update_anggota_warga', array('method' => 'POST')) ?>
							<?php if ($hunian->status_verifikasi != 2) : ?>
								<div class="alert alert-danger text-center" role="alert">
									Belum Terverifkasi
								</div>
							<?php else : ?>
								<div class="alert alert-success text-center" role="alert">
									Terverifikasi
								</div>
							<?php endif; ?>
							<h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-account-circle mr-1"></i> Data personal</h5>
							<div class="row">
								<div class="col-md-8">
									<div class="form-group">
										<label for="firstname">Nama Lengkap</label>
										<input type="text" class="form-control" name="nama_warga" value="<?php echo $hunian->nama_warga ?>">
										<span class="form-text text-danger"><?= form_error('nama_warga'); ?></span>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-8">
									<div class="form-group">
										<label for="firstname">No Handphone</label>
										<input type="number" class="form-control" name="no_hp" value="<?php echo $hunian->no_hp ?>">
										<span class="form-text text-danger"><?= form_error('no_hp'); ?></span>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label for="firstname">Tempat Lahir</label>
										<input type="text" class="form-control" name="tempat_lahir" value="<?php echo $hunian->tempat_lahir ?>">
										<span class="form-text text-danger"><?= form_error('tempat_lahir'); ?></span>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="firstname">Tanggal Lahir</label>
										<input type="date" class="form-control" name="tanggal_lahir" value="<?php echo $hunian->tanggal_lahir ?>">
										<span class="form-text text-danger"><?= form_error('tanggal_lahir'); ?></span>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-8">
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
								<div class="col-md-8">
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
							</div>

							<div class="row">
								<div class="col-md-8">
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

							<h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-account-multiple mr-1"></i> Hubungan Keluarga</h5>
							<div class="row">
								<div class="col-md-8">
									<div class="form-group">
										<label for="firstname">Nomor Induk Keluarga</label>
										<input type="number" class="form-control" name="nik" value="<?php echo $hunian->nik ?>">
										<span class="form-text text-danger"><?= form_error('nik'); ?></span>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-8">
									<div class="form-group">
										<label for="firstname">Hubungan Keluarga</label>
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
							</div>

							<div class="row">
								<div class="col-md-8">
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

							<div class="row">
								<div class="col-md-8">
									<div class="form-group">
										<label for="firstname">Status Keluarga</label>
										<input type="hidden" name="status" value="<?php echo $hunian->status ?>">
										<select class="form-control" name="status">
											<?php if ($hunian->status) { ?>
												<option disabled selected><?php echo $hunian->status ?></option>
											<?php } else { ?>
												<option disabled selected>Status Keluarga</option>
											<?php } ?>
											<option value="Kepala Keluarga" <?php echo set_select('status', 'Kepala Keluarga', (!empty($data) && $data == "Kepala Keluarga" ? TRUE : FALSE)); ?>>Kepala Keluarga</option>
											<option value="Anggota Keluarga" <?php echo set_select('status', 'Anggota Keluarga', (!empty($data) && $data == "Anggota Keluarga" ? TRUE : FALSE)); ?>>Anggota Keluarga</option>
										</select>
										<span class="form-text text-danger"><?= form_error('status'); ?></span>
									</div>
								</div>
							</div>


							<h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-office-building mr-1"></i> Info Pekerjaan</h5>
							<div class="row">
								<div class="col-md-6">
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
								<div class="col-md-6">
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

								<!-- end col -->
							</div>

							<div class="row">
								<div class="col-md-8">
									<div class="form-group">
										<input type="hidden" name="id_detail_warga" value="<?= $hunian->id_detail_warga ?>">
										<button type="submit" class="btn btn-info">Perbarui Data</button>
									</div>
								</div>
							</div>

							<?= form_close() ?>
						</div>
						<!-- end settings content-->
					</div> <!-- end tab-content -->
				</div> <!-- end card-box-->

			</div> <!-- end col -->
		</div>
		<!-- end row-->

	</div> <!-- container -->

</div> <!-- content -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
