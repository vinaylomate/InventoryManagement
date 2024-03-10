<!DOCTYPE html>

<html lang="en">



<head>



	<?php

	include("inc/meta.php");

	?>

	<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

	<link rel="stylesheet" href="selectcss/chosen.css">

	<style type="text/css" media="all">
		/* vinay pagination */
		.box {
			display: flex;
			justify-content: center;
			align-items: center;
		}

		.box button {
			margin: 5px;
			background-color: #e74a3b;
			color: white;
			border: none;
		}

		#total {
			padding: 5px 10px;
			margin: 0 3px;
			cursor: pointer;
			border: 1px solid #ccc;
			background-color: #e74a3b;
			color: white;
			font-weight: bold;
		}

		.pagination-button {
			padding: 5px 10px;
			margin: 0 3px;
			cursor: pointer;
			border: 1px solid #ccc;
			background-color: #fff;
		}

		.pagination-button.active {
			background-color: white;
			color: #e74a3b;
		}

		/* vinay pagination */
		/* fix rtl for demo */

		.chosen-rtl .chosen-drop {

			left: -9000px;



			z-index: 1010;

		}

		.pagination-content {

			width: 60%;

			text-align: justify;

			padding: 10px;

		}



		.pagination {

			padding: 10px;

		}

		.pagination b {

			text-decoration: none;

			padding: 5px 10px;

			box-shadow: 0px 0px 10px #0000001c;

			background: white;

			margin: 3px;

			color: #1f1e1e;

		}

		.pagination b.active {

			background: #b02923;

			color: white;

		}



		.pagination a.active {

			background: #f77404;

			color: white;

		}



		.pagination a {

			text-decoration: none;

			padding: 5px 10px;

			box-shadow: 0px 0px 10px #0000001c;

			background: white;

			margin: 3px;

			color: #1f1e1e;

		}
	</style>

	<script>
		/* vinay pagination */
		var currentPage = 1;
		var totalCount = 0;

		function generatePagination(totalCount, itemsPerPage, startPage = 1) {
			var totalPages = Math.ceil(totalCount / itemsPerPage);
			var paginationBox = document.getElementById("paginationBox");
			paginationBox.innerHTML = "";

			var totalPagesToShow = Math.min(totalPages, 10); // Show up to 10 pages

			var startIndex = Math.max(1, currentPage - Math.floor(totalPagesToShow / 2));
			var endIndex = Math.min(startIndex + totalPagesToShow - 1, totalPages);

			for (var i = startIndex; i <= endIndex; i++) {
				var pageButton = document.createElement("button");
				pageButton.textContent = i;
				pageButton.className = "pagination-button";
				if (i === currentPage) {
					pageButton.classList.add("active");
				}
				pageButton.onclick = function() {
					currentPage = parseInt(this.textContent);
					getMainData();
					generatePagination(totalCount, itemsPerPage);
				};
				paginationBox.appendChild(pageButton);
			}

			var prevButton = document.getElementById("prevButton");
			prevButton.disabled = currentPage === 1;
			prevButton.onclick = function() {
				if (currentPage > 1) {
					currentPage--;
					getMainData();
					generatePagination(totalCount, itemsPerPage);
				}
			};

			var nextButton = document.getElementById("nextButton");
			nextButton.disabled = currentPage === totalPages;
			nextButton.onclick = function() {
				if (currentPage < totalPages) {
					currentPage++;
					getMainData();
					generatePagination(totalCount, itemsPerPage);
				}
			};

			// Update total count display
			var totalDiv = document.querySelector("#total");
			totalDiv.textContent = "Entries-" + totalCount;
		}

		function getFirstPage() {
			currentPage = 1;
			let itemsPerPage = document.getElementById('itemsPerPageDropdown').value;
			getMainData();
			generatePagination(totalCount, itemsPerPage, 1);
		}

		function getLastPage() {
			let itemsPerPage = document.getElementById('itemsPerPageDropdown').value;
			var lastPage = Math.ceil(totalCount / itemsPerPage);
			currentPage = lastPage;
			getMainData();
			generatePagination(totalCount, itemsPerPage, lastPage);
		}

		function getPageSize() {
			currentPage = 1;
			getMainData();
		}

		function getSearch() {
			currentPage = 1;
			getMainData();
		}
		/* vinay pagination */

		async function deleteProduct(id) {
			let user = JSON.parse(localStorage.getItem('user'));
			if (user == null) {
				window.location.href = 'index.php';
			}
			let userId = user.User.userId;
			let token = user.token;
			let url = `http://localhost:8080/manage/delete/productRegister/${parseInt(id)}/${userId}`;
			await $.ajax({

				type: "DELETE",

				url: url,
				headers: {
					Authorization: token
				},
				//data: $("#companyMaster").serialize(), // serializes the form's elements.
				contentType: 'application/json',

				success: function(data) {
					alert('Record Deleted Successfully');
					window.location.href = 'rmRegister.php';
				},
				error: function(error) {
					alert(JSON.stringify(error));
				}
			});
		}

		async function getCompanyData() {
			let user = JSON.parse(localStorage.getItem('user'));
			if (user == null) {
				window.location.href = 'index.php';
			}
			let userId = user.User.userId;
			let token = user.token;
			await $.ajax({

				type: "GET",
				headers: {
					Authorization: token
				},
				url: 'http://localhost:8080/manage/get/company/0/10',
				contentType: 'application/json',

				success: function(data) {
					let comapanyDD = document.getElementById('compId');
					comapanyDD.innerHTML = `<option value="0">Select</option>`;
					data.Company.forEach((company) => {
						let row = `<option value="${company.companyId}">${company.companyName}</option>`;
						comapanyDD.innerHTML += row;
					});

					let productTypeDD = document.getElementById('iType');
					productTypeDD.innerHTML = `<option value="0">Select</option>`;
					data.ProductType.forEach((type) => {
						let row = `<option value="${type.productTypeId}">${type.productTypeName}</option>`;
						productTypeDD.innerHTML += row;
					});
				},
				error: function(error) {
					alert(JSON.stringify(error));
				}
			});
		}

		async function getCategory() {
			let user = JSON.parse(localStorage.getItem('user'));
			if (user == null) {
				window.location.href = 'index.php';
			}
			let userId = user.User.userId;
			let token = user.token;
			let productTypeId = document.getElementById('iType').value;
			await $.ajax({

				type: "GET",

				url: `http://localhost:8080/manage/get/productCategory/${productTypeId}`,
				headers: {
					Authorization: token
				},
				contentType: 'application/json',
				success: function(data) {
					let productCategoryDD = document.getElementById('cat');
					productCategoryDD.innerHTML = `<option value="0">Select</option>`;
					data.forEach((category) => {
						let row = `<option value="${category.productCategoryId}">${category.productCategoryName}</option>`;
						productCategoryDD.innerHTML += row;
					});
				},
				error: function(error) {
					alert(JSON.stringify(error));
				}
			});
		}

		// function getLocationData() {
		// 	let companyId = document.getElementById('compId').value;
		// 	$.ajax({

		// 		type: "GET",

		// 		url: `http://localhost:8080/manage/get/location/typeWise/${companyId}/1/0`,
		// 		contentType: 'application/json',
		// 		success: function(data) {
		// 			let locationDD = document.getElementById('location');
		// 			locationDD.innerHTML = `<option value="0">Select</option>`;
		// 			data.forEach((location) => {
		// 				let row = `<option value="${location.locationId}">${location.locationName} - ${location.locationCode} - ${location.locationDescription}</option>`;
		// 				locationDD.innerHTML += row;
		// 			});
		// 		},
		// 		error: function(error) {
		// 			alert(JSON.stringify(error));
		// 		}
		// 	});
		// }

		async function getMainData() {
			let user = JSON.parse(localStorage.getItem('user'));
			if (user == null) {
				window.location.href = 'index.php';
			}
			let userId = user.User.userId;
			let token = user.token;
			var companyId = document.getElementById('compId').value == "" ? 0 : document.getElementById('compId').value;
			var search = document.getElementById('txtsearch').value == "" ? "null" : document.getElementById('txtsearch').value;
			var productTypeId = document.getElementById('iType').value == "" ? 0 : document.getElementById('iType').value;
			let pageSize = document.getElementById('itemsPerPageDropdown').value;
			let productCategoryId = document.getElementById('cat').value;
			await $.ajax({

				type: "GET",
				headers: {
					Authorization: token
				},
				url: `http://localhost:8080/manage/get/productRegister/${companyId}/${productTypeId}/${productCategoryId}/${search}/${currentPage-1}/${pageSize}`,
				contentType: 'application/json',

				success: function(data) {
					/* vinay pagination */
					totalCount = data.count;
					generatePagination(data.count, pageSize, currentPage);
					/* vinay pagination */
					let tbody = document.querySelector('#dataTable tbody');
					let index = 0;
					tbody.innerHTML = "";
					data.data.forEach((data) => {
						let row = `<tr style="text-align: center">
						<td>${data.entryDate}</td>
						<td>${data.productCategory.productCategoryName}</td>
						<td>${data.sageCode}</td>
						<td>${data.focusCode}</td>
						<td>${data.description}</td>
						<td>${data.uom.uomName}</td>
						<td>${data.company.companyCode} - ${data.company.companyName} - ${data.company.companyDescription}</td>
						<td>${data.productType.productTypeName}</td>
						<td>${data.reorderLevelQty}</td>
						<td>${data.productExpiry} - Months</td>
						<td>
							<i class="fa fa-trash" style="color:#f00" onClick = "deleteProduct(${data.productRegisterId});">
							</i>
						</td>
						</tr>`;
						tbody.innerHTML += row;
					});
				},
				error: function(error) {
					alert(JSON.stringify(error));
				}
			});
		}

		function edit(id)

		{

			//alert('hi');

			window.open("getrmmaster_details.php?ID=" + id, "_blank", "toolbar=yes, scrollbars=yes, resizable=no, top=60, left=0, width=700, height=600");

		}

		function erate(id)

		{

			//alert('hi');

			window.open("rm_price_history.php?ID=" + id, "_blank", "toolbar=yes, scrollbars=yes, resizable=no, top=60, left=0, width=700, height=600");

		}



		function del(id, user)

		{





			var r = confirm("Do you want to Delete this Record....?");

			if (r == true) {

				$.ajax({
					url: scriptUrl,
					success: function(result)

					{

						alert('Record Deleted Successfully...');

						window.location.href = 'rmMaster.php';

					}
				});



			} else {

				txt = "You Pressed Cancel!";

			}



		}



		function dataReset()

		{

			window.location.href = 'rmRegister.php';

		}
	</script>

</head>



<body id="page-top" onLoad="getCompanyData(); getMainData();">



	<!-- Page Wrapper -->

	<div id="wrapper">



		<!-- Sidebar -->

		<?php

		include("inc/menu.php");

		?>

		<!-- End of Sidebar -->



		<!-- Content Wrapper -->

		<div id="content-wrapper" class="d-flex flex-column">



			<!-- Main Content -->

			<div id="content">



				<!-- Topbar -->

				<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">



					<!-- Sidebar Toggle (Topbar) -->

					<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">

						<i class="fa fa-bars"></i> </button>



					<!-- Topbar Search -->





					<!-- Topbar Navbar -->

					<ul class="navbar-nav ml-auto">



						<!-- Nav Item - Search Dropdown (Visible Only XS) -->





						<!-- Nav Item - Alerts -->





						<!-- Nav Item - Messages -->





						<div class="topbar-divider d-none d-sm-block"></div>



						<!-- Nav Item - User Information -->

						<?php include('inc/header.php'); ?>

					</ul>

				</nav>

				<!-- End of Topbar -->



				<!-- Begin Page Content -->

				<div class="container-fluid">



					<!-- Page Heading -->

					<div class="d-sm-flex align-items-center justify-content-between mb-4">

						<table width="100%">

							<tr>

								<td>
									<h1 class="h4 mb-0 text-gray-800" style="height:0px;padding-bottom: 10px;">Product Register</h1>
								</td>

								<td align="right"><a href="rmMaster.php" class="btn btn-warning" style="text-decoration: none;">Goto Product Entry</a></td>

							</tr>

						</table>

					</div>



					<!-- DataTales Example -->

					<div class="card shadow mb-4">

						<div class="card-body">

							<form>

								<input type="hidden" id="uid" name="uid" value="<?php echo $_SESSION['uId'] ?>">

								<input type="hidden" id="urole" name="urole" value="<?php echo $uRole; ?>">

								<input type="hidden" id="uiType" name="uiType" value="<?php echo $uiType; ?>">

								<input type="hidden" id="uloc" name="uloc" value="<?php echo $uloc; ?>">

								<input type="hidden" id="ulocty" name="ulocty" value="<?php echo $ulocType; ?>">

								<div class="row">

									<div class="col-lg-12">

										<div class="p-2">

											<table cellpadding="5px">

												<tr>

													<td valign="top"><label class="m-0 font-weight-bold text-primary">Company</label></td>

													<td valign="top">:</td>

													<td valign="top">

														<select class="form-control form-control-sm" id="compId" name="compId" tabindex="1" style="width:250px;" onChange="getMainData();">


														</select>

													</td>





													<td valign="top"><label class="m-0 font-weight-bold text-primary">Product Type</label></td>

													<td valign="top">:</td>

													<td valign="top">

														<select class="form-control form-control-sm" id="iType" name="iType" tabindex="3" style="width:230px;" onChange="getCategory(); getMainData();">

															<option value="0">Select</option>

														</select>

													</td>



													<td valign="top"></td>

													<td valign="top"></td>

													<td valign="top"></td>

													<td>

														<!--<input type="button" id="btnsearch" name="btnsearch" class="btn btn-primary" onClick="getdata();" tabindex="3.2" value="Search">-->

													</td>

													<td valign="top"><label class="m-0 font-weight-bold text-primary">Category</label></td>

													<td valign="top">:</td>

													<td valign="top">

														<select class="form-control form-control-sm" id="cat" name="cat" tabindex="3" style="width:230px;" onChange="getMainData()">

															<option value="0">Select</option>

														</select>

													</td>

												</tr>



												<tr>


													</td>

													<td valign="top"><label class="m-0 font-weight-bold text-primary">Search</label></td>

													<td valign="top">:</td>

													<td valign="top"><input type="text" id="txtsearch" name="txtsearch" class="form-control" tabindex="3.1" onKeyUp="getSearch();" onchange="getSearch();"></td>

													<td>

														<input type="button" id="btnReset" name="btnReset" class="btn btn-warning" onClick="dataReset();" tabindex="3.3" value="Reset">

													</td>

												</tr>



												<tr>



												</tr>



											</table>

										</div>

									</div>

								</div>

							</form>
							<!-- vinay pagination -->
							<div class="box">
								<button id="prevButton">Previous</button>
								<button id="firstButton" onClick="getFirstPage();">First</button>
								<div id="paginationBox"></div>
								<button id="lastButton" onClick="getLastPage();">Last</button>
								<button id="nextButton">Next</button>
								<div id="total"></div>

								<select id="itemsPerPageDropdown" onchange="getPageSize();">
									<option value="25">25</option>
									<option value="50">50</option>
									<option value="100">100</option>
									<option value="150">150</option>
									<option value="200">200</option>
									<option value="250">250</option>
								</select>
							</div>
							<!-- vinay pagination -->
							<div class="table-responsive">

								<div id="tbl">


									<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

										<thead>

											<tr style="background-color:#b02923;font-size:14px;">

												<th style="color:#fff;text-align:center">Sr.No.</th>

												<th style="color:#fff;text-align:center">Category</th>

												<th style="color:#fff;text-align:center">Sage Code</th>

												<th style="color:#fff;text-align:center">Focus Code</th>

												<th style="color:#fff;text-align:center">Description</th>

												<th style="color:#fff;text-align:center">Pack. Size / UOM</th>

												<th style="color:#fff;text-align:center">Company</th>

												<th style="color:#fff;text-align:center">Product Type</th>

												<th style="color:#fff;text-align:center">Reorder Level Qty</th>

												<th style="color:#fff;text-align:center">Prod. Expiry</th>

												<th style="color:#fff;text-align:center">Delete</th>

											</tr>

										</thead>

										<tbody>
										</tbody>


									</table>



								</div>

							</div>

						</div>

					</div>



				</div>

				<!-- /.container-fluid -->



			</div>

			<!-- End of Main Content -->



			<!-- Footer -->

			<?php

			include("inc/footer.php");



			?>

			<!-- End of Footer -->



		</div>

		<!-- End of Content Wrapper -->



	</div>

	<!-- End of Page Wrapper -->



	<!-- Scroll to Top Button-->

	<a class="scroll-to-top rounded" href="#page-top">

		<i class="fas fa-angle-up"></i>

	</a>

	<!-- Logout Modal--> <!-- Bootstrap core JavaScript-->

	<script src="vendor/jquery/jquery.min.js"></script>

	<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>



	<!-- Core plugin JavaScript-->

	<script src="vendor/jquery-easing/jquery.easing.min.js"></script>



	<!-- Custom scripts for all pages-->

	<script src="js/sb-admin-2.min.js"></script>



	<!-- Page level plugins -->

	<script src="vendor/chart.js/Chart.min.js"></script>



	<!-- Page level custom scripts -->

	<script src="js/demo/chart-area-demo.js"></script>

	<script src="js/demo/chart-pie-demo.js"></script>

	<!-- Page level plugins -->

	<!--<script src="vendor/datatables/jquery.dataTables.min.js"></script>

<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<script src="js/demo/datatables-demo.js"></script>-->



	<script src="selectjs/chosen.jquery.js" type="text/javascript"></script>

	<script src="selectjs/docsupport/prism.js" type="text/javascript" charset="utf-8"></script>

	<script type="text/javascript">
		var config = {

			'.chosen-select': {},

			'.chosen-select-deselect': {
				allow_single_deselect: true
			},

			'.chosen-select-no-single': {
				disable_search_threshold: 10
			},

			'.chosen-select-no-results': {
				no_results_text: 'Oops, nothing found!'
			},

			'.chosen-select-width': {
				width: "95%"
			},

		}

		for (var selector in config) {

			$(selector).chosen(config[selector]);

		}
	</script>

	<script type="text/javascript">
		$(document).ready(function() {



		});





		$("#btnsubmit").click(function()

			{

				/*alert("hi");

				alert(document.getElementById("desc").value);*/

				if ($("#company_name").val().trim() == "0")

				{

					$("#company_name").addClass("require");

					alert("Please Select Company..!!");

					$("#company_name").focus();

					return false;

					//alert("bye");

				} else if ($("#iType").val().trim() == "0")

				{

					$("#iType").addClass("require");

					alert("Please Select Product Type..!!");

					$("#iType").focus();

					return false;

					//alert("bye");

				} else if ($("#sage_code").val().trim() == "")

				{

					$("#sage_code").addClass("require");

					alert("Please Enter Sage Code..!!");

					$("#sage_code").focus();

					return false;

					//alert("bye");

				} else if ($("#focus_code").val().trim() == "")

				{

					$("#focus_code").addClass("require");

					alert("Please Enter Focus Code..!!");

					$("#focus_code").focus();

					return false;

				} else if ($("#txtdesc").val().trim() == "")

				{

					$("#txtdesc").addClass("require");

					alert("Please Enter Description..!!");

					$("#txtdesc").focus();

					return false;

				} else if ($("#uom").val().trim() == "0")

				{

					$("#uom").addClass("require");

					alert("Please Select UOM..!!");

					$("#uom").focus();

					return false;

				} else if ($("#company_name").val().trim() == "0")

				{

					$("#company_name").addClass("require");

					alert("Please Select Company Name..!!");

					$("#company_name").focus();

					return false;

				} else if ($("#iType").val().trim() == "0")

				{

					$("#iType").addClass("require");

					alert("Please Select Proudct Type Name..!!");

					$("#iType").focus();

					return false;

				} else if ($("#reorder_level_qty").val().trim() == "")

				{

					$("#reorder_level_qty").addClass("require");

					alert("Please Enter Reorder Level Qty..!!");

					$("#reorder_level_qty").focus();

					return false;

				} else if ($("#product_expiry").val().trim() == "")

				{

					$("#product_expiry").addClass("require");

					alert("Please Enter Product Expiry..!!");

					$("#product_expiry").focus();

					return false;

				} else if ($("#rackNo").val().trim() == "")

				{

					$("#rackNo").addClass("require");

					alert("Please Select Rack No. ..!!");

					$("#rackNo").focus();

					return false;

				} else

				{

					document.getElementById('btnsubmit').disabled = true;

					var url = "ins_rm_master.php";

					//alert(url);

					// the script where you handle the form input.

					$.ajax({

						type: "POST",

						url: url,

						data: $("#rmMaster").serialize(), // serializes the form's elements.

						success: function(data)

						{

							alert(data);

							document.getElementById('btnsubmit').disabled = false;

							window.location.href = 'rmMaster.php';

						}

					});

					e.preventDefault();

				}

				// avoid to execute the actual submit of the form.

			});



		function getLoc()

		{

			if (document.getElementById('compId').value == '0')

			{

				if (document.getElementById('urole').value == 'admin')

				{



				} else

				{

					alert('Plz, Select Company Name..!');

					document.getElementById('compId').focus();

				}

			} else

			{

				var id = document.getElementById('compId').value;

				var uId = document.getElementById('uid').value;

				var uloc = document.getElementById('uloc').value;

				var uiType = document.getElementById('uiType').value;

				var ulocty = document.getElementById('ulocty').value;

				var urole = document.getElementById('urole').value;

				var scriptUrl = 'getLocations.php?compId=' + id + '&iType=1' + '&uiType=' + uiType + '&uId=' + uId + '&uloc=' + uloc + '&ulocty=' + ulocty + '&urole=' + urole;

				//alert(scriptUrl);

				$.ajax({
					url: scriptUrl,
					success: function(result)

					{

						//alert(result);

						//document.getElementById('location').innerHTML=result;

						$("#iType").html(result).trigger("chosen:updated.chosen");

					}
				});

			}

		}



		function getdata()

		{

			var compId, locId, iType, srch;

			//alert('hey chiru...');

			if (document.getElementById('compId').value == '0')

			{

				compId = "0";

			} else

			{

				compId = document.getElementById('compId').value;

			}

			if (document.getElementById('iType').value == '0')

			{

				locId = "0";

			} else

			{

				locId = document.getElementById('iType').value;

			}







			//alert('hey chiru...');

			var uId = document.getElementById('uid').value;

			var uType = document.getElementById('uiType').value;

			var uRole = document.getElementById('urole').value;

			var uloc = document.getElementById('uloc').value;

			var page_num = page_num ? page_num : 0;

			var keywords = $('#txtsearch').val();

			var filterBy = $('#filterBy').val();

			$.ajax({

				type: 'POST',

				url: 'getrmRegister.php',

				data: 'page=' + page_num + '&keywords=' + keywords + '&filterBy=' + filterBy + '&compId=' + compId + '&iType=1' + '&locId=' + locId + '&uId=' + uId + '&uiType=' + uType + '&urole=' + uRole + '&sType=0',

				beforeSend: function() {

				},

				success: function(html) {

					//alert(html);

					$('#tbl').html(html);

				}

			});

			/*var scriptUrl='getrmRegister.php?compId='+compId+'&iType=1'+'&locId='+locId+'&uId='+uId+'&uiType='+uType+'&role='+uRole+'&uloc='+uloc+'&srch='+srch;

	//alert(scriptUrl);

 	//dataTable

 	$('#tbl').load(scriptUrl);*/

		}
	</script>

</body>



</html>