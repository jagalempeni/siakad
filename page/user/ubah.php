<?php 
if($_SESSION['admin']){
?>

<?php 		
$id   = $_GET['id'];
$sql  = $koneksi->query("SELECT * FROM tb_user WHERE id = '$id'");
$data = $sql->fetch_assoc();
?>
 
<form method="POST">
    <div class="box box-primary">
       <div class="box-header with-border">
          <h3 class="box-title">Ubah Data User</h3>
       </div>

       <div class="box-body">
         <div class="form-group">
             <label>Nama</label>
             <input type="text" class="form-control" required name="nama" value="<?= $data['nama']; ?>" readonly>
         </div>

         <div class="form-group">
            <label>Password</label>
            <input type="text" class="form-control" required name="pass" value="<?= $data["pass"]; ?>">
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
        $pass    = $_POST['pass'];
        $ubah    = $koneksi->query("UPDATE tb_user SET  pass = '$pass' WHERE id = '$id'");

		if ($ubah) {
			echo "
    			<script>
    			    setTimeout(function() {
    			        swal({
    			            title: 'Selamat!',
    			            text: 'Data Berhasil Diubah!',
    			            type: 'success'
    			        }, function() {
    			            window.location = '?page=user';
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