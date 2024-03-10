<?php
$compId=$_GET['compId'];
$iType=$_GET['iType'];
$locId=$_GET['locId'];
$uId=$_GET['uId'];
include('mysql.connect.php');
$q="SELECT a.id AS ID,a.UserNm AS salemanNm FROM admin_tbl AS a LEFT JOIN admin_usr_loc AS b ON a.id=b.uid WHERE a.sts='0' AND a.compId='$compId' AND a.iType='$iType' AND b.locId='$locId' AND a.uType='2'";
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