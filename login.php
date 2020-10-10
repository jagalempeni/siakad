<?php
    error_reporting(0);
    ob_start();
    session_start();
    require 'models/functions.php';
    if($_SESSION['admin'] || $_SESSION['mahasiswa'] || $_SESSION['dosen']){
        header("location:index.php");
    }else{
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="icon" type="image/png" href="logo.png">
    <title>Halaman Login</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="public/bootstrap/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="public/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="public/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body>
    <div class="container">
        <div class="row text-center ">
            <div class="col-md-12">
                <br /><br /><br /><br />
                <img src="logo.png" alt="Logo" height="100" width="100">
				<br />
				<h2 style="color:black;">SISTEM AKADEMIK <br>KAMPUS PMKM</h2><br><br>


            </div>
        </div>
         <div class="row ">

                  <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                        <center><strong>  Masukan Username dan Password </strong></center>
                            </div>
                            <div class="panel-body">
                                <form role="form" method="POST">
                                       <br />
                                     <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
                                            <input class="form-control" placeholder="Username" name="username"  autofocus>
                                        </div>
                                            <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                           <input class="form-control" placeholder="Password" name="pass" type="password" value="">
                                        </div>


                                    <input  type="submit" name="login" class="btn btn-lg btn-success btn-block" value="Login"/>
                                    </form>
        <?php
        $username = mysqli_real_escape_string($koneksi, $_POST['username']);
        $pass     = mysqli_real_escape_string($koneksi, $_POST['pass']);
        $login    = $_POST['login'];
        if($login){
            $sql   = $koneksi->query("SELECT * FROM tb_user WHERE id = '$username' AND pass = '$pass' ");
          $ketemu = $sql->num_rows;
          $data   = $sql->fetch_assoc();
            if($ketemu >= 1){
              session_start();
            $_SESSION['username'] = $data ['id'];
            $_SESSION[pass]       = $data [pass];
            $_SESSION[level]      = $data [level];
              
              if($data['level'] == "admin"){
                  $_SESSION['admin'] = $data[id];
                  header("location:index.php");
              } else if($data['level'] == "mahasiswa"){
                  $_SESSION['mahasiswa'] = $data[id];
                  header("location:index.php");

              }else if($data['level'] == "dosen"){
                  $_SESSION['dosen'] = $data[id];
                  header("location:index.php");
              }
            } else{ ?>
              <script type="text/javascript">
                  alert("Login Gagal Username dan Password Salah.. Silahkan Ulangi Lagi !");
              </script>
        <?php } } ?>

    </div>
</div>
<div class="clear" style="clear: both;"></div>

<style>
body { 
 background: url(bg.jpg) no-repeat center center fixed; 
 -webkit-background-size: cover;
 -moz-background-size: cover;
 -o-background-size: cover;
 background-size: cover;
}
</style>

<script src="public/jquery/jquery.min.js"></script>
<script src="public/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
<?php }