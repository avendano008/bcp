<?php

	include'../../connect/connect.php';

	$id=$_POST['id'];

	$sql = "UPDATE employee SET status='active' WHERE id='$id'";

		if ($conn->query($sql) === TRUE) {
		 	?>
		 	<script type="text/javascript">
		 		alert('Success employee has been enabled');
		 		location.href='../?page=archive';
		 	</script>
		 	<?php
		} else {
		  echo "Error: " . $sql . "<br>" . $conn->error;
		}

?>