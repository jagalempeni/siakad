<?php 
if($_SESSION['admin']){
?>

<?php 
	$nim    = $_GET['id'];
	$sql    = $koneksi->query("SELECT * from tb_mahasiswa, tb_jurusan WHERE tb_mahasiswa.kode_jurusan = tb_jurusan.kode_jurusan AND nim = '$nim'");
	$tampil = $sql->fetch_assoc();
 ?>
<form method="POST" enctype="multipart/form-data">
	<div class="box box-primary">
	   <div class="box-header with-border">
	     	<h3 class="box-title">Ubah Akses KRS Mahasiswa</h3>
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
		        <label>Tahun Angkatan</label>
		        <input class="form-control" required name="tahun_akad" value="<?= $tampil['angkatan']; ?>" readonly>
		    </div>



		   <div class="form-group">
		   	
	        	<label>Prodi</label>
	        	<input class="form-control" required name="jurusan" value="<?= $tampil['nama_jurusan']; ?>" readonly>
	      </div>

	      

	    <div class="form-group">
			  <label>Akses KRS</label>
			  <select class="form-control" required name="krs">
			     <option value="0" <?php if( $tampil['krs']=='0'){echo "selected"; } ?>>Lock</option>
			     <option value="1" <?php if( $tampil['krs']=='1'){echo "selected"; } ?>>Unlock</option>
			  </select>
			</div>

		<div class="box-footer">
			<input type="submit" name="simpan" value="Ubah" class="btn btn-flat btn-primary">
			<input type=button value=Kembali onclick=self.history.back() class="btn btn-flat btn-info">
		</div>
	</div>
</form>    

<?php 
	if (isset($_POST['simpan'])) {
		$krs    = $_POST['krs'];
		$tempat  = $_POST['tempat'];
		$tgl     = $_POST['tgl'];
		$alamat  = $_POST['alamat'];
		$jurusan = $_POST['jurusan'];
		$kode_kuri = $_POST['kode_kuri'];
		$smester = $_POST['smester'];
		$jk      = $_POST['jk'];
		$email   = $_POST['email'];
		$telpon  = $_POST['telpon'];
		$pass    = $_POST['pass'];
		
		$foto    = $_FILES['foto']['name'];
		$lokasi  = $_FILES['foto']['tmp_name'];

		if(!empty($lokasi)) {
			move_uploaded_file($lokasi, "img/".$foto);

			$koneksi->query("UPDATE  tb_mahasiswa SET  krs = '$krs' WHERE nim = '$nim'");
				?>
			       <script>
					    setTimeout(function() {
					        swal({
					            title: "Selamat!",
					            text: "Data Berhasil Diubah!",
					            type: "success"
					        }, function() {
					            window.location = "?page=lock_unlock";
					        });
					    }, 300);
					</script>
		      <?php  
		}else{
			$koneksi->query("UPDATE  tb_mahasiswa SET  krs = '$krs'  WHERE nim = '$nim'");
				?>
			         <script>
					    setTimeout(function() {
					        swal({
					            title: "Selamat!",
					            text: "Data Berhasil Diubah!",
					            type: "success"
					        }, function() {
					            window.location = "?page=lock_unlock";
					        });
					    }, 300);
					</script>
		   <?php  
		}
	}
 ?>

<?php
    }else{
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';
exit;
    }
?> 