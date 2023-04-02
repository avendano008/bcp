<h1 class="text-success">Grant Loan List</h1><br>
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
				<a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal"><i class="bi bi-plus" style="font-size: 25px;"></i> Add Loan</a>
				<!--end::Add product-->
			</div>
			<!--end::Card toolbar-->
		</div>
		<!--begin::Card body-->
		<div class="card-body pt-0">
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
							<th class="min-w-100px">Name</th>
							<th class="min-w-100px">Amount</th>
							<th class="min-w-100px">Installment</th>
							<th class="min-w-100px">Total Pay</th>
							<!-- <th class="min-w-100px">Total Due</th> -->
							<th class="min-w-100px">Approve Date</th>
							<th class="min-w-100px">Status</th>
							<th class="min-w-100px">Action</th>
						</tr>
						<!--end::Table row-->
					</thead>
					<!--end::Table head-->
					<!--begin::Table body-->
					<tbody class="fw-bold text-gray-600">
						<?php
							$sql = "SELECT l.*,
							(SELECT f_name FROM employee WHERE id=l.e_id) AS f_name,
							(SELECT l_name FROM employee WHERE id=l.e_id) AS l_name,
							IFNULL((SELECT SUM(total_pay) FROM loan_grant_payroll WHERE loan_id=l.id),'00') AS total_pay
							 FROM loan_grant l WHERE status='Approved'";
							$result = $conn->query($sql);

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
										<?php echo$row['amount']?>
									</td>
									<td class="pe-0">
										<?php echo  number_format((float)($row['amount']/$row['installment_period']), 2, '.', '')?>
									</td>
									<td class="pe-0">
										<?php echo  number_format((float)($row['total_pay']), 2, '.', '')?>
									</td>
									<!-- <td class="pe-0">
										Test 1
									</td> -->
									<td class="pe-0">
										<?php echo$row['approved_date']?>
									</td>
									<td class="pe-0">
										<?php echo$row['status']?>
									</td>
									<td class="pe-0">
										<a href="?page=<?php echo$_GET['page']?>&trash=<?php echo$row['id']?>" class="btn btn-danger"><i class="bi bi-trash"></i>archive</a>
										
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


<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
    	<form method="POST" action="<?php echo$_GET['page']?>/add.php">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">New Loan</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <div class="row">	
	     	<div class="col-md-12 fv-row fv-plugins-icon-container">
					<!--begin::Label-->
						<label class="required fs-5 fw-bold mb-2">Assign to</label>
						<select type="text" class="form-control form-control-solid" placeholder="" name="e_id" required>
							<option></option>
							<?php
								$sql = "SELECT * FROM employee";
								$result = $conn->query($sql);

								if ($result->num_rows > 0) {
								  // output data of each row
								  while($row = $result->fetch_assoc()) {
								    ?>
								    <option value="<?php echo$row['id']?>"><?php echo$row['f_name']?> <?php echo$row['l_name']?></option>
								    <?php
								  }
								} else {
								  echo "0 results";
								}
							?>
						</select>
						<!--end::Input-->
					<div class="fv-plugins-message-container invalid-feedback"></div>
				</div>
				<div class="col-md-12 fv-row fv-plugins-icon-container">
					<!--begin::Label-->
						<label class="required fs-5 fw-bold mb-2">Amount</label>
						<input type="number" class="form-control form-control-solid" placeholder="" name="amount" required value="">
						
					<div class="fv-plugins-message-container invalid-feedback"></div>
				</div>
				<div class="col-md-12 fv-row fv-plugins-icon-container">
					<!--begin::Label-->
						<label class="required fs-5 fw-bold mb-2">Approved Date</label>
						<input type="date" class="form-control form-control-solid" placeholder="" name="approved_date" required value="">
						<!--end::Input-->
					<div class="fv-plugins-message-container invalid-feedback"></div>
				</div>
				<div class="col-md-12 fv-row fv-plugins-icon-container">
					<!--begin::Label-->
						<label class="required fs-5 fw-bold mb-2">Install Period</label>
						<input type="number" class="form-control form-control-solid" placeholder="" name="installment_period" required value="">
						<!--end::Input-->
					<div class="fv-plugins-message-container invalid-feedback"></div>
				</div>
				<div class="col-md-12 fv-row fv-plugins-icon-container">
					<!--begin::Label-->
						<label class="required fs-5 fw-bold mb-2">Loan Number</label>
						<input type="number" class="form-control form-control-solid" placeholder="" name="loan_number" required value="">
						<!--end::Input-->
					<div class="fv-plugins-message-container invalid-feedback"></div>
				</div>
				<div class="col-md-12 fv-row fv-plugins-icon-container">
					<!--begin::Label-->
						<label class="required fs-5 fw-bold mb-2">Status</label>
						<select type="date" class="form-control form-control-solid" placeholder="" name="status" required value="">
							<option>Approved</option>
							<!-- <option>Declined</option> -->
						</select>
						<!--end::Input-->
					<div class="fv-plugins-message-container invalid-feedback"></div>
				</div>
				<div class="col-md-12 fv-row fv-plugins-icon-container">
					<!--begin::Label-->
						<label class="required fs-5 fw-bold mb-2">Remarks</label>
						<textarea type="date" class="form-control form-control-solid" name="remarks" required placeholder="Please Reason of Loan"></textarea>
						<!--end::Input-->
					<div class="fv-plugins-message-container invalid-feedback"></div>
				</div>
       </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" >Add</button>
      </div>
      </form>
    </div>
  </div>
</div>

<?php

	if(isset($_GET['edit']) || isset($_GET['trash'])){

			if(isset($_GET['edit'])){
				$id=$_GET['edit'];
			}else{
				$id=$_GET['trash'];
			}

			$sql = "SELECT l.*,
			(SELECT f_name FROM employee WHERE id=l.e_id) AS f_name,
			(SELECT l_name FROM employee WHERE id=l.e_id) AS l_name

			FROM loan_grant l WHERE l.id='$id'";
			$result = $conn->query($sql);
			$row = $result->fetch_assoc();
			
	}else{
			$id="";
			
	}
?>

<div class="modal fade" id="myModaledit">
  <div class="modal-dialog">
    <div class="modal-content">
    	<form method="POST" action="<?php echo$_GET['page']?>/add.php">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Update Loan</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <div class="row">
      	<div class="col-md-12 fv-row fv-plugins-icon-container">
					<!--begin::Label-->
						<label class="required fs-5 fw-bold mb-2">Name</label>
						<h3 class="text-success"><?php echo$row['f_name']?> <?php echo$row['l_name']?></h3>
						
					<div class="fv-plugins-message-container invalid-feedback"></div>
				</div>
				<div class="col-md-12 fv-row fv-plugins-icon-container">
					<!--begin::Label-->
						<label class="required fs-5 fw-bold mb-2">Amount</label>
						<h3 class="text-success"><?php echo$row['amount']?></h3>
						
					<div class="fv-plugins-message-container invalid-feedback"></div>
				</div>
				<div class="col-md-12 fv-row fv-plugins-icon-container">
					<!--begin::Label-->
						<label class="required fs-5 fw-bold mb-2">Approved Date</label><br>
						<h3 class="text-success"><?php echo$row['approved_date']?></h3>
						<!--end::Input-->
					<div class="fv-plugins-message-container invalid-feedback"></div>
				</div>
				<div class="col-md-12 fv-row fv-plugins-icon-container">
					<!--begin::Label-->
						<label class="required fs-5 fw-bold mb-2">Install Period</label>
						<h3 class="text-success"><?php echo$row['installment_period']?></h3>
						<!--end::Input-->
					<div class="fv-plugins-message-container invalid-feedback"></div>
				</div>
				<div class="col-md-12 fv-row fv-plugins-icon-container">
					<!--begin::Label-->
						<label class="required fs-5 fw-bold mb-2">Loan Number</label>
						<h3 class="text-success"><?php echo$row['loan_number']?></h3>
						<!--end::Input-->
					<div class="fv-plugins-message-container invalid-feedback"></div>
				</div>
				<div class="col-md-12 fv-row fv-plugins-icon-container">
					<!--begin::Label-->
						<label class="required fs-5 fw-bold mb-2">Status</label>
						<h3 class="text-success"><?php echo$row['status']?></h3>
						<!--end::Input-->
					<div class="fv-plugins-message-container invalid-feedback"></div>
				</div>
				<div class="col-md-12 fv-row fv-plugins-icon-container">
					<!--begin::Label-->
						<label class="required fs-5 fw-bold mb-2">Remarks</label>
						<textarea type="date" class="form-control form-control-solid" name="remarks" required placeholder="Please Reason of Loan"><?php echo$row['remarks']?></textarea>
						<!--end::Input-->
					<div class="fv-plugins-message-container invalid-feedback"></div>
				</div>
       </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" >Save</button>
      </div>
      </form>
    </div>
  </div>
</div>



<div class="modal fade" id="myModaltrash">
  <div class="modal-dialog">
    <div class="modal-content">
    	<form method="POST" action="<?php echo$_GET['page']?>/delete.php">
      <!-- Modal Header -->
      <div class="modal-header">
        <h1 class="modal-title text-danger"><i class="bi bi-exclamation-triangle text-danger" style="font-size:30px;"></i></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      	
      	<h1 class="modal-title text-danger">Do you wanna disabled this loan?</h1>
      	<label class="text-warning">Warning!</label> <label class="text-danger">No turning back</label>
      <div class="row">	
	      <div class="col-md-12 fv-row fv-plugins-icon-container">
			<!--begin::Label-->
				<label class="required fs-5 fw-bold mb-2">Archive Name</label>
				<input type="text" class="form-control form-control-solid" placeholder="" disabled required value="<?php echo$row['f_name']?> <?php echo$row['l_name']?>">
				<input type="hidden" name="id" value="<?php echo$row['id']?>">
				<!--end::Input-->
			<div class="fv-plugins-message-container invalid-feedback"></div>
		</div>
      </div>
    </div>
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger">Accept</button>
      </div>
      </form>
    </div>
  </div>
</div>