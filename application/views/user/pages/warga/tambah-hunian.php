<style>
	.dropify-message {
		text-align: center;
		font-size: 2px;
		visibility: hidden;
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
						<li class="list-inline-item"><a href="#" class="text-color text-uppercase text-sm letter-spacing">Tambah Hunian</a></li>
					</ul>
					<h1 class="text-lg text-white mt-2">Tambah Hunian</h1>
				</div>
			</div>
		</div>
	</section>

	<div class="container py-5">
		<div class="row gutters">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<div class="card h-100">
					<div class="card-body">
						<?= form_open_multipart('user/warga/proses_tambah_anggota_warga', array('method' => 'POST')) ?>
						<div class="row gutters">
							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
								<h6 class="mb-2 text-primary">Data Personal</h6>
							</div>
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
								<div class="form-group">
									<label for="firstname">Nama Lengkap</label>
									<input type="text" class="form-control" placeholder="Ersa Nur Maulana" name="nama_warga" value="<?= set_value('nama_warga') ?>">
									<span class="form-text text-danger"><?= form_error('nama_warga'); ?></span>
								</div>
							</div>
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
								<div class="form-group">
									<label for="firstname">Nomor Induk Kependudukan</label>
									<input type="number" class="form-control" placeholder="3525726892580001" name="nik" value="<?= set_value('nik') ?>">
									<span class="form-text text-danger"><?= form_error('nik'); ?></span>
								</div>
							</div>
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
								<div class="form-group">
									<label for="firstname">Tempat Lahir</label>
									<input type="text" class="form-control" placeholder="Bogor" name="tempat_lahir" value="<?= set_value('tempat_lahir') ?>">
									<span class="form-text text-danger"><?= form_error('tempat_lahir'); ?></span>
								</div>
							</div>

							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
								<div class="form-group">
									<label for="firstname">Tanggal Lahir</label>
									<input type="date" class="form-control" id="date-data" name="tanggal_lahir" value="<?= set_value('tanggal_lahir') ?>">
									<span class="form-text text-danger"><?= form_error('tanggal_lahir'); ?></span>
								</div>
							</div>

							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
								<div class="form-group">
									<label for="firstname">No Handphone</label>
									<input type="number" placeholder="081322456198" class="form-control" name="no_hp" value="<?= set_value('no_hp') ?>">
									<span class="form-text text-danger"><?= form_error('no_hp'); ?></span>
								</div>
							</div>

							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
								<div class="form-group">
									<label for="firstname">Agama</label>
									<select class="form-control" name="agama">
										<option disabled selected>Agama</option>
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

							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
								<div class="form-group">
									<label for="firstname">Jenis Kelamin</label>
									<select class="form-control" name="jenis_kelamin">
										<option disabled selected>Jenis Kelamin</option>
										<option value="Laki-laki" <?php echo set_select('jenis_kelamin', 'Laki-laki', (!empty($data) && $data == "Laki-laki" ? TRUE : FALSE)); ?>>Laki-laki</option>
										<option value="Perempuan" <?php echo set_select('jenis_kelamin', 'Perempuan', (!empty($data) && $data == "Perempuan" ? TRUE : FALSE)); ?>>Perempuan</option>
									</select>
									<span class="form-text text-danger"><?= form_error('jenis_kelamin'); ?></span>
								</div>
							</div>

							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
								<div class="form-group">
									<label for="firstname">Status Perkawinan</label>
									<select class="form-control" name="status_perkawinan">
										<option disabled selected>Status Perkawinan</option>
										<option value="Belum Kawin" <?php echo set_select('status_perkawinan', 'Belum Kawin', (!empty($data) && $data == "Belum Kawin" ? TRUE : FALSE)); ?>>Belum Kawin</option>
										<option value="Kawin" <?php echo set_select('status_perkawinan', 'Kawin', (!empty($data) && $data == "Kawin" ? TRUE : FALSE)); ?>>Kawin</option>
										<option value="Janda" <?php echo set_select('status_perkawinan', 'Janda', (!empty($data) && $data == "Janda" ? TRUE : FALSE)); ?>>Janda</option>
										<option value="Duda" <?php echo set_select('status_perkawinan', 'Duda', (!empty($data) && $data == "Duda" ? TRUE : FALSE)); ?>>Duda</option>
									</select>
									<span class="form-text text-danger"><?= form_error('status_perkawinan'); ?></span>
								</div>
							</div>

							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
								<div class="form-group">
									<label for="companyname">Foto Kartu Tanda Penduduk atau Akta Kelahiran</label>
									<input type="file" class="dropify" id="file_ktp" name="file_ktp" onchange="doAfterSelectImage(this)" value="<?= set_value('file_ktp') ?>">
									<span class="form-text text-danger"><?= form_error('file_ktp'); ?></span>
								</div>
							</div>
						</div>

						<div class="row gutters">
							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
								<h6 class="mt-3 mb-2 text-primary">Hubungan Keluarga</h6>
							</div>
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
								<div class="form-group">
									<label for="firstname">Sebagai</label>
									<select class="form-control" name="hubungan_keluarga">
										<option disabled selected>Hubungan Keluarga</option>
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
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
								<div class="form-group">
									<label for="firstname">Status Hunian</label>
									<select class="form-control" name="status_hunian">
										<option disabled selected>Status hunian</option>
										<option value="KTP lengkong tinggal di Lengkong" <?php echo set_select('status_hunian', 'KTP lengkong tinggal di Lengkong', (!empty($data) && $data == "KTP lengkong tinggal di Lengkong" ? TRUE : FALSE)); ?>>KTP lengkong tinggal di Lengkong</option>
										<option value="KTP luar tinggal di Lengkong" <?php echo set_select('status_hunian', 'KTP luar tinggal di Lengkong', (!empty($data) && $data == "KTP luar tinggal di Lengkong" ? TRUE : FALSE)); ?>>KTP luar tinggal di Lengkong</option>
										<option value="KTP lengkong tinggal di luar" <?php echo set_select('status_hunian', 'KTP lengkong tinggal di luar', (!empty($data) && $data == "KTP lengkong tinggal di luar" ? TRUE : FALSE)); ?>>KTP lengkong tinggal di luar</option>
									</select>
									<span class="form-text text-danger"><?= form_error('status_hunian'); ?></span>
								</div>
							</div>
						</div>

						<div class="row gutters">
							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
								<h6 class="mt-3 mb-2 text-primary">Info Pekerjaan</h6>
							</div>
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
								<div class="form-group">
									<label for="companyname">Pendidikan</label>
									<select class="form-control" name="pendidikan">
										<option disabled selected>Pendidikan</option>
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
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
								<div class="form-group">
									<label for="cwebsite">Pekerjaan</label>
									<select class="form-control" id="pekerjaan" name="pekerjaan">
										<option disabled selected>Pekerjaan</option>
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

						<div class="row gutters">
							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
								<div class="text-right">
									<button type="submit" class="btn btn-primary">Tambah</button>
								</div>
							</div>
						</div>
						<?= form_close() ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- <script>
	$('#date-data').on('change', function() {
		var date = new Date($('#date-data').val());
		var day = date.getDate();
		var month = date.getMonth() + 1;
		var year = date.getFullYear();
		var datePick = [month, day, year].join('/');
	});
	var today = new Date();
	var dd = String(today.getDate()).padStart(2, '0');
	var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
	var yyyy = today.getFullYear();
	today = mm + '/' + dd + '/' + yyyy;
	document.getElementById("date-data").setAttribute("max", today);
</script> -->

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
