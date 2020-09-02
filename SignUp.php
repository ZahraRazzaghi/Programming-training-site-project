<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="X-UA-Compatible" content="ie=edge">
    <title>Registretion</title>
</head>
<link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="assets/css/style-Sign-Up.css" rel="stylesheet" type="text/css">
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
<img src="assets/images/sign_up_image.svg" class="wave">
<!-- End Big SVG -->

<div class="container">
    <!-- Start form section -->
    <div id="users" class="section-container">
        <form action="engin/DoRegister.php" method="post" dir="rtl">
            <h1 class="text-for-title">ثبت نام</h1>

            <p id="msg_place"></p><br>
            <div class="input-div one">
                <img src="assets/images/sign-in-up/user-shield.png" width="30px">
                <div>
                    <input type="text" name="display-name" class="input" id="DisplayName_input" required>
                    <label for="displayname_input" style="padding-bottom: 16pt; font-size: 12pt">نام شما</label>
                </div>
            </div>
            <div class="input-div two">
                <img src="assets/images/sign-in-up/email.png" width="30px">
                <div>
                    <input onblur="chechEmail();" type="text" name="email" class="input" id="Email_input"  required>
                    <label for="Email_input" style="padding-bottom: 16pt; font-size: 12pt">ایمیل</label>
                </div>
            </div>
            <div class="input-div tree">
                <img src="assets/images/sign-in-up/password.png" width="30px">
                <div>
                    <input minlength="4" maxlength="64"onblur="checkPass();" type="password" name="password" class="input" id="Password_input" required>
                    <label for="password_input" style="padding-bottom: 16pt; font-size: 12pt" >رمز عبور</label>
                </div>
            </div>
            <div class="input-div four">
                <img src="assets/images/sign-in-up/password.png" width="30px">
                <div>
                    <input minlength="4" maxlength="64" onkeyup="checkPass();" type="password" name="password-confirm" class="input" id="PasswordConfirm_input" required>
                    <label for="passwordconfirm_input" style="padding-bottom: 16pt; font-size: 12pt">تکرار رمز عبور</label>
                </div>
            </div>
            <input type="submit" id="reg_btn" onclick="" name="do-register" value="ثبت نام" class="button-form-submit">
            <a href="SignIn.php" class="btn sign-in-button">ورود</a>
        </form>
    </div>
    <!-- End form section -->
</div>
<!-- Script Links And Codes -->
<script src="assets/js/jquery-3.4.1.min.js"></script>
<script src="assets/js/sweetalert.js"></script>
<script>
    var msg = document.getElementById('msg_place');
    var email = document.getElementById('Email_input');
    var password = document.getElementById('Password_input');
    var passwordConf = document.getElementById('PasswordConfirm_input');
    //if pass and pass conf not equal run this code while input onkeyup event acurrd
    function checkPass() {
        if(password.value == passwordConf.value){
            msg.innerHTML = "";
        }
        else{
            msg.innerHTML = "رمز عبور با تکرار آن برابر نیست";
        }
        if(password.length < 4){
            msg.innerHTML = "طول کلمه عبور حداقل باید 4 کاراکتر باشد";
        }
    }
    //if email format not correct run this script
    function chechEmail() {
        var at=email.indexOf("@");
        var dot=email.lastIndexOf(".");
        if(at<1||dot<at+2||dot+2>=email.length)
        {
            msg.innerHTML = "ایمیل وارد شده صحیح نمی باشد";
        }
    }

</script>
</body>
</html>