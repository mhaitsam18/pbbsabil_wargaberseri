<!-- Begin Page Content -->
<div class="main-wrapper">

	<section class="page-title bg-2">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 text-center">
					<ul class="list-inline mb-0">
						<li class="list-inline-item"><a href="<?php echo base_url(); ?>user/" class="text-sm letter-spacing text-white text-uppercase font-weight-bold">Home</a></li>
						<li class="list-inline-item"><span class="text-white">|</span></li>
						<li class="list-inline-item"><a href="#" class="text-color text-uppercase text-sm letter-spacing">Iuran Warga</a></li>
					</ul>
					<h1 class="text-lg text-white mt-2">Info Keuangan Iuran</h1>
				</div>
			</div>
		</div>
	</section>

	<!-- Begin Page Content -->
	<div class="container-fluid">

		<div class="table-responsive">
			<div class=container>
				<div class="card my-4">
					<div class="card-header">
						Info Keuangan Iuran
					</div>

					<div class="card-body">
					<div class="text-right">
								<b><?php $hasil_rupiah = "Rp " . number_format($totalsaldo[0]->total_saldo, 0, ',', '.'); ?>
								Saldo : <?php echo $hasil_rupiah; ?></b>
							</div>
						<table class="table">
							<thead>
								<tr>
									<th scope="col">No</th>
									<th scope="col">Bulan</th>
									<th scope="col">Tahun</th>
									<th scope="col">Jumlah Pemasukan</th>
									<th scope="col">Jumlah Pengeluaran</th>
									<th scope="col">Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no = 1;
								foreach ($keuangan as $iuran) { ?>
									<tr>
										<th><?php echo $no++; ?></th>
										<th> <?php echo $iuran->bulan; ?></th>
										<th> <?php echo $iuran->tahun; ?></th>
										<th> <?php echo "Rp " . number_format($iuran->pemasukan, 0, '', '.'); ?></th>
										<th> <?php echo "Rp " . number_format($iuran->pengeluaran, 0, '', '.'); ?></th>
										<th><a href="<?php echo base_url('user/iuran/infoPenggunaanIuran/' . $iuran->bulan) ?>"><button class="ladda-button btn btn-primary"><i class="mdi mdi-information-outline"></i>Info</button></a></th>
									<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
