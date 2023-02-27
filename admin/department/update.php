<?php

	include'../../connect/connect.php';

	$id=$_POST['id'];
	$name=$_POST['name'];

	$sql="UPDATE department SET name='$name' WHERE id='$id'";

	if ($conn->query($sql) === TRUE) {
	  ?>
		 	<script type="text/javascript">
		 		alert('Success update department');
		 		location.href='../?page=department';
		 	</script>
		 	<?php
	} else {
	  echo "Error updating record: " . $conn->error;
	}
?>