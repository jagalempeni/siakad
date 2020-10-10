<?php 
if($_SESSION['admin']){
?>

<?php 
	$kode   = $_GET['id'];
	$sql    = $koneksi->query("SELECT * FROm tb_dosen WHERE kode_dosen = '$kode'");
	$tampil = $sql->fetch_assoc();
 ?>

<form method="POST" enctype="multipart/form-data">
	<div class="box box-primary">
		<div class="box-header with-border">
		  <h3 class="box-title">Ubah Data Dosen</h3>
		</div>
		
		<div class="box-body">
		   <div class="form-group">
	        	<label>Kode Dosen :</label>
	        	<input class="form-control" required name="kode" value="<?= $tampil['kode_dosen']; ?>" readonly>
		   </div>

		   <div class="form-group">
	        	<label>NIDN/NIK :</label>
	        	<input class="form-control" required name="nidn" value="<?= $tampil['nidn']; ?>">
		   </div>

		   <div class="form-group">
	        	<label>Nama :</label>
	        	<input class="form-control" required name="nama" value="<?= $tampil['nama_dosen']; ?>">
		   </div>

			<div class="form-group">  
	        	<label>Email :</label>  
	        	<input class="form-control" required name="email" value="<?= $tampil['email']; ?>">
		   </div>

		   <div class="form-group">
	        	<label>Pendidikan S1 :</label>
	        	<input class="form-control" required name="pend_s1" value="<?= $tampil['pend_s1']; ?>">
		   </div>

		   <div class="form-group">
	        	<label>Pendidikan S2 :</label>
	        	<input class="form-control" required name="pend_s2" value="<?= $tampil['pend_s2']; ?>">
		   </div>

		   <div class="form-group">
	        	<label>Pendidikan S3 :</label>
	        	<input class="form-control" required name="pend_s3" value="<?= $tampil['pend_s3']; ?>">
		   </div>

	    	<div class="form-group">
	        	<label>Telphone :</label>
	        	<input class="form-control" required name="telpon"value="<?= $tampil['telpon']; ?>">
	    	</div>

		    
	    	<div class="form-group">
           <label>Alamat :</label>
           <textarea class="form-control" required rows="3" name="alamat"><?= $tampil['alamat']; ?></textarea>
		   </div>

		   <!-- <div class="form-group">
	        	<img src="img/<?= $tampil['foto'] ?>" width="100" height="100">
		   </div>

		   <div class="form-group">
	        	<label>Ganti Foto :</label>
	        	<input type="file" name="foto">
		   </div> -->
		</div>
	
		<div class="box-footer">
			<input type="submit" name="simpan" value="Ubah" class="btn btn-sm btn-primary btn-flat">
			<input type=button value=Kembali onclick=self.history.back() class="btn btn-sm btn-info btn-flat">
		</div>
	</div>    
</form>

<?php 
	if (isset($_POST['simpan'])) {
	$nama   = $_POST['nama'];
	$nidn   = $_POST['nidn'];
	$alamat = $_POST['alamat'];
	$email  = $_POST['email'];
	$pend_s1 = $_POST['pend_s1'];
	$pend_s2 = $_POST['pend_s2'];
	$pend_s3 = $_POST['pend_s3'];
	$telpon = $_POST['telpon'];
	$pass   = $_POST['pass'];
	// $foto   = $_FILES['foto']['name'];
	// $lokasi = $_FILES['foto']['tmp_name'];

	if(!empty($lokasi)) {
		move_uploaded_file($lokasi, "img/".$foto);
		$koneksi->query("UPDATE  tb_dosen SET  nidn = '$nidn', nama_dosen = '$nama',  alamat = '$alamat',  email = '$email', pend_s1 = '$pend_s1', pend_s2 = '$pend_s2', pend_s3 = '$pend_s3', telpon = '$telpon', foto = '$foto' WHERE kode_dosen = '$kode'");
		$koneksi->query("UPDATE tb_user SET nama = '$nama', foto = '$foto' WHERE user_id = '$kode'");
			?>
	      <script>
		    	setTimeout(function() {
		        	swal({
			            title: "Selamat!",
			            text: "Data Berhasil Diubah!",
			            type: "success"
			        }, function() {
			            window.location = "?page=dosen";
			        });
			    }, 300);
			</script>
	      <?php  
	}else{

		$koneksi->query("UPDATE  tb_dosen SET  nama_dosen = '$nama',  alamat = '$alamat', email = '$email', telpon = '$telpon'  WHERE kode_dosen = '$kode'");

		$koneksi->query("UPDATE tb_user SET nama = '$nama' WHERE user_id = '$kode'");
			?>
			<script>
			 setTimeout(function() {
			     swal({
			         title: "Selamat!",
			         text: "Data Berhasil Diubah!",
			         type: "success"
			     }, function() {
			         window.location = "?page=dosen";
			     });
			 }, 300);
			</script>
<?php  } } ?>

<?php
    }else{
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';
exit;
    }
?> 
