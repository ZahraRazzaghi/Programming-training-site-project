<?php
//ini_set('display_errors', '0');//Don't show php errors
$msg ='';
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
    <link href="css/style.css" rel="stylesheet" type="text/css"/>
    <link href="../../User/css/style_UserDashboard.css" rel="stylesheet" />
    <link href="../../User/css/style_UserProfileSetting.css" rel="stylesheet" />
    <link href="../../assets/css/style-top-menu.css" rel="stylesheet" />

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
                        <a class="materialButton elevated text-light" href="engin/LogOut.php"> <i><img src="../../assets/images/logout.png"></i>خروج</a>
                        <a class="materialButton primary elevated" href="UserProfileSetting.php"><i><img src="../../assets/images/setting.png"></i>ویرایش پروفایل</a>
                    </div>

                </div>
            </div>
            <hr />
            <ul>
                <!--Show all managers -->
                <li><a id="item1" href="#" ><i><img src="../../User/images/delete-user.png" width="20px"></i>نمایش تمام مدیران</a></li>
                <div id="sub1">
                    <table style="  margin: 0 auto;" align="center">
                        <tbody>
                        <tr>
                            <td style="text-align: center; border: 1px solid #3a464b; padding: 5px;"><strong>شماره</strong></td>
                            <td style="text-align: center; border: 1px solid #3a464b; padding: 5px;"><strong>نام </strong></td>
                            <td style="text-align: center; border: 1px solid #3a464b; padding: 5px;"><strong> ایمیل </strong></td>
                        </tr>
                        <?php
                        //learner selected courses
                        $sql = "SELECT * FROM admin_tbl";
                        $run = mysqli_query($db, $sql) or die('error in inner join');
                        while($row = mysqli_fetch_array($run)){
                            $AdminId = $row['Admin_Id'];
                            $AdminName = $row['Admin_Name'];
                            $AdminUserName = $row['Admin_UserName'];
                            echo '
                 <tr>
                    <td style="border: 1px solid #3a464b; padding: 5px;">'.$AdminId .'</td>
                    <td style="border: 1px solid #3a464b; padding: 5px;">'.$AdminName.'</td>
                    <td style="border: 1px solid #3a464b; padding: 5px;">'.$AdminUserName.'</td>
                    <td style="border: 1px solid #3a464b; padding: 5px;"><form method="POST" action="">
                    <input type="submit" name="'.$AdminUserName.'" class="btn btn-danger" value="حذف"></form></td>
                </tr>';
                            if(isset($_POST[$AdminUserName])){
                                mysqli_query($db,"DELETE FROM admin_tbl WHERE Admin_UserName ='$AdminUserName'");
                            }
                        }

                        ?>
                        </tbody>
                    </table><br>
                </div>

                <!--Add new managers -->
                <li><a id="item2" href="#" ><i><img src="../../User/images/delete-user.png" width="20px"></i>افزودن ادمین جدید</a></li>
                <div id="sub2">
                    <form action="" method="POST" class="sec">
                        <input type="text" name="AdminName" maxlength="90" placeholder="نام ادمین" required><br>
                        <input type="email" name="AdminUserName"  maxlength="90" placeholder="نام کاربری ادمین" required><br>
                        <input type="password" name="password" minlength="4" maxlength="90" placeholder=" تکرار رمز عبور جدید" required><br>
                        <input type="password" name="passwordConfirm" minlength="4" maxlength="90" placeholder=" تکرار رمز عبور جدید" required><br>
                        <?php echo $msg; ?>
                        <input type="submit" name="َAddNewAdmin" value="ذخیره تعقیرات">
                    </form><br>
                    <?php
                    //insert into admin table

                    $AdminN = $_POST["AdminName"];
                    $AdminUN = $_POST["AdminUserName"];
                    $pass = md5($_POST["password"]);
                    $passdConf = md5($_POST["passwordConfirm"]);
                    if(isset($_POST['AddNewAdmin'])) {

                        if (!filter_var($AdminUN, FILTER_VALIDATE_EMAIL)) {$msg = "<div class='alert alert-danger'>آدرس پست الکترونیک شما معتبر نمی باشد لطفا آن را بررسی نموده و دوباره امتحان کنید</div>";
                            die();}
                        elseif($password != $passwordConfirm){$msg = "<div class='alert alert-danger'>رمز عبور با تکرار آن برابر نیست</div>";
                            die();}
                        else{
                            $sql = "SELECT * FROM admin_tbl WHERE Admin_UserName='$AdminUN'";
                            $run = mysqli_query($db, $sql) or die('error');
                            $rows = mysqli_num_rows($run);
                            if ($rows>0){
                                $msg =  "<div class='alert alert-danger'>ین  مدیر قبلا ثبت نام شده است</div>";
                                die();
                            }

                            else{
                                mysqli_query($db,"INSERT INTO admin_tbl(Admin_Name,Admin_UserName,Admin_Password,Admin_JoinDate)VALUES('$AdminN','$AdminUN','$pass',now())") or die('ثبت نشد');
                                $msg =  "<div class='alert alert-success'>با موفقیت ثبت شد</div>";


                            }
                        }
                    }
                    ?>


                    <br>
                </div>
            </ul>




        </div>


        <script src="../../assets/js/jquery-3.4.1.min.js"></script>
        <script src="../../assets/js/popper.min.js"></script>
        <script src="../../assets/js/bootstrap.js"></script>
        <script>
            $('#sub').slideToggle(0);
            $('#sub1').slideToggle(0);
            $('#sub2').slideToggle(0);
            $('#sub3').slideToggle(0);
            $('#sub4').slideToggle(0);
            $('#item').click(function () {
                $('#sub').slideToggle(500);
            })
            $('#item1').click(function () {
                $('#sub1').slideToggle(500);
            })
            $('#item2').click(function () {
                $('#sub2').slideToggle(500);
            })
            $('#item3').click(function () {
                $('#sub3').slideToggle(500);
            })
            $('#item4').click(function () {
                $('#sub4').slideToggle(500);
            })
        </script>
</body>
</html>

