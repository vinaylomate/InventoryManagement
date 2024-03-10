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
$ID=$_GET['ID'];
include('mysql.connect.php');
$qry="SELECT a.fgId,a.category_id,a.uom,a.company_id,a.location_id,b.category_nm,a.sage_code,a.focus_code,a.descc,a.brand,a.capacity,c.uom AS unit_name,d.company_name,e.location_name,a.reorder_level_qty,a.product_expiry FROM `fg_master` AS a LEFT JOIN `category_master` AS b ON a.category_id=b.catId LEFT JOIN `uom_tbl` AS c ON a.uom=c.ID LEFT JOIN `company_tbl` AS d ON a.company_id=d.ID LEFT JOIN `location_tbl` AS e ON a.location_id=e.ID WHERE a.sts='0' and a.fgId='$ID'";
//echo $qry."<br>";	
$st=$mysql->prepare($qry);
$st->execute();
$row=$st->fetch(PDO::FETCH_ASSOC);
$fgId=$row['fgId'];
$category_id=$row['category_id'];
$category=$row['category_nm'];
/*$code=$row['code'];*/
$uom=$row['uom'];
$uomNm=$row['unit_name'];
$company_id=$row['company_id'];
$location_id=$row['location_id'];
$sage_code=$row['sage_code'];
$focus_code=$row['focus_code'];
$descc=$row['descc'];
$reordQty=$row['reorder_level_qty'];
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
            <h1 class="h4 mb-0 text-gray-800" style="height:0px;margin-top:10px">FG Master</h1>     
          </div>
          
          <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">          
          <div class="col-lg-12">
            <div class="p-5">             
              <form class="user" action="edit_fg_master.php" method="post">
              <input type="hidden" value="<?php echo $fgId;?>" id="eId" name="eId">
              <input type="hidden" id="uid" name="uid" value="<?php echo $_SESSION['uId']?>">
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label class="m-0 font-weight-bold text-primary">Category</label>
                    <select class="chosen-select form-control form-control-sm" id="txtcategory" name="txtcategory" tabindex="1" required>
                    <option value="<?php echo $category_id;?>"><?php echo $category;?></option>
                    <?php 
					include('mysql.connect.php');
					$q="SELECT catId,category_nm FROM category_master where catId!='$category_id'";
					$s=$mysql->prepare($q);
					$s->execute();
					while($row=$s->fetch(PDO::FETCH_ASSOC))
					{
						echo '<option value="'.$row['catId'].'">'.$row['category_nm'].'</option>';
					}
					$mysql=null;
					?>
                    </select>
                    <input type="hidden" id="ptxtcategory" name="ptxtcategory" value="<?php echo $category_id;?>">
                  </div>
                  <!--<div class="col-sm-6">
                    <label class="m-0 font-weight-bold text-primary">Code</label>
                    <input type="text" class="form-control form-control-sm" id="txtcode" name="txtcode" value="<?php echo $code;?>" placeholder="Code" tabindex="2" required>
                  </div>-->
                   <div class="col-sm-6">
                    <label class="m-0 font-weight-bold text-primary">Sage Code</label>
                    <input type="text" class="form-control form-control-sm" id="txtitemcode" name="txtitemcode" value="<?php echo $sage_code;?>" placeholder="Item Code" tabindex="3" required readonly>
                  </div>
                </div>
                
                <div class="form-group row">
                 
                  <div class="col-sm-6">
                    <label class="m-0 font-weight-bold text-primary">Description</label>
                    <input type="text" class="form-control form-control-sm" id="txtdesc" name="txtdesc" value="<?php echo $descc;?>" placeholder="Description" tabindex="4" required>
                  <input type="hidden" id="ptxtdesc" name="ptxtdesc" value="<?php echo $descc;?>">
                  </div>
                  <div class="col-sm-6">
                    <label class="m-0 font-weight-bold text-primary">UOM</label>                    
                    <select class="form-control form-control-sm" id="txtuom" name="txtuom"  tabindex="5" required> 
                    <option value="<?php echo $uom;?>"><?php echo $uomNm;?></option>
                    <?php 
					include('mysql.connect.php');
					$qq="SELECT ID,uom FROM uom_tbl WHERE uom!='$uom' AND sts='0'";
					echo $qq."<br>";
					$ss=$mysql->prepare($qq);
					$ss->execute();
					while($row=$ss->fetch(PDO::FETCH_ASSOC))
					{
						echo '<option value="'.$row['ID'].'">'.$row['uom'].'</option>';
					}
					$mysql=null;
					?>
                    </select>
                    <input type="hidden" id="ptxtuom" name="ptxtuom" value="<?php echo $uom;?>">
                  </div>
                </div>
                
                
				<div class="form-group row">
                 
                  <div class="col-sm-6">
                    <label class="m-0 font-weight-bold text-primary">Reorder Level(Qty)</label>
                    <input type="text" class="form-control form-control-sm" id="reorder_level_qty" name="reorder_level_qty" value="<?php echo $reordQty;?>" placeholder="Description" tabindex="5.1" required>
                  <input type="hidden" id="preorder_level_qty" name="preorder_level_qty" value="<?php echo $reordQty;?>">
                  </div>
                  <div class="col-sm-6">
                    <label class="m-0 font-weight-bold text-primary"></label> 
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