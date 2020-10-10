<?php 
if($_SESSION['admin']){
?>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Data Program Studi</h3>
    </div>

    <div class="box-body">
        <table class="table table-bordered table-condensed" id="dataTables-example">
            <thead>
                <tr>
                	<th>No</th>
                	<th>Kode Prodi</th>
                    <th>Nama Prodi</th>
                    <th>Sebutan Lulusan</th>
                    <th>Kaprodi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            
            <tbody>
            <?php 
            	$no = 1;
            	$sql = $koneksi->query("SELECT * FROM tb_jurusan WHERE aktif=1");
            	while ($data = $sql->fetch_assoc()) {
             ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $data['kode_jurusan']; ?></td>
                    <td><?= $data['nama_jurusan']; ?></td>
                    <td><?= $data['sebutan_lulusan']; ?></td>
                    <td><?= $data['nama_kaprodi']; ?></td>
                    <td>
                    	<a href="?page=jurusan&aksi=ubah&id=<?= $data['kode_jurusan']; ?>" class=" btn btn-flat btn-xs btn-info" ><i class="fa fa-edit"></i> Ubah</a>

                    	<a onclick="return confirm('Yakin Akan Mengahapus Data Ini...???')" href="?page=jurusan&aksi=hapus&id=<?= $data['kode_jurusan']; ?>" class=" btn btn-flat btn-xs btn-danger" ><i class="fa fa-trash-o"></i> Hapus</a>
                    </td>
                </tr>
                <?php } ?>
             </tbody>
        </table>  
    </div>

    <div class="box-footer">
        <a href="?page=jurusan&aksi=tambah" class=" btn btn-flat btn-sm btn-success" style="margin-top: 8px;" ><i class="fa fa-plus"></i> Tambah Data</a>  
    </div>         
</div>

<?php
    }else{
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';
exit;
    }
?>