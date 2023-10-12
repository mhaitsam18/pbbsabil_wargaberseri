<div class="content-page">
	<div class="content">

		<!-- Start Content-->
		<div class="container-fluid">

			<form action="<?= base_url('admin/aspirasi/update_status_aspirasi') ?>" enctype="multipart/form-data" method="post">
				<div class="container-fluid">
					<!-- Illustrations -->
					<div class="card shadow mb-4">
						<div class="card-header py-3">
							<h4 class="m-0 font-weight-bold text-primary">Detail Aspirasi Warga</h6>
						</div>
						<div class="card-body">
							<div class="text-center">

								<div class="form-group row">
									<label style="text-align: left" class="col-sm-2 col-form-label">No Tiket</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" name="no_tiket" value="<?php echo $aspirasi_masuk[0]->no_tiket; ?>" readonly>
									</div>
								</div>
								<div class="form-group row">
									<label style="text-align: left" class="col-sm-2 col-form-label">Nama Warga</label>
									<div class="col-sm-10">
										<input type="text" name="nama" class="form-control" value="<?php echo $aspirasi_masuk[0]->nama_warga; ?>" readonly>

									</div>
								</div>
								<div class="form-group row">
									<label style="text-align: left" class="col-sm-2 col-form-label">Id Warga</label>
									<div class="col-sm-10">
										<input type="text" name="id_warga" class="form-control" value="<?php echo $aspirasi_masuk[0]->id_detail_warga; ?>" readonly>
									</div>
								</div>
								<div class="form-group row">
									<label style="text-align: left" class="col-sm-2 col-form-label">Tanggal Aspirasi</label>
									<div class="col-sm-10">
										<input type="date" class="form-control" name="tanggal_pembayaran" required="" value="<?php echo $aspirasi_masuk[0]->tanggal_aspirasi ?>" readonly>
									</div>
								</div>
								<div class="form-group row">
									<label style="text-align: left" class="col-sm-2 col-form-label">Jenis Aspirasi</label>
									<div class="col-sm-10">
										<input type="text" name="jenis_aspirasi" class="form-control" value="<?php echo $aspirasi_masuk[0]->jenis_aspirasi; ?>" readonly>
									</div>
								</div>

								<div class="form-group row">
									<label style="text-align: left" class="col-sm-2 col-form-label">Aspirasi</label>
									<div class="col-sm-10">
										<textarea class="form-control" readonly="" name="aspirasi"><?php echo $aspirasi_masuk[0]->aspirasi; ?></textarea>
									</div>
								</div>

								<div class="form-group row">
									<label style="text-align: left" class="col-sm-2 col-form-label">Status Aspirasi</label>
									<div class="col-sm-10">
										<select class="form-control" name="status_aspirasi">
											<option value="<?php echo $aspirasi_masuk[0]->status_aspirasi; ?>">
												<?php echo $aspirasi_masuk[0]->status_aspirasi; ?>
											</option>
											<option>-</option>
											<option value="ASPIRASI DITOLAK">ASPIRASI DITOLAK</option>
											<option value="ASPIRASI DITERIMA">ASPIRASI DITERIMA</option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label style="text-align: left" class="col-sm-2 col-form-label">Respon Apirasi</label>
									<div class="col-sm-10">
										<textarea class="form-control" name="respon_aspirasi"></textarea>
									</div>
								</div>
								<div style="text-align: right" class="col-sm-12">
									<button class="btn btn-primary">Simpan</button>
								</div>
			</form>
		</div>
	</div>
</div>
</div>
</form>
