<?php
	$id    = $_GET['id'];
	$angkatan    = $_GET['angkatan'];
    $ambil = $koneksi->query("SELECT * FROM sk_kewajiban WHERE 
    	angkatan_bayar 	='$angkatan'");
    $data  = $ambil->fetch_assoc();

	$koneksi->query("UPDATE sk_kewajiban SET id_master = '$id'");
    $koneksi->query("UPDATE sk_master SET sinkron = 1 WHERE id_master='$id'");
?>
<script>
    setTimeout(function() {
        sweetAlert({
            title: 'OKE!',
            text: 'Data Berhasil Diperbaharui!',
            type: 'success'
        }, function() {
            window.location = '?page=sk_master';
        });
    }, 300);
</script>



<!-- SEBELUM EDIT -->