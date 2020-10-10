<?php 
if($_SESSION['admin'] || $_SESSION['keuangan']){
?>

<?php
    $ambil = $koneksi->query("SELECT * FROM sk_master WHERE id_master='$_GET[id]'");
    $data  = $ambil->fetch_assoc();
	$koneksi->query("DELETE FROM sk_master WHERE id_master = '$_GET[id]'");
?>
<script>
    setTimeout(function() {
        sweetAlert({
            title: 'OKE!',
            text: 'Data Berhasil Dihapus!',
            type: 'error'
        }, function() {
            window.location = '?page=sk_master';
        });
    }, 300);
</script>

<?php
    }else{
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';
exit;
    }
?>   