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
								<li class="breadcrumb-item"><a href="<?php echo base_url('admin/keuangan'); ?>" <a href="javascript: void(0);">Keuangan</a></li>
								<li class="breadcrumb-item"><a href="javascript: void(0);">Data Iuran Warga</a></li>
							</ol>
						</div>
						<h4 class="page-title">Data Iuran Warga, <?php if (empty($iuran)) {
												echo " ";
											} else { echo $iuran[0]->bulan_iuran . " - " . $iuran[0]->tahun_iuran; }?></h4>
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
											<option value="Belum Terverifikasi">Belum Terverifikasi</option>
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
										<th data-toggle="true">No Tagihan</th>
										<!-- <th>Bulan Iuran</th>
										 <th>Tahun Iuran</th>-->
										<th>Nama</th>
										<th>Jenis</th>
										<th>Tanggal Bayar</th>
										<th>Status Iuran</th>

									</tr>
								</thead>
								<tbody>
									<?php $no = 1; 
									foreach ($iuran as $warga) : ?>
										<tr>
											<td><?php echo $no++ ?></td>
											<td><?php echo $warga->no_tagihan; ?></td>
											<!-- <td><?php echo $warga->bulan_iuran; ?></td>
											<td><?php echo $warga->tahun_iuran; ?></td>-->
											<td><?php echo $warga->nama; ?></td>
											<td><?php echo $warga->jenis; ?></td>
											<?php if (empty($warga->tanggal_pembayaran)) : ?>
												<td>-</td>
											<?php endif; ?>
											<?php if ($warga->tanggal_pembayaran != "") : ?>
												<td><?php $tanggal = strtotime($warga->tanggal_pembayaran);
                                						echo date('d-M-Y',$tanggal); ?></td>
											<?php endif; ?>
											<td><?php echo $warga->status_iuran; ?></td>
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
			<button onclick="exportTableToExcel('demo-foo-filtering', 'data-iuran')" class="ladda-button btn btn-primary" data-style="slide-up">Export Table Data To Excel File</button>
		</div> <!-- container -->
 
	</div> <!-- content -->
