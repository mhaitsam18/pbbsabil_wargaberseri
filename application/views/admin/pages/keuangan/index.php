<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->

<script type="text/javascript">
	function exportTableToExcel(tableID, filename = '') {
		var downloadLink;
		var dataType = 'application/vnd.ms-excel';
		var tableSelect = document.getElementById(tableID);
		var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

		// Specify file name
		filename = filename ? filename + '.xls' : 'excel_data.xls';

		// Create download link element
		downloadLink = document.createElement("a");

		document.body.appendChild(downloadLink);

		if (navigator.msSaveOrOpenBlob) {
			var blob = new Blob(['\ufeff', tableHTML], {
				type: dataType
			});
			navigator.msSaveOrOpenBlob(blob, filename);
		} else {
			// Create a link to the file
			downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

			// Setting the file name
			downloadLink.download = filename;

			//triggering the function
			downloadLink.click();
		}
	}
</script>

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
								<li class="breadcrumb-item"><a href="javascript: void(0);">Keuangan</a></li>
							</ol>
						</div>
						<h4 class="page-title">Data Keuangan</h4>
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
											<!--<option value="Belum Terverifikasi">Belum Terverifikasi</option>-->
										</select>
									</div>
									<div class="form-group">
										<input id="demo-foo-search" type="text" placeholder="Search" class="form-control form-control-sm" autocomplete="on">
									</div>
								</div>
							</div>
							<div class="text-right">
								<?php $hasil_rupiah = "Rp " . number_format($totalsaldo[0]->total_saldo, 0, ',', '.'); ?>
								Total Saldo : <?php echo $hasil_rupiah; ?>
							</div>
						</div>


						<div class="table-responsive">
							<table id="demo-foo-filtering" class="table table-bordered toggle-circle mb-0" data-page-size="7">
								<thead>
									<tr>
										<th>No.</th>
										<th data-toggle="true">Bulan</th>
										<th>Tahun</th>
										<th>Jumlah Warga</th>
										<th>Jumlah Sudah Bayar</th>
										<th>Jumlah Belum Bayar</th>
										<th>Iuran Masuk</th>
										<th>Tagihan Iuran</th>
										<th>Pengeluaran</th>
										<th>Pemasukan</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 1;
									foreach ($keuangan as $uang) : ?>
										<tr>

											<td><?php echo $no++ ?></td>
											<td><?php echo $uang->bulan; ?></td>
											<td><?php echo $uang->tahun; ?></td>
											<td><?php echo $uang->jumlah_warga; ?></td>
											<td><?php echo $uang->jumlah_sudah_bayar; ?></td>
											<td><?php echo $uang->jumlah_belum_bayar; ?></td>
											<td><?php echo  "Rp " . number_format($uang->saldo, 0, ',', '.'); ?></td>
											<td><?php echo  "Rp " . number_format($uang->tagihan, 0, ',', '.'); ?></td>
											
											<td><?php echo "Rp " . number_format($uang->pengeluaran, 0, ',', '.'); ?></td>
											<td><?php echo "Rp " . number_format($uang->pemasukan, 0, ',', '.'); ?></td>
											<td>
												<a href=" <?php echo base_url('admin/keuangan/detail_rekap/' . $uang->bulan . '/' . $uang->tahun) ?>" class="ladda-button btn btn-primary" data-style="slide-up">
													<i class="mdi mdi-information-outline"></i> Info
												</a>
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
									<tr class="active">
										<td colspan="12">

										</td>
									</tr>
								</tfoot>
							</table>
						</div> <!-- end .table-responsive-->
					</div> <!-- end card-box -->
				</div> <!-- end col -->
			</div>
			<!-- end row -->
			<button onclick="exportTableToExcel('demo-foo-filtering', 'data-iuran')" class="ladda-button btn btn-primary" data-style="slide-up">Export Table Data To Excel File</button>

		</div> <!-- container -->

	</div> <!-- content -->
