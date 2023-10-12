<link href="<?php echo base_url(); ?>assets/user/css/tambahdataPenggunaan.css" rel="stylesheet">
<link href="https://code.jquery.com/ui/1.9.2/themes/smoothness/jquery-ui.css" rel="stylesheet">

<div class="main-wrapper">

	<section class="page-title bg-2">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 text-center">
					<ul class="list-inline mb-0">
						<li class="list-inline-item"><a href="index.html" class="text-sm letter-spacing text-white text-uppercase font-weight-bold">Home</a></li>
						<li class="list-inline-item"><span class="text-white">|</span></li>
						<li class="list-inline-item"><a href="#" class="text-color text-uppercase text-sm letter-spacing">Iuran Warga</a></li>
					</ul>
					<h1 class="text-lg text-white mt-2">Pembayaran Iuran Warga</h1>
				</div>
			</div>
		</div>
	</section>
	<div class="container-fluid">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				Form Pembayaran Iuran</h6>
			</div>
			<div class="card-body">
				<div class="container">

					<form action="<?php echo base_url(); ?>user/iuran/input_data_pembayaran" method="POST" enctype="multipart/form-data">

						<?php $warga = $this->session->all_userdata(); ?>

						<?php foreach ($iuran as $bayar) { ?>

							<label for="nama">No Tagihan</label>
							<input type="text" id="fname" name="no_tagihan" value="<?php echo $bayar->no_tagihan; ?>" readonly>
							<label for="nama">Nama Penghuni</label>
							<input type="text" id="fname" name="nama_warga" value="<?php echo $warga['nama_warga']; ?>" readonly>
							<input type="hidden" name="id_detail_warga" value="<?php echo $warga['id_detail_warga']; ?>">
							<br><br>
							<label for="pembayaran">Nominal</label>
							<br>
							<input type="text" name="nominal" value="<?php echo $bayar->nominal; ?>" required>
							<br><br>
							<label for="pembayaran">Tanggal Pembayaran</label>
							<br>
							<input type="text" name="tanggal_pembayaran" id="datepicker" required>
							<br><br>
							<!-- <label for="pembayaran">Pembayaran</label>
							<br>
							<input type="text" name="pembayaran" readonly value="Transfer">
							<br><br>-->
							<label for="bukti">Bukti Pembayaran</label>
							<br>
							<input id="bukti" type="file" name="bukti_pembayaran" required="">
							<br><br>
							<input type="submit" value="Kirim">

					</form>
				<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(function() {
		$("#datepicker").datepicker({
			maxDate: "D"
		});
	});
</script>
