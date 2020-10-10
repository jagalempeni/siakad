<?php 
if($_SESSION['admin']){
?>

<div class="box box-primary">
	<div class="box-header">
		<h3 class="box-title">Form Import Data</h3>
	</div>

	<div class="box-body" style="border-top: 1px solid #f4f4f4;">
		<form method="post" action="" enctype="multipart/form-data">
			<input type="file" name="file" class="pull-left">
			<button type="submit" name="upload" class="btn btn-flat btn-success btn-sm">
				<span class="glyphicon glyphicon-eye-open"></span> Upload
			</button>
			<a href="download/format-import-dosen.xlsx" class="btn btn-warning btn-sm btn-flat"><i class="glyphicon glyphicon-download"></i> Download Format Import Dosen</a>
		</form>
		<br>


<?php  
// panggil PHPExcel
require_once 'PHPExcel/PHPExcel.php';
// koneksi
$conn = mysqli_connect("localhost","polf8968_001","Admin@123empat!","polf8968_001akad");


if( isset($_POST["upload"]) ){
	$inputFileName = $_FILES["file"]["tmp_name"];
	$excelData = [];

	if( !$conn ){
		die("Connection Failed " . mysqli_error($conn));
	}

	try {
		$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
		$objReader = PHPExcel_IOFactory::createReader($inputFileType);
		$objPHPExcel = $objReader->load($inputFileName);
	} catch (Exception $e) {
		die('Error loading file "'.pathinfo($inputFileName, PATHINFO_BASENAME).'": '.$e->getMessage());
	}

	$sheet = $objPHPExcel->getSheet(0);
	$highestRow = $sheet->getHighestRow();
	$highestColumn = $sheet->getHighestColumn(); ?>

	<?php

	for( $row = 2; $row <= $highestRow; $row++ ){
		$rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE); 

		$sql = "INSERT INTO tb_dosen(kode_dosen, nidn, nama_dosen, telpon, nik, ktp, ibu, email, alamat, pend_s1, pend_s2, pend_s3, foto) 
			VALUES (
			'".$rowData[0][0]."', 
			'".$rowData[0][1]."', 
			'".$rowData[0][2]."', 
			'".$rowData[0][3]."', 
			'".$rowData[0][4]."',
			'".$rowData[0][5]."', 
			'".$rowData[0][6]."',
			'".$rowData[0][7]."', 
			'".$rowData[0][8]."', 
			'".$rowData[0][9]."',
			'".$rowData[0][10]."', 
			'".$rowData[0][11]."', 						
			'user.png')
		"; 

		$sql1 = mysqli_query($conn, "INSERT INTO tb_user(id, nama, pass, level, foto) VALUES(
			'".$rowData[0][0]."',
			'".$rowData[0][2]."', 
			'".$rowData[0][0]."',
			'dosen',
			'user.png')
		");


		if( mysqli_query($conn, $sql) ){
			$excelData[] = $rowData[0];
		} 
	} ?>
	<table class='table table-bordered table-condensed'>
		<thead>
			<th>KODE</th>
			<th>NIDN</th>
			<th>NAMA</th>
			<th>TELEPON</th>
			<th>EMAIL</th>
			<th>ALAMAT</th>			
			<th>NIK</th>
			<th>NO. KTP</th>
			<th>NAMA IBU KANDUNG</th>
			<th>PEND. S1</th>
			<th>PEND. S2</th>
			<th>PEND. S3</th>			
		</thead>
		<tbody>
		<?php foreach ($excelData as $index => $excelrow) { ?>
			<tr>
			<?php foreach ($excelrow as $excelcolumn) { ?>
				<td><?= $excelcolumn ?></td>
			<?php } ?>
			</tr>
		<?php } ?>
		</tbody>
	</table>
	<br>

		<?php mysqli_close($conn);
	} ?>

	<a href="?page=dosen" class="btn btn-info btn-sm btn-flat">Kembali</a>
	</div>
</div>

<?php
    }else{
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';
exit;
    }
?> 