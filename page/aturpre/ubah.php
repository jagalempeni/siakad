<?php 
$id     = $_GET['id'];
$ambil  = $koneksi->query("SELECT * FROM tb_jadwal, tb_matkul WHERE 
                                tb_jadwal.kode_mk = tb_matkul.kode_mk AND
                                id = '$id'");
$tampil = $ambil->fetch_assoc();
$kelas  = $tampil['kelas'];
$kdosen = $tampil['kode_dosen'];
 ?>
<form role="form" method="POST">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Ubah Presentase Nilai</h3>
        </div>
        <div class="box-body">
             <div class="form-group">
                <label>Kode Matakuliah :</label>
                <input type="text" class="form-control" required name="matkul" value="<?php echo $tampil['kode_mk']; ?>" readonly>
            </div>

            <div class="form-group">
                <label>Matakuliah :</label>
                <input type="text" class="form-control" required name="namamatkul" value="<?php echo $tampil['nama_mk']; ?>" readonly>
            </div>


            <div class="form-group">
                <label>Kelas :</label>
                <input type="text" class="form-control" required name="kelas" value="<?php echo $kelas ?>" readonly>
            </div>

            <div class="form-group">
                <label>Presensi :</label>
                <input type="text" class="form-control" required name="presensi" value="0.15" >
            </div>

            <div class="form-group">
                <label>Tugas :</label>
                <input type="text" class="form-control" required name="tugas" value="0.1" >
            </div>

            <div class="form-group">
                <label>Quiz :</label>
                <input type="text" class="form-control" required name="quiz" value="0.05" >
            </div>

            <div class="form-group">
                <label>UTS :</label>
                <input type="text" class="form-control" required name="uts" value="0.3" >
            </div>

            <div class="form-group">
                <label>UAS :</label>
                <input type="text" class="form-control" required name="uas" value="0.4" >
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
    $presensi   = $_POST['presensi'];
    $tugas   = $_POST['tugas'];
    $quiz   = $_POST['quiz'];
    $uts = $_POST['uts'];
    $uas   = $_POST['uas'];
    $simpan  = $koneksi->query("UPDATE tb_jadwal SET kode_mk = '$matkul', kelas = '$kelas', presensi = '$presensi', tugas = '$tugas', quiz = '$quiz', uts = '$uts', uas = '$uas' WHERE id = '$id' ");
    $update     = $koneksi->query("UPDATE tb_krs SET presensi = '$presensi', tugas = '$tugas', quiz = '$quiz', uts = '$uts', uas = '$uas' WHERE kode_mk='$matkul'");

    $update1     = $koneksi->query("UPDATE tb_nilai SET prepre = '$presensi', pretug = '$tugas', prequi = '$quiz', preuts = '$uts', preuas = '$uas' WHERE kode_mk='$matkul' AND kelas='$kelas'");

    if ($simpan) {
        echo "
            <script>
                setTimeout(function() {
                    swal({
                        title: 'Selamat!',
                        text: 'Data Berhasil Diubah!',
                        type: 'success'
                    }, function() {
                        window.location = '?page=aturpre&dosen=$kdosen';
                    });
                }, 300);
            </script>
        ";
    }
}
?>
                            