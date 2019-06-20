<?php
include"header.php";
include"includes/IncDBDetails.php";
session_start();
if(isset($_SESSION['empid']) && isset($_SESSION['admin']))
{
	header('Location:index.php');
}
?>

<!doctype html>
<head>
</head>
<body>
	<br>
<br><br><br><br><br>
<nav>
<div>
<form align="center" method="POST" action="includes/IncLogin.php">
<table align="center" cellpadding="5" cellspacing="5" border="3">
<tr><td>Employee-ID</td><td><input type="text" placeholder="Employee-ID" name="email" id="email"></input></td></tr>
<tr><td>Password</td><td><input type="password" placeholder="Password" name="password" id="password"></input></td></tr>
<tr><td colspan="2"><button type="submit" name="submit" id="submit">Submit</button></td></tr>
</table>
</form>
</div>
</nav>
</body>
