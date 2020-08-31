<?php
require_once '../engin/db.php';
if(!isset($_SESSION['loggedin'])){
    header('Location: ../SignIn.php');
}
$UserEmail =$_SESSION['loggedin'];
$query="SELECT * FROM users_tbl WHERE Usr_UserName ='$UserEmail'";
$run=mysqli_query($db,$query);
if(mysqli_num_rows($run)>0) {
    $row = mysqli_fetch_array($run);
    $name = $row['Usr_DisplayName'];
    $dir = $row['Usr_ProfilePicDir'];
}


//change name
$msg='';
if(isset($_POST['changeNameSubmit'])){
    $name = $_POST['changeNameInput'];
    $query = "update users_tbl set Usr_DisplayName='$name' where Usr_UserName='$UserEmail'";
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
        $query = "update users_tbl set Usr_UserName='$email' where Usr_UserName='$UserEmail'";
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
        $query = "update users_tbl set Usr_Password='$hashed'where Usr_UserName='$UserEmail'";
        mysqli_query($db,$query);
        $msg = "<div class='alert alert-success'>رمز عبور بروزرسانی شد.</div>";
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
    <link href="css/style_UserProfileSetting.css" rel="stylesheet" type="text/css">
    <link href="css/style_UserDashboard.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/style-top-menu.css" rel="stylesheet" type="text/css">
</head>
<body>
<!-- Start Header -->
<header id="cabecalho">
    <a href="#" id="logo"><img src="../assets/images/logo.png" style="width: 3rem;height: auto"><i>fastscroll</i></a>
    <nav dir="rtl">
        <a href="#" id="menu-icon"><img src="../assets/images/menu-icon.png" style="width: 3rem;height: auto"> </a>
        <ul>
            <li><a href="../index.php" class="btn" style="transition: 119ms;"> خانه</a></li>
            <li><a href="../AboutUs.php" class="btn" style="transition: 119ms;">درباره ما</a></li>
            <li><a href="../ContactUs.php" class="btn" style="transition: 119ms;">تماس با ما</a></li>
            <li><a href="../forum/controllers/Forum.php" class="btn" style="transition: 119ms;">انجمن</a></li>
            <li><a href="UserDashboard.php" class="btn" style="transition: 119ms;">پروفایل</a></li>
        </ul>
    </nav>
</header>
<br>
<!-- End Header -->
<div class="wrapper pageLayout User ">
    <div class="content">
        <div class="block">
            <div class="userProfile current">
                <div class="user float-right">
                    <div class="avatar float-right">
                        <img src="<?php echo $dir;?>" />
                    </div>
                    <div class="details">
                        <h3 class="name ">
                            <?php echo $name; ?>

                        </h3>
                        <div class="detail">
                            <div>
                                <div  class="email"><?php echo $_SESSION['loggedin']; ?></div>
                            </div>
                            <div>
                                <span>12026 XP</span>
                            </div>
                        </div>
                        <a class="materialButton elevated" href="../engin/LogOut.php">خروج</a>
                        <a class="materialButton primary elevated" href="UserDashboard.php"> پروفایل</a>
                    </div>

                </div>
            </div>


            <hr />
            <br>

            <ul>
                <!-- Start change profile pic section -->
                <li><a id="item" href="#">افزودن تصویر پروفایل</a href=""></li>
                <div id="sub">
                    <form action="upload.php" method="post" enctype="multipart/form-data">
                        <!-- Select image to upload: -->
                        <input type="file" name="ProfilePic" id="fileToUpload" title="عکس را به اینجا بکشید">
                        <label for="fileToUpload" class="text-danger border">حداکثر 500KB</label>
                        <input type="submit" value="آپلود تصویر" name="UploadPic"><br>

                    </form>
                </div>
                <!-- End change profile pic section -->

                <!-- Start change userName section -->
                <li><a id="item1" href="#">تعقیر نام کاربری</a></li>
                <div id="sub1">
                    <form action="" method="post">
                        <input type="text" name="changeNameInput" placeholder="نام تان را وارد کنید">
                        <input type="submit" name="changeNameSubmit" value="ذخیره تعقیرات">
                    </form>
                </div>
                <!-- End change userName section -->

                <!-- Start change email section -->
                <li><a id="item2" href="#" > تعقیر ایمیل کاربری</a></li>
                <div id="sub2">
                    <?php echo '<span style="color:#ff5cab;">ایمیل فعلی: </span>'.$_SESSION['loggedin']; ?>
                    <form action="" method="post">
                        <input type="email"  name="changeEmailInput" placeholder="نشانی ایمیل تان را وارد کنید">
                        <input type="submit" name="changeEmailSubmit" value="ذخیره تعقیرات">
                    </form>
                </div>
                <!-- End change email section -->

                <!-- Start change password section -->
                <li><a id="item3" href="#" >تعقیر رمز عبور</a></li>
                <div id="sub3">
                    <form action="" method="post">
                        <input type="password" name="prevPassword" minlength="4" maxlength="64" placeholder="رمز عبور فعلی">
                        <input type="password" name="password" minlength="4" maxlength="64" placeholder="رمز عبور جدید">
                        <input type="password" name="passwordConfirm" minlength="4" maxlength="64" placeholder=" تکرار رمز عبور جدید">
                        <input type="submit" name="changePassSubmit" value="ذخیره تعقیرات">
                    </form>
                </div>
                <!-- End change password section -->

            </ul>
            <hr />
            <div class="rtl">
                <?php echo $msg;?>
            </div>
        </div>
    </div>
</div>
<script src="../assets/js/jquery-3.4.1.min.js"></script>
<script src="../assets/js/popper.min.js"></script>
<script src="../assets/js/bootstrap.js"></script>
<script>
    $('#sub').slideToggle(500);
    $('#sub1').slideToggle(500);
    $('#sub2').slideToggle(500);
    $('#sub3').slideToggle(500);
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
</script>
</body>
</html>
