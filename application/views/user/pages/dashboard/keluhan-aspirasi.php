<div class="main-wrapper ">
	<section class="page-title bg-2">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 text-center">
					<ul class="list-inline mb-0">
						<li class="list-inline-item"><a href="index.html" class="text-sm letter-spacing text-white text-uppercase font-weight-bold">Home</a></li>
						<li class="list-inline-item"><span class="text-white">|</span></li>
						<li class="list-inline-item"><a href="#" class="text-color text-uppercase text-sm letter-spacing">About us</a></li>
					</ul>
					<h1 class="text-lg text-white mt-2">Keluhan dan Aspirasi</h1>
				</div>
			</div>
		</div>
	</section>
</div>

<div class=container>
	<div class="card mt-4">
		<div class="card-header">
			Keluhan dan Aspirasi
		</div>
		<div class="card-body">
			<?= $this->session->flashdata('message'); ?>
			<form action="<?= base_url('Home/insertKeluhanAspirasi'); ?>" method="POST" enctype="multipart/form-data">
				<h5 class="card-title">Keluhan dan Aspirasi</h5>
				<div class="form-group">
					<label for="nama">Nama</label>
					<input type="text" class="form-control" id="nama_aspirasi" name="nama" placeholder="Nama" value="<?= set_value('nama') ?>">
					<?= form_error('nama', '<small class="text-danger pl-3">', '</small>') ?>
				</div>
				<div class="form-group">
					<label for="no_wa">Nomor WA</label>
					<input type="number" class="form-control" id="no_wa_aspirasi" name="no_wa" placeholder="Nomor WhatsApp" value="<?= set_value('no_wa') ?>">
					<?= form_error('no_wa', '<small class="text-danger pl-3">', '</small>') ?>
				</div>
				<div class="form-group">
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="jenis" id="keluhan" value="Keluhan">
						<label class="form-check-label" for="keluhan">Keluhan</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="jenis" id="aspirasi" value="Aspirasi">
						<label class="form-check-label" for="aspirasi">Aspirasi</label>
					</div>
					<?= form_error('jenis', '<small class="text-danger pl-3">', '</small>') ?>
				</div>
				<div class="form-group">
					<select class="form-control" name="jenis_pesan" id="jenis_pesan" value="<?= set_value('jenis_pesan') ?>">
						<option value="" disabled selected>Jenis Keluhan</option>
						<option value="kebersihan">Kebersihan</option>
						<option value="keamanan">Keamanan</option>
						<option value="fasilitas">Fasilitas</option>
						<option value="olahraga">Olahraga</option>
					</select>
					<?= form_error('jenis_pesan', '<small class="text-danger pl-3">', '</small>') ?>
				</div>
				<div class="form-group">
					<label for="isi">Isi</label>
					<textarea class="form-control" id="isi" name="isi" placeholder="Isi" value="<?= set_value('isi') ?>"></textarea>
					<?= form_error('isi', '<small class="text-danger pl-3">', '</small>') ?>
				</div>
				<div class="form-group">
					<label for="bukti">Upload Bukti</label>
					<input type="file" class="form-control" id="bukti" name="bukti">
				</div>
				<button type="submit" class="btn btn-primary float-right">Kirim</button>
			</form>
		</div>
	</div>
</div>
