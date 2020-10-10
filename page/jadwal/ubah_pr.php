<?php 
$id     = $_GET['id'];
$dosen = $_GET['dosen'];
$ambil  = $koneksi->query("SELECT * FROM tb_jadwal, tb_dosen, tb_matkul WHERE  
          tb_dosen.kode_dosen  = tb_jadwal.kode_dosen AND
          tb_jadwal.kode_mk    = tb_matkul.kode_mk AND
          tb_jadwal.kode_dosen = '$dosen'");
        while ($data = $mk->fetch_assoc()) { ?>
<form role="form" method="POST">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Atur Presentase Nilai</h3>
        </div>
        <div class="box-body">
        	<div class="form-group">
                <label>Mata Kuliah :</label>
                <select class="form-control" required name="matkul" disable>
                    <?php 
                    	$sql = $koneksi->query("SELECT * FROM tb_matkul");
                    	while ($data = $sql->fetch_assoc()) {
                    	$pilih2 = ($data['kode_mk'] == $tampil['kode_mk']?"selected":"");		
                    		echo "

                            <option value='$data[kode_mk]'>$data[nama_mk]  || $data[kode_jurusan] || $data[smester]</option>

                    		";
                    	}
                     ?>
                </select>
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
    $tanggal = $_POST['tanggal'];
    $jam_m   = $_POST['jam_m'];
    $jam_s   = $_POST['jam_s'];
    $simpan  = $koneksi->query("UPDATE tb_jadwal SET kode_mk = '$matkul', kelas = '$kelas', kode_ruang = '$ruang', nama_hari = '$hari', tanggal = '$tanggal', jam_mulai = '$jam_m', jam_selesai = '$jam_s', kode_dosen = '$dosen' WHERE id = '$id' ");
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
                            