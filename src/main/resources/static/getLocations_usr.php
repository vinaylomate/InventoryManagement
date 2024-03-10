<?php
$compId=$_GET['compId'];
$iType=$_GET['iType'];
$uiType=$_GET['uiType'];
$uId=$_GET['uId'];
$uloc=$_GET['uloc'];
$lcnt=0;
if( strpos( $uloc, ',' ) !== false )
{
	$locId=explode(',',$uloc);
	$lcnt=count($locId);
}
else
{
	$locId=$uloc;
	$lcnt=1;
}


include('mysql.connect.php');
if($uiType=='0' || $uiType=='3')
{
  if($iType=='1')
  {
  	$q="SELECT ID,CONCAT(loc_code,' - ',location_name) AS location_name,iType FROM location_tbl WHERE sts='0' AND company_id='$compId' AND iType='1'";	
  }
  else if($iType=='2')
  {
  	$q="SELECT ID,CONCAT(loc_code,' - ',location_name) AS location_name,iType FROM location_tbl WHERE sts='0' AND company_id='$compId' AND iType='2'";	
  }
  else
  {
  	$q="SELECT ID,CONCAT(loc_code,' - ',location_name) AS location_name,iType FROM location_tbl WHERE sts='0' AND company_id='$compId'";	
  }
  //echo $q."<Br>";
  $s=$mysql->prepare($q);
  $s->execute();
  echo '<option value="0">Select</option>';

  while($row=$s->fetch(PDO::FETCH_ASSOC))
  {
	$lId=$row['ID']."||".$row['iType'];
	  
    echo '<option value="'.$lId.'">'.$row['location_name'].'</option>';	
  }
}
else
{
	if($lcnt==1)
	{		
	  if($iType=='1')
	  {
		$q="SELECT ID,CONCAT(loc_code,' - ',location_name) AS location_name,iType FROM location_tbl WHERE sts='0' AND company_id='$compId' AND iType='1' AND ID='$locId'";	
	  }
	  else 
	  {
		$q="SELECT ID,CONCAT(loc_code,' - ',location_name) AS location_name,iType FROM location_tbl WHERE sts='0' AND company_id='$compId' AND iType='2' AND ID='$locId'";	
	  }
	  //echo $q."<Br>";
	  $s=$mysql->prepare($q);
	  $s->execute();
	  while($row=$s->fetch(PDO::FETCH_ASSOC))
	  {
		$lId=$row['ID']."||".$row['iType'];  
		echo '<option value="'.$lId.'">'.$row['location_name'].'</option>';	
	  }

	}
	else
	{
		$val="";
		$val='<option value="0">Select</option>';	
		
		for($i=0;$i<$lcnt;$i++)
		{
			if($iType=='1')
            {
              $q="SELECT ID,CONCAT(loc_code,' - ',location_name) AS location_name,iType FROM location_tbl WHERE sts='0' AND company_id='$compId' AND iType='1' AND ID='$locId[$i]'";	
            }
            else 
            {
              $q="SELECT ID,CONCAT(loc_code,' - ',location_name) AS location_name,iType FROM location_tbl WHERE sts='0' AND company_id='$compId' AND iType='2' AND ID='$locId[$i]'";	
            }
            //echo $q."<Br>";
            $s=$mysql->prepare($q);
            $s->execute();
            while($row=$s->fetch(PDO::FETCH_ASSOC))
            {
			  $lId=$row['ID']."||".$row['iType'];  	
              $val=$val.'<option value="'.$lId.'">'.$row['location_name'].'</option>';	
            }
		}
		echo $val;
	}
}
$mysql=null;
?>