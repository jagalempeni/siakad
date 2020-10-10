<?php 		
$id   = $_GET['id'];
$sql  = $koneksi->query("SELECT * FROM tb_krs WHERE kode = '$id'");
$data = $sql->fetch_assoc();
?>
 
<form method="POST">
    <div class="box box-primary">
       <div class="box-header with-border">
          <h3 class="box-title">Ubah Keterangan Matakuliah</h3>
       </div>

       <div class="box-body">
         <div class="form-group">
             <label>Kode Matakuliah</label>
             <input type="text" class="form-control" required name="kode" value="<?= $data['kode_mk']; ?>" readonly>
         </div>

        <div class="form-group">
        <label>Ubah Keterangan</label>
        <select class="form-control" required name="ket">
           <option>-Pilih Keterangan-</option>
           <option value="Baru" <?php if( $tampil['ket']=='Baru'){echo "selected"; } ?>>Baru</option>
           <option value="Ulang" <?php if( $tampil['ket']=='Ulang'){echo "selected"; } ?>>Ulang</option>
           <option value="Transfer" <?php if( $tampil['ket']=='Transfer'){echo "selected"; } ?>>Transfer</option>
        </select>
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
        $ket    = $_POST['ket'];
        $ubah    = $koneksi->query("UPDATE tb_krs SET  ket = '$ket' WHERE kode = '$id'");

        $update = $koneksi->query("UPDATE tb_nilai SET ket = '$ket' WHERE kode_mk = 'kode'");

		if ($ubah) {
			echo "
    			<script>
    			    setTimeout(function() {
    			        swal({
    			            title: 'Selamat!',
    			            text: 'Data Berhasil Diubah!',
    			            type: 'success'
    			        }, function() {
    			            window.location = '?page=krs';
    			        });
    			    }, 300);
    			</script>
			";
		} else{
            mysqli_error($koneksi); 
        }
	}
?>
                            