<?php
$iType=$_GET['iType'];
include('mysql.connect.php');
$q="SELECT catId AS ID,category_nm AS catNm FROM category_master WHERE iType='$iType' AND sts='0'";	
//echo "Utype 0 || 3 || ".$q."<Br>";
$s=$mysql->prepare($q);
$s->execute();
echo '<option value="0">Select</option>';

while($row=$s->fetch(PDO::FETCH_ASSOC))
{
	echo '<option value='.$row['ID'].'>'.$row['catNm'].'</option>';	
}
$mysql=null;
?>