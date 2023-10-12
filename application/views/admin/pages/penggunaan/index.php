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
								<li class="breadcrumb-item"><a href="javascript: void(0);">Pengeluaran</a></li>
							</ol>
						</div>
						<h4 class="page-title">Data Pengeluaran</h4>
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
											<!--<option value="May">May</option>-->
										</select>
									</div>
									<div class="form-group">
										<input id="demo-foo-search" type="text" placeholder="Search" class="form-control form-control-sm" autocomplete="on">
									</div>
								</div>
							</div>
							<div class="form-group mr-2" style="float:right; margin-left:80%;">
									<a href="<?php echo base_url('admin/penggunaan/tambah_penggunaan') ?>" class="btn btn-secondary">
											<i class="mdi mdi-plus-circle mr-2" ></i>Tambah Data</a>
							</div>
						</div>
						<div class="table-responsive">
							<table id="demo-foo-filtering" class="table table-bordered toggle-circle mb-0" data-page-size="7">
								<thead>
									<tr>
										<th>No.</th>
										<th data-toggle="true">Bulan</th>
										<th data-toggle="true">Tahun</th>
										<th>Jumlah Pengeluaran</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 1;
									foreach ($penggunaan as $data_penggunaan) : ?>
										<tr>
											<td><?php echo $no++ ?></td>
											<td><?php echo $data_penggunaan->bulan_penggunaan; ?></td>
											<td><?php echo $data_penggunaan->tahun_penggunaan; ?></td>
											<td><?php echo $hasil_rupiah = "Rp " . number_format($data_penggunaan->pengeluaran, 0, ',', '.') ?></td>
											<td><a href=" <?php echo base_url('admin/penggunaan/tampil_bulanan/' . $data_penggunaan->bulan_penggunaan ) ?>" class="ladda-button btn btn-primary" data-style="slide-up">
													<i class="mdi mdi-information-outline"></i> Info</a> </td>
											<!--<td><?php $waktu =  strtotime($data_penggunaan->tanggal_penggunaan);
													echo date('d-M-Y', $waktu); ?></td> -
											<td> <a href=" <?php echo base_url('admin/penggunaan/detail_penggunaan/' . $data_penggunaan->id_penggunaan) ?>" class="ladda-button btn btn-primary" data-style="slide-up">
													<i class="mdi mdi-information-outline"></i> Info</a> &nbsp;&nbsp;
												<a href=" <?php echo base_url('admin/penggunaan/edit_data_penggunaan/' . $data_penggunaan->id_penggunaan) ?>" class="ladda-button btn btn-success" data-style="slide-up">
													<i class="mdi mdi-pencil"></i> Edit</a>&nbsp;&nbsp;
												<a href=" <?php echo base_url('admin/penggunaan/hapus_data_penggunaan/' . $data_penggunaan->id_penggunaan) ?>" class="ladda-button btn btn-danger" data-style="slide-up">
													<i class="mdi mdi-delete"></i> Delete</a> -->
											</td>
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
									<?php $hasil_rupiah = "Rp " . number_format($saldo[0]->total_saldo, 0, ',', '.'); ?>
									<tr class="active">
										<td colspan="12">
											<div class="text-right">
												Total Saldo : <?php echo $hasil_rupiah; ?>
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
