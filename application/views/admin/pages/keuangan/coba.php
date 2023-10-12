<!DOCTYPE html>
<html>
<body>
<table>
<thead>
	<tr>
		<th>id warga</th>
		<th>Status</th>
		<th>nominal</th>
	</tr>
</thead>
<tbody>
<?php 
	foreach ($iuran as $warga) : ?>
	<tr>
	<td><?php echo $warga->id_warga; ?></td>
	<td><?php echo $warga->status_rumah; ?></td>
<?php  $stat=  $warga->status_rumah;
$nominal = 0;
	if ($stat == 'Rumah Usaha') {
	$nominal = 1000000;} 

	if  ($stat == 'Rumah Tinggal') {
	$nominal = 2000000;}

	if  ($stat == 'Rumah Tinggal') {
	$nominal = 2000000;}
	?>

	<td><?php echo $nominal; ?></td>
	</tr>
	<?php endforeach; ?>
	</table>
</tbody>
<tfoot>
</body>
</html>