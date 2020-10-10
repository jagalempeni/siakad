<?php
$kelas = $_GET['kelas'];
$kode_mk = $_GET['kode_mk'];
$nim     = $_GET['nim'];
$dosen   = $_GET['dosen'];
?>
 
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Data Pengisian Nilai</h3>
  </div>

  <div class="box-body">
    <table class="table table-bordered table-condensed" id="dataTables-example">
      <thead>
        <tr>
          <th>No</th>
          <th>Jenis Penilaian</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>

  <tr>
            <td>1</td>
            <td>Presensi</td>
            <td>
              <a href="?page=nilai_d&aksi=input_presensi.php" class=" btn btn-flat btn-sm btn-success"><i class="fa fa-edit"></i> Masukan Nilai</a>
            </td>
        </tr>
        <tr>
            <td>2</td>
            <td>Tugas</td>
            <td>
              <a href="#" class=" btn btn-flat btn-sm btn-success" ><i class="fa fa-edit"></i> Masukan Nilai</a>
            </td>
        </tr><tr>
            <td>3</td>
            <td>Quiz</td>
            <td>
              <a href="#" class=" btn btn-flat btn-sm btn-success" ><i class="fa fa-edit"></i> Masukan Nilai</a>
            </td>
        </tr>
        <tr>
            <td>4</td>
            <td>UTS</td>
            <td>
              <a href="#" class=" btn btn-flat btn-sm btn-success" ><i class="fa fa-edit"></i> Masukan Nilai</a>
            </td>
        </tr>
        <tr>
            <td>5</td>
            <td>UAS</td>
            <td>
              <a href="#" class=" btn btn-flat btn-sm btn-success" ><i class="fa fa-edit"></i> Masukan Nilai</a>
            </td>
        </tr>
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
        

            
        <?php } ?>
      </tbody>
  </table>
  <?php
  $sql_rekap = $koneksi->query("SELECT * FROM  tb_matkul  WHERE kode_mk = '$kode_mk'");
  $data_rekap = $sql_rekap->fetch_assoc();
  $sql_dosen  =  $koneksi->query("SELECT * FROM  tb_dosen  WHERE kode_dosen = '$dosen'");
  $data_dosen = $sql_dosen->fetch_assoc();
  ?>

    </div>
</div>

<div class="box box-primary">
<div class="box-header with-border">
    <h3 class="box-title">Rekap Nilai</h3>
  </div>

  <div class="box-body">
  <form method="POST" enctype="multipart/form-data">
      <div class="form-group">
        <label>Mata Kuliah :</label>
        <input class="form-control" name="nim" value="<?= $data_rekap['nama_mk']; ?> " readonly>
      </div>      
      <div class="form-group">
        <label>SKS :</label>
        <input class="form-control" name="nama" value="<?= $data_rekap['sks']; ?>" readonly>
      </div>
    <div class="form-group">
      <label>Nama Dosen</label>
      <input class="form-control" name="nama" value="<?= $data_dosen['nama_dosen']; ?>" readonly>
   </div>

    
      <?php
      $no = 1;
      $kelas = $_GET['kelas'];
      $nilai = $koneksi->query("SELECT * FROM tb_mahasiswa, tb_nilai, tb_matkul WHERE 
        tb_nilai.kode_mk  = tb_matkul.kode_mk AND
        tb_mahasiswa.nim  = tb_nilai.nim AND
        tb_nilai.kelas  = '$kelas' AND
        tb_matkul.kode_mk = '$kode_mk' ORDER BY 
        tb_matkul.kode_mk ASC 
    ");
    
      while ( $data = $nilai->fetch_assoc() ) {
        $sks        = $data['sks'];
        $mutu_hasil = $sks * $mutu;
    $presensi   = $data['presensi'];
        $tugas      = $data['tugas'];
        $quiz      = $data['quiz'];
        $uts        = $data['uts'];
        $uas        = $data['uas'];
       $jumlah = ($presensi * $data['prepre']) + ($tugas * $data['pretug']) + ($quiz * $data['prequi']) + ($uts * $data['preuts']) + ($uas * $data['preuas']);
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
        
      ?>



      <table  class="table table-bordered table-condensed" id="dataTables-example">
      <thead>
        <tr>
          <th rowspan="2" class="text-center">No</th>
          <th rowspan="2" class="text-center">Nim</th>
          <th rowspan="2" class="text-center">Nama</th>
          <th colspan="5" class="text-center">Nilai</th>
          <th rowspan="2" class="text-center">TP</th>
          <th colspan="2" class="text-center">Nilai Akhir</th>
          <th rowspan="2" class="text-center">Aksi</th>
        </tr>
        <tr>
      <th class="text-center">Presensi (<?php echo $data['prepre'];?>)</th>
          <th class="text-center">Tugas (<?php echo $data['pretug'];?>)</th>
          <th class="text-center">Quiz (<?php echo $data['prequi'];?>)</th>
          <th class="text-center">UTS (<?php echo $data['preuts'];?>)</th>
          <th class="text-center">UAS (<?php echo $data['preuas'];?>)</th>
          <th class="text-center">HM</th>
          <th class="text-center">AM</th>
          
          
        </tr>
      </thead>
      <tbody>





        <tr>
          <td><?= $no++; ?></td>
          <td><?= $data['nim'] ?></td>
          <td><?= $data['nama'] ?></td>
      <td align="center"><?= $data['presensi'] ?></td>
          <td align="center"><?= $data['tugas'] ?></td>
          <td align="center"><?= $data['quiz'] ?></td>
          <td align="center"><?= $data['uts'] ?></td>
          <td align="center"><?= $data['uas'] ?></td>        
          <td align="center"><?= $jumlah ?></td>
          <td align="center"><?= $grade ?></td>
          <td align="center"><?= number_format("$mutu",2) ?></td>
          
          <td>
            <a href="?page=nilai_d&aksi=edit&id=<?= $data ['id'];?>&nim=<?= $data['nim']; ?>&smester=<?= $data['smester'];?>&krs=<?= $data['kode'] ?>&kode_mk=<?= $kode_mk;  ?>&dosen=<?= $dosen; ?>" class="btn btn-flat btn-sm btn-info"><i class="fa fa-edit"></i> Edit</a>
          </td>
        </tr>
      <?php } ?>
      </tbody>
    </table>
  </div>
  <div class="box-footer">
    <a href="./cetak/rekap_nilai_dosen.php?dosen=<?= $dosen; ?>&matkul=<?= $kode_mk; ?>&nim=<?= $nim;?>" target="blank" class="btn btn-flat btn-sm btn-default" style="margin-top: 10px;" target="blank" ><i class="fa fa-print"></i> Cetak Rekap Nilai</a>
    <input type=button value=Kembali onclick=self.history.back() class="btn btn-flat btn-sm btn-info" style="margin-top: 10px;">
  </div>
</div>