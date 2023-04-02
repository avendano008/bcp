<?php
	
	include'../../connect/connect.php';



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
	// $rate_per_hour=$_POST['rate_per_hour'];
	$sss=$_POST['sss'];
	$pagibig=$_POST['pagibig'];
	$philhealth=$_POST['philhealth'];
	$tin=$_POST['tin'];
	$username=$_POST['username'];
	$email=$_POST['email'];
	$pass=md5($_POST['pass']);

	$sql = "SELECT * FROM hr_employee WHERE email='$email'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	  // output data of each row
	  while($row = $result->fetch_assoc()) {
	    ?>
		  <script type="text/javascript">
		  	
		  	alert('Email Already register');
		 	location.href='../?page=employees';
		  </script>
		  <?php
	  }
	} else {
	  $sql = "SELECT * FROM hr_employee WHERE cp_number='$cp_number'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		  // output data of each row
		  while($row = $result->fetch_assoc()) {
		    ?>
			  <script type="text/javascript">
			  	
			  	alert('Cellphone Already register');
			 	location.href='../?page=employees';
			  </script>
			  <?php
		  }
		} else {
		  	$sql = "SELECT * FROM hr_employee WHERE username='$username'";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
			  // output data of each row
			  while($row = $result->fetch_assoc()) {
			    ?>
				  <script type="text/javascript">
				  	
				  	alert('Username Already register');
				 	location.href='../?page=employees';
				  </script>
				  <?php
			  }
			} else {
			  $sql = "SELECT * FROM hr_employee WHERE f_name='$f_name' AND l_name='$l_name'";
				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
				  // output data of each row
				  while($row = $result->fetch_assoc()) {
				    ?>
					  <script type="text/javascript">
					  	
					  	alert('Full name Already register');
					 	location.href='../?page=employees';
					  </script>
					  <?php
				  }
				} else {
				  $sql = "SELECT * FROM hr_employee WHERE code='$code'";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
					  // output data of each row
					  while($row = $result->fetch_assoc()) {
					    ?>
						  <script type="text/javascript">
						  	
						  	alert('Code Already register');
						 	location.href='../?page=employees';
						  </script>
						  <?php
					  }
					} else {
					  $sql = "INSERT INTO hr_employee (f_name, l_name, code, email,pass,status,department,designation,gender,blood_group,cp_number,date_of_birth,date_of_joining,date_of_leaving,username,sss,pagibig,philhealth,tin)
						VALUES ('$f_name', '$l_name', '$code', '$email','$pass','active','$department','$designation','$gender','$blood_group','$cp_number','$date_of_birth','$date_of_joining','$date_of_leaving','$username','$sss','$pagibig','$philhealth','$tin')";

						if ($conn->query($sql) === TRUE) {

							$title="Employees";
							$description="New Employee has been added";

							$sql = "INSERT INTO hr_system_log (name, description, date_log, time_log)
									VALUES ('$title', '$description', '$datestamp', '$timestamp')";
							$conn->query($sql);

						  ?>
						  <script type="text/javascript">
						  	
						  	alert('Success add employee');
						 	location.href='../?page=employees';
						  </script>
						  <?php
						} else {
						  echo "Error: " . $sql . "<br>" . $conn->error;
						}
					}
				}
			}

		}
	}



	
?>