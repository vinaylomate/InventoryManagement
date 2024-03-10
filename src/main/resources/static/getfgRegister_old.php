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
$uloc=$_GET['uloc'];

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
		$str=$str." AND d.ID='$compId' AND e.ID='$locId' ";
	}
	else if($compId!='0' && $locId!='0' && $srch!='0')
	{
      $str=$str." AND d.ID='$compId' AND e.ID='$locId' AND (b.category_nm LIKE '%".$srch."%' OR a.sage_code LIKE '%".$srch."%' OR a.focus_code  LIKE '%".$srch."%' OR a.descc LIKE '%".$srch."%' OR a.brand LIKE '%".$srch."%' OR c.uom LIKE '%".$srch."%' OR CONCAT(d.company_code,' - ',d.company_name) LIKE '%".$srch."%' OR CONCAT(e.loc_code,' - ',e.location_name) LIKE '%".$srch."%' 
      OR a.reorder_level_qty LIKE '%".$srch."%' OR a.product_expiry LIKE '%".$srch."%' OR a.rackNo LIKE '%".$srch."%' )";
	}	
	else if($compId!='0' && $locId=='0' && $srch!='0')
	{
      $str=$str." AND d.ID='$compId' AND (b.category_nm LIKE '%".$srch."%' OR a.sage_code LIKE '%".$srch."%' OR a.focus_code  LIKE '%".$srch."%' OR a.descc LIKE '%".$srch."%' OR a.brand LIKE '%".$srch."%' OR c.uom LIKE '%".$srch."%' OR CONCAT(d.company_code,' - ',d.company_name) LIKE '%".$srch."%' OR CONCAT(e.loc_code,' - ',e.location_name) LIKE '%".$srch."%' 
      OR a.reorder_level_qty LIKE '%".$srch."%' OR a.product_expiry LIKE '%".$srch."%' OR a.rackNo LIKE '%".$srch."%' )";
	}
	else 
	{
		$str=$str." AND d.ID='$compId'";
	}
	//echo "<Br>";
    if($uRole=='admin' && ($uiType=='3' || $uiType=='0'))
	{
		$qq="SELECT a.fgId,a.category_id,a.uom,a.company_id,a.location_id,b.category_nm,a.sage_code,a.focus_code,a.descc,a.brand,c.uom AS unit_name,CONCAT(d.company_code,' - ',d.company_name) AS company_name,CONCAT(e.loc_code,' - ',e.location_name) AS location_name,a.reorder_level_qty,a.product_expiry,a.rackNo,a.barcode,a.location_id FROM `fg_master` AS a
		LEFT JOIN `category_master` AS b ON a.category_id=b.catId
		LEFT JOIN `uom_tbl` AS c ON a.uom=c.ID
		LEFT JOIN `company_tbl` AS d ON a.company_id=d.ID
		LEFT JOIN `location_tbl` AS e ON a.location_id=e.ID WHERE a.sts='0' ".$str." ORDER BY a.fgId";
	}
	else
	{
		$qq="SELECT a.fgId,a.category_id,a.uom,a.company_id,a.location_id,b.category_nm,a.sage_code,a.focus_code,a.descc,a.brand,c.uom AS unit_name,CONCAT(d.company_code,' - ',d.company_name) AS company_name,CONCAT(e.loc_code,' - ',e.location_name) AS location_name,a.reorder_level_qty,a.product_expiry,a.rackNo,a.barcode,a.location_id FROM `fg_master` AS a
		LEFT JOIN `category_master` AS b ON a.category_id=b.catId
		LEFT JOIN `uom_tbl` AS c ON a.uom=c.ID
		LEFT JOIN `company_tbl` AS d ON a.company_id=d.ID
		LEFT JOIN `location_tbl` AS e ON a.location_id=e.ID LEFT JOIN admin_usr_loc AS us ON a.location_id=us.locId 
		WHERE a.sts='0' ".$str." AND us.uid='$uId' ORDER BY a.fgId";
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
      $str=$str." AND d.ID='$compId' AND (b.category_nm LIKE '%".$srch."%' OR a.sage_code LIKE '%".$srch."%' OR a.focus_code  LIKE '%".$srch."%' OR a.descc LIKE '%".$srch."%' OR a.brand LIKE '%".$srch."%' OR c.uom LIKE '%".$srch."%' OR CONCAT(d.company_code,' - ',d.company_name) LIKE '%".$srch."%' OR CONCAT(e.loc_code,' - ',e.location_name) LIKE '%".$srch."%' 
      OR a.reorder_level_qty LIKE '%".$srch."%' OR a.product_expiry LIKE '%".$srch."%' OR a.rackNo LIKE '%".$srch."%' )";
	}
	else 
	{
		$str=$str." AND d.ID='$compId'";
	}
	
	//echo "<Br>";
	
	if($compId=='0')
	{
		$qq="SELECT a.fgId,a.category_id,a.uom,a.company_id,a.location_id,b.category_nm,a.sage_code,a.focus_code,a.descc,a.brand,c.uom AS unit_name,CONCAT(d.company_code,' - ',d.company_name) AS company_name,CONCAT(e.loc_code,' - ',e.location_name) AS location_name,a.reorder_level_qty,a.product_expiry,a.rackNo,a.barcode,a.location_id FROM `fg_master` AS a
		LEFT JOIN `category_master` AS b ON a.category_id=b.catId LEFT JOIN `uom_tbl` AS c ON a.uom=c.ID LEFT JOIN `company_tbl` AS d ON a.company_id=d.ID LEFT JOIN `location_tbl` AS e ON a.location_id=e.ID WHERE a.sts='0' ORDER BY a.fgId";
	}
	else
	{
		if($uRole=='admin' && ($uiType=='3' || $uiType=='0'))
		{
			$qq="SELECT a.fgId,a.category_id,a.uom,a.company_id,a.location_id,b.category_nm,a.sage_code,a.focus_code,a.descc,a.brand,c.uom AS unit_name,CONCAT(d.company_code,' - ',d.company_name) AS company_name,CONCAT(e.loc_code,' - ',e.location_name) AS location_name,a.reorder_level_qty,a.product_expiry,a.rackNo,a.barcode,a.location_id FROM `fg_master` AS a
			LEFT JOIN `category_master` AS b ON a.category_id=b.catId LEFT JOIN `uom_tbl` AS c ON a.uom=c.ID LEFT JOIN `company_tbl` AS d ON a.company_id=d.ID LEFT JOIN `location_tbl` AS e ON a.location_id=e.ID WHERE a.sts='0' ".$str." ORDER BY a.fgId";
		}
		else
		{
			$qq="SELECT a.fgId,a.category_id,a.uom,a.company_id,a.location_id,b.category_nm,a.sage_code,a.focus_code,a.descc,a.brand,c.uom AS unit_name,CONCAT(d.company_code,' - ',d.company_name) AS company_name,CONCAT(e.loc_code,' - ',e.location_name) AS location_name,a.reorder_level_qty,a.product_expiry,a.rackNo,a.barcode,a.location_id FROM `fg_master` AS a
			LEFT JOIN `category_master` AS b ON a.category_id=b.catId LEFT JOIN `uom_tbl` AS c ON a.uom=c.ID LEFT JOIN `company_tbl` AS d ON a.company_id=d.ID LEFT JOIN `location_tbl` AS e ON a.location_id=e.ID LEFT JOIN admin_usr_loc AS us ON a.location_id=us.locId WHERE a.sts='0' AND us.uid='$uId' ".$str." ORDER BY a.fgId";
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
<tr style="background-color:#b02923">
<th style="color:#fff;text-align:center">Sr.No.</th>
<th style="color:#fff;text-align:center">Category</th>
<th style="color:#fff;text-align:center">Sage Code</th>
<th style="color:#fff;text-align:center">Focus Code</th>
<th style="color:#fff;text-align:center">Barcode</th>
<th style="color:#fff;text-align:center">Description</th>
<th style="color:#fff;text-align:center">Brand</th>
<th style="color:#fff;text-align:center">UOM</th>
<th style="color:#fff;text-align:center">Company</th>
<th style="color:#fff;text-align:center">Location </th>
<th style="color:#fff;text-align:center">Reorder Level Qty</th>
<th style="color:#fff;text-align:center">Prod. Expiry</th>
<th style="color:#fff;text-align:center">Rack No.</th>
<!--<th style="color:#fff;text-align:center">View</th>-->
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
		$id=$row['fgId'];	
        $loc_id=$row['location_id'];

        if($uRole=='admin' && $uiType=='3')
        {
            echo'<tr style="color:#000;font-weight:600;">';
            echo '<td>'.$cnt.'</td>';
            echo '<td>'.$row['category_nm'].'</td>';
            echo '<td>'.$row['sage_code'].'</td>';
            echo '<td>'.$row['focus_code'].'</td>';
            echo '<td>'.$row['barcode'].'</td>';
            echo '<td>'.$row['descc'].'</td>';
            echo '<td>'.$row['brand'].'</td>';
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
            $cnt++;	
        }
        else
        {
          echo'<tr style="color:#000;font-weight:600;">';
          echo '<td>'.$cnt.'</td>';
          echo '<td>'.$row['category_nm'].'</td>';
          echo '<td>'.$row['sage_code'].'</td>';
          echo '<td>'.$row['focus_code'].'</td>';
          echo '<td>'.$row['barcode'].'</td>';
          echo '<td>'.$row['descc'].'</td>';
          echo '<td>'.$row['brand'].'</td>';
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
            echo '<td>'.$row['barcode'].'</td>';
            echo '<td>'.$row['descc'].'</td>';
            echo '<td>'.$row['brand'].'</td>';
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
            $cnt++;	
        }
        else
        {
            echo'<tr style="color:#000;font-weight:600;">';
                        echo '<td>'.$cnt.'</td>';
                        echo '<td>'.$row['category_nm'].'</td>';
                        echo '<td>'.$row['sage_code'].'</td>';
                        echo '<td>'.$row['focus_code'].'</td>';
                        echo '<td>'.$row['barcode'].'</td>';
                        echo '<td>'.$row['descc'].'</td>';
                        echo '<td>'.$row['brand'].'</td>';
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
                        $cnt++;
        } 
	
	}	
}	
$mysql=null;
?>					
</table>	
<!--====pagination section start====-->
<div class="pagination">    
<?php echo $pagination; ?>
</div>
<!--====pagination section end====-->
 <!-- Page level plugins -->
  <!--<script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <script src="js/demo/datatables-demo.js"></script>-->