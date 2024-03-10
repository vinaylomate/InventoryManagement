<?php 
if(isset($_POST['page']))
{ 
	date_default_timezone_set('Asia/Calcutta');
	$cdt=date('Y-m-d');
    // Include pagination library file 
    include('shripage1.php'); 
     
    // Include database configuration file 
    include('mysql.connect.php'); 
     
    // Set some useful configuration 
    $baseURL = 'getlockQty_Reg2.php'; 
    $offset = !empty($_POST['page'])?$_POST['page']:0; 
    $limit = 100; 
	
	$compId=$locId=$iType=$kw=$sType='0';
	
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
		
		$fdt=$srch[3];
		$tdt=$srch[4];
	}
	else
	{
		$sType=$_POST['sType'];
	
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
    // Set conditions for search 
	
	
	
	//echo $fdt." : ".$tdt."<Br>";
	
	$adparams=$compId."||".$locId."||".$iType."||".$fdt."||".$tdt;
	
	//echo "S Type : ".$sType." : ".$adparams."<br>";
	
	
    if(empty($_POST['keywords']))
	$kw="0";
	else
	$kw=$_POST['keywords'];
	
    if(isset($_POST['filterBy']) && $_POST['filterBy'] != ''){ 
        /*$whereSQL .= (strpos($whereSQL, 'WHERE') !== false)?" AND ":" WHERE "; 
        $whereSQL .= " sts = ".$_POST['filterBy']; */
    } 
     
    // Count of all records 
    //$query   = $mysql->prepare("SELECT COUNT(*) as rowNum FROM users ".$whereSQL);
	
	if($compId!='0' && $locId!='0' && $iType!='0' && $fdt=='0' && $tdt=='0')
	{
		$str=$str." AND c.ID='$compId' AND l.ID='$locId' AND a.iType='$iType'";
		//echo "Aa-1 : ".$str."<br>";
	}	
	else if($compId!='0' && $locId=='0' && $iType!='0' && $fdt=='0' && $tdt=='0')
	{
      $str=$str." AND c.ID='$compId' AND a.iType='$iType' ";
		//echo "Aa-3 : ".$str."<br>";
	}	
	else if($compId!='0' && $locId=='0' && $iType=='0' && $fdt=='0' && $tdt=='0')
	{
      $str=$str." AND c.ID='$compId' ";
		//echo "Aa-4 : ".$str."<br>";
	}
	else if($compId!='0' && $locId!='0' && $iType!='0' && $fdt!='0' && $tdt!='0')
	{
		$str=$str." AND c.ID='$compId' AND l.ID='$locId' AND a.iType='$iType' AND (a.dt BETWEEN '$fdt' AND '$tdt') ";
		//echo "Aa-1 : ".$str."<br>";
	}	
	else if($compId!='0' && $locId=='0' && $iType!='0' && $fdt!='0' && $tdt!='0')
	{
      $str=$str." AND c.ID='$compId' AND a.iType='$iType' AND (a.dt BETWEEN '$fdt' AND '$tdt') ";
		//echo "Aa-3 : ".$str."<br>";
	}	
	else if($compId!='0' && $locId=='0' && $iType=='0' && $fdt!='0' && $tdt!='0')
	{
      $str=$str." AND c.ID='$compId' AND (a.dt BETWEEN '$fdt' AND '$tdt') ";
		//echo "Aa-4 : ".$str."<br>";
	}	
	else if($compId!='0' && $locId=='0' && $iType=='0' && $fdt!='0' && $tdt!='0')
	{
		$str=$str." AND c.ID='$compId' AND (a.dt BETWEEN '$fdt' AND '$tdt') ";
		//echo "Aa-5 : ".$str."<br>";
	}	
	else if($compId=='0' && $locId=='0' && $iType=='0' && $fdt!='0' && $tdt!='0')
	{
		$str=$str." AND (a.dt BETWEEN '$fdt' AND '$tdt') ";
		//echo "Aa-5 : ".$str."<br>";
	}
	else 
	{
		$str=$str."";
		//echo "Aa-6 : ".$str."<br>";
	}
	
	if($kw!='0')
	{
		$str=$str." AND (
      IF(a.iType='1',rc.category_nm LIKE '%".$kw."%',fc.category_nm LIKE '%".$kw."%') OR
      IF(a.iType='1',r.sage_code LIKE '%".$kw."%',f.sage_code LIKE '%".$kw."%') OR
      IF(a.iType='1',r.focus_code LIKE '%".$kw."%',f.focus_code LIKE '%".$kw."%') OR 
      IF(a.iType='1',r.description LIKE '%".$kw."%',f.descc LIKE '%".$kw."%') OR 
      IF(a.iType='1',ru.uom LIKE '%".$kw."%',fu.uom LIKE '%".$kw."%') OR 
      IF(a.iType='1',r.reorder_level_qty LIKE '%".$kw."%',f.reorder_level_qty LIKE '%".$kw."%') OR 
      IF(a.iType='1',r.product_expiry LIKE '%".$kw."%',f.product_expiry LIKE '%".$kw."%') OR 
      IF(a.iType='1',r.rackNo LIKE '%".$kw."%',f.rackNo LIKE '%".$kw."%') OR 
      CONCAT(c.company_code,' - ',c.company_name) LIKE '%".$kw."%' OR 
      CONCAT(l.loc_code,' - ',l.location_name) LIKE '%".$kw."%')";
	}

    //echo $str."<Br>";

    //echo "ROLE : ".$uRole."<br>";

    if($uRole=='admin' && ($uiType=='3' || $uiType=='0'))
    {
        $qq="SELECT DATE_FORMAT(a.dt,'%d-%m-%Y') AS dt,a.iType,IF(a.iType='1','RAW MATERIAL','FINISHED GOODS') AS iTypeNm,a.compId,a.locId,l.loc_code,l.location_name,a.docNo,a.ref ,a.notes,IF(a.iType='1',r.focus_code,f.focus_code) AS fc,IF(a.iType='1',r.sage_code,f.sage_code) AS sg,IF(a.iType='1',CONCAT(r.description,' - ',ru.uom),CONCAT(f.descc,' - ',fu.uom)) AS desp,IF(b.eType='1','IN','OUT') AS EntryType,e.entryNm,b.qty AS Quantity,b.batchNo,IF(b.expdt='-','-',DATE_FORMAT(b.expdt,'%d-%m-%Y')) AS expdt FROM inventory_tbl AS a LEFT JOIN company_tbl AS c ON a.compId=c.ID LEFT JOIN location_tbl AS l ON a.locId=l.ID LEFT JOIN inventory_info_tbl AS b ON a.ID=b.invId LEFT JOIN rm_master AS r ON b.itemId=r.rmId LEFT JOIN category_master AS rc ON r.catId=rc.catId LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID LEFT JOIN fg_master AS f ON b.itemId=f.fgId LEFT JOIN category_master AS fc ON f.category_id=fc.catId LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID LEFT JOIN entry_type_tbl AS e ON b.entryId=e.entryId WHERE a.sts='0' AND b.sts='0' AND a.lsts='1' ".$str." ORDER BY substring(a.docNo,1,9), substring(a.docNo,10)*1 DESC LIMIT $offset,$limit";

        $qqq="SELECT COUNT(a.docNo) AS rowNum FROM inventory_tbl AS a LEFT JOIN company_tbl AS c ON a.compId=c.ID LEFT JOIN location_tbl AS l ON a.locId=l.ID LEFT JOIN inventory_info_tbl AS b ON a.ID=b.invId LEFT JOIN rm_master AS r ON b.itemId=r.rmId LEFT JOIN category_master AS rc ON r.catId=rc.catId LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID LEFT JOIN fg_master AS f ON b.itemId=f.fgId LEFT JOIN category_master AS fc ON f.category_id=fc.catId LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID LEFT JOIN entry_type_tbl AS e ON b.entryId=e.entryId WHERE a.sts='0' AND b.sts='0' AND a.lsts='1' ".$str." ORDER BY substring(a.docNo,1,9), substring(a.docNo,10)*1 DESC";
		$query1=$mysql->prepare($qqq);
        $query1->execute();
        $result  = $query1->fetch(PDO::FETCH_ASSOC); 
        $rowCount= $result['rowNum'];
        //echo "A : ".$qq."<br>";
    }
    else
    {
        $qq="SELECT DATE_FORMAT(a.dt,'%d-%m-%Y') AS dt,a.iType,IF(a.iType='1','RAW MATERIAL','FINISHED GOODS') AS iTypeNm,a.compId,a.locId,l.loc_code,l.location_name,a.docNo,a.ref ,a.notes,IF(a.iType='1',r.focus_code,f.focus_code) AS fc,IF(a.iType='1',r.sage_code,f.sage_code) AS sg,IF(a.iType='1',CONCAT(r.description,' - ',ru.uom),CONCAT(f.descc,' - ',fu.uom)) AS desp,IF(b.eType='1','IN','OUT') AS EntryType,e.entryNm,b.qty AS Quantity,b.batchNo,IF(b.expdt='-','-',DATE_FORMAT(b.expdt,'%d-%m-%Y')) AS expdt FROM inventory_tbl AS a LEFT JOIN company_tbl AS c ON a.compId=c.ID LEFT JOIN location_tbl AS l ON a.locId=l.ID LEFT JOIN inventory_info_tbl AS b ON a.ID=b.invId LEFT JOIN rm_master AS r ON b.itemId=r.rmId LEFT JOIN category_master AS rc ON r.catId=rc.catId LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID LEFT JOIN fg_master AS f ON b.itemId=f.fgId LEFT JOIN category_master AS fc ON f.category_id=fc.catId LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID LEFT JOIN entry_type_tbl AS e ON b.entryId=e.entryId LEFT JOIN admin_usr_loc AS u ON a.locId=u.locId WHERE a.sts='0' AND b.sts='0' AND a.lsts='1' AND c.ID='$compId' AND a.iType='$uiType' AND a.lsts='1' AND u.uid='$uId' ".$str." ORDER BY substring(a.docNo,1,9), substring(a.docNo,10)*1 DESC LIMIT $offset,$limit";

        $qqq="SELECT COUNT(a.docNo) AS rowNum FROM inventory_tbl AS a LEFT JOIN company_tbl AS c ON a.compId=c.ID LEFT JOIN location_tbl AS l ON a.locId=l.ID LEFT JOIN inventory_info_tbl AS b ON a.ID=b.invId LEFT JOIN rm_master AS r ON b.itemId=r.rmId LEFT JOIN category_master AS rc ON r.catId=rc.catId LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID LEFT JOIN fg_master AS f ON b.itemId=f.fgId LEFT JOIN category_master AS fc ON f.category_id=fc.catId LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID LEFT JOIN entry_type_tbl AS e ON b.entryId=e.entryId LEFT JOIN admin_usr_loc AS u ON a.locId=u.locId WHERE a.sts='0' AND b.sts='0' AND a.lsts='1' AND c.ID='$compId' AND a.iType='$uiType' AND a.lsts='1' AND u.uid='$uId' ".$str." ORDER BY substring(a.docNo,1,9), substring(a.docNo,10)*1 DESC";
		$query1=$mysql->prepare($qqq);
        $query1->execute();
        $result  = $query1->fetch(PDO::FETCH_ASSOC); 
        $rowCount= $result['rowNum'];
        //echo "B : ".$qq."<br>";
    }
	 
     
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
 
    // Fetch records based on the offset and limit 
    /*$query = $mysql->prepare("SELECT * FROM users $whereSQL ORDER BY id DESC LIMIT $offset,$limit");
	$query->execute();*/
	
	//echo $q."<Br>";	
	$query = $mysql->prepare($qq); 
	$query->execute();
	$paginationData=$query->fetchAll();	
	echo $pagination->createLinks(); 
	
	//admin_tbl 
$qEditDel="SELECT act_edit AS ed,act_delete AS del FROM admin_tbl WHERE sts='0' AND id='".$uId."'";
//echo $qEditDel."<Br>";	
$stmEditDel=$mysql->prepare($qEditDel);
$stmEditDel->execute();
$rowEditDel=$stmEditDel->fetch(PDO::FETCH_ASSOC);
$ed=$rowEditDel['ed'];
$dels=$rowEditDel['del'];	
//admin_tbl
?> 
    <!-- Data list container --> 
    
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
<thead>
<tr style="background-color:#b02923">
<th style="color:#fff;">Date</th>
<th style="color:#fff">Doc. No</th>
<!--<th style="color:#fff">Company</th>-->
<th style="color:#fff">Location</th>
<th style="color:#fff">Product Category</th>
<th style="color:#fff">Reference</th>
<!--<th style="color:#fff">Notes</th>-->
<th style="color:#fff">Focus Code</th>
<th style="color:#fff">Sage Code</th>
<th style="color:#fff">Product</th>
<th style="color:#fff">Entry Type</th>
<th style="color:#fff">Batch / Lot No.</th>
<th style="color:#fff">IN</th>
<th style="color:#fff">OUT</th>
<th style="color:#fff">Expiry Date</th>
</tr>
</thead>
<tbody>
<?php
$a=$b=0;	
foreach ($paginationData as $row) 
{
	//$id=$row['ID'];
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
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['ref'].'</td>';
		//echo '<td style="background-color:#0d69f445;color:#000">'.$row['notes'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['fc'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['sg'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['desp'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['entryNm'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['batchNo'].'</td>';
		if($row['EntryType']=='IN')
		{
			echo '<td style="background-color:#0d69f445;color:#000">'.$row['Quantity'].'</td>';
			$a=$a+$row['Quantity'];		  	
		}
		else
		{
			echo '<td style="background-color:#0d69f445;color:#000">0</td>';		  	
		}
		
		
		if($row['EntryType']=='OUT')
		{
			echo '<td style="background-color:#0d69f445;color:#000">'.$row['Quantity'].'</td>';	
			$b=$b+$row['Quantity'];	  	
		}
		else
		{
			echo '<td style="background-color:#0d69f445;color:#000">0</td>';		  	
		}
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['expdt'].'</td>';
		echo '</tr>';  
	
	}
	else
	{
		echo'<tr style="color:#000;font-weight:600;">';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['dt'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['docNo'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['loc_code'].' - '.$row['location_name'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['iTypeNm'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['ref'].'</td>';
		//echo '<td style="background-color:#f4b80d61;color:#000">'.$row['notes'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['fc'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['sg'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['desp'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['entryNm'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['batchNo'].'</td>';
		if($row['EntryType']=='IN')
		{
			echo '<td style="background-color:#f4b80d61;color:#000">'.$row['Quantity'].'</td>';
			$a=$a+$row['Quantity'];		  	
		}
		else
		{
			echo '<td style="background-color:#f4b80d61;color:#000">0</td>';		  	
		}
		
		
		if($row['EntryType']=='OUT')
		{
			echo '<td style="background-color:#f4b80d61;color:#000">'.$row['Quantity'].'</td>';	
			$b=$b+$row['Quantity'];	  	
		}
		else
		{
			echo '<td style="background-color:#f4b80d61;color:#000">0</td>';		  	
		}
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['expdt'].'</td>';
		echo '</tr>';  
	}				  
	$cnt++;	
}	
$mysql=null;	
?>
</tbody>
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
<th style="color:#fff">Total</th>
<th style="color:#fff"><?php echo $a;?></th>
<th style="color:#fff"><?php echo $b;?></th>
<th style="color:#fff"></th>
</tr>
</tfoot>	
</table>
    <!-- Display pagination links --> 
<?php 
} 
?>