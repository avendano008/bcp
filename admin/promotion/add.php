<?php

	include'../../connect/connect.php';

	$remarks=$_POST['remarks'];
	$e_id=$_POST['e_id'];


	$sql = "INSERT INTO hr_promotion (e_id, remarks, date_time,status)
		VALUES ('$e_id', '$remarks', NOW(),'pending')";

		if ($conn->query($sql) === TRUE) {

							$title="Promotion";
							$description="New promotion type has been add";

							$sql = "INSERT INTO hr_system_log (name, description, date_log, time_log)
									VALUES ('$title', '$description', '$datestamp', '$timestamp')";
							$conn->query($sql);
		 	?>
		 	<script type="text/javascript">
		 		alert('Success add Promotion');
		 		location.href='../?page=promotion';
		 	</script>
		 	<?php
		} else {
		  echo "Error: " . $sql . "<br>" . $conn->error;
		}

?>