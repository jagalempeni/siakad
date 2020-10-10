<?php 
if($_SESSION['admin']){
?>

<?php 
	$nim    = $_GET['id'];
	$sql    = $koneksi->query("SELECT * from tb_sett");
	$tampil = $sql->fetch_assoc();
 ?>
<form method="POST" enctype="multipart/form-data">
	<div class="box box-primary">
	   <div class="box-header with-border">
	     	<h3 class="box-title">Setting Tahun Akademik</h3>
	   </div>
	   <div class="box-body">
	   <div class="form-group">
		        <label>Tahun Akademik</label>
		        <select class="form-control" name='tahun'>
				<option><?= $tampil['tahun_akad']; ?></option>
					<?php
					$tahun_akad = date("Y");
					for ($i=$tahun_akad;$i>=$tahun_akad-8;$i--) {
						echo "<option value='$i/".($i+1)."'>$i/".($i+1)."</option>";
					}
					?>
				</select>
		    </div>	    



		<div class="box-footer">
			<input type="submit" name="simpan" value="Ubah" class="btn btn-flat btn-primary">
			<input type=button value=Kembali onclick=self.history.back() class="btn btn-flat btn-info">
		</div>
	</div>
</form>    

<?php 
	if (isset($_POST['simpan'])) {
		$tahun    = $_POST['tahun'];
		
		$foto    = $_FILES['foto']['name'];
		$lokasi  = $_FILES['foto']['tmp_name'];

		if(!empty($lokasi)) {
			move_uploaded_file($lokasi, "img/".$foto);

			$koneksi->query("UPDATE  tb_sett SET  tahun_akad = '$tahun'");
				?>
			       <script>
					    setTimeout(function() {
					        swal({
					            title: "Selamat!",
					            text: "Data Berhasil Diubah!",
					            type: "success"
					        }, function() {
					            window.location = "?page=ubah_tahun";
					        });
					    }, 300);
					</script>
		      <?php  
		}else{
			$koneksi->query("UPDATE  tb_sett SET  tahun_akad = '$tahun'");
				?>
			         <script>
					    setTimeout(function() {
					        swal({
					            title: "Selamat!",
					            text: "Data Berhasil Diubah!",
					            type: "success"
					        }, function() {
					            window.location = "?page=ubah_tahun";
					        });
					    }, 300);
					</script>
		   <?php  
		}
	}
 ?>

 <?php
    }else{
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';
exit;
    }
?> 
