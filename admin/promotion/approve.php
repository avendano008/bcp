<?php

include'../../connect/connect.php';

echo$e_id=$_GET['id'];

$sql = "UPDATE hr_promotion SET status='approved' WHERE e_id='$e_id'";

if ($conn->query($sql) === TRUE) {
  ?>
		 	<script type="text/javascript">
		 		alert('Success update Promotion');
		 		location.href='../?page=promotion';
		 	</script>
		 	<?php
} else {
  echo "Error updating record: " . $conn->error;
}

?>