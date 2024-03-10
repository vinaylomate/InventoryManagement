<?php 
if(isset($_POST['page']))
{ 
    // Include pagination library file 
    include('shripage2.php'); 
     
    // Include database configuration file 
    include('mysql.connect.php'); 
     
    // Set some useful configuration 
    $baseURL = 'getrmRegister2.php'; 
    $offset = !empty($_POST['page'])?$_POST['page']:0; 
    $limit = 10; 
	
	if(empty($_POST['additionalParam']))
	{	
	$compId=$locId=$iType='0';
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
	
	//echo $uRole."<br>";
	
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
	}
	else
	{
		echo $_POST['additionalParam']."<Br>";
	}
	$adparams="1||".$compId."||".$locId."||".$uId."||".$uiType."||".$uRole."||".$uloc;
     
    // Set conditions for search 
    $whereSQL = ''; 
    if(!empty($_POST['keywords']))
	{ 
        /*$whereSQL = " WHERE (first_name LIKE '%".$_POST['keywords']."%' OR last_name LIKE '%".$_POST['keywords']."%' OR email LIKE '%".$_POST['keywords']."%' OR country LIKE '%".$_POST['keywords']."%') "; */
		$whereSQL = " AND (c.company_name LIKE '%".$_POST['keywords']."%' OR d.location_name LIKE '%".$_POST['keywords']."%' OR e.category_nm LIKE '%".$_POST['keywords']."%' OR a.sage_code LIKE '%".$_POST['keywords']."%' OR a.focus_code  LIKE '%".$_POST['keywords']."%' OR a.description LIKE '%".$_POST['keywords']."%' OR b.uom LIKE '%".$_POST['keywords']."%' OR CONCAT(c.company_code,' - ',c.company_name) LIKE '%".$_POST['keywords']."%' OR CONCAT(d.loc_code,' - ',d.location_name) LIKE '%".$_POST['keywords']."%' OR a.reorder_level_qty LIKE '%".$_POST['keywords']."%' OR a.product_expiry LIKE '%".$_POST['keywords']."%' OR a.rackNo LIKE '%".$_POST['keywords']."%' )";
		
		$query   = $mysql->prepare("SELECT COUNT(a.rmId) AS rowNum FROM `rm_master` AS a LEFT JOIN `uom_tbl` AS b ON a.UOM=b.ID LEFT JOIN `company_tbl` AS c ON a.company_id=c.ID LEFT JOIN `location_tbl` AS d ON a.location_id=d.ID LEFT JOIN category_master AS e ON a.catId=e.catId WHERE a.sts='0' ".$whereSQL);
		$query->execute();
		$result  = $query->fetch(PDO::FETCH_ASSOC); 
		$rowCount= $result['rowNum'];
		
		$q="SELECT a.rmId,a.sage_code,a.focus_code,a.description,b.uom AS unit_name,CONCAT(c.company_code,' - ',c.company_name) AS company_name,CONCAT(d.loc_code,' - ',d.location_name) AS location_name,a.reorder_level_qty,a.product_expiry,a.rackNo,e.category_nm,a.location_id FROM `rm_master` AS a LEFT JOIN `uom_tbl` AS b ON a.UOM=b.ID LEFT JOIN `company_tbl` AS c ON a.company_id=c.ID LEFT JOIN `location_tbl` AS d ON a.location_id=d.ID LEFT JOIN category_master AS e ON a.catId=e.catId WHERE a.sts='0' ".$whereSQL." ORDER BY a.rmId LIMIT $offset,$limit";
    } 
	else
	{
		if($lcnt==1)
		{	
			if($compId!='0' && $locId!='0')
			{
				$whereSQL=$whereSQL." AND c.ID='$compId' AND d.ID='$locId' ";
			}
			else 
			{
				$str=$str." AND d.ID='$compId'";
			}
			//echo "<Br>";
			if($uRole=='admin' && ($uiType=='3' || $uiType=='0'))
			{
				$query   = $mysql->prepare("SELECT COUNT(a.rmId) AS rowNum FROM `rm_master` AS a LEFT JOIN `uom_tbl` AS b ON a.UOM=b.ID LEFT JOIN `company_tbl` AS c ON a.company_id=c.ID LEFT JOIN `location_tbl` AS d ON a.location_id=d.ID LEFT JOIN category_master AS e ON a.catId=e.catId WHERE a.sts='0' ".$whereSQL);
				$query->execute();
				$result  = $query->fetch(PDO::FETCH_ASSOC); 
				$rowCount= $result['rowNum'];

				$q="SELECT a.rmId,a.sage_code,a.focus_code,a.description,b.uom AS unit_name,CONCAT(c.company_code,' - ',c.company_name) AS company_name,CONCAT(d.loc_code,' - ',d.location_name) AS location_name,a.reorder_level_qty,a.product_expiry,a.rackNo,e.category_nm,a.location_id FROM `rm_master` AS a LEFT JOIN `uom_tbl` AS b ON a.UOM=b.ID LEFT JOIN `company_tbl` AS c ON a.company_id=c.ID LEFT JOIN `location_tbl` AS d ON a.location_id=d.ID LEFT JOIN category_master AS e ON a.catId=e.catId WHERE a.sts='0' ".$whereSQL." ORDER BY a.rmId LIMIT $offset,$limit";
			}
			else
			{
				$query   = $mysql->prepare("SELECT COUNT(a.rmId) AS rowNum FROM `rm_master` AS a LEFT JOIN `uom_tbl` AS b ON a.UOM=b.ID LEFT JOIN `company_tbl` AS c ON a.company_id=c.ID LEFT JOIN `location_tbl` AS d ON a.location_id=d.ID LEFT JOIN category_master AS e ON a.catId=e.catId LEFT JOIN admin_usr_loc AS us ON a.location_id=us.locId WHERE a.sts='0' AND us.uid='$uId' ".$whereSQL);
				$query->execute();
				$result  = $query->fetch(PDO::FETCH_ASSOC); 
				$rowCount= $result['rowNum'];

				$q="SELECT a.rmId,a.sage_code,a.focus_code,a.description,b.uom AS unit_name,CONCAT(c.company_code,' - ',c.company_name) AS company_name,CONCAT(d.loc_code,' - ',d.location_name) AS location_name,a.reorder_level_qty,a.product_expiry,a.rackNo,e.category_nm,a.location_id FROM `rm_master` AS a LEFT JOIN `uom_tbl` AS b ON a.UOM=b.ID LEFT JOIN `company_tbl` AS c ON a.company_id=c.ID LEFT JOIN `location_tbl` AS d ON a.location_id=d.ID LEFT JOIN category_master AS e ON a.catId=e.catId LEFT JOIN admin_usr_loc AS us ON a.location_id=us.locId WHERE a.sts='0' AND us.uid='$uId' ".$whereSQL." ORDER BY a.rmId LIMIT $offset,$limit";
				//echo "HEY CHIRU... ".$q."<br>";
			}
		}
		else
		{	
			if($compId!='0')
			{
			  $whereSQL=$whereSQL." AND c.ID='$compId'";
			}
			else 
			{
				$whereSQL=$whereSQL."";
			}

			//echo "<Br>";

			if($compId=='0')
			{
				$query   = $mysql->prepare("SELECT COUNT(a.rmId) AS rowNum FROM `rm_master` AS a LEFT JOIN `uom_tbl` AS b ON a.UOM=b.ID LEFT JOIN `company_tbl` AS c ON a.company_id=c.ID LEFT JOIN `location_tbl` AS d ON a.location_id=d.ID LEFT JOIN category_master AS e ON a.catId=e.catId WHERE a.sts='0'");
				$query->execute();
				$result  = $query->fetch(PDO::FETCH_ASSOC); 
				$rowCount= $result['rowNum'];

				$q="SELECT a.rmId,a.sage_code,a.focus_code,a.description,b.uom AS unit_name,CONCAT(c.company_code,' - ',c.company_name) AS company_name,CONCAT(d.loc_code,' - ',d.location_name) AS location_name,a.reorder_level_qty,a.product_expiry,a.rackNo,e.category_nm,a.location_id FROM `rm_master` AS a LEFT JOIN `uom_tbl` AS b ON a.UOM=b.ID LEFT JOIN `company_tbl` AS c ON a.company_id=c.ID LEFT JOIN `location_tbl` AS d ON a.location_id=d.ID LEFT JOIN category_master AS e ON a.catId=e.catId WHERE a.sts='0' ORDER BY a.rmId LIMIT $offset,$limit";
			}
			else
			{
				if($uRole=='admin' && ($uiType=='3' || $uiType=='0'))
				{
					$query   = $mysql->prepare("SELECT COUNT(a.rmId) AS rowNum FROM `rm_master` AS a LEFT JOIN `uom_tbl` AS b ON a.UOM=b.ID LEFT JOIN `company_tbl` AS c ON a.company_id=c.ID LEFT JOIN `location_tbl` AS d ON a.location_id=d.ID LEFT JOIN category_master AS e ON a.catId=e.catId WHERE a.sts='0' ".$whereSQL);
					$query->execute();
					$result  = $query->fetch(PDO::FETCH_ASSOC); 
					$rowCount= $result['rowNum'];

					$q="SELECT a.rmId,a.sage_code,a.focus_code,a.description,b.uom AS unit_name,CONCAT(c.company_code,' - ',c.company_name) AS company_name,CONCAT(d.loc_code,' - ',d.location_name) AS location_name,a.reorder_level_qty,a.product_expiry,a.rackNo,e.category_nm,a.location_id FROM `rm_master` AS a LEFT JOIN `uom_tbl` AS b ON a.UOM=b.ID LEFT JOIN `company_tbl` AS c ON a.company_id=c.ID LEFT JOIN `location_tbl` AS d ON a.location_id=d.ID LEFT JOIN category_master AS e ON a.catId=e.catId WHERE a.sts='0' ".$whereSQL." ORDER BY a.rmId LIMIT $offset,$limit";
				}
				else
				{
					$query   = $mysql->prepare("SELECT COUNT(a.rmId) AS rowNum FROM `rm_master` AS a LEFT JOIN `uom_tbl` AS b ON a.UOM=b.ID LEFT JOIN `company_tbl` AS c ON a.company_id=c.ID LEFT JOIN `location_tbl` AS d ON a.location_id=d.ID LEFT JOIN category_master AS e ON a.catId=e.catId LEFT JOIN admin_usr_loc AS us ON a.location_id=us.locId WHERE a.sts='0' AND us.uid='$uId' ".$whereSQL);
					$query->execute();
					$result  = $query->fetch(PDO::FETCH_ASSOC); 
					$rowCount= $result['rowNum'];

					$q="SELECT a.rmId,a.sage_code,a.focus_code,a.description,b.uom AS unit_name,CONCAT(c.company_code,' - ',c.company_name) AS company_name,CONCAT(d.loc_code,' - ',d.location_name) AS location_name,a.reorder_level_qty,a.product_expiry,a.rackNo,e.category_nm,a.location_id FROM `rm_master` AS a LEFT JOIN `uom_tbl` AS b ON a.UOM=b.ID LEFT JOIN `company_tbl` AS c ON a.company_id=c.ID LEFT JOIN `location_tbl` AS d ON a.location_id=d.ID LEFT JOIN category_master AS e ON a.catId=e.catId LEFT JOIN admin_usr_loc AS us ON a.location_id=us.locId WHERE a.sts='0' AND us.uid='$uId' ".$whereSQL." ORDER BY a.rmId LIMIT $offset,$limit";
				}
			}
			//echo "hhh : ".$q."<br>";
		}	
	}
	
    if(isset($_POST['filterBy']) && $_POST['filterBy'] != ''){ 
        /*$whereSQL .= (strpos($whereSQL, 'WHERE') !== false)?" AND ":" WHERE "; 
        $whereSQL .= " sts = ".$_POST['filterBy']; */
    } 
     
    // Count of all records 
    //$query   = $mysql->prepare("SELECT COUNT(*) as rowNum FROM users ".$whereSQL); 
	 
     
    // Initialize pagination class 
    $pagConfig = array( 
        'baseURL' => $baseURL, 
        'totalRows' => $rowCount, 
        'perPage' => $limit, 
        'currentPage' => $offset, 
        'contentDiv' => 'tbl', 
        'additionalParam' => $adparams, 
        'link_func' => '' 
    ); 
    $pagination =  new Pagination($pagConfig); 
 
    // Fetch records based on the offset and limit 
    /*$query = $mysql->prepare("SELECT * FROM users $whereSQL ORDER BY id DESC LIMIT $offset,$limit");
	$query->execute();*/
	
	//echo $q."<Br>";	
	$query = $mysql->prepare($q); 
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