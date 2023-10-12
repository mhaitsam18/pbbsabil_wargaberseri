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
		<div class="flash-data" data-flashdata="<?= $this->session->flashdata('flashKendaraan'); ?>"></div>
		<?php unset($_SESSION['flashKendaraan']); ?>
		<!-- Start Content-->
		<div class="container-fluid">

			<!-- start page title -->
			<div class="row">
				<div class="col-12">
					<div class="page-title-box">
						<div class="page-title-right">
							<ol class="breadcrumb m-0">
								<li class="breadcrumb-item"><a href="javascript: void(0);">Warga Berseri</a></li>
								<li class="breadcrumb-item"><a href="javascript: void(0);">Sunting Kendaraan</a></li>
							</ol>
						</div>
						<h4 class="page-title">Sunting Data Kendaraan</h4>
					</div>
				</div>
			</div>
			<!-- end page title -->

			<!-- Form row -->
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<?= form_open_multipart('admin/kendaraan/proses_sunting_kendaraan/' . $kendaraan->id_kendaraan, array('method' => 'POST')) ?>

							<div class="form-row">
								<div class="form-group col-md-8">
									<label class="col-form-label">Tipe Kendaraan</label>
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
									<span class="form-text text-danger"><?= form_error('tipe_kendaraan'); ?></span>
								</div>
							</div>

							<div class="form-row">
								<div class="form-group col-md-8">
									<label class="col-form-label">Merk Kendaraan</label>
									<input type="text" class="form-control" placeholder="Merk Kendaraan" name="merk_kendaraan" value="<?= $kendaraan->merk_kendaraan ?>">
									<span class="form-text text-danger"><?= form_error('merk_kendaraan'); ?></span>
								</div>
							</div>

							<div class="form-row">
								<div class="form-group col-md-8">
									<label class="col-form-label">Nama Pemilik STNK</label>
									<input type="text" class="form-control" placeholder="Nama Pemilik" name="nama_stnk" value="<?= $kendaraan->nama_stnk ?>">
									<span class="form-text text-danger"><?= form_error('nama_stnk'); ?></span>
								</div>
							</div>

							<div class="form-row">
								<div class="form-group col-md-8">
									<label class="col-form-label">Nomor Polisi</label>
									<?php $pecah = explode(" ", $kendaraan->no_polisi); ?>
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

							<div class="form-row">
								<div class="form-group col-md-8">
									<label class="col-form-label">Foto Kendaraan</label>
									<input type="file" class="form-control dropify" name="foto_kendaraan" value="<?php echo set_value('foto_kendaraan') ?>">
									<span class="form-text text-danger"><?= form_error('foto_kendaraan'); ?></span>
								</div>
								<div class="form-group col-md-4">
									<label class="col-form-label">Foto Kendaraan</label>
									<input type="file" disabled class="dropify" data-default-file="<?= base_url('uploads/kendaraan/' . $kendaraan->foto_kendaraan) ?>">
									<span class="form-text text-danger"><?= form_error('foto_kendaraan'); ?></span>
								</div>
							</div>
							<button type="submit" class="btn btn-primary waves-effect waves-light">Simpan Perubahan</button>
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
	function limitKeypress(event, value, maxLength) {
		if (value != undefined && value.toString().length >= maxLength) {
			event.preventDefault();
		}
	}
</script>
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
