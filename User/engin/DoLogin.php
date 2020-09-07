<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>DoLogin</title>
</head>
<link href="../../assets/css/bootstrap.css" rel="stylesheet" type="text/css">
<body>
<?php
require_once 'db.php';
ini_set('display_errors', '0');//Don't show php errors
$msg='';
$email=$_POST['email'];
$password=md5($_POST['password']);

if(isset($_POST['email']) && isset($_POST['password'])) {
    if (empty($email)) {
        $msg="لطفا نام کاربری خود را وارد کنید";
    }

    if (empty($password)) {
        $msg="لطفا رمز عبور خود را وارد کنید";
    }

    $result = mysqli_query($db,"SELECT * FROM users_tbl WHERE Usr_UserName='$email' AND Usr_Password='$password'");
    $rows = mysqli_num_rows($result);
    if ($rows<=0){
        $msg = "";
        $msg = "<div class='alert alert-danger'>ایمیل یا رمز عبور شما صحیح نمی باشد</div>";

    }


else {
    // اگر کاربر تایید شد از طریق نشست ورود کاربر را مشخص میکنیم.
    $_SESSION["loggedin"]=$email;
    $_SESSION['start'] = time(); // Taking now logged in time.
    $_SESSION['expire'] = $_SESSION['start'] + (5000);
    $db->close();
    header('Location: ../UserDashboard.php');
}
}
?>

</body>
<script src="../../assets/js/jquery-3.4.1.min.js"></script>
<script src="../../assets/js/bootstrap.js"></script>
<script src="../../assets/js/popper.min.js"></script>
<script>

</script>


</html>