<?php
	$nim = $_GET['id']; 
	$sql = $koneksi->query("SELECT * FROM tb_mahasiswa WHERE nim = '$nim'");
	$tampil = $sql->fetch_assoc();
?>

<form method="POST" enctype="multipart/form-data">
	<div class="box box-primary">
	   <div class="box-header with-border">
	     <h3 class="box-title">Ubah Profile</h3>
	   </div>
		
		<div class="box-body">

			<div class="form-group">
			  <label>Nim</label>
			  <input class="form-control" required name="nim" value="<?= $tampil['nim']; ?>" readonly>
			</div>

			<div class="form-group">
			  <label>Nama</label>
			  <input class="form-control" required name="nama" value="<?= $tampil['nama']; ?>" readonly>
			</div>

			<div class="form-group">
			     <label>Semester :</label>
			     <select class="form-control" required name="smester">

				     <option>-Pilih Smester-</option>
				     <option value="1" <?php if( $tampil['smester'] == '1'){echo "selected"; } ?>>1</option>
				     <option value="2" <?php if( $tampil['smester'] == '2'){echo "selected"; } ?>>2</option>
				     <option value="3" <?php if( $tampil['smester'] == '3'){echo "selected"; } ?>>3</option>
				     <option value="4" <?php if( $tampil['smester'] == '4'){echo "selected"; } ?>>4</option>
				     <option value="5" <?php if( $tampil['smester'] == '5'){echo "selected"; } ?>>5</option>
				     <option value="6" <?php if( $tampil['smester'] == '6'){echo "selected"; } ?>>6</option>
				     <option value="7" <?php if( $tampil['smester'] == '7'){echo "selected"; } ?>>7</option>
				     <option value="8" <?php if( $tampil['smester'] == '8'){echo "selected"; } ?>>8</option>
			     </select>
			 </div>


			<div class="form-group">
			  <label>Tempat Lahir</label>
			  <input class="form-control" required name="tempat" value="<?= $tampil['tempat_lahir']; ?>">
			</div>

			<div class="form-group">
			  <label>Tanggal Lahir</label>
			  <input class="form-control" required type="date" name="tgl" value="<?= $tampil['tanggal_lahir']; ?>">
			</div>

			<div class="form-group">
			     <label>Alamat</label>
			     <textarea class="form-control" required rows="3" name="alamat"><?= $tampil['alamat']; ?></textarea>
			</div>

			 <div class="form-group">
				<label>Jenis Kelamin</label>
			  	<div>
				   <input type="radio" name="jk"  value="L" <?php if($tampil['jenis_kelamin']=="L"){ echo "checked"; }?>/> Laki-laki &nbsp; &nbsp; &nbsp;
				   <input type="radio" name="jk"  value="P" <?php if($tampil['jenis_kelamin']=="P"){ echo "checked"; }?>/> Perempuan
			  	</div>
			</div>

	      <div class="form-group">
	        	<label>Email</label>
	        	<input class="form-control" required name="email" value="<?= $tampil['email']; ?>">
	    	</div>

			<div class="form-group">
			  <label>Telphone</label>
			  <input class="form-control" required name="telpon" value="<?= $tampil['telpon']; ?>">
			</div>
		</div>

			
		<div class="box-footer">
			<input type="submit" name="simpan" value="Ubah" class="btn btn-flat btn-primary">
			<input type=button value=Kembali onclick=self.history.back() class="btn btn-flat btn-info">
		</div>
	</div>
</form>    

<?php 
	if (isset($_POST['simpan'])) {
		$nama    = $_POST['nama'];
		$tempat  = $_POST['tempat'];
		$tgl     = $_POST['tgl'];
		$alamat  = $_POST['alamat'];
		$smester = $_POST['smester'];
		$jk      = $_POST['jk'];
		$email   = $_POST['email'];
		$telpon  = $_POST['telpon'];


			$koneksi->query("UPDATE  tb_mahasiswa SET  nama = '$nama', tempat_lahir='$tempat', tanggal_lahir = '$tgl', alamat = '$alamat', smester = '$smester', jenis_kelamin = '$jk', email = '$email', telpon = '$telpon' WHERE nim = '$nim'");
				

	$ubah_stts = $koneksi->query("UPDATE tb_mahasiswa SET status_krs = 1 WHERE nim = '$nim'");
?>
		<script>
			setTimeout(function() {
			swal({
			   title: "Selamat!",
			   text: "Ubah Smester Berhasil !",
			   type: "success"
			}, function() {
			   window.location = "?page=profile";
			});
			}, 300);
		</script>
<?php  } ?>



