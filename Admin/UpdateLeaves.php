<?php
include 'header.php';
include '../includes/IncDBDetails.php';
session_start();
?>
<?php
if(isset($_SESSION['admin']) && isset($_SESSION['empid']))
{
if($_SESSION['admin']=='Y'){
	$empid = (int)$_SESSION['empid'];
	$sql0 = "select * from wit_lv_trn_dtls where lv_stat = 'P';";
	$result = mysqli_query($Connect,$sql0);
	echo "<br><br><br><br>";
	echo "<table border='5' align='center' cellpadding='5' cellspacing='3'>";
	echo "<tr><th colspan='9' style='color:red' style='background-color:white'>Pending Leaves</th></tr>";
	echo "<tr><th>Employee-ID</th><th>From</th><th>To</th><th>Number of Days</th><th>Reason</th><th>Status</th><th>Approved By</th><th>Approved Date</th><th>Applied Date</th>";

	$n=1;
	while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
	{
		if($n%2==0){
			echo "<tr><td>";	
		}
		else{
			echo "<tr style='background-color:white'><td>";
		}
		$rowdtf = new DateTime($row['lv_frm']);
		$row['lv_frm'] = $rowdtf->format('Y-m-d');

		$rowdtl = new DateTime($row['lv_to']);
		$row['lv_to'] = $rowdtl->format('Y-m-d');

		echo $row['emp_id'];
		echo "</td><td>";
		echo $row['lv_frm'];
		echo "</td><td>";
		echo $row['lv_to'];
		echo "</td><td>";
		echo $row['no_dys'];
		echo "</td><td>";
		echo $row['rsn'];
		echo "</td><td>";
		echo $row['lv_stat'];
		echo "</td><td>";
		echo $row['apprd_by_emp_id'];
		echo "</td><td>";
		echo $row['apprd_dttm'];
		echo "</td><td>";
		echo $row['crtd_dttm'];
		echo "</td><td>";
		echo "<a href='UpdateLeaveMethod.php?id=".$row['emp_id']."&operation=Approve&from=".$row['lv_frm']."&no=".$row['no_dys']."'>Approve</a>";
		echo "<br>";
		echo "<a href='UpdateLeaveMethod.php?id=".$row['emp_id']."&operation=Reject&from=".$row['lv_frm']."&no=".$row['no_dys']."'>Reject</a>";
		echo"</td><tr>";
		$n++;
	}
	echo "</table>";


	$sql1 = "select * from wit_lv_trn_dtls where lv_stat='A';";
	$result1 = mysqli_query($Connect,$sql1);
	echo "<br><br><br><br>";
	echo "<table border='5' align='center' cellpadding='5' cellspacing='3'>";
	echo "<tr><th colspan='9' style='color:red' style='background-color:white'>Approved Requests</th></tr>";
	echo "<tr><th>Employee-ID</th><th>From</th><th>To</th><th>Number of Days</th><th>Reason</th><th>Status</th><th>Approved By</th><th>Approved Date</th><th>Applied Date</th>";

	$n=1;
	while($row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC))
	{
		if($n%2==0){
			echo "<tr><td>";	
		}
		else{
			echo "<tr style='background-color:white'><td>";
		}
		$rowdtf1 = new DateTime($row1['lv_frm']);
		$row1['lv_frm'] = $rowdtf1->format('Y-m-d');

		$rowdtl1 = new DateTime($row1['lv_to']);
		$row1['lv_to'] = $rowdtl1->format('Y-m-d');
		echo $row1['emp_id'];
		echo "</td><td>";
		echo $row1['lv_frm'];
		echo "</td><td>";
		echo $row1['lv_to'];
		echo "</td><td>";
		echo $row1['no_dys'];
		echo "</td><td>";
		echo $row1['rsn'];
		echo "</td><td>";
		echo $row1['lv_stat'];
		echo "</td><td>";
		echo $row1['apprd_by_emp_id'];
		echo "</td><td>";
		echo $row1['apprd_dttm'];
		echo "</td><td>";
		echo $row1['crtd_dttm'];
		echo "</td><tr>";
		$n++;
	}
	echo"</table>";


	$sql2 = "select * from wit_lv_trn_dtls where lv_stat='R';";
	$result2 = mysqli_query($Connect,$sql2);
	echo "<br><br><br><br>";
	echo "<table border='5' align='center' cellpadding='5' cellspacing='3'>";
	echo "<tr><th colspan='9' style='color:red' style='background-color:white'>Rejected Requests</th></tr>";
	echo "<tr><th>Employee-ID</th><th>From</th><th>To</th><th>Number of Days</th><th>Reason</th><th>Status</th><th>Approved By</th><th>Approved Date</th><th>Applied Date</th>";

	$n=1;
	while($row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC))
	{
		if($n%2==0){
			echo "<tr><td>";	
		}
		else{
			echo "<tr style='background-color:white'><td>";
		}

		$rowdtf2 = new DateTime($row2['lv_frm']);
		$row2['lv_frm'] = $rowdtf2->format('Y-m-d');

		$rowdtl2 = new DateTime($row2['lv_to']);
		$row2['lv_to'] = $rowdtl2->format('Y-m-d');
		echo $row2['emp_id'];
		echo "</td><td>";
		echo $row2['lv_frm'];
		echo "</td><td>";
		echo $row2['lv_to'];
		echo "</td><td>";
		echo $row2['no_dys'];
		echo "</td><td>";
		echo $row2['rsn'];
		echo "</td><td>";
		echo $row2['lv_stat'];
		echo "</td><td>";
		echo $row2['apprd_by_emp_id'];
		echo "</td><td>";
		echo $row2['apprd_dttm'];
		echo "</td><td>";
		echo $row2['crtd_dttm'];
		echo "</td><tr>";
		$n++;
	}
	echo"</table>";
}
else{
	echo "Admin Rights are needed.";	
}

}
else{
	echo "You need to Log in.";
}
?>
<!Doctype html>
<head>
</head>
<body>

</body>
