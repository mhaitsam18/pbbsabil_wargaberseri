<div class="main-wrapper">
	<section class="page-title bg-2">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 text-center">
					<ul class="list-inline mb-0">
						<li class="list-inline-item"><a href="index.html" class="text-sm letter-spacing text-white text-uppercase font-weight-bold">Home</a></li>
						<li class="list-inline-item"><span class="text-white">|</span></li>
						<li class="list-inline-item"><a href="#" class="text-color text-uppercase text-sm letter-spacing">Pengajuan Surat</a></li>
					</ul>
					<h1 class="text-lg text-white mt-2">Pengajuan Surat</h1>
				</div>
			</div>
		</div>
	</section>
	<div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
	<?php unset($_SESSION['flash']); ?>

	<div class="container-fluid">
		<div class="row mt-4">
			<div class="col-md-6 ml-4 my-4">
				<!-- START Tabel Detail Keluarga -->
				<div class="table-responsive" style="overflow-y: auto;">
					<table class="table table-striped table-hover table-md">
						<thead>
							<tr>
								<td class="font-weight-medium" scope="col" width="100%" colspan="4">
									<h2>Ajukan Surat</h2>
									Ajukan surat keperluan melalui form disini, tunggu konfirmasi admin untuk persetujuan surat agar bisa diunduh.
								</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>No</td>
								<td>Nama</td>
								<td>Tanggal</td>
								<td>Keperluan</td>
								<td>Status</td>
								<td colspan="4">Aksi</td>
							</tr>
							<?php $no = 1;
							foreach ($pengajuan as $surat) : ?>
								<tr>
									<td><?= $no++ ?></td>
									<td><?= $surat->nama_warga ?></td>
									<td style="width: 150px;"><?= date_indo($surat->tanggal_pengajuan) ?></td>
									<td><?= $surat->pengajuan ?></td>
									<td>
										<?php if ($surat->verifikasi_rt == "Diproses" && $surat->verifikasi_rt == "Diproses") { ?>
											<span class="badge bg-warning text-white">Diproses</span>
										<?php	} elseif ($surat->verifikasi_rw == "Disetujui" && $surat->verifikasi_rw == "Disetujui") { ?>
											<span class="badge bg-success text-white">Disetujui</span>
										<?php } ?>
									</td>
									<center>
										<td colspan="4">
											<?php if ($surat->nama_warga == $this->session->nama_warga) { ?>
												<?php if ($surat->verifikasi_rt == "Diproses" || $surat->verifikasi_rw == "Diproses") { ?>
													<button disabled class="btn btn-success btn-sm btn-edit" style="cursor: not-allowed !important ">
														<i class=" fas fa-download"></i>
													</button>
												<?php	} elseif ($surat->verifikasi_rt == "Disetujui" && $surat->verifikasi_rw == "Disetujui") { ?>
													<a href="<?= base_url('user/surat/download_surat/' . $surat->id_pengajuan_surat) ?>">
														<button class="btn btn-success btn-sm">
															<i class="fas fa-download"></i>
														</button>
													</a>
												<?php } ?>
												<a href="<?= base_url('user/surat/hapus_surat/' . $surat->id_pengajuan_surat) ?>" class="hapus">
													<button class="btn btn-sm btn-danger">
														<i class="fas fa-trash"></i>
													</button>
												</a>
											<?php	} ?>
										</td>
									</center>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
				<!-- END Tabel Detail Keluarga -->
			</div>

			<div class="col-md-4 text-left my-4 ml-5 d-flex flex-column justify-content-center">
				<?= form_open_multipart('user/surat/tambah_pengajuan', array('method' => 'POST')) ?>
				<div class="form-group">
					<label class="text-black font-weight-bold">Anggota Keluarga Untuk Diajukan</label>
					<select class="form-control" name="id_detail_warga">
						<?php foreach ($nama as $nama_warga) : ?>
							<option value="<?= $nama_warga->id_detail_warga; ?>"><?= $nama_warga->nama_warga; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="form-group">
					<label class="text-black font-weight-bold">Keperluan</label>
					<textarea class="form-control" name="pengajuan" rows="3" placeholder="Masukkan Keperluan Surat Keterangan"></textarea>
					<span class="form-text text-danger"><?= form_error('pengajuan'); ?></span>
				</div>
				<div>
					<button class="btn btn-main text-white btn-block" type="submit">Ajukan</button>
				</div>
				<?= form_close() ?>
			</div>

		</div>
	</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?php echo base_url('assets/js/sweetalert2.all.min.js') ?>"></script>
<script>
	const flashData = $('.flash-data').data('flashdata');
	console.log(flashData);
	if (flashData) {
		Swal.fire({
			icon: 'success',
			title: 'Pengajuan Surat',
			text: flashData
		});
	}
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
