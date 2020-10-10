<?php
	$nim = $_GET['id']; 
	$sql = $koneksi->query("SELECT * FROM tb_mahasiswa WHERE nim = '$nim'");
	$tampil = $sql->fetch_assoc();
?>

<form method="POST" enctype="multipart/form-data">
	<div class="box box-primary">
	   <div class="box-header with-border">
	     <h3 class="box-title">Ubah Smester</h3>
	   </div>
		
		<div class="box-body">
			<div class="form-group">
			     <label>Smester :</label>
			     <select class="form-control" required name="smester">

				     <option>-Pilih Smester-</option>
				     <option value="1" <?php if( $tampil['smester'] == '1'){echo "selected"; } ?>>1</option>
				     <option value="2" <?php if( $tampil['smester'] == '2'){echo "selected"; } ?>>2</option>
				     <option value="3" <?php if( $tampil['smester'] == '3'){echo "selected"; } ?>>3</option>
				     <option value="4" <?php if( $tampil['smester'] == '4'){echo "selected"; } ?>>4</option>
				     <option value="5" <?php if( $tampil['smester'] == '5'){echo "selected"; } ?>>5</option>
				     <option value="6" <?php if( $tampil['smester'] == '6'){echo "selected"; } ?>>6</option>
				     <option value="7" <?php if( $tampil['smester'] == '7'){echo "selected"; } ?>>7</option>
				     <option value="8" <?php if( $tampil['smester'] == '8'){echo "selected"; } ?>>8</option>
			     </select>
			 </div>
		</div>

		<div class="box-footer">
			<input type="submit" name="simpan" value="Ubah" class="btn btn-sm btn-flat btn-primary">
			<input type=button value=Kembali onclick=self.history.back() class="btn btn-sm btn-flat btn-info">
		</div>
	</div>
</form>
<?php 

if (isset($_POST['simpan'])) {
	$smester   = $_POST['smester'];
	$sql       = $koneksi->query("UPDATE tb_mahasiswa SET smester = '$smester' WHERE nim = '$nim'");
	$ubah_stts = $koneksi->query("UPDATE tb_mahasiswa SET status_krs = 1 WHERE nim = '$nim'");
?>
		<script>
			setTimeout(function() {
			swal({
			   title: "Selamat!",
			   text: "Ubah Smester Berhasil !",
			   type: "success"
			}, function() {
			   window.location = "?page=profile";
			});
			}, 300);
		</script>
<?php  } ?>



