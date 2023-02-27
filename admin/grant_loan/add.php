<?php

	include'../../connect/connect.php';

	$e_id=$_POST['e_id'];
	$amount=$_POST['amount'];
	$approved_date=$_POST['approved_date'];
	$installment_period=$_POST['installment_period'];
	$loan_number=$_POST['loan_number'];
	$status=$_POST['status'];
	$remarks=$_POST['remarks'];

	$sql = "INSERT INTO loan_grant (e_id, amount,approved_date,installment_period,loan_number,status,remarks)
		VALUES ('$e_id','$amount','$approved_date','$installment_period','$loan_number','$status','$remarks')";


		if ($conn->query($sql) === TRUE) {

							$title="Loan";
							$description="New loan has been added";

							$sql = "INSERT INTO system_log (name, description, date_log, time_log)
									VALUES ('$title', '$description', '$datestamp', '$timestamp')";
							$conn->query($sql);
		 	?>
		 	<script type="text/javascript">
		 		alert('Success add Grant Loan');
		 		location.href='../?page=grant_loan';
		 	</script>
		 	<?php
		} else {
		  echo "Error: " . $sql . "<br>" . $conn->error;
		}

?>