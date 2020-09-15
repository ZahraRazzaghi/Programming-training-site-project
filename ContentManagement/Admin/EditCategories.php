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
    <title>پروفایل :<?php echo $_SESSION['AdminLogin']; ?>  </title>
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
<!--Start Edit Category -->
    <p style="color: #6009f0;padding-top: 3px"><b><img src="images/AdminPics/edit-64.png" style="margin-left: 3px;width:18px;">ویرایش دسته بندی</b></p>

    <div class="EditCategory">
    <?php
    $msg ='';
//select upon resiving data
    if (isset($_GET['edit'])){
        $id = mysqli_real_escape_string($db,$_GET['edit']);
        $sql = "SELECT * FROM categories_tbl WHERE Cat_ID='$id'";
        $run = mysqli_query($db, $sql);
        if (mysqli_num_rows($run) > 0) {
            $row = mysqli_fetch_array($run);
            $Cat_ID = $row['Cat_ID'];
            $Cat_Title = $row['Cat_Title'];
            //update category name
            if (isset($_POST['editCategory'])) {
                $changeCatTitle =$_POST['CatTitle'];
                $sql = "UPDATE categories_tbl SET  Cat_Title='$changeCatTitle' WHERE Cat_ID='$id'";
                $run = mysqli_query($db, $sql);
                if ($run) {
                    $msg = "<p class='alert alert-success'>دسته بندی با موفقیت ویرایش شد</p>";
                     echo "<script> window.location.replace('Categories.php') </script>";
                } else {
                    $msg = "<p class='alert alert-danger'>ویرایش دسته بندی با شکست مواجه شد.</p>";
                }

            }
        }
    }

    ?>

        <form action="" method="POST">
            <input value="<?php echo $Cat_Title; ?>" type="text" class="text-box" name="CatTitle" placeholder="نام دسته بندی" required>
            <input type="submit" class="btn btn-success" name="editCategory" value="ویرایش دسته بندی">
            <input type="reset" class="btn btn-secondary" value="لغو">
        </form>
        <?php if (isset($msg))echo $msg; ?>


    </div>
<!--End Edit Category -->



</div>
    <script src="../../assets/js/jquery-3.4.1.min.js"></script>
    <script src="../../assets/js/popper.min.js"></script>
    <script src="../../assets/js/bootstrap.js"></script>

</body>
</html>

