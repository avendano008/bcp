<?php

	include'../../connect/connect.php';

	$name=$_POST['name'];

	$sql = "INSERT INTO hr_designation (name, date_time)
		VALUES ('$name', NOW())";

		if ($conn->query($sql) === TRUE) {
		 	?>
		 	<script type="text/javascript">
		 		alert('Success add designation');
		 		location.href='../?page=designation';
		 	</script>
		 	<?php
		} else {
		  echo "Error: " . $sql . "<br>" . $conn->error;
		}

?>