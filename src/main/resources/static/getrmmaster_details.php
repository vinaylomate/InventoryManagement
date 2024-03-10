<?php include('log_check.php');
$cmpId=$_SESSION['cmpId'];
$uiType=$_SESSION['iType'];
$userId=$_SESSION['uId'];
$uRole=$_SESSION['uRole'];
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
$qry="SELECT a.rmId,a.dt,a.sage_code,a.focus_code,a.description,b.uom AS packing_size,a.UOM,a.company_id,a.location_id,a.reorder_level_qty,a.product_expiry 
FROM rm_master AS a LEFT JOIN uom_tbl AS b ON a.UOM=b.ID WHERE a.rmId='$ID'";
//echo $qry;
$st=$mysql->prepare($qry);
$st->execute();
$row=$st->fetch(PDO::FETCH_ASSOC);
$rmId=$row['rmId'];
$dt=$row['dt'];
$sage_code=$row['sage_code'];
$focus_code=$row['focus_code'];
$description=$row['description'];
$packing_size=$row['packing_size'];
$UOM=$row['UOM'];
$company_id=$row['company_id'];
$location_id=$row['location_id'];
$reorder_level_qty=$row['reorder_level_qty'];
$product_expiry=$row['product_expiry'];
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
              <form class="user" action="#" method="post" id="rm_master_edit" name="rm_master_edit">
                <input type="hidden" id="eId" name="eId" value="<?php echo $rmId;?>">
                <input type="hidden" id="uid" name="uid" value="<?php echo $_SESSION['uId'];?>">
                <input type="hidden" id="p_sage_code" name="p_sage_code" value="<?php echo $sage_code;?>">
                <input type="hidden" id="p_focus_code" name="p_focus_code" value="<?php echo $focus_code;?>">
                <input type="hidden" id="p_description" name="p_description" value="<?php echo $description;?>">
                <input type="hidden" id="p_UOM" name="p_UOM" value="<?php echo $UOM;?>">
                <input type="hidden" id="p_company_id" name="p_company_id" value="<?php echo $company_id;?>">
                <input type="hidden" id="p_location_id" name="p_location_id" value="<?php echo $location_id;?>">
                <input type="hidden" id="p_reorder_level_qty" name="p_reorder_level_qty" value="<?php echo $reorder_level_qty;?>">
                <input type="hidden" id="p_product_expiry" name="p_product_expiry" value="<?php echo $product_expiry;?>">
                
               
              <div class="form-group row">
                
                <div class="col-sm-6">
                    <label class="m-0 font-weight-bold text-primary">Sage Code</label>                    
                   <input type="text" id="sage_code" name="sage_code" class="form-control form-control-sm" placeholder="Sage Code" readonly value="<?php echo $sage_code?>">
                  </div>
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label class="m-0 font-weight-bold text-primary">Focus Code</label>
                    <input type="text" class="form-control form-control-sm" id="focus_code" name="focus_code" placeholder="Focus Code" readonly value="<?php echo $focus_code?>">
                  </div>
                  
                </div>
                
                <div class="form-group row">
                  <div class="col-sm-6">
                    <label class="m-0 font-weight-bold text-primary">Description</label>
                    <textarea class="form-control form-control-sm" id="txtdesc" name="txtdesc" placeholder="Description" tabindex="1" >
                   <?php echo trim($description);?>
                    </textarea>
                  </div>

                  <!--<div class="col-sm-6 mb-3 mb-sm-0">
                  <label class="m-0 font-weight-bold text-primary">Packing Size</label>
                    <input type="text" class="form-control form-control-sm" id="packing_size" name="packing_size" placeholder="Packing Size" tabindex="4" value="<?php echo $packing_size?>">
                  </div>-->
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label class="m-0 font-weight-bold text-primary">UOM</label>
                    <select name="uom" id="uom" class="form-control form-control-sm" tabindex="2">
                     
                      <?php
                      include("mysql.connect.php");
                      $q="SELECT ID,uom FROM uom_tbl WHERE sts='0' and ID='$UOM'";
                      $s=$mysql->prepare($q);
                      $s->setFetchMode(PDO::FETCH_ASSOC);
                      $s->execute();
                      while($r=$s->fetch())
                       {
                        echo "<option value=".$r['ID'].">".$r['uom']."</option>";
                       }   
                       $q1="SELECT ID,uom FROM uom_tbl WHERE sts='0' and ID!='$UOM'";
                      $s1=$mysql->prepare($q1);
                      $s1->setFetchMode(PDO::FETCH_ASSOC);
                      $s1->execute();
                      while($r1=$s1->fetch())
                       {
                        echo "<option value=".$r1['ID'].">".$r1['uom']."</option>";
                       }   
                      $mysql=null;
                      ?>
                    </select>
                  </div>
                </div>
                
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label class="m-0 font-weight-bold text-primary">Company Name</label>
                    <select name="company_name" id="company_name" class="form-control form-control-sm" tabindex="3.1">                      
                      <?php
                        include("mysql.connect.php");
                        $q="SELECT ID,CONCAT(company_code,' - ', company_name) AS company_name FROM company_tbl WHERE sts='0' and ID='$company_id'";
                        $s=$mysql->prepare($q);
                        $s->setFetchMode(PDO::FETCH_ASSOC);
                        $s->execute();
                        while($r=$s->fetch())
                        {
                          echo "<option value=".$r['ID'].">".$r['company_name']."</option>";
                        }
                        /*$q1="SELECT ID,CONCAT(company_code,' - ', company_name) AS company_name FROM company_tbl WHERE sts='0' and ID!='$company_id'";
                        $s1=$mysql->prepare($q1);
                        $s1->setFetchMode(PDO::FETCH_ASSOC);
                        $s1->execute();
                        while($r1=$s1->fetch())
                        {
                          echo "<option value=".$r1['ID'].">".$r1['company_name']."</option>";
                        }*/
                        $mysql=null;
                      ?>
                    </select>
                  </div>
					
                  <div class="col-sm-6">
                    <label class="m-0 font-weight-bold text-primary">Location</label>
                    <select class="form-control form-control-sm" id="location" name="location" tabindex="3.2">
                  <?php
                    include('mysql.connect.php');
                    $q="SELECT ID,CONCAT(loc_code,' - ',location_name) AS location_name FROM location_tbl where sts='0' and ID='$location_id'";
                    $s=$mysql->prepare($q);
                    $s->execute();
                    while($row=$s->fetch(PDO::FETCH_ASSOC))
                    {
                    echo '<option value='.$row['ID'].'>'.$row['location_name'].'</option>'; 
                    }
                    /* $q1="SELECT ID,CONCAT(loc_code,' - ',location_name) AS location_name FROM location_tbl where sts='0' and ID!='$location_id'";
                    $s1=$mysql->prepare($q1);
                    $s1->execute();
                    while($row1=$s1->fetch(PDO::FETCH_ASSOC))
                    {
                    echo '<option value='.$row1['ID'].'>'.$row1['location_name'].'</option>'; 
                    }*/
                    $mysql=null;
                    ?>
                    </select>                    
                  </div>
                 </div>
                 
                 <div class="form-group row">
                 <div class="col-sm-6">
                    <label class="m-0 font-weight-bold text-primary">Reorder Level(Qty)</label>
                    <input type="text" id="reorder_level_qty" name="reorder_level_qty" tabindex="4" class="form-control form-control-sm" placeholder="Reorder Level(Qty)" value="<?php echo $reorder_level_qty?>">
                  </div>
					 
				<div class="col-sm-6 mb-3 mb-sm-0">
                  <label class="m-0 font-weight-bold text-primary">Product Expiry</label>
                    <input type="text" class="form-control form-control-sm" id="product_expiry" name="product_expiry" placeholder="Product Expiry" tabindex="5" value="<?php echo $product_expiry?>">
                  </div>	 
                 </div>
                
                
                 
                <button type="button" id="btnsubmit" name="btnsubmit" class="btn btn-primary" tabindex="6">Save</button>
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
<script type="text/javascript">

  $("#btnsubmit").click(function()
  {
    /*alert("hi");
    alert(document.getElementById("desc").value);*/

    if($("#sage_code").val().trim() =="")
    {
      $("#sage_code").addClass("require");
      alert("Please Enter Sage Code..!!");
      $("#sage_code").focus();
      return false;
      //alert("bye");
    }
    else if($("#focus_code").val().trim()=="")
    {
      $("#focus_code").addClass("require");
      alert("Please Enter Focus Code..!!");
      $("#focus_code").focus();
      return false;
    }
    else if($("#txtdesc").val().trim()=="")
    {
      $("#txtdesc").addClass("require");
      alert("Please Enter Description..!!");
      $("#txtdesc").focus();
      return false;
    }
    else if($("#uom").val().trim()=="0")
    {
      $("#uom").addClass("require");
      alert("Please Select UOM..!!");
      $("#uom").focus();
      return false;
    }
    else if($("#company_name").val().trim()=="0")
    {
      $("#company_name").addClass("require");
      alert("Please Select Company Name..!!");
      $("#company_name").focus();
      return false;
    }
    else if($("#location").val().trim()=="0")
    {
      $("#location").addClass("require");
      alert("Please Select Location Name..!!");
      $("#location").focus();
      return false;
    }
    else if($("#reorder_level_qty").val().trim()=="")
    {
      $("#reorder_level_qty").addClass("require");
      alert("Please Enter Reorder Level Qty..!!");
      $("#reorder_level_qty").focus();
      return false;
    }
    else if($("#product_expiry").val().trim()=="")
    {
      $("#product_expiry").addClass("require");
      alert("Please Enter Product Expiry..!!");
      $("#product_expiry").focus();
      return false;
    }
    
    else
    {
      document.getElementById('btnsubmit').disabled=true;
            var url = "edit_rm_master.php"; 
      //alert(url);
      // the script where you handle the form input.
      $.ajax({
           type: "POST",
           url: url,
           data: $("#rm_master_edit").serialize(), // serializes the form's elements.
           success: function(data)
           {
           alert(data);
           document.getElementById('btnsubmit').disabled=false;
           window.opener.location.reload();
           window.close();
           }
         });
     
      e.preventDefault(); 
    }
     // avoid to execute the actual submit of the form.
  });
</script>

</html>