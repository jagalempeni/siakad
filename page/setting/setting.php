<?php 		
$kode = $_GET['id'];
$sql  = $koneksi->query("SELECT * FROM tb_sett");
$data = $sql->fetch_assoc();
?>
 
<form role="form" method="POST">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Ubah Data Pimpinan</h3>
        </div>

        <div class="box-body">
            <div class="form-group">
                <label>Ketua :</label>
                <input type="text" class="form-control" required name="ket" value="<?= $data['ket']; ?>">
            </div>

            <div class="form-group">
                <label>NIDN Ketua :</label>
                <input type="text" class="form-control" required name="no_ket" value="<?= $data['no_ket']; ?>">
            </div>

            <div class="form-group">
                <label>Waket I :</label>
                <input type="text" class="form-control" required name="waket" value="<?= $data['waket']; ?>">
            </div>

            <div class="form-group">
                <label>NIDN Waket I :</label>
                <input type="text" class="form-control" required name="no_waket" value="<?= $data['no_waket']; ?>">
            </div>
  
        </div>

        <div class="box-footer">
            <input type="submit" name="ubah" value="Ubah" class="btn btn-sm btn-flat btn-primary">
            <input type=button value="Kembali" onclick="self.history.back()" class="btn btn-sm btn-flat btn-info">
        </div>        
    </div>
</form>
<?php 
	if (isset($_POST['ubah'])) {	
        $ket    = $_POST['ket'];
        $no_ket     = $_POST['no_ket'];
        $waket = $_POST['waket'];
        $no_waket = $_POST['no_waket'];
        $ubah    = $koneksi->query("update tb_sett set  ket='$ket', no_ket='$no_ket', waket='$waket', no_waket='$no_waket'");

		if ($ubah) {
			echo "
    			<script>
    			    setTimeout(function() {
    			        swal({
    			            title: 'Selamat!',
    			            text: 'Data Berhasil Diubah!',
    			            type: 'success'
    			        }, function() {
    			            window.location = '?page=setting';
    			        });
    			    }, 300);
    			</script>
			";
		} else{
            mysqli_error($koneksi); 
        }
	}
?>
                            