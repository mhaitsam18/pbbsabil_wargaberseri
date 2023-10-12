
<!-- Header Close -->

<div class="main-wrapper ">
<section class="page-title bg-2">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
          <ul class="list-inline mb-0">
            <li class="list-inline-item"><a href="index.html" class="text-sm letter-spacing text-white text-uppercase font-weight-bold">Home</a></li>
            <li class="list-inline-item"><span class="text-white">|</span></li>
            <li class="list-inline-item"><a href="#" class="text-color text-uppercase text-sm letter-spacing">our blog</a></li>
          </ul>
           <h1 class="text-lg text-white mt-2">Peraturan</h1>
      </div>
    </div>
  </div>
</section>

<!-- Section Blog start -->
<section class="section blog bg-gray">
	<div class="container">
		<div class="row">
			<?php foreach ($peraturan as $row): ?>
				<div class="col-lg-4 col-md-6">
					<article class="card border-0 rounded-0 mb-4">
						<img src="<?= base_url('uploads/peraturan/').$row['thumbnail'] ?>" alt="<?=$row['thumbnail']?>" class="img-fluid">
						<div class="mt-3 px-4 py-3 ">
							<div class="blog-post-meta text-capitalize mb-2">
								<span class="post-meta date-meta mr-2">
									<i class="ti-calendar mr-2"></i><?= date('l, d F Y', strtotime($row['waktu_post'])) ?>
								</span>
								<span class="post-meta author"><i class="ti-user mr-2 text-muted"></i><?= $row['penulis'] ?></span>
							</div>
							<a href="<?= base_url('user/dashboard/detailPeraturan/').$row['id'] ?>"><h4 class="mb-3 font-secondary"><?= $row['judul'] ?></h4></a>
							<?php 
							$jml_karakter = strlen($row['isi']);
							if ($jml_karakter>50) {
								$isi = strrev($row['isi']);
								$x = $jml_karakter - 50;
								$isi = substr($isi, $x);
								$isi = strrev($isi);
							} else{
								$isi = $row['isi'];
							}
							 ?>
							<p class="mb-4"><?= $isi ?>...</p>
							<a href="<?= base_url('user/dashboard/detailPeraturan/').$row['id'] ?>" class="text-color mb-3 d-block"><i class="ti-minus mr-2"></i> Read More</a>
							<!-- stretched-link -->
						</div>
					</article>
				</div>
			<?php endforeach ?>
		</div>
		<div class="row justify-content-center mt-5">
			<?php echo $this->pagination->create_links(); ?>
		</div>
		<!-- <div class="row justify-content-center mt-5">
			<nav aria-label="Page navigation">
				<ul class="pagination justify-content-center">
					<li class="page-item"><a class="page-link" href="#">Previous</a></li>
					<li class="page-item active" aria-current="page"><a class="page-link" href="#">1</a></li>
					<li class="page-item"><a class="page-link" href="#">2</a></li>
					<li class="page-item"><a class="page-link" href="#">3</a></li>
					<li class="page-item"><a class="page-link" href="#">Next</a></li>
				</ul>
			</nav>
		</div> -->
	</div>
</section>
<!-- Section Blog End -->