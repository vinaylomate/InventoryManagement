<?php
if(isset($_POST['btn']))
{
	include('mysql.connect.php');
	$file=$_FILES['file']['tmp_name'];
	$handle=fopen($file,"r");
	$c=0;
	date_default_timezone_set('Asia/Calcutta');
	$date=date('Y-m-d');			
	while(($filesop=fgetcsv($handle,1000,","))!==false)
	{
		if(empty($filesop[0]) || $filesop[0]=='Country')
		{
		}
		
		else
		{   
		    $country=$filesop[0];
			$code=$filesop[1];
			$itemcode=$filesop[2];
			$description=$filesop[3];
			$price=$filesop[4];
			$sg=$filesop[5];
			$uom=$filesop[6];
			$supplier_code=$filesop[7];
			$packing_size=$filesop[8];
			
			$uid=$_POST['euid'];
			
			
			
			$qry="INSERT INTO rm_master(dt,country,`code`,item_code,descc,price,SG,UOM,packing_size,supplier_code,uid)
								 VALUES('$date','$country','$code','$itemcode','$description','$price','$sg','$uom','$packing_size','$supplier_code','$uid')";
			$stm=$mysql->prepare($qry);
			$stm->execute();
			$lastId=$mysql->lastInsertId();
			
			$qq="INSERT INTO rm_master_history(dt,ErmId,country,`code`,item_code,descc,price,SG,UOM,packing_size,supplier_code,uid)
										VALUES('$date','$lastId','$country','$code','$itemcode','$description','$price','$sg','$uom','$packing_size','$supplier_code','$uid')";
			$ss=$mysql->prepare($qq);
			$ss->execute();							
			
			
		}
	}
$mysql=null;	
echo "<script>alert('Recored Inserted Successfully...!')</script>";
echo "<script>window.location.href='rmMaster.php'</script>";
}
?>