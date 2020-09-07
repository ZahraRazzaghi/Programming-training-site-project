<?php
session_start();
if(isset($_SESSION['loggedin'])){
    unset($_SESSION['loggedin']);//unset vars
    session_destroy(); //delete session information from sever
    header('Location: ../../index.php');
}else{
    echo 'خطا در خروج از سیستم';
}
?>


