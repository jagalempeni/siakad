<?php 
if($_SESSION['admin'] || $_SESSION['keuangan']){
?>


<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Data Mahasiswa</h3>
    </div>

    <div class="box-body">
        <table class="table table-bordered table-hover table-striped" id="dataTables-example">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Angkatan</th>
                    <th>Prodi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>

            <?php 

            	$no=1;

            	$sql = $koneksi->query("select * from tb_mahasiswa left join tb_jurusan on tb_mahasiswa.kode_jurusan = tb_jurusan.kode_jurusan ORDER by angkatan DESC");
            	while ($data=$sql->fetch_assoc()) {
       		
            	

             ?>

                <tr class="odd gradeX">
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $data['nim']; ?></td>
                    <td><?php echo $data['nama']; ?></td>
                    <td><?php echo $data['angkatan']; ?></td>   
                    <td><?php echo $data['nama_jurusan']; ?></td>                   

                    <td>
                    	<a href="?page=sk_master&aksi=mastermhs&id=<?php echo $data['angkatan']; ?>&nim=<?php echo $data['nim']; ?>&prodi=<?php echo $data['kode_jurusan']; ?>" class=" btn btn-flat btn-xs btn-info" ><i class="fa fa-edit"></i> Transaksi</a>

                    	<a href="?page=sk_transaksi&aksi=riwayat&id=<?php echo $data['nim']; ?>" class=" btn btn-flat btn-xs btn-success" ><i class="glyphicon glyphicon-list-alt"></i> Riwayat</a>
                    </td>
                </tr>

                <?php } ?>
            </tbody> 
        </table> 
    </div>
</div>

<?php
    }else{
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';
exit;
    }
?> 
        
     