<?php
//ini_set('display_errors', '0');//Don't show php errors
require_once '../engin/db.php';
if(!isset($_SESSION['AdminLogin'])){
    header('Location: AdminLogin.php');
}
$AdminEmail =$_SESSION['AdminLogin'];
$query="SELECT * FROM admin_tbl WHERE Admin_UserName='$AdminEmail'";
$run=mysqli_query($db,$query);
if(mysqli_num_rows($run)>0) {
    $row = mysqli_fetch_array($run);
    $AdminId = $row['Admin_Id'];
    $AdminName = $row['Admin_Name'];
    $AdminUserName = $row['Admin_UserName'];
    $AdminPassword = $row['Admin_Password'];
}
?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <title>پروفایل :<?php echo $_SESSION['AdminLogin']; ?>  </title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="X-UA-Compatible" content="ie=edge">

    <link href="../../assets/css/bootstrap.css" rel="stylesheet" />
    <link href="../../assets/css/style-top-menu.css" rel="stylesheet" />
    <link href="../../User/css/style_UserDashboard.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />

    <link href="../Articles/css/style.css" rel="stylesheet" />

</head>
<body>


  <?php require_once 'sidebar.php'?>

<div class="content" style="background: url('../../assets/images/testimonials.jpg') no-repeat;background-size: cover;min-height: 600px">
    <p class="alert alert-info">خوش آمدید!</p>
    <a class="materialButton elevated text-light" href="engin/LogOut.php"> <i><img src="../../assets/images/logout.png"></i>خروج</a>

</div>

    <script src="../../assets/js/jquery-3.4.1.min.js"></script>
    <script src="../../assets/js/popper.min.js"></script>
    <script src="../../assets/js/bootstrap.js"></script>

</body>
</html>

