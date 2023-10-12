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
								<li class="breadcrumb-item"><a href="javascript: void(0);">Info Warga</a></li>
							</ol>
						</div>
						<?php if ($this->session->role_id == 6) { ?>
							<h4 class="page-title">Info Warga RT <?= get_rt()[0] ?> / RW <?= get_rt()[1] ?></h4>
						<?php	} elseif ($this->session->role_id == 7) { ?>
							<h4 class="page-title">Info Warga RW <?= get_rw() ?></h4>
						<?php } else { ?>
							<h4 class="page-title">Info Warga</h4>
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
										<th>No Rumah</th>
										<th>Status</th>
										<th>Detail</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 1;
									foreach ($pendataan_warga as $warga) :	 ?>
										<tr>
											<td><?php echo $no++ ?></td>
											<td><?php echo $warga->nama_warga ?></td>
											<td><?php echo $warga->nik ?></td>
											<td><?php echo $warga->no_rumah ?></td>
											<td><?php echo $warga->status ?></td>
											<td>
												<a href="<?= base_url('admin/warga/detail_hunian/' . $warga->id_detail_warga) ?>" class="ladda-button btn btn-primary" data-style="slide-up">
													<i class="mdi mdi-information-outline"></i> Detail
												</a>
											</td>
											<td width='260px'>
												<center>
													<?php if ($warga->status_verifikasi == 1) {  ?>
														<a href="<?= base_url('admin/warga/verifikasi_warga_info/' . $warga->id_detail_warga) ?>" class="ladda-button btn btn-warning" data-style="slide-up">
															<i class="mdi mdi-account-check-outline"></i>
															Verifikasi
														</a>
													<?php } else { ?>
														<button disabled class="ladda-button btn btn-success" data-style="slide-up">
															<i class="mdi mdi-account-check-outline"></i>
															Terverifikasi
														</button>
													<?php		} ?>
												</center>
											</td>
										</tr>
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
