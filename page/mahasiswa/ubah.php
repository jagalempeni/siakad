<?php 
if($_SESSION['admin']){
?>

<?php 
	$nim    = $_GET['id'];
	$sql    = $koneksi->query("SELECT * from tb_mahasiswa WHERE nim = '$nim'");
	$tampil = $sql->fetch_assoc();
 ?>
<form method="POST" enctype="multipart/form-data">
	<div class="box box-primary">
	   <div class="box-header with-border">
	     	<h3 class="box-title">Ubah Data Mahasiswa</h3>
	   </div>
	   <div class="box-body">
			<div class="form-group">
			  <label>Nim</label>
			  <input class="form-control" required name="nim" value="<?= $tampil['nim']; ?>" readonly>
			</div>

			<div class="form-group">
			  <label>Nama</label>
			  <input class="form-control" required name="nama" value="<?= $tampil['nama']; ?>">
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
		        <label>NIK</label>
		        <input class="form-control" required name="nik" value="<?= $tampil['nik']; ?>">
		   </div>

		   <div class="form-group">
		        <label>No. KTP</label>
		        <input class="form-control" required name="ktp" value="<?= $tampil['ktp']; ?>">
		   </div>

		   <div class="form-group">
		        <label>Nama Ibu Kandung</label>
		        <input class="form-control" required name="ktp" value="<?= $tampil['ibu']; ?>">
		   </div>

		   <div class="form-group">
		        <label>Dosen Pembimbing</label>
		        <input class="form-control" required name="dosen" value="<?= $tampil['dosen']; ?>">
		   </div>


			 <div class="form-group">
		        <label>Tahun Angkatan</label>
		        <select class="form-control" required name="angkatan">
			        <option><?= $tampil['angkatan']; ?></option>
			        <?php
					$tahun = date("Y");
					for ($i=$tahun;$i>=$tahun-8;$i--) {
						echo "<option value='$i'>$i</option>";
					}
					?>
				</select>
		    </div>


			<div class="form-group">
			  <label>Semester</label>
			  <select class="form-control" required name="smester">
			     <option>-- Pilih Semester --</option>
			     <option value="1" <?php if( $tampil['smester']=='1'){echo "selected"; } ?>>1</option>
			     <option value="2" <?php if( $tampil['smester']=='2'){echo "selected"; } ?>>2</option>
			     <option value="3" <?php if( $tampil['smester']=='3'){echo "selected"; } ?>>3</option>
			     <option value="4" <?php if( $tampil['smester']=='4'){echo "selected"; } ?>>4</option>
			     <option value="5" <?php if( $tampil['smester']=='5'){echo "selected"; } ?>>5</option>
			     <option value="6" <?php if( $tampil['smester']=='6'){echo "selected"; } ?>>6</option>
			     <option value="7" <?php if( $tampil['smester']=='7'){echo "selected"; } ?>>7</option>
			     <option value="8" <?php if( $tampil['smester']=='8'){echo "selected"; } ?>>8</option>
			  </select>
			</div>



		   <div class="form-group">
	        	<label>Program Studi</label>
	        	<select class="form-control" required name="jurusan">
		         <option>-- Pilih Prodi --</option>}
	            <?php 
	            	$sql = $koneksi->query("SELECT * from tb_jurusan WHERE aktif=1");
	            	while ($data=$sql->fetch_assoc()) {
	            		$pilih=($data['kode_jurusan']==$tampil['kode_jurusan']?"selected":"");
	            		echo "
	            			<option value='$data[kode_jurusan]' $pilih>$data[nama_jurusan]</option>
	            		";
	            	}
	             ?>
	         </select>
	      </div>

	      <div class="form-group">
	        	<label>Kelas</label>
	        	<select class="form-control" required name="kelas">
		         <option><?= $tampil['kelas']; ?></option>}
	            <?php 
	            	$sql = $koneksi->query("SELECT * from tb_kelas");
	            	while ($data=$sql->fetch_assoc()) {
	            		$pilih=($data['kelas']==$tampil['kelas']?"selected":"");
	            		echo "
	            			<option value='$data[kelas]' $pilih>$data[kelas]</option>
	            		";
	            	}
	             ?>
	         </select>
	      </div>

	       <!-- <div class="form-group">
	        	<label>Kurikulum</label>
	        	<select class="form-control" required name="kode_kuri">
		         <option>-Pilih Kurikulum-</option>}
	            <?php 
	            	$sql = $koneksi->query("SELECT * from tb_kurikulum");
	            	while ($data=$sql->fetch_assoc()) {
	            		$pilih=($data['kode_kuri']==$tampil['kode_kuri']?"selected":"");
	            		echo "
	            			<option value='$data[kode_kuri]' $pilih>$data[kode_kuri]</option>
	            		";
	            	}
	             ?>
	         </select>
	      </div> -->

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

			<div class="form-group">
			  <label>Status Mahasiswa</label>
			  <select class="form-control" required name="status">
			     <option>-- Pilih Status --</option>
			     <option value="0" <?php if( $tampil['status']=='0'){echo "selected"; } ?>>Tidak Aktif</option>
			     <option value="1" <?php if( $tampil['status']=='1'){echo "selected"; } ?>>Aktif</option>
			  </select>
			</div>

			<!-- <div class="form-group">
			  <img src="img/<?= $tampil['foto'] ?>" width="75" height="75">
			</div>

			<div class="form-group">
			  <label>Ganti Foto</label>
			  <input type="file" name="foto">
			</div> -->
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
		$jurusan = $_POST['jurusan'];
		$kode_kuri = $_POST['kode_kuri'];
		$smester = $_POST['smester'];
		$kelas = $_POST['kelas'];
		$jk      = $_POST['jk'];
		$email   = $_POST['email'];
		$telpon  = $_POST['telpon'];
		$status      = $_POST['status'];
		$pass    = $_POST['pass'];
		
		// $foto    = $_FILES['foto']['name'];
		// $lokasi  = $_FILES['foto']['tmp_name'];

		if(!empty($lokasi)) {
			move_uploaded_file($lokasi, "img/".$foto);

			$koneksi->query("UPDATE  tb_mahasiswa SET  nama = '$nama', tempat_lahir='$tempat', tanggal_lahir = '$tgl', alamat = '$alamat', kode_jurusan = '$jurusan', kelas = '$kelas', kode_kuri = '$kode_kuri', smester = '$smester', jenis_kelamin = '$jk', email = '$email', telpon = '$telpon', foto = '$foto' WHERE nim = '$nim'");
			$koneksi->query("UPDATE tb_user SET nama = '$nama', foto = '$foto' WHERE user_id = '$nim'");
				?>
			       <script>
					    setTimeout(function() {
					        swal({
					            title: "Selamat!",
					            text: "Data Berhasil Diubah!",
					            type: "success"
					        }, function() {
					            window.location = "?page=mahasiswa";
					        });
					    }, 300);
					</script>
		      <?php  
		}else{
			$koneksi->query("UPDATE  tb_mahasiswa SET  nama = '$nama', tempat_lahir = '$tempat', tanggal_lahir = '$tgl', alamat = '$alamat', kode_jurusan = '$jurusan', kelas = '$kelas', kode_kuri = '$kode_kuri', smester = '$smester', jenis_kelamin = '$jk', email = '$email', telpon = '$telpon', status = '$status'  WHERE nim = '$nim'");
			$koneksi->query("update tb_user set nama='$nama' WHERE user_id='$nim'");
				?>
			         <script>
					    setTimeout(function() {
					        swal({
					            title: "Selamat!",
					            text: "Data Berhasil Diubah!",
					            type: "success"
					        }, function() {
					            window.location = "?page=mahasiswa";
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
