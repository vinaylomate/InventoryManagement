<?php
if(isset($_POST['btn']))
{
	include('mysql.connect.php');
	$file=$_FILES['file']['tmp_name'];
	$handle=fopen($file,"r");
	$c=0;
				
	while(($filesop=fgetcsv($handle,1000,","))!==false)
	{
		if(empty($filesop[0]) || $filesop[0]=='Supplier Name')
		{
		}
		
		else
		{   
		    $sname=$filesop[0];
			$address=$filesop[1];
			$contact=$filesop[2];
			$mobile=$filesop[3];
			$country=$filesop[4];
			$uid=$_POST['euid'];
			
			
			$q="SELECT MAX(ID) AS code FROM supplier_code";
			//echo $q."<br>";
			$s=$mysql->prepare($q);
			$s->execute();
			$row=$s->fetch(PDO::FETCH_ASSOC);
			$code=$row['code'];
			if($code<=9)
			{
			$s_code="SP0000".($code+1);
			}
			
			else if($code>9 && $code<99)
			{
			$s_code="SP000".($code+1);
			}
			else if($code>99 && $code<999)
			{
			$s_code="SP00".($code+1);
			}
			else if($code>999 && $code<9999)
			{
			$s_code="SP0".($code+1);
			}
			else 
			{
			$s_code="SP".($code+1);
			}
			
			$qq="INSERT INTO supplier_code(supplier_code)VALUES('$s_code')";
			$ss=$mysql->prepare($qq);
			$ss->execute();
			
			$qry="INSERT INTO supplier_tbl(supplier_code,s_nm,adrs,contact,mob,country,uid)VALUES('$s_code','$sname','$address','$contact','$mobile','$country','$uid')";
			$stm=$mysql->prepare($qry);
			$stm->execute();
			
		}
	}
echo "<script>alert('Recored Inserted Successfully...!')</script>";
echo "<script>window.location.href='companyMaster.php'</script>";
}
?>