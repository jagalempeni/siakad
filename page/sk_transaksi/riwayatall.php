<?php 
if($_SESSION['admin'] || $_SESSION['keuangan']){
?>

<form method="POST" enctype="multipart/form-data">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Riwayat Pembayaran Mahasiswa</h3>
        </div>

        <div class="box-body">
    <!-- akhir form -->

    <table class="table table-condensed table-bordered" id="dataTables-example">
        <thead>
            <tr>
                <th>No.</th>
                <th>NIM</th>
                <th>Nama Pembayaran</th>
                <th>Jumlah Setor</th>
                <th>Catatan</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
        <?php 
            
            $no      = 1;
            $sql = $koneksi->query("SELECT * FROM sk_transaksi INNER JOIN sk_master ON sk_transaksi.id_master = sk_master.id_master ORDER BY id_transaksi DESC");
            
            while ( $data = $sql->fetch_assoc() ) { 
                $jumlahsetor = $data['jumlah_setor'];
                ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $data['nim']; ?></td>
                <td><?= $data['nama_bayar']; ?></td>
                <td>Rp. <?= number_format($jumlahsetor, 0, ".", ".") ?></td>
                <td><?= $data['catatan']; ?></td>
                <td><?= $data['tgl_setor']; ?></td>  
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

<?php
    }else{
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';
exit;
    }
?>      