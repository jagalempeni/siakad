<?php 
if($_SESSION['admin']){
?>

<?php
$nim    = $_GET['id'];
$sql3 = $koneksi->query("SELECT * FROM tb_sett");
$data3 = $sql3->fetch_assoc();
$tahunakad = $data3 ['tahun_akad'];

$sql    = $koneksi->query("SELECT * from tb_mahasiswa WHERE tb_mahasiswa.nim = '$nim'");
    $tampil = $sql->fetch_assoc();
 ?>
<form method="POST" enctype="multipart/form-data">
    <div class="box box-primary">
       <div class="box-header with-border">
            <h3 class="box-title">Ubah Data KRS Mahasiswa</h3>
       </div>
       <div class="box-body">
            <div class="form-group">
              <label>Nim</label>
              <input class="form-control" required name="nim" value="<?= $tampil['nim']; ?>" readonly>
            </div>

            <div class="form-group">
              <label>Nama</label>
              <input class="form-control" required name="nama" value="<?= $tampil['nama']; ?>" readonly>
            </div>

    <div class="box-body">
        <table class="table table-bordered table-hover table-striped" id="dataTables-example">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Kode Matakuliah</th>
                    <th>Nama Matakuliah</th>
                    <th>Semester</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>

            <?php 

                $no=1;

                $sql = $koneksi->query("select * from tb_krs inner join tb_mahasiswa ON tb_krs.nim = tb_mahasiswa.nim inner join tb_matkul on tb_krs.kode_mk = tb_matkul.kode_mk WHERE tb_krs.nim = '$nim'");
                while ($data=$sql->fetch_assoc()) {
                    
                

             ?>

                <tr class="odd gradeX">
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $data['kode_matkul']; ?></td>
                    <td><?php echo $data['nama_mk']; ?></td>
                    <td><?php echo $data['smester']; ?></td>

                    <td>
                        <!-- <a href="?page=krs_admin_view&aksi=ubah&id=<?php echo $data['kode']; ?>" class=" btn btn-flat btn-xs btn-info" ><i class="fa fa-edit"></i> Ubah</a> -->

                        <a onclick="return confirm('Yakin Akan Mengahapus Data Ini...???')" href="?page=krs_admin_view&aksi=hapus&id=<?php echo $data['kode']; ?>&id1=<?php echo $tampil['nim']; ?>" class=" btn btn-flat btn-xs btn-danger" ><i class="fa fa-trash-o"></i> Hapus</a>

                    </td>
                </tr>

                <?php } ?>
            </tbody> 
        </table> 
    </div>

    <input type=button value=Kembali onclick="self.history.back()" class="btn btn-info btn-flat btn-sm" style="margin-top: 10px;" >
</div>
        
<?php
    }else{
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';
exit;
    }
?>   