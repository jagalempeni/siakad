<?php
$kode_mk = $_GET['kode_mk'];
$nim     = $_GET['id'];
$dosen   = $_GET['dosen'];
$krs     = $_GET['krs'];
$sql     = $koneksi->query("SELECT * FROM tb_mahasiswa, tb_matkul, tb_dosen WHERE
                            tb_mahasiswa.nim = '$nim' AND
                            tb_matkul.kode_mk = '$kode_mk' AND
                            tb_dosen.kode_dosen = '$dosen' ");
$tampil = $sql->fetch_assoc();
?>

<form role="form" method="POST">
    <div class="box box-primary">
       <div class="box-header with-border">
            <h3 class="box-title">Example</h3>
        </div>
        <div class="box-body">
        	<div class="form-group">
                <label>Nim :</label>
                <input type="text" class="form-control" name="nim" value="<?php echo $tampil['nim']; ?>" readonly>
            </div>

            <div class="form-group">
                <label>Nim :</label>
                <input type="text" class="form-control" name="nama" value="<?php echo $tampil['nama']; ?>" readonly>
            </div>

            <div class="form-group">
                <label>Kode Mata Kuliah :</label>
                <input type="text" class="form-control" name="kode_mk" value="<?php echo $tampil['kode_mk']; ?>" readonly>
            </div>

             <div class="form-group">
                <label>Nama Mata Kuliah :</label>
                <input type="text" class="form-control" name="nama" value="<?php echo $tampil['nama_mk'];?>" readonly>
            </div>

            <div class="form-group">
                <label>SKS :</label>
                <input type="number" class="form-control" name="sks"  value="<?php echo $tampil['sks'];?>" readonly>
            </div>

            <div class="form-group">
                <label>Kode Dosen :</label>
                <input type="text" class="form-control" name="kode_dosen"  value="<?php echo $tampil['kode_dosen'];?>" readonly>
            </div>

             <div class="form-group">
                <label>Kode Dosen :</label>
                <input type="text" class="form-control" name="nama_dosen"  value="<?php echo $tampil['nama_dosen'];?>" readonly>
            </div>


            <div class="form-group">
                <label>Smester Yang Ditempuh :</label>
                <input type="number" class="form-control" name="smester"  value="<?php echo $tampil['smester'];?>" readonly>
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
            <input type="submit" name="simpan" value="Simpan" class="btn btn-flat btn-sm btn-primary">
            <input type=button value=Kembali onclick=self.history.back() class="btn btn-flat btn-sm btn-info">
        </div>
    </div>
</form>

<?php
if (isset($_POST['simpan'])) {
    $nim        = $_POST['nim'];
    $kode_mk    = $_POST['kode_mk'];
    $kode_dosen = $_POST['kode_dosen'];
    $smester    = $_POST['smester'];
	$presensi   = $_POST['presensi'];
    $tugas      = $_POST['tugas'];    
    $quiz      = $_POST['quiz'];
    $uts        = $_POST['uts'];
    $uas        = $_POST['uas'];
    $simpan     = $koneksi->query("INSERT INTO tb_nilai (nim, kode_mk, kode_dosen, smester, presensi, tugas, quiz, uts, uas) VALUES ('$nim', '$kode_mk', '$kode_dosen', '$smester', '$tugas', '$quiz', '$tugas', '$uts', '$uas')");
	$update     = $koneksi->query("UPDATE tb_krs SET status_nilai= 0 WHERE kode='$krs'");
		if ($simpan) {
			echo "

				<script>
				    setTimeout(function() {
				        swal({
				            title: 'Selamat!',
				            text: 'Data Berhasil Disimpan!',
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
