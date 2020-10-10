<?php 		
$id   = $_GET['id'];
$sql  = $koneksi->query("SELECT * FROM tb_user WHERE id = '$id'");
$data = $sql->fetch_assoc();
?>
 
<form method="POST">
    <div class="box box-primary">
       <div class="box-header with-border">
          <h3 class="box-title">Ubah Data Password</h3>
       </div>

       <div class="box-body">
         <div class="form-group">
             <label>Password Default</label>
             <input type="text" placeholder="masukan password default" class="form-control" required name="pass">
         </div>
    </div>

       <div class="box-footer">
        <input type="submit" name="ubah" value="Simpan" class="btn btn-flat btn-sm btn-primary">
          <input type=button value="Kembali" onclick="self.history.back()" class="btn btn-flat btn-sm btn-info">
       </div>
    </div>
</form>
<?php 
  if (isset($_POST['ubah'])) {  
        $pass    = $_POST['pass'];
        $ubah    = $koneksi->query("UPDATE tb_user SET  pass = '$pass'");

    if ($ubah) {
      echo "
          <script>
              setTimeout(function() {
                  swal({
                      title: 'Selamat!',
                      text: 'Password Default Berhasil Diubah!',
                      type: 'success'
                  }, function() {
                      window.location = '?page=user';
                  });
              }, 300);
          </script>
      ";
    } else{
            mysqli_error($koneksi); 
        }
  }
?>
                            