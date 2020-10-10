<?php 
if($_SESSION['admin']){
?>

<?php 		
$id   = $_GET['id'];
$sql  = $koneksi->query("SELECT * FROM tb_jurusan WHERE kode_jurusan = '$id'");
$data = $sql->fetch_assoc();
?>
 
<form method="POST">
    <div class="box box-primary">
       <div class="box-header with-border">
          <h3 class="box-title">Ubah Data Prodi</h3>
       </div>

       <div class="box-body">
         <div class="form-group">
             <label>Kode Prodi</label>
             <input type="text" class="form-control" required name="kode" value="<?= $data['kode_jurusan']; ?>" readonly>
         </div>

         <div class="form-group">
            <label>Nama Prodi</label>
            <input type="text" class="form-control" required name="nama" value="<?= $data["nama_jurusan"]; ?>">
        </div>

        <div class="form-group">
            <label>Sebutan Lulusan</label>
            <input type="text" class="form-control" required name="sebutan" value="<?= $data["sebutan_lulusan"]; ?>">
        </div>

        <div class="form-group">
            <label>Nama Kaprodi</label>
            <input type="text" class="form-control" required name="kaprodi" value="<?= $data["nama_kaprodi"]; ?>">
        </div>

        <div class="form-group">
            <label>NIDN Kaprodi</label>
            <input type="text" class="form-control" required name="nidn" value="<?= $data["nidn_kaprodi"]; ?>">
        </div>
    </div>

       <div class="box-footer">
        <input type="submit" name="ubah" value="Simpan" class="btn btn-flat btn-sm btn-primary">
          <input type=button value="Kembali" onclick="self.history.back()" class="btn btn-flat btn-sm btn-info">
       </div>
    </div>
</form>

<?php 
	if (isset($_POST['ubah'])) {	
        $nama    = $_POST['nama'];
        $sebutan    = $_POST['sebutan'];
        $kaprodi    = $_POST['kaprodi'];
        $nidn    = $_POST['nidn'];
        $ubah    = $koneksi->query("UPDATE tb_jurusan SET  nama_jurusan = '$nama', sebutan_lulusan = '$sebutan', nama_kaprodi = '$kaprodi', nidn_kaprodi = '$nidn' WHERE kode_jurusan = '$id'");

		if ($ubah) {
			echo "
    			<script>
    			    setTimeout(function() {
    			        swal({
    			            title: 'Selamat!',
    			            text: 'Data Berhasil Diubah!',
    			            type: 'success'
    			        }, function() {
    			            window.location = '?page=jurusan';
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