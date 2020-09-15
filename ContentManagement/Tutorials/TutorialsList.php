<?php require_once '../engin/db.php'; ?>
<!DOCTYPE html>
<html lang="fa"><head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="description" content="Available Courses on fast-scroll">
    <meta name="keywords" content="Courses, HTML, CSS, JavaScript, C++, PHP, SQL, Java, Python, Ruby, C#, JQuery, Swift, Coding, Code, Programming">
    <title>Courses | FASTSCROLL: Learn to code for FREE!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link href="../../assets/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="../../assets/css/style-top-menu.css" rel="stylesheet" type="text/css">
    <link href="../../assets/css/style-index.css" rel="stylesheet" type="text/css">
    <link href="css/style_Courses_Land.css" rel="stylesheet" type="text/css">
<body>
<div id="fastscroll"></div>type="text/css">
<header id="cabecalho">
    <a href="#" id="logo"><img src="../../assets/images/logo.png" style="width: 3rem;height: auto" class="float-left"><i class="float-right" style="padding-top: 15px">fastscroll</i></a>
    <nav>
        <a href="#" id="menu-icon"><img src="../../assets/images/menu-icon.png" style="width: 3rem;height: auto"> </a>
        <ul>
            <li><a href="../../index.php" class="btn"> خانه</a></li>
            <li><a href="../../AboutUs.php" class="btn">درباره ما</a></li>
            <li><a href="../../ContactUs.php" class="btn">تماس با ما</a></li>
            <li><a href="../../forum/controllers/Forum.php" class="btn">انجمن</a></li>
            <li><a href="../../User/UserDashboard.php" class="btn">پروفایل</a></li>

        </ul>
    </nav>
</header>
<br>
<br>
<br>
<!-- Start Search box-->
<div class="wrapper container"style="padding: 7px">
    <div class="search_box" >
        <form action="" method="post" class="row">
            <input type="text" class="input_search" placeholder="چی میخوای یاد بگیری؟" name="searchValue">
            <button name="searchBtn" type="submit" class="search_btn" value=""><img src="../../assets/images/search-icon.png" style="width: 2.5rem"></button>
        </form>
    </div>
    <div class="clear"></div>
</div>
<section class="wrapper2" dir="rtl">
    <div class="container-fostrap">
        <div class="content">
            <div class="container">
                <div class="row">
                    <?php
                    //search in the db

                    if(isset($_POST['searchBtn'])) {
                        $search = $_POST["searchValue"];
                        if (empty($search)){
                            $searchMsg= '<div class="alert alert-warning">چیزی برای جستجو وارد کنید...</div>';
                        }else{
                            $sql = "SELECT * FROM toturials_tbl WHERE (tuTo_Name LIKE '%$search%' OR tuTo_Description LIKE '%$search%')";
                            $run = mysqli_query($db, $sql);
                            $rows = mysqli_num_rows($run);
                            if ($rows > 0) {
                                while ($row = mysqli_fetch_array($run)) {
                                    $tuTo_ID = $row['tuTo_ID'];
                                    $tuTo_Name = $row['tuTo_Name'];
                                    $tuTo_Description = $row['tuTo_Description'];
                                    $tuTo_NumberOfLearners = $row['tuTo_NumberOfLearners'];
                                    $Summery_Desc = mb_substr($tuTo_Description, 0, 150, 'utf-8');
                                    $tuTo_PicDir = $row['tuTo_PicDir'];

                                    echo '

                             
                <div class="courseItem block noPadding">
                    <a href="TutorialStartPage.php?content='.$tuTo_ID.'">
                        <img src="../Admin/' . $tuTo_PicDir . '" alt="Python 3 Tutorial" class="courseIcon">
                        <div class="courseDescription">
                            <div>' . $tuTo_Name . '</div>
                            <p>' . $Summery_Desc . '</p>
                        </div>
                    </a>
                    <div class="courseStores">
                        <a href="TutorialStartPage.php?content='.$tuTo_ID.'" class="more">بیشتر</a>
                    </div>
                    <div class="courseCounts">
                        <ul>
                            <li><span class="">فراگیران</span><p>' . $tuTo_NumberOfLearners . '</p></li>
                            <li><span>آموزش ها</span><p>0</p></li>
                            <li><span>مقالات</span><p>0</p></li>
                        </ul>
                    </div>
                </div>
            </div>
                            ';
                                }
                                }else {$searchMsg= '<div class="alert alert-info" align="center"><img src="../../assets/images/sad.png"><p>متاسفیم نتیجه ای پیدا نشد</p></div>';}
                            echo '<hr>';
                        }

                    }
                    if(isset($searchMsg)){ echo '<div class="container"  align="center">'.$searchMsg.'</div>';}
                    ?>

                </div>
            </div>
        </div>
    </div>
</section>


<!-- End Search box-->

<div class="coursesContent " dir="rtl">



                    <?php
                    //نمایش  نوشته ها

                    global $count;
                    if(!isset($_GET['page'])){
                        $offset = $_GET['page']=0;
                    }else{
                        $offset = ($_GET['page']-1)*6;
                    }
                    $sql = "SELECT * FROM toturials_tbl";
                    $run = mysqli_query($db, $sql);
                    $count = mysqli_num_rows($run);
                    $count = ceil($count/3);
                    //3-1=2*6=12
                    //4-1=3*6=18
                    //5-1=4*6=24
                    //6-1=5*6=30
                    $sql = "SELECT * FROM toturials_tbl limit {$offset},6";
                    $run = mysqli_query($db, $sql);
                    $rows = mysqli_num_rows($run);
                    if ($rows > 0) {
                        while ($row = mysqli_fetch_array($run)) {
                            $tuTo_ID = $row['tuTo_ID'];
                            $tuTo_Name = $row['tuTo_Name'];
                            $tuTo_Description = $row['tuTo_Description'];
                            $tuTo_NumberOfLearners = $row['tuTo_NumberOfLearners'];
                            $Summery_Desc = mb_substr($tuTo_Description,0,100,'utf-8');
                            $tuTo_PicDir = $row['tuTo_PicDir'];

                            echo '

                             
                <div class="courseItem block noPadding">
                    <a href="TutorialStartPage.php?content='.$tuTo_ID.'">
                        <img src="../Admin/'.$tuTo_PicDir.'" alt="Python 3 Tutorial" class="courseIcon">
                        
                        <div class="courseDescription">
                            <div>'.$tuTo_Name.'</div>
                            <p>'.$Summery_Desc.'</p>
                        </div>
                    </a>
                    <div class="courseStores">
                        <a href="TutorialStartPage.php?content='.$tuTo_ID.'" class="more">بیشتر</a>
                    </div>
                    <div class="courseCounts">
                        <ul>
                            <li><span class="">فراگیران</span><p>'.$tuTo_NumberOfLearners.'</p></li>
                            <li><span>آموزش ها</span><p>0</p></li>
                            <li><span>مقالات</span><p>0</p></li>
                        </ul>
                    </div>
                </div>';
                        }
                    }else {$searchMsg= '<div class="alert alert-info" align="center"><img src="../../assets/images/sad.png"><p>متاسفیم نوشته ای وجود ندارد</p></div>';}

                    ?>



</div>
<br>

<ul class="pagination float-right" style=" padding-right: 1rem">
    <li class="page-item disabled"><a class="page-link" href="#">قبلی</a> </li>
    <?php
    for($i=1;$i<=$count;$i++){
        if($i==$_GET['page']){
            echo '<li class="page-item active"><a class="page-link" href="TutorialsList.php?page='.$i.'">'.$i.'</a> </li>';

        }else{
            echo '<li class="page-item "><a class="page-link" href="TutorialsList.php?page='.$i.'">'.$i.'</a> </li>';
        }
    }
    ?>
    <li class="page-item"><a class="page-link" href="#">بعدی</a> </li>
</ul>





<!--- Start footer --->
<?//php require_once '../../footer.php';?>
<!---End footer --->

<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="../../assets/js/jquery-3.4.1.min.js"></script>
<script src="../../assets/js/bootstrap.js"></script>
<script src="../../assets/js/popper.min.js"></script>
</body>
</html>