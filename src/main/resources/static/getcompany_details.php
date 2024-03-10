<?php include('log_check.php') ?>

<!DOCTYPE html>

<html lang="en">



<head>



  <?php

  include("inc/meta.php");

  ?>

  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  <script>
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

</head>



<body id="page-top">


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

            <h1 class="h4 mb-0 text-gray-800" style="height:0px;margin-top:10px">Company Master</h1>

          </div>



          <div class="card o-hidden border-0 shadow-lg my-5">

            <div class="card-body p-0">

              <!-- Nested Row within Card Body -->

              <div class="row">

                <div class="col-lg-12">

                  <div class="p-5">

                    <form class="user" action="#" method="post" name="companyMaster" id="companyMaster">

                      <input type="hidden" id="eId" name="eId" value="">

                      <input type="hidden" id="uid" name="uid" value="">

                      <div class="form-group row">

                        <div class="col-sm-6 mb-3 mb-sm-0">

                          <label class="m-0 font-weight-bold text-primary">Company Code</label>

                          <input type="text" class="form-control form-control-sm" id="txtcode" name="txtcode" placeholder="Company Code" value="" readonly>

                        </div>

                        <div class="col-sm-6">

                          <label class="m-0 font-weight-bold text-primary">Company Name</label>

                          <input type="text" class="form-control form-control-sm" id="txtnm" name="txtnm" placeholder="Company Name" onKeyUp="ChangeCase(this);" value="" tabindex="1" required>

                          <input type="hidden" class="form-control form-control-sm" id="txtpnm" name="txtpnm" placeholder="Company Name" value="" readonly>

                        </div>

                      </div>



                      <div class="form-group row">

                        <div class="col-sm-6 mb-3 mb-sm-0">

                          <label class="m-0 font-weight-bold text-primary">Description</label>

                          <textarea id="txtdesc" name="txtdesc" class="form-control form-control-sm" placeholder="Company Description" tabindex="2" required></textarea>



                          <input type="hidden" class="form-control form-control-sm" id="txtpdesc" name="txtpdesc" placeholder="Company Description" value="" readonly>

                        </div>



                      </div>



                      <div class="form-group row">





                        <button type="button" id="btnsubmit" name="btnsubmit" class="btn btn-primary btn-group-sm" tabindex="3">Update</button>



                    </form>

                  </div>

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

  <script type="text/javascript">
    $("#btnsubmit").click(function()

      {

        /*alert("hi");

        alert(document.getElementById("desc").value);*/



        if ($("#txtnm").val().trim() == "")

        {

          $("#txtnm").addClass("require");

          alert("Please Enter Company Name..!!");

          $("#txtnm").focus();

          return false;

          //alert("bye");

        } else if ($("#txtdesc").val().trim() == "")

        {

          $("#txtdesc").addClass("require");

          alert("Please Enter Company Description..!!");

          $("#txtdesc").focus();

          return false;

        } else

        {

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
            "companyDescription": document.getElementById('txtdesc').value
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

    function ChangeCase(elem)

    {

      elem.value = elem.value.toUpperCase();

    }
  </script>

</body>



</html>