<?php
  error_reporting(0);
$koneksi = new mysqli  ("localhost","polf8968_001","Admin@123empat!","polf8968_001akad");

$settpim    = $koneksi->query("SELECT * FROM tb_sett");
  $tampilpim  = $settpim->fetch_assoc();
  $no_ket     = $tampilpim ['no_ket'];
  $ket        = $tampilpim ['ket'];
  $no_waket   = $tampilpim ['no_waket'];
  $waket      = $tampilpim ['waket'];


$nim = $_GET['id'];
  $sql1 = $koneksi->query("SELECT * from  tb_mahasiswa , tb_jurusan
              WHERE  tb_mahasiswa.kode_jurusan = tb_jurusan.kode_jurusan

              AND tb_mahasiswa.nim='$nim'");
  $tampil=$sql1->fetch_assoc();
  $jurusanmhs = $tampil['kode_jurusan'];


$sql3 = $koneksi->query("select * from tb_nilai, tb_matkul
                            WHERE tb_nilai.kode_mk=tb_matkul.kode_mk
                            AND    tb_nilai.nim='$nim'");

$data3 = $sql3->fetch_assoc();


$smester = $_GET['smester'];
$nim = $_GET['id'];
$no=1;


$nilai10 = $koneksi->query("select * from tb_nilai, tb_matkul
                            WHERE tb_nilai.kode_mk=tb_matkul.kode_mk
                            AND    tb_nilai.nim='$nim'
                            order by tb_matkul.kode_mk asc");
                            while ($data10=$nilai10->fetch_assoc()) {




                              $sks10= $data10['sks'];




                              $mutu_hasil10 = $sks10 * $mutu10;

                              $presensi10 = $data10['presensi'];
                              $tugas10 = $data10['tugas'];
                              $quiz10      = $data10['quiz'];
                              $uts10 = $data10['uts'];
                              $uas10 = $data10['uas'];

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

                                  $total10 = $sks10 * $mutu10;


         $jml_krs10 = $jml_krs10+$data10['sks'];
         $jml_krst10 = $jml_krst10+$datat10['sks'];

        $jml_mutu10 = $jml_mutu10+$total10;

        $ipk10 = $jml_mutu10 / $jml_krs10;

}


    $content = '

    <style type="text/css">

  .tabel{border-collapse: collapse;}
  .tabel th{padding: 5px 3px; background-color: #cccccc;}
  .tabel td{padding: 5px 3px;}
   img{width:125px; height:130px;}
   td{font-size:12;}
   th{font-size:12px;}

   .style2 {
    color: black;
    font-weight: bold;
    margin-left:20px ;

}
  </style>


';
    $content .= '
<page>



<table align="center" border="">
<tr>
  <td><img src="../assets/img/kop-surat.png" width="900" height="180"/></td>
</tr>
<tr>
  <td valign="bottom" style="font-size:14px;" align="center" colspan="3" ><b>KARTU HASIL STUDI MKM BREBES </b></td>
</tr>
</table>
<br><br>

<table border="" align="center">
        <tr>
          <td>Nama</td>
          <td>:</td>
          <td>'.$tampil['nama'].'</td>
          <td width="400"></td>
          <td>Prodi</td>
          <td>:</td>
          <td>'.$tampil['nama_jurusan'].'</td>
        </tr>

        <tr>
          <td>NIM</td>
          <td>:</td>
          <td>'.$tampil['nim'].'</td>
          <td width="400"></td>
          <td>Semester - Th. Akademik</td>
          <td>:</td>
          <td>'.$tampil['smester'].' - '.$data3['tahun_akad'].'</td>
        </tr>

        <tr>
          <td>Kelas</td>
          <td>:</td>
          <td>'.$tampil['kelas'].'</td>
        </tr>  
</table><br>

<table style=text-align:"center"; border="1" class="tabel"  align="center" >

<tr align="center">
           <th rowspan="2" width="40">NO</th>
            <th rowspan="2" width="150">KODE</th>
            <th rowspan="2" width="170">MATAKULIAH</th>
            <th rowspan="2" width="80">KREDIT</th>
            <th colspan="3" width="80">NILAI</th>

        </tr>


    <tr align="center">            
            <th width="80">N. ANGKA</th>
            <th width="80">N. HURUF</th>
            <th width="80">N. INDEKS</th>

        </tr>
';



$tgl4 = date("d M Y");

$smester = $_GET['smester'];
$nim = $_GET['id'];
$no=1;


$nilai = $koneksi->query("select * from tb_nilai, tb_matkul
                            WHERE tb_nilai.kode_mk=tb_matkul.kode_mk
                            AND    tb_nilai.nim='$nim'
                            AND    tb_nilai.smestern='$smester'
                            order by tb_matkul.kode_mk asc");
                            while ($data=$nilai->fetch_assoc()) {



                              $nilaiakhir= $data['nilaiakhir'];
                              $sks= $data['sks'];




                              $mutu_hasil = $sks * $mutu;

                              $presensi = $data['presensi'];
                              $tugas = $data['tugas'];
                              $quiz      = $data['quiz'];
                              $uts = $data['uts'];
                              $uas = $data['uas'];

                              $jumlah = ($presensi/100*10) + ($tugas/100*10) + ($uts/100*30) + ($uas/100*50)  ;

                              if ($jumlah >= 85) 

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

                                  $total = $sks * $mutu;

$content .= '

          <tr align="center">
                <td> '.$no++.' </td>
                <td> '.$data['kode_matkul'].' </td>
                <td align="center">'.$data['nama_mk'].'</td>
                <td align="center"> '.$data['sks'].'</td>  
                <td align="center">'.$jumlah.'</td>                 
                <td align="center">'.$grade.'</td>                
                <td> '.number_format("$mutu",2).'</td>
            </tr>

        ';

         $jml_krs = $jml_krs+$data['sks'];
         $jml_krst = $jml_krst+$datat['sks'];

        $jml_mutu = $jml_mutu+$total;

        $ipk = $jml_mutu / $jml_krs;


  $settpim1    = $koneksi->query("SELECT * FROM tb_jurusan WHERE tb_jurusan.kode_jurusan='$jurusanmhs'");
  $tampilpim1  = $settpim1->fetch_assoc();
  $kaprodi     = $tampilpim1 ['nama_kaprodi'];
  $nidnkaprodi     = $tampilpim1 ['nidn_kaprodi'];



        }

        $content .= '

          <tr>
            <th style="text-align: center; " colspan="3">JUMLAH</th>
            <td align="center"><b>'.$jml_krs.'  </b></td>
            <td colspan="5"></td>
        </tr>
        
       
        <tr>
            <th style="text-align: center; " colspan="3">IPK</th>
            
            <td align="center"><b> '.number_format("$ipk",2).' </b></td>
            <td colspan="5"></td>
        </tr>
        ';

$content .= '

</table><br><br>

<table style="width:100%;" align="center" border="">

  
  <tr>
    <td align="center">
    Mengetahui,<br><b>Direktur,</b><br><br><br><br><b><u>'.$ket.'</u><br>NIPY : '.$no_ket.'</b>
    </td>

    <td width="50">
    </td>

    <td width="50">
    </td>
    
    <td width="50">
    </td>

    <td width="50">
    </td>

    <td width="50">
    </td>

    <td width="50">
    </td>
    
    <td align="center">
    Brebes, '.$tgl4.'<br><b>Kepala Program Studi,</b><br><br><br><br><b><u>'.$kaprodi.'</u><br>NIPY : '.$nidnkaprodi.'</b>
    </td>
  </tr>
</table>



</page>';

    require_once('../assets/html2pdf/html2pdf.class.php');
  //$html2pdf = new HTML2PDF('P','A5','fr', false, 'ISO-8859-15',array(30, 0, 20, 0));
    $html2pdf = new HTML2PDF('L','A4','fr', false, 'ISO-8859-15',array(0, 10, 0, 0));
    $html2pdf->WriteHTML($content);
    $html2pdf->Output('khs_mahasiswa.pdf');
?>
