<?php

	include'../../connect/connect.php';

	$id=$_POST['id'];
	

	$sql="DELETE FROM hr_leaves WHERE id='$id'";

	if ($conn->query($sql) === TRUE) {

							$title="Leave-Holiday";
							$description="Holiday has been Remove";

							$sql = "INSERT INTO hr_system_log (name, description, date_log, time_log)
									VALUES ('$title', '$description', '$datestamp', '$timestamp')";
							$conn->query($sql);
	  ?>
		 	<script type="text/javascript">
		 		alert('Success delete holiday');
		 		location.href='../?page=holiday_leave';
		 	</script>
		 	<?php
	} else {
	  echo "Error updating record: " . $conn->error;
	}
?>