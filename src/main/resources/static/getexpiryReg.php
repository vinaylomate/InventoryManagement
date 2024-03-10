<?php
if(isset($_POST['page']))
{
// Include pagination library file 
    include('shripage1.php'); 
     
    // Include database configuration file 
    include('mysql.connect.php'); 
     
    // Set some useful configuration 
    $baseURL = 'getexpiryReg.php'; 
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

		if(!empty($_POST['iType']))
		$iType=$_POST['iType'];	

		$uId=$_POST['uId'];
		$uiType=$_POST['uiType'];
		$uRole=$_POST['urole'];

		if(empty($_POST['uloc']))
		$uloc="0";
		else
		$uloc=$_POST['uloc'];

		if(empty($_POST['catId']))
		$catId="0";
		else
		$catId=$_POST['catId'];

		if(empty($_POST['brand']))
		$brand="0";
		else
		$brand=$_POST['brand'];
	}
	$whereSQL = ''; 
	$adparams=$compId."||".$locId."||".$iType."||".$catId."||".$brand;
	
	//echo "S Type : ".$sType." = ".$adparams." = ROLE : ".$uRole."<br>";
	
	if($compId!='0' && $locId!='0' && $iType!='0' && $catId=='0' && $brand=='0')
	{
		$whereSQL=$whereSQL." AND b.ID='$compId' AND c.ID='$locId' AND a.iType='$iType'";
		//echo "AD-1".$whereSQL."<Br>";
	}
	else if($compId!='0' && $locId=='0' && $iType!='0' && $catId=='0' && $brand=='0')
	{
		$whereSQL=$whereSQL." AND b.ID='$compId' AND a.iType='$iType'";
		//echo "AD-2".$whereSQL."<Br>";
	}
	else if($compId!='0' && $locId!='0' && $iType!='0' && $catId!='0' && $brand!='0')
	{
		$whereSQL=$whereSQL." AND b.ID='$compId' AND a.iType='$iType' AND c.ID='$locId' AND IF(a.iType='1',r.catId,f.category_id)='$catId' AND f.brand='$brand' ";
		//echo "AD-3".$whereSQL."<Br>";
	}	
	else if($compId!='0' && $locId!='0' && $iType!='0' && $catId!='0' && $brand=='0')
	{
		$whereSQL=$whereSQL." AND b.ID='$compId' AND a.iType='$iType' AND c.ID='$locId' AND IF(a.iType='1',r.catId,f.category_id)='$catId' ";
		//echo "AD-4".$whereSQL."<Br>";
	}
	else if($compId!='0' && $locId!='0' && $iType!='0' && $catId=='0' && $brand!='0')
	{
		$whereSQL=$whereSQL." AND b.ID='$compId' AND a.iType='$iType' AND c.ID='$locId' AND f.brand='$brand' ";
		//echo "AD-5".$whereSQL."<Br>";
	}
	else if($compId!='0' && $locId=='0' && $iType!='0' && $catId!='0' && $brand!='0')
	{
		$whereSQL=$whereSQL." AND b.ID='$compId' AND a.iType='$iType' AND IF(a.iType='1',r.catId,f.category_id)='$catId' AND f.brand='$brand' ";
		//echo "AD-6".$whereSQL."<Br>";
	}
	else if($compId!='0' && $locId=='0' && $iType!='0' && $catId!='0' && $brand=='0')
	{
		$whereSQL=$whereSQL." AND b.ID='$compId' AND a.iType='$iType' AND IF(a.iType='1',r.catId,f.category_id)='$catId' ";
		//echo "AD-7".$whereSQL."<Br>";
	}
	else if($compId!='0' && $locId=='0' && $iType!='0' && $catId=='0' && $brand!='0')
	{
		$whereSQL=$whereSQL." AND b.ID='$compId' AND a.iType='$iType' AND f.brand='$brand' ";
		//echo "AD-8".$whereSQL."<Br>";
	}	
	else if($compId!='0' && $locId=='0' && $iType=='0' && $catId=='0' && $brand=='0')
	{
		$whereSQL=$whereSQL." AND b.ID='$compId' ";
		//echo "AD-9".$whereSQL."<Br>";
	}					
	else 
	{
		$whereSQL=$whereSQL." ";
		//echo "AD-10".$whereSQL."<Br>";
	}
	
	
	
    if(!empty($_POST['keywords']))
	{ 
        /*$whereSQL = " WHERE (first_name LIKE '%".$_POST['keywords']."%' OR last_name LIKE '%".$_POST['keywords']."%' OR email LIKE '%".$_POST['keywords']."%' OR country LIKE '%".$_POST['keywords']."%') "; */
		$whereSQL=$whereSQL." AND (CONCAT(c.loc_code,' - ', c.location_name) LIKE '%".$_POST['keywords']."%' OR IF(a.iType='1',d.focus_code,f.focus_code) LIKE '%".$_POST['keywords']."%' OR IF(a.iType='1',d.sage_code,f.sage_code) LIKE '%".$_POST['keywords']."%' OR IF(a.iType='1',d.description,CONCAT(g.category_nm,' ',f.brand,' ',f.descc)) LIKE '%".$_POST['keywords']."%' OR IF(a.iType='1',u.uom,u2.uom)  LIKE '%".$_POST['keywords']."%' OR a.batchNo LIKE '%".$_POST['keywords']."%' OR IF(a.stk_qty='0',a.openstk,a.stk_qty) LIKE '%".$_POST['keywords']."%' OR a.expdt LIKE '%".$_POST['keywords']."%' )";
    } 
    if(isset($_POST['filterBy']) && $_POST['filterBy'] != ''){ 
        /*$whereSQL .= (strpos($whereSQL, 'WHERE') !== false)?" AND ":" WHERE "; 
        $whereSQL .= " sts = ".$_POST['filterBy']; */
    } 		

	if($uRole=='admin' && ($uiType=='3' || $uiType=='0'))
	{
		$qq="SELECT a.ID,a.docNo,a.dt,a.compId,CONCAT(b.company_code,' - ',b.company_name) AS compNm,a.locId,c.loc_code  AS loc,a.iType,IF(a.iType='1','RM','FG') AS iTypeNm,a.itemId,IF(a.iType='1',d.focus_code,f.focus_code) AS fc,IF(a.iType='1',d.sage_code,f.sage_code) AS sg,IF(a.iType='1',CONCAT(d.description,' - ',u.uom),CONCAT(f.descc,' - ',u2.uom)) AS itemNm,IF(a.iType='1',u.uom,u2.uom) AS uom,IF(a.stk_qty='0',a.openstk,a.stk_qty) AS qty,a.expdt,a.uid,TIMESTAMPDIFF(MONTH, CURRENT_DATE(),a.expdt) AS mnt,a.batchNo FROM stock_tbl_2 AS a LEFT JOIN company_tbl AS b ON a.compId=b.ID LEFT JOIN location_tbl AS c ON a.locId=c.ID LEFT JOIN rm_master AS d ON a.itemId=d.rmId	LEFT JOIN uom_tbl AS u ON d.UOM=u.ID LEFT JOIN fg_master AS f ON a.itemId=f.fgId LEFT JOIN uom_tbl AS u2 ON f.uom=u2.ID LEFT JOIN category_master AS g ON f.category_id=g.catId LEFT JOIN category_master AS rg ON d.catId=rg.catId WHERE a.sts!='2' AND b.sts!='2' AND c.sts!='2' AND a.out_qty='0' AND IF(a.iType='1',d.sts!='2',f.sts!='2') ".$whereSQL." ORDER BY a.ID LIMIT $offset,$limit";

		//echo "A : ".$qq."<br>";

		$qqq="SELECT COUNT(a.ID) AS rowNum FROM stock_tbl_2 AS a LEFT JOIN company_tbl AS b ON a.compId=b.ID LEFT JOIN location_tbl AS c ON a.locId=c.ID LEFT JOIN rm_master AS d ON a.itemId=d.rmId	LEFT JOIN uom_tbl AS u ON d.UOM=u.ID LEFT JOIN fg_master AS f ON a.itemId=f.fgId LEFT JOIN uom_tbl AS u2 ON f.uom=u2.ID LEFT JOIN category_master AS g ON f.category_id=g.catId LEFT JOIN category_master AS rg ON d.catId=rg.catId WHERE a.sts!='2' AND b.sts!='2' AND c.sts!='2' AND a.out_qty='0' AND IF(a.iType='1',d.sts!='2',f.sts!='2') ".$whereSQL." ORDER BY a.ID";

		//echo "AA : ".$qqq."<br>";
	}
	else
	{

		$qq="SELECT a.ID,a.docNo,a.dt,a.compId,CONCAT(b.company_code,' - ',b.company_name) AS compNm,a.locId,c.loc_code  AS loc,a.iType,IF(a.iType='1','RM','FG') AS iTypeNm,a.itemId,IF(a.iType='1',d.focus_code,f.focus_code) AS fc,IF(a.iType='1',d.sage_code,f.sage_code) AS sg,IF(a.iType='1',CONCAT(d.description,' - ',u.uom),CONCAT(f.descc,' - ',u2.uom)) AS itemNm,IF(a.iType='1',u.uom,u2.uom) AS uom,IF(a.stk_qty='0',a.openstk,a.stk_qty) AS qty,a.expdt,a.uid,TIMESTAMPDIFF(MONTH, CURRENT_DATE(),a.expdt) AS mnt,a.batchNo FROM stock_tbl_2 AS a LEFT JOIN company_tbl AS b ON a.compId=b.ID LEFT JOIN location_tbl AS c ON a.locId=c.ID LEFT JOIN rm_master AS d ON a.itemId=d.rmId	LEFT JOIN uom_tbl AS u ON d.UOM=u.ID LEFT JOIN fg_master AS f ON a.itemId=f.fgId LEFT JOIN uom_tbl AS u2 ON f.uom=u2.ID LEFT JOIN category_master AS g ON f.category_id=g.catId LEFT JOIN category_master AS rg ON d.catId=rg.catId LEFT JOIN admin_usr_loc AS u ON c.ID=u.locId WHERE a.sts!='2' AND b.sts!='2' AND c.sts!='2' AND a.out_qty='0' AND IF(a.iType='1',d.sts!='2',f.sts!='2') ".$whereSQL." AND u.uid='$uId' ORDER BY a.ID LIMIT $offset,$limit ";
		//echo "B : ".$qq."<br>";
		
		$qqq="SELECT COUNT(a.ID) AS rowNum FROM stock_tbl_2 AS a LEFT JOIN company_tbl AS b ON a.compId=b.ID LEFT JOIN location_tbl AS c ON a.locId=c.ID LEFT JOIN rm_master AS d ON a.itemId=d.rmId	LEFT JOIN uom_tbl AS u ON d.UOM=u.ID LEFT JOIN fg_master AS f ON a.itemId=f.fgId LEFT JOIN uom_tbl AS u2 ON f.uom=u2.ID LEFT JOIN category_master AS g ON f.category_id=g.catId LEFT JOIN category_master AS rg ON d.catId=rg.catId LEFT JOIN admin_usr_loc AS u ON c.ID=u.locId WHERE a.sts!='2' AND b.sts!='2' AND c.sts!='2' AND a.out_qty='0' AND IF(a.iType='1',d.sts!='2',f.sts!='2') ".$whereSQL." AND u.uid='$uId' ORDER BY a.ID";	
		//echo "BB : ".$qqq."<br>";
	}

//echo $qqq.'<br>';	
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
<div>    
<?php echo $pagination->createLinks();  ?>
</div>
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

<thead>

<tr style="background-color:#b02923">

<th style="color:#fff">Date</th>

<!--<th style="color:#fff">Doc. No</th>-->

<th style="color:#fff">Location</th>

<th style="color:#fff;">Focus Code</th>

<th style="color:#fff">Sage Code</th>

<th style="color:#fff">Product</th>

<th style="color:#fff">Batch No</th>

<th style="color:#fff">Qty</th>

<th style="color:#fff">Prod. Exp. Date</th>

</tr>

</thead>

<?php 




$cnt=1;

$crd=date('Y-m');

foreach ($paginationData as $row) 

{	

	$id=$row['iid'];



	$expdt=date('Y-m',strtotime($row['expdt']));

	//echo "Current : ".$crd."|| Expdt : ".$expdt."<Br>";

	$date_diff = abs(strtotime($crd) - strtotime($expdt));

	$years = floor($date_diff / (365*60*60*24));

	if($crd>$expdt)

	{

	  $mnt = "-".floor(($date_diff - $years * 365*60*60*24) / (30*60*60*24));

	}

	else

	{

	  $mnt = floor(($date_diff - $years * 365*60*60*24) / (30*60*60*24));

	}

	//echo $id." : ".$date_diff." || Year : ".$years." || Months : ".$mnt."<Br>";



	  if($mnt <=1 && $mnt<2 && $years==0)

	  {

		  echo'<tr style="color:#F00;font-weight:bold;">';

		  echo '<td>'.date('d-m-Y',strtotime($row['dt'])).'</td>';

		  echo '<td>'.$row['loc'].'</td>';

		  echo '<td>'.$row['fc'].'</td>';

		  echo '<td>'.$row['sg'].'</td>';

		  echo '<td>'.$row['itemNm'].' - '.$row['uom'].'</td>';

		  echo '<td>'.$row['batchNo'].'</td>';				  

		  echo '<td>'.$row['qty'].'</td>';		

		  echo '<td>'.date('d-m-Y',strtotime($row['expdt'])).'</td>';

		  echo '</tr>';

	  }

	  else if($mnt >=2 && $mnt<3 && $years==0)

	  {

		  echo'<tr style="color:orange;font-weight:bold;">';

		  echo '<td>'.date('d-m-Y',strtotime($row['dt'])).'</td>';

		  echo '<td>'.$row['loc'].'</td>';

		  echo '<td>'.$row['fc'].'</td>';

		  echo '<td>'.$row['sg'].'</td>';

		  echo '<td>'.$row['itemNm'].' - '.$row['uom'].'</td>';

		  echo '<td>'.$row['batchNo'].'</td>';				  

		  echo '<td>'.$row['qty'].'</td>';		

		  echo '<td>'.date('d-m-Y',strtotime($row['expdt'])).'</td>';

		  echo '</tr>';

	  }	

	  else if($mnt=='3' && $years==0)

	  {

		  echo'<tr style="color:#0472c9;font-weight:bold;">';

		  echo '<td>'.date('d-m-Y',strtotime($row['dt'])).'</td>';

		  echo '<td>'.$row['loc'].'</td>';

		  echo '<td>'.$row['fc'].'</td>';

		  echo '<td>'.$row['sg'].'</td>';

		  echo '<td>'.$row['itemNm'].' - '.$row['uom'].'</td>';

		  echo '<td>'.$row['batchNo'].'</td>';				  

		  echo '<td>'.$row['qty'].'</td>';		

		  echo '<td>'.date('d-m-Y',strtotime($row['expdt'])).'</td>';

		  echo '</tr>';

	  }				 

	  else

	  {

		  echo'<tr style="background-color:#FFF;color:#000;font-weight:bold;">';

		  echo '<td>'.date('d-m-Y',strtotime($row['dt'])).'</td>';

		  echo '<td>'.$row['loc'].'</td>';

		  echo '<td>'.$row['fc'].'</td>';

		  echo '<td>'.$row['sg'].'</td>';

		  echo '<td>'.$row['itemNm'].' - '.$row['uom'].'</td>';

		  echo '<td>'.$row['batchNo'].'</td>';				  

		  echo '<td>'.$row['qty'].'</td>';		

		  echo '<td>'.date('d-m-Y',strtotime($row['expdt'])).'</td>';

		  echo '</tr>';

	  }

	$cnt++;



}

$mysql=null;

?>

<tbody>

</tbody>

</table>

<?php 
} 
?>