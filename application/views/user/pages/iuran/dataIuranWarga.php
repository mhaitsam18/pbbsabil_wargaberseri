<div class="main-wrapper">

	<section class="page-title bg-2">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 text-center">
					<ul class="list-inline mb-0">
						<li class="list-inline-item"><a href="<?php echo base_url(); ?>user/" class="text-sm letter-spacing text-white text-uppercase font-weight-bold">Home</a></li>
						<li class="list-inline-item"><span class="text-white">|</span></li>
						<li class="list-inline-item"><a href="#" class="text-color text-uppercase text-sm letter-spacing">Iuran Warga</a></li>
					</ul>
					<h1 class="text-lg text-white mt-2">Data Tagihan Iuran</h1>
				</div>
			</div>
		</div>
	</section>

	<!-- Begin Page Content -->
	<div class="container-fluid">
		<?php $warga = $this->session->all_userdata(); ?>

		<!-- DataTales Example -->
		<div class="container">
			<div class="table-responsive">
				<div class="card mt-4">
					<div class="card-header">Data Iuran <?php echo $warga['nama_warga']; ?><?php echo  " | " . $warga['id_warga']; ?>
					</div>

					<div class="card-body">
						<table class="table" id="dataTable" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th>No</th>
									<th>No Tagihan</th>
									<th>Bulan</th>
									<th>Tahun</th>
									<th>Nama Kepala Keluarga</th>
									<th>Status Iuran</th>
									<th>Jenis</th>
									<th>Tagihan</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no = 1;

								foreach ($iuran as $pengguna) {
								?>
											
									<tr>
										<th><?php echo $no++; ?></th>
										<th><?php echo $pengguna->no_tagihan; ?></th>
										<th><?php echo $pengguna->bulan_iuran; ?></th>
										<th><?php echo $pengguna->tahun_iuran; ?></th>
										<th><?php echo $pengguna->nama; ?></th>
										<th><?php if ($pengguna->status_iuran == "Ditolak") {
											?> <button class="btn btn-danger">Ditolak</button>
										 <?php }elseif ($pengguna->status_iuran == "Belum Diverifikasi") {
											?> <button class="btn btn-warning btn-sm">Belum Diverifikasi</button><?php }else{ 
										 	echo $pengguna->status_iuran;
										 } ?> </th>
										<th><?php echo $pengguna->jenis; ?></th>
										<th><?php echo number_format($pengguna->nominal, 0, '', '.'); ?></th>
										<?php if ($pengguna->status_iuran == "Belum Diverifikasi") : ?>
											<th>Sudah Bayar</th>
										<?php endif; ?>
										<?php if ($pengguna->status_iuran == "Belum Lunas" || $pengguna->status_iuran == "Ditolak") : ?>
											<th>
												<a href="<?php echo base_url(); ?>user/iuran/tambah_data_pembayaran/<?php echo $pengguna->no_tagihan; ?>">
													<button class="btn btn-primary">Bayar</button>
												</a>
											</th>
										<?php endif; ?>
									</tr>
								<?php } ?>
							</tbody>
						</table>
						<div class="right">
							<b>
								<?php 
								if (empty($iuran)) {
									echo  "Total Tagihan Rp. 0"; 
								}else{
								$tagihan = $nominal[0]->tagihan;
								echo  "Total Tagihan Rp. " . number_format($tagihan, 0, '', '.'); 
								}  ?>
							</b> 
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
