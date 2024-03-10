<?php
include ("mysql.connect.php");
date_default_timezone_set('Asia/Calcutta');
set_time_limit(0);
$filename="stockRegBatchWiseEx_".date('d.m.Y H:i:s a').".xls";
$date=date('Y-m-d');
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: application/vnd.ms-excel");
$compId=$locId=$iType='0';
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

		//echo "ABCYY : ".$uloc."<Br>";

		if(empty($_GET['catId']))
		$catId="0";
		else
		$catId=$_GET['catId'];

		if(empty($_GET['brand']))
		$brand="0";
		else
		$brand=$_GET['brand'];
	
	$adparams=$compId."||".$locId."||".$iType."||".$catId."||".$brand;
	
	//echo "S Type : ".$sType." : ".$adparams."<br>";
	
	
 $whereSQL = ''; 
	
	if($compId!='0' && $locId!='0' && $iType!='0' && $catId=='0' && $brand=='0')
	{
		$whereSQL=$whereSQL." AND c.ID='$compId' AND l.ID='$locId' AND a.iType='$iType' ";
		//echo "AD-1".$whereSQL."<Br>";
	}
	else if($compId!='0' && $locId=='0' && $iType!='0' && $catId=='0' && $brand=='0')
	{
		$whereSQL=$whereSQL." AND c.ID='$compId' AND a.iType='$iType' ";
		//echo "AD-2".$whereSQL."<Br>";
	}
	else if($compId!='0' && $locId!='0' && $iType!='0' && $catId!='0' && $brand!='0')
	{
		$whereSQL=$whereSQL." AND c.ID='$compId' AND a.iType='$iType' AND l.ID='$locId' AND IF(a.iType='1',r.catId,f.category_id)='$catId' AND a.batchNo='$brand' ";
		//echo "AD-3".$whereSQL."<Br>";
	}	
	else if($compId!='0' && $locId!='0' && $iType!='0' && $catId!='0' && $brand=='0')
	{
		$whereSQL=$whereSQL." AND c.ID='$compId' AND a.iType='$iType' AND l.ID='$locId' AND IF(a.iType='1',r.catId,f.category_id)='$catId' ";
		//echo "AD-4".$whereSQL."<Br>";
	}
	else if($compId!='0' && $locId!='0' && $iType!='0' && $catId=='0' && $brand!='0')
	{
		$whereSQL=$whereSQL." AND c.ID='$compId' AND a.iType='$iType' AND l.ID='$locId' AND a.batchNo='$brand' ";
		//echo "AD-5".$whereSQL."<Br>";
	}
	else if($compId!='0' && $locId=='0' && $iType!='0' && $catId!='0' && $brand!='0')
	{
		$whereSQL=$whereSQL." AND c.ID='$compId' AND a.iType='$iType' AND IF(a.iType='1',r.catId,f.category_id)='$catId' AND a.batchNo='$brand' ";
		//echo "AD-6".$whereSQL."<Br>";
	}
	else if($compId!='0' && $locId=='0' && $iType!='0' && $catId!='0' && $brand=='0')
	{
		$whereSQL=$whereSQL." AND c.ID='$compId' AND a.iType='$iType' AND IF(a.iType='1',r.catId,f.category_id)='$catId' ";
		//echo "AD-7".$whereSQL."<Br>";
	}
	else if($compId!='0' && $locId=='0' && $iType!='0' && $catId=='0' && $brand!='0')
	{
		$whereSQL=$whereSQL." AND c.ID='$compId' AND a.iType='$iType' AND a.batchNo='$brand' ";
		//echo "AD-8".$whereSQL."<Br>";
	}	
	else if($compId!='0' && $locId=='0' && $iType=='0' && $catId=='0' && $brand=='0')
	{
		$whereSQL=$whereSQL." AND c.ID='$compId' ";
		//echo "AD-9".$whereSQL."<Br>";
	}		
	else if($compId=='0' && $locId=='0' && $iType!='0' && $catId=='0' && $brand=='0')
	{
		$whereSQL=$whereSQL." AND a.iType='$iType' ";
		//echo "AD-10".$whereSQL."<Br>";
	}	
	else if($compId=='0' && $locId=='0' && $iType=='0' && $catId=='0' && $brand!='0')
	{
		$whereSQL=$whereSQL." AND a.batchNo='$brand' ";
		//echo "AD-11".$whereSQL."<Br>";
	}			
	else 
	{
		$whereSQL=$whereSQL." ";
		//echo "AD-12".$whereSQL."<Br>";
	}
	
	
    if(!empty($_GET['srch']))
	{ 
        /*$whereSQL = " WHERE (first_name LIKE '%".$_GET['srch']."%' OR last_name LIKE '%".$_GET['srch']."%' OR email LIKE '%".$_GET['srch']."%' OR country LIKE '%".$_GET['srch']."%') "; */
		$whereSQL=$whereSQL." AND (
      IF(a.iType='1',rc.category_nm LIKE '%".$_GET['srch']."%',fc.category_nm LIKE '%".$_GET['srch']."%') OR
      IF(a.iType='1',r.sage_code LIKE '%".$_GET['srch']."%',f.sage_code LIKE '%".$_GET['srch']."%') OR
      IF(a.iType='1',r.focus_code LIKE '%".$_GET['srch']."%',f.focus_code LIKE '%".$_GET['srch']."%') OR 
      IF(a.iType='1',r.description LIKE '%".$_GET['srch']."%',f.descc LIKE '%".$_GET['srch']."%') OR 
      IF(a.iType='1',ru.uom LIKE '%".$_GET['srch']."%',fu.uom LIKE '%".$_GET['srch']."%') OR 
      IF(a.iType='1',r.reorder_level_qty LIKE '%".$_GET['srch']."%',f.reorder_level_qty LIKE '%".$_GET['srch']."%') OR 
      IF(a.iType='1',r.product_expiry LIKE '%".$_GET['srch']."%',f.product_expiry LIKE '%".$_GET['srch']."%') OR 
      IF(a.iType='1',r.rackNo LIKE '%".$_GET['srch']."%',f.rackNo LIKE '%".$_GET['srch']."%') OR 
      CONCAT(c.company_code,' - ',c.company_name) LIKE '%".$_GET['srch']."%' OR 
      CONCAT(l.loc_code,' - ',l.location_name) LIKE '%".$_GET['srch']."%' OR a.batchNo LIKE '%".$_GET['srch']."%') ";
    } 
	
	//echo $whereSQL."<Br>";

	/*echo "role:".$uRole." : ".$uiType.'<br>';
	var_dump($uRole=='admin' && ($uiType=='3' || $uiType=='0'));
echo "<Br>";*/
	
if($uRole=='admin' && ($uiType=='3' || $uiType=='0'))
{
	$qq="SELECT a.compId,a.locId,l.loc_code,l.location_name AS locNm,IF(a.iType='1','RAW MATERIAL','FINISHED GOODS') AS iTypeNm,a.iType,a.itemId,IF(a.iType='1',r.focus_code,f.focus_code)AS fc,IF(a.iType='1',r.sage_code,f.sage_code)AS sg,IF(a.iType='1',r.description,f.descc)AS desp,IF(a.iType='1',rc.category_nm,fc.category_nm)AS catName,a.batchNo,SUM(a.openstk) AS opstk,SUM(a.in_qty) AS inq,SUM(a.out_qty)oq,SUM(a.lock_qty) AS lq,((SUM(a.in_qty+a.openstk))-SUM((a.out_qty+a.lock_qty))) AS stk, IF(a.iType='1',r.reorder_level_qty,f.reorder_level_qty)AS reord,IF(a.iType='1',r.rackNo,f.rackNo)AS rack FROM stock_tbl_2 AS a LEFT JOIN location_tbl AS l ON a.locId=l.ID LEFT JOIN rm_master AS r ON a.itemId=r.rmId LEFT JOIN category_master AS rc ON r.catId=rc.catId LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID LEFT JOIN fg_master AS f ON a.itemId=f.fgId LEFT JOIN category_master AS fc ON f.category_id=fc.catId LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID LEFT JOIN company_tbl AS c ON a.compId=c.ID WHERE a.sts!='2' ".$whereSQL." GROUP BY a.compId,a.locId,a.iType,a.itemId,a.batchNo,IF(a.iType='1','RAW MATERIAL','FINISHED GOODS'),IF(a.iType='1',r.focus_code,f.focus_code),IF(a.iType='1',r.sage_code,f.sage_code),IF(a.iType='1',r.description,f.descc),IF(a.iType='1',rc.category_nm,fc.category_nm), IF(a.iType='1',r.reorder_level_qty,f.reorder_level_qty),IF(a.iType='1',r.rackNo,f.rackNo) ORDER BY a.itemId";
	//echo "A : ".$qq."<br>".$qqq."<Br>";
}
else
{
	$qq="SELECT a.compId,a.locId,l.loc_code,l.location_name AS locNm,IF(a.iType='1','RAW MATERIAL','FINISHED GOODS') AS iTypeNm,a.iType,a.itemId,IF(a.iType='1',r.focus_code,f.focus_code)AS fc,IF(a.iType='1',r.sage_code,f.sage_code)AS sg,IF(a.iType='1',r.description,f.descc)AS desp,IF(a.iType='1',rc.category_nm,fc.category_nm)AS catName,a.batchNo,SUM(a.openstk) AS opstk,SUM(a.in_qty) AS inq,SUM(a.out_qty)oq,SUM(a.lock_qty) AS lq,((SUM(a.in_qty+a.openstk))-SUM((a.out_qty+a.lock_qty))) AS stk, IF(a.iType='1',r.reorder_level_qty,f.reorder_level_qty)AS reord,IF(a.iType='1',r.rackNo,f.rackNo)AS rack FROM stock_tbl_2 AS a LEFT JOIN location_tbl AS l ON a.locId=l.ID LEFT JOIN rm_master AS r ON a.itemId=r.rmId LEFT JOIN category_master AS rc ON r.catId=rc.catId LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID LEFT JOIN fg_master AS f ON a.itemId=f.fgId LEFT JOIN category_master AS fc ON f.category_id=fc.catId LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID LEFT JOIN company_tbl AS c ON a.compId=c.ID LEFT JOIN admin_usr_loc AS u ON l.ID=u.locId WHERE a.sts!='2' ".$whereSQL." AND u.uid='$uId' AND a.sts!='2' GROUP BY a.compId,a.locId,a.iType,a.itemId,a.batchNo,IF(a.iType='1','RAW MATERIAL','FINISHED GOODS'),IF(a.iType='1',r.focus_code,f.focus_code),IF(a.iType='1',r.sage_code,f.sage_code),IF(a.iType='1',r.description,f.descc),IF(a.iType='1',rc.category_nm,fc.category_nm), IF(a.iType='1',r.reorder_level_qty,f.reorder_level_qty),IF(a.iType='1',r.rackNo,f.rackNo) ORDER BY a.itemId";
}
//echo $qq."<Br>";
echo '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" border="1">
<thead>
<tr style="background-color:#b02923">
<th style="color:#fff;">Location</th>
<th style="color:#fff;">Focus Code</th>
<th style="color:#fff">Sage Code</th>
<th style="color:#fff;">Product</th>
<th style="color:#fff;">Batch / Lot No.</th>
<th style="color:#fff">Opening Stock</th>
<th style="color:#fff;">IN</th>
<th style="color:#fff">OUT</th>
<th style="color:#fff;">Lock Qty</th>
<th style="color:#fff;">Avail. Stock</th>
<th style="color:#fff">Re - Order Level</th>
<th style="color:#fff">Re - Order Req.</th>
<th style="color:#fff">Rack No.</th>
</tr>
</thead>';
$cnt=1;
$a=$b=$c=$d=$e=0;	
$stmt=$mysql->prepare($qq);
$stmt->execute();
$paginationData=$stmt->fetchAll();
foreach ($paginationData as $row) 
{
	//$id=$row['ID'];

	$loc_id=$row['locId'];
	if($uRole=='admin' || $uiType=='3')
	{
		$a=$a+$row['opstk'];
	$b=$b+$row['inq'];
	$c=$c+$row['oq'];
	$d=$d+$row['lq'];
	$e=$e+$row['stk'];

	if($row['iType']=='1')
	{
		echo'<tr style="color:#000;font-weight:600;">';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['loc_code'].' - '.$row['locNm'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['fc'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['sg'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['desp'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['batchNo'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['opstk'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['inq'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['oq'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['lq'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['stk'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['reord'].'</td>';
		if($row['stk']<$row['reord'])
		{
		  echo '<td style="background-color:#0d69f445;color:#F00;font-weight:bold;">Yes</td>';
		}
		else
		{
		  echo '<td style="background-color:#0d69f445;color:#000">No</td>';  
		}
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['rack'].'</td>';
		echo '</tr>';  
	}
	else
	{
		echo'<tr style="color:#000;font-weight:600;">';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['loc_code'].' - '.$row['locNm'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['fc'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['sg'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['desp'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['batchNo'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['opstk'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['inq'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['oq'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['lq'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['stk'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['reord'].'</td>';
		if($row['stk']<$row['reord'])
		{
		  echo '<td style="background-color:#f4b80d61;color:#F00;font-weight:bold;">Yes</td>';
		}
		else
		{
		  echo '<td style="background-color:#f4b80d61;color:#000">No</td>';  
		}
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['rack'].'</td>';
		echo '</tr>';  
	}				  
	$cnt++;	
	}
	else
    {        
      $a=$a+$row['opstk'];
	$b=$b+$row['inq'];
	$c=$c+$row['oq'];
	$d=$d+$row['lq'];
	$e=$e+$row['stk'];

	if($row['iType']=='1')
	{
		echo'<tr style="color:#000;font-weight:600;">';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['loc_code'].' - '.$row['locNm'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['fc'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['sg'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['desp'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['batchNo'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['opstk'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['inq'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['oq'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['lq'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['stk'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['reord'].'</td>';
		if($row['stk']<$row['reord'])
		{
		  echo '<td style="background-color:#0d69f445;color:#F00;font-weight:bold;">Yes</td>';
		}
		else
		{
		  echo '<td style="background-color:#0d69f445;color:#000">No</td>';  
		}
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['rack'].'</td>';
		echo '</tr>';  
	}
	else
	{
		echo'<tr style="color:#000;font-weight:600;">';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['loc_code'].' - '.$row['locNm'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['fc'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['sg'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['desp'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['batchNo'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['opstk'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['inq'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['oq'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['lq'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['stk'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['reord'].'</td>';
		if($row['stk']<$row['reord'])
		{
		  echo '<td style="background-color:#f4b80d61;color:#F00;font-weight:bold;">Yes</td>';
		}
		else
		{
		  echo '<td style="background-color:#f4b80d61;color:#000">No</td>';  
		}
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['rack'].'</td>';
		echo '</tr>';  
	}				  
	$cnt++;	
	}
}
echo '<tfoot>
<tr style="background-color:#b02923">
<th style="color:#fff"></th>
<th style="color:#fff;"></th>
<th style="color:#fff"></th>
<th style="color:#fff"></th>
<th style="color:#fff"></th>
<th style="color:#fff;">Total</th>
<th style="color:#fff">'.$b.'</th>
<th style="color:#fff;">'. $c.'</th>
<th style="color:#fff">'. $d.'</th>
<th style="color:#fff;">'.$e.'</th>
<th style="color:#fff;"></th>
<th style="color:#fff"></th>
<th style="color:#fff"></th>
</tr>
</tfoot>';
echo '</table>';
$mysql=null;
?>