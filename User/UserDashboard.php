<?php
//ini_set('display_errors', '0');//Don't show php errors
require_once '../engin/db.php';
if(!isset($_SESSION['loggedin'])){
    header('Location: ../SignIn.php');
}else{

    $now = time();
if ($now > $_SESSION['expire']) {
    session_destroy();
    header('Location: ../SignIn.php');
}}

        $UserEmail =$_SESSION['loggedin'];
        $query="SELECT * FROM users_tbl WHERE Usr_UserName ='$UserEmail'";
        $run=mysqli_query($db,$query);
        if(mysqli_num_rows($run)>0) {
            $row = mysqli_fetch_array($run);
            $UserID = $row['Usr_ID'];
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
    <a href="#" id="logo" style="padding-top: 5px;"><img src="../assets/images/logo.png" style="width:1.9rem;"><i>fastscroll</i></a>
    <nav dir="rtl">
        <a href="#" id="menu-icon" style="padding-top: 5px;"><img src="../assets/images/menu-icon.png" style="width: 2.3rem;"> </a>
        <ul>
            <li><a href="../index.php" class="btn" style="transition: 119ms;"><img src="../assets/images/home-page-logo.png"></a></li>
            <!--Start Profile Section --
            <!-- Start notifications -->
            <li class="n">
                <a href="#" id="item" class="btn notifications" style="transition: 119ms;">
                    <div class="icon-wrap">
                        <img src="images/fu-notification.png">
                    </div>
                </a>

                <div id="sub" class="notification_dd">
                        <ul class="notification_ul">
                            <li class="success starbucks">
                                <div class="notify_icon">
                                    <span class="icon"></span>
                                </div>

                                <div class="notify_data">
                                    <div class="title">
                                    </div>
                                    <div class="sub_title">
                                    </div>
                                </div>

                                <div class="notify_status">
                                    <p>اعلان جدیدی وجود ندارد</p>
                                </div>
                            </li>

                                <li class="show_all">
                                    <p class="link">نمایش همه</p>
                                </li>
                        </ul>
                    </div>

                <!-- Start notifaction Popup -->

                <div class="popup">
                    <div class="inner_popup">
                        <div class="notification_dd">
                            <ul class="notification_ul">
                                <li class="title">
                                    <p>تمام اعلان ها</p><br>
                                    <p class="close"><img src="../assets/images/delete.png" width="20px"></p>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
                <!-- End notifaction Popup -->
                <!-- start courses popup -->
                <div class="popup2">
                    <div class="inner_popup2">
                        <div class="notification_dd2">
                            <ul class="notification_ul2">
                                <li class="title2">
                                    <p>تمام اعلان ها</p><br>
                                    <p class="close2"><img src="../assets/images/delete.png" width="20px"></p>
                                </li>
                                <?php
                                //learner selected courses
                                $sql = "SELECT * FROM select_tutorial_tbl INNER JOIN toturials_tbl ON select_tutorial_tbl.tuTo_ID=toturials_tbl.tuTo_ID WHERE select_tutorial_tbl.Usr_ID=' $UserID'";
                                $run = mysqli_query($db, $sql) or die('error in inner join');
                                while($row = mysqli_fetch_array($run)){
                                    $tutoID = $row['tuTo_ID'];
                                    $tutoName = $row['tuTo_Name'];
                                    $tutoPicDir = $row['tuTo_PicDir'];
                                    $tutoLinkDir = $row['tuTo_LinkDir'];
                                    $NumberOfLearners = $row['tuTo_NumberOfLearners'];
                                    echo '<div class="courseInfo" data-courseid="1051">
                                                  <img src="'.$tutoPicDir.'" class="courseIcon" style="max-width:30px">
                                                  <div class="details"><p class="courseName">'.$tutoName.'</p>
                                                      <p class="learnersCount"> فراگیران: '.$NumberOfLearners.'</p>
                                                      <div class="controls">
                                                          <div class="buttonsWrapper">
                                                         <form action="" method="post">
                                                            <input type="submit" class="materialButton negative removeCourse" name="'.$tutoID.'" value="حذف">
                                                         </form>
                                                          </div>
                                                      </div>
                                                  </div>
                                                  <div class="loader"> </div>
                                              </div> ';
                                    if(isset($_POST[$tutoID])){
                                        mysqli_query($db,"DELETE FROM select_tutorial_tbl WHERE Usr_ID ='$UserID' AND tuTo_ID ='$tutoID'");
                                    }
                                }

                                ?>


                            </ul>
                        </div>
                    </div>
                <!-- end courses popup -->


                </div>

            </li>
            <!-- End notifications -->
            <li><a href="../AboutUs.php" class="btn" style="transition: 119ms;">درباره ما</a></li>
            <li><a href="../ContactUs.php" class="btn" style="transition: 119ms;">تماس با ما</a></li>
            <li><a href="../forum/controllers/Forum.php" class="btn" style="transition: 119ms;">انجمن</a></li>
            <li><a href="../Course/controllers/Courses.php" class="btn" style="transition: 119ms;">اموزش ها</a></li>
        </ul>
    </nav>
</header>
<!-- End Header -->
<br>
<div class="wrapper pageLayout">
    <div class="content">
        <div class="block">
            <div class="userProfile current">
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
                                <label>level</label>
                                1
                            </div>
                            <div>
                                <span>5 XP</span>
                            </div>
                        </div>
                        <a class="materialButton elevated text-light" href="engin/LogOut.php"> <i><img src="../assets/images/logout.png"></i>خروج</a>
                        <a class="materialButton primary elevated" href="UserProfileSetting.php"><i><img src="../assets/images/setting.png"></i>ویرایش پروفایل</a>
                    </div>

                </div>
            </div>
            <hr />
            <!-- Start User Toturials -->
            <div class="userCoursesTitle">
                <!-- Start course Popup-->

                <a href="#" class="show-manage-Courses"><img src="images/courses-setting.png"></a>




                <h2>آموزش های من</h2>





            <div class="userCourses">

                <?php
                //learner selected courses
                $sql = "SELECT * FROM select_tutorial_tbl INNER JOIN toturials_tbl ON select_tutorial_tbl.tuTo_ID=toturials_tbl.tuTo_ID WHERE select_tutorial_tbl.Usr_ID=' $UserID'";
                $run = mysqli_query($db, $sql) or die('error in inner join');
                while($row = mysqli_fetch_array($run)){
                    $tutoName = $row['tuTo_Name'];
                    $tutoPicDir = $row['tuTo_PicDir'];
                    $tutoLinkDir = $row['tuTo_LinkDir'];

                    echo '<div class="courseWrapper">
                    <div class="chart" data-percent="100" data-size="60" data-line="3">
                        <canvas height="60" width="60"></canvas>
                    </div>
                    <a href="'.$tutoLinkDir.'" class="course" title="">
                        <img src="'.$tutoPicDir.'" alt=""/>
                    </a>
                    <p class="courseXp">'.$tutoName.'</p>
                </div>';
                }
                ?>


            </div>
            <!-- End User Toturials -->

            <hr>
            <div class="my-Certificates">
                <h2>کد های من</h2>
                <a href="../Code-Editor/Code-Editor.php" target="_blank" class="add materialButton" title="Add">
                    <div class="actionIcon"></div>
                    <span>کد جدید +</span>
                </a>

            </div>
            <hr>
            <div class="codesTitle">
                <h2>گواهینامه های من </h2>

            </div>
            <hr />
<h4>سایر دوره ها</h4>
        </div>

    </div>

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

