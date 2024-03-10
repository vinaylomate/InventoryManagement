<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<?php
$compId=$_GET['compId'];
$locId=$_GET['locId'];
$iType=$_GET['iType'];
$itemId=$_GET['itemId'];
if(empty($_GET['fdt']))
$fdt='2022-12-03';
else
$fdt=$_GET['fdt'];

if(empty($_GET['tdt']))
$tdt='2023-12-03';
else
$tdt=$_GET['tdt'];

include('mysql.connect.php');
if($iType=='1')
{
	$qq="SELECT a.rmId AS ID, CONCAT(a.focus_code,' - ',a.sage_code,' - ',b.uom) AS itemNm FROM rm_master AS a LEFT JOIN uom_tbl AS b ON a.UOM=b.ID WHERE a.sts='0' AND a.company_id='$compId' AND a.location_id='$locId' AND a.rmId='$itemId'";
}
else
{
	$qq="SELECT a.fgId AS ID, CONCAT(a.focus_code,' - ',a.sage_code,' - ',b.uom) AS itemNm FROM fg_master AS a LEFT JOIN uom_tbl AS b ON a.uom=b.ID WHERE a.sts='0' AND a.company_id='$compId' AND a.location_id='$locId' AND a.fgId='$itemId'";
}
//echo $qq."<Br>";
$ss=$mysql->prepare($qq);
$ss->execute();
$rw=$ss->fetch(PDO::FETCH_ASSOC);
$itemNm=$rw['itemNm'];

$q="SELECT dt,cqty AS closingstk,cdt AS Nextdt,oqty AS Openingstk FROM stock_op_tbl WHERE compId='$compId' AND locId='$locId' AND iType='$iType' AND itemId='$itemId' AND (dt BETWEEN '$fdt' AND '$tdt') ORDER BY dt";
//echo $q."<Br>";
$s=$mysql->prepare($q);
$s->execute();
//echo '<option value="0">Select</option>';
$data=$s->fetchAll();
?>
<table width="100%" id="tbl_prod" class="table table-bordered">
<tr style="background-color:#b02923">
<th style="color:#fff;text-align:center" colspan="5">Product Name : <?php echo $itemNm;?></th>
</tr>	
<tr style="background-color:#b02923">
<th style="color:#fff;text-align:center">No.</th>
<th style="color:#fff;text-align:center">Date</th>
<th style="color:#fff;text-align:center">Closing Stock</th>  
<th style="color:#fff;text-align:center">Next Date</th>
<th style="color:#fff;text-align:center">Opening Stock</th> 
</tr>
<?php
$k=1;	
foreach($data as $row)
{
  echo '<tr>';
  echo '<td>'.$k.'</td>';
  echo '<td>'.date('d-m-Y',strtotime($row['dt'])).'</td>';
  echo '<td>'.$row['closingstk'].'</td>';
  echo '<td>'.date('d-m-Y',strtotime($row['Nextdt'])).'</td>';	
  echo '<td>'.$row['Openingstk'].'</td>';			
  echo '</tr>';
  $k++;
}
$mysql=null;
?>
</table>