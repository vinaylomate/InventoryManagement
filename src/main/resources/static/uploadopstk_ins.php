<?php
if(isset($_POST['btn']))
{
	include('mysql.connect.php');
	$file=$_FILES['file']['tmp_name'];
	$handle=fopen($file,"r");
	$c=0;
	date_default_timezone_set('Asia/Calcutta');
	$date=date('Y-m-d');	
	
	$invId=0;		
	$docNo=$dt="0";
	while(($filesop=fgetcsv($handle,1000,","))!==false)
	{
		if($filesop[0]=='CompanayId')
		{
		}
		
		else
		{			
			$expdt="-";	
			$uId=$_POST['euid'];
			$compId=$filesop[0];	
			$locId=$filesop[1];
			$iType=$filesop[2];
			$itemId=$filesop[3];
			$dd=$filesop[4];
			if (strpos($d, "/") !== false) 
            {
              $d1=explode('/',$dd);
              $dt=$d1[2]."-".$d1[1]."-".$d1[0];	
            }
            else
            {
              $d1=explode('-',$dd);
              $dt=$d1[2]."-".$d1[1]."-".$d1[0];	
            }
			
			$opstk=$filesop[5];
			$clstk=$filesop[6];
			$ndd=$filesop[7];
			if (strpos($d, "/") !== false) 
            {
              $d11=explode('/',$ndd);
              $nxdt=$d11[2]."-".$d11[1]."-".$d11[0];	
            }
            else
            {
              $d11=explode('-',$ndd);
              $nxdt=$d11[2]."-".$d11[1]."-".$d11[0];	
            }
			$nopstk=$filesop[8];
			
			$q="INSERT INTO stock_op_tbl(compId,locId,iType,itemId,dt,cqty,cdt,oqty)
			VALUES('$compId','$locId','$iType','$itemId','$dt','$clstk','$nxdt','$clstk')";
			//echo $q."<Br>";
			$stmt=$mysql->prepare($q);
			//$stmt->execute();
		}
	}
$mysql=null;	
/*echo "<script>alert('Record Uploaded Successfully...!')</script>";
echo "<script>window.location.href='uploadopstk.php'</script>";*/
}
?>