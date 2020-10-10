<?php
  error_reporting(0);
$koneksi = new mysqli  ("localhost","root","","assholeh_siakad1");

$nim = $_GET['id'];
  $sql1 = $koneksi->query("SELECT * from  tb_mahasiswa , tb_jurusan
              WHERE  tb_mahasiswa.kode_jurusan = tb_jurusan.kode_jurusan

              AND tb_mahasiswa.nim='$nim'");
  $tampil=$sql1->fetch_assoc();

    $content = '

    <style type="text/css">

  .tabel{border-collapse: collapse;}
  .tabel th{padding: 8px 5px; background-color: #cccccc;}
  .tabel td{padding: 8px 5px;}
   img{width:125px; height:130px;}
   td{font-size:12px;}
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





<table style="width:100%;" align="center" >
<tr>
        <td><img src="../assets/img/logo-cetak.png" width="80" height="80"/> 
      </td>
  
      <td style="font-size: 13px; text-align: center;"><b>SEKOLAH TINGGI FARMASI<br>
        STIE ASSHOLEH PEMALANG</b><br>
        <font size="7">Jl. Sindoro No. 39 Telp. (0284) 322881 Pemalang</font><br><hr>
      </td>

        <td>
          <table style="width: 7%;">
          <tr><td></td></tr></table></td>
          <td>
          <table style="width: 7%;">
          <tr><td></td></tr></table></td>

      <td>
          <table style="width:41%;" align="left" >
        <tr><th align="center" colspan="3">KARTU HASIL STUDI</th></tr>
        <tr>
          <td>Prodi</td>
          <td>:</td>
          <td>'.$tampil['nama_jurusan'].'</td>
        </tr>

         <tr>
          <td>Nama</td>
          <td>:</td>
          <td>'.$tampil['nama'].'</td>
        </tr>

        <tr>
          <td>NIM</td>
          <td>:</td>
          <td>'.$tampil['nim'].'</td>
        </tr>

        <tr>
          <td>Semester - Th. Akademik</td>
          <td>:</td>
          <td>'.$tampil['smester'].' - '.$tampil['tahun_akad'].'</td>
        </tr>

        </table>
        </td>

      

    
</tr>
</table><br>

<table border="1" class="tabel"  align="center">


    <tr>
           <th>NO</th>
            <th>KODE</th>
            <th>MATAKULIAH</th>
            <th>B/U</th>
            <th>KREDIT</th>
            <th>Smester</th>
            <th>N. HURUF</th>
            <th>N. KUMULATIF</th>
            <th>Mutu</th>

        </tr>
';

$tgl4 = date("d M Y");

$smester = $_GET['smester'];
$nim = $_GET['id'];
$no=1;


$nilai = $koneksi->query("select * from tb_nilai, tb_matkul
                            WHERE tb_nilai.kode_mk=tb_matkul.kode_mk
                            AND    tb_nilai.nim='$nim'
                            order by tb_matkul.kode_mk asc");
                            while ($data=$nilai->fetch_assoc()) {

                              $sks= $data['sks'];




                              $mutu_hasil = $sks * $mutu;

                              $tugas = $data['tugas'];
                              $uts = $data['uts'];
                              $uas = $data['uas'];

                              $jumlah = ($tugas * 0.3) + ($uts * 0.3) + ($uas * 0.4);

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

$content .= '

          <tr>
                <td> '.$no++.' </td>
                <td> '.$data['kode_mk'].' </td>
                <td>'.$data['nama_mk'].'</td>
                <td>'.$data['ket'].'</td>
                <td align="right"> '.$data['sks'].'</td>
                <td>'.$data['smester'].'</td>
                <td>'.$grade.'</td>
                <td> '.$mutu.'</td>
                <td> '.$total.'</td>
            </tr>

        ';

         $jml_krs = $jml_krs+$data['sks'];

        $jml_mutu = $jml_mutu+$total;

        $ipk = $jml_mutu / $jml_krs;
        }

        $content .= '

          <tr>
            <th style="text-align: center; " colspan="3">Total SKS</th>
            <td align="right"><b> '.$jml_krs.' </b></td>
            <td colspan="5"></td>
        </tr>
         <tr>
            <th style="text-align: center; " colspan="3">Total Mutu</th>
            <td align="right"><b> '.$jml_mutu.' </b></td>
            <td colspan="5"></td>
        </tr>
        <tr>
            <th style="text-align: center; " colspan="3">IPK</th>
            <td align="right"><b> '.round($ipk,2).' </b></td> 
            <td colspan="5"></td>
        </tr>';

$content .= '

</table>

<br>

      <a style="text-decoration: none; color: black; margin-left: 510px; font-size: 12px;">Pemalang, '.$tgl4.'</a><br>
      <a style="text-decoration: none; color: black; margin-left: 510px; font-size: 12px;">Disetujui,</a><br>
      <a style="text-decoration: none; color: black; margin-left: 510px; font-size: 12px;">Waket I</a><br><br><br><br><br><br>
      <a style="text-decoration: none; color: black; margin-left: 510px; font-size: 12px;">Suripto, SE, M.Si, Ak.</a>

</page>';

    require_once('../assets/html2pdf/html2pdf.class.php');
  //$html2pdf = new HTML2PDF('P','A5','fr', false, 'ISO-8859-15',array(30, 0, 20, 0));
    $html2pdf = new HTML2PDF('L','A5','fr');
    $html2pdf->WriteHTML($content);
    $html2pdf->Output('krs_mahasiswa.pdf');
?>
