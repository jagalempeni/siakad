<?php 
$sql = $koneksi->query("SELECT * FROM tb_mahasiswa");
while( $data = $sql->fetch_assoc() ){
       $jml_mhs = $sql->num_rows; 
}

$sql1 = $koneksi->query("SELECT * FROM tb_mahasiswa where status = 1");
while( $data1 = $sql1->fetch_assoc() ){
       $jml_mhs1 = $sql1->num_rows; 
}

$sql2 = $koneksi->query("SELECT * FROM tb_dosen");
while ( $data2 = $sql2->fetch_assoc() ){
  $jml_dosen = $sql2->num_rows; 
}

$sql3 = $koneksi->query("SELECT * FROM tb_matkul");
while( $data3 = $sql3->fetch_assoc() ){
  $jml_matkul = $sql3->num_rows; 
}

$nim   = $_SESSION['username']; 
$nilai = $koneksi->query("SELECT * FROM tb_nilai, tb_matkul
        WHERE tb_nilai.kode_mk = tb_matkul.kode_mk AND 
        tb_nilai.nim = '$nim' ORDER BY tb_matkul.kode_mk ASC ");
while ($data = $nilai->fetch_assoc()) {
  $sks   = $data['sks'];   
  $grade = $data['grade'];                          
  
  if ( $grade == "A" ) {
        $mutu = 4;
  }elseif ( $grade == "B" ) {
       $mutu = 3;
  }elseif ( $grade == "C" ) {
       $mutu = 2;
  }elseif ( $grade == "D" ) {
       $mutu = 1;
  }else{
      $mutu = 0;
  }            
  
  $mutu_hasil = $sks * $mutu; 
  $jml_krs    = $jml_krs + $data['sks'];
  $jml_mutu   = $jml_mutu + $mutu_hasil;
  $ipk        = $jml_mutu / $jml_krs;
}
?>
<div class="content container-fluid">
  <div class="box box-primary">
    <div class="row">
      <div class="col-sm-12">
        <h1 style="font-family: times new roman; font-size: 40px; text-align: center;">Selamat datang <?= $data_u['nama']; ?></h1>
      </div>
    </div>
  <div class="row">
  <?php if ($_SESSION['admin'] ) {?>       
    <div class="col-sm-5 col-sm-offset-1">
      <!-- small box -->
      <div class="small-box bg-yellow">
          <div class="inner">
            <h3><?= $jml_mhs; ?></h3>
            <p>Jumlah Semua Mahasiswa</p>
          </div>
          <div class="icon">
            <i class="glyphicon glyphicon-user" style="font-size: 80px;"></i>
          </div>
          <a href="index.php?page=mahasiswa" class="small-box-footer">
            Info Lagi <i class="fa fa-arrow-circle-right"></i>
          </a>
      </div>
    </div> 

    <div class="col-sm-5">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3><?= $jml_mhs1; ?></h3>
          <p>Jumlah Mahasiswa Aktif</p>
        </div>
        <div class="icon">
          <i class="glyphicon glyphicon-user" style="font-size: 80px;"></i>
        </div>
        <a href="index.php?page=mahasiswa" class="small-box-footer">
          Info Lagi <i class="fa fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>     
            
    <div class="col-sm-5 col-sm-offset-1">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3><?= $jml_dosen; ?></h3>
          <p>Jumlah Dosen</p>
        </div>
        <div class="icon">
          <i class="glyphicon glyphicon-user" style="font-size: 80px;"></i>
        </div>
        <a href="index.php?page=dosen" class="small-box-footer">
          Info Lagi <i class="fa fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>

    <div class="col-sm-5">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3><?= $jml_matkul; ?></h3>
          <p>Jumlah Mata Kuliah</p>
        </div>
        <div class="icon">
          <i class="glyphicon glyphicon-list-alt" style="font-size: 80px;"></i>
        </div>
        <a href="index.php?page=matkul" class="small-box-footer">
          More info <i class="fa fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>
  <?php } if ($_SESSION['mahasiswa'] ) { ?> 
    <div class="col-sm-5 col-sm-offset-1">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3><?=  $jml_krs; ?></h3>
          <p>Jumlah SKS Yang Telah Ditempuh</p>
        </div>
        <div class="icon">
          <i class="glyphicon glyphicon-list-alt" style="font-size: 80px;"></i>
        </div>
        <a href="#" class="small-box-footer">
          Info Lagi <i class="fa fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>

    <div class="col-sm-5">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3><?= round($ipk,2); ?></h3>
          <p>Index Prestasi Kumulatif</p>
        </div>
        <div class="icon">
          <i class="glyphicon glyphicon-list-alt" style="font-size: 80px;"></i>
        </div>
        <a href="#" class="small-box-footer">
          Info Lagi <i class="fa fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>
	</div>
  <?php } ?> 
</div>		     