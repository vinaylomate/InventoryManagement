<!DOCTYPE html>

<html lang="en">



<head>



  <?php

  include("inc/meta.php");

  ?>

  <script>
    function getData() {
      let user = JSON.parse(localStorage.getItem('user'));
      if (user == null) {
        window.location.href = 'index.php';
      }
      let userId = user.User.userId;
      let token = user.token;
      var docNo = "";
      <?php
      $a = $_GET['ID'];
      echo "docNo = '" . $a . "';";
      ?>
      let url = `http://localhost:8080/manage/view/stockRegister/${docNo}/${userId}`;
      $.ajax({

        type: "GET",
        headers: {
          Authorization: token
        },
        url: url,
        contentType: 'application/json',

        success: function(data) {

          let tbody = document.querySelector('#dataTable tbody');
          let index = 1;
          let qty = 0;
          let date, company, location, productType, sageRef;
          tbody.innerHTML = "";
          let row = `<tr style="text-align: center; background-color:#e1736e; color: #000;">
              <td>No</td>
              <td>Focus Code</td>
              <td>Sage Code</td>
              <td>Description</td>
              <td>Batch No</td>
              <td>Qty</td>
              <td>Expiry Date</td>
              <td>Entry Type</td>
              </tr>`;
          tbody.innerHTML += row;
          data.forEach((data) => {
            date = data.entryDate;
            company = data.location.company.companyName;
            location = data.location.locationCode + " - " + data.location.locationName + " - " + data.location.locationDescription;
            productType = data.location.productType.productTypeName;
            sageRef = data.sageReference;
            qty += data.qty;
            let row = `<tr style="text-align: center">
              <td>${index}</td>
              <td>${data.productRegister.focusCode}</td>
              <td>${data.productRegister.sageCode}</td>
              <td>${data.productRegister.description}</td>
              <td>${data.batchNo}</td>
              <td>${data.qty}</td>`
              if(data.expiryDate == null) {
                row += `<td>-</td>`;
              } else {
                row += `<td>${data.expiryDate}</td>`
              }
              row += `<td>${data.entry.entryType}</td>
              </tr>`;
            index++;
            tbody.innerHTML += row;
          });
          document.getElementById('qty').innerHTML = qty;
          document.getElementById('docNo').innerHTML = docNo;
          document.getElementById('date').innerHTML = date;
          document.getElementById('company').innerHTML = company;
          document.getElementById('location').innerHTML = location;
          document.getElementById('productType').innerHTML = productType;
          document.getElementById('sageRef').innerHTML = sageRef;
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

                            <div class="col-md-4" style="font-weight:600">Document No. :</div>

                            <div class="col-md-8"><label id="docNo"></label></div>

                          </div>

                        </div>





                      </div>



                      <div class="row" style="margin-top:15px">

                        <div class="col-md-6">

                          <div class="row">

                            <div class="col-md-4" style="font-weight:600">Company :</div>

                            <div class="col-md-8"><label id="company"></label></div>

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

                            <div class="col-md-4" style="font-weight:600">Product Type :</div>

                            <div class="col-md-8"><label id="productType"></label></div>

                          </div>

                        </div>



                        <div class="col-md-6">

                          <div class="row">

                            <div class="col-md-4" style="font-weight:600">Sage Reference</div>

                            <div class="col-md-8"><label id="sageRef"></label></div>

                          </div>

                        </div>

                      </div>

                      <hr>



                      <div style="margin-top:25px">

                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                          <tr id="aa" style="background-color:#e1736e;">

                            <th style="color:#000">No</th>

                            <th style="color:#000">Focus Code</th>

                            <th style="color:#000">Sage Code</th>

                            <th style="color:#000">Description</th>

                            <th style="color:#000">Batch No</th>

                            <th style="color:#000">Qty</th>

                            <th style="color:#000">Prod. Exp. Date</th>

                            <th style="color:#000">Entry Type</th>

                          </tr>

                          <tbody>

                          </tbody>

                          <tfoot>

                            <th></th>

                            <th></th>

                            <th style="color:#F00"></th>

                            <th style="color:#F00"></th>

                            <th style="color:#F00;text-align:right">Total </th>

                            <th style="color:#F00;text-align:center"><label id="qty"></label></th>

                            <th style="color:#F00"></th>

                            <th style="color:#F00"></th>

                          </tfoot>

                        </table>

                      </div>



                    </div>

                  </page>

                  <!--<div align="center" style="padding:5px">

            <input type="button" onClick="print2()" value="Print" class="btn btn-primary"/> 

            </div>-->

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

  <script>
    // $(window).load(function() {

    //   $('#tbl').DataTable({});

    // });


    function print2()

    {

      var printContents = document.getElementById('getdata').innerHTML;

      var originalContents = document.body.innerHTML;

      document.body.innerHTML = printContents;

      window.print();

      document.body.innerHTML = originalContents;



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

  <!-- <script src="js/demo/chart-area-demo.js"></script>

  <script src="js/demo/chart-pie-demo.js"></script> -->

  <!-- Page level plugins -->

  <!-- <script src="vendor/datatables/jquery.dataTables.min.js"></script>

  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script> -->



  <!-- Page level custom scripts -->

  <!-- <script src="js/demo/datatables-demo.js"></script> -->

</body>



</html>