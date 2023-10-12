<div class="content-page">
	<div class="content">

		<!-- Start Content-->
		<div class="container-fluid">

			<form action="<?= base_url('admin/iuran/iuran_tambahan') ?>" enctype="multipart/form-data" method="post">
				<div class="container-fluid">
					<!-- Illustrations -->
					<div class="card shadow mb-4">
						<div class="card-header py-3">
							<h4 class="page-title">Form Tambah Iuran Non-Reguler / Iuran Tambahan</h4>
						</div>
						<div class="card-body">
							<div class="text-center">
								<form>
									<div class="form-group row">
										<label style="text-align: left" class="col-sm-2 col-form-label">Nominal</label>
										<div class="col-sm-10">
											<input type="number" class="form-control" name="nominal">
										</div>
									</div>
									
									<div style="text-align: right" class="col-sm-12">
										<button onclick="simpan()" class="btn btn-primary">Simpan</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</form>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="<?php echo base_url('assets/js/sweetalert2.all.min.js') ?>"></script>
<!-- 	<script>
	function simpan
	Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.isConfirmed) {
    Swal.fire(
      'Deleted!',
      'Your file has been deleted.',
      'success'
    )
  }
});
</script> -->
	<script>
	function simpan(){
		Swal.fire({
		icon: 'success',
		title: 'Data Iuran',
		text: 'Berhasil Ditambahkan',
		timer:50000
			});
	}
</script>