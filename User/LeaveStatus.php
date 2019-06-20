<?php
include 'header.php';
include '../includes/IncDBDetails.php';
session_start();
?>
<?php
if(isset($_SESSION['admin']) && isset($_SESSION['empid'])){
	$sql2 = "select * from wit_lv_trn_dtls where emp_id='".$_SESSION['empid']."';";
	$result2 = mysqli_query($Connect,$sql2);
	echo "<br><br><br><br>";
	echo "<table border='5' align='center' cellpadding='5' cellspacing='3'>";
	echo "<tr><th colspan='9' style='color:red' style='background-color:white'> Your Total Leave Requests</th></tr>";
	echo "<tr><th>Employee-ID</th><th>From</th><th>To</th><th>Number of Days</th><th>Reason</th><th>Status</th><th>Approved By</th><th>Approved Date</th><th>Applied Date</th></tr>";

	$n=1;
	while($row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC))
	{
		if($row2['lv_stat']=='P'){
			$row2['lv_stat']='Pending';
			echo "<trstyle='background-color:white;'><td>";	
		}
		else if($row2['lv_stat']=='A')
		{
			$row2['lv_stat']='Approved';
			echo "<tr style='background-color:Green;'><td>";
		}
		else if(($row2['lv_stat']=='R'))
		{
			$row2['lv_stat']='Rejected';
			echo "<tr style='background-color:Red;'><td>";	
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
}
else{
	echo "You need to Log in.";
}
?>
