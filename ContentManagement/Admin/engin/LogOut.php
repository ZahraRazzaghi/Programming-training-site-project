<?php
session_start();
if(isset($_SESSION['AdminLogin'])){
    unset($_SESSION['AdminLogin']);//unset vars
    session_destroy(); //delete session information from sever
    header('Location: ../AdminLogin.php');
}else{
    echo 'خطا در خروج از سیستم';
}
?>


