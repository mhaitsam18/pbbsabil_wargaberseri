<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->
<div class="content-page">
	<div class="content">
		<!-- Start Content-->
		<div class="container-fluid">
			<div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
			<?php unset($_SESSION['flash']); ?>
			<!-- start page title -->
			<div class="row">
				<div class="col-12">
					<div class="page-title-box">
						<div class="page-title-right">
							<ol class="breadcrumb m-0">
								<li class="breadcrumb-item"><a href="javascript: void(0);">Warga Berseri</a></li>
								<li class="breadcrumb-item"><a href="javascript: void(0);">Data Warga</a></li>
							</ol>
						</div>
						<?php if ($this->session->role_id == 6) { ?>
							<h4 class="page-title">Data Warga RT <?= get_rt()[0] ?> / RW <?= get_rt()[1] ?></h4>
						<?php	} elseif ($this->session->role_id == 7) { ?>
							<h4 class="page-title">Data Warga RW <?= get_rw() ?></h4>
						<?php } else { ?>
							<h4 class="page-title">Data Warga</h4>
						<?php	} ?>
					</div>
				</div>
			</div>
			<!-- end page title -->
			<div class="row">
				<div class="col-12">
					<div class="card-box">
						<div class="mb-2">
							<div class="row">
								<div class="col">
									<div class="form-group mr-2">
										<a href="<?= base_url('admin/warga/tambah_warga') ?>" class="btn btn-secondary"><i class="mdi mdi-plus-circle mr-2"></i> Tambah Data Warga</a>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-12 text-sm-center form-inline">
									<div class="form-group mr-2">
										<select id="demo-foo-filter-status" class="custom-select custom-select-sm">
											<option value="">Tampilkan Semua</option>
											<option value="Rumah Pribadi">Rumah Usaha</option>
											<option value="Pemilik Kost">Rumah Tinggal</option>
											<option value="Pemilik Kontrakan">Rumah Kosong</option>
										</select>
									</div>
									<div class="form-group">
										<input id="demo-foo-search" type="text" placeholder="Search" class="form-control form-control-sm" autocomplete="on">
									</div>
								</div>
							</div>
						</div>
						<div class="table-responsive">
							<table id="demo-foo-filtering" class="table table-bordered toggle-circle mb-0" data-page-size="7">
								<thead>
									<tr>
										<th>No.</th>
										<th>No Rumah</th>
										<th>No KK</th>
										<th>Alamat</th>
										<th>Jml Keluarga</th>
										<th>Status Rumah</th>
										<th style="width: 80px;">Rt / Rw</th>
										<th>Pemilik Rumah</th>
										<th>Foto KK</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 1;
									foreach ($pendataan_warga as $warga) : ?>
										<tr>
											<td><?php echo $no++ ?></td>
											<td><?php echo $warga->no_rumah ?></td>
											<td><?php echo $warga->no_kk ?></td>
											<td><?php echo $warga->alamat ?></td>
											<td><?php echo $warga->jumlah_keluarga ?></td>
											<td><?php echo $warga->status_rumah ?></td>
											<td><?php echo $warga->rt ?> / <?php echo $warga->rw ?></td>
											<td><?php echo $warga->nama_warga ?></td>
											<td width='110px'>
												<button data-toggle="modal" data-target="#openImageKK<?php echo $warga->id_warga ?>" class="ladda-button btn btn-info" data-style="slide-up">
													<i class="mdi mdi-eye-outline"></i> Lihat
												</button>
											</td>
											<td style="width:310px;">
												<center>
													<a href=" <?php echo base_url('admin/warga/detail_warga/' . $warga->id_warga) ?>" class="ladda-button btn btn-primary" data-style="slide-up">
														<i class="mdi mdi-information-outline"></i> Anggota
													</a>
													<a href=" <?php echo base_url('admin/kendaraan/data/' . $warga->id_warga) ?>" class="ladda-button btn btn-warning" data-style="slide-up">
														<i class="mdi mdi-information-outline"></i> Kendaraan
													</a>
													<a href="<?php echo base_url('admin/warga/hapus_warga/' . $warga->id_warga) ?>" class="ladda-button btn btn-danger hapus mt-2" data-style="slide-up">
														<i class="mdi mdi-delete"></i> Hapus
													</a>
													<a href="<?php echo base_url('admin/warga/sunting_warga/' . $warga->id_warga) ?>" class="ladda-button btn btn-info mt-2" data-style="slide-up">
														<i class=" mdi mdi-square-edit-outline"></i> Sunting
													</a>
												</center>
											</td>
										</tr>
										<!-- START Modal Lihat File KK -->
										<div class="modal fade overflow-auto" id="openImageKK<?php echo $warga->id_warga ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLabel">Foto Kartu Keluarga</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
													</div>
													<div class="modal-body">
														<div class="form-group d-flex justify-content-center">
															<img src="<?= base_url('/uploads/kk/' . $warga->file_kk)  ?>" alt="..." class="img-thumbnail mb-2">
														</div>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
													</div>
												</div>
											</div>
										</div>
										<!-- END Modal Lihat File KK -->
									<?php endforeach; ?>
								</tbody>
								<tfoot>
									<tr class="active">
										<td colspan="10">
											<div class="text-right">
												<ul class="pagination pagination-rounded justify-content-end footable-pagination m-t-10 mb-0">
												</ul>
											</div>
										</td>
									</tr>
								</tfoot>
							</table>
						</div> <!-- end .table-responsive-->
					</div> <!-- end card-box -->
				</div> <!-- end col -->
			</div>
			<!-- end row -->
		</div> <!-- container -->
	</div> <!-- content -->

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="<?php echo base_url('assets/js/sweetalert2.all.min.js') ?>"></script>

	<script>
		const flashData = $('.flash-data').data('flashdata');
		console.log(flashData);
		if (flashData) {
			Swal.fire({
				icon: 'success',
				title: 'Data Warga',
				text: 'Berhasil ' + flashData
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
