<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<title><?php echo $title ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
	<meta content="Coderthemes" name="author" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<!-- App favicon -->
	<link rel="shortcut icon" href="<?php echo base_url() ?>assets/admin/images/pbb.png">

	<!-- App css -->
	<link href="<?php echo base_url() ?>assets/admin/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url() ?>assets/admin/css/icons.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url() ?>assets/admin/css/app.min.css" rel="stylesheet" type="text/css" />

</head>

<body class="authentication-bg authentication-bg-pattern">

	<div class="account-pages mt-5 mb-5">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-8 col-lg-6 col-xl-5">
					<div class="card bg-pattern">
						<div class="card-body p-4">
							<?php if ($this->session->flashdata('error')) { ?>
								<div class="alert alert-danger col-12">
									<center><?= $this->session->flashdata('error'); ?></center>
								</div>
							<?php } ?>

							<div class="text-center w-75 m-auto">
								<span><img src="<?php echo base_url() ?>assets/admin/images/pbb-logo.png" alt="" height="40"></span>
								<p class="text-muted mb-4 mt-3">Enter your username and password to access admin panel.</p>
							</div>

							<?php echo form_open('admin/auth', array('method' => 'POST')) ?>

							<div class="form-group mb-3">
								<label for="emailaddress">Email address</label>
								<input class="form-control" type="text" name="email" id="email" placeholder="Enter your email">
							</div>

							<div class="form-group mb-3">
								<label for="password">Password</label>
								<input class="form-control" type="password" name="password" id="password" placeholder="Enter your password">
							</div>

							<div class="form-group mb-0 text-center">
								<button class="btn btn-primary btn-block" type="submit"> Log In </button>
							</div>

							<?php echo form_close() ?>
						</div> <!-- end card-body -->
					</div>
					<!-- end card -->
					<!-- end row -->

				</div> <!-- end col -->
			</div>
			<!-- end row -->
		</div>
		<!-- end container -->
	</div>
	<!-- end page -->


	<footer class="footer footer-alt">
		2021 &copy; <a href="#" class="text-white-50">Warga Berseri</a>
	</footer>

	<!-- Vendor js -->
	<script src="<?php echo base_url() ?>assets/admin/js/vendor.min.js"></script>

	<!-- App js -->
	<script src="<?php echo base_url() ?>assets/admin/js/app.min.js"></script>

</body>


</html>
