<?php include('log_check.php')?>
<!DOCTYPE html>
<html lang="en">

<head>

 <?php
 include("inc/meta.php");
 ?>
 <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<script>
function del(id)
 {

	
	var r = confirm("Do you want to Delete this User....?");
	if (r == true) {
	var scriptUrl ='del_user.php?id='+id;
	//alert(scriptUrl);
	$.ajax({url:scriptUrl,success:function(result)
	{	
	alert('Record Deleted Successfully...');
	window.location.href='user_master.php';
	}});
	
	} 
	else {
	txt = "You Pressed Cancel!";
	}

}
</script>
</head>

<body id="page-top">

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
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
               </a>
             
            </li>
          </ul>
        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h4 mb-0 text-gray-800">User Master</h1>     
          </div>
          
          
    
     <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">User Master</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr style="background-color:#5377e0">
                      <th style="color:#fff;text-align:center;">No.</th>
                      <th style="color:#fff;text-align:center;">Name</th>
                      <th style="color:#fff;text-align:center;">Password</th>
                      <th style="color:#fff;text-align:center;">Access</th>
                      <th style="color:#fff;text-align:center;">Delete</th>
                    </tr>
                  </thead>
                  <?php 
				  include('mysql.connect.php');
				  $qq="SELECT id,UserNm,pwd,u_access FROM admin_tbl WHERE sts='0'";
					   //echo $qq."<br>";
				  $stm=$mysql->prepare($qq);
				  $stm->execute();
				  $cnt=1;
				  while($row=$stm->fetch(PDO::FETCH_ASSOC))
				  {
					  $id=$row['id'];
					  echo'<tr>';
					  echo '<td align="center">'.$cnt.'</td>';
					  echo '<td align="center">'.$row['UserNm'].'</td>';
					  echo '<td align="center">'.$row['pwd'].'</td>';
					  
					  if($row['u_access'] == '1,2,3')
					  {
					  echo '<td align="center">Master,Output Formula,Report</td>';  
					  }
					  else if($row['u_access'] == '1')
					  {
					  echo '<td align="center">Master</td>';  
					  }
					  else if($row['u_access'] == '2')
					  {
					  echo '<td align="center">Output Formula</td>';  
					  }
					  else if($row['u_access'] == '3')
					  {
					  echo '<td align="center">Report</td>';  
					  }
					  else if($row['u_access'] == '1,2')
					  {
					  echo '<td align="center">Master,Output Formula,Report</td>';  
					  }
					  else if($row['u_access'] == '1,3')
					  {
					  echo '<td align="center">Master,Report</td>';  
					  }
					  else if($row['u_access'] == '2,3')
					  {
					  echo '<td align="center">Output Formula,Report</td>';  
					  }
					  else
					  {
						echo '<td align="center">All</td>';    
					  }
					  
					  echo '<td align="center"><a href="javascript:del('.$id.')"><i class="fa fa-trash" style="color:#F00"></i></a></td>';
					  echo '</tr>';
					  $cnt++;
				  }
				  $mysql=null;
				  ?>
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
  <!-- Logout Modal-->  <!-- Bootstrap core JavaScript-->
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
</body>

</html>