<?php
include'../connect/connect.php';
session_start();


if(isset($_SESSION['user_id'])) {
	if($_SESSION['user_type']=='hr' || $_SESSION['user_type']=='background'){
		$id=$_SESSION['user_id'];
		$fullname=$_SESSION['f_name']." ".$_SESSION['l_name'];
		$_SESSION['user_type']='hr';
		
		$sql = "SELECT a.*,
		IFNULL((SELECT name FROM hr_images i WHERE i.user_id=a.id AND user_type='hr' ORDER BY i.id DESC LIMIT 1),'default.png') AS image,
		(SELECT COUNT(id) FROM hr_employee WHERE status='active') AS employee,
		(SELECT COUNT(id) FROM hr_employee WHERE status='inactive') AS employee_archive,
		(SELECT COUNT(id) FROM hr_leaves_application WHERE status='Approved') AS leaves
		 FROM hr_admin a WHERE id='$id'";
		$result = $conn->query($sql);

		$row = $result->fetch_assoc();
		?>
<html lang="en">
	<!--begin::Head-->
	<head><base href="">
		<title><?php
								if(isset($_GET['page'])){
									$page=$_GET['page'];
									echo str_replace('_', ' ', $page);
								}else{
									echo"Dashboard";
								}
							?></title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Page Vendor Stylesheets(used by this page)-->
		<link href="../assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
		<link href="../assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Page Vendor Stylesheets-->
		<!--begin::Global Stylesheets Bundle(used by all pages)-->
		<link href="../assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="../assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<script src="../assets/js/chart.js"></script>
		<!--end::Global Stylesheets Bundle-->
		<style type="text/css">
			@media (max-width: 399px) { 
			    .display_hide{
			      display: none !important;
			    }
			}
		</style>
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed">
		<!--begin::Main-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="page d-flex flex-row flex-column-fluid">
				<!--begin::Aside-->
				<div id="kt_aside" style="background: white;" class="aside pb-5 pt-5 pt-lg-0" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'80px', '300px': '100px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
					<!--begin::Brand-->
					<div class="aside-logo py-8" id="kt_aside_logo" style="background: white;">
						<!--begin::Logo-->
						<a href="../" class="d-flex align-items-center">
							<img alt="Logo" src="../img/logo.png" class="h-80px logo" />
						</a>
						<!--end::Logo-->
					</div>
					<!--end::Brand-->
					<!--begin::Aside menu-->
					<div class="aside-menu flex-column-fluid" id="kt_aside_menu">
						<!--begin::Aside Menu-->
						<div class="hover-scroll-overlay-y my-2 my-lg-5 pe-lg-n1" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside, #kt_aside_menu" data-kt-scroll-offset="5px">
							<!--begin::Menu-->
							<div class="menu menu-column menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500 fw-bold" id="#kt_aside_menu" data-kt-menu="true">
								<div data-kt-menu-trigger="click" data-kt-menu-placement="right-start" class="menu-item here show py-2">
									<span class="menu-link menu-center" title="Dashboard" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
										<span class="menu-icon me-0">
											<i class="bi bi-speedometer fs-2 "></i>
										</span>
										<span class="menu-title text-black">Dashboard</span>
									</span>
									<div class="menu-sub menu-sub-dropdown w-225px w-lg-275px px-1 py-4">
										<div class="menu-item">
											<a class="menu-link active" href="./">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Main</span>
											</a>
										</div>
									</div>
								</div>
								
							</div>
							<div class="menu menu-column menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500 fw-bold" id="#kt_aside_menu" data-kt-menu="true">
								<div data-kt-menu-trigger="click" data-kt-menu-placement="right-start" class="menu-item here show py-2">
									<span class="menu-link menu-center" title="Organization" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
										<span class="menu-icon me-0">
											<i class="bi bi-list fs-2 "></i>
										</span>
										<span class="menu-title text-black">Organization</span>
									</span>
									<div class="menu-sub menu-sub-dropdown w-225px w-lg-275px px-1 py-4">
										<div class="menu-item">
											<a class="menu-link active" href="./?page=department">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Department</span>
											</a>
											<a class="menu-link active" href="./?page=designation">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Designation</span>
											</a>
										</div>
									</div>
								</div>
								
							</div>
							<div class="menu menu-column menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500 fw-bold" id="#kt_aside_menu" data-kt-menu="true">
								<div data-kt-menu-trigger="click" data-kt-menu-placement="right-start" class="menu-item here show py-2">
									<span class="menu-link menu-center" title="Employees" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
										<span class="menu-icon me-0">
											<i class="bi bi-people fs-2 "></i>
										</span>
										<span class="menu-title text-black">Employees</span>
									</span>
									<div class="menu-sub menu-sub-dropdown w-225px w-lg-275px px-1 py-4">
										<div class="menu-item">
											<a class="menu-link active" href="./?page=employees">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Employees</span>
											</a>
											<!-- <a class="menu-link active" href="./?page=disciplinary">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Disciplinary</span>
											</a> -->
											<a class="menu-link active" href="./?page=archive">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Archive</span>
											</a>
										</div>
									</div>
								</div>
								
							</div>
							<!-- <div class="menu menu-column menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500 fw-bold" id="#kt_aside_menu" data-kt-menu="true">
								<div data-kt-menu-trigger="click" data-kt-menu-placement="right-start" class="menu-item here show py-2">
									<span class="menu-link menu-center" title="Attendance" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
										<span class="menu-icon me-0">
											<i class="bi bi-journal-check fs-2 "></i>
										</span>
										<span class="menu-title text-black">Attendance</span>
									</span>
									<div class="menu-sub menu-sub-dropdown w-225px w-lg-275px px-1 py-4">
										<div class="menu-item">
											<a class="menu-link active" href="./?page=list_attendance">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">List</span>
											</a>
											
											<a class="menu-link active" href="./?page=report_attendance">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Report</span>
											</a>
										</div>
									</div>
								</div>
							</div>
							<div class="menu menu-column menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500 fw-bold" id="#kt_aside_menu" data-kt-menu="true">
								<div data-kt-menu-trigger="click" data-kt-menu-placement="right-start" class="menu-item here show py-2">
									<span class="menu-link menu-center" title="Payroll" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
										<span class="menu-icon me-0">
											<i class="bi bi-currency-exchange fs-2 "></i>
										</span>
										<span class="menu-title text-black">Payroll</span>
									</span>
									<div class="menu-sub menu-sub-dropdown w-225px w-lg-275px px-1 py-4">
										<div class="menu-item">
											
											<a class="menu-link active" href="./?page=generate_payslip">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Generate Payslip</span>
											</a>
											<a class="menu-link active" href="./?page=list_payroll">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">List</span>
											</a>
											<a class="menu-link active" href="./?page=report_payroll">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Report</span>
											</a>
										</div>
									</div>
								</div>
							</div> -->
							<div class="menu menu-column menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500 fw-bold" id="#kt_aside_menu" data-kt-menu="true">
								<div data-kt-menu-trigger="click" data-kt-menu-placement="right-start" class="menu-item here show py-2">
									<span class="menu-link menu-center" title="Leave" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
										<span class="menu-icon me-0">
											<i class="bi bi-person-dash fs-2 "></i>
										</span>
										<span class="menu-title text-black">Leave</span>
									</span>
									<div class="menu-sub menu-sub-dropdown w-225px w-lg-275px px-1 py-4">
										<div class="menu-item">
											
											 <a class="menu-link active" href="./?page=leave_type">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Type</span>
											</a>
											<a class="menu-link active" href="./?page=application_leave">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Application</span>
											</a>
											<!-- <a class="menu-link active" href="./?page=earn_leave">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Earn</span>
											</a>
											<a class="menu-link active" href="./?page=report_leave">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Report</span> 
											</a> -->
										</div>
									</div>
								</div>
							</div>
							  
							<div class="menu menu-column menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500 fw-bold" id="#kt_aside_menu" data-kt-menu="true">
								<div data-kt-menu-trigger="click" data-kt-menu-placement="right-start" class="menu-item here show py-2">
									<span class="menu-link menu-center" title="Compensation" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
										<span class="menu-icon me-0">
											<i class="bi bi-credit-card fs-2 "></i>
										</span>
										<span class="menu-title text-black">Compensation</span>
									</span>
									<div class="menu-sub menu-sub-dropdown w-225px w-lg-275px px-1 py-4">
										<div class="menu-item">
											<a class="menu-link active" href="./?page=holiday_leave">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Holiday Pay</span>
											</a>
										</div>
										<div class="menu-item">
											<a class="menu-link active" href="./?page=manatory_benefits">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Mandatory Benefits</span>
											</a>
										</div>
										<div class="menu-item">
											<a class="menu-link active" href="./?page=service_incentive">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Service Incentive</span>
											</a>
										</div>
										<div class="menu-item">
											<a class="menu-link active" href="./?page=institutional_benefits">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Institutional Benefits</span>
											</a>
										</div>
										<div class="menu-item">
											<a class="menu-link active" href="./?page=avon_member">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Avon Member</span>
											</a>
										</div>
										<div class="menu-item">
											<a class="menu-link active" href="./?page=bonus">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Bonus</span>
											</a>
										</div>
									</div>
								</div>
							</div>
							<div class="menu menu-column menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500 fw-bold" id="#kt_aside_menu" data-kt-menu="true">
								<div data-kt-menu-trigger="click" data-kt-menu-placement="right-start" class="menu-item here show py-2">
									<span class="menu-link menu-center" title="Promotion" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
										<span class="menu-icon me-0">
											<i class="bi bi-bookmark-check fs-2 "></i>
										</span>
										<span class="menu-title text-black">Promotion</span>
									</span>
									<div class="menu-sub menu-sub-dropdown w-225px w-lg-275px px-1 py-4">
										<div class="menu-item">
											
											 <a class="menu-link active" href="./?page=promotion">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Employee</span>
											</a>
											
										</div>
									</div>
								</div>
							</div>
							<!--
							<div class="menu menu-column menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500 fw-bold" id="#kt_aside_menu" data-kt-menu="true">
								<div data-kt-menu-trigger="click" data-kt-menu-placement="right-start" class="menu-item here show py-2">
									<span class="menu-link menu-center" title="Notice" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
										<span class="menu-icon me-0">
											<i class="bi bi-exclamation-diamond-fill fs-2 "></i>
										</span>
										<span class="menu-title text-black">Notice</span>
									</span>
									<div class="menu-sub menu-sub-dropdown w-225px w-lg-275px px-1 py-4">
										<div class="menu-item">
											<a class="menu-link active" href="./?page=notice">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">List</span>
											</a>
										</div>
									</div>
								</div>
							</div> -->
							<!--<div class="menu menu-column menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500 fw-bold" id="#kt_aside_menu" data-kt-menu="true">
								<div data-kt-menu-trigger="click" data-kt-menu-placement="right-start" class="menu-item here show py-2">
									<span class="menu-link menu-center" title="Setting" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
										<span class="menu-icon me-0">
											<i class="bi bi-gear fs-2 "></i>
										</span>
										<span class="menu-title text-black">Setting</span>
									</span>
									<div class="menu-sub menu-sub-dropdown w-225px w-lg-275px px-1 py-4">
										<div class="menu-item">
											<a class="menu-link active" href="./?page=setting">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">View</span>
											</a>
										</div>
									</div>
								</div>
							</div> -->
							<div class="menu menu-column menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500 fw-bold" id="#kt_aside_menu" data-kt-menu="true">
								<div data-kt-menu-trigger="click" data-kt-menu-placement="right-start" class="menu-item here show py-2">
									<span class="menu-link menu-center" title="Back to Login" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
										<span class="menu-icon me-0">
											<i class="bi bi-arrow-left fs-2 "></i>
										</span>
										<span class="menu-title text-black">Logout</span>
									</span>
									<div class="menu-sub menu-sub-dropdown w-225px w-lg-275px px-1 py-4">
										<div class="menu-item">
											<a class="menu-link active" href="?page=logout">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Yes?</span>
											</a>
										</div>
									</div>
								</div>
							</div>
							<!--end::Menu-->
						</div>
						<!--end::Aside Menu-->
					</div>
					<!--end::Aside menu-->
				</div>
				<!--end::Aside-->
				<!--begin::Wrapper-->
				<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
					<!--begin::Header-->
					<div id="kt_header" style="background: white;" class="header align-items-stretch">
						<div class="d-flex align-items-center d-lg-none ms-n1 me-2" title="Show aside menu">
								<div class="btn btn-icon btn-active-color-primary w-30px h-30px w-md-40px h-md-40px" id="kt_aside_mobile_toggle">
									<!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
									<span class="svg-icon svg-icon-1">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
											<path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="currentColor"></path>
											<path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="currentColor"></path>
										</svg>
									</span>
									<!--end::Svg Icon-->
								</div>
							</div>
						<h1 style="padding: 15px; text-transform: uppercase;" class=""> 
							<?php
								if(isset($_GET['page'])){
									$page=$_GET['page'];
									echo str_replace('_', ' ', $page);
								}else{
									echo"Dashboard";
								}

							?>
						</h1>
						<!--begin::Mobile logo-->
							<div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
								<a href="../img/logo.png" class="d-lg-none">
									<img alt="Logo" src="../img/logo.png" class="h-30px" />
								</a>
							</div>
							<!--end::Mobile logo-->
							<!--begin::Toolbar wrapper-->
								<div class="d-flex align-items-stretch flex-shrink-0" style="margin-right: 10px;">
									<!--begin::Search-->
									<div class="d-flex align-items-stretch ms-1 ms-lg-3">
										<!--begin::Search-->
										<div id="kt_header_search" class="header-search  d-flex align-items-stretch" data-kt-search-keypress="true" data-kt-search-min-length="2" data-kt-search-enter="enter" data-kt-search-layout="menu" data-kt-menu-trigger="auto" data-kt-menu-overflow="false" data-kt-menu-permanent="true" data-kt-menu-placement="bottom-end" data-kt-search="true">
											<!--begin::Search toggle-->
											<div class="d-flex align-items-center text-black display_hide" data-kt-search-element="toggle" id="kt_header_search_toggle " style="color: white;">
												Welcome! <b><?php echo$_SESSION['f_name']?> <?php echo$_SESSION['l_name']?> </b>
												<!-- <a href="?page=chat" class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px">
													<span class="svg-icon svg-icon-1">
														<i class="bi bi-chat" style="font-size:20px;"></i>
													</span>
												</a> -->
											</div>
											<!--end::Menu-->
										</div>
										<!--end::Search-->
									</div>
									<div class="d-flex align-items-center ms-1 ms-lg-3">
										<!--begin::Drawer toggle-->
										<div id="notif">
											<!-- <div  style="width: 20px;height: 20px; background:blue; border-radius:20px; position: absolute;top: 10px; color: white;"><center>2</center></div> -->
										</div>
										<a href="?page=user" class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px" id="kt_activities_toggle" style="border-radius: 100px;">
											<img src="../img/user/<?php echo$row['image']?>" style="width:40px;height:40px;border-radius: 100px;">
											<!-- <i class="bi bi-bell fs-2"></i> -->
										</a>
										<!--end::Drawer toggle-->
									</div>
								</div>
								<!--end::Toolbar wrapper-->
					</div>

					<!--end::Header-->
					<!--begin::Content-->
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
						<!--begin::Container-->
						<div id="kt_content_container" style="padding-top: 20px;" class="container-xxl">
							<div class="toolbar py-2" id="kt_toolbar">
								<!--begin::Container-->
								<div id="kt_toolbar_container" class="container d-flex align-items-center"><div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
											
										</div>
									<!--begin::Page title-->
									<div class="flex-grow-1 flex-shrink-0 me-5">
										<!--begin::Page title-->
										<!-- <i class="bi bi-calendar" style="font-size: 20px;"></i> 
										<?php echo $datestamp?> -->
										<div class="d-flex align-items-center">
											
											<input class="form-control form-control-solid" id="from_range" type="text" placeholder="Search here..." value="" >
											<span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
											<a href="#print"><i class="bi bi-search fs-2"></i></a>
											
										</div>
										<!--end::Page title-->
									</div>
									<!--end::Page title-->
									<!--begin::Action group-->
									<div class="d-flex align-items-center flex-wrap">
										<!--begin::Wrapper-->
										<div class="flex-shrink-0 me-2">
											
										</div>
										<!--end::Wrapper-->
										<!--begin::Wrapper-->
										<!-- <div class="d-flex align-items-center">
											
											<input class="form-control form-control-solid" id="from_range" type="text" placeholder="Counselor or Student" value="" >
											<span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
											<a href="#print"><i class="bi bi-search fs-2"></i></a>
											
										</div> -->
										
										<!--end::Wrapper-->
									</div>
									<!--end::Action group-->
								</div>
								<!--end::Container-->
							</div>

							<?php
								if(isset($_GET['page'])){
									$page=$_GET['page'];
									include $page.'.php';
								}else{
									include'dashboard.php';
								}

							?>
						</div>
						<!--end::Container-->
					</div>
					<!--end::Content-->
					<!--begin::Footer-->
					<div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
						<!--begin::Container-->
						<div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
							<!--begin::Copyright-->
							<div class="text-dark order-2 order-md-1">
								<span class="text-muted fw-bold me-1">2022©</span>
								© | <a href="index.html#top" class="">Bestlink College of the Philippines</a> - All Rights Reserved.&nbsp;SY 2022-2023</p>
							</div>
							<!--end::Copyright-->
							<!--begin::Menu-->
							<!-- <ul class="menu menu-gray-600 menu-hover-primary fw-bold order-1">
								<li class="menu-item">
									<a href="https://keenthemes.com" target="_blank" class="menu-link px-2">About</a>
								</li>
								<li class="menu-item">
									<a href="https://devs.keenthemes.com" target="_blank" class="menu-link px-2">Support</a>
								</li>
								<li class="menu-item">
									<a href="https://1.envato.market/EA4JP" target="_blank" class="menu-link px-2">Purchase</a>
								</li>
							</ul> -->
							<!--end::Menu-->
						</div>
						<!--end::Container-->
					</div>
					<!--end::Footer-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
		<!--end::Root-->

		<!--begin::Scrolltop-->
		<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
			<!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
			<span class="svg-icon">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
					<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor" />
					<path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor" />
				</svg>
			</span>
			<!--end::Svg Icon-->
		</div>

		<!--end::Modals-->
		<!--begin::Javascript-->
		<script>var hostUrl = "../assets/";</script>
		<!--begin::Global Javascript Bundle(used by all pages)-->
		<script src="../assets/plugins/global/plugins.bundle.js"></script>
		<script src="../assets/js/scripts.bundle.js"></script>

		<!--end::Global Javascript Bundle-->
		<!--begin::Page Vendors Javascript(used by this page)-->
		<script src="../assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
		<script src="../assets/plugins/custom/datatables/datatables.bundle.js"></script>
		<script src="../assets/plugins/custom/formrepeater/formrepeater.bundle.js"></script>
		<!--end::Page Vendors Javascript-->
		<!--begin::Page Custom Javascript(used by this page)-->
		<script src="<?php
								if(isset($_GET['page'])){
									$page=$_GET['page'];
									//echo'../assets/js/custom/apps/ecommerce/catalog/'.$page.'.js';
									echo'../assets/js/custom/apps/ecommerce/catalog/dashboard.js';
								}else{
									echo'../assets/js/custom/apps/ecommerce/catalog/dashboard.js';
								}

							?>"></script>
		<!-- <script src="../assets/js/custom/apps/ecommerce/catalog/save-product.js"></script> -->
		<script src="../assets/js/widgets.bundle.js"></script>
		<script src="../assets/js/custom/widgets.js"></script>
		<script src="../assets/js/custom/apps/chat/chat.js"></script>
		<script src="../assets/js/custom/utilities/modals/upgrade-plan.js"></script>
		<script src="../assets/js/custom/utilities/modals/create-campaign.js"></script>
		<script src="../assets/js/custom/utilities/modals/create-api-key.js"></script>
		<script src="../assets/js/custom/utilities/modals/users-search.js"></script>
		<script type="text/javascript">
		    <?php
		    	if(isset($_GET['edit'])){
		    		?>
		    		$(window).on('load', function() {
				        $('#myModaledit').modal('show');
				    });
		    		<?php
		    	}
		    	if(isset($_GET['view'])){
		    		?>
		    		$(window).on('load', function() {
				        $('#myModalview').modal('show');
				    });
		    		<?php
		    	}
		    	if(isset($_GET['trash'])){
		    		?>
		    		$(window).on('load', function() {
				        $('#myModaltrash').modal('show');
				    });
		    		<?php
		    	}
		    	if(isset($_GET['restore'])){
		    		?>
		    		$(window).on('load', function() {
				        $('#myModalrestore').modal('show');
				    });
		    		<?php
		    	}
		    	if(isset($_GET['print'])){
		    		?>
		    		$(window).on('load', function() {
				        $('#myModalprint').modal('show');
				    });
		    		<?php
		    	}
		    ?>
		</script>
		
		<!--end::Page Custom Javascript-->
		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>

		<?php
	}else{
		header("location: ./login.php");
	}
}
?>