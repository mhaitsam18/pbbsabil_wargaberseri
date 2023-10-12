<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->


<div class="content-page">
	<div class="content">

		<div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
		<?php unset($_SESSION['flash']); ?>
		<!-- Start Content-->
		<div class="container-fluid">
			<!-- start page title -->
			<div class="row">
				<div class="col-12">
					<div class="page-title-box">
						<div class="page-title-right">
							<ol class="breadcrumb m-0">
								<li class="breadcrumb-item"><a href="javascript: void(0);">Warga Berseri</a></li>
								<li class="breadcrumb-item"><a href="javascript: void(0);">Detail Warga</a></li>
							</ol>
						</div>
						<h4 class="page-title">Profile Warga No Rumah
							<?= $warga->no_rumah ?>
						</h4>
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
										<?php if ($jumlah_hunian >= $warga->jumlah_keluarga) { ?>
											<button type="button" class="btn btn btn-primary" id="tambah">
												<i class=" fas fa-plus mr-2"></i>
												Tambah Anggota Hunian
											</button>
										<?php } else { ?>
											<a href="<?= base_url('admin/warga/tambah_hunian/' . $id_warga) ?>" class="btn btn-secondary">
												<i class="mdi mdi-plus-circle mr-2"></i>
												Tambah Anggota Hunian
											</a>
										<?php	} ?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-12 text-sm-center form-inline">
									<div class="form-group mr-2">
										<select id="demo-foo-filter-status" class="custom-select custom-select-sm">
											<option value="">Tampilkan Semua</option>
											<option value="Kepala Keluarga">Kepala Keluarga</option>
											<option value="Anggota Keluarga">Anggota Keluarga</option>
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
										<th>Nama Lengkap</th>
										<th>NIK</th>
										<th>Status</th>
										<th>Pekerjaan</th>
										<th>File KTP</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 1;
									foreach ($pendataan_warga as $warga) : ?>
										<tr>
											<td><?php echo $no++ ?></td>
											<td><?php echo $warga->nama_warga ?></td>
											<td><?php echo $warga->nik ?></td>
											<td><?php echo $warga->status ?></td>
											<td><?php echo $warga->pekerjaan ?></td>
											<td>
												<button data-toggle="modal" data-target="#viewDetail<?php echo $warga->id_detail_warga ?>" class="ladda-button btn btn-info" data-style="slide-up">
													<i class="mdi mdi-eye-outline"></i> Lihat
												</button>
											</td>
											<td>
												<center>
													<?php
													$no_rumah = $this->uri->segment(5);
													if ($warga->status_verifikasi == 1) {  ?>
														<?= form_open_multipart('admin/warga/verifikasi_warga', array('method' => 'POST')) ?>
														<input type="hidden" name="id_warga" value="<?= $warga->id_warga ?>">
														<input type="hidden" name="id_detail_warga" value="<?= $warga->id_detail_warga ?>">
														<input type="hidden" name="no_rumah" value="<?= $no_rumah ?>">
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
													<a href="<?= base_url('admin/warga/detail_hunian/' . $warga->id_detail_warga) ?>">
														<button class="ladda-button btn btn-warning" data-style="slide-up">
															<i class="mdi mdi-pencil-box-outline"></i>
															Sunting
														</button>
													</a>
													<a class="hapus" href="<?php echo base_url('admin/warga/hapus_hunian/' . $warga->id_detail_warga . '/' . $warga->id_warga) ?>">
														<button class="ladda-button btn btn-danger" data-style="slide-up">
															<i class="mdi mdi-delete"></i>
															Hapus
														</button>
													</a>
											</td>
											</center>
										</tr>
										<!-- START Modal view File Ktp -->
										<div class="modal fade" id="viewDetail<?php echo $warga->id_detail_warga ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLabel">Detail Data Warga
														</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
													</div>
													<div class="modal-body">
														<div class="form-group ">
															<label>File Identitas</label>
															<img src="<?php echo base_url('uploads/ktp/') . $warga->file_ktp ?>" alt="..." class="img-thumbnail mb-2">
														</div>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
													</div>
												</div>
											</div>
										</div>
										<!-- END Modal view File Ktp -->
									<?php endforeach; ?>
								</tbody>
								<tfoot>
									<tr class="active">
										<td colspan="9">
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
			<!-- end row-->
		</div> <!-- container -->
	</div> <!-- content -->

	<!-- TAMABHAN SCRIPT -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="<?php echo base_url('assets/js/sweetalert2.all.min.js') ?>"></script>
	<script>
		const flashData = $('.flash-data').data('flashdata');
		console.log(flashData);
		if (flashData) {
			Swal.fire({
				icon: 'success',
				title: 'Data Hunian',
				text: 'Berhasil ' + flashData
			});
		}
	</script>
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
