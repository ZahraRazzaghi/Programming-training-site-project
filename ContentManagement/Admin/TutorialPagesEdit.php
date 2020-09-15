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
    <title>افزودن برگه جدید</title>
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
    <p style="color: #6009f0;padding-top: 3px"><b><img src="images/AdminPics/edit-64.png" style="margin-left: 3px;width:18px;">ویرایش برگه</b></p>
    <?php
    if (isset($_GET['editTutoPage'])) {
        $id = mysqli_real_escape_string($db, $_GET['editTutoPage']);
        $sql = "SELECT * FROM tutorialpages_tbl WHERE tutorialPage_ID='$id'";
        $run = mysqli_query($db, $sql);
        $row = mysqli_fetch_array($run);
        $tutorialPage_ID = $row['tutorialPage_ID'];
        $tutorialPage_Name = $row['tutorialPage_Name'];
        $tutorialPage_Desc = $row['tutorialPage_Desc'];
        $tuTo_ID = $row['tuTo_ID'];
    }
    ?>
    <form action="" method="POST" enctype="multipart/form-data">
        <input value="<?php echo $tutorialPage_Name;?>" type="text" class="text-box" name="pageTitle" style="width: 50%;" placeholder="نام برگه" required>
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
        <pre> <textarea placeholder="توضیحات" name="pageBody" type="text-box" style="width: 100%;border:1px solid #7b79ff; min-height: 300px;height: 300px;padding: .5rem"><?php echo $tutorialPage_Desc;?></textarea></pre>
        <br>
        <input type="submit" class="btn btn-success" name="updatePage" value="ویرایش برگه">
        <input type="reset" class="btn btn-outline-secondary" value="انصراف">
    </form>
    <?php
    $msg ='';
    //inser into post table
    if(isset($_POST['updatePage'])) {
        $pageTitle = $_POST['pageTitle'];
        $pageBody = $_POST['pageBody'];
        $pageCategoryId = $_POST['pageCategoryId'];

        $sql = "Update tutorialpages_tbl SET tutorialPage_Name='$pageTitle',tutorialPage_Desc='$pageBody',tuTo_ID='$pageCategoryId' WHERE tutorialPage_ID='$id'";
        $run = mysqli_query($db, $sql);
        if ($run) {
            $msg = "<p class='alert alert-success'>برگه با موفقیت ویرایش شد</p>";
        } else {
            $msg = "<p class='alert alert-danger'> ویرایش برگه با شکست مواجه شد </p>";
        }
    }
    ?>
    <?php echo $msg; ?>


    <script src="../../assets/js/jquery-3.4.1.min.js"></script>
    <script src="../../assets/js/popper.min.js"></script>
    <script src="../../assets/js/bootstrap.js"></script>

</body>
</html>

