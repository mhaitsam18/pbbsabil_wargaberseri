<div class="content-page">
	<div class="content">
		<!-- Begin Page Content -->
		<div class="container-fluid">
			<!-- Page Heading -->
			<h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
			<?= $this->session->flashdata('message'); ?>
			<?= form_error('judul', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
			<?= form_error('isi', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
			<?= form_error('thumbnail', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
			<div class="row">
				<div class="col-lg-12">
					<div class="mb-2">
                            <div class="row">
                                <div class="col-12 text-sm-center form-inline">
                                    <div class="form-group mr-2">
                                        <select id="demo-foo-filter-status" class="custom-select custom-select-sm">
                                            <option value="">Tampilkan Semua</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input id="demo-foo-search" type="text" placeholder="Cari" class="form-control form-control-sm" autocomplete="on">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mr-2" style="float:right; margin-left:80%;">
                                <!-- <a href="<?php echo base_url('admin/pemasukan/tambah_pemasukan') ?>" class="btn btn-secondary"><i class="mdi mdi-plus-circle mr-2"></i>Tambah Data</a> -->
                            </div>
                        </div>
                        <a href="" class="btn btn-primary mb-3 newPeraturanModalButton" data-toggle="modal" data-target="#newPeraturanModal">Tambah Peraturan</a>
					<table class="table table-hover"  id="demo-foo-filtering" data-page-size="7">
						<thead>
							<tr>
								<th scope="col">No</th>
								<th scope="col">Judul</th>
								<th scope="col">Isi</th>
								<th scope="col">Penulis</th>
								<th scope="col">Waktu Post</th>
								<th scope="col">Terakhir diubah</th>
								<th scope="col">Foto</th>
								<th scope="col">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1; ?>
							<?php foreach ($peraturan as $key) : ?>
								<tr>
									<th scope="row"><?= $no ?></th>
									<td><?= $key['judul'] ?></td>
									<td><?= $key['isi'] ?></td>
									<td><?= $key['penulis'] ?></td>
									<td><?= $key['waktu_post'] ?></td>
									<td><?= $key['terakhir_diubah'] ?></td>
									<td><img src="<?= base_url('uploads/peraturan/') . $key['thumbnail'] ?>" class="img-thumbnail" style="width: 300px;"></td>
									<td>
										<a href="<?= base_url("admin/Pengurus/updatePeraturan/$key[id]"); ?>" class="badge badge-success updatePeraturanModalButton" data-toggle="modal" data-target="#newPeraturanModal" data-id="<?= $key['id'] ?>">Ubah</a>
										<a href="<?= base_url("admin/Pengurus/deletePeraturan/$key[id]"); ?>" class="badge badge-danger" onclick="return confirm('Are you sure?');">Hapus</a>
									</td>
								</tr>
								<?php $no++; ?>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<!-- /.container-fluid -->
	</div>
</div>
</div>
<!-- End of Main Content -->

<!-- Modal -->
<div class="modal fade" id="newPeraturanModal" tabindex="-1" aria-labelledby="newPeraturanModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="newPeraturanModalLabel">Tambah Peraturan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('admin/Pengurus/peraturan') ?>" method="post" enctype="multipart/form-data">
				<input type="hidden" name="id" id="id">
				<div class="modal-body">
					<div class="form-group">
						<input type="text" class="form-control" id="judul" name="judul" placeholder="Judul">
						<?= form_error('judul', '<small class="text-danger pl-3">', '</small>'); ?>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="penulis" name="penulis" value="<?= $user['name'] ?>" readonly>
					</div>
					<div class="form-group">
						<textarea class="form-control" id="isi" name="isi" placeholder="Isi"></textarea>
					</div>
					<div class="form-group">
						<label for="thumbnail">Upload Foto (.jpg/.png/.jpeg maks. 2Mb)</label>
						<input type="file" class="form-control" id="thumbnail" name="thumbnail">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					<button type="submit" class="btn btn-primary">Tambah</button>
				</div>
			</form>
		</div>
	</div>
</div>
