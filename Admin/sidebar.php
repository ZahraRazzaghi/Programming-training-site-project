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
<br>
<div class="sideBar">
    <div class="accordion">
        <ul>
            <li><a href="AdminDashboard.php">داشبورد</a> </li>

            <li class="has-sub" id="item"> <a href="#">مدیریت دسته بندی</a>
            <ul id="sub">
                <li><a href="Categories.php">افزودن دسته بندی جدید</a> </li>

            </ul>
            </li>

            <li class="has-sub" id="item1"><a href="#">مدیریت مطالب</a>
            <ul id="sub1">
                <li><a href="Posts.php">مشاهده مطالب</a> </li>
                <li><a href="AddPosts.php">افزودن مطلب </a> </li>

            </ul>
            </li>

            <li class="has-sub" id="item2"><a href="#">مدیریت نظرات</a>
            <ul id="sub2">
                <li><a href="AdminDashboard.php">مشاهده نظرات</a> </li>

            </ul>
            </li>

        </ul>
        <div class="clear"></div>

    </div>
    <div class="clear"></div>

</div>



<script src="../../assets/js/jquery-3.4.1.min.js"></script>
<script src="../../assets/js/popper.min.js"></script>
<script src="../../assets/js/bootstrap.js"></script>
<script>
    $('#sub').slideUp(0);
    $('#sub1').slideUp(0);
    $('#sub2').slideUp(0);
    $('#sub3').slideUp(0);
    $('#item').click(function () {
        $('#sub').slideToggle(500);
        $('#sub1').slideUp(500);
        $('#sub2').slideUp(500);
    })
    $('#item1').click(function () {
        $('#sub1').slideToggle(500);
        $('#sub').slideUp(500);
        $('#sub2').slideUp(500);
    })
    $('#item2').click(function () {
        $('#sub2').slideToggle(500);
        $('#sub1').slideUp(500);
        $('#sub').slideUp(500);
    })


</script>

</body>
</html>
