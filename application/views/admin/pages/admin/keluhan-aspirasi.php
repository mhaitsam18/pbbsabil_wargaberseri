    <div class="content-page">
    	<div class="content">
    		<!-- Begin Page Content -->
    		<div class="container-fluid">
    			<!-- Page Heading -->
    			<h1 class="h3 mb-4 text-gray-800">Keluhan</h1>
    			<?= $this->session->flashdata('messageKeluhan'); ?>
    			<div class="row">
    				<div class="col-lg-12">
    					<a href="<?= base_url('admin/KeluhanAspirasi/clearKeluhan') ?>" class="btn btn-danger mb-3" onclick="return confirm('Are you sure?');">Bersihkan Keluhan</a>
    					<table class="table table-hover">
    						<thead>
    							<tr>
    								<th scope="col">No</th>
    								<th scope="col">Nama</th>
    								<th scope="col">Nomor WhatsApp</th>
    								<th scope="col">Jenis Keluhan</th>
    								<th scope="col">Status</th>
    								<th scope="col">Waktu Kirim</th>
    								<th scope="col">Action</th>
    							</tr>
    						</thead>
    						<tbody>
    							<?php $no = 1; ?>
    							<?php $color = ''; ?>
    							<?php foreach ($keluhan as $key) : ?>
    								<?php
									$tanggal = new DateTime($key['waktu_kirim']);
									$sekarang = new DateTime();
									$perbedaan = $tanggal->diff($sekarang);
									?>
    								<?php if ($key['status'] == 'Belum diproses' && $perbedaan->d > 2) : ?>
    									<?php $color = 'table-light'; ?>
    								<?php elseif ($key['status'] == 'Sedang diproses') : ?>
    									<?php $color = 'table-warning'; ?>
    								<?php elseif ($key['status'] == 'Sudah diproses') : ?>
    									<?php $color = 'table-success'; ?>
    								<?php elseif ($key['status'] == 'Belum diproses') : ?>
    									<?php $color = 'table-light'; ?>
    								<?php endif ?>
    								<tr class="<?= $color ?>">
    									<th scope="row"><?= $no ?></th>
    									<td><?= $key['nama'] ?></td>
    									<td><?= $key['no_wa'] ?></td>
    									<td><?= $key['jenis_keluhan'] ?></td>
    									<td><?= $key['status'] ?></td>
    									<td><?= $key['waktu_kirim'] ?></td>
    									<td>
    										<a href="" class="badge badge-primary detailKeluhanModalButton" data-toggle="modal" data-target="#newKeluhanModal" data-id="<?= $key['id'] ?>">Detail</a>
    										<a href="<?= base_url("admin/KeluhanAspirasi/deleteKeluhan/$key[id]"); ?>" class="badge badge-danger" onclick="return confirm('Are you sure?');">Delete</a>
    									</td>
    								</tr>
    								<?php $no++; ?>
    							<?php endforeach ?>
    						</tbody>
    					</table>
    				</div>
    			</div>

    		</div>
    		<!-- Begin Page Content -->
    		<div class="container-fluid">
    			<!-- Page Heading -->
    			<h1 class="h3 mb-4 text-gray-800">Aspirasi</h1>
    			<?= $this->session->flashdata('messageAspirasi'); ?>
    			<div class="row">
    				<div class="col-lg-12">
    					<a href="<?= base_url('admin/KeluhanAspirasi/clearAspirasi') ?>" class="btn btn-danger mb-3" onclick="return confirm('Are you sure?');">Bersihkan Aspirasi</a>
    					<table class="table table-hover">
    						<thead>
    							<tr>
    								<th scope="col">No</th>
    								<th scope="col">Nama</th>
    								<!-- <th scope="col">Email</th> -->
    								<th scope="col">Nomor WhatsApp</th>
    								<th scope="col">Jenis Aspirasi</th>
    								<th scope="col">Status</th>
    								<th scope="col">Waktu Kirim</th>
    								<th scope="col">Action</th>
    							</tr>
    						</thead>
    						<tbody>
    							<?php $no = 1; ?>
    							<?php foreach ($aspirasi as $key) : ?>

    								<?php
									$tanggal = new DateTime($key['waktu_kirim']);
									$sekarang = new DateTime();
									$perbedaan = $tanggal->diff($sekarang);
									?>
    								<?php if ($key['status'] == 'Belum diproses' && $perbedaan->d > 2) : ?>
    									<?php $color = 'table-light'; ?>
    								<?php elseif ($key['status'] == 'Sedang diproses') : ?>
    									<?php $color = 'table-warning'; ?>
    								<?php elseif ($key['status'] == 'Sudah diproses') : ?>
    									<?php $color = 'table-success'; ?>
    								<?php elseif ($key['status'] == 'Belum diproses') : ?>
    									<?php $color = 'table-light'; ?>
    								<?php endif ?>
    								<tr class="<?= $color ?>">
    									<th scope="row"><?= $no ?></th>
    									<td><?= $key['nama'] ?></td>
    									<!-- <td><?= $key['email'] ?></td> -->
    									<td><?= $key['no_wa'] ?></td>
    									<td><?= $key['jenis_aspirasi'] ?></td>
    									<td><?= $key['status'] ?></td>
    									<td><?= $key['waktu_kirim'] ?></td>
    									<td>
    										<a href="" class="badge badge-primary detailAspirasiModalButton" data-toggle="modal" data-target="#newAspirasiModal" data-id="<?= $key['id'] ?>">Detail</a>
    										<a href="<?= base_url("admin/keluhanaspirasi/deleteAspirasi/$key[id]"); ?>" class="badge badge-danger" onclick="return confirm('Are you sure?');">Delete</a>
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
    <div class="modal fade" id="newAspirasiModal" tabindex="-1" aria-labelledby="newAspirasiModalLabel" aria-hidden="true">
    	<div class="modal-dialog">
    		<div class="modal-content">
    			<div class="modal-header">
    				<h5 class="modal-title" id="newAspirasiModalLabel">Detail Aspirasi</h5>
    				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    					<span aria-hidden="true">&times;</span>
    				</button>
    			</div>
    			<form action="<?= base_url('admin/KeluhanAspirasi/updateAspirasi') ?>" method="post">
    				<input type="hidden" name="id" id="ida">
    				<div class="modal-body">
    					<div class="form-group">
    						<label for="name">Nama Lengkap</label>
    						<input type="text" class="form-control" id="nama_aspirasi" name="nama" readonly>
    					</div>
    					<div class="form-group">
    						<label for="no_wa">Nomor WhatsApp</label>
    						<input type="number" class="form-control" id="no_wa_aspirasi" name="no_wa" readonly>
    					</div>
    					<div class="form-group">
    						<label for="jenis_aspirasi">Jenis Aspirasi</label>
    						<input type="text" class="form-control" id="jenis_aspirasi" name="jenis_aspirasi" readonly>
    					</div>
    					<div class="form-group">
    						<label for="aspirasi">Aspirasi</label>
    						<textarea class="form-control" id="aspirasi" name="aspirasi" readonly></textarea>
    					</div>
    					<div class="form-group">
    						<label for="waktu_kirim">Waktu Kirim</label>
    						<input type="text" class="form-control" id="waktu_kirim_aspirasi" name="waktu_kirim" readonly>
    					</div>
    					<div class="form-group">
    						<label for="bukti">Bukti Aspirasi</label>
    						<br>
    						<img src="" id="bukti_aspirasi" class="img-thumbnail" width="300px">
    					</div>
    					<div class="form-group">
    						<label for="status">Status</label>
    						<select class="form-control" id="status_aspirasi" name="status">
    							<option value="Belum diproses">Belum diproses</option>
    							<option value="Sedang diproses">Sedang diproses</option>
    							<option value="Sudah diproses">Sudah diproses</option>
    						</select>
    						<?= form_error('status', '<small class="text-danger pl-3">', '</small>'); ?>
    					</div>
    				</div>
    				<div class="modal-footer">
    					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
    					<button type="submit" class="btn btn-primary">Ubah Status</button>
    				</div>
    			</form>
    		</div>
    	</div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="newKeluhanModal" tabindex="-1" aria-labelledby="newKeluhanModalLabel" aria-hidden="true">
    	<div class="modal-dialog">
    		<div class="modal-content">
    			<div class="modal-header">
    				<h5 class="modal-title" id="newKeluhanModalLabel">Detail Keluhan</h5>
    				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    					<span aria-hidden="true">&times;</span>
    				</button>
    			</div>
    			<form action="<?= base_url('admin/KeluhanAspirasi/updateKeluhan') ?>" method="post">
    				<input type="hidden" name="id" id="idk">
    				<div class="modal-body">
    					<div class="form-group">
    						<label for="name">Nama Lengkap</label>
    						<input type="text" class="form-control" id="nama_keluhan" name="nama" readonly>
    					</div>
    					<div class="form-group">
    						<label for="no_wa">Nomor WhatsApp</label>
    						<input type="number" class="form-control" id="no_wa_keluhan" name="no_wa" readonly>
    					</div>
    					<div class="form-group">
    						<label for="jenis_keluhan">Jenis Keluhan</label>
    						<input type="text" class="form-control" id="jenis_keluhan" name="jenis_keluhan" readonly>
    					</div>
    					<div class="form-group">
    						<label for="keluhan">Keluhan</label>
    						<textarea class="form-control" id="keluhan" name="keluhan" readonly></textarea>
    					</div>
    					<div class="form-group">
    						<label for="waktu_kirim">Waktu Kirim</label>
    						<input type="text" class="form-control" id="waktu_kirim_keluhan" name="waktu_kirim" readonly>
    					</div>
    					<div class="form-group">
    						<label for="bukti">Bukti Keluhan</label>
    						<br>
    						<img src="" id="bukti_keluhan" class="img-thumbnail" width="300px">
    					</div>
    					<div class="form-group">
    						<label for="status">Status</label>
    						<select class="form-control" id="status_keluhan" name="status">
    							<option value="Belum diproses">Belum diproses</option>
    							<option value="Sedang diproses">Sedang diproses</option>
    							<option value="Sudah diproses">Sudah diproses</option>
    						</select>
    						<?= form_error('status', '<small class="text-danger pl-3">', '</small>'); ?>
    					</div>
    				</div>
    				<div class="modal-footer">
    					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
    					<button type="submit" class="btn btn-primary">Ubah Status</button>
    				</div>
    			</form>
    		</div>
    	</div>
    </div>
