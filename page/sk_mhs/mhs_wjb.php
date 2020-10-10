<?php 
$nim = $_SESSION['username'];
$sql = $koneksi->query("SELECT * FROM  tb_mahasiswa , tb_jurusan WHERE
        tb_mahasiswa.kode_jurusan = tb_jurusan.kode_jurusan AND
        tb_mahasiswa.nim          = '$nim'");
$data = $sql->fetch_assoc(); ?>

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Kewajiban Pembayaran Mahasiswa</h3>
        </div>

        <div class="box-body">
    <table class="table table-condensed table-bordered">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Pembayaran</th>
                <th>Yang Harus Dibayar</th>
                <th>Sisa Pembayaran</th>
                </tr>
        </thead>
        <tbody>
        <?php 

            $no      = 1;
            $sql = $koneksi->query("SELECT * FROM sk_kewajiban, sk_master WHERE 
                sk_kewajiban.id_master  = sk_master.id_master AND
                sk_kewajiban.nim        = '$nim'");
            
            while ( $data = $sql->fetch_assoc() ) { 
            	$udah     = $data['kewajiban_bayar'];
                $harus         = $data['jumlah_bayar'];;
                $sisa         = $harus - $udah;
            	?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $data['nama_bayar']; ?></td>
                <td>Rp. <?= number_format($harus, 0, ".", ".") ?></td>
                <td>Rp. <?= number_format($sisa, 0, ".", ".") ?></td>
                </td>
            </tr>
            <?php
                } 
            ?>
            </tbody> 

        </table>
    </div>

    <div class="box-footer">
        <input type=button value=Kembali onclick="self.history.back()" class="btn btn-info btn-flat btn-sm" style="margin-top: 10px;" >
    </div>
</div>




