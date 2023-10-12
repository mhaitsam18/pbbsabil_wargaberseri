<div class="content-page">
	<div class="content">

		<!-- Start Content-->
		<div class="container-fluid">

			<div class="container-fluid">
				<div class="card shadow mb-4">
					<div class="card-header py-3">
						<h6 class="m-0 font-weight-bold text-primary">
							<form enctype="multipart/form-data" method="POST" action="<?php echo base_url(); ?>admin/Dashboard/create"> <input class="btn btn-primary" type="submit" value=" Tambah Data +"> </form>
						</h6>
					</div>
					<div class="card-body">
						<div class="text-center">
							<table class="table table-bordered" style="height:-150px">
								<thead>
									<tr>
										<th scope="col" style="width: 5%">No</th>
										<th scope="col">Foto Lokasi</th>
										<th scope="col">Nama Lokasi</th>
										<th scope="col">Alamat Lokasi</th>
										<th scope="col">Fasilitas Lokasi</th>
										<th scope="col" colspan="3" style="width: 15%">Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 1;
									foreach ($data_fasilitas as $f) { ?>
										<tr>
											<th scope="row"> <?php echo $no++ ?></th>
											<td style="width: 150px"><img src="<?= $f->foto_lokasi; ?>" width="150px" height="100px"></td>
											<td style="width: 200px"><?php echo $f->nama_lokasi ?></td>
											<td><?php echo $f->alamat_lokasi ?></td>
											<td><?php echo $f->fasilitas_lokasi ?></td>
											<td> <a href="<?= base_url('admin/dashboard/edit/' . $f->no) ?>" class="btn btn-sm btn-success"> <i class="fa fa-pen"> <i> </td>
											<td> <a href="<?= base_url('admin/dashboard/delete/' . $f->no) ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> </a> </td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
							<!-- <!DOCTYPE html>
          <html>
          <head>
          <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA_paQmlBSHBkpEiZofZxdEEF1NJ9jUTaM&callback=initialize" async defer></script>
          <script type="text/javascript">
          // variabel global marker
          var marker;
          function buatMarker(peta, posisiTitik){
              if( marker ){
                // pindahkan marker
                marker.setPosition(posisiTitik);
              } else {
                // buat marker baru
                marker = new google.maps.Marker({
                  position: posisiTitik,
                  map: peta
                });
              }
          }
          function initialize() {
            var propertiPeta = {
              center: new google.maps.LatLng(-6.9729552,107.6365337),
            zoom: 17,
              mapTypeId:google.maps.MapTypeId.ROADMAP
            };

            var peta = new google.maps.Map(document.getElementById("googleMap"), propertiPeta);

            // even listner ketika peta diklik
            google.maps.event.addListener(peta, 'click', function(event) {
              buatMarker(this, event.latLng);
            });
          }
          </script>
          </head>
          <body>
            <div id="googleMap" style="width:100%;height:500px;"></div>
          </body>
          </html> -->

							<!-- CARA MENAMPILKAN : -->
							<!-- <section class="map1 cid-qv5AtTlAOw" id="map1-4y" data-rv-view="10734">
        <div class="google-map"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.305551337187!2d107.6361689142461!3d-6.973232094962348!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e9b3dbad8a1f%3A0x89ae734cc4aba80b!2sJl.%20Komp.%20Permata%20Buah%20Batu%2C%20Lengkong%2C%20Kec.%20Bojongsoang%2C%20Bandung%2C%20Jawa%20Barat%2040287!5e0!3m2!1sid!2sid!4v1584367442855!5m2!1sid!2sid" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe></div>
        </section> -->
						</div>
					</div>
				</div>
			</div>
