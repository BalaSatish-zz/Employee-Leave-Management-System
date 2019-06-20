<?php
include 'header.php';
include '../includes/IncDBDetails.php';
session_start();

if(isset($_SESSION['admin']) && isset($_SESSION['empid']))
{
if($_SESSION['admin']=='Y'){
$id = $_GET['id'];
$number = $_GET['no'];
$operation = $_GET['operation'];
$from = $_GET['from'];
echo "".$number;

$AdminID = $_SESSION['empid'];
$dt1 = new DateTime("$from");
$fdt = $dt1->format('Y-m-d H:i:s');

$status="P";
if($operation == "Reject")
{
	$status = "R";
}
if($operation == "Approve")
{
	$status = "A";
}
$Currentdate = new DateTime();
$cdt = $Currentdate->format('Y-m-d H:i:s');

	$rowcasuallimit;
	$rowemergencylimit;
	$rowcasual;
	$rowemergency;
	$rowcapplied;
	$rowsapplied;


$sql3 = "select * from leavetable where emp_id = '$id'";
$result3 = mysqli_query($Connect,$sql3);
$resultcheck3 = mysqli_num_rows($result3);
if($resultcheck3)
{
	$row3 = mysqli_fetch_assoc($result3);
	$rowcasual = $row3['casual'];
	$rowemergency = $row3['emergency'];
	$rowcapplied = $row3['capplied'];
	$rowsapplied = $row3['sapplied'];
}

$sql4 = "select * from wit_lv_config;";
$result4 = mysqli_query($Connect,$sql4);
$resultcheck4 = mysqli_num_rows($result4);
if($resultcheck4)
{
	$row4 = mysqli_fetch_assoc($result4);
	$rowcasuallimit = $row4['mnthly_csl_lv'];
	$rowemergencylimit = $row4['mnthly_sk_lv'];
}



if($operation == "Approve")
{
	$CLeft = $rowcasuallimit - $rowcasual;
	$SLeft = $rowemergencylimit - $rowemergency;

	if(($rowcapplied!=='0' && $CLeft >= '0')  || ($rowsapplied!=='0' && $SLeft >='0'))
	{
		if($rowcapplied !=='0' && $rowcasual<$rowcasuallimit && $rowcasuallimit>=$rowcapplied && $number<=$CLeft)
		{
			$sqlquery = "update leavetable set casual=casual+'$number', capplied =capplied-'$number', requests=requests-'1' where emp_id='$id'";
			mysqli_query($Connect,$sqlquery);
			$sql0 ="update wit_lv_trn_dtls set apprd_by_emp_id = '$AdminID',apprd_dttm = '$cdt',lv_stat='$status' where emp_id = '$id' and lv_frm ='$from';";
			mysqli_query($Connect,$sql0);
			//$result = mysqli_query($Connect,$sql1);
			echo "".mysqli_error($Connect);
			echo "<br><b>Approved as Casual Leave for $number Day/s.</b>".mysqli_error($Connect)."<br>";
		}
		else if($rowsapplied !==0 && $rowemergency<$rowemergencylimit && $rowemergencylimit>=$rowsapplied && $number<=$SLeft)
		{
			$sqlquery = "update leavetable set emergency=emergency+'$number', sapplied = sapplied-'$number',requests=requests-'1' where emp_id='$id'";
			mysqli_query($Connect,$sqlquery);
			echo "".mysqli_error($Connect);
			$sql0 ="update wit_lv_trn_dtls set apprd_by_emp_id = '$AdminID',apprd_dttm = '$cdt',lv_stat='$status' where emp_id = '$id' and lv_frm ='$from';";
			mysqli_query($Connect,$sql0);
			//$result = mysqli_query($Connect,$sql1);
			echo "<br><b>Approved as Sick Leave  for $number Day/s.</b>".mysqli_error($Connect)."<br>";
		}
	}	

	// $sql1 = "update leavetable 
				
	// 				set casual = casual+'$number', capplied = capplied - '$number' if(capplied > '$number')

	// 				where emp_id ='$id';
	// 		 update leavetable
				
	// 				set  emergency = emergency+'$number', sapplied = sapplied - '$number' if(capplied < '$number');

	// 				where emp_id ='$id';";
	// //$sql2 = "update leavetable set casual = casual+'$number', capplied = capplied - '$number' where emp_id ='$id' and capplied > '$number';";
}
else if($operation == "Reject")
{
	$CLeft = $rowcasuallimit - $rowcasual;
	$SLeft = $rowemergencylimit - $rowemergency;
	if(($rowcapplied!=='0' && $CLeft >= '0')  || ($rowsapplied!=='0' && $SLeft >='0'))
	{
		if($rowcapplied !=='0' && $rowcasual<$rowcasuallimit && $rowcasuallimit>=$rowcapplied && $number<=$CLeft)
		{
			$sqlquery = "update leavetable set capplied =capplied-'$number', requests=requests-'1' where emp_id='$id'";
			mysqli_query($Connect,$sqlquery);
			$sql0 ="update wit_lv_trn_dtls set apprd_by_emp_id = '$AdminID',apprd_dttm = '$cdt',lv_stat='$status' where emp_id = '$id' and lv_frm ='$from';";
			mysqli_query($Connect,$sql0);
			//$result = mysqli_query($Connect,$sql1);
			echo "".mysqli_error($Connect);
			echo "<br>Rejected.".mysqli_error($Connect)."<br>";
		}
		else if($rowsapplied !=='0' && $rowemergency<$rowemergencylimit && $rowemergencylimit>=$rowsapplied && $number<=$SLeft)
		{
			$sqlquery = "update leavetable set sapplied = sapplied-'$number', requests=requests-'1' where emp_id='$id'";
			mysqli_query($Connect,$sqlquery);
			$sql0 ="update wit_lv_trn_dtls set apprd_by_emp_id = '$AdminID',apprd_dttm = '$cdt',lv_stat='$status' where emp_id = '$id' and lv_frm ='$from';";
			mysqli_query($Connect,$sql0);
			//$result = mysqli_query($Connect,$sql1);
			echo "".mysqli_error($Connect);			
			echo "<br>Rejected.".mysqli_error($Connect)."<br>";
		}
		else{
			echo "error";
		}
	}	
}
}
else{
	echo "Admin Rights are Needed.";
}
}else{
	echo "You need to Log in.";
}
?>
