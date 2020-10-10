<form role="form" method="POST" enctype="multipart/form-data">
	<div class="box box-primary">
	   <div class="box-header with-border">
	     	<h3 class="box-title">Tambah Data Master</h3>
	   </div>
	   <div class="box-body">
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
	$jumlah     = $_POST['jumlah'];
	
	$tambah =	$koneksi->query("INSERT INTO sk_master (nama_bayar, angkatan_bayar, jumlah_bayar)VALUES('$nama', '$angkatan', '$jumlah')");
			
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