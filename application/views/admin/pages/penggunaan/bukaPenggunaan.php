<div class="content-page">
	<div class="content">

		<!-- Start Content-->
		<div class="container-fluid">

			<!-- form action="<?= base_url('admin/penggunaan/input_data_penggunaan') ?>" enctype="multipart/form-data" method="post"> -->
			<div class="container-fluid">
				<!-- Illustrations -->

				<div class="card-header py-3">
					<h4 class="page-title">Data Pengeluaran <?php echo $penggunaan[0]->nama_kebutuhan; ?></h6>
				</div>
				<div class="card shadow mb-4">
					<div class="card-body">
						<div class="text-center">
							<form>
								<div class="form-group row">
									<label style="text-align: left" class="col-sm-2 col-form-label">Nama Kebutuhan</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" name="nama_kebutuhan" required="" value="<?php echo $penggunaan[0]->nama_kebutuhan; ?>" readonly>
									</div>
								</div>
								<div class="form-group row">
									<label style="text-align: left" class="col-sm-2 col-form-label">Jumlah Pengeluaran</label>
									<div class="col-sm-10">
										<input type="number" name="jumlah_pengeluaran" class="form-control" required="" value="<?php echo number_format($penggunaan[0]->jumlah_pengeluaran,0,',','.');  ?>" readonly>
									</div>
								</div>
								<div class="form-group row">
									<label style="text-align: left" class="col-sm-2 col-form-label">Tanggal Pengeluaran</label>
									<div class="col-sm-10">
										<input type="date" class="form-control" name="tanggal_penggunaan" required="" value="<?php echo $penggunaan[0]->tanggal_penggunaan; ?>" readonly>
									</div>
								</div>
								<div class="form-group row">
									<label style="text-align: left" class="col-sm-2 col-form-label">Bukti Pengeluaran</label>
									<div class="col-sm-10">
										<img src="<?= base_url($penggunaan[0]->bukti_pengeluaran); ?>" style="height: 70%; width: 50%;">
									</div>
								</div>
								<div class="form-group row">
									<label style="text-align: left" class="col-sm-2 col-form-label">Keterangan</label>
									<div class="col-sm-10">
										<textarea class="form-control" rows="10" name="keterangan" required readonly><?php echo $penggunaan[0]->keterangan; ?></textarea>
									</div>
								</div>
								<!-- <div style="text-align: center" class="col-sm-12">
									<a href="<?php echo base_url('admin/penggunaan/') ?>" style="text-decoration: none;"><button class="btn btn-primary" type="button">Kembali</button></a>
								</div>
								<!-- -->      </form> -->
						</div>
					</div>
				</div>
			</div>
			</form>
