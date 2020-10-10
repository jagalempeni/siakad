<?php
$koneksi = new mysqli ("localhost","polf8968_001","Admin@123empat!","polf8968_001akad");
header("content-disposition: attachment; filename=data_matakuliah.xls");
header("content-type: application/vnd-ms-excel");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Data Matakuliah</title>
</head>
<body>
	<table border="1" cellpadding="5">
		<thead>
			<th>Kode Matkul</th>
			<th>Nama Matkul</th>
			<th>SKS</th>
			<th>Semester</th>
			<th>Prodi</th>
		</thead>
		<tbody>
		<?php 
     	$no = 1;
     	$sql = $koneksi->query("SELECT * FROM tb_matkul INNER JOIN tb_jurusan ON tb_matkul.kode_jurusan = tb_jurusan.kode_jurusan");
     	while ($data = $sql->fetch_assoc()) { ?>
	    <tr>
	        <td><?= $data['kode_matkul']; ?></td>
	        <td><?= $data['nama_mk']; ?></td>
	        <td><?= $data['sks']; ?></td>
	        <td><?= $data['smester']; ?></td>
	        <td><?= $data['nama_jurusan']; ?></td>
	        <?php } ?>
	     </tr>
		</tbody>
	</table>
</body>
</html>