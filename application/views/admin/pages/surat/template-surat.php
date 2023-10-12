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
								<li class="breadcrumb-item"><a href="javascript: void(0);">Penyediaan Surat</a></li>
							</ol>
						</div>
						<h4 class="page-title">Penyediaan Surat</h4>
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
										<a href="<?= base_url('admin/surat/view_tambah_template_surat') ?>">
											<button class="btn btn-secondary">
												<i class="mdi mdi-plus-circle mr-2"></i>
												Tambah Penyediaan Surat
											</button>
										</a>
									</div>
								</div>
								<div class="col-12 text-sm-center form-inline">
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
										<th>Judul</th>
										<th>Keterangan Surat</th>
										<th>File Surat</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 1;
									foreach ($template_surat as $surat) : ?>
										<tr>
											<td><?= $no++ ?></td>
											<td><?= $surat->judul ?></td>
											<td><?= $surat->keterangan_surat ?></td>
											<td>
												<?= str_replace('_', ' ', $surat->file_surat)  ?>
											</td>
											<td style="width: 300px;">
												<center>
													<a href="<?= base_url('admin/surat/download_template_surat/' . $surat->id_surat) ?>">
														<button class="ladda-button btn btn-success" data-style="slide-up">
															<i class="mdi mdi-download"></i>
															Unduh
														</button>
													</a>
													<a href="<?= base_url('admin/surat/hapus_template_surat/' . $surat->id_surat) ?>" class="hapus">
														<button class="ladda-button btn btn-danger" data-style="slide-up">
															<i class="mdi mdi-delete"></i>
															Hapus
														</button>
													</a>
													<a href="<?= base_url('admin/surat/view_edit_template_surat/' . $surat->id_surat) ?>">
														<button class="ladda-button btn btn-warning mt-1" data-style="slide-up">
															<i class="mdi mdi-square-edit-outline"></i>
															Sunting
														</button>
													</a>
												</center>
											</td>
										</tr>
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
				title: 'Template Surat',
				text: 'Berhasil ' + flashData
			});
		}
	</script>
	<script>
		$('.hapus').on('click', function(e) {
			e.preventDefault();
			const href = $(this).attr('href');
			Swal.fire({
				title: 'Anda yakin ingin menghapus surat?',
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
