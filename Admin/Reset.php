<?php
include"header.php";
include"../includes/IncDBDetails.php";
session_start();
?>

<?php
	 if(isset($_SESSION['admin']) && isset($_SESSION['empid']))
	{
		if($_SESSION['admin']=='Y')
		{
			$sql0 = "update leavetable set casual='0',emergency='0',capplied='0', sapplied='0', requests=0 where 1=1;";
		mysqli_query($Connect,$sql0);
		echo "Reset Successfull".mysqli_error($Connect);
		}
		else{
			echo "Admin rights are needed.";
		}
	}
	else{
		echo "You need to Log in.";
	}
