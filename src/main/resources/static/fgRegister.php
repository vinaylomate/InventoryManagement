<!DOCTYPE html>

<html lang="en">

<head>

  <?php include("inc/meta.php"); ?>

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
    /* vinay pagination */

    function getSearch() {
      currentPage = 1;
      getMainData();
    }

    function deleteProduct(id) {
      let url = `http://192.168.0.138:8080/manage/delete/productRegister/${parseInt(id)}`;
      $.ajax({

        type: "DELETE",

        url: url,

        //data: $("#companyMaster").serialize(), // serializes the form's elements.
        contentType: 'application/json',

        success: function(data) {
          alert('Record Deleted Successfully');
          window.location.href = 'fgRegister.php';
        },
        error: function(error) {
          alert(JSON.stringify(error));
        }
      });
    }

    function getCompanyData() {
      $.ajax({

        type: "GET",

        url: 'http://192.168.0.138:8080/manage/get/company/0/10',
        contentType: 'application/json',

        success: function(data) {
          let comapanyDD = document.getElementById('compId');
          comapanyDD.innerHTML = `<option value="0">Select</option>`;
          data.Company.forEach((company) => {
            let row = `<option value="${company.companyId}">${company.companyName}</option>`;
            comapanyDD.innerHTML += row;
          });
        },
        error: function(error) {
          alert(JSON.stringify(error));
        }
      });
    }

    function getLocationData() {
      let companyId = document.getElementById('compId').value;
      $.ajax({

        type: "GET",

        url: `http://192.168.0.138:8080/manage/get/location/typeWise/${companyId}/2/0`,
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

    function getMainData() {
      var companyId = document.getElementById('compId').value == "" ? 0 : document.getElementById('compId').value;
      var locationId = document.getElementById('location').value == "" ? 0 : document.getElementById('location').value;
      var search = document.getElementById('txtsearch').value == "" ? "null" : document.getElementById('txtsearch').value;
      let pageSize = document.getElementById('itemsPerPageDropdown').value;
      $.ajax({

        type: "GET",

        url: `http://192.168.0.138:8080/manage/get/productRegister/${companyId}/${locationId}/2/0/${search}/${currentPage-1}/${pageSize}`,
        contentType: 'application/json',

        success: function(data) {
          totalCount = data.count;
          generatePagination(data.count, pageSize, currentPage);
          let tbody = document.querySelector('#dataTable tbody');
          let index = 0;
          tbody.innerHTML = "";
          data.data.forEach((data) => {
            let row = `<tr style="text-align: center">
              <td >${++index}</td>
              <td>${data.productCategory.productCategoryName}</td>
              <td>${data.sageCode}</td>
              <td>${data.focusCode}</td>
              <td>${data.description}</td>
              <td>${data.brandName}</td>
              <td>${data.uom.uomName}</td>
              <td>${data.company.companyCode} - ${data.company.companyName} - ${data.company.companyDescription}</td>
              <td>${data.location.locationName} - ${data.location.locationCode} - ${data.location.locationDescription}</td>
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

      window.open("getfgmaster_details.php?ID=" + id, "_blank", "toolbar=yes, scrollbars=yes, resizable=no, top=60, left=0, width=700, height=600");

    }



    function dataReset()

    {

      window.location.href = 'fgRegister.php';

    }



    function del(id, user)

    {

      var r = confirm("Do you want to Delete this Record....?");

      if (r == true) {

        var scriptUrl = 'del_fgMaster.php?id=' + id + '&userId=' + user;

        $.ajax({
          url: scriptUrl,
          success: function(result)

          {

            alert('Record Deleted Successfully...');

            window.location.href = 'fgMaster.php';

          }
        });



      } else {

        txt = "You Pressed Cancel!";

      }

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
                  <h1 class="h4 mb-0 text-gray-800" style="height:0px;padding-bottom: 10px;">FG Master Register</h1>
                </td>

                <td align="right"><a href="fgMaster.php" class="btn btn-warning" style="text-decoration: none;">Goto FG Master Entry</a></td>

              </tr>

            </table>

          </div>



          <!-- DataTales Example -->

          <div class="card shadow mb-4">

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

                          <select class="form-control form-control-sm" id="compId" name="compId" tabindex="1" style="width:250px;" onChange="getLocationData();getMainData();">


                          </select>

                        </td>





                        <td valign="top"><label class="m-0 font-weight-bold text-primary">Location</label></td>

                        <td valign="top">:</td>

                        <td valign="top">

                          <select class="form-control form-control-sm" id="location" name="location" tabindex="3" style="width:230px;" onChange="getMainData()">

                            <option value="0">Select</option>

                          </select>

                        </td>



                        <td valign="top"></td>

                        <td valign="top"></td>

                        <td valign="top"></td>

                        <td valign="top"><label class="m-0 font-weight-bold text-primary">Search</label></td>

                        <td valign="top">:</td>

                        <td valign="top"><input type="text" id="txtsearch" name="txtsearch" class="form-control" tabindex="3.1" onchange="getSearch();" onkeyup="getSearch();"></td>

                        <td valign="top"></td>

                        <td valign="top"></td>

                        <td valign="top"></td>

                        <td valign="top"></td>

                        <td valign="top"></td>

                        <td valign="top"></td>

                        <td valign="top"><input type="button" id="btnReset" name="btnReset" class="btn btn-warning" onClick="dataReset();" tabindex="3.3" value="Reset"></td>

                      </tr>



                      <tr>

                        <td valign="top"></td>

                        <td valign="top"></td>

                        <td valign="top"></td>



                        <td valign="top"></td>

                        <td valign="top"></td>

                        <td valign="top"></td>



                        <td valign="top"></td>

                        <td valign="top"></td>

                        <td valign="top">

                        </td>

                      </tr>



                      <tr>



                      </tr>



                    </table>

                  </div>

                </div>

              </div>

            </form>

            <div class="card-body">

              <div class="table-responsive">

                <div id="tbl">

                  <!--====pagination section start====-->

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
                  <!--====pagination section end====-->



                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                    <thead>

                      <tr style="background-color:#b02923">

                        <th style="color:#fff;text-align:center">Sr.No.</th>

                        <th style="color:#fff;text-align:center">Category</th>

                        <th style="color:#fff;text-align:center">Sage Code</th>

                        <th style="color:#fff;text-align:center">Focus Code</th>

                        <!--<th style="color:#fff;text-align:center">Barcode</th>-->

                        <th style="color:#fff;text-align:center">Description</th>

                        <th style="color:#fff;text-align:center">Brand</th>

                        <th style="color:#fff;text-align:center">UOM</th>

                        <th style="color:#fff;text-align:center">Company</th>

                        <th style="color:#fff;text-align:center">Location </th>

                        <th style="color:#fff;text-align:center">Reorder Level Qty</th>

                        <th style="color:#fff;text-align:center">Prod. Expiry</th>

                        <th style="color:#fff;text-align:center">Delete</th>

                      </tr>

                    </thead>

                    <tbody>

                    </tbody>

                    <!--<tfoot>

<tr>

<th>Sr.No.</th>

<th>Customer Code</th>

<th>Customer Name</th>

<th>Address</th>

<th>Contact No</th>

<th>Mobile No</th>

<th>Country</th>

</tr>

</tfoot>-->

                  </table>

                  <!--====pagination content end====-->



                  <!--====pagination section start====-->



                  <!--====pagination section end====-->

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

  <!--  <script src="vendor/datatables/jquery.dataTables.min.js"></script>

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
      }

    }

    for (var selector in config) {

      $(selector).chosen(config[selector]);

    }
  </script>

  <script type="text/javascript">
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

        var scriptUrl = 'getLocations.php?compId=' + id + '&iType=2' + '&uiType=' + uiType + '&uId=' + uId + '&uloc=' + uloc + '&ulocty=' + ulocty + '&urole=' + urole;

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



      if (document.getElementById('location').value == '0')

      {

        locId = "0";

      } else

      {

        locId = document.getElementById('location').value;

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

        url: 'getfgRegister.php',

        data: 'page=' + page_num + '&keywords=' + keywords + '&filterBy=' + filterBy + '&compId=' + compId + '&iType=2' + '&locId=' + locId + '&uId=' + uId + '&uiType=' + uType + '&urole=' + uRole + '&sType=0',

        beforeSend: function() {

        },

        success: function(html) {

          //alert(html);

          $('#tbl').html(html);

        }

      });

      /*var scriptUrl='getfgRegister.php?compId='+compId+'&iType=2'+'&locId='+locId+'&uId='+uId+'&uiType='+uType+'&role='+uRole+'&uloc='+uloc+'&srch='+srch;

	//alert(scriptUrl);

 	//dataTable

 	$('#tbl').load(scriptUrl);*/

    }
  </script>

</body>



</html>