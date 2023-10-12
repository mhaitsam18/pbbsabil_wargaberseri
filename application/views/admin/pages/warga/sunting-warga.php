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
								<li class="breadcrumb-item"><a href="javascript: void(0);">Data Warga</a></li>
							</ol>
						</div>
						<h4 class="page-title">Sunting Data Warga</h4>
					</div>
				</div>
			</div>
			<!-- end page title -->

			<!-- Form row -->
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<?= form_open_multipart('admin/warga/proses_update_warga', array('method' => 'POST')) ?>

							<div class="form-row">
								<div class="form-group col-md-8">
									<label for="inputEmail4" class="col-form-label">Nomor Rumah</label>
									<input type="text" class="form-control text-uppercase" name="no_rumah" value="<?= $warga->no_rumah ?>">
									<span class="form-text text-danger"><?= form_error('no_rumah'); ?></span>
								</div>
							</div>

							<div class="form-row">
								<div class="form-group col-md-8">
									<label for="inputEmail4" class="col-form-label">Nomor Kartu Keluarga</label>
									<input type="number" class="form-control" placeholder="No KK" name="no_kk" value="<?= $warga->no_kk ?>">
									<span class="form-text text-danger"><?= form_error('no_kk'); ?></span>
								</div>
							</div>

							<div class="form-row">
								<div class="form-group col-md-6">
									<label for="inputCity" class="col-form-label">Alamat</label>
									<textarea class="form-control" name="alamat" cols="20" rows="1" placeholder="Alamat Rumah"><?= $warga->alamat ?></textarea>
									<span class="form-text text-danger"><?= form_error('alamat'); ?></span>
								</div>

								<div class="form-group col-md-1">
									<label class="col-form-label">RT</label>
									<input type="text" class="form-control" name="rt" value="<?= $warga->rt ?>">
									<span class="form-text text-danger"><?= form_error('rt'); ?></span>
								</div>

								<div class="form-group col-md-1">
									<label class="col-form-label">RW</label>
									<input type="text" class="form-control" name="rw" value="<?= $warga->rw ?>">
									<span class="form-text text-danger" style=" width:200px"><?= form_error('rw'); ?></span>
								</div>
							</div>

							<div class="form-row">
								<div class="form-group col-md-8">
									<label class="col-form-label">Jumlah Keluarga</label>
									<input type="text" class="form-control" name="jumlah_keluarga" value="<?= $warga->jumlah_keluarga ?>">
									<span class="form-text text-danger"><?= form_error('jumlah_keluarga'); ?></span>
								</div>
							</div>

							<div class="form-row">
								<div class="form-group col-md-8">
									<label class="col-form-label">Status Rumah</label>
									<input type="hidden" name="status_rumah" value="<?= $warga->status_rumah ?>">
									<select class="form-control" name="status_rumah">
										<?php if ($warga->status_rumah) { ?>
											<option disabled selected><?php echo $warga->status_rumah ?></option>
										<?php } else { ?>
											<option disabled selected>Status Rumah</option>
										<?php } ?>
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
									<?php switch ($warga->status_rumah_tangga):
										case "Rentan Miskin": ?>
											<div>
												<div class="custom-control custom-checkbox">
													<input type="checkbox" name="status_rumah_tangga[]" class="custom-control-input" id="customCheck1" value="KIS" checked>
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
											</div>
											<?php break; ?>
										<?php
										case "Hampir Miskin": ?>
											<div>
												<div class="custom-control custom-checkbox">
													<input type="checkbox" name="status_rumah_tangga[]" class="custom-control-input" id="customCheck1" value="KIS" checked>
													<label class="custom-control-label text-info" for="customCheck1">Program Pemerintah berupa KIS (Kartu Indonesia Sehat)</label>
												</div>
												<div class="custom-control custom-checkbox">
													<input type="checkbox" name="status_rumah_tangga[]" class="custom-control-input" id="customCheck2" value="RASKIN" checked>
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
											</div>
											<?php break; ?>
										<?php
										case "Miskin": ?>
											<div>
												<div class="custom-control custom-checkbox">
													<input type="checkbox" name="status_rumah_tangga[]" class="custom-control-input" id="customCheck1" value="KIS" checked>
													<label class="custom-control-label text-info" for="customCheck1">Program Pemerintah berupa KIS (Kartu Indonesia Sehat)</label>
												</div>
												<div class="custom-control custom-checkbox">
													<input type="checkbox" name="status_rumah_tangga[]" class="custom-control-input" id="customCheck2" value="RASKIN" checked>
													<label class="custom-control-label text-success" for="customCheck2">Program Pemerintah berupa RASKIN (Beras untuk keluarga miskin)</label>
												</div>
												<div class="custom-control custom-checkbox">
													<input type="checkbox" name="status_rumah_tangga[]" class="custom-control-input" id="customCheck3" value="KIP" checked>
													<label class="custom-control-label text-warning" for="customCheck3">Program Pemerintah berupa KIP (Kartu Indonesia Pintar)</label>
												</div>
												<div class="custom-control custom-checkbox">
													<input type="checkbox" name="status_rumah_tangga[]" class="custom-control-input" id="customCheck4" value="PKH">
													<label class="custom-control-label text-danger" for="customCheck4">Program Pemerintah berupa PKH (Program Keluarga Harapan)</label>
												</div>
											</div>
											<?php break; ?>
										<?php
										case "Sangat Miskin": ?>
											<div>
												<div class="custom-control custom-checkbox">
													<input type="checkbox" name="status_rumah_tangga[]" class="custom-control-input" id="customCheck1" value="KIS" checked>
													<label class="custom-control-label text-info" for="customCheck1">Program Pemerintah berupa KIS (Kartu Indonesia Sehat)</label>
												</div>
												<div class="custom-control custom-checkbox">
													<input type="checkbox" name="status_rumah_tangga[]" class="custom-control-input" id="customCheck2" value="RASKIN" checked>
													<label class="custom-control-label text-success" for="customCheck2">Program Pemerintah berupa RASKIN (Beras untuk keluarga miskin)</label>
												</div>
												<div class="custom-control custom-checkbox">
													<input type="checkbox" name="status_rumah_tangga[]" class="custom-control-input" id="customCheck3" value="KIP" checked>
													<label class="custom-control-label text-warning" for="customCheck3">Program Pemerintah berupa KIP (Kartu Indonesia Pintar)</label>
												</div>
												<div class="custom-control custom-checkbox">
													<input type="checkbox" name="status_rumah_tangga[]" class="custom-control-input" id="customCheck4" value="PKH" checked>
													<label class="custom-control-label text-danger" for="customCheck4">Program Pemerintah berupa PKH (Program Keluarga Harapan)</label>
												</div>
											</div>
											<?php break; ?>
										<?php
										default: ?>
											<div>
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
											</div>
									<?php break;
									endswitch; ?>
									<span class="form-text text-danger"><?= form_error('status_rumah_tangga[]'); ?></span>
									<?php if ($warga->status_rumah_tangga != NULL || $warga->status_rumah_tangga != "") : ?>
										<span class="form-text text-primary ml-3">Status : <?php echo $warga->status_rumah_tangga ?></span>
									<?php endif; ?>
								</div>
							</div>

							<div class="form-row">
								<div class="form-group col-md-8">
									<label class="col-form-label">Foto Kartu Keluarga</label>
									<input type="file" class="form-control dropify" onchange="doAfterSelectImage(this)" name="file_kk" value="<?php echo set_value('file_kk') ?>">
									<span class="form-text text-danger"><?= form_error('file_kk'); ?></span>
								</div>
								<?php if ($warga->file_kk) : ?>
									<div class="form-group col-md-4">
										<label class="col-form-label">Foto Kartu Keluarga</label>
										<input type="file" class="dropify" disabled="disabled" data-default-file="<?= base_url('uploads/kk/' . $warga->file_kk) ?>">
									</div>
								<?php endif ?>
							</div>

							<div class="form-row">

							</div>

							<input type="hidden" name="id_warga" value="<?php echo $warga->id_warga ?>">
							<button type="submit" class="btn btn-primary waves-effect waves-light">Sunting Data</button>

							<?= form_close() ?>

						</div> <!-- end card-body -->
					</div> <!-- end card-->
				</div> <!-- end col -->
			</div>
			<!-- end row -->

		</div> <!-- container -->

	</div> <!-- content -->

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?php echo base_url('assets/js/sweetalert2.all.min.js') ?>"></script>

<script>
	const flashData = $('.flash-data').data('flashdata');
	console.log(flashData);
	if (flashData) {
		Swal.fire({
			icon: 'success',
			title: 'Data Warga',
			text: 'Berhasil ' + flashData
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
