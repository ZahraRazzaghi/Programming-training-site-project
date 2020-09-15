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
    <title>ویرایش مطلب </title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="X-UA-Compatible" content="ie=edge">
    <link href="../../assets/css/bootstrap.css" rel="stylesheet" />
    <link href="../../assets/css/style-top-menu.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
    <link href="../Articles/css/style.css" rel="stylesheet" />

</head>
<body>
<?php require_once 'sidebar.php'?>
<div class="content">
    <p style="color: #6009f0;padding-top: 3px"><b><img src="images/AdminPics/edit-64.png" style="margin-left: 3px;width:18px;">ویرایش آموزش </b></p>
    <?php
    $msg ='';
    //select upon resiving data
    if (isset($_GET['editTuto'])) {
        $id = mysqli_real_escape_string($db, $_GET['editTuto']);
        $sql = "SELECT * FROM toturials_tbl WHERE tuTo_ID='$id'";
        $run = mysqli_query($db, $sql);
        if (mysqli_num_rows($run) > 0) {
            $row = mysqli_fetch_array($run);
            $tuTo_ID = $row['tuTo_ID'];
            $tuTo_Name = $row['tuTo_Name'];
            $tuTo_Description = $row['tuTo_Description'];
            $tuTo_NumberOfLearners = $row['tuTo_NumberOfLearners'];
            $tuTo_PicDir = $row['tuTo_PicDir'];
        }

        //update posts information
        if (isset($_POST['EditTutoBtn'])) {
            $tuToName = $_POST['tutoName'];
            $tuToDescription = $_POST['tuToDescription'];

            //Start upload img------------------------------------------
            require_once 'TotuPicUpload.php';
            if($move){//اگه عکس جدیدی آپلود شد
                unlink($tuTo_PicDir);//فایل قبلی رو از دایرکتوری پاک کن
            }else{//در غیر اینصورت
                $targetFilePath=$tuTo_PicDir;//همون فایل قبلی رو بزار باشه
            }
            //End Upload Img--------------------------------------------
            $sql = "UPDATE toturials_tbl SET  tuTo_Name='$tuToName',tuTo_Description='$tuToDescription',tuTo_PicDir='$targetFilePath' WHERE tuTo_ID='$id'";
            $run = mysqli_query($db, $sql);
            if ($run) {
                $msg = "<p class='alert alert-success'>نوشته با موفقیت ویرایش شد</p>";
                header("Location: Tutorials.php");
            } else {
                $msg = "<p class='alert alert-danger'>ویرایش نوشته با شکست مواجه شد.</p>";
            }

        }
    }
    ?>

    <form action="" method="POST" enctype="multipart/form-data">
        <input value="<?php echo $tuTo_Name;?>" type="text" class="text-box" name="tutoName" style="width: 50%;" placeholder="عنوان آموزش" required>

        <div class="select-pic">
            <img src="<?php echo $tuTo_PicDir;?>">
            <label for="tutoPic">انتخاب تصویر برای آموزش جدید</label>
            <input type="file" name="tutoPic" class="text-box" title="عکس را به اینجا بکشید"><br>
        </div>
        <textarea contenteditable="true"  placeholder="توضیحات" name="tuToDescription" type="text-box" style="width: 100%;border:1px solid #7b79ff; min-height: 300px;height: 300px;padding: .5rem"><?php echo $tuTo_Description;?></textarea>

        <br>
        <input type="submit" class="btn btn-success" name="EditTutoBtn" value="ویرایش آموزش">
        <input type="reset" class="btn btn-secondary" value="انصراف">
    </form>
<?php echo $msg; ?>






    <script src="../../assets/js/jquery-3.4.1.min.js"></script>
    <script src="../../assets/js/popper.min.js"></script>
    <script src="../../assets/js/bootstrap.js"></script>
</body>
</html>

