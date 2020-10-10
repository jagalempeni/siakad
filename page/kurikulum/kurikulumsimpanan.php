<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Data kurikulum</h3>
    </div>

    <div class="box-body">
        <table class="table table-bordered table-condensed" id="dataTables-example">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama Kurikulum</th>
                    <th>SKS Wajib</th>
                    <th>SKS Pilihan</th>
                    <th>Jumlah SKS</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>

            <?php 

            	$no=1;

            	$sql = $koneksi->query("select * from tb_kurikulum inner join tb_jurusan
            							on tb_kurikulum.kode_jurusan = tb_jurusan.kode_jurusan");
            	while ($data=$sql->fetch_assoc()) {
            		
            	

             ?>

                <tr class="odd gradeX">                    
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
                    <td><?php echo $data['alamat']; ?></td>
                    <td><?php echo $data['nama_jurusan']; ?></td>

                    <td>
                    	<a href="?page=kurikulum&aksi=ubah&id=<?php echo $data['nim']; ?>" class=" btn btn-flat btn-sm btn-info" ><i class="fa fa-edit"></i> Ubah</a>

                    	<a onclick="return confirm('Yakin Akan Mengahapus Data Ini...???')" href="?page=kurikulum&aksi=hapus&id=<?php echo $data['nim']; ?>" class=" btn btn-flat btn-sm btn-danger" ><i class="fa fa-trash-o"></i> Hapus</a>

                    	<a href="?page=kurikulum&aksi=detail&id=<?php echo $data['nim']; ?>" class=" btn btn-flat btn-sm btn-success" ><i class="glyphicon glyphicon-list-alt"></i> Detail</a>
                    </td>
                </tr>

                <?php } ?>
            </tbody> 
        </table> 
    </div>

    <div class="box-footer">
        <a href="?page=kurikulum&aksi=tambah" class=" btn btn-flat btn-sm btn-success btn-flat btn-sm" style="margin: 5px;"><i class="fa fa-plus"></i> Tambah Data</a>

       
    </div>
</div>
        
     