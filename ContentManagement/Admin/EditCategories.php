<?php
//ini_set('display_errors', '0');//Don't show php errors
require_once '../includs/init.php';
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
<body class="">
<!-- Start Header -->
<header id="cabecalho">
    <a href="#" id="logo" style="padding-top: 5px;"><img src="../../assets/images/logo.png" style="width: 2.2rem;"><i>fastscroll</i></a>
    <nav dir="rtl">
        <a href="#" id="menu-icon" style="padding-top: 5px;"><img src="../../assets/images/menu-icon.png" style="width: 2.3rem;"> </a>
        <ul>
            <li><a href="../Articles/index.php" class="btn" style="transition: 119ms;background: transparent;border: none;color:rgb(96,9,240);" target="_blank">مشاهده مقالات</a></li>
            <li><a href="../Articles/index.php" class="btn" style="transition: 119ms;background: transparent;border: none;color:rgb(96,9,240);" target="_blank">مشاهده آموزش ها</a></li>
        </ul>
    </nav>
</header>
<!-- End Header -->
<br>
<?php require_once 'sidebar.php'?>
<div class="content">
<!--Start ADD New Category -->
<div class="EditCategory">
    <?php
    $msg ='';
//select upon resiving data
    if (isset($_GET['edit'])){
        $id = mysqli_real_escape_string($db,$_GET['edit']);
        $sql = "SELECT * FROM categories_tbl WHERE Cat_ID='$id'";
        $run = mysqli_query($con, $sql);
        if (mysqli_num_rows($run) > 0) {
            $row = mysqli_fetch_array($run);
            $Cat_ID = $row['Cat_ID'];
            $Cat_Title = $row['Cat_Title'];
            //update category name
            if (isset($_POST['editCategory'])) {
                $changeCatTitle =$_POST['CatTitle'];
                $sql = "UPDATE categories_tbl SET  Cat_Title='$changeCatTitle' WHERE Cat_ID='$id'";
                $run = mysqli_query($con, $sql);
                if ($run) {
                    $msg = "<p class='alert alert-success'>دسته بندی با موفقیت ویرایش شد</p>";
                    header("refresh:0.5,url=Categories.php");
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
<!--End ADD New Category -->



</div>
    <script src="../../assets/js/jquery-3.4.1.min.js"></script>
    <script src="../../assets/js/popper.min.js"></script>
    <script src="../../assets/js/bootstrap.js"></script>

</body>
</html>

