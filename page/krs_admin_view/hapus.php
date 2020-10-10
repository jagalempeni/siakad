<?php 
if($_SESSION['admin']){
?>

<?php
    $kode    = $_GET['id'];
    $kode1    = $_GET['id1'];
   
    $koneksi->query("DELETE FROM tb_krs WHERE kode = $kode");
if ($koneksi) {
echo"
<script>
    setTimeout(function() {
        sweetAlert({
            title: 'OKE!',
            text: 'Data Berhasil Dihapus!',
            type: 'error'
        }, function() {
            window.location = '?page=krs_admin_view&aksi=detail&id=$kode1';
        });
    }, 300);
</script>";
}
?>

<?php
    }else{
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';
exit;
    }
?>   