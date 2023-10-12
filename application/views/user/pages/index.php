<style>
	#mapppp {
		height: 450px;
		/* The height is 400 pixels */
		width: 100%;
		/* The width is the width of the web page */
	}

	.btn {
		padding: 18px 35px;
	}
</style>
<?php unset($_SESSION['flash']); ?>
<div class="main-wrapper ">
	<!-- Section Menu End -->

	<!-- Section Slider Start -->
	<!-- Slider Start -->
	<section class="slider">
		<div class="container">
			<div class="row">
				<div class="col-md-5">
					<?php $dashboard = $this->db->get_where('dashboard', ['id' => 2])->row_array(); ?>
					<?= $dashboard['content']; ?>
					<?php if (!$this->session->id_warga) : ?>
						<a href="<?php echo base_url('user/auth') ?>" class="btn btn-main ">Masuk Sekarang <i class="ti-angle-right ml-3"></i></a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>
	<!-- Section Slider End -->

	<!-- Section Intro Start -->
	<section class="mt-80px">
		<div class="container">
			<div class="row ">
				<div class="col-lg-4 col-md-6">
					<div class="card p-5 border-0 rounded-top border-bottom position-relative hover-style-1">
						<span class="number">01</span>
						<h3 class="mt-3">Pendataan Warga</h3>
						<p class="mt-3 mb-4">Untuk melakukan pendataan silahkan klik halaman ini.</p>
						<a href="<?php echo base_url('user/warga') ?>" class="text-color text-uppercase font-size-13 letter-spacing font-weight-bold"><i class="ti-minus mr-2 "></i>lakukan pendataan</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="card p-5 border-0 rounded-top hover-style-1">
						<span class="number">02</span>
						<h3 class="mt-3">Pendataan Dana Iuran</h3>
						<p class="mt-3 mb-4">Untuk melakukan pembayaran dana iuran silahkan klik halaman ini.</p>
						<a href="<?php echo base_url('user/iuran') ?>" class="text-color text-uppercase font-size-13 letter-spacing font-weight-bold"><i class="ti-minus mr-2 "></i>more Details</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="card p-5 border-0 rounded-top hover-style-1">
						<span class="number">03</span>
						<h3 class="mt-3">Fasilitas Warga</h3>
						<p class="mt-3 mb-4">Untuk melihat fasilitas yang tersedia silahkan klik halaman ini.</p>
						<a href="<?php echo base_url('user/dashboard/view_fasilitas') ?>" class="text-color text-uppercase font-size-13 letter-spacing font-weight-bold"><i class="ti-minus mr-2 "></i>Lihat Fasilitas</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Section Intro End -->

	<!-- Section About start -->
	<br>

	<section class="map1 cid-qv5AtTlAOw" id="map1-4y" data-rv-view="10734">
		<div class="google-map">
			<div id="mapppp"></div>
			<!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.305551337187!2d107.6361689142461!3d-6.973232094962348!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e9b3dbad8a1f%3A0x89ae734cc4aba80b!2sJl.%20Komp.%20Permata%20Buah%20Batu%2C%20Lengkong%2C%20Kec.%20Bojongsoang%2C%20Bandung%2C%20Jawa%20Barat%2040287!5e0!3m2!1sid!2sid!4v1584367442855!5m2!1sid!2sid" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe> -->
		</div>
	</section>

	<section class="section about">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-6">
					<img src="<?= base_url('uploads/berita/' . $berita_terkini['thumbnail']) ?>" alt="" class="img-fluid rounded shadow w-100">
				</div>

				<div class="col-lg-6">
					<div class="pl-3 mt-5 mt-lg-0">
						<h2 class="mt-1 mb-3"><?= $berita_terkini['judul'] ?></h2>

						<p class="mb-4"><?= $berita_terkini['isi'] ?></p>

						<a href="<?php echo base_url('user/dashboard/berita') ?>" class="btn btn-main">Lihat Berita<i class="fa fa-angle-right ml-2"></i></a>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Berita -->

	<section class="section about">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-6">
					<img src="<?= base_url('uploads/pengumuman/' . $pengumuman_terkini['thumbnail']) ?>" alt="<?= $pengumuman_terkini['thumbnail'] ?>" class="img-fluid rounded shadow w-100">
				</div>

				<div class="col-lg-6">
					<div class="pl-3 mt-5 mt-lg-0">
						<h2 class="mt-1 mb-3"><?= $pengumuman_terkini['judul'] ?></h2>
						<p class="mb-4"><?= $pengumuman_terkini['isi'] ?></p>
						<a href="<?php echo base_url('user/dashboard/informasi') ?>" class="btn btn-main">Lihat Pengumuman<i class="fa fa-angle-right ml-2"></i></a>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="section about">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-6">
					<img src="<?= base_url('uploads/peraturan/' . $peraturan_terkini['thumbnail']) ?>" class="img-fluid rounded shadow w-100">
				</div>

				<div class="col-lg-6">
					<div class="pl-3 mt-5 mt-lg-0">
						<h2 class="mt-1 mb-3"><?= $peraturan_terkini['judul'] ?></h2>
						<p class="mb-4"><?= $peraturan_terkini['isi'] ?></p>
						<a href="<?php echo base_url('user/dashboard/peraturan') ?>" class="btn btn-main">Lihat Peraturan<i class="fa fa-angle-right ml-2"></i></a>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php if ($this->session->userdata('id_warga')) : ?>
		<section class="section about">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-lg-6">
						<img src="<?= base_url('uploads/notulensi/' . $notulensi_terkini['thumbnail']) ?>" class="img-fluid rounded shadow w-100">
					</div>

					<div class="col-lg-6">
						<div class="pl-3 mt-5 mt-lg-0">
							<h2 class="mt-1 mb-3"><?= $notulensi_terkini['judul'] ?></h2>
							<p class="mb-4"><?= $notulensi_terkini['isi'] ?></p>
							<a href="<?php echo base_url('user/dashboard/notulensi') ?>" class="btn btn-main">Lihat Notulensi<i class="fa fa-angle-right ml-2"></i></a>
						</div>
					</div>
				</div>
			</div>
		</section>
	<?php endif ?>
	<!-- Section About End -->
	<section class="section about">
		<div class="container">
			<div class="col-lg-12">
				<h2>Musrembang</h2>
				<table class="table table-hover" id="dataTable">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Program</th>
							<th scope="col">Kegiatan</th>
							<th scope="col">Sasaran</th>
							<th scope="col">Volume / Lokasi</th>
							<th scope="col">Diusulkan oleh</th>
							<th scope="col">Keterangan</th>
							<th scope="col">Status</th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1; ?>
						<?php foreach ($musrembang as $key) : ?>
							<tr>
								<th scope="row"><?= $no ?></th>
								<td><?= $key['program'] ?></td>
								<td><?= $key['kegiatan'] ?></td>
								<td><?= $key['sasaran'] ?></td>
								<td><?= $key['volume_lokasi'] ?></td>
								<td><?= $key['pengusul'] ?></td>
								<td><?= $key['keterangan'] ?></td>
								<td><?= $key['status'] ?></td>
							</tr>
							<?php $no++; ?>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</section>

	<!-- section Call To action start -->
	<section class="section cta">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-8 col-md-12 col-sm-12">
					<div class="text-center">
						<span class="h6 letter-spacing text-white">Selamat datang</span>
						<h2 class="text-lg mt-4 mb-5 text-white">
							Warga Pemata <span class="text-color">Buah Batu</span>
						</h2>
					</div>
				</div>
			</div>
		</div>

	</section>


	<!-- Section Footer Start -->

	<script>
		var markers = [];
		markers = <?= json_encode($fasilitas) ?>;

		function initMap() {
			// The location of Uluru
			const uluru = {
				lat: parseFloat(markers[0]['lat']),
				lng: parseFloat(markers[0]['long'])
			};
			console.log(markers[0]);
			// const uluru = { lat: -6.9569959915425486, lng: 107.71047678591479 };
			// The map, centered at Uluru
			const map = new google.maps.Map(document.getElementById("mapppp"), {
				zoom: 16,
				center: uluru,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			});

			var infoWindow = new google.maps.InfoWindow;

			// The marker, positioned at Uluru
			for (var i = 0; i < markers.length; i++) {
				var tanda = markers[i];
				const marker = new google.maps.Marker({
					position: {
						lat: parseFloat(tanda['lat']),
						lng: parseFloat(tanda['long'])
					},
					map: map,
					title: tanda['nama_lokasi'],
					visible: true
				});
				console.log(marker);

				//Attach click event to the marker.
				(function(marker, tanda) {
					google.maps.event.addListener(marker, "click", function(e) {
						//Wrap the content inside an HTML DIV in order to set height and width of InfoWindow.
						infoWindow.setContent(`
						<div class="card" style="width: 18rem;">
						<img class="card-img-top" src="${tanda.foto_lokasi}" alt="Card image cap">
						<div class="card-body">
							<h5 class="card-title">${tanda.nama_lokasi}</h5>
							<p class="card-text">${tanda.fasilitas_lokasi}</p>
						</div>
						</div>
						`);
						infoWindow.open(map, marker);
					});
				})(marker, tanda);
			}
		}
	</script>

	<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDcdCIn09zTQi2T21FOiGgTFNkZUoz2hqU&callback=initMap&libraries=&v=weekly" async> -->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDcdCIn09zTQi2T21FOiGgTFNkZUoz2hqU&callback=initMap&libraries=&v=weekly" async>
	</script>
