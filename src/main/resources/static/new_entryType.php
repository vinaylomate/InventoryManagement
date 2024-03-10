<?php /*include('log_check.php');

$cmpId=$_SESSION['cmpId'];

$uiType=$_SESSION['iType'];

$userId=$_SESSION['uId'];

$uRole=$_SESSION['uRole'];*/

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
    function GetSelected() {

      //Create an Array.

      var selected = new Array();



      //Reference the Table.

      var sval = document.getElementById("Select_values");



      //Reference all the CheckBoxes in Table.

      var chks = sval.getElementsByTagName("INPUT");



      // Loop and push the checked CheckBox value in Array.

      for (var i = 0; i < chks.length; i++) {

        if (chks[i].checked) {

          selected.push(chks[i].value);

        }



      }

      document.getElementById('selectval').value = selected;

      //Display the selected CheckBox values.



    };
  </script>



  <script>
    function deleteEntry(id) {
      let user = JSON.parse(localStorage.getItem('user'));
      if (user == null) {
        window.location.href = 'index.php';
      }
      let userId = user.User.userId;
      let token = user.token;
      let url = `http://localhost:8080/manage/delete/entry/${parseInt(id)}/${userId}`;
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
          window.location.href = 'new_entryType.php';
        },
        error: function(error) {
          alert(JSON.stringify(error));
        }
      });
    }

    function edit(id)

    {

      //alert('hi');

      window.open("getentrytype_details.php?ID=" + id, "_blank", "toolbar=yes, scrollbars=yes, resizable=no, top=60, left=0, width=700, height=600");

    }

    function del(id, user)

    {





      var r = confirm("Do you want to Delete this Record....?");

      if (r == true) {

        var scriptUrl = 'del_entrytype.php?id=' + id + '&userId=' + user;

        $.ajax({
          url: scriptUrl,
          success: function(result)

          {

            alert('Record Deleted Successfully...');

            window.location.href = 'new_entryType.php';

          }
        });



      } else {

        txt = "You Pressed Cancel!";

      }



    }

    function getusernm()

    {

      var uname = document.getElementById("txtname").value;

      //alert(uname);



      var scriptUrl = 'getname.php?nm=' + uname;

      $.ajax({
        url: scriptUrl,
        success: function(result)

        {

          //alert(result);

          var str = result;

          if (str == '1')

          {

            alert('Username Already Exist...!');

            document.getElementById("txtname").value = "";

            document.getElementById("txtname").focus();

          }

        }

      });

    }
  </script>

</head>



<body id="page-top" onLoad="getEntryTypes()">



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

            <h1 class="h4 mb-0 text-gray-800" style="height:0px;padding-bottom: 10px;">New Entry Type</h1>

          </div>



          <div class="card o-visible border-0 shadow-lg my-2">

            <div class="card-body p-0">

              <!-- Nested Row within Card Body -->

              <div class="row">

                <div class="col-lg-12">

                  <div class="p-2">



                    <form class="user" action="#" method="post" id="newEntry" name="newEntry">

                      <input type="hidden" id="uid" name="uid" value="<?php echo $_SESSION['uId'] ?>">

                      <table cellpadding="5px;">

                        <tr>

                          <td><label class="m-0 font-weight-bold text-primary">Entry Type Name</label></td>

                          <td>:</td>

                          <td><input type="text" class="form-control form-control-sm" id="txtetypenm" name="txtetypenm" placeholder="Entry Type Name" tabindex="1"></td>

                          <td><label class="m-0 font-weight-bold text-primary">Entry Type</label></td>

                          <td>:</td>

                          <td>

                            <select class="form-control form-control-sm" id="eType" name="eType" tabindex="2" style="width:250px;">

                              <option value="IN">IN</option>

                              <option value="OUT">OUT</option>

                              <!--<option value="3">BOTH</option>-->

                            </select>

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



          <div class="card shadow mb-4">

            <div class="card-header py-3">

              <h6 class="m-0 font-weight-bold text-primary">Entry Type Register</h6>

            </div>

            <div class="card-body">

              <div class="table-responsive">

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                  <thead>

                    <tr style="background-color:#b02923">

                      <th style="color:#fff;text-align:center">Sr.No.</th>

                      <th style="color:#fff;text-align:center">Entry Type Name</th>

                      <th style="color:#fff;text-align:center">Entry Type</th>

                      <th style="color:#fff;text-align:center">Delete</th>

                    </tr>

                  </thead>


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



        if ($("#txtetypenm").val().trim() == "")

        {

          $("#txtetypenm").addClass("require");

          alert("Please Enter Entry Type Name..!!");

          $("#txtetypenm").focus();

          return false;

        } else if ($("#eType").val().trim() == "0")

        {

          $("#txtetypenm").addClass("require");

          alert("Please Select Entry Type..!!");

          $("#eType").focus();

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
          var url = `http://localhost:8080/manage/add/entry/${userId}`;
          let entryName = document.getElementById('txtetypenm').value;
          let entryType = document.getElementById('eType').value;
          let jsonData = {
            "entryName": entryName,
            "entryType": entryType
          }

          //alert(url);

          // the script where you handle the form input.

          $.ajax({

            type: "POST",

            url: url,
            headers: {
              Authorization: token
            },
            data: JSON.stringify(jsonData), // serializes the form's elements.
            contentType: 'application/json',
            success: function(data)

            {
              alert('Record Inserted Successfully');
              document.getElementById('btnsubmit').disabled = false;
              window.location.href = 'new_entryType.php';

            },
            error: function(error) {
              console.log(error);
            }

          });



          e.preventDefault();

        }

        // avoid to execute the actual submit of the form.

      });

    function getEntryTypes() {
      let user = JSON.parse(localStorage.getItem('user'));
      if (user == null) {
        window.location.href = 'index.php';
      }
      let userId = user.User.userId;
      let token = user.token;

      $.ajax({

        type: "GET",

        url: 'http://localhost:8080/manage/get/entry/0/10000',
        headers: {
          Authorization: token
        },
        //data: $("#companyMaster").serialize(), // serializes the form's elements.
        contentType: 'application/json',

        success: function(data) {
          let tbody = document.querySelector("#dataTable tbody");
          let index = 0;
          data.forEach((type) => {
            let row = `<tr style="text-align: center">
								<td >${++index}</td>
								<td>${type.entryName}</td>
								<td>${type.entryType}</td>
								<td>
                  <i class="fa fa-trash" style="color:#f00" onClick = "deleteEntry(${type.entryId});">
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

</body>



</html>