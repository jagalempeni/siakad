<?php
$koneksi = new mysqli ("localhost","root","","dev_siakad-dev1");
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
			<th>NAMA</th>
			<th>TEMPAT LAHIR</th>
			<th>TANGGAL LAHIR</th>
			<th>ALAMAT</th>
			<th>NO. NIK</th>
			<th>NO. KTP</th>
			<th>NAMA IBU KANDUNG</th>
			<th>DOSEN PEMBIMBING</th>
			<th>PRODI</th>
			<th>SEMESTER</th>
			<th>ANGKATAN</th>
			<th>JENIK KELAMIN</th>
			<th>EMAIL</th>
			<th>NO. TELEPON</th>
			<th>STATUS</th>
		</thead>
		<tbody>
		<?php 
     	$no = 1;
     	$sql = $koneksi->query("SELECT * FROM tb_mahasiswa LEFT JOIN tb_jurusan ON tb_mahasiswa.kode_jurusan = tb_jurusan.kode_jurusan");
     	while ($data = $sql->fetch_assoc()) { 
     		$sts = $data ['status'];
     		if ($sts == 0) {$stst = 'Tidak Aktif';}
     		if ($sts == 1) {$stst = 'Aktif';}

     		?>

	    <tr>
	        <td><?= $data['nim']; ?></td>
	        <td><?= $data['nama']; ?></td>
	        <td><?= $data['tempat_lahir']; ?></td>
	        <td><?= $data['tanggal_lahir']; ?></td>
	        <td><?= $data['alamat']; ?></td>	        
	        <td><?= $data['nik']; ?></td>
	        <td><?= $data['ktp']; ?></td>
	        <td><?= $data['ibu']; ?></td>
	        <td><?= $data['dosen']; ?></td>
	        <td><?= $data['nama_jurusan']; ?></td>
	        <td><?= $data['smester']; ?></td>
	        <td><?= $data['angkatan']; ?></td>
	        <td><?= $data['jenis_kelamin']; ?></td>
	        <td><?= $data['email']; ?></td>
	        <td><?= $data['telpon']; ?></td>
	        <td><?= $stst; ?></td>
	        <?php } ?>
	     </tr>
		</tbody>
	</table>
</body>
</html>