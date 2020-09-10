<?php
/* connect to db */
session_start();//very important
// Create connection
$db=mysqli_connect('localhost','root','','l3rn_d8_l3ensit3_pr0ject') or die(mysql_error());

// Check connection
if (mysqli_connect_errno($db))
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
//change character set to utf8
mysqli_set_charset($db, "utf8");
?>
