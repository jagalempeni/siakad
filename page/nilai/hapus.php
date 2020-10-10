<?php 
if($_SESSION['admin']){
?>

<?php
    $ambil = $koneksi->query("SELECT * FROM tb_nilai WHERE kode_mk='$_GET[id]'");
    $data  = $ambil->fetch_assoc();
 //    $foto  = $data['foto'];
	// if (file_exists("img/$foto")) {
	// 	unlink("img/$foto");
	// }
	$koneksi->query("DELETE FROM tb_nilai WHERE kode_mk = '$_GET[id]'");
//	$koneksi->query("DELETE FROM tb_user WHERE id = '$_GET[id]'");
?>
<script>
    setTimeout(function() {
        sweetAlert({
            title: 'OKE!',
            text: 'Data Berhasil Dihapus!',
            type: 'error'
        }, function() {
            window.location = '?page=nilai';
        });
    }, 300);
</script>

<?php
    }else{
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';
exit;
    }
?>