<!DOCTYPE html>

<html lang="en">



<head>



  <?php

  include("inc/meta.php");

  ?>

</head>

<script>
  async function getTotalStock() {
    let user = JSON.parse(localStorage.getItem('user'));
    if (user == null) {
      window.location.href = 'index.php';
    }
    let userId = user.User.userId;
    let token = user.token;
    let url = `http://localhost:8080/manage/get/totalStock`;
    let arr = [];
    $.ajax({
      type: "GET",
      headers: {
        Authorization: token
      },
      url: url,
      contentType: 'application/json',
      success: function(data) {
        document.getElementById("totalStock").innerHTML = data;
      }
    });
  }

  async function getReorderLevelQty() {
    let user = JSON.parse(localStorage.getItem('user'));
    if (user == null) {
      window.location.href = 'index.php';
    }
    let userId = user.User.userId;
    let token = user.token;
    let url = `http://localhost:8080/manage/get/reorderLevelQty`;
    let arr = [];
    $.ajax({
      type: "GET",
      headers: {
        Authorization: token
      },
      url: url,
      contentType: 'application/json',
      success: function(data) {
        document.getElementById("reorderLevelQty").innerHTML = data;
      }
    });
  }

  async function getOFS() {
    let user = JSON.parse(localStorage.getItem('user'));
    if (user == null) {
      window.location.href = 'index.php';
    }
    let userId = user.User.userId;
    let token = user.token;
    let url = `http://localhost:8080/manage/get/OFS`;
    let arr = [];
    $.ajax({
      type: "GET",
      headers: {
        Authorization: token
      },
      url: url,
      contentType: 'application/json',
      success: function(data) {
        document.getElementById("OFS").innerHTML = data;
      }
    });
  }

  async function getExpiry() {
    let user = JSON.parse(localStorage.getItem('user'));
    if (user == null) {
      window.location.href = 'index.php';
    }
    let userId = user.User.userId;
    let token = user.token;
    let url = `http://localhost:8080/manage/get/expiry`;
    let arr = [];
    $.ajax({
      type: "GET",
      headers: {
        Authorization: token
      },
      url: url,
      contentType: 'application/json',
      success: function(data) {
        document.getElementById("expiry").innerHTML = data;
      }
    });
  }
</script>



<body id="page-top" onLoad="getTotalStock();getReorderLevelQty();getOFS();showGraph();showGraph1();getExpiry();">



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

          <div class="align-items-center justify-content-between mb-4" style="background-color:#3c8dbc;border-radius:5px;" align="center">

            <h1 class="h3 mb-0 text-gray-801">Dashboard</h1>

          </div>


          <div class = "row">
            <!-- Content Row -->

            <div class="col-xl-3 col-md-6 mb-4">

              <div class="card border-left-primary shadow h-100 py-2">

                <div class="card-body">

                  <div class="row no-gutters align-items-center">

                    <div class="col mr-2">

                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Stock</div>

                      <div class="h5 mb-0 font-weight-bold text-gray-800">

                        <a href="stockReg.php"><label id="totalStock"></a>

                      </div>

                    </div>

                    <div class="col-auto">

                      <i class="fas fa-users fa-2x text-gray-300"></i>

                    </div>

                  </div>

                </div>

              </div>

            </div>



            <div class="col-xl-3 col-md-6 mb-4">

              <div class="card border-left-success shadow h-100 py-2">

                <div class="card-body">

                  <div class="row no-gutters align-items-center">

                    <div class="col mr-2">

                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">RE - ORDER LEVEL</div>

                      <div class="h5 mb-0 font-weight-bold text-gray-800">

                        <a href="stockReg_r.php"><label id="reorderLevelQty"></a>

                      </div>

                    </div>

                    <div class="col-auto">

                      <i class="fas fa-users fa-2x text-gray-300"></i>

                    </div>

                  </div>

                </div>

              </div>

            </div>


            <div class="col-xl-3 col-md-6 mb-4">

              <div class="card border-left-info shadow h-100 py-2">

                <div class="card-body">

                  <div class="row no-gutters align-items-center">

                    <div class="col mr-2">

                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">OUT OF STOCK</div>

                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <a href="stockReg_ost.php"><label id="OFS"></a>

                      </div>

                    </div>

                    <div class="col-auto">

                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>

                    </div>

                  </div>

                </div>

              </div>

            </div>


            <div class="col-xl-3 col-md-6 mb-4">

              <div class="card border-left-primary shadow h-100 py-2">

                <div class="card-body">

                  <a href="expiryReg.php" alt="expiry date" style="text-decoration: none;">

                    <div class="row no-gutters align-items-center">

                      <div class="col mr-2">

                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Expiry Date</div>

                        <div class="h5 mb-0 font-weight-bold text-gray-800">

                          <a href="expiryReg.php"><label id="expiry"></a>

                        </div>

                      </div>

                      <div class="col-auto">

                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>

                      </div>

                    </div>

                  </a>

                </div>

              </div>

            </div>

          </div>

        </div>

        <div class="row">



          <!-- Area Chart -->

          <div class="col-xl-7 col-lg-7">

            <div class="card shadow mb-4">

              <!-- Card Header - Dropdown -->

              <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

                <h6 class="m-0 font-weight-bold text-primary">IN DETAILS - FINISHED GOODS</h6>

                <div class="dropdown no-arrow">

                  <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a>



                </div>

              </div>

              <!-- Card Body -->

              <div class="card-body">

                <div class="chart-area">

                  <script type="text/javascript" src="dist/canvasjs.js"></script>

                  <div id="chartContainer" style="height: 300px; width: 100%;padding:10px;"></div>

                </div>

              </div>

            </div>

          </div>

          <script>
            // $(document).ready(function() {

            //   showGraph();



            // });



            async function showGraph()

            {

              //alert('hi');

              var v = '-1';

              var v1 = '2';

              //var scriptUrl="dashboard_chart.php?item_code="+v+'&suppliercode='+v1;

              // var scriptUrl = "dashboard_chart_FG.php?iType=" + v1;

              //alert(scriptUrl);

              let user = JSON.parse(localStorage.getItem('user'));
              if (user == null) {
                window.location.href = 'index.php';
              }
              let userId = user.User.userId;
              let token = user.token;
              let url = `http://localhost:8080/get/graph/${v1}/IN`;
              let arr = [];
              await $.ajax({
                type: "GET",
                headers: {
                  Authorization: token
                },
                url: url,
                contentType: 'application/json',
                success: function(data) {
                  data.forEach((graph) => {
                    let parts = graph.month.split("-");
                    let month = parts[1];
                    let year = parts[1] + '-' + parts[0];
                    let stuff = {
                      "label": year,
                      "y": graph.totalQty,
                      "indexLabel": "{y}"
                    };
                    arr.push(stuff);
                  });
                }
              });

              JSON.stringify(arr)

              var chart = new CanvasJS.Chart("chartContainer", {





                title: {

                  text: "IN DETAILS - FINISHED GOODS",



                },

                data: [ //array of dataSeries

                  { //dataSeries object



                    /*** Change type "column" to "bar", "area", "line" or "pie" or "pie" doughnut***/


                    type: "column",

                    dataPoints: arr



                  }
                ]

              });

              chart.render();
            }
          </script>

          <!-- Pie Chart -->

          <div class="col-xl-5 col-lg-7">

            <div class="card shadow mb-4">

              <!-- Card Header - Dropdown -->

              <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

                <h6 class="m-0 font-weight-bold text-primary">OUT DETAILS - FINISHED GOODS</h6>

                <div class="dropdown no-arrow">

                  <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a>



                </div>

              </div>

              <!-- Card Body -->

              <div class="card-body">



                <script>
                  // $(document).ready(function() {

                  //   showGraph1();

                  //   showGraph();



                  // });



                  async function showGraph1()

                  {

                    //alert('hi');

                    var v = '-1';

                    var v1 = '2';

                    //var scriptUrl="dashboard_chart.php?item_code="+v+'&suppliercode='+v1;

                    // var scriptUrl = "dashboard_chart_FG.php?iType=" + v1;

                    //alert(scriptUrl);

                    let user = JSON.parse(localStorage.getItem('user'));
                    if (user == null) {
                      window.location.href = 'index.php';
                    }
                    let userId = user.User.userId;
                    let token = user.token;
                    let url = `http://localhost:8080/get/graph/2/OUT`;
                    let arr = [];
                    await $.ajax({
                      type: "GET",
                      headers: {
                        Authorization: token
                      },
                      url: url,
                      contentType: 'application/json',
                      success: function(data) {
                        data.forEach((graph) => {
                          let parts = graph.month.split("-");
                          let month = parts[1];
                          let year = parts[1] + '-' + parts[0];
                          let stuff = {
                            "label": year,
                            "y": graph.totalQty,
                            "indexLabel": "{y}"
                          };
                          arr.push(stuff);
                        });
                      }
                    });

                    JSON.stringify(arr)

                    var chart = new CanvasJS.Chart("chartContainer1", {





                      title: {

                        text: "OUT DETAILS - FINISHED GOODS",



                      },

                      data: [ //array of dataSeries

                        { //dataSeries object



                          /*** Change type "column" to "bar", "area", "line" or "pie" or "pie" doughnut***/


                          type: "column",

                          dataPoints: arr



                        }
                      ]

                    });

                    chart.render();
                  }
                </script>







                <div class="chart-area">



                  <script type="text/javascript" src="dist/canvasjs.js"></script>

                  <div id="chartContainer1" style="height: 300px; width: auto;padding:10px;"></div>

                </div>

              </div>

            </div>

          </div>

          <!-- Content Row -->

        </div>

        <!-- Footer -->

        <?php

        include("inc/footer.php");

        ?>

        <!-- End of Footer -->



      </div>

      <!-- End of Content Wrapper -->



    </div>



  </div>

  <!-- End of Page Wrapper -->



  <!-- Scroll to Top Button-->

  <a class="scroll-to-top rounded" href="#page-top">

    <i class="fas fa-angle-up"></i>

  </a>



  <!-- Logout Modal-->





  <!-- Bootstrap core JavaScript-->

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



</body>



</html>