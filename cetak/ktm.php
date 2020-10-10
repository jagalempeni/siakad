<?php
  error_reporting(0);
$koneksi = new mysqli  ("localhost","stapinac_w2l","Admin@1","stapinac_w2l");
    $content = '

    <style type="text/css">

	.tabel{border-collapse: collapse;}
	 img{width:125px; height:130px;}

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
	<td rowspan="6"><img src="../assets/img/logo.png" width="110" height="110"/></td>

	<td style="font-size: 12px; text-align: center;">SYNTAX CORPORATION</td>
</tr>

<tr>
	<td style="font-size: 12px; text-align: center;">Greenland Sendang No. H-01 Sumber - Cirebon</td>
</tr>
<tr>
	<td style="font-size: 12px; text-align: center;">Telp: (0231) 322887</td>
</tr>
<tr>
	<td style="font-size: 12px; text-align: center;">Email : support@syntax.co.id / Website : hhtp//www.syntax.co.id</td>
</tr>
<br>
<hr>
<br><br>

</table>
<br><br>

<h4 style="text-align:center;">Kartu Tanda Mahasiswa</h4>';

$nim = $_GET['id'];
$sql = $koneksi->query("select * from tb_mahasiswa inner join tb_jurusan
                            on tb_mahasiswa.kode_jurusan = tb_jurusan.kode_jurusan and nim='$nim'");
$data=$sql->fetch_assoc();

 $jenkel = ($data['jenis_kelamin']==L)?"Laki-laki" : "Wanita";

$content .= '
<table class="tabel" align="center">
<tr>
	<td rowspan="5"> <img src="../img/'.$data['foto'].'"> </td>
	<td><span class="style2">Nim </span></td>
	<td><span class="style2">: </span></td>
	<td><span class="style2">'.$data['nim'].'</span></td>
</tr>

<tr>

	<td><span class="style2">Nama </span></td>
	<td><span class="style2">: </span></td>
	<td><span class="style2">'.$data['nama'].'</span></td>

</tr>

<tr>

	<td><span class="style2">Tempat / tgl Lahir </span></td>
	<td><span class="style2">: </span></td>
	<td><span class="style2">'.$data['tempat_lahir'].' , '.date('d F Y', strtotime($data['tanggal_lahir'])).'</span></td>

</tr>

<tr>

	<td><span class="style2">Jenis Kelamin </span></td>
	<td><span class="style2">: </span></td>
	<td><span class="style2">'.$jenkel.'</span></td>

</tr>


<tr>

	<td><span class="style2">Prodi </span></td>
	<td><span class="style2">: </span></td>
	<td><span class="style2">'.$data['nama_jurusan'].'</span></td>

</tr>
</table>

</page>';

    require_once('../assets/html2pdf/html2pdf.class.php');
    $html2pdf = new HTML2PDF('L','A6','fr');
    $html2pdf->WriteHTML($content);
    $html2pdf->Output('ktm_mahasiswa.pdf');
?>