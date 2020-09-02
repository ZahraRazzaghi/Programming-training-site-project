<?php
require_once 'engin/db.php';
if(isset($_GET['token'])){
    $token = mysqli_real_escape_string($db,$_GET['token']);
    $query = "select * from pass_reset_tbl WHERE token='$token'";
    $run = mysqli_query($db,$query);
    if(mysqli_num_rows($run)>0){
        $row = mysqli_fetch_array($run);
       $token = $row['token'];
       $email = $row['email'];
    }else{
        header("location: SignIn.php");
    }
}

if(isset($_POST['submit'])){
    $password = mysqli_real_escape_string($db,$_POST['password']);
    $passwordConf = mysqli_real_escape_string($db,$_POST['passwordConfirm']);
    $options = ['cost'=>11];
    if($password!=$passwordConf){
        $msg = "<div class='alert alert-danger'>متاسفیم، رمز عبور با تکرار آن مطابقت ندارد!</div>";
    }elseif(strlen($password)<4){
        $msg = "<div class='alert alert-danger'>رمز عبور باید حداقل 4 کاراکتر باشد.</div>";
    }else{
        $hashed = md5($password);
        $query = "update users_tbl set Usr_Password='$hashed'where Usr_UserName='$email'";
        mysqli_query($db,$query);
        $query = "delete from pass_reset WHERE email='$email'";
        mysqli_query($db,$query);
        $msg = "<div class='alert alert-success'>رمز عبور بروزرسانی شد.</div>";
        $db->close();
    }
}
?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="X-UA-Compatible" content="ie=edge">
    <title>بازنشانی رمز عبور</title>
</head>
<link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="assets/css/style-Sign-In.css" rel="stylesheet" type="text/css">
<link href="assets/css/style-top-menu.css" rel="stylesheet" type="text/css">
<body>
<!-- Start Header -->
<header id="cabecalho">
    <a href="#" id="logo" style="padding-top: 5px;"><img src="assets/images/logo.png" style="width: 2.2rem;"><i>fastscroll</i></a>
    <nav dir="rtl">
        <a href="#" id="menu-icon" style="padding-top: 5px;"><img src="assets/images/menu-icon.png" style="width: 2.3rem;"> </a>
        <ul>
            <li><a href="index.php" class="btn home" style="transition: 119ms;"><img src="assets/images/home-page-logo.png"></a></li>
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
            <h1 class="text-for-title">بازنشانی رمز عبور</h1>

            <!--Start Profile Pic -->
            <img src="assets/images/#" class="avatar">
            <!--End Profile Pic -->
            <div class="input-div two">
                <img src="assets/images/sign-in-up/email.png" width="30px">
                <div>
                    <input value="<?php echo $email; ?>" onblur="chechEmail();" type="text" name="email" class="input" readonly>
                    <label for="Email_input" style="padding-bottom: 16pt; font-size: 12pt">ایمیل</label>
                </div>
            </div>
            <div class="input-div tree">
                <img src="assets/images/sign-in-up/password.png" width="30px">
                <div>
                    <input minlength="4" maxlength="64"onblur="checkPass();" type="password" name="password" class="input" required>
                    <label for="password_input" style="padding-bottom: 16pt; font-size: 12pt" >رمز عبور</label>
                </div>
            </div>
            <div class="input-div four">
                <img src="assets/images/sign-in-up/password.png" width="30px">
                <div>
                    <input minlength="4" maxlength="64" onkeyup="checkPass();" type="password" name="passwordConfirm" class="input"  required>
                    <label for="passwordconfirm_input" style="padding-bottom: 16pt; font-size: 12pt">تکرار رمز عبور</label>
                </div>
            </div>
            <?php if(isset($msg)){echo $msg;} ?>
            <input type="submit" name="submit" class="button-form-submit text-light" value="بازنشانی رمز عبور">
            <p><?php ?></p><br>
        </form>
    </div>
    <!-- End Login Form -->
</div>
</body>
</html>