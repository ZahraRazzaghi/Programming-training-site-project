<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="X-UA-Compatible" content="ie=edge">
    <title>Forum - fastscroll.com</title>
    <link href="../../assets/css/bootstrap.css" type="text/css" rel="stylesheet">
    <link href="../themes/css/style.css" rel="stylesheet" type="text/css">
    <link href="../../assets/css/all.min.css" rel="stylesheet">
</head>
<body>
<?php
/*
if(isset($_SESSION['username'])){
   logout();
}else{
    if(isset($_GET['status'])){
        if($_GET['status']=='reg_success'){
            echo "<h1 style='color:green;'>new user register successfully!</h1>";
        }else if($_GET['status']=='login_fail'){
            echo "<h1 style='color:red;'>invalid username and/or password!</h1>";
        }
    }
}
*/
?>
<div class="headerfixedbar container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="pullLeft"  style="margin-top: 4px;">
               <a href="../../index.php" title="fastscroll.com" class="headerLogoText"><img src="../../assets/images/logo.png" alt="fastscroll.com" class="headerLogoImage"><i>fastscroll</i> </a>
            </div>
            <div class="pullRight">
               <a href="../../index.php?logout" title="خروج از حساب کاربری" class="btn btn-primary themeButton">Logout</a>
            </div>
        </div>
    </div>
</div>
<!-- ُStart of forum structure layout -->
<div class="container">
<div class="row">
    <div class="col-lg-12 paginationBar forumModule forumMargin">
        <a href="#">خانه</a><!--<i class="fa fa-chevron-circle-left paginationArrow"></i>
        <a href="#">دسته</a><i class="fa fa-chevron-circle-left paginationArrow"></i>
        <a href="#">بحث</a>-->
    </div>
</div>

    <div id="category_1" class="row forumModule forumMargin" style="margin-top: 0px">
        <a href="#" onclick="showDisscussions(1);">
        <div class="col-lg-12 columnPad">
            <div class="pullRight">
                <h1> نام دسته</h1>
            </div>
            <div class="pullLeft">
                <a id="startDiscussionButton_1" href="#" class="btn btn-primary themeButton" onclick="startDiscussion(1);"> شروع بحث</a>
            </div>
        </div>
        </a>
    </div>

<div id="cat_new_discussion_1" style="display: none;">
    <div class="col-lg-12">
        <form>
            <div class="form-group">
                 <label>عنوان</label>
                <input type="text" name="newDiscussionTitle" class="form-control" size="40">
                <label  style="margin-top: 15px;">محتوا</label>
                <textarea name="newDiscussionText" rows="8" class="form-control"></textarea>

            </div>
        </form>
    </div>
</div>



    <div id="cat_discussions_1" class="row forumPad" style="display: none;">
        <div class="col-lg-12">
        <table class="forumTable">
            <thead>
            <th class="pullLeft">پاسخ ها</th>
            <th>نویسنده</th>
            <th>بحث</th>

            </thead>
            <tr class="forumModule">
                <td><a href="#" class="pullLeft">25</a>
                <td><a href="#" dir="auto">سمانه</a></td>
                <td><a href="#" dir="auto">توابع در php </a></td>

            </tr>
            <tr class="forumModule">
                <td><a href="#" class="pullLeft">32</a>
                <td><a href="#" dir="auto">کیان</a></td>
                <td><a href="#" dir="auto">شی گرایی در php </a></td>

            </tr>
            <tr class="forumModule">
                <td><a href="#" class="pullLeft">10</a>
                <td><a href="#" dir="auto">علی</a></td>
                <td><a href="#" dir="auto"> z-index در css </a></td>

            </tr>
        </table>
        </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="pullRight" style="padding-left: 15px;">
                <a class="btn-link" href="#">بیشتر بخوانید</a>
            </div>
        </div>
    </div>
</div>

    <div id="category_2" class="row forumModule" style="margin-top: 0px">
        <a href="#" onclick="showDisscussions(2);">
            <div class="col-lg-12 columnPad">
                <div class="pullRight">
                    <h1> نام دسته</h1>
                </div>
                <div class="pullLeft">
                    <a id="startDiscussionButton_2" href="#" class="btn btn-primary themeButton" onclick="startDiscussion(2);"> شروع بحث</a>
                </div>
            </div>
        </a>
    </div>

    <div id="cat_new_discussion_2" style="display: none;">
        <div class="col-lg-12">
            <form>
                <div class="form-group">
                    <label>عنوان</label>
                    <input type="text" name="newDiscussionTitle" class="form-control" size="40">
                    <label  style="margin-top: 15px;">محتوا</label>
                    <textarea name="newDiscussionText" rows="8" class="form-control"></textarea>

                </div>
            </form>
        </div>
    </div>

    <div id="cat_discussions_2" class="row forumPad" style="display: none;">
        <div class="col-lg-12">
        <table class="forumTable">
            <thead>
            <th class="pullLeft">پاسخ ها</th>
            <th>نویسنده</th>
            <th>بحث</th>

            </thead>
            <tr class="forumModule">
                <td><a href="#" class="pullLeft">25</a>
                <td><a href="#" dir="auto">سمانه</a></td>
                <td><a href="#" dir="auto">توابع در php </a></td>

            </tr>
            <tr class="forumModule">
                <td><a href="#" class="pullLeft">32</a>
                <td><a href="#" dir="auto">کیان</a></td>
                <td><a href="#" dir="auto">شی گرایی در php </a></td>

            </tr>
            <tr class="forumModule">
                <td><a href="#" class="pullLeft">10</a>
                <td><a href="#" dir="auto">علی</a></td>
                <td><a href="#" dir="auto"> z-index در css </a></td>

            </tr>
        </table>
        </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="pullRight" style="padding-left: 15px;">
                <a class="btn-link" href="#">بیشتر بخوانید</a>
            </div>
        </div>
    </div>
</div>

</div>


<!--- js files & codes --->
<script src="../../assets/js/bootstrap.js" type="text/css" rel="stylesheet"></script>
<script src="../../assets/js/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
<script>

    function showDisscussions(cat_id) {
        var html_id="#cat_discussions_" + cat_id;
       if($(html_id).css("display"=="block")){
           $(html_id).css("display","none");
       }else{
           $(html_id).css("display","block");
       }
    }
    function startDiscussion(cat_id) {
        var button_id="#startDiscussionButton_" + cat_id;
        var html_id="#cat_new_discussion_" + cat_id;
        if($(html_id).css("display"=="block")){
            $(html_id).css("display","none");
            $(button_id).text("شروع بحث");

        }else{
            $(html_id).css("display","block");
            $(button_id).text("لغو");
        }
    }
</script>
</body>
</html>