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
.pagination b{
 text-decoration: none;
 padding: 5px 10px;
 box-shadow: 0px 0px 10px #0000001c;
 background: white;
 margin: 3px;
 color: #1f1e1e;
} 
	
.pagination b.active{
 background: #b02923;
 color: white;
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
function view(id)
{
	//alert('hi');
	window.open("getinventoryview.php?ID="+id, "_blank", "toolbar=yes, scrollbars=yes, resizable=no, top=60, left=0, width=1000, height=600");
}
	
function dataReset()
{
	window.location.href='lockQty_Reg2.php';
}	

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
	var scriptUrl ='getLocations.php?compId='+id+'&iType='+iType+'&uiType='+uiType+'&uId='+uId+'&uloc='+uloc+'&ulocty='+ulocty+'&urole='+urole;
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
    var compId,locId,iType,srch;
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
		
	if(document.getElementById('txtsearch').value=='')
	{
	  srch	='0';
	}
	else
	{
	  srch=document.getElementById('txtsearch').value;	
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
 	
 	var uId=document.getElementById('uid').value;
	var uType=document.getElementById('uiType').value;
	var uRole=document.getElementById('urole').value;
    var ulocty= document.getElementById('ulocty').value;
	//alert('Hey Chiru....REG');
	var page_num = page_num?page_num:0;
	var keywords = $('#txtsearch').val();
    var filterBy = $('#filterBy').val();
	
    $.ajax({
    type: 'POST',
    url: 'getlockQty_Reg2.php',
    data:'page='+page_num+'&keywords='+keywords+'&filterBy='+filterBy+'&compId='+compId+'&iType='+iType+'&locId='+locId+'&uId='+uId+'&uloc='+uloc+'&uiType='+uType
    +'&ulocty='+ulocty+'&urole='+uRole+'&fdt='+fdt+'&tdt='+tdt+'&sType=0',
    beforeSend: function () {
    },
    success: function (html) {
		//alert(html);
		$('#tbl').html(html);
    }
    });	
 	/*var scriptUrl='getlockQty_Reg2.php?compId='+compId+'&iType='+iType+'&locId='+locId+'&uId='+uId+'&uiType='+uType+'&role='+uRole+'&srch='+srch+'&fdt='+fdt+'&tdt='+tdt;
	//alert(scriptUrl);
 	//dataTable
 	$('#tbl').load(scriptUrl);*/
}

function getexcel()
{
    var compId,locId,iType,fdt,tdt,srch;
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
	var uloc=document.getElementById('uloc').value;

	var scriptUrl='lockQty_RegItemEx.php?compId='+compId+'&iType='+iType+'&locId='+locId+'&uId='+uId+'&fdt='+fdt+'&tdt='+tdt+'&uiType='+uType+'&role='+uRole+'&uloc='+uloc+'&srch='+srch;
	//alert(scriptUrl);
	//dataTable
	window.open(scriptUrl, "toolbar=yes, scrollbars=yes, resizable=no, top=60, left=0, width=1000, height=600");
}

function getpdf()
{
	var compId,locId,iType,fdt,tdt,srch;
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
	var uloc=document.getElementById('uloc').value;

	var scriptUrl='mpdf/print_files/lockQty_Itemwise_pdf.php?compId='+compId+'&iType='+iType+'&locId='+locId+'&uId='+uId+'&fdt='+fdt+'&tdt='+tdt+'&uiType='+uType+'&role='+uRole+'&uloc='+uloc+'&srch='+srch+'&fdt='+fdt+'&tdt='+tdt;
	//alert(scriptUrl);
	//dataTable
	window.open(scriptUrl,  "toolbar=yes, scrollbars=yes, resizable=no, top=60, left=0, width=1000, height=600");
}	

function edit(id)
{
	//alert('hi');
	/*window.open("lockQtyRelease.php?ID="+id, "_blank", "toolbar=yes, scrollbars=yes, resizable=no, top=60, left=0, width=1100, height=600");*/
	window.open("lockQtyRelease.php?ID="+id, "toolbar=yes, scrollbars=yes, resizable=no, top=60, left=0, width=1100, height=600");
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
<!-- Begin Page Content -->
<div class="container-fluid">
<!-- Page Heading -->
<div class="align-items-center justify-content-between mb-2" style="background-color:#3c8dbc;border-radius:5px;" align="center">
<h1 class="h3 mb-0 text-gray-801" style="padding-bottom: 5px;">Lock Qty Register - Product Wise</h1>   
</div>
<!-- DataTales Example -->
<div class="card shadow mb-4">
<!--<div class="card-header py-3">
<h6 class="m-0 font-weight-bold text-primary">Inventory Register</h6>
</div>-->
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
<select class="chosen-select form-control form-control-sm" id="location" name="location" tabindex="3" style="width:240px;" onChange="getdata();">
<option value="0">Select</option>	
</select>
</td>		
</tr>

<tr>
<td valign="top"><label class="m-0 font-weight-bold text-primary">From Date</label></td>	
<td valign="top">:</td>	
<td valign="top">
<input type="date" class="form-control form-control-sm" id="fdt" name="fdt" value="" onChange="getdata();" tabindex="4">
</td>		

<td valign="top"><label class="m-0 font-weight-bold text-primary">To Date</label></td>	
<td valign="top">:</td>	
<td valign="top">
<input type="date" class="form-control form-control-sm" id="tdt" name="tdt" value="" onChange="getdata();" tabindex="5">
</td>		
</tr>	

<tr>
<td valign="top"><label class="m-0 font-weight-bold text-primary">Search</label></td>	
<td valign="top">:</td>	
<td valign="top">
<input type="text" id="txtsearch" name="txtsearch" class="form-control" tabindex="5.1">
</td>	
<td>
<input type="button" id="btnsearch" name="btnsearch" class="btn btn-primary" onClick="getdata();" tabindex="5.2" value="Search">
</td>
<td valign="top"></td>		
</tr>	
</table>
</div>
</div>
</div>

<div align="right">
<input type="button" id="btnReset" name="btnReset" class="btn btn-warning" onclick="dataReset();" tabindex="5.3" value="Reset">	
<a href="javascript:getexcel();"><img src="img/EXCELIMG1.png" alt="download" title="download" style="width:50px; height:50px"></a>
<a href="javascript:getpdf();"><img src="img/pdf.png" alt="download" title="download" style="width:50px; height:50px"></a>
</div>				
<?php
$totalRecordsPerPage=0;	
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

$limit = 100; 
if($uRole=='admin' && ($uiType=='3' || $uiType=='0'))
{
	$qq="SELECT DATE_FORMAT(a.dt,'%d-%m-%Y') AS dt,a.iType,IF(a.iType='1','RAW MATERIAL','FINISHED GOODS') AS iTypeNm,a.compId,a.locId,l.loc_code,l.location_name,a.docNo,a.ref ,a.notes,IF(a.iType='1',r.focus_code,f.focus_code) AS fc,IF(a.iType='1',r.sage_code,f.sage_code) AS sg,IF(a.iType='1',CONCAT(r.description,' - ',ru.uom),CONCAT(f.descc,' - ',fu.uom)) AS desp,IF(b.eType='1','IN','OUT') AS EntryType,e.entryNm,b.qty AS Quantity,b.batchNo,IF(b.expdt='-','-',DATE_FORMAT(b.expdt,'%d-%m-%Y')) AS expdt FROM inventory_tbl AS a LEFT JOIN company_tbl AS c ON a.compId=c.ID LEFT JOIN location_tbl AS l ON a.locId=l.ID LEFT JOIN inventory_info_tbl AS b ON a.ID=b.invId LEFT JOIN rm_master AS r ON b.itemId=r.rmId LEFT JOIN category_master AS rc ON r.catId=rc.catId LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID LEFT JOIN fg_master AS f ON b.itemId=f.fgId LEFT JOIN category_master AS fc ON f.category_id=fc.catId LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID LEFT JOIN entry_type_tbl AS e ON b.entryId=e.entryId WHERE a.sts='0' AND b.sts='0' AND a.lsts='1' ORDER BY substring(a.docNo,1,9), substring(a.docNo,10)*1 DESC LIMIT $limit";
	
	$qqq="SELECT COUNT(a.docNo) AS rowNum FROM inventory_tbl AS a LEFT JOIN company_tbl AS c ON a.compId=c.ID LEFT JOIN location_tbl AS l ON a.locId=l.ID LEFT JOIN inventory_info_tbl AS b ON a.ID=b.invId LEFT JOIN rm_master AS r ON b.itemId=r.rmId LEFT JOIN category_master AS rc ON r.catId=rc.catId LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID LEFT JOIN fg_master AS f ON b.itemId=f.fgId LEFT JOIN category_master AS fc ON f.category_id=fc.catId LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID LEFT JOIN entry_type_tbl AS e ON b.entryId=e.entryId WHERE a.sts='0' AND b.sts='0' AND a.lsts='1' ORDER BY substring(a.docNo,1,9), substring(a.docNo,10)*1 DESC";
	//echo $qq."<Br>";
}
else
{
	$qq="SELECT DATE_FORMAT(a.dt,'%d-%m-%Y') AS dt,a.iType,IF(a.iType='1','RAW MATERIAL','FINISHED GOODS') AS iTypeNm,a.compId,a.locId,l.loc_code,l.location_name,a.docNo,a.ref ,a.notes,IF(a.iType='1',r.focus_code,f.focus_code) AS fc,IF(a.iType='1',r.sage_code,f.sage_code) AS sg,IF(a.iType='1',CONCAT(r.description,' - ',ru.uom),CONCAT(f.descc,' - ',fu.uom)) AS desp,IF(b.eType='1','IN','OUT') AS EntryType,e.entryNm,b.qty AS Quantity,b.batchNo,IF(b.expdt='-','-',DATE_FORMAT(b.expdt,'%d-%m-%Y')) AS expdt FROM inventory_tbl AS a LEFT JOIN company_tbl AS c ON a.compId=c.ID LEFT JOIN location_tbl AS l ON a.locId=l.ID LEFT JOIN inventory_info_tbl AS b ON a.ID=b.invId LEFT JOIN rm_master AS r ON b.itemId=r.rmId LEFT JOIN category_master AS rc ON r.catId=rc.catId LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID LEFT JOIN fg_master AS f ON b.itemId=f.fgId LEFT JOIN category_master AS fc ON f.category_id=fc.catId LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID LEFT JOIN entry_type_tbl AS e ON b.entryId=e.entryId LEFT JOIN admin_usr_loc AS u ON a.locId=u.locId WHERE a.sts='0' AND b.sts='0' AND a.lsts='1' AND a.compId='$cmpId' AND a.iType='$uiType' AND a.lsts='1' AND u.uid='$userId' ORDER BY substring(a.docNo,1,9), substring(a.docNo,10)*1 DESC  LIMIT $limit";
	
	$qqq="SELECT COUNT(a.docNo) AS rowNum FROM inventory_tbl AS a LEFT JOIN company_tbl AS c ON a.compId=c.ID LEFT JOIN location_tbl AS l ON a.locId=l.ID LEFT JOIN inventory_info_tbl AS b ON a.ID=b.invId LEFT JOIN rm_master AS r ON b.itemId=r.rmId LEFT JOIN category_master AS rc ON r.catId=rc.catId LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID LEFT JOIN fg_master AS f ON b.itemId=f.fgId LEFT JOIN category_master AS fc ON f.category_id=fc.catId LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID LEFT JOIN entry_type_tbl AS e ON b.entryId=e.entryId LEFT JOIN admin_usr_loc AS u ON a.locId=u.locId WHERE a.sts='0' AND b.sts='0' AND a.lsts='1' AND a.compId='$cmpId' AND a.iType='$uiType' AND a.lsts='1' AND u.uid='$userId' ORDER BY substring(a.docNo,1,9), substring(a.docNo,10)*1 DESC";
	//echo "Else  - ".$qq."<Br>";

	//echo $qq."<Br>";
}
include('shripage1.php');
$baseURL = 'getlockQty_Reg2.php'; 
	
$query1   = $mysql->prepare($qqq); 
$query1->execute();
$result1  = $query1->fetch(PDO::FETCH_ASSOC);
$rowCount= $result1['rowNum']; 	
	
$query=$mysql->prepare($qq);
$query->execute();	
$paginationData=$query->fetchAll();	
// Initialize pagination class 
if($uRole=='admin' && ($uiType=='3' || $uiType=='0'))
{
	$pagConfig = array( 
		'baseURL'=> $baseURL, 
		'totalRows'=> $rowCount, 
		'perPage'=> $limit, 
		'contentDiv'=> 'tbl', 
		'link_func'=> '',
		'keywords'=> '',
		'uiType'=> $uiType,
		'uRole'=> $uRole,
		'uId'=> $_SESSION['uId'],
		'srch'=> '',
		'sType'=> '0'
	); 
}
else
{
	$adparams=$cmpId."||".$uloc."||".$uiType."||0||0";
	
	$pagConfig = array( 
		'baseURL'=> $baseURL, 
		'totalRows'=> $rowCount, 
		'perPage'=> $limit, 
		'contentDiv'=> 'tbl', 
		'link_func'=> '',
		'keywords'=> '',
		'uiType'=> $uiType,
		'uRole'=> $uRole,
		'uId'=> $_SESSION['uId'],
		'srch'=> $adparams,
		'sType'=> '1'
	); 
} 
$pagination =  new Pagination($pagConfig);			
?>
<div class="table-responsive">
<div id="tbl">
<div class="pagination">    
<?php echo $pagination; ?>
</div>	
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
<thead>
<tr style="background-color:#b02923">
<th style="color:#fff;">Date</th>
<th style="color:#fff">Doc. No</th>
<!--<th style="color:#fff">Company</th>-->
<th style="color:#fff">Location</th>
<th style="color:#fff">Product Category</th>
<th style="color:#fff">Salesman</th>
<th style="color:#fff">Reference</th>
<!--<th style="color:#fff">Notes</th>-->
<th style="color:#fff">Focus Code</th>
<th style="color:#fff">Sage Code</th>
<th style="color:#fff">Product</th>
<th style="color:#fff">Entry Type</th>
<th style="color:#fff">Batch / Lot No.</th>
<th style="color:#fff">Lock Qty</th>
<th style="color:#fff">Release</th>
</tr>
</thead>
<?php
$a=$b=0;	
foreach ($paginationData as $row) 
{
	$id=$row['ID'];
	/*$a=$a+$row['openstk'];
	$b=$b+$row['IN_Qty'];
	$c=$c+$row['OUT_Qty'];
	$d=$d+$row['Lock_Qty'];
	$e=$e+$row['Closestk'];*/

	if($row['iType']=='1')
	{
		echo'<tr style="color:#000;font-weight:600;">';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['dt'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['docNo'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['loc_code'].' - '.$row['location_name'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['iTypeNm'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['salemanNm'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['ref'].'</td>';
		//echo '<td style="background-color:#0d69f445;color:#000">'.$row['notes'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['fc'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['sg'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['desp'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['entryNm'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['batchNo'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['Quantity'].'</td>';	
		$a=$a+$row['Quantity'];	
		if($ed==0)
        {
            echo '<td>-</td>';  
        }
        else
        {
			if($row['rsts']=='0')
			{
            	echo '<td align="center"><a href="javascript:edit('.$id.')" style="color:#F00;text-decoration:none;">Pending</a></td>';
			}
			else
			{
            	echo '<td style="color:#4a8029">Released</td>';
			}
        }
		echo '</tr>';  
	
	}
	else
	{
		echo'<tr style="color:#000;font-weight:600;">';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['dt'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['docNo'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['loc_code'].' - '.$row['location_name'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['iTypeNm'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['salemanNm'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['ref'].'</td>';
		//echo '<td style="background-color:#f4b80d61;color:#000">'.$row['notes'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['fc'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['sg'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['desp'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['entryNm'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['batchNo'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['Quantity'].'</td>';	
		$a=$a+$row['Quantity'];
		if($ed==0)
        {
            echo '<td>-</td>';  
        }
        else
        {
            if($row['rsts']=='0')
			{
            	echo '<td align="center"><a href="javascript:edit('.$id.')" style="color:#F00;text-decoration:none;">Pending</a></td>';
			}
			else
			{
            	echo '<td style="color:#4a8029">Released</td>';
			}
        }
		echo '</tr>';  
	}				  
	$cnt++;	
}	
$mysql=null;	
?>
<tfoot>
<tr style="background-color:#b02923">
<th style="color:#fff;"></th>
<th style="color:#fff"></th>
<!--<th style="color:#fff">Company</th>
<th style="color:#fff"></th>-->
<th style="color:#fff"></th>
<th style="color:#fff"></th>
<th style="color:#fff"></th>
<th style="color:#fff"></th>
<th style="color:#fff"></th>
<th style="color:#fff"></th>
<th style="color:#fff"></th>
<th style="color:#fff"></th>
<th style="color:#fff">Total</th>
<th style="color:#fff"><?php echo $a;?></th>
<th style="color:#fff"></th>
</tr>
</tfoot>	
</table>	
<div class="pagination">    
<?php echo $pagination; ?>
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