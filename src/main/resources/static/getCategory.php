<?php
$iType=$_GET['iType'];
include('mysql.connect.php');
//$q="SELECT catId AS ID,category_nm AS catNm FROM category_master WHERE iType='$iType' AND sts='0'";	
if($iType=='1')
{
	$q="SELECT a.catId AS ID,a.category_nm AS catNm FROM category_master AS a LEFT JOIN rm_master AS b ON a.catId=b.catId WHERE a.iType='$iType' AND a.sts='0' GROUP BY a.catId,a.category_nm ORDER BY a.catId";
}
else
{
	$q="SELECT a.catId AS ID,a.category_nm AS catNm FROM category_master AS a LEFT JOIN fg_master AS b ON a.catId=b.category_id WHERE a.iType='$iType' AND a.sts='0' GROUP BY a.catId,a.category_nm ORDER BY a.catId";
}
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