<?php
$koneksi = new mysqli ("localhost","stapinac_w2l","Admin@1","stapinac_w2l");
header("content-disposition: attachment; filename=data_mahasiswa.xls");
header("content-type: application/vnd-ms-excel");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Data Mahasiswa</title>
</head>
<body>
	<table border="1" cellpadding="5">
		<thead>
			<th>NIM</th>
			<th>Nama</th>
			<th>Tempat Lahir</th>
			<th>Tanggal Lahir</th>
			<th>Alamat</th>
			<th>Kode Prodi</th>
			<th>Smester</th>
			<th>Jenis Kelamin</th>
			<th>Email</th>
			<th>Telpon</th>
		</thead>
		<tbody>
		<?php 
     	$no = 1;
     	$sql = $koneksi->query("SELECT * FROM tb_mahasiswa INNER JOIN tb_jurusan ON tb_mahasiswa.kode_jurusan = tb_jurusan.kode_jurusan");
     	while ($data = $sql->fetch_assoc()) { ?>
	    <tr>
	        <td><?= $data['nim']; ?></td>
	        <td><?= $data['nama']; ?></td>
	        <td><?= $data['tempat_lahir']; ?></td>
	        <td><?= $data['tanggal_lahir']; ?></td>
	        <td><?= $data['alamat']; ?></td>
	        <td><?= $data['kode_jurusan']; ?></td>
	        <td><?= $data['smester']; ?></td>
	        <td><?= $data['jenis_kelamin']; ?></td>
	        <td><?= $data['email']; ?></td>
	        <td><?= $data['telpon']; ?></td>
	        <?php } ?>
	     </tr>
		</tbody>
	</table>
</body>
</html>