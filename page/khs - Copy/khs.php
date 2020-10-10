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
          <select class="form-control" required name="jurusan" readonly>
              <?php
                  $sql1 = $koneksi->query("SELECT * FROM tb_jurusan");
                  while($j = $sql1->fetch_assoc()){
                      $pilih = ($j['kode_jurusan'] == $data['kode_jurusan']?"selected":"");
                      echo "
                          <option value='$j[kode_jurusan]' $pilih>$j[nama_jurusan]</option>
                      ";
                  }
               ?>
          </select>
      </div>

      <div class="form-group">
          <label>Jenjang</label>
           <input class="form-control" required name="smester" value="<?= 'Strata Satu (S1)' ?>" readonly>
      </div>
    </form>

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
      $nilai = $koneksi->query("SELECT * FROM tb_nilai, tb_matkul, tb_mahasiswa WHERE 
        tb_nilai.kode_mk = tb_matkul.kode_mk AND 
        tb_mahasiswa.khs    = 1 AND
        tb_nilai.nim = '$nim' ORDER BY tb_matkul.kode_mk ASC");
      while ($data = $nilai->fetch_assoc()) {
        $sks        = $data['sks'];
        $mutu_hasil = $sks * $mutu;
        $tugas      = $data['tugas'];
        $uts        = $data['uts'];
        $uas        = $data['uas'];
        $jumlah     = ($tugas * 0.3) + ($uts * 0.3) + ($uas * 0.4);

        if ($jumlah >= 86) {
            $grade = "A";
        }
        if ($jumlah   <= 85) {
            $grade = "B";
        }
        if ($jumlah   <= 70) {
            $grade = "C";
        }
        if ($jumlah   <= 56) {
            $grade = "D";
        }
        if ($jumlah   <= 45) {
            $grade = "E";
        }
        if ($grade == "A") {
            $mutu = 4;
        } elseif ($grade == "B") {
            $mutu = 3;
        } elseif ($grade == "C") {
            $mutu = 2;
        } elseif ($grade == "D") {
            $mutu = 1;
        } else{
            $mutu = 0;
        } 
        $total = $sks * $mutu; ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $data['kode_mk'] ?></td>
            <td><?= $data['nama_mk'] ?></td>
            <td align="right"><?= $data['sks'] ?></td>
            <td><?= $data['smester'] ?></td>
            <td><?= $grade ?></td>
            <td><?= $mutu; ?></td>
            <td><?= $total; ?></td>
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
        <td  style="font-size: px; text-align: right;"><b><?= $jml_mutu ; ?></b></td>
        <td colspan="4"></td>
      </tr>
      <tr>
          <th  style="text-align: right; font-size: 17px; " colspan="3">IPK </th>
          <td  style="text-align: right;"><b><?= round( $ipk, 2 ); ?></b></td>
          <td colspan="4"></td>
      </tr>
    </table>
  </div>

  <div class="box-footer">
    <a href="./cetak/cetak_khs.php?id=<?= $nim; ?>&smester=<?= $smester; ?>" class="btn btn-flat btn-sm btn-default" style="margin-top: 10px;" target="blank" ><i class="fa fa-print"></i> Cetak KHS</a>
    <input type=button value=Kembali onclick=self.history.back() class="btn btn-flat btn-sm btn-info" style="margin-top: 10px;">
  </div>
</div>
