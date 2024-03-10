<?php include('log_check.php')?>
<!DOCTYPE html>
<html lang="en">

<head>

 <?php
 include("inc/meta.php");
 ?>
 <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
 <script>
 function view(id)
	{
		//alert('hi');
	window.open("getfomulaview.php?ID="+id, "_blank", "toolbar=yes, scrollbars=yes, resizable=no, top=60, left=0, width=1000, height=600");
	}
	 function edit(id)
	{
	alert('Page Under Process....!');
	/*window.open("edit_outputFEntry.php?ID="+id, "_blank", "toolbar=yes, scrollbars=yes, resizable=no, top=60, left=0, width=1100, height=600");*/
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
            <?php include('inc/header.php');?>
          </ul>
        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="align-items-center justify-content-between mb-4" style="background-color:#3c8dbc;border-radius:5px;" align="center">
			<h1 class="h3 mb-0 text-gray-801">Product Expiry Date Master</h1>   
          </div>
          
    
     <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"></h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr style="background-color:#b02923">
                      <th style="color:#fff">No.</th>
                      <th style="color:#fff;">Date</th>
                      <th style="color:#fff">Company</th>
                      <th style="color:#fff">Location</th>
                      <th style="color:#fff">Doc. No</th>
                      <th style="color:#fff">Product Category</th>
                      <th style="color:#fff">Product</th>
                      <th style="color:#fff">Entry Type Name</th>
                      <th style="color:#fff">Entry Type</th>
                      <th style="color:#fff">Batch No</th>
                      <th style="color:#fff">Qty</th>
                      <th style="color:#fff">Remark</th>
                      <th style="color:#fff">Prod. Exp. Date</th>
                    </tr>
                  </thead>
                  <?php 
				  include('mysql.connect.php');
				  //admin_tbl 
				  $qEditDel="SELECT act_edit AS ed,act_delete AS del FROM admin_tbl WHERE sts='0' AND id='".$_SESSION['uId']."'";
				  //echo $qEditDel."<Br>";	
				  $stmEditDel=$mysql->prepare($qEditDel);
				  $stmEditDel->execute();
				  $rowEditDel=$stmEditDel->fetch(PDO::FETCH_ASSOC);
				  $ed=$rowEditDel['ed'];
				  $dels=$rowEditDel['del'];	
				  //admin_tbl	
					
				  $qq="SELECT a.ID,a.dt,a.compId,CONCAT(b.company_code,' - ',b.company_name) AS compNm,
 a.locId,CONCAT(c.loc_code,' - ', c.location_name) AS loc,a.docNo,a.iType,IF(a.iType='1','RAW MATERIAL','FINISHED GOODS') AS iTypeNm,a.itemId,
IF(a.iType='1',CONCAT(d.focus_code,' ',d.sage_code,' ',d.description),CONCAT(f.focus_code,' ',f.sage_code,' ',g.category_nm,' ',f.brand,' ',f.descc)) AS itemNm,
a.entryId,e.entryNm,a.eType,IF(a.eType='1','IN','OUT') AS eTypeNm,a.qty,a.batchNo,a.remark,a.expdt,a.uid,TIMESTAMPDIFF(MONTH, CURRENT_DATE(),expdt) AS mnt FROM inventory_tbl AS a 
 LEFT JOIN company_tbl AS b ON a.compId=b.ID 
 LEFT JOIN location_tbl AS c ON a.locId=c.ID 
 LEFT JOIN rm_master AS d ON a.itemId=d.rmId
 LEFT JOIN fg_master AS f ON a.itemId=f.fgId 
 LEFT JOIN entry_type_tbl AS e ON a.entryId=e.entryId 
 LEFT JOIN category_master AS g ON f.category_id=g.catId 
 WHERE a.sts='0' AND b.sts='0' AND c.sts='0' AND f.sts='0' AND e.sts='0' AND g.sts='0' ORDER BY a.dt DESC";
				  $stm=$mysql->prepare($qq);
				  $stm->execute();
				  $cnt=1;
				  while($row=$stm->fetch(PDO::FETCH_ASSOC))
				  {
					  $id=$row['fId'];
					  if($row['mnt']=='3')
					  {
						  echo'<tr style="background-color:#FFFF00;color:#000;font-weight:bold;">';
						  echo '<td align="center">'.$cnt.'</td>';
						  echo '<td>'.date('d-m-Y',strtotime($row['dt'])).'</td>';
						  echo '<td>'.$row['compNm'].'</td>';
						  echo '<td>'.$row['loc'].'</td>';
						  echo '<td>'.$row['docNo'].'</td>';
						  echo '<td>'.$row['iTypeNm'].'</td>';
						  echo '<td>'.$row['itemNm'].'</td>';
						  echo '<td>'.$row['entryNm'].'</td>';
						  echo '<td>'.$row['eTypeNm'].'</td>';
						  echo '<td>'.$row['batchNo'].'</td>';					  
						  echo '<td>'.$row['qty'].'</td>';				  
						  echo '<td>'.$row['remark'].'</td>';
						  echo '<td>'.date('d-m-Y',strtotime($row['expdt'])).'</td>';
						  echo '</tr>';
					  }
					  else if($row['mnt']=='2')
					  {
						  echo'<tr style="background-color:#FFA500;color:#000;font-weight:bold;">';
						  echo '<td align="center">'.$cnt.'</td>';
						  echo '<td>'.date('d-m-Y',strtotime($row['dt'])).'</td>';
						  echo '<td>'.$row['compNm'].'</td>';
						  echo '<td>'.$row['loc'].'</td>';
						  echo '<td>'.$row['docNo'].'</td>';
						  echo '<td>'.$row['iTypeNm'].'</td>';
						  echo '<td>'.$row['itemNm'].'</td>';
						  echo '<td>'.$row['entryNm'].'</td>';
						  echo '<td>'.$row['eTypeNm'].'</td>';
						  echo '<td>'.$row['batchNo'].'</td>';					  
						  echo '<td>'.$row['qty'].'</td>';				  
						  echo '<td>'.$row['remark'].'</td>';
						  echo '<td>'.date('d-m-Y',strtotime($row['expdt'])).'</td>';
						  echo '</tr>';
					  }
					  else if($row['mnt']=='1')
					  {
						  echo'<tr style="background-color:#F00;color:#000;font-weight:bold;">';
						  echo '<td align="center">'.$cnt.'</td>';
						  echo '<td>'.date('d-m-Y',strtotime($row['dt'])).'</td>';
						  echo '<td>'.$row['compNm'].'</td>';
						  echo '<td>'.$row['loc'].'</td>';
						  echo '<td>'.$row['docNo'].'</td>';
						  echo '<td>'.$row['iTypeNm'].'</td>';
						  echo '<td>'.$row['itemNm'].'</td>';
						  echo '<td>'.$row['entryNm'].'</td>';
						  echo '<td>'.$row['eTypeNm'].'</td>';
						  echo '<td>'.$row['batchNo'].'</td>';					  
						  echo '<td>'.$row['qty'].'</td>';				  
						  echo '<td>'.$row['remark'].'</td>';
						  echo '<td>'.date('d-m-Y',strtotime($row['expdt'])).'</td>';
						  echo '</tr>';
					  }
					  else
					  {
                          echo'<tr style="background-color:#FFF;color:#000;font-weight:bold;">';
                          echo '<td align="center">'.$cnt.'</td>';
                          echo '<td>'.date('d-m-Y',strtotime($row['dt'])).'</td>';
                          echo '<td>'.$row['compNm'].'</td>';
                          echo '<td>'.$row['loc'].'</td>';
                          echo '<td>'.$row['docNo'].'</td>';
                          echo '<td>'.$row['iTypeNm'].'</td>';
                          echo '<td>'.$row['itemNm'].'</td>';
                          echo '<td>'.$row['entryNm'].'</td>';
                          echo '<td>'.$row['eTypeNm'].'</td>';
                          echo '<td>'.$row['batchNo'].'</td>';					  
                          echo '<td>'.$row['qty'].'</td>';				  
                          echo '<td>'.$row['remark'].'</td>';
                          echo '<td>'.date('d-m-Y',strtotime($row['expdt'])).'</td>';
                          echo '</tr>';
					  }
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