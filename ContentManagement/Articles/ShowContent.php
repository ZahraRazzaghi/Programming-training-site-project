<?php require_once '../engin/db.php';
if(isset($_GET['AddLike'])) {//اگر کاربر پست را لایک کرد
    $id2 = mysqli_real_escape_string($db, $_GET['AddLike']);


    $sql = "SELECT * FROM posts_tbl WHERE Post_ID='$id2'";
    $run = mysqli_query($db, $sql);
    $rows = mysqli_num_rows($run);
    if ($rows > 0) {
        $row = mysqli_fetch_array($run);
        $post_Likes = $row['post_Likes'];
        $post_Likes += 1;//یک واحد به مقدار لایک پست اضافه کن
        $sql = "UPDATE posts_tbl SET post_Likes='$post_Likes' WHERE Post_ID='$id2'";
        $run = mysqli_query($db, $sql);

    }
}
if(isset($_GET['SubLike'])) {//اگر کاربر پست را لایک کرد
    $id2 = mysqli_real_escape_string($db, $_GET['SubLike']);
    @$pfw_ip= $_SERVER['REMOTE_ADDR'];//متغیر دریافت آی پی مخاطب
    unset($_SESSION['AdminLogin']);//unset vars

    $sql = "SELECT * FROM posts_tbl WHERE Post_ID='$id2'";
    $run = mysqli_query($db, $sql);
    $rows = mysqli_num_rows($run);
    if ($rows > 0) {
        $row = mysqli_fetch_array($run);
        $post_Likes = $row['post_Likes'];
        $post_Likes -= 1;//یک واحد از مقدار لایک پست کم کن
        $sql = "UPDATE posts_tbl SET post_Likes='$post_Likes' WHERE Post_ID='$id2'";
        $run = mysqli_query($db, $sql);
    }
}
?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="X-UA-Compatible" content="ie=edge">
    <title>fastscroll-learn programing fast</title>
    <!---style & script files--->
    <link href="../../assets/css/bootstrap.css" type="text/css" rel="stylesheet">
    <link href="../../assets/css/style-top-menu.css" type="text/css" rel="stylesheet">
    <link href="../../assets/css/style-index.css" type="text/css" rel="stylesheet">
    <link href="css/style.css" type="text/css" rel="stylesheet">
</head>
<body>
<!--Start Header Section -->
<div id="cabecalho">
    <a href="#" id="logo" style="padding-top: 5px;"><img src="../../assets/images/logo.png" style="width: 2.2rem;"><i>fastscroll</i></a>
    <nav dir="rtl">
        <a href="#" id="menu-icon" style="padding-top: 5px;"><img src="../../assets/images/menu-icon.png" style="width: 2.3rem;"> </a>
        <ul>
            <?php
            $sql = "SELECT * FROM categories_tbl";
            $run = mysqli_query($db, $sql);
            while($row = mysqli_fetch_array($run)) {
                $Cat_ID = $row['Cat_ID'];
                $Cat_Title = $row['Cat_Title'];
                echo '<li><a href="category.php?CatID='.$Cat_ID.' class="btn" style="transition: 119ms;">'.$Cat_Title.'</a></li>';
            }
            ?>
            <li><a href="../Admin/AdminLogin.php">ورود مدیر</a> </li>
        </ul>
    </nav>
</div>
<!--End Header Section -->
<br><br><br><br>
<!--Start Show select content section -->
<div class="container ContentBody">
    <div class="postContent container">

    <?php
    //نمایش نوشته های مربوط به دسته انتخاب شده
    if (isset($_GET['content'])) {
        $id = mysqli_real_escape_string($db, $_GET['content']);
        $sql = "SELECT * FROM posts_tbl WHERE Post_ID='$id'";
        $run = mysqli_query($db, $sql);
        $rows = mysqli_num_rows($run);
        if ($rows > 0) {
            while ($row = mysqli_fetch_array($run)) {
                $Post_ID = $row['Post_ID'];
                $Post_Title = $row['Post_Title'];
                $Post_Author = $row['Post_Author'];
                $Post_Create_At = $row['Post_Create_At'];
                $Post_Img = $row['Post_Img'];
                $Post_body = $row['Post_body'];
                $Post_Img = $row['Post_Img'];
                $Post_Tags = $row['Post_Tags'];
                $post_Likes = $row['post_Likes'];

                echo '
            <!--Post Header -->
            <div class="postContentHeader"  align="center">
                <div class="postContentPic"><img src="../Admin/' . $Post_Img . '"></div><hr class="bg-info" width="100px">
                <h2 class="text-dark">' . $Post_Title . '</h2>
            </div>
            <!--Post Body -->
            <div class="postContentBody">
                <div class="postContentDesc">' . $Post_body . '</div>
                <!--Post Footer -->
                <div class="postContentFooter">
                    <span calss="author"><img src="images/Author.png"> ' . $Post_Author . '</span>
                    <span class="date">تاریخ انتشار:' . $Post_Create_At . '</span><br>
                    <hr>
                  <a class="float-left" href="ShowContent.php?AddLike='.$Post_ID.'"><img src="images/em-heart-50.png" width="30px"><p class="text-center" style="color:#6f20f1;">'.$post_Likes.'</p></a>

                </div>
            </div>';
                //نمایس برچسب ها به صورت جدا جدا
                $tags=explode(',',$Post_Tags);
                echo'<span class="tags">';
                foreach ($tags as $Tag){
                    echo '<a>' . $Tag . '</a>';
                }
                echo '</span>';
            }


            
        }else {$searchMsg= '<div class="alert alert-info" align="center"><img src="../../assets/images/sad.png"><p>متاسفیم نوشته ای وجود ندارد</p></div>';}

    }

    ?>
        <br>
        <br>
        <br>

    </div>
    <!--Start Comment Section-->
    <div class="CommentSend container-fluid">
        <div class="commentHeader">
            <h5>ارسال نظر</h5>
        </div>
        <div class="commentBody" align="center">
            <form method="post">
                <input name="commentAuthor" type="text" class="textBox" placeholder="نام" required><br>
                <input name="commentEmail" type="email" class="textBox" placeholder="ایمیل" required><br>
                <textarea name="commentContent" class="textBox" placeholder="نظر خود را بنویسید"required></textarea><br>
                <input name="commentsend" type="submit" class="btn btn-success" value="ارسال نظر">
                <input type="reset" class="btn btn-danger" value="لغو">
            </form>
        </div>
        <?php
        //selelct post information
        global $id;
        if (isset($_GET['content'])) {
            $id = mysqli_real_escape_string($db, $_GET['content']);
            $sql = "SELECT * FROM posts_tbl WHERE Post_ID='$id'";
            $run = mysqli_query($db, $sql);
            if(mysqli_num_rows($run)>0) {
                $row = mysqli_fetch_array($run);
                $Post_ID = $row['Post_ID'];
            }
        }
        if (isset($_POST['commentsend'])) {
            $commentAuthor = $_POST['commentAuthor'];
            $commentEmail = $_POST['commentEmail'];
            $commentContent = $_POST['commentContent'];

            $query = "INSERT INTO comments_tbl(Post_ID,Comment_Author,Comment_Body,Comment_Email,Comment_Create_At)VALUES('$Post_ID','$commentAuthor','$commentContent','$commentEmail',now())";
            $run = mysqli_query($db, $query);
            if ($run) {
                echo "<p class='alert alert-success'>نظر شما با موفقیت ارسال شد</p>";
            } else {
                echo "<p class='alert alert-danger'>متاسفیم، ارسال نظر شما با شکست مواجه شد</p>";
            }
        }

        ?>
        <div class="comments" align="center">
<?php
global $count;
if(!isset($_GET['page'])){
    $offset = $_GET['page']=0;
}else{
    $offset = ($_GET['page']-1)*5;
}
//show comment
$sql = "SELECT * FROM comments_tbl WHERE Comment_Status=1 AND Post_ID='$id' AND  Comment_Reply=0 limit {$offset},5";//اگر کامنت مربوط به این صفحه باشد و تایید شده باشدو فقط سوال باشه
$run = mysqli_query($db, $sql);
$rows = mysqli_num_rows($run);
if ($rows>0) {
//set id for show id
    $ID = 0;
    while ($row = mysqli_fetch_array($run)) {
        $Post_ID = $row['Post_ID'];
        $Comment_Id = $row['Comment_Id'];
        $Comment_Author = $row['Comment_Author'];
        $Comment_Body = $row['Comment_Body'];
        $Comment_Status = $row['Comment_Status'];
        $Comment_Email = $row['Comment_Email'];
        $Comment_Create_At = $row['Comment_Create_At'];
        $Comment_Reply = $row['Comment_Reply'];
        echo '<div class="commentUser"  align="center" style="margin: .8rem;">
                    <div class="commentInfo">
                        <span class="commentAuthor float-right"> <b class="text-primary">' . $Comment_Author . '</b> گفته:</span>
                        <span class="commentAuthor float-left text-secondary">تاریخ:'.$Comment_Create_At.'</span>
                        <div class="clear"></div>
                    </div>
                    <div class="commentQ float-right">
                        <p class="userReply">'.$Comment_Body.'</p>
                        <div class="clear"></div>
                    </div>
                </div>  <div class="clear"></div>
        ';
    //show admin reply
        $sql = "SELECT * FROM comments_tbl WHERE Comment_Reply='$Comment_Id' ";
        $run2 = mysqli_query($db, $sql);
        $rows = mysqli_num_rows($run2);
        $row = mysqli_fetch_array($run2);
        $Post_ID = $row['Post_ID'];
        $Comment_Id = $row['Comment_Id'];
        $Comment_Author = $row['Comment_Author'];
        $Comment_Body = $row['Comment_Body'];
        $Comment_Status = $row['Comment_Status'];
        $Comment_Email = $row['Comment_Email'];
        $Comment_Create_At = $row['Comment_Create_At'];
        $Comment_Reply = $row['Comment_Reply'];
        if ($rows>0) {
            echo '<div class="commentAnswer" align="center">

                <div class="commentAnswerAdmin">
                    <div class="commentInfo">
                        <span class="commentAuthor float-right"> <b class="text-warning"> ' . $Comment_Author . ' </b>گفته: </span>
                        <span class="commentAuthor float-left text-secondary">تاریخ:'.$Comment_Create_At.'</span>

                        <div class="clear"></div>
                    </div>
                    <div class="commentA float-right">
                        <p class="adminReply">'.$Comment_Body.'</p>
                        <div class="clear"></div>
                    </div>
                </div>
            <div class="clear"></div>
            </div>
      
    ';
        }
}


}else{echo '<div class="container"> <p class="alert alert-info">نظری برای این نوشته وجود ندارد</p></div>';}
?>
    <!--End Comment Section-->
        </div></div>

    <ul class="pagination" >
        <li class="page-item disabled"><a class="page-link" href="#">قبلی</a> </li>
        <?php
        for($i=1;$i<=$count;$i++){
            if($i==$_GET['page']){
                echo '<li class="page-item active"><a class="page-link" href="ShowContent.php?page='.$i.'">'.$i.'</a> </li>';

            }else{
                echo '<li class="page-item "><a class="page-link" href="ShowContent.php?page='.$i.'">'.$i.'</a> </li>';
            }
        }
        ?>
        <li class="page-item"><a class="page-link" href="#">بعدی</a> </li>
    </ul>

</div>
<!--End Show select content section -->
<br>
<br>
<br>
<?php require_once 'footer.php' ?>
<script src="../../assets/js/jquery-3.4.1.min.js"></script>
<script src="../../assets/js/popper.min.js"></script>
<script src="../../assets/js/bootstrap.js"></script>
</body>
</html>