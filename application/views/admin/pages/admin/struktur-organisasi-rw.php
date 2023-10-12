<div class="content-page">
	<div class="content">
		<!-- Begin Page Content -->
		<div class="container-fluid">

			<!-- Page Heading -->
			<h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
			<?= $this->session->flashdata('message'); ?>
			<?= form_error('nama', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
			<?= form_error('jabatan', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
			<div class="row">
				<div class="col-lg-11">
					<a href="" class="btn btn-primary mb-3 newStrukturPetugasRWModalButton" data-toggle="modal" data-target="#newStrukturPetugasRWModal">Tambah Struktur Petugas RW</a>
					<table class="table table-hover">
						<thead>
							<tr>
								<th scope="col">No</th>
								<th scope="col">Foto</th>
								<th scope="col">Nama Lengkap</th>
								<th scope="col">Jabatan</th>
								<th scope="col">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1; ?>
							<?php foreach ($petugas_rw as $key) : ?>
								<tr>
									<th scope="row"><?= $no ?></th>
									<td><img src="<?= base_url('uploads/struktur-organisasi-rw/') . $key['foto'] ?>" height="200px" width="200px"></td>
									<td><?= $key['nama'] ?></td>
									<td><?= $key['jabatan'] ?></td>
									<td>
										<a href="<?= base_url("admin/admin/updateStrukturPetugasRW/$key[id]"); ?>" class="badge badge-success updateStrukturPetugasRWModalButton" data-toggle="modal" data-target="#newStrukturPetugasRWModal" data-id="<?= $key['id'] ?>">Ubah</a>
										<a href="<?= base_url("admin/admin/deleteStrukturPetugasRW/$key[id]"); ?>" class="badge badge-danger" onclick="return confirm('Are you sure?');">Hapus</a>
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
<div class="modal fade" id="newStrukturPetugasRWModal" tabindex="-1" aria-labelledby="newStrukturPetugasRWModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="newStrukturPetugasRWModalLabel">Tambah Struktur</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('admin/admin/strukturOrganisasiPetugasRW') ?>" method="post" enctype="multipart/form-data">
				<input type="hidden" name="id" id="id">
				<div class="modal-body">
					<div class="form-group">
						<input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap">
						<?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="Jabatan">
						<?= form_error('jabatan', '<small class="text-danger pl-3">', '</small>'); ?>
					</div>
					<div class="form-group">
						<select class="form-control" id="atasan" name="atasan" placeholder="Atasan">
							<option value="" disabled selected>-- Pilih Atasan --</option>
							<?php foreach ($petugas_rw as $key => $value) { ?>
								<option value="<?= $value['id'] ?>"><?= $value['nama'] ?></option>
							<?php } ?>
						</select>
						<?= form_error('atasan', '<small class="text-danger pl-3">', '</small>'); ?>
					</div>
					<div class="custom-file mb-3">
						<input type="file" class="custom-file-input" id="foto" name="foto" required>
						<label class="custom-file-label" for="foto">Pilih foto...</label>
						<div class="invalid-feedback">Example invalid custom file feedback</div>
						<?= form_error('foto', '<small class="text-danger pl-3">', '</small>'); ?>
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
