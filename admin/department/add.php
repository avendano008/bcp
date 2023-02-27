<?php

	include'../../connect/connect.php';

	$name=$_POST['name'];

	$sql = "INSERT INTO department (name, date_time)
		VALUES ('$name', NOW())";

		if ($conn->query($sql) === TRUE) {
		 	?>
		 	<script type="text/javascript">
		 		alert('Success add department');
		 		location.href='../?page=department';
		 	</script>
		 	<?php
		} else {
		  echo "Error: " . $sql . "<br>" . $conn->error;
		}

?>