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
		if($filesop[0]=='Sage code')
		{}		
		else
		{			
			$uId=$_POST['euid'];
			$sg=$filesop[0];
			$reord=$filesop[1];		
			$locNo=$filesop[2];	
			$locId=$filesop[3];	
			
			$q="SELECT fgId AS ID,reorder_level_qty AS preord FROM fg_master WHERE sage_code='$sg' AND location_id='$locId' AND sts='0'";
			$stmt=$mysql->prepare($q);
			$stmt->execute();
			$row=$stmt->fetch(PDO::FETCH_ASSOC);
			$itemId=$row['ID'];
			$preord=$row['preord'];
			
			$qq1="SELECT ID FROM fg_reorderupt WHERE itemId='$itemId' AND sage_code='$sg' AND locId='$locId'";
			//echo $qq1."<Br>";
			$stmtt1=$mysql->prepare($qq1);
			$stmtt1->execute();
			$row1=$stmtt1->fetch(PDO::FETCH_ASSOC);
			$reordchangeId=0;
			
			if(!empty($row1['ID']))
			$reordchangeId=$row1['ID'];
			
			if($reordchangeId=='0')
			{
				$q1="UPDATE fg_master SET reorder_level_qty='$reord' WHERE fgId='$itemId' AND sage_code='$sg' AND sts='0' AND location_id='$locId'";
				$stmt1=$mysql->prepare($q1);
				$stmt1->execute();

				$q22="SELECT ID FROM stock_tbl WHERE itemId='$itemId' AND locId='$locId' AND sts='0'";
				//echo $q22."<Br>";
				$stmt22=$mysql->prepare($q22);
				$stmt22->execute();
				$row22=$stmt22->fetch(PDO::FETCH_ASSOC);
				$stkId=0;
				if(!empty($row22['ID']))
				$stkId=$row22['ID'];

				if($stkId!='0')
				{
					$q2="UPDATE stock_tbl SET reord_qty='$reord' WHERE itemId='$itemId' AND locId='$locId' AND sts='0' AND ID='$stkId'";
					//echo $q2."<Br>";
					$stmt2=$mysql->prepare($q2);
					$stmt2->execute();

					$q21="UPDATE stock_tbl_2 SET reord_qty='$reord' WHERE itemId='$itemId' AND locId='$locId' AND sts='0' AND stkId='$stkId'";
					//echo $q21."<Br>";
					$stmt21=$mysql->prepare($q21);
					$stmt21->execute();
				}

				$qq="INSERT INTO fg_reorderupt(sage_code,itemId,preordqty,reordqty,locId,reqby,stkId)VALUES('$sg','$itemId','$preord','$reord','$locId','By Requested by Imran Sir ON 19-12-2022','$stkId')";
				//echo $qq."<Br>";
				$stmtt=$mysql->prepare($qq);
				$stmtt->execute();
			}
		}
	}
$mysql=null;	
echo "<script>alert('Recored Uploaded Successfully...!')</script>";
echo "<script>window.location.href='uploadRordQty.php'</script>";
}
?>