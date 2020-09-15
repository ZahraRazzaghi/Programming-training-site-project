<?php
$file = $_FILES["tutoPic"]["name"];//file
$tmp_name = $_FILES["tutoPic"]["tmp_name"];//Curent dir
$directory = 'images/TotuPics/';// save pics on this directory with session name
$target_file = $directory . basename($file);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


// Check if image file is a actual image or fake image
$check = getimagesize($tmp_name);
if ( $check !== false ) {
    $uploadOk = 1;
} else {
    $uploadOk = 0;
}

// Check file size 500KB
if ( $_FILES["tutoPic"]["size"] > 2000000 ) {
    echo "<p class='alert alert-warning'>متاسفیم، عکس شما نیاید بیشتر 1 مگابایت حجم داشته باشد.</p>";
    $uploadOk = 0;//cancel upload operation
}


if ($uploadOk == 0) {
    echo "<p class='alert alert-info'>تصویری آپلود نشد.</p>";
    // if everything is ok, try to upload file
} elseif ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif"
) {
    echo "<p class='alert alert-warning'>متاسفیم، فقط فایل های JPG, JPEG, PNG و GIFاجازه آپلود دارند.</p>";
    $uploadOk = 0;
} else {
    $extension = explode(".", $file);
    $newPostImgName = uniqid(md5(time())) . '.' . end($extension);
    $targetFilePath = $directory . $newPostImgName;
    $move = move_uploaded_file($tmp_name, $targetFilePath);


}
?>