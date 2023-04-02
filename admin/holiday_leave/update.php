<?php

	include'../../connect/connect.php';

	$name=$_POST['name'];
	$start_date=$_POST['start_date'];
	$end_date=$_POST['end_date'];
	$days=$_POST['days'];
	$year=$_POST['year'];
	$id=$_POST['id'];

	$sql = "UPDATE hr_leaves SET name='$name',start_date='$start_date',end_date='$end_date',days='$days',year='$year' WHERE id='$id'";

		if ($conn->query($sql) === TRUE) {

							$title="Leave-Holiday";
							$description="Holiday has been updated";

							$sql = "INSERT INTO hr_system_log (name, description, date_log, time_log)
									VALUES ('$title', '$description', '$datestamp', '$timestamp')";
							$conn->query($sql);
		 	?>
		 	<script type="text/javascript">
		 		alert('Success Update Holiday');
		 		location.href='../?page=holiday_leave';
		 	</script>
		 	<?php
		} else {
		  echo "Error: " . $sql . "<br>" . $conn->error;
		}

?>