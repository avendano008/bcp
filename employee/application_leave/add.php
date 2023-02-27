<?php
include'../../connect/connect.php';

session_start();

$id=$_SESSION['user_id'];

$leave_type_id=$_POST['leave_type_id'];
$request_of_application=$_POST['request_of_application'];
$remarks=$_POST['remarks'];

$sql = "INSERT INTO leaves_application (e_id, leave_type_id, request_of_application,remarks,status)
VALUES ('$id', '$leave_type_id', '$request_of_application','$remarks','pending')";

if ($conn->query($sql) === TRUE) {
  ?>
	<script type="text/javascript">
 		alert('Success Add Application');
 		location.href='../?page=application_leave';
 	</script>
	  <?php
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}


?>