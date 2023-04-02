<?php

	include'../../connect/connect.php';

	$remarks=$_POST['remarks'];
	$e_id=$_POST['e_id'];


	$sql = "INSERT INTO hr_institutional_benefits (e_id, remarks, date_time)
		VALUES ('$e_id', '$remarks', NOW())";

		if ($conn->query($sql) === TRUE) {

							$title="Compensation-Institional Benefits";
							$description="New Benefits type has been add";

							$sql = "INSERT INTO hr_system_log (name, description, date_log, time_log)
									VALUES ('$title', '$description', '$datestamp', '$timestamp')";
							$conn->query($sql);
		 	?>
		 	<script type="text/javascript">
		 		alert('Success add Benefits');
		 		location.href='../?page=institutional_benefits';
		 	</script>
		 	<?php
		} else {
		  echo "Error: " . $sql . "<br>" . $conn->error;
		}

?>