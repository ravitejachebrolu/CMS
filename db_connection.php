<?php 
//create database connection
define("DB_SERVER", "localhost");
define("DB_USER","spykeps_cms");
define("DB_PASS", "myaimmydream2");
define("DB_NAME", "spykeps");
$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);

// test the connection
if(mysqli_connect_errno()){
	die("database connnection failed:".mysqli_connect_error().
		"(".mysqli_connect_errno().")"
		);
}
?>
