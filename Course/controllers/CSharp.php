<?php
require_once '../../engin/db.php';
$tutName='C#';//Course Name

//select infomation in tutorials table
$query ="SELECT * FROM toturials_tbl WHERE tuTo_Name='$tutName'";
$run = mysqli_query($db,$query);
if(mysqli_num_rows($run)>0) {
    $row = mysqli_fetch_array($run);
    $tutoID = $row['tuTo_ID'];
    $tutoName = $row['tuTo_Name'];
    $tutoSumDesc = $row['tuTo_SummaryDescription'];
    $tutoNumOFLearners = $row['tuTo_NumberOfLearners'];//1 واحد بهش اضافه کن اول تو دیتابیس ذخیره کن بعد نمایشش بده
}


if(isset($_POST['start-learning'])){
    if(!isset($_SESSION['loggedin'])){
        header('Location: ../../SignIn.php');
    }else{
        $email = $_SESSION['loggedin'];
        //select user information fron user table
        $sql = "SELECT * FROM users_tbl WHERE Usr_UserName='$email'";
        $run = mysqli_query($db, $sql) or die('error for select User');
        if(mysqli_num_rows($run)>0) {
            $row = mysqli_fetch_array($run);
            $userID = $row['Usr_ID'];
        }

        $sql = "INSERT INTO select_tutorial_tbl(Usr_ID,tuTo_ID)VALUES('$userID','$tutoID')";
        $run = mysqli_query($db, $sql) or die('error for insert in selecttbl');
        //بردار بندازش تو جدول چون کاربر انتخابش کرده
        //mysqli_query($db,"INSERT INTO toturials_tbl(tuTo_Name,UtuTo_SummaryDescription,tuTo_PicDir)VALUES('html','hyper text markub lang','dir'") or die('not save');


    }
    //برو تو صفحه آموزش

}
?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="X-UA-Compatible" content="ie=edge">
    <title>Start html</title>
</head>
<link href="../../assets/css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="../../assets/css/style-top-menu.css" rel="stylesheet" type="text/css">
<link href="../css/style_Courses_pages.css" rel="stylesheet" type="text/css">
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

<!-- End Header -->


<div class="wrapper pageLayout container-fluid">
    <div class="content">
        <div class="block">
            <div class="start-lerning">
                <form action=""  method="post">
                    <input type="submit" class="btn btn-outline-success" name="start-learning" value="شروع یادگیری ">
                </form>
            </div>
        </div>
    </div>
</div>





<script src="../../assets/js/jquery-3.4.1.min.js"></script>
<script src="../../assets/js/bootstrap.js"></script>
<script src="../../assets/js/popper.min.js"></script>
</body>
</html>