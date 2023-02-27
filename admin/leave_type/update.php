<?php

	include'../../connect/connect.php';

	$type=$_POST['type'];
	$number_of_days=$_POST['number_of_days'];
	$id=$_POST['id'];

	$sql = "UPDATE leaves_type SET type='$type',number_of_days='$number_of_days' WHERE id='$id'";

		if ($conn->query($sql) === TRUE) {

							$title="Leave-Type";
							$description="Leave type has been updated";

							$sql = "INSERT INTO system_log (name, description, date_log, time_log)
									VALUES ('$title', '$description', '$datestamp', '$timestamp')";
							$conn->query($sql);
		 	?>
		 	<script type="text/javascript">
		 		alert('Success Update Leave type');
		 		location.href='../?page=leave_type';
		 	</script>
		 	<?php
		} else {
		  echo "Error: " . $sql . "<br>" . $conn->error;
		}

?>