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
function view(id)
{
	//alert('hi');
	window.open("getlockQtyview.php?ID="+id, "_blank", "toolbar=yes, scrollbars=yes, resizable=no, top=60, left=0, width=1000, height=600");
}
	 
function edit(id)
{
	window.open("lockQtyEntryEdit.php?ID="+id, "toolbar=yes, scrollbars=yes, resizable=no, top=60, left=0, width=1100, height=600");
}
	 
function dataReset()
{
	window.location.href='lockQty_Reg.php';
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
	
 	var scriptUrl='getlockQtyReg.php?compId='+compId+'&iType='+iType+'&locId='+locId+'&uId='+uId+'&fdt='+fdt+'&tdt='+tdt+'&uiType='+uType+'&role='+uRole+'&uloc='+uloc+'&srch='+srch;
	//alert(scriptUrl);	
 	//dataTable
 	$('#tbl').load(scriptUrl);
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

	var scriptUrl='lockQtyRegEx.php?compId='+compId+'&iType='+iType+'&locId='+locId+'&uId='+uId+'&fdt='+fdt+'&tdt='+tdt+'&uiType='+uType+'&role='+uRole+'&uloc='+uloc+'&srch='+srch;
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

	var scriptUrl='mpdf/print_files/lockQty_pdf.php?compId='+compId+'&iType='+iType+'&locId='+locId+'&uId='+uId+'&fdt='+fdt+'&tdt='+tdt+'&uiType='+uType+'&role='+uRole+'&uloc='+uloc+'&srch='+srch;
	//alert(scriptUrl);
	//dataTable
	window.open(scriptUrl,  "toolbar=yes, scrollbars=yes, resizable=no, top=60, left=0, width=1000, height=600");

	
}	
	 
function deletes(id)
{
  var y=window.confirm("Do you want to Delete?");
  if(y)
  {
	  var uid=document.getElementById('uid').value;
	  var scriptUrl='deleteLockQty.php?ID='+id+'&uid='+uid;
	  //alert(scriptUrl);
	  $.ajax({url:scriptUrl,success:function(result)
      {	
		  var str=result.split("||");
		  alert(str[0]);
      }});
  }
  else
  {
	  alert('You Pressed Cancel Button...');
  }
  window.location.href='lockQty_Reg.php';	
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
<div class="align-items-center justify-content-between mb-2" style="background-color:#3c8dbc;border-radius:5px;" align="center">
<h1 class="h3 mb-0 text-gray-801" style="padding-bottom: 5px;">Lock Qty Register</h1>   
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
	
<td valign="top"><label class="m-0 font-weight-bold text-primary"></label></td>	
<td valign="top"></td>	
<td valign="top">
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
if($uRole=='admin' && ($uiType=='3' || $uiType=='0'))
{
	$qq="SELECT a.ID,a.dt,a.compId,a.locId,a.iType,a.docNo,a.yr,a.yr2,b.company_code,b.company_name,c.loc_code,c.location_name,IF(a.iType='1','RAW MATERIAL','FINISHED GOODS') AS iTypeNm,ref,notes ,a.salemnId,s.UserNm AS salemanNm,a.rsts FROM inventory_tbl AS a LEFT JOIN company_tbl AS b ON a.compId=b.ID LEFT JOIN location_tbl AS c ON a.locId=c.ID LEFT JOIN admin_tbl AS s ON a.salemnId=s.id WHERE a.sts!='2' AND b.sts!='2' AND c.sts!='2' AND a.lsts='1' AND s.sts!='2' GROUP BY a.ID,a.dt,a.compId,a.locId,a.iType,a.docNo,a.yr,a.yr2,b.company_code,b.company_name,c.loc_code,c.location_name,IF(a.iType='1','RAW MATERIAL','FINISHED GOODS'),ref,notes ,a.salemnId,s.UserNm ORDER BY SUBSTRING(a.docNo,1,9), SUBSTRING(a.docNo,10)*1 DESC";
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
	$qq="SELECT a.ID,a.dt,a.compId,a.locId,a.iType,a.docNo,a.yr,a.yr2,b.company_code,b.company_name,c.loc_code,c.location_name,IF(a.iType='1','RAW MATERIAL','FINISHED GOODS') AS iTypeNm,ref,notes ,a.salemnId,s.UserNm AS salemanNm,a.rsts FROM inventory_tbl AS a LEFT JOIN company_tbl AS b ON a.compId=b.ID LEFT JOIN location_tbl AS c ON a.locId=c.ID LEFT JOIN admin_tbl AS s ON a.salemnId=s.id LEFT JOIN admin_usr_loc AS u ON c.ID=u.locId WHERE a.sts!='2' AND b.sts!='2' AND c.sts!='2' AND a.lsts='1' AND s.sts!='2' AND a.compId='$cmpId' AND a.iType='$uiType' AND u.uid='$userId' AND a.lsts='1' GROUP BY a.ID,a.dt,a.compId,a.locId,a.iType,a.docNo,a.yr,a.yr2,b.company_code,b.company_name,
	c.loc_code,c.location_name,IF(a.iType='1','RAW MATERIAL','FINISHED GOODS'),ref,notes ,a.salemnId,s.UserNm ORDER BY SUBSTRING(a.docNo,1,9), SUBSTRING(a.docNo,10)*1 DESC";
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
$cdt=date('Y-m-d');		
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
<th style="color:#fff">Company</th>
<th style="color:#fff">Location</th>
<th style="color:#fff">Product Category</th>
<th style="color:#fff">Saleman</th>
<th style="color:#fff">Reference</th>
<th style="color:#fff">Notes</th>
<th style="color:#fff">View</th>
<th style="color:#fff">Edit</th>
<th style="color:#fff">Delete</th>
</tr>
</thead>
<?php 
foreach ($paginationData as $row) 
{
	$id=$row['ID'];
	if($uRole=='admin' || $uiType=='3')
    {
		if($row['iType']=='1')
		{
			echo'<tr style="color:#000;font-weight:600;background-color:#0d69f445;">';
			echo '<td>'.date('d-m-Y',strtotime($row['dt'])).'</td>';
			echo '<td>'.$row['docNo'].'</td>';
			echo '<td>'.$row['company_code'].' '.$row['company_name'].'</td>';
			echo '<td>'.$row['loc_code'].' '.$row['location_name'].'</td>';
			echo '<td>'.$row['iTypeNm'].'</td>';
			echo '<td>'.$row['salemanNm'].'</td>';
			echo '<td>'.$row['ref'].'</td>';					  
			echo '<td>'.$row['notes'].'</td>';					  					  
			echo '<td align="center"><a href="javascript:view('.$id.')"><i class="fa fa-eye"></i></a></td>';
			if($ed==0)
            {
              echo '<td>-</td>';  
              echo '<td>-</td>';
            }
            else
            {
				if($row['rsts']=='0')
				{
					if($row['dt']==$cdt)
					{
						echo '<td align="center"><a href="javascript:edit('.$id.')"><i class="fa fa-edit"></i></a></td>';
					}
					else
					{
						echo '<td align="center">-</td>';
					}
					echo '<td align="center"><a href="javascript:deletes('.$id.')"><i class="fa fa-trash"></i></a></td>'; 
				}
				else
				{
				  echo '<td>-</td>';  
				  echo '<td>-</td>';
				}
            }
			echo '</tr>';
		}
		else
		{
			echo'<tr style="color:#000;font-weight:600;background-color:#f4b80d61;">';
			echo '<td>'.date('d-m-Y',strtotime($row['dt'])).'</td>';
			echo '<td>'.$row['docNo'].'</td>';
			echo '<td>'.$row['company_code'].' '.$row['company_name'].'</td>';
			echo '<td>'.$row['loc_code'].' '.$row['location_name'].'</td>';
			echo '<td>'.$row['iTypeNm'].'</td>';	
			echo '<td>'.$row['salemanNm'].'</td>';
			echo '<td>'.$row['ref'].'</td>';					  
			echo '<td>'.$row['notes'].'</td>';					  
			echo '<td align="center"><a href="javascript:view('.$id.')"><i class="fa fa-eye"></i></a></td>';
			if($ed==0)
            {
              echo '<td>-</td>';  
              echo '<td>-</td>';
            }
            else
            {
				if($row['rsts']=='0')
				{
					if($row['dt']==$cdt)
					{
						echo '<td align="center"><a href="javascript:edit('.$id.')"><i class="fa fa-edit"></i></a></td>';
					}
					else
					{
						echo '<td align="center">-</td>';
					}
					echo '<td align="center"><a href="javascript:deletes('.$id.')"><i class="fa fa-trash"></i></a></td>'; 
				}
				else
				{
				  echo '<td>-</td>';  
				  echo '<td>-</td>';
				}
            }
			echo '</tr>';
		}
		$cnt++;
	}
	else
	{		
		if($row['iType']=='1')
		{
			echo'<tr style="color:#000;font-weight:600;background-color:#0d69f445;">';
			echo '<td>'.date('d-m-Y',strtotime($row['dt'])).'</td>';
			echo '<td>'.$row['docNo'].'</td>';
			echo '<td>'.$row['company_code'].' '.$row['company_name'].'</td>';
			echo '<td>'.$row['loc_code'].' '.$row['location_name'].'</td>';
			echo '<td>'.$row['iTypeNm'].'</td>';
			echo '<td>'.$row['salemanNm'].'</td>';
			echo '<td>'.$row['ref'].'</td>';					  
			echo '<td>'.$row['notes'].'</td>';					  					  
			echo '<td align="center"><a href="javascript:view('.$id.')"><i class="fa fa-eye"></i></a></td>';
			if($ed==0)
            {
              echo '<td>-</td>';  
              echo '<td>-</td>';
            }
            else
            {
            if($row['rsts']=='0')
			{
				if($row['dt']==$cdt)
                {
                    echo '<td align="center"><a href="javascript:edit('.$id.')"><i class="fa fa-edit"></i></a></td>';
                }
                else
                {
                    echo '<td align="center">-</td>';
                }
                echo '<td align="center"><a href="javascript:deletes('.$id.')"><i class="fa fa-trash"></i></a></td>'; 
			}
          }
			echo '</tr>';
		}
		else
		{
			echo'<tr style="color:#000;font-weight:600;background-color:#f4b80d61;">';
			echo '<td>'.date('d-m-Y',strtotime($row['dt'])).'</td>';
			echo '<td>'.$row['docNo'].'</td>';
			echo '<td>'.$row['company_code'].' '.$row['company_name'].'</td>';
			echo '<td>'.$row['loc_code'].' '.$row['location_name'].'</td>';
			echo '<td>'.$row['iTypeNm'].'</td>';	
			echo '<td>'.$row['salemanNm'].'</td>';
			echo '<td>'.$row['ref'].'</td>';					  
			echo '<td>'.$row['notes'].'</td>';					  
			echo '<td align="center"><a href="javascript:view('.$id.')"><i class="fa fa-eye"></i></a></td>';
			
            if($ed==0)
            {
              echo '<td>-</td>';  
              echo '<td>-</td>';
            }
            else
            {
				if($row['rsts']=='0')
				{
					if($row['dt']==$cdt)
					{
						echo '<td align="center"><a href="javascript:edit('.$id.')"><i class="fa fa-edit"></i></a></td>';
					}
					else
					{
						echo '<td align="center">-</td>';
					}
					echo '<td align="center"><a href="javascript:deletes('.$id.')"><i class="fa fa-trash"></i></a></td>'; 
				}
				else
				{
				  echo '<td>-</td>';  
				  echo '<td>-</td>';
				}
            }
			echo '</tr>';
		}
		$cnt++;
	
	}
}
$mysql=null;
?>
</table>
<div class="pagination">    
<?php echo $pagination; ?>
</div>	
</div>	
</div>
</div>
</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Footer -->
<?php include("inc/footer.php"); ?>
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
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>-->

  <!-- Page level custom scripts -->
<!--  <script src="js/demo/datatables-demo.js"></script>-->
  
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