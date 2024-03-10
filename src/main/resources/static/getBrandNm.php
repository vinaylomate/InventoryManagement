<?php
$compId=$_GET['compId'];
$locId=$_GET['locId'];
include('mysql.connect.php');
$q="SELECT brand FROM fg_master WHERE company_id='$compId' AND location_id='$locId' AND sts='0' GROUP BY brand";	
//echo "Utype 0 || 3 || ".$q."<Br>";
$s=$mysql->prepare($q);
$s->execute();
echo '<option value="0">Select</option>';

while($row=$s->fetch(PDO::FETCH_ASSOC))
{
	echo '<option value='.$row['brand'].'>'.$row['brand'].'</option>';	
}
$mysql=null;
?>