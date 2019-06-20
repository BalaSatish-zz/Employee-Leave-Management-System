<?php
include"header.php";
include"../includes/IncDBDetails.php";
?>
<?php
if(isset($_POST['submit']))
{
	$fn = mysqli_real_escape_String($Connect,$_POST['firstname']);
	$ln = mysqli_real_escape_String($Connect,$_POST['lastname']); 
	$name ="".mysqli_real_escape_String($Connect,$_POST['firstname']). " " . mysqli_real_escape_String($Connect,$_POST['lastname']);
	$email = mysqli_real_escape_String($Connect,$_POST['email']);
	$password1 = mysqli_real_escape_String($Connect,$_POST['password1']);
	$password2 = mysqli_real_escape_String($Connect,$_POST['password2']);
	$designation = mysqli_real_escape_String($Connect,$_POST['designation']);
	$admin = mysqli_real_escape_String($Connect,$_POST['admin']);

	$sql0 = "select emp_id from wit_lv_emp_mast where emp_eml = '$email';";

		$result0 = mysqli_query($Connect,$sql0);
		$resultcheck = mysqli_num_rows($result0);
if($password1 == $password2){

	if(!$resultcheck)
	{
		$pwd = $password1;
		// echo "".$_POST['firstname']."<br>";
		// echo "".$_POST['lastname']."<br>";
		// echo "".$_POST['email']."<br>";
		// echo "".$_POST['password1']."<br>";
		// echo "".$_POST['password2']."<br>";
		// echo "".$_POST['designation']."<br>";
		// echo "".$_POST['admin']."<br>";

		$sql1 = "insert into wit_lv_emp_mast (emp_name, emp_eml,  login_pwd, is_admin, emp_desgn) values ('$name', '$email', '$pwd', '$admin', '$designation');";
		mysqli_query($Connect,$sql1);

		$sql2 = "select emp_id from wit_lv_emp_mast where emp_eml = '$email';";
		$result = mysqli_query($Connect,$sql2);

		$row = mysqli_fetch_assoc($result);
		echo "<br><h3>Account Creation Successfull.<br><h3>";
		echo "<br><h1>Your Employee-ID: ".$row['emp_id']."</h1>";

		$emp_id = $row['emp_id'];

		$sql3 = "insert into leavetable (emp_id, casual,  emergency, capplied, sapplied, requests) values ('$emp_id','0','0','0','0','0');";
		mysqli_query($Connect,$sql3);
	}
	else{
		echo "Sorry! Email already taken.";
		return;
	}
}
else{
	echo "Passwords Mismatch...!";
	return;
}
}
else
{
	echo "Error...!";
	return;
}		
?>
