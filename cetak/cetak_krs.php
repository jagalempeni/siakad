<?php
  error_reporting(0);
$koneksi = new mysqli  ("localhost","polf8968_001","Admin@123empat!","polf8968_001akad");
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
	<td><img src="../assets/img/kop-surat.png" width="510" height="120"/></td>
</tr>


<br><br>



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

                              $jumlah10 = $data10['nilaiakhir'];

                              if ($jumlah10 >= 85) {
            $grade10 = "A";
        }
        if ($jumlah10   <= 84) {
            $grade10 = "AB";
        }
        if ($jumlah10   <= 75) {
            $grade10 = "B";
        }
        if ($jumlah10   <= 69) {
            $grade10 = "BC";
        }
        if ($jumlah10   <= 63) {
            $grade10 = "C";
        }
        if ($jumlah10   <= 57) {
            $grade10 = "CD";
        }
        if ($jumlah10   <= 51) {
            $grade10 = "D";
        }
        if ($jumlah10   <= 45) {
            $grade10 = "E";
        }
        if ($grade10 == "A") {
            $mutu10 = 4.00;
        } elseif ($grade10 == "AB") {
            $mutu10 = 3.50;
        } elseif ($grade10 == "B") {
            $mutu10 = 3.00;
        } elseif ($grade10 == "BC") {
            $mutu10 = 2.50;
        } elseif ($grade10 == "C") {
            $mutu10 = 2.00;
        } elseif ($grade10 == "CD") {
            $mutu10 = 1.50;
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
	  <td></td>
	  <td></td>
	  <td></td>
	</tr>



	

</table><br>

<table border="1" class="tabel" align="center">


		<tr>
			<th align="center">No</th>
            <th align="center">Kode Mata kuliah</th>
            <th align="center" width="150">Nama Mata kuliah</th>
            <th align="center">Jumlah Kredit</th>
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
		        <td align="center"> '.$data['kode_matkul'].'</td>
		        <td align="center">'. $data['nama_mk'].'</td>
		        <td align="center">'.$data['sks'].'</td>
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
<a style="text-decoration: none; color: black; margin-left: 375px; font-size:10px;">Brebes, '.$tgl4.'</a><br><br>

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
