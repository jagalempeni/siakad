<?php
  error_reporting(0);
$koneksi = new mysqli  ("localhost","root","","office_assholeh_siakad");
    $content = '

    <style type="text/css">

	.tabel{border-collapse: collapse;}
	.tabel th{padding: 5px 3px; background-color: #cccccc;}
	.tabel td{padding: 5px 3px;}
	 img{width:125px; height:130px;}
	 td{font-size:10px;}
	 th{font-size:10px;}

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
	<td rowspan="2"><img src="../assets/img/logo-cetak.png" width="80" height="80"/></td>
	
	<td style="font-size: 20px; text-align: center;"><b>SEKOLAH TINGGI FARMASI<br><br>
	STIE ASSHOLEH PEMALANG</b></td>
</tr>


<br><br><br>
<hr>



</table>

<br>
<h4 style="text-align:center;"><u>KARTU RENCANA STUDI </u></h4><br>';

	$nim = $_GET['id'];
	$sql1 = $koneksi->query("SELECT * from  tb_mahasiswa , tb_jurusan
							WHERE  tb_mahasiswa.kode_jurusan = tb_jurusan.kode_jurusan

							AND tb_mahasiswa.nim='$nim'");
	$tampil=$sql1->fetch_assoc();

	$sql3 = $koneksi->query("SELECT * from  tb_sett");
	$tampil3=$sql3->fetch_assoc();



$content .= '


<table align="center">

	<tr>
	  
	  <td>NIM</td>
	  <td>:</td>
	  <td width="200">'.$tampil['nim'].'</td>
	  <td>Tahun Akademik</td>
	  <td>:</td>
	  <td>'.$tampil3['tahun_akad'].'</td>


	</tr>

	<tr>
	  <td>Nama Mahasiswa</td>
	  <td>:</td>
	  <td>'.$tampil['nama'].'</td>
	  <td>Semester</td>
	  <td>:</td>
	  <td>'.$tampil['smester'].'</td>
	</tr>


	<tr>
	  <td>Program Studi</td>
	  <td>:</td>
	  <td>'.$tampil['nama_jurusan'].'</td>
	</tr>



	

</table><br>

<table border="1" class="tabel" align="center">


		<tr>
			<th align="center">No</th>
            <th align="center">Kode Mata kuliah</th>
            <th align="center">Nama Mata kuliah</th>
            <th align="center">Jumlah Kredit</th>
            <th align="center">Kelas</th>
            <th align="center">Keterangan</th>
		</tr>
';

$tgl4 = date("d M Y");
$smester = $_GET['smester'];
$nim = $_GET['id'];



$no=1;
$sql = $koneksi->query("SELECT * from tb_krs , tb_matkul
						WHERE   tb_matkul.kode_mk = tb_krs.kode_mk  		
						AND 	tb_krs.nim='$nim'
						AND 	tb_matkul.smester='$smester'");
while ($data=$sql->fetch_assoc()) {

$content .= '

        	<tr>
		        <td align="center">'.$no++.'</td>
		        <td align="center"> '.$data['kode_mk'].'</td>
		        <td align="center">'. $data['nama_mk'].'</td>
		        <td align="center">'.$data['sks'].'</td>
		        <td align="center">'. $data['kelas'].'</td>
		        <td align="center">'. $data['ket'].'</td>
		        
		    </tr>

        ';

         $jml_krs = $jml_krs+$data['sks'];
        }

        $content .= '

	        <tr>
		        <th style="text-align: center;" colspan="3">Total Kredit</th>
		        <th align="center"><b> '.$jml_krs.' </b></th>
		        
		    </tr>';

$content .= '

</table>


<br>
<a style="text-decoration: none; color: black; margin-left: 375px; font-size:10px;">Pemalang, '.$tgl4.'</a><br><br>

<table style="text-align: center;" align="center">

	<tr>	  
	  <td>Mengetahui,</td>
	  <td width="200"></td>
	  <td>Mahasiswa,</td>
	</tr>

	<tr>
	  <td>Dosen Pembimbing Akademik,</td>	 
	</tr><br><br><br><br>

	<tr>
		<td height="50"></td>
	</tr>

	<tr>
	  <td ></td>
	  <td width="200"></td>
	  <td>'.$tampil['nama'].'</td>	 
	</tr>

	<tr>	  
	  <td height="0">__________________</td>
	  <td width="200"></td>
	  <td height="0">__________________</td>
	</tr>

	<tr>	  
	  <td>Nama & Tanda Tangan</td>
	  <td width="200"></td>
	  <td>Nama & Tanda Tangan</td>
	</tr>

</table>



</page>';

    require_once('../assets/html2pdf/html2pdf.class.php');
	//$html2pdf = new HTML2PDF('P','A5','fr', false, 'ISO-8859-15',array(30, 0, 20, 0));
    $html2pdf = new HTML2PDF('P','A5','fr', false, 'ISO-8859-15',array(0, 10, 0, 0));
    $html2pdf->WriteHTML($content);
    $html2pdf->Output('krs_mahasiswa.pdf');
?>
