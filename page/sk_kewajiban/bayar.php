<?php 
	$nim    = $_GET['nim'];
	$id    = $_GET['id'];
	$sql    = $koneksi->query("SELECT * from tb_mahasiswa, sk_master, sk_kewajiban WHERE 				
							sk_kewajiban.id_master = sk_master.id_master AND
							sk_kewajiban.id_kewajiban = '$id' AND
							tb_mahasiswa.nim = '$nim'");

	$tampil = $sql->fetch_assoc();	
	$telahbayar = $tampil['kewajiban_bayar'];
	$kurang = $tampil['jumlah_bayar']-$tampil['kewajiban_bayar'];
	$jumlahbayar = $tampil ['jumlah_bayar'];
	$kewajibanbayar = $tampil ['kewajiban_bayar'];
	$angkatan = $tampil ['angkatan'];


	// if ($kurang < 0) {($status='<small class="label bg-yellow">Dikembalikan</small>');}
	// elseif ($kurang == 0) {($status='<small class="label bg-green">Lunas</small>');} 
	// else{($status='<small class="label bg-red">Belum Lunas</small>');}
 ?>
<form method="POST" enctype="multipart/form-data">
	<div class="box box-primary">
	   <div class="box-header with-border">
	     	<h3 class="box-title">Pembayaran Mahasiswa</h3>
	   </div>
	   <div class="box-body">
			<div class="col-lg">
				<table class="table table-bordered table-striped">
					<tr>
						<th>Nim</th>
						<th>Nama</th>
						<th>Tahun Angkatan</th>
						<th>Nama Pembayaran</th>
					</tr>
					<tr>
						<td><?= $tampil['nim']; ?></dh>
						<td><?= $tampil['nama']; ?></td>
						<td><?= $tampil['angkatan']; ?></td>
						<td><?= $tampil['nama_bayar'] ?></td>
					</tr>
				</table>
			</div>
		</div>
		<div class="box-body">

			<div class="col-lg-4">
				<div class="form-group">
				  <label>Yang Harus Dibayar</label>
				  <input class="form-control" required value="Rp. <?= number_format($jumlahbayar, 0, ".", ".") ?>" readonly>
				  <input type="hidden" class="form-control" required name="total_bayar" value="<?= $jumlahbayar?>" readonly>

				  <input type="hidden" class="form-control" required name="id_master" value="<?= $tampil['id_master']; ?>" readonly>
				  <input type="hidden" class="form-control" required name="id_kewajiban" value="<?= $tampil['id_kewajiban']; ?>" readonly>
				  <input type="hidden" class="form-control" required name="angkatan" value="<?= $tampil['angkatan']; ?>" readonly>

				</div>
			</div>

			<div class="col-lg-4">
				<div class="form-group">
				  <label>Sudah Dibayar</label>
				  <input class="form-control" required value="Rp. <?= number_format($kewajibanbayar, 0, ".", ".") ?>" readonly>
				  <input type="hidden" class="form-control" required name="sudah_bayar" value="<?= $kewajibanbayar?>" readonly>
				</div>
			</div>

			<div class="col-lg-4">
				<div class="form-group">
				  <label>Sisa Pembayaran</label>
				  <input class="form-control" required value="Rp. <?= number_format($kurang, 0, ".", ".") ?>" readonly>
				  <input type="hidden" class="form-control" required name="kekurangan_bayar" value="<?= $kurang ?>" readonly>
				</div>
			</div>

			<div class="col-lg-4">
				<div class="form-group">
				  <label><h3><span class="label bg-blue">Form Pembayaran</span></h3></label>
				  <input class="form-control" required name="sekarang_bayar" autofocus="" placeholder="masukan jumlah pembayaran"><i>* contoh : <b>100000</b></i>
				</div>

				<div class="form-group">
				  <textarea class="form-control" rows="3" name="catatan" placeholder="masukan catatan"></textarea>
				</div>
			</div>

		</div>
		<div class="box-footer">
			<input type="submit" name="simpan" value="Bayar" class="btn btn-flat btn-primary">

			<input type=button value=Kembali onclick="window.location.href = '?page=sk_master&aksi=mastermhs&id=<?= $tampil['angkatan'];?>&nim=<?= $tampil['nim']; ?>'" class="btn btn-flat btn-info">
		</div>
	</div>
</form>    

<?php 
	if (isset($_POST['simpan'])) {
		$total_bayar    = $_POST['total_bayar'];
		$sekarang_bayar  = $_POST['sekarang_bayar'];
		$id_master    = $_POST['id_master'];
		$id_kewajiban  = $_POST['id_kewajiban'];
		$catatan  = $_POST['catatan'];
		$nim  = $_GET['nim'];

		$bayar =	$koneksi->query("INSERT INTO sk_transaksi(nim, id_master, id_kewajiban, jumlah_bayar, jumlah_setor, tgl_setor, catatan)VALUES('$nim','$id_master','$id_kewajiban','$total_bayar', '$sekarang_bayar', NOW(), '$catatan')");

			$jumlahsetor_total = $sekarang_bayar + $telahbayar;	
			$koneksi->query("UPDATE sk_kewajiban SET kewajiban_bayar ='$jumlahsetor_total' WHERE 
			id_kewajiban='$id_kewajiban'");

			if ($bayar) {
			echo "
    			<script>
    			    setTimeout(function() {
    			        swal({
    			            title: 'Selamat!',
    			            text: 'Data Transaksi Berhasil Ditambah!',
    			            type: 'success'
    			        }, function() {
    			            window.location = '?page=sk_master&aksi=mastermhs&id=$angkatan&nim=$nim';
    			        });
    			    }, 300);
    			</script>
			";
		} else{
            echo "
    			<script>
    			    setTimeout(function() {
    			        swal({
    			            title: 'Transaksi Gagal !',
    			            text: 'Cek Kembali Data, !',
    			            type: 'error'
    			        }, function() {
    			            window.location = '?page=sk_master&aksi=mastermhs&id=$angkatan&nim=$nim';
    			        });
    			    }, 300);
    			</script>
			";
        }
	}
?>


<!-- SEBELEUM EDIT -->