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
                    <th>Matakuliah</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>

            <?php 

            	$no=1;

            	$sql = $koneksi->query("select * from tb_krs inner join tb_mahasiswa ON tb_krs.nim = tb_mahasiswa.nim inner join tb_matkul on tb_krs.kode_mk = tb_matkul.kode_mk WHERE tb_krs.tahun_akad = '$tahunakad'");
            	while ($data=$sql->fetch_assoc()) {
            		
            	

             ?>

                <tr class="odd gradeX">
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $data['nim']; ?></td>
                    <td><?php echo $data['nama']; ?></td>
                    <td><?php echo $data['angkatan']; ?></td>
                    <td><?php echo $data['nama_mk']; ?></td>

                    <td>
                    	<a href="?page=krs_admin&aksi=ubah&id=<?php echo $data['kode']; ?>" class=" btn btn-flat btn-xs btn-info" ><i class="fa fa-edit"></i> Ubah</a>

                    	<a onclick="return confirm('Yakin Akan Mengahapus Data Ini...???')" href="?page=krs_admin&aksi=hapus&id=<?php echo $data['kode']; ?>" class=" btn btn-flat btn-xs btn-danger" ><i class="fa fa-trash-o"></i> Hapus</a>

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
        
     