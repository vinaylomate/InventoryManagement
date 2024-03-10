<?php
$compId=$_GET['compId'];
$iType=$_GET['iType'];
$locId=$_GET['locId'];

if(empty($_GET['uiType']))
$uiType='0';
else
$uiType=$_GET['uiType'];

$uId=$_GET['uId'];
include('mysql.connect.php');
if($iType=='3')
{		
    $q="SELECT ID,CONCAT(loc_code,' - ',location_name) AS location_name FROM location_tbl WHERE sts='0' AND company_id='$compId' AND ID='$locId'";
}
else
{		
    $q="SELECT ID,CONCAT(loc_code,' - ',location_name) AS location_name FROM location_tbl WHERE sts='0' AND company_id='$compId' AND iType='$iType' AND ID='$locId'";
}
//echo $q."<Br>";
$s=$mysql->prepare($q);
$s->execute();
if($locId=='0')
{
	echo '<option value="0">Select</option>';
}
while($row=$s->fetch(PDO::FETCH_ASSOC))
{
  echo '<option value='.$row['ID'].'>'.$row['location_name'].'</option>';	
}
$mysql=null;
?>