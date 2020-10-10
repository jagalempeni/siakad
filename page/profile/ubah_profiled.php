<?php
	$kode_dosen = $_GET['id']; 
	$sql = $koneksi->query("SELECT * FROM tb_dosen WHERE kode_dosen = '$kode_dosen'");
	$tampil = $sql->fetch_assoc();
?>

<form method="POST" enctype="multipart/form-data">
	<div class="box box-primary">
	   <div class="box-header with-border">
	     <h3 class="box-title">Ubah Profile</h3>
	   </div>
		
		<div class="box-body">

			<div class="form-group">
			  <label>Kode Dosen</label>
			  <input class="form-control" required name="kode_dosen" value="<?= $tampil['kode_dosen']; ?>" readonly>
			</div>

			<div class="form-group">
			  <label>Nama</label>
			  <input class="form-control" required name="nama" value="<?= $tampil['nama_dosen']; ?>" readonly>
			</div>
			

			<div class="form-group">
			     <label>Alamat</label>
			     <textarea class="form-control" required rows="3" name="alamat"><?= $tampil['alamat']; ?></textarea>
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
		$kode_dosen    = $_POST['kode_dosen'];
		$nama  = $_POST['nama'];
		$alamat  = $_POST['alamat'];
		$email   = $_POST['email'];
		$telpon  = $_POST['telpon'];


			$koneksi->query("UPDATE  tb_dosen SET  alamat = '$alamat', email='$email', telpon = '$telpon' WHERE kode_dosen = '$kode_dosen'");
				

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



