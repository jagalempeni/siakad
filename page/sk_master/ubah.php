<?php 
if($_SESSION['admin'] || $_SESSION['keuangan']){
?>

<?php 
	$id    = $_GET['id'];
	$sql    = $koneksi->query("SELECT * from sk_master WHERE id_master = '$id'");
	$tampil = $sql->fetch_assoc();
 ?>
<form method="POST" enctype="multipart/form-data">
	<div class="box box-primary">
	   <div class="box-header with-border">
	     	<h3 class="box-title">Ubah Data Master</h3>
	   </div>
	   <div class="box-body">
			<div class="form-group">
	        	<label>Nama Pembayaran</label>
	        	<input class="form-control" required name="nama" value="<?= $tampil['nama_bayar']; ?>">
		    </div>

		    <div class="form-group">
		        <label>Tahun Angkatan Mahasiswa</label>
		        <select class="form-control" name='angkatan'>
				<option><?= $tampil['angkatan_bayar']; ?></option>
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

		           <option><?= $tampil['kode_jurusan']; ?></option>}
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
			        <option><?= $tampil['semester'] ?></option>
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
		        <input class="form-control" required type="number" name="jumlah" value="<?= $tampil['jumlah_bayar']; ?>">
		    </div>
	</div><div class="box-footer">
        <input type="submit" name="ubah" value="Simpan" class="btn btn-flat btn-sm btn-primary">
          <input type=button value="Kembali" onclick="self.history.back()" class="btn btn-flat btn-sm btn-info">
       </div>
    </div>
</form>

<?php 
	if (isset($_POST['ubah'])) {	
        $nama    = $_POST['nama'];
        $angkatan    = $_POST['angkatan'];
        $jurusan   = $_POST['jurusan'];
        $semester   = $_POST['semester'];
        $jumlah    = $_POST['jumlah'];
        $ubah    = $koneksi->query("UPDATE sk_master SET  nama_bayar = '$nama', angkatan_bayar = '$angkatan', kode_jurusan = '$jurusan', semester = '$semester', jumlah_bayar = '$jumlah' WHERE id_master = '$id'");

		if ($ubah) {
			echo "
    			<script>
    			    setTimeout(function() {
    			        swal({
    			            title: 'Selamat!',
    			            text: 'Data Berhasil Diubah!',
    			            type: 'success'
    			        }, function() {
    			            window.location = '?page=sk_master';
    			        });
    			    }, 300);
    			</script>
			";
		} else{
            mysqli_error($koneksi); 
        }
	}
?>

<?php
    }else{
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';
exit;
    }
?>       