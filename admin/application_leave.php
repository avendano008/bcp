
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css" />
<script src="https://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
<h1 class="text-success">Leave Application List</h1><br>
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
				<!-- <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal"><i class="bi bi-plus" style="font-size: 25px;"></i>Add Leave Application</a> -->
				<!-- <a href="#" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#myModal"><i class="bi bi-plus" style="font-size: 25px;"></i>Add Bulk Attendance</a> -->
				<!-- <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal"><i class="bi bi-plus" style="font-size: 25px;"></i>Add Report</a> -->
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
							<th class="min-w-100px">Employee name</th>
							<th class="min-w-100px">Leave Type</th>
							<th class="min-w-100px">Request of Application</th>
							<th class="min-w-100px">Remarks</th>
							<th class="min-w-100px">Action</th>
						</tr>
						<!--end::Table row-->
					</thead>
					<!--end::Table head-->
					<!--begin::Table body-->
					<tbody class="fw-bold text-gray-600">
						<?php
							$sql = "SELECT l.*,(SELECT type FROM leaves_type t WHERE t.id=l.leave_type_id) AS leave_type,(SELECT f_name FROM employee e WHERE e.id=l.e_id) AS f_name,(SELECT l_name FROM employee e WHERE e.id=l.e_id) AS l_name FROM leaves_application l ORDER BY id DESC";
								$result = $conn->query($sql);

								if ($result->num_rows > 0) {
								  // output data of each row
								  while($row1 = $result->fetch_assoc()) {
								    ?>
								    <tr>
											<td>
												<div class="form-check form-check-sm form-check-custom form-check-solid">
													<input class="form-check-input" type="checkbox" value="1" />
												</div>
											</td>
											<td class="pe-0">
												<?php echo$row1['f_name']?> <?php echo$row1['l_name']?>
											</td>
											<td class="pe-0">
												<?php echo$row1['leave_type']?>
											</td>
											<td class="pe-0">
												<?php echo$row1['request_of_application']?>
											</td>
											<td class="pe-0">
												<?php echo$row1['remarks']?>
											</td>
											<td class="pe-0">
												<!-- <a href="?page=<?php echo$_GET['page']?>&edit=" class="btn btn-primary"><i class="bi bi-check"></i>Edit</a> -->
												<?php
													if($row1['status']=="Approved" || $row1['status']=="Declined"){
														echo$row1['status'];
													}else{
														?>
															<a href="?page=<?php echo$_GET['page']?>&approved=<?php echo$row1['id']?>" class="btn btn-primary"><i class="bi bi-check"></i>Approved</a>
															<a href="?page=<?php echo$_GET['page']?>&declined=<?php echo$row1['id']?>" class="btn btn-info"><i class="bi bi-trash"></i>Declined</a>
														<?php
													}
												?>
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
        <h4 class="modal-title">New Application Leave</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <div class="row">	
	     	<div class="col-md-6 fv-row fv-plugins-icon-container">
					<!--begin::Label-->
						<label class="required fs-5 fw-bold mb-2">Leave Type</label>
						<select type="text" class="form-control form-control-solid" placeholder="" name="leave_type_id" required>
							<option></option>
							<?php
								$sql = "SELECT * FROM leaves_type";
									$result = $conn->query($sql);

									if ($result->num_rows > 0) {
									  // output data of each row
									  while($row = $result->fetch_assoc()) {
									   ?>
									   	<option value="<?php echo$row['id']?>"><?php echo$row['type']?></option>
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
				<div class="col-md-6 fv-row fv-plugins-icon-container">
					<!--begin::Label-->
						<label class="required fs-5 fw-bold mb-2">Request of Application</label>
						<input type="date" class="form-control form-control-solid" placeholder="" name="request_of_application" required>
						<!--end::Input-->
					<div class="fv-plugins-message-container invalid-feedback"></div>
				</div>
				<div class="col-md-12 fv-row fv-plugins-icon-container">
					<!--begin::Label-->
						<label class="required fs-5 fw-bold mb-2">Remarks</label>
						<textarea type="text" class="form-control form-control-solid" name="remarks" placeholder="Reason of application" required></textarea>
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


<div class="modal fade" id="myModaledit">
  <div class="modal-dialog">
    <div class="modal-content">
    	<form method="POST" action="counselor/update.php">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Update Attendance</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <div class="row">	
	      <div class="col-md-12 fv-row fv-plugins-icon-container">
			<!--begin::Label-->
				<label class="required fs-5 fw-bold mb-2">Attendance Name</label>
				<input type="text" class="form-control form-control-solid" placeholder="" name="f_name" required value="">
				<input type="hidden" name="id" value="">
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


<?php

	if(isset($_GET['edit']) || isset($_GET['trash'])){

			if(isset($_GET['edit'])){
				$id=$_GET['edit'];
			}else{
				$id=$_GET['trash'];
			}

			$sql = "SELECT * FROM leaves_application WHERE id='$id'";
			$result = $conn->query($sql);
			$row = $result->fetch_assoc();
			
	}else{
			$id="";
			
	}
?>

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
      	
      	<h1 class="modal-title text-danger">Do you wanna delete this?</h1>
      	<label class="text-warning">Warning!</label> <label class="text-danger">No turning back</label>
      <div class="row">	
	      <div class="col-md-12 fv-row fv-plugins-icon-container">
			<!--begin::Label-->
				<label class="required fs-5 fw-bold mb-2">Application leave</label>
				<input type="text" class="form-control form-control-solid" placeholder="" name="f_name" id="" disabled required value="Date:<?php echo$row['request_of_application']?> "><br>
				<textarea type="text" class="form-control form-control-solid" placeholder="" name="f_name" id="" disabled required><?php echo$row['remarks']?></textarea>
				<input type="hidden" name="id" value="<?php echo$id?>">
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

<script type="text/javascript">
	$("#log_date").datepicker( { dateFormat: 'dd/mm/yy', maxDate: '-0Y' });

</script>

<?php
		if(isset($_GET['approved'])){
			$id=$_GET['approved'];

			$sql = "UPDATE leaves_application SET status='Approved' WHERE id='$id'";

			if ($conn->query($sql) === TRUE) {

						$title="Leave-Application";
							$description="Leave has been Approved";

							$sql = "INSERT INTO system_log (name, description, date_log, time_log)
									VALUES ('$title', '$description', '$datestamp', '$timestamp')";
							$conn->query($sql);
			  ?>
			  <script type="text/javascript">
			  	alert('Application has been approved');
			  	location.href="./?page=application_leave";
			  </script>
			  <?php
			} else {
			  echo "Error updating record: " . $conn->error;
			}
		}

		if(isset($_GET['declined'])){
			$id=$_GET['declined'];

			$sql = "UPDATE leaves_application SET status='Declined' WHERE id='$id'";

			if ($conn->query($sql) === TRUE) {

							$title="Leave-Application";
							$description="Leave has been Declined";

							$sql = "INSERT INTO system_log (name, description, date_log, time_log)
									VALUES ('$title', '$description', '$datestamp', '$timestamp')";
							$conn->query($sql);
			  ?>
			  <script type="text/javascript">
			  	alert('Application has been Declined');
			  	location.href="./?page=application_leave";
			  </script>
			  <?php
			} else {
			  echo "Error updating record: " . $conn->error;
			}
		}
?>