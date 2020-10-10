<?php 
if($_SESSION['admin'] || $_SESSION['keuangan']){
?>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Data Master Keuangan</h3>
    </div>

    <div class="box-body">
        <table class="table table-bordered table-hover table-striped" id="dataTables-example">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Angkatan</th>
                    <th>Kode Prodi</th>
                    <th>Semester</th>
                    <th>Nama Pembayaran</th>
                    <th>Jumlah Pembayaran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>

            <?php 

            	$no=1;

            	$sql = $koneksi->query("select * from sk_master ORDER BY angkatan_bayar");
            	while ($data=$sql->fetch_assoc()) {

                 $jumlahbayar = $data['jumlah_bayar'];           		
            	

             ?>

                <tr class="odd gradeX">
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $data['angkatan_bayar']; ?></td>
                    <td><?php echo $data['kode_jurusan']; ?></td>
                    <td><?php echo $data['semester']; ?></td>
                    <td><?php echo $data['nama_bayar']; ?></td>
                    <td>Rp. <?= number_format($jumlahbayar, 0, ".", ".") ?></td>            

                    <td>
                    	<a href="?page=sk_master&aksi=ubah&id=<?php echo $data['id_master']; ?>" class=" btn btn-flat btn-xs btn-info" ><i class="fa fa-edit"></i> Ubah</a>

                    	<a onclick="return confirm('Yakin Akan Mengahapus Data Ini...???')" href="?page=sk_master&aksi=hapus&id=<?php echo $data['id_master']; ?>" class=" btn btn-flat btn-xs btn-danger" ><i class="fa fa-trash-o"></i> Hapus</a>
                    </td>
                </tr>

                <?php } ?>
            </tbody> 
        </table> 
    </div>

    <div class="box-footer">
        <a href="?page=sk_master&aksi=tambah" class=" btn btn-flat btn-sm btn-success btn-flat btn-sm" style="margin: 5px;"><i class="fa fa-plus"></i> Tambah Data</a>
    </div>
</div>

<?php
    }else{
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';
exit;
    }
?>   
        
     