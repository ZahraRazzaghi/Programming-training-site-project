<!DOCTYPE html>
<html dir="rtl" lang="fa">
<head>
    <meta charset="UTF-8">
    <title>Do Register</title
</head>
<body>
<?php
require_once 'db.php';
$display_name=$_POST["display-name"];
$email=$_POST["email"];
$password=md5($_POST["password"]);
$password_confirm=md5($_POST["password-confirm"]);

if (strlen($display_name) == 0) {
    die("لطفا نام خود را وارد کنید");
}
if (strlen($password) == 0) {
    die("لطفا رمز عبور خود را وارد کنید");
}
if (strlen($password_confirm) == 0) {
    die("لطفا تکرار رمز عبور خود را وارد کنید");
}
if (!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/', $email)) {
    die("آدرس پست الکترونیک شما معتبر نمی باشد لطفا آن را بررسی نموده و دوباره امتحان کنید");
}
if($password != $password_confirm){
    echo "رمز عبور با تکرار آن برابر نیست";
}

if(isset($_POST['display-name']) && isset($_POST['email']) && isset($_POST['password'])&&isset($_POST['password-confirm'])) {

    $display_name = mysqli_real_escape_string($db, $_POST['display-name']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = md5($_POST['password']);

    $result=mysqli_query($db, "SELECT Usr_UsrName FROM users_tbl WHERE Usr_UsrName='$email'");
    $rows=mysqli_num_rows($result);
    if ($rows > 0){
        die("این ایمیل قبلا ثبت نام شده");

    }else{
       $sqlInsert=mysqli_query($db,"INSERT INTO users_tbl(Usr_DisplayName,Usr_UserName,Usr_Password,Usr_joinDate) VALUES('$display_name','$email','$password',now())") or die (mysqli_error($db));
        header('Location: ../Registration.php');
    }
}
?>
</body>
</html>
