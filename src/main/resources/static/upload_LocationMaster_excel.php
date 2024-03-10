3q9<?php
if(isset($_POST['btn']))
{
	include('mysql.connect.php');
	$file=$_FILES['file']['tmp_name'];
	$handle=fopen($file,"r");
	$c=0;
				
	while(($filesop=fgetcsv($handle,1000,","))!==false)
	{
		if(empty($filesop[0]) || $filesop[0]=='Customer Name')
		{
		}
		
		else
		{   
		    $cname=$filesop[0];
			$address=$filesop[1];
			$contact=$filesop[2];
			$mobile=$filesop[3];
			$country=$filesop[4];
			$uid=$_POST['euid'];
			
			$q="SELECT MAX(ID) AS code FROM cust_code";
			//echo $q."<br>";
			$s=$mysql->prepare($q);
			$s->execute();
			$row=$s->fetch(PDO::FETCH_ASSOC);
			$code=$row['code'];
			if($code<=9)
			{
			$c_code="SF0000".($code+1);
			}
			else if($code>9 && $code<99)
			{
			$c_code="SF000".($code+1);
			}
			else if($code>99 && $code<999)
			{
			$c_code="SF00".($code+1);
			}
			else if($code>999 && $code<9999)
			{
			$c_code="SF0".($code+1);
			}
			else 
			{
			$c_code="SF".($code+1);
			}
			
			$qq="INSERT INTO cust_code(customer_code)VALUES('$c_code')";
			$ss=$mysql->prepare($qq);
			$ss->execute();
			
			$qry="INSERT INTO cust_tbl(customer_code,c_nm,adrs,contact,mob,country,uid)VALUES('$c_code','$cname','$address','$contact','$mobile','$country','$uid')";
			$stm=$mysql->prepare($qry);
			$stm->execute();
			
		}
	}
echo "<script>alert('Recored Inserted Successfully...!')</script>";
echo "<script>window.location.href='locationMaster.php'</script>";
}
?>