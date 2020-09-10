<?php require_once '../includs/init.php'; ?>
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
<!--
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
-->
<div class="header">
    <div  class="container">
        <ul class="menu">
            <?php
            $sql = "SELECT * FROM categories_tbl";
            $run = mysqli_query($con, $sql);
            while($row = mysqli_fetch_array($run)) {
                $Cat_ID = $row['Cat_ID'];
                $Cat_Title = $row['Cat_Title'];
                echo "<li><a href='?CatID=".$Cat_ID."'>$Cat_Title</a> </li>";
            }
            ?>
            <li><a href="../Admin/AdminLogin.php">ورود مدیر</a> </li>
        </ul>
    </div>
    <div class="clear"></div>
</div><br>

<div class="container ContentBody">
    <?php
    //نمایش نوشته های مربوط به دسته انتخاب شده
    if (isset($_GET['content'])) {
        $id = mysqli_real_escape_string($con, $_GET['content']);
        $sql = "SELECT * FROM posts_tbl WHERE Post_ID='$id'";
        $run = mysqli_query($con, $sql);
        $rows = mysqli_num_rows($run);
        if ($rows > 0) {
            while ($row = mysqli_fetch_array($run)) {
                $Post_Title = $row['Post_Title'];
                $Post_Author = $row['Post_Author'];
                $Post_Create_At = $row['Post_Create_At'];
                $Post_Img = $row['Post_Img'];
                $Post_body = $row['Post_body'];
                $Post_Img = $row['Post_Img'];
                $Post_Tags = $row['Post_Tags'];

                echo '
                  <div class="postContent container">
            <!--Post Header -->
            <div class="postContentHeader"  align="center">
                <div class="postContentPic"><img src="../Admin/' . $Post_Img . '"></div><hr class="bg-info" width="100px">
                <h2 class="text-dark">' . $Post_Title . '</h2>
            </div>
            <!--Post Body -->
            <div class="postContentBody">
                <div class="postContentDesc">' . $Post_body . '</div>
                <!--Post Footer -->
                <div class="postContentFooter">
                    <span calss="author"><img src="images/Author.png"> ' . $Post_Author . '</span>
                    <span class="date">تاریخ انتشار:' . $Post_Create_At . '</span>
                    <hr>
                     <span class="date">برچسب ها:' . $Post_Tags . '</span>

                </div>
            </div>
            </div>
                ';
            }
        }else {$searchMsg= '<div class="alert alert-info" align="center"><img src="../../assets/images/sad.png"><p>متاسفیم نوشته ای وجود ندارد</p></div>';}
    }
    ?>
</div>

<br>
<br>





<br>
<?php require_once 'footer.php' ?>
<script src="../../assets/js/jquery-3.4.1.min.js"></script>
<script src="../../assets/js/popper.min.js"></script>
<script src="../../assets/js/bootstrap.js"></script>
</body>
</html>