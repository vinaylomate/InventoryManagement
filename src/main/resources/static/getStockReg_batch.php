<?php
if(isset($_POST['page']))
{
 // Include pagination library file 
    include('shripage1.php'); 
     
    // Include database configuration file 
    include('mysql.connect.php'); 
     
    // Set some useful configuration 
    $baseURL = 'getStockReg_batch.php'; 
    $offset = !empty($_POST['page'])?$_POST['page']:0; 
    $limit = 100; 
		
	$compId=$locId=$iType='0';
	if($_POST['sType']=='1')
	{
		$sType=$_POST['sType'];
		//$adparams=$compId."||".$locId."||".$iType."||".$fdt."||".$tdt;		
		$srch1=$_POST['srch'];
		$srch=explode("||",$srch1);

		$compId=$srch[0];

		$locId=$srch[1];

		$iType=$srch[2];	

		$uId=$_POST['uId'];
		$uiType=$_POST['uiType'];
		$uRole=$_POST['urole'];
		$uloc="0";
		$catId=$srch[3];	
		$brand=$srch[4];	
	}
	else
	{
		if(!empty($_POST['compId']))
		$compId=$_POST['compId'];

		if(!empty($_POST['locId']))
		$locId=$_POST['locId'];

		if(!empty($_POST['iType']))
		$iType=$_POST['iType'];	

		$uId=$_POST['uId'];
		$uiType=$_POST['uiType'];
		$uRole=$_POST['urole'];

		if(empty($_POST['uloc']))
		$uloc="0";
		else
		$uloc=$_POST['uloc'];

		//echo "ABCYY : ".$uloc."<Br>";

		if(empty($_POST['catId']))
		$catId="0";
		else
		$catId=$_POST['catId'];

		if(empty($_POST['brand']))
		$brand="0";
		else
		$brand=$_POST['brand'];
	}
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
	
	
    if(!empty($_POST['keywords']))
	{ 
        /*$whereSQL = " WHERE (first_name LIKE '%".$_POST['keywords']."%' OR last_name LIKE '%".$_POST['keywords']."%' OR email LIKE '%".$_POST['keywords']."%' OR country LIKE '%".$_POST['keywords']."%') "; */
		$whereSQL=$whereSQL." AND (
      IF(a.iType='1',rc.category_nm LIKE '%".$_POST['keywords']."%',fc.category_nm LIKE '%".$_POST['keywords']."%') OR
      IF(a.iType='1',r.sage_code LIKE '%".$_POST['keywords']."%',f.sage_code LIKE '%".$_POST['keywords']."%') OR
      IF(a.iType='1',r.focus_code LIKE '%".$_POST['keywords']."%',f.focus_code LIKE '%".$_POST['keywords']."%') OR 
      IF(a.iType='1',r.description LIKE '%".$_POST['keywords']."%',f.descc LIKE '%".$_POST['keywords']."%') OR 
      IF(a.iType='1',ru.uom LIKE '%".$_POST['keywords']."%',fu.uom LIKE '%".$_POST['keywords']."%') OR 
      IF(a.iType='1',r.reorder_level_qty LIKE '%".$_POST['keywords']."%',f.reorder_level_qty LIKE '%".$_POST['keywords']."%') OR 
      IF(a.iType='1',r.product_expiry LIKE '%".$_POST['keywords']."%',f.product_expiry LIKE '%".$_POST['keywords']."%') OR 
      IF(a.iType='1',r.rackNo LIKE '%".$_POST['keywords']."%',f.rackNo LIKE '%".$_POST['keywords']."%') OR 
      CONCAT(c.company_code,' - ',c.company_name) LIKE '%".$_POST['keywords']."%' OR 
      CONCAT(l.loc_code,' - ',l.location_name) LIKE '%".$_POST['keywords']."%' OR a.batchNo LIKE '%".$_POST['keywords']."%') ";
    } 
	
	//echo $whereSQL."<Br>";
		
    if(isset($_POST['filterBy']) && $_POST['filterBy'] != '')
	{ 
        /*$whereSQL .= (strpos($whereSQL, 'WHERE') !== false)?" AND ":" WHERE "; 
        $whereSQL .= " sts = ".$_POST['filterBy']; */
    } 
	
//echo "role:".$uRole.'<br>';
	
if($uRole=='admin' && ($uiType=='3' || $uiType=='0'))
{
	$qq="SELECT a.compId,a.locId,l.loc_code,l.location_name AS locNm,IF(a.iType='1','RAW MATERIAL','FINISHED GOODS') AS iTypeNm,a.iType,a.itemId,IF(a.iType='1',r.focus_code,f.focus_code)AS fc,IF(a.iType='1',r.sage_code,f.sage_code)AS sg,IF(a.iType='1',r.description,f.descc)AS desp,IF(a.iType='1',rc.category_nm,fc.category_nm)AS catName,a.batchNo,SUM(a.openstk) AS opstk,SUM(a.in_qty) AS inq,SUM(a.out_qty)oq,SUM(a.lock_qty) AS lq,((SUM(a.in_qty+a.openstk))-SUM((a.out_qty+a.lock_qty))) AS stk, IF(a.iType='1',r.reorder_level_qty,f.reorder_level_qty)AS reord,IF(a.iType='1',r.rackNo,f.rackNo)AS rack FROM stock_tbl_2 AS a LEFT JOIN location_tbl AS l ON a.locId=l.ID LEFT JOIN rm_master AS r ON a.itemId=r.rmId LEFT JOIN category_master AS rc ON r.catId=rc.catId LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID LEFT JOIN fg_master AS f ON a.itemId=f.fgId LEFT JOIN category_master AS fc ON f.category_id=fc.catId LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID LEFT JOIN company_tbl AS c ON a.compId=c.ID WHERE a.sts!='2' ".$whereSQL." GROUP BY a.compId,a.locId,a.iType,a.itemId,a.batchNo,IF(a.iType='1','RAW MATERIAL','FINISHED GOODS'),IF(a.iType='1',r.focus_code,f.focus_code),IF(a.iType='1',r.sage_code,f.sage_code),IF(a.iType='1',r.description,f.descc),IF(a.iType='1',rc.category_nm,fc.category_nm), IF(a.iType='1',r.reorder_level_qty,f.reorder_level_qty),IF(a.iType='1',r.rackNo,f.rackNo) ORDER BY a.itemId LIMIT $offset,$limit";
	
	$qqq="SELECT COUNT(a.itemId) AS rowNum FROM stock_tbl_2 AS a LEFT JOIN location_tbl AS l ON a.locId=l.ID LEFT JOIN rm_master AS r ON a.itemId=r.rmId LEFT JOIN category_master AS rc ON r.catId=rc.catId LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID LEFT JOIN fg_master AS f ON a.itemId=f.fgId LEFT JOIN category_master AS fc ON f.category_id=fc.catId LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID LEFT JOIN company_tbl AS c ON a.compId=c.ID WHERE a.sts!='2' ".$whereSQL." GROUP BY a.compId,a.locId,a.iType,a.itemId,a.batchNo,IF(a.iType='1','RAW MATERIAL','FINISHED GOODS'),IF(a.iType='1',r.focus_code,f.focus_code),IF(a.iType='1',r.sage_code,f.sage_code),IF(a.iType='1',r.description,f.descc),IF(a.iType='1',rc.category_nm,fc.category_nm), IF(a.iType='1',r.reorder_level_qty,f.reorder_level_qty),IF(a.iType='1',r.rackNo,f.rackNo) ORDER BY a.itemId";
	//echo "A : ".$qq."<br>".$qqq."<Br>";
}
else
{
	$qq="SELECT a.compId,a.locId,l.loc_code,l.location_name AS locNm,IF(a.iType='1','RAW MATERIAL','FINISHED GOODS') AS iTypeNm,a.iType,a.itemId,IF(a.iType='1',r.focus_code,f.focus_code)AS fc,IF(a.iType='1',r.sage_code,f.sage_code)AS sg,IF(a.iType='1',r.description,f.descc)AS desp,IF(a.iType='1',rc.category_nm,fc.category_nm)AS catName,a.batchNo,SUM(a.openstk) AS opstk,SUM(a.in_qty) AS inq,SUM(a.out_qty)oq,SUM(a.lock_qty) AS lq,((SUM(a.in_qty+a.openstk))-SUM((a.out_qty+a.lock_qty))) AS stk, IF(a.iType='1',r.reorder_level_qty,f.reorder_level_qty)AS reord,IF(a.iType='1',r.rackNo,f.rackNo)AS rack FROM stock_tbl_2 AS a LEFT JOIN location_tbl AS l ON a.locId=l.ID LEFT JOIN rm_master AS r ON a.itemId=r.rmId LEFT JOIN category_master AS rc ON r.catId=rc.catId LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID LEFT JOIN fg_master AS f ON a.itemId=f.fgId LEFT JOIN category_master AS fc ON f.category_id=fc.catId LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID LEFT JOIN company_tbl AS c ON a.compId=c.ID LEFT JOIN admin_usr_loc AS u ON l.ID=u.locId WHERE a.sts!='2' ".$whereSQL." AND u.uid='$uId' AND a.sts!='2' GROUP BY a.compId,a.locId,a.iType,a.itemId,a.batchNo,IF(a.iType='1','RAW MATERIAL','FINISHED GOODS'),IF(a.iType='1',r.focus_code,f.focus_code),IF(a.iType='1',r.sage_code,f.sage_code),IF(a.iType='1',r.description,f.descc),IF(a.iType='1',rc.category_nm,fc.category_nm), IF(a.iType='1',r.reorder_level_qty,f.reorder_level_qty),IF(a.iType='1',r.rackNo,f.rackNo) ORDER BY a.itemId LIMIT $offset,$limit";
	
	$qqq="SELECT COUNT(a.itemId) AS rowNum FROM stock_tbl_2 AS a LEFT JOIN location_tbl AS l ON a.locId=l.ID LEFT JOIN rm_master AS r ON a.itemId=r.rmId LEFT JOIN category_master AS rc ON r.catId=rc.catId LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID LEFT JOIN fg_master AS f ON a.itemId=f.fgId LEFT JOIN category_master AS fc ON f.category_id=fc.catId LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID LEFT JOIN company_tbl AS c ON a.compId=c.ID LEFT JOIN admin_usr_loc AS u ON l.ID=u.locId WHERE a.sts!='2' ".$str." AND u.uid='$uId' AND a.sts!='2' GROUP BY a.compId,a.locId,a.iType,a.itemId,a.batchNo,IF(a.iType='1','RAW MATERIAL','FINISHED GOODS'),IF(a.iType='1',r.focus_code,f.focus_code),IF(a.iType='1',r.sage_code,f.sage_code),IF(a.iType='1',r.description,f.descc),IF(a.iType='1',rc.category_nm,fc.category_nm), IF(a.iType='1',r.reorder_level_qty,f.reorder_level_qty),IF(a.iType='1',r.rackNo,f.rackNo) ORDER BY a.itemId";
	//echo "Else  - ".$qq."<Br>";
}
//echo "hhh : ".$qq."<br>";

$query1   = $mysql->prepare($qqq); 
$query1->execute();
$rw=$query1->fetchAll();
$rowCount=$query1->rowCount();

set_time_limit(0);	
$query=$mysql->prepare($qq);
$query->execute();	
$paginationData=$query->fetchAll();	
// Initialize pagination class 
$pagConfig = array( 
    'baseURL'=> $baseURL, 
    'totalRows'=> $rowCount, 
    'perPage'=> $limit, 
    'currentPage'=> $offset, 
    'contentDiv'=> 'tbl', 
    'link_func'=> '',
    'keywords'=> $_POST['keywords'],
    'uiType'=> $uiType,
    'uRole'=> $uRole,
    'uId'=> $uId,
    'srch'=> $adparams,
    'sType'=> '1'
    );  
    $pagination =  new Pagination($pagConfig); 
?>

<div>    
<?php echo $pagination->createLinks();  ?>
</div>
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
<!--<th style="color:#fff">View</th>-->
</tr>
</thead>
<?php
$a=$b=$c=$d=$e=0;	
foreach ($paginationData as $row) 
{
	//$id=$row['ID'];
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
$mysql=null;	
?>
<tfoot>
<tr style="background-color:#b02923">
<th style="color:#fff"></th>
<th style="color:#fff;"></th>
<th style="color:#fff"></th>
<th style="color:#fff"></th>
<th style="color:#fff"></th>
<th style="color:#fff;">Total</th>
<th style="color:#fff"><?php echo $b;?></th>
<th style="color:#fff;"><?php echo $c;?></th>
<th style="color:#fff"><?php echo $d;?></th>
<th style="color:#fff;"><?php echo $e;?></th>
<th style="color:#fff;"></th>
<th style="color:#fff"></th>
<th style="color:#fff"></th>
<!--<th style="color:#fff"></th>
<th style="color:#fff"></th>-->
</tr>
</tfoot>	

</table>	

<?php 
} 
?>
 