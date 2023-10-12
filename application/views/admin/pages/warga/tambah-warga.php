<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->

<style>
	p {
		margin: 0px;
		padding: 0px;
		overflow-wrap: normal;
		word-break: normal;
	}
</style>
<?php $role = $this->session->userdata('role_id'); ?>
<div class="content-page">
	<div class="content">

		<!-- Start Content-->
		<div class="container-fluid">

			<!-- start page title -->
			<div class="row">
				<div class="col-12">
					<div class="page-title-box">
						<div class="page-title-right">
							<ol class="breadcrumb m-0">
								<li class="breadcrumb-item"><a href="javascript: void(0);">Warga Berseri</a></li>
								<li class="breadcrumb-item"><a href="javascript: void(0);">Data Warga</a></li>
							</ol>
						</div>
						<h4 class="page-title">Tambah Data Warga</h4>
					</div>
				</div>
			</div>
			<!-- end page title -->

			<!-- Form row -->
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<?= form_open_multipart('admin/warga/proses_tambah_warga', array('method' => 'POST')) ?>

							<div class="form-row">
								<div class="form-group col-md-8">
									<label for="inputEmail4" class="col-form-label">Nama Pemilik Rumah</label>
									<input type="text" class="form-control" placeholder="Nama Pemilik Rumah" name="nama_warga" value="<?php echo set_value('nama_warga') ?>">
									<span class="form-text text-danger"><?= form_error('nama_warga'); ?></span>
								</div>
							</div>

							<div class="form-row">
								<div class="form-group col-md-8">
									<label for="inputEmail4" class="col-form-label">No Hp</label>
									<input type="number" class="form-control" placeholder="Nomor HP Pemilik Rumah" name="no_hp" value="<?php echo set_value('no_hp') ?>">
									<span class="form-text text-danger"><?= form_error('no_hp'); ?></span>
								</div>
							</div>

							<div class="form-row">
								<div class="form-group col-md-8">
									<label for="inputEmail4" class="col-form-label">Nomor Rumah</label>
									<input type="text" class="form-control text-uppercase" placeholder="b-3" name="no_rumah" value="<?php echo set_value('no_rumah') ?>">
									<span class="form-text text-danger"><?= form_error('no_rumah'); ?></span>
								</div>
							</div>

							<div class="form-row">
								<div class="form-group col-md-8">
									<label for="inputEmail4" class="col-form-label">Nomor Kartu Keluarga</label>
									<input type="number" class="form-control" placeholder="No KK" name="no_kk" value="<?php echo set_value('no_kk') ?>">
									<span class="form-text text-danger"><?= form_error('no_kk'); ?></span>
								</div>
							</div>

							<div class="form-row">
								<div class="form-group col-md-6">
									<label for="inputCity" class="col-form-label">Alamat</label>
									<textarea class="form-control" name="alamat" cols="20" rows="1" placeholder="Alamat Rumah"><?php echo set_value('alamat') ?></textarea>
									<span class="form-text text-danger"><?= form_error('alamat'); ?></span>
								</div>
								<?php if ($role == 6) { ?>
									<div class="form-group col-md-1">
										<label class="col-form-label">RT</label>
										<input type="text" class="form-control" readonly name="rt" value="<?= $user->rt ?>">
									</div>
								<?php	} else { ?>
									<div class="form-group col-md-1">
										<label class="col-form-label">RT</label>
										<select class="form-control" name="rt">
											<option disabled selected>rt</option>
											<option value="1" <?php echo set_select('rt', '1', (!empty($data) && $data == "1" ? TRUE : FALSE)); ?>>1</option>
											<option value="2" <?php echo set_select('rt', '2', (!empty($data) && $data == "2" ? TRUE : FALSE)); ?>>2</option>
											<option value="3" <?php echo set_select('rt', '3', (!empty($data) && $data == "3" ? TRUE : FALSE)); ?>>3</option>
											<option value="4" <?php echo set_select('rt', '4', (!empty($data) && $data == "4" ? TRUE : FALSE)); ?>>4</option>
											<option value="5" <?php echo set_select('rt', '5', (!empty($data) && $data == "5" ? TRUE : FALSE)); ?>>5</option>
										</select>
										<span class="form-text text-danger"><?= form_error('rt'); ?></span>
									</div>
								<?php	} ?>

								<?php if ($role == 7 || $role == 6) { ?>
									<div class="form-group col-md-1">
										<label class="col-form-label">RW</label>
										<input type="text" class="form-control" readonly name="rw" value="<?= $user->rw ?>">
										<span class="form-text text-danger" style=" width:200px"><?= form_error('rw'); ?></span>
									</div>
								<?php	} else { ?>
									<div class="form-group col-md-1">
										<label class="col-form-label">RW</label>
										<input type="text" class="form-control" name="rw" value="<?php echo set_value('rw') ?>">
										<span class="form-text text-danger" style=" width:200px"><?= form_error('rw'); ?></span>
									</div>
								<?php	} ?>

							</div>

							<div class="form-row">
								<div class="form-group col-md-8">
									<label class="col-form-label">Jumlah Keluarga</label>
									<input type="text" class="form-control" name="jumlah_keluarga" value="<?php echo set_value('jumlah_keluarga') ?>">
									<span class="form-text text-danger"><?= form_error('jumlah_keluarga'); ?></span>
								</div>
							</div>

							<div class="form-row">
								<div class="form-group col-md-8">
									<label class="col-form-label">Status Rumah</label>
									<select class="form-control" name="status_rumah">
										<option disabled selected>Status Rumah</option>
										<option value="Rumah Usaha" <?php echo set_select('status_rumah', 'Rumah Usaha', (!empty($data) && $data == "Rumah Usaha" ? TRUE : FALSE)); ?>>Rumah Usaha</option>
										<option value="Rumah Tinggal" <?php echo set_select('status_rumah', 'Rumah Tinggal', (!empty($data) && $data == "Rumah Tinggal" ? TRUE : FALSE)); ?>>Rumah Tinggal</option>
										<option value="Rumah Kosong" <?php echo set_select('status_rumah', 'Rumah Kosong', (!empty($data) && $data == "Rumah Kosong" ? TRUE : FALSE)); ?>>Rumah Kosong</option>
									</select>
									<span class="form-text text-danger"><?= form_error('status_rumah'); ?></span>
								</div>
							</div>

							<div class="form-row">
								<div class="form-group col-md-8">
									<label class="col-form-label">Status Rumah Tangga</label>
									<div class="custom-control custom-checkbox">
										<input type="checkbox" name="status_rumah_tangga[]" class="custom-control-input" id="customCheck1" value="KIS">
										<label class="custom-control-label text-info" for="customCheck1">Program Pemerintah berupa KIS (Kartu Indonesia Sehat)</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input type="checkbox" name="status_rumah_tangga[]" class="custom-control-input" id="customCheck2" value="RASKIN">
										<label class="custom-control-label text-success" for="customCheck2">Program Pemerintah berupa RASKIN (Beras untuk keluarga miskin)</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input type="checkbox" name="status_rumah_tangga[]" class="custom-control-input" id="customCheck3" value="KIP">
										<label class="custom-control-label text-warning" for="customCheck3">Program Pemerintah berupa KIP (Kartu Indonesia Pintar)</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input type="checkbox" name="status_rumah_tangga[]" class="custom-control-input" id="customCheck4" value="PKH">
										<label class="custom-control-label text-danger" for="customCheck4">Program Pemerintah berupa PKH (Program Keluarga Harapan)</label>
									</div>
									<span class="form-text text-danger"><?= form_error('status_rumah_tangga[]'); ?></span>
								</div>
							</div>

							<div class="form-row">
								<div class="form-group col-md-8">
									<label class="col-form-label">Foto Kartu Keluarga</label>
									<input type="file" class="form-control dropify" id="file_kk" onchange="doAfterSelectImage(this)" name="file_kk" value="<?php echo set_value('file_kk') ?>">
									<span class="form-text text-danger"><?= form_error('file_kk'); ?></span>
								</div>
							</div>

							<button type="submit" class="btn btn-primary waves-effect waves-light">Tambah Data</button>

							<?= form_close() ?>

						</div> <!-- end card-body -->
					</div> <!-- end card-->
				</div> <!-- end col -->
			</div>
			<!-- end row -->

		</div> <!-- container -->

	</div> <!-- content -->

</div>

<!-- ============================================================== -->
<!-- End Page content -->
<!-- ============================================================== -->
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
			document.getElementById('file_kk').value = "";
		}
	}
</script>
