<?php 
if($_SESSION['admin']){
?>

<?php 
	$kode_dosen = $_GET['id'];
	$sql = $koneksi->query("SELECT * FROM tb_dosen WHERE kode_dosen = '$kode_dosen'");	
	$data = $sql->fetch_assoc();
 ?>	
<div class="box box-primary">
   <div class="box-header with-border">
     <h3 class="box-title">Detail Dosen</h3>
   </div>
	<div class="box-body">                   
		<table class="table table-bordered">
			<tr>
				<td rowspan="12" align="center"><img src="img/<?= $data['foto']; ?>" style="width: 200px; height: 200px; border: 1px solid #eee;"> </td>
			</tr>
		     <tr>
				<td><span class="style2"> Kode Dosen </span></td>
				<td><span class="style2"> :</span></td>
				<td><span class="style2"> <?= $data['kode_dosen']; ?></span></td>
			</tr>
			<tr>
				<td><span class="style2"> NIDN/NIK </span></td>
				<td><span class="style2"> :</span></td>
				<td><span class="style2"> <?= $data['nidn']; ?></span></td>
			</tr>
			<tr>
				<td><span class="style2"> Nama </span></td>
				<td><span class="style2"> :</span></td>
				<td><span class="style2"> <?= $data['nama_dosen']; ?></span></td>
			</tr>
			<tr>
				<td><span class="style2"> Telephone</span></td>
				<td><span class="style2"> :</span></td>
				<td><span class="style2"> <?= $data['telpon']; ?></span></td>
			</tr>
			<tr>
				<td><span class="style2"> Email </span></td>
				<td><span class="style2"> :</span></td>
				<td><span class="style2"> <?= $data['email']; ?></span></td>
			</tr>
			<tr>
				<td><span class="style2"> Alamat </span></td>
				<td><span class="style2"> :</span></td>
				<td><span class="style2"> <?= $data['alamat']; ?></span></td>
			</tr>
			
			<tr>
				<td><span class="style2"> Pendidikan S1 </span></td>
				<td><span class="style2"> :</span></td>
				<td><span class="style2"> <?= $data['pend_s1']; ?></span></td>
			</tr>
			<tr>
				<td><span class="style2"> Pendidikan S2 </span></td>
				<td><span class="style2"> :</span></td>
				<td><span class="style2"> <?= $data['pend_s2']; ?></span></td>
			</tr>
			
			<tr>
				<td><span class="style2"> Pendidikan S3 </span></td>
				<td><span class="style2"> :</span></td>
				<td><span class="style2"> <?= $data['pend_s3']; ?></span></td>
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
			
	</div>
</div>

<?php
    }else{
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';
exit;
    }
?> 
