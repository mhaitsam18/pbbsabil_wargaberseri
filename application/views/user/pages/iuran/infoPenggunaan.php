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
						Info Keuangan Iuran | <?php echo $pemasukan[0]->bulan_pemasukan ?>
					</div>

					<div class="card-body">
					<div class="text-right">
								<b><?php $hasil_rupiah = "Rp " . number_format($totalsaldo[0]->total_saldo, 0, ',', '.'); ?>
								Saldo : <?php echo $hasil_rupiah; ?></b>
							</div>
						<table class="table">
						<div class="text-left">
								<b>Pengeluaran</b>
							</div>
							<thead>
								<tr>
									<th scope="col">No</th>
									<th scope="col">Nama Kebutuhan</th>
									<th scope="col">Kategori</th>
									<th scope="col">Jumlah Pengeluaran</th>
									<th scope="col">Tanggal Pengeluaran</th>
									<th scope="col">Keterangan</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no = 1;
								foreach ($penggunaan as $pengguna) { ?>
									<tr>
										<th><?php echo $no++; ?></th>
										<th> <?php echo $pengguna->nama_kebutuhan; ?></th>
										<th> <?php echo $pengguna->kategori ?></th>
										<th> <?php echo "Rp " . number_format($pengguna->jumlah_pengeluaran, 0, '', '.'); ?></th>
										<th> <?php $tanggal =  strtotime($pengguna->tanggal_penggunaan);
												echo date('d-M-Y', $tanggal); ?></th>
										<th> <?php echo $pengguna->keterangan; ?></th>
									</tr>
								<?php } ?> 
								<tr>
									<td>Jumlah Pengeluaran : </td> &nbsp;&nbsp;&nbsp;
									<td><?php echo "Rp " . number_format($keuangan[0]->pengeluaran, 0, '', '.'); ?></td>
								</tr>
							</tbody>
							</table>
							<table class="table">
							<div class="text-left">
								<b>Pemasukan</b>
							</div>	
									<th scope="col">No</th>
									<th scope="col">Nama Pemasukan</th>
									<th scope="col">Kategori</th>
									<th scope="col">Jumlah Pemasukan</th>
									<th scope="col">Tanggal Pemasukan</th>
									<th scope="col">Keterangan</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no = 1;
								foreach ($pemasukan as $iuran) { ?>
									<tr>
										<th><?php echo $no++; ?></th>
										<th> <?php echo $iuran->nama_pemasukan; ?></th>
										<th> <?php echo $iuran->kategori ?></th>
										<th> <?php echo "Rp " . number_format($iuran->jumlah_pemasukan, 0, '', '.'); ?></th>
										<th> <?php $tanggal =  strtotime($iuran->tanggal_pemasukan);
												echo date('d-M-Y', $tanggal); ?></th>
									</tr>
									<?php } ?> 
								<tr>
									<td>Jumlah Pemasukan : </td> &nbsp;&nbsp;&nbsp;
									<td><?php echo "Rp " . number_format($keuangan[0]->pemasukan, 0, '', '.'); ?></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


