<link href="https://code.jquery.com/ui/1.9.2/themes/smoothness/jquery-ui.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
<script>
	$(function() {
		$("#datepicker").datepicker({
			maxDate: "D"
		});
	});
</script>
<div class="content">

	<!-- Start Content-->
	<div class="container-fluid">
		<?php if (!empty($this->session->flashdata('error'))) {
			echo $this->session->flashdata('error');
		} ?>
		<form action="<?= base_url('admin/iuran/input_data_iuran') ?>" enctype="multipart/form-data" method="post">
			<div class="container-fluid">
				<!-- Illustrations -->

				<div class="content-page">

					<div class="row">
						<div class="col-12">
							<div class="page-title-box">
								<div class="page-title-right">
									<ol class="breadcrumb m-0">
										<li class="breadcrumb-item"><a href="javascript: void(0);">Admin Warga Berseri</a></li>
										<li class="breadcrumb-item"><a href="<?php echo base_url('admin/iuran/view_dataIuran'); ?>"><a herf="
                    javascript: void(0);">Data Iuran Warga</a></li>
										<li class="breadcrumb-item"><a href="javascript: void(0);">Pembayaran</a></li>
									</ol>
								</div>
								<h4 class="page-title">Form Pembayaran Iuran</h4>
							</div>
						</div>
					</div>
					<div class="card shadow mb-4">
						<div class="card-body">
							<div class="text-center">
								<form>
									<div class="form-group row">
										<label style="text-align: left" class="col-sm-2 col-form-label">No Tagihan</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="no_tagihan" value="<?php echo $iuran[0]->no_tagihan; ?>" readonly>
										</div>
									</div>
									<div class="form-group row">
										<label style="text-align: left" class="col-sm-2 col-form-label">Nama Warga</label>
										<div class="col-sm-10">
											<input type="text" name="nama" class="form-control" value="<?php echo $iuran[0]->nama; ?>" readonly>

										</div>
									</div>
									<div class="form-group row">
										<label style="text-align: left" class="col-sm-2 col-form-label">Nominal</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="nominal" value="<?php echo $iuran[0]->nominal; ?>" readonly required>
										</div>
									</div>
									<div class="form-group row">
										<label style="text-align: left" class="col-sm-2 col-form-label">Tanggal Pembayaran</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" id="datepicker" name="tanggal_pembayaran" required>
										</div>
									</div>
									<div class="form-group row">
										<label style="text-align: left" class="col-sm-2 col-form-label">Pembayaran</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="pembayaran" value="Tunai" readonly required>
										</div>
									</div>
							</div>

							<div style="text-align: right" class="col-sm-12">
								<button class="btn btn-primary">Simpan</button>
							</div>
		</form>
	</div>
</div>
</div>
</div>
</form>
