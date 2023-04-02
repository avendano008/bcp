<?php
	include'../connect/connect.php';

?>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css" />
<script src="https://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>





<h1 class="text-success">Employees List</h1><br>
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
				<!-- <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal"><i class="bi bi-plus" style="font-size: 25px;"></i> Add Employees</a> -->
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
							<th class="min-w-100px">Employee Name</th>
							<th class="min-w-100px">PIN</th>
							<th class="min-w-100px">Email</th>
							<th class="min-w-100px">Contact</th>
							<th class="min-w-100px">Gender</th>
							<th class="min-w-100px">Action</th>
						</tr>
						<!--end::Table row-->
					</thead>
					<!--end::Table head-->
					<!--begin::Table body-->
					<tbody class="fw-bold text-gray-600">

						<?php

							$sql = "SELECT * FROM hr_employee WHERE status='inactive' ORDER BY id DESC";
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
											<?php echo$row['code']?>
										</td>
										<td class="pe-0">
											<?php echo$row['email']?>
										</td>
										<td class="pe-0">
											<?php echo$row['cp_number']?>
										</td>
										<td class="pe-0">
											<?php echo$row['gender']?>
										</td>

										<td class="pe-0">
											<a href="?page=<?php echo$_GET['page']?>&restore=<?php echo$row['id']?>" class="btn btn-success"><i class="bi bi-check"></i></a>
											<!-- <a href="?page=<?php echo$_GET['page']?>&trash=<?php echo$row['id']?>" class="btn btn-danger"><i class="bi bi-trash"></i></a> -->
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
        <h4 class="modal-title">New Employees</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <div class="row">	
	     	<div class="col-md-6 fv-row fv-plugins-icon-container">
					<!--begin::Label-->
						<label class="required fs-5 fw-bold mb-2">First Name</label>
						<input type="text" class="form-control form-control-solid" placeholder="" name="f_name" required>
						<!--end::Input-->
					<div class="fv-plugins-message-container invalid-feedback"></div>
				</div>
				<div class="col-md-6 fv-row fv-plugins-icon-container">
					<!--begin::Label-->
						<label class="required fs-5 fw-bold mb-2">Last Name</label>
						<input type="text" class="form-control form-control-solid" placeholder="" name="l_name" required>
						<!--end::Input-->
					<div class="fv-plugins-message-container invalid-feedback"></div>
				</div>
				<div class="col-md-12 fv-row fv-plugins-icon-container">
					<!--begin::Label-->
						<label class="required fs-5 fw-bold mb-2">Employee Code</label>
						<input type="text" class="form-control form-control-solid" placeholder="" name="code" required>
						<!--end::Input-->
					<div class="fv-plugins-message-container invalid-feedback"></div>
				</div>
				<div class="col-md-6 fv-row fv-plugins-icon-container">
					<!--begin::Label-->
						<label class="required fs-5 fw-bold mb-2">Department</label>
						<select type="text" class="form-control form-control-solid" placeholder="" name="department" required>
							<?php
								$sql="SELECT * FROM hr_department ORDER BY id DESC";
								$result = $conn->query($sql);
								if ($result->num_rows > 0) {
								  // output data of each row
								  while($row = $result->fetch_assoc()) {
								    ?><option><?php echo$row['name']?></option><?php
								  }
								} else {
								  echo "<option></option>";
								}
							?>
						</select>
						<!--end::Input-->
					<div class="fv-plugins-message-container invalid-feedback"></div>
				</div>
				<div class="col-md-6 fv-row fv-plugins-icon-container">
					<!--begin::Label-->
						<label class="required fs-5 fw-bold mb-2">Designation</label>
						<select type="text" class="form-control form-control-solid" placeholder="" name="designation" required>
							<?php
								$sql="SELECT * FROM hr_designation ORDER BY id DESC";
								$result = $conn->query($sql);
								if ($result->num_rows > 0) {
								  // output data of each row
								  while($row = $result->fetch_assoc()) {
								    ?><option><?php echo$row['name']?></option><?php
								  }
								} else {
								  echo "<option></option>";
								}
							?>
						</select>
						<!--end::Input-->
					<div class="fv-plugins-message-container invalid-feedback"></div>
				</div>
				<div class="col-md-6 fv-row fv-plugins-icon-container">
					<!--begin::Label-->
						<label class="required fs-5 fw-bold mb-2">Gender</label>
						<select type="text" class="form-control form-control-solid" placeholder="" name="gender" required>
							<option>Male</option>
							<option>Female</option>
						</select>
						<!--end::Input-->
					<div class="fv-plugins-message-container invalid-feedback"></div>
				</div>
				<div class="col-md-6 fv-row fv-plugins-icon-container">
					<!--begin::Label-->
						<label class="required fs-5 fw-bold mb-2">Blood Group</label>
						<select type="text" class="form-control form-control-solid" placeholder="" name="blood_group" required>
							<option>O+</option>
							<option>O-</option>
							<option>A+</option>
							<option>A-</option>
							<option>B+</option>
							<option>B-</option>
							<option>AB+</option>
						</select>
						<!--end::Input-->
					<div class="fv-plugins-message-container invalid-feedback"></div>
				</div>
				<div class="col-md-6 fv-row fv-plugins-icon-container">
					<!--begin::Label-->
						<label class="required fs-5 fw-bold mb-2">Contact Number</label>
						<input type="number" class="form-control form-control-solid" placeholder="" name="cp_number" required>
						<!--end::Input-->
					<div class="fv-plugins-message-container invalid-feedback"></div>
				</div>
				<div class="col-md-6 fv-row fv-plugins-icon-container">
					<!--begin::Label-->
						<label class="required fs-5 fw-bold mb-2">Date of Birth</label>
						<input type="text" class="form-control form-control-solid" id="date_of_birth" placeholder="" name="date_of_birth" required>
						<!--end::Input-->
					<div class="fv-plugins-message-container invalid-feedback"></div>
				</div>
				<div class="col-md-6 fv-row fv-plugins-icon-container">
					<!--begin::Label-->
						<label class="required fs-5 fw-bold mb-2">Date of joining</label>
						<input type="date" class="form-control form-control-solid" placeholder="" name="date_of_joining" required>
						<!--end::Input-->
					<div class="fv-plugins-message-container invalid-feedback"></div>
				</div>
				<div class="col-md-6 fv-row fv-plugins-icon-container">
					<!--begin::Label-->
						<label class="required fs-5 fw-bold mb-2">Date of Leaving</label>
						<input type="date" class="form-control form-control-solid" placeholder="" name="date_of_leaving" required>
						<!--end::Input-->
					<div class="fv-plugins-message-container invalid-feedback"></div>
				</div>
				<div class="col-md-6 fv-row fv-plugins-icon-container">
					<!--begin::Label-->
						<label class="required fs-5 fw-bold mb-2">Rate per hour</label>
						<input type="number" class="form-control form-control-solid" placeholder="" name="rate_per_hour" required>
						<!--end::Input-->
					<div class="fv-plugins-message-container invalid-feedback"></div>
				</div>
				<div class="col-md-12 fv-row fv-plugins-icon-container">
					<!--begin::Label-->
						<label class="required fs-5 fw-bold mb-2">Username</label>
						<input type="text" class="form-control form-control-solid" placeholder="" name="username" required>
						<!--end::Input-->
					<div class="fv-plugins-message-container invalid-feedback"></div>
				</div>
				<div class="col-md-12 fv-row fv-plugins-icon-container">
					<!--begin::Label-->
						<label class="required fs-5 fw-bold mb-2">Email</label>
						<input type="email" class="form-control form-control-solid" placeholder="" name="email" required>
						<!--end::Input-->
					<div class="fv-plugins-message-container invalid-feedback"></div>
				</div>
				<div class="col-md-12 fv-row fv-plugins-icon-container">
					<!--begin::Label-->
						<label class="required fs-5 fw-bold mb-2">Password</label>
						<input type="password" class="form-control form-control-solid" placeholder="" name="pass" required>
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

	if(isset($_GET['edit']) || isset($_GET['trash']) || isset($_GET['restore'])){

			if(isset($_GET['edit'])){
				$id=$_GET['edit'];
			}else if(isset($_GET['restore'])){
				$id=$_GET['restore'];
			}else{
				$id=$_GET['trash'];
			}

			$sql = "SELECT * FROM hr_employee WHERE id='$id'";
			$result = $conn->query($sql);
			$row = $result->fetch_assoc();
			
	}else{
			$id="";
			
	}
?>
<div class="modal fade" id="myModaledit">
  <div class="modal-dialog">
    <div class="modal-content">
    	<form method="POST" action="<?php echo$_GET['page']?>/edit.php">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Update Employees</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <div class="row">	
	     	<div class="col-md-6 fv-row fv-plugins-icon-container">
					<!--begin::Label-->
						<label class="required fs-5 fw-bold mb-2">First Name</label>
						<input type="text" class="form-control form-control-solid" placeholder="" name="f_name" required value="<?php echo$row['f_name']?>">
						<input type="hidden" class="form-control form-control-solid" placeholder="" name="id" required value="<?php echo$row['id']?>">
						<input type="hidden" class="form-control form-control-solid" placeholder="" name="c_password" required value="<?php echo$row['pass']?>">
						<!--end::Input-->
					<div class="fv-plugins-message-container invalid-feedback"></div>
				</div>
				<div class="col-md-6 fv-row fv-plugins-icon-container">
					<!--begin::Label-->
						<label class="required fs-5 fw-bold mb-2">Last Name</label>
						<input type="text" class="form-control form-control-solid" placeholder="" name="l_name" required value="<?php echo$row['l_name']?>">
						<!--end::Input-->
					<div class="fv-plugins-message-container invalid-feedback"></div>
				</div>
				<div class="col-md-12 fv-row fv-plugins-icon-container">
					<!--begin::Label-->
						<label class="required fs-5 fw-bold mb-2">Employee Code</label>
						<input type="text" class="form-control form-control-solid" placeholder="" name="code" required value="<?php echo$row['code']?>">
						<!--end::Input-->
					<div class="fv-plugins-message-container invalid-feedback"></div>
				</div>
				<div class="col-md-6 fv-row fv-plugins-icon-container">
					<!--begin::Label-->
						<label class="required fs-5 fw-bold mb-2">Department</label>
						<select type="text" class="form-control form-control-solid" placeholder="" name="department" required >
							<option><?php echo$row['department']?></option>
							<?php
								$sql="SELECT * FROM hr_department ORDER BY id DESC";
								$result = $conn->query($sql);
								if ($result->num_rows > 0) {
								  // output data of each row
								  while($row1 = $result->fetch_assoc()) {
								    ?><option><?php echo$row1['name']?></option><?php
								  }
								} else {
								  echo "<option></option>";
								}
							?>
						</select>
						<!--end::Input-->
					<div class="fv-plugins-message-container invalid-feedback"></div>
				</div>
				<div class="col-md-6 fv-row fv-plugins-icon-container">
					<!--begin::Label-->
						<label class="required fs-5 fw-bold mb-2">Designation</label>
						<select type="text" class="form-control form-control-solid" placeholder="" name="designation" required >
							<option><?php echo$row['designation']?></option>
							<?php
								$sql="SELECT * FROM hr_designation ORDER BY id DESC";
								$result = $conn->query($sql);
								if ($result->num_rows > 0) {
								  // output data of each row
								  while($row2 = $result->fetch_assoc()) {
								    ?><option><?php echo$row2['name']?></option><?php
								  }
								} else {
								  echo "<option></option>";
								}
							?>
						</select>
						<!--end::Input-->
					<div class="fv-plugins-message-container invalid-feedback"></div>
				</div>
				<div class="col-md-6 fv-row fv-plugins-icon-container">
					<!--begin::Label-->
						<label class="required fs-5 fw-bold mb-2">Gender</label>
						<select type="text" class="form-control form-control-solid" placeholder="" name="gender" required value="<?php echo$row['gender']?>">
							<option>Male</option>
							<option>Female</option>
						</select>
						<!--end::Input-->
					<div class="fv-plugins-message-container invalid-feedback"></div>
				</div>
				<div class="col-md-6 fv-row fv-plugins-icon-container">
					<!--begin::Label-->
						<label class="required fs-5 fw-bold mb-2">Blood Group</label>
						<select type="text" class="form-control form-control-solid" placeholder="" name="blood_group" required value="<?php echo$row['blood_group']?>">
							<option>O+</option>
							<option>O-</option>
							<option>A+</option>
							<option>A-</option>
							<option>B+</option>
							<option>B-</option>
							<option>AB+</option>
						</select>
						<!--end::Input-->
					<div class="fv-plugins-message-container invalid-feedback"></div>
				</div>
				<div class="col-md-6 fv-row fv-plugins-icon-container">
					<!--begin::Label-->
						<label class="required fs-5 fw-bold mb-2">Contact Number</label>
						<input type="number" class="form-control form-control-solid" placeholder="" name="cp_number" required value="<?php echo$row['cp_number']?>">
						<!--end::Input-->
					<div class="fv-plugins-message-container invalid-feedback"></div>
				</div>
				<div class="col-md-6 fv-row fv-plugins-icon-container">
					<!--begin::Label-->
						<label class="required fs-5 fw-bold mb-2">Date of Birth</label>
						<input type="text" class="form-control form-control-solid" id="date_of_birth" placeholder="" name="date_of_birth" required value="<?php echo$row['date_of_birth']?>">
						<!--end::Input-->
					<div class="fv-plugins-message-container invalid-feedback"></div>
				</div>
				<div class="col-md-6 fv-row fv-plugins-icon-container">
					<!--begin::Label-->
						<label class="required fs-5 fw-bold mb-2">Date of joining</label>
						<input type="date" class="form-control form-control-solid" placeholder="" name="date_of_joining" required value="<?php echo$row['date_of_joining']?>">
						<!--end::Input-->
					<div class="fv-plugins-message-container invalid-feedback"></div>
				</div>
				<div class="col-md-6 fv-row fv-plugins-icon-container">
					<!--begin::Label-->
						<label class="required fs-5 fw-bold mb-2">Date of Leaving</label>
						<input type="date" class="form-control form-control-solid" placeholder="" name="date_of_leaving" required value="<?php echo$row['date_of_leaving']?>">
						<!--end::Input-->
					<div class="fv-plugins-message-container invalid-feedback"></div>
				</div>
				<div class="col-md-12 fv-row fv-plugins-icon-container">
					<!--begin::Label-->
						<label class="required fs-5 fw-bold mb-2">Rate per hour</label>
						<input type="number" class="form-control form-control-solid" placeholder="" name="rate_per_hour" required value="<?php echo$row['rate_per_hour']?>">
						<!--end::Input-->
					<div class="fv-plugins-message-container invalid-feedback"></div>
				</div>
				<div class="col-md-12 fv-row fv-plugins-icon-container">
					<!--begin::Label-->
						<label class="required fs-5 fw-bold mb-2">Username</label>
						<input type="text" class="form-control form-control-solid" placeholder="" name="username" required value="<?php echo$row['username']?>">
						<!--end::Input-->
					<div class="fv-plugins-message-container invalid-feedback"></div>
				</div>
				<div class="col-md-12 fv-row fv-plugins-icon-container">
					<!--begin::Label-->
						<label class="required fs-5 fw-bold mb-2">Email</label>
						<input type="email" class="form-control form-control-solid" placeholder="" name="email" required value="<?php echo$row['email']?>">
						<!--end::Input-->
					<div class="fv-plugins-message-container invalid-feedback"></div>
				</div>
				<div class="col-md-12 fv-row fv-plugins-icon-container">
					<!--begin::Label-->
						<label class="required fs-5 fw-bold mb-2">Password</label>
						<input type="password" class="form-control form-control-solid" placeholder="" name="pass" required value="<?php echo$row['pass']?>">
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
    	<form method="POST" action="<?php echo$_GET['page']?>/archive.php">
      <!-- Modal Header -->
      <div class="modal-header">
        <h1 class="modal-title text-danger"><i class="bi bi-exclamation-triangle text-danger" style="font-size:30px;"></i></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      	
      	<h1 class="modal-title text-danger">Do you wanna Disabled this?</h1>
      	<label class="text-warning">Warning!</label> 
      	<label class="text-danger">It will be store in archive</label>
      <div class="row">	
	      <div class="col-md-12 fv-row fv-plugins-icon-container">
			<!--begin::Label-->
				<label class="required fs-5 fw-bold mb-2">Employees Name</label>
				<input type="text" class="form-control form-control-solid" placeholder="" name="f_name" disabled required value="<?php echo$row['f_name']?> <?php echo$row['l_name']?>">
				<input type="hidden" class="form-control form-control-solid" placeholder="" name="id" required value="<?php echo$row['id']?>">
				<!--end::Input-->
			<div class="fv-plugins-message-container invalid-feedback"></div>
		</div>
      </div>
    </div>
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger" >Accept</button>
      </div>
      </form>
    </div>
  </div>
</div>



<div class="modal fade" id="myModaltrash">
  <div class="modal-dialog">
    <div class="modal-content">
    	<form method="POST" action="<?php echo$_GET['page']?>/restore.php">
      <!-- Modal Header -->
      <div class="modal-header">
        <h1 class="modal-title text-danger"><i class="bi bi-exclamation-triangle text-danger" style="font-size:30px;"></i></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      	
      	<h1 class="modal-title text-danger">Do you wanna Disabled this?</h1>
      	<label class="text-warning">Warning!</label> 
      	<label class="text-danger">It will be store in archive</label>
      <div class="row">	
	      <div class="col-md-12 fv-row fv-plugins-icon-container">
			<!--begin::Label-->
				<label class="required fs-5 fw-bold mb-2">Employees Name</label>
				<input type="text" class="form-control form-control-solid" placeholder="" name="f_name" disabled required value="<?php echo$row['f_name']?> <?php echo$row['l_name']?>">
				<input type="hidden" class="form-control form-control-solid" placeholder="" name="id" required value="<?php echo$row['id']?>">
				<!--end::Input-->
			<div class="fv-plugins-message-container invalid-feedback"></div>
		</div>
      </div>
    </div>
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger" >Accept</button>
      </div>
      </form>
    </div>
  </div>
</div>


<div class="modal fade" id="myModalrestore">
  <div class="modal-dialog">
    <div class="modal-content">
    	<form method="POST" action="<?php echo$_GET['page']?>/archive.php">
      <!-- Modal Header -->
      <div class="modal-header">
        <h1 class="modal-title text-success"><i class="bi bi-exclamation-triangle text-success" style="font-size:30px;"></i></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      	
      	<h1 class="modal-title text-success">Do you wanna Restore this?</h1>
      	<label class="text-warning">Warning!</label> 
      	<label class="text-success">It will be store in Employee List</label>
      <div class="row">	
	      <div class="col-md-12 fv-row fv-plugins-icon-container">
			<!--begin::Label-->
				<label class="required fs-5 fw-bold mb-2">Employees Name</label>
				<input type="text" class="form-control form-control-solid" placeholder="" name="f_name" disabled required value="<?php echo$row['f_name']?> <?php echo$row['l_name']?>">
				<input type="hidden" class="form-control form-control-solid" placeholder="" name="id" required value="<?php echo$row['id']?>">
				<!--end::Input-->
			<div class="fv-plugins-message-container invalid-feedback"></div>
		</div>
      </div>
    </div>
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-success" >Accept</button>
      </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
	$("#date_of_birth").datepicker( { dateFormat: 'dd/mm/yy', maxDate: '-13Y' });

</script>