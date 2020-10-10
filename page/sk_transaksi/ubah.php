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
			  <input class="form-control" required name="nama" value="<?= $tampil['nama']; ?>" readonly>
			</div>

			 <div class="form-group">
		        <label>Tahun Angkatan</label>
		        <select class="form-control" required name="angkatan" readonly>
			        <option><?= $tampil['angkatan']; ?></option>
			        <?php
					$tahun = date("Y");
					for ($i=$tahun;$i>=$tahun-8;$i--) {
						echo "<option value='$i'>$i</option>";
					}
					?>
				</select>
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
