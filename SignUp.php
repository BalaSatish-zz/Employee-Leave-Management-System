<?php
include"header.php";
?>

<!doctype html>
<head>
</head>
<body>
<br>
<br><br><br><br><br>
<nav>
<div>
<form align="center" method="POST" action="includes/IncSignUp.php">
<table border="3" cellpadding="5" cellspacing="5" align="center">
<tr><td>First Name</td><td><input type="text" placeholder="First Name" name="firstname" id="firstname"></input></td></tr>
<tr><td>Last Name</td><td><input type="text" placeholder="Last Name" name="lastname" id="lastname"></input></td></tr>
<tr><td>Email-ID</td><td><input type="text" placeholder="Email-ID" name="email" id="email"></input></td></tr>
<tr><td>Enter Password</td><td><input type="Password" placeholder="Password" name="password1" id="password1"></input></td></tr>
<tr><td>Confirm Password</td><td><input type="Password" placeholder="Password" name="password2" id="password2"></input></td></tr>
<tr><td>Designation</td><td>
	<select name="designation" id="designation">
		<option value="EMP" selected="true">Employee</option>
		<option value="HR">Human Resource</option>
		<option value="MGR">Manager</option>
	</select></td></tr>
<tr><td>Admin</td><td>
	<select name="admin" id="admin">
		<option value="N" selected="true">No</option>
		<option value="Y">Yes</option>
	</select></td></tr>
<tr><td colspan="2" align="center"><button type="submit" name="submit" id="submit">SignUp</button></td></tr>
</table>
</form>
</div>
</nav>
</body>
