<?php
$kode_mk = $_GET['kode_mk'];
$nim     = $_GET['id'];
$dosen   = $_GET['dosen'];
$krs     = $_GET['krs'];
$sql     = $koneksi->query("SELECT * FROM tb_mahasiswa, tb_matkul, tb_dosen, tb_jadwal, tb_krs WHERE
                            tb_mahasiswa.nim = '$nim' AND
                            tb_krs.kode = '$krs' AND
                            tb_matkul.kode_mk = '$kode_mk' AND
                            tb_dosen.kode_dosen = '$dosen' ");
$tampil = $sql->fetch_assoc();
?>


<?php
$sql3 = $koneksi->query("SELECT * FROM tb_sett");
$data3 = $sql3->fetch_assoc();
?>

<form role="form" method="POST">
    <div class="box box-primary">
       <div class="box-header with-border">
            <h3 class="box-title">Masukan Nilai Mahasiswa</h3><br>Tahun Akademik <b><?=$data3 ['tahun_akad'];?></b>
        </div>
        <div class="box-body">
        	<div class="form-group">
                <label>Nim :</label>
                <input type="text" class="form-control" name="nim" value="<?php echo $tampil['nim']; ?>" readonly>
            </div>

            <div class="form-group">
                <input type="hidden" class="form-control" name="tahun_akad" value="<?php echo $data3['tahun_akad']; ?>">
            </div>

            <div class="form-group">
                <label>Nama :</label>
                <input type="text" class="form-control" name="nama" value="<?php echo $tampil['nama']; ?>" readonly>
            </div>

            <div class="form-group">
                <label>Kode Mata Kuliah :</label>
                <input type="text" class="form-control" name="kode_mk" value="<?php echo $tampil['kode_mk']; ?>" readonly>
            </div>

             <div class="form-group">
                <label>Nama Mata Kuliah :</label>
                <input type="text" class="form-control" name="nama_mk" value="<?php echo $tampil['nama_mk'];?>" readonly>
            </div>

            <div class="form-group">
                <label>Keterangan Matakuliah :</label>
                <input type="text" class="form-control" name="ket" value="<?php echo $tampil['ket'];?>" readonly>
            </div>

            <div class="form-group">
                <label>Kelas :</label>
                <input type="text" class="form-control" name="kelas" value="<?php echo $tampil['kelas'];?>" readonly>
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
                <label>Nama Dosen :</label>
                <input type="text" class="form-control" name="nama_dosen"  value="<?php echo $tampil['nama_dosen'];?>" readonly>
            </div>


            <div class="form-group">
                <label>Semester Yang Ditempuh :</label>
                <input type="number" class="form-control" name="smester"  value="<?php echo $tampil['smester'];?>" readonly>
            </div>

			<div class="form-group">
                <label>Nilai Akhir :</label>
                <input type="number" class="form-control" name="nilai_akhir">
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
    $tahun_akad = $_POST['tahun_akad'];
    $kode_mk    = $_POST['kode_mk'];
    $kode_dosen = $_POST['kode_dosen'];
    $smester    = $_POST['smester'];
    $kelas    = $_POST['kelas'];
    $nilai_akhir = $_POST['nilai_akhir'];
    $simpan     = $koneksi->query("INSERT INTO tb_nilai (nim, tahun_akad, kode_mk, kode_dosen, smestern, kelas, nilaiakhir) VALUES ('$nim', '$tahun_akad', '$kode_mk', '$kode_dosen', '$smester', '$kelas', '$nilai_akhir')");

    

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
				            window.location = '?page=nilai_d&aksi=lihat_mhs&kode_mk=$kode_mk&dosen=$dosen&kelas=$kelas';
				        });
				    }, 300);
				</script>
			";
		}
	}
 ?>
