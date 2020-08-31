<?php
require_once 'engin/db.php';


if(isset($_POST['submit'])){
    $email = mysqli_real_escape_string($db,$_POST['email']);
    $query = "select * from users_tbl WHERE  Usr_UserName='$email'";//find this email on db
    $run = mysqli_query($db,$query);
    if(mysqli_num_rows($run)>0){
        $row = mysqli_fetch_array($run);
      //  $db_email = $row['email'];
       // $db_id = $row['id'];
        $token = uniqid(md5(time())); //This is a random token==seed is time for create random numbers.
        $query = "INSERT INTO pass_reset_tbl(id,email,token) VALUES(NULL,'$email','$token')";
        if(mysqli_query($db,$query)){//اگه کوئری اجراشد/ایمیل بازیابی ارسال شد
            //ایمیل بازیابی زیر در صورت آنلاین شدن ارسال میشه
          //  $to = $db_email;
            $subject = "Password reset link";
            $message = "Click <a href='https://fastscroll.com/ResetPassword.php?token=$token'>here</a>to reset your password.";
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers = "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers = 'From:<demo@demo.com>' . "\r\n";
           // mail($to,$subject,$message,$headers); //به طور موقت کامنتش کردم
            //i am commenting this mail function because i'm on loacalhost and we cannot use send php mail function on localhost without smtp.
            //but if i run on live server the php mail function will work and send the link to email.
            $msg = "<div class='alert alert-success'> ایمیل بازیابی برای شما ارسال شد.</div>";
        }
    }else{
        $msg = "<div class='alert alert-danger'>کاربری با این ایمیل پیدا نشد</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="X-UA-Compatible" content="ie=edge">
    <title>فراموشی رمز عبور</title>
</head>
<link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="assets/css/style_Sign_In.css" rel="stylesheet" type="text/css">
<link href="assets/css/style-top-menu.css" rel="stylesheet" type="text/css">
<body>
<!-- Start Header -->
<header id="cabecalho">
    <a href="#" id="logo"><img src="assets/images/logo.png" style="width: 3rem;height: auto"><i>fastscroll</i></a>
    <nav dir="rtl">
        <a href="#" id="menu-icon"><img src="assets/images/menu-icon.png" style="width: 3rem;height: auto"> </a>
        <ul>
            <li><a href="index.php" class="btn" style="transition: 119ms;"> خانه</a></li>
            <li><a href="AboutUs.php" class="btn" style="transition: 119ms;">درباره ما</a></li>
            <li><a href="ContactUs.php" class="btn" style="transition: 119ms;">تماس با ما</a></li>
            <li><a href="forum/controllers/Forum.php" class="btn" style="transition: 119ms;">انجمن</a></li>
        </ul>
    </nav>
</header>
<!-- End Header -->
<!-- Start Big SVG -->
<img src="assets/images/forgot_password.svg" style="width: 50%" class="wave">
<!-- End Big SVG -->
<div  class="container" dir="rtl">
    <!-- Start Login Form -->
    <div class="section-container">
        <form action="" method="post">
            <h1 class="text-for-title">بازیابی رمز عبور</h1>

            <!--Start Profile Pic -->
            <img src="assets/images/#" class="avatar">
            <!--End Profile Pic -->
            <div class="input-div one">
                <i aria-hidden="true"><img src="assets/images/sign-in-up/email.png" width="30px"></i>
                <div>
                    <input class="input" type="text" name="email" id="email" required>
                    <label for="email" style="padding-bottom: 10pt; font-size: 12pt">ایمیل</label>
                </div>
            </div>
            <?php if(isset($msg)){echo $msg;} ?>
            <input type="submit" name="submit" class="button-form-submit text-light" value="ارسال">
        </form>
    </div>
    <!-- End Login Form -->
</div>
</body>
</html>