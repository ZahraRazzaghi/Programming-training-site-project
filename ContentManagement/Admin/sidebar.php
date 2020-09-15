<?php
//ini_set('display_errors', '0');//Don't show php errors
require_once '../engin/db.php';
if(!isset($_SESSION['AdminLogin'])){
    header('Location: AdminLogin.php');
}
?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <title></title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="X-UA-Compatible" content="ie=edge">
    <link href="../../assets/css/bootstrap.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />

</head>
<body>
<header id="cabecalho">
    <a href="#" id="logo" style="padding-top: 5px;"><img src="../../assets/images/logo.png" style="width: 2.2rem;"><i>fastscroll</i></a>
    <nav dir="rtl">
        <a href="#" id="menu-icon" style="padding-top: 5px;"><img src="../../assets/images/menu-icon.png" style="width: 2.3rem;"> </a>
        <ul>
            <li><a href="../Articles/index.php" class="btn" style="transition: 119ms;background: transparent;border: none;color:rgb(96,9,240);" target="_blank">مشاهده مقالات</a></li>
            <li><a href="../Tutorials/TutorialsList.php" class="btn" style="transition: 119ms;background: transparent;border: none;color:rgb(96,9,240);" target="_blank">مشاهده آموزش ها</a></li>
        </ul>
    </nav>
</header>
<br>
<br>
<div class="sideBar">
    <div class="accordion">
        <ul>
            <li><a href="AdminDashboard.php">داشبورد<img class="float-left" src="images/AdminPics/dashboard.png" style="width:15px;padding-top: 6px" ></a> </li>
            <li class="has-sub" id="item1"><a href="#">مدیریت مطالب <img id="img1" class="float-left" src="images/AdminPics/accordion.png" width="15px"></a>
            <ul id="sub1">
                <li><a href="Categories.php">افزودن دسته بندی جدید</a> </li>
                <li><a href="AddPosts.php">افزودن مطلب </a> </li>
                <li><a href="Posts.php">مشاهده مطالب</a> </li>

            </ul>
            </li>
            <li class="has-sub" id="item2"><a href="#">مدیریت آموزش ها<img id="img2" class="float-left" src="images/AdminPics/accordion.png" width="15px"></a>
            <ul id="sub2">
                <li><a href="AddTutorial.php">افزودن دسته بندی جدید</a> </li>
                <li><a href="TutorialsList.php">مشاهده لیست دسته بندی ها</a> </li>
                <li><a href="AddPageToTutorial.php">افزودن برگه جدید </a> </li>
                <li><a href="TutorialPages.php">مشاهده لیست برگه ها</a> </li>

            </ul>
            </li>

            <li class="has-sub" id="item3"><a href="#">مدیریت نظرات<img id="img3" class="float-left" src="images/AdminPics/accordion.png" width="15px"></a>
            <ul id="sub3">
                <li><a href="Comments.php">مشاهده نظرات</a> </li>

            </ul>
            <li class="has-sub" id="item4"><a href="#"><img id="img4" class="float-left" src="images/AdminPics/accordion.png" width="15px">مدیریت مدیران</a>
                <ul id="sub4">
                    <li><a href="Admins-manage.php">مشاهده مدیران</a> </li>

                </ul>
            </li>

        </ul>
        <div class="clear"></div>

    </div>
    <div class="clear"></div>

</div>


<style>
    .rotated {
        -webkit-transform: rotate(90deg);  /* Chrome, Safari 3.1+ */
        -moz-transform: rotate(90deg);  /* Firefox 3.5-15 */
        -ms-transform: rotate(90deg);  /* IE 9 */
        -o-transform: rotate(90deg);  /* Opera 10.50-12.00 */
        transform: rotate(90deg);  /* Firefox 16+, IE 10+, Opera 12.10+ */
        transition: 500ms;
    }

</style>
<script src="../../assets/js/jquery-3.4.1.min.js"></script>
<script src="../../assets/js/popper.min.js"></script>
<script src="../../assets/js/bootstrap.js"></script>
<script>

    $('#sub1').slideUp(0);
    $('#sub2').slideUp(0);
    $('#sub3').slideUp(0);
    $('#sub4').slideUp(0);

    $('#item1').click(function () {
        $('#sub1').slideToggle(500);
        $('#sub4').slideUp(500);
        $('#sub3').slideUp(500);
        $('#sub2').slideUp(500);
        $('#img1').toggleClass('rotated');

    })
    $('#item2').click(function () {
        $('#sub2').slideToggle(500);
        $('#sub4').slideUp(500);
        $('#sub3').slideUp(500);
        $('#sub1').slideUp(500);
        $('#img2').toggleClass('rotated');
    })
    $('#item3').click(function () {
        $('#sub3').slideToggle(500);
        $('#sub4').slideUp(500);
        $('#sub2').slideUp(500);
        $('#sub1').slideUp(500);
        $('#sub').slideUp(500);
        $('#img3').toggleClass('rotated');
    })
    $('#item4').click(function () {
        $('#sub4').slideToggle(500);
        $('#sub3').slideUp(500);
        $('#sub2').slideUp(500);
        $('#sub1').slideUp(500);
        $('#img4').toggleClass('rotated');
    })


</script>

</body>
</html>
