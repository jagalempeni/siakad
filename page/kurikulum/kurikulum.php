<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Data kurikulum</h3>
    </div>

    <div class="box-body">
        <table class="table table-bordered table-condensed" id="dataTables-example">
            <thead>
                <tr>
					<th>No.</th>
                    <th>Kode Kurikulum</th>
                    <th>Nama Kurikulum</th>                    
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
			
			<?php 

            	$no=1;
            	$sql = $koneksi->query("select * from tb_kurikulum");
            	while ($data=$sql->fetch_assoc()) {
			?>
				<tr>
            		<td><?= $no++; ?></td>
                    <td><?= $data['kode_kuri']; ?></td>
                    <td><?= $data['nama_kuri']; ?></td>                     
                    <td><a href="?page=kurikulum&aksi=ubah&id=<?= $data['kode_kuri']; ?>" class=" btn btn-info btn-flat btn-sm" ><i class="fa fa-edit"></i> Ubah</a>
                        <a onclick="return confirm('Yakin Akan Mengahapus Data Ini...???')" href="?page=kurikulum&aksi=hapus&id=<?= $data['kode_kuri']; ?>" class=" btn btn-danger btn-flat btn-sm" ><i class="fa fa-trash"></i> Hapus</a>
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
        
     