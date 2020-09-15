<?php
//ini_set('display_errors', '0');//Don't show php errors
require_once '../engin/db.php';
if(!isset($_SESSION['AdminLogin'])){
    header('Location: AdminLogin.php');
}
if (isset($_GET['EditA'])) {
    $id = mysqli_real_escape_string($db, $_GET['EditA']);
    $sql = "SELECT * FROM admin_tbl WHERE Admin_Id='$id'";
    $run = mysqli_query($db, $sql);
    if (mysqli_num_rows($run) > 0) {
        $row = mysqli_fetch_array($run);
        $AdminId = $row['Admin_Id'];
        $AdminName = $row['Admin_Name'];
        $AdminUserName = $row['Admin_UserName'];
        $AdminPassword = $row['Admin_Password'];
    }
}
?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <title>پروفایل :<?php echo $_SESSION['AdminLogin']; ?>  </title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="X-UA-Compatible" content="ie=edge">
    <link href="../../assets/css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <link href="../../assets/css/style-top-menu.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" type="text/css"/>
    <link href="../Articles/css/style.css" rel="stylesheet" />
</head>
<body>
<?php require_once 'sidebar.php'?>
<div class="content">

    <p style="color: #6009f0;padding-top: 3px"><b><img src="images/AdminPics/edit-64.png" style="margin-left: 3px;width:18px;">ویرایش اطلاعات مدیر</b></p>
    <!--Add new managers -->
    <form action="" method="POST">
        <input value="<?php echo $AdminName;?>" type="text" name="AdminName" maxlength="90" placeholder="نام ادمین" class="textBox" required><br>
        <input value="<?php echo $AdminUserName;?>" type="email" name="AdminUserName"  maxlength="90" placeholder="نام کاربری ادمین" class="textBox" required><br>
        <input value="<?php echo $AdminPassword;?>" type="password" name="password" minlength="4" maxlength="90" placeholder=" رمز عبور جدید" class="textBox" required><br>
        <input value="<?php echo $AdminPassword;?>" type="password" name="passwordConfirm" minlength="4" maxlength="90" placeholder=" تکرار رمز عبور جدید" class="textBox" required><br>
        <input type="submit" class="btn btn-success" name="َEditAdmin" value="ویرایش اطلاعات">
        <input type="reset" class="btn btn-outline-secondary" value="انصراف">
    </form><br>
    <?php
    //insert into admin table
    if(isset($_POST['َEditAdmin'])) {
        $AdminN = $_POST["AdminName"];
        $AdminUN = $_POST["AdminUserName"];
        $pass = md5($_POST["password"]);
        $passdConf = md5($_POST["passwordConfirm"]);
        if (!filter_var($AdminUN, FILTER_VALIDATE_EMAIL)) {echo "<div class='alert alert-danger'>آدرس پست الکترونیک شما معتبر نمی باشد لطفا آن را بررسی نموده و دوباره امتحان کنید</div>";
            die();}
        if($pass != $passdConf){echo "<div class='alert alert-danger'>رمز عبور با تکرار آن برابر نیست</div>";
            die();} else{
            $sql = "UPDATE admin_tbl SET Admin_Name='$AdminN' Admin_UserName='$AdminUN' Admin_Password='$pass' WHERE Admin_Id='$id'";
            $run = mysqli_query($db,$sql);
            if($run){
                echo  "<div class='alert alert-success'>با موفقیت ویرایش شد</div>";
            }else{
                echo "<div class='alert alert-danger'>ویرایش نشد</div>";

            }
        }
    }?>
</div>
</body>
</html>

