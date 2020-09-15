<?php require_once '../engin/db.php'; ?>
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
            $sql = "SELECT * FROM categories_tbl";
            $run = mysqli_query($db, $sql);
            while($row = mysqli_fetch_array($run)) {
                $Cat_ID = $row['Cat_ID'];
                $Cat_Title = $row['Cat_Title'];
                echo '<li><a href="category.php?CatID='.$Cat_ID.' class="btn" style="transition: 119ms;">'.$Cat_Title.'</a></li>';
            }
            ?>
            <li><a href="../Admin/AdminLogin.php">ورود مدیر</a> </li>
        </ul>
        </nav>
    </div>
    <div class="clear"></div>
</div><br>

<!-- Start Search box-->
<div class="wrapper">
    <div class="search_box">

        <form action="" method="post" class="row">
            <input type="text" class="input_search" placeholder="دنبال چی هستی؟" name="searchValue">
            <button name="searchBtn" type="submit" class="search_btn" value=""><img src="../../assets/images/search-icon.png" style="width: 2.5rem"></button>
        </form>

    </div>
    <div class="clear"></div>

</div><br><br><br><br><br>

<?php

//search
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

                echo '<div class="row container">
                  <div class="post col-md-3">
            <!--Post Header -->
            <div class="postHeader">
                <h2 class="postTitle">' . $Post_Title . '</h2>
                <span>تاریخ انتشار:' . $Post_Create_At . '</span>

                <div class="clear"></div>
            </div>
            <!--Post Body -->
            <div class="postBody">
                <div class="postPic"><img src="../Admin/' . $Post_Img . '"></div>
                <div class="postDesc">' . $SummeryPost_body . '</div>
                <!--Post Footer -->
                <div class="postFooter">
                    <span><img src="images/Author.png"> ' . $Post_Author . '</span>
                    <a href="ShowContent.php?content='.$Post_ID.'" class="btn ReadMore">ادامه مطلب</a>
                    <div class="clear"></div>

                </div>
            </div>
            </div></div>
                ';
            }
        }else {$searchMsg= '<div class="alert alert-info" align="center"><img src="../../assets/images/sad.png"><p>متاسفیم نتیجه ای پیدا نشد</p></div>';}
        echo '<hr>';
    }

}
if(isset($searchMsg)){ echo '<div class="container"  align="center">'.$searchMsg.'</div>';}
?>

<!-- End Search box-->

<!--End Header-->

<!--Start body-->
<div class="body">
    <div class="container">
        <div class="row ">

            <?php
            //نمایش نوشته های مربوط به دسته انتخاب شده
            if (isset($_GET['CatID'])) {
                $id = mysqli_real_escape_string($db, $_GET['CatID']);
                $sql = "SELECT * FROM posts_tbl WHERE Cat_ID='$id'";
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
                  <div class="post col-md-3">
            <!--Post Header -->
            <div class="postHeader">
                <h2 class="postTitle">' . $Post_Title . '</h2>
                <span>تاریخ انتشار:' . $Post_Create_At . '</span>

                <div class="clear"></div>
            </div>
            <!--Post Body -->
            <div class="postBody">
                <div class="postPic"><img src="../Admin/' . $Post_Img . '"></div>
                <div class="postDesc">' .  $SummeryPost_body . '</div>
                <!--Post Footer -->
                <div class="postFooter">
                    <span><img src="images/Author.png"> ' . $Post_Author . '</span>
                    <a href="ShowContent.php?content='.$Post_ID.'" class="btn ReadMore">ادامه مطلب</a>
                    <div class="clear"></div>

                </div>
            </div>
            </div>
                ';
                    }
                }else {$searchMsg= '<div class="alert alert-info" align="center"><img src="../../assets/images/sad.png"><p>متاسفیم نوشته ای وجود ندارد</p></div>';}
            }
            ?>

        </div>
    </div>
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