<?php 
$kode   = $_GET['id'];
$sql    = $koneksi->query("SELECT * from tb_kurikulum where kode_kuri = '$kode'");
$tampil = $sql->fetch_assoc();
 ?>
<form method="POST">
	<div class="box box-primary">
	   <div class="box-header with-border">
	     	<h3 class="box-title">Ubah Data Kurikulum</h3>
	   </div>
	   <div class="box-body">


		<div class="form-group">
		        <label>Kode Kurikulum</label>
		        <input type="text" class="form-control" required name="kode" value="<?= $tampil["kode_kuri"]; ?>" readonly>
		    </div>


		<div class="form-group">
		        <label>Nama Kurikulum</label>
		        <input type="text" class="form-control" required name="nama" value="<?= $tampil["nama_kuri"]; ?>">
		   </div>

		
		<div class="box-footer">

		    <input type="submit" name="ubah" value="Simpan" class="btn btn-flat btn-sm btn-primary">
		    <input type=button value=Kembali onclick=self.history.back() class="btn btn-flat btn-sm btn-info" />
		 </div>
	</div>  
</form>

<?php 
	if (isset($_POST['ubah'])) {	
		$nama	= $_POST['nama'];
		$kode	= $_POST['kode'];
		$ubah	= $koneksi->query("UPDATE tb_kurikulum SET nama_kuri = '$nama' WHERE kode_kuri = '$kode'");
	
	if ($ubah) {
		
		echo "
				<script>
				    setTimeout(function() {
				        swal({
				            title: 'Selamat!',
				            text: 'Data Berhasil Diubah!',
				            type: 'success'
				        }, function() {
				            window.location = '?page=kurikulum';
				        });
				    }, 300);
				</script>
			";
		}
	}
?>



