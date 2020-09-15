<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>DoLogin</title>
</head>
<link href="../../assets/css/bootstrap.css" rel="stylesheet" type="text/css">
<body>
<?php
ini_set('display_errors', '0');//Don't show php errors
require_once '../engin/db.php';
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

    $result = mysqli_query($db,"SELECT * FROM admin_tbl WHERE Admin_UserName='$email' AND Admin_Password='$password'");
    $rows = mysqli_num_rows($result);
    if ($rows<=0){
        $msg = "";
        $msg = "<div class='alert alert-danger'>ایمیل یا رمز عبور شما صحیح نمی باشد</div>";

    }


    else {
        // اگر کاربر تایید شد از طریق نشست ورود کاربر را مشخص میکنیم.
        $_SESSION["AdminLogin"]=$email;

        $db->close();
        header('Location: ../AdminDashboard.php');
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