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
		        <label>Tahun Akademik</label>
		        <select class="form-control" required name="tahun_akad">
			        <option>-Pilih Tahun Akademik-</option>
			        <option value="2010" <?php if( $tampil['tahun_akad']=='2010'){echo "selected"; } ?>>2010</option>
			        <option value="2011" <?php if( $tampil['tahun_akad']=='2011'){echo "selected"; } ?>>2011</option>
			        <option value="2012" <?php if( $tampil['tahun_akad']=='2012'){echo "selected"; } ?>>2012</option>
			        <option value="2013" <?php if( $tampil['tahun_akad']=='2013'){echo "selected"; } ?>>2013</option>
			        <option value="2014" <?php if( $tampil['tahun_akad']=='2014'){echo "selected"; } ?>>2014</option>
			        <option value="2015" <?php if( $tampil['tahun_akad']=='2015'){echo "selected"; } ?>>2015</option>
			        <option value="2016" <?php if( $tampil['tahun_akad']=='2016'){echo "selected"; } ?>>2016</option>
			        <option value="2017" <?php if( $tampil['tahun_akad']=='2017'){echo "selected"; } ?>>2017</option>
			        <option value="2018" <?php if( $tampil['tahun_akad']=='2018'){echo "selected"; } ?>>2018</option>
			        <option value="2019" <?php if( $tampil['tahun_akad']=='2019'){echo "selected"; } ?>>2019</option>
			        <option value="2020" <?php if( $tampil['tahun_akad']=='2020'){echo "selected"; } ?>>2020</option>
			        <option value="2021" <?php if( $tampil['tahun_akad']=='2021'){echo "selected"; } ?>>2021</option>
			        <option value="2022" <?php if( $tampil['tahun_akad']=='2022'){echo "selected"; } ?>>2022</option>
			        <option value="2023" <?php if( $tampil['tahun_akad']=='2023'){echo "selected"; } ?>>2023</option>
			        <option value="2024" <?php if( $tampil['tahun_akad']=='2024'){echo "selected"; } ?>>2024</option>
			        <option value="2025" <?php if( $tampil['tahun_akad']=='2025'){echo "selected"; } ?>>2025</option>
			        <option value="2026" <?php if( $tampil['tahun_akad']=='2026'){echo "selected"; } ?>>2026</option>
			        <option value="2027" <?php if( $tampil['tahun_akad']=='2027'){echo "selected"; } ?>>2027</option>
			        <option value="2028" <?php if( $tampil['tahun_akad']=='2028'){echo "selected"; } ?>>2028</option>
			        <option value="2029" <?php if( $tampil['tahun_akad']=='2029'){echo "selected"; } ?>>2029</option>
			        <option value="2030" <?php if( $tampil['tahun_akad']=='2030'){echo "selected"; } ?>>2030</option>
		        </select>
		    </div>


			<div class="form-group">
			  <label>Smester</label>
			  <select class="form-control" required name="smester">
			     <option>-Pilih Smester-</option>
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
	        	<label>Prodi</label>
	        	<select class="form-control" required name="jurusan">
		         <option>-Pilih Prodi-</option>}
	            <?php 
	            	$sql = $koneksi->query("SELECT * from tb_jurusan");
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
			     <option>-Pilih Kelas-</option>
			     <option value="Pagi" <?php if( $tampil['kelas']=='Pagi'){echo "selected"; } ?>>Pagi</option>
			     <option value="Sore" <?php if( $tampil['kelas']=='Sore'){echo "selected"; } ?>>Sore</option>
			     <option value="Malam" <?php if( $tampil['kelas']=='Malam'){echo "selected"; } ?>>Malam</option>
			  </select>
			</div>

	       <div class="form-group">
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

			<div class="form-group">
			  <img src="img/<?= $tampil['foto'] ?>" width="75" height="75">
			</div>

			<div class="form-group">
			  <label>Ganti Foto</label>
			  <input type="file" name="foto">
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
		$pass    = $_POST['pass'];
		
		$foto    = $_FILES['foto']['name'];
		$lokasi  = $_FILES['foto']['tmp_name'];

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
			$koneksi->query("UPDATE  tb_mahasiswa SET  nama = '$nama', tempat_lahir = '$tempat', tanggal_lahir = '$tgl', alamat = '$alamat', kode_jurusan = '$jurusan', kelas = '$kelas', kode_kuri = '$kode_kuri', smester = '$smester', jenis_kelamin = '$jk', email = '$email', telpon = '$telpon'  WHERE nim = '$nim'");
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
