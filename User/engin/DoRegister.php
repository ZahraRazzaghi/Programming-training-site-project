<!DOCTYPE html>
<html dir="rtl" lang="fa">
<head>
    <meta charset="UTF-8">
    <title>Do Register</title
</head>
<link href="../../assets/css/bootstrap.css">
<body>
<?php
ini_set('display_errors', '0');//Don't show php errors
require_once 'db.php';
$display_name=$_POST["display-name"];
$email=$_POST["email"];
$password=md5($_POST["password"]);
$password_confirm=md5($_POST["password-confirm"]);


if(isset($_POST['display-name']) && isset($_POST['email']) && isset($_POST['password'])&&isset($_POST['password-confirm'])) {

    $display_name = mysqli_real_escape_string($db, $_POST['display-name']);
    $email = mysqli_real_escape_string($db, $_POST['email']);

    if (empty($display_name)) {
        echo "<div class='alert alert-danger'>لطفا نام خود را وارد کنید</div>";
        die();
    }
    elseif (empty($password)) {
        echo "<div class='alert alert-danger'>لطفا رمز عبور خود را وارد کنید</div>";
        die();
    }
    elseif (empty($password_confirm)) {
        echo "<div class='alert alert-danger'>لطفا تکرار رمز عبور خود را وارد کنید</div>";
        die();
    }
    elseif (empty($email)) {
        echo "<div class='alert alert-danger'>لطفا ایمیل خود را وارد کنید</div>";
        die();
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<div class='alert alert-danger'>آدرس پست الکترونیک شما معتبر نمی باشد لطفا آن را بررسی نموده و دوباره امتحان کنید</div>";
        die();
    }
    elseif($password != $password_confirm){
        echo "<div class='alert alert-danger'>رمز عبور با تکرار آن برابر نیست</div>";
        die();
    }
    else{
        $sql = "SELECT * FROM users_tbl WHERE Usr_UserName='$email'";
        $run = mysqli_query($db, $sql) or die('error');
        $rows = mysqli_num_rows($run);
        if ($rows>0){
            echo "<div class='alert alert-danger'>ین ایمیل قبلا ثبت نام شده است</div>";
            die();
        }

        else{
            mysqli_query($db,"INSERT INTO users_tbl(Usr_DisplayName,Usr_UserName,Usr_Password,Usr_joinDate)VALUES('$display_name','$email','$password',now())") or die('ثبت نشد');
            $db->close();
            header('Location: ../SignIn.php');

        }
    }
}

?>


<script src="../../assets/js/jquery-3.4.1.min.js"></script><!--first-->
<script src="../../assets/js/bootstrap.js"></script><!--second-->
<script src="../../assets/js/popper.min.js"></script>

</body>
</html>
