<?php
$compId=$_GET['compId'];
$iType=$_GET['iType'];
$locId=$_GET['locId'];
include('mysql.connect.php');
if($compId!='0' && $iType!='0' && $locId!='0')
{
	$q="SELECT batchNo FROM stock_tbl_2 WHERE sts!='2' AND compId='$compId' AND iType='$iType' AND locId='$locId' GROUP BY batchNo ORDER BY SUBSTRING(batchNo,1,9), SUBSTRING(batchNo,10)*1 DESC";	
}
else if($compId!='0' && $iType!='0' && $locId=='0')
{
	$q="SELECT batchNo FROM stock_tbl_2 WHERE sts!='2' AND compId='$compId' AND iType='$iType' GROUP BY batchNo ORDER BY SUBSTRING(batchNo,1,9), SUBSTRING(batchNo,10)*1 DESC";	
}
else
{
	$q="SELECT batchNo FROM stock_tbl_2 WHERE sts!='2' GROUP BY batchNo ORDER BY SUBSTRING(batchNo,1,9), SUBSTRING(batchNo,10)*1 DESC";	
}
//echo "Utype 0 || 3 || ".$q."<Br>";
$s=$mysql->prepare($q);
$s->execute();
echo '<option value="0">Select</option>';

while($row=$s->fetch(PDO::FETCH_ASSOC))
{
	echo '<option value='.$row['batchNo'].'>'.$row['batchNo'].'</option>';	
}
$mysql=null;
?>