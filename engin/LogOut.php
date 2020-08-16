<?php
session_start();
//session_destroy();
unset($_SESSION['loggedin']);
if(isset($_SESSION['loggedin'])){
    echo 'yes';
}else{
    header('Location: ../index.php');
}
?>


