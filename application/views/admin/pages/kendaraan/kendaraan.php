<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->
<div class="content-page">
	<div class="content">
		<!-- Start Content-->
		<div class="container-fluid">
			<!-- start page title -->
			<div class="row">
				<div class="col-12">
					<div class="page-title-box">
						<div class="page-title-right">
							<ol class="breadcrumb m-0">
								<li class="breadcrumb-item"><a href="javascript: void(0);">Warga Berseri</a></li>
								<li class="breadcrumb-item"><a href="javascript: void(0);">Detail Kendaraan</a></li>
							</ol>
						</div>
						<h4 class="page-title">Data Kendaraan?>
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
													<a href="<?php echo base_url('admin/kendaraan/hapus_kendaraan/' . $kendaraan->id_kendaraan . '/' . $id) ?>" class="ladda-button btn btn-danger" data-style="slide-up">
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
