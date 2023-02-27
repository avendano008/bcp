<?php

	include'../../connect/connect.php';

	$id=$_POST['id'];
	

	$sql="DELETE FROM department WHERE id='$id'";

	if ($conn->query($sql) === TRUE) {
	  ?>
		 	<script type="text/javascript">
		 		alert('Success delete department');
		 		location.href='../?page=department';
		 	</script>
		 	<?php
	} else {
	  echo "Error updating record: " . $conn->error;
	}
?>