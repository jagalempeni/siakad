<form role="form" method="POST" enctype="multipart/form-data">
	<div class="box box-primary">
	   <div class="box-header with-border">
	     	<h3 class="box-title">Tambah Data Kurikulum</h3>
	   </div>
	   <div class="box-body">


		<div class="form-group">
		        <label>Kode Kurikulum</label>
		        <input class="form-control" required name="kode_kuri" placeholder="Masukan Kode Kurikulum">
		    </div>


		<div class="form-group">
		        <label>Nama Kurikulum</label>
		        <input class="form-control" required name="nama_kuri" placeholder="Masukan Nama Kurikulum">
		   </div>

		
		<div class="box-footer">

		    <input type="submit" name="simpan" value="Simpan" class="btn btn-flat btn-sm btn-primary">
		    <input type=button value=Kembali onclick=self.history.back() class="btn btn-flat btn-sm btn-info" />
		 </div>
	</div>  
</form>

<?php 
	if (isset($_POST['simpan'])) {
		
	
	$kode_kuri		= $_POST['kode_kuri'];
	$nama_kuri		= $_POST['nama_kuri'];
	$simpan			= $koneksi->query("INSERT INTO tb_kurikulum VALUES ('$kode_kuri', '$nama_kuri')");
	
	if ($simpan) {
		
		echo "
				<script>
				    setTimeout(function() {
				        swal({
				            title: 'Selamat!',
				            text: 'Data Berhasil Disimpan!',
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