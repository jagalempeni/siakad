<?php
$koneksi = new mysqli ("localhost","polf8968_001","Admin@123empat!","polf8968_001akad");
header("content-disposition: attachment; filename=data_dosen.xls");
header("content-type: application/vnd-ms-excel");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Data Dosen</title>
</head>
<body>
	<table border="1" cellpadding="5">
		<thead>
			<th>KODE</th>
			<th>NIDN</th>
			<th>NAMA</th>
			<th>TELEPON</th>
			<th>EMAIL</th>
			<th>ALAMAT</th>
			<th>NIK</th>
			<th>NO. KTP</th>
			<th>NAMA IBU KANDUNG</th>
			<th>PEND. S1</th>
			<th>PEND. S2</th>
			<th>PEND. S3</th>	
		</thead>
		<tbody>
		<?php 
     	$no = 1;
     	$sql = $koneksi->query("SELECT * FROM tb_dosen");
     	while ($data = $sql->fetch_assoc()) { ?>
	    <tr>
	        <td><?= $data['kode_dosen']; ?></td>
	        <td><?= $data['nidn']; ?></td>
	        <td><?= $data['nama_dosen']; ?></td>
	        <td><?= $data['telpon']; ?></td>
	        <td><?= $data['email']; ?></td>
	        <td><?= $data['alamat']; ?></td>
	        <td><?= $data['nik']; ?></td>
	        <td><?= $data['ktp']; ?></td>
	        <td><?= $data['ibu']; ?></td>
	        <td><?= $data['pend_s1']; ?></td>
	        <td><?= $data['pend_s2']; ?></td>
	        <td><?= $data['pend_s3']; ?></td>
	        <?php } ?>
	     </tr>
		</tbody>
	</table>
</body>
</html>