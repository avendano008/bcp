<?php

	include'../../connect/connect.php';

	$id=$_GET['id'];

	$month=$_GET['month'];
	$days=$_GET['day'];

							if($_GET['day']=="01-15"){
								$day1="-01";
								$day2="-15";
							}else{
								$day1="-16";
								$day2="-31";
							}

							$from=$_GET['month'].$day1;
							$to=$_GET['month'].$day2;

									$date_from=date_create($from);
									$date_to=date_create($to);

									$from=date_format($date_from,"m/d/Y");
									$to=date_format($date_to,"m/d/Y");

							$temp_month=date_format($date_from,"m");

							if($_GET['day']=="16-31" && $temp_month=="02"){

								$day1="-16";
								$day2="-28";

								$from=$_GET['month'].$day1;
								$to=$_GET['month'].$day2;

								$month=$_GET['month'];

								$date_from=date_create($from);
								$date_to=date_create($to);

								$from=date_format($date_from,"d/m/Y");
								$to=date_format($date_to,"d/m/Y");

							}


							if($_GET['day']=="16-31" && $temp_month=="04" || $_GET['day']=="16-31" && $temp_month=="06" ||  $_GET['day']=="16-31" && $temp_month=="09" || $_GET['day']=="16-31" && $temp_month=="11"){

								$day1="-16";
								$day2="-30";

								$from=$_GET['month'].$day1;
								$to=$_GET['month'].$day2;

								$month=$_GET['month'];

								$date_from=date_create($from);
								$date_to=date_create($to);

								$from=date_format($date_from,"d/m/Y");
								$to=date_format($date_to,"d/m/Y");

							}

							echo$from;echo$to;

			$sql = "SELECT *,IFNULL((SELECT SUM(e_total_rate) FROM attendance_log a WHERE a.log_date BETWEEN '$from' AND '$to' AND a.e_id=e.id AND a.status='Approved' AND a.payroll_status!='1' AND a.loan_grant_payroll_id=''),'00') AS salary FROM employee e WHERE e.id='$id'";
			$result = $conn->query($sql);
			$row = $result->fetch_assoc();


			$salary=$row['salary'];

			$installment='0';
			$loan_id='0';

			$sql = "SELECT * FROM loan_grant WHERE e_id='$id' AND status='Approved' ORDER BY id DESC LIMIT 1";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
			  // output data of each row
			  while($row = $result->fetch_assoc()) {
			    $installment=number_format((float)($row['amount']/$row['installment_period']), 2, '.', '');
			    $loan_id=$row['id'];
			  }
			} else {
			 ?><script type="text/javascript">alert('No Loan found');location.href='../?page=generate_payslip&print=<?php echo$id?>&month=<?php echo$month?>&day=<?php echo$days?>'</script><?php
			}

			if($salary>=$installment){

				$sql = "INSERT INTO loan_grant_payroll (loan_id, total_pay, date_time)
				VALUES ('$loan_id', '$installment', NOW())";



				if ($conn->query($sql) === TRUE) {

							$title="Payroll";
							$description="Pay Loan successfully paid";

							$sql = "INSERT INTO system_log (name, description, date_log, time_log)
									VALUES ('$title', '$description', '$datestamp', '$timestamp')";
							$conn->query($sql);
				  
				  	$sql = "SELECT * FROM loan_grant_payroll WHERE loan_id='$loan_id' ORDER BY id DESC LIMIT 1";
					$result = $conn->query($sql);
					$row = $result->fetch_assoc();

					$loan_grant_payroll_id=$row['loan_id'];

					$sql="UPDATE attendance_log a SET a.loan_grant_payroll_id='$loan_grant_payroll_id' WHERE a.log_date BETWEEN '$from' AND '$to' AND a.e_id='$id' AND a.status='Approved' AND a.payroll_status!='1' AND a.loan_grant_payroll_id='' ";

					if ($conn->query($sql) === TRUE) {

						?><script type="text/javascript">alert('Success loan has been deducted and recorded');location.href='../?page=generate_payslip&print=<?php echo$id?>&month=<?php echo$month?>&day=<?php echo$days?>'</script><?php

					} else {
					  echo "Error: " . $sql . "<br>" . $conn->error;
					}

				} else {
				  echo "Error: " . $sql . "<br>" . $conn->error;
				}


			}else{
				?><script type="text/javascript">alert('Cant Proceed, Salary is lower than installment');location.href='../?page=generate_payslip&print=<?php echo$id?>&month=<?php echo$month?>&day=<?php echo$days?>'</script><?php
			}

?>