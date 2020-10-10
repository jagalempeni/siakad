<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Data Jadwal</h3>
  </div>



<div class="box-body">
        <table class="table table-condensed table-bordered" id="dataTables-example1">
            <thead>
                <tr>
                    <th>No</th>
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
             $dosen = $_GET['dosen'];
            $sql = $koneksi->query("SELECT * FROM tb_jadwal, tb_matkul, tb_ruang, tb_dosen WHERE   
                tb_jadwal.kode_mk = tb_matkul.kode_mk   AND
                tb_jadwal.kode_ruang = tb_ruang.kode_ruang AND
                tb_jadwal.kode_dosen = tb_dosen.kode_dosen AND
                tb_jadwal.kode_dosen           = '$dosen'");
            while ($data=$sql->fetch_assoc()) { ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $data['nama_mk']; ?></td>
                    <td><?= $data['kelas']; ?></td>
                    <td><?= $data['kode_jurusan']; ?></td>
                    <td><?= $data['smester']; ?></td>
                    <td><?= $data['nama_ruang']; ?></td>
                    <td><?= $data['nama_hari']; ?></td>                    
                    <td><?= date('G:i', strtotime($data['jam_mulai'])).'&nbsp; - &nbsp;'.date('G:i', strtotime($data['jam_selesai'])).'&nbsp; Wib'; ?></td>
                    <td><?= $data['nama_dosen']; ?></td>
                    <td>
                        <a href="?page=aturpre&aksi=ubah&id=<?= $data['id']; ?>" class=" btn btn-flat btn-sm btn-success" ><i class="fa fa-cogs"></i> Ubah % Nilai</a>

                    </td>
                </tr>
                <?php } ?>
             </tbody>
        </table>
    </div>

</div>
