<?php 
$koneksi->query("DELETE FROM tb_mahasiswa");
$koneksi->query("DELETE FROM tb_user WHERE level = 'mahasiswa'");


?>
<script>
	setTimeout(function() {
	  sweetAlert({
	      title: 'OKE!',
	      text: 'Semua Data Terhapus!',
	      type: 'error'
	  }, function() {
	      window.location = '?page=mahasiswa';
	  });
	}, 300);
</script>