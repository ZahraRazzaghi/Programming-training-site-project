<?php
ini_set('display_errors', '0');//Don't show php errors
require_once '../includs/init.php';
require_once '../engin/db.php';
if(!isset($_SESSION['AdminLogin'])){
    header('Location: AdminLogin.php');
}
?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <title>ویرایش مطلب </title>
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
    <p style="color: #6009f0;padding-top: 3px"><b><img src="images/AdminPics/edit-64.png" style="margin-left: 3px;width:18px;">ویرایش مطلب</b></p>
    <?php
    $msg ='';
    //select upon resiving data
    if (isset($_GET['editPost'])) {
        $id = mysqli_real_escape_string($db, $_GET['editPost']);
        $sql = "SELECT * FROM posts_tbl WHERE Post_ID='$id'";
        $run = mysqli_query($db, $sql);
        if (mysqli_num_rows($run) > 0) {
            $row = mysqli_fetch_array($run);
            $Post_ID = $row['Post_ID'];
            $Cat_ID = $row['Cat_ID'];
            $Post_Title = $row['Post_Title'];
            $Post_Author = $row['Post_Author'];
            $Post_Create_At = $row['Post_Create_At'];
            $Post_Img = $row['Post_Img'];
            $Post_body = $row['Post_body'];
            $Post_Tags = $row['Post_Tags'];
        }


            //update posts information
            if (isset($_POST['EditPostBtn'])) {
                $postTitle =$_POST['postTitle'];
                $postCategoryId =$_POST['postCategoryId'];
                $postAuthor =$_POST['postAuthor'];
                //Start upload img------------------------------------------
                require_once 'PostPicUpload.php';
                if($move){//اگه عکس جدیدی آپلود شد
                    unlink($Post_Img);//فایل قبلی رو از دایرکتوری پاک کن
                }else{//در غیر اینصورت
                    $targetFilePath=$Post_Img;//همون فایل قبلی رو بزار باشه
                }
                //End Upload Img--------------------------------------------
                $postBody =$_POST['postBody'];
                $postTags =$_POST['postTags'];
                $sql = "UPDATE posts_tbl SET  Cat_ID='$postCategoryId',Post_Title='$postTitle',Post_Author='$postAuthor',Post_Img='$targetFilePath',Post_body='$postBody',Post_Tags='$postTags' WHERE Post_ID='$id'";
                $run = mysqli_query($db, $sql);
                if ($run) {
                    $msg = "<p class='alert alert-success'>نوشته با موفقیت ویرایش شد</p>";
                    header("refresh:0.1,url=Posts.php");
                } else {
                    $msg = "<p class='alert alert-danger'>ویرایش نوشته با شکست مواجه شد.</p>";
                }

            }
    }
    ?>


    <form action="" method="POST" enctype="multipart/form-data">
        <input value="<?php echo $Post_Title;?>" type="text" class="text-box" name="postTitle" style="width: 50%;" placeholder="عنوان مطلب" required>
        <select name="postCategoryId" required title="دسته بندی">
            <?php
            //Show categories in drop down menu
            $sql = "SELECT * FROM categories_tbl";
            $run = mysqli_query($db, $sql);
            while($row = mysqli_fetch_array($run)) {
                $Cat_Title = $row['Cat_Title'];
                if($Cat_ID == $row['Cat_ID']){//selected category
                    echo '<option value="'.$Cat_ID.'" selected>'.$Cat_Title.'</option>';

                }else echo '<option value="'.$Cat_ID.'">'.$Cat_Title.'</option>';//etc categories
            }
            ?>
        </select><br>
        <input value="<?php echo $Post_Author;?>" type="text" class="text-box" name="postAuthor" style="width: 50%;" placeholder="نویسنده مطلب" required><br>
        <div class="select-pic">

            <label for="postImg">انتخاب تصویر جدید برای نوشته</label>
            <input type="file" name="postImg" class="text-box" title="عکس را به اینجا بکشید"><br>
            <img src="<?php echo $Post_Img;?>" width="300px" >
        </div>
        <textarea placeholder="مطلب" name="postBody" type="text-box" style="width: 100%;border:1px solid #7b79ff; min-height: 300px;height: 300px;padding: .5rem"><?php echo $Post_body;?></textarea>
        <input value="<?php echo $Post_Tags;?>" type="text" class="text-box" name="postTags" placeholder="برچسب ها" style="width: 98%" required><br>

        <br>
        <input type="submit" class="btn btn-success" name="EditPostBtn" value="ویرایش مطلب">
        <input type="reset" class="btn btn-secondary" value="انصراف">
    </form>






    <script src="../../assets/js/jquery-3.4.1.min.js"></script>
    <script src="../../assets/js/popper.min.js"></script>
    <script src="../../assets/js/bootstrap.js"></script>

</body>
</html>

