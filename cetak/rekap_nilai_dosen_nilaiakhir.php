<?php
  error_reporting(0);
$koneksi = new mysqli  ("localhost","root","","assholeh_siakad1");
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
	<td rowspan="6"><img src="../assets/img/logo-cetak.png" width="100" height="100"/></td>
	<td style="font-size: 10px; text-align: center;"></td>
</tr>
<tr>

</tr>
<tr style="text-align: center;">
	<td style="font-size: 13px; text-align: center;"><h2>SEKOLAH TINGGI FARMASI</h2></td>
</tr>

<tr>
	<td style="font-size: 13px; text-align: center;"><h2>STIE ASSHOLEH PEMALANG</h2></td>
</tr>

<br>
<hr>



</table><br><br>


<h4 style="text-align:center;"><u>Rekap Nilai Mahasiswa</u></h4>';

$dosen =$_GET['dosen'];
$kode_mk=$_GET['matkul'];

$sql_rekap = $koneksi->query("SELECT * from  tb_matkul, tb_jurusan  where kode_mk='$kode_mk' and tb_matkul.kode_jurusan = tb_jurusan.kode_jurusan");
$data_rekap=$sql_rekap->fetch_assoc();

$sql_dosen = $koneksi->query("SELECT * from  tb_dosen  where kode_dosen='$dosen'");
$data_dosen=$sql_dosen->fetch_assoc();

$sql_akad = $koneksi->query("SELECT * from  tb_krs  where kode_mk='$kode_mk'");
$data_akad=$sql_akad->fetch_assoc();



$content .= '
<table>

	<tr>
	  <td  width="90"></td>
	  <td><b>Mata Kuliah</b></td>
	  <td>:</td>
	  <td>'.$data_rekap['nama_mk'].'</td>

	  <td ><b>Tahun Akademik</b></td>
	  <td>:</td>
	  <td>'.$data_akad['tahun_akad'].'</td>


	</tr>

	<tr>
	  <td  width="90"></td>
	  <td><b>SKS</b></td>
	  <td>:</td>
	  <td width="250">'.$data_rekap['sks'].'</td>

    <td ><b>Program Studi</b></td>
    <td>:</td>
    <td>'.$data_rekap['nama_jurusan'].'</td>
	</tr>

  <tr>
    <td  width="90"></td>
    <td><b>Dosen</b></td>
    <td>:</td>
    <td width="250">'.$data_dosen['nama_dosen'].'</td>

    <td ><b>Semester</b></td>
    <td>:</td>
    <td>'.$data_rekap['nama_jurusan'].'</td>
  </tr>

</table><br>

<table border="1" class="tabel"  align="center" >


<tr>
          <th rowspan="2" class="text-center">No</th>
          <th rowspan="2" style="text-align:center; class="text-center">Nim</th>
          <th rowspan="2" style="text-align:center; class="text-center">Nama</th>
          <th rowspan="2" style="text-align:center; class="text-center">TP</th>
          <th colspan="2" style="text-align:center; class="text-center">Nilai Akhir</th>
          

</tr>

<tr>

          
          <th class="text-center">HM</th>
          <th class="text-center">AM</th>


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



$content .= '

        	<tr>
                <td> '.$no++.' </td>
                <td> '.$data['nim'].' </td>
                <td>'.$data['nama'].'</td>
                <td>'.$jumlah.'</td>
                <td>'.$grade.'</td>
                <td>'.number_format("$mutu",2).'</td>
                
            </tr>

        ';


        }



$content .= '

</table>

<br>

      <a style="text-decoration: none; color: black; margin-left: 510px; font-size: 12px;">Pemalang, '.$tgl4.'</a><br>
      <a style="text-decoration: none; color: black; margin-left: 510px; font-size: 12px;">Disetujui,</a><br>
      <a style="text-decoration: none; color: black; margin-left: 510px; font-size: 12px;">Waket I</a><br><br><br><br><br><br>
      <a style="text-decoration: none; color: black; margin-left: 510px; font-size: 12px;">Suripto, SE, M.Si, Ak.</a>

</page>';

    require_once('../assets/html2pdf/html2pdf.class.php');
    $html2pdf = new HTML2PDF('P','A4','fr');
    $html2pdf->WriteHTML($content);
    $html2pdf->Output('rekap_dosen.pdf');
?>
