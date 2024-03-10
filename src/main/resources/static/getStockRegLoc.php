<?php
if(isset($_POST['page']))
{
// Include pagination library file 
    include('shripage1.php'); 
     
    // Include database configuration file 
    include('mysql.connect.php'); 
     
    // Set some useful configuration 
    $baseURL = 'getStockRegLoc.php'; 
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

		$uId=$_POST['uId'];
		$uiType=$_POST['uiType'];
		$uRole=$_POST['urole'];
	}
	else
	{
		if(!empty($_POST['compId']))
		$compId=$_POST['compId'];

		if(!empty($_POST['iType']))
		$iType=$_POST['iType'];
		else
		$iType="1";

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
	}
	
//echo "ABCYY : ".$uRole."<Br>";
	$whereSQL = ''; 
	$whereSQL1 = ''; 
	
	$adparams=$compId."||".$locId."||".$iType."||".$catId;
	//echo "S Type : ".$sType." = ".$adparams." = ROLE : ".$uRole."<br>";
	
	if($compId!='0' && $iType!='0' && $catId=='0')
	{
		$whereSQL = $whereSQL." AND a.compId='$compId' AND a.iType='$iType'";
		$whereSQL1=$whereSQL1." AND company_id='$compId' AND iType='$iType'";
	}
	else if($compId!='0' && $iType!='0' && $catId!='0')
	{
		$whereSQL = $whereSQL." AND a.compId='$compId' AND a.iType='$iType' AND r.catId='$catId'";
		$whereSQL1=$whereSQL1." AND company_id='$compId' AND iType='$iType'";
	}
	else if($compId=='0' && $iType!='0' && $catId!='0')
	{
		$whereSQL = $whereSQL." AND a.iType='$iType' AND r.catId='$catId'";
		$whereSQL1=$whereSQL1." AND iType='$iType'";
	}
	else	
	{
		$whereSQL = $whereSQL." AND a.iType='$iType' ";
		$whereSQL1=$whereSQL1." AND iType='$iType' ";
	}
	
    if(!empty($_POST['keywords']))
	{ 
        /*$whereSQL = " WHERE (first_name LIKE '%".$_POST['keywords']."%' OR last_name LIKE '%".$_POST['keywords']."%' OR email LIKE '%".$_POST['keywords']."%' OR country LIKE '%".$_POST['keywords']."%') "; */
		$whereSQL = $whereSQL." AND (r.focus_code LIKE '%".$_POST['keywords']."%' OR r.sage_code LIKE '%".$_POST['keywords']."%' OR CONCAT(r.description,' - ',ru.uom) LIKE '%".$_POST['keywords']."%' )";
    } 
    if(isset($_POST['filterBy']) && $_POST['filterBy'] != ''){ 
        /*$whereSQL .= (strpos($whereSQL, 'WHERE') !== false)?" AND ":" WHERE "; 
        $whereSQL .= " sts = ".$_POST['filterBy']; */
    } 





if($uRole=='admin' && ($uiType=='3'||$uiType=='0'))
{		
	$qq="SELECT r.focus_code,r.sage_code,CONCAT(r.description,' - ',ru.uom) AS desp FROM stock_tbl AS a LEFT JOIN company_tbl AS c ON a.compId=c.ID LEFT JOIN location_tbl AS l ON a.locId=l.ID LEFT JOIN rm_master AS r ON a.itemId=r.rmId LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID LEFT JOIN category_master AS rg ON r.catId=rg.catId WHERE a.sts='0'  ".$whereSQL." AND a.sts!='2' AND r.sts!='2' GROUP BY r.focus_code,r.sage_code,r.description,ru.uom ORDER BY SUBSTRING(r.focus_code,1,9), SUBSTRING(r.focus_code,10)*1 LIMIT $offset,$limit ";

	$qqq="SELECT r.focus_code FROM stock_tbl AS a LEFT JOIN company_tbl AS c ON a.compId=c.ID LEFT JOIN location_tbl AS l ON a.locId=l.ID LEFT JOIN rm_master AS r ON a.itemId=r.rmId LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID LEFT JOIN category_master AS rg ON r.catId=rg.catId WHERE a.sts='0' ".$whereSQL." AND a.sts!='2' AND r.sts!='2' GROUP BY r.focus_code,r.sage_code,r.description,ru.uom ORDER BY SUBSTRING(r.focus_code,1,9), SUBSTRING(r.focus_code,10)*1";	
	
	//echo $qq."<br/>";
}
else
{		
	$qq="SELECT r.focus_code,r.sage_code,CONCAT(r.description,' - ',ru.uom) AS desp FROM stock_tbl AS a LEFT JOIN company_tbl AS c ON a.compId=c.ID LEFT JOIN location_tbl AS l ON a.locId=l.ID LEFT JOIN rm_master AS r ON a.itemId=r.rmId LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID LEFT JOIN category_master AS rg ON r.catId=rg.catId LEFT JOIN admin_usr_loc AS us ON l.ID=us.locId WHERE a.sts='0' ".$whereSQL." AND a.sts!='2' AND r.sts!='2' AND us.uid='$uId' GROUP BY r.focus_code,r.sage_code,r.description,ru.uom ORDER BY SUBSTRING(r.focus_code,1,9), SUBSTRING(r.focus_code,10)*1 LIMIT $offset,$limit";
	
	$qqq="SELECT r.focus_code FROM stock_tbl AS a LEFT JOIN company_tbl AS c ON a.compId=c.ID LEFT JOIN location_tbl AS l ON a.locId=l.ID LEFT JOIN rm_master AS r ON a.itemId=r.rmId LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID LEFT JOIN category_master AS rg ON r.catId=rg.catId LEFT JOIN admin_usr_loc AS us ON l.ID=us.locId WHERE a.sts='0' ".$whereSQL." AND a.sts!='2' AND r.sts!='2' AND us.uid='$uId' GROUP BY r.focus_code,r.sage_code,r.description,ru.uom ORDER BY SUBSTRING(r.focus_code,1,9), SUBSTRING(r.focus_code,10)*1";	
}

//echo $qq."<br/>";
$query1   = $mysql->prepare($qqq); 
$query1->execute();
//$result1  = $query1->fetch(PDO::FETCH_ASSOC);
//$rowCount= $result1['rowNum']; 	
$rowCount= $query1->rowCount();
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
<th style="color:#fff;">Focus Code</th>
<th style="color:#fff">Sage Code</th>
<th style="color:#fff;">Product</th>
<?php
$ql="SELECT ID,loc_code,location_name FROM location_tbl WHERE sts!='2' ".$whereSQL1." ORDER BY loc_code";	
$stl=$mysql->prepare($ql);
$stl->execute();
$loc=array();
$l=0;	
while($row1=$stl->fetch(PDO::FETCH_ASSOC))
{
$loc[$l]=$row1['ID'];
?>
<th style="color:#fff"><?php echo $row1['loc_code']." - ".$row1['location_name'];?></th>
<?php
$l++;
}
?>
<th style="color:#fff;">Total</th>
</tr>
</thead>
<?php 

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
	$qqqq="SELECT r.focus_code,r.sage_code,r.description,ru.uom,SUM(a.stk_qty) AS stk FROM stock_tbl AS a LEFT JOIN rm_master AS r ON a.itemId=r.rmId LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID WHERE a.sts!='2' AND r.sts!='2' AND r.focus_code='".$row['focus_code']."' AND r.sage_code='".$row['sage_code']."' AND a.locId='$loc[$i]' GROUP BY r.focus_code,r.sage_code,r.description,ru.uom";
	//if($row['focus_code']=='AC001' || $row['sage_code']=='RMSL-AC0001-000K0001')
	//echo $qqqq."<Br>";
	$stl1=$mysql->prepare($qqqq);
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

?>
<tfoot>
<tr style="background-color:#b02923">
<th style="color:#fff;"></th>
<th style="color:#fff"></th>
<th style="color:#fff;"></th>
<?php
$ql="SELECT loc_code,location_name FROM location_tbl WHERE sts!='2' ".$whereSQL1." ORDER BY loc_code";	
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
?>
<th style="color:#fff;"><?php echo $a;?></th>
</tr>
</tfoot>
					
</table>	
<?php 
} 
?>