<?php
  error_reporting(0);
$koneksi = new mysqli  ("localhost","polf8968_001","Admin@123empat!","polf8968_001akad");

$settpim    = $koneksi->query("SELECT * FROM tb_sett");
  $tampilpim  = $settpim->fetch_assoc();
  $no_ket     = $tampilpim ['no_ket'];
  $ket        = $tampilpim ['ket'];
  $no_waket   = $tampilpim ['no_waket'];
  $waket      = $tampilpim ['waket'];

    $content = '

    <style type="text/css">

	.tabel{border-collapse: collapse;}
	.tabel th{padding: 8px 5px; background-color: #cccccc;}
	.tabel td{padding: 8px 5px;}
	 img{width:125px; height:130px;}
	 td{font-size:14px;}
	 th{font-size:14px;}

	 .style2 {
    color: black;
    font-weight: bold;
    margin-left:20px ;

}
	</style>


';
    $content .= '
<page>


<table align="center">
<tr>
  <td><img src="../assets/img/kop-surat.png" width="680" height="140"/></td>
</tr>
<tr>

</tr>
<br>
</table>


<h4 style="text-align:center;"><u>Rekap Nilai Mahasiswa</u></h4>';

$dosen =$_GET['dosen'];
$kode_mk=$_GET['matkul'];

$sql_rekap = $koneksi->query("SELECT * from  tb_matkul, tb_jurusan, tb_nilai  where 
                              tb_jurusan.kode_jurusan = tb_matkul.kode_jurusan AND
                              tb_matkul.kode_mk       = '$kode_mk' AND
                              tb_nilai.kode_mk        = '$kode_mk'
                              ");
$data_rekap=$sql_rekap->fetch_assoc();

$sql_dosen = $koneksi->query("SELECT * from  tb_dosen  where kode_dosen='$dosen'");
$data_dosen=$sql_dosen->fetch_assoc();



$content .= '
<table border="" align="center">

	<tr>
	  <td>Kode MataKuliah</td>
	  <td>:</td>
	  <td>'.$data_rekap['kode_matkul'].'</td>
    <td>Nama Matakuliah</td>
    <td>:</td>
    <td>'.$data_rekap['nama_mk'].'</td>
  </tr>

  <tr>
    <td>Program Studi</td>
    <td>:</td>
    <td>'.$data_rekap['nama_jurusan'].'</td>  
    <td>Kelas</td>
    <td>:</td>
    <td>'.$data_rekap['kelas'].'</td>  
  </tr>

	<tr>
	  <td>Semester</td>
	  <td>:</td>
	  <td width="280">'.$data_rekap['smester'].'</td>
	</tr>

</table><br><br><br>

<table border="1" class="tabel"  align="center" >


<tr>
          <th rowspan="2" style="text-align:center;" width="40">No</th>
          <th rowspan="2" style="text-align:center;" width="90">Nim</th>
          <th rowspan="2" style="text-align:center;" width="90">Nama</th>
          <th colspan="5" style="text-align:center;" width="120">Nilai</th>
          

</tr>

<tr>

          <th style="text-align:center;">Angka</th>
          <th style="text-align:center;">Huruf</th>
          <th style="text-align:center;">Mutu</th>


</tr>
';

$tgl4 = date("d M Y");

$smester = $_GET['smester'];
$nim = $_GET['id'];
$no=1;


$no = 1;

$nilai = $koneksi->query("select * from tb_mahasiswa, tb_nilai, tb_matkul
                        WHERE tb_nilai.kode_mk=tb_matkul.kode_mk
                        and tb_mahasiswa.nim=tb_nilai.nim
                        and tb_matkul.kode_mk='$kode_mk'
                         order by tb_matkul.kode_mk asc");
while ( $data = $nilai->fetch_assoc() ) {
        $sks        = $data['sks'];
        $mutu_hasil = $sks * $mutu;
    $presensi   = $data['presensi'];
        $tugas      = $data['tugas'];
        $quiz      = $data['quiz'];
        $uts        = $data['uts'];
        $uas        = $data['uas'];
       $jumlah = ($presensi/100*10) + ($tugas/100*10) + ($uts/100*30) + ($uas/100*50)  ;
if ($jumlah >= 86) 

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



$content .= '

        	<tr>
                <td style="text-align:center;"> '.$no++.' </td>
                <td width="120" style="text-align:center;"> '.$data['nim'].' </td>
                <td width="150" style="text-align:center;"> '.$data['nama'].'</td>
                <td width="50" style="text-align:center;">'.$jumlah.'</td>
                <td width="50" style="text-align:center;">'.$grade.'</td>
                <td width="50" style="text-align:center;">'.number_format("$mutu",2).'</td>
                
            </tr>

        ';


        }



$content .= '

</table>
<br><br><br>
<table align="center">
  <tr>
    <td valign="top">
      <br><br>Dosen Pengampu
    </td>
    <td width="40">
    </td>
    <td width="40">
      Brebes, '.$tgl4.'<br>Disetujui,<br>Wadir I
    </td>
  </tr>

  <tr>
    <td valign="center">
      '.$data_dosen['nama_dosen'].'
    </td>
    <td width="270">
    </td>
    <td width="160">
      '.$waket.'
    </td>
  </tr>
</table>

</page>';

    require_once('../assets/html2pdf/html2pdf.class.php');
    $html2pdf = new HTML2PDF('P','A4','fr');
    $html2pdf->WriteHTML($content);
    $html2pdf->Output('rekap_nilai_dosen.pdf');
?>
