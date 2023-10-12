<div class="main-wrapper ">
	<section class="page-title bg-2">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 text-center">
					<ul class="list-inline mb-0">
						<li class="list-inline-item"><a href="index.html" class="text-sm letter-spacing text-white text-uppercase font-weight-bold">Home</a></li>
						<li class="list-inline-item"><span class="text-white">|</span></li>
						<li class="list-inline-item"><a href="#" class="text-color text-uppercase text-sm letter-spacing">Penyediaan Surat</a></li>
					</ul>
					<h1 class="text-lg text-white mt-2">Penyediaan Surat</h1>
				</div>
			</div>
		</div>
	</section>
</div>

<div class="container">

	<?php if (!$template_surat) { ?>
		<h2 class="text-md text-black text-center my-5">Maaf Surat Keterangan/Pengantar Tidak Tersedia</h2>
	<?php } else { ?>
		<?php foreach ($template_surat as $template) : ?>

			<div class="card text-center mt-4">
				<div class="card-header">
					Keperluan Pengajuan <?php echo $template->judul ?>
				</div>
				<div class="card-body">
					<h5 class="card-title">Silahkan Unduh</h5>
					<p class="card-text"><b>Keterangan : <?php echo $template->keterangan_surat ?></b> </p>
					<a href=" <?php echo base_url('user/surat/download_template/' . $template->id_surat) ?>">
						<button class="btn btn-primary">Unduh</button>
					</a>

				</div>

			</div>
			<br>

		<?php endforeach; ?>
	<?php	} ?>

</div>
