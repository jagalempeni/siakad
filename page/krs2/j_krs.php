<?php 
$nim 	= $_SESSION['username'];
$sql 	= $koneksi->query("SELECT * FROM  tb_mahasiswa , tb_jurusan WHERE
		tb_mahasiswa.kode_jurusan = tb_jurusan.kode_jurusan AND
		tb_mahasiswa.nim = '$nim'");
$data = $sql->fetch_assoc();
?>
<form method="POST" enctype="multipart/form-data">
 	<div class="box box-primary">
	   <div class="box-header with-border">
	     <h3 class="box-title">Kartu Rencana Studi Anda</h3>
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
			  <input class="form-control" required name="jurusan" value="<?= $data['nama_jurusan']; ?>" readonly>  			   
			</div>

			<div class="form-group">
			  	<label>Smester yang Akan Ditempuh :</label>
			 	<input class="form-control" required name="smester" value="<?= $data['smester']; ?>" readonly>
			</div>
		</div>
	</div>

<p style="background-color:yellow; font-size:20px"><marquee>JIKA DATA MATAKULIAH TIDAK MUNCUL SILAHKAN HUBUNGI ADMIN</marquee></p>

	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Data Mata Kuliah Yang akan Di Tempuh</h3>
		</div>
		
		<div class="box-body">
			<table class="table table-condensed table-bordered" id="dataTables-example">
			   <thead>
			       <tr>
			       	<th>Pilih</th>
			           <th>No</th>
			           <th>Kode Matkul</th>
			           <th>Mata Kuliah</th>
			           <th>Prodi &nbsp;&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-sort"</th>
			           <th>SKS</th>
			           <th>Dosen</th>
			           <th>Ruang</th>
			           <th>Hari</th>
			           <th>Jadwal</th>
			       </tr>
			   </thead>
			   <tbody>

			   <?php 
			    
				$smester = $data['smester'];
				$no      = 1;
				$mk      = $koneksi->query("SELECT * FROM tb_matkul , 	tb_dosen , tb_jadwal, tb_mahasiswa,tb_ruang, tb_jurusan WHERE  
							tb_matkul.kode_mk       = tb_jadwal.kode_mk AND
							tb_matkul.kode_jurusan  = tb_jurusan.kode_jurusan AND
							tb_jadwal.kode_dosen    = tb_dosen.kode_dosen AND
							tb_jadwal.kode_ruang    = tb_ruang.kode_ruang AND
							tb_mahasiswa.status_krs = 1 AND
							tb_mahasiswa.krs 		= 1 AND
							tb_mahasiswa.nim        = '$nim' AND					
							tb_matkul.smester       = '$smester'");
			   while ( $tampil = $mk->fetch_assoc() ) {
			   ?>
			       <tr>
			       		<td><input type="checkbox" name="pilih[]" value="<?= $tampil['kode_mk']; ?>"></td>
			       	 	<td><?= $no++; ?></td>
			       	 	<td> 
			              <div class="form-group">
			           			<input class="form-control" required name="kd_mk" value="<?= $tampil['kode_mk']; ?> " readonly style="width: 100px;">
			       			</div>   
			    			</td>
			           <td><?= $tampil['nama_mk']; ?></td>
			           <td><?= $tampil['nama_jurusan']; ?></td>
			           <td><?= $tampil['sks']; ?></td>
			           <td><?= $tampil['nama_dosen']; ?></td> 
			           <td><?= $tampil['nama_ruang']; ?></td>
			           <td><?= $tampil['nama_hari']; ?></td> 
			           <td><?= date('G:i ', strtotime($tampil['jam_mulai'])).'-'.date('G:i', strtotime( $tampil['jam_selesai'])).'&nbsp; WIB'; ?> 
			          </td>
			       </tr>
			     <?php } ?>  
			   </tbody> 
			</table>        
		 
		</div> 

		<div class="box-footer">
		   <input type="submit" name="simpan" value="Tambah" class="btn btn-flat btn-sm btn-flat btn-sm btn-primary" >
			<a href="?page=krs&aksi=lihat&smester=<?= $smester;?>" class="btn btn-flat btn-sm btn-flat btn-sm btn-success" style="margin-left: 20px;">Lihat KRS</a>  	
	  	</div>
	</div>
</form>



<?php 
	if (isset($_POST['simpan'])) {
	$nim     = $_POST['nim'];
	$jurusan = $_POST['jurusan'];
	$jumlah  = count($_POST['pilih']);
	for ( $i = 0; $i < $jumlah ; $i++ ) { 
		$pilih  = $_POST['pilih'][$i];
		$simpan = $koneksi->query("INSERT INTO tb_krs(kode_mk, nim, kode_jurusan, status_nilai)VALUES('$pilih','$nim','$jurusan', 1)");
		$update = $koneksi->query("UPDATE tb_mahasiswa SET status_krs = 0, krs = 0 WHERE nim = '$nim'");
		if ($simpan) { ?>
			<script>
				setTimeout(function() {
				  swal({
				      title: "Selamat!",
				      text: "KRS Berhasil Ditambahkan!",
				      type: "success"
				  }, function() {
				      window.location = "?page=krs";
				  });
				}, 300);
			</script>
<?php } } } ?>


									                
		                                          
		                                            
		                                            
			                                            
				                    
									                

									                
		                                            
		                                             

