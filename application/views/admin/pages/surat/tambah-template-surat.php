<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->

<style>
	p {
		margin: 0px;
		padding: 0px;
		overflow-wrap: normal;
		word-break: normal;
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
								<li class="breadcrumb-item"><a href="javascript: void(0);">Tambah Penyediaan Surat</a></li>
							</ol>
						</div>
						<h4 class="page-title">Tambah Penyediaan Surat</h4>
					</div>
				</div>
			</div>
			<!-- end page title -->

			<!-- Form row -->
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<?= form_open_multipart('admin/surat/tambah_template_surat', array('method' => 'POST')) ?>
							<div class="form-row">
								<div class="form-group col-md-8">
									<label class="col-form-label">Judul Surat</label>
									<input type="text" class="form-control" placeholder="Judul Surat" name="judul" value="<?php echo set_value('judul') ?>">
									<span class="form-text text-danger"><?= form_error('judul'); ?></span>
								</div>
							</div>

							<div class="form-row">
								<div class="form-group col-md-8">
									<label class="col-form-label">Keterangan Surat</label>
									<textarea name="keterangan_surat" class="form-control input-sm" cols="30" rows="5" placeholder="Keterangan Surat"><?php echo set_value('keterangan_surat') ?></textarea>
									<span class="form-text text-danger"><?= form_error('keterangan_surat'); ?></span>
								</div>
							</div>

							<div class="form-row">
								<div class="form-group col-md-8">
									<label class="col-form-label">File Surat</label>
									<input type="file" class="form-control dropify" name="file_surat" id="file_surat" onchange="doAfterSelectImage(this)">
									<span class="form-text text-danger"><?= form_error('file_surat'); ?></span>
								</div>
							</div>
							<button type="submit" class="btn btn-primary waves-effect waves-light">Tambah Data</button>

							<?= form_close() ?>

						</div> <!-- end card-body -->
					</div> <!-- end card-->
				</div> <!-- end col -->
			</div>
			<!-- end row -->

		</div> <!-- container -->

	</div> <!-- content -->

</div>

<!-- ============================================================== -->
<!-- End Page content -->
<!-- ============================================================== -->
<script>
	function doAfterSelectImage(input) {
		let fileData = input.files[0];
		let imgtype = fileData.type;
		let match = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
		if (!(imgtype == match[0] || imgtype == match[1] || imgtype == match[2])) {
			Swal.fire({
				icon: 'warning',
				title: 'File yang harus diupload hanya berupa File berjenis pdf atau docx!',
			});
			document.getElementById('file_surat').value = "";
		}
	}
</script>
