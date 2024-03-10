<?php
if(isset($_POST['btn']))
{
	include('mysql.connect.php');
	$file=$_FILES['file']['tmp_name'];
	$handle=fopen($file,"r");
	$c=0;
				
	while(($filesop=fgetcsv($handle,1000,","))!==false)
	{
		if(empty($filesop[0]) || $filesop[0]=='Category')
		{
		}
		
		else
		{   
		    $category=$filesop[0];
			$itemcode=$filesop[1];
			$description=$filesop[2];
			$uom=$filesop[3];
			
			$uid=$_POST['euid'];
			
			$qry="INSERT INTO fg_master(category,`code`,item_code,descc,UOM,uid)VALUES('$category','0','$itemcode','$description','$uom','$uid')";
			$stm=$mysql->prepare($qry);
			$stm->execute();						
			
			
		}
	}
$mysql=null;	
echo "<script>alert('Recored Inserted Successfully...!')</script>";
echo "<script>window.location.href='fgMaster.php'</script>";
}
?>