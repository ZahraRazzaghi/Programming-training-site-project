<?php
ini_set('display_errors', '0');//Don't show php errors
require_once '../engin/db.php';
if(!isset($_SESSION['AdminLogin'])){
    header('Location: AdminLogin.php');
}
//Delete Category
if (isset($_GET['deleteComment'])) {
    $id = mysqli_real_escape_string($db, $_GET['deleteComment']);
    $sql = "DELETE FROM comments_tbl WHERE Comment_Id ='$id'";
    $run = mysqli_query($db,$sql);
    if($run){
        $msg2='<p class="alert alert-success">نظر موردنظر با موفقیت حذف شد.</p>';
    }else{
        $msg2='<p class="alert alert-success">حذف نظر با شکست مواجه شد.</p>';
    }
}
//confirm or reject comment
$ok =1;
$no =0;
//if confirm
if(isset($_GET['ConfirmComment'])){
    $id = mysqli_real_escape_string($db, $_GET['ConfirmComment']);
    mysqli_query($db,"UPDATE comments_tbl SET Comment_Status='$ok' WHERE Comment_Id ='$id'");

}
//if reject
if(isset($_GET['RejectComment'])){
    $id = mysqli_real_escape_string($db, $_GET['RejectComment']);
    mysqli_query($db,"UPDATE comments_tbl SET Comment_Status='$no' WHERE Comment_Id ='$id'");
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
    <p style="color: #6009f0"><b><img src="images/AdminPics/eye-64.png" style="margin-left: 3px;width:18px;"> لیست نظرات</b></p>

        <?php echo $msg; ?>

    <!--Start Show All Comments -->
    <div class="showAllCategories">

        <table>
            <thead>
            <tr>
                <th>شناسه</th>
                <th>برای پست</th>
                <th>نام نویسنده</th>
                <th>ایمیل نویسنده</th>
                <th>متن نظر</th>
                <th>تاریخ ارسال</th>
                <th>وضعیت</th>
                <th>پاسخ</th>
                <th>عملیات</th>
            </tr>
            </thead>

            <tbody>

            <?php
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

            //select every thing from comments_tbl
            $sql = "SELECT * FROM comments_tbl limit {$offset},6";
            $run = mysqli_query($db, $sql);
            $rows = mysqli_num_rows($run);
            if ($rows>0) {
                //set id for show id
                $ID = 0;
                while ($row = mysqli_fetch_array($run)) {
                    $ID+=1;
                    $Post_ID = $row['Post_ID'];
                    $Comment_Id = $row['Comment_Id'];
                    $Comment_Author = $row['Comment_Author'];
                    $Comment_Body = $row['Comment_Body'];
                    $SumComment_Body = mb_substr($Comment_Body,0,50,'utf-8');
                    $Comment_Status = $row['Comment_Status'];
                    $Comment_Email = $row['Comment_Email'];
                    $Comment_Create_At = $row['Comment_Create_At'];
                    $Comment_Reply = $row['Comment_Reply'];
                    //select post title from posts_tbl
                    $sql= "SELECT * FROM posts_tbl WHERE Post_ID='$Post_ID'";
                    $run2 = mysqli_query($db, $sql) or die('error inn');
                    $row = mysqli_fetch_array($run2);
                    $Post_Title=$row['Post_Title'];


                    //check email status
                    if($Comment_Status==0){
                        $status = '<a href="Comments.php?ConfirmComment='.$Comment_Id.'" class="btn btn-success" >تایید نظر</a>';
                    }else{
                        $status = '<a href="Comments.php?RejectComment='.$Comment_Id.'" class="btn btn-danger">رد نظر</a>';
                    }

                    //check for reply
                    if($Comment_Reply==0){
                        $replySecB1 ='<a href="CommentReply.php?replyComment='.$Comment_Id.'"><i><img src="images/AdminPics/reply.png"></i></a>';
                    }else{
                        $replySecB1 ='<a class="text-success badge">این یک پاسخ است</a>';
                        $replySecB2 ='<a href="EditComments.php?EditCommentReply='.$Comment_Id.'" ><i><img src="images/AdminPics/edit.png"></i></a>';
                    }

                    echo '<tr>
           <td>'.$ID.'</td>
           <td>'.$Post_Title.'</td>
           <td>'.$Comment_Author.'</td>
           <td>'.$Comment_Email.'</td>
           <td>'.$SumComment_Body.'</td>
           <td>'.$Comment_Create_At.'</td>
           <td>'.$status.'</td>
           <td>'.$replySecB1.''.$replySecB2.'</td>
           <td>
                  <a href="Comments.php?deleteComment='.$Comment_Id.'"><i><img src="images/AdminPics/delete.png"></i></a>
                  <!-- if i want edit all commets 
                  <a href="EditComments.php?EditCommentReply='.$Comment_Id.'" ><i><img src="images/AdminPics/edit.png"></i></a>
                  -->
           </td></tr>';

                }
            }else echo '<p class="alert alert-info">نظری وجود ندارد</p>';

            ?>

            </tbody>
        </table>
    </div>
    <!--End Show All Comments -->

    <ul class="pagination" >
        <li class="page-item disabled"><a class="page-link" href="#">قبلی</a> </li>
        <?php
        for($i=1;$i<=$count;$i++){
            if($i==$_GET['page']){
                echo '<li class="page-item active"><a class="page-link" href="Comments.php?page='.$i.'">'.$i.'</a> </li>';

            }else{
                echo '<li class="page-item "><a class="page-link" href="Comments.php?page='.$i.'">'.$i.'</a> </li>';
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

