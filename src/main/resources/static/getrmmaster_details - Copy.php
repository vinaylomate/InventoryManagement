<?php include('log_check.php')?>
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
    .chosen-rtl .chosen-drop 
	{ left: -9000px;
	
	}
  </style>

 <script>
 function contactvalidation()
  {
	var contact=document.getElementById('txtph').value;
	//alert(s_name);
	var scriptUrl='getph.php?txtcontact='+contact;
	  $.ajax({url:scriptUrl,success:function(result)
		  {
		      //alert(result);
			 var str = result;
			 if(str == 1)
			 {
				 alert('This Contact No Already Exist..!');
				 document.getElementById('txtph').value='';
				 document.getElementById('txtph').focus();
			 }
			 
		   // $("#s_id").html(str);
		  }
		  });
  }
  
function mobvalidation()
  {
	var mobile=document.getElementById('txtmob').value;
	//alert(mobile);
	var scriptUrl='getmob.php?txtmob='+mobile;
	  $.ajax({url:scriptUrl,success:function(result)
		  {
		      //alert(result);
			 var str = result;
			 if(str == 1)
			 {
				 alert('This Mobile No Already Exist..!');
				 document.getElementById('txtmob').value='';
				 document.getElementById('txtmob').focus();
			 }
			 
		   // $("#s_id").html(str);
		  }
		  });
  }
 
 </script>
</head>

<body id="page-top">
 <?php
date_default_timezone_set('Asia/Calcutta');
$dt=date('Y-m-d');   
$ID=$_GET['ID'];
include('mysql.connect.php');
$qry="SELECT rmId,country,`code`,item_code,descc,price,SG,UOM,packing_size,supplier_code FROM rm_master WHERE rmId='$ID'";
$st=$mysql->prepare($qry);
$st->execute();
$row=$st->fetch(PDO::FETCH_ASSOC);
$rmId=$row['rmId'];
$country=$row['country'];
$code=$row['code'];
$item_code=$row['item_code'];
$descc=$row['descc'];
$price=$row['price'];
$SG=$row['SG'];
$UOM=$row['UOM'];
$packing_size=$row['packing_size'];
$supplier_code=$row['supplier_code'];

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
            <h1 class="h4 mb-0 text-gray-800" style="height:0px;margin-top:10px">RM Master</h1>     
          </div>
          
          <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">          
          <div class="col-lg-12">
            <div class="p-5">             
              <form class="user" action="edit_rm_master.php" method="post">
                <input type="hidden" id="eId" name="eId" value="<?php echo $rmId;?>">
                <input type="hidden" id="uid" name="uid" value="<?php echo $_SESSION['uId'];?>">
                <div class="form-group row">
                
                
                <div class="col-sm-6">
                    <label class="m-0 font-weight-bold text-primary">Date</label>                    
                    <input type="date" class="form-control form-control-sm" id="rmdt" name="rmdt" value="<?php echo $dt?>" readonly>
                  </div>
                
                <div class="col-sm-6">
                    <label class="m-0 font-weight-bold text-primary">Country</label>                    
                    <select class="form-control form-control-sm" id="txtCountry" name="txtCountry" tabindex="1" >
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
                
                <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                  <label class="m-0 font-weight-bold text-primary">Code</label>
                    <input type="text" class="form-control form-control-sm" id="txtcode" name="txtcode" value="<?php echo $code?>" placeholder="Code" tabindex="2" >
                    <input type="hidden" id="ptxtcode" name="ptxtcode" value="<?php echo $code;?>">
                  </div>
                  
                  
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label class="m-0 font-weight-bold text-primary">Item Code</label>
                    <input type="text" class="form-control form-control-sm" id="txtitemcode" name="txtitemcode" value="<?php echo $item_code?>" placeholder="Item Code" tabindex="3" >
                    <input type="hidden" id="ptxtitemcode" name="ptxtitemcode" value="<?php echo $item_code;?>">
                  </div>
                  
                </div>
                
                <div class="form-group row">
                <div class="col-sm-6">
                    <label class="m-0 font-weight-bold text-primary">Description</label>
                    <input type="text" class="form-control form-control-sm" id="txtdesc" name="txtdesc" value="<?php echo $descc?>" placeholder="Description" tabindex="4" >
                    <input type="hidden" id="ptxtdesc" name="ptxtdesc" value="<?php echo $descc;?>">
                  </div>
                  
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label class="m-0 font-weight-bold text-primary">Price</label>
                    <input type="text" class="form-control form-control-sm" id="txtprice" name="txtprice" value="<?php echo $price?>" placeholder="Price" tabindex="5" >
                    <input type="hidden" id="ptxtprice" name="ptxtprice" value="<?php echo $price;?>">
                  </div>
                  
                  
                  
                 </div>
                 
                 <div class="form-group row">
                 <div class="col-sm-6 mb-3 mb-sm-0">
                  <label class="m-0 font-weight-bold text-primary">S .G</label>
                    <input type="text" class="form-control form-control-sm" id="txtsg" name="txtsg" value="<?php echo $SG?>" placeholder="S.G" tabindex="6" >
                    <input type="hidden" id="ptxtsg" name="ptxtsg" value="<?php echo $SG;?>">
                  </div>
                  
                 <div class="col-sm-6">
                    <label class="m-0 font-weight-bold text-primary">UOM</label>
                    <select class="form-control form-control-sm" id="txtuom" name="txtuom" tabindex="7">
                    <option value="<?php echo $UOM?>"><?php echo $UOM?></option>
                    <?php
                    if($UOM == "KG")
					{
						echo '<option value="LTR">LTR</option>';
					}
					else
					{
						echo '<option value="KG">KG</option>';
					}
					?>
                    </select>
                    <input type="hidden" id="ptxtuom" name="ptxtuom" value="<?php echo $UOM;?>">
                  </div>
                 
                  </div>
                
                <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                  <label class="m-0 font-weight-bold text-primary">Packing Size</label>
                    <input type="text" class="form-control form-control-sm" id="txtpackingsize" name="txtpackingsize" value="<?php echo $packing_size?>" placeholder="Packing Size" tabindex="8" >
                    <input type="hidden" id="ptxtpackingsize" name="ptxtpackingsize" value="<?php echo $packing_size;?>">
                  </div>
                  
                  <div class="col-sm-6">
                    <label class="m-0 font-weight-bold text-primary">Supplier Code</label>
                    <select class="chosen-select form-control form-control-sm" id="txtsuppliercode" name="txtsuppliercode" tabindex="9" >
                    <option value="<?php echo $supplier_code;?>"><?php echo $supplier_code;?></option>
					<?php 
                    include('mysql.connect.php');
                    $qry="SELECT sId,supplier_code,s_nm FROM supplier_tbl where supplier_code!='$supplier_code'";
                    $st=$mysql->prepare($qry);
                    $st->execute();
                    while($row=$st->fetch(PDO::FETCH_ASSOC))
					{
						echo '<option value='.$row['supplier_code'].'>'.$row['supplier_code'].' - '.$row['s_nm'].'</option>';
					}
					$mysql=null;
                    ?>
                    </select>
                    <input type="hidden" id="ptxtsuppliercode" name="ptxtsuppliercode" value="<?php echo $supplier_code;?>">
                  </div>
                  
                  
                 </div>
                 
                <button type="submit" id="btn" name="btn" class="btn btn-primary" tabindex="10">Save</button>
               
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
    <script src="selectjs/chosen.jquery.js" type="text/javascript"></script>
  <script src="selectjs/docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
  <script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  </script>
</body>

</html>