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
$str="";
if($lcnt=='1')
{
	if($compId!='0' && $locId!='0' && $srch=='0' && $iType!='0' && $fdt=='0' && $tdt=='0')
	{
		$str=$str." AND c.ID='$compId' AND l.ID='$locId' AND a.iType='$iType' ";
		//echo "Aa-1 : ".$str."<br>";
	}
	else if($compId!='0' && $locId!='0' && $srch!='0' && $iType!='0' && $fdt=='0' && $tdt=='0')
	{
      $str=$str." AND c.ID='$compId' AND l.ID='$locId'  AND a.iType='$iType' AND (l.loc_code LIKE '%".$srch."%' OR l.location_name LIKE '%".$srch."%' OR r.focus_code LIKE '%".$srch."%'
  OR f.focus_code LIKE '%".$srch."%' OR r.sage_code LIKE '%".$srch."%' OR f.sage_code LIKE '%".$srch."%'
  OR rg.category_nm LIKE '%".$srch."%' OR r.description LIKE '%".$srch."%' OR ru.uom LIKE '%".$srch."%'
  OR fgg.category_nm LIKE '%".$srch."%' OR f.brand LIKE '%".$srch."%' OR f.descc LIKE '%".$srch."%' OR
  fu.uom LIKE '%".$srch."%')";
		//echo "Aa-2 : ".$str."<br>";
	}	
	else if($compId!='0' && $locId=='0' && $srch!='0' && $iType!='0' && $fdt=='0' && $tdt=='0')
	{
      $str=$str." AND c.ID='$compId' AND a.iType='$iType' AND (l.loc_code LIKE '%".$srch."%' OR l.location_name LIKE '%".$srch."%' OR r.focus_code LIKE '%".$srch."%'
  OR f.focus_code LIKE '%".$srch."%' OR r.sage_code LIKE '%".$srch."%' OR f.sage_code LIKE '%".$srch."%'
  OR rg.category_nm LIKE '%".$srch."%' OR r.description LIKE '%".$srch."%' OR ru.uom LIKE '%".$srch."%'
  OR fgg.category_nm LIKE '%".$srch."%' OR f.brand LIKE '%".$srch."%' OR f.descc LIKE '%".$srch."%' OR
  fu.uom LIKE '%".$srch."%')";
		//echo "Aa-3 : ".$str."<br>";
	}	
	else if($compId!='0' && $locId=='0' && $srch!='0' && $iType=='0' && $fdt=='0' && $tdt=='0')
	{
      $str=$str." AND c.ID='$compId' AND (l.loc_code LIKE '%".$srch."%' OR l.location_name LIKE '%".$srch."%')";
		//echo "Aa-4 : ".$str."<br>";
	}	
	else if($compId!='0' && $locId=='0' && $srch=='0' && $iType!='0' && $fdt=='0' && $tdt=='0')
	{
		$str=$str." AND c.ID='$compId' AND a.iType='$iType' ";
		//echo "Aa-5 : ".$str."<br>";
	}
	else if($compId!='0' && $locId!='0' && $srch=='0' && $iType!='0' && $fdt!='0' && $tdt!='0')
	{
		$str=$str." AND c.ID='$compId' AND l.ID='$locId' AND a.iType='$iType' AND (a.dt BETWEEN '$fdt' AND '$tdt') ";
		//echo "Aa-1 : ".$str."<br>";
	}
	else if($compId!='0' && $locId!='0' && $srch!='0' && $iType!='0' && $fdt!='0' && $tdt!='0')
	{
      $str=$str." AND c.ID='$compId' AND l.ID='$locId'  AND a.iType='$iType' AND (l.loc_code LIKE '%".$srch."%' OR l.location_name LIKE '%".$srch."%' OR r.focus_code LIKE '%".$srch."%'
  OR f.focus_code LIKE '%".$srch."%' OR r.sage_code LIKE '%".$srch."%' OR f.sage_code LIKE '%".$srch."%'
  OR rg.category_nm LIKE '%".$srch."%' OR r.description LIKE '%".$srch."%' OR ru.uom LIKE '%".$srch."%'
  OR fgg.category_nm LIKE '%".$srch."%' OR f.brand LIKE '%".$srch."%' OR f.descc LIKE '%".$srch."%' OR
  fu.uom LIKE '%".$srch."%') AND (a.dt BETWEEN '$fdt' AND '$tdt') ";
		//echo "Aa-2 : ".$str."<br>";
	}	
	else if($compId!='0' && $locId=='0' && $srch!='0' && $iType!='0' && $fdt!='0' && $tdt!='0')
	{
      $str=$str." AND c.ID='$compId' AND a.iType='$iType' AND (l.loc_code LIKE '%".$srch."%' OR l.location_name LIKE '%".$srch."%' OR r.focus_code LIKE '%".$srch."%'
  OR f.focus_code LIKE '%".$srch."%' OR r.sage_code LIKE '%".$srch."%' OR f.sage_code LIKE '%".$srch."%'
  OR rg.category_nm LIKE '%".$srch."%' OR r.description LIKE '%".$srch."%' OR ru.uom LIKE '%".$srch."%'
  OR fgg.category_nm LIKE '%".$srch."%' OR f.brand LIKE '%".$srch."%' OR f.descc LIKE '%".$srch."%' OR
  fu.uom LIKE '%".$srch."%') AND (a.dt BETWEEN '$fdt' AND '$tdt') ";
		//echo "Aa-3 : ".$str."<br>";
	}	
	else if($compId!='0' && $locId=='0' && $srch!='0' && $iType=='0' && $fdt!='0' && $tdt!='0')
	{
      $str=$str." AND c.ID='$compId' AND (l.loc_code LIKE '%".$srch."%' OR l.location_name LIKE '%".$srch."%' OR r.focus_code LIKE '%".$srch."%'
  OR f.focus_code LIKE '%".$srch."%' OR r.sage_code LIKE '%".$srch."%' OR f.sage_code LIKE '%".$srch."%'
  OR rg.category_nm LIKE '%".$srch."%' OR r.description LIKE '%".$srch."%' OR ru.uom LIKE '%".$srch."%'
  OR fgg.category_nm LIKE '%".$srch."%' OR f.brand LIKE '%".$srch."%' OR f.descc LIKE '%".$srch."%' OR
  fu.uom LIKE '%".$srch."%') AND (a.dt BETWEEN '$fdt' AND '$tdt') ";
		//echo "Aa-4 : ".$str."<br>";
	}	
	else if($compId!='0' && $locId=='0' && $srch=='0' && $iType!='0' && $fdt!='0' && $tdt!='0')
	{
		$str=$str." AND c.ID='$compId' AND a.iType='$iType'  AND (a.dt BETWEEN '$fdt' AND '$tdt') ";
		//echo "Aa-5 : ".$str."<br>";
	}	
	else if($compId!='0' && $locId=='0' && $srch=='0' && $iType=='0' && $fdt!='0' && $tdt!='0')
	{
		$str=$str." AND c.ID='$compId' AND (a.dt BETWEEN '$fdt' AND '$tdt') ";
		//echo "Aa-5 : ".$str."<br>";
	}
	else 
	{
		$str=$str." AND c.ID='$compId'";
		//echo "Aa-6 : ".$str."<br>";
	}

	if($uRole=='admin' && ($uiType=='3' || $uiType=='0'))
	{
		
  		$qq="SELECT IF(a.iType='1',r.focus_code,f.focus_code) AS focus_code,
IF(a.iType='1',r.sage_code,f.sage_code) AS sage_code,
IF(a.iType='1',CONCAT(rg.category_nm,' - ',r.description,' - ',ru.uom),
CONCAT(fgg.category_nm,' - ',f.brand,' ',f.descc,' - ',fu.uom)) AS desp,
SUM(b.qty) AS OUT_QTY,
CONCAT(l.loc_code,' - ',l.location_name)AS locNm,a.iType FROM inventory_tbl AS a
LEFT JOIN `inventory_info_tbl` AS b ON a.ID=b.invId
 LEFT JOIN company_tbl AS c ON a.compId=c.ID 
 LEFT JOIN location_tbl AS l ON a.locId=l.ID 
 LEFT JOIN rm_master AS r ON b.itemId=r.rmId 
 LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID 
 LEFT JOIN fg_master AS f ON b.itemId=f.fgId 
 LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID 
 LEFT JOIN category_master AS rg ON r.catId=rg.catId 
 LEFT JOIN category_master AS fgg ON f.category_id=fgg.catId
WHERE a.sts!='2'  AND b.eType='2' AND IF(a.iType='1',r.sts!='2',f.sts!='2') ".$str." AND b.qty!='0' 
  GROUP BY IF(a.iType='1',r.focus_code,f.focus_code), IF(a.iType='1',r.sage_code,f.sage_code), IF(a.iType='1',CONCAT(rg.category_nm,' - ',r.description,' - ',ru.uom),CONCAT(fgg.category_nm,' - ',f.brand,' ',f.descc,' - ',fu.uom)), CONCAT(l.loc_code,' - ',l.location_name) ,a.iType ORDER BY SUM(b.qty) DESC
 ";

		//echo "A : ".$qq."<br>";
	}
	else
	{
		
  	$qq="SELECT IF(a.iType='1',r.focus_code,f.focus_code) AS focus_code,
IF(a.iType='1',r.sage_code,f.sage_code) AS sage_code,
IF(a.iType='1',CONCAT(rg.category_nm,' - ',r.description,' - ',ru.uom),
CONCAT(fgg.category_nm,' - ',f.brand,' ',f.descc,' - ',fu.uom)) AS desp,
SUM(b.qty) AS OUT_QTY,
CONCAT(l.loc_code,' - ',l.location_name)AS locNm,a.iType FROM inventory_tbl AS a
LEFT JOIN `inventory_info_tbl` AS b ON a.ID=b.invId
 LEFT JOIN company_tbl AS c ON a.compId=c.ID 
 LEFT JOIN location_tbl AS l ON a.locId=l.ID 
 LEFT JOIN rm_master AS r ON b.itemId=r.rmId 
 LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID 
 LEFT JOIN fg_master AS f ON b.itemId=f.fgId 
 LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID 
 LEFT JOIN category_master AS rg ON r.catId=rg.catId 
 LEFT JOIN category_master AS fgg ON f.category_id=fgg.catId 
 LEFT JOIN admin_usr_loc AS u ON l.ID=u.locId WHERE a.sts!='2' AND b.eType='2' AND  IF(a.iType='1',r.sts!='2',f.sts!='2') ".$str." AND u.uid='$uId' AND b.qty!='0' GROUP BY IF(a.iType='1',r.focus_code,f.focus_code), IF(a.iType='1',r.sage_code,f.sage_code), IF(a.iType='1',CONCAT(rg.category_nm,' - ',r.description,' - ',ru.uom),CONCAT(fgg.category_nm,' - ',f.brand,' ',f.descc,' - ',fu.uom)), CONCAT(l.loc_code,' - ',l.location_name) ,a.iType ORDER BY SUM(b.qty) DESC
 ";
	}
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
      $str=$str." AND c.ID='$compId' AND a.iType='$iType' AND (l.loc_code LIKE '%".$srch."%' OR l.location_name LIKE '%".$srch."%' OR r.focus_code LIKE '%".$srch."%'
  OR f.focus_code LIKE '%".$srch."%' OR r.sage_code LIKE '%".$srch."%' OR f.sage_code LIKE '%".$srch."%'
  OR rg.category_nm LIKE '%".$srch."%' OR r.description LIKE '%".$srch."%' OR ru.uom LIKE '%".$srch."%'
  OR fgg.category_nm LIKE '%".$srch."%' OR f.brand LIKE '%".$srch."%' OR f.descc LIKE '%".$srch."%' OR
  fu.uom LIKE '%".$srch."%')";
	  //echo "AA-1 : ".$str."<br>";
	}
	else if($compId!='0' && $srch!='0' && $iType=='0' && $fdt=='0' && $tdt=='0')
	{
      $str=$str." AND c.ID='$compId' AND (l.loc_code LIKE '%".$srch."%' OR l.location_name LIKE '%".$srch."%' OR r.focus_code LIKE '%".$srch."%'
  OR f.focus_code LIKE '%".$srch."%' OR r.sage_code LIKE '%".$srch."%' OR f.sage_code LIKE '%".$srch."%'
  OR rg.category_nm LIKE '%".$srch."%' OR r.description LIKE '%".$srch."%' OR ru.uom LIKE '%".$srch."%'
  OR fgg.category_nm LIKE '%".$srch."%' OR f.brand LIKE '%".$srch."%' OR f.descc LIKE '%".$srch."%' OR
  fu.uom LIKE '%".$srch."%')";
	  //echo "AA-2 : ".$str."<br>";
	}
	else if($compId!='0' && $srch=='0' && $iType!='0' && $fdt=='0' && $tdt=='0')
	{
      $str=$str." AND c.ID='$compId' AND a.iType='$iType' ";
	  //echo "AA-3 : ".$str."<br>";
	}
	else if($compId!='0' && $srch!='0' && $iType!='0' && $fdt!='0' && $tdt!='0')
	{
      $str=$str." AND c.ID='$compId' AND a.iType='$iType' AND (l.loc_code LIKE '%".$srch."%' OR l.location_name LIKE '%".$srch."%' OR r.focus_code LIKE '%".$srch."%'
  OR f.focus_code LIKE '%".$srch."%' OR r.sage_code LIKE '%".$srch."%' OR f.sage_code LIKE '%".$srch."%'
  OR rg.category_nm LIKE '%".$srch."%' OR r.description LIKE '%".$srch."%' OR ru.uom LIKE '%".$srch."%'
  OR fgg.category_nm LIKE '%".$srch."%' OR f.brand LIKE '%".$srch."%' OR f.descc LIKE '%".$srch."%' OR
  fu.uom LIKE '%".$srch."%') AND (a.dt BETWEEN '$fdt' AND '$tdt') ";
	  //echo "AA-1 : ".$str."<br>";
	}
	else if($compId!='0' && $srch!='0' && $iType=='0' && $fdt!='0' && $tdt!='0')
	{
      $str=$str." AND c.ID='$compId' AND (l.loc_code LIKE '%".$srch."%' OR l.location_name LIKE '%".$srch."%' OR r.focus_code LIKE '%".$srch."%'
  OR f.focus_code LIKE '%".$srch."%' OR r.sage_code LIKE '%".$srch."%' OR f.sage_code LIKE '%".$srch."%'
  OR rg.category_nm LIKE '%".$srch."%' OR r.description LIKE '%".$srch."%' OR ru.uom LIKE '%".$srch."%'
  OR fgg.category_nm LIKE '%".$srch."%' OR f.brand LIKE '%".$srch."%' OR f.descc LIKE '%".$srch."%' OR
  fu.uom LIKE '%".$srch."%') AND (a.dt BETWEEN '$fdt' AND '$tdt') ";
	  //echo "AA-2 : ".$str."<br>";
	}
	else if($compId!='0' && $srch=='0' && $iType!='0' && $fdt!='0' && $tdt!='0')
	{
      $str=$str." AND c.ID='$compId' AND a.iType='$iType'  AND (a.dt BETWEEN '$fdt' AND '$tdt') ";
	  //echo "AA-3 : ".$str."<br>";
	}
	else if($compId!='0' && $srch=='0' && $iType=='0' && $fdt!='0' && $tdt!='0')
	{
      $str=$str." AND c.ID='$compId' AND (a.dt BETWEEN '$fdt' AND '$tdt') ";
	  //echo "AA-3 : ".$str."<br>";
	}
	else 
	{
		$str=$str." AND c.ID='$compId'";
	  //echo "AA-4 : ".$str."<br>";
	}
			if($compId=='0')
			{

				$qq="SELECT IF(a.iType='1',r.focus_code,f.focus_code) AS focus_code,
				IF(a.iType='1',r.sage_code,f.sage_code) AS sage_code,
				IF(a.iType='1',CONCAT(rg.category_nm,' - ',r.description,' - ',ru.uom),
				CONCAT(fgg.category_nm,' - ',f.brand,' ',f.descc,' - ',fu.uom)) AS desp,
				SUM(b.qty) AS OUT_QTY,
				CONCAT(l.loc_code,' - ',l.location_name)AS locNm,a.iType FROM inventory_tbl AS a
				LEFT JOIN `inventory_info_tbl` AS b ON a.ID=b.invId
				 LEFT JOIN company_tbl AS c ON a.compId=c.ID 
				 LEFT JOIN location_tbl AS l ON a.locId=l.ID 
				 LEFT JOIN rm_master AS r ON b.itemId=r.rmId 
				 LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID 
				 LEFT JOIN fg_master AS f ON b.itemId=f.fgId 
				 LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID 
				 LEFT JOIN category_master AS rg ON r.catId=rg.catId 
				 LEFT JOIN category_master AS fgg ON f.category_id=fgg.catId
				 WHERE a.sts!='2' AND b.eType='2' AND IF(a.iType='1',r.sts!='2',f.sts!='2') AND b.qty!='0'
				 GROUP BY IF(a.iType='1',r.focus_code,f.focus_code), IF(a.iType='1',r.sage_code,f.sage_code), IF(a.iType='1',CONCAT(rg.category_nm,' - ',r.description,' - ',ru.uom),CONCAT(fgg.category_nm,' - ',f.brand,' ',f.descc,' - ',fu.uom)), CONCAT(l.loc_code,' - ',l.location_name) ,a.iType ORDER BY SUM(b.qty) DESC ";

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
				if($uRole=='admin' && ($uiType=='3' || $uiType=='0'))
				{
					$qq="SELECT IF(a.iType='1',r.focus_code,f.focus_code) AS focus_code,
						IF(a.iType='1',r.sage_code,f.sage_code) AS sage_code,
						IF(a.iType='1',CONCAT(rg.category_nm,' - ',r.description,' - ',ru.uom),
						CONCAT(fgg.category_nm,' - ',f.brand,' ',f.descc,' - ',fu.uom)) AS desp
						,SUM(b.qty) AS OUT_QTY,
						CONCAT(l.loc_code,' - ',l.location_name)AS locNm,a.iType FROM inventory_tbl AS a
						LEFT JOIN `inventory_info_tbl` AS b ON a.ID=b.invId
						 LEFT JOIN company_tbl AS c ON a.compId=c.ID 
						 LEFT JOIN location_tbl AS l ON a.locId=l.ID 
						 LEFT JOIN rm_master AS r ON b.itemId=r.rmId 
						 LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID 
						 LEFT JOIN fg_master AS f ON b.itemId=f.fgId 
						 LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID 
						 LEFT JOIN category_master AS rg ON r.catId=rg.catId 
						 LEFT JOIN category_master AS fgg ON f.category_id=fgg.catId
						  WHERE a.sts!='2' AND b.eType='2' AND IF(a.iType='q',r.sts!='2',f.sts!='2') ".$str." AND b.qty!='0'
						   GROUP BY IF(a.iType='1',r.focus_code,f.focus_code), IF(a.iType='1',r.sage_code,f.sage_code), IF(a.iType='1',CONCAT(rg.category_nm,' - ',r.description,' - ',ru.uom),CONCAT(fgg.category_nm,' - ',f.brand,' ',f.descc,' - ',fu.uom)), CONCAT(l.loc_code,' - ',l.location_name) ,a.iType ORDER BY SUM(b.qty) DESC";
				}
				else
				{
					$qq="SELECT IF(a.iType='1',r.focus_code,f.focus_code) AS focus_code,
						IF(a.iType='1',r.sage_code,f.sage_code) AS sage_code,
						IF(a.iType='1',CONCAT(rg.category_nm,' - ',r.description,' - ',ru.uom),
						CONCAT(fgg.category_nm,' - ',f.brand,' ',f.descc,' - ',fu.uom)) AS desp
						,SUM(b.qty) AS OUT_QTY,CONCAT(l.loc_code,' - ',l.location_name)AS locNm,a.iType FROM inventory_tbl AS a
						LEFT JOIN `inventory_info_tbl` AS b ON a.ID=b.invId
						 LEFT JOIN company_tbl AS c ON a.compId=c.ID 
						 LEFT JOIN location_tbl AS l ON a.locId=l.ID 
						 LEFT JOIN rm_master AS r ON b.itemId=r.rmId 
						 LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID 
						 LEFT JOIN fg_master AS f ON b.itemId=f.fgId 
						 LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID 
						 LEFT JOIN category_master AS rg ON r.catId=rg.catId 
						 LEFT JOIN category_master AS fgg ON f.category_id=fgg.catId 
						 LEFT JOIN admin_usr_loc AS u ON l.ID=u.locId 
						  WHERE a.sts!='2' AND b.eType='2' AND  IF(a.iType='1',r.sts!='2',f.sts!='2') ".$str." AND u.uid='$uId' AND b.qty!='0' GROUP BY IF(a.iType='1',r.focus_code,f.focus_code), IF(a.iType='1',r.sage_code,f.sage_code), IF(a.iType='1',CONCAT(rg.category_nm,' - ',r.description,' - ',ru.uom),CONCAT(fgg.category_nm,' - ',f.brand,' ',f.descc,' - ',fu.uom)), CONCAT(l.loc_code,' - ',l.location_name) ,a.iType ORDER BY SUM(b.qty) DESC";
				}

				include('shripage.php');
    $totalRecordsPerPage=500;
    $paginationData=pagination_records($totalRecordsPerPage,$qq);
    //print_r($paginationData);
    $sn=pagination_records_counter($totalRecordsPerPage);
    $cnt=$sn;	
    $pagination=pagination($totalRecordsPerPage,$qq);
			}

}
//echo $qq."<br/>";
?>
<div class="pagination">    
<?php echo $pagination; ?>
</div>	
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
<thead>
<tr style="background-color:#b02923">
<th style="color:#fff;">Location</th>
<th style="color:#fff;">Focus Code</th>
<th style="color:#fff">Sage Code</th>
<th style="color:#fff;">Product</th>
<!--<th style="color:#fff">Opening Stock</th>-->
<th style="color:#fff;">OUT</th>

</tr>
</thead>
<?php

include('mysql.connect.php');
//admin_tbl 
$qEditDel="SELECT act_edit AS ed,act_delete AS del FROM admin_tbl WHERE sts='0' AND id='".$uId."'";
//echo $qEditDel."<Br>";	
$stmEditDel=$mysql->prepare($qEditDel);
$stmEditDel->execute();
$rowEditDel=$stmEditDel->fetch(PDO::FETCH_ASSOC);
$ed=$rowEditDel['ed'];
$dels=$rowEditDel['del'];	
//admin_tbl	
foreach ($paginationData as $row) 
{
	
    if($uRole=='admin' || $uiType=='3')
    {
      if($row['iType']=='1')
      {
          echo'<tr style="color:#000;font-weight:600;">';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['locNm'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['focus_code'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['sage_code'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['desp'].'</td>';
		/*echo '<td style="background-color:#0d69f445;color:#000">'.$row['openstk'].'</td>';*/
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['OUT_QTY'].'</td>';
		
		echo '</tr>';  
      }
      else
      {
          echo'<tr style="color:#000;font-weight:600;">';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['locNm'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['focus_code'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['sage_code'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['desp'].'</td>';
		/*echo '<td style="background-color:#f4b80d61;color:#000">'.$row['openstk'].'</td>';*/
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['OUT_QTY'].'</td>';
		
		echo '</tr>'; 
      }
      $cnt++;
    }
	else
	{
		if($row['iType']=='1')
        {
           echo'<tr style="color:#000;font-weight:600;">';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['locNm'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['focus_code'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['sage_code'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['desp'].'</td>';
		/*echo '<td style="background-color:#0d69f445;color:#000">'.$row['openstk'].'</td>';*/
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['OUT_QTY'].'</td>';
		
		echo '</tr>';  
        }
        else
        {
          
          echo'<tr style="color:#000;font-weight:600;">';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['locNm'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['focus_code'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['sage_code'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['desp'].'</td>';
		/*echo '<td style="background-color:#f4b80d61;color:#000">'.$row['openstk'].'</td>';*/
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['OUT_QTY'].'</td>';
        }
        $cnt++;
	}
}
$mysql=null;	
?>	
</table>