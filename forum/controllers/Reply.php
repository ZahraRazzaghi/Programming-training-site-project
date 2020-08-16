<?php
require_once 'db.php';
session_start();
$comment=n12br(addslashes($_POST['comment']));
$cid=$_GET['cid'];
$scid=$_Get['scid'];
$tid=$_GET['tid'];
$insert=mysqli_query($db,"INSERT INTO frm_replies_tbl(Cat_Id,Sub_Cat_Id,Topic_Id,Author,Comment,Date_Posted)
VALUES ('".$cid."','".$scid."','".$tid."','".$_SESSION['usernamme']."',),'".$comment."',NOW());");

if($insert){
    header("Location: readtopic.php?cid=".$cid."$cid=".$scid="$tid=".$tid."");
}

?>