<?php
  error_reporting(0);
$koneksi = new mysqli  ("localhost","root","","assholeh_siakad1");

$nim = $_GET['id'];
  $sql1 = $koneksi->query("SELECT * from  tb_mahasiswa , tb_jurusan
              WHERE  tb_mahasiswa.kode_jurusan = tb_jurusan.kode_jurusan

              AND tb_mahasiswa.nim='$nim'");
  $tampil=$sql1->fetch_assoc();


$sql3 = $koneksi->query("select * from tb_nilai, tb_matkul
                            WHERE tb_nilai.kode_mk=tb_matkul.kode_mk
                            AND    tb_nilai.nim='$nim'");

$data3 = $sql3->fetch_assoc();



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



<td>
  <table>
    <tr>
        <td>
          <td valign="top">
          <table style=text-align:center;" >
          <tr>
            <td rowspan="3"><img src="../assets/img/logo-cetak.png" width="82" height="82"/> 
            </td>
              <td valign="center" style="font-size:14px;"><b>SEKOLAH TINGGI FARMASI</b><br>
              </td>
            </tr>
            <tr>
              <td style="font-size:30px"><b>STIE ASSHOLEH</b></td>
            </tr>
            <tr>
              <td valign="bottom">Jl. Sindoro No. 39 Telp. (0284) 322881 Pemalang</td>
            </tr>
          </table>
          </td>
          

      </td>
      </tr>
  </table>
</td>



  

        <td>
          <table style="width: 7%;">
          <tr><td></td></tr></table></td>
          <td>
          <table style="width: 7%;">
          <tr><td></td></tr></table></td>




      <td>
          <table style="width:41%;" align="left">
        <tr><td valign="bottom" style="font-size:12px;" align="center" colspan="3" ><b>KARTU HASIL STUDI</b></td></tr>
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
          <td>'.$tampil['smester'].' - '.$data3['tahun_akad'].'</td>
        </tr>

        </table>
        </td>

      

    
</tr>
</table><br>

<table style=text-align:"center"; border="1" class="tabel"  align="center" >


    <tr>
           <th>NO</th>
            <th>KODE</th>
            <th>MATAKULIAH</th>
            <th>B/U</th>
            <th>KREDIT</th>
            <th>N. HURUF</th>
            <th>N. KUMULATIF</th>

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

                              $presensi = $data['presensi'];
                              $tugas = $data['tugas'];
                              $quiz      = $data['quiz'];
                              $uts = $data['uts'];
                              $uas = $data['uas'];

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

                                  $total = $sks * $mutu;

$content .= '

          <tr>
                <td> '.$no++.' </td>
                <td> '.$data['kode_mk'].' </td>
                <td>'.$data['nama_mk'].'</td>
                <td>'.$data['ket'].'</td>
                <td align="center"> '.$data['sks'].'</td>  
                <td align="center">'.$grade.'</td>
                <td> '.number_format("$mutu",2).'</td>
            </tr>

        ';

         $jml_krs = $jml_krs+$data['sks'];

        $jml_mutu = $jml_mutu+$total;

        $ipk = $jml_mutu / $jml_krs;
        }

        $content .= '

          <tr>
            <th style="text-align: center; " colspan="4">JUMLAH</th>
            <td align="center"><b>'.$jml_krs.'  </b></td>
            <td colspan="5"></td>
        </tr>
        ';

$content .= '

</table>

<br>






<table style="width:100%;" align="center">
<tr>
        <td width="170">
        </td>
  
        <td width="50">
        </td>



        <td width="90">
        </td>

        <td>
        </td>

        <td></td>

        <td text-align="center">Pemalang, '.$tgl4.'<br>STIE ASSHOLEH PEMALANG<br>Ketua,
        </td>    
</tr>

<tr>
        <td width="170" height="10">
        </td>
  
        <td width="50">
        </td>

        <td width="90">
        </td>

        <td>
        </td>

        <td></td>

        <td>
        </td>    
</tr>

<tr>
        <td colspan="4" width="170" ><hr width="20px">
        </td>
        <td>
        </td>
        <td>
        </td>      
</tr>

<tr>
        <td width="200">Kredit diperoleh di Semester ini
                        <br>Total Kredit diperoleh
                        <br>Beban Studi Semester berikutnya
        </td>
  
        <td width="50"><b>'.$jml_krs.' SKS</b>
                        <br>...
                        <br><b>24 SKS</b>
        </td>

        <td valign="top" width="90">IP Semester ini
                        <br> IP Kumulatif
        </td>

        <td valign="top" width="30"> <b> '.number_format("$ipk",2).' </b>
                        <br>....
        </td>

        <td width="30"></td>

        <td rowspan="2" text-align="center" valign="bottom"><b><u>H.NOOR ROSYADI, SE., MM.</u><br>NIDN : 0630105901</b>
        </td>    
</tr>
<tr>
  <td colspan="4"><hr width="20px">
  </td>
</tr>
</table>



</page>';

    require_once('../assets/html2pdf/html2pdf.class.php');
  //$html2pdf = new HTML2PDF('P','A5','fr', false, 'ISO-8859-15',array(30, 0, 20, 0));
    $html2pdf = new HTML2PDF('L','A5','fr');
    $html2pdf->WriteHTML($content);
    $html2pdf->Output('krs_mahasiswa.pdf');
?>
