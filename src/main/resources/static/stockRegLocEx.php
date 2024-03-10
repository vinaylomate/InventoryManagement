<?php
include ("mysql.connect.php");
date_default_timezone_set('Asia/Calcutta');
set_time_limit(0);
$filename="stockRegLocEx_".date('d.m.Y H:i:s a').".xls";
$date=date('Y-m-d');
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: application/vnd.ms-excel");
$compId=$locId=$iType='0';
if(!empty($_GET['compId']))
$compId=$_GET['compId'];

if(!empty($_GET['iType']))
$iType=$_GET['iType'];

$uId=$_GET['uId'];
$uiType=$_GET['uiType'];
$uRole=$_GET['role'];

if(empty($_GET['uloc']))
$uloc="0";
else
$uloc=$_GET['uloc'];
	
//echo "ABCYY : ".$uloc."<Br>";

if(empty($_GET['catId']))
$catId="0";
else
$catId=$_GET['catId'];

if(empty($_GET['srch']))
$srch="0";
else
$srch=$_GET['srch'];

$str=$strl="";

if($compId!='0' && $iType!='0' && $catId=='0' && $srch=='0')
{
	$str=$str." AND a.compId='$compId' AND a.iType='$iType'";
	$strl=$strl." AND company_id='$compId' AND iType='$iType'";
}
else if($compId!='0' && $iType!='0' && $catId!='0' && $srch=='0')
{
	$str=$str." AND a.compId='$compId' AND a.iType='$iType' AND r.catId='$catId'";
	$strl=$strl." AND company_id='$compId' AND iType='$iType'";
}
else if($compId!='0' && $iType!='0' && $catId!='0' && $srch!='0')
{
	$str=$str." AND a.compId='$compId' AND a.iType='$iType' AND r.catId='$catId' AND (
      rg.category_nm LIKE '%".$srch."%' OR r.sage_code LIKE '%".$srch."%' OR r.focus_code LIKE '%".$srch."%' 
	  OR r.description LIKE '%".$srch."%' OR ru.uom LIKE '%".$srch."%')";
	$strl=$strl." AND company_id='$compId' AND iType='$iType'";
}
else if($compId!='0' && $iType!='0' && $catId=='0' && $srch!='0')
{
	$str=$str." AND a.compId='$compId' AND a.iType='$iType' AND (
      rg.category_nm LIKE '%".$srch."%' OR r.sage_code LIKE '%".$srch."%' OR r.focus_code LIKE '%".$srch."%' 
	  OR r.description LIKE '%".$srch."%' OR ru.uom LIKE '%".$srch."%')";
	$strl=$strl." AND company_id='$compId' AND iType='$iType'";
}
else if($compId=='0' && $iType!='0' && $catId!='0' && $srch!='0')
{
	$str=$str." AND a.iType='$iType' AND r.catId='$catId' AND (
      rg.category_nm LIKE '%".$srch."%' OR r.sage_code LIKE '%".$srch."%' OR r.focus_code LIKE '%".$srch."%' 
	  OR r.description LIKE '%".$srch."%' OR ru.uom LIKE '%".$srch."%')";
	$strl=$strl." AND company_id='$compId' AND iType='$iType'";
}
else if($compId=='0' && $iType!='0' && $catId!='0' && $srch=='0')
{
	$str=$str." AND a.iType='$iType' AND r.catId='$catId' ";
	$strl=$strl." AND company_id='$compId' AND iType='$iType'";
}
else if($compId=='0' && $iType!='0' && $catId=='0' && $srch!='0')
{
	$str=$str." AND a.iType='$iType' AND (
      rg.category_nm LIKE '%".$srch."%' OR r.sage_code LIKE '%".$srch."%' OR r.focus_code LIKE '%".$srch."%' 
	  OR r.description LIKE '%".$srch."%' OR ru.uom LIKE '%".$srch."%')";
	$strl=$strl." AND company_id='$compId' AND iType='$iType'";
}
else	
{
	$str=$str." a.iType='$iType' ";
	$strl=$strl." AND iType='$iType' ";
}
if($uRole=='admin' && ($uiType=='3'||$uiType=='0'))
{		
	$qq="SELECT r.focus_code,r.sage_code,CONCAT(r.description,' - ',ru.uom) AS desp FROM stock_tbl AS a LEFT JOIN company_tbl AS c ON a.compId=c.ID LEFT JOIN location_tbl AS l ON a.locId=l.ID LEFT JOIN rm_master AS r ON a.itemId=r.rmId LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID LEFT JOIN category_master AS rg ON r.catId=rg.catId WHERE a.sts!='2' AND r.sts!='2' ".$str." GROUP BY r.focus_code,r.sage_code,r.description,ru.uom ORDER BY SUBSTRING(r.focus_code,1,9), SUBSTRING(r.focus_code,10)*1";
}
else
{		
	$qq="SELECT r.focus_code,r.sage_code,CONCAT(r.description,' - ',ru.uom) AS desp FROM stock_tbl AS a LEFT JOIN company_tbl AS c ON a.compId=c.ID LEFT JOIN location_tbl AS l ON a.locId=l.ID LEFT JOIN rm_master AS r ON a.itemId=r.rmId LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID LEFT JOIN category_master AS rg ON r.catId=rg.catId LEFT JOIN admin_usr_loc AS us ON l.ID=us.locId WHERE a.sts!='2' AND r.sts!='2' ".$str." AND us.uid='$uId' GROUP BY r.focus_code,r.sage_code,r.description,ru.uom ORDER BY SUBSTRING(r.focus_code,1,9), SUBSTRING(r.focus_code,10)*1";
}

include('mysql.connnect.php');

echo '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" border="1">
<thead>
<tr style="background-color:#b02923">	
<th style="color:#fff;">Focus Code</th>
<th style="color:#fff">Sage Code</th>
<th style="color:#fff;">Product</th>';
$ql="SELECT ID,loc_code,location_name FROM location_tbl WHERE sts!='2' ".$strl." ORDER BY loc_code";	
$stl=$mysql->prepare($ql);
$stl->execute();
$loc=array();
$l=0;	
while($row1=$stl->fetch(PDO::FETCH_ASSOC))
{
	$loc[$l]=$row1['ID'];
	$l++;
	
	echo '<th style="color:#fff">'.$row1['loc_code']." - ".$row1['location_name'].'</th>';
}
echo '<th style="color:#fff;">Total</th>';
echo'</tr>
</thead>';	
$stmt=$mysql->prepare($qq);
$stmt->execute();
$paginationData=$stmt->fetchAll();
$cnt=1;
$a=$b=$c=$d=$e=0;	
$lcount=count($loc);
foreach ($paginationData as $row) 
{	
	//$id=$row['ID'];
	echo'<tr style="color:#000;font-weight:600;">';
	echo '<td style="background-color:#0d69f445;color:#000">'.$row['focus_code'].'</td>';
	echo '<td style="background-color:#0d69f445;color:#000">'.$row['sage_code'].'</td>';
	echo '<td style="background-color:#0d69f445;color:#000">'.$row['desp'].'</td>';

	$tot=0;
	for($i=0;$i<$lcount;$i++)
	{
		$qqq="SELECT r.focus_code,r.sage_code,r.description,ru.uom,SUM(a.stk_qty) AS stk FROM stock_tbl AS a LEFT JOIN rm_master AS r ON a.itemId=r.rmId LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID WHERE a.sts!='2' AND r.sts!='2' AND a.iType='1' AND r.focus_code='".$row['focus_code']."' AND r.sage_code='".$row['sage_code']."' AND a.locId='$loc[$i]' GROUP BY r.focus_code,r.sage_code,r.description,ru.uom";
		//if($row['focus_code']=='AC001' || $row['sage_code']=='RMSL-AC0001-000K0001')
		//echo $qqq."<Br>";
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
echo '<tfoot>
<tr style="background-color:#b02923">
<th style="color:#fff;"></th>
<th style="color:#fff"></th>
<th style="color:#fff;"></th>';

$ql="SELECT loc_code,location_name FROM location_tbl WHERE sts!='2' ".$strl." ORDER BY loc_code";	
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
echo '<th style="color:#fff;">'.$a.'</th>';
echo'</tr>
</tfoot>';
echo '</table>';
$mysql=null;
?>