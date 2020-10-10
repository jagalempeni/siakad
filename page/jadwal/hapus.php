<?php 
if($_SESSION['admin']){
?>

<?php 
$id  = $_GET['id'];
$sql = $koneksi->query("DELETE FROM tb_jadwal WHERE id = '$id'");
?>
<script>
   setTimeout(function() {
      sweetAlert({
         title: 'OKE!',
         text: 'Data Berhasil Dihapus!',
         type: 'error'
      }, function() {
         window.location = '?page=jadwal';
      });
   }, 300);
</script>

<?php
    }else{
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';
exit;
    }
?> 