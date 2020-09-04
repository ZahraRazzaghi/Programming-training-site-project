<?php
require_once 'engin/db.php';
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
$run=mysqli_query($db,"Select count(*) as `articles` from articles_tbl;");
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

<!--- Start Header --->
<!-- Responsive Menu -->
<!--- Start Header --->
<div id="fastscroll"></div>
<br>
<br>
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
            <a href="SignUp.php" class="btn btn-outline-primary">ثبت نام<i><img src="assets/images/sign-in-up/register.png" width="25%"></i></a>
            <a href="SignIn.php" class="btn btn-outline-primary">ورود<i><img src="assets/images/sign-in-up/login.png" width="30%"></i></a>
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
                    <a href="Course/controllers/Courses.php">
                        <button class="custom-btn btn-2"><span>شروع یادگیری</span></button>

                    </a>
                </div>
        </div>

    </div>
</section>
<!--start search section -->
<script src="assets/js/index-search-box.js"></script>
<section class="home-banner text-center">
<div class="container">
    <div class="justify-content-center container">

        <div class="wrapper">
            <div class="search_box">

                <input type="text" class="input_search" placeholder="چی دوست داری یاد بگیری؟">
                <div class="search_btn"><img src="assets/images/search-icon.png" style="width: 2.5rem"></div>
            </div>
        </div>
        <div dir="ltr" class="under-search-buttons">
            <a href="Course/controllers/HTML.php" class="custom-btn btn-12"><span>HTML</span><span>HTML</span></a>
            <a href="Course/controllers/CSS.php" class="custom-btn btn-12"><span>CSS</span><span>CSS</span></a>
            <a href="Course/controllers/PHP.php" class="custom-btn btn-12"><span>PHP</span><span>PHP</span></a>
            <a href="Course/controllers/SQL.php"a class="custom-btn btn-12"><span>SQL</span><span>SQL</span></a>
            <a href="Course/controllers/JavaScript.php" class="custom-btn btn-12"><span>JavaScript</span><span>JavaScript</span></a>
            <a href="Course/controllers/Python.php" class="custom-btn btn-12"><span>Phython 3</span><span>Phython 3</span></a>
            <a href="Course/controllers/CPlusPlus.php" class="custom-btn btn-12"><span>C++</span><span>C++</span></a>
            <a href="Course/controllers/CSharp.php" class="custom-btn btn-12"><span>C#</span><span>C#</span></a>
            <a href="Course/controllers/Java.php" class="custom-btn btn-12"><span>JAVA</span><span>JAVA</span></a>
            <a href="Course/controllers/machine-learning.php" class="custom-btn btn-12"><span>Machin Learning</span><span>Machin Learning</span></a>
            <a href="Course/controllers/Ruby.php" class="custom-btn btn-12"><span>Ruby</span><span>Ruby</span></a>
            <a href="Course/controllers/Swift.php" class="custom-btn btn-12"><span>Swift 4</span><span>Swift 4</span></a><br>
            <a href="Course/controllers/Courses.php" class="custom-btn btn-12"><span>ادامه</span><span>ادامه</span></a>

        </div>


    </div>

</div>
</section>
<!--end search section -->


<!--- End Header --->

<!-- Start Services -->

<main>
    <!--Start Last Tutorials -->
    <section class="last-tutorials" id="last-tutorials">
        <div class="container-fluid">
            <h6><img src="assets/images/cancel-last-digit.png">آخرین دوره ها</h6>


<div class="container-fluid row text-center">
    <div class="last-tutorial"></div>
    <div class="last-tutorial"></div>
    <div class="last-tutorial"></div>
    <div class="last-tutorial"></div>


</div>
        </div>
    </section>
    <!--End Last Tutorials -->

    <!--Start Last Articles -->
    <section class="last-articles" id="last-articles">
        <div class="container-fluid">
           <h6><img src="assets/images/cancel-last-digit.png">آخرین مقالات</h6>
            <div class="container-fluid row text-center">
                <div class="last-article"></div>
                <div class="last-article"></div>
                <div class="last-article"></div>
                <div class="last-article"></div>


            </div>

        </div>
    </section>
    <!--End Last Articles -->


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
                            <h3><?php echo $articles; ?></h3>
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
<div id="footer">
    <div class="container footer-link-group text-center center bg-dark">
        <div class="row">
            <div class="col-md-4">
                <h4>توسعه وب</h4>
                <ul>
                    <li><a href="Course/controllers/HTML.php">HTML</a></li>
                    <li><a href="Course/controllers/CSS.php">CSS</a></li>
                    <li><a href="Course/controllers/JavaScript.php">JavaScript</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h4>سمت سرور</h4>
                <ul>
                    <li><a href="Course/controllers/PHP.php">PHP</a></li>
                    <li><a href="Course/controllers/SQL.php">SQL</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h4>ابزارها</h4>
                <ul>
                    <li><a href="Code-Editor/Code-Editor.php">Code Editor</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footerContent">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 align-content-center text-center row ">
                <div class="col-md-8">
                    <h5 dir="ltr" class="contentTitle">ویژگی ها</h5>
                    <ul class="tutorial-groups text-light">

                        <li><a class="">در وب و در حال حرکت بیاموزید.</a></li>
                        <li><a class="">در همه دستگاه ها و سیستم عامل های اصلی موجود است.</a></li>
                        <li><a class="">ساده تر و لذت بخش تر از همیشه!</a></li>

                    </ul>

                </div>
                <div class="col-md-4">
                    <h5 dir="ltr" class="contentTitle">خدمات</h5>
                    <ul class="tutorial-groups text-light">

                        <li><a class="">طراحی و توسعه وب</a></li>
                        <li><a class="">طراحی و توسعه برنامه های مبایل</a></li>
                        <li><a class="">آموزش های ویدئویی</a></li>
                        <li><a class="">پلتفرم یادگیری آنلاین</a></li>
                        <li><a class="">مسیرهای یادگیری</a></li>
                        <li><a class="">گواهی نامه های آنلاین</a></li>
                        <li><a class="">مقالات بروز</a></li>
                    </ul>
                </div>

            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 align-content-center center">
                <div class="footerMenu Courses">
                    <ul>
                        <li><a href="index.php" id="footerHome">خانه</a></li>
                        <li><a href="AboutUs.php">درباره ما</a></li>
                        <li><a href="ContactUs.php" id="footerCourses">ارتباط با ما</a></li>
                        <li><a href="#last-tutorials" class="">آخرین دوره ها</a></li>
                        <li><a href="#last-articles" class="">آخرین مقالات</a></li>
                        <li><a href="Course/controllers/Courses.php" id="footerContacts">آموزش ها</a></li>
                        <li><a href="CommonQuestions.php" id="faq" >سؤالات متداول</a></li>
                    </ul>
                </div>
            </div>
            <div class=" align-content-center center bg-dark" style="padding: 10px">
                <p style="color:#fafafa; font-weight: 100">FastScroll را در شبکه های اجتماعی دنبال کنید</p>
                <hr class="bg-hr">
                    <div class="socialCounts row align-content-center center">
                    <a  href="https://twitter.com/FastScroll/" target="_blank" title="twitter">
                        <div ><img src="assets/images/Social-img/twitter.png"  title="" width="59%"></div>
                    </a>
                    <a  href="http://www.facebook.com/FastScroll/" target="_blank">
                        <div ><img src="assets/images/Social-img/facebook.png"  title="facebook" width="59%"></div>
                    </a>
                    <a  href="http://www.github.com/FastScroll/" target="_blank">
                        <div ><img src="assets/images/Social-img/github.png" title="Github" width="59%"></div>
                    </a>
                    <a  href="http://www.linkdin.com/FastScroll/" target="_blank">
                        <div><img src="assets/images/Social-img/linkedin.png"  title="Linkdin" width="59%"></div>
                    </a>

                </div>
            </div>
        </div>
        </div>
    <a href="#fastscroll" class="anchor" title="بالا"><img src="assets/images/white-scroll-up.png" width="50pt" alt="بالا"></a>
    <div class="copyright" dir="ltr">
        © 2020 FastScroll, Inc. All rights reserved.
   </div>
</div>
<!---End footer --->
<script src="assets/js/jquery-3.4.1.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.js"></script>

</body>
</html>