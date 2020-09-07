<?php
/* connect to db */
session_start();//very important
//تنظیم منطقه زمانی
date_default_timezone_set('Asia/Tehran');

// Create connection
$db=mysqli_connect('localhost','root','','l3rn_d8_l3ensit3_pr0ject') or die(mysql_error());

// Check connection
if (mysqli_connect_errno($db))
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
//change character set to utf8
mysqli_set_charset($db, "utf8");

/***
// Create database

$sql=" CREATE DATABASE mydb DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;";
if (mysqli_query($con,$sql))
{
    echo "دیتابیس با موفقیت ساخته شد";
}
else
{
    echo "خطای در هنگام ساخت پایگاه داده: " . mysqli_error($con);
}
//Create table on db
// Create table
$sql="CREATE TABLE Users(ID INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(ID),email VARCHAR(50),password VARCHAR(50),Age INT)";
// Execute query
if (mysqli_query($con,$sql))
{
    echo "جدول کاربران با موفقیت ساخته شد";
}
else

{
    echo "خطا در ساخت جدول کاربران: " . mysqli_error($con);
}**/
?>
