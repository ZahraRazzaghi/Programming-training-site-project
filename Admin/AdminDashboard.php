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

    <link href="../assets/css/bootstrap.css" rel="stylesheet" />
    <link href="../User/css/style_UserDashboard.css" rel="stylesheet" />
    <link href="../assets/css/style-top-menu.css" rel="stylesheet" />

</head>
<body class="">
<!-- Start Header -->
<header id="cabecalho">

</header>
<!-- End Header -->
<br>
<div class="wrapper pageLayout">
    <div class="content">
        <div class="block">
            <div class="userProfile current">
                <div class="user float-right">
                    <div class="avatar float-right">
                    </div>
                    <div class="details">
                        <h1 class="name ">

                        </h1>
                        <div class="detail">
                            <div>

                                <p>مدیر شماره <?php echo $AdminId; ?></p>
                                <p><?php echo $AdminName;?></p>
                                <p><?php echo $AdminUserName;?></p>

                            </div>
                            <div>
                                <span></span>
                            </div>
                        </div>
                        <a class="materialButton elevated text-light" href="engin/LogOut.php/"> <i><img src="../assets/images/logout.png"></i>خروج</a>
                        <a class="materialButton primary elevated" href="UserProfileSetting.php"><i><img src="../assets/images/setting.png"></i>ویرایش پروفایل</a>
                    </div>

                </div>
            </div>
            <hr />
            <div class="manage">
                <a href="Articles.php">مقالات</a><br>
                <a href="Tutorials.php">آموزش ها</a><br>
                <a href="Admins.php">مدیران</a><br>
                <a href="Users.php">کاربران</a><br>
            </div>

    </div>
    <div>
</div>


    <script src="../assets/js/jquery-3.4.1.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.js"></script>
    <script>

        //notification popup
        $('#item').click(function () {
            $('#sub').slideToggle(0);
        })

        $(".show_all .link").click(function(){
            $(".popup").show();
            $('#sub').slideToggle(0);

        });

        $(".close").click(function(){
            $(".popup").hide();
        });
        //courses popup
        $(".show-manage-Courses").click(function(){
            $(".popup2").show();
        });
        $(".close2").click(function(){
            $(".popup2").hide();
        });


    </script>
</body>
</html>

