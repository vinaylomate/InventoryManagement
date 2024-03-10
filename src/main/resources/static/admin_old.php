<?php include('log_check.php')?>
<!DOCTYPE html>
<html lang="en">

<head>

 <?php
 include("inc/meta.php");
 ?>
</head>

<body id="page-top" onLoad="showGraph1();showGraph();">

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
            <i class="fa fa-bars"></i>          </button>

          <!-- Topbar Search -->
          

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            

            <!-- Nav Item - Alerts -->
            

            <!-- Nav Item - Messages -->
            

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <?php include('inc/header.php');?>
          </ul>
        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="align-items-center justify-content-between mb-4" style="background-color:#3c8dbc;border-radius:5px;" align="center">
			<h1 class="h3 mb-0 text-gray-801">Dashboard</h1>   
          </div>

          <!-- Content Row -->
          <?php
          if($_SESSION['uAccess'] == '1,2,3')
		  {	  
		  ?>
          	<div class="row">

							 <?php //Sub Master
                      if($_SESSION['subAccess']=='1,2,3,4,5')
                      {}
                      else if($_SESSION['subAccess'] == '1,2,3,4')
                      {}
                      else if($_SESSION['subAccess'] == '1,2,3')
                      {}
                      else if($_SESSION['subAccess'] == '1,2,4,5')
                      {}
                      else if($_SESSION['subAccess'] == '1,2,5')
                      {}
                      else if($_SESSION['subAccess'] == '1,3,4,5')
                      {}
                      else if($_SESSION['subAccess'] == '1,3,5')
                      {}
                      else if($_SESSION['subAccess'] == '1')
                      {}
                      else if($_SESSION['subAccess'] == '2')
                      {}
                      else if($_SESSION['subAccess'] == '3')
                      {}
                      else if($_SESSION['subAccess'] == '4')
                      {}
                      else if($_SESSION['subAccess'] == '5')
                      {}
                      else if($_SESSION['subAccess'] == '1,2')
                      {}
                      else if($_SESSION['subAccess'] == '1,3')
                      {}
                      else if($_SESSION['subAccess'] == '1,4')
                      {}
                      else if($_SESSION['subAccess'] == '1,5')
                      {}
                      else if($_SESSION['subAccess'] == '2,3')
                      {}
                      else if($_SESSION['subAccess'] == '2,4')
                      {}
                      else if($_SESSION['subAccess'] == '2,5')
                      {}
                      else if($_SESSION['subAccess'] == '3,4')
                      {}
                      else if($_SESSION['subAccess'] == '3,5')
                      {}
                      else if($_SESSION['subAccess'] == '4,5')
                      {}
                      else if($_SESSION['subAccess'] == '1,2,4')
                      {}
                     else if($_SESSION['subAccess'] == '2,3,4')
                     {}
                      else if($_SESSION['subAccess'] == '1,3,4')
                      {}
                      else if($_SESSION['subAccess'] == '2,3,5')
                      {}
                       else if($_SESSION['subAccess'] == '2,4,5')
                       {}
                      else if($_SESSION['subAccess'] == '1,4,5')
                      {}
                        else
                        {
                        ?> 
                            <div class="col-xl-3 col-md-6 mb-4">
                              <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                  <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Stock</div>
                                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                                      <?php
                                      include('mysql.connect.php');
                                      $qry="SELECT COUNT(sId) AS total FROM supplier_tbl WHERE sts='0' AND uid=".$_SESSION['uId']."";
                                      $st=$mysql->prepare($qry);
                                      $st->execute();
                                      while($row=$st->fetch(PDO::FETCH_ASSOC))
                                      {
                                          echo '<a href="supplierMaster.php">'.$row['total'].'</a>';
                                      }
                                      $mysql=null;
                                      ?>
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
                                      <?php
                                      include('mysql.connect.php');
                                      $qry="SELECT COUNT(cId) AS total FROM cust_tbl WHERE sts='0' AND uid=".$_SESSION['uId']."";
                                      $st=$mysql->prepare($qry);
                                      $st->execute();
                                      while($row=$st->fetch(PDO::FETCH_ASSOC))
                                      {
                                          echo '<a href="customerMaster.php">'.$row['total'].'</a>';
                                      }
                                      $mysql=null;
                                      ?>
                                      </div>
                                    </div>
                                    <div class="col-auto">
                                      <i class="fas fa-users fa-2x text-gray-300"></i>                   
                                       </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            
                            <!--<div class="col-xl-3 col-md-6 mb-4">
                              <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                 <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                      <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Raw Material</div>
                                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                                      <?php
                                      include('mysql.connect.php');
                                      $qry="SELECT COUNT(rmId) AS total FROM rm_master WHERE sts='0'";
                                      $st=$mysql->prepare($qry);
                                      $st->execute();
                                      while($row=$st->fetch(PDO::FETCH_ASSOC))
                                      {
                                          echo '<a href="rmMaster.php">'.$row['total'].'</a>';
                                      }
                                      $mysql=null;
                                      ?>
                                      </div>
                                    </div>
                                    <div class="col-auto">
                                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>                  
                                      </div>
                                  </div>
                                </div>
                              </div>
                            </div>-->
                
                            
                
                            <div class="col-xl-3 col-md-6 mb-4">
                              <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                  <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">OUT OF STOCK</div>
                                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                                      <?php
                                      include('mysql.connect.php');
                                      $qry="SELECT COUNT(dId) AS total FROM drum_master WHERE sts='0' AND uid=".$_SESSION['uId']."";
                                      $st=$mysql->prepare($qry);
                                      $st->execute();
                                      while($row=$st->fetch(PDO::FETCH_ASSOC))
                                      {
                                          echo '<a href="drumMaster.php">'.$row['total'].'</a>';
                                      }
                                      $mysql=null;
                                      ?>
                                      </div>
                                    </div>
                                    <div class="col-auto">
                                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>                    
                                      </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            
                             <!-- Area Chart -->
            <div class="col-xl-7 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">GRAPH-1</h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>                    </a>
                    
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-area">
                    <script type="text/javascript" src="dist/canvasjs.js"></script>
					<div id="chartContainer" style="height: 300px; width: auto;padding:10px;"></div>
                  </div>
                </div>
              </div>
            </div>
			<script>
$(document).ready(function () {
            showGraph();
			
        });

 function showGraph()
        {		{
                //alert('hi');
				var v='-1';
				var v1='0';
				
				var scriptUrl="dashboard_chart.php?item_code="+v+'&suppliercode='+v1;
				//alert(scriptUrl);				
				$.post(scriptUrl,
                function (data2)
                {
					var chart = new CanvasJS.Chart("chartContainer", {
		
						
					  title:{
						text: "Graph-1",
						
					  },
					  data: [//array of dataSeries
						{ //dataSeries object
				
						 /*** Change type "column" to "bar", "area", "line" or "pie" or "pie" doughnut***/
						 
						 type: "line",
						 dataPoints:data2
						 
					   }]
					   });
				chart.render();				

                });
            }
        }
</script>
            <!-- Pie Chart -->
            <div class="col-xl-5 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">GRAPH-2 </h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>                    </a>
                    
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                
               <script>

$(document).ready(function () {
            showGraph1();
			showGraph();
			
        });

 function showGraph1()
        {		{
                //alert('hi');
				var v='-1';
				var v1='0';
				
				var scriptUrl="dashboard_chart1.php?item_code="+v+'&suppliercode='+v1;
				//alert(scriptUrl);				
				$.post(scriptUrl,
                function (data2)
                {
					var chart = new CanvasJS.Chart("chartContainer1", {
		
						
					  title:{
						text: "Graph-2",
						
					  },
					  data: [//array of dataSeries
						{ //dataSeries object
				
						 /*** Change type "column" to "bar", "area", "line" or "pie" or "pie" doughnut***/
						 
						 type: "doughnut",	
						 					 
						 dataPoints:data2 
					   }]
					   });
				chart.render();				

                });
            }
        }
</script>


                  
                  <div class="chart-area">
                 
                    <script type="text/javascript" src="dist/canvasjs.js"></script>
					<div id="chartContainer1" style="height: 300px; width: auto;padding:10px;"></div>
                  </div>
                </div>
              </div>
            </div>
                        <?php
                        }//sub Master End
                        ?>    

            </div>
           
           
           <?php
		  }
		  else if($_SESSION['uAccess'] == '1')
		  {
		  ?>
          	<div class="row">

							 <?php //Sub Master
                      if($_SESSION['subAccess']=='1,2,3,4,5')
                      {}
                      else if($_SESSION['subAccess'] == '1,2,3,4')
                      {}
                      else if($_SESSION['subAccess'] == '1,2,3')
                      {}
                      else if($_SESSION['subAccess'] == '1,2,4,5')
                      {}
                      else if($_SESSION['subAccess'] == '1,2,5')
                      {}
                      else if($_SESSION['subAccess'] == '1,3,4,5')
                      {}
                      else if($_SESSION['subAccess'] == '1,3,5')
                      {}
                      else if($_SESSION['subAccess'] == '1')
                      {}
                      else if($_SESSION['subAccess'] == '2')
                      {}
                      else if($_SESSION['subAccess'] == '3')
                      {}
                      else if($_SESSION['subAccess'] == '4')
                      {}
                      else if($_SESSION['subAccess'] == '5')
                      {}
                      else if($_SESSION['subAccess'] == '1,2')
                      {}
                      else if($_SESSION['subAccess'] == '1,3')
                      {}
                      else if($_SESSION['subAccess'] == '1,4')
                      {}
                      else if($_SESSION['subAccess'] == '1,5')
                      {}
                      else if($_SESSION['subAccess'] == '2,3')
                      {}
                      else if($_SESSION['subAccess'] == '2,4')
                      {}
                      else if($_SESSION['subAccess'] == '2,5')
                      {}
                      else if($_SESSION['subAccess'] == '3,4')
                      {}
                      else if($_SESSION['subAccess'] == '3,5')
                      {}
                      else if($_SESSION['subAccess'] == '4,5')
                      {}
                      else if($_SESSION['subAccess'] == '1,2,4')
                      {}
                     else if($_SESSION['subAccess'] == '2,3,4')
                     {}
                      else if($_SESSION['subAccess'] == '1,3,4')
                      {}
                      else if($_SESSION['subAccess'] == '2,3,5')
                      {}
                       else if($_SESSION['subAccess'] == '2,4,5')
                       {}
                      else if($_SESSION['subAccess'] == '1,4,5')
                      {}
                        else
                        {}//sub Master End
                        ?>    

            </div>
          
          <?php
		  }
		  else if($_SESSION['uAccess'] == '1,2')
		  {
		  ?>
          	<div class="row">
					<?php //Sub Master
                      if($_SESSION['subAccess']=='1,2,3,4,5')
                      {}
                      else if($_SESSION['subAccess'] == '1,2,3,4')
                      {}
                      else if($_SESSION['subAccess'] == '1,2,3')
                      {}
                      else if($_SESSION['subAccess'] == '1,2,4,5')
                      {}
                      else if($_SESSION['subAccess'] == '1,2,5')
                      {}
                      else if($_SESSION['subAccess'] == '1,3,4,5')
                      {}
                      else if($_SESSION['subAccess'] == '1,3,5')
                      {}
                      else if($_SESSION['subAccess'] == '1')
                      {}
                      else if($_SESSION['subAccess'] == '2')
                      {}
                      else if($_SESSION['subAccess'] == '3')
                      {}
                      else if($_SESSION['subAccess'] == '4')
                      {}
                      else if($_SESSION['subAccess'] == '5')
                      {}
                      else if($_SESSION['subAccess'] == '1,2')
                      {}
                      else if($_SESSION['subAccess'] == '1,3')
                      {}
                      else if($_SESSION['subAccess'] == '1,4')
                      {}
                      else if($_SESSION['subAccess'] == '1,5')
                      {}
                      else if($_SESSION['subAccess'] == '2,3')
                      {}
                      else if($_SESSION['subAccess'] == '2,4')
                      {}
                      else if($_SESSION['subAccess'] == '2,5')
                      {}
                      else if($_SESSION['subAccess'] == '3,4')
                      {}
                      else if($_SESSION['subAccess'] == '3,5')
                      {}
                      else if($_SESSION['subAccess'] == '4,5')
                      {}
                      else if($_SESSION['subAccess'] == '1,2,4')
                      {}
                     else if($_SESSION['subAccess'] == '2,3,4')
                     {}
                      else if($_SESSION['subAccess'] == '1,3,4')
                      {}
                      else if($_SESSION['subAccess'] == '2,3,5')
                      {}
                       else if($_SESSION['subAccess'] == '2,4,5')
                       {}
                      else if($_SESSION['subAccess'] == '1,4,5')
                      {}
                        else
                        {}//sub Master End
                        ?>    

            </div>
            
           <?php
		  }
		  else if($_SESSION['uAccess'] == '1,3')
		  {
		  ?>
          	<div class="row">

							 <?php //Sub Master
                      if($_SESSION['subAccess']=='1,2,3,4,5')
                      {}
                  else if($_SESSION['subAccess'] == '1,2,3,4')
                  {}
                  else if($_SESSION['subAccess'] == '1,2,3')
                  {}
                  else if($_SESSION['subAccess'] == '1,2,4,5')
                  {}
                  else if($_SESSION['subAccess'] == '1,2,5')
                  {}
                  else if($_SESSION['subAccess'] == '1,3,4,5')
                  {}
                  else if($_SESSION['subAccess'] == '1,3,5')
                  {}
                  else if($_SESSION['subAccess'] == '1')
                  {}
                  else if($_SESSION['subAccess'] == '2')
                  {}
                  else if($_SESSION['subAccess'] == '3')
                  {}
                  else if($_SESSION['subAccess'] == '4')
                  {}
                  else if($_SESSION['subAccess'] == '5')
                  {}
                  else if($_SESSION['subAccess'] == '1,2')
                  {}
                  else if($_SESSION['subAccess'] == '1,3')
                  {}
                  else if($_SESSION['subAccess'] == '1,4')
                  {}
                  else if($_SESSION['subAccess'] == '1,5')
                  {}
                  else if($_SESSION['subAccess'] == '2,3')
                  {}
                  else if($_SESSION['subAccess'] == '2,4')
                  {}
                  else if($_SESSION['subAccess'] == '2,5')
                  {}
                  else if($_SESSION['subAccess'] == '3,4')
                  {}
                  else if($_SESSION['subAccess'] == '3,5')
                  {}
                  else if($_SESSION['subAccess'] == '4,5')
                  {}
                  else if($_SESSION['subAccess'] == '1,2,4')
                  {}
                 else if($_SESSION['subAccess'] == '2,3,4')
                 {}
                  else if($_SESSION['subAccess'] == '1,3,4')
                  {}
                  else if($_SESSION['subAccess'] == '2,3,5')
                  {}
                   else if($_SESSION['subAccess'] == '2,4,5')
                   {}
                  else if($_SESSION['subAccess'] == '1,4,5')
                  {}
                    else
                    {}//sub Master End
                    ?>    

        </div> 
            
           <?php
		  }
		  else if($_SESSION['uAccess'] == '2,3')
		  {}
		  else if($_SESSION['uAccess'] == '2')
		  {}
		  else if($_SESSION['uAccess'] == '3')
		  {}
		  else if($_SESSION['uAccess'] == '0')
		  {
		  ?>
          
         	 <div class="row">

            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
				  <a href="stockReg.php" alt="Stock" style="text-decoration: none;">		
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Stock</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                      <?php
					  include('mysql.connect.php');
                      $qry="SELECT SUM(stk_qty) AS tot FROM stock_tbl WHERE sts!='2'";
					  $st=$mysql->prepare($qry);
					  $st->execute();
					  while($row=$st->fetch(PDO::FETCH_ASSOC))
					  {
						  echo '<a href="stockReg.php">'.round($row['tot'],2).'</a>';
					  }
					  $mysql=null;
					  ?>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-gray-300"></i>                    
                    </div>
                  </div>
					</a>	  
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
				  <a href="stockReg_r.php" alt="Reorder Count" style="text-decoration: none;">		
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">RE - ORDER LEVEL</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                      <?php
					  include('mysql.connect.php');
                      $qry="SELECT stk_qty,reord_qty FROM stock_tbl WHERE sts!='2'";
					  $st=$mysql->prepare($qry);
					  $st->execute();
			  		  $rordCnt=0;
					  while($row=$st->fetch(PDO::FETCH_ASSOC))
					  {
						//var_dump($row['stk_qty']<$row['reord_qty']);
						if($row['stk_qty']<$row['reord_qty'])
						{
							$rordCnt++;
						}
					  }
			  		  echo '<a href="stockReg_r.php">'.$rordCnt.'</a>';	
					  $mysql=null;
					  ?>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-gray-300"></i>                   
                       </div>
                  </div>
					</a>	  
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
				  <a href="stockReg_ost.php" alt="Reorder Count" style="text-decoration: none;">	
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">OUT OF STOCK</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                      <?php
					  include('mysql.connect.php');
                      $qry="SELECT COUNT(itemId) AS total FROM stock_tbl WHERE sts!='2' AND stk_qty='0'";
					  $st=$mysql->prepare($qry);
					  $st->execute();
					  while($row=$st->fetch(PDO::FETCH_ASSOC))
					  {
						  echo '<a href="stockReg_ost.php">'.$row['total'].'</a>';
					  }
					  $mysql=null;
					  ?>
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

            <!-- Pending Requests Card Example -->
            
			<div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
				<a href="expiryReg.php" alt="expiry date" style="text-decoration: none;">	
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Expiry Date</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                      <?php
					  /*include('mysql.connect.php');
                      $qry="SELECT COUNT(dId) AS total FROM drum_master WHERE sts='0'";
					  $st=$mysql->prepare($qry);
					  $st->execute();
					  while($row=$st->fetch(PDO::FETCH_ASSOC))
					  {
						  echo '<a href="drumMaster.php">'.$row['total'].'</a>';
					  }
					  $mysql=null;*/
					  ?>
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
          
          	<div class="row">

            <!-- Area Chart -->
            <div class="col-xl-7 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">IN DETAILS - RAW MATERIAL</h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>                    </a>
                    
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
$(document).ready(function () {
            showGraph();
			
        });

 function showGraph()
 {		
    //alert('hi');
    var v='-1';
    var v1='1';

    //var scriptUrl="dashboard_chart.php?item_code="+v+'&suppliercode='+v1;
    var scriptUrl="dashboard_chart.php?iType="+v1;
    //alert(scriptUrl);				
    $.post(scriptUrl,
    function (dataIn)
    {
        var chart = new CanvasJS.Chart("chartContainer", {


          title:{
            text: "IN DETAILS - RAW MATERIAL",

          },
          data: [//array of dataSeries
            { //dataSeries object

             /*** Change type "column" to "bar", "area", "line" or "pie" or "pie" doughnut***/

             type: "column",
             dataPoints:dataIn

           }]
           });
    chart.render();				

    });
 }
				
</script>
            <!-- Pie Chart -->
            <div class="col-xl-5 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">OUT DETAILS - RAW MATERIAL</h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>                    </a>
                    
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                
               <script>

$(document).ready(function () {
            showGraph1();
			showGraph();
			
        });

 function showGraph1()
        {		
			
                //alert('hi');
				var v='-1';
				var v1='1';
				
				var scriptUrl="dashboard_chart1.php?iType="+v1;
				//alert(scriptUrl);				
				$.post(scriptUrl,
                function (data2)
                {
					var chart = new CanvasJS.Chart("chartContainer1", {
		
						
					  title:{
						text: "OUT DETAILS - RAW MATERIAL",
						
					  },
					  data: [//array of dataSeries
						{ //dataSeries object
				
						 /*** Change type "column" to "bar", "area", "line" or "pie" or "pie" doughnut***/
						 
						 type: "column",	
						 					 
						 dataPoints:data2 
					   }]
					   });
				chart.render();				

                });
            
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
          <div class="row">

            <!-- Content Column -->
            <div class="col-lg-6 mb-4">

              <!-- Project Card Example -->
              <!--<div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
                </div>
                <div class="card-body">
                  <h4 class="small font-weight-bold">Server Migration <span class="float-right">20%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <h4 class="small font-weight-bold">Sales Tracking <span class="float-right">40%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <h4 class="small font-weight-bold">Customer Database <span class="float-right">60%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <h4 class="small font-weight-bold">Payout Details <span class="float-right">80%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <h4 class="small font-weight-bold">Account Setup <span class="float-right">Complete!</span></h4>
                  <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>-->

              <!-- Color System -->
              <!--<div class="row">
                <div class="col-lg-6 mb-4">
                  <div class="card bg-primary text-white shadow">
                    <div class="card-body">
                      Primary
                      <div class="text-white-50 small">#4e73df</div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 mb-4">
                  <div class="card bg-success text-white shadow">
                    <div class="card-body">
                      Success
                      <div class="text-white-50 small">#1cc88a</div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 mb-4">
                  <div class="card bg-info text-white shadow">
                    <div class="card-body">
                      Info
                      <div class="text-white-50 small">#36b9cc</div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 mb-4">
                  <div class="card bg-warning text-white shadow">
                    <div class="card-body">
                      Warning
                      <div class="text-white-50 small">#f6c23e</div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 mb-4">
                  <div class="card bg-danger text-white shadow">
                    <div class="card-body">
                      Danger
                      <div class="text-white-50 small">#e74a3b</div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 mb-4">
                  <div class="card bg-secondary text-white shadow">
                    <div class="card-body">
                      Secondary
                      <div class="text-white-50 small">#858796</div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 mb-4">
                  <div class="card bg-light text-black shadow">
                    <div class="card-body">
                      Light
                      <div class="text-black-50 small">#f8f9fc</div>
                    </div>
                  </div>
              </div>
              <div class="col-lg-6 mb-4">
                <div class="card bg-dark text-white shadow">
                  <div class="card-body">
                      Dark
                      <div class="text-white-50 small">#5a5c69</div>
                  </div>
                </div>
              </div>
            </div>-->
            </div>

            <div class="col-lg-6 mb-4">

              <!-- Illustrations -->
              <!--<div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Illustrations</h6>
                </div>
                <div class="card-body">
                  <div class="text-center">
                    <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="img/undraw_posting_photo.svg" alt="">                  </div>
                  <p>Add some quality, svg illustrations to your project courtesy of <a target="_blank" rel="nofollow" href="https://undraw.co/">unDraw</a>, a constantly updated collection of beautiful svg images that you can use completely free and without attribution!</p>
                  <a target="_blank" rel="nofollow" href="https://undraw.co/">Browse Illustrations on unDraw &rarr;</a>                </div>
              </div>-->

              <!-- Approach -->
              <!--<div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Development Approach</h6>
                </div>
                <div class="card-body">
                  <p>SB Admin 2 makes extensive use of Bootstrap 4 utility classes in order to reduce CSS bloat and poor page performance. Custom CSS classes are used to create custom components and custom utility classes.</p>
                  <p class="mb-0">Before working with this theme, you should become familiar with the Bootstrap framework, especially the utility classes.</p>
                </div>
              </div>-->
            </div>
          </div>

        	</div>
			
			
          <?php
		  }
		  ?>


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