<?php
$nim  = $_SESSION['username'];
$sql  = $koneksi->query("SELECT * FROM  tb_mahasiswa , tb_jurusan WHERE  
        tb_mahasiswa.kode_jurusan = tb_jurusan.kode_jurusan AND
        tb_mahasiswa.nim = '$nim'");
$data = $sql->fetch_assoc();
?>


<?php
      $no    = 1;
      $nilai10 = $koneksi->query("SELECT * FROM tb_nilai, tb_matkul, tb_mahasiswa WHERE 
        tb_nilai.kode_mk = tb_matkul.kode_mk AND 
        tb_nilai.nim = tb_mahasiswa.nim AND 

        tb_mahasiswa.khs    = 1 AND

        tb_nilai.nim = '$nim' ORDER BY tb_matkul.kode_mk ASC");
      while ($data10 = $nilai10->fetch_assoc()) {
        $sks10        = $data10['sks'];
        $mutu_hasil10 = $sks10 * $mutu10;
        $presensi10      = $data10['presensi'];
        $tugas10     = $data10['tugas'];
        $quiz10      = $data10['quiz'];
        $uts10        = $data10['uts'];
        $uas10        = $data10['uas'];
        $jumlah10 = ($presensi10/100*10) + ($tugas10/100*10) + ($uts10/100*30) + ($uas10/100*50)  ;

        {
            $grade10 = "A";
        }
        if ($jumlah10   <= 85) {
            $grade10 = "A-";
        }
        if ($jumlah10   <= 80) {
            $grade10 = "B+";
        }
        if ($jumlah10   <= 75) {
            $grade10 = "B";
        }
        if ($jumlah10   <= 70) {
            $grade10 = "B-";
        }
        if ($jumlah10   <= 65) {
            $grade10 = "C+";
        }
        if ($jumlah10   <= 60) {
            $grade10 = "C";
        }
        if ($jumlah10   <= 55) {
            $grade10 = "C-";
        }
        if ($jumlah10   <= 50) {
            $grade10 = "D";
        }
        if ($jumlah10   <= 45) {
            $grade10 = "E";
        }

        if ($grade10 == "A") {
            $mutu10 = 4.00;
        } elseif ($grade10 == "A-") {
            $mutu10 = 3.70;
        } elseif ($grade10 == "B+") {
            $mutu10 = 3.30;
        } elseif ($grade10 == "B") {
            $mutu10 = 3.00;
        } elseif ($grade10 == "B-") {
            $mutu10 = 2.70;
        } elseif ($grade10 == "C+") {
            $mutu10 = 2.30;
        } elseif ($grade10 == "C") {
            $mutu10 = 2.00;
        } elseif ($grade10 == "C-") {
            $mutu10 = 1.70;
        } elseif ($grade10 == "D") {
            $mutu10 = 1.00;
        } else{
            $mutu10 = 0.00;
        } 
        $total10 = $sks10 * $mutu10; ?>
        <?php
          $jml_krs10  = $jml_krs10 + $data10['sks'];
          $jml_mutu10 = $jml_mutu10 + $total10;
          $ipk10      = $jml_mutu10 / $jml_krs10;
        } ?>

<form method="POST" enctype="multipart/form-data">
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Kartu Hasil Studi</h3>
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
      <div class="form-group">
           <label>Semester :</label>
           <select class="form-control" required name="smester">

             <option><?= $data['smester']; ?></option>
             <option value="1" <?php if( $tampil['smester'] == '1'){echo "selected"; } ?>>1</option>
             <option value="2" <?php if( $tampil['smester'] == '2'){echo "selected"; } ?>>2</option>
             <option value="3" <?php if( $tampil['smester'] == '3'){echo "selected"; } ?>>3</option>
             <option value="4" <?php if( $tampil['smester'] == '4'){echo "selected"; } ?>>4</option>
             <option value="5" <?php if( $tampil['smester'] == '5'){echo "selected"; } ?>>5</option>
             <option value="6" <?php if( $tampil['smester'] == '6'){echo "selected"; } ?>>6</option>
             <option value="7" <?php if( $tampil['smester'] == '7'){echo "selected"; } ?>>7</option>
             <option value="8" <?php if( $tampil['smester'] == '8'){echo "selected"; } ?>>8</option>
           </select>
       </div>





<div class="box-footer">
      <input type="submit" name="simpan" value="Lihat KHS" class="btn btn-flat btn-primary">
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
         title: "Lihat KHS",
         type: "success"
      }, function() {
         window.location = "?page=khs";
      });
      }, 300);
    </script>
<?php  } ?>

<div class="box-body">

    <table class="table table-bordered table-stripped" id="dataTables-example">
      <thead>
          <tr>
             <th style="text-align:center;" width="20">No</th>
              <th style="text-align:center;">Kode Matkul</th>
              <th style="text-align:center;">Mata Kuliah</th>
              <th style="text-align:center;">SKS</th>
              <th style="text-align:center;">Semester</th>
              <th style="text-align:center;" width="20">Nilai</th>
              <th style="text-align:center;" width="30">Bobot</th>
              <th style="text-align:center;" width="30">Mutu</th>
          </tr>
      </thead>
      <tbody>
      <?php
      $no    = 1;
      $smester = $data['smester'];
      $nilai = $koneksi->query("SELECT * FROM tb_nilai, tb_matkul, tb_mahasiswa WHERE 
        tb_nilai.kode_mk = tb_matkul.kode_mk AND 
        tb_nilai.nim = tb_mahasiswa.nim AND 

        tb_mahasiswa.khs    = 1 AND

        tb_nilai.smestern        = '$smester' AND

        tb_nilai.nim = '$nim' ORDER BY tb_matkul.kode_mk ASC");
      while ($data = $nilai->fetch_assoc()) {
        $sks        = $data['sks'];
        $mutu_hasil = $sks * $mutu;
        $presensi      = $data['presensi'];
        $tugas      = $data['tugas'];
        $quiz      = $data['quiz'];
        $uts        = $data['uts'];
        $uas        = $data['uas'];
        $jumlah = ($presensi/100*10) + ($tugas/100*10) + ($uts/100*30) + ($uas/100*50)  ;

        {
            $grade = "A";
        }
        if ($jumlah   <= 85) {
            $grade = "A-";
        }
        if ($jumlah   <= 80) {
            $grade = "B+";
        }
        if ($jumlah   <= 75) {
            $grade = "B";
        }
        if ($jumlah   <= 70) {
            $grade = "B-";
        }
        if ($jumlah   <= 65) {
            $grade = "C+";
        }
        if ($jumlah   <= 60) {
            $grade = "C";
        }
        if ($jumlah   <= 55) {
            $grade = "C-";
        }
        if ($jumlah   <= 50) {
            $grade = "D";
        }
        if ($jumlah   <= 45) {
            $grade = "E";
        }

        if ($grade == "A") {
            $mutu = 4.00;
        } elseif ($grade == "A-") {
            $mutu = 3.70;
        } elseif ($grade == "B+") {
            $mutu = 3.30;
        } elseif ($grade == "B") {
            $mutu = 3.00;
        } elseif ($grade == "B-") {
            $mutu = 2.70;
        } elseif ($grade == "C+") {
            $mutu = 2.30;
        } elseif ($grade == "C") {
            $mutu = 2.00;
        } elseif ($grade == "C-") {
            $mutu = 1.70;
        } elseif ($grade == "D") {
            $mutu = 1.00;
        } else{
            $mutu = 0.00;
        }
        $total = $sks * $mutu; ?>
        <tr>
            <td><?= $no++; ?></td>
            <td align="center"><?= $data['kode_matkul'] ?></td>
            <td align="center"><?= $data['nama_mk'] ?></td>
            <td align="center"><?= $data['sks'] ?></td>
            <td align="center"><?= $data['smester'] ?></td>
            <td align="center"><?= $grade ?></td>
            <td align="center"><?= number_format("$mutu",2); ?></td>
            <td align="center"><?= number_format("$total",2); ?></td>
        </tr>
        <?php
          $jml_krs  = $jml_krs + $data['sks'];
          $jml_mutu = $jml_mutu + $total;
          $ipk      = $jml_mutu / $jml_krs;
        } ?>
      </tbody>
      <tr>
        <th  style="text-align: right; font-size: 17px; " colspan="3">Total SKS</th>
        <td  style="font-size: px; text-align: right;"><b><?= $jml_krs ; ?></b></td>
        <td colspan="4"></td>
      </tr>
      <tr>
        <th  style="text-align: right; font-size: 17px; " colspan="3">Total Mutu</th>
        <td  style="font-size: px; text-align: right;"><b><?= number_format("$jml_mutu",2); ?></b></td>
        <td colspan="4"></td>
      </tr>
      <tr>
          <th  style="text-align: right; font-size: 17px; " colspan="3">IPS </th>
          <td  style="text-align: right;"><b><?= number_format("$ipk",2); ?></b></td>
          <td colspan="4"></td>
      </tr>
      <tr>
          <th  style="text-align: right; font-size: 17px; " colspan="3">IPK </th>
          <td  style="text-align: right;"><b><?= number_format("$ipk10",2); ?></b></td>
          <td colspan="4"></td>
      </tr>
    </table>
  </div>
</div>

  <div class="box-footer">
    <a href="./cetak/cetak_khs.php?id=<?= $nim; ?>&smester=<?= $smester; ?>" class="btn btn-flat btn-sm btn-default" style="margin-top: 10px;" target="blank" ><i class="fa fa-print"></i> Cetak KHS</a>
    <input type=button value=Kembali onclick=self.history.back() class="btn btn-flat btn-sm btn-info" style="margin-top: 10px;">
  </div>
</div>



<!--


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
      <h3 class="box-title">Kartu Hasil Studi</h3>
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
      <div class="form-group">
           <label>Semester :</label>
           <select class="form-control" required name="smester">

             <option><?= $data['smester']; ?></option>
             <option value="1" <?php if( $tampil['smester'] == '1'){echo "selected"; } ?>>1</option>
             <option value="2" <?php if( $tampil['smester'] == '2'){echo "selected"; } ?>>2</option>
             <option value="3" <?php if( $tampil['smester'] == '3'){echo "selected"; } ?>>3</option>
             <option value="4" <?php if( $tampil['smester'] == '4'){echo "selected"; } ?>>4</option>
             <option value="5" <?php if( $tampil['smester'] == '5'){echo "selected"; } ?>>5</option>
             <option value="6" <?php if( $tampil['smester'] == '6'){echo "selected"; } ?>>6</option>
             <option value="7" <?php if( $tampil['smester'] == '7'){echo "selected"; } ?>>7</option>
             <option value="8" <?php if( $tampil['smester'] == '8'){echo "selected"; } ?>>8</option>
           </select>
       </div>





<div class="box-footer">
      <input type="submit" name="simpan" value="Lihat KHS" class="btn btn-flat btn-primary">
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
         title: "Lihat KHS",
         type: "success"
      }, function() {
         window.location = "?page=khs";
      });
      }, 300);
    </script>
<?php  } ?>

    <table class="table table-bordered condensed" id="dataTables-example">
      <thead>
          <tr>
             <th>No</th>
              <th>Kode Matkul</th>
              <th>Mata Kuliah</th>
              <th>SKS</th>
              <th>Smester</th>
              <th>Nilai</th>
              <th>Bobot</th>
              <th>Mutu</th>
          </tr>
      </thead>
      <tbody>
      <?php
      $no    = 1;
      $smester = $data['smester'];
      $nilai = $koneksi->query("SELECT * FROM tb_nilai, tb_matkul, tb_mahasiswa WHERE 
        tb_nilai.kode_mk = tb_matkul.kode_mk AND 
        tb_nilai.nim = tb_mahasiswa.nim AND 

        tb_mahasiswa.khs    = 1 AND

        tb_nilai.smestern        = '$smester' AND

        tb_nilai.nim = '$nim' ORDER BY tb_matkul.kode_mk ASC");
      while ($data = $nilai->fetch_assoc()) {
        $sks        = $data['sks'];
        $mutu_hasil = $sks * $mutu;
        $presensi      = $data['presensi'];
        $tugas      = $data['tugas'];
        $quiz      = $data['quiz'];
        $uts        = $data['uts'];
        $uas        = $data['uas'];
         $jumlah = $data['nilaiakhir'];

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
            <td align="right"><?= $data['sks'] ?></td>
            <td><?= $data['smester'] ?></td>
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
        <th  style="text-align: right; font-size: 17px; " colspan="3">Total SKS</th>
        <td  style="font-size: px; text-align: right;"><b><?= $jml_krs ; ?></b></td>
        <td colspan="4"></td>
      </tr>
      <tr>
        <th  style="text-align: right; font-size: 17px; " colspan="3">Total Mutu</th>
        <td  style="font-size: px; text-align: right;"><b><?= number_format("$jml_mutu",2); ?></b></td>
        <td colspan="4"></td>
      </tr>
      <tr>
          <th  style="text-align: right; font-size: 17px; " colspan="3">IPK </th>
          <td  style="text-align: right;"><b><?= number_format("$ipk",2); ?></b></td>
          <td colspan="4"></td>
      </tr>
    </table>
  </div>

  <div class="box-footer">
    <a href="./cetak/cetak_khs.php?id=<?= $nim; ?>&smester=<?= $smester; ?>" class="btn btn-flat btn-sm btn-default" style="margin-top: 10px;" target="blank" ><i class="fa fa-print"></i> Cetak KHS</a>
    <input type=button value=Kembali onclick=self.history.back() class="btn btn-flat btn-sm btn-info" style="margin-top: 10px;">
  </div>
</div>
-->
