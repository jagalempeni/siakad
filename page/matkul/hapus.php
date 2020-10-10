<?php 
if($_SESSION['admin']){
?>

<?php 
$id  = $_GET['id'];
$sql = $koneksi->query("DELETE FROM tb_matkul WHERE kode_mk = '$id'");
?>
<script>
	setTimeout(function() {
	  sweetAlert({
	      title: 'OKE!',
	      text: 'Data Berhasil Dihapus!',
	      type: 'error'
	  }, function() {
	      window.location = '?page=matkul';
	  });
	}, 300);
</script>

<?php
    }else{
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';
exit;
    }
?> 