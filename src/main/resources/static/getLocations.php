<?php
$compId=$_GET['compId'];
$iType=$_GET['iType'];
$uiType=$_GET['uiType'];
$uId=$_GET['uId'];
$uRole=$_GET['urole'];

if(empty($_GET['uloc']))
$uloc=0;
else
$uloc=$_GET['uloc'];

if(empty($_GET['ulocty']))
$ulocty=0;
else
$ulocty=$_GET['ulocty'];

$lcnt=0;
$ulItype="";
//echo $uloc."<Br>";

if( strpos( $uloc, ',' ) !== false )
{
	$locId=explode(',',$uloc);
	$ulItype=explode(',',$ulocty);
	$lcnt=count($locId);
}
else
{
	$locId=$uloc;
	$ulItype=$ulocty;
	$lcnt=1;
}

//echo $lcnt."<Br>";

include('mysql.connect.php');
if($uRole=='admin' || $uRole=='manager')
{ 	
  if($iType=='1')
  {
  	$q="SELECT ID,CONCAT(loc_code,' - ',location_name) AS location_name FROM location_tbl WHERE sts='0' AND company_id='$compId' AND iType='1'";	
  }
  else if($iType=='2')
  {
  	$q="SELECT ID,CONCAT(loc_code,' - ',location_name) AS location_name FROM location_tbl WHERE sts='0' AND company_id='$compId' AND iType='2'";	
  }
  else
  {
  	$q="SELECT ID,CONCAT(loc_code,' - ',location_name) AS location_name FROM location_tbl WHERE sts='0' AND company_id='$compId'";	
  }
	
 //echo "Utype 0 || 3 || ".$q."<Br>";
  $s=$mysql->prepare($q);
  $s->execute();
  echo '<option value="0">Select</option>';

  while($row=$s->fetch(PDO::FETCH_ASSOC))
  {
    echo '<option value='.$row['ID'].'>'.$row['location_name'].'</option>';	
  }
}
else 
{ 
		//echo $lcnt."<Br>";
	    $val="";
	    if($lcnt!=1)
		$val='<option value="0">Select</option>';	
		
		if($lcnt>1)
		{
			for($i=0;$i<$lcnt;$i++)
			{
				//echo $iType." : ".$ulItype[$i]."<br>";
				if($iType==$ulItype[$i])
				{
					$q="SELECT ID,CONCAT(loc_code,' - ',location_name) AS location_name FROM location_tbl WHERE sts='0' AND company_id='$compId' AND iType='$ulItype[$i]' AND ID='$locId[$i]'";
					//echo "hello : ".$q."<Br>";
					$s=$mysql->prepare($q);
					$s->execute();
					while($row=$s->fetch(PDO::FETCH_ASSOC))
					{
					  $val=$val.'<option value='.$row['ID'].'>'.$row['location_name'].'</option>';	
					}
				}
			}
		}
		else
		{
			$q="SELECT ID,CONCAT(loc_code,' - ',location_name) AS location_name FROM location_tbl WHERE sts='0' AND company_id='$compId' AND iType='$ulItype' AND ID='$locId'";
            //echo "hello : ".$q2."<Br>";
            $s=$mysql->prepare($q);
            $s->execute();
            while($row=$s->fetch(PDO::FETCH_ASSOC))
            {
              $val=$val.'<option value='.$row['ID'].'>'.$row['location_name'].'</option>';	
            }
		}
		echo $val;  
}
$mysql=null;
?>