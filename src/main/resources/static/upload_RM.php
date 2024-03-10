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
		if(empty($filesop[0]) || $filesop[0]=='Company Code')
		{
		}
		
		else
		{   
		    $comp=$filesop[0];
			$loc=$filesop[1];
			$sage=$filesop[2];
			$focus=$filesop[3];
			$desp=$filesop[4];
			$uom=$filesop[5];
			$rord=$filesop[6];
			$exp=$filesop[7];
			$rack=$filesop[8];		
			$catNm=strtoupper($filesop[9]);		
			$uid=$_POST['euid'];
			$iType=1;
			
			$compId=$locId=0;
			
			$qc="SELECT ID FROM company_tbl WHERE company_code='$comp' AND sts!='2'";
			$stc=$mysql->prepare($qc);
			$stc->execute();
			$rwc=$stc->fetch(PDO::FETCH_ASSOC);
			$compId=$rwc['ID'];
			
			$qlc="SELECT ID FROM location_tbl WHERE loc_code='$loc' AND company_id='$compId' AND sts!='2' AND iType='$iType'";
			$stlc=$mysql->prepare($qlc);
			$stlc->execute();
			$rwlc=$stlc->fetch(PDO::FETCH_ASSOC);
			$locId=$rwlc['ID'];
			
			$q="SELECT ID FROM uom_tbl WHERE uom='$uom' AND sts!='2'";
			$st=$mysql->prepare($q);
			$st->execute();
			$rw=$st->fetch(PDO::FETCH_ASSOC);
			$uomId=0;
			if(empty($rw['ID']))
			{
				$q1="INSERT INTO uom_tbl(uom,desp,uid)VALUES('$uom','$uom','$uid')";
				$st1=$mysql->prepare($q1);
				$st1->execute();
				$uomId=$mysql->lastInsertId();
			}
			else
			{
				$uomId=$rw['ID'];
			}
			
			$qc="SELECT catId AS ID FROM category_master WHERE category_nm='$catNm' AND sts='0' AND iType='$iType'";
			//echo $qc."<Br>";
			$stc=$mysql->prepare($qc);
			$stc->execute();
			$rwc=$stc->fetch(PDO::FETCH_ASSOC);
			$catId=0;
			if(empty($rwc['ID']))
			{
				$q1="INSERT INTO category_master(category_nm,iType,uid)VALUES('$catNm','$iType','$uid')";
				$st1=$mysql->prepare($q1);
				$st1->execute();
				$catId=$mysql->lastInsertId();
			}
			else
			{
				$catId=$rwc['ID'];
			}
			
			$qrk="SELECT rackNo FROM rack_tbl WHERE rackNo='$rack' AND sts!='2' AND iType='$iType'";
			$strk=$mysql->prepare($qrk);
			$strk->execute();
			$rwrk=$strk->fetch(PDO::FETCH_ASSOC);
			if(empty($rwrk['rackNo']))
			{
				$qrk1="INSERT INTO rack_tbl(iType,rackNo,uid)VALUES('$iType','$rack','$uid')";
				//echo $qrk1."<br>";
				$strk1=$mysql->prepare($qrk1);
				$strk1->execute();
			}
			
			//echo $compId." : ".$locId." : ".$uomId." : ".$rack."<Br>";
			
			$qq="INSERT INTO rm_master(dt,sage_code,focus_code,description,UOM,company_id,location_id,reorder_level_qty,product_expiry,rackNo,uid,catId)VALUES('$date','$sage','$focus','$desp','$uomId','$compId','$locId','$rord','$exp','$rack','$uid','$catId')";
			//echo $qq."<Br>";
			$ss=$mysql->prepare($qq);
			$ss->execute();							
			
			
		}
	}
$mysql=null;	
echo "<script>alert('Recored Inserted Successfully...!')</script>";
echo "<script>window.location.href='rmMaster.php'</script>";
}
?>