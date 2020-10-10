<?php 
if($_SESSION['admin']){
?>

    <div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Data User</h3>
    </div>

    <div class="box-body">
        <table class="table table-bordered table-condensed" id="dataTables-example">
            <thead>
                <tr>
                	<th>No</th>
                	<th>User ID</th>
                    <th>Nama</th>
                    <th>Level</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            
            <tbody>
            <?php 
            	$no = 1;
            	$sql = $koneksi->query("SELECT * FROM tb_user");
            	while ($data = $sql->fetch_assoc()) {
             ?>
                <tr>                    
                    <td><?= $no++; ?></td>
                    <td><?= $data['id']; ?></td>
                    <td><?= $data['nama']; ?></td>
                    <td><?= $data['level']; ?></td>
                    <td>
                    	<a href="?page=user&aksi=ubah&id=<?= $data['id']; ?>" class=" btn btn-flat btn-sm btn-info" ><i class="fa fa-edit"></i> Edit User</a>
                    </td>
                </tr>
                <?php } ?>
             </tbody>
        </table>  

        
        <div class="box-footer"> 
    </div>
    </div>
         
</div>

<?php
    }else{
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';
exit;
    }
?> 