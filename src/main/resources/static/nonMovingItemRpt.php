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

		function getCompanyData() {
			let user = JSON.parse(localStorage.getItem('user'));
			if (user == null) {
				window.location.href = 'index.php';
			}
			let userId = user.User.userId;
			let token = user.token;
			$.ajax({

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
					data.ProductType.forEach((productType) => {
						let row = `<option value="${productType.productTypeId}">${productType.productTypeName}</option>`;
						productTypeDD.innerHTML += row;
					});
				},
				error: function(error) {
					alert(JSON.stringify(error));
				}
			});
		}

		function getLocationData() {
			let user = JSON.parse(localStorage.getItem('user'));
			if (user == null) {
				window.location.href = 'index.php';
			}
			let userId = user.User.userId;
			let token = user.token;
			let companyId = document.getElementById('compId').value;
			let productTypeId = document.getElementById('iType').value;
			$.ajax({

				type: "GET",
				headers: {
					Authorization: token
				},
				url: `http://localhost:8080/manage/get/location/typeWise/${companyId}/${productTypeId}/${userId}`,
				contentType: 'application/json',
				success: function(data) {
					let locationDD = document.getElementById('location');
					locationDD.innerHTML = `<option value="0">Select</option>`;
					data.forEach((location) => {
						let row = `<option value="${location.locationId}">${location.locationName}</option>`;
						locationDD.innerHTML += row;
					});
				},
				error: function(error) {
					alert(JSON.stringify(error));
				}
			});
		}

		function getMainData() {
			let user = JSON.parse(localStorage.getItem('user'));
			if (user == null) {
				window.location.href = 'index.php';
			}
			let userId = user.User.userId;
			let token = user.token;
			var companyId = document.getElementById('compId').value == "" ? 0 : document.getElementById('compId').value;
			var productTypeId = document.getElementById('iType').value == "" ? 0 : document.getElementById('iType').value;
			var locationId = document.getElementById('location').value == "" ? 0 : document.getElementById('location').value;
			var search = document.getElementById('txtsearch').value == "" ? "null" : document.getElementById('txtsearch').value;
			// var fromDate = document.getElementById('fdt').value == "" ? "null" : document.getElementById('fdt').value;
			// var endDate = document.getElementById('tdt').value == "" ? "null" : document.getElementById('tdt').value;
			var fromDate = "null";
			var endDate = "null";
			let pageSize = document.getElementById('itemsPerPageDropdown').value;
			var url = `http://localhost:8080/manage/get/nonMovingReport/${companyId}/${productTypeId}/${locationId}/${search}/${currentPage-1}/${pageSize}/${fromDate}/${endDate}/`;
			$.ajax({

				type: "GET",
				headers: {
					Authorization: token
				},
				url: url,
				contentType: 'application/json',

				success: function(data) {
					totalCount = data.count;
					generatePagination(data.count, pageSize, currentPage);
					let tbody = document.querySelector('#dataTable tbody');
					let index = 0;
					tbody.innerHTML = "";
					data.data.forEach((data) => {
						let row = `<tr style="text-align: center">
							<td>${data.location}</td>
							<td>${data.focusCode}</td>
							<td>${data.sageCode}</td>
							<td>${data.description}</td>
							<td>${data.qty}</td>
							</tr>`;
						tbody.innerHTML += row;
					});
				},
				error: function(error) {
					alert(JSON.stringify(error));
				}
			});
		}

		function getLoc()



		{



			//alert('hey chiru...');



			if (document.getElementById('compId').value == '0')



			{



				if (document.getElementById('urole').value == 'admin')



				{







				} else



				{



					alert('Plz, Select Company Name..!');



					document.getElementById('company_name').focus();



				}



			} else if (document.getElementById('iType').value == '0')



			{



				//alert('Plz, Select Product Category..!'); 



				document.getElementById('iType').focus();



			} else



			{



				var id = document.getElementById('compId').value;



				var iType = document.getElementById('iType').value;



				var uId = document.getElementById('uid').value;



				var uloc = document.getElementById('uloc').value;



				var uiType = document.getElementById('uiType').value;



				var ulocty = document.getElementById('ulocty').value;



				var urole = document.getElementById('urole').value;



				var scriptUrl = 'getLocations.php?compId=' + id + '&iType=' + iType + '&uId=' + uId + '&uiType=' + uiType + '&uId=' + uId + '&uloc=' + uloc + '&ulocty=' + ulocty + '&urole=' + urole;



				//alert(scriptUrl);



				$.ajax({
					url: scriptUrl,
					success: function(result)



					{



						//alert(result);



						//document.getElementById('location').innerHTML=result; 



						$("#location").html(result).trigger("chosen:updated.chosen");



					}
				});



			}



		}



		function dataReset()



		{



			window.location.href = 'nonMovingItemRpt.php';



		}







		function getexcel()



		{



			var compId, locId, iType, srch, fdt, tdt;



			if (document.getElementById('compId').value == '0')



			{



				compId = "0";



			} else



			{



				compId = document.getElementById('compId').value;



			}







			if (document.getElementById('iType').value == '0')



			{



				iType = "0";



			} else



			{



				iType = document.getElementById('iType').value;



			}







			if (document.getElementById('location').value == '0')



			{



				locId = "0";



			} else



			{



				locId = document.getElementById('location').value;



			}







			if (document.getElementById('txtsearch').value == '')



			{



				srch = '0';



			} else



			{



				srch = document.getElementById('txtsearch').value;



			}







			if (document.getElementById('fdt').value == '')



			{



				fdt = "0";



			} else



			{



				fdt = document.getElementById('fdt').value;



			}







			if (document.getElementById('tdt').value == '')



			{



				tdt = "0";



			} else



			{



				tdt = document.getElementById('tdt').value;



			}







			var uId = document.getElementById('uid').value;



			var uType = document.getElementById('uiType').value;



			var uRole = document.getElementById('urole').value;



			var uloc = document.getElementById('uloc').value;



			var scriptUrl = 'nonMovingItemEx.php?compId=' + compId + '&iType=' + iType + '&locId=' + locId + '&uId=' + uId + '&uiType=' + uType + '&role=' + uRole + '&srch=' + srch + '&uloc=' + uloc + '&fdt=' + fdt + '&tdt=' + tdt;







			//alert(scriptUrl);



			//dataTable



			window.open(scriptUrl, "toolbar=yes, scrollbars=yes, resizable=no, top=60, left=0, width=1000, height=600");



		}







		function getpdf()



		{



			var compId, locId, iType, srch, fdt, tdt;



			if (document.getElementById('compId').value == '0')



			{



				compId = "0";



			} else



			{



				compId = document.getElementById('compId').value;



			}







			if (document.getElementById('iType').value == '0')



			{



				iType = "0";



			} else



			{



				iType = document.getElementById('iType').value;



			}







			if (document.getElementById('location').value == '0')



			{



				locId = "0";



			} else



			{



				locId = document.getElementById('location').value;



			}







			if (document.getElementById('txtsearch').value == '')



			{



				srch = '0';



			} else



			{



				srch = document.getElementById('txtsearch').value;



			}







			if (document.getElementById('fdt').value == '')



			{



				fdt = "0";



			} else



			{



				fdt = document.getElementById('fdt').value;



			}







			if (document.getElementById('tdt').value == '')



			{



				tdt = "0";



			} else



			{



				tdt = document.getElementById('tdt').value;



			}







			var uId = document.getElementById('uid').value;



			var uType = document.getElementById('uiType').value;



			var uRole = document.getElementById('urole').value;



			var uloc = document.getElementById('uloc').value;







			var scriptUrl = 'mpdf/print_files/nonMovingItem_pdf.php?compId=' + compId + '&iType=' + iType + '&locId=' + locId + '&uId=' + uId + '&uiType=' + uType + '&role=' + uRole + '&srch=' + srch + '&uloc=' + uloc + '&fdt=' + fdt + '&tdt=' + tdt;



			//alert(scriptUrl);



			//dataTable



			window.open(scriptUrl, "toolbar=yes, scrollbars=yes, resizable=no, top=60, left=0, width=1000, height=600");



		}







		function view(id)



		{



			//alert('hi');



			window.open("getinventoryview.php?ID=" + id, "_blank", "toolbar=yes, scrollbars=yes, resizable=no, top=60, left=0, width=1000, height=600");



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



						<i class="fa fa-bars"></i>



					</button>







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



					<div class="align-items-center justify-content-between mb-2" style="background-color:#3c8dbc;border-radius:5px;" align="center">



						<h1 class="h3 mb-0 text-gray-801" style="padding-bottom: 5px;">Non Moving Item Report</h1>



					</div>















					<!-- DataTales Example -->



					<div class="card shadow mb-4">



						<!--<div class="card-header py-3">



<h6 class="m-0 font-weight-bold text-primary">Inventory Register</h6>



</div>-->



						<form>



							<input type="hidden" id="uid" name="uid" value="<?php echo $userId ?>">



							<input type="hidden" id="urole" name="urole" value="<?php echo $uRole; ?>">



							<input type="hidden" id="uiType" name="uiType" value="<?php echo $uiType; ?>">



							<input type="hidden" id="uloc" name="uloc" value="<?php echo $uloc; ?>">



							<input type="hidden" id="ulocty" name="ulocty" value="<?php echo $ulocType; ?>">



							<div class="card-body">



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



														<select class="form-control form-control-sm" id="iType" name="iType" tabindex="2" onChange="getLocationData(); getMainData();" style="width:250px;" required>


														</select>



													</td>







													<td valign="top"><label class="m-0 font-weight-bold text-primary">Location</label></td>



													<td valign="top">:</td>



													<td valign="top">



														<select class="form-control form-control-sm" id="location" name="location" tabindex="3" style="width:230px;" onChange="getMainData();">



															<option value="0">Select</option>



														</select>



													</td>



												</tr>







												<!-- <tr>



													<td valign="top"><label class="m-0 font-weight-bold text-primary">From Date</label></td>



													<td valign="top">:</td>



													<td valign="top">



														<input type="date" class="form-control form-control-sm" id="fdt" name="fdt" value="" tabindex="4">



													</td>







													<td valign="top"><label class="m-0 font-weight-bold text-primary">To Date</label></td>



													<td valign="top">:</td>



													<td valign="top">



														<input type="date" class="form-control form-control-sm" id="tdt" name="tdt" value="" onChange="getMainData();" tabindex="5">



													</td>











												</tr> -->







												<tr>



													<td valign="top"></td>



													<td valign="top"></td>



													<td valign="top"></td>



													<td valign="top"></td>



													<td valign="top"></td>



													<td valign="top"></td>



													<td valign="top"></td>



													<td valign="top"></td>



													<td valign="top"></td>



												</tr>







												<tr>



													<td valign="top"><label class="m-0 font-weight-bold text-primary">Search</label></td>



													<td valign="top">:</td>



													<td valign="top">



														<input type="text" id="txtsearch" name="txtsearch" class="form-control" tabindex="3.1" placeholder="Type keywords..." onKeyUp="getSearch();" onchange="getSearch();" style="width: 250px;">



													</td>



													<td>



														<!--<input type="button" id="btnsearch" name="btnsearch" class="btn btn-primary" onClick="searchFilter();" tabindex="5.2" value="Search">-->



													</td>



													<td valign="top"></td>



													<td valign="top"></td>



													<td valign="top">



														<a href="javascript:getexcel();"><img src="img/EXCELIMG1.png" alt="download" title="download" style="width:50px; height:50px"></a>







													</td>



													<td valign="top">



														<a href="javascript:getpdf();"><img src="img/pdf.png" alt="download" title="download" style="width:50px; height:50px"></a>







													</td>



													<td valign="top"><input type="button" id="btnReset" name="btnReset" class="btn btn-warning" onClick="dataReset();" tabindex="3.3" value="Reset"></td>



												</tr>







											</table>



										</div>



									</div>



								</div>

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


										<table class="table table-bordered" id="dataTable" cellspacing="0">



											<thead>



												<tr style="background-color:#b02923">



													<th style="color:#fff;">Location</th>



													<th style="color:#fff;">Focus Code</th>



													<th style="color:#fff">Sage Code</th>



													<th style="color:#fff;">Product</th>



													<!--<th style="color:#fff">Opening Stock</th>-->



													<th style="color:#fff;">Stock Qty</th>







												</tr>



											</thead>

											<tbody>

											</tbody>

										</table>







									</div>



								</div>



							</div>



						</form>



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



  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>-->







	<!-- Page level custom scripts -->



	<!--<script src="js/demo/datatables-demo.js"></script>-->







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
			}



		}



		for (var selector in config) {



			$(selector).chosen(config[selector]);



		}



		function searchFilter(page_num)

		{

			page_num = page_num ? page_num : 0;

			var len = document.getElementById('txtsearch').value.length;

			//alert(len);

			var compId, locId, iType;



			if (document.getElementById('compId').value == '0')



			{



				compId = "0";



			} else



			{



				compId = document.getElementById('compId').value;



			}







			if (document.getElementById('iType').value == '0')



			{



				iType = "0";



			} else



			{



				iType = document.getElementById('iType').value;



			}







			if (document.getElementById('location').value == '0')



			{



				locId = "0";


			} else



			{



				locId = document.getElementById('location').value;



			}



			var uId = document.getElementById('uid').value;



			var uType = document.getElementById('uiType').value;



			var urole = document.getElementById('urole').value;



			var uloc = document.getElementById('uloc').value;

			//alert(urole);



			var keywords = $('#txtsearch').val();

			var filterBy = $('#filterBy').val();

			if (len >= 3)

			{

				$.ajax({

					type: 'POST',

					url: 'getnonMovingItem.php',

					data: 'page=' + page_num + '&keywords=' + keywords + '&filterBy=' + filterBy + '&compId=' + compId + '&iType=' + iType + '&locId=' + locId + '&uId=' + uId + '&uiType=' + uType + '&urole=' + urole + '&uloc=' + uloc,

					beforeSend: function() {

					},

					success: function(html) {

						//alert(html);

						$('#tbl').html(html);

					}

				});

			} else

			{

				//alert('1');

			}

		}



		function getdata()



		{



			var compId, locId, iType, srch, fdt, tdt;



			if (document.getElementById('compId').value == '0')



			{



				compId = "0";



			} else



			{



				compId = document.getElementById('compId').value;



			}







			if (document.getElementById('iType').value == '0')



			{



				iType = "0";



			} else



			{



				iType = document.getElementById('iType').value;



			}







			if (document.getElementById('location').value == '0')



			{



				locId = "0";



			} else



			{



				locId = document.getElementById('location').value;



			}







			if (document.getElementById('txtsearch').value == '')



			{



				srch = '0';



			} else



			{



				srch = document.getElementById('txtsearch').value;



			}







			if (document.getElementById('fdt').value == '')



			{



				fdt = "0";



			} else



			{



				fdt = document.getElementById('fdt').value;



			}







			if (document.getElementById('tdt').value == '')



			{



				tdt = "0";



			} else



			{



				tdt = document.getElementById('tdt').value;



			}





			var page_num = page_num ? page_num : 0;

			var uId = document.getElementById('uid').value;



			var uType = document.getElementById('uiType').value;



			var uRole = document.getElementById('urole').value;



			var uloc = document.getElementById('uloc').value;

			var keywords = $('#txtsearch').val();

			var filterBy = $('#filterBy').val();



			$.ajax({

				type: 'POST',

				url: 'getnonMovingItem.php',

				data: 'page=' + page_num + '&keywords=' + keywords + '&filterBy=' + filterBy + '&compId=' + compId + '&iType=' + iType + '&locId=' + locId + '&uId=' + uId + '&uiType=' + uType + '&urole=' + uRole + '&uloc=' + uloc + '&fdt=' + fdt + '&tdt=' + tdt + '&sType=0',

				beforeSend: function() {

				},

				success: function(html) {

					//alert(html);

					$('#tbl').html(html);

				}

			});


		}
	</script>



</body>



</html>