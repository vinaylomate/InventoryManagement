<?php
function getopenStk($dt1,$compId,$locId,$iType,$itemId)
{
	include('mysql.connect.php');
	$qopstk="SELECT oqty FROM stock_op_tbl WHERE cdt='$dt1' AND compId='$compId' AND locId='$locId' AND iType='$iType' AND itemId='$itemId' AND sts!='2'";
	//echo $qopstk."<Br>";
	$stopstk=$mysql->prepare($qopstk);
	$stopstk->execute();
	$opqty=0;
	$rowopstk=$stopstk->fetch(PDO::FETCH_ASSOC);
	if(!empty($rowopstk['oqty']))
	$opqty=$rowopstk['oqty'];
	
	return $opqty;
}
?>
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
<thead>
<tr style="background-color:#b02923">	
<th style="color:#fff;">Location</th>
<th style="color:#fff;">Focus Code</th>
<th style="color:#fff">Sage Code</th>
<th style="color:#fff;">Product</th>
<th style="color:#fff">Opening Stock</th>
<th style="color:#fff;">IN</th>
<th style="color:#fff">OUT</th>
<th style="color:#fff;">Lock Qty</th>
<th style="color:#fff;">Closing Stock</th>
<th style="color:#fff">Re - Order Level</th>
<th style="color:#fff">Re - Order Req.</th>
<th style="color:#fff">Rack No.</th>
</tr>
</thead>
<?php 
$compId=$locId=$iType='0';

$fdt=$tdt=date('Y-m-d');	

if(!empty($_GET['compId']))
$compId=$_GET['compId'];

if(!empty($_GET['locId']))
$locId=$_GET['locId'];

if(!empty($_GET['iType']))
$iType=$_GET['iType'];

if(!empty($_GET['fdt']))
$fdt=$_GET['fdt'];	

if(!empty($_GET['tdt']))
$tdt=$_GET['tdt'];		
//echo "<Br>".$compId." : ".$iType." : ".$locId."<Br>";

$str="";

if($compId!='0' && $iType!='0' && $locId!='0' && $fdt!='0' && $tdt!='0')
{
$str=$str." AND a.compId='$compId' AND a.iType='$iType' AND a.locId='$locId' AND (a.dt BETWEEN '$fdt' AND '$tdt')";
}
else if($compId=='0' && $iType=='0' && $locId=='0' && $fdt!='0' && $tdt!='0')
{
$str=$str." AND (a.dt BETWEEN '$fdt' AND '$tdt')";
}
/*else if($compId!='0' && $iType!='0' && $locId=='0' && $fdt!='0' && $tdt!='0')
{
$str=$str." AND a.compId='$compId' AND a.iType='$iType' AND (a.dt BETWEEN '$fdt' AND '$tdt')";
}
else if($compId!='0' && $iType=='0' && $locId!='0' && $fdt!='0' && $tdt!='0')
{
$str=$str." AND a.compId='$compId' AND a.locId='$locId' AND (a.dt BETWEEN '$fdt' AND '$tdt')";
}
else if($compId!='0' && $iType=='0' && $locId=='0' && $fdt!='0' && $tdt!='0')
{
$str=$str." AND a.compId='$compId'  AND (a.dt BETWEEN '$fdt' AND '$tdt')";
}
else if($compId=='0' && $iType!='0' && $locId!='0')
{
$str=$str." a.locId='$locId' AND a.iType='$iType' ";
}
else if($compId=='0' && $iType=='0' && $locId!='0')
{
$str=$str." a.locId='$locId' ";
}
else if($compId=='0' && $iType!='0' && $locId=='0')
{
$str=$str." a.iType='$iType' ";
}	*/

include('mysql.connect.php');

$qq="SELECT a.iType,a.compId,CONCAT(b.company_code,' - ',b.company_name) AS compNm,a.locId,CONCAT(c.loc_code,' - ',c.location_name) AS locNm,a.itemId,
IF(a.iType='1',d.focus_code,f.focus_code) AS fcode, IF(a.iType='1',d.sage_code,f.sage_code) AS sg,
IF(a.iType='1',CONCAT(rc.category_nm,' ',d.description,' - ',ru.uom),CONCAT(fc.category_nm,' ',f.brand,' ',f.descc,' - ',fu.uom)) AS desp
,IF(a.iType='1','RM','FG') AS iTypeNm,SUM(a.in_qty) AS inQ,SUM(a.out_qty) AS outQ,SUM(IF(a.out_qty='0',a.stk_qty,'0')) AS stkQ,a.rackNo,a.reord_qty,SUM(a.lock_qty) AS lockQ FROM stock_tbl_2 AS a LEFT JOIN company_tbl AS b ON a.compId=b.ID 
LEFT JOIN location_tbl AS c ON a.locId=c.ID 
LEFT JOIN rm_master AS d ON a.itemId=d.rmId 
LEFT JOIN category_master AS rc ON d.catId=rc.catId 
LEFT JOIN uom_tbl AS ru ON d.UOM=ru.ID 
LEFT JOIN fg_master AS f ON a.itemId=f.fgId 
LEFT JOIN category_master AS fc ON f.category_id=fc.catId 
LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID 
WHERE a.sts!='2' AND b.sts!='2' AND c.sts!='2' AND IF(a.iType='1',d.sts!='2',f.sts!='2') AND IF(a.iType='1',rc.sts!='2',fc.sts!='2') AND IF(a.iType='1',ru.sts!='2',fu.sts!='2') ".$str." GROUP BY a.compId,a.locId,a.iType,a.itemId ORDER BY a.iType,a.itemId";
//echo $qq."<br>";
$stm=$mysql->prepare($qq);
$stm->execute();
$cnt=1;
$a=$b=$c=$d=$e=$opstk=$clstk=0;	
if($stm->rowCount()>0)
{	
while($row=$stm->fetch(PDO::FETCH_ASSOC))
{		
	$iTy=$row['iType'];
	$compId=$row['compId'];
	$locId=$row['locId'];
	$itemId=$row['itemId'];
	
	if($row['iType']=='1')
	{
		$opstk=getopenStk($fdt,$compId,$locId,$iTy,$itemId);
		
		$clstk=($opstk+$row['inQ'])-($row['outQ']+$row['lockQ']);
		
		echo'<tr style="color:#000;font-weight:600;">';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['locNm'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['fcode'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['sg'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['desp'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$opstk.'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['inQ'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['outQ'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['lockQ'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$clstk.'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['reord_qty'].'</td>';
		if($clstk<$row['reord_qty'])
		{
		echo '<td style="background-color:#0d69f445;color:#F00;font-weight:bold;">Yes</td>';
		}
		else
		{
		echo '<td style="background-color:#0d69f445;color:#000">No</td>';  
		}
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['rackNo'].'</td>';
		echo '</tr>';  
	}
	else
	{
		$opstk=getopenStk($fdt,$compId,$locId,$iTy,$itemId);
		
		$clstk=($opstk+$row['inQ'])-($row['outQ']+$row['lockQ']);
		
		echo'<tr style="color:#000;font-weight:600;">';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['locNm'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['fcode'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['sg'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['desp'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$opstk.'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['inQ'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['outQ'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['lockQ'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$clstk.'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['reord_qty'].'</td>';
		if($clstk<$row['reord_qty'])
		{
		echo '<td style="background-color:#f4b80d61;color:#F00;font-weight:bold;">Yes</td>';
		}
		else
		{
		echo '<td style="background-color:#f4b80d61;color:#000">No</td>';  
		}
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['rackNo'].'</td>';
		echo '</tr>';  
	}				  
	$cnt++;
}
}
else
{	
	$qq2="SELECT a.iType,a.compId,CONCAT(b.company_code,' - ',b.company_name) AS compNm,a.locId,CONCAT(c.loc_code,' - ',c.location_name) AS locNm,a.itemId, IF(a.iType='1',d.focus_code,f.focus_code) AS fcode, IF(a.iType='1',d.sage_code,f.sage_code) AS sg, IF(a.iType='1',CONCAT(rc.category_nm,' ',d.description,' - ',ru.uom),CONCAT(fc.category_nm,' ',f.brand,' ',f.descc,' - ',fu.uom)) AS desp ,IF(a.iType='1','RM','FG') AS iTypeNm,'0' AS inQ,'0' AS outQ,'0' AS stkQ,IF(a.iType='1',d.rackNo,f.rackNo) AS rackNo,IF(a.iType='1',d.reorder_level_qty,f.reorder_level_qty) AS reord_qty,'0' AS lockQ FROM stock_op_tbl AS a LEFT JOIN company_tbl AS b ON a.compId=b.ID LEFT JOIN location_tbl AS c ON a.locId=c.ID LEFT JOIN rm_master AS d ON a.itemId=d.rmId LEFT JOIN category_master AS rc ON d.catId=rc.catId LEFT JOIN uom_tbl AS ru ON d.UOM=ru.ID LEFT JOIN fg_master AS f ON a.itemId=f.fgId LEFT JOIN category_master AS fc ON f.category_id=fc.catId LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID WHERE a.sts!='2' AND b.sts!='2' AND c.sts!='2' AND IF(a.iType='1',d.sts!='2',f.sts!='2') AND IF(a.iType='1',rc.sts!='2',fc.sts!='2') AND IF(a.iType='1',ru.sts!='2',fu.sts!='2') GROUP BY a.compId,a.locId,a.iType,a.itemId ORDER BY a.iType,a.itemId";
	//echo $qq2."<br>";
	$stm2=$mysql->prepare($qq2);
	$stm2->execute();
	$cnt=1;
	$a=$b=$c=$d=$e=$opstk=$clstk=0;	
	while($row=$stm2->fetch(PDO::FETCH_ASSOC))
	{		
		$iTy=$row['iType'];
		$compId=$row['compId'];
		$locId=$row['locId'];
		$itemId=$row['itemId'];

		if($row['iType']=='1')
		{
			$opstk=getopenStk($fdt,$compId,$locId,$iTy,$itemId);
			//echo $opstk."<Br>";
			$clstk=($opstk+$row['inQ'])-($row['outQ']+$row['lockQ']);

			echo'<tr style="color:#000;font-weight:600;">';
			echo '<td style="background-color:#0d69f445;color:#000">'.$row['locNm'].'</td>';
			echo '<td style="background-color:#0d69f445;color:#000">'.$row['fcode'].'</td>';
			echo '<td style="background-color:#0d69f445;color:#000">'.$row['sg'].'</td>';
			echo '<td style="background-color:#0d69f445;color:#000">'.$row['desp'].'</td>';
			echo '<td style="background-color:#0d69f445;color:#000">'.$opstk.'</td>';
			echo '<td style="background-color:#0d69f445;color:#000">'.$row['inQ'].'</td>';
			echo '<td style="background-color:#0d69f445;color:#000">'.$row['outQ'].'</td>';
			echo '<td style="background-color:#0d69f445;color:#000">'.$row['lockQ'].'</td>';
			echo '<td style="background-color:#0d69f445;color:#000">'.$clstk.'</td>';
			echo '<td style="background-color:#0d69f445;color:#000">'.$row['reord_qty'].'</td>';
			if($clstk<$row['reord_qty'])
			{
			echo '<td style="background-color:#0d69f445;color:#F00;font-weight:bold;">Yes</td>';
			}
			else
			{
			echo '<td style="background-color:#0d69f445;color:#000">No</td>';  
			}
			echo '<td style="background-color:#0d69f445;color:#000">'.$row['rackNo'].'</td>';
			echo '</tr>';  
		}
		else
		{
			$opstk=getopenStk($fdt,$compId,$locId,$iTy,$itemId);

			$clstk=($opstk+$row['inQ'])-($row['outQ']+$row['lockQ']);

			echo'<tr style="color:#000;font-weight:600;">';
			echo '<td style="background-color:#f4b80d61;color:#000">'.$row['locNm'].'</td>';
			echo '<td style="background-color:#f4b80d61;color:#000">'.$row['fcode'].'</td>';
			echo '<td style="background-color:#f4b80d61;color:#000">'.$row['sg'].'</td>';
			echo '<td style="background-color:#f4b80d61;color:#000">'.$row['desp'].'</td>';
			echo '<td style="background-color:#f4b80d61;color:#000">'.$opstk.'</td>';
			echo '<td style="background-color:#f4b80d61;color:#000">'.$row['inQ'].'</td>';
			echo '<td style="background-color:#f4b80d61;color:#000">'.$row['outQ'].'</td>';
			echo '<td style="background-color:#f4b80d61;color:#000">'.$row['lockQ'].'</td>';
			echo '<td style="background-color:#f4b80d61;color:#000">'.$clstk.'</td>';
			echo '<td style="background-color:#f4b80d61;color:#000">'.$row['reord_qty'].'</td>';
			if($clstk<$row['reord_qty'])
			{
			echo '<td style="background-color:#f4b80d61;color:#F00;font-weight:bold;">Yes</td>';
			}
			else
			{
			echo '<td style="background-color:#f4b80d61;color:#000">No</td>';  
			}
			echo '<td style="background-color:#f4b80d61;color:#000">'.$row['rackNo'].'</td>';
			echo '</tr>';  
		}				  
		$cnt++;
	}

}
$mysql=null;
?>
<tbody>
</tbody>
<!--<tfoot>
<tr style="background-color:#b02923">
<th style="color:#fff;"></th>
<th style="color:#fff;"></th>
<th style="color:#fff"></th>
<th style="color:#fff;">Total</th>
<th style="color:#fff"><?php echo $a;?></th>
<th style="color:#fff;"><?php echo $b;?></th>
<th style="color:#fff"><?php echo $c;?></th>
<th style="color:#fff;"><?php echo $d;?></th>
<th style="color:#fff;"><?php echo $e;?></th>
<th style="color:#fff"></th>
<th style="color:#fff"></th>
<th style="color:#fff"></th>
</tr>
</tfoot>-->		

</table>
<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>