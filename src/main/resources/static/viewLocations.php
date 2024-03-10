<?php include('log_check.php')?>
<!DOCTYPE html>
<html lang="en">

<head>

 <?php
 include("inc/meta.php");
 ?>
 <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
 
 <script>
function closeW()	
{
  window.close();
}</script>
</head>

<body id="page-top">
<?php
$ID=$_GET['ID'];	
include('mysql.connect.php');
$qry="SELECT id,UserNm,act_edit AS ed,act_delete AS del,act_create AS cr,act_view AS vw FROM admin_tbl WHERE sts='0' AND id='$ID'";
$st=$mysql->prepare($qry);
$st->execute();
$row=$st->fetch(PDO::FETCH_ASSOC);
$cId=$row['id'];
$nm=$row['UserNm'];
$mysql=null;	
?>
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
            <h1 class="h4 mb-0 text-gray-800" style="height:0px;margin-top:10px">User Creation - Locations</h1>     
          </div>
          
          <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">          
          <div class="col-lg-12">
            <div class="p-5">             
             <form class="user" action="changeAction_edit.php" method="post">
             <input type="hidden" id="eId" name="eId" value="<?php echo $cId;?>">
             <input type="hidden" id="uid" name="uid" value="<?php echo $_SESSION['uId']?>">
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label class="m-0 font-weight-bold text-primary">User Name</label>
                    <input type="text" class="form-control form-control-sm" id="txtcode" name="txtcode" value="<?php echo $nm;?>" placeholder="Customer Code" readonly >
                  </div>
                  
                </div>
                
                <div class="form-group row">
<div class="col-sm-8">
<label class="m-0 font-weight-bold text-primary">Locations</label>
<br>
<table class="table-bordered" width="100%">
<tr>
<th>Sr.No.</th>
<th>Location</th>	
<th>Location Product Category</th>		
</tr>
<?php
include('mysql.connect.php');
$qry2="SELECT CONCAT(b.loc_code,' ',b.location_name) AS locNm,IF(a.locType='0','RAW MATERIAL','FINISHED GOODS') AS iTypeNm FROM admin_usr_loc AS a LEFT JOIN location_tbl AS b ON a.locId=b.ID WHERE b.sts='0' AND a.uid='$ID'";
$st2=$mysql->prepare($qry2);
$st2->execute();
$cnt=1;	
while($row2=$st2->fetch(PDO::FETCH_ASSOC))
{
  echo '<tr>';
  echo '<td>'.$cnt.'</td>';
  echo '<td>'.$row2['locNm'].'</td>';
  echo '<td>'.$row2['iTypeNm'].'</td>';	
  echo '</tr>';
}
$mysql=null;		
?>
</table>	
</div>
</div>
                
                
                <button type="button" id="btnC" name="btnC" class="btn btn-danger" tabindex="6" onClick="closeW();">Close</button>
               
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