<?php 
if($_SESSION['admin'] || $_SESSION['dosen']){
?>

<?php
$kode_mk = $_GET['kode_mk'];
$id      = $_GET['id'];
$nim     = $_GET['nim'];
$dosen   = $_GET['dosen'];
$krs     = $_GET['krs'];
$sql     = $koneksi->query("SELECT * FROM tb_mahasiswa, tb_matkul, tb_dosen WHERE 
                        tb_mahasiswa.nim    = '$nim' AND
                        tb_matkul.kode_mk   ='$kode_mk' AND
                        tb_dosen.kode_dosen = '$dosen'");
$tampil    = $sql->fetch_assoc();
$sql_nilai = $koneksi->query("SELECT * FROM tb_nilai WHERE id = '$id'");
$edit_n    = $sql_nilai->fetch_assoc();
?>
<form role="form" method="POST">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Example</h3>
        </div>
            
        <div class="box-body">
        	<div class="form-group">
                <label>Nim :</label>
                <input type="text" class="form-control" required name="nim" value="<?= $tampil['nim']; ?>" readonly>
            </div>

            <div class="form-group">
                <label>Nim :</label>
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
                <input type="number" class="form-control" required name="smester"  value="<?= $tampil['smester'];?>" readonly>
            </div>

            <div class="form-group">
                <label>Tugas :</label>
                <input type="number" class="form-control" required name="tugas" value="<?= $edit_n['tugas']; ?>">
            </div>

            <div class="form-group">
                <label>UTS :</label>
                <input type="number" class="form-control" required name="uts" value="<?= $edit_n['uts']; ?>">
            </div>

            <div class="form-group">
                <label>UAS :</label>
                <input type="number" class="form-control" required name="uas" value="<?= $edit_n['uas']; ?>">
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
    $tugas  = $_POST['tugas'];
    $uts    = $_POST['uts'];
    $uas    = $_POST['uas'];
    $simpan = $koneksi->query("DELETE  tb_nilai SET  tugas = '$tugas', uts = '$uts', uas = '$uas' WHERE id = '$id'");

	if ($simpan) {
		echo "
			<script>
			    setTimeout(function() {
			        swal({
			            title: 'Selamat!',
			            text: 'Data Berhasil Dihapus!',
			            type: 'success'
			        }, function() {
			            window.location = '?page=nilai&aksi=lihat_mhs&kode_mk=$kode_mk&dosen=$dosen';
			        });
			    }, 300);
			</script>
		";
} } ?>

<?php
    }else{
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';
exit;
    }
?>    
