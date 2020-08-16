<?php
require_once 'engin/db.php';
/*
require_once  'engin/utilities.php';
if(isset($_POST['do-login'])){}
//array to hold errors
$form_errors=array();
//validate
$required_fields=array('email','password');

$form_errors=array_merge($form_errors,check_empty_fields($required_fields));

if(empty($form_errors)){
    //check if user exist in the database
}else{
    if(count($form_errors)==1){
        $result="<p style='color: #f00;'>There was one error in the form</p>";
    }else{
        $result="<p style='color: #f00;'>The re were ".count($form_errors)." errors in the form</p>";
    }
}*/

if(isset($_SESSION['loggedin'])){
    header('Location: UserDashboard.php');
}
?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="assets/css/all.min.css" rel="stylesheet">
<link href="assets/css/style_Sign_In.css" rel="stylesheet" type="text/css">
<link href="assets/css/style_Sign_Up.css" rel="stylesheet" type="text/css">

<body>
<header id="cabecalho">
    <a href="#" id="logo"><img src="assets/images/logo.png" style="width: 3rem;height: auto"><i>fastscroll</i></a>
    <nav dir="rtl">
        <a href="#" id="menu-icon"><img src="assets/images/menu-icon.png" style="width: 3rem;height: auto"> </a>
        <ul>
            <li><a href="index.php" class="btn"> خانه</a></li>
            <li><a href="AboutUs.php">درباره ما</a></li>
            <li><a href="ContactUs.php">تماس با ما</a></li>
            <li><a href="forum/controllers/Forum.php">انجمن</li></a>
        </ul>
    </nav>
</header>
<img src="assets/images/undraw_authentication_fsn5.svg" style="width: 50%" class="wave">
<div  class="container" dir="rtl">
    <div class="section-container">

        <?php //if(isset($result)) echo $result; ?>
        <?php //if(!empty($form_errors)) echo show_errors($form_errors); ?>


        <form action="engin/DoLogin.php" method="post">
            <div class="back-for-title"> <small><h1 class="text-for-title">ورود به حساب کاربری</h1></small></div>
            <img src="assets/images/profile.svg" class="avatar">

            <div class="input-div one">
                <div class="i">
                    <i class="fa fa-user-circle" aria-hidden="true" style="color:#8ab1f0;font-size:12px"></i>
                </div>
                <div>
                    <input class="input" type="text" name="email" placeholder="">
                    <label><small>نام کاربری(ایمیل)</small></label>
                </div>
            </div>
            <div class="input-div two">
                <div class="i">
                    <i class="fas fa-lock" style="color:#8ab1f0;font-size:12px"></i>
                </div>
                <div>
                    <input class="input" name="password" type="password">
                    <label><small>رمز عبور</small></label>
                </div>
            </div>

            <input type="submit" name="do-login" class="button-form-submit text-light" value="ورود">
            <div class="inline-flex">
                <a href="#" class="link">آیا رمز عبور خود را فراموش کرده اید؟</a>&nbsp;<span class="fas fa-line-columns" style="color: #0d6ca0"> </span>&nbsp;&nbsp;&nbsp;
                <a href="SignUp.php" class="link"> آیا ثبت نام نکرده اید؟</a>
            </div>
        </form>
    </div>

</div>

<script type="text/javascript" src="assets/js/main.js"></script>
</body>
</html>