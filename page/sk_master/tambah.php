<form role="form" method="POST" enctype="multipart/form-data">
	<div class="box box-primary">
	   <div class="box-header with-border">
	     	<h3 class="box-title">Tambah Data Master</h3>
	   </div>
	   <div class="box-body">

	   		<input type="hidden" class="form-control" required name="idmaster">

		   <div class="form-group">
	        	<label>Nama Pembayaran</label>
	        	<input class="form-control" required name="nama" placeholder="Masukan nama pembayaran">
		    </div>

		    <div class="form-group">
		        <label>Tahun Angkatan Mahasiswa</label>
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
		        <label>Semester</label>
		        <select class="form-control" required name="semester">
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
		        <label>Jumlah Pembayaran</label>
		        <input class="form-control" required type="number" name="jumlah" placeholder="Masukan jumlah pembayaran">
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
	
	$nama    = $_POST['nama'];
	$angkatan  = $_POST['angkatan'];
	$semester  = $_POST['semester'];
	$jumlah     = $_POST['jumlah'];
	$idmaster     = $_POST['idmaster'];
	
	$tambah =	$koneksi->query("INSERT INTO sk_master (nama_bayar, angkatan_bayar, semester, jumlah_bayar)VALUES('$nama', '$angkatan', '$semester', '$jumlah')");
			
		if ($tambah) {
			echo "
    			<script>
    			    setTimeout(function() {
    			        swal({
    			            title: 'Selamat!',
    			            text: 'Data Berhasil Ditambah!',
    			            type: 'success'
    			        }, function() {
    			            window.location = '?page=sk_master';
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
    			            text: 'Silahkan cek kembali data yang anda masukan !',
    			            type: 'error'
    			        }, function() {
    			            window.location = '?page=sk_master';
    			        });
    			    }, 300);
    			</script>
			";
        }
	}
?>