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
      $.ajax({

        type: "GET",

        url: 'http://192.168.0.138:8080/manage/get/company/0/10',
        //data: $("#companyMaster").serialize(), // serializes the form's elements.
        contentType: 'application/json',

        success: function(data) {
          let comapanyDD = document.getElementById('company_name');
          comapanyDD.innerHTML = `<option value="0">Select</option>`;
          data.Company.forEach((company) => {
            let row = `<option value="${company.companyId}">${company.companyName}</option>`;
            comapanyDD.innerHTML += row;
          });

          let uomDD = document.getElementById('uom');
          uomDD.innerHTML = `<option value="0">Select</option>`;
          data.UOM.forEach((uom) => {
            let row = `<option value="${uom.uomId}">${uom.uomName}</option>`;
            uomDD.innerHTML += row;
          });
        },
        error: function(error) {
          alert(JSON.stringify(error));
        }
      });

      $.ajax({

        type: "GET",

        url: `http://192.168.0.138:8080/manage/get/productCategory/2`,
        contentType: 'application/json',
        success: function(data) {
          let productCategoryDD = document.getElementById('cat_id');
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

    function edit(id) {
      //alert('hi');
      window.open("getfgmaster_details.php?ID=" + id, "_blank", "toolbar=yes, scrollbars=yes, resizable=no, top=60, left=0, width=700, height=600");
    }

    function erate(id) {
      //alert('hi');
      window.open("rm_price_history.php?ID=" + id, "_blank", "toolbar=yes, scrollbars=yes, resizable=no, top=60, left=0, width=700, height=600");
    }

    function del(id, user) {


      var r = confirm("Do you want to Delete this Record....?");
      if (r == true) {
        var scriptUrl = 'del_fgMaster.php?id=' + id + '&userId=' + user;
        $.ajax({
          url: scriptUrl,
          success: function(result) {
            alert('Record Deleted Successfully...');
            window.location.href = 'fgMaster.php';
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

    function isNumberKey(evt) {
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        alert('Enter Numbers Only...!')
        return false;
      }
      return true;
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
            <h1 class="h4 mb-0 text-gray-800" style="height:0px;padding-bottom: 10px;">FG Master</h1>
          </div>

          <div class="card o-visible border-0 shadow-lg my-2">
            <div class="card-body p-0">
              <!-- Nested Row within Card Body -->
              <div class="row">
                <div class="col-lg-12">
                  <div class="p-2">
                    <div>
                      <span style="padding-right:10px;">
                        <input type="radio" id="csvfile" name="csvfile" value="1" onClick="getrbtn()" required>&nbsp;&nbsp;Excel File Upload
                      </span>
                    </div>

                    <div id="first" style="visibility:hidden;overflow:hidden;height:0px;margin-top:20px">
                      <form class="user" action="upload_FG.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" id="euid" name="euid" value="<?php echo $_SESSION['uId'] ?>">
                        <div class="form-group row">
                          <div class="col-sm-6 mb-3 mb-sm-0">
                            <label class="m-0 font-weight-bold text-primary">Select CSV File.</label>
                            <input id="file" name="file" class="form-control" type="file" required>
                            <a href="Excel/FG.csv"><label style="color:#F00;margin-top:10px"><b>Click Here For Sample CSV</b></label></a><br>
                            <label style="color:#F00;margin-top:10px"><b>Note : Product Expiry should write as [ 1 Year / 6 Months] in csv File</b></label>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="submit" id="btn" name="btn" class="btn btn-primary" value="Create">
                          </div>
                        </div>
                      </form>
                    </div>

                    <div id="second">
                      <form class="user" action="#" method="post" name="rmMaster" id="rmMaster">
                        <input type="hidden" id="uid" name="uid" value="<?php echo $userId ?>">
                        <input type="hidden" id="urole" name="urole" value="<?php echo $uRole ?>">
                        <input type="hidden" id="uiType" name="uiType" value="<?php echo $uiType ?>">
                        <input type="hidden" id="uloc" name="uloc" value="<?php echo $uloc ?>">
                        <input type="hidden" id="ulocty" name="ulocty" value="<?php echo $ulocType; ?>">
                        <table cellpadding="5px">
                          <tr>
                            <td valign="top"><label class="m-0 font-weight-bold text-primary">Company</label></td>
                            <td valign="top">:</td>
                            <td valign="top">
                              <select name="company_name" id="company_name" class="form-control form-control-sm" tabindex="1" onChange="getLocationData()" style="width:250px;">

                              </select>
                            </td>

                            <td valign="top"><label class="m-0 font-weight-bold text-primary">Location</label></td>
                            <td valign="top">:</td>
                            <td valign="top">
                              <select class="form-control form-control-sm" id="location" name="location" tabindex="2" style="width:250px;">
                                <option value="0">Select</option>
                              </select>
                            </td>

                            <td valign="top"><label class="m-0 font-weight-bold text-primary">Category</label></td>
                            <td valign="top">:</td>
                            <td valign="top">
                              <select name="cat_id" id="cat_id" class="form-control form-control-sm" tabindex="3" style="width:230px;">
                                <option value="0">Select</option>

                              </select>
                            </td>
                          </tr>

                          <tr>
                            <td valign="top"><label class="m-0 font-weight-bold text-primary">Sage Code</label></td>
                            <td valign="top">:</td>
                            <td valign="top">
                              <input type="text" id="sage_code" name="sage_code" class="form-control form-control-sm" placeholder="Sage Code" tabindex="4" style="width:250px;">
                            </td>

                            <td valign="top"><label class="m-0 font-weight-bold text-primary">Focus Code</label></td>
                            <td valign="top">:</td>
                            <td valign="top">
                              <input type="text" class="form-control form-control-sm" id="focus_code" name="focus_code" placeholder="Focus Code" tabindex="5" style="width:250px;">
                            </td>

                            <td valign="top"><label class="m-0 font-weight-bold text-primary">Brand</label></td>
                            <td valign="top">:</td>
                            <td valign="top">
                              <input type="text" id="brand" name="brand" class="form-control form-control-sm" placeholder="Brand" tabindex="6" style="width:230px;">
                            </td>
                          </tr>

                          <tr>
                            <td valign="top"><label class="m-0 font-weight-bold text-primary">Capacity / UOM</label></td>
                            <td valign="top">:</td>
                            <td valign="top">
                              <select name="uom" id="uom" class="form-control form-control-sm" tabindex="7" style="width:250px;">
                                <option value="0">Select</option>

                              </select>
                            </td>

                            <td valign="top"><label class="m-0 font-weight-bold text-primary">Description</label></td>
                            <td valign="top">:</td>
                            <td valign="top">
                              <textarea name="desc" id="desc" class="form-control form-control-sm" placeholder="Description" tabindex="8" style="width:250px;"></textarea>
                            </td>

                            <td valign="top"><label class="m-0 font-weight-bold text-primary">Reorder Level(Qty)</label></td>
                            <td valign="top">:</td>
                            <td valign="top">
                              <input type="text" id="reorder_level_qty" name="reorder_level_qty" tabindex="9" class="form-control form-control-sm" onKeyPress="return isNumberKey(event)" placeholder="Reorder Level(Qty)" style="width:230px;">
                            </td>
                          </tr>

                          <tr>
                            <td valign="top"><label class="m-0 font-weight-bold text-primary">Product Expiry</label></td>
                            <td valign="top">:</td>
                            <td valign="top">
                              <select class="form-control form-control-sm" id="product_expiry" name="product_expiry" tabindex="10" style="width:250px;">
                                <option value="0">Select</option>
                                <option value="12">1 Year</option>
                                <option value="6">6 Months</option>
                              </select>
                            </td>
                          </tr>

                          <tr>
                            <td><button type="button" id="btnsubmit" name="btnsubmit" class="btn btn-primary" tabindex="12">Create</button></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td align="right">
                              <a href="fgRegister.php" class="btn btn-warning" style="text-decoration: none;">Show FG Register</a>
                            </td>
                          </tr>
                        </table>

                      </form>
                    </div>

                  </div>
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
  </script>
  <script type="text/javascript">
    $("#btnsubmit").click(function(e) {
    /*alert("hi");
    alert(document.getElementById("desc").value);*/

    if ($("#company_name").val().trim() == "0") {
      $("#company_name").addClass("require");
      alert("Please Select Company Name..!!");
      $("#company_name").focus();
      return false;
    } else if ($("#location").val().trim() == "0") {
      $("#location").addClass("require");
      alert("Please Select Location Name..!!");
      $("#location").focus();
      return false;
    } else if ($("#cat_id").val().trim() == "0") {
      $("#cat_id").addClass("require");
      alert("Please Select Category..!!");
      $("#cat_id").focus();
      return false;
      //alert("bye");
    } else if ($("#sage_code").val().trim() == "") {
      $("#sage_code").addClass("require");
      alert("Please Enter Sage Code..!!");
      $("#sage_code").focus();
      return false;
      //alert("bye");
    } else if ($("#focus_code").val().trim() == "") {
      $("#focus_code").addClass("require");
      alert("Please Enter Focus Code..!!");
      $("#focus_code").focus();
      return false;
    } else if ($("#desc").val().trim() == "") {
      $("#desc").addClass("require");
      alert("Please Enter Description..!!");
      $("#desc").focus();
      return false;
    } else if ($("#brand").val().trim() == "") {
      $("#brand").addClass("require");
      alert("Please Enter Brand..!!");
      $("#brand").focus();
      return false;
    } else if ($("#uom").val().trim() == "0") {
      $("#uom").addClass("require");
      alert("Please Select UOM..!!");
      $("#uom").focus();
      return false;
    } else if ($("#reorder_level_qty").val().trim() == "") {
      $("#reorder_level_qty").addClass("require");
      alert("Please Enter Reorder Level Qty..!!");
      $("#reorder_level_qty").focus();
      return false;
    } else if ($("#product_expiry").val().trim() == "") {
      $("#product_expiry").addClass("require");
      alert("Please Enter Product Expiry..!!");
      $("#product_expiry").focus();
      return false;
    }
    /*else if($("#barcode").val().trim()=="0")
    {
      $("#barcode").addClass("require");
      alert("Please Enter Barcode  ..!!");
      $("#barcode").focus();
      return false;
    }*/
    else {
      document.getElementById('btnsubmit').disabled = true;
      let companyId = document.getElementById('company_name').value;
      let uomId = document.getElementById('uom').value;
      let productCategoryId = document.getElementById('cat_id').value;
      let locationId = document.getElementById('location').value;
      let sageCode = document.getElementById('sage_code').value;
      let focusCode = document.getElementById('focus_code').value;
      let description = document.getElementById('desc').value;
      let reorderLevelQty = document.getElementById('reorder_level_qty').value;
      let productExpiry = document.getElementById('product_expiry').value;
      let brandName = document.getElementById('brand').value;
      var url = `http://192.168.0.138:8080/manage/add/productRegister/${companyId}/${uomId}/2/${productCategoryId}/${locationId}`;
      let jsonData = {
        "sageCode": sageCode,
        "focusCode": focusCode,
        "description": description,
        "reorderLevelQty": reorderLevelQty,
        "brandName":brandName,
        "productExpiry": productExpiry
      };
      $.ajax({
        type: "POST",
        url: url,
        data: JSON.stringify(jsonData),
        contentType: 'application/json',
        success: function(data) {
          alert('Record Inserted Successfully');
          document.getElementById('btnsubmit').disabled = false;
          window.location.href = 'fgMaster.php';
        },
        error: function(error) {
          console.log(error);
        }
      });
      e.preventDefault();
    }
    // avoid to execute the actual submit of the form.
    });
    // avoid to execute the actual submit of the form.

    function getLocationData() {
      console.log("called");
      let companyId = document.getElementById('company_name').value;
      $.ajax({

        type: "GET",

        url: `http://192.168.0.138:8080/manage/get/location/typeWise/${companyId}/2/0`,
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
  </script>
</body>

</html>