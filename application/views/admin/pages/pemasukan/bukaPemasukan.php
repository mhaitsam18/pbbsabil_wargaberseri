<div class="content-page">
	<div class="content">

		<!-- Start Content-->
		<div class="container-fluid">

			<!-- form action="<?= base_url('pemasukan/input_data_pemasukan') ?>" enctype="multipart/form-data" method="post"> -->
			<div class="container-fluid">
				<!-- Illustrations -->
				<div class="card shadow mb-4">
					<div class="card-header py-3">
						<h4 class="page-title">Data pemasukan <?php echo $pemasukan[0]->nama_pemasukan; ?></h6>
					</div>
					<div class="card-body">
						<div class="text-center">
							<form>
								<div class="form-group row">
									<label style="text-align: left" class="col-sm-2 col-form-label">Nama pemasukan</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" name="nama_pemasukan" required="" value="<?php echo $pemasukan[0]->nama_pemasukan; ?>" readonly>
									</div>
								</div>
								<div class="form-group row">
									<label style="text-align: left" class="col-sm-2 col-form-label">Jumlah Pengeluaran</label>
									<div class="col-sm-10">
										<input type="number" name="jumlah_pemasukan" class="form-control" required="" value="<?php echo number_format($pemasukan[0]->jumlah_pemasukan,0,',','.');; ?>" readonly>
									</div>
								</div>
								<div class="form-group row">
									<label style="text-align: left" class="col-sm-2 col-form-label">Tanggal pemasukan</label>
									<div class="col-sm-10">
										<input type="input" class="form-control" name="tanggal_pemasukan" required="" value="<?php echo $pemasukan[0]->tanggal_pemasukan; ?>" readonly>
									</div>
								</div>
								<div class="form-group row">
									<label style="text-align: left" class="col-sm-2 col-form-label">Bukti pemasukan</label>
									<div class="col-sm-10">
										<img src="<?= base_url($pemasukan[0]->bukti_pemasukan); ?>" style="height: 70%; width: 50%;">
									</div>
								</div>
								<div class="form-group row">
									<label style="text-align: left" class="col-sm-2 col-form-label">Keterangan</label>
									<div class="col-sm-10">
										<textarea class="form-control" rows="10" name="keterangan" required readonly><?php echo $pemasukan[0]->keterangan; ?></textarea>
									</div>
								</div>
								<!-- <div style="text-align: center" class="col-sm-12">
									<a href="<?php echo base_url('pemasukan/') ?>" style="text-decoration: none;"><button class="btn btn-primary" type="button">Kembali</button></a>
								 --></div>
								<!--      </form> -->
						</div>
					</div>
				</div>
			</div>
			</form>
