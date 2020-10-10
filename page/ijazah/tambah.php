<form method="POST">
 	<div class="box box-primary">
	   <div class="box-header with-border">
	      <h3 class="box-title">Tambah Data Ijazah</h3>
	   </div>

	   <div class="box-body">
          <div class="form-group">
		           <label>Nama</label>
		           <select class="form-control" required name="jurusan">

		           <option>-Pilih Nama-</option>}
		           option
		               <?php 

		               	$sql = $koneksi->query("select * from tb_mahasiswa");
		               	while ($data=$sql->fetch_assoc()) {
		               		echo "

		               			<option value='$data[nim]'>$data[nama]</option>

		               		";
		               	}
		                ?>
		           </select>
		       </div>

         <div class="form-group">
            <label>No. Ijazah</label>
            <input type="text" class="form-control" required name="no_ijazah">
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
		$kode    = $_POST['no.ijazah'];		
		$simpan  = $koneksi->query("INSERT INTO tb_mahasiswa VALUES ('$no.ijazah')");
		if ($simpan) {
			echo "
				<script>
				    setTimeout(function() {
				        swal({
				            title: 'Selamat!',
				            text: 'Data Berhasil Disimpan!',
				            type: 'success'
				        }, function() {
				            window.location = '?page=ijazah';
				        });
				    }, 300);
				</script>
			";
		}
	}
?>
                            