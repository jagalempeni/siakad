<?php 
$nim = $_SESSION['username'];
$sql = $koneksi->query("SELECT * FROM  tb_mahasiswa , tb_jurusan WHERE
        tb_mahasiswa.kode_jurusan = tb_jurusan.kode_jurusan AND
        tb_mahasiswa.nim          = '$nim'");
$data = $sql->fetch_assoc(); ?>

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Riwayat Pembayaran Mahasiswa</h3>
        </div>

        <div class="box-body">
    <table class="table table-condensed table-bordered">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Pembayaran</th>
                <th>Jumlah Setor</th>
                <th>Catatan</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
        <?php 

            $no      = 1;
            $sql = $koneksi->query("SELECT * FROM sk_transaksi, sk_kewajiban, sk_master WHERE 
                sk_transaksi.id_master = sk_master.id_master AND
                sk_transaksi.id_kewajiban = sk_kewajiban.id_kewajiban AND
                sk_transaksi.nim = '$nim' ORDER by id_transaksi DESC");
            
            while ( $data = $sql->fetch_assoc() ) { 
            	$jumlahsetor = $data['jumlah_setor'];
            	?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $data['nama_bayar']; ?></td>
                <td>Rp. <?= number_format($jumlahsetor, 0, ".", ".") ?></td>
                <td><?= $data['catatan']; ?></td>
                <td><?= $data['tgl_setor']; ?></td>  
                </td>
            </tr>
            <?php
                $jml_krs = $jml_krs + $data['sks']; 
                } 
            ?>
            </tbody> 

        </table>
    </div>

    <div class="box-footer">
        <input type=button value=Kembali onclick="self.history.back()" class="btn btn-info btn-flat btn-sm" style="margin-top: 10px;" >
    </div>
</div>




