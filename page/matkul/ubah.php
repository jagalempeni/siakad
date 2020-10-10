<?php 
if($_SESSION['admin']){
?>

<?php 		
$kode = $_GET['id'];
$sql  = $koneksi->query("SELECT * FROM tb_matkul left join tb_jurusan on tb_matkul.kode_mk = '$kode'");
$data = $sql->fetch_assoc();
?>
 
<form role="form" method="POST">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Ubah Data Matakuliah</h3>
        </div>

        <div class="box-body">
            <div class="form-group">
                <label>Kode Mata Kuliah :</label>
                <input type="text" class="form-control" required name="kode" value="<?= $data['kode_mk']; ?>" readonly>
            </div>

            <div class="form-group">
                <label>Nama Mata Kuliah :</label>
                <input type="text" class="form-control" required name="nama" value="<?= $data['nama_mk']; ?>">
            </div>



            <div class="form-group">
                <label>SKS :</label>
                <input type="number" class="form-control" required name="sks" value="<?= $data['sks']; ?>">
            </div>

            <div class="form-group">
                <label>Semester :</label>
                <select class="form-control" required name="smester">
                    <option><?= $data['smester']; ?></option>
                    <option value="1" <?php if( $data['smester']=='1'){echo "selected"; } ?>>1</option>
                    <option value="2" <?php if( $data['smester']=='2'){echo "selected"; } ?>>2</option>
                    <option value="3" <?php if( $data['smester']=='3'){echo "selected"; } ?>>3</option>
                    <option value="4" <?php if( $data['smester']=='4'){echo "selected"; } ?>>4</option>
                    <option value="5" <?php if( $data['smester']=='5'){echo "selected"; } ?>>5</option>
                    <option value="6" <?php if( $data['smester']=='6'){echo "selected"; } ?>>6</option>
                    <option value="7" <?php if( $data['smester']=='7'){echo "selected"; } ?>>7</option>
                    <option value="8" <?php if( $data['smester']=='8'){echo "selected"; } ?>>8</option>
                </select>
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
        $nama    = $_POST['nama'];
        $sks     = $_POST['sks'];
        $smester = $_POST['smester'];
        $ubah    = $koneksi->query("update tb_matkul set  nama_mk='$nama', sks='$sks', smester='$smester' where kode_mk='$kode'");

		if ($ubah) {
			echo "
    			<script>
    			    setTimeout(function() {
    			        swal({
    			            title: 'Selamat!',
    			            text: 'Data Berhasil Diubah!',
    			            type: 'success'
    			        }, function() {
    			            window.location = '?page=matkul';
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
                            