<?php

	include'../../connect/connect.php';

	$id=$_POST['id'];
	

	$sql="UPDATE  loan_grant SET status='Archive' WHERE id='$id'";

	if ($conn->query($sql) === TRUE) {

							$title="Loan";
							$description="Loan has been move to archive";

							$sql = "INSERT INTO system_log (name, description, date_log, time_log)
									VALUES ('$title', '$description', '$datestamp', '$timestamp')";
							$conn->query($sql);
	  ?>
		 	<script type="text/javascript">
		 		alert('Success move to Archive ');
		 		location.href='../?page=grant_loan';
		 	</script>
		 	<?php
	} else {
	  echo "Error updating record: " . $conn->error;
	}
?>