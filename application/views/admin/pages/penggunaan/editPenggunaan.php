<link href="https://code.jquery.com/ui/1.9.2/themes/smoothness/jquery-ui.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
<script>
	$(function() {
		$("#datepicker").datepicker({
			maxDate: "D"
		});
	});
</script>
<div class="content-page">
	<div class="content">

		<!-- Start Content-->
		<div class="container-fluid">
			<form method="POST" enctype="multipart/form-data" action="<?php echo base_url('admin/penggunaan/update_data_penggunaan/') . $penggunaan[0]->id_penggunaan; ?>">

				<div class="container-fluid">
					<!-- Illustrations -->
					<div class="card shadow mb-4">
						<div class="card-header py-3">
							<h4 class="page-title">Form Edit Data Pengeluaran</h6>
						</div>
						<div class="card-body">
							<div class="text-center">
								<font color="red"><b>
										<?php if (!empty($this->session->flashdata('error'))) {
											echo $this->session->flashdata('error');
										} ?></b></font>


								<input type="hidden" name="jumlah_pengeluaran_awal" value="<?php echo $penggunaan[0]->jumlah_pengeluaran; ?>">
								<div class="form-group row">
									<label style="text-align: left" class="col-sm-2 col-form-label">Nama Kebutuhan</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" name="nama_kebutuhan" required="" value="<?php echo $penggunaan[0]->nama_kebutuhan; ?>">
									</div>
								</div>
								<div class="form-group row">
									<label style="text-align: left" class="col-sm-2 col-form-label">Jumlah Pengeluaran</label>
									<div class="col-sm-10">
										<input type="number" name="jumlah_pengeluaran" class="form-control" required="" value="<?php echo $penggunaan[0]->jumlah_pengeluaran; ?>">
									</div>
								</div>
								<div class="form-group row">
									<label style="text-align: left" class="col-sm-2 col-form-label">Tanggal Pengeluaran</label>
									<div class="col-sm-10">
										<input type="text" id="datepicker" class="form-control" name="tanggal_penggunaan" required value="<?php echo $penggunaan[0]->tanggal_penggunaan; ?>">
									</div>
								</div>
								<div class="form-group row">
									<label style="text-align: left" class="col-sm-2 col-form-label">Bukti Pengeluaran </label>
									<div class="col-sm-5">
										<a href="<?= base_url($penggunaan[0]->bukti_pengeluaran); ?>" target="_blank">
											<img src="<?= base_url($penggunaan[0]->bukti_pengeluaran); ?>" style="height: 70%; width: 50%; float: left;"></a>
									</div>
								</div>
								<div class="form-group row">
									<label style="text-align: left" class="col-sm-2 col-form-label">Bukti Pengeluaran Baru</label>
									<div class="col-sm-10">
										<input type="file" class="form-control-file" name="bukti_pengeluaran">
									</div>
								</div>
								<div class="form-group row">
									<label style="text-align: left" class="col-sm-2 col-form-label">Keterangan</label>
									<div class="col-sm-10">
										<textarea class="form-control" rows="10" name="keterangan" required=""><?php echo $penggunaan[0]->keterangan; ?></textarea>
									</div>
								</div>
								<div style="text-align: right" class="col-sm-12">
									<button class="btn btn-primary">Ubah</button>
								</div>
			</form>
		</div>
	</div>
</div>
</div>
</form>
