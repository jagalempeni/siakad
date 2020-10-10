<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Daftar Mata Kuliah Diajar</h3>
  </div>

  <div class="box-body">
    <table class="table table-bordered table-condensed" id="dataTables-example">
        <thead>
            <tr>
            	  <th>No</th>
            	  <th>Kode Matkul</th>
                <th>Mata Kuliah</th>
                <th>SKS</th>
                <th>Smester</th>
                <th>Kode Dosen</th>
                <th>Dosen</th>
                <th>Kelas</th>
                <th>Jadwal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
      <?php
        $dosen = $_GET['dosen'];
        $no    = 1;
        $mk    = $koneksi->query("SELECT * FROM tb_jadwal, tb_dosen, tb_matkul, tb_ruang WHERE  
          tb_dosen.kode_dosen  = tb_jadwal.kode_dosen AND
          tb_jadwal.kode_mk    = tb_matkul.kode_mk AND
          tb_jadwal.kode_ruang = tb_ruang.kode_ruang AND
          tb_jadwal.kode_dosen = '$dosen'");
      	while ($data = $mk->fetch_assoc()) { ?>
          <tr>
              <td><?= $no++; ?></td>
              <td><?= $data['kode_mk']; ?></td>
              <td><?= $data['nama_mk']; ?></td>
              <td><?= $data['sks']; ?></td>
              <td><?= $data['smester']; ?></td>
              <td><?= $data['kode_dosen']; ?></td>
              <td><?= $data['nama_dosen']; ?></td>
              <td><?= $data['nama_ruang']; ?></td>
              <td><?= date('d F Y', strtotime( $data['tanggal'])).', &nbsp;'.date('G:i ', strtotime($data['jam_mulai'])).'-'.date('G:i', strtotime( $data['jam_selesai'])).'&nbsp; WIB'; ?></td>
              <td>
              	<a href="?page=nilai_d&aksi=lihat_mhs&kode_mk=<?= $data['kode_mk']; ?>&dosen=<?= $data['kode_dosen']; ?> &krs=<?= $data['kode']; ?>" class=" btn btn-flat btn-sm btn-info" ><i class="fa fa-edit"></i> Nilai Mahasiswa</a>

              </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
</div>