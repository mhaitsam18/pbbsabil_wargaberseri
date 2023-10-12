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
								<li class="breadcrumb-item"><a href="javascript: void(0);">Pemasukan Iuran</a></li>
							</ol>
						</div>
						<h4 class="page-title">Data Pemasukan, <?php echo $pemasukan[0]->bulan_pemasukan . " - " . $pemasukan[0]->tahun_pemasukan; ?></h4>
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
										</select>
									</div>
									<div class="form-group">
										<input id="demo-foo-search" type="text" placeholder="Search" class="form-control form-control-sm" autocomplete="on">
									</div>
								</div>
							</div>
							<div class="form-group mr-2" style="float:right; margin-left:80%;">
									<a href="<?php echo base_url('admin/pemasukan/tambah_pemasukan') ?>" class="btn btn-secondary">
											<i class="mdi mdi-plus-circle mr-2" ></i>Tambah Data</a>
									</div>
						</div>
						<div class="table-responsive">
							<table id="demo-foo-filtering" class="table table-bordered toggle-circle mb-0" data-page-size="7">
								<thead>
									<tr>
										<th>No.</th>
										<th data-toggle="true">Nama Pemasukan</th>
										<th>Jumlah Pemasukan</th>
										<th>Tanggal Pemasukan</th> 
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 1;
									foreach ($pemasukan as $data_pemasukan) : ?>
										<tr>
											<td><?php echo $no++ ?></td>
											<!-- <td><?php echo $data_pemasukan->bulan_pemasukan; ?></td>
											<td><?php echo $hasil_rupiah = "Rp " . number_format($data_pemasukan->pemasukan , 0 ,',','.') ?></td>
											<td><a href=" <?php echo base_url('admin/pemasukan/tampil_bulanan/' ) ?>" class="ladda-button btn btn-primary" data-style="slide-up">
													<i class="mdi mdi-information-outline"></i> Info</a> </td> -->
											<td><?php echo $data_pemasukan->nama_pemasukan; ?></td>
											<td><?php echo $hasil_rupiah = "Rp " . number_format($data_pemasukan->jumlah_pemasukan, 0, ',', '.') ?></td>
											<td><?php $waktu =  strtotime($data_pemasukan->tanggal_pemasukan);
													echo date('d-M-Y', $waktu); ?></td> 
											<td> <a href=" <?php echo base_url('admin/pemasukan/detail_pemasukan/' . $data_pemasukan->id_pemasukan) ?>" class="ladda-button btn btn-primary" data-style="slide-up">
													<i class="mdi mdi-information-outline"></i> Info</a> &nbsp;&nbsp;
												<a href=" <?php echo base_url('admin/pemasukan/edit_data_pemasukan/' . $data_pemasukan->id_pemasukan) ?>" class="ladda-button btn btn-success" data-style="slide-up">
													<i class="mdi mdi-pencil"></i> Edit</a>&nbsp;&nbsp;
												<a href=" <?php echo base_url('admin/pemasukan/hapus_data_pemasukan/' . $data_pemasukan->id_pemasukan) ?>" class="ladda-button btn btn-danger" data-style="slide-up">
													<i class="mdi mdi-delete"></i> Delete</a> 
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
