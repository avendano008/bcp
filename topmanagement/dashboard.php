<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<div class="row">
	<div class="col-12 col-md-12">
		<!--begin::Statistics Widget 5-->
		<a href="#" class="card bg-white hoverable card-xl-stretch mb-xl-8">
			<!--begin::Body-->
			<div class="card-body">
				<canvas id="myChart"></canvas>
			</div>
			<!--end::Body-->
		</a>
		<!--end::Statistics Widget 5-->
	</div>
</div>
<script>
const xValues = ['Jan','Feb','Mar','Apr','May','June','July','Aug','Sep','Oct','Nov','Dec'];

new Chart("myChart", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{ 
      data: [860,1140,1060,1060,1070,1110,1330,2210,7830,2478,1330],
      borderColor: "red",
      fill: false
    }, { 
      data: [1600,1700,1700,1900,2000,2700,4000,5000,6000,7000,1900,2000],
      borderColor: "green",
      fill: false
    }, { 
      data: [300,700,2000,5000,6000,4000,2000,1000,200,100,6000,4000],
      borderColor: "blue",
      fill: false
    }]
  },
  options: {
    legend: {display: false}
  }
});
</script>

<div class="row g-5 g-xl-8">
	<div class="col-6 col-md-4">
		<!--begin::Statistics Widget 5-->
		<a href="#" class="card bg-white hoverable card-xl-stretch mb-xl-8">
			<!--begin::Body-->
			<div class="card-body">
				<!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm002.svg-->

				<i class="bi bi-people text-info" style="font-size: 40px;"></i>
				<label class="text-info" style="position: absolute;font-size: 30px;right: 20px;"><?php echo$row['employee']?></label>
				<!--end::Svg Icon-->
				<div class="text-info fw-bolder fs-2 mb-2 mt-5">Employees</div>
				<div class="fw-bold text-black"></div>
			</div>
			<!--end::Body-->
		</a>
		<!--end::Statistics Widget 5-->
	</div>
	<div class="col-6 col-md-4">
		<!--begin::Statistics Widget 5-->
		<a href="#" class="card bg-white hoverable card-xl-stretch mb-xl-8">
			<!--begin::Body-->
			<div class="card-body">
				<!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm008.svg-->
				<i class="bi bi-person-dash text-primary" style="font-size: 40px;"></i>
				<label class="text-primary" style="position: absolute;font-size: 30px;right: 20px;"><?php echo$row['leaves']?></label>
				<!--end::Svg Icon-->
				<div class="text-primary fw-bolder fs-2 mb-2 mt-5">Leaves</div>
				<div class="fw-bold text-black"></div>
			</div>
			<!--end::Body-->
		</a>
		<!--end::Statistics Widget 5-->
	</div>
	<div class="col-6 col-md-4">
		<!--begin::Statistics Widget 5-->
		<a href="#" class="card bg-info hoverable card-xl-stretch mb-xl-8">
			<!--begin::Body-->
			<div class="card-body text-center">
				<!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm002.svg-->

				
				<label class="text-white" style="font-size: 30px;"><?php echo$row['employee_archive']?></label>
				<!--end::Svg Icon-->
				<div class="text-white fw-bolder fs-2 mb-2 mt-5">Archive</div>
				<div class="fw-bold text-white"></div>
			</div>
			<!--end::Body-->
		</a>
		<!--end::Statistics Widget 5-->
	</div>
	
	
</div>



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
				<h2>Notice Board</h2>
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
							<th class="min-w-100px">Title</th>
							<th class="min-w-100px">Description</th>
							<th class="min-w-100px">Date</th>
							<th class="min-w-100px">Time</th>
						</tr>
						<!--end::Table row-->
					</thead>
					<!--end::Table head-->
					<!--begin::Table body-->
					<tbody class="fw-bold text-gray-600">
						<?php
							$sql = "SELECT * FROM hr_system_log ORDER BY id DESC";
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
										<?php echo$row['name']?>
									</td>
									<td class="pe-0">
										<?php echo$row['description']?>
									</td>
									<td class="pe-0">
										<?php echo$row['date_log']?>
									</td>
									<td class="pe-0">
										<?php echo$row['time_log']?>
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
