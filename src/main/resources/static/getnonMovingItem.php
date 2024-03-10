<?php
if(isset($_POST['page']))
{
// Include pagination library file 
    include('shripage1.php'); 
     
    // Include database configuration file 
    include('mysql.connect.php'); 
     
    // Set some useful configuration 
    $baseURL = 'getnonMovingItem.php'; 
    $offset = !empty($_POST['page'])?$_POST['page']:0; 
    $limit = 100; 

	$compId=$locId=$iType='0';
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
		
		$fdt=$srch[3];
		
		$tdt=$srch[4];

		$uId=$_POST['uId'];
		$uiType=$_POST['uiType'];
		$uRole=$_POST['urole'];
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
		

		if(empty($_POST['fdt']))
		$fdt="0";
		else
		$fdt=$_POST['fdt'];

		if(empty($_POST['tdt']))
		$tdt="0";
		else
		$tdt=$_POST['tdt'];
	}

//echo $locId."<Br>";
	
	$whereSQL = ''; 
	
	$adparams=$compId."||".$locId."||".$iType."||".$fdt."||".$tdt;
	
	//echo "S Type : ".$sType." = ".$adparams." = ROLE : ".$uRole."<br>";
	
	if($compId!='0' && $locId!='0' && $iType!='0' && $fdt=='0' && $tdt=='0')
	{
		$whereSQL = $whereSQL." AND a.compId='$compId' AND l.ID='$locId' AND a.iType='$iType' ";
		//echo "Aa-1 : ".$str."<br>";
	}
	else if($compId!='0' && $locId=='0' && $iType!='0' && $fdt=='0' && $tdt=='0')
	{
		$whereSQL = $whereSQL." AND a.compId='$compId' AND a.iType='$iType' ";
		//echo "Aa-2 : ".$str."<br>";
	}
	else if($compId!='0' && $locId!='0' && $iType!='0' && $fdt!='0' && $tdt!='0')
	{
		$whereSQL = $whereSQL." AND a.compId='$compId' AND l.ID='$locId' AND a.iType='$iType' AND (b.dt BETWEEN '$fdt' AND '$tdt') ";
		//echo "Aa-3 : ".$str."<br>";
	}	
	else if($compId!='0' && $locId=='0' && $iType!='0' && $fdt!='0' && $tdt!='0')
	{
		$whereSQL = $whereSQL." AND a.compId='$compId' AND a.iType='$iType'  AND (b.dt BETWEEN '$fdt' AND '$tdt') ";
		//echo "Aa-4 : ".$str."<br>";
	}	
	else if($compId!='0' && $locId=='0' && $iType=='0' && $fdt!='0' && $tdt!='0')
	{
		$whereSQL = $whereSQL." AND a.compId='$compId' AND (b.dt BETWEEN '$fdt' AND '$tdt') ";
		//echo "Aa-5 : ".$str."<br>";
	}	
	else if($compId=='0' && $locId=='0' && $iType=='0' && $fdt!='0' && $tdt!='0')
	{
		$whereSQL = $whereSQL." AND (b.dt BETWEEN '$fdt' AND '$tdt') ";
		//echo "Aa-6 : ".$str."<br>";
	}	
	else if($compId!='0' && $locId=='0' && $iType=='0' && $fdt=='0' && $tdt=='0')
	{
		$whereSQL = $whereSQL." AND a.compId='$compId' ";
		//echo "Aa-7 : ".$str."<br>";
	}	
	else if($compId=='0' && $locId=='0' && $iType!='0' && $fdt=='0' && $tdt=='0')
	{
		$whereSQL = $whereSQL." AND a.iType='$iType' ";
		//echo "Aa-8 : ".$str."<br>";
	}
	else 
	{
		$whereSQL = $whereSQL." ";
		//echo "Aa-9 : ".$str."<br>";
	}

	
    if(!empty($_POST['keywords'])){ 
        /*$whereSQL = " WHERE (first_name LIKE '%".$_POST['keywords']."%' OR last_name LIKE '%".$_POST['keywords']."%' OR email LIKE '%".$_POST['keywords']."%' OR country LIKE '%".$_POST['keywords']."%') "; */
		$whereSQL = $whereSQL." AND (l.location_name LIKE '%".$_POST['keywords']."%' )";
    } 
	$whereSQL2 = ''; 
    if(!empty($_POST['keywords'])){ 
        /*$whereSQL = " WHERE (first_name LIKE '%".$_POST['keywords']."%' OR last_name LIKE '%".$_POST['keywords']."%' OR email LIKE '%".$_POST['keywords']."%' OR country LIKE '%".$_POST['keywords']."%') "; */
		$whereSQL2 = " AND (l.location_name LIKE '%".$_POST['keywords']."%' OR r.focus_code LIKE '%".$_POST['keywords']."%' OR r.sage_code
		LIKE '%".$_POST['keywords']."%' OR r.description LIKE '%".$_POST['keywords']."%' )";
    } 
	$whereSQL3 = ''; 
    if(!empty($_POST['keywords'])){ 
        /*$whereSQL = " WHERE (first_name LIKE '%".$_POST['keywords']."%' OR last_name LIKE '%".$_POST['keywords']."%' OR email LIKE '%".$_POST['keywords']."%' OR country LIKE '%".$_POST['keywords']."%') "; */
		$whereSQL3 = " AND (l.location_name LIKE '%".$_POST['keywords']."%' OR f.focus_code LIKE '%".$_POST['keywords']."%' OR f.sage_code
		LIKE '%".$_POST['keywords']."%' OR f.descc LIKE '%".$_POST['keywords']."%' )";
    } 	
	
    if(isset($_POST['filterBy']) && $_POST['filterBy'] != ''){ 
        /*$whereSQL .= (strpos($whereSQL, 'WHERE') !== false)?" AND ":" WHERE "; 
        $whereSQL .= " sts = ".$_POST['filterBy']; */
    } 

	

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


	//echo "<Br>";
if($uRole=='admin' && ($uiType=='3' || $uiType=='0'))
{
    $qq="SELECT a.ID,a.compId,a.locId,l.loc_code,l.location_name AS locNm,a.iType,a.itemId,SUM(b.in_qty+b.openstk) AS in_qty,a.stk_qty AS stk_qty FROM stock_tbl AS a LEFT JOIN stock_tbl_2 AS b ON a.ID=b.stkId LEFT JOIN location_tbl AS l ON a.locId=l.ID WHERE a.sts='0' ".$whereSQL." AND a.in_qty=a.stk_qty AND (a.out_qty='0' OR a.lock_qty='0') GROUP BY a.ID,a.compId,a.locId,a.iType,a.itemId ORDER BY a.stk_qty DESC LIMIT $offset,$limit";

    //echo "A : ".$qq."<br>";
    $qqq="SELECT a.ID FROM stock_tbl AS a LEFT JOIN stock_tbl_2 AS b ON a.ID=b.stkId LEFT JOIN location_tbl AS l ON a.locId=l.ID WHERE a.in_qty=a.stk_qty AND (a.out_qty='0' OR a.lock_qty='0') ".$whereSQL." GROUP BY a.ID,a.compId,a.locId,a.iType,a.itemId ORDER BY a.stk_qty DESC ";
}
else
{

    $qq="SELECT a.ID,a.compId,a.locId,l.loc_code,l.location_name AS locNm,a.iType,a.itemId,SUM(b.in_qty+b.openstk) AS in_qty,a.stk_qty AS stk_qty FROM stock_tbl AS a LEFT JOIN stock_tbl_2 AS b ON a.ID=b.stkId LEFT JOIN location_tbl AS l ON a.locId=l.ID LEFT JOIN admin_usr_loc AS u ON l.ID=u.locId WHERE a.sts='0' ".$whereSQL." AND u.uid='$uId' AND a.in_qty=a.stk_qty AND (a.out_qty='0' OR a.lock_qty='0') GROUP BY a.ID,a.compId,a.locId,a.iType,a.itemId ORDER BY a.stk_qty DESC LIMIT $offset,$limit";

    //echo "B : ".$qq."<br>";
    $qqq="SELECT a.ID FROM stock_tbl AS a LEFT JOIN stock_tbl_2 AS b ON a.ID=b.stkId LEFT JOIN location_tbl AS l ON a.locId=l.ID LEFT JOIN admin_usr_loc AS u ON l.ID=u.locId WHERE a.sts='0' ".$whereSQL." AND u.uid='$uId' AND a.in_qty=a.stk_qty AND (a.out_qty='0' OR a.lock_qty='0') GROUP BY a.ID,a.compId,a.locId,a.iType,a.itemId ORDER BY a.stk_qty DESC";
}


//echo $qq."<br/>";
$query1   = $mysql->prepare($qqq); 
$query1->execute();
//$result1  = $query1->fetch(PDO::FETCH_ASSOC);
//$rowCount= $result1['rowNum']; 	
$rowCount=$query1->rowCount();	 	
//echo $rowCount."<br>";	
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

		$qi="SELECT r.focus_code AS fc,r.sage_code AS sg,rc.category_nm AS catNm,r.description AS desp,ru.uom AS uom FROM rm_master AS r LEFT JOIN category_master AS rc ON r.catId=rc.catId LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID LEFT JOIN location_tbl AS l ON r.location_id=l.ID WHERE r.sts='0' AND r.location_id='".$row['locId']."' AND rmId='".$row['itemId']."' ".$whereSQL2."";

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

		$qi="SELECT f.focus_code AS fc,f.sage_code AS sg,fc.category_nm AS catNm,f.descc AS desp,fu.uom AS uom FROM fg_master AS f LEFT JOIN category_master AS fc ON f.category_id=fc.catId LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID LEFT JOIN location_tbl AS l ON f.location_id=l.ID WHERE f.sts='0' AND f.location_id='".$row['locId']."' AND fgId='".$row['itemId']."' ".$whereSQL3."";

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

<?php 
} 
?>