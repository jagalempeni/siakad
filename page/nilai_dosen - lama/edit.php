<?php
$kode_mk = $_GET['kode_mk'];
$id      = $_GET['id'];
$nim     = $_GET['nim'];
$dosen   = $_GET['dosen'];
$krs     = $_GET['krs'];

$sql     = $koneksi->query("SELECT * FROM tb_mahasiswa, tb_matkul, tb_dosen WHERE  tb_mahasiswa.nim    = '$nim' AND
                    tb_matkul.kode_mk   = '$kode_mk' AND
                    tb_dosen.kode_dosen = '$dosen' ");
$tampil    = $sql->fetch_assoc();

?>
<form role="form" method="POST">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Nilai</h3>
        </div>
        <div class="box-body">
        	<div class="form-group">
                <label>Nim :</label>
                <input type="text" class="form-control" required name="nim" value="<?= $tampil['nim']; ?>" readonly>
            </div>

            <div class="form-group">
                <label>Nama :</label>
                <input type="text" class="form-control" required name="nama" value="<?= $tampil['nama']; ?>" readonly>
            </div>

            <div class="form-group">
                <label>Kode Mata Kuliah :</label>
                <input type="text" class="form-control" required name="kode_mk" value="<?= $tampil['kode_mk']; ?>" readonly>
            </div>

             <div class="form-group">
                <label>Nama Mata Kuliah :</label>
                <input type="text" class="form-control" required name="nama" value="<?= $tampil['nama_mk'];?>" readonly>
            </div>

            <div class="form-group">
                <label>SKS :</label>
                <input type="number" class="form-control" required name="sks"  value="<?= $tampil['sks'];?>" readonly>
            </div>

            <div class="form-group">
                <label>Kode Dosen :</label>
                <input type="text" class="form-control" required name="kode_dosen"  value="<?= $tampil['kode_dosen'];?>" readonly>
            </div>

             <div class="form-group">
                <label>Kode Dosen :</label>
                <input type="text" class="form-control" required name="nama_dosen"  value="<?= $tampil['nama_dosen'];?>" readonly>
            </div>


            <div class="form-group">
                <label>Smester Yang Ditempuh :</label>
                <input type="number" class="form-control" required name="smester" value="<?= $tampil['smester'];?>" readonly>
            </div>
			
			<div class="form-group">
                <label>Presensi (15%):</label>
                <input type="number" class="form-control" name="presensi">
            </div> 
            
            <div class="form-group">
                <label>Tugas (10%):</label>
                <input type="number" class="form-control" name="tugas">
            </div>

            <div class="form-group">
                <label>Quiz (5%):</label>
                <input type="number" class="form-control" name="quiz">
            </div>

            <div class="form-group">
                <label>UTS (30%):</label>
                <input type="number" class="form-control" name="uts">
            </div>

            <div class="form-group">
                <label>UAS (40%):</label>
                <input type="number" class="form-control" name="uas">
            </div>     
        </div>
        
        <div class="box-footer">
            <input type="submit" name="simpan" value="Ubah" class="btn btn-flat btn-sm btn-primary">
            <input type=button value=Kembali onclick=self.history.back() class="btn btn-flat btn-sm btn-info">
        </div>
    </div>
</form>
<?php
if (isset($_POST['simpan'])) {
	$presensi  = $_POST['presensi'];
    $tugas     = $_POST['tugas'];
    $quiz     = $_POST['quiz'];
    $uts       = $_POST['uts'];
    $uas       = $_POST['uas'];
    $simpan    = $koneksi->query("UPDATE  tb_nilai SET presensi = '$presensi', tugas = '$tugas', quiz = '$quiz', uts = '$uts', uas = '$uas' WHERE nim = '$nim'");
		if ($simpan) {
			echo "
				<script>
				    setTimeout(function() {
				        swal({
				            title: 'Selamat!',
				            text: 'Data Berhasil Diubah!',
				            type: 'success'
				        }, function() {
				            window.location = '?page=nilai_d&aksi=lihat_mhs&kode_mk=$kode_mk&dosen=$dosen';
				        });
				    }, 300);
				</script>
			";
		}
	}
?>
