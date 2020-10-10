<?php
$kode_mk = $_GET['kode_mk'];
$id      = $_GET['id'];
$nim     = $_GET['nim'];
$dosen   = $_GET['dosen'];
$krs     = $_GET['krs'];

$sql     = $koneksi->query("SELECT * FROM tb_nilai, tb_mahasiswa, tb_matkul, tb_dosen WHERE  tb_mahasiswa.nim    = '$nim' AND
                    tb_matkul.kode_mk   = '$kode_mk' AND
                    tb_dosen.kode_dosen = '$dosen' ");
$tampil    = $sql->fetch_assoc();
$kelas = $tampil ['kelas'];

$sql1     = $koneksi->query("SELECT * FROM tb_nilai, tb_mahasiswa, tb_matkul, tb_dosen WHERE                tb_mahasiswa.nim    = '$nim' AND
                    tb_matkul.kode_mk   = '$kode_mk' AND
                    tb_dosen.kode_dosen = '$dosen' ");
$tampil1    = $sql1->fetch_assoc();

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
                <label>Kelas :</label>
                <input type="text" class="form-control" required name="kelas"  value="<?php echo $kelas ?>" readonly>
            </div>

            <div class="form-group">
                <label>Kode Dosen :</label>
                <input type="text" class="form-control" required name="kode_dosen"  value="<?= $tampil['kode_dosen'];?>" readonly>
            </div>

             <div class="form-group">
                <label>Nama Dosen :</label>
                <input type="text" class="form-control" required name="nama_dosen"  value="<?= $tampil['nama_dosen'];?>" readonly>
            </div>


            <div class="form-group">
                <label>Semester Yang Ditempuh :</label>
                <input type="number" class="form-control" required name="smester" value="<?= $tampil['smester'];?>" readonly>
            </div>
			
			<div class="form-group">
                <label>Presensi :</label>
                <input type="number" class="form-control" name="presensi" value="<?= $tampil['presensi']?>">
            </div> 

            <div class="form-group">
                <label>Tugas :</label>
                <input type="number" class="form-control" name="tugas" value="<?= $tampil['tugas']?>">
            </div>

            <div class="form-group">
                <label>UTS :</label>
                <input type="number" class="form-control" name="uts" value="<?= $tampil['uts']?>">
            </div>

            <div class="form-group">
                <label>UAS :</label>
                <input type="number" class="form-control" name="uas" value="<?= $tampil['uas']?>">
            </div> 
        
        <div class="box-footer">
            <input type="submit" name="simpan" value="Ubah" class="btn btn-flat btn-sm btn-primary">
            <input type=button value=Kembali onclick=self.history.back() class="btn btn-flat btn-sm btn-info">
        </div>
    </div>
</form>
<?php
if (isset($_POST['simpan'])) {
	$presensi   = $_POST['presensi'];
    $tugas      = $_POST['tugas'];
    $quiz       = $_POST['quiz'];
    $uts        = $_POST['uts'];
    $uas        = $_POST['uas'];
    $prepre     = $_POST['prepre'];
    $pretug     = $_POST['pretug'];    
    $prequi     = $_POST['prequi'];
    $preuts     = $_POST['preuts'];
    $preuas     = $_POST['preuas'];
    $nilai     = $_POST['nilai'];
    $jumlah     = ($presensi * 100 / $presensi * $prepre) + ($tugas * $pretug) + ($quiz * $prequi) +          ($uts * $preuts) + ($uas * $preuas);
    $simpan     = $koneksi->query("UPDATE  tb_nilai SET tugas = '$tugas', presensi = '$presensi', uts = '$uts', uas = '$uas' WHERE nim = '$nim' AND kode_mk = '$kode_mk'");
		if ($simpan) {
			echo "
				<script>
				    setTimeout(function() {
				        swal({
				            title: 'Selamat!',
				            text: 'Data Berhasil Diubah!',
				            type: 'success'
				        }, function() {
				            window.location = '?page=nilai_d&aksi=lihat_mhs&kode_mk=$kode_mk&dosen=$dosen&kelas=$kelas';
				        });
				    }, 300);
				</script>
			";
		}
	}
?>
