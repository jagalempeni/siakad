<?php	
error_reporting(0);
session_start();
$koneksi = new mysqli("localhost","root","","assholeh_siakad1");
if(@$_SESSION['admin'] || $_SESSION['mahasiswa'] || $_SESSION['dosen']){

if($_SESSION['admin']){
    $user_l = $_SESSION['admin'];
} else if($_SESSION['mahasiswa']){
    $user_l = $_SESSION['mahasiswa'];
} else if($_SESSION['dosen']){
    $user_l = $_SESSION['dosen'];
}

$sql_u  = $koneksi-> query("SELECT * FROM tb_user WHERE id ='$user_l'");
$data_u = $sql_u-> fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sistem Informasi Akademik</title>
<link rel="stylesheet" href="public/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="public/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="public/css/AdminLTE.min.css">
<link rel="stylesheet" href="public/css/skins/_all-skins.min.css">
<link href="public/dataTables/dataTables.bootstrap.css" rel="stylesheet">
<link rel="stylesheet" href="public/sw/dist/sweetalert.css">
<body class="hold-transition skin-blue sidebar-mini">

<!-- wrapper -->
<div class="wrapper">
    <!-- Main Header -->
    <header class="main-header">

        <!-- Logo -->
        <a href="index2.html" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini" style="font-style: italic; font-family: times new roman; font-size: 23px;"><b>STIE</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg" style="font-style: italic; font-family: times new roman; font-size: 23px; font-weight: bold;"><b>STIE</b> ASSHOLEH</span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>

          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
            <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->
                  <img src="img/<?= $data_u['foto']; ?>" class="user-image" alt="User Image">
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs"><?= $data_u['nama']; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  <li class="user-header">
                    <img src="img/<?= $data_u['foto']; ?>" class="img-circle" alt="User Image">

                    <p>
                      <?php echo $data_u['level']; ?>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                    <?php if( $_SESSION["admin"] ) : ?>
                      <a href="?page=profileAdmin&id=<?= $user_l; ?>" class="btn btn-default btn-flat">Profile</a>
                    <?php else : ?>
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    <?php endif; ?>
                    </div>
                    <div class="pull-right">
                      <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
               </li>
              </ul>
            </div>
        </nav>
    </header>

    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
          <div class="pull-left image">
            <?php if ($_SESSION['mahasiswa'] || $_SESSION['admin']) {?>
              <img src="img/<?= $data_u['foto']; ?>" class="user-image img-responsive" style="border-radius: 50%; width: 40px; height: 40px;">

            <?php } ?>   
                &nbsp; 
            <?php if ($_SESSION['dosen']) {?>
                <img src="img/<?= $data_u['foto']; ?>" class="user-image img-responsive" style="border-radius: 50%; width: 40px; height: 40px;">
            <?php } ?>
          </div>
          <div class="pull-left info">
            <p><?= $data_u['nama']; ?></p>
            <!-- Status -->
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
          <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
          </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
          <li>
              <a href="index.php"><i class="glyphicon glyphicon-home"></i><span> Dashboard</span></a>
          </li>

          <?php if ( $_SESSION['mahasiswa'] || $_SESSION['dosen'] ) {?>
          <li>
              <a href="?page=profile"><i class="glyphicon glyphicon-user"></i><span> Profile</span></a>
          </li>
          <?php } ?>

          <?php if ($_SESSION['admin'] ) {?>
          <li>
              <a href="?page=mahasiswa"><i class="glyphicon glyphicon-user"></i><span> Mahasiswa</span></a>
          </li>
		  <li>
              <a href="?page=kurikulum"><i class="glyphicon glyphicon-th"></i><span> Kurikulum</span></a>
          </li>
          <li>
              <a href="?page=dosen"><i class="glyphicon glyphicon-user"></i><span> Dosen</span></a>
          </li>
          <li>
              <a href="?page=jurusan"><i class="glyphicon glyphicon-edit"></i><span> Prodi</span></a>
          </li>
          <li>
              <a href="?page=matkul"><i class="glyphicon glyphicon-edit"></i><span> Mata Kuliah</span></a>
          </li>
          <li>
              <a href="?page=jadwal"><i class="glyphicon glyphicon-th-list"></i><span> Jadwal </span></a>
          </li>
          <li>
              <a href="?page=nilai"><i class="glyphicon glyphicon-th"></i><span> Nilai Mahasiswa </span></a>
          </li>
          <li>
              <a href="?page=ijazah"><i class="glyphicon glyphicon-education"></i><span> Ijazah </span></a>
          </li>
          <li>
              <a href="?page=user"><i class="glyphicon glyphicon-user"></i><span> User </span></a>
          </li>
          <li>
              <a href="?page=lock_unlock"><i class="glyphicon glyphicon-lock"></i><span> Lock-Unlock </span></a>
          </li>
          <?php } ?>

          <?php if ($_SESSION['dosen'] ) {?>
          <li>
              <a href="?page=nilai_d&dosen=<?php echo $_SESSION['username'];?>"><i class="glyphicon glyphicon-th"></i><span> Nilai Mahasiswa </span></a>
          </li>


          <li>
              <a href="?page=aturpre&dosen=<?php echo $_SESSION['username'];?>"><i class="glyphicon glyphicon-th-list"></i><span> Jadwal Dosen</span></a>
          </li>


          <?php } ?>

          <?php if ($_SESSION['mahasiswa']) {?>
          <li>
              <a   href="?page=krs"><i class="glyphicon glyphicon-th-large"></i><span> KRS</span></a>
          </li>
          <li>
              <a   href="?page=khs"><i class="glyphicon glyphicon-th-large"></i><span> KHS</span></a>
          </li>
          <?php } ?>
        </ul>
        <!-- /.sidebar-menu -->
      </section>
      <!-- /.sidebar -->
    </aside>

    <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Main content -->
      <section class="content">
                <?php
                    $page = $_GET['page'];
                    $aksi = $_GET['aksi'];

                    if( $page == "mahasiswa" ){
                        if( $aksi == "" ){
                            include "page/mahasiswa/mahasiswa.php";
                        } if( $aksi == "detail" ){
                            include "page/mahasiswa/detail.php";
                        } if( $aksi == "tambah" ){
                            include "page/mahasiswa/tambah.php";
                        } if( $aksi == "ubah" ){
                            include "page/mahasiswa/ubah.php";
                        } if( $aksi == "hapus" ){
                            include "page/mahasiswa/hapus.php";
                        } if( $aksi == "import_mhs" ){
                            include "page/mahasiswa/import_mhs.php";
                        } 
						
						
					}	if( $page == "kurikulum" ){
                        if( $aksi == "" ){
                            include "page/kurikulum/kurikulum.php";
                        } if( $aksi == "detail" ){
                            include "page/kurikulum/detail.php";
                        } if( $aksi == "tambah" ){
                            include "page/kurikulum/tambah.php";
                        } if( $aksi == "ubah" ){
                            include "page/kurikulum/ubah.php";
                        } if( $aksi == "hapus" ){
                            include "page/kurikulum/hapus.php";
                        } if( $aksi == "import_mhs" ){
                            include "page/kurikulum/import_mhs.php";
                        } 
						
						
						
						
                    } if( $page=="dosen" ) {
                        if( $aksi == "" ){
                            include "page/dosen/dosen.php";
                        } if( $aksi == "detail" ){
                            include "page/dosen/detail.php";
                        } if( $aksi == "tambah" ){
                            include "page/dosen/tambah.php";
                        } if( $aksi == "ubah" ){
                            include "page/dosen/ubah.php";
                        } if( $aksi == "hapus" ){
                            include "page/dosen/hapus.php";
                        } if( $aksi == "import_dosen" ){
                            include "page/dosen/import_dosen.php";
                        }

                    } if( $page == "jurusan" ){
                        if ($aksi == ""){
                            include "page/jurusan/jurusan.php";
                        }
                        if ($aksi == "tambah"){
                            include "page/jurusan/tambah.php";
                        }
                        if ($aksi == "ubah"){
                            include "page/jurusan/ubah.php";
                        }
                        if ($aksi == "hapus"){
                            include "page/jurusan/hapus.php";
                        }
                    } if( $page == "krs" ){
                        if ( $aksi == "" ){
                            include "page/krs/j_krs.php";
                        } if( $aksi == "lihat" ){
                            include "page/krs/krs.php";
                        } if( $aksi == "proses_tmbh" ){
                            include "page/krs/proses_krs.php";
                        } if( $aksi == "hapus" ){
                            include "page/krs/hapus_krs.php";
                        } if( $aksi == "ubah" ){
                            include "page/krs/ubah_krs.php";
                        }
                    } if($page == "jadwal" ){
                        if ( $aksi == "" ){
                            include "page/jadwal/jadwal.php";
                        } if ( $aksi == "tambah" ){
                            include "page/jadwal/tambah.php";
                        } if ( $aksi == "ubah" ){
                            include "page/jadwal/ubah.php";
                        } if ( $aksi == "ubah_pr" ){
                            include "page/jadwal/ubah_pr.php";
                        } if ( $aksi == "hapus" ){
                            include "page/jadwal/hapus.php";
                        } if( $aksi == "import_jadwal" ){
                            include "page/jadwal/import_jadwal.php";
                        }


                    } if($page == "aturpre" ){
                        if ( $aksi == "" ){
                            include "page/aturpre/aturpre.php";
                        } if ( $aksi == "tambah" ){
                            include "page/aturpre/tambah.php";
                        } if ( $aksi == "ubah" ){
                            include "page/aturpre/ubah.php";                        
                        } if ( $aksi == "hapus" ){
                            include "page/aturpre/hapus.php";
                        } if( $aksi == "import_jadwal" ){
                            include "page/aturpre/import_jadwal.php";
                        }



                    } if( $page =="matkul" ){
                        if ( $aksi == "" ){
                            include "page/matkul/matkul.php";
                        }if ( $aksi == "tambah" ){
                            include "page/matkul/tambah.php";
                        }if ( $aksi == "ubah" ){
                            include "page/matkul/ubah.php";
                        }if ( $aksi == "hapus" ){
                            include "page/matkul/hapus.php";
                        } if( $aksi == "import_matkul" ){
                            include "page/matkul/import_matkul.php";
                        }
                    } if( $page == "profile" ){
                      
                      if ($aksi=="") {
                          include "page/profile/profile.php";
                      } if( $aksi == "ubahpass" ){
                          include "page/profile/ubah_pass.php";
                      } if( $aksi == "ubahsmester" ){
                          include "page/profile/ubah_smester.php";
                      } if( $aksi == "ubahfoto" ){
                          include "page/profile/ubah_foto.php";
                      }
                    
                    } if( $page == "nilai" ){
                        if( $aksi == "" ){
                            include "page/nilai/tampil_mk.php";
                        } if( $aksi == "lihat_mhs" ){
                            include "page/nilai/tampil_nilai.php";
                        } if( $aksi == "edit" ){
                            include "page/nilai_dosen/edit.php";
                        }
                        if( $aksi == "input" ){
                            include "page/nilai/input.php";
                        }
                    } if( $page == "khs" ){
                        if( $aksi == "" ){
                            include "page/khs/khs.php";
                        } if( $aksi == "tampil_nilai" ){
                            include "page/nilai/tampil_nilai.php";
                        } if( $aksi == "input" ){
                            include "page/nilai/input.php";
                        }

                    } if( $page == "ijazah" ){
                        if ($aksi == ""){
                            include "page/ijazah/ijazah.php";
                        }
                        if ($aksi == "tambah"){
                            include "page/ijazah/tambah.php";
                        }
                        if ($aksi == "ubah"){
                            include "page/ijazah/ubah.php";
                        }
                        if ($aksi == "hapus"){
                            include "page/ijazah/hapus.php";
                        }

                    } if( $page == "user" ){
                        if ($aksi == ""){
                            include "page/user/user.php";
                        }
                        if ($aksi == "tambah"){
                            include "page/user/tambah.php";
                        }
                        if ($aksi == "ubah"){
                            include "page/user/ubah.php";
                        }
                        if ($aksi == "hapus"){
                            include "page/user/hapus.php";
                            }
                        if ($aksi == "ubahbanyak"){
                            include "page/user/ubahbanyak.php";
                        }


                    } if( $page=="lock_unlock" ) {
                        if( $aksi == "" ){
                            include "page/lock_unlock/lock_unlock.php";
                        } if( $aksi == "ubah_krs" ){
                            include "page/lock_unlock/ubah_krs.php";
                        } if( $aksi == "ubah_khs" ){
                            include "page/lock_unlock/ubah_khs.php";
                        } 


                    } if( $page == "nilai_d" ) {
                        if( $aksi == "" ) {
                            include "page/nilai_dosen/nilai.php";
                        } if( $aksi == "lihat_mhs" ){
                            include "page/nilai_dosen/lihat_mhs.php";
                        } if( $aksi == "edit" ){
                            include "page/nilai_dosen/edit.php";
                        } if( $aksi == "nilai" ){
                            include "page/nilai_dosen/input_nilai.php";
                        }

                    } if ($page=="") {
                        include "home.php";
                    } if( $page == "profileAdmin" ) {
                      include 'page/profile/profileAdmin.php';

                    }
                ?>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
</div>
<!-- akhir wrapper -->

<script src="public/jquery/jquery.min.js"></script>
<script src="public/bootstrap/js/bootstrap.min.js"></script>
<script src="public/dataTables/jquery.dataTables.js"></script>
<script src="public/dataTables/dataTables.bootstrap.js"></script>
<script src="public/sw/dist/sweetalert.min.js"></script>
<script src="public/js/adminlte.min.js"></script>
<script>
    $(document).ready(function () {
        $('#dataTables-example').dataTable({
          "scrollX" : true
        });
        
    });
</script>


<script>
    $(document).ready(function () {
        $('#dataTables-example1').dataTable({
          "scrollX" : true
        });
        
    });
</script>


</body>
</html>
<?php
    }else{
        header("location:login.php");
    }
?>