<?php include('../config/connect.php');
$msg = '';
 $actions_post = '';
// ตรวจพบ session user_admin และ status_login หน้า login จะเข้า index อัตโนมัติ
if (isset($_SESSION['user_admin'])) {
if ($_SESSION['user_admin'] != "" && $_SESSION['status_login'] === true) {
    header('location:index.php');
}
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Boukensha Guild | Login</title>

    <!-- favicon -->
    <link rel="icon" type="image/png" href="../img/ico/icon.png" />

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Favicons -->
    <link href="../assets/img/favicon.png" rel="icon">
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .img-logo:hover {
            cursor: pointer;
            opacity: 0.8;
            filter: alpha(opacity=80);
        }

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
            background: url('dist/img/Preloader_2.gif') center no-repeat #fff;
        }

        body::before {
            content: "";
            /* Important */
            z-index: -1;
            /* Important */
            position: inherit;
            left: inherit;
            top: inherit;
            width: inherit;
            height: inherit;
            background-image: inherit;
            background-size: cover;
            filter: blur(3px);
        }

        body {
            background-image: url("dist/img/wallpaperflare.com_wallpaper.jpg");
            background-size: 0 0;
            /* Image should not be drawn here */
              -webkit-background-size: cover;
              -moz-background-size: cover;
              -o-background-size: cover;
              background-size: cover;
            /* Or absolute for scrollable backgrounds */
        }
    </style>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css" />
    <!-- Custom styles for this template -->
    <link href="dist/css/signin.css" rel="stylesheet">
</head>

<body class="text-center bg-dark">
    <div class="se-pre-con"></div>
    <main class="form-signin">
        <!-- เปลี่ยนดีไซน์ใหม่เพื่อรองรับการย่อหน้าจอแบบมือถือได้ -->
        <?php
        if (isset($_POST['submit'])) {

            $username = mysqli_real_escape_string($conn, $_POST['username']); // Protect SQL Injection ป้องกัน sql Injection 
            $password = mysqli_real_escape_string($conn, md5($_POST['password'])); // Protect SQL Injection ป้องกัน sql Injection

            $sql = " SELECT * FROM user_admin WHERE username='$username' AND password='$password' ";

            $res = mysqli_query($conn, $sql);
            $rs = mysqli_fetch_assoc($res);

            $count = mysqli_num_rows($res);

            if ($count == 1) {
                $msg = "<div class='alert alert-success'>Login Successful.</div>";
                $_SESSION['user_admin'] = $rs['full_name']; //To check whether the user is logged in or not and logout will unset it
                $_SESSION['status_login'] = true; // To
                header("refresh:3;url=index.php");
                $actions_post = 'success';
                $msg = "<div class='alert alert-success'><i class=\"far fa-check-circle\"></i> เข้าสู่ระบบสำเร็จ <br><i class=\"fas fa-hourglass-half\"></i> โปรดรอสักครู่</div>";
            } else {
                $msg = "<div class='alert alert-danger'><i class=\"fas fa-exclamation-circle\"></i> ชื่อผู้ใช้ หรือ รหัสผ่าน <br>ไม่ถูกต้องโปรดตรวจสอบใหม่</div>";
            }
        }

        ?>
        <?php
        if ($msg != "") {
            echo $msg;
        }
        ?>
        <?php if ($actions_post != 'success') { ?>
            <form action="" method="POST">
                <i class="fab fa-guilded text-light fa-4x mb-2 img-logo" onclick="javascript:location.href='../index.php'" data-bs-toggle="tooltip" data-bs-placement="top" title="กลับสู่หน้าหลัก"></i>
                <h1 class="h3 mb-3 fw-normal text-light fw-bold"><span class="text-dark">Boukensha</span><span class="text-danger"> Guild</span></h1>
                <div class="form-floating">
                    <input type="text" class="form-control" name="username" id="floatingInput" placeholder="Username">
                    <label for="floatingInput">ชื่อผู้ใช้</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">รหัสผ่าน</label>
                </div>
                <button class="w-100 btn btn-lg btn-primary" type="submit" name="submit" value="Login">Login</button>
            </form>
        <?php } ?>
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js" integrity="sha512-DUC8yqWf7ez3JD1jszxCWSVB0DMP78eOyBpMa5aJki1bIRARykviOuImIczkxlj1KhVSyS16w2FSQetkD4UU2w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
    <script>
        //paste this code under the head tag or in a separate js file.
        // Wait for window load
        $(window).load(function() {
            // Animate loader off screen
            $(".se-pre-con").fadeOut("slow");;
        });
    </script>
</body>

</html>