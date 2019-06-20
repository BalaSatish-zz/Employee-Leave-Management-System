<?php
include 'header.php';
include 'includes/IncDBDetails.php';
session_start();
if(isset($_SESSION['admin']) || isset($_SESSION['empid']))
{
	unset($_SESSION['admin']);
	unset($_SESSION['empid']);
	session_destroy();
	echo "Logged Out Successfully...!";
	header('Location:index.php');
}
else{
	echo "Session Expired.";
}
?>