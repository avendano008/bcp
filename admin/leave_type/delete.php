<?php

	include'../../connect/connect.php';

	$id=$_POST['id'];
	

	$sql="DELETE FROM leaves_type WHERE id='$id'";

	if ($conn->query($sql) === TRUE) {

							$title="Leave-Type";
							$description="Leave type has been remove";

							$sql = "INSERT INTO system_log (name, description, date_log, time_log)
									VALUES ('$title', '$description', '$datestamp', '$timestamp')";
							$conn->query($sql);
	  ?>
		 	<script type="text/javascript">
		 		alert('Success delete holiday');
		 		location.href='../?page=leave_type';
		 	</script>
		 	<?php
	} else {
	  echo "Error updating record: " . $conn->error;
	}
?>