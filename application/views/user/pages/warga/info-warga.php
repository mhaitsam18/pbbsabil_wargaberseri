<style>
	.dropify-message {
		text-align: center;
		font-size: 2px;
		visibility: hidden;
	}
</style>

<!-- Start Modal Update kk -->
<div class="modal fade overflow-auto" id="updateKK" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<?= form_open_multipart('user/warga/update_kk', array('method' => 'POST')) ?>
			<input type="hidden" name="id_warga" value="<?= $warga->id_warga ?>">
			<input type="hidden" name="old_kk" value="<?= $warga->file_kk ?>">
			<div class="modal-header">
				<h5 class="modal-title">Update Foto Kartu Keluarga</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label>Foto KK</label>
					<input type="file" name="file_kk" id="file_kk" onchange="doAfterSelectImage(this)" class="form-control dropify">
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
<!-- End Modal Update kk -->

<div class="main-wrapper">
	<section class="page-title bg-2">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 text-center">
					<ul class="list-inline mb-0">
						<li class="list-inline-item"><a href="index.html" class="text-sm letter-spacing text-white text-uppercase font-weight-bold">Home</a></li>
						<li class="list-inline-item"><span class="text-white">|</span></li>
						<li class="list-inline-item"><a href="#" class="text-color text-uppercase text-sm letter-spacing">Info Warga</a></li>
					</ul>
					<h1 class="text-lg text-white mt-2">Info Warga</h1>
				</div>
			</div>
		</div>
	</section>

	<div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
	<?php unset($_SESSION['flash']); ?>



	<div class="col mt-5">
		<div class="row justify-content-center">
			<div class="col-12 col-md-8 mb-3">
				<div class="card">
					<div class="card-body">
						<div class="e-profile">
							<div class="row">
								<div class="col-12 col-sm-auto mb-3">
									<div class="mx-auto" style="width: 200px;">
										<div class="d-flex justify-content-center align-items-center rounded" style="height: 140px; background-color: rgb(233, 236, 239);">
											<?php if ($warga->file_kk == NULL || $warga->file_kk == '') { ?>
												<span style="color: rgb(166, 168, 170); font: bold 8pt Arial;">140x140</span>
											<?php } else { ?>
												<img src="<?= base_url('uploads/kk/' . $warga->file_kk) ?>" class="img-fluid rounded" alt="">
											<?php	} ?>
										</div>
									</div>
								</div>
								<div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
									<div class="text-center text-sm-left mb-2 mb-sm-0">
										<h4 class="pt-sm-2 pb-1 mb-0 text-nowrap"><?= $warga->no_rumah ?></h4>
										<p class="mb-0"><?= $warga->no_kk ?></p>
										<div class="mt-2">
											<button class="btn btn-primary" type="button" data-toggle="modal" data-target="#updateKK">
												<i class="fa fa-fw fa-camera"></i>
												<span>Ganti Foto Kartu Keluarga</span>
											</button>
										</div>
									</div>
								</div>
							</div>
							<ul class="nav nav-tabs">
								<li class="nav-item"><a href="javascript:void(0)" class="active nav-link">Sunting Warga</a></li>
							</ul>
							<div class="tab-content pt-3">
								<div class="tab-pane active">
									<form class="form" action="<?= base_url('user/warga/proses_update_warga') ?>" method="POST">
										<div class="row">
											<div class="col">
												<h6 class="mb-2 text-primary">Data Rumah</h6>
												<div class="row">
													<div class="col">
														<div class="form-group">
															<label for="firstname">No Rumah</label>
															<input type="text" class="form-control text-uppercase" name="no_rumah" value="<?php echo $warga->no_rumah ?>">
															<span class="form-text text-danger"><?= form_error('no_rumah'); ?></span>
														</div>
													</div>
													<div class="col">
														<div class="form-group">
															<label for="firstname">Nomor Kartu Keluarga</label>
															<input type="number" class="form-control" name="no_kk" value="<?php echo $warga->no_kk ?>">
															<span class="form-text text-danger"><?= form_error('no_kk'); ?></span>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col">
														<div class="form-group">
															<label for="firstname">Rt</label>
															<input type="number" class="form-control" name="rt" value="<?php echo $warga->rt ?>">
															<span class="form-text text-danger"><?= form_error('rt'); ?></span>
														</div>
													</div>
													<div class="col">
														<div class="form-group">
															<label for="firstname">Rw</label>
															<input type="number" class="form-control" name="rw" value="<?php echo $warga->rw ?>">
															<span class="form-text text-danger"><?= form_error('rw'); ?></span>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col">
														<div class="form-group">
															<label for="firstname">Jumlah Keluarga</label>
															<input type="number" class="form-control" name="jumlah_keluarga" value="<?php echo $warga->jumlah_keluarga ?>">
															<span class="form-text text-danger"><?= form_error('jumlah_keluarga'); ?></span>
														</div>
													</div>
													<div class="col">
														<div class="form-group">
															<label for="firstname">Status Tempat Tinggal</label>
															<input type="hidden" name="status_rumah" value="<?php echo $warga->status_rumah ?>">
															<select class="form-control" name="status_rumah">
																<?php if ($warga->status_rumah) { ?>
																	<option disabled selected><?php echo $warga->status_rumah ?></option>
																<?php } else { ?>
																	<option disabled selected>Status Tempat Tinggal</option>
																<?php } ?>
																<option value="Rumah Usaha" <?php echo set_select('status_rumah', 'Rumah Usaha', (!empty($data) && $data == "Rumah Usaha" ? TRUE : FALSE)); ?>>Rumah Usaha</option>
																<option value="Rumah Tinggal" <?php echo set_select('status_rumah', 'Rumah Tinggal', (!empty($data) && $data == "Rumah Tinggal" ? TRUE : FALSE)); ?>>Rumah Tinggal</option>
																<option value="Rumah Kosong" <?php echo set_select('status_rumah', 'Rumah Kosong', (!empty($data) && $data == "Rumah Kosong" ? TRUE : FALSE)); ?>>Rumah Kosong</option>
															</select>
															<span class="form-text text-danger"><?= form_error('status_rumah'); ?></span>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col">
														<div class="form-group">
															<label class="col-form-label">Status Bantuan Rumah Tangga</label>
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
														</div>
													</div>
													<div class="col">
														<div class="form-group">
															<label for="firstname">Alamat</label>
															<textarea class="form-control" name="alamat" cols="20" rows="9"><?php echo $warga->alamat ?></textarea>
															<span class="form-text text-danger"><?= form_error('jumlah_keluarga'); ?></span>
														</div>
													</div>
												</div>

											</div>
										</div>
										<div class="row">
											<div class="col d-flex justify-content-end">
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
				document.getElementById('file_kk').value = "";
			}
		}
	</script>
