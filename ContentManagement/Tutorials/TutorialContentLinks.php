<?php
//ini_set('display_errors', '0');//Don't show php errors
require_once '../engin/db.php';
//اگر کاربر لاگین نکرده باشه هدایتش کن به صفحه لاگین
if(!isset($_SESSION['loggedin'])){
    header('Location: ../../User/SignIn.php');
}else {//در غیر این صورت نشست کاربر رو بریز داخل متغیر برای استفاده های بعد
    $email = $_SESSION['loggedin'];
    //و زمان انقضای نشست رو هم در نظر بگیر
    $now = time();
    if ($now > $_SESSION['expire']) {
        session_destroy();
        //اگر زمان نشست تموم شد کاربر رو پزتش کن بیرون
        header('Location: ../../User/SignIn.php');
    }
    //اگر دکمه شروع یادگیری توی صفحه شروع آموزش کلیک شد باید یه نفر به تعداد یادگیرای اون درس اضافه بشه
    // و اطلاعات کاربر و درس توی جدول انتخاب درس درج بشه
    if (isset($_GET['Srart-learningBtn'])) {
        $id = mysqli_real_escape_string($db, $_GET['Srart-learningBtn']);
        //آی دی کاربری که لاگین کرده را از جدول کاربر بردار
        $sql = "SELECT * FROM users_tbl WHERE Usr_UserName='$email'";
        $run = mysqli_query($db, $sql) or die('error for select User');
        if (mysqli_num_rows($run) > 0) {
            $row = mysqli_fetch_array($run);
            $userID = $row['Usr_ID'];
        }
        //بررسی کن ببین کاربر قبل در ای درس ثبت نام کرده یا نه
        $sql = "SELECT * FROM select_tutorial_tbl WHERE Usr_ID=$userID AND tuTo_ID=$id";
        $run = mysqli_query($db, $sql) or die('error for find info');
        $rows = mysqli_num_rows($run);
        if ($rows > 0) {//اگر کاربر قبل در این درس ثبت نام کرده که هیچ
        } else {//در غیر اینصورت اطلاعاتش رو تو جدول انتخاب درس ثبت کن
            $sql = "INSERT INTO select_tutorial_tbl(Usr_ID,tuTo_ID)VALUES('$userID','$id')";
            $run = mysqli_query($db, $sql) or die('error for insert in selecttbl');
            //برو تو صفحه آموزش
            $sql = "SELECT * FROM toturials_tbl WHERE tuTo_ID='$id'";
            $run = mysqli_query($db, $sql);
            $rows = mysqli_num_rows($run);
            if ($rows > 0) {
                $row = mysqli_fetch_array($run);
                $tuTo_NumberOfLearners = $row['tuTo_NumberOfLearners'];
                $tuTo_NumberOfLearners += 1;
                $sql = "UPDATE toturials_tbl SET  tuTo_NumberOfLearners='$tuTo_NumberOfLearners' WHERE tuTo_ID='$id'";
                $run = mysqli_query($db, $sql);
            }


        }

    }
}
?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="X-UA-Compatible" content="ie=edge">
    <title>شروع یادگیری</title>
</head>
<link href="../../assets/css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="../../assets/css/style-top-menu.css" rel="stylesheet" type="text/css">
<link href="css/style_Courses_pages.css" rel="stylesheet" type="text/css">
<body
<!-- Start Header -->
<header id="cabecalho">
    <a href="#" id="logo" style="padding-top: 5px;"><img src="../../assets/images/logo.png" style="width: 2.2rem;"><i>fastscroll</i></a>
    <nav dir="rtl">
        <a href="#" id="menu-icon" style="padding-top: 5px;"><img src="../../assets/images/menu-icon.png" style="width: 2.3rem;"> </a>
        <ul>
            <li><a href="../../index.php" class="btn home" style="transition: 119ms;"><img src="../../assets/images/home-page-logo.png"></a></li>
            <li><a href="../../AboutUs.php" class="btn" style="transition: 119ms;">درباره ما</a></li>
            <li><a href="../../ContactUs.php" class="btn" style="transition: 119ms;">تماس با ما</a></li>
            <li><a href="../../forum/controllers/Forum.php" class="btn" style="transition: 119ms;">انجمن</a></li>
        </ul>
    </nav>
</header>
<br>
<br>
<br>

<!-- End Header -->
<div class="wrapper pageLayout container-fluid">
    <div class="content">
        <div class="block">
<?php
//نمایش نوشته های مربوط به دسته انتخاب شده
if (isset($_GET['Srart-learningBtn'])) {
    $id = mysqli_real_escape_string($db, $_GET['Srart-learningBtn']);
    $sql = "SELECT * FROM toturials_tbl WHERE tuTo_ID='$id'";
    $run = mysqli_query($db, $sql);
    $rows = mysqli_num_rows($run);
    if ($rows > 0) {
        $row = mysqli_fetch_array($run);
        $tuTo_ID = $row['tuTo_ID'];
        $tuTo_Name = $row['tuTo_Name'];
        $tuTo_NumberOfLearners = $row['tuTo_NumberOfLearners'];
        $tuTo_Description = $row['tuTo_Description'];
        $tuTo_PicDir = $row['tuTo_PicDir'];

        echo '
          
          
            <div class="toToPic">
            <div class="courseImg">
                <span><img src="../Admin/' . $tuTo_PicDir . '" width="40px"></span> 
            </div>
      
          <br>
            <h1 style="color:#ffbbbe;">' . $tuTo_Name . '</h1>
            <p dir="rtl">' . $tuTo_Description . '</p>';
    }
        $sql = "SELECT * FROM tutorialpages_tbl WHERE tuTo_ID='$id' ORDER BY tutorialPage_ID";
        $run = mysqli_query($db, $sql);
        $rows = mysqli_num_rows($run);
        if ($rows > 0) {
            while ($row = mysqli_fetch_array($run)) {
                $tutorialPage_ID = $row['tutorialPage_ID'];
                $tutorialPage_Name = $row['tutorialPage_Name'];
                $tutorialPage_Desc = $row['tutorialPage_Desc'];
                $tuTo_ID = $row['tuTo_ID'];
                echo '<br><a dir="rtl" href="TutorialPagesContent.php?contentPageLink='.$tutorialPage_ID.'">'.$tutorialPage_Name.'</a>';
            }
        }    else {$searchMsg= '<div class="alert alert-info" align="center"><img src="../../assets/images/sad.png"><p>متاسفیم نوشته ای وجود ندارد</p></div>';}
}

?>

</div>
</div>
</div>

<script src="../../assets/js/jquery-3.4.1.min.js"></script>
<script src="../../assets/js/bootstrap.js"></script>
<script src="../../assets/js/popper.min.js"></script>
</body>
</html>