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
                <div class="col-12">
                    <div class="card-box">
                        <h4 class="header-title">Filtering</h4>
                        <p class="sub-header">
                            include filtering in your FooTable.
                        </p>
                        <div class="btn-group mb-2">
                            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php if ($this->uri->segment(4) != ''): ?>
                                    RW.0<?= $this->uri->segment(4) ?> 
                                <?php else: ?>
                                    Pilih RW 
                                <?php endif ?>
                                <i class="mdi mdi-chevron-down"></i></button>
                            <div class="dropdown-menu">
                                <?php foreach ($rw as $w): ?>
                                    <a class="dropdown-item" href="<?= base_url('admin/Dashboard/data_warga/'.$w->rw) ?>">RW. 0<?= $w->rw ?></a>
                                <?php endforeach ?>
                            </div>
                        </div><!-- /btn-group -->
                        <?php if ($this->uri->segment(4) != ''): ?>
                            <div class="btn-group mb-2">
                                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?php if ($this->uri->segment(5) != ''): ?>
                                        RT.0<?= $this->uri->segment(5) ?> 
                                    <?php else: ?>
                                        Pilih RT 
                                    <?php endif ?>
                                    <i class="mdi mdi-chevron-down"></i></button>
                                <div class="dropdown-menu">
                                    <?php foreach ($rt as $t): ?>
                                        <a class="dropdown-item" href="<?= base_url('admin/Dashboard/data_warga/'.$this->uri->segment(4).'/'.$t->rt) ?>">RT. 0<?= $t->rt ?></a>
                                    <?php endforeach ?>
                                </div>
                            </div><!-- /btn-group -->
                        <?php endif ?>
                        <div class="mb-2">
                            <div class="row">
                                <div class="col-12 text-sm-center form-inline text-right">
                                    <div class="form-group mr-2">
                                        <select id="demo-foo-filter-status" class="custom-select custom-select-sm">
                                            <option value="">Show all</option>
                                            <option value="active">Active</option>
                                            <option value="disabled">Disabled</option>
                                            <option value="suspended">Suspended</option>
                                        </select>
                                    </div>
                                    <div class="form-group mr-2">
                                        <input id="demo-foo-search" type="text" placeholder="Search" class="form-control form-control-sm" autocomplete="on">
                                    </div>
                                    <div class="" style="margin-left:80%;">
                                        <h4 class="">Total Warga : <?= $detail_warga->num_rows(); ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="demo-foo-filtering" class="table table-bordered toggle-circle mb-0" data-page-size="7">
                                <thead>
                                        <tr>
                                            <th data-toggle="true">Nomor Rumah</th>
                                            <th>Nama Warga</th>
                                            <th data-hide="phone">NIK</th>
                                            <th data-hide="phone, tablet">Nomor HP</th>
                                            <th data-hide="phone, tablet">Alamat</th>
                                            <th data-hide="phone, tablet">Status</th>
                                        </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($detail_warga->result() as $row): ?>
                                    <tr>
                                        <td><?= $row->no_rumah ?></td>
                                        <td><?= $row->nama_warga ?></td>
                                        <td><?= $row->nik ?></td>
                                        <td><?= $row->no_hp ?></td>
                                        <td><?= $row->alamat ?></td>
                                        <td><span class="badge label-table badge-success"><?= $row->status ?></span></td>
                                    </tr>
                                    <?php endforeach ?>
                                </tbody>
                                <tfoot>
                                    <tr class="active">
                                        <td colspan="5">
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
		</div>
        <!-- /.container-fluid -->
    </div>
</div>