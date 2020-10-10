<form method="POST">
	<div class="box box-primary">
		<div class="box-header with-border">
		  	<h3 class="box-title">Ubah Password</h3>
		</div>

		<div class="box-body">	
		    <div class="form-group">
		        <label>Password Lama :</label>
		        <input type="password" class="form-control" required name="plama" placeholder="Password Lama">
		    </div>

		     <div class="form-group">
		        <label>Password Baru :</label>
		        <input type="password" class="form-control" required name="pbaru" placeholder="Password Baru" >
		    </div>   
		</div>

		<div class="box-footer">
		     <input type="submit" name="simpan" value="Update" class="btn btn-flat btn-sm btn-primary">
			 <input type=button value=Kembali onclick=self.history.back() class="btn btn-flat btn-sm btn-info">  	
		</div>
	</div>
</form>

<?php 
if (isset($_POST['simpan'])) {
	$id    = $_GET['id'];
	$plama = $_POST['plama'];
	$pbaru = $_POST['pbaru'];
	$cek   = $koneksi->query("SELECT * FROM tb_user WHERE user_id = '$id' AND pass = '$plama'");
	$ketemu = $cek->num_rows;
	if ($ketemu == 0) {
		echo "
		<script>
		    setTimeout(function() {
		        sweetAlert({
		            title: 'Perhatian!',
		            text: 'Password Lama Salah',
		            type: 'error'
		        }, function() {
		            window.location = '?page=profile&aksi=ubahpass';
		        });
		    }, 300);
		</script>";
	} else{
		$simpan = $koneksi->query("UPDATE tb_user SET pass='$pbaru' WHERE user_id = '$id'");
	if ($simpan) {
		echo "
				<script>
				    setTimeout(function() {
				        swal({
				            title: 'Selamat!',
				            text: 'Ubah Password berhasil!',
				            type: 'success'
				        }, function() {
				            window.location = '?page=profile';
				        });
				    }, 300);
				</script>
		";
} } } ?>
                            