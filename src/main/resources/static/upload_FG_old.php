<?php
if(isset($_POST['btn']))
{
	include('mysql.connect.php');
	$file=$_FILES['file']['tmp_name'];
	$handle=fopen($file,"r");
	$c=0;
				
	while(($filesop=fgetcsv($handle,1000,","))!==false)
	{
		if(empty($filesop[0]) || $filesop[0]=='Company Code')
		{
		}
		
		else
		{   
		    $comp=$filesop[0];
			$loc=$filesop[1];		
			$cat=strtoupper($filesop[2]);
			$sg=$filesop[3];
			$fc=$filesop[4];
			$bar=$filesop[5];
			$desp=$filesop[6];
			$brand=$filesop[7];
			$uom=$filesop[8];	
			$rord=$filesop[9];			
			$exp=$filesop[10];	
			$rack=$filesop[11];	
			$uid=$_POST['euid'];
			$iType=2;
			
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
			
			$qcat="SELECT catId FROM category_master WHERE category_nm='$cat' AND sts!='2' AND iType='$iType'";
			//echo $qcat."<Br>";
			$stcat=$mysql->prepare($qcat);
			$stcat->execute();
			$rwcat=$stcat->fetch(PDO::FETCH_ASSOC);
			$catId=0;
			if(empty($rwcat['catId']))
			{
				$qcat1="INSERT INTO category_master(category_nm,uid,iType)VALUES('$cat','$uid','$iType')";
				$stcat1=$mysql->prepare($qcat1);
				$stcat1->execute();
				$catId=$mysql->lastInsertId();
			}
			else
			{
				$catId=$rwcat['catId'];
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
			
			$qq="INSERT INTO fg_master(category_id,sage_code,focus_code,barcode,descc,brand,uom,company_id,location_id,reorder_level_qty,product_expiry,rackNo,uid)VALUES('$catId','$sg','$fc','$bar','$desp','$brand','$uomId','$compId','$locId','$rord','$exp','$rack','$uid')";
			//echo $qq."<Br>";
			$ss=$mysql->prepare($qq);
			$ss->execute();								
			
			
		}
	}
$mysql=null;	
echo "<script>alert('Recored Inserted Successfully...!')</script>";
echo "<script>window.location.href='fgMaster.php'</script>";
}
?>