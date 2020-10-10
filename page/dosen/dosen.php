<?php 
if($_SESSION['admin']){
?>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Data Dosen</h3>
    </div>
    <div class="box-body">
        <table class="table table-bordered table-condensed" id="dataTables-example">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Dosen</th>
                    <th>Nama</th>
                    <th>Telpon</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <!-- <th>Foto</th> -->
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                $no  = 1;
                $sql = $koneksi->query("SELECT * FROM  tb_dosen");
                while ( $data = $sql->fetch_assoc() ) {
             ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $data['kode_dosen']; ?></td>
                    <td><?= $data['nama_dosen']; ?></td>
                    <td><?= $data['telpon']; ?></td>
                    <td><?= $data['email']; ?></td>
                    <td><?= $data['alamat']; ?></td>
                    <!-- <td><img src="img/<?= $data['foto']; ?>" alt="" width="40" height="40"></td> -->
                    <td>
                        <a href="?page=dosen&aksi=ubah&id=<?= $data['kode_dosen']; ?>" class=" btn btn-info btn-flat btn-xs" ><i class="fa fa-edit"></i> Ubah</a>
                        <a onclick="return confirm('Yakin Akan Mengahapus Data Ini...???')" href="?page=dosen&aksi=hapus&id=<?= $data['kode_dosen']; ?>" class=" btn btn-danger btn-flat btn-xs" ><i class="fa fa-trash-o"></i> Hapus</a>

                        <a href="?page=dosen&aksi=detail&id=<?php echo $data['kode_dosen']; ?>" class=" btn btn-flat btn-xs btn-success" ><i class="glyphicon glyphicon-list-alt"></i> Detail</a>
                    </td>
                </tr>
                <?php } ?>
             </tbody>
        </table> 
    </div>
    <div class="box-footer">
        <a href="?page=dosen&aksi=tambah" class=" btn btn-success btn-flat btn-sm" style="margin: 5px;" ><i class="fa fa-plus"></i> Tambah Data</a> 
        <a href="page/dosen/eksport_dosen.php" class="btn btn-flat btn-sm btn-warning btn-flat btn-sm" style="margin: 5px;"><i class="glyphicon glyphicon-download"></i> Eksport Data</a>
        
        <a href="index.php?page=dosen&aksi=import_dosen" class="btn btn-flat btn-sm btn-warning btn-flat btn-sm" style="margin: 5px;"><i class="glyphicon glyphicon-upload"></i> Import Data</a> 

        <a onclick="return confirm('Yakin Akan Mengahapus Semua Data Ini...???')" href="index.php?page=dosen&aksi=refresh" class="btn btn-flat btn-sm btn-danger btn-flat btn-sm" style="margin: 5px;"><i class="glyphicon glyphicon-trash"></i> Hapus Semua</a>
    </div>
</div>      

<?php
    }else{
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';
exit;
    }
?>    