<?php
require_once '../engin/db.php';
ini_set('display_errors', '0');//Don't show php errors
?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="X-UA-Compatible" content="ie=edge">
    <title>fastscroll-learn programing fast</title>
    <!---style & script files--->
    <link href="../../assets/css/bootstrap.css" type="text/css" rel="stylesheet">
    <link href="../../assets/css/style-top-menu.css" type="text/css" rel="stylesheet">
    <link href="../../assets/css/style-index.css" type="text/css" rel="stylesheet">
    <link href="css/style.css" type="text/css" rel="stylesheet">
</head>
<body>
<!--Start Header-->
<div id="cabecalho">
    <a href="#" id="logo" style="padding-top: 5px;"><img src="../../assets/images/logo.png" style="width: 2.2rem;"><i>fastscroll</i></a>
    <nav dir="rtl">
        <a href="#" id="menu-icon" style="padding-top: 5px;"><img src="../../assets/images/menu-icon.png" style="width: 2.3rem;"> </a>
        <ul>
            <?php
            //show categories top on the page
            $sql = "SELECT * FROM categories_tbl";
            $run = mysqli_query($db, $sql);
            while($row = mysqli_fetch_array($run)) {
                $Cat_ID = $row['Cat_ID'];
                $Cat_Title = $row['Cat_Title'];
                echo '<li><a href="category.php?CatID='.$Cat_ID.' class="btn" style="transition: 119ms;">'.$Cat_Title.'</a></li>';
            } ?>
            <li><a href="../Admin/AdminLogin.php">ورود مدیر</a> </li>
        </ul>
    </nav>
</div>
<div class="clear"></div>
</div><br>


<!-- Start Search box-->
<div class="wrapper container">
    <div class="search_box">
        <form action="" method="post" class="row">
            <input type="text" class="input_search" placeholder="دنبال چی هستی؟" name="searchValue">
            <button name="searchBtn" type="submit" class="search_btn" value=""><img src="../../assets/images/search-icon.png" style="width: 2.5rem"></button>
        </form>
    </div>
    <div class="clear"></div>
</div><br><br><br><br><br>
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
        $sql = "SELECT * FROM posts_tbl WHERE (Post_Tags LIKE '%$search%' OR Post_Title LIKE '%$search%'OR Post_body LIKE '%$search%')";
        $run = mysqli_query($db, $sql) or die('error in search');
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
                echo ' <div class="col-sm-12 col-md-4 postBlock" dir="rtl">
                        <div class="card">
                            <a class="img-card" href="ShowContent.php?content='.$Post_ID.'">
                                <img src="../Admin/'.$Post_Img.'" />
                            </a>
                            <div class="card-content">
                                <h4 class="card-title">
                                    <a href="ShowContent.php?content='.$Post_ID.'">' . $Post_Title . '</a>
                                </h4>
                                <p class="">' . $SummeryPost_body . ' </p>
                            </div>
                            <div class="card-read-more">
                                <span><a href="ShowContent.php?content='.$Post_ID.'" class="btn">ادامه مطلب</a></span>
                                <span><p><img src="images/Author.png">'.$Post_Author.'</p></span>
                                <span><p><img src="images/calender.png">'.$Post_Create_At.'</p></span>
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

<!--End Header-->

<!--Start body-->
<section class="wrapper2" dir="rtl">
    <div class="container-fostrap">
        <div class="content">
            <div class="container">
                <div class="row">



        <?php
        //نمایش  نوشته ها


        global $count;
            if(!isset($_GET['page'])){
                $offset = $_GET['page']=1;
            }else{
                $offset = ($_GET['page']-1)*6;
            }
        $sql = "SELECT * FROM posts_tbl";
        $run = mysqli_query($db, $sql);
        $count = mysqli_num_rows($run);
        $count = ceil($count/3);
//3-1=2*6=12
//4-1=3*6=18
//5-1=4*6=24
//6-1=5*6=30
        $sql = "SELECT * FROM posts_tbl limit {$offset},6";
            $run = mysqli_query($db, $sql);
            $rows = mysqli_num_rows($run);
            if ($rows > 0) {
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
                 <div class="col-sm-12 col-md-4 postBlock" dir="rtl">
                        <div class="card">
                            <a class="img-card" href="http://www.fostrap.com/2016/03/bootstrap-3-carousel-fade-effect.html">
                                <img src="../Admin/'.$Post_Img.'" />
                            </a>
                            <div class="card-content">
                                <h4 class="card-title">
                                    <a href="ShowContent.php?content='.$Post_ID.'">' . $Post_Title . '</a>
                                </h4>
                                <p class="">' . $SummeryPost_body . ' </p>
                            </div>
                            <div class="card-read-more">
                                <span><a href="ShowContent.php?content='.$Post_ID.'" class="btn">ادامه مطلب</a></span>
                                <span><p><img src="images/Author.png">'.$Post_Author.'</p></span>
                                <span><p><img src="images/Author.png">'.$Post_Create_At.'</p></span>
                            </div>
                        </div>
                    </div>
                ';
                }
            }else {$searchMsg= '<div class="alert alert-info" align="center"><img src="../../assets/images/sad.png"><p>متاسفیم نوشته ای وجود ندارد</p></div>';}

        ?>
                    <ul class="pagination">
                        <li class="page-item disabled"><a class="page-link" href="#">قبلی</a> </li>
                        <?php
                        for($i=1;$i<=$count;$i++){
                            if($i==$_GET['page']){
                                echo '<li class="page-item active"><a class="page-link" href="index.php?page='.$i.'">'.$i.'</a> </li>';

                            }else{
                                echo '<li class="page-item "><a class="page-link" href="index.php?page='.$i.'">'.$i.'</a> </li>';
                            }
                        }
                        ?>
                        <li class="page-item"><a class="page-link" href="#">بعدی</a> </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<br>


</div>



</div>
    <div class="clear"></div>
</div>
<!--End body-->
<br>
<?php require_once 'footer.php' ?>
<!---End footer --->
<script src="../../assets/js/jquery-3.4.1.min.js"></script>
<script src="../../assets/js/popper.min.js"></script>
<script src="../../assets/js/bootstrap.js"></script>
</body>
</html>