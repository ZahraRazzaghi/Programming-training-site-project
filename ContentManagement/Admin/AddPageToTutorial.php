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
    <title>افزودن برگه جدید</title>
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
    <p style="color: #6009f0;padding-top: 3px"><b><img src="images/AdminPics/plus.png" style="margin-left: 3px;width:18px;">افزودن برگه جدید به یک آموزش</b></p>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="text" class="text-box" name="pageTitle" style="width: 50%;" placeholder="نام برگه" required>
        <select name="pageCategoryId" required title="دسته بندی">
            <option value="" disabled selected>آموزش ها</option>
            <?php
            //Show categories in drop down menu
            $sql = "SELECT * FROM toturials_tbl";
            $run = mysqli_query($db, $sql);
            while($row = mysqli_fetch_array($run)) {
                $tuTo_ID = $row['tuTo_ID'];
                $tuTo_Name = $row['tuTo_Name'];
                echo '<option value="'.$tuTo_ID.'">'.$tuTo_Name.'</option>';
            }
            ?>
        </select><br>
       <textarea id="trumbowyg-demo" placeholder="توضیحات" name="pageBody" type="text-box" style="width: 95%;border:1px solid #7b79ff; min-height: 300px;height: 300px;padding: .5rem"></textarea>
        <input type="submit" class="btn btn-success" name="insertPage" value="درج برگه">
        <input type="reset" class="btn btn-outline-secondary" value="انصراف">
    </form>
    <?php
    $msg ='';
    //inser into post table
    if(isset($_POST['insertPage'])) {
        $pageTitle = $_POST['pageTitle'];

        $pageBody = $_POST['pageBody'];
        $pageCategoryId = $_POST['pageCategoryId'];

        $sql = "INSERT INTO tutorialpages_tbl(tutorialPage_Name,tutorialPage_Desc,tuTo_ID)VALUES('$pageTitle','$pageBody','$pageCategoryId')";
        $run = mysqli_query($db, $sql);
        if ($run) {
            $msg = "<p class='alert alert-success'>برگه جدید با موفقیت اضافه شد</p>";
        } else {
            $msg = "<p class='alert alert-danger'>اضافه کردن برگه جدید با شکست مواجه شد.</p>";
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

