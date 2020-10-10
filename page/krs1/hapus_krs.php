<?php 
$id  = $_GET['id'];
$sql = $koneksi->query("DELETE FROM tb_krs WHERE kode = '$id'");
?>
<script>
    setTimeout(function() {
        sweetAlert({
            title: 'OKE!',
            text: 'Data Berhasil Dihapus!',
            type: 'error'
        }, function() {
            window.location = "?page=krs&aksi=lihat&smester=<?= $smester;?>";
        });
    }, 300);
</script>