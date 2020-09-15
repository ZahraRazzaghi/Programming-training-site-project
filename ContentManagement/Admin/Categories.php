<?php
ini_set('display_errors', '0');//Don't show php errors
require_once '../engin/db.php';
if(!isset($_SESSION['AdminLogin'])){
    header('Location: AdminLogin.php');
}
//Delete Category
if (isset($_GET['deleteCat'])) {
    $id = mysqli_real_escape_string($db, $_GET['deleteCat']);
    $sql = "DELETE FROM categories_tbl WHERE Cat_ID ='$id'";
    $run = mysqli_query($db,$sql);
    if($run){
        $msg2='<p class="alert alert-success">دسته موردنظر با موفقیت حذف شد.</p>';
    }else{
        $msg2='<p class="alert alert-success">حذف دسته با شکست مواجه شد.</p>';
    }
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
    <!--Start ADD New Category -->
    <p style="color: #6009f0;padding-top: 3px"><b><img src="images/AdminPics/plus.png" style="margin-left: 3px;width:18px;">افزودن دسته بندی جدید</b></p>
    <div class="addNewCategory">
        <?php
        $msg ='';
        if(isset($_POST['insertCategory'])){
            $Cat_Title = $_POST["CatTitle"];
            $sql = "INSERT INTO categories_tbl(Cat_Title)VALUES('$Cat_Title')";
            $run = mysqli_query($db,$sql);
            if($run){
                $msg ="<p class='alert alert-success'>دسته جدید با موفقیت اضافه شد</p>";
            }else{
                $msg ="<p class='alert alert-danger'>اضافه کردن دسته جدید با شکست مواجه شد.</p>";
            }

        }
        ?>

        <form action="" method="POST">
            <input type="text" class="text-box" name="CatTitle" placeholder="نام دسته بندی" required>
            <input type="submit" class="btn btn-success" name="insertCategory" value="درج دسته بندی">
            <input type="reset" class="btn btn-secondary" value="لغو">
        </form>
        <?php echo $msg; ?>
    </div>
    <!--End ADD New Category -->

    <br>
    <br>


    <!--Start Show All Categories -->
    <div class="showAllCategories">
        <p style="color: #6009f0"><b><img src="images/AdminPics/eye-64.png" style="margin-left: 3px;width:18px;"> لیست دسته بندی مطالب</b></p>

        <table>
            <thead>
            <tr>
                <th>شناسه</th>
                <th>نام دسته بندی</th>
                <th>عملیات</th>
            </tr>
            </thead>

            <tbody>

            <?php
            $msg2='';
            $sql = "SELECT * FROM categories_tbl";
            $run = mysqli_query($db, $sql);
            $rows = mysqli_num_rows($run);
            if ($rows>0) {
                $ID = 0;
                while ($row = mysqli_fetch_array($run)) {
                    $Cat_Title = $row['Cat_Title'];
                    $Cat_D = $row['Cat_ID'];
                    $ID+=1;
                    echo '<tr>
           <td>'.$ID.'</td>
           <td>'.$Cat_Title.'</td>
           <td>
                  <a href="EditCategories.php?edit='.$Cat_D.'" ><i><img src="images/AdminPics/edit.png"></i></a>
                  <a href="?deleteCat='.$Cat_D.'"><i><img src="images/AdminPics/delete.png"></i></a>
           </td></tr>';

                }
            }else echo '<p class="alert alert-info">دسته ای وجود ندارد</p>';

            ?>

            </tbody>
        </table>
    </div>
    <!--End Show All Categories -->
    <?php echo $msg2;?>


</div>
<script src="../../assets/js/jquery-3.4.1.min.js"></script>
<script src="../../assets/js/popper.min.js"></script>
<script src="../../assets/js/bootstrap.js"></script>

</body>
</html>

