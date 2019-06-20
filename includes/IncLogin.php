<?php
include"header.php";
include"../includes/IncDBDetails.php";
session_start();
?>
<?php
if(isset($_POST['submit']))
{
	$email = $_POST['email'];
	$password = $_POST['password'];
		$sql = "select * from wit_lv_emp_mast where (emp_eml='$email' and login_pwd='$password') or (emp_id='$email' and login_pwd='$password ');";

		$result = mysqli_query($Connect,$sql);
		$resultcheck = mysqli_num_rows($result);
		if($resultcheck==true)
		{
			echo "".$_POST['email']."<br>";
			echo "".$_POST['password']."<br>";	
			$row = mysqli_fetch_assoc($result);
			echo "".$row['emp_name'];
			$_SESSION['empid'] = $row['emp_id'];
			$_SESSION['admin'] = $row['is_admin'];
			$_SESSION['name'] = $row['emp_name'];
			header('Location:../index.php');
		}
		else
		{
			echo "Invalid Credentials...!";
		}
		
}
else
{
	echo "Error...!";
}		
?>
