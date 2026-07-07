<?php
$dbhost='localhost';
$username='root';
$password='Afrin@123';
$db='theitupdates';
$con = mysqli_connect("$dbhost","$username","$password","$db");
if(!$con){
	echo" database not connected";
}
?>
