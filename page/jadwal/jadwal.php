<?php 
if($_SESSION['admin']){
?>

<?php
$sql3 = $koneksi->query("SELECT * FROM tb_sett");
$data3 = $sql3->fetch_assoc();
?>

<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Data Jadwal Perkuliahan</h3><br>Tahun Akademik <b><?=$data3 ['tahun_akad']?></b>
  </div>

  <div class="box-body">
        <table class="table table-condensed table-bordered" id="dataTables-example">
            <thead>
                <tr>
                	<th>No</th>
                    <th>Prodi</th>
                    <th>Kelas</th>
                    <th>Semester</th>
                    <th>Matakuliah</th>                    
                    <th>Ruang</th>
                    <th>Hari</th>                   
                    <th>Jam</th>
                    <th>Dosen</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>

            <?php
            $no=1;
            $tahun_akad = $data3 ['tahun_akad'];
            $sql = $koneksi->query("SELECT * FROM tb_jadwal left join tb_matkul on tb_jadwal.kode_mk =  tb_matkul.kode_mk left join tb_ruang on tb_jadwal.kode_ruang = tb_ruang.kode_ruang left join tb_dosen on tb_jadwal.kode_dosen = tb_dosen.kode_dosen WHERE   
                tb_jadwal.kode_mk = tb_matkul.kode_mk	AND
                tb_jadwal.tahun_akad = '$tahun_akad' AND
                tb_jadwal.kode_ruang = tb_ruang.kode_ruang AND
                tb_jadwal.kode_dosen = tb_dosen.kode_dosen
                ORDER BY kode_jurusan ASC, kelas ASC, smester ASC, nama_mk ASC");
            while ($data=$sql->fetch_assoc()) { ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $data['kode_jurusan']; ?></td>
                    <td><?= $data['kelas']; ?></td>
                    <td><?= $data['smester']; ?></td>
                    <td><?= $data['nama_mk']; ?></td>
                    <td><?= $data['nama_ruang']; ?></td>
                    <td><?= $data['nama_hari']; ?></td>                    
                    <td><?= date('G:i', strtotime($data['jam_mulai'])).'&nbsp; - &nbsp;'.date('G:i', strtotime($data['jam_selesai'])).'&nbsp; Wib'; ?></td>
                    <td><?= $data['nama_dosen']; ?></td>
                    <td>
                    	<a href="?page=jadwal&aksi=ubah&id=<?= $data['id']; ?>" class=" btn btn-flat btn-xs btn-info" ><i class="fa fa-edit"></i> Ubah</a>

                    	<a onclick="return confirm('Yakin Akan Mengahapus Data Ini...???')" href="?page=jadwal&aksi=hapus&id=<?= $data['id']; ?>" class=" btn btn-flat btn-xs btn-danger" ><i class="fa fa-trash"></i> Hapus</a>
                    </td>
                </tr>
                <?php } ?>
             </tbody>
        </table>
    </div>

    <div class="box-footer">
        <a href="?page=jadwal&aksi=tambah" class=" btn btn-flat btn-sm btn-success" style="margin-top: 8px;" ><i class="fa fa-plus"></i> Tambah Data</a>
    </div>
</div>

<?php
    }else{
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';
exit;
    }
?> 
