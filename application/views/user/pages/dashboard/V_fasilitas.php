<div class="main-wrapper ">
	<section class="page-title bg-3">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 text-center">
					<h1 class="text-lg text-white mt-2">Data Fasilitas Perumahan Permata Buah Batu</h1>
				</div>
			</div>
		</div>
	</section>
</div> <br>


<div class="content-page">
	<div class="content">

		<!-- Start Content-->
		<div class="container-fluid">

			<div class="container-fluid">
				<div class="card shadow mb-4">
					<div class="card-header py-3">
						<h6 class="m-0 font-weight-bold text-primary">
							<form enctype="multipart/form-data" method="POST"> </form>
						</h6>
					</div>
					<div class="card-body">
						<div class="text-center">
							<table class="table table-bordered" style="height:-150px">
								<thead>
									<tr>
										<th scope="col" style="width: 5%">No</th>
										<th scope="col">Foto Lokasi</th>
										<th scope="col">Nama Lokasi</th>
										<th scope="col">Alamat Lokasi</th>
										<th scope="col">Fasilitas Lokasi</th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 1;
									foreach ($data_fasilitas as $f) { ?>
										<tr>
											<th scope="row"> <?php echo $no++ ?></th>
											<td style="width: 150px"><img src="<?= $f->foto_lokasi ?>" width="150px" height="100px"></td>
											<td style="width: 200px"><?php echo $f->nama_lokasi ?></td>
											<td><?php echo $f->alamat_lokasi ?></td>
											<td><?php echo $f->fasilitas_lokasi ?></td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
