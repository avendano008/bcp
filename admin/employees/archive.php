<?php

	include'../../connect/connect.php';

	$id=$_POST['id'];

	$sql = "UPDATE employee SET status='inactive' WHERE id='$id'";

		if ($conn->query($sql) === TRUE) {

							$title="Employees";
							$description="Employee has been move to archive";

							$sql = "INSERT INTO system_log (name, description, date_log, time_log)
									VALUES ('$title', '$description', '$datestamp', '$timestamp')";
							$conn->query($sql);
		 	?>
		 	<script type="text/javascript">
		 		alert('Success employee has been disabled');
		 		location.href='../?page=employees';
		 	</script>
		 	<?php
		} else {
		  echo "Error: " . $sql . "<br>" . $conn->error;
		}

?>