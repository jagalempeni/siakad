<?php 
if($_SESSION['admin']){
?>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Setting Tahun Akademik</h3>
    </div>

    <div class="box-body">
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Tahun Akademik</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>

            <?php 

                $no=1;

                $sql = $koneksi->query("select * from tb_sett");
                while ($data=$sql->fetch_assoc()) {
                                  

             ?>

                <tr class="odd gradeX">
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $data['tahun_akad']; ?></td>
                    <td>
                        <a href="?page=tahun_akad&aksi=ubah_tahun" class=" btn btn-flat btn-sm btn-info" ><i class="fa fa-edit"></i> Edit</a>
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
        
     