<link href="<?php echo base_url(); ?>assets/user/css/tambahdataPenggunaan.css" rel="stylesheet">
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
					<h1 class="text-lg text-white mt-2">Info Aspirasi Warga</h1>
				</div>
			</div>
		</div>
	</section>
	<div class="container-fluid">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Form Detail Aspirasi Warga</h6>
			</div>
			<div class="card-body">
				<div class="container">


					<?php foreach ($aspirasi as $data_aspirasi) : ?>


						<label for="nama">No Tiket</label>
						<input type="text" id="fname" name="no_tiket" value="<?php echo $data_aspirasi->no_tiket; ?>" readonly>
						<label for="nama">Tanggal Input</label><br>
						<input type="date" name="tanggal_aspirasi" required="" value="<?php echo $data_aspirasi->tanggal_aspirasi; ?>" readonly>
						<br>
						<label for="nama">Nama Warga</label>
						<?php $warga = $this->session->all_userdata(); ?>
						<input type="text" id="fname" name="nama" value="<?php echo $warga['nama_warga']; ?>" readonly>
						<input type="hidden" name="id_detail_warga" value="<?php echo $warga['id_detail_warga']; ?>">
						<br>
						<label for="pembayaran">Jenis Aspirasi</label>
						<br>
						<select name="jenis_aspirasi">
							<option value="<?php echo $data_aspirasi->jenis_aspirasi; ?>"><?php echo $data_aspirasi->jenis_aspirasi; ?></option>
							<option>-</option>
							<option value="Aspirasi">Aspirasi</option>
							<option value="Komplain Keamanan">Komplain Keamanan</option>
							<option value="Komplain Kebersihan">Komplain Kebersihan</option>
						</select>
						<br><br>
						<label for="pembayaran">Aspirasi</label>
						<br>
						<textarea name="aspirasi" required="" rows="7"><?php echo $data_aspirasi->aspirasi; ?></textarea>
						<br>
						<label for="nama">Status Aspirasi</label>
						<input type="text" id="fname" name="nama" value="<?php echo $data_aspirasi->status_aspirasi; ?>" readonly>
						<br>
						<?php if ($data_aspirasi->respon_aspirasi != "") : ?>
							<label for="pembayaran">Respon Aspirasi</label>
							<br>
							<textarea name="aspirasi" required="" rows="7" readonly=""><?php echo $data_aspirasi->respon_aspirasi; ?></textarea>
						<?php endif; ?>
						<br>
						<a href="<?php echo base_url(); ?>user/aspirasi/data_aspirasi_warga"><button class="btn btn-primary">Kembali</button></a>
					<?php endforeach ?>

				</div>
			</div>
		</div>
	</div>
</div>
