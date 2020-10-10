<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Data Matasdakuliah</h3>
    </div>

    <div class="box-body">
        <table class="table table-bordered table-bordered table-striped table-hover" id="dataTables-example">
            <thead>
                <tr>
                	<th>No</th>
                	<th>Kode Mata Kuliah</th>
                    <th>Mata Kuliah</th>
                    <th>SKS</th>
                    <th>Prodi</th>
                    <th>Semester</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            
            <tbody>
            <?php 
            	$no = 1;
            	$sql = $koneksi->query("SELECT * FROM  tb_matkul inner join tb_jurusan on tb_matkul.kode_jurusan = tb_jurusan.kode_jurusan ORDER BY kode_mk ASC") ;
            	while ($data=$sql->fetch_assoc()) {
             ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $data['kode_mk']; ?></td>
                    <td><?= $data['nama_mk']; ?></td>
                    <td><?= $data['sks']; ?></td>
                    <td><?= $data['nama_jurusan']; ?></td>
                    <td><?= $data['smester']; ?></td>
                   
                    <td>
                    	<a href="?page=matkul&aksi=ubah&id=<?= $data['kode_mk']; ?>" class=" btn btn-flat btn-sm btn-info" ><i class="fa fa-edit"></i> Ubah</a>

                    	<a onclick="return confirm('Yakin Akan Mengahapus Data Ini...???')" href="?page=matkul&aksi=hapus&id=<?= $data['kode_mk']; ?>" class=" btn btn-flat btn-sm btn-danger" ><i class="fa fa-trash"></i> Hapus</a>
                    </td>
                </tr>

                <?php } ?>

             </tbody>

        </table>  
    </div>

    <div class="box-footer">
        <a href="?page=matkul&aksi=tambah" class=" btn btn-flat btn-sm btn-success" style="margin-top: 8px;" ><i class="fa fa-plus"></i> Tambah Data</a> 
         
        <a href="page/matkul/eksport_matkul.php" class="btn btn-flat btn-sm btn-warning btn-flat btn-sm" style="margin-top: 8px;" ><i class="glyphicon glyphicon-download"></i> Eksport Data</a>
        
        <a href="index.php?page=matkul&aksi=import_matkul" class="btn btn-flat btn-sm btn-warning btn-flat btn-sm" style="margin-top: 8px;" ><i class="glyphicon glyphicon-upload"></i> Import Data</a>
    </div>         
</div>