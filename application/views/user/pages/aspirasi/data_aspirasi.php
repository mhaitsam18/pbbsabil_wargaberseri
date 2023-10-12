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

	<!-- Begin Page Content -->
	<div class="container-fluid">


		<!-- DataTales Example -->
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<?php
				$data_warga = $this->session->all_userdata();
				?>
				<h6 class="m-0 font-weight-bold text-primary">Daftar Aspirasi <?php echo $data_warga['nama_warga']; ?></h6>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>No</th>
								<th>No Tiket</th>
								<th>Tanggal Aspirasi</th>
								<th>Jenis Aspirasi</th>
								<th>Status Aspirasi</th>
								<th>Aksi</th>

							</tr>
						</thead>
						<tbody>
							<?php
							$no = 1;
							foreach ($aspirasi as $data_aspirasi) { ?>
								<tr>
									<th><?php echo $no++; ?></th>
									<th> <?php echo $data_aspirasi->no_tiket; ?></th>
									<th><?php $tanggal =  strtotime($data_aspirasi->tanggal_aspirasi);
										echo date('d-M-Y', $tanggal); ?></th>
									<th><?php echo $data_aspirasi->jenis_aspirasi; ?></th>
									<th> <?php echo $data_aspirasi->status_aspirasi ?></th>
									<th>
										<center>
											<a href="<?php echo base_url('user/aspirasi/infoAspirasi/' . $data_aspirasi->no_tiket) ?>">
												<button class="btn btn-primary">Detail<i class="fa fa-info"></i></button>
											</a>
											&nbsp;
											<a href="<?php echo base_url('user/aspirasi/hapusAspirasi/' . $data_aspirasi->no_tiket) ?>">
												<button class="btn btn-danger">Hapus<i class="fa fa-info"></i></button>
											</a>
											&nbsp;
										</center>
									</th>
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
