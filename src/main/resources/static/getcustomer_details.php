<?php include('log_check.php')?>
<!DOCTYPE html>
<html lang="en">

<head>

 <?php
 include("inc/meta.php");
 ?>
 <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
 
 <script>
 function edit(id)
	{
	//alert('hi');
	window.open("getcustomer_details.php?ID="+id, "_blank", "toolbar=yes, scrollbars=yes, resizable=no, top=60, left=0, width=700, height=600");
	}
 
 function del(id)
 {

	
	var r = confirm("Do you want to Delete this Record....?");
	if (r == true) {
	var scriptUrl ='del_cust_master.php?id='+id;
	$.ajax({url:scriptUrl,success:function(result)
	{	
	alert('Record Deleted Successfully...');
	window.location.href='customerMaster.php';
	}});
	
	} 
	else {
	txt = "You Pressed Cancel!";
	}

}
 </script>
</head>

<body id="page-top">
<?php
$ID=$_GET['ID'];
include('mysql.connect.php');
$qry="SELECT cId,customer_code,c_nm,adrs,contact,mob,country FROM cust_tbl WHERE cId='$ID'";
$st=$mysql->prepare($qry);
$st->execute();
$row=$st->fetch(PDO::FETCH_ASSOC);
$cId=$row['cId'];
$customer_code=$row['customer_code'];
$c_nm=$row['c_nm'];
$adrs=$row['adrs'];
$contact=$row['contact'];
$mob=$row['mob'];
$country=$row['country'];
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
            <h1 class="h4 mb-0 text-gray-800" style="height:0px;margin-top:10px">Customer Master</h1>     
          </div>
          
          <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">          
          <div class="col-lg-12">
            <div class="p-5">             
             <form class="user" action="edit_cust_master.php" method="post">
             <input type="hidden" id="eId" name="eId" value="<?php echo $cId;?>">
             <input type="hidden" id="uid" name="uid" value="<?php echo $_SESSION['uId']?>">
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label class="m-0 font-weight-bold text-primary">Customer Code</label>
                    <input type="text" class="form-control form-control-sm" id="txtcode" name="txtcode" value="<?php echo $customer_code;?>" placeholder="Customer Code" readonly >
                  </div>
                  <div class="col-sm-6">
                    <label class="m-0 font-weight-bold text-primary">Customer Name</label>
                    <input type="text" class="form-control form-control-sm" id="txtnm" name="txtnm" value="<?php echo $c_nm;?>" placeholder="Customer Name" tabindex="1" required>
                    <input type="hidden" id="ptxtnm" name="ptxtnm" value="<?php echo $c_nm;?>">
                  </div>
                </div>
                
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label class="m-0 font-weight-bold text-primary">Address</label>
                  <input type="text" id="txtadrs" name="txtadrs" value="<?php echo $adrs;?>" class="form-control form-control-sm" placeholder="Customer Address" tabindex="2" required>
                  <input type="hidden" id="ptxtadrs" name="ptxtadrs" value="<?php echo $adrs;?>">
                  </div>
                  <div class="col-sm-6">
                    <label class="m-0 font-weight-bold text-primary">Contact No</label>
                    <input type="number" class="form-control form-control-sm" id="txtph" name="txtph" placeholder="Contact No" value="<?php echo $contact;?>" tabindex="3" required>
                  	<input type="hidden" id="ptxtph" name="ptxtph" value="<?php echo $contact;?>">
                  </div>
                </div>
                
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label class="m-0 font-weight-bold text-primary">Mobile No</label>
                    <input type="number" class="form-control form-control-sm" id="txtmob" name="txtmob" placeholder="Mobile No" value="<?php echo $mob;?>" tabindex="4" required>
                    <input type="hidden" id="ptxtmob" name="ptxtmob" value="<?php echo $mob;?>">
                  </div>
                  <div class="col-sm-6">
                    <label class="m-0 font-weight-bold text-primary">Country</label>                    
                    <select class="form-control form-control-sm" id="txtCountry" name="txtCountry" tabindex="5" required>
                    <option value="<?php echo $country;?>"><?php echo $country;?></option>
                    <?php
                    if($country=='UAE')
					{
					echo '
                    <option value="LBP">LBP</option>
                    <option value="KSA">KSA</option>';	
					}
					else if($country=='LBP')
					{
					echo '
					<option value="UAE">UAE</option>
                    <option value="KSA">KSA</option>';		
					}
					else if($country=='KSA')
					{
					echo '
					<option value="UAE">UAE</option>
                    <option value="LBP">LBP</option>';		
					}
					else
					{
					echo '
					<option value="UAE">UAE</option>
                    <option value="LBP">LBP</option>
					<option value="KSA">KSA</option>';	
					}
					?>
                    </select>
                    <input type="hidden" id="ptxtCountry" name="ptxtCountry" value="<?php echo $country;?>">
                  </div>
                </div>
                <button type="submit" id="btn" name="btn" class="btn btn-primary" tabindex="6">Save</button>
               
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