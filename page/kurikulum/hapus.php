<?php 
$id  = $_GET['id'];
$sql = $koneksi->query("DELETE FROM tb_kurikulum WHERE kode_kuri = '$id'");
?>
<script>
    setTimeout(function() {
      sweetAlert({
          title: 'OKE!',
          text: 'Data Berhasil Dihapus!',
          type: 'error'
      }, function() {
          window.location = '?page=kurikulum';
      });
    }, 300);
</script>