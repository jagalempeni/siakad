<?php 
if($_SESSION['admin']){
?>

<?php
$sql3 = $koneksi->query("SELECT * FROM tb_sett");
$data3 = $sql3->fetch_assoc();

$tahunakad = $data3 ['tahun_akad'];
?>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Data KRS Mahasiswa</h3><br>Tahun Akademik <b><?php echo $tahunakad?></b>
    </div>

    <div class="box-body">
        <table class="table table-bordered table-hover table-striped" id="dataTables-example">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Angkatan</th>
                    <th>Prodi</th>
                    <th>Semester</th>
                    <th>Status KRS</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>

            <?php 

            	$no=1;

            	$sql = $koneksi->query("select * from tb_mahasiswa left join tb_jurusan
                                        on tb_mahasiswa.kode_jurusan = tb_jurusan.kode_jurusan ORDER by nim ASC");
            	while ($data=$sql->fetch_assoc()) {

                    $tbstatus = $data['status_krs'] ; 

                        if ($tbstatus == 0) {$statuskrs='<small class="label bg-green">Selesai</small>';}
                        if ($tbstatus == 1) {$statuskrs='<small class="label bg-red">Belum Selesai</small>';}
            	

             ?>

                <tr class="odd gradeX">
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $data['nim']; ?></td>
                    <td><?php echo $data['nama']; ?></td>
                    <td><?php echo $data['angkatan']; ?></td>
                    <td><?php echo $data['nama_jurusan']; ?></td>
                    <td><?php echo $data['smester']; ?></td>
                    <td><?php echo $statuskrs; ?></td>

                    <td>
                    	<a href="?page=krs_admin_view&aksi=detail&id=<?php echo $data['nim']; ?>" class=" btn btn-flat btn-xs btn-warning" ><i class="fa fa-edit"></i> Detail</a>

                    </td>
                </tr>

                <?php } ?>
            </tbody> 
        </table> 
    </div>

    <div class="box-footer">
        <input type=button value=Kembali onclick="self.history.back()" class="btn btn-info btn-flat btn-sm" style="margin-top: 10px;" >
    </div>
</div>

<?php
    }else{
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';
exit;
    }
?>     
        
     