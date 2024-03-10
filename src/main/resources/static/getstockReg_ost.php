<?php 
if(isset($_POST['page']))
{ 
    // Include pagination library file 
    include('shripage1.php'); 
     
    // Include database configuration file 
    include('mysql.connect.php'); 
     
    // Set some useful configuration 
    $baseURL = 'getstockReg_ost.php'; 
    $offset = !empty($_POST['page'])?$_POST['page']:0; 
    $limit = 100; 
	
	$compId=$locId=0;
	if($_POST['sType']=='1')
	{
		$sType=$_POST['sType'];
		//$adparams=$compId."||".$locId."||".$iType."||".$fdt."||".$tdt;		
		$srch1=$_POST['srch'];
		//echo "aa : ".$srch1."<Br>";
		$srch=explode("||",$srch1);
		
		$compId=$srch[0];

		$locId=$srch[1];

		$iType=$srch[2];
		
		$catId=$srch[3];
		
		$brand=$srch[4];

		$uId=$_POST['uId'];
		$uiType=$_POST['uiType'];
		$uRole=$_POST['urole'];
	}
	else
	{
		$sType=$_POST['sType'];
		if(!empty($_POST['compId']))
		$compId=$_POST['compId'];

		if(!empty($_POST['locId']))
		$locId=$_POST['locId'];

		if(empty($_POST['iType']))
		$iType="0";
		else
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
	
	//echo "S Type : ".$sType." = ".$adparams." = ROLE : ".$uRole."<br>";
	
	//echo $uRole.'<br>';
	/*if(empty($_POST['uloc']))
	$uloc="0";
	else
	$uloc=$_POST['uloc'];*/
    // Set conditions for search 
    $whereSQL = '';
	
	if($compId!='0' && $locId!='0' && $iType!='0' && $catId=='0' && $brand=='0')
	{
		$whereSQL=$whereSQL." AND c.ID='$compId' AND l.ID='$locId' AND a.iType='$iType'";
		//echo "AD-1".$str."<Br>";
	}
	else if($compId!='0' && $locId=='0' && $iType!='0' && $catId=='0' && $brand=='0')
	{
		$whereSQL=$whereSQL." AND c.ID='$compId' AND a.iType='$iType'";
		//echo "AD-2".$str."<Br>";
	}
	else if($compId!='0' && $locId!='0' && $iType!='0' && $catId!='0' && $brand!='0')
	{
		$whereSQL=$whereSQL." AND c.ID='$compId' AND a.iType='$iType' AND l.ID='$locId' AND IF(a.iType='1',r.catId,f.category_id)='$catId' AND f.brand='$brand' ";
		//echo "AD-3".$str."<Br>";
	}	
	else if($compId!='0' && $locId!='0' && $iType!='0' && $catId!='0' && $brand=='0')
	{
		$whereSQL=$whereSQL." AND c.ID='$compId' AND a.iType='$iType' AND l.ID='$locId' AND IF(a.iType='1',r.catId,f.category_id)='$catId' ";
		//echo "AD-4".$str."<Br>";
	}
	else if($compId!='0' && $locId!='0' && $iType!='0' && $catId=='0' && $brand!='0')
	{
		$whereSQL=$whereSQL." AND c.ID='$compId' AND a.iType='$iType' AND l.ID='$locId' AND f.brand='$brand' ";
		//echo "AD-5".$str."<Br>";
	}
	else if($compId!='0' && $locId=='0' && $iType!='0' && $catId!='0' && $brand!='0')
	{
		$whereSQL=$whereSQL." AND c.ID='$compId' AND a.iType='$iType' AND IF(a.iType='1',r.catId,f.category_id)='$catId' AND f.brand='$brand' ";
		//echo "AD-6".$str."<Br>";
	}	
	else if($compId!='0' && $locId=='0' && $iType!='0' && $catId!='0' && $brand=='0')
	{
		$whereSQL=$whereSQL." AND c.ID='$compId' AND a.iType='$iType' AND IF(a.iType='1',r.catId,f.category_id)='$catId' ";
		//echo "AD-7".$str."<Br>";
	}
	else if($compId!='0' && $locId=='0' && $iType!='0' && $catId=='0' && $brand!='0')
	{
		$whereSQL=$whereSQL." AND c.ID='$compId' AND a.iType='$iType' AND f.brand='$brand' ";
		//echo "AD-8".$str."<Br>";
	}
	else if($compId!='0' && $locId=='0' && $iType=='0' && $catId=='0' && $brand=='0')
	{
		$whereSQL=$whereSQL." AND c.ID='$compId' ";
		//echo "AD-9".$str."<Br>";
	}	
	else if($compId=='0' && $locId=='0' && $iType!='0' && $catId=='0' && $brand=='0')
	{
		$whereSQL=$whereSQL." AND a.iType='$iType' ";
		//echo "AD-10".$str."<Br>";
	}				
	else 
	{
		$whereSQL=$whereSQL." ";
		//echo "AD-11".$str."<Br>";
	}
	 
	//echo $whereSQL."<Br>";	
	
    if(!empty($_POST['keywords']))
	{ 
        /*$whereSQL = " WHERE (first_name LIKE '%".$_POST['keywords']."%' OR last_name LIKE '%".$_POST['keywords']."%' OR email LIKE '%".$_POST['keywords']."%' OR country LIKE '%".$_POST['keywords']."%') "; */
		$whereSQL = $whereSQL." AND (IF(a.iType='1',rg.category_nm LIKE '%".$_POST['keywords']."%',fgg.category_nm LIKE '%".$_POST['keywords']."%') OR IF(a.iType='1',r.sage_code LIKE '%".$_POST['keywords']."%',f.sage_code LIKE '%".$_POST['keywords']."%') OR IF(a.iType='1',r.focus_code LIKE '%".$_POST['keywords']."%',f.focus_code LIKE '%".$_POST['keywords']."%') OR IF(a.iType='1',r.description LIKE '%".$_POST['keywords']."%',f.descc LIKE '%".$_POST['keywords']."%') OR IF(a.iType='1',ru.uom LIKE '%".$_POST['keywords']."%',fu.uom LIKE '%".$_POST['keywords']."%') OR IF(a.iType='1',r.reorder_level_qty LIKE '%".$_POST['keywords']."%',f.reorder_level_qty LIKE '%".$_POST['keywords']."%') OR IF(a.iType='1',r.product_expiry LIKE '%".$_POST['keywords']."%',f.product_expiry LIKE '%".$_POST['keywords']."%') OR IF(a.iType='1',r.rackNo LIKE '%".$_POST['keywords']."%',f.rackNo LIKE '%".$_POST['keywords']."%') OR CONCAT(c.company_code,' - ',c.company_name) LIKE '%".$_POST['keywords']."%' OR CONCAT(l.loc_code,' - ',l.location_name) LIKE '%".$_POST['keywords']."%') ";
    } 
	
    if(isset($_POST['filterBy']) && $_POST['filterBy'] != '')
	{ 
        /*$whereSQL .= (strpos($whereSQL, 'WHERE') !== false)?" AND ":" WHERE "; 
        $whereSQL .= " sts = ".$_POST['filterBy']; */
    }
     
	if($uRole=='admin' && ($uiType=='3' || $uiType=='0'))
	{	 
		$qqq="SELECT COUNT(a.ID) AS rowNum FROM stock_tbl AS a LEFT JOIN company_tbl AS c ON a.compId=c.ID LEFT JOIN location_tbl AS l ON a.locId=l.ID LEFT JOIN rm_master AS r ON a.itemId=r.rmId LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID LEFT JOIN fg_master AS f ON a.itemId=f.fgId LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID LEFT JOIN category_master AS rg ON r.catId=rg.catId LEFT JOIN category_master AS fgg ON f.category_id=fgg.catId WHERE a.sts!='2' AND IF(a.iType='1',r.sts!='2',f.sts!='2') AND a.stk_qty='0' ".$whereSQL." ORDER BY a.ID";

        $qq="SELECT a.ID,a.iType,IF(a.iType='1',r.focus_code,f.focus_code) AS focus_code,IF(a.iType='1',r.sage_code,f.sage_code) AS sage_code,IF(a.iType='1',CONCAT(r.description,' - ',ru.uom),CONCAT(f.descc,' - ',fu.uom)) AS desp,'0' AS openstk,a.in_qty AS IN_Qty,a.out_qty AS OUT_Qty,a.lock_qty AS Lock_Qty,a.stk_qty AS Closestk,IF(a.iType='1',r.rackNo,f.rackNo) AS rack,IF(a.iType='1',r.reorder_level_qty,f.reorder_level_qty) rorder,CONCAT(l.loc_code,' - ',l.location_name)AS locNm FROM stock_tbl AS a LEFT JOIN company_tbl AS c ON a.compId=c.ID LEFT JOIN location_tbl AS l ON a.locId=l.ID LEFT JOIN rm_master AS r ON a.itemId=r.rmId LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID LEFT JOIN fg_master AS f ON a.itemId=f.fgId LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID LEFT JOIN category_master AS rg ON r.catId=rg.catId LEFT JOIN category_master AS fgg ON f.category_id=fgg.catId WHERE a.sts!='2' AND IF(a.iType='1',r.sts!='2',f.sts!='2') AND a.stk_qty='0' ".$whereSQL." ORDER BY a.ID LIMIT $offset,$limit";
		//echo $qq."<Br>".$qqq."<Br>";
	}
	else
	{
		$qqq="SELECT COUNT(a.ID) AS rowNum FROM stock_tbl AS a LEFT JOIN company_tbl AS c ON a.compId=c.ID LEFT JOIN location_tbl AS l ON a.locId=l.ID LEFT JOIN rm_master AS r ON a.itemId=r.rmId LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID LEFT JOIN fg_master AS f ON a.itemId=f.fgId LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID LEFT JOIN category_master AS rg ON r.catId=rg.catId LEFT JOIN category_master AS fgg ON f.category_id=fgg.catId LEFT JOIN admin_usr_loc AS u ON l.ID=u.locId WHERE a.sts!='2' AND IF(a.iType='1',r.sts!='2',f.sts!='2') AND a.stk_qty='0' ".$whereSQL." AND u.uid='$uId' ORDER BY a.ID";

        $qq="SELECT a.ID,a.iType,IF(a.iType='1',r.focus_code,f.focus_code) AS focus_code,IF(a.iType='1',r.sage_code,f.sage_code) AS sage_code,
        IF(a.iType='1',CONCAT(r.description,' - ',ru.uom),CONCAT(f.descc,' - ',fu.uom)) AS desp,'0' AS openstk,a.in_qty AS IN_Qty,a.out_qty AS OUT_Qty,a.lock_qty AS Lock_Qty,a.stk_qty AS Closestk,IF(a.iType='1',r.rackNo,f.rackNo) AS rack,IF(a.iType='1',r.reorder_level_qty,f.reorder_level_qty) rorder,CONCAT(l.loc_code,' - ',l.location_name)AS locNm FROM stock_tbl AS a LEFT JOIN company_tbl AS c ON a.compId=c.ID LEFT JOIN location_tbl AS l ON a.locId=l.ID LEFT JOIN rm_master AS r ON a.itemId=r.rmId LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID LEFT JOIN fg_master AS f ON a.itemId=f.fgId LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID LEFT JOIN category_master AS rg ON r.catId=rg.catId LEFT JOIN category_master AS fgg ON f.category_id=fgg.catId LEFT JOIN admin_usr_loc AS u ON l.ID=u.locId WHERE a.sts!='2' AND IF(a.iType='1',r.sts!='2',f.sts!='2') AND a.stk_qty='0' ".$whereSQL." AND u.uid='$uId' ORDER BY a.ID LIMIT $offset,$limit";
		//echo "Else  - ".$qq."<Br>";
	}

	$query1   = $mysql->prepare($qqq); 
	$query1->execute();
	$result1  = $query1->fetch(PDO::FETCH_ASSOC);
	$rowCount= $result1['rowNum']; 	

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
    <!-- Data list container --> 
 <div>    
<?php echo $pagination->createLinks(); ?>
</div>	   
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
<thead>
<tr style="background-color:#b02923">
<th style="color:#fff;">Location</th>
<th style="color:#fff;">Focus Code</th>
<th style="color:#fff">Sage Code</th>
<th style="color:#fff;">Product</th>
<!--<th style="color:#fff">Opening Stock</th>-->
<th style="color:#fff;">IN</th>
<th style="color:#fff">OUT</th>
<th style="color:#fff;">Lock Qty</th>
<th style="color:#fff;"><!--Closing-->Avail. Stock</th>
<th style="color:#fff">Re - Order Level</th>
<th style="color:#fff">Re - Order Req.</th>
<th style="color:#fff">Rack No.</th>
</tr>
</thead>
<?php 

include('mysql.connect.php');
$a=$b=$c=$d=$e=0;	
foreach ($paginationData as $row) 
{
	//$id=$row['ID'];
	$a=$a+$row['openstk'];
	$b=$b+$row['IN_Qty'];
	$c=$c+$row['OUT_Qty'];
	$d=$d+$row['Lock_Qty'];
	$e=$e+$row['Closestk'];

	if($row['iType']=='1')
	{
		echo'<tr style="color:#000;font-weight:600;">';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['locNm'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['focus_code'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['sage_code'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['desp'].'</td>';
		/*echo '<td style="background-color:#0d69f445;color:#000">'.$row['openstk'].'</td>';*/
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['IN_Qty'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['OUT_Qty'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['Lock_Qty'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['Closestk'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['rorder'].'</td>';
		if($row['Closestk']<$row['rorder'])
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
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['locNm'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['focus_code'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['sage_code'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['desp'].'</td>';
		/*echo '<td style="background-color:#f4b80d61;color:#000">'.$row['openstk'].'</td>';*/
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['IN_Qty'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['OUT_Qty'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['Lock_Qty'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['Closestk'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['rorder'].'</td>';
		if($row['Closestk']<$row['rorder'])
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
<tbody>
</tbody>
<tfoot>
<tr style="background-color:#b02923">
<th style="color:#fff;"></th>
<th style="color:#fff;"></th>
<th style="color:#fff"></th>
<th style="color:#fff;">Total</th>
<th style="color:#fff"><?php echo $b;?></th>
<th style="color:#fff;"><?php echo $c;?></th>
<th style="color:#fff"><?php echo $d;?></th>
<th style="color:#fff;"><?php echo $e;?></th>
<th style="color:#fff;"></th>
<th style="color:#fff"></th>
<th style="color:#fff"></th>
<!--<th style="color:#fff"></th>-->
</tr>
</tfoot>	

</table>
<!-- Display pagination links --> 
<?php 
} 
?>