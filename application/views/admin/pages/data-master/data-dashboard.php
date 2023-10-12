    <div class="content-page">
    	<div class="content">
    		<!-- Begin Page Content -->
    		<div class="container-fluid">

    			<!-- Page Heading -->
    			<h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
    			<?= $this->session->flashdata('message'); ?>
    			<div class="row">
    				<div class="col-lg-8">
    					<form action="<?= base_url('admin/DataMaster/dashboard') ?>" method="post" enctype="multipart/form-data">
    						<input type="hidden" name="id" id="id" value="<?= $dashboard['id'] ?>">
    						<div class="form-group row">
    							<label for="header" class="col-sm-2 col-form-label">Header</label>
    							<div class="col-sm-10">
    								<input type="text" class="form-control" id="header" name="header" value="<?= $dashboard['header'] ?>">
    								<?= form_error('header', '<small class="text-danger pl-3">', '</small>') ?>
    							</div>
    						</div>
    						<div class="form-group row">
    							<label for="title" class="col-sm-2 col-form-label">Title</label>
    							<div class="col-sm-10">
    								<input type="text" class="form-control" id="title" name="title" value="<?= $dashboard['title'] ?>">
    								<?= form_error('title', '<small class="text-danger pl-3">', '</small>') ?>
    							</div>
    						</div>
    						<div class="form-group row">
    							<label for="content" class="col-sm-2 col-form-label">Content</label>
    							<div class="col-sm-10">
    								<textarea class="form-control" id="content" name="content" rows="3"><?= $dashboard['content'] ?></textarea>
    								<?= form_error('content', '<small class="text-danger pl-3">', '</small>') ?>
    							</div>
    						</div>
    						<div class="form-group row">
    							<label for="footer" class="col-sm-2 col-form-label">Footer</label>
    							<div class="col-sm-10">
    								<input type="text" class="form-control" id="footer" name="footer" value="<?= $dashboard['footer'] ?>">
    								<?= form_error('footer', '<small class="text-danger pl-3">', '</small>') ?>
    							</div>
    						</div>
    						<div class="form-group row">
    							<label for="icon" class="col-sm-2 col-form-label">Icon</label>
    							<div class="col-sm-10">
    								<input type="text" class="form-control" id="icon" name="icon" value="<?= $dashboard['icon'] ?>">
    								<?= form_error('icon', '<small class="text-danger pl-3">', '</small>') ?>
    							</div>
    						</div>
    						<div class="form-group row">
    							<label for="side_logo" class="col-sm-2 col-form-label">Side Logo</label>
    							<div class="col-sm-10">
    								<input type="text" class="form-control" id="side_logo" name="side_logo" value="<?= $dashboard['side_logo'] ?>">
    								<?= form_error('side_logo', '<small class="text-danger pl-3">', '</small>') ?>
    							</div>
    						</div>
    						<div class="form-group row">
    							<div class="col-sm-2">Logo</div>
    							<div class="col-sm-10">
    								<div class="row">
    									<div class="col-sm-3">
    										<img src="<?= base_url('uploads/logo/') . $dashboard['logo'] ?>" class="img-thumbnail">
    									</div>
    									<div class="col-sm-9">
    										<div class="custom-file">
    											<input type="file" class="custom-file-input" id="logo" name="logo">
    											<label class="custom-file-label" for="image">Choose file</label>
    											<?= form_error('logo', '<small class="text-danger pl-3">', '</small>') ?>
    										</div>
    									</div>
    								</div>
    							</div>
    						</div>
    						<div class="form-group row">
    							<div class="col-sm">
    								<button type="submit" class="btn btn-primary float-right">Save</button>
    							</div>
    						</div>

    					</form>
    				</div>
    			</div>
    		</div>
    		<!-- /.container-fluid -->
    	</div>
    </div>
    </div>
