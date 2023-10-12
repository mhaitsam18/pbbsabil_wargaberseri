<html>
<head>
	<title>Print kwitansi</title>
	<style type="text/css">
			.lead {
				font-family: "Verdana";
				font-weight: bold;
			}
			.value {
				font-family: "Verdana";
			}
			.value-big {
				font-family: "Verdana";
				font-weight: bold;
				font-size: large;
			}
			.td {
				valign : "top";
			}

			/* @page { size: with x height */
			/*@page { size: 20cm 10cm; margin: 0px; }*/
			@page {
				size: A4;
				margin : 0px;
			}
	/*		@media print {
			  html, body {
			  	width: 210mm;
			  }
			}*/
			/*body { border: 2px solid #000000;  }*/
	</style>
	<script type="text/javascript">
		var beforePrint = function() {
		};

		var afterPrint = function() {
			document.location.href = '/{{hospitalName}}';
		};

		if (window.matchMedia) {
			var mediaQueryList = window.matchMedia('print');
			mediaQueryList.addListener(function(mql) {
				if (mql.matches) {
					beforePrint();
				} else {
					afterPrint();
				}
			});
		}

		window.onbeforeprint = beforePrint;
		window.onafterprint = afterPrint;
    </script>
</head>
<body>
	<table border="1px">
		<tr>
			<td width="80px"><img src="<?php echo base_url('/assets/user/images/pbb.png')?>" width="80px" /></td>
			<td>
				<table cellpadding="4">
					<tr>
						<?php foreach ($iuran as $data_iuran) : ?>
						<td width="200px"><div class="lead">No kwitansi:</td>
						<td><div class="value"><?= $data_iuran->no_tagihan; ?></div></td>
					</tr>
					<tr>
						<td><div class="lead">Telah terima dari:</div></td>
						<td><div class="value"><?= $data_iuran->nama; ?></div></td>
					</tr>
					<tr>
						<td><div class="lead">Untuk Pembayaran:</div></td>
						<td><div class="value"></div>Iuran <?= $data_iuran->jenis; ?> bulan <?= $data_iuran->bulan_iuran; ?> <?= $data_iuran->tahun_iuran; ?></td>
					</tr>
					<tr>
						<td><div class="lead">Tanggal:</div></td>
						<td><div class="value"><?= $data_iuran->tanggal_pembayaran; ?></div></td>
					</tr>
					<tr>
						<td><div class="lead">Rupiah:</div></td>
						<td><div class="value-big">Rp. <?= number_format($data_iuran->nominal, 0, ',', '.'); ?></div></td>
					</tr>
					<tr>
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr>
						<td></td>
					</tr>
					<tr>
						<td>&nbsp;&nbsp;&nbsp;</td>
						<td>____________________________________________________</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td><div class="value">Bendahara Perumahan Permata Buah Batu</div></td>
					</tr>

				</table>
			</td>
		</tr>
	</table>
	<hr>
	<?php endforeach; ?>
	<script src="/js/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function () {
			window.print();
		});
	</script>
</body>
</html>