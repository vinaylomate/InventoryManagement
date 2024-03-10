<!DOCTYPE html>

<html lang="en">



<head>



  <?php

  include("inc/meta.php");

  ?>

  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  <script>
    function contactvalidation() {

      var contact = document.getElementById('txtph').value;

      //alert(s_name);

      var scriptUrl = 'getph.php?txtcontact=' + contact;

      $.ajax({
        url: scriptUrl,
        success: function(result) {

          //alert(result);

          var str = result;

          if (str == 1) {

            alert('This Contact No Already Exist..!');

            document.getElementById('txtph').value = '';

            document.getElementById('txtph').focus();

          }



          // $("#s_id").html(str);

        }

      });

    }



    function mobvalidation() {

      var mobile = document.getElementById('txtmob').value;

      //alert(mobile);

      var scriptUrl = 'getmob.php?txtmob=' + mobile;

      $.ajax({
        url: scriptUrl,
        success: function(result) {

          //alert(result);

          var str = result;

          if (str == 1) {

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
    function deleteCompany(id) {
      let user = JSON.parse(localStorage.getItem('user'));
			if (user == null) {
				window.location.href = 'index.php';
			}
			let userId = user.User.userId;
			let token = user.token;
      let url = `http://localhost:8080/manage/delete/company/${parseInt(id)}/${parseInt(userId)}`;
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
          window.location.href = 'companyMaster.php';
        },
        error: function(error) {
          alert(JSON.stringify(error));
        }
      });
    }

    function edit(id) {

      //alert('hi');
      let user = JSON.parse(localStorage.getItem('user'));
			if (user == null) {
				window.location.href = 'index.php';
			}
      window.open("getcompany_details.php?ID=" + id+"&TOKEN="+user.token, "_blank", "toolbar=yes, scrollbars=yes, resizable=no, top=60, left=0, width=700, height=600");

    }



    function del(id, user) {





      var r = confirm("Do you want to Delete this Record....?");

      if (r == true) {

        var scriptUrl = 'del_company_master.php?id=' + id + '&userId=' + user;

        //alert(scriptUrl);

        $.ajax({
          url: scriptUrl,
          success: function(result) {

            alert('Record Deleted Successfully...');

            window.location.href = 'companyMaster.php';

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



<body id="page-top" onLoad="getCompanyData()">



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

            <h1 class="h4 mb-0 text-gray-800" style="height:0px;padding-bottom: 10px;">Company Master</h1>

          </div>



          <div class="card o-hidden border-0 shadow-lg my-2">

            <div class="card-body p-0">

              <!-- Nested Row within Card Body -->

              <div class="row">

                <div class="col-lg-12">

                  <div class="p-2">



                    <div id="second">

                      <form class="user" action="#" method="POST" id="companyMaster" name="companyMaster" enctype="multipart/form-data">

                        <input type="hidden" id="uid" name="uid" value="<?php echo $_SESSION['uId'] ?>">

                        <input type="hidden" id="cmpcode" name="cmpcode" value="<?php echo $code ?>">

                        <table cellpadding="5px;">

                          <tr>

                            <td valign="top">

                              <label class="m-0 font-weight-bold text-primary">Company Code : </label>

                            </td>

                            <td valign="top">

                              <input type="text" class="form-control form-control-sm" id="txtcode" name="txtcode" placeholder="Company Code" value="" tabindex="1.1" required>

                            </td>

                            <td valign="top">

                              <label class="m-0 font-weight-bold text-primary">Company Name : </label>

                            </td>

                            <td valign="top">

                              <input type="text" class="form-control form-control-sm" id="txtnm" name="txtnm" placeholder="Company Name" tabindex="1.2" onKeyUp="ChangeCase(this);" required>

                            </td>

                            <td valign="top">

                              <label class="m-0 font-weight-bold text-primary">Description : </label>

                            </td>

                            <td valign="top">

                              <textarea id="desc" name="desc" class="form-control form-control-sm" placeholder="Description" tabindex="2" onKeyUp="ChangeCase(this);" required></textarea>

                            </td>

                          </tr>

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

              <h6 class="m-0 font-weight-bold text-primary">Company Register</h6>

            </div>

            <div class="card-body">

              <div class="table-responsive">

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                  <thead>

                    <tr style="background-color:#b02923">

                      <th style="color:#fff;text-align:center">Sr.No.</th>

                      <th style="color:#fff;text-align:center">Comp. Code</th>

                      <th style="color:#fff;text-align:center">Company Name</th>

                      <th style="color:#fff;text-align:center">Company Description</th>

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





  <!-- Page level custom scripts -->
  <script type="text/javascript">
    function getCompanyData() {
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
          let tbody = document.querySelector('#dataTable tbody');
          let index = 0;
          data.Company.forEach((data) => {
            let row = `<tr style="text-align: center">
                <td >${++index}</td>
                <td>${data.companyCode}</td>
                <td>${data.companyName}</td>
                <td>${data.companyDescription}</td>
                <td>
                  <i class="fa fa-trash" style="color:#f00" onClick = "deleteCompany(${data.companyId})">
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

    $("#btnsubmit").click(function() {

      /*alert("hi");
  
      alert(document.getElementById("desc").value);*/

      if ($("#txtcode").val().trim() == "") {

        $("#txtcode").addClass("require");

        alert("Please Enter Company Code..!!");

        $("#txtcode").focus();

        return false;

        //alert("bye");

      } else if ($("#txtnm").val().trim() == "") {

        $("#txtnm").addClass("require");

        alert("Please Enter Company Name..!!");

        $("#txtnm").focus();

        return false;

        //alert("bye");

      } else if ($("#desc").val().trim() == "") {

        $("#desc").addClass("require");

        alert("Please Enter Company Description..!!");

        $("#desc").focus();

        return false;

      } else {

        document.getElementById('btnsubmit').disabled = true;
        let user = JSON.parse(localStorage.getItem('user'));
        if (user == null) {
          window.location.href = 'index.php';
        }
        let userId = user.User.userId;
        let token = user.token;
        var url = `http://localhost:8080/manage/add/company/${userId}`;

        var jsonData = {
          "companyCode": document.getElementById('txtcode').value,
          "companyName": document.getElementById('txtnm').value,
          "companyDescription": document.getElementById('desc').value
        }
        //alert(url);

        // the script where you handle the form input.

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
            window.location.href = 'companyMaster.php';
          },
          error: function(error) {
            alert(JSON.stringify(error));
          }
        });



        e.preventDefault();

      }

      // avoid to execute the actual submit of the form.

    });

    function ChangeCase(elem) {

      elem.value = elem.value.toUpperCase();

    }
  </script>

</body>



</html>