<?php
require_once '../engin/db.php';
require_once 'engin/DoLogin.php';
if(isset($_SESSION['AdminLogin'])){
    header('Location: AdminDashboard.php');
}
//
//mysqli_query($db,"update AdminPassword set AdminPassword=md5(27626) where Admin_Name='Zahra Razzaghi'");
?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="X-UA-Compatible" content="ie=edge">
    <title>ورود</title>
</head>
<link href="../../assets/css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="../../User/css/style-Sign-In.css" rel="stylesheet" type="text/css">
<link href="../../assets/css/style-top-menu.css" rel="stylesheet" type="text/css">
<body>
<!-- Start Header -->
<header id="cabecalho">
    <a href="#" id="logo" style="padding-top: 5px;"><img src="../../assets/images/logo.png" style="width: 2.2rem;"><i>fastscroll</i></a>
    <nav dir="rtl">
        <a href="#" id="menu-icon" style="padding-top: 5px;"><img src="../../assets/images/menu-icon.png" style="width: 2.3rem;"> </a>
        <ul>
            <li><a href="../../index.php" class="btn home" style="transition: 119ms;"><img src="../../assets/images/home-page-logo.png"></a></li>
            <li><a href="../../AboutUs.php" class="btn" style="transition: 119ms;">درباره ما</a></li>
            <li><a href="../../ContactUs.php" class="btn" style="transition: 119ms;">تماس با ما</a></li>
            <li><a href="../../forum/controllers/Forum.php" class="btn" style="transition: 119ms;">انجمن</a></li>
        </ul>
    </nav>
</header>
<!-- End Header -->
<!-- Start Big SVG -->
<img src="../../assets/images/Freelancer.svg" style="width: 50%" class="wave">
<!-- End Big SVG -->
<div  class="container" dir="rtl">
    <!-- Start Login Form -->
    <div class="section-container">
        <form action="" method="post">
            <h1 class="text-for-title">ورود مدیر سایت</h1>
            <p id="msg_place"></p><br>
            <!--Start Profile Pic -->
            <img src="images/AdminPics/admin.png" class="avatar">
            <!--End Profile Pic -->
            <div class="input-div one">
                <i aria-hidden="true"><img src="../../assets/images/sign-in-up/email.png" width="30px"></i>
                <div>
                    <input class="input" type="text" name="email" id="email" required>
                    <label for="email" style="padding-bottom: 10pt; font-size: 12pt">ایمیل</label>
                </div>
            </div>
            <div class="input-div two">
                <i><img src="../../assets/images/sign-in-up/password.png" width="30px"></i>
                <div>
                    <input class="input" name="password" type="password" id="password" required>
                    <label for="password" style="padding-bottom: 10pt; font-size: 12pt">رمز عبور</label>
                </div>
            </div>
            <?php echo $msg;?>
            <input type="submit" name="do-login" class="button-form-submit text-light" value="ورود">
            <div class="inline-flex">
                <a href="../../User/ForgetPassword.php" class="link">آیا رمز عبور خود را فراموش کرده اید؟</a>
            </div>
        </form>
    </div>
    <!-- End Login Form -->
</div>

<script src="../../assets/js/jquery-3.4.1.min.js"></script>
<script src="../../assets/js/bootstrap.js"></script>
<script src="../../assets/js/popper.min.js"></script>

</body>
</html>