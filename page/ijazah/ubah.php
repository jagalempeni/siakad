      <?php
      $no    = 1;
      $nim12 = $_GET['id'];
      $nilai = $koneksi->query("SELECT * FROM tb_nilai, tb_matkul, tb_mahasiswa WHERE 
        tb_nilai.kode_mk = tb_matkul.kode_mk AND 
        tb_nilai.nim = tb_mahasiswa.nim AND

        tb_nilai.nim = '$nim12' ORDER BY tb_matkul.smester ASC");
      while ($data = $nilai->fetch_assoc()) {
        $sks        = $data['sks'];
        $mutu_hasil = $sks * $mutu;
        $presensi      = $data['presensi'];
        $tugas      = $data['tugas'];
        $quiz      = $data['quiz'];        
        $smestern      = $data['smestern'];
        $uts        = $data['uts'];
        $uas        = $data['uas'];
        $prepre     = $data['prepre'];
        $pretug     = $data['pretug'];
        $prequi     = $data['prequi'];
        $preuts     = $data['preuts'];
        $preuas     = $data['preuas'];
        $jumlah     = ($presensi * 100 / $presensi * $prepre) + ($tugas * $data['pretug']) + ($quiz * $data['prequi']) + ($uts * $data['preuts']) + ($uas * $data['preuas']);

        if ($jumlah >= 85) {
            $grade = "A";
        }
        if ($jumlah   <= 84) {
            $grade = "AB";
        }
        if ($jumlah   <= 75) {
            $grade = "B";
        }
        if ($jumlah   <= 69) {
            $grade = "BC";
        }
        if ($jumlah   <= 63) {
            $grade = "C";
        }
        if ($jumlah   <= 57) {
            $grade = "CD";
        }
        if ($jumlah   <= 51) {
            $grade = "D";
        }
        if ($jumlah   <= 45) {
            $grade = "E";
        }
        if ($grade == "A") {
            $mutu = 4.00;
        } elseif ($grade == "AB") {
            $mutu = 3.50;
        } elseif ($grade == "B") {
            $mutu = 3.00;
        } elseif ($grade == "BC") {
            $mutu = 2.50;
        } elseif ($grade == "C") {
            $mutu = 2.00;
        } elseif ($grade == "CD") {
            $mutu = 1.50;
        } elseif ($grade == "D") {
            $mutu = 1.00;
        } else{
            $mutu = 0.00;
        } 
        $total = $sks * $mutu; ?>

        <?php
          $jml_krs  = $jml_krs + $data['sks'];
          $jml_mutu = $jml_mutu + $total;
          $ipk      = $jml_mutu / $jml_krs;

          if ($ipk <= 4.00) {
            $predikat = "Cumloude";
        }
        if ($ipk <= 3.50) {
            $predikat = "Sangat Memuaskan";
        }
        if ($ipk <= 2.75) {
            $predikat = "Memuaskan";
        }

        } ?>

<?php 
  $nim    = $_GET['id'];
  $sql    = $koneksi->query("SELECT * from tb_mahasiswa WHERE nim = '$nim'");
  $tampil = $sql->fetch_assoc();
 ?>
<form method="POST" enctype="multipart/form-data">
  <div class="box box-primary">
     <div class="box-header with-border">
        <h3 class="box-title">Ubah Data Transkrip Mahasiswa</h3>
     </div>
     <div class="box-body">
      <div class="form-group">
        <label>Nama</label>
        <input class="form-control" required name="nama" value="<?= $tampil['nama']; ?>" readonly>
      </div>  

      <div class="form-group">
        <label>IPK</label>
        <input class="form-control" required name="ipk" value="<?= number_format("$ipk",2) ?>" readonly>
      </div>

      <div class="form-group">
        <label>Predikat</label>
        <input class="form-control" required name="predikat" value="<?= $predikat ?>" readonly>
      </div>

      <div class="form-group">
        <label>No. PIN</label>
        <input class="form-control" required name="pin" value="<?= $tampil['no_pin']; ?>">
      </div> 

      <div class="form-group">
        <label>No. Ijazah</label>
        <input class="form-control" required name="no_ijazah" value="<?= $tampil['no_ijazah']; ?>">
      </div>  

      <div class="form-group">
        <label>Judul Tugas Akhir</label>
        <input class="form-control" required name="judul" value="<?= $tampil['judul_skripsi']; ?>">
      </div> 

      <div class="form-group">
        <label>Tanggal Lulus</label>
        <input type="date" class="form-control" required name="tgl_lulus" value="<?= $tampil['tgl_lulus']; ?>">
      </div> 

        <div class="box-footer">
        <input type="submit" name="ubah" value="Simpan" class="btn btn-flat btn-sm btn-primary">
          <input type=button value="Kembali" onclick="self.history.back()" class="btn btn-flat btn-sm btn-info">
       </div>
    </div>
</form>

<?php 
  if (isset($_POST['ubah'])) {  
        $no_ijazah    = $_POST['no_ijazah'];
        $judul    = $_POST['judul'];
        $pin    = $_POST['pin'];
        $tgl_lulus    = $_POST['tgl_lulus'];
        $ipk    = $_POST['ipk'];
        $predikat    = $_POST['predikat'];
        $ubah    = $koneksi->query("UPDATE tb_mahasiswa SET  no_ijazah = '$no_ijazah', judul_skripsi = '$judul', no_pin = '$pin', tgl_lulus = '$tgl_lulus', ipk = '$ipk', predikat = '$predikat' WHERE nim = '$nim'");

    if ($ubah) {
      echo "
          <script>
              setTimeout(function() {
                  swal({
                      title: 'Selamat!',
                      text: 'Data Berhasil Diubah!',
                      type: 'success'
                  }, function() {
                      window.location = '?page=ijazah';
                  });
              }, 300);
          </script>
      ";
    } else{
            mysqli_error($koneksi); 
        }
  }
?>
                            