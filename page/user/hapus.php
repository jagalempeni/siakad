<?php       
$id   = $_GET['id'];
$sql  = $koneksi->query("DELETE FROM tb_user WHERE id ='$id'");
?>
<script>
    setTimeout(function() {
      sweetAlert({
            title: 'OKE!',
            text: 'Data Berhasil Dihapus!',
            type: 'error'
      }, function() {
          window.location = '?page=user';
      });
    }, 300);
</script>