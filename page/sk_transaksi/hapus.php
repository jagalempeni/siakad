<?php
    $ambil = $koneksi->query("SELECT * FROM tb_mahasiswa WHERE nim='$_GET[id]'");
    $data  = $ambil->fetch_assoc();
 //    $foto  = $data['foto'];
	// if (file_exists("img/$foto")) {
	// 	unlink("img/$foto");
	// }
	$koneksi->query("DELETE FROM tb_mahasiswa WHERE nim = '$_GET[id]'");
	$koneksi->query("DELETE FROM tb_user WHERE id = '$_GET[id]'");
?>
<script>
    setTimeout(function() {
        sweetAlert({
            title: 'OKE!',
            text: 'Data Berhasil Dihapus!',
            type: 'error'
        }, function() {
            window.location = '?page=mahasiswa';
        });
    }, 300);
</script>