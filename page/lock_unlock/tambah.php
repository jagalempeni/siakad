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
		        <label>Tahun Angkatan</label>
		        <select class="form-control" required name="tahun_akad">
			        <option>-Pilih Tahun Akademik-</option>
			        <option value="2010">2010</option>
			        <option value="2011">2011</option>
			        <option value="2012">2012</option>	
			        <option value="2013">2013</option>
			        <option value="2014">2014</option>
			        <option value="2015">2015</option>
			        <option value="2016">2016</option>
			        <option value="2017">2017</option>
			        <option value="2018">2018</option>
			        <option value="2019">2019</option>
			        <option value="2020">2020</option>
			        <option value="2021">2021</option>
			        <option value="2022">2022</option>
			        <option value="2023">2023</option>
			        <option value="2024">2024</option>
			        <option value="2025">2025</option>
			        <option value="2026">2026</option>
			        <option value="2027">2027</option>
			        <option value="2028">2028</option>
			        <option value="2029">2029</option>
			        <option value="2030">2030</option>
		        </select>
		    </div>

			<div class="form-group">
		        <label>Smester</label>
		        <select class="form-control" required name="smester">
			        <option>-Pilih Smester-</option>
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

		           <option>-Pilih Prodi-</option>}
		           option
		               <?php 

		               	$sql = $koneksi->query("select * from tb_jurusan");
		               	while ($data=$sql->fetch_assoc()) {
		               		echo "

		               			<option value='$data[kode_jurusan]'>$data[nama_jurusan]</option>

		               		";
		               	}
		                ?>
		           </select>
		       </div>

		       <div class="form-group">
		           <label>Kurikulum</label>
		           <select class="form-control" required name="kurikulum">

		           <option>-Kurikulum-</option>}
		           option
		               <?php 

		               	$sql = $koneksi->query("select * from tb_kurikulum");
		               	while ($data=$sql->fetch_assoc()) {
		               		echo "

		               			<option value='$data[kode_kuri]'>$data[nama_kuri]</option>

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
		        <label>Foto</label>
		        <input type="file" name="foto">
		    </div>
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
	$jurusan = $_POST['jurusan'];
	$smester = $_POST['smester'];
	$kurikulum = $_POST['kurikulum'];
	$tahun_akad = $_POST['tahun_akad'];
	$jk      = $_POST['jk'];
	$email   = $_POST['email'];
	$telpon  = $_POST['telpon'];
	$pass    = $_POST['pass'];	
	$foto    = $_FILES['foto']['name'];
	$lokasi  = $_FILES['foto']['tmp_name'];
	$upload  = move_uploaded_file($lokasi, "img/".$foto);

	if ($upload) {
		
		$koneksi->query("INSERT INTO tb_mahasiswa (nim, nama, tempat_lahir, tanggal_lahir, alamat, kode_jurusan, tahun_akad, smester, kode_kuri, jenis_kelamin, email, telpon, foto, status_krs)VALUES('$nim', '$nama', '$tempat', '$tgl', '$alamat', '$jurusan', '$tahun_akad', '$smester', '$kurikulum', '$jk', '$email', '$telpon', '$foto', 1)");

		$koneksi->query("INSERT INTO tb_user set user_id='$nim', nama='$nama', pass='$pass', level='mahasiswa', foto='$foto'");
			?>
		        
		           <script>
					    setTimeout(function() {
					        swal({
					            title: "Selamat!",
					            text: "Data Berhasil Disimpan!",
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
