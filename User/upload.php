<?php
ini_set('display_errors', '0');//Don't show php errors
require_once '../engin/db.php';
if(!isset($_SESSION['loggedin'])){
    header('Location: ../SignIn.php');
}
$UserEmail=$_SESSION['loggedin'];
$target_dir = 'UserProfileImages/';// save pics on this directory with session name



$target_file   = $target_dir . basename( $_FILES["ProfilePic"]["name"] );
$uploadOk      = 1;
$imageFileType = strtolower( pathinfo( $target_file, PATHINFO_EXTENSION ) );


// Check if image file is a actual image or fake image
if ( isset( $_POST["UploadPic"] ) ) {
    $check = getimagesize( $_FILES["ProfilePic"]["tmp_name"] );
    if ( $check !== false ) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check file size 500KB
if ( $_FILES["ProfilePic"]["size"] > 500000 ) {
    $msg = "Sorry, your file is too large.";
    $uploadOk = 0;//cancel upload operation
}

// Allow certain file formats

if ( $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}


// Check if $uploadOk is set to 0 by an error

if ( $uploadOk == 0 ) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
} else {
    $newfilename = uniqid(md5(time())) . '.' . end(explode(".",$_FILES["ProfilePic"]["name"]));
    $targetFilePath = $target_dir . $newfilename;
    $move =  move_uploaded_file( $_FILES["ProfilePic"]["tmp_name"],$targetFilePath);
    if ($move) {
        echo "The file " . basename( $_FILES["ProfilePic"]["name"] ) . " has been uploaded.";
        $query = "update users_tbl set Usr_ProfilePicDir='$targetFilePath' where Usr_UserName='$UserEmail'";
        if(mysqli_query($db,$query)){

            $msg = "<div class='alert alert-success'> عکس پروفایل شما با موفقیت بروزرسانی شد.</div>";
        }else{
            $msg = "<div class='alert alert-danger'>  بروزرسانی عکس پروفایل شما با مشکل مواجه شد.</div>";
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
$db->close();
header('Location: UserProfileSetting.php');

?>

