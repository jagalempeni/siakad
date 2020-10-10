<?php 
$sql     = $koneksi->query("SELECT kode_mk FROM tb_matkul ORDER BY kode_mk DESC");
$data    = $sql->fetch_assoc();
$kode_mk = $data['kode_mk'];
$urut    = substr($kode_mk, 1, 3);
$tambah  = (int) $urut + 1;

if(strlen($tambah) == 1){
	$format = "M"."00".$tambah;
} else if(strlen($tambah) == 2){
	$format = "M"."0".$tambah;
} else{
	$format = "M".$tambah;
}


 ?>

<form method="POST">
 	<div class="box box-primary">
	   <div class="box-header with-border">
	      <h3 class="box-title">Tambah Data Matakuliah</h3>
	   </div>

	   <div class="box-body">
         <div class="form-group">
             <label>Kode Mata Kuliah :</label>
             <input type="text" class="form-control" required name="kode" value="<?php echo $format; ?>">
         </div>

         <div class="form-group">
            <label>Nama Mata Kuliah :</label>
            <input type="text" class="form-control" required name="nama">
        	</div>

         <div class="form-group">
            <label>SKS :</label>
            <input type="number" class="form-control" required name="sks">
        	</div>



        	<div class="form-group">
		           <label>Prodi</label>
		           <select class="form-control" required name="jurusan">

		           <option>-Pilih Prodi-</option>}
		           option
		               <?php 

		               	$sql = $koneksi->query("select * from tb_jurusan");
		               	while ($data=$sql->fetch_assoc()) {
		               		echo "

		               			<option value='$data[kode_jurusan]'>$data[nama_jurusan]</option>

		               		";
		               	}
		                ?>
		           </select>
		       </div>



			<div class="form-group">
			  <label>Semester :</label>
			  <select class="form-control" required name="smester">
				  <option>-Pilih Smester-</option>
				  <option value="1">1</option>
				  <option value="2">2</option>
				  <option value="3">3</option>
				  <option value="4">4</option>
				  <option value="5">5</option>
				  <option value="6">6</option>
				  <option value="7">7</option>
				  <option value="8">8</option>
			  </select>
			</div>


			



   	</div>

	   <div class="box-footer">
	   	<input type="submit" name="simpan" value="Simpan" class="btn btn-flat btn-sm btn-primary">
	      <input type=button value="Kembali" onclick="self.history.back()" class="btn btn-flat btn-sm btn-info">
	   </div>
	</div>
</form>

<?php 
	if (isset($_POST['simpan'])) {
		$kode    = $_POST['kode'];
		$nama    = $_POST['nama'];
		$sks     = $_POST['sks'];
		$smester = $_POST['smester'];
		$kuri 	 = $_POST['kuri'];
		$jurusan = $_POST['jurusan'];
		$simpan  = $koneksi->query("INSERT INTO tb_matkul (kode_mk, nama_mk, sks, smester, kode_kuri, kode_jurusan) VALUES ('$kode', '$nama', '$sks', '$smester', '$kuri', '$jurusan')");
		if ($simpan) {
			echo "
				<script>
				    setTimeout(function() {
				        swal({
				            title: 'Selamat!',
				            text: 'Data Berhasil Disimpan!',
				            type: 'success'
				        }, function() {
				            window.location = '?page=matkul';
				        });
				    }, 300);
				</script>
			";
		}
	}
?>
                            