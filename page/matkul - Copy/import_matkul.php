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
		</form>
		<br>


<?php  
// panggil PHPExcel
require_once 'PHPExcel/PHPExcel.php';
// koneksi
$conn = mysqli_connect("localhost","root","","assholeh_siakad");


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

	for( $row = 1; $row <= $highestRow; $row++ ){
		$rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE); 

		$sql = "INSERT INTO tb_matkul(kode_mk, nama_mk, sks, smester, kode_jurusan, kode_kuri) 
			VALUES (
			'".$rowData[0][0]."', 
			'".$rowData[0][1]."', 
			'".$rowData[0][2]."', 
			'".$rowData[0][3]."', 
			'".$rowData[0][4]."', 
			'".$rowData[0][5]."')
		"; 
		


		if( mysqli_query($conn, $sql) ){
			$excelData[] = $rowData[0];
		} 
	} ?>
	<table class='table table-bordered table-condensed'>
		<thead>
			<th>Kode</th>
			<th>Nama</th>
			<th>Jumlah SKS</th>
			<th>Semester</th>
			<th>Prodi</th>
			<th>Kurikulum</th>
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

	<a href="?page=matkul" class="btn btn-info btn-sm btn-flat">Kembali</a>
	</div>
</div