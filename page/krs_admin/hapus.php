<?php
    $kode    = $_GET['id'];
   
    $koneksi->query("DELETE FROM tb_krs WHERE kode = $kode");
?>
<script>
    setTimeout(function() {
        sweetAlert({
            title: 'OKE!',
            text: 'Data Berhasil Dihapus!',
            type: 'error'
        }, function() {
            window.location = '?page=krs_admin&aksi=detail&id=<?= $nim; ?>';
        });
    }, 300);
</script>