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
    <title>پاسخ به نظر  </title>
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
    <br>
    <br>
    <br>

    <!--Start Reply Form -->
    <p style="color: #6009f0;padding-top: 3px"><b><img src="images/AdminPics/edit-64.png" style="margin-left: 3px;width:18px;">ویرایش پاسخ</b></p>
    <?php
    if(isset($_GET['EditCommentReply'])){
        $id = mysqli_real_escape_string($db, $_GET['EditCommentReply']);
        $sql = "SELECT * FROM comments_tbl WHERE Comment_Id='$id'";
        $run = mysqli_query($db, $sql);
        $rows = mysqli_num_rows($run);
        if ($rows>0) {
            $row = mysqli_fetch_array($run);
            $Comment_Id = $row['Comment_Id'];
            $Comment_Author = $row['Comment_Author'];
            $Comment_Email = $row['Comment_Email'];
            $Comment_Body = $row['Comment_Body'];
            $Post_ID = $row['Post_ID'];
            //select post title from posts_tbl
            $sql= "SELECT * FROM posts_tbl WHERE Post_ID='$Post_ID'";
            $run = mysqli_query($db, $sql);
            $row = mysqli_fetch_array($run);
            $Post_Title=$row['Post_Title'];

        }

        echo '<form action="" method="POST">
        <input type="text" class="textBox" name="comment_id" value="'.$Post_Title.'" disabled>
        <input value="'.$Comment_Author.'" type="text" class="textBox" disabled>
        <input value="'.$Comment_Email.'" type="text" class="textBox" disabled>
        <textarea id="trumbowyg-demo" class="textBox" name="contentReply">'.$Comment_Body.'</textarea><br>
        <input type="submit" class="btn btn-success" name="sendReply" value="ارسال پاسخ">
        <input type="reset" class="btn btn-secondary" value="انصراف">
    </form>';
    }
    if(isset($_POST['sendReply'])){
        $contentReply = $_POST['contentReply'];
        $query = "UPDATE comments_tbl SET Comment_Body='$contentReply' WHERE Comment_Id='$Comment_Id'";
        $run = mysqli_query($db,$query);
        if ($run) {
            echo "<p class='alert alert-success'>پاسخ ویرایش شد.</p>";
            header("refresh:0.1,url=Comments.php");
        } else {
            echo "<p class='alert alert-danger'>ویرایش پاسخ با شکست مواجه شد.</p>";
        }
    }
    ?>

    <!--End Start Reply Form -->


</div>
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

