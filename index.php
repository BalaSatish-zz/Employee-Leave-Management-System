<?php
include"header.php";
session_start();
?>

<?php
echo"<!doctype html>
		<head>
		<title>Employee Leave Management System</title>
		</head>
		<body>
		<ul>
		";

if(isset($_SESSION['empid']) && isset($_SESSION['admin']))
{
	echo"<li><b>Hello <b>".$_SESSION['name']."</li>";
	if($_SESSION['admin']=='N')
	{
		echo"<li><a href='User.php'>User Panel</a></li>";
	}
	else if($_SESSION['admin']=='Y')
	{
		echo"<li><a href='Admin.php'>Admin Panel</a></li>";
	}
	echo"<li><a href='Logout.php'>Logout</a></li>";
}
else{
	echo"<li><a href='SignUp.php'>Sign Up</a></li>";
	echo"<li><a href='Login.php'>Log in</a></li>";
}
echo "</ul>
		</body>
		</html>
		";

	
?>

