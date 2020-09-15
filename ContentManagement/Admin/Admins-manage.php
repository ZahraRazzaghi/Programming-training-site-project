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
    <link href="../../assets/css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <link href="../../assets/css/style-top-menu.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" type="text/css"/>
    <link href="../Articles/css/style.css" rel="stylesheet" />
</head>
<body>
<?php require_once 'sidebar.php';?>
<br>
<?php
echo '<div class="AdminDetails">
        <div>
            <p class="text-success">'.$AdminName.'</p>
<p>'.$AdminUserName.'</p>

</div>
<a class="btn btn-secondary" href="engin/LogOut.php"> <i><img src="../../assets/images/logout.png"></i>خروج</a>
<a class="btn btn-info" href="AdminProfileEdit.php?EditA='.$AdminId.'"><i><img src="../../assets/images/setting.png"></i>ویرایش پروفایل</a>
</div>';
?>
<div class="content">

<br>
<br>
    <!--Show all managers -->
    <p style="color: #6009f0"><b><img src="images/AdminPics/eye-64.png" style="margin-left: 5px;width:20px;"> لیست مدیران</b></p>
        <table style="  margin: 0 auto;" align="center">
            <tbody>
            <tr>
                <th style="text-align: center; border: 1px solid #3a464b; padding: 5px;"><strong>شماره</strong></th>
                <th style="text-align: center; border: 1px solid #3a464b; padding: 5px;"><strong>نام </strong></th>
                <th style="text-align: center; border: 1px solid #3a464b; padding: 5px;"><strong> ایمیل </strong></th>
                <th style="text-align: center; border: 1px solid #3a464b; padding: 5px;"><strong> عملیات </strong></th>
            </tr>
            <?php
            //learner selected courses
            $sql = "SELECT * FROM admin_tbl";
            $run = mysqli_query($db, $sql);
            $ID=0;
            while($row = mysqli_fetch_array($run)){
                $ID+=1;
                $AdminId = $row['Admin_Id'];
                $AdminName = $row['Admin_Name'];
                $AdminUserName = $row['Admin_UserName'];
                echo '
                 <tr>
                    <td style="border: 1px solid #3a464b; padding: 5px;">'.$ID .'</td>
                    <td style="border: 1px solid #3a464b; padding: 5px;">'.$AdminName.'</td>
                    <td style="border: 1px solid #3a464b; padding: 5px;">'.$AdminUserName.'</td>
                    <td style="border: 1px solid #3a464b; padding: 5px;"><form method="POST" action="">
                    <a href="Admins-manage.php?deleteA='.$AdminId.'"><i><img src="images/AdminPics/delete.png"></i></a>

                </tr>';
            }
            if (isset($_GET['deleteA'])) {
                $id = mysqli_real_escape_string($db, $_GET['deleteA']);
                $sql = "DELETE FROM admin_tbl WHERE Admin_Id ='$id'";
                $run = mysqli_query($db,$sql);
                if($run){
                    $msg2='<p class="alert alert-success">مدیر موردنظر با موفقیت حذف شد.</p>';
                }else{
                    $msg2='<p class="alert alert-success">حذف مدیر با شکست مواجه شد.</p>';
                }
            }
            ?>
            </tbody>
        </table><br>

    <p style="color: #6009f0;padding-top: 3px"><b><img src="images/AdminPics/plus.png" style="margin-left: 3px;width:18px;">افزودن مدیر جدید</b></p><br>
        <!--Add new managers -->
        <form action="" method="POST">
            <input type="text" name="AdminName" maxlength="90" placeholder="نام ادمین" class="textBox" required><br>
            <input type="email" name="AdminUserName"  maxlength="90" placeholder="نام کاربری ادمین" class="textBox" required><br>
            <input type="password" name="password" minlength="4" maxlength="90" placeholder="رمز عبور" class="textBox" required><br>
            <input type="password" name="passwordConfirm" minlength="4" maxlength="90" placeholder=" تکرار رمز عبور " class="textBox" required><br>
            <input type="submit" class="btn btn-success" name="َAddNewAdmin" value="افزودن مدیر">
            <input type="reset" class="btn btn-outline-secondary" value="انصراف">
        </form><br>
        <?php
        //insert into admin table
        if(isset($_POST['AddNewAdmin'])) {
            $AdminN = $_POST["AdminName"];
            $AdminUN = $_POST["AdminUserName"];
            $pass = md5($_POST["password"]);
            $passdConf = md5($_POST["passwordConfirm"]);
            if (!filter_var($AdminUN, FILTER_VALIDATE_EMAIL)) {echo "<div class='alert alert-danger'>آدرس پست الکترونیک شما معتبر نمی باشد لطفا آن را بررسی نموده و دوباره امتحان کنید</div>";
                die();}
            if($pass != $passdConf){echo "<div class='alert alert-danger'>رمز عبور با تکرار آن برابر نیست</div>";
                die();}

            $sql = "SELECT * FROM admin_tbl WHERE Admin_UserName='$AdminUN'";
            $run = mysqli_query($db, $sql);
            $rows = mysqli_num_rows($run);
            if ($rows>0){
                echo "<div class='alert alert-danger'>این  مدیر قبلا ثبت نام شده است</div>";
            } else{
                $query = "INSERT INTO admin_tbl(Admin_Name,Admin_UserName,Admin_Password,Admin_JoinDate)VALUES('$AdminN','$AdminUN','$pass',now())";
                $run = mysqli_query($db,$query);
                if($run){
                    echo  "<div class='alert alert-success'>با موفقیت ثبت شد</div>";
                }else{
                    echo "<div class='alert alert-danger'>ثبت نشد</div>";

                }
            }
        }?>
</div>
</body>
</html>

