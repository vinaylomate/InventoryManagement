<!DOCTYPE html>

<html lang="en">



<head>



	<?php

	include("inc/meta.php");

	?>

	<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

	<link rel="stylesheet" href="selectcss/chosen.css">

	<style type="text/css" media="all">
		/* fix rtl for demo */

		.chosen-rtl .chosen-drop {
			left: -9000px;



		}
	</style>
	<script>
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
				//data: $("#companyMaster").serialize(), // serializes the form's elements.
				contentType: 'application/json',

				success: function(data) {
					let comapanyDD = document.getElementById('compId');
					comapanyDD.innerHTML = `<option value="0">Select</option>`;
					data.Company.forEach((company) => {
						let row = `<option value="${company.companyId}">${company.companyName}</option>`;
						comapanyDD.innerHTML += row;
					});

					let productTypeDD = document.getElementById("proType");
					productTypeDD.innerHTML = `<option value="0">Select</option>`;
					data.ProductType.forEach((type) => {
						let row = `<option value="${type.productTypeId}">${type.productTypeName}</option>`;
						productTypeDD.innerHTML += row;
					});

					let EntryTypeDD = document.getElementById("eType");
					EntryTypeDD.innerHTML = `<option value="0">Select</option>`;
					data.Entry.forEach((type) => {
						let row = `<option value="${type.entryId}">${type.entryName}</option>`;
						EntryTypeDD.innerHTML += row;
					});
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
			let productTypeId = document.getElementById("proType").value;
			let url = `http://localhost:8080/manage/get/location/typeWise/${companyId}/${productTypeId}/${userId}`;
			$.ajax({

				type: "GET",
				headers: {
					Authorization: token
				},
				url: url,
				contentType: 'application/json',
				success: function(data) {
					let locationDD = document.getElementById('location');
					locationDD.innerHTML = `<option value="0">Select</option>`;
					data.forEach((location) => {
						let row = `<option value="${location.locationId}">${location.locationName} - ${location.locationCode} - ${location.locationDescription}</option>`;
						locationDD.innerHTML += row;
					});
				},
				error: function(error) {
					alert(JSON.stringify(error));
				}
			});
		}

		function getProducts() {
			let user = JSON.parse(localStorage.getItem('user'));
			if (user == null) {
				window.location.href = 'index.php';
			}
			let userId = user.User.userId;
			let token = user.token;
			let companyId = document.getElementById('compId').value;
			let productTypeId = document.getElementById("proType").value;
			let locationId = document.getElementById("location").value;
			let search = document.getElementById("txtsearch").value == "" ? null : document.getElementById("txtsearch").value;
			let productCategoryId = 0;
			let pageNumber = 0;
			let pageSize = 15;
			$.ajax({

				type: "GET",
				headers: {
					Authorization: token
				},
				url: `http://localhost:8080/manage/get/productRegister/${companyId}/${productTypeId}/${productCategoryId}/${search}/${pageNumber}/${pageSize}`,
				contentType: 'application/json',
				success: function(data) {
					let productDD = document.getElementById('itemId');
					productDD.innerHTML = `<option value="0">Select</option>`;
					data.data.forEach((product) => {
						let pro = new Array();
						pro[0] = product.productRegisterId;
						pro[1] = product.brandName;
						pro[2] = product.productExpiry;
						pro[3] = product.reorderLevelQty;
						let row = `<option value="${pro}">${product.sageCode} - ${product.focusCode} - ${product.description}</option>`;
						productDD.innerHTML += row;
					});
				},
				error: function(error) {
					alert(JSON.stringify(error));
				}
			});
		}

		async function getBatchNo() {
			let user = JSON.parse(localStorage.getItem('user'));
			if (user == null) {
				window.location.href = 'index.php';
			}
			let userId = user.User.userId;
			let token = user.token;
			var locationId = document.getElementById('location').value;
			var arr = document.getElementById('itemId').value;
			var entryId = 1;
			var productRegisterId = arr[0];
			var url = `http://localhost:8080/manage/get/stockRegister/${locationId}/${entryId}/${productRegisterId}/${userId}`;
			await $.ajax({

				type: "GET",
				url: url,
				headers: {
					Authorization: token
				},
				contentType: 'application/json',
				success: function(data) {
					let batchNoDD = document.getElementById('bctNo');
					batchNoDD.innerHTML = `<option value="0">Select</option>`;
					data.forEach((batch) => {
						let row = `<option value="${batch.qty}">${batch.batchNo}</option>`;
						batchNoDD.innerHTML += row;
					});
				},
				error: function(error) {
					alert(JSON.stringify(error));
				}
			});
		}
	</script>

</head>



<body id="page-top" onLoad="getCompanyData()">



	<!-- Page Wrapper -->

	<div id="wrapper">



		<!-- Sidebar -->

		<?php

		include("inc/menu.php");

		date_default_timezone_set('Asia/Calcutta');
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

					<div class="align-items-center justify-content-between mb-2" style="background-color:#3c8dbc;border-radius:5px;" align="center">

						<h1 class="h3 mb-0 text-gray-801" style="padding-bottom: 5px;">Stock Entry</h1>

					</div>

					<form class="user" action="#" method="POST" id="companyMaster" name="companyMaster" enctype="multipart/form-data">

						<div class="card o-visible border-0 shadow-lg my-2">
							<div class="card-body p-0">

								<!-- Nested Row within Card Body -->



								<input type="hidden" id="uid" name="uid" value="<?php echo $_SESSION['uId'] ?>">

								<input type="hidden" id="urole" name="urole" value="<?php echo $uRole; ?>">

								<input type="hidden" id="uiType" name="uiType" value="<?php echo $uiType; ?>">

								<input type="hidden" id="uloc" name="uloc" value="<?php echo $uloc; ?>">

								<input type="hidden" id="ulocty" name="ulocty" value="<?php echo $ulocType; ?>">

								<input type="hidden" id="yr" name="yr" value="">

								<input type="hidden" id="yr2" name="yr2" value="">

								<!-- Formula First Start-->

								<div class="row">

									<div class="col-lg-12">

										<div class="p-2">

											<table cellpadding="5px">

												<tr>

													<td valign="top"><label class="m-0 font-weight-bold text-primary">Company</label></td>

													<td valign="top">:</td>

													<td valign="top">

														<select class="form-control form-control-sm" id="compId" name="compId" tabindex="1" required style="width:250px;" onChange="getLocationData();">


														</select>

													</td>

													<td valign="top"><label class="m-0 font-weight-bold text-primary">Product Type</label></td>

													<td valign="top">:</td>

													<td valign="top">

														<select class="form-control form-control-sm" id="proType" name="proType" tabindex="3" onChange="getLocationData();" style="width:250px;">

															<option value="0">Select</option>

														</select>

													</td>

													<td valign="top"><label class="m-0 font-weight-bold text-primary">Location</label></td>

													<td valign="top">:</td>

													<td valign="top">

														<select class="form-control form-control-sm" id="location" name="location" onChange="getDocNo()" tabindex="3" style="width:250px;">

															<option value="0">Select</option>

														</select>

													</td>

												</tr>



												<tr>

													<td valign="top"><label class="m-0 font-weight-bold text-primary">Doc. No</label></td>

													<td valign="top">:</td>

													<td valign="top">

														<input type="text" class="form-control form-control-sm" id="txtserialno" name="txtserialno" value="<?php echo $s_code; ?>" placeholder="Serial No">

													</td>





													<td valign="top"><label class="m-0 font-weight-bold text-primary">Date</label></td>

													<td valign="top">:</td>

													<td valign="top">


														<input type="date" class="form-control form-control-sm" id="txtdt" name="txtdt" value="<?php echo $dt ?>" max="<?php echo date('Y-m-d'); ?>" min="<?php echo $mindt; ?>" tabindex="4">

														<!--<input type="date" class="form-control form-control-sm" id="txtdt" name="txtdt" value="<?php echo $dt ?>" tabindex="4">-->

													</td>



													<td valign="top"><label class="m-0 font-weight-bold text-primary">Entry Type</label></td>

													<td valign="top">:</td>

													<td valign="top">

														<select class="form-control form-control-sm" id="eType" name="eType" tabindex="5" onChange="geteType()" style="width:250px;">

															<option value="0">Select</option>



														</select>

														<input type="hidden" class="form-control form-control-sm" id="txteType" name="txteType" value="0" readonly>

													</td>

												</tr>



												<tr>

													<td valign="top"></td>

													<td valign="top"></td>

													<td valign="top">

														<input type="radio" id="rbmn" name="rb" value="0" tabindex="6" onChange="showProduct();" checked>

														<label class="m-0 font-weight-bold text-primary">Manually</label>

														<!--<input type="radio" id="rbsc" name="rb" value="1" tabindex="6" onChange="showProduct();">

<label class="m-0 font-weight-bold text-primary">Scan Barcode</label>-->

														<input type="hidden" class="form-control form-control-sm" id="typ" name="typ" value="0" readonly>

													</td>



													<td valign="top"><label class="m-0 font-weight-bold text-primary" id="lbl1">Product</label></td>

													<td valign="top">:</td>

													<td valign="top">

														<div id="rmshow">

															<div style="margin-bottom: 5px;">

																<input type="text" class="form-control form-control-sm" id="txtsearch" name="txtsearch" placeholder="Search" tabindex="7.1" value="" onChange="getProducts()" required>

															</div>

															<select class="form-control form-control-sm" id="itemId" name="itemId" tabindex="7.1" onChange="getBatchNo()" style="width:250px;">

																<option value="0">Select</option>

															</select>

														</div>

														<div id="fgbar" style="visibility: hidden;overflow: hidden;height: 0px;">

															<input type="text" class="form-control form-control-sm" id="txtbar" name="txtbar" placeholder="Barcode" tabindex="7.1" value="" onChange="getInfo('tbl_prod')" required>

														</div>

													</td>



													<td valign="top"><label class="m-0 font-weight-bold text-primary" id="lblbct" style="visibility: hidden;overflow: hidden;height: 0px;">Batch No</label></td>

													<td valign="top"><label id="lblbct2" style="visibility: hidden;overflow: hidden;height: 0px;">:</label></td>

													<td valign="top">

														<div id="divbct" style="visibility: hidden;overflow: hidden;height: 0px;">

															<select class="form-control form-control-sm" id="bctNo" name="bctNo" tabindex="7.2" style="width:250px;">

																<option value="0">Select</option>

															</select>

														</div>

													</td>

												</tr>



												<tr>

													<td valign="top"><label class="m-0 font-weight-bold text-primary">Sage Reference</label></td>

													<td valign="top">:</td>

													<td valign="top">

														<input type="text" class="form-control form-control-sm" id="ref" name="ref" value="" placeholder="Sage Reference" tabindex="13.1">

													</td>





													<td valign="top"><label class="m-0 font-weight-bold text-primary">Notes</label></td>

													<td valign="top">:</td>

													<td valign="top">

														<input type="text" class="form-control form-control-sm" id="nts" name="nts" value="" placeholder="Notes" tabindex="13.2">

													</td>



													<td valign="top"><label class="m-0 font-weight-bold text-primary"></label></td>

													<td valign="top"></td>

													<td valign="top"><button type="button" id="btnAdd" name="btnAdd" class="btn btn-success" tabindex="8" onClick="getInfo('tbl_prod')">Add</button>

														<button type="button" id="btndel" name="btndel" class="btn btn-warning" tabindex="15" onClick="delRows('tbl_prod')">Remove</button>

													</td>

												</tr>

											</table>

										</div>

									</div>

								</div>

								<!-- Formula First End-->

								<!-- Formula Second End-->



							</div>

						</div><!--end-->



						<div class="card o-hidden border-0 shadow-lg my-2">
							<div class="card-body p-0">

								<!-- Nested Row within Card Body -->



								<!-- Formula First Start-->

								<div class="row">

									<div class="col-lg-12">

										<div class="p-2">

											<div class="form-group row">

												<div class="col-sm-6 mb-3 mb-sm-0">

													<label class="m-0 font-weight-bold text-primary" style="font-size : 20px;"><b>Total Qty : </b></label>

													<label class="m-0 font-weight-bold text-primary1" style="font-size : 30px;" id="counting"><b>0</b></label>

													<input type="hidden" class="form-control form-control-sm" id="rec" name="rec" placeholder="" value="0" readonly>

												</div>

												<div class="col-sm-6 mb-3 mb-sm-0" align="right">

													<button type="button" id="btn" name="btn" class="btn btn-primary" tabindex="14">Save</button>

												</div>

											</div>

											<div class="form-group row">

												<div class="col-sm-12 mb-3 mb-sm-0 table-responsive">

													<table width="100%" id="tbl_prod" class="table table-bordered">

														<tr style="background-color:#b02923">

															<th style="color:#fff;text-align:center">No.</th>

															<th style="color:#fff;text-align:center">Sage Code</th>

															<th style="color:#fff;text-align:center">Focus Code</th>

															<!--<th style="color:#fff;text-align:center">Barcode</th>-->

															<th style="color:#fff;text-align:center">Description</th>

															<th style="color:#fff;text-align:center">Entry Type</th>

															<th style="color:#fff;text-align:center">Batch No</th>

															<th style="color:#fff;text-align:center">Stock Qty</th>

															<th style="color:#fff;text-align:center">Qty</th>

															<th style="color:#fff;text-align:center">Bal. Qty</th>

															<th style="color:#fff;text-align:center">Expiry Date</th>

															<!--<th style="color:#fff;text-align:center">Reference</th>      

<th style="color:#fff;text-align:center">Notes</th>-->

														</tr>

													</table>

												</div>

											</div>



											<div class="form-group row">

												<div class="col-sm-6 mb-3 mb-sm-0">



												</div>

												<div class="col-sm-6 mb-3 mb-sm-0">

													<label class="m-0 font-weight-bold text-primary"></label>



												</div>

												<div id="abc"></div>



											</div>

										</div>

									</div>

								</div>

								<!-- Formula First End-->

								<!-- Formula Second End-->



							</div>

						</div><!--end-->

					</form>

					<!-- DataTales Example -->

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

	<script src="vendor/datatables/jquery.dataTables.min.js"></script>

	<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>



	<!-- Page level custom scripts -->

	<script src="js/demo/datatables-demo.js"></script>





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



		function getLoc()

		{

			if (document.getElementById('compId').value == '0')

			{

				if (document.getElementById('urole').value == 'admin')

				{



				} else

				{

					alert('Plz, Select Company Name..!');

					document.getElementById('company_name').focus();

				}

			} else if (document.getElementById('proType').value == '0')

			{

				//alert('Plz, Select Product Category..!'); 

				document.getElementById('proType').focus();

			} else

			{

				var id = document.getElementById('compId').value;

				var iType = document.getElementById('proType').value;

				var uId = document.getElementById('uid').value;

				var uloc = document.getElementById('uloc').value;

				var uiType = document.getElementById('uiType').value;

				var ulocty = document.getElementById('ulocty').value;

				var urole = document.getElementById('urole').value;

				var scriptUrl = 'getLocations.php?compId=' + id + '&iType=' + iType + '&uiType=' + uiType + '&uId=' + uId + '&uloc=' + uloc + '&ulocty=' + ulocty + '&urole=' + urole;

				//alert(scriptUrl);

				$.ajax({
					url: scriptUrl,
					success: function(result)

					{

						//alert(result);

						//document.getElementById('location').innerHTML=result;

						//$("#location").html(result).trigger("chosen:updated.chosen");

						$("#location").html(result).trigger("chosen:updated.chosen");

						if (uId != '1')

						{

							getDocNo();

						}

					}
				});

			}

		}



		function getDocNo()

		{

			if (document.getElementById('compId').value == '0')

			{

				//alert('Plz, Select Company..!'); 

				document.getElementById('compId').focus();

				//$("#iType").val(0).trigger("chosen:updated.chosen");

			} else if (document.getElementById('proType').value == '0')

			{

				//alert('Plz, Select Product Category..!'); 

				document.getElementById('proType').focus();

				//$("#iType").val(0).trigger("chosen:updated.chosen");

			} else if (document.getElementById('location').value == '0')

			{

				//alert('Plz, Select Location..!'); 

				document.getElementById('location').focus();

				//$("#iType").val(0).trigger("chosen:updated.chosen");

			} else

			{
				let user = JSON.parse(localStorage.getItem('user'));
				if (user == null) {
					window.location.href = 'index.php';
				}
				let userId = user.User.userId;
				let token = user.token;
				var locationId = document.getElementById('location').value;

				const d = new Date();
				let year = d.getFullYear();

				$.ajax({

					type: "GET",

					url: `http://localhost:8080/manage/get/docNo/${locationId}/${year}`,
					headers: {
						Authorization: token
					},
					contentType: 'application/json',
					success: function(data) {
						var value = JSON.stringify(data);
						document.getElementById('txtserialno').value = JSON.parse(value).docNo;
					},
					error: function(error) {
						alert(JSON.stringify(error));
					}
				});

			}



		}



		function getproduct()

		{

			if (document.getElementById('compId').value == '0')

			{

				//alert('Plz, Select Company..!'); 

				document.getElementById('compId').focus();

				//$("#iType").val(0).trigger("chosen:updated.chosen");

			} else if (document.getElementById('proType').value == '0')

			{

				//alert('Plz, Select Product Category..!'); 

				document.getElementById('proType').focus();

				//$("#iType").val(0).trigger("chosen:updated.chosen");

			} else if (document.getElementById('location').value == '0')

			{

				//alert('Plz, Select Location..!'); 

				document.getElementById('location').focus();

				//$("#iType").val(0).trigger("chosen:updated.chosen");

			} else if (document.getElementById('txteType').value == '0' || document.getElementById('txteType').value == '')

			{

				alert('Plz, Select Entry Type..!');

				document.getElementById('txtsearch').value = "";

				document.getElementById('eType').focus();

			} else if (document.getElementById('txtsearch').value == '')

			{

				//alert('Plz, Select Location..!'); 

				document.getElementById('txtsearch').focus();

				//$("#iType").val(0).trigger("chosen:updated.chosen");

			} else

			{

				var id = document.getElementById('proType').value;

				var compId = document.getElementById('compId').value;

				var locId = document.getElementById('location').value;

				var yr = document.getElementById('yr').value;

				var yr2 = document.getElementById('yr2').value;

				var srch = document.getElementById('txtsearch').value;

				var eType = document.getElementById('txteType').value;

				var scriptUrl = 'getProducts.php?iType=' + id + '&compId=' + compId + '&locId=' + locId + '&yr=' + yr + '&yr2=' + yr2 + '&srch=' + srch;

				//alert(scriptUrl);

				$.ajax({
					url: scriptUrl,
					success: function(result)

					{

						//alert(result);

						//document.getElementById('location').innerHTML=result; 

						//$("#itemId").html(str[0]).trigger("chosen:updated.chosen");			

						//$("#itemId").html(result).trigger("chosen:updated.chosen");

						//$("#itemId").val(result).trigger("chosen:updated.chosen");

						$("#itemId").html(result).trigger("chosen:updated.chosen");



						if (eType == 'OUT')

						{

							getProductInfo();

						}

						document.getElementById('txtsearch').value = "";

					}
				});

			}

		}



		function getProductInfo()

		{

			if (document.getElementById('compId').value == '0')

			{

				alert('Plz, Select Company..!');

				document.getElementById('compId').focus();

			} else if (document.getElementById('proType').value == '0')

			{

				alert('Plz, Select Product Category..!');

				document.getElementById('proType').focus();

			} else if (document.getElementById('location').value == '0')

			{

				alert('Plz, Select Location..!');

				document.getElementById('location').focus();

			} else if (document.getElementById('txteType').value == '0' || document.getElementById('txteType').value == '')

			{

				alert('Plz, Select Entry Type..!');

				document.getElementById('eType').focus();

			} else if (document.getElementById('itemId').value == '')

			{

				alert('Plz, Select Product..!');

				document.getElementById('itemId').focus();

			} else

			{

				var proType = document.getElementById('proType').value;

				var compId = document.getElementById('compId').value;

				var locId = document.getElementById('location').value;

				var eType = document.getElementById('txteType').value;

				var item = document.getElementById('itemId').value;

				if (eType == 'OUT')

				{

					//alert(aa);

					var scripturl = 'getProductBctNo.php?iType=' + iType + '&compId=' + compId + '&locId=' + locId + '&eType=' + eType + '&itemId=' + itemId;

					//alert(scripturl);

					$.ajax({
						url: scripturl,
						success: function(res)

						{

							//alert(res);

							//$("#bctNo").html(res).trigger("chosen:updated.chosen");		

							$("#bctNo").html(res).trigger("chosen:updated.chosen");

						}
					});

				}

			}

		}



		async function geteType()

		{

			if (document.getElementById('eType').value == '0')

			{

				alert('Plz, Select Entry Type..!');

				document.getElementById('eType').focus();

			} else

			{

				let user = JSON.parse(localStorage.getItem('user'));
				if (user == null) {
					window.location.href = 'index.php';
				}
				let userId = user.User.userId;
				let token = user.token;
				var entryId = document.getElementById('eType').value;
				let id;
				await $.ajax({

					type: "GET",
					url: `http://localhost:8080/manage/get/entry/${entryId}`,
					headers: {
						Authorization: token
					},
					contentType: 'application/json',
					success: function(data) {
						id = data;
					},
					error: function(error) {
						alert(JSON.stringify(error));
					}
				});
				await new Promise(r => setTimeout(r, 200));
				document.getElementById('txteType').value = id;

				if (id == 'OUT')

				{

					//lblbct,lblbct2,divbct,bctNo

					document.getElementById('lblbct').style.visibility = 'visible';

					document.getElementById('lblbct').style.overflow = 'visible';

					document.getElementById('lblbct').style.height = 'auto';



					document.getElementById('lblbct2').style.visibility = 'visible';

					document.getElementById('lblbct2').style.overflow = 'visible';

					document.getElementById('lblbct2').style.height = 'auto';



					document.getElementById('divbct').style.visibility = 'visible';

					document.getElementById('divbct').style.overflow = 'visible';

					document.getElementById('divbct').style.height = 'auto';

				} else

				{

					//lblbct,lblbct2,divbct,bctNo

					document.getElementById('lblbct').style.visibility = 'hidden';

					document.getElementById('lblbct').style.overflow = 'hidden';

					document.getElementById('lblbct').style.height = '0px';



					document.getElementById('lblbct2').style.visibility = 'hidden';

					document.getElementById('lblbct2').style.overflow = 'hidden';

					document.getElementById('lblbct2').style.height = '0px';



					document.getElementById('divbct').style.visibility = 'hidden';

					document.getElementById('divbct').style.overflow = 'hidden';

					document.getElementById('divbct').style.height = '0px';

				}

			}

		}

		async function getInfo(tableID)

		{


			var b = 0;

			var typ = 0;

			var res = document.getElementById('itemId');
			var res1 = document.getElementById('itemId').value;

			var arr = res1.split(',');

			var proType = document.getElementById('proType').value;



			var id = arr[0].trim();
			b = 0;

			if (document.getElementById('eType').value == '0')

			{

				alert('Plz, Select Entry Type...!');

				document.getElementById('eType').focus();

			} else

			{

				var eType = document.getElementById('txteType').value;

				var eTypeId = document.getElementById('eType').value;

				var txteType = document.getElementById('txteType').value;

				var compId = document.getElementById('compId').value;

				var locId = document.getElementById('location').value;

				var dt = document.getElementById('txtdt').value;

				var bctNo = "";

				var stkId2 = 0;

				var stkId = 0;

				var bsts = 0;

				if (bsts == '0') {

					{
						var cnt = 1;

						var product = res.options[res.selectedIndex].text;

						var str = product.split(' - ');

						var itemId = cnt;

						var sagecd = str[0];

						var focuscd = str[1];

						var desp = str[2];

						var mont = parseInt(arr[2]);

						var expdt = addMonths(dt, mont);

						var productRegisterId = arr[0];

						var locationId = document.getElementById('location').value;

						var stkqty;
						let user = JSON.parse(localStorage.getItem('user'));
						if (user == null) {
							window.location.href = 'index.php';
						}
						let userId = user.User.userId;
						let token = user.token;
						if (txteType == 'OUT') {

							bctNo1 = document.getElementById('bctNo');
							bctNo = bctNo1.options[bctNo1.selectedIndex].text;
							stkqty = document.getElementById('bctNo').value;
						} else {
							await $.ajax({

								type: "GET",
								url: `http://localhost:8080/manage/get/qty/${productRegisterId}/${locationId}`,
								headers: {
									Authorization: token
								},
								contentType: 'application/json',
								success: function(data) {
									stkqty = data;
								},
								error: function(error) {
									alert(JSON.stringify(error));
								}
							});
							await new Promise(r => setTimeout(r, 200));
						}
						var rordqty = arr[3];

						var rackNo = 0;

						//alert('Stock Qty : '+stkqty);

						var pItemId = document.getElementsByName("item_id[]");

						var pcompId = document.getElementsByName("cmpId[]");

						var plcId = document.getElementsByName("lcId[]"); //

						var peTypeId = document.getElementsByName("eTypesId[]");

						var batchdd = document.getElementsByName("batch[]");

						var pstkId = document.getElementsByName("stkId[]");

						var batchId = document.getElementsByName("stkId2[]");



						var flag = 0;

						for (var i = 0; i < pItemId.length; i++)

						{

							if (id == pItemId[i].value && compId == pcompId[i].value && locId == plcId[i].value && eTypeId == peTypeId[i].value && batchdd[i].value == bctNo && stkId == pstkId[i].value && stkId2 == batchId[i].value)

							{

								flag++;

							}

						}



						if (flag == 1)

						{

							alert("Product Already Added...!");

						} else

						{

							var table = document.getElementById(tableID);

							var rowCount = table.rows.length;

							var str = rowCount - 1;

							var row = table.insertRow(rowCount);

							if (rowCount == '1')

								counts = 0;



							var k = str + 1;

							var cell0 = row.insertCell(0);

							cell0.style.backgroundColor = "white";

							var element = document.createElement("input");

							element.type = "checkbox";

							element.name = "chkbox[]";

							element.id = "chkbox" + k;

							element.style.color = "black";

							element.style.fontWeight = "bold";

							cell0.appendChild(element);



							var element01 = document.createElement("input");

							element01.type = "hidden";

							element01.name = "cmpId[]";

							element01.id = "cmpId" + k;

							element01.value = document.getElementById('compId').value;

							cell0.appendChild(element01);



							var element02 = document.createElement("input");

							element02.type = "hidden";

							element02.name = "lcId[]";

							element02.id = "lcId" + k;

							element02.value = document.getElementById('location').value;

							cell0.appendChild(element02);



							var cell1 = row.insertCell(1);

							cell1.style.backgroundColor = "white";

							var element1 = document.createElement("label");

							element1.id = "sg" + k;

							element1.innerHTML = sagecd;

							element1.style.color = "black";

							element1.style.fontWeight = "bold";

							cell1.appendChild(element1);



							var cell2 = row.insertCell(2);

							cell2.style.backgroundColor = "white";

							var element2 = document.createElement("label");

							element2.id = "fc" + k;

							element2.innerHTML = focuscd;

							element2.style.color = "black";

							element2.style.fontWeight = "bold";

							cell2.appendChild(element2);



							/*var cell3 = row.insertCell(3);

							cell3.style.backgroundColor = "white";

							var element3 = document.createElement("label");

							element3.id="bar"+k;

							element3.innerHTML=bar;

							element3.style.color="black";

							element3.style.fontWeight="bold";

							cell3.appendChild(element3);*/



							var cell4 = row.insertCell(3);

							cell4.style.backgroundColor = "white";

							var element31 = document.createElement("input");

							element31.type = "hidden";

							element31.name = "item_id[]";

							element31.id = "item_id" + k;

							element31.value = arr[0];

							//cell3.appendChild(element31);	

							cell4.appendChild(element31);



							var element4 = document.createElement("label");

							element4.id = "desp" + k;

							element4.innerHTML = desp;

							element4.style.color = "black";

							element4.style.fontWeight = "bold";

							cell4.appendChild(element4);



							var cell5 = row.insertCell(4);

							cell5.style.backgroundColor = "white";

							var element5 = document.createElement("label");

							element5.id = "ety" + k;

							element5.style.color = "black";

							element5.style.fontWeight = "bold";

							element5.innerHTML = eType;

							cell5.appendChild(element5);



							var element51 = document.createElement("input");

							element51.type = "hidden";

							element51.name = "eTypesId[]";

							element51.id = "eTypesId" + k;

							element51.value = eTypeId;

							cell5.appendChild(element51);



							var element52 = document.createElement("input");

							element52.type = "hidden";

							element52.name = "eTypes[]";

							element52.id = "eTypes" + k;

							element52.value = txteType;

							cell5.appendChild(element52);



							if (txteType == 'OUT')

							{

								var cell6 = row.insertCell(5);

								cell6.style.backgroundColor = "white";

								var element6 = document.createElement("input");

								element6.type = "text";

								element6.name = "batch[]";

								element6.id = "batch" + k;

								element6.value = bctNo;

								element6.readOnly = true;

								element6.style.width = "150px";

								element6.style.backgroundColor = "#c3c2c2";

								element6.style.fontWeight = "bold";

								cell6.appendChild(element6);

							} else

							{

								var cell6 = row.insertCell(5);

								cell6.style.backgroundColor = "white";

								var element6 = document.createElement("input");

								element6.type = "text";

								element6.name = "batch[]";

								element6.id = "batch" + k;

								element6.value = bctNo;

								element6.tabIndex = '9.' + k;

								element6.style.width = "150px";

								cell6.appendChild(element6);

							}



							var cell7 = row.insertCell(6);

							cell7.style.backgroundColor = "white";

							var element7 = document.createElement("input");

							element7.type = "text";

							element7.name = "stkqty[]";

							element7.id = "stkqty" + k;

							element7.value = stkqty;

							element7.readOnly = true;

							element7.style.backgroundColor = "#c3c2c2";

							element7.style.fontWeight = "bold";

							element7.style.width = "100px";

							cell7.appendChild(element7);



							var cell8 = row.insertCell(7);

							cell8.style.backgroundColor = "white";

							var element8 = document.createElement("input");

							element8.type = "text";

							element8.name = "qty[]";

							element8.id = "qty" + k;

							element8.value = "1";

							element8.style.fontWeight = "bold";

							element8.tabIndex = '10.' + k;

							element8.style.width = "80px";

							element8.onchange = function()

							{

								calc();

							}

							cell8.appendChild(element8);



							var cell9 = row.insertCell(8);

							cell9.style.backgroundColor = "white";

							var element9 = document.createElement("input");

							element9.type = "text";

							element9.name = "bqty[]";

							element9.id = "bqty" + k;

							element9.value = stkqty;

							element9.style.backgroundColor = "#c3c2c2";

							element9.readOnly = true;

							element9.style.fontWeight = "bold";

							element9.style.width = "100px";

							cell9.appendChild(element9);



							var element91 = document.createElement("input");

							element91.type = "hidden";

							element91.name = "rordqty[]";

							element91.id = "rordqty" + k;

							element91.value = rordqty;

							element91.readOnly = true;

							element91.style.width = "80px";

							cell9.appendChild(element91);



							var element92 = document.createElement("input");

							element92.type = "hidden";

							element92.name = "rackNo[]";

							element92.id = "rackNo" + k;

							element92.value = rackNo;

							element92.readOnly = true;

							element92.style.width = "50px";

							cell9.appendChild(element92);



							if (txteType == 'OUT')

							{

								var cell10 = row.insertCell(9);

								cell10.style.backgroundColor = "white";

								var element10 = document.createElement("input");

								element10.type = "text";

								element10.name = "expdt[]";

								element10.id = "expdt" + k;

								element10.value = expdt;

								element10.style.width = "120px";

								element10.style.fontWeight = "bold";

								element10.readOnly = true;

								element10.style.backgroundColor = "#c3c2c2";

								cell10.appendChild(element10);

							} else

							{

								var cell10 = row.insertCell(9);

								cell10.style.backgroundColor = "white";

								var element10 = document.createElement("input");

								element10.type = "date";

								element10.name = "expdt[]";

								element10.id = "expdt" + k;

								element10.value = expdt;

								element10.style.width = "120px";

								element10.style.fontWeight = "bold";

								element10.readOnly = true;

								cell10.appendChild(element10);

							}



							var element11 = document.createElement("input");

							element11.type = "hidden";

							element11.name = "stkId[]";

							element11.id = "stkId" + k;

							element11.value = stkId;

							element11.style.width = "50px";

							cell10.appendChild(element11);



							var element12 = document.createElement("input");

							element12.type = "hidden";

							element12.name = "stkId2[]";

							element12.id = "stkId2" + k;

							element12.value = stkId2;

							element12.style.width = "50px";

							cell10.appendChild(element12);

							counts = counts + 1;


							document.getElementById('rec').value = k;

							if (k == '1' && document.getElementById('batch' + k).value == '')

							{



							} else if (document.getElementById('batch' + k).value == '')

							{



							} else

							{

								calc();

							}

							document.getElementById('txtsearch').value = "";

							$("#itemId").val(0).trigger("chosen:updated.chosen");

							$("#bctNo").val(0).trigger("chosen:updated.chosen");

						}

					}
				} else

				{

					alert('Select Batch No...');

					document.getElementById('bctNo').focus();

				}

			}



			if (typ == '0')

			{

				document.getElementById('txtsearch').focus();

				document.getElementById('txtsearch').value = "";

				$("#itemId").val(0).trigger("chosen:updated.chosen");

				$("#bctNo").val(0).trigger("chosen:updated.chosen");

			} else

			{

				document.getElementById('txtbar').value = "";

				document.getElementById('txtbar').focus();

			}

		}



		function calc()

		{

			var rec = parseInt(document.getElementById('rec').value);

			var totqty = 0;

			for (var i = 1; i <= rec; i++)

			{

				var etype = document.getElementById('eTypes' + i).value;

				var qty = parseFloat(document.getElementById('qty' + i).value);

				var stkqty = parseFloat(document.getElementById('stkqty' + i).value);

				var bqty = parseFloat(document.getElementById('bqty' + i).value);

				if (document.getElementById('batch' + i).value == '')

				{

					alert('Plz, Enter Batch / Lot No here...!');

					document.getElementById('batch' + i).focus();

					document.getElementById('qty' + i).value = "0";

				} else

				{

					var bbqty = 0;

					totqty = totqty + qty;

					if (etype == 'IN')

					{

						bbqty = qty + stkqty;

					} else

					{

						if (qty > stkqty)

						{

							alert('Enter less than Stock Qty...!');

							document.getElementById('qty' + i).value = "0";

							document.getElementById('qty' + i).focus();

						} else

						{

							bbqty = stkqty - qty;

						}

					}

					document.getElementById('bqty' + i).value = bbqty;

					//alert("Qty : "+qty+"||Stock Qty : "+stkqty+"||Bal.Qty : "+bqty+"|| Entry Type : "+etype);

				}

			}

			document.getElementById('counting').innerHTML = totqty;

		}



		function delRows(tableID)

		{

			var chkbox, cmpId, lcId, sg, fc, bar, item_id, desp, ety, eTypesId, batch, qty, expdt, tbl, len, stkqty, bqty, ref, nts;

			var count = parseInt(document.getElementById('rec').value);

			//alert('hi');

			tbl = document.getElementById(tableID);

			len = tbl.rows.length;

			//alert(len);	

			var n = 1; // assumes ID numbers start at zero

			for (var i = 1; i <= len; i++)

			{

				//alert(i+" : "+len);

				chkbox = document.getElementById("chkbox" + i);

				cmpId = document.getElementById("cmpId" + i);

				lcId = document.getElementById("lcId" + i);

				sg = document.getElementById("sg" + i);

				fc = document.getElementById("fc" + i);

				bar = document.getElementById("bar" + i);

				item_id = document.getElementById("item_id" + i);

				desp = document.getElementById("desp" + i);

				ety = document.getElementById("ety" + i);

				eTypesId = document.getElementById("eTypesId" + i);

				batch = document.getElementById("batch" + i);

				qty = document.getElementById("qty" + i);

				expdt = document.getElementById("expdt" + i);

				stkqty = document.getElementById("stkqty" + i);

				bqty = document.getElementById("bqty" + i);

				/*ref= document.getElementById("ref" + i);

				nts= document.getElementById("nts" + i);*/

				//alert("chkbox" + i+chkbox.checked);

				if (chkbox.checked)

				{

					//alert('Del : '+n);

					tbl.deleteRow(n);

					count--;

				} else

				{ //,,,,,,,,,

					chkbox.id = "chkbox" + n;

					cmpId.id = "cmpId" + n;

					lcId.id = "lcId" + n;

					sg.id = "sg" + n;

					fc.id = "fc" + n;

					bar.id = "bar" + n;

					item_id.id = "item_id" + n;

					desp.id = "desp" + n;

					ety.id = "ety" + n;

					eTypesId.id = "eTypesId" + n;

					batch.id = "batch" + n;

					qty.id = "qty" + n;

					expdt.id = "expdt" + n;

					stkqty.id = "stkqty" + n;

					bqty.id = "bqty" + n;

					/*ref.id = "ref" + n;

					nts.id = "nts" + n;*/

					++n;

				}

				//alert(count);

				document.getElementById('rec').value = count;

				calc();

			}



		}

		const addMonths = (dateString, monthsToAdd) => new Date(new Date(dateString).setMonth(new Date(dateString).getMonth() + monthsToAdd)).toISOString().slice(0, 10);


		$("#btn").click(async function() {

			let user = JSON.parse(localStorage.getItem('user'));
			if (user == null) {
				window.location.href = 'index.php';
			}
			let userId = user.User.userId;
			let token = user.token;
			var size = parseInt(document.getElementById('rec').value);
			var sageReference = document.getElementById('ref').value;
			var notes = document.getElementById('nts').value;
			var entryDate = document.getElementById('txtdt').value;
			var docNo = document.getElementById('txtserialno').value;
			for (var i = 1; i <= size; i++) {

				var productRegisterId = document.getElementById('item_id' + i).value;
				var entryId = document.getElementById('eTypesId' + i).value;
				var locationId = document.getElementById('lcId' + i).value;
				var batchNo = document.getElementById('batch' + i).value;
				var qty = document.getElementById('qty' + i).value;
				var expiryDate = document.getElementById('expdt' + i).value;

				if(qty <= 0) {
					alert("qty is zero");
					return;
				}

				var url = `http://localhost:8080/manage/add/stockRegister/${locationId}/${entryId}/${productRegisterId}/${docNo}/${userId}`;

				var jsonData = {
					"entryDate": entryDate,
					"sageReference": sageReference,
					"notes": notes,
					"batchNo": batchNo,
					"qty": qty,
					"expiryDate": expiryDate
				}

				// the script where you handle the form input.

				await $.ajax({

					type: "POST",
					url: url,
					headers: {
						Authorization: token
					},
					data: JSON.stringify(jsonData),
					contentType: 'application/json',

					success: function(data) {
						alert('Record Inserted Successfully');
					},
					error: function(error) {
						alert(JSON.stringify(error));
					}
				});
				await new Promise(r => setTimeout(r, 200));
			}
			window.location.href = 'inventoryEntry.php';
		});

		function view(id)

		{

			//alert('hi');

			window.open("getinventoryview.php?ID=" + id, "_blank", "toolbar=yes, scrollbars=yes, resizable=no, top=60, left=0, width=1000, height=600");

		}

		function showProduct()

		{

			if (document.getElementById('rbmn').checked == true)

			{

				document.getElementById('typ').value = "0";

				document.getElementById('lbl1').innerHTML = 'Product';

				document.getElementById('rmshow').style.visibility = 'visible';

				document.getElementById('rmshow').style.overflow = 'visible';

				document.getElementById('rmshow').style.height = "auto";

				document.getElementById('fgbar').style.visibility = 'hidden';

				document.getElementById('fgbar').style.overflow = 'hidden';

				document.getElementById('fgbar').style.height = "0px";

			}

			if (document.getElementById('rbsc').checked == true)

			{

				document.getElementById('typ').value = "1";

				document.getElementById('lbl1').innerHTML = 'Barcode';

				document.getElementById('fgbar').style.visibility = 'visible';

				document.getElementById('fgbar').style.overflow = 'visible';

				document.getElementById('fgbar').style.height = "auto";

				document.getElementById('rmshow').style.visibility = 'hidden';

				document.getElementById('rmshow').style.overflow = 'hidden';

				document.getElementById('rmshow').style.height = "0px";

			}

		}
	</script>

</body>



</html>