<?php
require_once '../../engin/db.php';


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

<!-- End Header -->
<?php
//نمایش نوشته های مربوط به دسته انتخاب شده
if (isset($_GET['content'])) {
    $id = mysqli_real_escape_string($db, $_GET['content']);
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
           <div class="wrapper pageLayout container-fluid">
    <div class="content">
        <div class="block">
            <div class="start-lerning">
                    <a href="TutorialContentLinks.php?Srart-learningBtn='.$tuTo_ID.'" class="btn btn-outline-success">شروع یادگیری<a>
            </div>
            <div class="toToPic">
            <div class="courseImg">
                <span><img src="../Admin/'.$tuTo_PicDir.'"></span> 
            </div>
           
               <span class="float-left"><img src="../../assets/images/ora-students.png" width="50px"><p style="color:#ffbbbe;font-size:18px;" class="bolder"> '.$tuTo_NumberOfLearners.'</p></span></div>
          <br>
          <br>
            <h1 style="color:#ffbbbe;">'.$tuTo_Name.'</h1>
            <p dir="rtl">'.$tuTo_Description.'</p>


        </div>
    </div>
</div>
                ';
            //نمایس برچسب ها به صورت جدا جدا
        }
    else {$searchMsg= '<div class="alert alert-info" align="center"><img src="../../assets/images/sad.png"><p>متاسفیم نوشته ای وجود ندارد</p></div>';}
}

?>






<script src="../../assets/js/jquery-3.4.1.min.js"></script>
<script src="../../assets/js/bootstrap.js"></script>
<script src="../../assets/js/popper.min.js"></script>
</body>
</html>