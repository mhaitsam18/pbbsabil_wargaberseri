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
			<?php
			if ($warga) {
				$nama = $warga->nama_warga;
				$nomor = $warga->no_hp;
			} else{
				$nama = set_value('nama');
				$nomor = set_value('no_wa');
			}
			 ?>
			<div class="wrapper mb-4">
				<form action="<?= base_url('user/aspirasi/input_data_aspirasi'); ?>" method="POST" enctype="multipart/form-data">
					<h5 class="card-title">Keluhan dan Aspirasi</h5>
					<div class="form-group">
						<label for="nama">Nama</label>
						<input type="text" class="form-control" id="nama_aspirasi" name="nama" placeholder="Nama" value="<?= $nama ?>" readonly>
						<?= form_error('nama', '<small class="text-danger pl-3">', '</small>') ?>
					</div>
					<div class="form-group">
						<label for="no_wa">Nomor WA</label>
						<input type="number" class="form-control" id="no_wa_aspirasi" name="no_wa" placeholder="Nomor WhatsApp" value="<?= $nomor ?>" readonly>
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
							<option value="" disabled selected>Jenis Keluhan atau Aspirasi</option>
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
	<div class="card mt-4">
		<div class="card-header">
			Data Keluhan dan Aspirasi
		</div>
		<div class="card-body">
			<?php if ($warga): ?>
				<div class="mb-4">
					<h4 class="card-title">Data Aspirasi Anda</h4>
					<table class="table table-hover">
						<thead>
							<tr>
								<th scope="col">No.</th>
								<th scope="col">Jenis aspirasi</th>
								<th scope="col">aspirasi</th>
								<th scope="col">Bukti</th>
								<th scope="col">Waktu Kirim</th>
								<th scope="col">Status</th>
								<th scope="col">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php $n = 1; 
							foreach ($aspirasi as $a): ?>
							<tr>
								<th><?= $n++; ?></th>
								<td><?= $a->jenis_aspirasi ?></td>
								<td><?= $a->aspirasi ?></td>
								<td><img src="<?= base_url("uploads/keluhan-aspirasi/$a->bukti") ?>" class="img-thumbnail" style="height: 100px; width: 100px;"></td>
								<td><?= $a->waktu_kirim ?></td>
								<td><?= $a->status ?></td>
								<td><a href="<?= base_url('User/Aspirasi/bersihkanAspirasi/'.$k->id) ?>" class="btn btn-danger btn-sm tombol-hapus">Hapus</a></td>
							</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
				<div class="mb-4">
					<h4 class="card-title">Data Keluhan Anda</h4>
					<table class="table table-hover">
						<thead>
							<tr>
								<th scope="col">No.</th>
								<th scope="col">Jenis keluhan</th>
								<th scope="col">keluhan</th>
								<th scope="col">Bukti</th>
								<th scope="col">Waktu Kirim</th>
								<th scope="col">Status</th>
								<th scope="col">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php $n = 1; 
							foreach ($keluhan as $k): ?>
							<tr>
								<th><?= $n++; ?></th>
								<td><?= $k->jenis_keluhan ?></td>
								<td><?= $k->keluhan ?></td>
								<td><img src="<?= base_url("uploads/keluhan-aspirasi/$k->bukti") ?>" class="img-thumbnail" style="height: 100px; width: 100px;"></td>
								<td><?= $k->waktu_kirim ?></td>
								<td><?= $k->status ?></td>
								<td><a href="<?= base_url('User/Aspirasi/bersihkanKeluhan/'.$k->id) ?>" class="btn btn-danger btn-sm tombol-hapus">Hapus</a></td>
							</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			<?php endif ?>
		</div>
	</div>
</div>




















































































<!-- <link href="<?php echo base_url(); ?>assets/user/css/tambahdataPenggunaan.css" rel="stylesheet">
<div class="main-wrapper">

	<section class="page-title bg-2">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 text-center">
					<ul class="list-inline mb-0">
						<li class="list-inline-item"><a href="index.html" class="text-sm letter-spacing text-white text-uppercase font-weight-bold">Home</a></li>
						<li class="list-inline-item"><span class="text-white">|</span></li>
						<li class="list-inline-item"><a href="#" class="text-color text-uppercase text-sm letter-spacing">Pendataan Warga</a></li>
					</ul>
					<h1 class="text-lg text-white mt-2">Aspirasi Warga</h1>
				</div>
			</div>
		</div>
	</section>

	<div class="container-fluid">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Form Input Aspirasi</h6>
			</div>
			<div class="card-body">
				<div class="container">
					<form action="<?php echo base_url(); ?>user/aspirasi/input_data_aspirasi" method="POST" enctype="multipart/form-data">

						<?php $warga = $this->session->all_userdata(); ?>

						<label for="nama">No Tiket</label>
						<input type="text" id="fname" name="no_tiket" value="<?php echo 'T' . date('dmYhis'); ?>" readonly>
						<label for="nama">Tanggal Input</label><br>
						<input type="date" name="tanggal_aspirasi" required="" value="<?php echo $data_warga[0]->tanggal_sekarang; ?>" readonly>
						<br>
						<label for="nama">Nama Warga</label>
						<input type="text" id="fname" name="nama_warga" value="<?php echo $warga['nama_warga']; ?>" readonly>
						<input type="hidden" name="id_detail_warga" value="<?php echo $warga['id_detail_warga']; ?>">
						<br>
						<label for="pembayaran">Jenis Aspirasi</label>
						<br>
						<select name="jenis_aspirasi">
							<option>-</option>
							<option value="Aspirasi">Aspirasi</option>
							<option value="Komplain Keamanan">Komplain Keamanan</option>
							<option value="Komplain Kebersihan">Komplain Kebersihan</option>
						</select>
						<br><br>
						<label for="pembayaran">Aspirasi</label>
						<br>
						<textarea name="aspirasi" required="" rows="7"></textarea>
						<br><br>
						<br><br>
						<input type="submit" value="Kirim">
					</form>
				</div>
			</div>
		</div>
	</div>
</div> -->
