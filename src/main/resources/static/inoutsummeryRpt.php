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
function getLoc()	
{
  //alert('hey chiru...');
  if(document.getElementById('compId').value=='0')
  {
	 if(document.getElementById('urole').value=='admin')
    {
	  
    }
	else
	{
	  alert('Plz, Select Company Name..!'); 	
	  document.getElementById('company_name').focus();	
	}
  }
  else if(document.getElementById('iType').value=='0')
  {
	 //alert('Plz, Select Product Category..!'); 
	 document.getElementById('iType').focus();
  }
  else	
  {
      var id = document.getElementById('compId').value;
	  var iType = document.getElementById('iType').value;
	  var uId= document.getElementById('uid').value;
	  var scriptUrl ='getLocations.php?compId='+id+'&iType='+iType+'&uId='+uId;
	  //alert(scriptUrl);
      $.ajax({url:scriptUrl,success:function(result)
      {	
	  	 //alert(result);
         //document.getElementById('location').innerHTML=result; 
		  $("#location").html(result).trigger("chosen:updated.chosen");
      }}); 
  }
}	

function getdata()
{
var compId,locId,iType,fdt,tdt;
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

if(document.getElementById('location').value=='0')
{
locId="0";
}
else
{
locId=document.getElementById('location').value;
}

if(document.getElementById('fdt').value=='')
{
fdt="0";
}
else
{
fdt=document.getElementById('fdt').value;
}

if(document.getElementById('tdt').value=='')
{
tdt="0";
}
else
{
tdt=document.getElementById('tdt').value;
}

var scriptUrl='getinoutsummeryRpt.php?compId='+compId+'&iType='+iType+'&locId='+locId+'&fdt='+fdt+'&tdt='+tdt;
//alert(scriptUrl);
//dataTable
$('#tbl').load(scriptUrl);
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

<body id="page-top" onLoad="getLoc();getdata();">

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
<i class="fa fa-bars"></i></button>

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
<?php
function getopenStk($dt1,$compId,$locId,$iType,$itemId)
{
	include('mysql.connect.php');
	$qopstk="SELECT oqty FROM stock_op_tbl WHERE cdt='$dt1' AND compId='$compId' AND locId='$locId' AND iType='$iType' AND itemId='$itemId' AND sts!='2'";
	//echo $qopstk."<Br>";
	$stopstk=$mysql->prepare($qopstk);
	$stopstk->execute();
	$opqty=0;
	$rowopstk=$stopstk->fetch(PDO::FETCH_ASSOC);
	if(!empty($rowopstk['oqty']))
	$opqty=$rowopstk['oqty'];
	
	return $opqty;
}
?>
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="align-items-center justify-content-between mb-2" style="background-color:#3c8dbc;border-radius:5px;" align="center">
<h1 class="h3 mb-0 text-gray-801" style="padding-bottom: 5px;">Summery( IN & Out )Report</h1>   
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
<select class="chosen-select form-control form-control-sm" id="compId" name="compId" tabindex="1" style="width:250px;" onChange="getLoc();getdata();">
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
<select class="chosen-select form-control form-control-sm" id="iType" name="iType" tabindex="2" onChange="getLoc();getdata();" style="width:250px;" required>
<?php
if($uiType=='0' || $uiType=='3')
{
?>
	<option value="0">Select</option>
	<option value="1">RAW MATERIAL</option>
	<option value="2">FINISHED GOODS</option>
<?php
}
else if($uiType=='1')
{
?>
	<option value="1">RAW MATERIAL</option>
<?php	
}
else
{
?>
<option value="2">FINISHED GOODS</option>
<?php	
}
?>
</select>
</td>	

<td valign="top"><label class="m-0 font-weight-bold text-primary">Location</label></td>	
<td valign="top">:</td>	
<td valign="top">
<select class="chosen-select form-control form-control-sm" id="location" name="location" tabindex="3" style="width:250px;" onChange="getdata();">
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
</select>
</td>		
</tr>	

<tr>
<td valign="top"><label class="m-0 font-weight-bold text-primary">From Date</label></td>	
<td valign="top">:</td>	
<td valign="top">
<input type="date" name="fdt" id="fdt" value="<?php echo date('Y-m-d');?>" class="form-control" tabindex="4" onChange="getdata()">
</td>		

<td valign="top"><label class="m-0 font-weight-bold text-primary">To Date</label></td>	
<td valign="top">:</td>	
<td valign="top">
<input type="date" name="tdt" id="tdt" value="<?php echo date('Y-m-d');?>" class="form-control" tabindex="5" onChange="getdata()">
</td>	

<td valign="top"><label class="m-0 font-weight-bold text-primary"></label></td>	
<td valign="top"></td>	
<td valign="top">

</td>		
</tr>
</table>
</div>
</div>
</div>
<div class="table-responsive">
<div id="tbl">	  
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
<thead>
<tr style="background-color:#b02923">
<th style="color:#fff;">Location</th>
<th style="color:#fff;">Focus Code</th>
<th style="color:#fff">Sage Code</th>
<th style="color:#fff;">Product</th>
<th style="color:#fff">Opening Stock</th>
<th style="color:#fff;">IN</th>
<th style="color:#fff">OUT</th>
<th style="color:#fff;">Lock Qty</th>
<th style="color:#fff;">Closing Stock</th>
<th style="color:#fff">Re - Order Level</th>
<th style="color:#fff">Re - Order Req.</th>
<th style="color:#fff">Rack No.</th>
</tr>
</thead>

<tbody>	
<?php 
include('mysql.connect.php');
$cdt=date('Y-m-d');
$qq="SELECT a.iType,a.compId,CONCAT(b.company_code,' - ',b.company_name) AS compNm,a.locId,CONCAT(c.loc_code,' - ',c.location_name) AS locNm,a.itemId,
IF(a.iType='1',d.focus_code,f.focus_code) AS fcode, IF(a.iType='1',d.sage_code,f.sage_code) AS sg,
IF(a.iType='1',CONCAT(rc.category_nm,' ',d.description,' - ',ru.uom),CONCAT(fc.category_nm,' ',f.brand,' ',f.descc,' - ',fu.uom)) AS desp
,IF(a.iType='1','RM','FG') AS iTypeNm,SUM(a.in_qty) AS inQ,SUM(a.out_qty) AS outQ,SUM(IF(a.out_qty='0',a.stk_qty,'0')) AS stkQ,a.rackNo,a.reord_qty,SUM(a.lock_qty) AS lockQ FROM stock_tbl_2 AS a LEFT JOIN company_tbl AS b ON a.compId=b.ID 
LEFT JOIN location_tbl AS c ON a.locId=c.ID 
LEFT JOIN rm_master AS d ON a.itemId=d.rmId 
LEFT JOIN category_master AS rc ON d.catId=rc.catId 
LEFT JOIN uom_tbl AS ru ON d.UOM=ru.ID 
LEFT JOIN fg_master AS f ON a.itemId=f.fgId 
LEFT JOIN category_master AS fc ON f.category_id=fc.catId 
LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID 
WHERE a.sts!='2' AND b.sts!='2' AND c.sts!='2' 
AND IF(a.iType='1',d.sts!='2',f.sts!='2') AND IF(a.iType='1',rc.sts!='2',fc.sts!='2') AND IF(a.iType='1',ru.sts!='2',fu.sts!='2') AND (a.dt BETWEEN '$cdt' AND '$cdt')
GROUP BY a.compId,a.locId,a.iType,a.itemId ORDER BY a.iType,a.itemId";
//echo $qq."<br>";
$stm=$mysql->prepare($qq);
$stm->execute();
$cnt=1;
$a=$b=$c=$d=$e=$opstk=$clstk=0;	
if($stm->rowCount()>0)
{
while($row=$stm->fetch(PDO::FETCH_ASSOC))
{		
	$iTy=$row['iType'];
	$compId=$row['compId'];
	$locId=$row['locId'];
	$itemId=$row['itemId'];
	
	if($row['iType']=='1')
	{
		$opstk=getopenStk($cdt,$compId,$locId,$iTy,$itemId);
		
		$clstk=($opstk+$row['inQ'])-($row['outQ']+$row['lockQ']);
		
		echo'<tr style="color:#000;font-weight:600;">';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['locNm'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['fcode'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['sg'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['desp'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$opstk.'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['inQ'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['outQ'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['lockQ'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$clstk.'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['reord_qty'].'</td>';
		if($row['stkQ']<$row['reord_qty'])
		{
		echo '<td style="background-color:#0d69f445;color:#F00;font-weight:bold;">Yes</td>';
		}
		else
		{
		echo '<td style="background-color:#0d69f445;color:#000">No</td>';  
		}
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['rackNo'].'</td>';
		echo '</tr>';  
	}
	else
	{
		$opstk=getopenStk($cdt,$compId,$locId,$iTy,$itemId);
		
		$clstk=($opstk+$row['inQ'])-($row['outQ']+$row['lockQ']);
		
		echo'<tr style="color:#000;font-weight:600;">';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['locNm'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['fcode'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['sg'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['desp'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$opstk.'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['inQ'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['outQ'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['lockQ'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$clstk.'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['reord_qty'].'</td>';
		if($row['stkQ']<$row['reord_qty'])
		{
		echo '<td style="background-color:#f4b80d61;color:#F00;font-weight:bold;">Yes</td>';
		}
		else
		{
		echo '<td style="background-color:#f4b80d61;color:#000">No</td>';  
		}
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['rackNo'].'</td>';
		echo '</tr>';  
	}				  
	$cnt++;
}
}
else
{
	$qq2="SELECT a.iType,a.compId,CONCAT(b.company_code,' - ',b.company_name) AS compNm,a.locId,CONCAT(c.loc_code,' - ',c.location_name) AS locNm,a.itemId, IF(a.iType='1',d.focus_code,f.focus_code) AS fcode, IF(a.iType='1',d.sage_code,f.sage_code) AS sg, IF(a.iType='1',CONCAT(rc.category_nm,' ',d.description,' - ',ru.uom),CONCAT(fc.category_nm,' ',f.brand,' ',f.descc,' - ',fu.uom)) AS desp ,IF(a.iType='1','RM','FG') AS iTypeNm,'0' AS inQ,'0' AS outQ,'0' AS stkQ,IF(a.iType='1',d.rackNo,f.rackNo) AS rackNo,IF(a.iType='1',d.reorder_level_qty,f.reorder_level_qty) AS reord_qty,'0' AS lockQ FROM stock_op_tbl AS a LEFT JOIN company_tbl AS b ON a.compId=b.ID LEFT JOIN location_tbl AS c ON a.locId=c.ID LEFT JOIN rm_master AS d ON a.itemId=d.rmId LEFT JOIN category_master AS rc ON d.catId=rc.catId LEFT JOIN uom_tbl AS ru ON d.UOM=ru.ID LEFT JOIN fg_master AS f ON a.itemId=f.fgId LEFT JOIN category_master AS fc ON f.category_id=fc.catId LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID WHERE a.sts!='2' AND b.sts!='2' AND c.sts!='2' AND IF(a.iType='1',d.sts!='2',f.sts!='2') AND IF(a.iType='1',rc.sts!='2',fc.sts!='2') AND IF(a.iType='1',ru.sts!='2',fu.sts!='2')  GROUP BY a.compId,a.locId,a.iType,a.itemId ORDER BY a.iType,a.itemId";
	//echo $qq2."<br>";
	$stm2=$mysql->prepare($qq2);
	$stm2->execute();
	$cnt=1;
	$a=$b=$c=$d=$e=$opstk=$clstk=0;	
	while($row=$stm2->fetch(PDO::FETCH_ASSOC))
	{		
		$iTy=$row['iType'];
		$compId=$row['compId'];
		$locId=$row['locId'];
		$itemId=$row['itemId'];

		if($row['iType']=='1')
		{
			$opstk=getopenStk($cdt,$compId,$locId,$iTy,$itemId);
			//echo $opstk."<Br>";
			$clstk=($opstk+$row['inQ'])-($row['outQ']+$row['lockQ']);

			echo'<tr style="color:#000;font-weight:600;">';
			echo '<td style="background-color:#0d69f445;color:#000">'.$row['locNm'].'</td>';
			echo '<td style="background-color:#0d69f445;color:#000">'.$row['fcode'].'</td>';
			echo '<td style="background-color:#0d69f445;color:#000">'.$row['sg'].'</td>';
			echo '<td style="background-color:#0d69f445;color:#000">'.$row['desp'].'</td>';
			echo '<td style="background-color:#0d69f445;color:#000">'.$opstk.'</td>';
			echo '<td style="background-color:#0d69f445;color:#000">'.$row['inQ'].'</td>';
			echo '<td style="background-color:#0d69f445;color:#000">'.$row['outQ'].'</td>';
			echo '<td style="background-color:#0d69f445;color:#000">'.$row['lockQ'].'</td>';
			echo '<td style="background-color:#0d69f445;color:#000">'.$clstk.'</td>';
			echo '<td style="background-color:#0d69f445;color:#000">'.$row['reord_qty'].'</td>';
			if($clstk<$row['reord_qty'])
			{
			echo '<td style="background-color:#0d69f445;color:#F00;font-weight:bold;">Yes</td>';
			}
			else
			{
			echo '<td style="background-color:#0d69f445;color:#000">No</td>';  
			}
			echo '<td style="background-color:#0d69f445;color:#000">'.$row['rackNo'].'</td>';
			echo '</tr>';  
		}
		else
		{
			$opstk=getopenStk($cdt,$compId,$locId,$iTy,$itemId);

			$clstk=($opstk+$row['inQ'])-($row['outQ']+$row['lockQ']);

			echo'<tr style="color:#000;font-weight:600;">';
			echo '<td style="background-color:#f4b80d61;color:#000">'.$row['locNm'].'</td>';
			echo '<td style="background-color:#f4b80d61;color:#000">'.$row['fcode'].'</td>';
			echo '<td style="background-color:#f4b80d61;color:#000">'.$row['sg'].'</td>';
			echo '<td style="background-color:#f4b80d61;color:#000">'.$row['desp'].'</td>';
			echo '<td style="background-color:#f4b80d61;color:#000">'.$opstk.'</td>';
			echo '<td style="background-color:#f4b80d61;color:#000">'.$row['inQ'].'</td>';
			echo '<td style="background-color:#f4b80d61;color:#000">'.$row['outQ'].'</td>';
			echo '<td style="background-color:#f4b80d61;color:#000">'.$row['lockQ'].'</td>';
			echo '<td style="background-color:#f4b80d61;color:#000">'.$clstk.'</td>';
			echo '<td style="background-color:#f4b80d61;color:#000">'.$row['reord_qty'].'</td>';
			if($clstk<$row['reord_qty'])
			{
			echo '<td style="background-color:#f4b80d61;color:#F00;font-weight:bold;">Yes</td>';
			}
			else
			{
			echo '<td style="background-color:#f4b80d61;color:#000">No</td>';  
			}
			echo '<td style="background-color:#f4b80d61;color:#000">'.$row['rackNo'].'</td>';
			echo '</tr>';  
		}				  
		$cnt++;
	}
}
$mysql=null;
?>
</tbody>
<!--<tfoot>
<tr style="background-color:#b02923">
<th style="color:#fff;"></th>
<th style="color:#fff;"></th>
<th style="color:#fff"></th>
<th style="color:#fff;">Total</th>
<th style="color:#fff"><?php echo $a;?></th>
<th style="color:#fff;"><?php echo $b;?></th>
<th style="color:#fff"><?php echo $c;?></th>
<th style="color:#fff;"><?php echo $d;?></th>
<th style="color:#fff;"><?php echo $e;?></th>
<th style="color:#fff"></th>
<th style="color:#fff"></th>
<th style="color:#fff"></th>
</tr>
</tfoot>-->	

</table>
</div>
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