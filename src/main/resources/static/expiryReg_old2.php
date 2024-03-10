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
<?php include("inc/meta.php");?>
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<link rel="stylesheet" href="selectcss/chosen.css">
<style type="text/css" media="all">
/* fix rtl for demo */
.chosen-rtl .chosen-drop 
{ 
	left: -9000px;

	z-index: 1010;
}
.pagination-content{
 width:60%;
 text-align: justify;
 padding:10px;
}
.pagination{
 padding:10px;
}
.pagination a.active{
 background: #f77404;
 color: white;
}  
.pagination a{
 text-decoration: none;
 padding: 5px 10px;
 box-shadow: 0px 0px 10px #0000001c;
 background: white;
 margin: 3px;
 color: #1f1e1e;
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
	  var uloc= document.getElementById('uloc').value;
	  var uiType= document.getElementById('uiType').value;
	  var ulocty= document.getElementById('ulocty').value;
	  var urole= document.getElementById('urole').value;
	  var scriptUrl ='getLocations.php?compId='+id+'&iType='+iType+'&uId='+uId+'&uiType='+uiType+'&uId='+uId+'&uloc='+uloc+'&ulocty='+ulocty+'&urole='+urole;
	  //alert(scriptUrl);
      $.ajax({url:scriptUrl,success:function(result)
      {	
	  	 //alert(result);
         //document.getElementById('location').innerHTML=result;
		  $("#location").html(result).trigger("chosen:updated.chosen");
		  if(urole!='admin' && (uId!='1' || uId!='3'))
		  {
		      getCategory();
		      getBrand();
		  }
      }}); 
  }
}	
	 
function getCategory()	
{
  //alert('hey chiru...CAT');
  if(document.getElementById('iType').value=='0')
  {
	 //alert('Plz, Select Product Category..!'); 
	 document.getElementById('iType').focus();
  }
  else	
  {
      var iType = document.getElementById('iType').value;
	  var scriptUrl ='getCategory.php?iType='+iType;
	  //alert(scriptUrl);
      $.ajax({url:scriptUrl,success:function(result)
      {	
	  	 //alert(result);
         //document.getElementById('location').innerHTML=result; 
		  $("#catId").html(result).trigger("chosen:updated.chosen");
      }}); 
  }
}
	
function getBrand()	
{
  //alert('hey chiru...BRAND');
  
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
  else if(document.getElementById('location').value=='0')
  {
	 //alert('Plz, Select Product Category..!'); 
	 document.getElementById('location').focus();
  }
  else	
  {
      var id = document.getElementById('compId').value;
	  var locId = document.getElementById('location').value;
	  var scriptUrl ='getBrandNm.php?compId='+id+'&locId='+locId;
	  //alert(scriptUrl);
      $.ajax({url:scriptUrl,success:function(result)
      {	
	  	 //alert(result);
         //document.getElementById('location').innerHTML=result; 
		  $("#brand").html(result).trigger("chosen:updated.chosen");
      }}); 
  }
}	 
	
function getdata()
{
	var compId,locId,iType,catId,brand,srch;
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
	
	if(document.getElementById('catId').value=='0')
	{
		catId="0";
	}
 	else
    {
		catId=document.getElementById('catId').value;
	}
	
	if(document.getElementById('brand').value=='')
	{
	  brand	='0';
	}
	else
	{
	  brand=document.getElementById('brand').value;	
	}
		
	if(document.getElementById('txtsearch').value=='')
	{
	  srch	='0';
	}
	else
	{
	  srch=document.getElementById('txtsearch').value;	
	}
 	
 	var uId=document.getElementById('uid').value;
	var uType=document.getElementById('uiType').value;
	var uRole=document.getElementById('urole').value;
	
	var scriptUrl='getexpiryReg.php?compId='+compId+'&iType='+iType+'&locId='+locId+'&uId='+uId+'&uiType='+uType+'&role='+uRole+'&srch='+srch+'&catId='+catId+'&brand='+brand;
	//alert(scriptUrl);
 	//dataTable
 	$('#tbl').load(scriptUrl);
}
	 
function dataReset()
{
	window.location.href='expiryReg.php';
}	 
	 
function getexcel()
{
	var compId,locId,iType,catId,brand,srch;
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
	
	if(document.getElementById('catId').value=='0')
	{
		catId="0";
	}
 	else
    {
		catId=document.getElementById('catId').value;
	}
	
	if(document.getElementById('brand').value=='')
	{
	  brand	='0';
	}
	else
	{
	  brand=document.getElementById('brand').value;	
	}
		
	if(document.getElementById('txtsearch').value=='')
	{
	  srch	='0';
	}
	else
	{
	  srch=document.getElementById('txtsearch').value;	
	}
 	
 	var uId=document.getElementById('uid').value;
	var uType=document.getElementById('uiType').value;
	var uRole=document.getElementById('urole').value;
 
 	var scriptUrl='expReg_exl.php?compId='+compId+'&iType='+iType+'&locId='+locId+'&uId='+uId+'&uiType='+uType+'&role='+uRole+'&srch='+srch+'&catId='+catId+'&brand='+brand;
	//alert(scriptUrl);
 	//dataTable
 	window.open(scriptUrl, "toolbar=yes, scrollbars=yes, resizable=no, top=60, left=0, width=1000, height=600");
}

function getpdf()
{
	var compId,locId,iType,catId,brand,srch;
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
	
	if(document.getElementById('catId').value=='0')
	{
		catId="0";
	}
 	else
    {
		catId=document.getElementById('catId').value;
	}
	
	if(document.getElementById('brand').value=='')
	{
	  brand	='0';
	}
	else
	{
	  brand=document.getElementById('brand').value;	
	}
		
	if(document.getElementById('txtsearch').value=='')
	{
	  srch	='0';
	}
	else
	{
	  srch=document.getElementById('txtsearch').value;	
	}
 	
 	var uId=document.getElementById('uid').value;
	var uType=document.getElementById('uiType').value;
	var uRole=document.getElementById('urole').value;
 
 	var scriptUrl='mpdf/print_files/expReg_pdf.php?compId='+compId+'&iType='+iType+'&locId='+locId+'&uId='+uId+'&uiType='+uType+'&role='+uRole+'&srch='+srch+'&catId='+catId+'&brand='+brand;
	//alert(scriptUrl);
 	//dataTable
 	window.open(scriptUrl,  "toolbar=yes, scrollbars=yes, resizable=no, top=60, left=0, width=1000, height=600");
}	 
 </script>
</head>

<body id="page-top" onLoad="getLoc();">

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
<h1 class="h3 mb-0 text-gray-801">Product Expiry Date Register</h1>   
</div>
<style>
.dot {
height: 20px;
width: 20px;
background-color: #f00;
border-radius: 50%;
display: inline-block;
}
.dot2 {
height: 20px;
width: 20px;
background-color: orange;
border-radius: 50%;
display: inline-block;
}
.dot3 {
height: 20px;
width: 20px;
background-color: #0472c9;
border-radius: 50%;
display: inline-block;
}	  
</style>
    
<!-- DataTales Example -->
<div class="card shadow mb-4">
<div class="card-header py-3">
<h6 class="m-0 font-weight-bold text-primary"></h6>
</div>
<input type="hidden" id="uid" name="uid" value="<?php echo $userId?>">
<input type="hidden" id="urole" name="urole" value="<?php echo $uRole;?>">
<input type="hidden" id="uiType" name="uiType" value="<?php echo $uiType;?>">
<input type="hidden" id="uloc" name="uloc" value="<?php echo $uloc;?>">	
<input type="hidden" id="ulocty" name="ulocty" value="<?php echo $ulocType;?>">
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
<select class="chosen-select form-control form-control-sm" id="iType" name="iType" tabindex="2"  onChange="getLoc();getCategory();getdata();" style="width:250px;" required>
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
<select class="chosen-select form-control form-control-sm" id="location" name="location" tabindex="3" style="width:230px;" onChange="getdata();getBrand();">
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
<td valign="top"><label class="m-0 font-weight-bold text-primary">Category</label></td>	
<td valign="top">:</td>	
<td valign="top">
<select class="chosen-select form-control form-control-sm" id="catId" name="catId" tabindex="4" style="width:250px;" onChange="getdata();">
<option value="0">Select</option>	
</select>
</td>		

<td valign="top"><label class="m-0 font-weight-bold text-primary">Brand</label></td>	
<td valign="top">:</td>	
<td valign="top">
<select class="chosen-select form-control form-control-sm" id="brand" name="brand" tabindex="5"  onChange="getdata();" style="width:250px;" required>
<option value="0">Select</option>
</select>
</td>	

<td valign="top"><label class="m-0 font-weight-bold text-primary">Search</label></td>	
<td valign="top">:</td>	
<td valign="top">
<input type="text" id="txtsearch" name="txtsearch" class="form-control" tabindex="5.1">
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
<td valign="top"></td>		
</tr>

<tr>
<td>
<input type="button" id="btnsearch" name="btnsearch" class="btn btn-primary" onClick="getdata();" tabindex="5.2" value="Search">
</td>	
<td valign="top"><label class="m-0 font-weight-bold text-primary"></label></td>	
<td valign="top"></td>	
<td valign="top">

</td>	
	
<td valign="top"></td>
<td valign="top"></td>	
<td valign="top"></td>	
<td valign="top"></td>	
<td valign="top"></td>	
</tr>

</table>
</div>
</div>
</div>
				
<div align="right">
<input type="button" id="btnReset" name="btnReset" class="btn btn-warning" onClick="dataReset();" tabindex="5.3" value="Reset">	
<a href="javascript:getexcel();"><img src="img/EXCELIMG1.png" alt="download" title="download" style="width:50px; height:50px"></a>
<a href="javascript:getpdf();"><img src="img/pdf.png" alt="download" title="download" style="width:50px; height:50px"></a>
</div>
				
<div class="table-responsive" align="right">
<table cellpadding="10px" cellspacing="10">
<tr>
<td valign="top">
<span class="dot"></span>
<span style="padding-left: 10px;margin-bottom:20px;">1 Month</span></td>	
<td>
<span class="dot2"></span>
<span style="padding-left: 10px;margin-bottom:20px;">2 Month</span>
</td>	
<td>
<span class="dot3"></span>
<span style="padding-left: 10px;margin-bottom:20px;">3 Month</span>
</td>		
</tr>	
</table>
</div>	
<?php
$totalRecordsPerPage=0;	
include('mysql.connect.php');
//admin_tbl 
$qEditDel="SELECT act_edit AS ed,act_delete AS del FROM admin_tbl WHERE sts='0' AND id='$userId'";
//echo $qEditDel."<Br>";	
$stmEditDel=$mysql->prepare($qEditDel);
$stmEditDel->execute();
$rowEditDel=$stmEditDel->fetch(PDO::FETCH_ASSOC);
$ed=$rowEditDel['ed'];
$dels=$rowEditDel['del'];	
//admin_tbl
if($uRole=='admin' && ($uiType=='3' || $uiType=='0'))
{
	$qq="SELECT a.ID,a.docNo,a.dt,a.compId,CONCAT(b.company_code,' - ',b.company_name) AS compNm,
	a.locId,CONCAT(c.loc_code,' - ', c.location_name) AS loc,a.iType,IF(a.iType='1','RAW MATERIAL','FINISHED GOODS') AS iTypeNm,a.itemId,
	IF(a.iType='1',d.focus_code,f.focus_code) AS fc,IF(a.iType='1',d.sage_code,f.sage_code) AS sg,IF(a.iType='1',d.description,CONCAT(g.category_nm,' ',f.brand,' ',f.descc)) AS itemNm,IF(a.iType='1',u.uom,u2.uom) AS uom,IF(a.stk_qty='0',a.openstk,a.stk_qty) AS qty,a.expdt,a.uid,TIMESTAMPDIFF(MONTH, CURRENT_DATE(),a.expdt) AS mnt,a.batchNo FROM stock_tbl_2 AS a LEFT JOIN company_tbl AS b ON a.compId=b.ID 
	LEFT JOIN location_tbl AS c ON a.locId=c.ID LEFT JOIN rm_master AS d ON a.itemId=d.rmId	LEFT JOIN uom_tbl AS u ON d.UOM=u.ID 
	LEFT JOIN fg_master AS f ON a.itemId=f.fgId LEFT JOIN uom_tbl AS u2 ON f.uom=u2.ID LEFT JOIN category_master AS g ON f.category_id=g.catId 
	WHERE a.sts!='2' AND b.sts!='2' AND a.out_qty='0' AND c.sts!='2' AND IF(a.iType='1',d.sts!='2',f.sts!='2') ORDER BY a.dt";
	//echo $qq."<Br>";
	include('shripage.php');
	$totalRecordsPerPage=500;
	$paginationData=pagination_records($totalRecordsPerPage,$qq);
	//print_r($paginationData);
	$sn=pagination_records_counter($totalRecordsPerPage);
	$cnt=$sn;	
	$pagination=pagination($totalRecordsPerPage,$qq);
}
else
{
	$qq="SELECT a.ID,a.docNo,a.dt,a.compId,CONCAT(b.company_code,' - ',b.company_name) AS compNm,
	a.locId,CONCAT(c.loc_code,' - ', c.location_name) AS loc,a.iType,IF(a.iType='1','RAW MATERIAL','FINISHED GOODS') AS iTypeNm,a.itemId,
	IF(a.iType='1',d.focus_code,f.focus_code) AS fc,IF(a.iType='1',d.sage_code,f.sage_code) AS sg,IF(a.iType='1',d.description,CONCAT(g.category_nm,' ',f.brand,' ',f.descc)) AS itemNm,IF(a.iType='1',u.uom,u2.uom) AS uom,IF(a.stk_qty='0',a.openstk,a.stk_qty) AS qty,a.expdt,a.uid,TIMESTAMPDIFF(MONTH, CURRENT_DATE(),a.expdt) AS mnt,a.batchNo FROM stock_tbl_2 AS a LEFT JOIN company_tbl AS b ON a.compId=b.ID LEFT JOIN location_tbl AS c ON a.locId=c.ID 
	LEFT JOIN rm_master AS d ON a.itemId=d.rmId LEFT JOIN uom_tbl AS u ON d.UOM=u.ID LEFT JOIN fg_master AS f ON a.itemId=f.fgId LEFT JOIN uom_tbl AS u2 ON f.uom=u2.ID LEFT JOIN category_master AS g ON f.category_id=g.catId LEFT JOIN admin_usr_loc AS ua ON c.ID=ua.locId WHERE a.sts!='2' AND b.sts!='2' AND c.sts!='2' AND IF(a.iType='1',d.sts!='2',f.sts!='2') AND a.out_qty='0' AND b.ID='$cmpId' AND ua.uid='$userId' ORDER BY a.dt";
	//echo "Else  - ".$qq."<Br>";

	//echo $qq."<Br>";
	include('shripage.php');
	$totalRecordsPerPage=500;
	$paginationData=pagination_records($totalRecordsPerPage,$qq);
	//print_r($paginationData);
	$sn=pagination_records_counter($totalRecordsPerPage);
	$cnt=$sn;	
	$pagination=pagination($totalRecordsPerPage,$qq);
}				
?>				
<div class="table-responsive">
<div id="tbl">
<div class="pagination">    
<?php echo $pagination; ?>
</div>	
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
<thead>
<tr style="background-color:#b02923">
<th style="color:#fff">Date</th>
<!--<th style="color:#fff">Doc. No</th>-->
<th style="color:#fff">Location</th>	
<th style="color:#fff;">Focus Code</th>
<th style="color:#fff">Sage Code</th>
<th style="color:#fff">Product</th>
<th style="color:#fff">Batch No</th>
<th style="color:#fff">Qty</th>
<th style="color:#fff">Prod. Exp. Date</th>
</tr>
</thead>
<?php 
include('mysql.connect.php');
$crd=date('Y-m');
foreach ($paginationData as $row) 
{
$id=$row['iid'];

$expdt=date('Y-m',strtotime($row['expdt']));
//echo "Current : ".$crd."|| Expdt : ".$expdt."<Br>";
$date_diff = abs(strtotime($crd) - strtotime($expdt));
$years = floor($date_diff / (365*60*60*24));
if($crd>$expdt)
{
  $mnt = "-".floor(($date_diff - $years * 365*60*60*24) / (30*60*60*24));
}
else
{
  $mnt = floor(($date_diff - $years * 365*60*60*24) / (30*60*60*24));
}
//echo $id." : ".$date_diff." || Year : ".$years." || Months : ".$mnt."<Br>";

  if($mnt <=1 && $mnt<2 && $years==0)
  {
      echo'<tr style="color:#F00;font-weight:bold;">';
      echo '<td>'.date('d-m-Y',strtotime($row['dt'])).'</td>';
      echo '<td>'.$row['loc'].'</td>';
      echo '<td>'.$row['fc'].'</td>';
      echo '<td>'.$row['sg'].'</td>';
      echo '<td>'.$row['itemNm'].' - '.$row['uom'].'</td>';
      echo '<td>'.$row['batchNo'].'</td>';				  
      echo '<td>'.$row['qty'].'</td>';		
      echo '<td>'.date('d-m-Y',strtotime($row['expdt'])).'</td>';
      echo '</tr>';
  }
  else if($mnt >=2 && $mnt<3 && $years==0)
  {
      echo'<tr style="color:orange;font-weight:bold;">';
      echo '<td>'.date('d-m-Y',strtotime($row['dt'])).'</td>';
      echo '<td>'.$row['loc'].'</td>';
      echo '<td>'.$row['fc'].'</td>';
      echo '<td>'.$row['sg'].'</td>';
      echo '<td>'.$row['itemNm'].' - '.$row['uom'].'</td>';
      echo '<td>'.$row['batchNo'].'</td>';				  
      echo '<td>'.$row['qty'].'</td>';		
      echo '<td>'.date('d-m-Y',strtotime($row['expdt'])).'</td>';
      echo '</tr>';
  }	
  else if($mnt=='3' && $years==0)
  {
      echo'<tr style="color:#0472c9;font-weight:bold;">';
      echo '<td>'.date('d-m-Y',strtotime($row['dt'])).'</td>';
      echo '<td>'.$row['loc'].'</td>';
      echo '<td>'.$row['fc'].'</td>';
      echo '<td>'.$row['sg'].'</td>';
      echo '<td>'.$row['itemNm'].' - '.$row['uom'].'</td>';
      echo '<td>'.$row['batchNo'].'</td>';				  
      echo '<td>'.$row['qty'].'</td>';		
      echo '<td>'.date('d-m-Y',strtotime($row['expdt'])).'</td>';
      echo '</tr>';
  }				 
  else
  {
      echo'<tr style="background-color:#FFF;color:#000;font-weight:bold;">';
      echo '<td>'.date('d-m-Y',strtotime($row['dt'])).'</td>';
      echo '<td>'.$row['loc'].'</td>';
      echo '<td>'.$row['fc'].'</td>';
      echo '<td>'.$row['sg'].'</td>';
      echo '<td>'.$row['itemNm'].' - '.$row['uom'].'</td>';
      echo '<td>'.$row['batchNo'].'</td>';				  
      echo '<td>'.$row['qty'].'</td>';		
      echo '<td>'.date('d-m-Y',strtotime($row['expdt'])).'</td>';
      echo '</tr>';
  }
$cnt++;
}
$mysql=null;
?>
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
<?php include("inc/footer.php");?>
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
<!--  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>


  <script src="js/demo/datatables-demo.js"></script>-->
  
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