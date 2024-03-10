<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<?php
$compId=$_GET['compId'];
$locId=$_GET['locId'];
$iType=$_GET['iType'];
$itemId=$_GET['itemId'];
include('mysql.connect.php');
$q="SELECT dt,cqty AS closingstk,cdt AS Nextdt,oqty AS Openingstk FROM stock_op_tbl WHERE compId='$compId' AND locId='$locId' AND iType='$iType' AND itemId='$itemId' ORDER BY dt";
//echo $q."<Br>";
$s=$mysql->prepare($q);
$s->execute();
//echo '<option value="0">Select</option>';
$data=$s->fetchAll();
?>
<table width="100%" id="tbl_prod" class="table table-bordered">
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