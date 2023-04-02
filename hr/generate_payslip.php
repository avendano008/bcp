<h1 class="text-success">Payslip List</h1><br>
<div class="card card-flush">
		<!--end::Card header-->
		<div class="card-header align-items-center py-5 gap-2 gap-md-5">
			<!--begin::Card title-->
			<div class="card-title">
				<!--begin::Search-->
				<div class="d-flex align-items-center position-relative my-1">
					<!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
					<span class="svg-icon svg-icon-1 position-absolute ms-4">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
							<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
							<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
						</svg>
					</span>
					<!--end::Svg Icon-->
					<input type="text" data-kt-ecommerce-product-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search" />
				</div>
				<!--end::Search-->
			</div>
			<!--end::Card title-->
			<!--begin::Card toolbar-->
			<div class="card-toolbar flex-row-fluid justify-content-end gap-5" style="">
				<div class="w-100 mw-150px">
					<!--begin::Select2-->
					<!--begin::Title-->
			<h1 class="text-success fw-bolder my-1 fs-3" id="total_sales"></h1>
			<!--end::Title-->
					
						
					<!--end::Select2-->
				</div>
				<!--begin::Add product-->
				<select type="date" name="" id='department' class="form-control form-control-solid w-200px ">
					<option>Department</option>
					<?php
						$sql = "SELECT * FROM department";
						$result = $conn->query($sql);

						if ($result->num_rows > 0) {
						  // output data of each row
						  while($row = $result->fetch_assoc()) {
						    ?>
						    	<option><?php echo$row['name']?></option>
						    <?php
						  }
						} else {
						  echo "0 results";
						}
					?>
				</select>
				Month
				<input type="month" name="" class="form-control form-control-solid w-200px " id="month" >
				Day
				<select class="form-control form-control-solid w-200px " onchange="date_range(document.getElementById('department').value,document.getElementById('month').value,this.value);">
					<option></option>
					<option>01-15</option>
					<option>16-31</option>
				</select>
				<script type="text/javascript">
					function date_range(department,month,day){
						location.href='?page=generate_payslip&department='+department+'&month='+month+'&day='+day;
					}
				</script>
				<!-- <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal"><i class="bi bi-plus" style="font-size: 25px;"></i>Add Attendance</a>
				<a href="#" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#myModal"><i class="bi bi-plus" style="font-size: 25px;"></i>Add Bulk Attendance</a> -->
				<!-- <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal"><i class="bi bi-plus" style="font-size: 25px;"></i>Add Report</a> -->
				<!--end::Add product-->
			</div>
			<!--end::Card toolbar-->
		</div>
		<!--begin::Card body-->
		<div class="card-body pt-0" id="table_content">
			<!--begin::Table-->
			

			<table class="table align-middle table-striped table-row-dashed fs-6 gy-5" id="kt_ecommerce_products_table">
					<!--begin::Table head-->
					<thead>
						
						<!--begin::Table row-->
						<tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
							<th class="w-10px pe-2">
								<div class="form-check form-check-sm form-check-custom form-check-solid me-3">
									<input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_ecommerce_products_table .form-check-input" value="1" />
								</div>
							</th>
							<th class="min-w-100px">Full Name</th>
							<th class="min-w-100px">Department</th>
							<th class="min-w-100px">Total Salary</th>
							<th class="min-w-100px">Action</th>
						</tr>
						<!--end::Table row-->
					</thead>
					<!--end::Table head-->
					<!--begin::Table body-->
					<tbody class="fw-bold text-gray-600">
						<?php

							$month = date("Y-m");

							$from=$month."-01";
							$to=$month."-31";

							$days="01-15";

							$date_from=date_create($from);
							$date_to=date_create($to);

							$from=date_format($date_from,"d/m/Y");
							$to=date_format($date_to,"d/m/Y");

						if(isset($_GET['department'])){

							$department=$_GET['department'];

							if($_GET['day']=="01-15"){

								$day1="-01";
								$day2="-15";
							}else{

								$day1="-16";
								$day2="-31";
							}

							$days=$_GET['day'];

							$from=$_GET['month'].$day1;
							$to=$_GET['month'].$day2;

							$month=$_GET['month'];

							$date_from=date_create($from);
							$date_to=date_create($to);

							$from=date_format($date_from,"d/m/Y");
							$to=date_format($date_to,"d/m/Y");

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

								$sql = "SELECT e.*,IFNULL((SELECT SUM(e_total_rate) FROM attendance_log a WHERE a.log_date BETWEEN '$from' AND '$to' AND a.e_id=e.id AND a.status='Approved' AND a.payroll_status!='1'),'00') AS salary  FROM employee e WHERE e.department='$department' ORDER BY id DESC";
								$result = $conn->query($sql);

						}else{

								$sql = "SELECT e.*,IFNULL((SELECT SUM(e_total_rate) FROM attendance_log a WHERE a.log_date BETWEEN '$from' AND '$to' AND a.e_id=e.id AND a.status='Approved' AND a.payroll_status!='1'),'00') AS salary  FROM employee e ORDER BY id DESC";
								$result = $conn->query($sql);
						}

								

								if ($result->num_rows > 0) {
								  // output data of each row
								  while($row = $result->fetch_assoc()) {
						?>
						<tr>
							<td>
								<div class="form-check form-check-sm form-check-custom form-check-solid">
									<input class="form-check-input" type="checkbox" value="1" />
								</div>
							</td>
							<td class="pe-0">
								<?php echo$row['f_name']?> <?php echo$row['l_name']?>
							</td>
							<td class="pe-0">
								<?php echo$row['department']?>
							</td>
							<td class="pe-0">
								<?php echo$row['salary']?>
							</td>
							<td class="pe-0">
								<a href="?page=<?php echo$_GET['page']?>&print=<?php echo$row['id']?>&month=<?php echo$month?>&day=<?php echo$days?>" class="btn btn-primary"><i class="bi bi-printer"></i></a>
							</td>
						</tr>
						<?php 
								  }
								} else {
								  echo "0 results";
							}
						?>
						
					</tbody>
					<!--end::Table body-->
				</table>


			<!--end::Table-->
		</div>
		<!--end::Card body-->
	</div>

<?php

		if(isset($_GET['print'])){
			$id=$_GET['print'];
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

									$from=date_format($date_from,"d/m/Y");
									$to=date_format($date_to,"d/m/Y");

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

			$sql = "SELECT e.*,
			IFNULL((SELECT SUM(e_total_rate) FROM attendance_log a WHERE a.log_date BETWEEN '$from' AND '$to' AND a.e_id=e.id AND a.status='Approved' AND a.payroll_status!='1'),'00') AS salary,
			IFNULL((SELECT loan_grant_payroll_id FROM attendance_log a WHERE a.log_date BETWEEN '$from' AND '$to' AND a.e_id=e.id AND a.status='Approved' AND a.payroll_status!='1' LIMIT 1),'00') AS loan
			FROM employee e WHERE e.id='$id'";
			$result = $conn->query($sql);
			$row = $result->fetch_assoc();
			$salary=$row['salary'];
			$loan=$row['loan'];
		}
?>
<div class="modal fade" id="myModalprint">
  <div class="modal-dialog">
    <div class="modal-content">
    	<form >
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Summary of Salary / Date : <?php echo$datestamp?></h4>

        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>

      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <div class="row">
      	<div class="col-md-6 col-6 fv-row fv-plugins-icon-container">
					<!--begin::Label-->
						<label class="required fs-5 fw-bold mb-2">From :</label><?php echo$from?><br>
						
						<!--end::Input-->
					<div class="fv-plugins-message-container invalid-feedback"></div>
				</div>
				<div class="col-md-6 col-6 fv-row fv-plugins-icon-container">
					<!--begin::Label-->
						<label class="required fs-5 fw-bold mb-2">To :</label><?php echo$to?>
						
						<!--end::Input-->
					<div class="fv-plugins-message-container invalid-feedback"></div>
				</div>
	     	<div class="col-md-12 col-6 fv-row fv-plugins-icon-container">
					<!--begin::Label-->
						<label class="required fs-5 fw-bold mb-2">Employee Name</label>
						<input type="text" class="form-control form-control-solid" placeholder="" name="f_name" value="<?php echo $row['f_name']?> <?php echo $row['l_name']?>">
						<!--end::Input-->
					<div class="fv-plugins-message-container invalid-feedback"></div>
				</div>
				
				<div class="col-md-12 fv-row fv-plugins-icon-container">
					<table class="table align-middle table-striped table-row-dashed fs-6 gy-5" width="100%">
						<thead>
							<th>Log Date</th>
							<th>Working Hour</th>
							<th>Rate</th>
							<th>Income</th>
						</thead>
						<tbody class="fw-bold text-gray">
							<?php
							$installment='0';
								$sql = "SELECT a.* FROM attendance_log a WHERE a.log_date BETWEEN '$from' AND '$to' AND a.e_id='$id' AND a.status='Approved' AND a.payroll_status!='1' ";
									$result = $conn->query($sql);

									if ($result->num_rows > 0) {
									  // output data of each row
									  while($row = $result->fetch_assoc()) {
									    ?>
									    	<tr>
									    		<td><?php echo $row['log_date']?></td>
													<td><?php echo $row['working_hour']?></td>
													<td><?php echo $row['e_rate']?></td>
													<td><?php echo $row['e_total_rate']?></td>
									    	</tr>
									    <?php
									  }

									  $sql = "SELECT * FROM loan_grant WHERE e_id='$id' AND status='Approved' ORDER BY id DESC LIMIT 1";
										$result = $conn->query($sql);

										

										if ($result->num_rows > 0) {
										  // output data of each row
										  while($row = $result->fetch_assoc()) {
										    $installment=number_format((float)($row['amount']/$row['installment_period']), 2, '.', '');
										    $loan_id=$row['id'];
										  }

										  
										}

										if($installment!=="0" AND $loan!==""){
											?>
												<tr class="text-warning">
													<td colspan="3" style="text-align: right;">Loan Deduction</td>
													<td><?php echo$installment?></td>
												</tr>
										  <?php

										  $salary=$salary-$installment;
										}
									} else {
									  echo "0 results";
									}

									

									?>
										<tr class="text-success">
												<td colspan="3" style="text-align: right;">Total Salary</td>
												<td><?php echo$salary?></td>
											</tr>
									<?php
							?>
							
						</tbody>
					</table>
				</div>		
       </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      	<?php

      	

					if($installment!=="0" AND $loan==""){
						?>
						<a type="button" class="btn btn-primary" href="<?php  echo$_GET['page']?>/pay_loan.php?id=<?php echo$id?>&month=<?php echo$month?>&day=<?php echo$days?>">Pay Loan</a>
						<?php
					}
      		if($salary!=="00"){
      			?>
      			
      				<button type="button" class="btn btn-success" onclick="document.getElementById('table_content').style.display='none';this.style.display='none';window.print();location.href='?page=generate_payslip'" >Generate</button>
      			<?php
      		}
      	?>
        
      </div>
      </form>
    </div>
  </div>
</div>
