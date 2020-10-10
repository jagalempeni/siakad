<?php 
if($_SESSION['admin']){
?>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Data Mahasiswa</h3>
    </div>

    <div class="box-body">
        <table class="table table-bordered table-condensed" id="dataTables-example">
            <thead>
                <tr>
                    <th rowspan="2">NO</th>
                    <th rowspan="2">NIM</th>
                    <th rowspan="2">Nama</th>
                    <th rowspan="2">Prodi</th>
                    <th style="text-align:center;" colspan="2">Status</th>
                    <th style="text-align:center;" rowspan="2">Edit lock / unlock</th>
                </tr>
                <tr>
                    <td>KRS</td>
                    <td>KHS</td>
                </tr>
            </thead>
            <tbody>

            <?php 

                $no=1;

                $sql = $koneksi->query("select * from tb_mahasiswa left join tb_jurusan
                                        on tb_mahasiswa.kode_jurusan = tb_jurusan.kode_jurusan");
                while ($data=$sql->fetch_assoc()) {

                    $tbstatus = $data['krs'] ; 

                        if ($tbstatus == 1) {$statuskrs='<small class="label bg-green">Unlock</small>';}
                        if ($tbstatus == 0) {$statuskrs='<small class="label bg-red">Lock</small>';}

                    $tbstatus1 = $data['khs'] ; 

                        if ($tbstatus1 == 1) {$statuskhs='<small class="label bg-green">Unlock</small>';}
                        if ($tbstatus1 == 0) {$statuskhs='<small class="label bg-red">Lock</small>';}
                    
                

             ?>

                <tr class="odd gradeX">
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $data['nim']; ?></td>
                    <td><?php echo $data['nama']; ?></td>
                    <td><?php echo $data['nama_jurusan']; ?></td>
                    <td><?php echo $statuskrs; ?></td>
                    <td><?php echo $statuskhs; ?></td>

                    <td style="text-align:center;">
                        <a href="?page=lock_unlock&aksi=ubah_krs&id=<?php echo $data['nim']; ?>" class=" btn btn-flat btn-xs btn-info" ><i class="fa fa-edit"></i> KRS</a>

                        <a href="?page=lock_unlock&aksi=ubah_khs&id=<?php echo $data['nim']; ?>" class=" btn btn-flat btn-xs btn-success" ><i class="fa fa-edit"></i> KHS</a>
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