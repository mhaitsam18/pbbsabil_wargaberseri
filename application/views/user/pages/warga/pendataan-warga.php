<style>
	.btn-main {
		color: white;
	}

	.button-tambah .btn {
		padding: 18px 35px;
	}

	.btn {
		padding: .375rem .75rem;
	}
</style>

<!-- START Modal Lihat File KK -->
<div class="modal fade overflow-auto" id="openImageKK" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Foto Kartu Keluarga</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
			</div>
			<div class="modal-body">
				<div class="form-group d-flex justify-content-center">
					<img src="<?php echo base_url('uploads/kk/' . $warga->file_kk) ?>" alt="..." class="img-thumbnail mb-2">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>
<!-- END Modal Lihat File KK -->

<div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
<?php unset($_SESSION['flash']); ?>

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
					<h1 class="text-lg text-white mt-2">Pendataan Warga</h1>
				</div>
			</div>
		</div>
	</section>

	<div class="container-fluid">
		<!-- Row Data Keluarga -->
		<div class="row mt-4">
			<div class="col-md-6 ml-4 my-4">
				<!-- START Tabel Detail Keluarga -->
				<div class="table-responsive" style="overflow-y: auto;">
					<table class="table table-striped table-hover table-md">
						<thead>
							<tr>
								<td class="font-weight-bold" scope="col" width="50%">
									Data Keluarga
								</td>
								<td>
								</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>No Rumah</td>
								<td><?= $warga->no_rumah ?></td>
							</tr>
							<tr>
								<td>No KK</td>
								<td><?= $warga->no_kk ?></td>
							</tr>
							<tr>
								<td>Alamat</td>
								<td><?= $warga->alamat ?></td>
							</tr>
							<tr>
								<td>Rt / Rw</td>
								<td><?= $warga->rt ?> / <?= $warga->rw ?></td>
							</tr>
							<tr>
								<td>Jumlah Keluarga</td>
								<td><?= $warga->jumlah_keluarga ?> Anggota Keluarga</td>
							</tr>
							<tr>
								<td>Status Tempat Tinggal</td>
								<td><?= $warga->status_rumah ?></td>
							</tr>
							<tr>
								<td>Status Rumah Tangga</td>
								<td><?= $warga->status_rumah_tangga ?></td>
							</tr>
							<tr>
								<td>Foto KK</td>
								<td>
									<button class="btn btn-primary btn-sm btn-edit" data-toggle="modal" data-target="#openImageKK">
										<i class=" fas fa-eye"></i>
									</button>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<!-- END Tabel Detail Keluarga -->
			</div>
			<div class="col-md-5 text-center my-4 ml-4 d-flex flex-column justify-content-center">
				<div>
					<h3>
						<div class="tooltip-icon"><i class="fa fa-check"></i></div>
						Data Sudah Terverifikasi
					</h3>
				</div>
				<div>
					<p style="font-weight: 900;">Silahkan edit data jika ada kesalahan saat penginputan oleh admin</p>
				</div>
				<div class="button-tambah">
					<a href="<?= base_url('user/warga/info_warga/' . $warga->id_warga) ?>">
						<button class="btn btn-main" style="width: 200px;">Edit Data</button>
					</a>
				</div>
			</div>
		</div>
		<!-- Row Data Keluarga -->

		<!-- START Tabel Anggota Keluarga -->
		<?php if ($this->session->status == "Kepala Keluarga") : ?>
			<?php if ($jumlah_hunian >= $warga->jumlah_keluarga) { ?>
				<div class="row ml-4 mt-5">
					<button type="button" class="btn btn btn-primary" id="tambah">
						<i class=" fas fa-plus mr-2"></i>
						Tambah Anggota Hunian
					</button>
				</div>
			<?php } else { ?>
				<div class="row ml-4 mt-5 ">
					<a href="<?= base_url('user/warga/tambah_hunian') ?>">
						<button type="button" class="btn btn-primary">
							<i class=" fas fa-plus mr-2"></i>
							Tambah Anggota Hunian
						</button>
					</a>
				</div>
			<?php	} ?>
		<?php endif ?>
		<div class="row justify-content-center">
			<div class="col-md-12 ml-4 my-4">
				<div class="card">
					<div class="card-header font-weight-bold text-dark">
						Anggota Hunian
					</div>
					<div class="card-body">
						<div class="table-responsive " style="overflow-y: auto;">
							<table class="table table-striped table-hover table-sm table-bordered">
								<thead class="font-weight-bold text-dark">
									<tr>
										<td>No</td>
										<td>Nama Lengkap</td>
										<td>Nik</td>
										<td>Status</td>
										<td>No Hp</td>
										<td>File Ktp</td>
										<td>Status Verfikasi</td>
										<?php if ($this->session->status == "Kepala Keluarga") : ?>
											<td>Aksi</td>
										<?php endif; ?>
									</tr>
								</thead>
								<tbody>
									<?php $no = 1;
									foreach ($pendataan_warga as $warga) : ?>
										<tr>
											<td><?= $no++ ?>.</td>
											<td><?= $warga->nama_warga ?></td>
											<td><?= $warga->nik ?></td>
											<td><?= $warga->status ?></td>
											<td><?= $warga->no_hp ?></td>
											<td class="d-flex justify-content-center">
												<button class="btn btn-primary btn-sm btn-edit" data-toggle="modal" data-target="#exampleModalCenter<?= $warga->id_detail_warga ?>">
													<i class="fas fa-eye"></i>
												</button>
											</td>
											<td>
												<center>
													<?php if ($warga->status_verifikasi == "1") : ?>
														<span class="badge badge-warning">Belum Terverifikasi</span>
													<?php else : ?>
														<span class="badge badge-success">Terverifikasi</span>
													<?php endif; ?>
												</center>
											</td>
											<td>
												<center>
													<a href="<?= base_url('user/warga/detail_hunian/' . $warga->id_detail_warga) ?>">
														<button class="btn btn-primary btn-sm"><i class="fas fa-info px-1"></i></button>
													</a>
													<?php if ($this->session->status == "Kepala Keluarga") : ?>
														<a href="<?= base_url('user/warga/info_hunian/' . $warga->id_detail_warga) ?>">
															<button class="btn btn-warning btn-sm text-white"><i class="fa fa-edit"></i></button>
														</a>
														<?php if ($this->session->status != $warga->status) : ?>
															<a href="<?= base_url('user/warga/hapus_hunian/' . $warga->id_detail_warga) ?>" class="hapus">
																<button class="btn btn-danger btn-sm btn-delete"><i class="fa fa-trash"></i></button>
															</a>
														<?php endif; ?>
													<?php endif; ?>
												</center>
											</td>
										</tr>
										<!-- START Modal Lihat File KTP -->
										<div class="modal fade overflow-auto" id="exampleModalCenter<?= $warga->id_detail_warga ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLabel">Foto Ktp</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
													</div>
													<div class="modal-body">
														<div class="form-group d-flex justify-content-center">
															<img src="<?php echo base_url('uploads/ktp/' . $warga->file_ktp) ?>" alt="..." class="img-thumbnail mb-2">
														</div>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
													</div>
												</div>
											</div>
										</div>
										<!-- START Modal Lihat File KTP -->
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- END Tabel Anggota Keluarga -->

		<?php if ($this->session->status == "Kepala Keluarga") : ?>
			<div class="row ml-4 mt-5">
				<a href="<?= base_url('user/kendaraan/tambah_kendaraan') ?>">
					<button type="button" class="btn btn btn-primary" data-target="#addKendaraan" data-toggle="modal"><i class=" fas fa-plus mr-2"></i>Tambah Data Kendaraan</button>
				</a>
			</div>
		<?php endif ?>
		<!-- START Tabel Data Kendaraan -->
		<div class="row justify-content-center">
			<div class="col-md-12 ml-4 my-4">
				<div class="card">
					<div class="card-header font-weight-bold text-dark">
						Data Kendaraan
					</div>
					<div class="card-body">
						<div class="table-responsive" style="overflow-y: auto; width:80%;">
							<table class="table table-striped table-hover table-bordered">
								<thead class="font-weight-bold text-dark">
									<tr>
										<th>No.</th>
										<th>Tipe Kendaraan</th>
										<th>Merk Kendaraan</th>
										<th>Nama Pemilik di STNK</th>
										<th>Nomor Polisi</th>
										<th>Foto Kendaraan</th>
										<th>Status Verifikasi</th>
										<?php if ($this->session->status == "Kepala Keluarga") : ?>
											<td>
												Aksi
											</td>
										<?php endif; ?>
									</tr>
								</thead>
								<tbody>
									<?php $no = 1;
									foreach ($info_kendaraan as $kendaraan) : ?>
										<tr>
											<td><?= $no++ ?></td>
											<td><?= $kendaraan->tipe_kendaraan ?></td>
											<td><?= $kendaraan->merk_kendaraan ?></td>
											<td><?= $kendaraan->nama_stnk ?></td>
											<td><?= $kendaraan->no_polisi ?></td>
											<td>
												<center>
													<button class="btn btn-primary btn-sm btn-edit" data-toggle="modal" data-target="#exampleModalCenter<?= $kendaraan->id_kendaraan ?>">
														<i class=" fas fa-eye"></i>
													</button>
												</center>
											</td>
											<td>
												<center>
													<?php if ($kendaraan->status_verifikasi == "1") : ?>
														<span class="badge badge-warning text-white">Belum Terverifikasi</span>
													<?php else : ?>
														<span class="badge badge-success">Terverifikasi</span>
													<?php endif; ?>
												</center>
											</td>
											<?php if ($this->session->status == "Kepala Keluarga") : ?>
												<td>
													<center>
														<a href="<?= base_url('user/kendaraan/edit_kendaraan/' . $kendaraan->id_kendaraan) ?>">
															<button class="btn btn-warning btn-sm text-white"><i class="fa fa-edit"></i></button>
														</a>
														<a href="<?= base_url("user/kendaraan/hapus_kendaraan/" . $kendaraan->id_kendaraan); ?>" class="hapus">
															<button class="btn btn-danger btn-sm btn-delete"><i class="fa fa-trash"></i></button>
														</a>
													</center>
												</td>
											<?php endif; ?>
										</tr>
										<!-- START Modal Lihat File Kendaraan -->
										<div class="modal fade overflow-auto" id="exampleModalCenter<?= $kendaraan->id_kendaraan ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLabel">Foto Kendaraan</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
													</div>
													<div class="modal-body">
														<div class="form-group d-flex justify-content-center">
															<img src="<?php echo base_url('uploads/kendaraan/' . $kendaraan->foto_kendaraan) ?>" alt="..." class="img-thumbnail mb-2">
														</div>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
													</div>
												</div>
											</div>
										</div>
										<!-- START Modal Lihat File Kendaraan -->
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- END Tabel Data Kendaraan -->
	</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?php echo base_url('assets/js/sweetalert2.all.min.js') ?>"></script>

<script>
	document.querySelector("#tambah").addEventListener('click', function() {
		Swal.fire({
			icon: "error",
			title: "Maaf",
			text: "Anda hanya bisa menambah anggota hunian sebanyak <?= $jumlah_hunian ?> hunian",
		});
	});
</script>

<script>
	$('.hapus').on('click', function(e) {
		e.preventDefault();
		const href = $(this).attr('href');
		Swal.fire({
			title: 'Anda yakin ingin menghapus data?',
			text: "Data tidak dapat kembali setelah dihapus!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya, hapus data!'
		}).then((result) => {
			if (result.isConfirmed) {
				document.location.href = href;
			}
		});
	});
</script>
<script>
	const flashData = $('.flash-data').data('flashdata');
	console.log(flashData);
	if (flashData) {
		Swal.fire({
			icon: 'success',
			title: 'Data',
			text: flashData
		});
	}
</script>
