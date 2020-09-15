<?php
require_once 'engin/db.php';
require_once 'ContentManagement/includs/init.php';
//count number of students, tutorials and articles
$run=mysqli_query($db,"Select count(*) as `students` from users_tbl;");
if(mysqli_num_rows($run)>0) {
    $row = mysqli_fetch_array($run);
    $students = $row['students'];
}
$run=mysqli_query($db,"Select count(*) as `tutorials` from toturials_tbl;");
if(mysqli_num_rows($run)>0) {
    $row = mysqli_fetch_array($run);
    $tutorials = $row['tutorials'];
}
$run=mysqli_query($con,"Select count(*) as `articles` from posts_tbl;");
if(mysqli_num_rows($run)>0) {
    $row = mysqli_fetch_array($run);
    $articles = $row['articles'];
}
?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="X-UA-Compatible" content="ie=edge">
    <title>fastscroll-learn programing fast</title>
    <!---style & script files--->
    <link href="assets/css/bootstrap.css" type="text/css" rel="stylesheet">
    <link href="assets/css/style-index.css" type="text/css" rel="stylesheet">
</head>
<body>
<div id="fastscroll"></div><!--Anchor -->
<br>
<br>
<!--- Start Header --->
<img class="header-svg" src="assets/images/home-header.svg">
<header class="index-showcase">
    <div class="container-index">
        <nav class="top-site">
            <nav class="top-menu">
                <ul class="float-left custom-control-inline ">
                    <li><a href="AboutUs.php">درباره ما</a></li>
                    <li><a href="ContactUs.php">تماس با ما</a></li>
                    <li><a href="CommonQuestions.php">سوالات متداول</a></li>
                </ul>
            </nav>
            <div class="navbar-brand">
                <a href="index.php"> <i style="color:#7b79ff">fastscroll</i><img src="assets/images/logo.png" alt="logo" id="logo"></a>
            </div>
        </nav>
        <div class="index-buttons">
            <a href="User/SignUp.php" class="btn btn-outline-primary">ثبت نام<i><img src="assets/images/sign-in-up/register.png" width="25%"></i></a>
            <a href="User/SignIn.php" class="btn btn-outline-primary">ورود<i><img src="assets/images/sign-in-up/login.png" width="30%"></i></a>
        </div>
    </div>
</header>
<section class="hero">
    <div class="container">
        <div class="main-message">
                <div class="title">
                    حرفه ای و رایگان یاد بگیرید!
                </div>
                <div class="subtitle">  ما در این سایت جدیدترین و کاربردی ترین علم روز در زمینه برنامه نویسی را در اختیار شما قرار خواهیم داد.</div>
                <div class="cta">
                    <a href="ContentManagement/Tutorials/TutorialsList.php">
                        <button class="custom-btn btn-2"><span>شروع یادگیری</span></button>

                    </a>
                </div>
        </div>

    </div>
</section>
<!--- End Header --->

<!--start search section -->
<script src="assets/js/index-search-box.js"></script>
<section class="home-banner text-center">
<div class="container">
    <div class="justify-content-center container">
        <!--Start Search Form -->
        <div class="wrapper">
            <div class="search_box">
                <form action="" method="post" class="row">
                    <input type="text" class="input_search" placeholder="چی دوست داری یاد بگیری؟" name="searchValue" required>
                    <button name="search" type="submit" class="search_btn" value=""><img src="assets/images/search-icon.png" style="width: 2.5rem"></button>
                </form>
            </div>
        </div>
        <!--Start php search code in tutorials-->
        <?php
        if(isset($_POST['search'])) {
            $search = $_POST["searchValue"];

            $sql = "SELECT * FROM toturials_tbl  WHERE tuTo_Name LIKE '%$search' OR tuTo_Description LIKE '%$search'";
            $run = mysqli_query($db, $sql) or die('error in search');
            $rows = mysqli_num_rows($run);
            if ($rows>0) {
                while ($row = mysqli_fetch_array($run)) {
                    $tutoName = $row['tuTo_Name'];
                    $tutoDesc = $row['tuTo_Description'];
                    $Summery_Desc = mb_substr($tutoDesc,0,100,'utf-8');
                    $tutoPicDir = $row['tuTo_PicDir'];
                    echo '<a href="" style="margin-top:3rem;">
<div class="row" style="border-bottom:1px solid #ccc;">
        <div class="col-md-2">
            <img src="Tutorials/'.$tutoPicDir.'" style="max-width:70px">
        </div>
        <div class="col-md-2">
        <h4>'.$tutoName.'</h4>

        </div>
        <div class="col-md-8">
        '.$Summery_Desc.'
        </div>
    </div></a>';
                }
            }else {echo "متاسفیم چیزی پیدا نشد";}
        }

        ?>
        <!--End php search code in tutorials-->
        <!--End Search Form -->
        <!--Start buttons udner the Search Form -->
        <div dir="ltr" class="under-search-buttons">
            <?php
            $sql = "SELECT * FROM toturials_tbl";
            $run = mysqli_query($db, $sql);
            $rows = mysqli_num_rows($run);
            $rows =0;
            //from rows to The last 4
            $sql = "SELECT * FROM toturials_tbl LIMIT $rows,12";
            $run = mysqli_query($db, $sql);
            $rows = mysqli_num_rows($run);
            if ($rows>0) {
                while ($row = mysqli_fetch_array($run)) {
                    $tuTo_ID = $row['tuTo_ID'];
                    $tutoName = $row['tuTo_Name'];
                    echo ' 
            <a href="ContentManagement/Tutorials/TutorialStartPage.php?content='.$tuTo_ID.'" class="custom-btn btn-12"><span>'.$tutoName.'</span><span>'.$tutoName.'</span></a> 
        ';
                }echo '<br><a href="ContentManagement/Tutorials/TutorialsList.php" class="custom-btn btn-12"><span>ادامه</span><span>ادامه</span></a> ';
            }
            ?>
        </div>
        <!--End buttons under the Search Form -->

</div>
</section>
<!--end search section -->
<!--- End Header --->
<main>
<!-- Start Last Tutorials Section -->
    <section class="wrapper2" dir="rtl" style="margin-top: 8rem;>
        <div class="container-fluid">
            <div class="content">
                <div class="container">
                    <div class="row" >

                        <?php
                        $sql = "SELECT * FROM toturials_tbl";
                        $run = mysqli_query($db, $sql);
                        $rows = mysqli_num_rows($run);
                        $rows -=4;
                        //from rows to The last 4
                        $sql = "SELECT * FROM toturials_tbl LIMIT $rows,4";
                        $run = mysqli_query($db, $sql);
                        $rows = mysqli_num_rows($run);
                        if ($rows>0) {
                            while ($row = mysqli_fetch_array($run)) {
                                $tuTo_ID = $row['tuTo_ID'];
                                $tutoName = $row['tuTo_Name'];
                                $tutoDesc = $row['tuTo_Description'];
                                $Summery_Desc = mb_substr($tutoDesc,0,100,'utf-8');
                                $tutoPicDir = $row['tuTo_PicDir'];
                                echo ' <div class="col-xs-6 col-sm-6 col-md-3" dir="rtl" ">
 <a href="ContentManagement/Tutorials/TutorialStartPage.php?content='.$tuTo_ID.'" >
 <div class="card" style="width: 18rem;background: #fff;border: 1px solid chartreuse;width:100%">
  <img class="card-img-top" src="ContentManagement/Admin/'.$tutoPicDir.'" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title text-dark">' . $tutoName . '</h5>
  </div></a>
</div></div>';
                            }
                        }
                        ?>
                    </div></div></div></div></section>
<!-- End Last Tutorials Section -->




    <!--Start Last Articles -->
    <h5 class="bg-warning rounded-circle text-sm-center">آخرین مقالات</h5>

                <div class="container-fluid">
                    <div class="row">

                <?php
                $sql = "SELECT * FROM posts_tbl ORDER BY post_Likes";
                $run = mysqli_query($con, $sql);
                $rows = mysqli_num_rows($run);
                $rows =0;
                //from rows to The last 4
                $sql = "SELECT * FROM posts_tbl LIMIT $rows,4";
                $run = mysqli_query($con, $sql);
                $rows = mysqli_num_rows($run);
                if ($rows>0) {
                    while ($row = mysqli_fetch_array($run)) {
                        $Post_ID = $row['Post_ID'];
                        $Post_Title = $row['Post_Title'];
                        $Post_Author = $row['Post_Author'];
                        $Post_Create_At = $row['Post_Create_At'];
                        $Post_Img = $row['Post_Img'];
                        $Post_body = $row['Post_body'];
                        $SummeryPost_body = mb_substr($Post_body,0,100,'utf-8');
                        $Post_Img = $row['Post_Img'];

                        echo '
                 <div class="col-xs-12 col-sm-6 col-md-3 postBlock" dir="rtl">
                        <div class="card2">
                            <a href="ContentManagement/Articles/ShowContent.php?content='.$Post_ID.'">
                                <img src="ContentManagement/Admin/'.$Post_Img.'" />
                            </a>
                            <div class="card-content">
                                <h4 class="card-title">
                                    <a href="ContentManagement/Articles/ShowContent.php?content='.$Post_ID.'">' . $Post_Title . '</a>
                                </h4>
                                <p class="">' . $SummeryPost_body . ' </p>
                            </div>
                            <div class="card-read-more row" style="position: absolute;bottom: 0">
                              
                                <span><p><img src="ContentManagement/Articles/images/Author.png">'.$Post_Author.'</p></span>
                                <span><p><img src="ContentManagement/Articles/images/calender.png">'.$Post_Create_At.'</p></span>
                                  <span><a href=ContentManagement/Articles/ShowContent.php?content='.$Post_ID.'" class="btn">ادامه مطلب</a></span>
                            </div>
                        </div>
                    </div>
                ';
                    }
                }
                ?>
<style>
    .card2{min-height: 325px;max-height: 325px;padding: 5px;}
    .postBlock{background: #c797eb;margin: 5px;width: 20%}
    .card-read-more span{padding: 5px}
</style>

                    </div>
                </div>
    <!--End Last Articles -->

<br>
<br>
<br>
    <!-- responsive carousel--->
    <div class="container">
        <div class="row">
            <div class="col-xs-11 col-md-10 col-centered">

                <div id="carousel" class="carousel slide" data-ride="carousel" data-type="multi" data-interval="2500">
                    <div class="carousel-inner">
                        <div class="item active">
                            <div class="carousel-col">
                                <div class="block red img-responsive"></div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="carousel-col">
                                <div class="block green img-responsive"></div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="carousel-col">
                                <div class="block blue img-responsive"></div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="carousel-col">
                                <div class="block yellow img-responsive"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Controls -->
                    <div class="left carousel-control">
                        <a href="#carousel" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </div>
                    <div class="right carousel-control">
                        <a href="#carousel" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- responsive carousel --->
    <br>
<br>
<br>
    <section class="testimonials container-fluid">
        <div class="container">
            <div class="testimonial">
                <div class="testimonial-text-box">
                    <h4>زمان سرمایه گذاری روی خودتان است. </h4>
                    <h5>هر زمان و هرجای دیگری به صورت رایگان در دسترس است!</h5>
                </div>
<!--------------------------->
                <div class="row align-content-center text-center">
                    <div class="column">
                        <div class="card">
                            <p><i><img src="assets/images/ora-students.png"></i></p>
                            <h3><?php echo $students; ?></h3>
                            <p>فراگیران</p>
                        </div>
                    </div>
                    <div class="column">
                        <div class="card">
                            <p><i><img src="assets/images/ora-course.png"></i></p>
                            <h3><?php echo $tutorials; ?></h3>
                            <p>آموزش ها</p>
                        </div>
                    </div>
                    <div class="column">
                        <div class="card">
                            <p><i><img src="assets/images/articles.png"></i></p>
                             <?php echo $articles; ?></h3>
                            <p>مقالات</p>
                        </div>
                    </div>
                </div>

                <style>

                    /* Float columns */
                    .column {

                        width: 33%;
                        padding: 0 5px;
                    }

                    .row {
                        margin: 0 -5px;
                    }

                    .row:after {
                        content: "";
                        display: table;
                    }

                    /* Style the cards */
                    .card {
                        padding: 10px;
                        text-align: center;
                        background-color: transparent;
                        color: #fff;
                        border: none;
                    }

                    .card:hover {
                        transform: scale(1.1);
                        background-color: rgba(74,0,224,.3);
                        transition-duration:399ms;
                        color: #fff;
                    }

                    .fa {
                        font-size: 50px;
                    }
                </style>

                <!--------------------------->

                <a href="Course/controllers/Courses.php">
                    <button class="custom-btn btn-11"> همین الان یادگیری را شروع کنید<div class="dot"></div></button>
                </a>
            </div>
        </div>
    </section>
    <!-- -->

    <section class="begin-adventure text-center container-fluid">
        <div class="">
            <div class="row">
            <div class="title-heading col-5 center">
                <div class="article_number"><b>1</b></div>
                <h3>چیزی را که می خواهید یاد بگیرید انتخاب کنید.</h3>
                <div class=" article-text">
                    <img src="assets/images/index-001.webp">
                    <p>از ساخت وب سایت تا تحلیل داده ها ، انتخاب مورد نظر شماست. مطمئن نیستید از کجا شروع کنید؟ ما شما را در جهت درست هدایت خواهیم کرد. </p>
                </div>
                </div>
            <div class="title-heading col-5 center">
                <div class="article_number n"><b>2</b></div>
                <h3>  یادگیر بگیرید</h3>
                <div class="article-text">
                    <img src="assets/images/index-002.webp">
                    <p>سطح تجربه شما مهم نیست ، شما برای چند دقیقه کد واقعی می نویسید.</p>
                    </div>
            </div>
            <div class="title-heading col-5 center">
                <div class="article_number"><b>3</b></div>
                <h3>بازخورد فوری دریافت کنید</h3>
                <div class="article-text">
                    <img src="assets/images/index-003.webp">
                    <p> کد شما به محض ارسال آن تست می شود ، بنابراین همیشه می دانید که آیا در مسیر صحیحی هستید یا نه. </p>
                </div>
            </div>
            <div class="title-heading col-5 center">
                <div class="article_number"><b>4</b></div>
                <h3>یادگیری را عملی تجربه کنید.</h3>
                <div class="article-text">
                    <img src="assets/images/index-004.webp">
                    <p>یادگیری خود را روی پروژه های دنیای واقعی اعمال کنید و دانش خود را با آزمون های متناسب امتحان کنید. </p>
                </div>
            </div>
            <div class="title-heading col-5 center">
                <div class="article_number"><b>5</b></div>
                <h3>شغل موردعلاقه خود را پیدا کنید.</h3>
                <div class="article-text">

                    <img src="assets/images/index-005.webp">
                    <p>مهارت های برنامه نویسی همیشه تقاضای بیشتری دارند. همه ی چیزی را که برای رسیدن به حرفه مورد نظرتان لازم هست را بیاموزید. </p>
                </div>
            </div></div>
        </div>
    </section>
</main>


<!-- About -->
<section class="index-about bg-light">
    <div class="container">
        <div class="grid-2">
            <div class="center">
                <i><img src="assets/images/Freelancer.svg"></i>
            </div>
            <div>
                <h3>درباره ما</h3>
                <p>
                    تغییر جهان یا حتی به فعلیت رساندن ایده‌هایتان. این‌ها همه دلایل بسیار خوبی برای شروع یادگیری برنامه‌نویسی هستند.
                    ولی آنچه مهم هست پیدا کردن مسیر و طی کردن آن می باشد.براستی چطور و از کجا باید برنامه‌نویسی را شروع کنیم؟

                </p>
                <a href="AboutUs.php"><button class="custom-btn btn-2">بیشتر</button></a>
            </div>
        </div>
    </div>
</section>
<!--- Start footer --->
<?php require_once 'footer.php';?>
<!---End footer --->
<script src="assets/js/jquery-3.4.1.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.js"></script>


</body>
</html>