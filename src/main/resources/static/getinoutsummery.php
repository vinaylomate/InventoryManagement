<!DOCTYPE html>

<html lang="en">



<head>



	<?php

	include("inc/meta.php");

	?>

	<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

	<script>
		function getData() {
			let user = JSON.parse(localStorage.getItem('user'));
			if (user == null) {
				window.location.href = 'index.php';
			}
			let userId = user.User.userId;
			let token = user.token;
			var sageCode = "";
			var fromDate = "";
			var endDate = "";
			var openingStock;
			var closingStock;
			var location = "";
			<?php
			$a = $_GET['PROID'];
			$b = $_GET['FROM'];
			$c = $_GET['END'];
			$d = $_GET['OPEN'];
			$e = $_GET['CLOSE'];
			$f = explode('-', $_GET['LOCATION']);
			echo "sageCode = '" . $a . "';";
			echo "fromDate = '" . $b . "';";
			echo "endDate = '" . $c . "';";
			echo "openingStock = '" . $d . "';";
			echo "closingStock = '" . $e . "';";
			echo "location = '" . $f[0] . "';";
			?>
			let url = `http://localhost:8080/manage/viewInOut/stockRegister/${location}/${sageCode}/${fromDate}/${endDate}`;
			$.ajax({

				type: "GET",
				headers: {
					Authorization: token
				},
				url: url,
				contentType: 'application/json',

				success: function(data) {

					let size = data.length;
					let tbody = document.querySelector('#dataTable tbody');
					let index = 0;
					let inQty = 0,
						outQty = 0,
						stockQty = 0;
					let open = 0;
					tbody.innerHTML = "";
					let row = `<tr style="text-align: center; background-color:#e1736e; color: #000;">
						<td>No</td>
						<td>Date</td>
						<td>Sage Reference</td>
						<td>Sage Code</td>
						<td>Focus Code</td>
						<td>Batch No</td>
						<td>Opening Stock</td>
						<td>In</td>
						<td>Out</td>
						<td>Running Stock</td>
						<td>Entry Type</td>
						</tr>`;
					tbody.innerHTML += row;
					data.forEach((data) => {
						if(index == size) {
							document.getElementById('to').innerHTML = data.entryDate;
						}
						location = data.location.locationCode + " - " + data.location.locationName + " - " + data.location.locationDescription;
						if (index == 0) {
							document.getElementById('from').innerHTML = data.entryDate;
							row = `<tr style="text-align: center">
								<td></td>
								<td>${data.entryDate}</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td>${openingStock}</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								</tr>`;
							tbody.innerHTML += row;
							row = `<tr style="text-align: center">
								<td>${++index}</td>
								<td>${data.entryDate}</td>
								<td>${data.sageReference}</td>
								<td>${data.productRegister.sageCode}</td>
								<td>${data.productRegister.focusCode}</td>
								<td>${data.batchNo}</td>
								<td>${openingStock}</td>`
							if (data.entry.entryType == "IN") {
								inQty += data.qty;
								row += `<td>${data.qty}</td>
									<td>0</td>`
							} else {
								outQty += data.qty;
								row += `<td>0</td>
									<td>${data.qty}</td>`
							}
							row += `<td>${data.currentQty}</td>
								<td>${data.entry.entryName}</td>
								</tr>`;
						} else {
							row = `<tr style="text-align: center">
								<td>${index}</td>
								<td>${data.entryDate}</td>
								<td>${data.sageReference}</td>
								<td>${data.productRegister.sageCode}</td>
								<td>${data.productRegister.focusCode}</td>
								<td>${data.batchNo}</td>
								<td>${open}</td>`
							if (data.entry.entryType == "IN") {
								inQty += data.qty;
								row += `<td>${data.qty}</td>
									<td>0</td>`
							} else {
								outQty += data.qty;
								row += `<td>0</td>
									<td>${data.qty}</td>`
							}
							row += `<td>${data.currentQty}</td>
								<td>${data.entry.entryName}</td>
								</tr>`;
						}
						open = data.currentQty;
						index++;
						tbody.innerHTML += row;
					});
					var currentDate = new Date();
					var day = currentDate.getDate();
					var month = currentDate.getMonth() + 1;
					var year = currentDate.getFullYear();

					var formattedDate = year + "-" + month + "-" + day;
					document.getElementById('location').innerHTML = location;
					document.getElementById('date').innerHTML = formattedDate;
					// document.getElementById('from').innerHTML = fromDate;
					// document.getElementById('to').innerHTML = endDate;
					document.getElementById('inQty').innerHTML = parseFloat(inQty);
					document.getElementById('outQty').innerHTML = parseFloat(outQty);
					document.getElementById('stockQty').innerHTML = Math.abs((parseFloat(openingStock) + parseFloat(inQty)) - parseFloat(outQty));
				},
				error: function(error) {
					alert(JSON.stringify(error));
				}
			});
		}
	</script>

</head>



<body id="page-top" onload="getData();">


	<!-- Page Wrapper -->

	<div id="wrapper">



		<!-- Sidebar -->



		<!-- End of Sidebar -->



		<!-- Content Wrapper -->

		<div id="content-wrapper" class="d-flex flex-column">



			<!-- Main Content -->

			<div id="content">



				<!-- Topbar -->



				<!-- End of Topbar -->



				<!-- Begin Page Content -->

				<div class="container-fluid">



					<!-- Page Heading -->

					<div class="d-sm-flex align-items-center justify-content-between mb-4">

						<h1 class="h4 mb-0 text-gray-800" style="height:0px;margin-top:10px"></h1>

					</div>



					<div class="card o-hidden border-0 shadow-lg my-5">

						<div class="card-body p-0">

							<!-- Nested Row within Card Body -->

							<div align="right" style="padding:5px">

								<input type="hidden" id="compId" name="compId" value="<?php echo $compId; ?>">

								<input type="hidden" id="iType" name="iType" value="<?php echo $iType; ?>">

								<input type="hidden" id="location" name="location" value="<?php echo $locId; ?>">

								<input type="hidden" id="fdt" name="fdt" value="<?php echo $fdt; ?>">

								<input type="hidden" id="tdt" name="tdt" value="<?php echo $tdt; ?>">

								<input type="hidden" id="txtsearch" name="txtsearch" value="<?php echo $srch; ?>">

								<input type="hidden" id="uid" name="uid" value="<?php echo $uId; ?>">

								<input type="hidden" id="uiType" name="uiType" value="<?php echo $uiType; ?>">

								<input type="hidden" id="urole" name="urole" value="<?php echo $uRole; ?>">

								<input type="hidden" id="uloc" name="uloc" value="<?php echo $uloc; ?>">

								<input type="hidden" id="itemId" name="itemId" value="<?php echo $itemId; ?>">



								<table>

									<tr>

										<td><a href="javascript:getexcel();"><img src="img/EXCELIMG1.png" alt="download" title="download" style="width:50px; height:50px"></a></td>

										<td><input type="button" onClick="print2()" value="Print" class="btn btn-primary" /></td>

										<td><input type="button" onClick="closeFn()" value="X" class="btn btn-danger" /></td>

									</tr>

								</table>

							</div>





							<div class="row">

								<div class="col-lg-12">

									<page id="getdata">

										<div class="p-5">

											<div style="padding-bottom:2px;font-size:30px;font-weight:bold;" align="center">

												<!--<img src="img/logo1.jpg" style="height:180px;width:100%">-->RITVER <span style="font-size:14px;">PAINTS & COATINGS</span>

												<hr>

											</div>

											<div class="row">

												<div class="col-md-6">

													<div class="row">

														<div class="col-md-4" style="font-weight:600">Date :</div>

														<div class="col-md-8"><label id="date"></label></div>

													</div>

												</div>



												<div class="col-md-6">

													<div class="row">

														<div class="col-md-4" style="font-weight:600">Location :</div>

														<div class="col-md-8"><label id="location"></label></div>

													</div>

												</div>





											</div>



											<div class="row" style="margin-top:15px">

												<div class="col-md-6">

													<div class="row">

														<div class="col-md-4" style="font-weight:600">From Date:</div>

														<div class="col-md-8"><label id="from"></label></div>

													</div>

												</div>



												<div class="col-md-6">

													<div class="row">

														<div class="col-md-4" style="font-weight:600">To Date :</div>

														<div class="col-md-8"><label id="to"></label></div>

													</div>

												</div>



											</div>



											</td>

											</tr>
											<div style="margin-top:25px">

												<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

													<tr id="aa" style="background-color:#e1736e;">

														<th style="color:#000">No</th>

														<th style="color:#000">Date</th>

														<th style="color:#000">Sage Reference</th>

														<th style="color:#000">Sage Code</th>

														<th style="color:#000">Focus Code</th>

														<th style="color:#000">Batch No</th>

														<th style="color:#000">Opening Stock</th>

														<th style="color:#000">IN</th>

														<th style="color:#000">OUT</th>

														<th style="color:#000">Running Stock</th>

														<th style="color:#000">Entry Type</th>

													</tr>

													<tbody>

													</tbody>

													<tfoot>


														<tr id="aa" style="background-color:#e1736e;" align="center">

															<th style="color:#000"></th>

															<th style="color:#000"></th>

															<th style="color:#000"></th>

															<th style="color:#000"></th>

															<th style="color:#000"></th>

															<th style="color:#000">Total</th>

															<th style="color:#000"></th>

															<th style="color:#000"><label id="inQty"></label></th>

															<th style="color:#000"><label id="outQty"></label></th>

															<th style="color:#000"><label id="stockQty"></label></th>

															<th style="color:#000"></th>

														</tr>


													</tfoot>

												</table>

											</div>



										</div>

									</page>

									<!---->

								</div>

							</div>

						</div>

					</div>



					<!-- DataTales Example -->





				</div>

				<!-- /.container-fluid -->



			</div>

			<!-- End of Main Content -->



			<!-- Footer -->



			<!-- End of Footer -->



		</div>

		<!-- End of Content Wrapper -->



	</div>

	<!-- End of Page Wrapper -->



	<!-- Scroll to Top Button-->

	<a class="scroll-to-top rounded" href="#page-top">

		<i class="fas fa-angle-up"></i>

	</a>

	<script>
		// $(window).load(function() {

		// 	$('#tbl').DataTable({});

		// });



		function print2()

		{

			var printContents = document.getElementById('getdata').innerHTML;

			var originalContents = document.body.innerHTML;

			document.body.innerHTML = printContents;

			window.print();

			document.body.innerHTML = originalContents;



		}

		function closeFn()

		{

			history.back();

		}



		function getexcel()

		{

			var compId, locId, iType, fdt, tdt, srch;

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



			if (document.getElementById('txtsearch').value == '')

			{

				srch = '0';

			} else

			{

				srch = document.getElementById('txtsearch').value;

				srch = encodeURIComponent(srch);

			}



			var uId = document.getElementById('uid').value;

			var uType = document.getElementById('uiType').value;

			var uRole = document.getElementById('urole').value;

			var uloc = document.getElementById('uloc').value;

			var itemId = document.getElementById('itemId').value;



			var scriptUrl = 'inoutReportsummeryEx.php?compId=' + compId + '&iType=' + iType + '&locId=' + locId + '&uId=' + uId + '&fdt=' + fdt + '&tdt=' + tdt + '&uiType=' + uType + '&role=' + uRole + '&uloc=' + uloc + '&srch=' + srch + '&itemId=' + itemId;

			//alert(scriptUrl);

			//dataTable

			window.open(scriptUrl, "toolbar=yes, scrollbars=yes, resizable=no, top=60, left=0, width=1000, height=600");

		}
	</script>

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


</body>



</html>