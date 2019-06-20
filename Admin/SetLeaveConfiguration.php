<?php
include 'header.php';
include '../includes/IncDBDetails.php';
session_start();
?>


<?php
$sql = "select * from wit_lv_config where 1=1;";
$result = mysqli_query($Connect,$sql);
$row = mysqli_fetch_assoc($result);
if(isset($_SESSION['admin']) && isset($_SESSION['empid']))
{
	if(!$_SESSION['admin']=='Y'){
		echo "Admin Rights are needed.";
		exit();
		}
}
else
{
	echo"You need to Log in.";
	exit();
}
?>
<!Doctype html>
<head>
</head>
<body>
<!--	
<br>
	<br><br><br><br>
<table border='5' cellpadding='5' cellspacing='5' align='center'>
	<tr><th colspan='2'>Leave Configuration</th></tr>
	<tr><td>Monthly Casual Leaves</td><td><?php //echo ".$row['mnthly_csl_lv'].";?></td></tr>
	<tr><td>Monthly Sick Leaves</td><td><?php //echo ".$row['mnthly_sk_lv'].  ";?></td></tr>
	<tr><td>Financial Month Start</td><td><?php //echo ".$row['fin_mth'].";?></td></tr>
</table> 
-->
<br>
	<br><br><br><br>
<form align='center' method='POST' action='LeaveConfigMethod.php'>
<table border='5' cellpadding='5' cellspacing='5' align='center'>
	<tr><th colspan='3'>Edit Leave Configuration Here</th></tr>
	<tr>
		<td>
			<select name='type' id='type'>
				<option value='0' selected='true'>Select an Option</option>
				<option value='mnthly_csl_lv'>Monthly Casual Leaves</option>
				<option value='mnthly_sk_lv'>Monthly Sick Leaves</option>
				<option value='fin_mth'>Financial Month Start</option>
			</select>		
		</td>
		<td><input type='number' placeholder='Value' name='number' id='number'></td>
		<td><button type='submit' name='submit' id='submit'>Submit</button></td>
	</tr>
	<tr><td>Monthly Casual Leaves</td><td colspan='2'><?php echo "".$row['mnthly_csl_lv']."";?></td></tr>
	<tr><td>Monthly Sick Leaves</td><td colspan='2'><?php echo "".$row['mnthly_sk_lv']."";?></td></tr>
	<tr><td>Financial Month Start</td><td colspan='2'><?php echo "".$row['fin_mth']."";?></td></tr>
</table>
</form>
</body>
