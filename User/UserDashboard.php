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

?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <title>پروفایل :<?php echo $name; ?>  </title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="X-UA-Compatible" content="ie=edge">

    <link href="../assets/css/bootstrap.css" rel="stylesheet" />
    <link href="css/style_UserDashboard.css" rel="stylesheet" />
    <link href="/Content/userCodes.css" rel="stylesheet" />
    <link href="../assets/css/style-top-menu.css" rel="stylesheet" />

</head>
<body class="">
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
        </ul>
    </nav>
</header>
<br>
<!-- End Header -->
<div class="wrapper pageLayout User ">
    <div class="content">
        <div class="block">
            <div class="userProfile   current">
                <div class="user float-right">
                    <div class="avatar float-right">
                        <img src="<?php echo $dir;?>" />
                    </div>
                    <div class="details">
                        <h1 class="name ">
                            <?php echo $name; ?>

                        </h1>
                        <div class="detail">
                            <div>
                                <label>سطح</label>
                                13
                            </div>
                            <div>
                                <span>12026 XP</span>
                            </div>
                        </div>
                        <a class="materialButton elevated" href="../engin/LogOut.php">خروج</a>
                        <a class="materialButton primary elevated" href="UserProfileSetting.php">ویرایش پروفایل</a>
                    </div>

                </div>
            </div>
            <hr />
            <!-- Start User Toturials -->
            <div class="userCoursesTitle">
                <h2>آموزش های من</h2>
                <button class="manageUserCourses"></button>
            </div>
            <div class="userCourses">
                <div class="courseWrapper">
                    <div class="chart" data-percent="100" data-size="60" data-line="3">
                        <canvas height="60" width="60"></canvas>
                    </div>
                    <a href="#" class="course" title="">
                        <img src="" alt=""/>
                    </a>
                    <p class="courseXp">0 XP</p>
                </div>

                <div class="courseWrapper">
                    <div class="chart" data-percent="100" data-size="60" data-line="3">
                        <canvas height="60" width="60"></canvas>
                    </div>
                    <a href="#" class="course" title="">
                        <img src="" alt=""/>
                    </a>
                    <p class="courseXp">0 XP</p>
                </div>
                <div class="courseWrapper">
                    <div class="chart" data-percent="100" data-size="60" data-line="3">
                        <canvas height="60" width="60"></canvas>
                    </div>
                    <a href="#" class="course" title="">
                        <img src="" alt=""/>
                    </a>
                    <p class="courseXp">0 XP</p>
                </div>
            </div>
            <!-- End User Toturials -->

            <hr>
            <div class="codesTitle">
                <h2>کد های من</h2>
                <a href="../Code-Editor/Code-Editor.php" target="_blank" class="add materialButton" title="Add">
                    <div class="actionIcon"></div>
                    <span>کد جدید +</span>
                </a>

            </div>

            <hr />
            <img src="../assets/images/gif.gif" alt="UsenName" />

        </div>

    </div>

</div>
<script src="../assets/js/jquery-3.4.1.min.js"></script>
<script src="../assets/js/bootstrap.js"></script>
</body>
</html>