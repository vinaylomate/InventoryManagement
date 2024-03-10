<!DOCTYPE html>
<html lang="en">
<head>
  <title>Pagination in PHP</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style type="text/css">
.pagination-content{
 width:60%;
 text-align: justify;
 padding:20px;
}
.pagination{
 padding:20px;
}
.pagination a.active{
 background: #f77404;
 color: white;
}  
.pagination a{
 text-decoration: none;
 padding: 10px 15px;
 box-shadow: 0px 0px 15px #0000001c;
 background: white;
 margin: 3px;
 color: #1f1e1e;
}
</style>

  
</head>
<body>
    
<?php

include('pagedemo.php');
 $totalRecordsPerPage=1000;
 $tableName="SELECT a.fgId,a.category_id,a.uom,a.company_id,a.location_id,b.category_nm,
 a.sage_code,a.focus_code,a.descc,a.brand,c.uom AS unit_name,CONCAT(d.company_code,' - ',d.company_name) AS company_name,CONCAT(e.loc_code,' - ',e.location_name) AS location_name,a.reorder_level_qty,a.product_expiry,a.rackNo,a.barcode,a.location_id FROM `fg_master` AS a LEFT JOIN `category_master` AS b ON a.category_id=b.catId LEFT JOIN `uom_tbl` AS c ON a.uom=c.ID LEFT JOIN `company_tbl` AS d ON a.company_id=d.ID LEFT JOIN `location_tbl` AS e ON a.location_id=e.ID WHERE a.sts='0'";
 $paginationData=pagination_records($totalRecordsPerPage,$tableName);
 //print_r($paginationData);
 $sn=pagination_records_counter($totalRecordsPerPage);
 $cnt=$sn;	
 $pagination=pagination($totalRecordsPerPage,$tableName);
 //echo $pagination."<Br>";
?>

<!--====pagination content  start====-->
<div class="pagination">
    
<?php echo $pagination; ?>

</div>
	
<div class="pagination-content">
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
//print_r($paginationData);
foreach ($paginationData as $row) 
{
			echo'<tr style="color:#000;font-weight:600;">';
            echo '<td>'.$sn.'</td>';
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

			$sn++;
}
?>
	</table>
</div>
<!--====pagination content end====-->
<br><br>
<!--====pagination section start====-->
<div class="pagination">
    
<?php echo $pagination; ?>

</div>
<!--====pagination section end====-->

<br><br><br>
</body>
</html>