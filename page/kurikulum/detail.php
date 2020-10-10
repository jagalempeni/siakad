<?php 
	$nim = $_GET['id'];
	$sql = $koneksi->query("SELECT * FROM tb_mahasiswa INNER JOIN tb_jurusan ON tb_mahasiswa.kode_jurusan = tb_jurusan.kode_jurusan AND nim = '$nim'");	
	$data = $sql->fetch_assoc();
 ?>	
<div class="box box-primary">
   <div class="box-header with-border">
     <h3 class="box-title">Detail Mahasiswa</h3>
   </div>
	<div class="box-body">                   
		<table class="table table-bordered">
			<tr>
				<td rowspan="10" align="center"><img src="img/<?= $data['foto']; ?>" style="width: 200px; height: 200px; border: 1px solid #eee;"> </td>
			</tr>
		     <tr>
				<td><span class="style2"> Nim </span></td>
				<td><span class="style2"> :</span></td>
				<td><span class="style2"> <?= $data['nim']; ?></span></td>
			</tr>
			<tr>
				<td><span class="style2"> Nama </span></td>
				<td><span class="style2"> :</span></td>
				<td><span class="style2"> <?= $data['nama']; ?></span></td>
			</tr>
			<tr>
				<td><span class="style2"> Tempat / Tanggal lahir </span></td>
				<td><span class="style2"> :</span></td>
				<td><span class="style2"> <?= $data['tempat_lahir'].','.date('d F Y', strtotime( $data['tanggal_lahir'])); ?></span></td>
			</tr>
			<tr>
				<td><span class="style2"> Alamat </span></td>
				<td><span class="style2"> :</span></td>
				<td><span class="style2"> <?= $data['alamat']; ?></span></td>
			</tr>
			<tr>
				<td><span class="style2"> Prodi </span></td>
				<td><span class="style2"> :</span></td>
				<td><span class="style2"> <?= $data['nama_jurusan']; ?></span></td>
			</tr>
			<tr>
				<td><span class="style2"> Jenis Kelamin </span></td>
				<td><span class="style2"> :</span></td>
				<td>
					<span class="style2"> 
					<?php  

						if ($data['jenis_kelamin'] == "L"){
							echo "Laki-laki";
						}else{
							echo"Perempuan";
						} 

					?>
					</span>
				</td>
			</tr>
			<tr>
				<td><span class="style2"> Email </span></td>
				<td><span class="style2"> :</span></td>
				<td><span class="style2"> <?= $data['email']; ?></span></td>
			</tr>
			<tr>
				<td><span class="style2"> Telepon </span></td>
				<td><span class="style2"> :</span></td>
				<td><span class="style2"> <?= $data['telpon']; ?></span></td>
			</tr>
		</table>
   </div>                     
   <div class="box-footer">
	   <input type=button value=Kembali onclick=self.history.back() class="btn btn-info btn-flat btn-sm" />
		<a href="./cetak/ktm.php?id=<?= $nim; ?>" class="btn btn-default btn-flat btn-sm" target="blank" ><i class="fa fa-print"></i> Cetak KTM</a>  	
	</div>
</div>
