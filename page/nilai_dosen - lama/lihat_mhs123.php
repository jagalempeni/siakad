<?php
$kode_mk = $_GET['kode_mk'];
$nim     = $_GET['nim'];
$dosen   = $_GET['dosen'];
?>
 
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Masukan Nilai Mahasiswa</h3>
  </div>

  <div class="box-body">
    <table class="table table-bordered table-condensed" id="dataTables-example">
      <thead>
        <tr>
          <th>NO</th>
          <th>NIM</th>
          <th>Nama</th>
          <th>Semester</th>
          <th>Prodi</th>
          <th>Matkul</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
      <?php
      $dosen = $_SESSION['username'];
      $no    = 1;
      $sql   = $koneksi->query("SELECT * FROM tb_mahasiswa, tb_jurusan, tb_krs, tb_matkul WHERE 
        tb_mahasiswa.kode_jurusan = tb_jurusan.kode_jurusan AND
        tb_mahasiswa.nim          = tb_krs.nim AND
        tb_matkul.kode_mk         = tb_krs.kode_mk AND
        tb_krs.kode_mk            =  '$kode_mk' AND
        tb_krs.status_nilai       = 1 ");
    	while ( $data = $sql->fetch_assoc() ) { ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $data['nim']; ?></td>
            <td><?= $data['nama']; ?></td>
	          <td><?= $data['smester']; ?></td>
            <td><?= $data['nama_jurusan']; ?></td>
            <td><?= $data['nama_mk']; ?></td>
            <td>
            	<a href="?page=nilai_d&aksi=nilai&id=<?= $data['nim']; ?>&smester=<?= $data['smester'];?>&krs=<?= $data['kode'] ?>&kode_mk=<?= $kode_mk;  ?>&dosen=<?= $dosen; ?>" class=" btn btn-flat btn-sm btn-success" ><i class="fa fa-edit"></i> Masukan Nilai</a>
            </td>
        </tr>
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

    <table  class="table table-bordered table-condensed" id="dataTables-example">
      <thead>
        <tr>
          <th rowspan="2" class="text-center">No</th>
          <th rowspan="2" class="text-center">Nim</th>
          <th rowspan="2" class="text-center">Nama</th>
          <th colspan="4" class="text-center">Nilai</th>
          <th colspan="2" class="text-center">Nilai Akhir</th>
          <th rowspan="2" class="text-center">Total <br> Mutu X SKS</th>
          <th rowspan="2" class="text-center">Aksi</th>
        </tr>
        <tr>
          <th class="text-center">Tugas</th>
          <th class="text-center">UTS</th>
          <th class="text-center">UAS</th>
          <th class="text-center">Jumlah</th>
          <th class="text-center">Grade</th>
          <th class="text-center">Mutu</th>
        </tr>
      </thead>
      <tbody>
      <?php
      $no = 1;
      $nilai = $koneksi->query("SELECT * FROM tb_mahasiswa, tb_nilai, tb_matkul WHERE 
        tb_nilai.kode_mk  = tb_matkul.kode_mk AND
        tb_mahasiswa.nim  = tb_nilai.nim AND
        tb_matkul.kode_mk = '$kode_mk' ORDER BY 
        tb_matkul.kode_mk ASC ");
      while ( $data = $nilai->fetch_assoc() ) {
        $sks        = $data['sks'];
        $mutu_hasil = $sks * $mutu;
        $tugas      = $data['tugas'];
        $uts        = $data['uts'];
        $uas        = $data['uas'];
        $jumlah     = ( $tugas * 0.3 ) + ( $uts * 0.3 ) + ( $uas * 0.4 );
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
        }elseif ($grade== "B") {
          $mutu = 3;
        }elseif ($grade== "C") {
          $mutu = 2;
        }elseif ($grade== "D") {
          $mutu = 1;
        }else{
          $mutu = 0;
        }
        $total = $sks * $mutu;
      ?>
        <tr>
          <td><?= $no++; ?></td>
          <td><?= $data['nim'] ?></td>
          <td><?= $data['nama'] ?></td>
          <td align="center"><?= $data['tugas'] ?></td>
          <td align="center"><?= $data['uts'] ?></td>
          <td align="center"><?= $data['uas'] ?></td>
          <td align="center"><?= $jumlah ?></td>
          <td align="center"><?= $grade ?></td>
          <td align="center"><?= $mutu ?></td>
          <td align="center"><?= $total ?>
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