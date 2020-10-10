<?php 
if($_SESSION['admin']){
?>

<?php 
$koneksi->query("DELETE FROM tb_dosen");
$koneksi->query("DELETE FROM tb_user WHERE level = 'dosen'");


?>
<script>
	setTimeout(function() {
	  sweetAlert({
	      title: 'OKE!',
	      text: 'Semua Data Terhapus!',
	      type: 'error'
	  }, function() {
	      window.location = '?page=dosen';
	  });
	}, 300);
</script>

<?php
    }else{
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';
exit;
    }
?> 