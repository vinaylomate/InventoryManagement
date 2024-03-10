<?php
if(isset($_POST['btn']))
{
	include('config.php');
	$file=$_FILES['file']['tmp_name'];
	$handle=fopen($file,"r");
	$c=0;
				
	while(($filesop=fgetcsv($handle,1000,","))!==false)
	{
		if(empty($filesop[0]) || $filesop[0]=='StudentName')
		{
		}
		
		else
		{   
		    $comp=$filesop[0];
			$loc=$filesop[1];
			$sg=$filesop[2];
			
			$qq="INSERT INTO exam_form_tbl_3(studNm,contactNo,email)			VALUES('$comp','$loc','$sg')";
			//echo $qq."<Br>";
			$ss=$mysql->prepare($qq);
			$ss->execute();								
			
			
		}
	}
$mysql=null;	
echo "<script>alert('Recored Inserted Successfully...!')</script>";
echo "<script>window.location.href='uploadaM.php'</script>";
}
?>