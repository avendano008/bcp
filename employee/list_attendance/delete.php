<?php

	include'../../connect/connect.php';

	$id=$_POST['id'];
	

	$sql="DELETE FROM attendance_log WHERE id='$id'";

	if ($conn->query($sql) === TRUE) {
	  ?>
		 	<script type="text/javascript">
		 		alert('Success delete attendance');
		 		location.href='../?page=list_attendance';
		 	</script>
		 	<?php
	} else {
	  echo "Error updating record: " . $conn->error;
	}
?>