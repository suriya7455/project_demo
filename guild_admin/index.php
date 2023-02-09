<?php
// Session start and Connect database
include('../config/connect.php');
include('../config/function.php');
/*ดรวจสอบ sesion user_admin ไม่เท่ากับค่าว่าง และ status_login มีค่าเท่ากับ ture (1) 
สามารถ login เข้าสู่ระบบได้อย่างถูกต้อง ไม่เข้าเงื่อนไขจะส่งกลับไปหน้า login.php */
if ($_SESSION['user_admin'] != "" && $_SESSION['status_login'] === true) {
} else {
  header('location:login.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Boukensha Guild | Admin</title>

  <!-- Favicons -->
  <link rel="icon" type="image/png" href="../img/ico/icon.png" />

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">

  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">

  <!-- Custom styles for this page -->
  <link href="plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  <!-- fancybox -->
  <link href="plugins/fancybox/fancybox.css" rel="stylesheet" />

  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">

  <!-- For Before Upload -->
  <link href="plugins/bootstrap-fileinput/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
  <link href="plugins/bootstrap-fileinput/themes/explorer-fas/theme.css" media="all" rel="stylesheet" type="text/css" />

  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

  <!--  bootstrap-icons-->
  <link rel="stylesheet" href="./plugins/bootstrap-icons-1.7.2/bootstrap-icons.css">

  <style>
    /* Paste this css to your style sheet file or under head tag */
    /* This only works with JavaScript,
        if it's not present, don't show loader */

    .no-js #loader {
      display: none;
    }

    .js #loader {
      display: block;
      position: absolute;
      left: 100px;
      top: 0;
    }

    .se-pre-con {
      position: fixed;
      left: 0px;
      top: 0px;
      width: 100%;
      height: 100%;
      z-index: 9999;
      background: url('../assets/img/Preloader_2.gif') center no-repeat #fff;
    }

    /* .note-group-select-from-files {
      display: none;
    } */
  </style>
</head>

<body class="hold-transition sidebar-mini">
  <!-- <div class="se-pre-con"></div> -->
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="javascript:;" role="button" onclick="logouts('logout.php')">
            <i class="fas fa-sign-out-alt"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="../index.php" target="_blank" class="brand-link">
        <i class="fab fa-guilded fa-lg brand-image pt-1"></i>
        <span class="brand-text font-weight-light">Boukensha Guild</span>
      </a>

      <!-- Sidebar -->
      <!-- นำเข้า sidebar เมนูด้านซ้ายจาก floder layout -->
      <?php include('layout/sidebar-menu.php'); ?>
      <!-- /.sidebar -->
    </aside>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <!-- นำเข้าหัวข้อ -->
            <?php include('content_topic.php'); ?>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- require file admin -->
        <?php require('file_request.php'); ?>
        <!-- /.require file admin -->

      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
      <div class="float-right d-none d-sm-block">
        <b>Version</b> 1.0.0
      </div>
      <strong>Copyright &copy; 2021-<?= date('Y') ?> Boukensha Guild </strong> All rights reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- <script src="dist/js/jquery-1.12.4.min.js"></script> -->
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>

  <!-- Summernote -->
  <script src="plugins/summernote/summernote-bs4.min.js"></script>
  <!-- include summernote-th-TH -->
  <script src="plugins/summernote/lang/summernote-th-TH.min.js"></script>

  <!-- AdminLTE for demo purposes -->
  <!-- <script src="dist/js/demo.js"></script> -->

  <!-- Datatable -->
  <script src="plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="plugins/datatables/dataTables.bootstrap4.min.js"></script>
  <script src="plugins/datatables/data.th.js"></script>

  <!-- fancybox -->
  <script src="plugins/fancybox/fancybox.umd.js"></script>

  <!-- Sweetalert2 -->
  <script src="plugins/sweetalert2/sweet-alert2.min.js"></script>

  <!-- Before Upload -->
  <script src="plugins/bootstrap-fileinput/js/plugins/piexif.js" type="text/javascript"></script>
  <script src="plugins/bootstrap-fileinput/js/plugins/sortable.js" type="text/javascript"></script>
  <script src="plugins/bootstrap-fileinput/js/fileinput.js" type="text/javascript"></script>
  <script src="plugins/bootstrap-fileinput/js/locales/th.js" type="text/javascript"></script>
  <script src="plugins/bootstrap-fileinput/themes/fas/theme.js" type="text/javascript"></script>
  <script src="plugins/bootstrap-fileinput/themes/explorer-fas/theme.js" type="text/javascript"></script>

  <!-- Select2 -->
  <script src="plugins/select2/js/select2.full.min.js"></script>

  <!-- User -->
  <script src="dist/js/jquery-user-app.js"></script>

  <script>
    $('#image_name').on('change', function() {
      //get the file name
      var fileName = $(this).val();
      //replace the "Choose a file" label
      $(this).next('.custom-file-label').html(fileName);
    })

    $('.file-name').on('change', function() {
      //get the file name
      var fileName = $(this).val();
      //replace the "Choose a file" label
      $(this).next('.custom-file-label').html(fileName);
    })

    //paste this code under the head tag or in a separate js file.
    // Wait for window load
    // $(window).load(function() {
    //   // Animate loader off screen
    //   $(".se-pre-con").fadeOut("slow");;
    // });
  </script>

  <!-- map -->
</body>

</html>