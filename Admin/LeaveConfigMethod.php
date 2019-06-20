<?php
include 'header.php';
include '../includes/IncDBDetails.php';
session_start();
?>


<?php
if(isset($_SESSION['admin']) && isset($_SESSION['empid']))
{
if($_SESSION['admin']=='Y'){
if(isset($_POST['submit'])){
$type = $_POST['type'];
$value = $_POST['number'];
	if($type!="0"){
		$sql = "update wit_lv_config set $type = $value where 1=1";
		$result = mysqli_query($Connect,$sql);
		header('Location:SetLeaveConfiguration.php');
	}
	else
	{
		echo "<h3>Please do Select an Option.</h3>";
	}
}
else{
	echo "error occured...!";
}}else
{
	echo"Admin Rights are needed.";
}
}
else
{
	echo "You need to Log in.";
}
?>
