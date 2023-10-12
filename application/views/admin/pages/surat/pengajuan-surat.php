<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->

<style>
	.rtrw {
		width: 140px;
		display: inline;
	}
</style>
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
								<li class="breadcrumb-item"><a href="javascript: void(0);">Pengajuan Surat</a></li>
							</ol>
						</div>
						<?php if ($this->session->role_id == 6) { ?>
							<h4 class="page-title">Pengajuan Surat RT <?= get_rt()[0] ?></h4>
						<?php	} elseif ($this->session->role_id == 7) { ?>
							<h4 class="page-title">Pengajuan Surat RW <?= get_rw() ?></h4>
						<?php } else { ?>
							<h4 class="page-title">Pengajuan Surat</h4>
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
										<th>Nama Warga</th>
										<th>No Rumah</th>
										<th>Rt / Rw</th>
										<th>Tanggal Pengajuan</th>
										<th>Keterangan</th>
										<th>Verifikasi</th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 1;
									$role = $this->session->role_id;
									foreach ($pengajuan_surat as $surat) : ?>
										<tr>
											<td><?= $no++ ?></td>
											<td><?= $surat->nama_warga ?></td>
											<td><?= $surat->no_rumah ?></td>
											<td><?= 'Rt ' . $surat->rt . ' / ' ?> <?= 'Rw ' . $surat->rw ?> </td>
											<td style="width: 150px;"><?= date_indo($surat->tanggal_pengajuan) ?></td>
											<td><?= $surat->pengajuan ?></td>
											<td style="width: 315px;">
												<center>
													<?php if ($surat->verifikasi_rt == "Diproses") {  ?>
														<form action="<?= base_url('admin/surat/verifikasi_surat_rt/') ?>" class="rtrw" method="POST">
															<input type="hidden" name="id_pengajuan_surat" value="<?= $surat->id_pengajuan_surat ?>">
															<input type="hidden" name="rt" value="<?= $surat->rt ?>">
															<?php if ($role == 6) { ?>
																<button type="submit" class="ladda-button btn btn-warning" data-style="slide-up">
																	<i class="mdi mdi-account-remove-outline"></i>
																	Rt Diproses
																</button>
															<?php	} else { ?>
																<button disabled type="submit" class="ladda-button btn btn-warning text-white" data-style="slide-up" style="cursor: not-allowed !important">
																	<i class="mdi mdi-account-remove-outline"></i>
																	Rt Diproses
																</button>
															<?php } ?>
														</form>
													<?php } elseif ($surat->verifikasi_rt == "Disetujui") { ?>
														<button disabled class="ladda-button btn btn-success" style="cursor: not-allowed !important" data-style="slide-up">
															<i class="mdi mdi-account-check-outline"></i>
															Rt Disetujui
														</button>
													<?php } ?>
													<?php if ($surat->verifikasi_rw == "Diproses") {  ?>
														<form action="<?= base_url('admin/surat/verifikasi_surat_rw/') ?>" class="rtrw" method="POST">
															<input type="hidden" name="id_pengajuan_surat" value="<?= $surat->id_pengajuan_surat ?>">
															<input type="hidden" name="rw" value="<?= $surat->rw ?>">
															<?php if ($role == 7) { ?>
																<button type="submit" class="ladda-button btn btn-warning" data-style="slide-up">
																	<i class="mdi mdi-account-remove-outline"></i>
																	Rw Diproses
																</button>
															<?php	} else { ?>
																<button disabled type="submit" class="ladda-button btn btn-warning text-white" data-style="slide-up" style="cursor: not-allowed !important">
																	<i class="mdi mdi-account-remove-outline"></i>
																	Rw Diproses
																</button>
															<?php } ?>
														</form>
													<?php } elseif ($surat->verifikasi_rw == "Disetujui") { ?>
														<button disabled class="ladda-button btn btn-success" data-style="slide-up" style="cursor: not-allowed !important">
															<i class="mdi mdi-account-check-outline"></i>
															Rw Disetujui
														</button>
													<?php } ?>

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
