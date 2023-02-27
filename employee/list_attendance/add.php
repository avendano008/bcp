<?php
	include'../../connect/connect.php';
	session_start();

	$id=$_SESSION['user_id'];


	$log_date=$_POST['log_date'];
	$log_in=$_POST['log_in'];
	$log_out=$_POST['log_out'];
	$rate_per_hour=$_POST['rate_per_hour'];

	function time_to_decimal($time) {
	    $timeArr = explode(':', $time);
	    $decTime = ($timeArr[0]*60) + ($timeArr[1]);

	    return $decTime;
	}

	$minute=time_to_decimal($log_out)-time_to_decimal($log_in);

	$working_hour=number_format((float)$minute/60, 2, '.', '');

	$e_total_rate=$working_hour*$rate_per_hour;

	$e_total_rate1=number_format((float)$e_total_rate, 2, '.', '');

	$sql = "INSERT INTO attendance_log (e_id,log_in,log_date,log_out,working_hour,status,e_rate,e_total_rate)
	VALUES ('$id','$log_in','$log_date','$log_out','$working_hour','pending','$rate_per_hour','$e_total_rate1')";

	if ($conn->query($sql) === TRUE) {
	  ?>
	  <script type="text/javascript">
		 		alert('Success Add attendance');
		 		location.href='../?page=list_attendance';
		 	</script>
	  <?php
	} else {
	  echo "Error: " . $sql . "<br>" . $conn->error;
	}

?>