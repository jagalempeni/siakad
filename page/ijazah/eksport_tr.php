<?php
$koneksi = new mysqli ("localhost","root","","office_assholeh_siakad");
header("content-disposition: attachment; filename=data_transkrip_mahasiswa.xls");
header("content-type: application/vnd-ms-excel");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Data Transkrip Mahasiswa</title>
</head>
<body>
	<table border="1" cellpadding="5">
		<thead>
			<th>NIM</th>
			<th>Nama</th>
			<th>Tahun Angkatan</th>
			<th>No. Ijazah</th>
			<th>No. PIN</th>
			<th>Judul Skripsi</th>
			<th>IPK</th>
			<th>Predikat</th>
			<th>Tanggal Lulus</th>
		</thead>
		<tbody>
		<?php 
     	$no = 1;
     	$sql = $koneksi->query("SELECT * FROM tb_mahasiswa");
     	while ($data = $sql->fetch_assoc()) { ?>
	    <tr>
	        <td><?= $data['nim']; ?></td>
	        <td><?= $data['nama']; ?></td>
	        <td><?= $data['angkatan']; ?></td>
	        <td><?= $data['no_ijazah']; ?></td>
	        <td><?= $data['no_pin']; ?></td>
	        <td><?= $data['judul_skripsi']; ?></td>
	        <td><?= $data['ipk']; ?></td>
	        <td><?= $data['predikat']; ?></td>
	        <td><?= $data['tgl_lulus']; ?></td>
	        <?php } ?>
	     </tr>
		</tbody>
	</table>
</body>
</html>