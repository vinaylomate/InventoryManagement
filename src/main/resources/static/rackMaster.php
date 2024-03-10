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
    function getData() {
      let user = JSON.parse(localStorage.getItem('user'));
      if (user == null) {
        window.location.href = 'index.php';
      }
      let userId = user.User.userId;
      let token = user.token;
      let productTypeId = document.getElementById('iType').value;

      $.ajax({

        type: "GET",

        url: 'http://localhost:8080/manage/get/company/0/10',
        headers: {
          Authorization: token
        },
        //data: $("#companyMaster").serialize(), // serializes the form's elements.
        contentType: 'application/json',

        success: function(data) {
          let productTypeDD = document.getElementById("iType");
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

      $.ajax({

        type: "GET",

        url: `http://localhost:8080/manage/get/allRack/0/100`,
        headers: {
          Authorization: token
        },
        //data: $("#companyMaster").serialize(), // serializes the form's elements.
        contentType: 'application/json',

        success: function(data) {
          let tbody = document.querySelector('#dataTable tbody');
          let index = 0;
          data.forEach((data) => {
            let row = `<tr style="text-align: center">
              <td>${++index}</td>
              <td >${data.productType.productTypeName}</td>
              <td>${data.rackNumber}</td>
              <td>
                <i class="fa fa-trash" style="color:#f00">
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

    function contactvalidation()

    {

      var contact = document.getElementById('txtph').value;

      //alert(s_name);

      var scriptUrl = 'getph.php?txtcontact=' + contact;

      $.ajax({
        url: scriptUrl,
        success: function(result)

        {

          //alert(result);

          var str = result;

          if (str == 1)

          {

            alert('This Contact No Already Exist..!');

            document.getElementById('txtph').value = '';

            document.getElementById('txtph').focus();

          }



          // $("#s_id").html(str);

        }

      });

    }



    function mobvalidation()

    {

      var mobile = document.getElementById('txtmob').value;

      //alert(mobile);

      var scriptUrl = 'getmob.php?txtmob=' + mobile;

      $.ajax({
        url: scriptUrl,
        success: function(result)

        {

          //alert(result);

          var str = result;

          if (str == 1)

          {

            alert('This Mobile No Already Exist..!');

            document.getElementById('txtmob').value = '';

            document.getElementById('txtmob').focus();

          }



          // $("#s_id").html(str);

        }

      });

    }
  </script>

  <script>
    function edit(id)

    {

      //alert('hi');

      window.open("getUOM_details.php?ID=" + id, "_blank", "toolbar=yes, scrollbars=yes, resizable=no, top=60, left=0, width=700, height=600");

    }



    function del(id, user)

    {





      var r = confirm("Do you want to Delete this Record....?");

      if (r == true) {

        var scriptUrl = 'del_uom_master.php?id=' + id + '&userId=' + user;

        //alert(scriptUrl);

        $.ajax({
          url: scriptUrl,
          success: function(result)

          {

            alert('Record Deleted Successfully...');

            window.location.href = 'UOMMst.php';

          }
        });



      } else {

        txt = "You Pressed Cancel!";

      }



    }
  </script>



  <script>
    function getrbtn()

    {

      if (document.getElementById('csvfile').checked == true)

      {

        document.getElementById('first').style.visibility = "visible";

        document.getElementById('first').style.overflow = "visible";

        document.getElementById('first').style.height = "auto";



        document.getElementById('second').style.visibility = "hidden";

        document.getElementById('second').style.overflow = "visible";

        document.getElementById('second').style.height = "0px";

      } else

      {

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



<body id="page-top" onload="getData();">



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

            <h1 class="h4 mb-0 text-gray-800" style="height:0px;padding-bottom: 10px;">Rack Master</h1>

          </div>



          <div class="card o-visible border-0 shadow-lg my-2">

            <div class="card-body p-0">

              <!-- Nested Row within Card Body -->

              <div class="row">

                <div class="col-lg-12">

                  <div class="p-2">

                    <div id="second">

                      <form class="user" action="#" method="POST" id="companyMaster" name="companyMaster" enctype="multipart/form-data">

                        <input type="hidden" id="uid" name="uid" value="<?php echo $_SESSION['uId'] ?>">

                        <table cellpadding="5px">

                          <td valign="top"><label class="m-0 font-weight-bold text-primary">Product Type</label></td>

                          <td valign="top">:</td>

                          <td valign="top">

                            <select class="form-control form-control-sm" id="iType" name="iType" tabindex="1" autofocus style="width:250px;">

                            </select>

                          </td>



                          <td valign="top"><label class="m-0 font-weight-bold text-primary">Rack Number</label></td>

                          <td valign="top">:</td>

                          <td valign="top">

                            <input type="text" class="form-control form-control-sm" id="txtrkNo" name="txtrkNo" placeholder="Rack Number" tabindex="2" onKeyUp="ChangeCase(this);" style="width:250px;">

                          </td>

                        </table>

                        <button type="button" id="btnsubmit" name="btnsubmit" class="btn btn-primary" tabindex="3">Create</button>

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

              <h6 class="m-0 font-weight-bold text-primary">Rack Register</h6>

            </div>

            <div class="card-body">

              <div class="table-responsive">

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                  <thead>

                    <tr style="background-color:#b02923">

                      <th style="color:#fff;text-align:center">Sr.No.</th>

                      <th style="color:#fff;text-align:center">Product Category</th>

                      <th style="color:#fff;text-align:center">Rack No.</th>

                      <!--<th style="color:#fff;text-align:center">Edit</th>-->

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
  <!-- 
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>

  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script> -->



  <!-- Page level custom scripts -->

  <!-- <script src="js/demo/datatables-demo.js"></script> -->

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
    $("#btnsubmit").click(function()

      {

        /*alert("hi");

        alert(document.getElementById("desc").value);*/



        if ($("#iType").val().trim() == "0")

        {

          $("#iType").addClass("require");

          alert("Please Select Product Category..!!");

          $("#iType").focus();

          return false;

          //alert("bye");

        } else if ($("#txtrkNo").val().trim() == "" || $("#txtrkNo").val().trim() == "0")

        {

          $("#txtrkNo").addClass("require");

          alert("Please Enter Rack Number..!!");

          $("#txtrkNo").focus();

          return false;

          //alert("bye");

        } else

        {

          document.getElementById('btnsubmit').disabled = true;
          let user = JSON.parse(localStorage.getItem('user'));
          if (user == null) {
            window.location.href = 'index.php';
          }
          let userId = user.User.userId;
          let token = user.token;
          let productTypeId = document.getElementById('iType').value;
          let rackNumber = document.getElementById('txtrkNo').value;

          var url = `http://localhost:8080/manage/add/rack/${productTypeId}/${userId}`;

          var jsonData = {
            "rackNumber": rackNumber,
          }

          $.ajax({

            type: "POST",

            url: url,
            headers: {
              Authorization: token
            },

            //data: $("#companyMaster").serialize(), // serializes the form's elements.
            data: JSON.stringify(jsonData),
            contentType: 'application/json',

            success: function(data) {
              alert('Record Inserted Successfully');
              document.getElementById('btnsubmit').disabled = false;
              window.location.href = 'rackMaster.php';
            },
            error: function(error) {
              alert(JSON.stringify(error));
            }
          });

          e.preventDefault();

        }

        // avoid to execute the actual submit of the form.

      });



    function ChangeCase(elem)

    {

      elem.value = elem.value.toUpperCase();

    }

    function getUOM() {
      let user = JSON.parse(localStorage.getItem('user'));
      if (user == null) {
        window.location.href = 'index.php';
      }
      let userId = user.User.userId;
      let token = user.token;
      $.ajax({

        type: "GET",

        url: 'http://localhost:8080/manage/get/rack/0/10',
        //data: $("#companyMaster").serialize(), // serializes the form's elements.
        contentType: 'application/json',
        headers: {
          Authorization: token
        },

        success: function(data) {
          let tbody = document.querySelector("#dataTable tbody");
          data.forEach((type) => {
            let row = `<tr style="text-align: center">
								<td >${type.uomId}</td>
								<td>${type.uomName}</td>
								<td>${type.uomDescription}</td>
								<td></td>
								<td></td>
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

</body>



</html>