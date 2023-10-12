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
						<li class="list-inline-item"><a href="#" class="text-color text-uppercase text-sm letter-spacing">Sunting Kendaraan</a></li>
					</ul>
					<h1 class="text-lg text-white mt-2">Sunting Kendaraan</h1>
				</div>
			</div>
		</div>
	</section>
	<div class="flash-data" data-flashdata="<?= $this->session->flashdata('flashKendaraan'); ?>"></div>
	<?php unset($_SESSION['flashKendaraan']); ?>

	<div class="container py-5">
		<div class="row gutters">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<div class="card h-100">
					<div class="card-body">
						<?= form_open_multipart('user/kendaraan/proses_sunting_kendaraan/' . $kendaraan->id_kendaraan, array('method' => 'POST')) ?>
						<div class="row gutters">
							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
								<h6 class="mb-2 text-primary">Sunting Kendaraan</h6>
							</div>
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
								<div class="form-group">
									<label>Tipe Kendaraan</label>
									<input type="hidden" name="tipe_kendaraan" value="<?php echo $kendaraan->tipe_kendaraan ?>">
									<select class="form-control" name="tipe_kendaraan">
										<?php if ($kendaraan->tipe_kendaraan) { ?>
											<option disabled selected><?php echo $kendaraan->tipe_kendaraan ?></option>
										<?php } else { ?>
											<option disabled selected>Tipe Kendaraan</option>
										<?php } ?>
										<option value="Roda Dua" <?php echo set_select('tipe_kendaraan', 'Roda Dua', (!empty($data) && $data == "Roda Dua" ? TRUE : FALSE)); ?>>Roda Dua</option>
										<option value="Roda Tiga" <?php echo set_select('tipe_kendaraan', 'Roda Tiga', (!empty($data) && $data == "Roda Tiga" ? TRUE : FALSE)); ?>>Roda Tiga</option>
										<option value="Roda Empat" <?php echo set_select('tipe_kendaraan', 'Roda Empat', (!empty($data) && $data == "Roda Empat" ? TRUE : FALSE)); ?>>Roda Empat</option>
										<option value="Lebih dari Roda Empat" <?php echo set_select('tipe_kendaraan', 'Lebih dari Roda Empat', (!empty($data) && $data == "Lebih dari Roda Empat" ? TRUE : FALSE)); ?>>Lebih dari Roda Empat</option>
									</select>
									<small class="form-text text-danger"><?= form_error('tipe_kendaraan'); ?></small>
								</div>
							</div>
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
								<div class="form-group">
									<label>Merk Kendaraan</label>
									<input style="height:40px" class="form-control input-sm" type="text" name="merk_kendaraan" placeholder="Toyota Avanza" value="<?= $kendaraan->merk_kendaraan ?>">
									<small class="form-text text-danger"><?= form_error('merk_kendaraan'); ?></small>
								</div>
							</div>
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
								<div class="form-group">
									<label>Nama Pemilik di STNK</label>
									<input style="height:40px" class="form-control input-sm" type="text" placeholder="Ersa Nur Maulana" name="nama_stnk" value="<?= $kendaraan->nama_stnk ?>">
									<small class="form-text text-danger"><?= form_error('nama_stnk'); ?></small>
								</div>
							</div>

							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
								<div class="form-group">
									<?php $pecah = explode(" ", $kendaraan->no_polisi); ?>
									<label>Nomor Polisi</label>
									<div class="form-row">
										<div class="col-2">
											<input type="text" value="<?= $pecah[0] ?>" name="nopol_1" placeholder="D" class="form-control input-sm text-uppercase" onkeypress="limitKeypress(event,this.value,2)">
										</div>
										<div class="col">
											<input type="number" value="<?= $pecah[1] ?>" name="nopol_2" placeholder="3441" class="form-control input-sm" onkeypress="limitKeypress(event,this.value,10)" />
										</div>
										<div class="col">
											<input type="text" value="<?= $pecah[2] ?>" name="nopol_3" placeholder="VHU" class="form-control input-sm text-uppercase" onkeypress="limitKeypress(event,this.value,3)">
										</div>
									</div>
									<small class="form-text text-danger"><?= form_error('nopol_2'); ?></small>
								</div>
							</div>

							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
								<div class="form-group">
									<label>Foto Kendaraan</label>
									<input type="file" name="foto_kendaraan" id="foto_kendaraan" onchange="doAfterSelectImage(this)" class="form-control dropify">
									<small class="form-text text-danger"><?= form_error('foto_kendaraan'); ?></small>
								</div>
							</div>

							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
								<div class="form-group">
									<label>Foto Kendaraan Terkini</label>
									<input type="file" disabled class="dropify" data-default-file="<?= base_url('uploads/kendaraan/' . $kendaraan->foto_kendaraan) ?>">
								</div>
							</div>
						</div>

						<div class="row gutters">
							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
								<div class="text-right">
									<button type="submit" class="btn btn-primary">Simpan Perubahan</button>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?php echo base_url('assets/js/sweetalert2.all.min.js') ?>"></script>
<script>
	const flashData = $('.flash-data').data('flashdata');
	console.log(flashData);
	if (flashData) {
		Swal.fire({
			icon: 'success',
			title: 'Data Kendaraan',
			text: flashData
		});
	}
</script>

<script>
	function limitKeypress(event, value, maxLength) {
		if (value != undefined && value.toString().length >= maxLength) {
			event.preventDefault();
		}
	}
</script>

<script>
	function doAfterSelectImage(input) {
		let fileData = input.files[0];
		let imgtype = fileData.type;
		let match = ['image/jpeg', 'image/jpg', 'image/png'];
		if (!(imgtype == match[0]) || (imgtype == match[1])) {
			Swal.fire({
				icon: 'warning',
				title: 'File yang harus diupload hanya berupa Foto!',
			});
			document.getElementById('foto_kendaraan').value = "";
		}
	}
</script>
