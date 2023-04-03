<?php
	
	include'../../connect/connect.php';

	$id=$_POST['id'];
	$f_name=$_POST['f_name'];
	$l_name=$_POST['l_name'];
	$code=$_POST['code'];
	$department=$_POST['department'];
	$designation=$_POST['designation'];
	$gender=$_POST['gender'];
	$blood_group=$_POST['blood_group'];
	$cp_number=$_POST['cp_number'];
	$date_of_birth=$_POST['date_of_birth'];
	$date_of_joining=$_POST['date_of_joining'];
	$date_of_leaving=$_POST['date_of_leaving'];
	$sss=$_POST['sss'];
	$pagibig=$_POST['pagibig'];
	$philhealth=$_POST['philhealth'];
	$tin=$_POST['tin'];
	
	
	$email=$_POST['email'];
	
	
	

	$sql="UPDATE hr_employee SET f_name='$f_name',l_name='$l_name',code='$code',department='$department',designation='$designation',gender='$gender',blood_group='$blood_group',cp_number='$cp_number',date_of_birth='$date_of_birth',date_of_joining='$date_of_joining',date_of_leaving='$date_of_leaving',email='$email' WHERE id='$id'";

							
	
		if ($conn->query($sql) === TRUE) {

							$title="Employees";
							$description="Employee has been updated";

							$sql = "INSERT INTO hr_system_log (name, description, date_log, time_log)
									VALUES ('$title', '$description', '$datestamp', '$timestamp')";
							$conn->query($sql);
							
			

		  ?>
		  <script type="text/javascript">
		  	alert('Success update employees');
		 	location.href='../?page=employees';
		  </script>
		  <?php
		} else {
		  echo "Error: " . $sql . "<br>" . $conn->error;
		}
?>