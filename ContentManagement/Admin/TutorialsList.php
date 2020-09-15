<?php
ini_set('display_errors', '0');//Don't show php errors
require_once '../engin/db.php';
if(!isset($_SESSION['AdminLogin'])){
    header('Location: AdminLogin.php');
}
//Delete Tutorial
if (isset($_GET['deleteToto'])) {
    $id = mysqli_real_escape_string($db, $_GET['deleteToto']);
    $sql = "SELECT * FROM toturials_tbl WHERE tuTo_ID='$id'";
    $run = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($run);
    $Post_Img = $row['tuTo_PicDir'];

    $sql = "DELETE FROM toturials_tbl WHERE tuTo_ID='$id'";
    $run = mysqli_query($db,$sql)or die('error to delete tutorial');
    if($run){
        $msg2='<p class="alert alert-success">آموزش موردنظر با موفقیت حذف شد.</p>';
        unlink($Post_Img);//delete post image from directory
    }else{
        $msg2='<p class="alert alert-success">حذف آموزش با شکست مواجه شد.</p>';
    }
}

?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <title> آموزش ها  </title>
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
    <p style="color: #6009f0"><b><img src="images/AdminPics/eye-64.png" style="margin-left: 3px;width:18px;">لیست آموزش ها</b></p><br>

    <!--Start Show All Categories Posts-->
    <?php if(isset($msg2))echo $msg2 ?>

    <div class="showAllPosts">
        <table>
            <thead>
            <tr>
                <th>شناسه</th>
                <th>نام آموزش</th>
                <th>تعداد یادگیرنده ها</th>
                <th>عکس</th>
                <th>عملیات</th>
            </tr>
            </thead>
<h5></h5>
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
            $sql = "SELECT * FROM toturials_tbl";
            $run = mysqli_query($db, $sql);
            $count = mysqli_num_rows($run);
            $count = ceil($count/3);
            $sql = "SELECT * FROM toturials_tbl limit {$offset},6 ";
            $run = mysqli_query($db, $sql);
            $rows = mysqli_num_rows($run);
            if ($rows > 0) {
                $ID = 0;
                while ($row = mysqli_fetch_array($run)) {
                    $ID+=1;
                    $tuTo_ID = $row['tuTo_ID'];
                    $tuTo_Name = $row['tuTo_Name'];
                    $tuTo_NumberOfLearners = $row['tuTo_NumberOfLearners'];
                    $tuTo_PicDir = $row['tuTo_PicDir'];

                    echo '<tr>
           <td>'.$ID.'</td>
           <td>'.$tuTo_Name.'</td>
           <td>'.$tuTo_NumberOfLearners.'</td>
   
           <td><img src="'.$tuTo_PicDir.'" width="100px"></td>
           <td>
                  <a href="EditTutorialsList.php?editTuto='.$tuTo_ID.'"><i><img src="images/AdminPics/edit.png"></i></a>
                  <a href="?deleteToto='.$tuTo_ID.'"><i><img src="images/AdminPics/delete.png"></i></a>
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
                echo '<li class="page-item active"><a class="page-link" href="Toturials.php?page='.$i.'">'.$i.'</a> </li>';

            }else{
                echo '<li class="page-item "><a class="page-link" href="Toturials.php?page='.$i.'">'.$i.'</a> </li>';
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

