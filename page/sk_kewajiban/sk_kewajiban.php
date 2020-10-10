<?php 
$nim = $_GET['id'];
$sql = $koneksi->query("SELECT * FROM  tb_mahasiswa , tb_jurusan WHERE
        tb_mahasiswa.kode_jurusan = tb_jurusan.kode_jurusan AND
        tb_mahasiswa.nim          = '$nim'");
$data = $sql->fetch_assoc(); ?>

<form method="POST" enctype="multipart/form-data">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Kewajiban Pembayaran Mahasiswa</h3>
        </div>

        <div class="box-body">
            <div class="form-group" >
                <label>Nim :</label>
                <input class="form-control" required name="nim" value="<?= $data['nim']; ?> " readonly>
            </div>

            <div class="form-group">
                <label>Nama :</label>
                <input class="form-control" required name="nama" value="<?= $data['nama']; ?>" readonly>
            </div>
                                        
            <div class="form-group">
                <label>Prodi :</label>
                <input class="form-control" required name="jurusan" value="<?= $data['nama_jurusan']; ?>" readonly>
                
            </div>   
    </form>
    <!-- akhir form -->

    <table class="table table-condensed table-bordered" id="dataTables-example">
        <thead>
            <tr>
                <th>NO</th>
                <th>Nama Pembayaran</th>
                <th>Angkatan Pembayaran</th>
                <th>Jumlah Pembayaran</th>
                <th>Telah Dibayar</th>
                <th>Kekurangan Pembayaran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php 

            $smester = $_GET['smester'];
            $kelas = $data['kelas'];
            $nim     = $_GET['id'];
            $no      = 1;
            $sql = $koneksi->query("SELECT * FROM sk_kewajiban, sk_master WHERE 
                sk_kewajiban.id_master    = sk_master.id_master AND
                sk_kewajiban.nim = '$nim'");

            // $sql1 = $koneksi->query("SELECT * FROM sk_kewajiban, sk_master WHERE 
            //     sk_kewajiban.id_master    = sk_master.id_master AND
            //     sk_kewajiban.nim = '$nim'");
            // $data1 = $sql1->fetch_assoc();
            // $kurang = $data1['jumlah_bayar']-$data1['kewajiban_bayar']; 

            // $sql1 = $koneksi->query("SELECT * FROM sk_transaksi, sk_master, sk_kewajiban WHERE 
            //     sk_transaksi.id_master = sk_master.id_master AND
            //     sk_transaksi.id_kewajiban = sk_kewajiban.id_kewajiban AND
            //     sk_transaksi.nim = '$nim'");
            
            while ( $data = $sql->fetch_assoc ())                   
                { 
            $jumlahbayar = $data['jumlah_bayar'];  
            $telahbayar = $data['kewajiban_bayar']; 
            $kurang = $jumlahbayar-$telahbayar; 
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $data['nama_bayar']; ?></td>
                <td><?= $data['angkatan_bayar']; ?></td>
                <td>Rp. <?= number_format($jumlahbayar, 0, ".", ".") ?></td>
                <td>Rp. <?= number_format($telahbayar, 0, ".", ".") ?></td>
                <td>Rp. <?= number_format($kurang, 0, ".", ".") ?></td>                 
                <td><a href="?page=sk_kewajiban&aksi=bayar&id=<?php echo $data['id_kewajiban']; ?>&nim=<?php echo $nim; ?>" class=" btn btn-flat btn-xs btn-success" ><i class="glyphicon glyphicon-list-alt"></i> Bayar</a></td>
                </td>
            </tr>
            <?php
                } 
            ?>
            </tbody> 
        </table>
    </div>
        <input type=button value=Kembali onclick="self.history.back()" class="btn btn-info btn-flat btn-sm" style="margin-top: 10px;" >
    </div>
</div>




    