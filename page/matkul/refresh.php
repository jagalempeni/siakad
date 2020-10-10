<?php 
if($_SESSION['admin']){
?>

<?php 
$idp  = $_GET['idp'];
$sql = $koneksi->query ("DELETE FROM tb_matkul");


?>
<script>
	setTimeout(function() {
	  sweetAlert({
	      title: 'OKE!',
	      text: 'Semua Data Terhapus!',
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