<?php
$compId=$_GET['compId'];
$iType=$_GET['iType'];

if(empty($_GET['uiType']))
$uiType='0';
else
$uiType=$_GET['uiType'];

$uId=$_GET['uId'];
include('mysql.connect.php');
if($uId=='1')
{
	if($uiType=='3')
	{		
		$q="SELECT ID,CONCAT(loc_code,' - ',location_name) AS location_name FROM location_tbl WHERE sts='0' AND company_id='$compId'";
	}
	else
	{		
		$q="SELECT ID,CONCAT(loc_code,' - ',location_name) AS location_name FROM location_tbl WHERE sts='0' AND company_id='$compId' AND iType='$iType'";
	}
}
else
{
	if($uiType=='3')
	{
		$q="SELECT c.ID,CONCAT(c.loc_code,' - ',c.location_name) AS location_name FROM admin_tbl AS a LEFT JOIN admin_usr_loc AS b ON a.id=b.uid LEFT JOIN location_tbl AS c ON b.locId=c.ID WHERE a.id='$uId' AND a.sts='0' AND a.compId='$compId' AND c.iType='$iType'";
	}
	else
	{
		$q="SELECT c.ID,CONCAT(c.loc_code,' - ',c.location_name) AS location_name FROM admin_tbl AS a LEFT JOIN admin_usr_loc AS b ON a.id=b.uid LEFT JOIN location_tbl AS c ON b.locId=c.ID WHERE a.id='$uId' AND a.sts='0' AND a.compId='$compId' AND c.iType='$iType'";
	}
}
//echo $q."<Br>";
$s=$mysql->prepare($q);
$s->execute();
echo '<option value="0">Select</option>';
while($row=$s->fetch(PDO::FETCH_ASSOC))
{
  echo '<option value='.$row['ID'].'>'.$row['location_name'].'</option>';	
}
$mysql=null;
?>