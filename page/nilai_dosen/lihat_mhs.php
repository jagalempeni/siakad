<?php
$kelas = $_GET['kelas'];
$kode_mk = $_GET['kode_mk'];
$nim     = $_GET['nim'];
$dosen   = $_GET['dosen'];
?>

<?php
$sql3 = $koneksi->query("SELECT * from tb_sett");
$data3 = $sql3->fetch_assoc();
?>
 
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Masukan Nilai Mahasiswa</h3><br>Tahun Akademik <b><?=$data3 ['tahun_akad'];?></b>
  </div>

  <div class="box-body">
    <table class="table table-bordered table-condensed" id="dataTables-example">
      <thead>
        <tr>
          <th>NO</th>
          <th>NIM</th>
          <th>Nama</th>
          <th>Semester</th>
          <th>Kelas</th>
          <th>Prodi</th>
          <th>Matkul</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
      <?php
      $dosen = $_SESSION['username'];
      $kelas = $_GET['kelas'];
      $tahun_akad = $data3 ['tahun_akad'];
      $no    = 1;
      $sql   = $koneksi->query("SELECT * FROM tb_mahasiswa, tb_jurusan, tb_krs, tb_matkul WHERE 
        tb_mahasiswa.kode_jurusan = tb_jurusan.kode_jurusan AND
        tb_mahasiswa.nim          = tb_krs.nim AND
        tb_krs.tahun_akad = '$tahun_akad' AND

        tb_matkul.kode_mk         = tb_krs.kode_mk AND
        tb_krs.kode_mk            =  '$kode_mk' AND 
        tb_krs.kelas            =  '$kelas' AND 
        tb_krs.status_nilai       = 1 ");
      while ( $data = $sql->fetch_assoc() ) { ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $data['nim']; ?></td>
            <td><?= $data['nama']; ?></td>
            <td><?= $data['smester']; ?></td>
            <td><?= $data['kelas']; ?></td>
            <td><?= $data['nama_jurusan']; ?></td>
            <td><?= $data['nama_mk']; ?></td>
            <td>
              <a href="?page=nilai_d&aksi=nilai&id=<?= $data['nim']; ?>&smester=<?= $data['smester'];?>&krs=<?= $data['kode'] ?>&kode_mk=<?= $kode_mk;  ?>&dosen=<?= $dosen; ?>" class=" btn btn-flat btn-sm btn-success" ><i class="fa fa-edit"></i> Masukan Nilai</a>

             <!-- <a href="?page=nilai_d&aksi=nilai_akhir&id=<?= $data['nim']; ?>&smester=<?= $data['smester'];?>&krs=<?= $data['kode'] ?>&kode_mk=<?= $kode_mk;  ?>&dosen=<?= $dosen; ?>" class=" btn btn-flat btn-sm btn-warning" ><i class="fa fa-edit"></i> Masukan Nilai Akhir</a> -->
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
    <h3 class="box-title">Data Mahasiswa Yang Sudah di Input</h3>
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
          <th colspan="3" class="text-center">Nilai</th>
          <th rowspan="2" class="text-center">Aksi</th>
        </tr>
        <tr>



    <?php
      $kelas123 = $_GET['kelas'];
      $prenilai = $koneksi->query("SELECT * FROM tb_mahasiswa, tb_nilai, tb_matkul WHERE 
        tb_nilai.kode_mk  = tb_matkul.kode_mk AND
        tb_mahasiswa.nim  = tb_nilai.nim AND
        tb_nilai.kelas  = '$kelas123' AND
        tb_matkul.kode_mk = '$kode_mk' ORDER BY 
        tb_matkul.kode_mk ASC 
    ");
    
        $datapre = $prenilai->fetch_assoc();
        $prepre        = $datapre['prepre'];
        $pretug        = $datapre['pretug'];
        $prequi        = $datapre['prequi'];
        $preuts        = $datapre['preuts'];
        $preuas        = $datapre['preuas'];      
         
      ?>

          <th class="text-center">Angka</th>
          <th class="text-center">Huruf</th>
          <th class="text-center">Mutu</th>
                
        </tr>

      </thead>
      
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
        $quiz       = $data['quiz'];
        $uts        = $data['uts'];
        $uas        = $data['uas'];
        $prepre     = $data['prepre'];
        $jumlah     = ($presensi/100*10) + ($tugas/100*10) + ($uts/100*30) + ($uas/100*50)  ;
if ($jumlah >= 86) {
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
        
      ?>
      <tbody>



      





        <tr>
          <td><?= $no++; ?></td>
          <td><?= $data['nim'] ?></td>
          <td><?= $data['nama'] ?></td>
          <td align="center"><?= $jumlah ?></td>
          <td align="center"><?= $grade ?></td>
          <td align="center"><?= number_format("$mutu",2) ?></td>
          
          <td align="center">
            <a href="?page=nilai_d&aksi=edit&id=<?= $data ['id'];?>&nim=<?= $data['nim']; ?>&smester=<?= $data['smester'];?>&krs=<?= $data['kode'] ?>&kode_mk=<?= $kode_mk;  ?>&dosen=<?= $dosen; ?>" class="btn btn-flat btn-sm btn-info"><i class="fa fa-edit"></i> Edit</a>
          </td>
          
          <td align="center">
            <a onclick="return confirm('Yakin Akan Mengahapus Data Ini...???')" href="?page=nilai_d&aksi=edit&id=<?= $data ['id'];?>&nim=<?= $data['nim']; ?>&smester=<?= $data['smester'];?>&krs=<?= $data['kode'] ?>&kode_mk=<?= $kode_mk;  ?>&dosen=<?= $dosen; ?>" class=" btn btn-flat btn-xs btn-danger" ><i class="fa fa-trash-o"></i> Hapus</a>
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