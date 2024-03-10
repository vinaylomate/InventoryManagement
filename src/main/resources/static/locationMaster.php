<?php
//include('log_check.php');
//
//$cmpId=$_SESSION['cmpId'];
//
//$uiType=$_SESSION['iType'];
//
//$userId=$_SESSION['uId'];
//
//$uRole=$_SESSION['uRole'];

//echo $cmpId."<Br>";

?>

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
		function deleteLocation(id) {
			let user = JSON.parse(localStorage.getItem('user'));
			if (user == null) {
				window.location.href = 'index.php';
			}
			let userId = user.User.userId;
			let token = user.token;
			let url = `http://localhost:8080/manage/delete/location/${parseInt(id)}/${parseInt(userId)}`;
			$.ajax({

				type: "DELETE",

				url: url,
				headers: {
					Authorization: token
				},

				//data: $("#companyMaster").serialize(), // serializes the form's elements.
				contentType: 'application/json',

				success: function(data) {
					alert('Record Deleted Successfully');
					window.location.href = 'locationMaster.php';
				},
				error: function(error) {
					alert(JSON.stringify(error));
				}
			});
		}

		function edit(id, user) {

			//alert('hi');

			window.open("getlocation_details.php?ID=" + id, "_blank", "toolbar=yes, scrollbars=yes, resizable=no, top=60, left=0, width=700, height=600");

		}



		function del(id, user) {



			var r = confirm("Do you want to Delete this Record....?");

			if (r == true) {

				var scriptUrl = 'del_loc_master.php?id=' + id + '&userId=' + user;

				$.ajax({
					url: scriptUrl,
					success: function(result) {

						alert('Record Deleted Successfully...');

						window.location.href = 'locationMaster.php';

					}
				});



			} else {

				txt = "You Pressed Cancel!";

			}

		}
	</script>



	<script>
		function getrbtn() {

			if (document.getElementById('csvfile').checked == true) {

				document.getElementById('first').style.visibility = "visible";

				document.getElementById('first').style.overflow = "visible";

				document.getElementById('first').style.height = "auto";



				document.getElementById('second').style.visibility = "hidden";

				document.getElementById('second').style.overflow = "visible";

				document.getElementById('second').style.height = "0px";

			} else {

				document.getElementById('first').style.visibility = "hidden";

				document.getElementById('first').style.overflow = "hidden";

				document.getElementById('first').style.height = "0px";



				document.getElementById('first').style.visibility = "hidden";

				document.getElementById('first').style.overflow = "hidden";

				document.getElementById('first').style.height = "0px";

			}



		}
	</script>

</head>



<body id="page-top" onLoad="getLocationData()">

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

						<h1 class="h4 mb-0 text-gray-800" style="height:0px;padding-bottom: 10px;">Location Master</h1>

					</div>



					<div class="card o-visible border-0 shadow-lg my-2">

						<div class="card-body p-0">

							<!-- Nested Row within Card Body -->

							<div class="row">

								<div class="col-lg-12">

									<div class="p-2">



										<div id="second">

											<form class="user" action="#" method="post" id="locationMaster" name="locationMaster">

												<input type="hidden" id="uid" name="uid" value="1">

												<table cellpadding="5px" align="center">

													<tr>

														<td>

															<label class="m-0 font-weight-bold text-primary">Company
																Name </label>

														</td>

														<td>:</td>

														<td>

															<select class="form-control form-control-sm" id="company_id" name="company_id" tabindex="1" style="width:220px;">


															</select>

														</td>

														<td>

															<label class="m-0 font-weight-bold text-primary">Product
																Category </label>

														</td>

														<td>:</td>

														<td>

															<select class=" form-control form-control-sm" id="iType" name="iType" tabindex="1.1" style="width250px;" required>



															</select>

														</td>

													</tr>



													<tr>

														<td>

															<label class="m-0 font-weight-bold text-primary">Location
																Code </label>

														</td>

														<td>:</td>

														<td>

															<input type="text" class="form-control form-control-sm" id="txtlcode" name="txtlcode" placeholder="Location Code" tabindex="2" onKeyUp="ChangeCase(this);" onChange="getcodeLen();" maxlength="6" required>

														</td>

														<td>

															<label class="m-0 font-weight-bold text-primary">Location
																Name </label>

														</td>

														<td>:</td>

														<td>

															<input type="text" class="form-control form-control-sm" id="txtnm" name="txtnm" placeholder="Location Name" tabindex="2.1" onKeyUp="ChangeCase(this);" required>

														</td>

													</tr>



													<tr>

														<td>

															<label class="m-0 font-weight-bold text-primary">Description
															</label>

														</td>

														<td>:</td>

														<td>

															<textarea id="description" name="description" class="form-control form-control-sm" placeholder="Description" tabindex="3" onKeyUp="ChangeCase(this);" required></textarea>

														</td>

														<td>

															<button type="button" id="btnsubmit" name="btnsubmit" class="btn btn-primary" tabindex="4">Create</button>

														</td>

														<td></td>

													</tr>

												</table>







											</form>

										</div>

									</div>

								</div>

							</div>

						</div>

					</div>



					<!-- DataTales Example -->

					<div class="card shadow mb-4">

						<div class="card-header py-3">

							<h6 class="m-0 font-weight-bold text-primary">Location Register</h6>

						</div>

						<div class="card-body">

							<div class="table-responsive">

								<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

									<thead>

										<tr style="background-color:#b02923">

											<th style="color:#fff;text-align:center">Sr.No.</th>

											<th style="color:#fff;text-align:center">Company Name</th>

											<th style="color:#fff;text-align:center">Product Category</th>

											<th style="color:#fff;text-align:center">Location Code</th>

											<th style="color:#fff;text-align:center">Location Name</th>

											<th style="color:#fff;text-align:center">Description</th>

											<th style="color:#fff;text-align:center">Delete</th>

										</tr>

									</thead>

									<!--					'<td align="center"><a href="javascript:del('.$id.','.$userId.')"><i class="fa fa-trash" style="color:#F00"></i></a></td>';-->

									<tbody></tbody>


								</table>

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





	<!-- Page level custom scripts -->



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
	</script>

	<script type="text/javascript">
		$("#btnsubmit").click(function(e) {

			/*alert("hi");
		
			alert(document.getElementById("desc").value);*/





			if ($("#company_id").val().trim() == "0") {

				$("#company_id").addClass("require");

				alert("Please Select Company Name..!!");

				$("#company_id").focus();

				return false;

				//alert("bye");

			} else if ($("#iType").val().trim() == "0") {

				$("#iType").addClass("require");

				alert("Please Select Product Category..!!");

				$("#iType").focus();

				return false;

				//alert("bye");

			} else if ($("#txtlcode").val().trim() == "") {

				$("#txtlcode").addClass("require");

				alert("Please Enter Location Code..!!");

				$("#txtlcode").focus();

				return false;

				//alert("bye");

			} else if ($("#txtnm").val().trim() == "") {

				$("#txtnm").addClass("require");

				alert("Please Enter Location Name..!!");

				$("#txtnm").focus();

				return false;

			} else if ($("#description").val().trim() == "") {

				$("#description").addClass("require");

				alert("Please Enter Description..!!");

				$("#description").focus();

				return false;

			} else {

				document.getElementById('btnsubmit').disabled = true;
				let companyId = document.getElementById('company_id').value;
				let productTypeId = document.getElementById('iType').value;
				let user = JSON.parse(localStorage.getItem('user'));
				if (user == null) {
					window.location.href = 'index.php';
				}
				let userId = user.User.userId;
				let token = user.token;

				var url = `http://localhost:8080/manage/add/location/${companyId}/${productTypeId}/${userId}`;

				//alert(url);
				console.log(url);
				let locationName = document.getElementById('txtnm').value;
				let locationDescription = document.getElementById('description').value;
				let locationCode = document.getElementById('txtlcode').value;
				// the script where you handle the form input.
				let jsonData = {
					"locationName": locationName,
					"locationDescription": locationDescription,
					"locationCode": locationCode
				};

				$.ajax({

					type: "POST",

					url: url,

					data: JSON.stringify(jsonData),

					headers: {
						Authorization: token
					},

					contentType: 'application/json',

					success: function(data) {

						alert("Record Inserted Successfully!!!");
						document.getElementById('btnsubmit').disabled = false;
						window.location.href = 'locationMaster.php';
					},
					error: function(error) {
						console.log(error);
					}

				});



				e.preventDefault();

			}

			// avoid to execute the actual submit of the form.

		});

		function ChangeCase(elem) {

			elem.value = elem.value.toUpperCase();

		}



		function getcodeLen() {

			var cd = document.getElementById('txtlcode').value;

			//if(cd.length<6 || cd.length>6)

			if (cd.length > 6) {

				alert("Plz, Enter Location Code 6 Characters Only...!");

				document.getElementById('txtlcode').value = "";

				document.getElementById('txtlcode').focus();

			}

		}

		function getLocationData() {
			let user = JSON.parse(localStorage.getItem('user'));
			if (user == null) {
				window.location.href = 'index.php';
			}
			let userId = user.User.userId;
			let token = user.token;
			$.ajax({

				type: "GET",

				url: 'http://localhost:8080/manage/get/company/0/10',
				headers: {
					Authorization: token
				},
				//data: $("#companyMaster").serialize(), // serializes the form's elements.
				contentType: 'application/json',

				success: function(data) {
					let companyDD = document.getElementById("company_id");
					data.Company.forEach((company) => {
						let row = `<option value="${company.companyId}">${company.companyName}</option>`;
						companyDD.innerHTML += row;
					});

					let productTypeDD = document.getElementById("iType");

					data.ProductType.forEach((type) => {
						let row = `<option value="${type.productTypeId}">${type.productTypeName}</option>`;
						productTypeDD.innerHTML += row;
					});
				},
				error: function(error) {
					alert(JSON.stringify(error));
				}
			});

			$.ajax({

				type: "GET",

				url: 'http://localhost:8080/manage/getAll/location/0/100',
				headers: {
					Authorization: token
				},
				//data: $("#companyMaster").serialize(), // serializes the form's elements.
				contentType: 'application/json',

				success: function(data) {
					let index = 0;
					let tbody = document.querySelector("#dataTable tbody");
					data.forEach((location) => {
						let row = `<tr style="text-align: center">
								<td >${++index}</td>
								<td>${location.company.companyName}</td>
								<td>${location.productType.productTypeName}</td>
								<td>${location.locationCode}</td>
								<td>${location.locationName}</td>
								<td>${location.locationDescription}</td>
								<td>
									<i class="fa fa-trash" style="color:#f00" onClick = "deleteLocation(${location.locationId});">
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
	</script>

	{
	compnay:[],
	material:[]
	}

</body>



</html>