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
<body>
<?php require_once 'sidebar.php'?>

<div class="content">
    <p style="color: #6009f0"><b><img src="images/AdminPics/eye-64.png" style="margin-left: 3px;width:18px;">لیست مطالب</b> </p>

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
        //نمایش  نوشته ها
        global $count;
            if(!isset($_GET['page'])){
                $offset = $_GET['page']=0;
            }else{
                $offset = ($_GET['page']-1)*6;
            }
        $sql = "SELECT * FROM posts_tbl";
        $run = mysqli_query($db, $sql);
        $count = mysqli_num_rows($run);
        $count = ceil($count/3);
//3-1=2*6=12
//4-1=3*6=18
//5-1=4*6=24
//6-1=5*6=30
        $sql = "SELECT * FROM posts_tbl ORDER BY Post_Create_At DESC limit {$offset},6 ";
            $run = mysqli_query($db, $sql);
            $rows = mysqli_num_rows($run);
            if ($rows > 0) {
                $ID = 0;
            while ($row = mysqli_fetch_array($run)) {
                $ID+=1;

                $Post_ID = $row['Post_ID'];
                $Cat_ID = $row['Cat_ID'];
                $Post_Title = $row['Post_Title'];
                $Post_Author = $row['Post_Author'];
                $Post_Create_At = $row['Post_Create_At'];
                $Post_Img = $row['Post_Img'];
                $Post_body = $row['Post_body'];
                $SummeryPost_body = mb_substr($Post_body,0,100,'utf-8');
                $Post_Tags= $row['Post_Tags'];


                $sql= "SELECT * FROM categories_tbl WHERE Cat_ID='$Cat_ID'";
                $run2 = mysqli_query($db, $sql) or die('error inn');
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
                  <a href="EditPost.php?editPost='.$Post_ID.'"><i><img src="images/AdminPics/edit.png"></i></a>
                  <a href="?deletePost='.$Post_ID.'"><i><img src="images/AdminPics/delete.png"></i></a>
           </td></tr>';

            }



            } else echo '<p class="alert alert-info">نوشته ای وجود ندارد</p>';
            ?>

            </tbody>
        </table>
    </div>
    <!--End Show All Categories -->
    <ul class="pagination" >
        <li class="page-item disabled"><a class="page-link" href="#">قبلی</a> </li>
        <?php
        for($i=1;$i<=$count;$i++){
            if($i==$_GET['page']){
                echo '<li class="page-item active"><a class="page-link" href="Posts.php?page='.$i.'">'.$i.'</a> </li>';

            }else{
                echo '<li class="page-item "><a class="page-link" href="Posts.php?page='.$i.'">'.$i.'</a> </li>';
            }
        }
        ?>
        <li class="page-item"><a class="page-link" href="#">بعدی</a> </li>
    </ul>
</div>
    <script src="../../assets/js/jquery-3.4.1.min.js"></script>
    <script src="../../assets/js/popper.min.js"></script>
    <script src="../../assets/js/bootstrap.js"></script>

</body>
</html>

