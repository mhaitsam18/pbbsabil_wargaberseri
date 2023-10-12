<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->
<div class="modal fade overflow-auto" id="addKendaraan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<?= form_open_multipart('admin/kendaraan/proses_tambah_kendaraan', array('method' => 'POST')) ?>
			<div class="modal-header">
				<h5 class="modal-title">Tambah Data Kendaraan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label>Tipe Kendaraan</label>
					<select class="form-control" name="tipe_kendaraan">
						<option value="-1"></option>
						<option value="Roda Dua">Roda Dua</option>
						<option value="Roda Tiga">Roda Tiga</option>
						<option value="Roda Empat">Roda Empat</option>
						<option value="Lebih dari Roda Empat">Lebih dari Roda Empat</option>
					</select>
				</div>
				<div class="form-group">
					<label>Merk Kendaraan</label>
					<input style="height:40px" class="form-control input-sm" type="text" name="merk_kendaraan">
					<small class="form-text text-danger"><?= form_error('merk_kendaraan'); ?></small>
				</div>
				<div class="form-group">
					<label>Nama Pemilik di STNK</label>
					<input style="height:40px" class="form-control input-sm" type="text" name="nama_stnk">
				</div>
				<div class="form-group">
					<label>Nomor Polisi</label>
					<input style="height:40px" class="form-control input-sm" type="text" name="no_polisi">
				</div>
				<div class="form-group">
					<label>Foto Kendaraan</label>
					<input type="file" name="foto_kendaraan" class="form-control">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" name="submit" class="btn btn-primary">Upload</button>
			</div>
		</div>
		<input type="hidden" name="id_warga" value="<?= $id ?>">
		<?= form_close() ?>
	</div>
</div>

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
								<li class="breadcrumb-item"><a href="javascript: void(0);">Data Kendaraan</a></li>
							</ol>
						</div>
						<h4 class="page-title">Data Kendaraan</h4>
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
										<a href="<?= base_url('admin/kendaraan/tambah_kendaraan/' . $id . '/' . $this->uri->segment(5)) ?>" class="btn btn-secondary">
											<i class="mdi mdi-plus-circle mr-2"></i>
											Tambah Kendaraan
										</a>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-12 text-sm-center form-inline">
									<div class="form-group mr-2">
										<select id="demo-foo-filter-status" class="custom-select custom-select-sm">
											<option value="">Tampilkan Semua</option>
											<option value="Roda Dua">Roda Dua</option>
											<option value="Roda Tiga">Roda Tiga</option>
											<option value="Roda Empat">Roda Empat</option>
											<option value="Lebih dari Roda Empat">Lebih dari Roda Empat</option>
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
										<th>Tipe Kendaraan</th>
										<th>Merk Kendaraan</th>
										<th>Nama Pemilik di STNK</th>
										<th>Nomor Polisi</th>
										<th>Foto Kendaraan</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 1;
									foreach ($info_kendaraan as $kendaraan) : ?>
										<tr>
											<td><?php echo $no++ ?></td>
											<td><?php echo $kendaraan->tipe_kendaraan ?></td>
											<td><?php echo $kendaraan->merk_kendaraan ?></td>
											<td><?php echo $kendaraan->nama_stnk ?></td>
											<td><?php echo $kendaraan->no_polisi ?></td>
											<td>
												<button data-toggle="modal" data-target="#openImageKendaraan<?php echo $kendaraan->id_kendaraan ?>" class="ladda-button btn btn-info" data-style="slide-up">
													<i class="mdi mdi-eye-outline"></i> Lihat
												</button>
											</td>
											<td>
												<center>
													<?php
													if ($kendaraan->status_verifikasi == 1) {  ?>
														<?= form_open_multipart('admin/kendaraan/verifikasi_kendaraan', array('method' => 'POST')) ?>
														<input type="hidden" name="id_warga" value="<?= $id ?>">
														<input type="hidden" name="id_kendaraan" value="<?= $kendaraan->id_kendaraan ?>">
														<button type="submit" class="ladda-button btn btn-warning mb-1" data-style="slide-up">
															<i class="mdi mdi-account-check-outline"></i>
															Verifikasi
														</button>
														<?= form_close() ?>
													<?php } else { ?>
														<button disabled class="ladda-button btn btn-success" data-style="slide-up">
															<i class="mdi mdi-account-check-outline"></i>
															Terverifikasi
														</button>
													<?php		} ?>
													<a href="<?= base_url('admin/kendaraan/edit_kendaraan/' . $kendaraan->id_kendaraan) ?>">
														<button type="button" class="ladda-button btn btn-warning" data-style="slide-up">
															<i class="mdi mdi-square-edit-outline"></i>
															Sunting
														</button>
													</a>
													<a href="<?php echo base_url('admin/kendaraan/hapus_kendaraan/' . $kendaraan->id_kendaraan . '/' . $id) ?>" class="ladda-button btn btn-danger hapus" data-style="slide-up">
														<i class="mdi mdi-delete"></i> Hapus
													</a>
											</td>
											</center>
										</tr>
										<!-- START Modal Lihat Foto Kendaraan -->
										<div class="modal fade overflow-auto" id="openImageKendaraan<?php echo $kendaraan->id_kendaraan ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLabel">Foto Kendaraan</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
													</div>
													<div class="modal-body">
														<div class="form-group d-flex justify-content-center">
															<img src="<?php echo base_url('uploads/kendaraan/') . $kendaraan->foto_kendaraan ?>" alt="..." class="img-thumbnail mb-2">
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
										<td colspan="9">
											<div class="text-right">
												<ul class="pagination pagination-rounded justify-content-end footable-pagination m-t-10 mb-0"></ul>
											</div>
										</td>
									</tr>
								</tfoot>
							</table>
						</div> <!-- end .table-responsive-->
					</div> <!-- end card-box -->
				</div> <!-- end col -->
			</div>
			<!-- end row-->
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
				title: 'Data kendaraan',
				text: 'Berhasil ' + flashData
			});
		}
	</script>
	<script>
		$('.hapus').on('click', function(e) {
			e.preventDefault();
			const href = $(this).attr('href');
			Swal.fire({
				title: 'Anda yakin ingin menghapus kendaraan?',
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
