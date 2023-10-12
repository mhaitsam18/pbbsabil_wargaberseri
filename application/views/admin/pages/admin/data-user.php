    <div class="content-page">
    	<div class="content">
    		<!-- Begin Page Content -->
    		<div class="container-fluid">

    			<!-- Page Heading -->
    			<h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
    			<?php if (validation_errors()) : ?>
    				<div class="alert alert-danger" role="alert">
    					<?= validation_errors(); ?>
    				</div>
    			<?php endif ?>
    			<?= $this->session->flashdata('message'); ?>
    			<div class="row">
    				<div class="col-lg">
    					<div class="card">
    						<div class="card-header"><i class="fas fa-table mr-1"></i>Data User</div>
    						<div class="card-body">
    							<!-- Button trigger modal -->
    							<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahUserAdminModal">
    								Tambah User Admin
    							</button>
    							<table class="table table-hover" id="dataTable">
    								<thead>
    									<tr>
    										<th scope="col">No</th>
    										<th scope="col">Nama</th>
    										<th scope="col">Email</th>
    										<th scope="col">Role</th>
    										<th scope="col">Status</th>
    										<th scope="col">Tanggal Dibuat</th>
    										<th scope="col">Foto</th>
    										<th scope="col">Aksi</th>
    									</tr>
    								</thead>
    								<tbody>
    									<?php $no = 1; ?>
    									<?php foreach ($user_data as $key) : ?>
    										<tr>
    											<th scope="row"><?= $no ?></th>
    											<td><?= $key['name'] ?></td>
    											<td><?= $key['email'] ?></td>
    											<td><?= $key['role'] ?></td>
    											<td>
    												<?php
													if ($key['is_active'] == 1) {
														echo "Aktif";
													} else {
														echo "Tidak Aktif";
													}
													?>
    											</td>
    											<td><?= $key['date_created'] ?></td>
    											<td><img src="<?= base_url('uploads/profile/') . $key['image'] ?>" width="200px" height="200px"></td>
    											<td>
    												<a href="" class="badge badge-warning setRoleButton" data-toggle="modal" data-target="#setRoleModal" data-id="<?= $key['uid'] ?>">Set Role</a>
													<a href="<?= base_url("admin/admin/deleteDataUser/$key[uid]"); ?>" class="badge badge-danger tombol-hapus" data-hapus="User">Hapus</a>
    											</td>
    										</tr>
    										<?php $no++; ?>
    									<?php endforeach ?>
    								</tbody>
    							</table>
    						</div>
    					</div>
    				</div>
    			</div>
    		</div>
    		<!-- /.container-fluid -->
    	</div>
    </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="tambahUserAdminModal" tabindex="-1" aria-labelledby="tambahUserAdminModalLabel" aria-hidden="true">
    	<div class="modal-dialog">
    		<div class="modal-content">
    			<div class="modal-header">
    				<h5 class="modal-title" id="tambahUserAdminModalLabel">Tambah data admin</h5>
    				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    					<span aria-hidden="true">&times;</span>
    				</button>
    			</div>
    			<div class="modal-body">
    				<form class="user" method="post" action="<?= base_url('admin/admin/registration') ?>">
    					<div class="form-group">
    						<input type="text" class="form-control form-control-user" id="name" name="name" placeholder="Nama Lengkap" value="<?= set_value('name') ?>">
    						<?= form_error('name', '<small class="text-danger pl-3">', '</small>') ?>
    					</div>
    					<div class="form-group">
    						<input type="email" class="form-control form-control-user" id="email" name="email" placeholder="Alamat Email" value="<?= set_value('email') ?>">
    						<?= form_error('email', '<small class="text-danger pl-3">', '</small>') ?>
    					</div>
    					<div class="form-group">
    						<input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Nama Panggilan" value="<?= set_value('username') ?>">
    						<?= form_error('username', '<small class="text-danger pl-3">', '</small>') ?>
    					</div>
    					<div class="form-group">
    						<select class="form-control" name="gender" id="gender">
    							<option value="" disabled selected>Pilih Jenis Kelamin</option>
    							<option value="Laki-laki">Laki-laki</option>
    							<option value="Perempuan">Perempuan</option>
    						</select>
    						<?= form_error('gender', '<small class="text-danger pl-3">', '</small>') ?>
    					</div>
    					<div class="form-group">
    						<input type="text" class="form-control form-control-user" id="place_of_birth" name="place_of_birth" placeholder="Tempat Lahir" value="<?= set_value('place_of_birth') ?>">
    						<?= form_error('place_of_birth', '<small class="text-danger pl-3">', '</small>') ?>
    					</div>
    					<div class="form-group">
    						<input type="date" class="form-control form-control-user" id="birthday" name="birthday" placeholder="Tanggal Lahir" value="<?= set_value('birthday') ?>">
    						<?= form_error('birthday', '<small class="text-danger pl-3">', '</small>') ?>
    					</div>
    					<div class="form-group">
    						<input type="number" class="form-control form-control-user" id="phone_number" name="phone_number" placeholder="Nomor Handphone" value="<?= set_value('phone_number') ?>">
    						<?= form_error('phone_number', '<small class="text-danger pl-3">', '</small>') ?>
    					</div>
    					<div class="form-group">
    						<textarea class="form-control form-control-user" id="address" name="address" rows="3" placeholder="Alamat Rumah"><?= set_value('address') ?></textarea>
    						<?= form_error('address', '<small class="text-danger pl-3">', '</small>') ?>
    					</div>
    					<div class="form-group">
    						<select class="form-control" name="religion_id" id="religion_id">
    							<option value="">Pilih Agama</option>
    							<?php foreach ($agama as $row) : ?>
    								<option value="<?= $row['id'] ?>"><?= $row['agama'] ?></option>
    							<?php endforeach ?>
    						</select>
    						<?= form_error('religion_id', '<small class="text-danger pl-3">', '</small>') ?>
    					</div>
    					<div class="form-group">
    						<select class="form-control" name="role_id" id="role_id">
    							<option value="">Pilih Role</option>
    							<?php foreach ($role as $row) : ?>
    								<option value="<?= $row['id'] ?>"><?= ucwords($row['role']) ?></option>
    							<?php endforeach ?>
    						</select>
    						<?= form_error('role_id', '<small class="text-danger pl-3">', '</small>') ?>
    					</div>
    					<div class="form-group row">
    						<div class="col-sm-6 mb-3 mb-sm-0">
    							<input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Kata Sandi">
    							<?= form_error('password1', '<small class="text-danger pl-3">', '</small>') ?>
    						</div>
    						<div class="col-sm-6">
    							<input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Ulang Kata Sandi">
    							<?= form_error('password2', '<small class="text-danger pl-3">', '</small>') ?>
    						</div>
    					</div>
    					<button typer="submit" class="btn btn-primary btn-user btn-block">
    						Daftar Akun
    					</button>
    				</form>
    			</div>
    			<!--<div class="modal-footer">-->
    			<!--	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
    			<!--	<button type="button" class="btn btn-primary">Save changes</button>-->
    			<!--</div>-->
    		</div>
    	</div>
    </div>

    <!-- End of Main Content -->

    <!-- Modal -->
    <div class="modal fade" id="setRoleModal" tabindex="-1" aria-labelledby="setRoleLabel" aria-hidden="true">
    	<div class="modal-dialog">
    		<div class="modal-content">
    			<div class="modal-header">
    				<h5 class="modal-title" id="setRoleLabel">Set User Role</h5>
    				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    					<span aria-hidden="true">&times;</span>
    				</button>
    			</div>
    			<form action="<?= base_url('admin/admin/setRole/') ?>" method="post">
    				<input type="hidden" name="id" id="id">
    				<div class="modal-body">
    					<div class="form-group">
    						<input type="text" class="form-control" id="name" name="name" readonly>
    					</div>
    					<div class="form-group">
    						<select class="form-control" name="role_id" id="role_id">
    							<option value="">Pilih Role</option>
    							<?php foreach ($role as $r) : ?>
    								<option value="<?= $r['id'] ?>"><?= $r['role'] ?></option>
    							<?php endforeach ?>
    						</select>
    					</div>
    				</div>
    				<div class="modal-footer">
    					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
    					<button type="submit" class="btn btn-primary">Simpan</button>
    				</div>
    			</form>
    		</div>
    	</div>
    </div>
