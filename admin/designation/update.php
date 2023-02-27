<?php

	include'../../connect/connect.php';

	$id=$_POST['id'];
	$name=$_POST['name'];

	$sql="UPDATE designation SET name='$name' WHERE id='$id'";

	if ($conn->query($sql) === TRUE) {
	  ?>
		 	<script type="text/javascript">
		 		alert('Success update designation');
		 		location.href='../?page=designation';
		 	</script>
		 	<?php
	} else {
	  echo "Error updating record: " . $conn->error;
	}
?>