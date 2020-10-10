<?php
  error_reporting(0);
$koneksi = new mysqli  ("localhost","root","","assholeh_siakad1");

$nim = $_GET['id'];
  $sql1 = $koneksi->query("SELECT * from  tb_mahasiswa , tb_jurusan, tb_nilai
              WHERE  tb_mahasiswa.kode_jurusan = tb_jurusan.kode_jurusan

              AND tb_mahasiswa.nim='$nim'");
  $tampil=$sql1->fetch_assoc();

  $judul_skripsi = $tampil['judul_skripsi'];


$nilai4 = $koneksi->query("select * from tb_nilai, tb_matkul
                            WHERE tb_nilai.kode_mk=tb_matkul.kode_mk
                            AND    tb_nilai.nim='$nim'
                            order by tb_matkul.kode_mk asc");
                            while ($data4=$nilai4->fetch_assoc()) 

 $jml_krs = $jml_krs+$data4['sks'];

        $jml_mutu = $jml_mutu+$total;

        $ipk = $jml_mutu / $jml_krs;




$nilai3 = $koneksi->query("select * from tb_nilai, tb_matkul                             
                            WHERE tb_nilai.kode_mk=tb_matkul.kode_mk                            
                            AND    tb_nilai.nim='$nim'
                            order by tb_matkul.kode_mk asc
                            limit 26 offset 0");
                            while ($data3=$nilai3->fetch_assoc()) {

                              $sks= $data3['sks'];
                              $mutu_hasil = $sks * $mutu;
                              $presensi = $data3['presensi'];
                              $tugas = $data3['tugas'];
                              $quiz      = $data3['quiz'];
                              $uts = $data3['uts'];
                              $uas = $data3['uas'];

                              $jumlah = $data3['nilaiakhir'];

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

        $jml_krs = $jml_krs+$data['sks'];

        $jml_mutu = $jml_mutu+$total;

        $ipk = $jml_mutu / $jml_krs;
        }







  $kodejrs = $tampil['kode_jurusan'];

        if ($kodejrs == S1M) {
            $jenjang = "Strata Satu (S1)";
        }
        if ($kodejrs == D3M) {
            $jenjang = "Diploma Tiga (D3)";
        }
        if ($kodejrs == S1M) {
            $sebutan = "Sarjana Ekonomi (S.E)";
        }
        if ($kodejrs == D3M) {
            $sebutan = "Ahli Madya (Amd)";
        }

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




<table align="center">
<tr>
  <td><img src="../assets/img/kop-surat.png" width="50%"/></td>
</tr>
</table><hr width="100%"><br>
<h3 align="center">TRANSKRIP NILAI</h3>

<table border="" align="center">
<tr>
<td>
<table border="" align="center">
  <tr>
    <td>
      <b>Nama<br>
      NIM<br>
      Tempat, Tanggal Lahir<br>
      Program Studi<br>
      Jenjang Pendidikan<br>
      Tahun Akademik<br></b>
    </td>    
    <td>
      : '.$tampil['nama'].'<br> 
      : '.$tampil['nim'].'<br>
      : '.$tampil['tempat_lahir'].', '.$tampil['tanggal_lahir'].'<br>
      : '.$tampil['nama_jurusan'].'<br>
      : '.$jenjang.'<br>
      : '.$tampil['tahun_akad'].'<br>
    </td>
    <td width="40">
    </td>
    <<td>
     <b>Total SKS yang Ditempuh<br>
      Indeks Prestasi Kumulatif<br>
      Predikat Kelulusan<br>
      Sebutan Akademik<br>
      Nomor Ijazah<br>
      Tahun Angkatan<br></b>
    </td>    
    <td>
      : '.$jml_krs.'<br> 
      : '.number_format("$ipk",2).'<br>
      : '.$tampil['tempat_lahir'].'<br>
      : '.$sebutan.'<br>
      : '.$tampil['no_ijazah'].'<br>
      : '.$tampil['angkatan'].'<br>      
    </td>
  </tr>
</table>

<br><br>


<table style="width:400px" align="center" border="">
<tr>
<td>
<table style=text-align:"center"; border="1" class="tabel"  align="left">


    <tr>
      <th>No.</th>
      <th align="center">Nama Matakuliah</th>
      <th>Nilai</th>
      <th>SKS</th>
    </tr>
';

$tgl4 = date("d M Y");
$nim = $_GET['id'];
$no=1;

$nilai = $koneksi->query("select * from tb_nilai, tb_matkul                             
                            WHERE tb_nilai.kode_mk=tb_matkul.kode_mk                            
                            AND    tb_nilai.nim='$nim'
                            order by tb_matkul.kode_mk asc
                            limit 26 offset 0");
                            while ($data=$nilai->fetch_assoc()) {

                              $sks= $data['sks'];
                              $mutu_hasil = $sks * $mutu;
                              $presensi = $data['presensi'];
                              $tugas = $data['tugas'];
                              $quiz      = $data['quiz'];
                              $uts = $data['uts'];
                              $uas = $data['uas'];

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

                                  $total = $sks * $mutu;

$content .= '

          <tr>
                <td align="center"> '.$no++.' </td>
                <td>'.$data['nama_mk'].'</td> 
                <td align="center">'.$grade.'</td>
                <td align="center"> '.$data['sks'].'</td> 
            </tr>

        ';

         $jml_krs = $jml_krs+$data['sks'];

        $jml_mutu = $jml_mutu+$total;

        $ipk = $jml_mutu / $jml_krs;
        }

        $content .= '

        ';

$content .= '

</table>
</td>


<td width="90"></td>


<td valign="top">
<table style=text-align:"center"; border="1" class="tabel"  align="left">


    <tr>
      <th>No.</th>
      <th align="center">Nama Matakuliah</th>
      <th>Nilai</th>
      <th>SKS</th>
    </tr>
';

$tgl4 = date("d M Y");
$nim = $_GET['id'];
$no=27;

$nilai = $koneksi->query("select * from tb_nilai, tb_matkul                             
                            WHERE tb_nilai.kode_mk=tb_matkul.kode_mk                            
                            AND    tb_nilai.nim='$nim'
                            order by tb_matkul.kode_mk asc
                            limit 30 offset 26");
                            while ($data=$nilai->fetch_assoc()) {

                              $sks= $data['sks'];
                              $mutu_hasil = $sks * $mutu;
                              $presensi = $data['presensi'];
                              $tugas = $data['tugas'];
                              $quiz      = $data['quiz'];
                              $uts = $data['uts'];
                              $uas = $data['uas'];

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



                                  $total = $sks * $mutu;

$content .= '

          <tr>
                <td align="center"> '.$no++.' </td>
                <td>'.$data['nama_mk'].'</td> 
                <td align="center">'.$grade.'</td>
                <td align="center"> '.$data['sks'].'</td> 
            </tr>

        ';

         $jml_krs = $jml_krs+$data['sks'];

        $jml_mutu = $jml_mutu+$total;

        $ipk = $jml_mutu / $jml_krs;
        }



        $content .= '

        ';

$content .= '

</table>
</td>


</tr>
<tr>
  <td>
    <table style="width:100%" border="1">
      <tr>
        <td>
          <table>
            <tr>
              <td width="10px"><b>Judul Skripsi:</b>
              </td>
              <td>
              </td>
              <td> '.$judul_skripsi.' 
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </td>
</tr>
</table>
</td>
</tr>
</table>

<table style="width:100%;" align="center" border="">
<tr>
  <td>
    <table border=0px>
      <tr>
        <td align="center"><br>
        Mengetahui<br>Ketua,
        </td>
        <td style="width:70px">
        </td>
        <td style="width:70px">
        </td>
        <td align="center">
        Pemalang, '.$tgl4.'<br>
        STIE ASSHOLEH PEMALANG<br>Wakil Ketua I,
        </td>
      </tr>
      <tr>
        <td style="height:50px">
        </td>
      </tr>
      <tr>
        <td align="center">
        <b><u>H.NOOR ROSYADI, SE., MM.</u><br>NIDN : 0630105901</b>
        </td>
        <td style="width:70px">
        </td>
        <td style="width:70px">
        </td>
        <td align="center">
        <b><u>SURIPTO, S.E., M,Si., Ak.</u><br>NIDN : 060708721</b>
        </td>
      </tr>
    </table>
  </td>
</tr> 
</table>



</page>';

    require_once('../assets/html2pdf/html2pdf.class.php');
  //$html2pdf = new HTML2PDF('P','A5','fr', false, 'ISO-8859-15',array(30, 0, 20, 0));
    $html2pdf = new HTML2PDF('P','Legal','fr');
    $html2pdf->WriteHTML($content);
    $html2pdf->Output('transkrip_nilai_mahasiswa.pdf');
?>
