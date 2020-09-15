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
    <title>پروفایل :<?php echo $_SESSION['AdminLogin']; ?>  </title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="X-UA-Compatible" content="ie=edge">

    <link href="../../assets/css/bootstrap.css" rel="stylesheet" />
    <link href="../../assets/css/style-top-menu.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />

    <link href="../Articles/css/style.css" rel="stylesheet" />
    <link href="css/trumbowyg.min.css" rel="stylesheet" />

    <!-- Initialize Quill editor -->


</head>
<body>
<?php require_once 'sidebar.php'?>
<div class="content">
    <p style="color: #6009f0;padding-top: 3px"><b><img src="images/AdminPics/plus.png" style="margin-left: 3px;width:18px;">افزودن مطلب جدید</b></p>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="text" class="text-box" name="postTitle" style="width: 50%;" placeholder="عنوان مطلب" required>
            <select name="postCategoryId" required title="دسته بندی">
                <option value="" disabled selected>دسته بندی</option>
                <?php
                //Show categories in drop down menu
                $sql = "SELECT * FROM categories_tbl";
                $run = mysqli_query($db, $sql);
                while($row = mysqli_fetch_array($run)) {
                    $Cat_ID = $row['Cat_ID'];
                    $Cat_Title = $row['Cat_Title'];
                    echo '<option value="'.$Cat_ID.'">'.$Cat_Title.'</option>';
                }
                ?>
            </select><br>
            <input type="text" class="text-box" name="postAuthor" style="width: 50%;" placeholder="نویسنده مطلب" required><br>
            <div class="select-pic">
                    <label for="postImg">انتخاب تصویر برای نوشته جدید</label>
                    <input type="file" name="postImg" class="text-box" title="عکس را به اینجا بکشید"><br>
            </div>
             <textarea id="trumbowyg-demo" id="editor" placeholder="مطلب" name="postBody" type="text-box" style="width: 95%;border:1px solid #7b79ff; min-height: 300px;height: 300px;padding: .5rem"></textarea>
            <input type="text" class="text-box" name="postTags" placeholder="برچسب ها" style="width: 98%" required><br>

            <br>
            <input type="submit" class="btn btn-success" name="insertPost" value="درج مطلب">
            <input type="reset" class="btn btn-secondary" value="انصراف">
        </form>
    <?php
    $msg ='';
    //inser into post table
    if(isset($_POST['insertPost'])) {
        $postTitle = $_POST['postTitle'];
        $postAuthor = $_POST['postAuthor'];

            //Start upload img--------------------------------------------
            require_once 'PostPicUpload.php';
            //End Upload Img--------------------------------------------

        $postBody = $_POST['postBody'];
        $postTags = $_POST['postTags'];
        $postCategoryId = $_POST['postCategoryId'];

        $sql = "INSERT INTO posts_tbl(Cat_ID,Post_Title,Post_Author,Post_Create_At,Post_Img,Post_body,Post_Tags)VALUES('$postCategoryId','$postTitle','$postAuthor',now(),'$targetFilePath','$postBody','$postTags')";
        $run = mysqli_query($db, $sql) or die('error');
        if ($run) {
            $msg = "<p class='alert alert-success'>نوشته جدید با موفقیت اضافه شد</p>";
        } else {
            $msg = "<p class='alert alert-danger'>اضافه کردن نوشته جدید با شکست مواجه شد.</p>";
        }
    }

    ?>
        <?php echo $msg; ?>

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

