<section style="padding: 100px 0;">
	<div class="container">
		<div class="row">
			<div class="col-md-10 mx-auto">
				<div class="text-justify p-5 shadow" style="height: 1000px">
					<h2 class="mb-3"><?= $notulensi['judul'] ?></span></h2>
					<small>Author: <?= $notulensi['penulis'] ?></small>			
					<h6 class="mb-3">Terakhir diubah : <?= date('l, d F Y', strtotime($notulensi['waktu_post'])) ?> <i class="fas fa-fw fa-edit"></i></h6>
					<p>
						<img src="<?= base_url('uploads/notulensi/').$notulensi['thumbnail'] ?>" class="img-thumbnail float-left mr-3" alt="<?= $notulensi['thumbnail'] ?>" style="width: 300px;"><?= $notulensi['isi'] ?>
					</p>
					<a href="<?= base_url('user/dashboard/notulensi') ?>" class="">Kembali</a>
				</div>
			</div>
		</div>
	</div>
</section>