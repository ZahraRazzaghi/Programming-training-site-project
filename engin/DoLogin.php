
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link href="assests/css/style.css" type="text/css" rel="stylesheet">
    <link href="assests/css/bootstrap.css" type="text/css" rel="stylesheet">
</head>
<body>
<?php
require_once 'db.php';
$email=$_POST['email'];
$password=md5($_POST['password']);

if (strlen($email) == 0) {
    echo "<p style='color: darkred;border: 1px dashed #dd4a68; width: 50%; margin: 25%'>
لطفا نام کاربری خود را وارد کنید</p>";
    die("");
}
echo "<p style='color: darkred;border: 1px dashed #dd4a68; width: 50%; margin: 25%'>
 لطفا رمز عبور خود را وارد کنید</p>";
if (strlen($password) == 0) {
    die("");
}


$result = mysqli_query($db,"SELECT * FROM users_tbl WHERE Usr_UserName='$email' AND Usr_Password='$password'");
$rows = mysqli_num_rows($result);
if ($rows<=0){
    echo "<p style='color: darkred;border: 1px dashed #dd4a68; width: 50%; margin: 25%'>
 نام کاربری یا رمز عبور اشتباه است</p>";
}

else {

    // اگر کاربر تایید شد از طریق نشست ورود کاربر را مشخص میکنیم.

    $_SESSION["loggedin"]=$email;
    header('Location: ../UserDashboard.php');

}

?>
</body>
</html>