<?php include('log_check.php');
$cmpId=$_SESSION['cmpId'];
$uiType=$_SESSION['iType'];
$userId=$_SESSION['uId'];
$uRole=$_SESSION['uRole'];
$uloc=$_SESSION['loc'];
$ulocType=$_SESSION['locType'];
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

	
function getdata()
{
	var compId,locId,iType;
	if(document.getElementById('compId').value=='0')
	{
		compId="0";
	}
 	else
    {
		compId=document.getElementById('compId').value;
	}
 
 	if(document.getElementById('iType').value=='0')
	{
		iType="0";
	}
 	else
    {
		iType=document.getElementById('iType').value;
	}
 	var scriptUrl='getStockRegLoc.php?compId='+compId+'&iType='+iType;
	//alert(scriptUrl);
 	//dataTable
 	$('#tbl').load(scriptUrl);
}
	
 function view(id)
{
		//alert('hi');
	window.open("getinventoryview.php?ID="+id, "_blank", "toolbar=yes, scrollbars=yes, resizable=no, top=60, left=0, width=1000, height=600");
}
	
function getpdf()
{
	var compId,iType;
	if(document.getElementById('compId').value=='0')
	{
		compId="0";
	}
 	else
    {
		compId=document.getElementById('compId').value;
	}
 
 	if(document.getElementById('iType').value=='0')
	{
		iType="0";
	}
 	else
    {
		iType=document.getElementById('iType').value;
	}
 
 	
 
 	var scriptUrl='mpdf/print_files/stlLoc_pdf.php?compId='+compId+'&iType='+iType;
	//alert(scriptUrl);
 	//dataTable
 	window.open(scriptUrl,  "toolbar=yes, scrollbars=yes, resizable=no, top=60, left=0, width=1000, height=600");
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
          <div class="align-items-center justify-content-between mb-2" style="background-color:#3c8dbc;border-radius:5px;" align="center">
<h1 class="h3 mb-0 text-gray-801" style="padding-bottom: 5px;">Stock Report - Location Wise(RM)</h1>   
</div>
<input type="hidden" id="uid" name="uid" value="<?php echo $_SESSION['uId']?>">	
<input type="hidden" id="urole" name="urole" value="<?php echo $uRole?>">
     <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <!--<div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Inventory Register</h6>
            </div>-->
            <div class="card-body">
				<div class="row">          
<div class="col-lg-12">
<div class="p-2">             
<table cellpadding="5px">
<tr>
<td valign="top"><label class="m-0 font-weight-bold text-primary">Company</label></td>	
<td valign="top">:</td>	
<td valign="top">
<select class="chosen-select form-control form-control-sm" id="compId" name="compId" tabindex="1" style="width:250px;" onChange="getdata();">
<?php
include("mysql.connect.php");
if($cmpId=='0')
{
	$q="SELECT ID,CONCAT(company_code,' - ', company_name) AS company_name FROM company_tbl WHERE sts='0'";
	echo '<option value="0">Select</option>';
}
else
{
	$q="SELECT ID,CONCAT(company_code,' - ', company_name) AS company_name FROM company_tbl WHERE sts='0' AND ID='$cmpId'";
}
$s=$mysql->prepare($q);
$s->setFetchMode(PDO::FETCH_ASSOC);
$s->execute();
while($r=$s->fetch())
{
  echo "<option value=".$r['ID'].">".$r['company_name']."</option>";
}
$mysql=null;
?>
</select>
</td>		

<td valign="top"><label class="m-0 font-weight-bold text-primary">Product Category</label></td>	
<td valign="top">:</td>	
<td valign="top">
<select class="chosen-select form-control form-control-sm" id="iType" name="iType" tabindex="2"  onChange="getLoc();getdata();" style="width:250px;" required>
<option value="1">RAW MATERIAL</option>
</select>
</td>	
	
<td valign="top"><label class="m-0 font-weight-bold text-primary"><!--Location--></label></td>	
<td valign="top"><!--:--></td>	
<td valign="top">
<!--<select class="chosen-select form-control form-control-sm" id="location" name="location" tabindex="3" style="width:250px;" onChange="getdata()">
<option value="0">Select</option>
<?php
/*include("mysql.connect.php");
$q="SELECT ID,CONCAT(loc_code,' - ', location_name) AS location_name FROM location_tbl WHERE sts='0'";
$s=$mysql->prepare($q);
$s->setFetchMode(PDO::FETCH_ASSOC);
$s->execute();
while($r=$s->fetch())
{
  echo "<option value=".$r['ID'].">".$r['location_name']."</option>";
}
$mysql=null;*/
?>	
</select>-->
</td>		
</tr>	
	
<tr>
<td valign="top"></td>	
<td valign="top"></td>	
<td valign="top"></td>		

<td valign="top"></td>	
<td valign="top"></td>	
<td valign="top"></td>	
	
<td valign="top"></td>	
<td valign="top"></td>	
<td valign="top">
</td>		
</tr>	
	
	
	
</table>
</div>
</div>
</div>
				
<div align="right">
<a href="javascript:getpdf();"><img src="img/pdf.png" alt="download" title="download" style="width:50px; height:50px"></a>
</div>				
				<?php include('mysql.connect.php');?>
				
              <div class="table-responsive">
			  <div id="tbl">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr style="background-color:#b02923">
                      <th style="color:#fff;">Focus Code</th>
                      <th style="color:#fff">Sage Code</th>
                      <th style="color:#fff;">Product</th>
					  <?php
					  $ql="SELECT loc_code,location_name FROM location_tbl WHERE sts!='2' AND iType='1' ORDER BY loc_code";	
					  $stl=$mysql->prepare($ql);
					  $stl->execute();
					  while($row1=$stl->fetch(PDO::FETCH_ASSOC))
					  {
					  ?>
                      <th style="color:#fff">
						  <?php echo $row1['loc_code']." - ".$row1['location_name'];?>
					  </th>
					 <?php
						}
					  ?>
                      <th style="color:#fff;">Total</th>
                    </tr>
                  </thead>
                  <?php 
				  
				  /
				  if($uRole=='admin' && ($uiType=='3'||$uiType=='0'))
                  {		
				  	$qq="SELECT a.iType,a.itemId,IF(a.iType='1',r.focus_code,f.focus_code) AS focus_code,IF(a.iType='1',r.sage_code,f.sage_code) AS sage_code,IF(a.iType='1',CONCAT(rg.category_nm,' ',r.description,' - ',ru.uom),CONCAT(fgg.category_nm,' ',f.brand,' ',f.descc,' - ',fu.uom)) AS desp FROM stock_tbl AS a LEFT JOIN company_tbl AS c ON a.compId=c.ID LEFT JOIN location_tbl AS l ON a.locId=l.ID LEFT JOIN rm_master AS r ON a.itemId=r.rmId LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID LEFT JOIN fg_master AS f ON a.itemId=f.fgId LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID LEFT JOIN category_master AS rg ON r.catId=rg.catId LEFT JOIN category_master AS fgg ON f.category_id=fgg.catId WHERE a.sts!='2' AND IF(a.iType='1',r.sts!='2',f.sts!='2') AND a.iType='1' ORDER BY a.ID";
				  }
				  else
                  {		
				  	$qq="SELECT a.iType,a.itemId,IF(a.iType='1',r.focus_code,f.focus_code) AS focus_code,IF(a.iType='1',r.sage_code,f.sage_code) AS sage_code,IF(a.iType='1',CONCAT(rg.category_nm,' ',r.description,' - ',ru.uom),CONCAT(fgg.category_nm,' ',f.brand,' ',f.descc,' - ',fu.uom)) AS desp FROM stock_tbl AS a LEFT JOIN company_tbl AS c ON a.compId=c.ID LEFT JOIN location_tbl AS l ON a.locId=l.ID LEFT JOIN rm_master AS r ON a.itemId=r.rmId LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID LEFT JOIN fg_master AS f ON a.itemId=f.fgId LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID LEFT JOIN category_master AS rg ON r.catId=rg.catId LEFT JOIN category_master AS fgg ON f.category_id=fgg.catId WHERE a.sts!='2' AND IF(a.iType='1',r.sts!='2',f.sts!='2') AND a.compId='$cmpId' AND a.uid='$userId' AND a.iType='1' ORDER BY a.ID";
				  }
				  //echo $qq."<br>";
				  $stm=$mysql->prepare($qq);
				  $stm->execute();
				  $cnt=1;
				  $a=$b=$c=$d=$e=0;	
				  while($row=$stm->fetch(PDO::FETCH_ASSOC))
				  {
					  //$id=$row['ID'];
					  $itemId=$row['itemId'];
                      echo'<tr style="color:#000;font-weight:600;">';
                      echo '<td style="background-color:#0d69f445;color:#000">'.$row['focus_code'].'</td>';
                      echo '<td style="background-color:#0d69f445;color:#000">'.$row['sage_code'].'</td>';
                      echo '<td style="background-color:#0d69f445;color:#000">'.$row['desp'].'</td>';
					  
					  $ql="SELECT ID FROM location_tbl WHERE sts!='2' AND iType='1' ORDER BY loc_code";	
					  $stl=$mysql->prepare($ql);
					  $stl->execute();
					  $tot=0;
					  while($row1=$stl->fetch(PDO::FETCH_ASSOC))
					  {
						  $locId=$row1['ID'];
						  $qqq="SELECT SUM(a.stk_qty) AS stk FROM stock_tbl AS a LEFT JOIN company_tbl AS c ON a.compId=c.ID LEFT JOIN location_tbl AS l ON a.locId=l.ID LEFT JOIN rm_master AS r ON a.itemId=r.rmId LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID LEFT JOIN fg_master AS f ON a.itemId=f.fgId LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID WHERE a.sts!='2' AND IF(a.iType='1',r.sts!='2',f.sts!='2') AND  a.iType='1' AND a.locId='$locId' AND a.itemId='$itemId' ORDER BY a.ID";
						  $stl1=$mysql->prepare($qqq);
						  $stl1->execute();
						  $row11=$stl1->fetch(PDO::FETCH_ASSOC);
						  $stk=0;
						  if(!empty($row11['stk']))
						  {
						  	$stk=$row11['stk'];
							$tot=$tot+$stk;
						  }
						  echo '<td style="background-color:#0d69f445;color:#000">'.$stk.'</td>';
					  }
					  echo '<td style="background-color:#f4b80d61;color:#000">'.$tot.'</td>';
					  $a=$a+$tot;
                      echo '</tr>';  

					  $cnt++;
				  }
				  ?>
                  <tfoot>
                    <tr style="background-color:#b02923">
                      <th style="color:#fff;"></th>
                      <th style="color:#fff"></th>
                      <th style="color:#fff;"></th>
					  <?php
					  $ql="SELECT loc_code,location_name FROM location_tbl WHERE sts!='2' AND iType='1' ORDER BY loc_code";	
					  $stl=$mysql->prepare($ql);
					  $stl->execute();
					  $ct=$stl->rowCount();
					  $k=1;
					  while($row1=$stl->fetch(PDO::FETCH_ASSOC))
					  {
						  if($k==$ct)
						  {
							echo '<th style="color:#fff">Total</th> '; 
						  }
					  	  else
						  {
							 echo '<th style="color:#fff"></th> ';  
						  }
						$k++;  
						}
					  ?>
                      <th style="color:#fff;"><?php echo $a;?></th>
                    </tr>
                  </tfoot>
					
                </table>
            </div>		    
			</div>
            </div>
          </div>
          <?php 
				  $mysql=null;?>
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