<?php

	include'../../connect/connect.php';

	$type=$_POST['type'];
	$number_of_days=$_POST['number_of_days'];


	$sql = "INSERT INTO hr_leaves_type (type, number_of_days)
		VALUES ('$type', '$number_of_days')";

		if ($conn->query($sql) === TRUE) {

							$title="Leave-Type";
							$description="New leave type has been add";

							$sql = "INSERT INTO hr_system_log (name, description, date_log, time_log)
									VALUES ('$title', '$description', '$datestamp', '$timestamp')";
							$conn->query($sql);
		 	?>
		 	<script type="text/javascript">
		 		alert('Success add Leave Type');
		 		location.href='../?page=leave_type';
		 	</script>
		 	<?php
		} else {
		  echo "Error: " . $sql . "<br>" . $conn->error;
		}

?>