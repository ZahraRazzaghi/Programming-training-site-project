<?php
ini_set('display_errors', '0');//Don't show php errors
require_once '../includs/init.php';
require_once '../engin/db.php';
if(!isset($_SESSION['AdminLogin'])){
    header('Location: AdminLogin.php');
}
//Delete post
if (isset($_GET['deletePost'])) {
    $id = mysqli_real_escape_string($con, $_GET['deletePost']);
    $sql = "SELECT * FROM posts_tbl WHERE Post_ID='$id'";
    $run = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($run);
    $Post_Img = $row['Post_Img'];

    $sql = "DELETE FROM posts_tbl WHERE Post_ID='$id'";
    $run = mysqli_query($con,$sql)or die('error to delete post');
    if($run){
        $msg2='<p class="alert alert-success">نوشته موردنظر با موفقیت حذف شد.</p>';
        unlink($Post_Img);//delete post image from directory
    }else{
        $msg2='<p class="alert alert-success">حذف نوشته با شکست مواجه شد.</p>';
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

    <!--Start Show All Categories Posts-->
    <?php if(isset($msg2))echo $msg2 ?>
    <div class="showAllPosts">
        <table>
            <thead>
            <tr>
                <th>شناسه</th>
                <th>نام دسته بندی</th>
                <th>عنوان</th>
                <th>نام نویسنده</th>
                <th>تاریخ ایجاد</th>
                <th>تصویر</th>
                <th>برجسب ها</th>
                <th>عملیات</th>
            </tr>
            </thead>

            <tbody>

            <?php
            $msg2='';

            $sql = "SELECT * FROM posts_tbl ORDER BY Cat_ID";
            $run = mysqli_query($con, $sql);
            $rows = mysqli_num_rows($run);
            if ($rows>0) {
                $ID = 0;
                while ($row = mysqli_fetch_array($run)) {
                    $ID+=1;
                    //select category name
                    $Post_ID = $row['Post_ID'];
                    $Cat_ID = $row['Cat_ID'];
                    $Post_Title = $row['Post_Title'];
                    $Post_Author = $row['Post_Author'];
                    $Post_Create_At = $row['Post_Create_At'];
                    $Post_Img = $row['Post_Img'];
                    $Post_body= $row['Post_body'];
                    $Post_Tags= $row['Post_Tags'];

                    $sql= "SELECT * FROM categories_tbl WHERE Cat_ID='$Cat_ID'";
                    $run2 = mysqli_query($con, $sql) or die('error inn');
                    $row = mysqli_fetch_array($run2);
                    $Cat_Title=$row['Cat_Title'];

                    echo '<tr>
           <td>'.$ID.'</td>
           <td>'.$Cat_Title.'</td>
           <td>'.$Post_Title.'</td>
           <td>'.$Post_Author.'</td>
           <td>'.$Post_Create_At.'</td>
           <td><img src="'.$Post_Img.'" width="100px"></td>
           <td>'.$Post_Tags.'</td>
           <td>
               <form action="" method="GET">
                  <a href="EditPost.php?editPost='.$Post_ID.'"><i><img src="images/AdminPics/edit.png"></i></a>
                  <a href="?deletePost='.$Post_ID.'"><i><img src="images/AdminPics/delete.png"></i></a>
               </form>
           </td></tr>';

                }
            }else echo '<p class="alert alert-info">نوشته ای وجود ندارد</p>';
            ?>

            </tbody>
        </table>
    </div>
    <!--End Show All Categories -->
</div>
    <script src="../../assets/js/jquery-3.4.1.min.js"></script>
    <script src="../../assets/js/popper.min.js"></script>
    <script src="../../assets/js/bootstrap.js"></script>

</body>
</html>

