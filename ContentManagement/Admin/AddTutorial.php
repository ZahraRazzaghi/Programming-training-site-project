<?php
ini_set('display_errors', '0');//Don't show php errors
require_once '../engin/db.php';
if(!isset($_SESSION['AdminLogin'])){
    header('Location: AdminLogin.php');
}
?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <title>پروفایل :<?php echo $_SESSION['AdminLogin']; ?>  </title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="X-UA-Compatible" content="ie=edge">

    <link href="../../assets/css/bootstrap.css" rel="stylesheet" />
    <link href="../../assets/css/style-top-menu.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
    <link href="../Articles/css/style.css" rel="stylesheet" />
    <link href="css/trumbowyg.min.css" rel="stylesheet" />

</head>
<body>
<?php require_once 'sidebar.php'?>
<div class="content">
    <p style="color: #6009f0;padding-top: 3px"><b><img src="images/AdminPics/plus.png" style="margin-left: 3px;width:18px;"> افزودن آموزش جدید</b></p>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="text" class="text-box" name="tutoName" style="width: 50%;" placeholder="عنوان آموزش" required><br>
            <div class="select-pic">
                    <label for="tutoPic">انتخاب تصویر برای آموزش جدید</label>
                    <input type="file" name="tutoPic" class="text-box" title="عکس را به اینجا بکشید"><br>
            </div>
             <textarea id="trumbowyg-demo" placeholder="توضیحات" name="tuToDescription" type="text-box" style="width: 95%;border:1px solid #7b79ff; min-height: 300px;height: 300px;padding: .5rem"></textarea>
            <input type="submit" class="btn btn-success" name="insertTuto" value="درج آموزش">
            <input type="reset" class="btn btn-secondary" value="انصراف">
        </form>
    <?php
    $msg ='';
    //inser into post table
    if(isset($_POST['insertTuto'])) {
        $tuToName = $_POST['tuToName'];
        $tuToDescription = $_POST['tuToDescription'];

            //Start upload img--------------------------------------------
            require_once 'TotuPicUpload.php';
            //End Upload Img--------------------------------------------

        $sql = "INSERT INTO toturials_tbl(tuTo_Name,tuTo_Description,tuTo_PicDir)VALUES('$tuToName','$tuToDescription','$targetFilePath')";
        $run = mysqli_query($db, $sql);
        if ($run) {
            $msg = "<p class='alert alert-success'>آموزش جدید با موفقیت اضافه شد</p>";
        } else {
            $msg = "<p class='alert alert-danger'>اضافه کردن آموزش جدید با شکست مواجه شد.</p>";
        }
    }

    ?>
        <?php echo $msg; ?>


<script src="../../assets/js/jquery-3.4.1.min.js"></script>
<script src="../../assets/js/popper.min.js"></script>
<script src="../../assets/js/bootstrap.js"></script>

    <script src="js/trumbowyg.fa.js"></script>
    <script src="js/trumbowyg.min.js"></script>

    <script>
        $('#trumbowyg-demo').trumbowyg();

    </script>
</body>
</html>

