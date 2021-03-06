<form role="form" method="POST">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Tambah Jadwal</h3>
        </div>

        <div class="box-body">
        	<div class="form-group">
                <label>Mata Kuliah :</label>
                <select class="form-control" required name="matkul">
                    <option>-- Pilih Mata Kuliah --</option>
                    <?php
                	$sql = $koneksi->query("SELECT * FROM tb_matkul");
                	while ( $data = $sql->fetch_assoc() ) {
                		echo "
                			<option value='$data[kode_mk]'>$data[nama_mk]  || $data[kode_jurusan] || $data[smester]</option>
                		";
                	} ?>
                </select>
            </div>

            <div class="form-group">
                <label>Kelas</label>
                <select class="form-control" required name="kelas">
                    <option>-Pilih Kelas-</option>
                    <option value="Pagi">Pagi</option>
                    <option value="Sore">Sore</option>
                    <option value="Malam">Malam</option>
                </select>
            </div>

            <div class="form-group">
                <label>Ruang :</label>
                <select class="form-control" required name="ruang">
                    <option>-- Pilih Ruang --</option>
                    <?php
                    	$sql = $koneksi->query("SELECT * FROM tb_ruang");
                    	while ( $data = $sql->fetch_assoc() ) {
                    		echo "
                    			<option value='$data[kode_ruang]'>$data[nama_ruang]</option>
                    		";
                    	}
                     ?>
                </select>
            </div>

            <div class="form-group">
                <label>Dosen :</label>
                <select class="form-control" required name="dosen">
                    <option>-- Pilih Dosen --</option>
                    <?php
                    	$sql = $koneksi->query("SELECT * FROM tb_dosen");
                    	while ( $data = $sql->fetch_assoc() ) {
                    		echo "
                    			<option value='$data[kode_dosen]'>$data[nama_dosen]</option>
                    		";
                    	} ?>
                </select>
            </div>

            <div class="form-group">
                <label for="hari">Hari :</label>
                <select name="hari" class="form-control" id="hari">
                    <option>-- Pilih Hari --</option>
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
                <input type="time" class="form-control" placeholder="12:09:00" name="jam_m">
            </div>

             <div class="form-group">
                <label>Jam Selesai :</label>
                <input type="time" class="form-control" placeholder="13:09:00" name="jam_s">
            </div>
        
        </div>

        <div class="box-footer">
            <input type="submit" name="simpan" value="Simpan" class="btn btn-sm btn-flat btn-primary">
            <input type=button value=Kembali onclick=self.history.back() class="btn btn-sm btn-flat btn-info">
        </div>
    </div>
</form>

<?php

if (isset($_POST['simpan'])) {
    $matkul  = $_POST['matkul'];
    $kelas  = $_POST['kelas'];
    $ruang   = $_POST['ruang'];
    $hari   = $_POST['hari'];
    $dosen   = $_POST['dosen'];    
    $jam_m   = $_POST['jam_m'];
    $jam_s   = $_POST['jam_s'];
    $simpan  = $koneksi->query("INSERT INTO tb_jadwal (kode_mk, kelas, kode_ruang, nama_hari, jam_mulai, jam_selesai, kode_dosen)VALUES('$matkul', '$kelas', '$ruang', '$hari', '$jam_m', '$jam_s', '$dosen')");

    if ($simpan) {
		echo "
			<script>
			    setTimeout(function() {
			        swal({
			            title: 'Selamat!',
			            text: 'Data Berhasil Disimpan!',
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
