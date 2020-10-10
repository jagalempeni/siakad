<?php 
if($_SESSION['admin']){
?>

<?php 		
$id   = $_GET['id'];
$sql  = $koneksi->query("DELETE FROM tb_jurusan WHERE kode_jurusan ='$id'");
?>
<script>
	setTimeout(function() {
	  sweetAlert({
			title: 'OKE!',
			text: 'Data Berhasil Dihapus!',
			type: 'error'
	  }, function() {
	      window.location = '?page=jurusan';
	  });
	}, 300);
</script>

<?php
    }else{
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';
exit;
    }
?>