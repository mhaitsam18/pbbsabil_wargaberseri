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
								<li class="breadcrumb-item"><a href="javascript: void(0);">Admin Warga Berseri</a></li>
								<li class="breadcrumb-item"><a href="javascript: void(0);">Data Iuran Warga</a></li>
							</ol>
						</div>
						<h4 class="page-title">Data Iuran Warga</h4>

					</div>
				</div>
			</div>
			<!-- end page title -->

			<div class=" row">
				<div class="col-12">
					<div class="card-box">


						<div class="mb-2">
							<div class="row">
								<div class="col">
									<div class="form-group">
										
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-12 text-sm-center form-inline">
									<div class="form-group mr-2">
										<select id="demo-foo-filter-status" class="custom-select custom-select-sm">
											<option value="">Tampilkan Semua</option>
											<option value="Verifikasi">Belum Terverifikasi</option>
											<option value="wajib">Wajib</option>
											<option value="tambahan">Tambahan</option>
										</select>
									</div>
									<div class="form-group">
										<input id="demo-foo-search" type="text" placeholder="Search" class="form-control form-control-sm" autocomplete="on">
									</div >
										<div class="form-group mr-2" style="float: right; margin-left:80%;" >
											<a href="<?php echo base_url(); ?>admin/iuran/tambah_iuran" class="btn btn-secondary" >
											<i class="mdi mdi-plus-circle mr-2" ></i> Tambah Data Iuran
											</a>
										</div>
								</div>
							</div>
						</div>

						<div class="table-responsive">
							<table id="demo-foo-filtering" class="table table-bordered toggle-circle mb-0" data-page-size="7">
								<thead>
									<tr>
										<th>No.</th>
										<th>Id Warga</th>
										<th data-toggle="true">No Tagihan</th>
									<!--	<th>No Rumah</th> -->
										<th>Bulan Iuran</th>
										<th>Tahun Iuran</th>
										<th>Nama</th>
										<th>Jenis Iuran</th>
										<th>Nominal</th>
										<th>Tanggal Bayar</th>
										<th>Bukti Pembayaran</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 1;
									foreach ($iuran as $warga) : ?>
										<tr>
											<td><?php echo $no++ ?></td>	
											<td><?php echo $warga->id_warga; ?></td>
											<td><?php echo $warga->no_tagihan; ?></td>
											<!-- <td><?php echo $warga->id_warga; ?></td> -->
											<td><?php echo $warga->bulan_iuran; ?></td>
											<td><?php echo $warga->tahun_iuran; ?></td>
											<td><?php echo $warga->nama; ?></td>
											<td><?php echo $warga->jenis; ?></td>
											<td><?php echo $hasil_rupiah = "Rp " . number_format($warga->nominal, 0, ',', '.'); ?></td>
											<?php if (empty($warga->tanggal_pembayaran)) : ?>
												<td>-</td>
											<?php endif; ?>

											<?php if ($warga->tanggal_pembayaran != "") : ?>
												<td><?php $tanggal = strtotime($warga->tanggal_pembayaran);
                                						echo date('d-M-Y',$tanggal); ?>
											<?php endif; ?>
											<?php if ($warga->bukti_pembayaran == "") : ?>
												<td>-</td>
											<?php endif; ?>
											<?php if ($warga->bukti_pembayaran != "") : ?>
												<!-- START Modal Lihat File KK -->
												<td width='110px'>
												<button data-toggle="modal" data-target="#bukti_pembayaran<?php echo $warga->id_warga ?>" class="ladda-button btn btn-info" data-style="slide-up">
													<i class="mdi mdi-eye-outline"></i> Lihat
												</button>
											</td>
										<div class="modal fade overflow-auto" id="bukti_pembayaran<?php echo $warga->id_warga ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLabel">Bukti Pembayaran</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
													</div>
													<div class="modal-body">
														<div class="form-group d-flex justify-content-center">
															<img src="<?= base_url($warga->bukti_pembayaran); ?>" alt="..." class="img-thumbnail mb-2">
														</div>
													</div>
												</div>
											</div>
										</div>
											<?php endif; ?>


											<?php if ($warga->status_iuran == "Belum Diverifikasi") : ?>
												<td width='280px'>
													<a href="<?php echo base_url(); ?>admin/iuran/verifikasi_iuran/<?php echo $warga->no_tagihan; ?>" class ="ladda-button btn btn-warning" data-style="slide-up"><i class="mdi mdi-account-check-outline"></i> Verifikasi Iuran</a> &nbsp;&nbsp;
																<a href="<?php echo base_url(); ?>admin/iuran/tolak_verifikasi/<?php echo $warga->no_tagihan; ?>" class="ladda-button btn btn-danger" data-style="slide-up"><i class="mdi mdi-cancel"></i> Tolak</button></a>
															
												</td>
											<?php endif; ?>

											<?php if ($warga->status_iuran != "Belum Diverifikasi" ) : ?>
												<td>
													<center><a href="<?php echo base_url(); ?>admin/iuran/bayar_iuran_langsung/<?php echo $warga->no_tagihan; ?>"><button type="button" class="btn btn-primary">Bayar Langsung</button></center>
												</td>
											<?php endif; ?>

										</tr>
									<?php endforeach; ?>
								</tbody>
								<tfoot>
									<tr class="active">
										<td colspan="12">
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
