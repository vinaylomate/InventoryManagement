<?php
date_default_timezone_set('Asia/Calcutta');
$iType=$_GET['iType'];
$compId=$_GET['compId'];
$locId=$_GET['locId'];
$eType=$_GET['eType'];
$itemId=$_GET['itemId'];

include('mysql.connect.php');
$q="SELECT CONCAT(ID,'||',stkId) AS ID,batchNo FROM stock_tbl_2 WHERE compId='$compId' AND locId='$locId' AND itemId='$itemId' AND iType='$iType' AND stk_qty!='0' AND sts='0' AND (out_qty='0' AND lock_qty='0')";
//echo $q."<br>";
$s=$mysql->prepare($q);
$s->execute();
echo '<option value="0">Select</option>';
while($row=$s->fetch(PDO::FETCH_ASSOC))
{
  echo '<option value='.$row['ID'].'>'.$row['batchNo'].'</option>';	
}
$mysql=null;
?>