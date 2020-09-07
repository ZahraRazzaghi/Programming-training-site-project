<?php
ini_set('display_errors', '0');//Don't show php errors
require_once '../engin/db.php';
if(!isset($_SESSION['loggedin'])){
    header('Location: ../SignIn.php');
}else{

    $now = time(); // Checking the time now when home page starts.
    if ($now > $_SESSION['expire']) {
        session_destroy();
        header('Location: ../SignIn.php');
    }
}
$UserEmail =$_SESSION['loggedin'];
$query="SELECT * FROM users_tbl WHERE Usr_UserName ='$UserEmail'";
$run=mysqli_query($db,$query);
if(mysqli_num_rows($run)>0) {
    $row = mysqli_fetch_array($run);
    $name = $row['Usr_DisplayName'];
    $dir = $row['Usr_ProfilePicDir'];
    $joinDate = $row['Usr_joinDate'];
}


//change name
$msg='';
if(isset($_POST['changeNameSubmit'])){
    $name = $_POST['changeNameInput'];
    $query = "UPDATE users_tbl SET Usr_DisplayName='$name' WHERE Usr_UserName='$UserEmail'";
    if(mysqli_query($db,$query)){

        $msg = "<div class='alert alert-success'> نام شما با موفقیت بروزرسانی شد.</div>";
    }else{
        $msg = "<div class='alert alert-danger'> تعقیر نام شما با مشکل مواجه شد.</div>";
    }

}

//change email
if(isset($_POST['changeEmailSubmit'])) {
    $email = $_POST['changeEmailInput'];
    $result = mysqli_query($db, "SELECT Usr_UsrName FROM users_tbl WHERE Usr_UsrName='$email'");
    if (mysqli_num_rows($result) > 0) {
        $msg = "<div class='alert alert-danger'> این ایمیل قبلا ثبت نام شده.</div>";
    } else {
        $query = "UPDATE users_tbl SET Usr_UserName='$email' WHERE Usr_UserName='$UserEmail'";
        if (mysqli_query($db, $query)) {
            $_SESSION["loggedin"]=$email;
            $msg = "<div class='alert alert-success'> ایمیل شما با موفقیت بروزرسانی شد.</div>";
        } else {
            $msg = "<div class='alert alert-danger'> تعقیر ایمیل شما با مشکل مواجه شد.</div>";
        }
    }

}

//Change Password
if(isset($_POST['changePassSubmit'])){
    $prevPassword = md5(mysqli_real_escape_string($db,$_POST['prevPassword']));
    $password = mysqli_real_escape_string($db,$_POST['password']);
    $passwordConf = mysqli_real_escape_string($db,$_POST['passwordConfirm']);
    $query="SELECT * FROM users_tbl WHERE Usr_UserName ='$UserEmail'";
    $run=mysqli_query($db,$query);
    if(mysqli_num_rows($run)>0) {
        $row = mysqli_fetch_array($run);
        $prePass = $row['Usr_Password'];
    }
    if($prePass != $prevPassword){
        $msg = "<div class='alert alert-danger'>رمز عبور فعلی شما صحیح نیست</div>";
    }
    elseif($password!=$passwordConf){
        $msg = "<div class='alert alert-danger'>متاسفیم، رمز عبور با تکرار آن مطابقت ندارد!</div>";
    }elseif(strlen($password)<4){
        $msg = "<div class='alert alert-danger'>رمز عبور باید حداقل 4 کاراکتر باشد.</div>";
    }else{
        $hashed = md5($password);
        $query = "UPDATE users_tbl SET Usr_Password='$hashed'WHERE Usr_UserName='$UserEmail'";
        mysqli_query($db,$query);
        $msg = "<div class='alert alert-success'>رمز عبور بروزرسانی شد.</div>";
    }
}

//delete accunt
if(isset($_POST['deleteAccunt'])){

    mysqli_query($db,"DELETE FROM users_tbl WHERE Usr_UserName ='$UserEmail'");
    unset($_SESSION['loggedin']);//unset vars
    if(isset($_SESSION['loggedin'])){
        echo 'yes';
    }else{
        header('Location: ../index.php');
    }

}
?>

<!DOCTYPE html>
<html lang="fa">
<head>


    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="X-UA-Compatible" content="ie=edge">
    <meta name="keywords" content="<?php echo $name;?>s  Profile on fastscroll">
    <title>پروفایل :<?php echo $name; ?>  </title>
    <link href="../assets/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/style-top-menu.css" rel="stylesheet" type="text/css">
    <link href="css/style_UserProfileSetting.css" rel="stylesheet" type="text/css">
    <link href="css/style_UserDashboard.css" rel="stylesheet" type="text/css">
</head>
<body>
<!-- Start Header -->
<header id="cabecalho">
    <a href="#" id="logo" style="padding-top: 5px;"><img src="../assets/images/logo.png" style="width: 2.2rem;"><i>fastscroll</i></a>
    <nav dir="rtl">
        <a href="#" id="menu-icon" style="padding-top: 5px;"><img src="../assets/images/menu-icon.png" style="width: 2.3rem;"> </a>
        <ul>
            <li><a href="../index.php" class="btn home" style="transition: 119ms;"><img src="../assets/images/home-page-logo.png"></a></li>
            <li><a href="#" class="btn notifications" style="transition: 119ms;"><img src="images/fu-notification.png"></a></li>
            <li><a href="../AboutUs.php" class="btn" style="transition: 119ms;">درباره ما</a></li>
            <li><a href="../ContactUs.php" class="btn" style="transition: 119ms;">تماس با ما</a></li>
            <li><a href="../forum/controllers/Forum.php" class="btn" style="transition: 119ms;">انجمن</a></li>
        </ul>
    </nav>
</header>
<!-- End Header -->
<br>
<div class="wrapper pageLayout User ">
    <div class="content">
        <div class="block">
            <div class="userProfile current">
                <div class="user float-right">
                    <div class="avatar float-right">
                        <img src="<?php echo $dir;?>" />
                    </div>
                    <div class="details">
                        <h3 class="name text-dark">
                            <?php echo $name; ?>
                        </h3>
                        <div class="detail" dir="rtl">
                            <div class="user-email">
                                <div  class="email"><?php echo $_SESSION['loggedin']; ?></div>
                            </div>
                            <div>
                                <span>0 XP</span>
                            </div>
                        </div>
                        <a class="materialButton elevated text-light" href="engin/LogOut.php"> <i><img src="../assets/images/logout.png"></i>خروج</a>
                        <a class="materialButton primary elevated" href="UserDashboard.php"> <i><img src="../assets/images/user.png" width="17px"></i> پروفایل</a>
                    </div>

                </div>
            </div>


            <hr />
            <br>

            <ul>
                <!-- Start change profile pic section -->
                <li><a id="item" href="#"><i><img src="images/add-pro-pic.png" width="20px"></i>افزودن تصویر پروفایل</a></li><br>
                <div id="sub">
                    <form action="upload.php" method="post" enctype="multipart/form-data" class="sec">
                        <!-- Select image to upload: -->
                        <input type="file" name="ProfilePic" id="fileToUpload" title="عکس را به اینجا بکشید">
                        <label for="fileToUpload" class="text-danger border">حداکثر 500KB</label>
                        <input type="submit" value="آپلود تصویر" name="UploadPic"><br>

                    </form><br>
                </div>
                <!-- End change profile pic section -->

                <!-- Start change userName section -->
                <li><a id="item1" href="#"><i><img src="images/change-name.png" width="20px"></i>تعقیر نام کاربری</a></li><br>
                <div id="sub1">
                    <form action="" method="post" class="sec">
                        <input type="text" name="changeNameInput" placeholder="نام تان را وارد کنید">
                        <input type="submit" name="changeNameSubmit" value="ذخیره تعقیرات">
                    </form><br>
                </div>
                <!-- End change userName section -->

                <!-- Start change email section -->
                <li><a id="item2" href="#" ><i><img src="images/change-email.png" width="20px"></i> تعقیر ایمیل کاربری</a></li><br>
                <div id="sub2">
                    <?php echo '<span style="color:#ff5cab;">ایمیل فعلی: </span>'.$_SESSION['loggedin']; ?>
                    <form action="" method="post" class="sec">
                        <input type="email"  name="changeEmailInput" placeholder="نشانی ایمیل تان را وارد کنید">
                        <input type="submit" name="changeEmailSubmit" value="ذخیره تعقیرات">
                    </form><br>
                </div>
                <!-- End change email section -->

                <!-- Start change password section -->
                <li><a id="item3" href="#" ><i><img src="../assets/images/password-reset.png" width="20px"></i>تعقیر رمز عبور</a></li><br>
                <div id="sub3">
                    <form action="" method="post" class="sec">
                        <input type="password" name="prevPassword" minlength="4" maxlength="64" placeholder="رمز عبور فعلی"><br>
                        <input type="password" name="password" minlength="4" maxlength="64" placeholder="رمز عبور جدید"><br>
                        <input type="password" name="passwordConfirm" minlength="4" maxlength="64" placeholder=" تکرار رمز عبور جدید"><br>
                        <input type="submit" name="changePassSubmit" value="ذخیره تعقیرات">
                    </form><br>
                </div>
                <!-- End change password section -->

                <!-- Start change password section -->
                <li><a id="item4" href="#" ><i><img src="images/delete-user.png" width="20px"></i>حذف حساب</a></li>
                <div id="sub4">
                        <form method="post" action="" dir="rtl" class="sec">
                            <label>آیا از حذف حساب خود مطمئنید؟</label>
                            <button  id="item4" class=" btn btn-sm btn-secondary">لغو</button>
                            <button class=" btn btn-sm btn-danger" type="submit" name="deleteAccunt"><i><img class="delete-img" src="../assets/images/delete.png" width="16px" style="    border: 1px solid #fff;border-radius: 50%;margin-left: 3px;
"></i>حذف حساب</button>
                            <img src="../assets/images/confirm%20delete.png" width="20%">

                        </form><br>
                </div>
                <!-- End change password section -->

            </ul>
            <hr />
            <div class="rtl">
                <?php echo $msg;?>
            </div>

            <div class="join-date row" dir="rtl">
                <span class="text-info">از کی با ما هستید:</span><div class="join-date"><?php echo $joinDate; ?></div>
            </div>


            </hr>


        </div>
    </div>
</div>
<script src="../assets/js/jquery-3.4.1.min.js"></script>
<script src="../assets/js/popper.min.js"></script>
<script src="../assets/js/bootstrap.js"></script>
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
