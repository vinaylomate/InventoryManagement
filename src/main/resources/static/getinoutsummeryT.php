<?php include('log_check.php')?>
<!DOCTYPE html>
<html lang="en">

<head>

 <?php
 include("inc/meta.php");
 ?>
 <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">
<?php
$compId=$locId=$iType=$itemId='0';
if(!empty($_GET['compId']))
$compId=$_GET['compId'];

if(!empty($_GET['locId']))
$locId=$_GET['locId'];

if(!empty($_GET['iType']))
$iType=$_GET['iType'];	

$uId=$_GET['uId'];
$uiType=$_GET['uiType'];
$uRole=$_GET['role'];

if(empty($_GET['uloc']))
$uloc="0";
else
$uloc=$_GET['uloc'];

if(empty($_GET['srch']))
$srch="0";
else
$srch=$_GET['srch'];

	
if(empty($_GET['fdt']))
$fdt=date('Y-m-d');
else
$fdt=$_GET['fdt'];

if(empty($_GET['tdt']))
$fdt=date('Y-m-d');
else
$tdt=$_GET['tdt'];

//echo $locId."<Br>";
$itemId=$_GET['itemId'];
$str=$str2="";
if($compId=='0')
{
	if($iType!='0' && $fdt!='0' && $tdt!='0' && $itemId!='0' && $srch!='0')
	{
		$str=$str." AND b.iType='$iType' AND (b.dt BETWEEN '$fdt' AND '$tdt') AND a.itemId='$itemId'  AND (IF(b.iType='1',r.focus_code LIKE '%".$srch."%',f.focus_code LIKE '%".$srch."%') OR IF(b.iType='1',r.sage_code LIKE '%".$srch."%',f.sage_code LIKE '%".$srch."%') OR IF(b.iType='1',rg.category_nm LIKE '%".$srch."%',fgg.category_nm LIKE '%".$srch."%') OR IF(b.iType='1',r.description LIKE '%".$srch."%',f.descc LIKE '%".$srch."%') OR a.batchNo LIKE '%".$srch."%' OR l.location_name LIKE '%".$srch."%') ";
		if($fdt<='2022-12-03')
		{
		  $fdt1='2022-12-03';
		  $str2=$str2." AND iType='$iType' AND dt='$fdt1' AND itemId='$itemId' ";  
		}
		else
		{
		    $str2=$str2." AND iType='$iType' AND cdt='$fdt' AND itemId='$itemId' ";
		}
	}
	else if($iType=='0' && $fdt!='0' && $tdt!='0' && $itemId!='0' && $srch!='0')
	{
		$str=$str." AND (b.dt BETWEEN '$fdt' AND '$tdt') AND a.itemId='$itemId'  AND (IF(b.iType='1',r.focus_code LIKE '%".$srch."%',f.focus_code LIKE '%".$srch."%') OR IF(b.iType='1',r.sage_code LIKE '%".$srch."%',f.sage_code LIKE '%".$srch."%') OR IF(b.iType='1',rg.category_nm LIKE '%".$srch."%',fgg.category_nm LIKE '%".$srch."%') OR IF(b.iType='1',r.description LIKE '%".$srch."%',f.descc LIKE '%".$srch."%') OR a.batchNo LIKE '%".$srch."%' OR l.location_name LIKE '%".$srch."%')";
		if($fdt<='2022-12-03')
		{
		  $fdt1='2022-12-03';
		  $str2=$str2." AND iType='$iType' AND dt='$fdt1' AND itemId='$itemId' ";  
		}
		else
		{
		    $str2=$str2." AND iType='$iType' AND cdt='$fdt' AND itemId='$itemId' "; 
		}
	}
	else if($iType!='0' && $fdt!='0' && $tdt!='0' && $itemId!='0' && $srch=='0')
	{
		$str=$str." AND b.iType='$iType' AND (b.dt BETWEEN '$fdt' AND '$tdt') AND a.itemId='$itemId' ";
		if($fdt<='2022-12-03')
		{
		   $str2=$str2." AND iType='$iType' AND dt='$fdt' AND itemId='$itemId' "; 
		}
		else
		{
		    $str2=$str2." AND iType='$iType' AND cdt='$fdt' AND itemId='$itemId' ";
		}
	}
	else if($iType=='0' && $fdt!='0' && $tdt!='0' && $itemId!='0' && $srch=='0')
	{
		$str=$str." AND (b.dt BETWEEN '$fdt' AND '$tdt') AND a.itemId='$itemId' ";
		if($fdt<='2022-12-03')
		{
		  $fdt1='2022-12-03';
		  $str2=$str2." AND dt='$fdt1' AND itemId='$itemId' ";  
		}
		else
		{
		    $str2=$str2." AND cdt='$fdt' AND itemId='$itemId' ";
		}
	}
	else
	{
		$str="no data found";
	}
}
else if($uRole=='admin' && ($uiType=='3' || $uiType=='0'))
{
	if($compId!='0' && $iType!='0' && $fdt!='0' && $tdt!='0' && $itemId!='0' && $locId!='0' && $srch!='0')
	{
		$str=$str." AND b.compId='$compId' AND b.iType='$iType' AND (b.dt BETWEEN '$fdt' AND '$tdt') AND a.itemId='$itemId' AND b.locId='$locId' AND (IF(b.iType='1',r.focus_code LIKE '%".$srch."%',f.focus_code LIKE '%".$srch."%') OR IF(b.iType='1',r.sage_code LIKE '%".$srch."%',f.sage_code LIKE '%".$srch."%') OR IF(b.iType='1',rg.category_nm LIKE '%".$srch."%',fgg.category_nm LIKE '%".$srch."%') OR IF(b.iType='1',r.description LIKE '%".$srch."%',f.descc LIKE '%".$srch."%') OR a.batchNo LIKE '%".$srch."%' OR l.location_name LIKE '%".$srch."%') ";
		if($fdt<='2022-12-03')
		{
		    $fdt1='2022-12-03';
			$str2=$str2." AND compId='$compId' AND iType='$iType' AND locId='$locId' AND dt='$fdt1' AND itemId='$itemId' ";
		}
		else
		{
		    $str2=$str2." AND compId='$compId' AND iType='$iType' AND locId='$locId' AND cdt='$fdt' AND itemId='$itemId' ";
		}
	}	
	else if($compId!='0' && $iType!='0' && $fdt!='0' && $tdt!='0' && $itemId!='0' && $locId=='0' && $srch!='0')
	{
		$str=$str." AND b.compId='$compId' AND b.iType='$iType' AND (b.dt BETWEEN '$fdt' AND '$tdt') AND a.itemId='$itemId' AND (IF(b.iType='1',r.focus_code LIKE '%".$srch."%',f.focus_code LIKE '%".$srch."%') OR IF(b.iType='1',r.sage_code LIKE '%".$srch."%',f.sage_code LIKE '%".$srch."%') OR IF(b.iType='1',rg.category_nm LIKE '%".$srch."%',fgg.category_nm LIKE '%".$srch."%') OR IF(b.iType='1',r.description LIKE '%".$srch."%',f.descc LIKE '%".$srch."%') OR a.batchNo LIKE '%".$srch."%' OR l.location_name LIKE '%".$srch."%') ";
		if($fdt<='2022-12-03')
		{
		    $fdt1='2022-12-03';
			$str2=$str2." AND compId='$compId' AND iType='$iType' AND dt='$fdt1' AND itemId='$itemId' ";
		}
		else
		{
		    $str2=$str2." AND compId='$compId' AND iType='$iType' AND cdt='$fdt' AND itemId='$itemId' ";
		}
	}
	else if($compId!='0' && $iType=='0' && $fdt!='0' && $tdt!='0' && $itemId!='0' && $locId=='0' && $srch!='0')
	{
		$str=$str." AND b.compId='$compId' AND (b.dt BETWEEN '$fdt' AND '$tdt') AND a.itemId='$itemId' AND (IF(b.iType='1',r.focus_code LIKE '%".$srch."%',f.focus_code LIKE '%".$srch."%') OR IF(b.iType='1',r.sage_code LIKE '%".$srch."%',f.sage_code LIKE '%".$srch."%') OR IF(b.iType='1',rg.category_nm LIKE '%".$srch."%',fgg.category_nm LIKE '%".$srch."%') OR IF(b.iType='1',r.description LIKE '%".$srch."%',f.descc LIKE '%".$srch."%') OR a.batchNo LIKE '%".$srch."%' OR l.location_name LIKE '%".$srch."%') ";
		if($fdt<='2022-12-03')
		{
		    $fdt1='2022-12-03';
			$str2=$str2." AND compId='$compId' AND iType='$iType' AND dt='$fdt1' AND itemId='$itemId' ";
		}
		else
		{
		    $str2=$str2." AND compId='$compId' AND iType='$iType' AND cdt='$fdt' AND itemId='$itemId' ";
		}
	}
	else if($compId=='0' && $iType=='0' && $fdt!='0' && $tdt!='0' && $itemId!='0' && $locId=='0' && $srch!='0')
	{
		$str=$str." AND (b.dt BETWEEN '$fdt' AND '$tdt') AND a.itemId='$itemId' AND (IF(b.iType='1',r.focus_code LIKE '%".$srch."%',f.focus_code LIKE '%".$srch."%') OR IF(b.iType='1',r.sage_code LIKE '%".$srch."%',f.sage_code LIKE '%".$srch."%') OR IF(b.iType='1',rg.category_nm LIKE '%".$srch."%',fgg.category_nm LIKE '%".$srch."%') OR IF(b.iType='1',r.description LIKE '%".$srch."%',f.descc LIKE '%".$srch."%') OR a.batchNo LIKE '%".$srch."%' OR l.location_name LIKE '%".$srch."%') ";
		if($fdt<='2022-12-03')
		{
		    $fdt1='2022-12-03';
			$str2=$str2." AND compId='$compId' AND iType='$iType' AND dt='$fdt1' AND itemId='$itemId' ";
		}
		else
		{
		    $str2=$str2." AND compId='$compId' AND iType='$iType' AND cdt='$fdt' AND itemId='$itemId' ";
		}
	}
	else if($compId!='0' && $iType!='0' && $fdt!='0' && $tdt!='0' && $itemId!='0' && $locId!='0' && $srch=='0')
	{
		$str=$str." AND b.compId='$compId' AND b.iType='$iType' AND (b.dt BETWEEN '$fdt' AND '$tdt') AND a.itemId='$itemId' AND b.locId='$locId' ";
		if($fdt<='2022-12-03')
		{
		    $fdt1='2022-12-03';
			$str2=$str2." AND compId='$compId' AND iType='$iType' AND locId='$locId' AND dt='$fdt1' AND itemId='$itemId' ";
		}
		else
		{
		    $str2=$str2." AND compId='$compId' AND iType='$iType' AND locId='$locId' AND cdt='$fdt' AND itemId='$itemId' ";
		}
	}
	else if($compId!='0' && $iType!='0' && $fdt!='0' && $tdt!='0' && $itemId!='0' && $locId=='0' && $srch=='0')
	{
		$str=$str." AND b.compId='$compId' AND b.iType='$iType' AND (b.dt BETWEEN '$fdt' AND '$tdt') AND a.itemId='$itemId' ";
		if($fdt<='2022-12-03')
		{
		    $fdt1='2022-12-03';
			$str2=$str2." AND compId='$compId' AND iType='$iType' AND dt='$fdt1' AND itemId='$itemId' ";
		}
		else
		{
		    $str2=$str2." AND compId='$compId' AND iType='$iType' AND cdt='$fdt' AND itemId='$itemId' ";
		}
	}
	else if($compId!='0' && $iType=='0' && $fdt!='0' && $tdt!='0' && $itemId!='0' && $locId=='0' && $srch=='0')
	{
		$str=$str." AND b.compId='$compId' AND (b.dt BETWEEN '$fdt' AND '$tdt') AND a.itemId='$itemId' ";
		if($fdt<='2022-12-03')
		{
		    $fdt1='2022-12-03';
			$str2=$str2." AND compId='$compId' AND dt='$fdt1' AND itemId='$itemId' ";
		}
		else
		{
		    $str2=$str2." AND compId='$compId' AND cdt='$fdt' AND itemId='$itemId' ";
		}
	}
	else if($compId=='0' && $iType=='0' && $fdt!='0' && $tdt!='0' && $itemId!='0' && $locId=='0' && $srch=='0')
	{
		$str=$str." AND (b.dt BETWEEN '$fdt' AND '$tdt') AND a.itemId='$itemId' ";
		if($fdt<='2022-12-03')
		{
		    $fdt1='2022-12-03';
			$str2=$str2." AND dt='$fdt1' AND itemId='$itemId' ";
		}
		else
		{
		    $str2=$str2." AND cdt='$fdt' AND itemId='$itemId' ";
		}
	}
	else
	{
		$str="no data found";
	}
}
else
{
	if($compId!='0' && $iType!='0' && $fdt!='0' && $tdt!='0' && $itemId!='0' && $locId!='0' && $srch!='0')
	{
		$str=$str." AND b.compId='$compId' AND b.iType='$iType' AND (b.dt BETWEEN '$fdt' AND '$tdt') AND a.itemId='$itemId' AND b.locId='$locId' AND (IF(b.iType='1',r.focus_code LIKE '%".$srch."%',f.focus_code LIKE '%".$srch."%') OR IF(b.iType='1',r.sage_code LIKE '%".$srch."%',f.sage_code LIKE '%".$srch."%') OR IF(b.iType='1',rg.category_nm LIKE '%".$srch."%',fgg.category_nm LIKE '%".$srch."%') OR IF(b.iType='1',r.description LIKE '%".$srch."%',f.descc LIKE '%".$srch."%') OR a.batchNo LIKE '%".$srch."%' OR l.location_name LIKE '%".$srch."%') ";
		if($fdt<='2022-12-03')
		{
		    $fdt1='2022-12-03';
			$str2=$str2." AND compId='$compId' AND iType='$iType' AND locId='$locId' AND dt='$fdt1' AND itemId='$itemId' ";
		}
		else
		{
		    $str2=$str2." AND compId='$compId' AND iType='$iType' AND locId='$locId' AND cdt='$fdt' AND itemId='$itemId' ";
		}
	}	
	else if($compId!='0' && $iType!='0' && $fdt!='0' && $tdt!='0' && $itemId!='0' && $locId=='0' && $srch!='0')
	{
		$str=$str." AND b.compId='$compId' AND b.iType='$iType' AND (b.dt BETWEEN '$fdt' AND '$tdt') AND a.itemId='$itemId' AND (IF(b.iType='1',r.focus_code LIKE '%".$srch."%',f.focus_code LIKE '%".$srch."%') OR IF(b.iType='1',r.sage_code LIKE '%".$srch."%',f.sage_code LIKE '%".$srch."%') OR IF(b.iType='1',rg.category_nm LIKE '%".$srch."%',fgg.category_nm LIKE '%".$srch."%') OR IF(b.iType='1',r.description LIKE '%".$srch."%',f.descc LIKE '%".$srch."%') OR a.batchNo LIKE '%".$srch."%' OR l.location_name LIKE '%".$srch."%') ";
		if($fdt<='2022-12-03')
		{
		    $fdt1='2022-12-03';
			$str2=$str2." AND compId='$compId' AND iType='$iType' AND dt='$fdt1' AND itemId='$itemId' ";
		}
		else
		{
		    $str2=$str2." AND compId='$compId' AND iType='$iType' AND cdt='$fdt' AND itemId='$itemId' ";
		}
	}
	else if($compId!='0' && $iType=='0' && $fdt!='0' && $tdt!='0' && $itemId!='0' && $locId=='0' && $srch!='0')
	{
		$str=$str." AND b.compId='$compId' AND (b.dt BETWEEN '$fdt' AND '$tdt') AND a.itemId='$itemId' AND (IF(b.iType='1',r.focus_code LIKE '%".$srch."%',f.focus_code LIKE '%".$srch."%') OR IF(b.iType='1',r.sage_code LIKE '%".$srch."%',f.sage_code LIKE '%".$srch."%') OR IF(b.iType='1',rg.category_nm LIKE '%".$srch."%',fgg.category_nm LIKE '%".$srch."%') OR IF(b.iType='1',r.description LIKE '%".$srch."%',f.descc LIKE '%".$srch."%') OR a.batchNo LIKE '%".$srch."%' OR l.location_name LIKE '%".$srch."%') ";
		if($fdt<='2022-12-03')
		{
		    $fdt1='2022-12-03';
			$str2=$str2." AND compId='$compId' AND iType='$iType' AND dt='$fdt1' AND itemId='$itemId' ";
		}
		else
		{
		    $str2=$str2." AND compId='$compId' AND iType='$iType' AND cdt='$fdt' AND itemId='$itemId' ";
		}
	}
	else if($compId=='0' && $iType=='0' && $fdt!='0' && $tdt!='0' && $itemId!='0' && $locId=='0' && $srch!='0')
	{
		$str=$str." AND (b.dt BETWEEN '$fdt' AND '$tdt') AND a.itemId='$itemId' AND (IF(b.iType='1',r.focus_code LIKE '%".$srch."%',f.focus_code LIKE '%".$srch."%') OR IF(b.iType='1',r.sage_code LIKE '%".$srch."%',f.sage_code LIKE '%".$srch."%') OR IF(b.iType='1',rg.category_nm LIKE '%".$srch."%',fgg.category_nm LIKE '%".$srch."%') OR IF(b.iType='1',r.description LIKE '%".$srch."%',f.descc LIKE '%".$srch."%') OR a.batchNo LIKE '%".$srch."%' OR l.location_name LIKE '%".$srch."%') ";
		if($fdt<='2022-12-03')
		{
		    $fdt1='2022-12-03';
			$str2=$str2." AND compId='$compId' AND iType='$iType' AND dt='$fdt1' AND itemId='$itemId' ";
		}
		else
		{
		    $str2=$str2." AND compId='$compId' AND iType='$iType' AND cdt='$fdt' AND itemId='$itemId' ";
		}

	}
	else if($compId!='0' && $iType!='0' && $fdt!='0' && $tdt!='0' && $itemId!='0' && $locId!='0' && $srch=='0')
	{
		$str=$str." AND b.compId='$compId' AND b.iType='$iType' AND (b.dt BETWEEN '$fdt' AND '$tdt') AND a.itemId='$itemId' AND b.locId='$locId' ";
		if($fdt<='2022-12-03')
		{
		    $fdt1='2022-12-03';
			$str2=$str2." AND compId='$compId' AND iType='$iType' AND locId='$locId' AND dt='$fdt1' AND itemId='$itemId' ";
		}
		else
		{
		    $str2=$str2." AND compId='$compId' AND iType='$iType' AND locId='$locId' AND cdt='$fdt' AND itemId='$itemId' ";
		}
	}
	else if($compId!='0' && $iType!='0' && $fdt!='0' && $tdt!='0' && $itemId!='0' && $locId=='0' && $srch=='0')
	{
		$str=$str." AND b.compId='$compId' AND b.iType='$iType' AND (b.dt BETWEEN '$fdt' AND '$tdt') AND a.itemId='$itemId' ";
		if($fdt<='2022-12-03')
		{
		    $fdt1='2022-12-03';
			$str2=$str2." AND compId='$compId' AND iType='$iType' AND dt='$fdt1' AND itemId='$itemId' ";
		}
		else
		{
		    $str2=$str2." AND compId='$compId' AND iType='$iType' AND cdt='$fdt' AND itemId='$itemId' ";
		}
	}
	else if($compId!='0' && $iType=='0' && $fdt!='0' && $tdt!='0' && $itemId!='0' && $locId=='0' && $srch=='0')
	{
		$str=$str." AND b.compId='$compId' AND (b.dt BETWEEN '$fdt' AND '$tdt') AND a.itemId='$itemId' ";
		if($fdt<='2022-12-03')
		{
		    $fdt1='2022-12-03';
			$str2=$str2." AND compId='$compId' AND dt='$fdt1' AND itemId='$itemId' ";
		}
		else
		{
		    $str2=$str2." AND compId='$compId' AND cdt='$fdt' AND itemId='$itemId' ";
		}
	}
	else if($compId=='0' && $iType=='0' && $fdt!='0' && $tdt!='0' && $itemId!='0' && $locId=='0' && $srch=='0')
	{
		$str=$str." AND (b.dt BETWEEN '$fdt' AND '$tdt') AND a.itemId='$itemId' ";
		if($fdt<='2022-12-03')
		{
		    $fdt1='2022-12-03';
			$str2=$str2." AND dt='$fdt1' AND itemId='$itemId' "; 
		}
		else
		{
		    $str2=$str2." AND cdt='$fdt' AND itemId='$itemId' ";
		}
	}
	else
	{
		$str="no data found";
	}
}

$locNm="";		
if($locId!='0')
{
	include('mysql.connect.php');
    $qqLoc="SELECT CONCAT(loc_code,' - ',location_name) AS locNm FROM location_tbl WHERE ID='$locId' AND sts='0'";
    //echo $qqLoc."<Br>";
    $st12=$mysql->prepare($qqLoc);
    $st12->execute();
    $rw12=$st12->fetch(PDO::FETCH_ASSOC);
	$locNm=$rw12['locNm'];
	$mysql=null;
}
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
            <h1 class="h4 mb-0 text-gray-800" style="height:0px;margin-top:10px"></h1>     
          </div>
          
          <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
       <div align="right" style="padding:5px">
		   <input type="hidden" id="compId" name="compId" value="<?php echo $compId; ?>">
		   <input type="hidden" id="iType" name="iType" value="<?php echo $iType; ?>">
		   <input type="hidden" id="location" name="location" value="<?php echo $locId; ?>">
		   <input type="hidden" id="fdt" name="fdt" value="<?php echo $fdt; ?>">
		   <input type="hidden" id="tdt" name="tdt" value="<?php echo $tdt; ?>">
		   <input type="hidden" id="txtsearch" name="txtsearch" value="<?php echo $srch; ?>">
		   <input type="hidden" id="uid" name="uid"  value="<?php echo $uId; ?>">
		   <input type="hidden" id="uiType" name="uiType" value="<?php echo $uiType; ?>">
		   <input type="hidden" id="urole" name="urole" value="<?php echo $uRole; ?>">
		   <input type="hidden" id="uloc" name="uloc" value="<?php echo $uloc; ?>">
		   <input type="hidden" id="itemId" name="itemId" value="<?php echo $itemId; ?>">
		   
            <table>
		   <tr>
			<td><a href="javascript:getexcel();"><img src="img/EXCELIMG1.png" alt="download" title="download" style="width:50px; height:50px"></a></td>
			<td><input type="button" onClick="print2()" value="Print" class="btn btn-primary"/></td>	
			 <td><input type="button" onClick="closeFn()" value="X" class="btn btn-danger"/></td>  
			</tr>
		   </table> 
            </div> 
        
        
        <div class="row" >          
          <div class="col-lg-12">
          <page id="getdata">
            <div class="p-5">
			<table width="100%">
			<tr>
			<td colspan="6" align="center">
			 <div style="font-size:30px;font-weight:bold;" align="center">
            <!--<img src="img/logo1.jpg" style="height:180px;width:100%">-->RITVER <span style="font-size:14px;">PAINTS & COATINGS</span>
				<hr>
            </div>
           
			</td>
			</tr>
			
			<?php
			if($locId=='0')	
			{
			?>
				<tr>	
				<td></td>	
				<td></td>	
				<td></td>	
				<td>Date</td>	
				<td>:</td>	
				<td><?php echo date('d-m-Y');?></td>
				</tr>
			<?php	
			}
			else
			{
			?>
				<tr>
				<td>Date</td>	
				<td>:</td>	
				<td><?php echo date('d-m-Y');?></td>	
				<td>Location</td>	
				<td>:</td>	
				<td><?php echo $locNm;?></td>	
				</tr>
			<?php	
			}
			?>
			<tr>
			<td>From Date</td>	
			<td>:</td>	
			<td><?php echo date('d-m-Y',strtotime($fdt));?></td>	
			<td>To Date</td>	
			<td>:</td>	
			<td><?php echo date('d-m-Y',strtotime($tdt));?></td>	
			</tr>
			</table>	
			<hr>
              
            <div style="margin-top:25px">
            <?php
            if($str=='no data found')
            {
				echo '<div align="center"><h1>no data found...</h1></div>';
            }
            else
            {
				include('mysql.connect.php');
				if($fdt<='2022-12-03')
				{
				    $qqOp="SELECT dt AS cdt,oqty FROM stock_op_tbl WHERE sts='0' ".$str2."";
				}
				else
				{
				    $qqOp="SELECT cdt,oqty FROM stock_op_tbl WHERE sts='0' ".$str2."";
				}
				//echo $qqOp."<Br>";
				$st1=$mysql->prepare($qqOp);
				$st1->execute();
				$rw1=$st1->fetch(PDO::FETCH_ASSOC);
				$opstk=$startop=$cdt=0;
				if(!empty($rw1['oqty']))
				{
					$opstk=$rw1['oqty'];
					$cdt=$rw1['cdt'];
					$startop=$opstk;
				}
				else	
				{
    				$opstk=0;
					$startop=$opstk;
					$cdt=$fdt;
				}

				if($uRole=='admin' && ($uiType=='3' || $uiType=='0'))
				{
					$qq="SELECT a.ID,b.dt,a.itemId,IF(b.iType='1',r.focus_code,f.focus_code) AS focus_code,IF(b.iType='1',r.sage_code,f.sage_code) AS sage_code,IF(b.iType='1',CONCAT(rg.category_nm,' ',r.description,' ',rm_u.uom),CONCAT(fgg.category_nm,' ',f.brand,' ',f.descc,' ',f_u.uom)) AS desp,a.entryId,e.entryNm,a.eType,IF(a.eType='1','IN','OUT') AS eTypeNm,a.qty,a.batchNo,a.expdt,a.ref,a.notes,l.loc_code,l.location_name,b.compId,b.locId,b.iType,b.ref FROM inventory_info_tbl AS a LEFT JOIN inventory_tbl AS b ON a.invId=b.ID LEFT JOIN rm_master AS r ON a.itemId=r.rmId LEFT JOIN fg_master AS f ON a.itemId=f.fgId LEFT JOIN entry_type_tbl AS e ON a.entryId=e.entryId LEFT JOIN uom_tbl AS rm_u ON r.UOM=rm_u.ID LEFT JOIN uom_tbl AS f_u ON f.uom=f_u.ID LEFT JOIN category_master AS rg ON r.catId=rg.catId LEFT JOIN category_master AS fgg ON f.category_id=fgg.catId LEFT JOIN location_tbl AS l ON b.locId=l.ID WHERE b.sts!='2' ".$str." AND a.sts!='2' ORDER BY b.dt";
				}
				else
				{
					$qq="SELECT a.ID,b.dt,a.itemId,IF(b.iType='1',r.focus_code,f.focus_code) AS focus_code,IF(b.iType='1',r.sage_code,f.sage_code) AS sage_code,IF(b.iType='1',CONCAT(rg.category_nm,' ',r.description,' ',rm_u.uom),CONCAT(fgg.category_nm,' ',f.brand,' ',f.descc,' ',f_u.uom)) AS desp,a.entryId,e.entryNm,a.eType,IF(a.eType='1','IN','OUT') AS eTypeNm,a.qty,a.batchNo,a.expdt,a.ref,a.notes,l.loc_code,l.location_name,b.compId,b.locId,b.iType,b.ref FROM inventory_info_tbl AS a LEFT JOIN inventory_tbl AS b ON a.invId=b.ID LEFT JOIN rm_master AS r ON a.itemId=r.rmId LEFT JOIN fg_master AS f ON a.itemId=f.fgId LEFT JOIN entry_type_tbl AS e ON a.entryId=e.entryId LEFT JOIN uom_tbl AS rm_u ON r.UOM=rm_u.ID LEFT JOIN uom_tbl AS f_u ON f.uom=f_u.ID LEFT JOIN category_master AS rg ON r.catId=rg.catId LEFT JOIN category_master AS fgg ON f.category_id=fgg.catId  LEFT JOIN location_tbl AS l ON b.locId=l.ID LEFT JOIN admin_usr_loc AS us ON l.ID=us.locId WHERE b.sts!='2' AND a.sts!='2' AND us.uid='$uId' ".$str." ORDER BY b.dt";
				}
				//echo $qq."<Br>";
				$stm=$mysql->prepare($qq);
				$stm->execute();	
				
			?>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <?php
            if($locId!='0')	
            {
            ?>				
            <tr id="aa" style="background-color:#e1736e;">	
            <th style="color:#000">No</th>
            <th style="color:#000">Date</th>
            <th style="color:#000">Sage Reference</th>
            <th style="color:#000">Sage Code</th>
            <th style="color:#000">Focus Code</th>
            <th style="color:#000">Batch No</th>
            <th style="color:#000">Opening Stock</th>
            <th style="color:#000">IN</th>
            <th style="color:#000">OUT</th>
            <th style="color:#000">Running Stock</th>
            <th style="color:#000">Entry Type</th>
            </tr>
			<tr>	
            <th style="color:#000"></th>
            <th style="color:#000"><?php echo date('d-m-Y',strtotime($cdt));?> </th>
            <th style="color:#000"></th>
            <th style="color:#000"></th>
            <th style="color:#000"></th>
            <th style="color:#000"></th>
            <th style="color:#000"><?php echo $opstk;?></th>
            <th style="color:#000">0</th>
            <th style="color:#000">0</th>
            <th style="color:#000">0</th>
            <th style="color:#000"></th>
            </tr>
            <?php
            }
            else
            {
            ?>				
            <tr id="aa" style="background-color:#e1736e;">					
            <th style="color:#000">No</th>
            <th style="color:#000">Date</th>
            <th style="color:#000">Location</th>
            <th style="color:#000">Sage Reference</th>	
            <th style="color:#000">Sage Code</th>
            <th style="color:#000">Focus Code</th>
            <th style="color:#000">Batch No</th>
            <th style="color:#000">Opening Stock</th>
            <th style="color:#000">IN</th>
            <th style="color:#000">OUT</th>
            <th style="color:#000">Running Stock</th>
            <th style="color:#000">Entry Type</th>
            </tr>				
            <tr>					
            <th style="color:#000"></th>
            <th style="color:#000"></th>
            <th style="color:#000"></th>
            <th style="color:#000"></th>	
            <th style="color:#000"></th>
            <th style="color:#000"></th>
            <th style="color:#000"></th>
            <th style="color:#000"><?php echo $opstk;?></th>
            <th style="color:#000">0</th>
            <th style="color:#000">0</th>
            <th style="color:#000">0</th>
            <th style="color:#000">Entry Type</th>
            </tr>		
            <?php
            }
            ?>
            <?php
            

            $cnt=1;
            $totin=$totout=$cltot=$rq=$dt=0;
            while($rw=$stm->fetch(PDO::FETCH_ASSOC))
            {
				$inq=$outq=0;
				$dt=$rw['dt'];
				echo '<tr>';
				echo '<td style="background-color:#0d69f445;color:#000">'.$cnt.'</td>';
				echo '<td style="background-color:#0d69f445;color:#000">'.date('d-m-Y',strtotime($rw['dt'])).'</td>';
				if($locId=='0')	
				{	
					echo '<td style="background-color:#0d69f445;color:#000">'.$rw['loc_code'].'</td>';
				}
				echo '<td style="background-color:#f4b80d61;color:#000">'.$rw['ref'].'</td>';
				echo '<td style="background-color:#f4b80d61;color:#000">'.$rw['sage_code'].'</td>';
				echo '<td style="background-color:#f4b80d61;color:#000">'.$rw['focus_code'].'</td>';
				echo '<td style="background-color:#0d69f445;color:#000">'.$rw['batchNo'].'</td>';
				if($cnt==1)
				{				
					echo '<td style="background-color:#0d69f445;color:#000">0</td>';
				}
				else 
				{				
					if($dt==$rw['dt'])
					{
						$opstk=$rq;
						$rq=0;
					}
					else
					{
						$qqOp22="SELECT oqty FROM stock_op_tbl WHERE sts='0' AND cdt='".$rw['dt']."' AND itemId='".$rw['itemId']."' AND compId='".$rw['compId']."' AND locId='".$rw['locId']."' AND iType='".$rw['iType']."'";
						//echo $qqOp22."<Br>";
						$st22=$mysql->prepare($qqOp22);
						$st22->execute();
						$rw22=$st22->fetch(PDO::FETCH_ASSOC);
						$opstk=0;
						if(!empty($rw22['oqty']))
						{
							$opstk=$rw22['oqty'];
						}
						else	
						{
							$opstk=0;
						}
					}
					echo '<td style="background-color:#0d69f445;color:#000">'.$opstk.'</td>';
				}	

				if($rw['eType']=='1')	
				{	
					echo '<td style="background-color:#0d69f445;color:#000">'.$rw['qty'].'</td>';
					$inq=$rw['qty'];
					$totin=$totin+$inq;
				}
				else
				{
					echo '<td style="background-color:#0d69f445;color:#000">0</td>';            
				}

				if($rw['eType']=='2')	
				{	
					echo '<td style="background-color:#0d69f445;color:#000">'.$rw['qty'].'</td>';
					$outq=$rw['qty'];
					$totout=$totout+$rw['qty'];
				}
				else
				{
					echo '<td style="background-color:#0d69f445;color:#000">0</td>';            
				}
				
				$rq=($opstk+$inq)-$outq;
				$cltot=$cltot+$rq;
				echo '<td style="background-color:#0d69f445;color:#000">'.$rq.'</td>';	
				echo '<td style="background-color:#0d69f445;color:#000">'.$rw['entryNm'].'</td>';
				echo '</tr>';
				$cnt++;
            }
            $mysql=null;
            ?>
            <tfoot>
            <?php
            if($locId!='0')	
            {
            ?>
            <tr id="aa" style="background-color:#e1736e;">				
            <th style="color:#000"></th>
            <th style="color:#000"></th>
            <th style="color:#000"></th>
            <th style="color:#000"></th>
            <th style="color:#000"></th>
            <th style="color:#000">Total</th>
            <th style="color:#000"></th>
            <th style="color:#000"><?php echo $totin;?></th>
            <th style="color:#000"><?php echo $totout;?></th>
            <th style="color:#000"><?php echo (($startop+$totin)-$totout);?></th>
            <th style="color:#000"></th>
            </tr>
				
			
            <?php
            }
            else
            {
            ?>
            <tr style="background-color:#e1736e;">					
            <th style="color:#000"></th>
            <th style="color:#000"></th>
            <th style="color:#000"></th>
            <th style="color:#000"></th>	
            <th style="color:#000"></th>
            <th style="color:#000"></th>
            <th style="color:#000"></th>
            <th style="color:#000"><?php echo $totin;?></th>
            <th style="color:#000"><?php echo $totout;?></th>
            <th style="color:#000"><?php echo (($startop+$totin)-$totout);?></th>
            <th style="color:#000"></th>
            <th style="color:#000"></th>
            </tr>
			
            <?php
            }
            ?>
            </tfoot>
            </table>
			<?php
            }
            ?>  

            </div>
              
            </div>
            </page>
            <!---->
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
 <script>  
    $(window).load(function() {
   $('#tbl').DataTable({});
	});
	
	function print2()
	{
	  var printContents = document.getElementById('getdata').innerHTML;
	  var originalContents = document.body.innerHTML;	  
	  document.body.innerHTML = printContents; 
	  window.print();	  
	  document.body.innerHTML = originalContents;	
	  
	}
function closeFn()
{
	window.close();
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
			srch=encodeURIComponent(srch);		
	}

	var uId=document.getElementById('uid').value;
	var uType=document.getElementById('uiType').value;
	var uRole=document.getElementById('urole').value;
	var uloc=document.getElementById('uloc').value;
	var itemId=document.getElementById('itemId').value;

	var scriptUrl='inoutReportsummeryEx.php?compId='+compId+'&iType='+iType+'&locId='+locId+'&uId='+uId+'&fdt='+fdt+'&tdt='+tdt+'&uiType='+uType+'&role='+uRole+'&uloc='+uloc+'&srch='+srch+'&itemId='+itemId;
	//alert(scriptUrl);
	//dataTable
	window.open(scriptUrl, "toolbar=yes, scrollbars=yes, resizable=no, top=60, left=0, width=1000, height=600");
}	 
</script>
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