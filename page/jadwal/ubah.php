<?php 
if($_SESSION['admin']){
?>

<?php 
$id     = $_GET['id'];
$ambil  = $koneksi->query("SELECT * FROM tb_jadwal WHERE id = '$id'");
$tampil = $ambil->fetch_assoc();
 ?>
<form role="form" method="POST">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Ubah Jadwal</h3>
        </div>
        <div class="box-body">
        	<div class="form-group">
                <label>Matakuliah</label>
                <select class="form-control" required name="matkul">
                 <option>-- Pilih Matakuliah --</option>}
                <?php 
                    $sql = $koneksi->query("SELECT * from tb_matkul");
                    while ($data=$sql->fetch_assoc()) {
                        $pilih=($data['kode_mk']==$tampil['kode_mk']?"selected":"");
                        echo "
                            <option value='$data[kode_mk]' $pilih>$data[nama_mk]</option>
                        ";
                    }
                 ?>
             </select>
          </div>


            <div class="form-group">
                <label>Kelas :</label>
                <select class="form-control" required name="kelas">
                    <option>-Pilih Kelas-</option>
                    <?php 
                        $sql = $koneksi->query("select * FROM tb_kelas");
                        while ($data = $sql->fetch_assoc()) {
                           $pilih1 = ($data['kelas'] == $tampil['kelas']?"selected":"");      
                            echo "
                                <option value='$data[kelas]' $pilih1>$data[kelas]</option>
                            ";
                        }
                     ?>
                </select>
            </div>

            <div class="form-group">
                <label>Ruang :</label>
                <select class="form-control" required name="ruang">
                    <option>-Pilih Ruang-</option>
                    <?php 
                    	$sql = $koneksi->query("select * FROM tb_ruang");
                    	while ($data = $sql->fetch_assoc()) {
                    	   $pilih1 = ($data['kode_ruang'] == $tampil['kode_ruang']?"selected":"");		
                    		echo "
                    			<option value='$data[kode_ruang]' $pilih1>$data[nama_ruang]</option>
                    		";
                    	}
                     ?>
                </select>
            </div>

            <div class="form-group">
                <label>Dosen :</label>
                <select class="form-control" required name="dosen">
                    <option>-Pilih Dosen-</option>
                    <?php 
                    	$sql = $koneksi->query("SELECT * FROM tb_dosen");	
                    	while ($data = $sql->fetch_assoc()) {
                    	$pilih = ($data['kode_dosen']==$tampil['kode_dosen']?"selected":"");		
                    		echo "

                    			<option value='$data[kode_dosen]' $pilih>$data[nama_dosen]</option>

                    		";
                    	}
                     ?>
                </select>
            </div>

            <div class="form-group">
                <label for="hari">Hari :</label>
                <select name="hari" class="form-control" id="hari">
                    <option value="<?= $tampil["nama_hari"]; ?>"><?= $tampil["nama_hari"]; ?></option>
                    <option>--- Pilih Hari ---</option>
                    <option value="Senin">Senin</option>
                    <option value="Selasa">Selasa</option>
                    <option value="Rabu">Rabu</option>
                    <option value="kamis">Kamis</option>
                    <option value="Jumat">Jumat</option>
                    <option value="Sabtu">Sabtu</option>
                </select>
            </div>
             <div class="form-group">
                <label>Jam Mulai :</label>
                <input type="time" class="form-control" required name="jam_m" value="<?php echo $tampil['jam_mulai']; ?>">
            </div>

             <div class="form-group">
                <label>Jam Selesai :</label>
                <input type="time" class="form-control" required name="jam_s" value="<?php echo $tampil['jam_selesai']; ?>">
            </div>
        </div>

        <div class="box-footer">
            <input type="submit" name="ubah" value="ubah" class="btn btn-flat btn-sm btn-primary">
            <input type=button value=Kembali onclick=self.history.back() class="btn btn-flat btn-sm btn-info">
        </div>
    </div>
</form>
<?php 

if (isset($_POST['ubah'])) {
    $matkul  = $_POST['matkul'];
    $kelas  = $_POST['kelas'];
    $ruang   = $_POST['ruang'];
    $hari   = $_POST['hari'];
    $dosen   = $_POST['dosen'];
    $jam_m   = $_POST['jam_m'];
    $jam_s   = $_POST['jam_s'];
    $simpan  = $koneksi->query("UPDATE tb_jadwal SET kode_mk = '$matkul', kelas = '$kelas', kode_ruang = '$ruang', nama_hari = '$hari',  jam_mulai = '$jam_m', jam_selesai = '$jam_s', kode_dosen = '$dosen' WHERE id = '$id' ");
    if ($simpan) {
    	echo "
    		<script>
    		    setTimeout(function() {
    		        swal({
    		            title: 'Selamat!',
    		            text: 'Data Berhasil Diubah!',
    		            type: 'success'
    		        }, function() {
    		            window.location = '?page=jadwal';
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
                            