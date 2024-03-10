<?php 
if(isset($_POST['page']))
{ 
    // Include pagination library file 
    include('shripage1.php'); 
     
    // Include database configuration file 
    include('mysql.connect.php'); 
     
    // Set some useful configuration 
    $baseURL = 'getrmRegister.php'; 
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
	}
	
	$adparams=$compId."||".$locId."||".$iType;
	
	//echo "S Type : ".$sType." = ".$adparams."<br>";
	
	//echo $uRole.'<br>';
	/*if(empty($_POST['uloc']))
	$uloc="0";
	else
	$uloc=$_POST['uloc'];*/
    //echo "ROLE : ".$uRole."<br>"; 
    // Set conditions for search 
    $whereSQL = ''; 
	
	 
	
	if($compId!='0' && $locId!='0')
	{
		$whereSQL = $whereSQL." AND c.ID='$compId' AND d.ID='$locId' ";
	}
	else if($compId!='0' && $locId=='0')
	{
		$whereSQL = $whereSQL." AND c.ID='$compId' ";
	}
	else
	{
		$whereSQL = $whereSQL."";
	}
	
	
    if(!empty($_POST['keywords']))
	{ 
        /*$whereSQL = " WHERE (first_name LIKE '%".$_POST['keywords']."%' OR last_name LIKE '%".$_POST['keywords']."%' OR email LIKE '%".$_POST['keywords']."%' OR country LIKE '%".$_POST['keywords']."%') "; */
		$whereSQL = $whereSQL." AND (c.company_name LIKE '%".$_POST['keywords']."%' OR d.location_name LIKE '%".$_POST['keywords']."%' OR e.category_nm LIKE '%".$_POST['keywords']."%' OR a.sage_code LIKE '%".$_POST['keywords']."%' OR a.focus_code  LIKE '%".$_POST['keywords']."%' OR a.description LIKE '%".$_POST['keywords']."%' OR b.uom LIKE '%".$_POST['keywords']."%' OR CONCAT(c.company_code,' - ',c.company_name) LIKE '%".$_POST['keywords']."%' OR CONCAT(d.loc_code,' - ',d.location_name) LIKE '%".$_POST['keywords']."%' OR a.reorder_level_qty LIKE '%".$_POST['keywords']."%' OR a.product_expiry LIKE '%".$_POST['keywords']."%' OR a.rackNo LIKE '%".$_POST['keywords']."%' )";
    } 
	
    if(isset($_POST['filterBy']) && $_POST['filterBy'] != '')
	{ 
        /*$whereSQL .= (strpos($whereSQL, 'WHERE') !== false)?" AND ":" WHERE "; 
        $whereSQL .= " sts = ".$_POST['filterBy']; */
    }
     
	if($uRole=='admin' && ($uiType=='3' || $uiType=='0'))
	{	 
		$qqq="SELECT COUNT(a.rmId) AS rowNum FROM `rm_master` AS a LEFT JOIN `uom_tbl` AS b ON a.UOM=b.ID LEFT JOIN `company_tbl` AS c ON a.company_id=c.ID LEFT JOIN `location_tbl` AS d ON a.location_id=d.ID LEFT JOIN category_master AS e ON a.catId=e.catId WHERE a.sts='0' ".$whereSQL." ORDER BY a.rmId ";

		$qq="SELECT a.rmId,a.sage_code,a.focus_code,a.description,b.uom AS unit_name,CONCAT(c.company_code,' - ',c.company_name) AS company_name,CONCAT(d.loc_code,' - ',d.location_name) AS location_name,a.reorder_level_qty,a.product_expiry,a.rackNo,e.category_nm,a.location_id FROM `rm_master` AS a LEFT JOIN `uom_tbl` AS b ON a.UOM=b.ID LEFT JOIN `company_tbl` AS c ON a.company_id=c.ID LEFT JOIN `location_tbl` AS d ON a.location_id=d.ID LEFT JOIN category_master AS e ON a.catId=e.catId WHERE a.sts='0' ".$whereSQL." ORDER BY a.rmId LIMIT $offset,$limit";
		//echo $qq."<Br>".$qqq."<Br>";
	}
	else
	{
		$qqq="SELECT COUNT(a.rmId) AS rowNum FROM `rm_master` AS a LEFT JOIN `uom_tbl` AS b ON a.UOM=b.ID LEFT JOIN `company_tbl` AS c ON a.company_id=c.ID LEFT JOIN `location_tbl` AS d ON a.location_id=d.ID LEFT JOIN category_master AS e ON a.catId=e.catId LEFT JOIN admin_usr_loc AS us ON a.location_id=us.locId WHERE a.sts='0' ".$whereSQL." AND us.uid='$uId' ORDER BY a.rmId ";

		$qq="SELECT a.rmId,a.sage_code,a.focus_code,a.description,b.uom AS unit_name,CONCAT(c.company_code,' - ',c.company_name) AS company_name,CONCAT(d.loc_code,' - ',d.location_name) AS location_name,a.reorder_level_qty,a.product_expiry,a.rackNo,e.category_nm ,a.location_id FROM `rm_master` AS a LEFT JOIN `uom_tbl` AS b ON a.UOM=b.ID LEFT JOIN `company_tbl` AS c ON a.company_id=c.ID LEFT JOIN `location_tbl` AS d ON a.location_id=d.ID LEFT JOIN category_master AS e ON a.catId=e.catId LEFT JOIN admin_usr_loc AS us ON a.location_id=us.locId WHERE a.sts='0' ".$whereSQL." AND us.uid='$uId' ORDER BY a.rmId LIMIT $offset,$limit";
		//echo "Else  - ".$qq."<Br>";
	}

	$query1   = $mysql->prepare($qqq); 
	$query1->execute();
	$result1  = $query1->fetch(PDO::FETCH_ASSOC);
	$rowCount= $result1['rowNum']; 	

	$query=$mysql->prepare($qq);
	$query->execute();	
	$paginationData=$query->fetchAll();	
	
	
	//admin_tbl 
	$qEditDel="SELECT act_edit AS ed,act_delete AS del FROM admin_tbl WHERE sts='0' AND id='".$uId."'";
	//echo $qEditDel."<Br>";	
	$stmEditDel=$mysql->prepare($qEditDel);
	$stmEditDel->execute();
	$rowEditDel=$stmEditDel->fetch(PDO::FETCH_ASSOC);
	$ed=$rowEditDel['ed'];
	$dels=$rowEditDel['del'];	
	//admin_tbl
	
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
<tr style="background-color:#b02923;font-size:14px;">
<th style="color:#fff;text-align:center">Sr.No.</th>
<th style="color:#fff;text-align:center">Category</th>
<th style="color:#fff;text-align:center">Sage Code</th>
<th style="color:#fff;text-align:center">Focus Code</th>
<th style="color:#fff;text-align:center">Description</th>
<th style="color:#fff;text-align:center">Pack. Size / UOM</th>
<th style="color:#fff;text-align:center">Company</th>
<th style="color:#fff;text-align:center">Location</th>
<th style="color:#fff;text-align:center">Reorder Level Qty</th>
<th style="color:#fff;text-align:center">Prod. Expiry</th>
<th style="color:#fff;text-align:center">Rack No.</th>
<th style="color:#fff;text-align:center">Edit</th>
<th style="color:#fff;text-align:center">Delete</th>
</tr>
</thead>
<?php 
foreach ($paginationData as $row) 
{
	$id=$row['rmId'];
	$loc_id=$row['location_id'];
	
      $offset++ ;	
	if($uRole=='admin' && $uiType=='3')
	{
      echo'<tr style="color:#000;font-weight:600;">';
      echo '<td>'.$offset .'</td>';
      echo '<td>'.$row['category_nm'].'</td>';
      echo '<td>'.$row['sage_code'].'</td>';
      echo '<td>'.$row['focus_code'].'</td>';
      echo '<td>'.$row['description'].'</td>';
      echo '<td>'.$row['unit_name'].'</td>';
      echo '<td>'.$row['company_name'].'</td>';
      echo '<td>'.$row['location_name'].'</td>';
      echo '<td>'.$row['reorder_level_qty'].'</td>';
      echo '<td>'.$row['product_expiry'].'</td>';
      echo '<td>'.$row['rackNo'].'</td>';
      /*echo '<td align="center"><a href="javascript:erate('.$id.')"><i class="fa fa-eye"></i></a></td>';*/
      if($ed==0)
      {
      echo '<td>-</td>';  
      }
      else
      {
      echo '<td align="center"><a href="javascript:edit('.$id.')"><i class="fa fa-edit"></i></a></td>';
      }
      if($dels==0)
      {
      echo '<td>-</td>';  
      }
      else
      {
      echo '<td align="center"><a href="javascript:del('.$id.','.$userId.')"><i class="fa fa-trash" style="color:#F00"></i></a></td>';
      }
      echo '</tr>';
	}
	else
	{
      echo'<tr style="color:#000;font-weight:600;">';
      echo '<td>'.$offset.'</td>';
      echo '<td>'.$row['category_nm'].'</td>';
      echo '<td>'.$row['sage_code'].'</td>';
      echo '<td>'.$row['focus_code'].'</td>';
      echo '<td>'.$row['description'].'</td>';
      echo '<td>'.$row['unit_name'].'</td>';
      echo '<td>'.$row['company_name'].'</td>';
      echo '<td>'.$row['location_name'].'</td>';
      echo '<td>'.$row['reorder_level_qty'].'</td>';
      echo '<td>'.$row['product_expiry'].'</td>';
      echo '<td>'.$row['rackNo'].'</td>';
      /*echo '<td align="center"><a href="javascript:erate('.$id.')"><i class="fa fa-eye"></i></a></td>';*/
      if($ed==0)
      {
      echo '<td>-</td>';  
      }
      else
      {
      echo '<td align="center"><a href="javascript:edit('.$id.')"><i class="fa fa-edit"></i></a></td>';
      }
      if($dels==0)
      {
      echo '<td>-</td>';  
      }
      else
      {
      echo '<td align="center"><a href="javascript:del('.$id.','.$userId.')"><i class="fa fa-trash" style="color:#F00"></i></a></td>';
      }
      echo '</tr>';
	}
}
$mysql=null;
?>
<!--<tfoot>
<tr>
<th>Sr.No.</th>
<th>Customer Code</th>
<th>Customer Name</th>
<th>Address</th>
<th>Contact No</th>
<th>Mobile No</th>
<th>Country</th>
</tr>
</tfoot>-->

</table>
    <!-- Display pagination links --> 
<?php 
} 
?>