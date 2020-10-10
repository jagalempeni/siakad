<?php 
$id  = $_GET["id"] ;
$sql = $koneksi->query("SELECT * FROM tb_user WHERE id = '$id'");
$row = $sql->fetch_assoc();

?>

<form method="POST" enctype="multipart/form-data">
	<div class="box box-primary">
		<div class="box-header with-border">
		  	<h3 class="box-title">Ubah Profile</h3>
		</div>

		<div class="box-body">	
		    <div class="form-group">
		        <label>Nama</label>
		        <input type="text" class="form-control" required name="nama" placeholder="Nama" value="<?= $row["nama"]; ?>">
		    </div>
		    <div class="form-group">
		    	<img src="img/<?= $row["foto"]; ?>" height="100">
		    </div>

		     <div class="form-group">
		        <label>Foto</label>
		        <input type="file" required name="foto">
		    </div>   
		</div>

		<div class="box-footer">
		     <input type="submit" name="simpan" value="Update" class="btn btn-flat btn-sm btn-primary">
			 <a href="index.php" class="btn btn-flat btn-sm btn-info">Kembali</a>	
		</div>
	</div>
</form>

<?php 
if (isset($_POST['simpan'])) {
	$id     = $_GET['id'];
	$nama   = $_POST['nama'];
	$foto   = $_FILES['foto']['name'];
	$lokasi = $_FILES['foto']['tmp_name'];

	if(!empty($lokasi)) {
		move_uploaded_file($lokasi, "img/".$foto);
		$simpan = $koneksi->query("UPDATE tb_user SET nama = '$nama', foto = '$foto' WHERE id = '$id'");
	} else{
		$simpan = $koneksi->query("UPDATE tb_user SET nama = '$nama' WHERE id = '$id'");
	}


	if ($simpan) {
		echo "
				<script>
				    setTimeout(function() {
				        swal({
				            title: 'Selamat!',
				            text: 'Ubah Profile berhasil!',
				            type: 'success'
				        }, function() {
				            window.location = 'index.php';
				        });
				    }, 300);
				</script>
		";
} } ?>