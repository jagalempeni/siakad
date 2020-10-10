<?php 
if($_SESSION['admin']){
?>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Data Mahasiswa</h3>
    </div>

    <div class="box-body">
        <table class="table table-bordered table-hover table-striped" id="dataTables-example">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Prodi</th>
                    <th width="30px">Angkatan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>

            <?php 

            	$no=1;

            	$sql = $koneksi->query("select * from tb_mahasiswa left join tb_jurusan
            							on tb_mahasiswa.kode_jurusan = tb_jurusan.kode_jurusan ORDER by angkatan DESC");
            	while ($data=$sql->fetch_assoc()) {

                 $tbstatus = $data['status'] ; 

                        if ($tbstatus == 1) {$status='<small class="label bg-green">Aktif</small>';}
                        if ($tbstatus == 0) {$status='<small class="label bg-red">Tidak Aktif</small>';}           		
            	

             ?>

                <tr class="odd gradeX">
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $data['nim']; ?></td>
                    <td><?php echo $data['nama']; ?></td>
                    <td>
                    	<?php 

                    		if ($data['jenis_kelamin']=="L") {
                    			echo "Laki-laki";
                    		}else{
                    			echo "Perempuan";
                    		}

                    	 ?>
                    </td>
                    <td><?php echo $data['nama_jurusan']; ?></td>
                    <td><?php echo $data['angkatan']; ?></td>
                    <td><?php echo $status; ?></td>

                    <td>
                    	<a href="?page=mahasiswa&aksi=ubah&id=<?php echo $data['nim']; ?>" class=" btn btn-flat btn-xs btn-info" ><i class="fa fa-edit"></i> Ubah</a>

                    	<a onclick="return confirm('Yakin Akan Mengahapus Data Ini...???')" href="?page=mahasiswa&aksi=hapus&id=<?php echo $data['nim']; ?>" class=" btn btn-flat btn-xs btn-danger" ><i class="fa fa-trash-o"></i> Hapus</a>

                    	<a href="?page=mahasiswa&aksi=detail&id=<?php echo $data['nim']; ?>" class=" btn btn-flat btn-xs btn-success" ><i class="glyphicon glyphicon-list-alt"></i> Detail</a>
                    </td>
                </tr>

                <?php } ?>
            </tbody> 
        </table> 
    </div>

    <div class="box-footer">
        <a href="?page=mahasiswa&aksi=tambah" class=" btn btn-flat btn-sm btn-success btn-flat btn-sm" style="margin: 5px;"><i class="fa fa-plus"></i> Tambah Data</a>

        <a href="page/mahasiswa/eksport_mhs.php" class="btn btn-flat btn-sm btn-warning  btn-flat btn-sm" style="margin: 5px;"><i class="glyphicon glyphicon-download"></i> Eksport Data</a>
        
        <a href="index.php?page=mahasiswa&aksi=import_mhs" class="btn btn-flat btn-sm btn-warning btn-flat btn-sm" style="margin: 5px;"><i class="glyphicon glyphicon-upload"></i> Import Data</a>

        <a onclick="return confirm('Yakin Akan Mengahapus Semua Data Ini...???')" href="index.php?page=mahasiswa&aksi=refresh" class="btn btn-flat btn-sm btn-danger btn-flat btn-sm" style="margin: 5px;"><i class="glyphicon glyphicon-trash"></i> Hapus Semua</a>
    </div>
</div>

<?php
    }else{
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';
exit;
    }
?>     
     