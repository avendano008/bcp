<?php

	include'../../connect/connect.php';

	
	$e_id=$_POST['e_id'];


	$sql = "INSERT INTO hr_avon_members (e_id, date_time)
		VALUES ('$e_id', NOW())";

		if ($conn->query($sql) === TRUE) {

							$title="Compensation-Avon Member";
							$description="New avon member type has been add";

							$sql = "INSERT INTO hr_system_log (name, description, date_log, time_log)
									VALUES ('$title', '$description', '$datestamp', '$timestamp')";
							$conn->query($sql);
		 	?>
		 	<script type="text/javascript">
		 		alert('Success add Avon member');
		 		location.href='../?page=avon_member';
		 	</script>
		 	<?php
		} else {
		  echo "Error: " . $sql . "<br>" . $conn->error;
		}

?>