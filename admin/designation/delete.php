<?php

	include'../../connect/connect.php';

	$id=$_POST['id'];
	

	$sql="DELETE FROM designation WHERE id='$id'";

	if ($conn->query($sql) === TRUE) {
	  ?>
		 	<script type="text/javascript">
		 		alert('Success delete designation');
		 		location.href='../?page=designation';
		 	</script>
		 	<?php
	} else {
	  echo "Error updating record: " . $conn->error;
	}
?>