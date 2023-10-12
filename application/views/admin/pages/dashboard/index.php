<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->
<style>
	.highcharts-credits {
		display: none;
	}

	.highcharts-root {
		font-family: 'Nunito', sans-serif !important;
		/* color: #98a6ad !important; */
	}
</style>
<?php unset($_SESSION['flash']); ?>
<div class="content-page">
	<div class="content">
		<!-- Start Content-->
		<div class="container-fluid">

			<!-- start page title -->
			<div class="row">
				<div class="col-12">
					<div class="page-title-box">
						<div class="page-title-right">
							<ol class="breadcrumb m-0">
								<li class="breadcrumb-item"><a href="javascript: void(0);">Warga Berseri</a></li>
								<li class="breadcrumb-item active">Dashboard</li>
							</ol>
						</div>
						<h4 class="page-title">Dashboard</h4>
					</div>
				</div>
			</div>
			<!-- end page title -->

			<div class="row">
				<div class="col-md-6 col-xl-3">
					<div class="card-box">
						<div class="row">
							<div class="col-6">
								<div class="avatar-sm bg-blue rounded">
									<i class="mdi mdi-home-city-outline avatar-title font-22 text-white"></i>
								</div>
							</div>
							<div class="col-6">
								<div class="text-right">
									<h3 class="text-dark my-1"><span data-plugin="counterup"><?= $total_warga ?></span>
									</h3>
									<p class="text-muted mb-1 text-truncate">Total Rumah</p>
								</div>
							</div>
						</div>

					</div> <!-- end card-box-->
				</div> <!-- end col -->

				<div class="col-md-6 col-xl-3">
					<div class="card-box">
						<div class="row">
							<div class="col-6">
								<div class="avatar-sm bg-success rounded">
									<i class="fe-users avatar-title font-22 text-white"></i>
								</div>
							</div>
							<div class="col-6">
								<div class="text-right">
									<h3 class="text-dark my-1"><span data-plugin="counterup"><?= $total_hunian ?></span>
									</h3>
									<p class="text-muted mb-1 text-truncate">Total Warga</p>
								</div>
							</div>
						</div>

					</div> <!-- end card-box-->
				</div> <!-- end col -->

				<div class="col-md-6 col-xl-3">
					<div class="card-box">
						<div class="row">
							<div class="col-6">
								<div class="avatar-sm bg-warning rounded">
									<i class="mdi mdi-car-multiple avatar-title font-22 text-white"></i>
								</div>
							</div>
							<div class="col-6">
								<div class="text-right">
									<h3 class="text-dark my-1"><span data-plugin="counterup"><?= $total_kendaraan ?></span></h3>
									<p class="text-muted mb-1 text-truncate">Total Kendaraan</p>
								</div>
							</div>
						</div>
					</div> <!-- end card-box-->
				</div> <!-- end col -->

				<div class="col-md-6 col-xl-3">
					<div class="card-box">
						<div class="row">
							<div class="col-6">
								<div class="avatar-sm bg-info rounded">
									<i class="fe-file-text avatar-title font-22 text-white"></i>
								</div>
							</div>
							<div class="col-6">
								<div class="text-right">
									<h3 class="text-dark my-1"><span data-plugin="counterup"><?= $total_pengajuan ?></span></h3>
									<p class="text-muted mb-1 text-truncate">Total Pengajuan Surat</p>
								</div>
							</div>
						</div>
					</div> <!-- end card-box-->
				</div> <!-- end col -->
			</div>


			<div class="container">
				<div class="row">
					<div class="col">
						<figure class="highcharts-figure">
							<div id="chart_pendidikan"></div>
							<p class="highcharts-description">

							</p>
						</figure>
					</div>
					<div class="col">
						<figure class="highcharts-figure">
							<div id="chart2"></div>
							<p class="highcharts-description">

							</p>
						</figure>
					</div>
					<div class="col">
						<figure class="highcharts-figure">
							<div id="chart_status_hunian"></div>
							<p class="highcharts-description">

							</p>
						</figure>
					</div>
				</div>
			</div>
		</div> <!-- container -->
	</div>
	<?php $null = "Data belum terdaftar" ?>
	<script>
		Highcharts.chart('chart_pendidikan', {
			chart: {
				plotBackgroundColor: null,
				plotBorderWidth: null,
				plotShadow: false,
				type: 'pie'
			},
			title: {
				text: 'Grafik Pendidikan',
				// style: {
				// 	color: '#98a6ad',
				// }
			},
			tooltip: {
				pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
			},
			accessibility: {
				point: {
					valueSuffix: '%'
				}
			},
			plotOptions: {
				pie: {
					allowPointSelect: true,
					cursor: 'pointer',
					dataLabels: {
						enabled: false
					},
					showInLegend: true
				}
			},
			series: [{
				name: 'Total',
				colorByPoint: true,
				data: [
					<?php foreach ($chart_pendidikan as $pendidikan) : ?> {
							name: '<?= $pendidikan->pendidikan ?>',
							y: <?= $pendidikan->total ?>,
						},
					<?php endforeach; ?>
				]
			}]
		});
	</script>

	<script>
		var miskin = "Rentan Miskin";
		Highcharts.chart('chart2', {
			chart: {
				plotBackgroundColor: null,
				plotBorderWidth: null,
				plotShadow: false,
				type: 'pie'
			},
			title: {
				text: 'Grafik Desil'
			},
			tooltip: {
				pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
			},
			accessibility: {
				point: {
					valueSuffix: '%'
				}
			},
			plotOptions: {
				pie: {
					allowPointSelect: true,
					cursor: 'pointer',
					dataLabels: {
						enabled: false
					},
					showInLegend: true
				}
			},
			// colors: ['#FEFEFE', '#50B432', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4'],
			series: [{
				name: 'Total',
				colorByPoint: true,
				data: [
					<?php foreach ($chart_desil as $desil) : ?> {
							name: '<?= $desil->status_rumah_tangga ?>',
							y: <?= $desil->total ?>,
						},
					<?php endforeach ?>
				]
			}]
		});
	</script>

	<script>
		Highcharts.chart('chart_status_hunian', {
			chart: {
				plotBackgroundColor: null,
				plotBorderWidth: null,
				plotShadow: false,
				type: 'pie'
			},
			title: {
				text: 'Grafik Status Hunian'
			},
			tooltip: {
				pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
			},
			accessibility: {
				point: {
					valueSuffix: '%'
				}
			},
			plotOptions: {
				pie: {
					allowPointSelect: true,
					cursor: 'pointer',
					dataLabels: {
						enabled: false
					},
					showInLegend: true
				}
			},
			series: [{
				name: 'Total',
				colorByPoint: true,
				data: [
					<?php foreach ($chart_hunian as $hunian) : ?> {
							name: '<?= $hunian->status_hunian ?>',
							y: <?= $hunian->total ?>,
						},
					<?php endforeach ?>
				]
			}]
		});
	</script>
