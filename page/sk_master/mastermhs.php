<?php 
if($_SESSION['admin'] || $_SESSION['keuangan']){
?>

<?php 

    $nim =$_GET['nim'];
    $id =$_GET['id'];
    $prodi =$_GET['prodi'];

    $sql1 = $koneksi->query("SELECT * FROM tb_mahasiswa WHERE
                                    tb_mahasiswa.nim = '$nim'");
    $tampil1 = $sql1->fetch_assoc();

?>


<form method="POST" enctype="multipart/form-data">
    <div class="box box-primary">
       <div class="box-header with-border">
            <h3 class="box-title">Pembayaran Mahasiswa</h3>
       </div>
       
        <div class="box-body">

            <div class="col-lg-4">
                <div class="form-group">
                  <label>NIM</label>
                  <input class="form-control" required name="nim" value="<?= $tampil1['nim']; ?>" readonly>
                </div>
            </div>

            <div class="col-lg-4">
                

                <div class="form-group">
                  <label>Nama</label>
                  <input class="form-control" required name="nama" value="<?= $tampil1['nama']; ?>" readonly>

                  <input type="hidden" class="form-control" required name="angkatan" value="<?= $tampil1['angkatan']; ?>" readonly>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="form-group">
                  <label>Rekening :</label>
                <select class="form-control" required name="idmaster">
                    <option>-- Pilih Rekening --</option>
                    <?php
                    $sql = $koneksi->query("SELECT * FROM sk_master WHERE 
                        angkatan_bayar = '$id' 
                        ORDER BY angkatan_bayar ASC, nama_bayar ASC");
                    while ( $data = $sql->fetch_assoc() ) {
                        echo "
                            <option value='$data[id_master]'>$data[nama_bayar]</option>
                        ";
                    } ?>
                </select>
            </div>
        </div>

        </div>
        <div class="box-footer">
            <input type="submit" name="simpan" value="Tambah" class="btn btn-flat btn-primary">
        </div>
    </div>
</form>   


<?php 
    if (isset($_POST['simpan'])) {
        $nim    = $_POST['nim'];
        $idmaster  = $_POST['idmaster'];
        $angkatan    = $_POST['angkatan'];




        $cek = $koneksi->query("SELECT * FROM sk_kewajiban WHERE
                                        id_master = '$idmaster' AND
                                        nim = '$nim'");
        $tampilcek = $cek->fetch_assoc();

        if ($tampilcek[id_kewajiban] <= 0) {
            
        $bayar =    $koneksi->query("INSERT INTO sk_kewajiban(id_master, nim, angkatan_bayar)VALUES('$idmaster','$nim','$angkatan')");
    } else {
        echo "
                <script>
                    setTimeout(function() {
                        swal({
                            title: 'Error !',
                            text: 'Data Pembayaran Sudah Tersedia !',
                            type: 'error'
                        }, function() {
                            window.location = '?page=sk_master&aksi=mastermhs&id=$id&nim=$nim&prodi=$prodi';
                        });
                    }, 300);
                </script>
            ";
        }
    }
?>







       
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Data Kewajiban Pembayaran Mahasiswa </h3>
    </div>

    <div class="box-body">
        <table class="table table-bordered table-hover table-striped" id="dataTables-example">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Angkatan</th>
                    <th>Nama Pembayaran</th>
                    <th>Yang Harus Dibayar</th>
                    <th>Sisa Pembayaran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>

            <?php 

            	$no     = 1;
                $id     = $_GET['id'];
                $nim    = $_GET['nim'];

            	$sql = $koneksi->query("select * from sk_master, sk_kewajiban WHERE 
                    sk_kewajiban.angkatan_bayar = '$id' AND
                    sk_kewajiban.nim            = '$nim' AND
                    sk_kewajiban.id_master = sk_master.id_master ORDER by id_kewajiban DESC");
            	while ($data=$sql->fetch_assoc()) {
                 $harus = $data['jumlah_bayar'];
                 $sudah = $data['kewajiban_bayar'];
                 $sisa  = $harus - $sudah;
                 $tbstatus = $data['status'] ; 

                        if ($tbstatus == 1) {$status='<small class="label bg-green">Aktif</small>';}
                        if ($tbstatus == 0) {$status='<small class="label bg-red">Tidak Aktif</small>';}          		
            	

             ?>

                <tr class="odd gradeX">
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $data['angkatan_bayar']; ?></td>
                    <td><?php echo $data['nama_bayar']; ?></td>
                    <td>Rp. <?= number_format($harus, 0, ".", ".") ?></td> 
                    <td>Rp. <?= number_format($sisa, 0, ".", ".") ?></td>                    

                    <td>
                    	<a href="?page=sk_kewajiban&aksi=bayar&nim=<?php echo $nim; ?>&id=<?php echo $data['id_kewajiban']; ?>" class=" btn btn-flat btn-xs btn-success" ><i class="glyphicon glyphicon-list-alt"></i> Bayar</a><!-- 

                    	<a onclick="return confirm('Yakin Akan Mengahapus Data Ini...???')" href="?page=mahasiswa&aksi=hapus&id=<?php echo $data['nim']; ?>" class=" btn btn-flat btn-xs btn-danger" ><i class="fa fa-trash-o"></i> Hapus</a>

                    	<a href="?page=mahasiswa&aksi=detail&id=<?php echo $data['nim']; ?>" class=" btn btn-flat btn-xs btn-success" ><i class="glyphicon glyphicon-list-alt"></i> Detail</a> -->
                    </td>
                </tr>

                <?php } ?>
            </tbody> 
        </table> 
    </div>
    <div class="box-footer">
            <input type=button value=Kembali onclick="window.location.href = '?page=sk_transaksi'" class="btn btn-flat btn-info">
        </div>
        
</div>

<?php
    }else{
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';
exit;
    }
?> 