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


include('mysql.connect.php');
$str="";
if($lcnt==1)
{	
	if($compId!='0' && $locId!='0' && $srch=='0')
	{
		$str=$str." AND c.ID='$compId' AND d.ID='$locId' ";
	}
	else if($compId!='0' && $locId!='0' && $srch!='0')
	{
      $str=$str." AND c.ID='$compId' AND d.ID='$locId' AND (e.category_nm LIKE '%".$srch."%' OR a.sage_code LIKE '%".$srch."%' OR a.focus_code  LIKE '%".$srch."%' OR a.description LIKE '%".$srch."%' OR b.uom LIKE '%".$srch."%' OR CONCAT(c.company_code,' - ',c.company_name) LIKE '%".$srch."%' OR CONCAT(d.loc_code,' - ',d.location_name) LIKE '%".$srch."%' 
      OR a.reorder_level_qty LIKE '%".$srch."%' OR a.product_expiry LIKE '%".$srch."%' OR a.rackNo LIKE '%".$srch."%' )";
	}	
	else if($compId!='0' && $locId=='0' && $srch!='0')
	{
      $str=$str." AND c.ID='$compId' AND (e.category_nm LIKE '%".$srch."%' OR a.sage_code LIKE '%".$srch."%' OR a.focus_code  LIKE '%".$srch."%' OR a.description LIKE '%".$srch."%'  OR b.uom LIKE '%".$srch."%' OR CONCAT(c.company_code,' - ',c.company_name) LIKE '%".$srch."%' OR CONCAT(d.loc_code,' - ',d.location_name) LIKE '%".$srch."%' OR a.reorder_level_qty LIKE '%".$srch."%' OR a.product_expiry LIKE '%".$srch."%' OR a.rackNo LIKE '%".$srch."%' )";
	}
	else 
	{
		$str=$str." AND d.ID='$compId'";
	}
	//echo "<Br>";
    if($uRole=='admin' && ($uiType=='3' || $uiType=='0'))
	{
		$qq="SELECT a.rmId,a.sage_code,a.focus_code,a.description,b.uom AS unit_name,CONCAT(c.company_code,' - ',c.company_name) AS company_name,CONCAT(d.loc_code,' - ',d.location_name) AS location_name,a.reorder_level_qty,a.product_expiry,a.rackNo,e.category_nm ,a.location_id FROM `rm_master` AS a LEFT JOIN `uom_tbl` AS b ON a.UOM=b.ID LEFT JOIN `company_tbl` AS c ON a.company_id=c.ID LEFT JOIN `location_tbl` AS d ON a.location_id=d.ID LEFT JOIN category_master AS e ON a.catId=e.catId WHERE a.sts='0' ".$str." ORDER BY a.rmId";
	}
	else
	{
		$qq="SELECT a.rmId,a.sage_code,a.focus_code,a.description,b.uom AS unit_name,CONCAT(c.company_code,' - ',c.company_name) AS company_name,CONCAT(d.loc_code,' - ',d.location_name) AS location_name,a.reorder_level_qty,a.product_expiry,a.rackNo,e.category_nm ,a.location_id FROM `rm_master` AS a LEFT JOIN `uom_tbl` AS b ON a.UOM=b.ID LEFT JOIN `company_tbl` AS c ON a.company_id=c.ID LEFT JOIN `location_tbl` AS d ON a.location_id=d.ID LEFT JOIN category_master AS e ON a.catId=e.catId LEFT JOIN admin_usr_loc AS us ON a.location_id=us.locId WHERE a.sts='0' ".$str." AND us.uid='$uId' ORDER BY a.rmId";
	}
	//echo $qq."<br>";
	
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
	if($compId!='0' && $srch!='0')
	{
      $str=$str." AND c.ID='$compId' AND (e.category_nm LIKE '%".$srch."%' OR a.sage_code LIKE '%".$srch."%' OR a.focus_code  LIKE '%".$srch."%' OR a.description LIKE '%".$srch."%'  OR b.uom LIKE '%".$srch."%' OR CONCAT(c.company_code,' - ',c.company_name) LIKE '%".$srch."%' OR CONCAT(d.loc_code,' - ',d.location_name) LIKE '%".$srch."%' OR a.reorder_level_qty LIKE '%".$srch."%' OR a.product_expiry LIKE '%".$srch."%' OR a.rackNo LIKE '%".$srch."%' )";
	}
	else 
	{
		$str=$str." AND c.ID='$compId'";
	}
	
	//echo "<Br>";
	
	if($compId=='0')
	{
		$qq="SELECT a.rmId,a.sage_code,a.focus_code,a.description,b.uom AS unit_name,CONCAT(c.company_code,' - ',c.company_name) AS company_name,CONCAT(d.loc_code,' - ',d.location_name) AS location_name,a.reorder_level_qty,a.product_expiry,a.rackNo,e.category_nm ,a.location_id FROM `rm_master` AS a LEFT JOIN `uom_tbl` AS b ON a.UOM=b.ID LEFT JOIN `company_tbl` AS c ON a.company_id=c.ID LEFT JOIN `location_tbl` AS d ON a.location_id=d.ID LEFT JOIN category_master AS e ON a.catId=e.catId WHERE a.sts='0' ORDER BY a.rmId";
	}
	else
	{
		if($uRole=='admin' && ($uiType=='3' || $uiType=='0'))
		{
			$qq="SELECT a.rmId,a.sage_code,a.focus_code,a.description,b.uom AS unit_name,CONCAT(c.company_code,' - ',c.company_name) AS company_name,CONCAT(d.loc_code,' - ',d.location_name) AS location_name,a.reorder_level_qty,a.product_expiry,a.rackNo,e.category_nm ,a.location_id FROM `rm_master` AS a LEFT JOIN `uom_tbl` AS b ON a.UOM=b.ID LEFT JOIN `company_tbl` AS c ON a.company_id=c.ID LEFT JOIN `location_tbl` AS d ON a.location_id=d.ID LEFT JOIN category_master AS e ON a.catId=e.catId WHERE a.sts='0' ".$str." ORDER BY a.rmId";
		}
		else
		{
			$qq="SELECT a.rmId,a.sage_code,a.focus_code,a.description,b.uom AS unit_name,CONCAT(c.company_code,' - ',c.company_name) AS company_name,CONCAT(d.loc_code,' - ',d.location_name) AS location_name,a.reorder_level_qty,a.product_expiry,a.rackNo,e.category_nm ,a.location_id FROM `rm_master` AS a LEFT JOIN `uom_tbl` AS b ON a.UOM=b.ID LEFT JOIN `company_tbl` AS c ON a.company_id=c.ID LEFT JOIN `location_tbl` AS d ON a.location_id=d.ID LEFT JOIN category_master AS e ON a.catId=e.catId LEFT JOIN admin_usr_loc AS us ON a.location_id=us.locId WHERE a.sts='0' ".$str." AND us.uid='$uId' ORDER BY a.rmId";
		}
	}
	//echo "hhh : ".$qq."<br>";
	
	include('shripage.php');
    $totalRecordsPerPage=500;
    $paginationData=pagination_records($totalRecordsPerPage,$qq);
    //print_r($paginationData);
    $sn=pagination_records_counter($totalRecordsPerPage);
    $cnt=$sn;	
    $pagination=pagination($totalRecordsPerPage,$qq);
}	
?>
	
<!--====pagination section start====-->
<div class="pagination">    
<?php echo $pagination; ?>
</div>
<!--====pagination section end====-->
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
//echo $lcnt."<Br>";
//echo "<Br>".$compId." : ".$iType." : ".$locId."<Br>";
include('mysql.connect.php');
if($lcnt==1)
{	
	//admin_tbl 
	$qEditDel="SELECT act_edit AS ed,act_delete AS del FROM admin_tbl WHERE sts='0' AND id='".$uId."'";
	//echo $qEditDel."<Br>";	
	$stmEditDel=$mysql->prepare($qEditDel);
	$stmEditDel->execute();
	$rowEditDel=$stmEditDel->fetch(PDO::FETCH_ASSOC);
	$ed=$rowEditDel['ed'];
	$dels=$rowEditDel['del'];	
	//admin_tbl	
	foreach($paginationData as $row)
	//while($row=$stm->fetch(PDO::FETCH_ASSOC))
	{
		$id=$row['rmId'];
		$loc_id=$row['location_id'];

        if($uRole=='admin' && $uiType=='3')
        {
            echo'<tr style="color:#000;font-weight:600;">';
		  echo '<td>'.$cnt.'</td>';
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
		  echo '<td align="center"><a href="javascript:del('.$id.','.$uId.')"><i class="fa fa-trash" style="color:#F00"></i></a></td>';
		  }
		  echo '</tr>';
		  $cnt++;	
        }
        else
        {
          echo'<tr style="color:#000;font-weight:600;">';
		  echo '<td>'.$cnt.'</td>';
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
		  echo '<td align="center"><a href="javascript:del('.$id.','.$uId.')"><i class="fa fa-trash" style="color:#F00"></i></a></td>';
		  }
		  echo '</tr>';
		  $cnt++;	
		} 
	}
}
else
{	
	//admin_tbl 
	$qEditDel="SELECT act_edit AS ed,act_delete AS del FROM admin_tbl WHERE sts='0' AND id='".$uId."'";
	//echo $qEditDel."<Br>";	
	$stmEditDel=$mysql->prepare($qEditDel);
	$stmEditDel->execute();
	$rowEditDel=$stmEditDel->fetch(PDO::FETCH_ASSOC);
	$ed=$rowEditDel['ed'];
	$dels=$rowEditDel['del'];	
	//admin_tbl	
	
	foreach($paginationData as $row)
	//while($row=$stm->fetch(PDO::FETCH_ASSOC))
	{		
		$id=$row['fgId'];	
        $loc_id=$row['location_id'];

        if($uRole=='admin' && $uiType=='3')
        {
            echo'<tr style="color:#000;font-weight:600;">';
		  echo '<td>'.$cnt.'</td>';
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
		  echo '<td align="center"><a href="javascript:del('.$id.','.$uId.')"><i class="fa fa-trash" style="color:#F00"></i></a></td>';
		  }
		  echo '</tr>';
		  $cnt++;		
        }
        else
        {
          echo'<tr style="color:#000;font-weight:600;">';
		  echo '<td>'.$cnt.'</td>';
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
		  echo '<td align="center"><a href="javascript:del('.$id.','.$uId.')"><i class="fa fa-trash" style="color:#F00"></i></a></td>';
		  }
		  echo '</tr>';
		  $cnt++;	
        } 	
	}	
}	
$mysql=null;
?>	
</table>
<div class="pagination">    
<?php echo $pagination; ?>
</div>