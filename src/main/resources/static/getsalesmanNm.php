<?php
$compId=$_GET['compId'];
$iType=$_GET['iType'];
$locId=$_GET['locId'];
$uId=$_GET['uId'];
include('mysql.connect.php');
if($uId=='1')
{
	$q="SELECT ID,salemanNm FROM salesman_tbl WHERE sts='0' AND compId='$compId' AND iType='$iType' AND locId='$locId'";
}
else
{
	$q="SELECT ID,salemanNm FROM salesman_tbl WHERE sts='0' AND compId='$compId' AND iType='$iType' AND locId='$locId' AND uid='$uId'";
}
//echo $q."<Br>";
$s=$mysql->prepare($q);
$s->execute();
echo '<option value="0">Select</option>';
while($row=$s->fetch(PDO::FETCH_ASSOC))
{
  echo '<option value='.$row['ID'].'>'.$row['salemanNm'].'</option>';	
}
$mysql=null;
?>