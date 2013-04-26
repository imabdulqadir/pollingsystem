<?php
$con=mysqli_connect('localhost','root','');
if(mysqli_connect_error($con))
{
	echo "Failed to connect to Mysql:".mysqli_connect_error();
}
$sql="create database qadirdb";
if(mysqli_query($con,$sql))
{
	//echo "Database created sucessfully";
}

?>
