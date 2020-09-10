<?php
try{
    $con=mysqli_connect('localhost','root','','content_management') or die(mysql_error());
    mysqli_set_charset($con, "utf8");

}catch(PDOException $error){
    echo 'Error' . $error->getMessage();
}
?>