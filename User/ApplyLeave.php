<?php
include 'header.php';
include '../includes/IncDBDetails.php';
session_start();
if(!(isset($_SESSION['admin']) && isset($_SESSION['empid'])))
{
	echo "You need to Log in.";
	exit();
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
<form  method="POST" action="../User/ApplyLeaveMethod.php">
<table border="3" cellpadding="5" cellspacing="5" align="center">
<tr><th>EmployeeID</th><th><?php echo "".$_SESSION['empid']; ?></th></tr>
<tr><th>From</th><td><input type="date" name="from" id="from"></input></td></tr>
<tr><th>To</th><td><input type="date" name="to" id="to"></input></td></tr>
<tr><th>Leave Type</th><td>
	<select name="type" id="type">
		<option value="Casual" selected="true">Casual Leave</option>
		<option value="Sick">Sick Leave</option>
	</select></td></tr>
<tr><th>Reason</th><td><textarea name="reason" id="reason" placeholder="reason" cols="40" rows="10"></textarea></td></tr>
<tr><td colspan="2" align="center"><button type="submit" name="submit" id="submit">Apply</button></td></tr>
</table>
</form>
</div>
</nav>
</body>
