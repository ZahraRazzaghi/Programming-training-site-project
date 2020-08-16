<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="X-UA-Compatible" content="ie=edge">
    <title>Registretion</title>
</head>
<link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="assets/css/all.min.css" rel="stylesheet" type="text/css">
<link href="assets/css/style-Sign-Up.css" rel="stylesheet" type="text/css">
<body>
<header id="cabecalho">
    <a href="#" id="logo"><img src="assets/images/logo.png" style="width: 3rem;height: auto"><i>fastscroll</i></a>
    <nav dir="rtl">
        <a href="#" id="menu-icon"><img src="assets/images/menu-icon.png" style="width: 3rem;height: auto"> </a>
        <ul>
            <li><a href="index.php"> خانه</a></li>
            <li><a href="AboutUs.php">درباره ما</a></li>
            <li><a href="ContactUs.php">تماس با ما</a></li>
            <li><a href="forum/controllers/Forum.php">انجمن</li></a>
        </ul>
    </nav>
</header>
<?php
require_once 'engin/db.php';
/*
require_once 'engin/utilities.php';

//process the form
if(isset($_POST['do-register'])){
    //initialize an array to store any error message from thr form
    $form_errors=array();

    //form validation
    $_required_fields=array('display-name','email','password');

    //loop through the required fields array
    foreach($_required_fields as $som_of_fields){
        if(!isset($_POST[$name_of_field]) || $_POST[$name_of_field]==NULL){
            $form_errors[]=$name_of_field;
        }
    }

    //check if error array is empty, if yes process form data and insert record
    if(empty($form_errors)){
        //collect form data and store in variables
        $display_name=$_POST['display-name'];
        $email=$_POST['email'];
        $password=$_POST['password'];
        //hashing the password
        $hashed_password=md5($password,PASSWORD_DEFAULT);
        try{
            //create SQL insert statement
            $sqlI
        }
    }
    //call the function to check empty field and merge the return data into form_error array
    $form_errors=array_merge($form_errors,check_empty_fields($required_fields));

    //Fields that requires checking for minimum length
    $fields_to_check_length=array('username' => 4,'password');

    //call the function to check minimum required length and merge the return data into form_error array
    $form_errors=array_merge($form_errors,check_min_length($fields_to_check_length));
}
*/
if(isset($_SESSION['loggedin'])){
    echo "<p style='padding:28px;color: darkolivegreen; '>ثبت نام با موفقیت انجام شد!</p>";
}else{
    $msg="<p style='padding:28px;color: darkred; '>خطایی رخ داده</p>";
}

?>

<img src="assets/images/sign_up_image.svg" class="wave">

<div class="container">

<div id="users" class="section-container">

    <form action="engin/DoRegister.php" method="post" onsubmit="onsubmit="Swal.fire(
    'می توانید وارد شوید',
    'اطلاعات حساب شما ثبت شد',
    'success');">

    <div class="back-for-title"> <small><h1 class="text-for-title">ثبت نام</h1></small></div>

        <p id="msg_place"></p><br>

        <div class="input-div one">
            <div class="i">
                <i class="fas fa-user-edit" style="color:#8ab1f0;font-size:12px"></i>
            </div>
            <div>
                <input type="text" name="display-name" class="input" id="DisplayName_input">
                <label><small>نام شما</small></label>
            </div>
        </div>

        <div class="input-div two">
            <div class="i">
                <i class="fas fa-mail-bulk" style="color:#8ab1f0;font-size:12px"></i>
            </div>
            <div>
                <input type="text" name="email" class="input" id="Email_input">
                <label><small>ایمیل</small></label>
            </div>
        </div>

        <div class="input-div tree">
            <div class="i">
                <i class="fas fa-user-lock" style="color:#8ab1f0;font-size:12px"></i>
            </div>
            <div>
                <input type="password" name="password" class="input" id="Password_input">
                <label><small>رمز عبور</small></label>
            </div>
        </div>

        <div class="input-div four">
            <div class="i">
                <i class="fas fa-user-lock" style="color:#8ab1f0;font-size:12px"></i>
            </div>
            <div>
                <input type="password" name="password-confirm" class="input" id="PasswordConfirm_input">
                <label><small>تکرار رمز عبور</small></label>
            </div>
        </div>
        <input type="submit" id="reg_btn" onclick="ShowMsg();" name="do-register" value="ثبت نام" class="button-form-submit">
    <a href="SignIn.php" class="btn link sign-in-button">ورود</a>
    </form>
    
</div>
</div>


<script src="assets/js/sweetalert.js"></script>
<script>
    function ShowMsg() {
        var D=document.getElementById("DisplayName_input").value;
        var E=document.getElementById("Email_input").value;
        var P=document.getElementById("Password_input").value;
        var PC=document.getElementById("PasswordConfirm_input").value;
            if (D==""||E==""||P==""||PC=="") {
            }
                document.getElementById("msg_place").innerHTML="تمام فیلد ها باید پر شوند";
                reg_btn.disabled = true;
            }
    if(P.value!=PC.value||PC.value!=P.value){
        document.getElementById("msg_place").innerHTML="رمز عبور باید با تکرار آن برابر باشد!";
    }

</script>
</body>
</html>