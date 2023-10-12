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
					<h1 class="text-lg text-white mt-2">Riwayat Pembayaran Iuran</h1>
				</div>
			</div>
		</div>
	</section>

	<!-- Begin Page Content -->
	<div class="container-fluid">
		<!-- DataTales Example -->
		<div class="container">
			<div class="table-responsive">
				<div class="card mt-4">
					<div class="card-header"> Riwayat Pembayaran Iuran</div>
				</div>


				<div class="card-body">
					<table class="table" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>No</th>
								<th>No Tagihan</th>

								<th>Bulan Iuran</th>
								<th>Tahun Iuran</th>
								<th>Tanggal Pembayaran</th>
								<th>Jenis</th>
								<th>Status</th>
								<!--<th>Aksi</th>-->
							</tr>
						</thead>
						<tbody>
							<?php
							$no = 1;
							foreach ($iuran as $iuran_warga) { ?>
								<tr>
									<th><?php echo $no++; ?></th>
									<th> <?php echo $iuran_warga->no_tagihan; ?></th>
									<!--<th><?php echo $admin[0]->username_admin; ?></th>-->
									<th><?php echo $iuran_warga->bulan_iuran; ?></th>
									<th><?php echo $iuran_warga->tahun_iuran; ?></th>
									<th><?php $tanggal =  strtotime($iuran_warga->tanggal_pembayaran);
										echo date('d-M-Y', $tanggal); ?></th>
										<th> <?php echo $iuran_warga->jenis; ?></th>
									<th><a href="<?= base_url('user/iuran/download_bukti_pembayaran/' . $iuran_warga->no_tagihan) ?>">
														<button class="btn btn-success btn-sm">
															<i class="fas fa-download"></i><?php echo " ". $iuran_warga->status_iuran; ?>
														</button>
													</a>
													<!--<button type="submit" class="btn btn-success"> 
									<?php echo $iuran_warga->status_iuran; ?></button></th>-->
								</tr>
								<!-- <th>Cetak Bukti Pembayaran</th> -->
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>


	</div>
	<!-- /.container-fluid -->

</div>

<!-- End of Main Content -->
