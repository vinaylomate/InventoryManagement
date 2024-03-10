<?php
if(isset($_POST['page']))
{
// Include pagination library file 
    include('shripage1.php'); 
     
    // Include database configuration file 
    include('mysql.connect.php'); 
     
    // Set some useful configuration 
    $baseURL = 'getfastMovingItem.php'; 
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
	
	$whereSQL = ''; 
	
	$adparams=$compId."||".$locId."||".$iType."||".$fdt."||".$tdt;
	
	//echo "S Type : ".$sType." = ".$adparams." = ROLE : ".$uRole."<br>";
	
	if($compId!='0' && $locId!='0' && $iType!='0' && $fdt=='0' && $tdt=='0')
	{
		$whereSQL = $whereSQL." AND c.ID='$compId' AND l.ID='$locId' AND a.iType='$iType' ";
		//echo "Aa-1 : ".$str."<br>";
	}
	else if($compId!='0' && $locId=='0' && $iType!='0' && $fdt=='0' && $tdt=='0')
	{
		$whereSQL = $whereSQL." AND c.ID='$compId' AND a.iType='$iType' ";
		//echo "Aa-2 : ".$str."<br>";
	}
	else if($compId!='0' && $locId!='0' && $iType!='0' && $fdt!='0' && $tdt!='0')
	{
		$whereSQL = $whereSQL." AND c.ID='$compId' AND l.ID='$locId' AND a.iType='$iType' AND (a.dt BETWEEN '$fdt' AND '$tdt') ";
		//echo "Aa-3 : ".$str."<br>";
	}	
	else if($compId!='0' && $locId=='0' && $iType!='0' && $fdt!='0' && $tdt!='0')
	{
		$whereSQL = $whereSQL." AND c.ID='$compId' AND a.iType='$iType'  AND (a.dt BETWEEN '$fdt' AND '$tdt') ";
		//echo "Aa-4 : ".$str."<br>";
	}	
	else if($compId!='0' && $locId=='0' && $iType=='0' && $fdt!='0' && $tdt!='0')
	{
		$whereSQL = $whereSQL." AND c.ID='$compId' AND (a.dt BETWEEN '$fdt' AND '$tdt') ";
		//echo "Aa-5 : ".$str."<br>";
	}	
	else if($compId=='0' && $locId=='0' && $iType=='0' && $fdt!='0' && $tdt!='0')
	{
		$whereSQL = $whereSQL." AND (a.dt BETWEEN '$fdt' AND '$tdt') ";
		//echo "Aa-6 : ".$str."<br>";
	}	
	else if($compId!='0' && $locId=='0' && $iType=='0' && $fdt=='0' && $tdt=='0')
	{
		$whereSQL = $whereSQL." AND c.ID='$compId' ";
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
	
    if(!empty($_POST['keywords']))
	{ 
        /*$whereSQL = " WHERE (first_name LIKE '%".$_POST['keywords']."%' OR last_name LIKE '%".$_POST['keywords']."%' OR email LIKE '%".$_POST['keywords']."%' OR country LIKE '%".$_POST['keywords']."%') "; */
        $whereSQL = $whereSQL." AND (l.loc_code LIKE '%".$_POST['keywords']."%' OR l.location_name LIKE '%".$_POST['keywords']."%' OR r.focus_code LIKE '%".$_POST['keywords']."%' OR f.focus_code LIKE '%".$_POST['keywords']."%' OR r.sage_code LIKE '%".$_POST['keywords']."%' OR f.sage_code LIKE '%".$_POST['keywords']."%' OR rg.category_nm LIKE '%".$_POST['keywords']."%' OR r.description LIKE '%".$_POST['keywords']."%' OR ru.uom LIKE '%".$_POST['keywords']."%'OR fgg.category_nm LIKE '%".$_POST['keywords']."%' OR f.brand LIKE '%".$_POST['keywords']."%' OR f.descc LIKE '%".$_POST['keywords']."%' OR fu.uom LIKE '%".$_POST['keywords']."%') ";
    } 
	
    if(isset($_POST['filterBy']) && $_POST['filterBy'] != '')
	{ 
        /*$whereSQL .= (strpos($whereSQL, 'WHERE') !== false)?" AND ":" WHERE "; 
        $whereSQL .= " sts = ".$_POST['filterBy']; */
    } 

	if($uRole=='admin' && ($uiType=='3' || $uiType=='0'))
	{
      $qq="SELECT IF(a.iType='1',r.focus_code,f.focus_code) AS focus_code,IF(a.iType='1',r.sage_code,f.sage_code) AS sage_code,
      IF(a.iType='1',CONCAT(rg.category_nm,' - ',r.description,' - ',ru.uom),CONCAT(fgg.category_nm,' - ',f.brand,' ',f.descc,' - ',fu.uom)) AS desp,
      SUM(b.qty) AS OUT_QTY,CONCAT(l.loc_code,' - ',l.location_name)AS locNm,a.iType FROM inventory_tbl AS a LEFT JOIN `inventory_info_tbl` AS b ON a.ID=b.invId LEFT JOIN company_tbl AS c ON a.compId=c.ID LEFT JOIN location_tbl AS l ON a.locId=l.ID LEFT JOIN rm_master AS r ON b.itemId=r.rmId LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID LEFT JOIN fg_master AS f ON b.itemId=f.fgId LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID LEFT JOIN category_master AS rg ON r.catId=rg.catId LEFT JOIN category_master AS fgg ON f.category_id=fgg.catId WHERE a.sts!='2' ".$whereSQL."  AND b.eType='2' AND IF(a.iType='1',r.sts!='2',f.sts!='2') AND b.qty!='0' GROUP BY IF(a.iType='1',r.focus_code,f.focus_code), IF(a.iType='1',r.sage_code,f.sage_code), IF(a.iType='1',CONCAT(rg.category_nm,' - ',r.description,' - ',ru.uom),CONCAT(fgg.category_nm,' - ',f.brand,' ',f.descc,' - ',fu.uom)), CONCAT(l.loc_code,' - ',l.location_name) ,a.iType ORDER BY SUM(b.qty) DESC LIMIT $offset,$limit ";
	  //echo "A : ".$qq."<br>";

      $qqq="SELECT a.iType FROM inventory_tbl AS a LEFT JOIN `inventory_info_tbl` AS b ON a.ID=b.invId LEFT JOIN company_tbl AS c ON a.compId=c.ID LEFT JOIN location_tbl AS l ON a.locId=l.ID LEFT JOIN rm_master AS r ON b.itemId=r.rmId LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID LEFT JOIN fg_master AS f ON b.itemId=f.fgId LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID LEFT JOIN category_master AS rg ON r.catId=rg.catId LEFT JOIN category_master AS fgg ON f.category_id=fgg.catId WHERE a.sts!='2' ".$whereSQL."  AND b.eType='2' AND IF(a.iType='1',r.sts!='2',f.sts!='2') AND b.qty!='0' GROUP BY IF(a.iType='1',r.focus_code,f.focus_code), IF(a.iType='1',r.sage_code,f.sage_code), IF(a.iType='1',CONCAT(rg.category_nm,' - ',r.description,' - ',ru.uom),CONCAT(fgg.category_nm,' - ',f.brand,' ',f.descc,' - ',fu.uom)), CONCAT(l.loc_code,' - ',l.location_name) ,a.iType ORDER BY SUM(b.qty) DESC";
	  //echo "AA : ".$qqq."<br>";			
	}
	else
	{
      $qq="SELECT IF(a.iType='1',r.focus_code,f.focus_code) AS focus_code,IF(a.iType='1',r.sage_code,f.sage_code) AS sage_code,IF(a.iType='1',CONCAT(rg.category_nm,' - ',r.description,' - ',ru.uom),CONCAT(fgg.category_nm,' - ',f.brand,' ',f.descc,' - ',fu.uom)) AS desp,SUM(b.qty) AS OUT_QTY,CONCAT(l.loc_code,' - ',l.location_name)AS locNm,a.iType FROM inventory_tbl AS a LEFT JOIN `inventory_info_tbl` AS b ON a.ID=b.invId LEFT JOIN company_tbl AS c ON a.compId=c.ID LEFT JOIN location_tbl AS l ON a.locId=l.ID LEFT JOIN rm_master AS r ON b.itemId=r.rmId LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID LEFT JOIN fg_master AS f ON b.itemId=f.fgId LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID LEFT JOIN category_master AS rg ON r.catId=rg.catId LEFT JOIN category_master AS fgg ON f.category_id=fgg.catId LEFT JOIN admin_usr_loc AS u ON l.ID=u.locId  WHERE a.sts!='2' ".$whereSQL." AND b.eType='2' AND  IF(a.iType='1',r.sts!='2',f.sts!='2') AND u.uid='$uId' AND b.qty!='0' GROUP BY IF(a.iType='1',r.focus_code,f.focus_code), IF(a.iType='1',r.sage_code,f.sage_code), IF(a.iType='1',CONCAT(rg.category_nm,' - ',r.description,' - ',ru.uom),CONCAT(fgg.category_nm,' - ',f.brand,' ',f.descc,' - ',fu.uom)), CONCAT(l.loc_code,' - ',l.location_name) ,a.iType ORDER BY SUM(b.qty) DESC LIMIT $offset,$limit ";
	  //echo "B : ".$qq."<br>";

      $qqq="SELECT a.iType FROM inventory_tbl AS a LEFT JOIN `inventory_info_tbl` AS b ON a.ID=b.invId LEFT JOIN company_tbl AS c ON a.compId=c.ID LEFT JOIN location_tbl AS l ON a.locId=l.ID LEFT JOIN rm_master AS r ON b.itemId=r.rmId LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID LEFT JOIN fg_master AS f ON b.itemId=f.fgId LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID LEFT JOIN category_master AS rg ON r.catId=rg.catId LEFT JOIN category_master AS fgg ON f.category_id=fgg.catId LEFT JOIN admin_usr_loc AS u ON l.ID=u.locId  WHERE a.sts!='2' ".$whereSQL." AND b.eType='2' AND  IF(a.iType='1',r.sts!='2',f.sts!='2') AND u.uid='$uId' AND b.qty!='0' GROUP BY IF(a.iType='1',r.focus_code,f.focus_code), IF(a.iType='1',r.sage_code,f.sage_code), IF(a.iType='1',CONCAT(rg.category_nm,' - ',r.description,' - ',ru.uom),CONCAT(fgg.category_nm,' - ',f.brand,' ',f.descc,' - ',fu.uom)), CONCAT(l.loc_code,' - ',l.location_name) ,a.iType ORDER BY SUM(b.qty) DESC";
	  //echo "BB : ".$qqq."<br>";
	}

    //echo $qq."<br/>";
    $query1   = $mysql->prepare($qqq); 
    $query1->execute();
    //$result1  = $query1->fetch(PDO::FETCH_ASSOC);
    $rowCount= $query1->rowCount();//$result1['rowNum']; 	

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

<!--<th style="color:#fff">Opening Stock</th>-->

<th style="color:#fff;">OUT</th>



</tr>

</thead>

<?php




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
<?php 
} 
?>