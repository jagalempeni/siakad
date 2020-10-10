<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Data Jadwal</h3>
  </div>

  <div class="box-body">
        <table class="table table-condensed table-bordered" id="dataTables-example">
            <thead>
                <tr>
                	<th>No</th>
                    <th>Kode Matkul</th>
                    <th>Mata Kuliah</th>
                    <th>Kelas</th>
                    <th>Prodi</th>
                    <th>Semester</th>                    
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
            $sql = $koneksi->query("SELECT * FROM tb_jadwal, tb_matkul, tb_ruang, tb_dosen, tb_jurusan WHERE   
                tb_jadwal.kode_mk = tb_matkul.kode_mk	AND
                tb_jadwal.kode_ruang = tb_ruang.kode_ruang AND
                tb_matkul.kode_jurusan = tb_jurusan.kode_jurusan AND
                tb_jadwal.kode_dosen = tb_dosen.kode_dosen");
            while ($data=$sql->fetch_assoc()) { ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $data['kode_mk']; ?></td>
                    <td><?= $data['nama_mk']; ?></td>
                    <td><?= $data['kelas']; ?></td>
                    <td><?= $data['nama_jurusan']; ?></td>
                    <td><?= $data['smester']; ?></td>
                    <td><?= $data['nama_ruang']; ?></td>
                    <td><?= $data['nama_hari']; ?></td>                    
                    <td><?= date('G:i', strtotime($data['jam_mulai'])).'&nbsp; - &nbsp;'.date('G:i', strtotime($data['jam_selesai'])).'&nbsp; Wib'; ?></td>
                    <td><?= $data['nama_dosen']; ?></td>
                    <td>
                    	<a href="?page=jadwal&aksi=ubah&id=<?= $data['id']; ?>" class=" btn btn-flat btn-sm btn-info" ><i class="fa fa-edit"></i> Ubah</a>

                    	<a onclick="return confirm('Yakin Akan Mengahapus Data Ini...???')" href="?page=jadwal&aksi=hapus&id=<?= $data['id']; ?>" class=" btn btn-flat btn-sm btn-danger" ><i class="fa fa-trash"></i> Hapus</a>
                    </td>
                </tr>
                <?php } ?>
             </tbody>
        </table>
    </div>

    <div class="box-footer">
        <a href="?page=jadwal&aksi=tambah" class=" btn btn-flat btn-sm btn-success" style="margin-top: 8px;" ><i class="fa fa-plus"></i> Tambah Data</a>
        <a href="page/jadwal/eksport_jadwal.php" class="btn btn-flat btn-sm btn-default btn-flat btn-sm" style="margin: 5px;"><i class="glyphicon glyphicon-download"></i> Eksport Data</a>
        
        <a href="index.php?page=jadwal&aksi=import_jadwal" class="btn btn-flat btn-sm btn-default btn-flat btn-sm" style="margin: 5px;"><i class="glyphicon glyphicon-upload"></i> Import Data</a>
    </div>
</div>
