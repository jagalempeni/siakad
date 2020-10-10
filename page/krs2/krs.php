<?php 
$nim = $_SESSION['username'];
$sql = $koneksi->query("SELECT * FROM  tb_mahasiswa , tb_jurusan WHERE
        tb_mahasiswa.kode_jurusan = tb_jurusan.kode_jurusan AND
        tb_mahasiswa.nim          = '$nim'");
$data = $sql->fetch_assoc(); ?>

<form method="POST" enctype="multipart/form-data">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Kartu Rencana Studi Yang Telah Diambil</h3>
        </div>

        <div class="box-body">
            <div class="form-group">
                <label>Nim :</label>
                <input class="form-control" required name="nim" value="<?= $data['nim']; ?> " readonly>
            </div>

            <div class="form-group">
                <label>Nama :</label>
                <input class="form-control" required name="nama" value="<?= $data['nama']; ?>" readonly>
            </div>
                                        
            <div class="form-group">
                <label>Prodi :</label>
                <select class="form-control" required name="jurusan" readonly>
                <?php 
                    $sql1 = $koneksi->query("SELECT * FROM tb_jurusan");
                    while( $j = $sql1->fetch_assoc() ){
                        $pilih = ($j['kode_jurusan'] == $data['kode_jurusan']?"selected":"");
                        echo "
                            <option value='$j[kode_jurusan]' $pilih>$j[nama_jurusan]</option>
                        ";
                    } ?>
                </select>
            </div>                        

            <div class="form-group">
                <label>Smester yang Akan Ditempuh :</label>
                <input class="form-control" required name="smester" value="<?= $data['smester']; ?>" readonly >
            </div>
    </form>
    <!-- akhir form -->

    <table class="table table-condensed table-bordered" id="dataTables-example">
        <thead>
            <tr>
                <th>NO</th>
                <th>Kode Matkul</th>
                <th>Nama Mata Kuliah</th>
                <th>SKS</th>
                <th>Dosen</th>
                <th>Kelas</th>
                <th>Hari</th>
                <th>Tanggal Jam</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php 

            $smester = $_GET['smester'];
            $nim     = $_SESSION['username'];
            $no      = 1;
        	if ( $_SESSION['mahasiswa'] ) {
        	$sql = $koneksi->query("SELECT * FROM tb_krs , tb_matkul, tb_dosen, tb_jadwal, tb_ruang WHERE 
                tb_matkul.kode_mk    = tb_krs.kode_mk AND 
                tb_dosen.kode_dosen  = tb_jadwal.kode_dosen AND
                tb_matkul.kode_mk    = tb_jadwal.kode_mk AND
                tb_jadwal.kode_ruang = tb_ruang.kode_ruang AND
                tb_krs.nim           = '$nim' AND
                tb_matkul.smester    = '$smester'");
            }else{	
                $sql = $koneksi->query("SELECT * FROM tb_krs  INNER JOIN tb_mahasiswa ON tb_mahasiswa.nim = tb_krs.nim INNER JOIN tb_matkul ON tb_matkul.kode_mk   = tb_krs.kode_mk INNER JOIN tb_jurusan ON tb_jurusan.kode_jurusan = tb_krs.kode_jurusan");
            }

            while ( $data = $sql->fetch_assoc() ) { ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $data['kode_mk']; ?></td>
                <td><?= $data['nama_mk']; ?></td>
                <td align="right"><?= $data['sks']; ?></td>
                <td><?= $data['nama_dosen']; ?></td>
                <td><?= $data['nama_ruang']; ?></td>
                <td><?= $data['nama_hari']; ?></td>
                <td><?= date('d F Y', strtotime( $data['tanggal'])).', &nbsp;'.date('G:i', strtotime($data['jam_mulai'])).'-'.date('G:i', strtotime($data['jam_selesai'])).'&nbsp; Wib'; ?></td>
                <td>
                    <a onclick="return confirm('Yakin Akan Mengahapus Data Ini...???')" href="?page=krs&aksi=hapus&id=<?= $data['kode']; ?>" class=" btn btn-danger btn-flat btn-sm" ><i class="fa fa-trash"></i> Hapus</a>
                </td>
            </tr>
            <?php
                $jml_krs = $jml_krs + $data['sks'];    
                } 
            ?>
            </tbody> 

            <tr>
                <th  style="text-align: center; font-size: 17px; " colspan="3">Total SKS</th>
                <td  style="font-size: 15px; text-align: right;"><b><?= $jml_krs ; ?></b></td>
                <td colspan="4"></td> 
            </tr>
        </table>
    </div>

    <div class="box-footer">
        <a href="./cetak/cetak_krs.php?id=<?= $nim; ?>&smester=<?= $smester; ?>" class="btn btn-default  btn-flat btn-sm" style="margin-top: 10px;" target="blank"><i class="fa fa-print"></i> Cetak KRS</a> 
        <input type=button value=Kembali onclick="self.history.back()" class="btn btn-info btn-flat btn-sm" style="margin-top: 10px;" >
    </div>
</div>

    