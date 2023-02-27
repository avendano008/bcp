<?php

	include'../../connect/connect.php';

	$name=$_POST['name'];
	$start_date=$_POST['start_date'];
	$end_date=$_POST['end_date'];
	$days=$_POST['days'];
	$year=$_POST['year'];

	$sql = "INSERT INTO leaves (name, start_date,end_date,days,year)
		VALUES ('$name', '$start_date','$end_date','$days','$year')";

		if ($conn->query($sql) === TRUE) {

							$title="Leave-Holiday";
							$description="New Holiday has been add";

							$sql = "INSERT INTO system_log (name, description, date_log, time_log)
									VALUES ('$title', '$description', '$datestamp', '$timestamp')";
							$conn->query($sql);
		 	?>
		 	<script type="text/javascript">
		 		alert('Success add Holiday');
		 		location.href='../?page=holiday_leave';
		 	</script>
		 	<?php
		} else {
		  echo "Error: " . $sql . "<br>" . $conn->error;
		}

?>