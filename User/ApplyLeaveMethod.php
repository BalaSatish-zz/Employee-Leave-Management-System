<?php
include 'header.php';
include '../includes/IncDBDetails.php';
session_start();
?>
<?php
if(isset($_SESSION['admin']) && isset($_SESSION['empid'])){
$casualleavestaken;
$sickleavestaken;
$monthlycasuallimit;
$monthlysicklimit;
$financialmonthstart;
$AppliedLeaveType;
if(isset($_POST['submit']))
{

	$empid = (int)$_SESSION['empid'];
	$sql_0= "select * from leavetable where emp_id = '$empid';";
		$result_0 = mysqli_query($Connect,$sql_0);
		$resultcheck_0 = mysqli_num_rows($result_0);

		if($resultcheck_0)
		{
			$row_0 = mysqli_fetch_assoc($result_0);
			$requests = $row_0['requests'];
			if($requests>=3)
			{
				echo "<br>Total number of requests Completed.<br>Wait till the requests are proccessed.";
				return;
			}
		}


	$sqlquery = "select * from leavetable where emp_id = '$empid';";
		$resultq = mysqli_query($Connect,$sqlquery);
		$resultcheckq = mysqli_num_rows($resultq);

		if($resultcheckq)
		{
			$leaverow = mysqli_fetch_assoc($resultq);
			$casualleavestaken = $leaverow['casual'];
			$sickleavestaken = $leaverow['emergency'];
			echo "<br><b>Taken:</b>";
			echo "<br>Casual: ".$casualleavestaken;
			echo "<br>Emergency: ".$sickleavestaken;
		}


		$sqlleavelimit = "select * from wit_lv_config where 1=1;";
		$resultl = mysqli_query($Connect,$sqlleavelimit);
		$resultcheckl = mysqli_num_rows($resultl);

		if($resultcheckl)
		{
			$limitrow = mysqli_fetch_assoc($resultl);
			//echo "<br>".mysqli_error($Connect);
			$monthlycasuallimit = $limitrow['mnthly_csl_lv'];
			$monthlysicklimit =  $limitrow['mnthly_sk_lv'];
			$financialmonthstart = $limitrow['fin_mth'];
			echo "<br><b>Limit:</b>";
			echo "<br>Casual: ".$monthlycasuallimit;
			echo "<br>Emergency: ".$monthlysicklimit;
		}

		$mcll = (int) $monthlycasuallimit; 
		$msll = (int) $monthlysicklimit;
		$tcl = (int) $casualleavestaken;
		$tsl = (int) $sickleavestaken;
		$totaltaken = $tcl + $tsl;
		$totallimit = $mcll +$msll;
		if($totallimit==$totaltaken)
		{
			echo "<br>Limit Reached.<br>";
			return;
		}
		else if($totallimit<$totaltaken)
		{
			echo "Limit Crossed";
			return;
		}

		$CLeft = $mcll - $tcl;
		$SLeft = $msll - $tsl;
	if(!($CLeft<0 || $SLeft <0 ))
	{


	$from = mysqli_real_escape_String($Connect,$_POST['from']);
	$to = mysqli_real_escape_String($Connect,$_POST['to']);
	$reason = mysqli_real_escape_String($Connect,$_POST['reason']);
	$LeaveType = mysqli_real_escape_String($Connect,$_POST['type']);
	$dt0 = new DateTime();
	$today = $dt0->format('Y-m-d');
	

	$fromdate = strtotime($from);
	$todate = strtotime($to);
	$todaydate = strtotime($today);
	if($fromdate >= $todate || $fromdate <=$todaydate)
	{
		echo "wrong input...!";
		return;
	}

	$date1 = new DateTime("$from");
	$date2 = new DateTime("$to");
	$interval = $date1->diff($date2);
	if($interval->days > ($msll+$mcll))
	{
		echo "<br>Long Leaves are not Entertained.<br>";
		return;
	}

//echo "<br>$financialmonthstart".date('-m-Y');
	$financialdatemaker = $financialmonthstart.date('-m-Y');
	$findate = strtotime($financialdatemaker);
//	echo "<br>$findate<br>$fromdate<br>$todate<br>";
	//echo "".(($todate - $findate)/3600)/24;
	$month  = (int) date('m');
	$numberofdays = (int) $interval->days ;
	// echo "".((($todate - $findate)/3600)/24)."<br>";
	// echo "".((($findate - $fromdate)/3600)/24)."<br>";
	// echo "".((($todate - $fromdate)/3600)/24)."<br>";

	// label:
	// if(((($todate - $findate)/3600)/24)>25 || ((($findate - $fromdate)/3600)/24)<-25)
	// {
	// 	$month = $month+1;
	// 	if($month<10){
	// 		$month = "0".$month;
	// 	}
	// 	$financialdatemaker = $financialmonthstart."-".($month)."-".date('Y');
	// 	$findate = strtotime($financialdatemaker);
	// 	goto label;	
	// }
	//echo "".((($todate - $fromdate)/3600)/24)."<br>";
	//echo "<br>".$financialdatemaker."<br>";
	$financial = new  DateTime("$financialdatemaker");
	// echo "".((($todate - $findate)/3600)/24)."<br>";
	// echo "".((($findate - $fromdate)/3600)/24)."<br>";
	// echo "".((($todate - $fromdate)/3600)/24)."<br>";
	// //$financialCheck = $financial->diff($date2);
	//echo "<br>".$financialCheck->days;
	//echo "difference " . $interval->y . " years, " . $interval->m." months, ".$interval->d." days "; 
	// shows the total amount of days (not divided into years, months and days like above)
	//echo "difference " . $interval->days . " days ";
	
	//echo "<br>".$numberofdays."<br>";
	$leaveApply = false;
	if($LeaveType=="Casual")
	{
		if($numberofdays <= $CLeft)
		{
			$leaveApply = true;
			$AppliedLeaveType = "capplied";
		}
	}
	if($LeaveType=="Sick")
	{
		if($numberofdays <= $SLeft)
		{
			$leaveApply = true;
			$AppliedLeaveType = "sapplied";
		}	
	}
	if($leaveApply){


	// echo "".((($todate - $findate)/3600)/24)."<br>";
	// echo "".((($findate - $fromdate)/3600)/24)."<br>";
	// echo "".((($todate - $fromdate)/3600)/24)."<br>";
	label:
	if(((($todate - $findate)/3600)/24)>25 || ((($findate - $fromdate)/3600)/24)<-25)
	{
		$month = $month+1;
		if($month<10){
			$month = "0".$month;
		}
		$financialdatemaker = $financialmonthstart."-".($month)."-".date('Y');
		$findate = strtotime($financialdatemaker);
		goto label;	
	}
	$financial = new  DateTime("$financialdatemaker");
	if(((abs((($todate - $findate)/3600)/24))+(abs((($findate - $fromdate)/3600)/24))==((($todate - $fromdate)/3600)/24)))
	{
		echo "<br><br>Leave on financial month start is not allowed.<br>";
		return;
	}

		$leavestatus = "P";
		$ApprovedByEmployeeId = 0;
		$dt0 = new DateTime();
		$dt1 = new DateTime("$from");
		$dt2 = new DateTime("$to");
		$CurrentDate =  $dt0->format('Y-m-d H:i:s');

		$fdt = $dt1->format('Y-m-d H:i:s');
		$tdt = $dt2->format('Y-m-d H:i:s');

		

		$sql0 = "update leavetable set $AppliedLeaveType = $AppliedLeaveType +$numberofdays, requests = requests+1 where emp_id = $empid;";
		mysqli_query($Connect,$sql0); 
//		echo "<br>".mysqli_error($Connect);




		$ApprovedDateTime = $CurrentDate;
		// echo "".$CurrentDate;
		$sql = "insert into  wit_lv_trn_dtls(emp_id, lv_frm, lv_to, no_dys, rsn, lv_stat, crtd_dttm) values ('$empid', '$fdt','$tdt', '$numberofdays', '$reason', '$leavestatus', '$CurrentDate');";
		// echo "<br>".$empid;
		// echo "<br>".$fdt;
		 //echo "<br>".$tdt;
		// echo "<br>".$numberofdays;
		// echo "<br>".$reason;
		// echo "<br>".$leavestatus;
		// echo "<br>".$CurrentDate;
		//echo "<br>".date("",$dt);

			$result = mysqli_query($Connect,$sql);
			echo "<br>".mysqli_error($Connect);
			echo "<br><b>Applied for $numberofdays Day/s of $LeaveType Leave</b>";
	}
}
}
}else{
	echo "You need to Log in.";
}
