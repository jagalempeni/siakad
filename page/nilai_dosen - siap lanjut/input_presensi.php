<form role="form" method="POST">
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Data Pengisian Nilai</h3>
</div>

<div class="box-body">
    <table class="table table-bordered table-condensed" id="dataTables-example">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Nilai Presensi</th>
            </tr>
        </thead>
    <tbody>


<?php
      $dosen = $_SESSION['username'];
      $kelas = $_GET['kelas'];
      $no    = 1;
      $sql   = $koneksi->query("SELECT * FROM tb_mahasiswa, tb_jurusan, tb_krs, tb_matkul WHERE 
        tb_mahasiswa.kode_jurusan = tb_jurusan.kode_jurusan AND
        tb_mahasiswa.nim          = tb_krs.nim AND


        tb_matkul.kode_mk         = tb_krs.kode_mk AND
        tb_krs.kode_mk            =  '$kode_mk' AND 
        tb_krs.kelas            =  '$kelas' AND 
        tb_krs.status_nilai       = 1 ");
      while ( $data = $sql->fetch_assoc() ) { ?>



        <tr>
            <td><?= $no++; ?></td>
            <td><?= $data['nama']; ?></td>
            <td><input type="number" class="form-control" name="n_presensi" placeholder="masukan nilai disini"> 
            </td>       
        
        </tr>
    </tbody>
        
    </div>
</form>
</table>
<div class="box-footer">
            <input type="submit" name="simpan" value="Simpan" class="btn btn-flat btn-sm btn-primary">
            <input type=button value=Kembali onclick=self.history.back() class="btn btn-flat btn-sm btn-info">
        </div>
</div>
</div>
</form>

<?php
if (isset($_POST['simpan'])) {
    $nim        = $_POST['nim'];
    $kode_mk    = $_POST['kode_mk'];
    $kode_dosen = $_POST['kode_dosen'];
    $smester    = $_POST['smester'];
    $kelas    = $_POST['kelas'];
	$presensi   = $_POST['presensi'];
    $tugas      = $_POST['tugas'];    
    $quiz      = $_POST['quiz'];
    $uts        = $_POST['uts'];
    $uas        = $_POST['uas'];
    $ket        = $_POST['ket'];
    $prepre  = $_POST['prepre'];
    $pretug      = $_POST['pretug'];    
    $prequi      = $_POST['prequi'];
    $preuts        = $_POST['preuts'];
    $preuas        = $_POST['preuas'];
    $simpan     = $koneksi->query("INSERT INTO tb_nilai (nim, kode_mk, kode_dosen, smester, kelas, presensi, tugas, quiz, uts, uas, ket, prepre, pretug, prequi, preuts, preuas) VALUES ('$nim', '$kode_mk', '$kode_dosen', '$smester', '$kelas', '$presensi', '$tugas', '$quiz', '$uts', '$uas', '$ket', '$prepre', '$pretug', '$prequi', '$preuts', '$preuas')");
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
