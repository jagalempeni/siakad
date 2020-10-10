<?php 
if($_SESSION['admin'] || $_SESSION['dosen']){
?>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Daftar Matakuliah Diajar</h3>
    </div>
    <div class="box-body">
        <table class="table table-bordered table-condensed" id="dataTables-example">
            <thead>
                <tr>
                	<th>No</th>
                	<th>Kode Matkul</th>
                    <th>Mata Kuliah</th>
                    <th>SKS</th>
                    <th>Semester</th>
                    <th>Kelas</th>
                    <th>Kode Dosen</th>
                    <th>Dosen</th>
                    <th>Ruang</th>
                    <th>Jadwal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $no = 1;
            $mk = $koneksi->query("SELECT * FROM tb_jadwal, tb_dosen, tb_matkul, tb_ruang WHERE  
                tb_dosen.kode_dosen  = tb_jadwal.kode_dosen AND
                tb_jadwal.kode_mk    = tb_matkul.kode_mk AND    
                tb_jadwal.kode_ruang = tb_ruang.kode_ruang");
            while ($data = $mk->fetch_assoc()) { ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $data['kode_matkul']; ?></td>
                    <td><?= $data['nama_mk']; ?></td>
                    <td><?= $data['sks']; ?></td>
                    <td><?= $data['smester']; ?></td>
                    <td><?= $data['kelas']; ?></td>
                    <td><?= $data['kode_dosen']; ?></td>
                    <td><?= $data['nama_dosen']; ?></td>
                    <td><?= $data['nama_ruang']; ?></td>
                    <td><?= $data['nama_hari'].', &nbsp;'.date('G:i ', strtotime($data['jam_mulai'])).'-'.date('G:i', strtotime( $data['jam_selesai'])).'&nbsp; WIB'; ?> </td>
                    <td>
                    	<a href="?page=nilai&aksi=lihat_mhs&kode_mk=<?= $data['kode_mk']; ?>&dosen=<?= $data['kode_dosen']; ?> " class=" btn btn-flat btn-xs btn-info" ><i class="fa fa-edit"></i> Nilai Mahasiswa</a>
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