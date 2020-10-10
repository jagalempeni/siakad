<?php 
if($_SESSION['admin']){
?>

<form method="POST">
 	<div class="box box-primary">
	   <div class="box-header with-border">
	      <h3 class="box-title">Tambah Data Prodi</h3>
	   </div>

	   <div class="box-body">
         <div class="form-group">
             <label>Kode Prodi</label>
             <input type="text" class="form-control" required name="kode">
         </div>

         <div class="form-group">
            <label>Nama Prodi</label>
            <input type="text" class="form-control" required name="nama">
         </div>

         <div class="form-group">
            <label>Sebutan Lulusan</label>
            <input type="text" class="form-control" required name="sebutan">
         </div>

         <div class="form-group">
            <label>Nama Kaprodi</label>
            <input type="text" class="form-control" required name="kaprodi">
         </div>

         <div class="form-group">
            <label>NIDN Kaprodi</label>
            <input type="text" class="form-control" required name="nidn">
         </div>
   	</div>

	   <div class="box-footer">
	   	<input type="submit" name="simpan" value="Simpan" class="btn btn-flat btn-sm btn-primary">
	      <input type=button value="Kembali" onclick="self.history.back()" class="btn btn-flat btn-sm btn-info">
	   </div>
	</div>
</form>

<?php 
	if (isset($_POST['simpan'])) {
		$kode    = $_POST['kode'];
		$nama    = $_POST['nama'];
		$sebutan    = $_POST['sebutan'];
		$kaprodi    = $_POST['kaprodi'];
        $nidn    = $_POST['nidn'];
		$simpan  = $koneksi->query("INSERT INTO tb_jurusan VALUES ('$kode', '$nama', '$sebutan', '$kaprodi', '$nidn', '1')");
		if ($simpan) {
			echo "
    			<script>
    			    setTimeout(function() {
    			        swal({
    			            title: 'Selamat!',
    			            text: 'Data Berhasil Ditambah!',
    			            type: 'success'
    			        }, function() {
    			            window.location = '?page=jurusan';
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
    			            window.location = '?page=jurusan';
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
                            