<?php
$id    = $_SESSION['username'];
$sql   = $koneksi->query("SELECT * FROM tb_mahasiswa INNER JOIN tb_jurusan ON tb_mahasiswa.kode_jurusan = tb_jurusan.kode_jurusan AND nim = '$id'");
$data  = $sql->fetch_assoc();
$sql2  = $koneksi->query("SELECT * FROM tb_dosen WHERE kode_dosen = '$id'");
$data2 = $sql2->fetch_assoc();
?>

<div class="box box-primary">
    <div class="box-header with-border">
            <h3 class="box-title">Profile</h3>
    </div>

    <div class="box-body">
        <table class="table table-bordered" style="letter-spacing: .5px;">
        	<tr>
            <?php if ($_SESSION['mahasiswa']) { ?>
        		<td rowspan="10" align="center" width="200"><img src="img/<?= $data['foto']; ?>" style="border: 1px solid #e7e7e7; width: 200px; height: 200px;"></td>
                <?php } ?>
                <?php if ($_SESSION['dosen']) { ?>
                <td rowspan="6" align="center" width="200"><img src="img/<?= $data2['foto']; ?>" style="border: 1px solid #e7e7e7; width: 200px; height: 200px;"> </td>
                  <?php } ?>
        	</tr>
    	   
           <?php if ($_SESSION['dosen']) { ?>
            <tr>
                <td><span class="style2"> Kode Dosen </span></td>
                <td><span class="style2"> :</span></td>
                <td><span class="style2"> <?= $data2['kode_dosen']; ?></span></td>
            </tr>
            <?php } ?>
            
            <?php if ($_SESSION['mahasiswa']) { ?>
            <tr>
        		<td><span class="style2"> Nim </span></td>
        		<td><span class="style2"> :</span></td>
        		<td><span class="style2"> <?= $data['nim']; ?></span></td>
        	</tr>

        	<tr>
        		<td><span class="style2"> Nama </span></td>
        		<td><span class="style2"> :</span></td>
        		<td><span class="style2"> <?= $data['nama']; ?></span></td>
        	</tr>
            <?php } ?>

            <?php if ($_SESSION['dosen']) { ?>
            <tr>
                <td><span class="style2"> Nama </span></td>
                <td><span class="style2"> :</span></td>
                <td><span class="style2"> <?= $data2['nama_dosen']; ?></span></td>
            </tr>
            <?php } ?>
            
            <?php if ($_SESSION['mahasiswa']) { ?>
        	<tr>
        		<td><span class="style2"> Tempat / Tanggal lahir </span></td>
        		<td><span class="style2"> :</span></td>
        		<td><span class="style2"> <?= $data['tempat_lahir'].','.date('d F Y', strtotime( $data['tanggal_lahir'])); ?></span></td>
        	</tr>

        	<tr>
        		<td><span class="style2"> Alamat </span></td>
        		<td><span class="style2"> :</span></td>
        		<td><span class="style2"> <?= $data['alamat']; ?></span></td>
        	</tr>
            <?php } ?>

            <?php if ($_SESSION['dosen']) { ?>
            <tr>
                <td><span class="style2"> Alamat </span></td>
                <td><span class="style2"> :</span></td>
                <td><span class="style2"> <?= $data2['alamat']; ?></span></td>
            </tr>
            <?php } ?>

            <?php if ($_SESSION['mahasiswa']) { ?>
        	<tr>
        		<td><span class="style2"> Prodi </span></td>
        		<td><span class="style2"> :</span></td>
        		<td><span class="style2"> <?= $data['nama_jurusan']; ?></span></td>
        	</tr>

        	<tr>
        		<td><span class="style2"> Jenis Kelamin </span></td>
        		<td><span class="style2"> :</span></td>
        		<td>
                    <span class="style2">
                		<?php
                			if ($data['jenis_kelamin']=="L"){
                				echo "Laki-laki";
                			}else{
                				echo"Perempuan";
                			}
                		?>
            		</span>
                </td>
        	</tr>
        	<tr>
        		<td><span class="style2"> Email </span></td>
        		<td><span class="style2"> :</span></td>
        		<td><span class="style2"> <?= $data['email']; ?></span></td>
        	</tr>
            <?php } ?>

            <?php if ($_SESSION['dosen']) { ?>
            <tr>
                <td><span class="style2"> Email </span></td>
                <td><span class="style2"> :</span></td>
                <td><span class="style2"> <?= $data2['email']; ?></span></td>
            </tr>
            <?php } ?>

            <?php if ($_SESSION['mahasiswa']) { ?>
        	<tr>
        		<td><span class="style2"> Telepon </span></td>
        		<td><span class="style2"> :</span></td>
        		<td><span class="style2"> <?= $data['telpon']; ?></span></td>
        	</tr>
            <?php } ?>

            <?php if ($_SESSION['dosen']) { ?>
            <tr>
                <td><span class="style2"> Telepon </span></td>
                <td><span class="style2"> :</span></td>
                <td><span class="style2"> <?= $data2['telpon']; ?></span></td>
            </tr>
        <?php } ?>
    </table>
  </div>

  <div class="box-footer">
    <a href="?page=profile&aksi=ubahpass&id=<?= $id; ?>" class="btn btn-sm btn-flat btn-primary" style="float: right;">Ubah Password</a>

    <?php if ($_SESSION['mahasiswa']) { ?>
    <a href="?page=profile&aksi=ubahsmester&id=<?= $id; ?>" class="btn btn-sm btn-flat btn-primary" style="float: right; margin-right: 10px;">Ubah Smester</a>
	<?php } ?>									 
    
    <input type=button value=Kembali onclick=self.history.back() class="btn btn-sm btn-flat btn-info">

    <div class="clear" style="clear: both;"></div>
  </div>
</div>      