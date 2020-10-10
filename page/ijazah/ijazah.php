<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Data Transkrip Mahasiswa</h3>
    </div>

    <div class="box-body">
        <table class="table table-bordered table-condensed table-striped" id="dataTables-example">
            <thead>
                <tr>
                	<th>No</th>
                	<th>NIM</th>
                    <th>Nama</th>
                    <th>Angkatan</th>
                    <th>No.Ijazah</th>
                    <th>Judul Tugas Akhir</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            
            <tbody>
            <?php 

                $no=1;

                $sql = $koneksi->query("select * from tb_mahasiswa");
                while ($data=$sql->fetch_assoc()) {
                    
                

             ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $data['nim']; ?></td>
                    <td><?= $data['nama']; ?></td>
                    <td><?= $data['angkatan']; ?></td>
                    <td><?= $data['no_ijazah']; ?></td>
                    <td><?= $data['judul_skripsi']; ?></td>
                    <td>
                    	<a href="?page=ijazah&aksi=ubah&id=<?php echo $data['nim']; ?>" class=" btn btn-flat btn-xs btn-success" ><i class="fa fa-edit"></i> Masukan Data</a>


                        
                    
                    </td>
                </tr>
                <?php } ?>
             </tbody>
        </table>  
    </div>

     <div class="box-footer">
        <a href="page/ijazah/eksport_tr.php" class="btn btn-flat btn-sm btn-warning  btn-flat btn-sm" style="margin: 5px;"><i class="glyphicon glyphicon-download"></i> Eksport Data</a>
        
    </div>

</div>