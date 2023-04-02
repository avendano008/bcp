<?php

	include'../../connect/connect.php';

	$remarks=$_POST['remarks'];
	$e_id=$_POST['e_id'];


	$sql = "INSERT INTO hr_bonus (e_id, remarks, date_time)
		VALUES ('$e_id', '$remarks', NOW())";

		if ($conn->query($sql) === TRUE) {

							$title="Compensation-Bonus";
							$description="New Bonus type has been add";

							$sql = "INSERT INTO hr_system_log (name, description, date_log, time_log)
									VALUES ('$title', '$description', '$datestamp', '$timestamp')";
							$conn->query($sql);
		 	?>
		 	<script type="text/javascript">
		 		alert('Success add Bonus');
		 		location.href='../?page=bonus';
		 	</script>
		 	<?php
		} else {
		  echo "Error: " . $sql . "<br>" . $conn->error;
		}

?>