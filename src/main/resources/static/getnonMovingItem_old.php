<?php
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

if(empty($_GET['srch']))
$srch="0";
else
$srch=$_GET['srch'];

	
if(empty($_GET['fdt']))
$fdt="0";
else
$fdt=$_GET['fdt'];

if(empty($_GET['tdt']))
$tdt="0";
else
$tdt=$_GET['tdt'];

//echo $locId."<Br>";
	
if($locId==0)
{
	$lcnt=0;
	if( strpos( $uloc, ',' ) !== false )
	{
		$locId=explode(',',$uloc);
		$lcnt=count($locId);
	}
	else
	{
		$locId=$uloc;
		if($uloc!='0')
		$lcnt=1;
	}
}
else
{
	$lcnt=1;
}

$rep_tp=$_GET['rep_tp'];

include('mysql.connect.php');
$str=$str2=$str3="";


if($lcnt==1)
{	
	if($compId!='0' && $locId!='0' && $srch=='0' && $iType!='0' && $fdt=='0' && $tdt=='0')
	{
		$str=$str." AND a.compId='$compId' AND l.ID='$locId' AND a.iType='$iType' ";
		
		$str2=$str2."";
		
		$str3=$str3."";
		//echo "Aa-1 : ".$str."<br>";
	}
	else if($compId!='0' && $locId!='0' && $srch!='0' && $iType!='0' && $fdt=='0' && $tdt=='0')
	{
        $str=$str." AND a.compId='$compId' AND l.ID='$locId'  AND a.iType='$iType' ";
		
		$str2=$str2." AND (r.focus_code LIKE '%".$srch."%' OR r.sage_code LIKE '%".$srch."%' OR rc.category_nm LIKE '%".$srch."%' OR r.description LIKE '%".$srch."%' OR ru.uom LIKE '%".$srch."%') ";
		
		$str3=$str3." AND (f.focus_code LIKE '%".$srch."%' OR f.sage_code LIKE '%".$srch."%' OR fc.category_nm LIKE '%".$srch."%' OR f.descc LIKE '%".$srch."%' OR fu.uom LIKE '%".$srch."%') ";
		//echo "Aa-2 : ".$str."<br>";
	}	
	else if($compId!='0' && $locId=='0' && $srch!='0' && $iType!='0' && $fdt=='0' && $tdt=='0')
	{
      	$str=$str." AND a.compId='$compId' AND a.iType='$iType' ";
		
		$str2=$str2." AND (r.focus_code LIKE '%".$srch."%' OR r.sage_code LIKE '%".$srch."%' OR rc.category_nm LIKE '%".$srch."%' OR r.description LIKE '%".$srch."%' OR ru.uom LIKE '%".$srch."%') ";
		
		$str3=$str3." AND (f.focus_code LIKE '%".$srch."%' OR f.sage_code LIKE '%".$srch."%' OR fc.category_nm LIKE '%".$srch."%' OR f.descc LIKE '%".$srch."%' OR fu.uom LIKE '%".$srch."%') ";
		//echo "Aa-3 : ".$str."<br>";
	}	
	else if($compId!='0' && $locId=='0' && $srch!='0' && $iType=='0' && $fdt=='0' && $tdt=='0')
	{
      	$str=$str." AND a.compId='$compId' ";
		
		$str2=$str2." AND (r.focus_code LIKE '%".$srch."%' OR r.sage_code LIKE '%".$srch."%' OR rc.category_nm LIKE '%".$srch."%' OR r.description LIKE '%".$srch."%' OR ru.uom LIKE '%".$srch."%') ";
		
		$str3=$str3." AND (f.focus_code LIKE '%".$srch."%' OR f.sage_code LIKE '%".$srch."%' OR fc.category_nm LIKE '%".$srch."%' OR f.descc LIKE '%".$srch."%' OR fu.uom LIKE '%".$srch."%') ";
		//echo "Aa-4 : ".$str."<br>";
	}	
	else if($compId!='0' && $locId=='0' && $srch=='0' && $iType!='0' && $fdt=='0' && $tdt=='0')
	{
		$str=$str." AND a.compId='$compId' AND a.iType='$iType' ";
		
		$str2=$str2."";
		
		$str3=$str3."";
		//echo "Aa-5 : ".$str."<br>";
	}
	else if($compId!='0' && $locId!='0' && $srch=='0' && $iType!='0' && $fdt!='0' && $tdt!='0')
	{
		$str=$str." AND a.compId='$compId' AND l.ID='$locId' AND a.iType='$iType' AND (b.dt BETWEEN '$fdt' AND '$tdt') ";
		
		$str2=$str2."";
		
		$str3=$str3."";
		//echo "Aa-1 : ".$str."<br>";
	}
	else if($compId!='0' && $locId!='0' && $srch!='0' && $iType!='0' && $fdt!='0' && $tdt!='0')
	{
      $str=$str." AND a.compId='$compId' AND l.ID='$locId'  AND a.iType='$iType' AND (b.dt BETWEEN '$fdt' AND '$tdt') ";
		
		$str2=$str2." AND (r.focus_code LIKE '%".$srch."%' OR r.sage_code LIKE '%".$srch."%' OR rc.category_nm LIKE '%".$srch."%' OR r.description LIKE '%".$srch."%' OR ru.uom LIKE '%".$srch."%') ";
		
		$str3=$str3." AND (f.focus_code LIKE '%".$srch."%' OR f.sage_code LIKE '%".$srch."%' OR fc.category_nm LIKE '%".$srch."%' OR f.descc LIKE '%".$srch."%' OR fu.uom LIKE '%".$srch."%') ";
		//echo "Aa-2 : ".$str."<br>";
	}	
	else if($compId!='0' && $locId=='0' && $srch!='0' && $iType!='0' && $fdt!='0' && $tdt!='0')
	{
      	$str=$str." AND a.compId='$compId' AND a.iType='$iType' AND (b.dt BETWEEN '$fdt' AND '$tdt') ";
		
		$str2=$str2." AND (r.focus_code LIKE '%".$srch."%' OR r.sage_code LIKE '%".$srch."%' OR rc.category_nm LIKE '%".$srch."%' OR r.description LIKE '%".$srch."%' OR ru.uom LIKE '%".$srch."%') ";
		
		$str3=$str3." AND (f.focus_code LIKE '%".$srch."%' OR f.sage_code LIKE '%".$srch."%' OR fc.category_nm LIKE '%".$srch."%' OR f.descc LIKE '%".$srch."%' OR fu.uom LIKE '%".$srch."%') ";
		//echo "Aa-3 : ".$str."<br>";
	}	
	else if($compId!='0' && $locId=='0' && $srch!='0' && $iType=='0' && $fdt!='0' && $tdt!='0')
	{
      	$str=$str." AND a.compId='$compId'  AND (b.dt BETWEEN '$fdt' AND '$tdt') ";
		
		$str2=$str2." AND (r.focus_code LIKE '%".$srch."%' OR r.sage_code LIKE '%".$srch."%' OR rc.category_nm LIKE '%".$srch."%' OR r.description LIKE '%".$srch."%' OR ru.uom LIKE '%".$srch."%') ";
		
		$str3=$str3." AND (f.focus_code LIKE '%".$srch."%' OR f.sage_code LIKE '%".$srch."%' OR fc.category_nm LIKE '%".$srch."%' OR f.descc LIKE '%".$srch."%' OR fu.uom LIKE '%".$srch."%') ";
		//echo "Aa-4 : ".$str."<br>";
	}	
	else if($compId!='0' && $locId=='0' && $srch=='0' && $iType!='0' && $fdt!='0' && $tdt!='0')
	{
		$str=$str." AND a.compId='$compId' AND a.iType='$iType'  AND (b.dt BETWEEN '$fdt' AND '$tdt') ";
		
		$str2=$str2."";
		
		$str3=$str3."";
		//echo "Aa-5 : ".$str."<br>";
	}	
	else if($compId!='0' && $locId=='0' && $srch=='0' && $iType=='0' && $fdt!='0' && $tdt!='0')
	{
		$str=$str." AND a.compId='$compId' AND (b.dt BETWEEN '$fdt' AND '$tdt') ";
		
		$str2=$str2."";
		
		$str3=$str3."";
		//echo "Aa-5 : ".$str."<br>";
	}
	else 
	{
		$str=$str." AND a.compId='$compId'";
		
		$str2=$str2."";
		
		$str3=$str3."";
		//echo "Aa-6 : ".$str."<br>";
	}
	
	//echo "<Br>";
	
    if($uRole=='admin' && ($uiType=='3' || $uiType=='0'))
	{
		$qq="SELECT a.ID,a.compId,a.locId,l.loc_code,l.location_name AS locNm,a.iType,a.itemId,SUM(b.in_qty+b.openstk) AS in_qty,SUM(a.stk_qty) AS stk_qty FROM stock_tbl AS a LEFT JOIN stock_tbl_2 AS b ON a.ID=b.stkId LEFT JOIN location_tbl AS l ON a.locId=l.ID WHERE a.in_qty=a.stk_qty AND (a.out_qty='0' OR a.lock_qty='0') ".$str." GROUP BY a.ID,a.compId,a.locId,a.iType,a.itemId ORDER BY SUM(a.stk_qty) DESC";
		//echo "A : ".$qq."<br>";
	}
	else
	{
		$qq="SELECT a.ID,a.compId,a.locId,l.loc_code,l.location_name AS locNm,a.iType,a.itemId,SUM(b.in_qty+b.openstk) AS in_qty,SUM(a.stk_qty) AS stk_qty FROM stock_tbl AS a LEFT JOIN stock_tbl_2 AS b ON a.ID=b.stkId LEFT JOIN location_tbl AS l ON a.locId=l.ID LEFT JOIN admin_usr_loc AS u ON l.ID=u.locId WHERE u.uid='$uId' AND a.in_qty=a.stk_qty AND (a.out_qty='0' OR a.lock_qty='0') ".$str." GROUP BY a.ID,a.compId,a.locId,a.iType,a.itemId ORDER BY SUM(a.stk_qty) DESC";
		//echo "B : ".$qq."<br>";
	}
	//echo "B : ".$qq."<br>";
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
	if($compId!='0' && $srch!='0' && $iType!='0' && $fdt=='0' && $tdt=='0')
	{
        $str=$str." AND a.compId='$compId' AND a.iType='$iType' ";
		
		$str2=$str2." AND (r.focus_code LIKE '%".$srch."%' OR r.sage_code LIKE '%".$srch."%' OR rc.category_nm LIKE '%".$srch."%' OR r.description LIKE '%".$srch."%' OR ru.uom LIKE '%".$srch."%') ";
		
		$str3=$str3." AND (f.focus_code LIKE '%".$srch."%' OR f.sage_code LIKE '%".$srch."%' OR fc.category_nm LIKE '%".$srch."%' OR f.descc LIKE '%".$srch."%' OR fu.uom LIKE '%".$srch."%') ";
	  //echo "AA-1 : ".$str."<br>";
	}
	else if($compId!='0' && $srch!='0' && $iType=='0' && $fdt=='0' && $tdt=='0')
	{
      	$str=$str." AND a.compId='$compId' ";
		
		$str2=$str2." AND (r.focus_code LIKE '%".$srch."%' OR r.sage_code LIKE '%".$srch."%' OR rc.category_nm LIKE '%".$srch."%' OR r.description LIKE '%".$srch."%' OR ru.uom LIKE '%".$srch."%') ";
		
		$str3=$str3." AND (f.focus_code LIKE '%".$srch."%' OR f.sage_code LIKE '%".$srch."%' OR fc.category_nm LIKE '%".$srch."%' OR f.descc LIKE '%".$srch."%' OR fu.uom LIKE '%".$srch."%') ";
	  //echo "AA-2 : ".$str."<br>";
	}
	else if($compId!='0' && $srch=='0' && $iType!='0' && $fdt=='0' && $tdt=='0')
	{
      	$str=$str." AND a.compId='$compId' AND a.iType='$iType' ";
		
		$str2=$str2."";
		
		$str3=$str3."";
	  //echo "AA-3 : ".$str."<br>";
	}
	else if($compId!='0' && $srch!='0' && $iType!='0' && $fdt!='0' && $tdt!='0')
	{
      	$str=$str." AND a.compId='$compId' AND a.iType='$iType' AND (b.dt BETWEEN '$fdt' AND '$tdt') ";
		
		$str2=$str2." AND (r.focus_code LIKE '%".$srch."%' OR r.sage_code LIKE '%".$srch."%' OR rc.category_nm LIKE '%".$srch."%' OR r.description LIKE '%".$srch."%' OR ru.uom LIKE '%".$srch."%') ";
		
		$str3=$str3." AND (f.focus_code LIKE '%".$srch."%' OR f.sage_code LIKE '%".$srch."%' OR fc.category_nm LIKE '%".$srch."%' OR f.descc LIKE '%".$srch."%' OR fu.uom LIKE '%".$srch."%') ";
	  //echo "AA-1 : ".$str."<br>";
	}
	else if($compId!='0' && $srch!='0' && $iType=='0' && $fdt!='0' && $tdt!='0')
	{
      	$str=$str." AND a.compId='$compId' AND (b.dt BETWEEN '$fdt' AND '$tdt') ";
		
		$str2=$str2." AND (r.focus_code LIKE '%".$srch."%' OR r.sage_code LIKE '%".$srch."%' OR rc.category_nm LIKE '%".$srch."%' OR r.description LIKE '%".$srch."%' OR ru.uom LIKE '%".$srch."%') ";
		
		$str3=$str3." AND (f.focus_code LIKE '%".$srch."%' OR f.sage_code LIKE '%".$srch."%' OR fc.category_nm LIKE '%".$srch."%' OR f.descc LIKE '%".$srch."%' OR fu.uom LIKE '%".$srch."%') ";
	  //echo "AA-2 : ".$str."<br>";
	}
	else if($compId!='0' && $srch=='0' && $iType!='0' && $fdt!='0' && $tdt!='0')
	{
      	$str=$str." AND a.compId='$compId' AND a.iType='$iType'  AND (b.dt BETWEEN '$fdt' AND '$tdt') ";
		
		$str2=$str2."";
		
		$str3=$str3."";
	  //echo "AA-3 : ".$str."<br>";
	}
	else if($compId!='0' && $srch=='0' && $iType=='0' && $fdt!='0' && $tdt!='0')
	{
      	$str=$str." AND a.compId='$compId' AND (b.dt BETWEEN '$fdt' AND '$tdt') ";
		
		$str2=$str2."";
		
		$str3=$str3."";
	  //echo "AA-3 : ".$str."<br>";
	}
	else 
	{
		$str=$str." AND a.compId='$compId'";
		
		$str2=$str2."";
		
		$str3=$str3."";
	  //echo "AA-4 : ".$str."<br>";
	}
	
	//echo "<Br>";
	
	if($compId=='0')
	{
		$qq="SELECT a.ID,a.compId,a.locId,l.loc_code,l.location_name AS locNm,a.iType,a.itemId,SUM(b.in_qty+b.openstk) AS in_qty,SUM(a.stk_qty) AS stk_qty FROM stock_tbl AS a LEFT JOIN stock_tbl_2 AS b ON a.ID=b.stkId LEFT JOIN location_tbl AS l ON a.locId=l.ID WHERE a.in_qty=a.stk_qty AND (a.out_qty='0' OR a.lock_qty='0') GROUP BY a.ID,a.compId,a.locId,a.iType,a.itemId ORDER BY SUM(a.stk_qty) DESC";
	  //echo "AAC : ".$qq."<br>";
	}
	else
	{
		if($uRole=='admin' && ($uiType=='3' || $uiType=='0'))
		{
			$qq="SELECT a.ID,a.compId,a.locId,l.loc_code,l.location_name AS locNm,a.iType,a.itemId,SUM(b.in_qty+b.openstk) AS in_qty,SUM(a.stk_qty) AS stk_qty FROM stock_tbl AS a LEFT JOIN stock_tbl_2 AS b ON a.ID=b.stkId LEFT JOIN location_tbl AS l ON a.locId=l.ID WHERE a.in_qty=a.stk_qty AND (a.out_qty='0' OR a.lock_qty='0') ".$str." GROUP BY a.ID,a.compId,a.locId,a.iType,a.itemId ORDER BY SUM(a.stk_qty) DESC";
	  		//echo "AABB : ".$qq."<br>";
		}
		else
		{
			$qq="SELECT a.ID,a.compId,a.locId,l.loc_code,l.location_name AS locNm,a.iType,a.itemId,SUM(b.in_qty+b.openstk) AS in_qty,SUM(a.stk_qty) AS stk_qty FROM stock_tbl AS a LEFT JOIN stock_tbl_2 AS b ON a.ID=b.stkId LEFT JOIN location_tbl AS l ON a.locId=l.ID LEFT JOIN admin_usr_loc AS u ON l.ID=u.locId WHERE u.uid='$userId' AND a.in_qty=a.stk_qty AND (a.out_qty='0' OR a.lock_qty='0') ".$str." GROUP BY a.ID,a.compId,a.locId,a.iType,a.itemId ORDER BY SUM(a.stk_qty) DESC";
	  //echo "AAB : ".$qq."<br>";
		}
	}
	//echo "hhh : ".$qq."<br>";
	
	include('shripage.php');
    $totalRecordsPerPage=500;
    $paginationData=pagination_records($totalRecordsPerPage,$qq);
    //print_r($paginationData);
    $sn=pagination_records_counter($totalRecordsPerPage);
    $cnt=$sn;	
    $pagination=pagination($totalRecordsPerPage,$qq);
}

?>
<div class="pagination">    
<?php echo $pagination; ?>
</div>	
<table class="table table-bordered" id="dataTable" cellspacing="0">
<thead>
<tr style="background-color:#b02923">
<th style="color:#fff;">Location</th>
<th style="color:#fff;">Focus Code</th>
<th style="color:#fff">Sage Code</th>
<th style="color:#fff;">Product</th>
<th style="color:#fff;">Stock Qty</th>
</tr>
</thead>
<?php
$a=$b=$c=$d=$e=0;	
foreach ($paginationData as $row) 
{
	//$id=$row['ID'];	
	if($row['iType']=='1')
	{
		$qi="SELECT r.focus_code AS fc,r.sage_code AS sg,rc.category_nm AS catNm,r.description AS desp,ru.uom AS uom FROM rm_master AS r LEFT JOIN category_master AS rc ON r.catId=rc.catId LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID WHERE location_id='".$row['locId']."' AND rmId='".$row['itemId']."' ".$str2." AND r.sts='0' ";
		//echo "iType : 1 = ".$qi."<Br>";
		$si=$mysql->prepare($qi);
		$si->execute();
		$rowi=$si->fetch(PDO::FETCH_ASSOC);
		if(!empty($rowi['fc']))
		{
			echo'<tr style="color:#000;font-weight:600;">';
			echo '<td style="background-color:#0d69f445;color:#000">'.$row['locNm'].'</td>';
			echo '<td style="background-color:#0d69f445;color:#000">'.$rowi['fc'].'</td>';
			echo '<td style="background-color:#0d69f445;color:#000">'.$rowi['sg'].'</td>';
			echo '<td style="background-color:#0d69f445;color:#000">'.$rowi['desp'].'</td>';
			/*echo '<td style="background-color:#0d69f445;color:#000">'.$row['openstk'].'</td>';*/
			echo '<td style="background-color:#0d69f445;color:#000">'.$row['stk_qty'].'</td>';		
			echo '</tr>';  
		}
	}
	else
	{
		$qi="SELECT f.focus_code AS fc,f.sage_code AS sg,fc.category_nm AS catNm,f.descc AS desp,fu.uom AS uom FROM fg_master AS f LEFT JOIN category_master AS fc ON f.category_id=fc.catId LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID WHERE location_id='".$row['locId']."' AND fgId='".$row['itemId']."' ".$str3." AND f.sts='0'";
		//echo "iType : 2 = ".$qi."<Br>";
		$si=$mysql->prepare($qi);
		$si->execute();
		$rowi=$si->fetch(PDO::FETCH_ASSOC);
		if(!empty($rowi['fc']))
		{
			echo'<tr style="color:#000;font-weight:600;">';
			echo '<td style="background-color:#f4b80d61;color:#000">'.$row['locNm'].'</td>';
			echo '<td style="background-color:#f4b80d61;color:#000">'.$rowi['fc'].'</td>';
			echo '<td style="background-color:#f4b80d61;color:#000">'.$rowi['sg'].'</td>';
			echo '<td style="background-color:#f4b80d61;color:#000">'.$rowi['desp'].'</td>';
			/*echo '<td style="background-color:#f4b80d61;color:#000">'.$row['openstk'].'</td>';*/
			echo '<td style="background-color:#f4b80d61;color:#000">'.$row['stk_qty'].'</td>';		
			echo '</tr>';  
		}
	}				  
	$cnt++;	
}	
$mysql=null;	
?>
</table>
<div class="pagination">    
<?php echo $pagination; ?>
</div>	