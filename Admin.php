<?php
include"header.php";
include"includes/IncDBDetails.php";
session_start();
?>

<?php
	 if(isset($_SESSION['admin']) && isset($_SESSION['empid']))
	{
		$sql0 = "select * from wit_lv_trn_dtls where lv_stat = 'P';";
		$result = mysqli_query($Connect,$sql0);
		$numberofrows = mysqli_num_rows($result);
		if($numberofrows)
			{
				echo"<br><p style='float:right;font-size:20pt;'>$numberofrows Pending Leave Request/s Found.</p><br>";	
			}
	}
?>
<!Doctype html>
<head>
</head>
<body>
	<ul>
		<li><a href="Admin/SetLeaveConfiguration.php">Leave Configuration</a></li>
		<li><a href="Admin/UpdateLeaves.php">Update Leaves</a></li>
		<li><a href="Admin/Reset.php">Reset</a></li>
		<li><a href="User.php">User Panel</a></li>
	</ul>
</body>
