<?php 
ob_start();
session_start();

$timezone = date_default_timezone_set("Europe/London");

$con = mysqli_connect("10.16.16.3", "burnn-98t-u-227952", "4Y!rVnKED", "burnn-98t-u-227952"); // connection variable

if(mysqli_connect_errno())
{
	echo "Failed to connect:" . mysqli_connect_errno();
}



?>