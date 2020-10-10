<?php
$nim  = $_SESSION['username'];
$sql  = $koneksi->query("SELECT * FROM  tb_mahasiswa , tb_jurusan WHERE  
        tb_mahasiswa.kode_jurusan = tb_jurusan.kode_jurusan AND
        tb_mahasiswa.nim = '$nim'");
$data = $sql->fetch_assoc();
?>

<form method="POST" enctype="multipart/form-data">
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Transkrip Nilai</h3>
    </div>

    <div class="box-body">
      <div class="form-group">
          <label>Nim :</label>
          <input class="form-control" required name="nim" value="<?= $data['nim']; ?> " readonly>
      </div>

       <div class="form-group">
          <label>Nama :</label>
          <input class="form-control" required name="nama" value="<?= $data['nama']; ?>" readonly/>
      </div>

      <div class="form-group">
          <label>Prodi :</label>
          <input class="form-control" required name="jurusan" value="<?= $data ['nama_jurusan']?>" readonly>             
      </div>
  </div>
</form>    

<?php 
  if (isset($_POST['simpan'])) {
    $nama    = $_POST['nama'];
    $tempat  = $_POST['tempat'];
    $tgl     = $_POST['tgl'];
    $alamat  = $_POST['alamat'];
    $smester = $_POST['smester'];
    $jk      = $_POST['jk'];
    $email   = $_POST['email'];
    $telpon  = $_POST['telpon'];


      $koneksi->query("UPDATE  tb_mahasiswa SET smester = '$smester' WHERE nim = '$nim'");
        
?>
    <script>
      setTimeout(function() {
      swal({
         title: "Selamat!",
         text: "Ubah Semester Berhasil !",
         type: "success"
      }, function() {
         window.location = "?page=khs";
      });
      }, 300);
    </script>
<?php  } ?>

    <table class="table table-bordered table-listed table-hover" id="dataTables-example">
      <thead>
          <tr>
             <th>No</th>
              <th>Kode Matkul</th>
              <th>Mata Kuliah</th>
              <th>SKS</th>
              <th>Semester</th>
              <th>Nilai</th>
              <th>Bobot</th>
              <th>Mutu</th>
          </tr>
      </thead>
      <tbody>
      <?php
      $no    = 1;
      $nilai = $koneksi->query("SELECT * FROM tb_nilai, tb_matkul, tb_mahasiswa WHERE 
        tb_nilai.kode_mk = tb_matkul.kode_mk AND 
        tb_nilai.nim = tb_mahasiswa.nim AND

        tb_nilai.nim = '$nim' ORDER BY tb_matkul.smester ASC");
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
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $data['kode_mk'] ?></td>
            <td><?= $data['nama_mk'] ?></td>
            <td><?= $data['sks'] ?></td>
            <td><?= $smestern ?></td>
            <td><?= $grade ?></td>
            <td><?= number_format("$mutu",2); ?></td>
            <td><?= number_format("$total",2); ?></td>
        </tr>
        <?php
          $jml_krs  = $jml_krs + $data['sks'];
          $jml_mutu = $jml_mutu + $total;
          $ipk      = $jml_mutu / $jml_krs;
        } ?>
      </tbody>
      <tr>
        <th  style="text-align: right; font-size: 17px; " colspan="3">Total SKS yang ditempuh</th>
        <td  style="font-size: px; text-align: right;"><b><?= $jml_krs ; ?></b></td>
        <td colspan="4"></td>
      </tr>
      <tr>
        <th  style="text-align: right; font-size: 17px; " colspan="3">Total Mutu</th>
        <td  style="font-size: px; text-align: right;"><b><?= number_format("$jml_mutu",2); ?></b></td>
        <td colspan="4"></td>
      </tr>
      <tr>
          <th  style="text-align: right; font-size: 17px; " colspan="3">Indeks Prestasi Kumulatif </th>
          <td  style="text-align: right;"><b><?= number_format("$ipk",2); ?></b></td>
          <td colspan="4"></td>
      </tr>
    </table>
  </div>

  <div class="box-footer">
    <a href="./cetak/cetak_tr.php?id=<?= $nim; ?>" class="btn btn-flat btn-sm btn-default" style="margin-top: 10px;" target="blank" ><i class="fa fa-print"></i> Cetak Transkrip</a>
    <input type=button value=Kembali onclick=self.history.back() class="btn btn-flat btn-sm btn-info" style="margin-top: 10px;">
  </div>
</div>
