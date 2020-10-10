<?php 
if($_SESSION['admin']){
?>

<?php 
	$sql        = $koneksi->query("SELECT kode_dosen FROm tb_dosen ORDER BY kode_dosen DESC");
	$data       = $sql->fetch_assoc();
	$kode_dosen = $data['kode_dosen'];
	$urut       = substr($kode_dosen, 1, 3);
	$tambah     = (int) $urut + 1;

	if(strlen($tambah) == 1){
		$format = "D"."00".$tambah;
	}else if(strlen($tambah) == 2){
		$format = "D"."0".$tambah;
	}else{
		$format = "D".$tambah;
	}
 ?>  
<form role="form" method="POST" enctype="multipart/form-data">
	<div class="box box-primary">
	   <div class="box-header with-border">
	      <h3 class="box-title">Tambah Data Dosen</h3>
	   </div>
	    <div class="box-body">
		    	<div class="form-group">
		      	<label>Kode Dosen :</label>
		        	<input class="form-control" required name="kode" placeholder="Masukan Kode Dosen">
		    	</div>

		    	<div class="form-group">
		        	<label>NIDN:</label>
		        	<input class="form-control" required name="nidn" placeholder="Masukan NIDN">
		    	</div>

		     	<div class="form-group">
		        	<label>Nama :</label>
		        	<input class="form-control" required name="nama" placeholder="Masukan Nama">
		    	</div>

			   <div class="form-group">
			      <label>Password :</label>
			      <input class="form-control" required type="password" name="pass" placeholder="Masukan Password">
			   </div>

		    	<div class="form-group">
		        	<label>Email :</label>
		        	<input class="form-control" required name="email" placeholder="Masukan email">
		    	</div>

		    	<div class="form-group">
		        	<label>Pendidikan S1 :</label>
		        	<input class="form-control"  name="pend_s1" placeholder="Masukan Pendidikan S1">
		    	</div>

		    	<div class="form-group">
		        	<label>Pendidikan S2 :</label>
		        	<input class="form-control" name="pend_s2" placeholder="Masukan Pendidikan S2">
		    	</div>

		    	<div class="form-group">
		        	<label>Pendidikan S3 :</label>
		        	<input class="form-control" name="pend_s3" placeholder="Masukan Pendidikan S3">
		    	</div>

		    	<div class="form-group">
		        	<label>Telphone :</label>
		        	<input class="form-control" required name="telpon" placeholder="Masukan Telpon">
		    	</div>

		    	<div class="form-group">
		        	<label>No. NIK :</label>
		        	<input class="form-control" required name="nik" placeholder="Masukan Nomor NIK">
		    	</div>

		    	<div class="form-group">
		        	<label>No. KTP :</label>
		        	<input class="form-control" required name="kt" placeholder="Masukan Nomor KTP">
		    	</div>

		    	<div class="form-group">
		        	<label>Nama Ibu Kandung :</label>
		        	<input class="form-control" required name="ibu" placeholder="Masukan Nama Ibu Kandung">
		    	</div>

		    	<div class="form-group">
	           	<label>Alamat :</label>
	           	<textarea class="form-control" required rows="3" name="alamat"></textarea>
		      </div>

		    	<!-- <div class="form-group">
		        	<label>Foto :</label>
		        	<input type="file" name="foto">
		    	</div> -->
			</div>

		<div class="box-footer">
			<input type="submit" name="simpan" value="Simpan" class="btn btn-sm btn-primary btn-flat">
			<input type=button value=Kembali onclick=self.history.back() class="btn btn-sm btn-info btn-flat">  
		</div>
	</div>   
</form> 

<?php 
	if (isset($_POST['simpan'])) {
	$kode   = $_POST['kode'];
	$nidn   = $_POST['nidn'];
	$nama   = $_POST['nama'];
	$alamat = $_POST['alamat'];
	$nik   = $_POST['nik'];
	$ktp = $_POST['ktp'];
	$ibu  = $_POST['ibu'];
	$email  = $_POST['email'];
	$pend_s1  = $_POST['pend_s1'];	
	$pend_s2  = $_POST['pend_s2'];
	$pend_s3  = $_POST['pend_s3'];
	$telpon = $_POST['telpon'];
	$pass   = $_POST['pass'];
	// $foto   = $_FILES['foto']['name'];
	// $lokasi = $_FILES['foto']['tmp_name'];
	// $upload = move_uploaded_file($lokasi, "img/".$foto);
	
	
	$tambah = $koneksi->query("INSERT INTO tb_dosen (kode_dosen, nidn, nama_dosen, telpon, nik, ktp, ibu, email,  alamat, pend_s1, pend_s2, pend_s3, foto) VALUES ('$kode', '$nidn', '$nama', '$telpon', '$nik', '$ktp',  '$ibu', '$email',  '$alamat', '$pend_s1', '$pend_s2', '$pend_s3', 'user.png')");
		
	$koneksi->query("INSERT INTO tb_user set id = '$kode', nama = '$nama', pass = '$pass', level = 'dosen', foto = 'user.png'");
		if ($tambah) {
			echo "
    			<script>
    			    setTimeout(function() {
    			        swal({
    			            title: 'Selamat!',
    			            text: 'Data Berhasil Ditambah!',
    			            type: 'success'
    			        }, function() {
    			            window.location = '?page=dosen';
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
    			            window.location = '?page=dosen';
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