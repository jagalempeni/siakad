<?php 
if($_SESSION['admin']){

?>

<form role="form" method="POST" enctype="multipart/form-data">
	<div class="box box-primary">
	   <div class="box-header with-border">
	     	<h3 class="box-title">Tambah Data Mahasiswa</h3>
	   </div>
	   <div class="box-body">
		   <div class="form-group">
	        	<label>Nim</label>
	        	<input class="form-control" required name="nim" placeholder="Masukan NIM">
		    </div>

		     <div class="form-group">
		        <label>Nama</label>
		        <input class="form-control" required name="nama" placeholder="Masukan Nama">
		    </div>

		    <div class="form-group">
		        <label>Password</label>
		        <input class="form-control" required type="password" name="pass" placeholder="Masukan Password">
		    </div>

		    <div class="form-group">
		        <label>Tempat Lahir</label>
		        <input class="form-control" required name="tempat" placeholder="Masukan Tempat lahir">
		    </div>

		    <div class="form-group">
		        <label>Tanggal Lahir</label>
		        <input class="form-control" required type="date" name="tgl">
		    </div>

		    <div class="form-group">
	           <label>Alamat</label>
	           <textarea class="form-control" required rows="3" name="alamat"></textarea>
		   </div>

		   <div class="form-group">
		        <label>NIK</label>
		        <input class="form-control" required name="nik" placeholder="Masukan Nomor NIK">
		   </div>

		   <div class="form-group">
		        <label>No. KTP</label>
		        <input class="form-control" required name="ktp" placeholder="Masukan Nomor KTP">
		   </div>

		   <div class="form-group">
		        <label>Nama Ibu Kandung</label>
		        <input class="form-control" required name="ibu" placeholder="Masukan Nama Ibu Kandung">
		   </div>

		   <div class="form-group">
		        <label>Dosen Pembimbing</label>
		        <input class="form-control" required name="dosen" placeholder="Masukan Nama Dosen Pembimbing Akademik">
		   </div>


		   <div class="form-group">
		        <label>Tahun Angkatan</label>
		        <select class="form-control" name='angkatan'>
				<option>-- Pilih Tahun --</option>
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
			        <option>-- Pilih Smester --</option>
			        <option value="1">1</option>
			        <option value="2">2</option>
			        <option value="3">3</option>
			        <option value="4">4</option>
			        <option value="5">5</option>
			        <option value="6">6</option>
			        <option value="7">7</option>
			        <option value="8">8</option>
		        </select>
		    </div>

		    <div class="form-group">
		           <label>Prodi</label>
		           <select class="form-control" required name="jurusan">

		           <option>-- Pilih Prodi --</option>}
		           option
		               <?php 

		               	$sql = $koneksi->query("select * from tb_jurusan WHERE aktif=1");
		               	while ($data=$sql->fetch_assoc()) {
		               		echo "

		               			<option value='$data[kode_jurusan]'>$data[nama_jurusan]</option>

		               		";
		               	}
		                ?>
		           </select>
		       </div>

		       <div class="form-group">
		           <label>Kelas</label>
		           <select class="form-control" required name="kelas">

		           <option>-- Pilih Kelas --</option>}
		           option
		               <?php 

		               	$sql = $koneksi->query("select * from tb_kelas");
		               	while ($data=$sql->fetch_assoc()) {
		               		echo "

		               			<option value='$data[kelas]'>$data[kelas]</option>

		               		";
		               	}
		                ?>
		           </select>
		       </div>

		    <div class="form-group">
		    	<label>Jenis Kelamin</label>

		           <div>
		            <input type="radio" name="jk"  value="L"/> Laki-laki &nbsp; &nbsp; &nbsp;
		            <input type="radio" name="jk"  value="P"/> Perempuan
		           </div>
		       </div>

		       <div class="form-group">
		        <label>Email</label>
		        <input class="form-control" required name="email" placeholder="Masukan email">
		    </div>

		    <div class="form-group">
		        <label>Telphone</label>
		        <input class="form-control" required name="telpon" placeholder="Masukan telpon">
		    </div>

		    <div class="form-group">
			  <label>Status Mahasiswa</label>
			  <select class="form-control" required name="status">
			     <option>-- Pilih Status --</option>
			     <option value="0"?>Tidak Aktif</option>
			     <option value="1"?>Aktif</option>
			  </select>
			</div>


		    <!-- <div class="form-group">
		        <label>Foto</label>
		        <input type="file" name="foto">
		    </div> -->
		</div>

		<div class="box-footer">

		    <input type="submit" name="simpan" value="Simpan" class="btn btn-flat btn-sm btn-primary">
		    <input type=button value=Kembali onclick=self.history.back() class="btn btn-flat btn-sm btn-info" />
		 </div>
	</div>  
</form>

<?php 
	if (isset($_POST['simpan'])) {
		
	
	$nim     = $_POST['nim'];
	$nama    = $_POST['nama'];
	$tempat  = $_POST['tempat'];
	$tgl     = $_POST['tgl'];
	$alamat  = $_POST['alamat'];
	$nik  = $_POST['nik'];
	$ktp     = $_POST['ktp'];
	$dosen     = $_POST['dosen'];
	$ibu  = $_POST['ibu'];
	$jurusan = $_POST['jurusan'];
	$kelas = $_POST['kelas'];
	$smester = $_POST['smester'];
	$angkatan = $_POST['angkatan'];
	$jk      = $_POST['jk'];
	$email   = $_POST['email'];
	$telpon  = $_POST['telpon'];
	$status  = $_POST['status'];
	$pass    = $_POST['pass'];	
	// $foto    = $_FILES['foto']['name'];
	// $lokasi  = $_FILES['foto']['tmp_name'];
	// $upload  = move_uploaded_file($lokasi, "img/".$foto);
	
	$tambah =	$koneksi->query("INSERT INTO tb_mahasiswa (nim, nama, tempat_lahir, tanggal_lahir, alamat, nik, ktp, ibu, dosen, kode_jurusan, kelas, angkatan, smester, jenis_kelamin, email, telpon, status, foto, status_krs)VALUES('$nim', '$nama', '$tempat', '$tgl', '$alamat', '$nik', '$ktp', '$ibu', '$dosen', '$jurusan', '$kelas', '$angkatan', '$smester', '$jk', '$email', '$telpon', $status, 'user.png', 1)");

	$koneksi->query("INSERT INTO tb_user set id ='$nim', nama='$nama', pass='$pass', level='mahasiswa', foto='user.png'");

	$koneksi->query("INSERT INTO sk_kewajiban (nim, angkatan_bayar)VALUES('$nim', '$angkatan')");
			
		if ($tambah) {
			echo "
    			<script>
    			    setTimeout(function() {
    			        swal({
    			            title: 'Selamat!',
    			            text: 'Data Berhasil Ditambah!',
    			            type: 'success'
    			        }, function() {
    			            window.location = '?page=mahasiswa';
    			        });
    			    }, 300);
    			</script>
			";
		} else{
            echo "
    			<script>
    			    setTimeout(function() {
    			        swal({
    			            title: 'Gagal !',
    			            text: 'Data Duplicate !',
    			            type: 'error'
    			        }, function() {
    			            window.location = '?page=mahasiswa';
    			        });
    			    }, 300);
    			</script>
			";
        }
	}
?>

<?php
    }else{
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';
exit;
    }
?>