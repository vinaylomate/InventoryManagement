<?php
if(isset($_POST['btn']))
{
	include("mysql.connect_online.php"); 
	date_default_timezone_set('Asia/Calcutta');
	$file=$_FILES['file']['tmp_name'];
	$handle=fopen($file,"r");
	$c=1;
				
	while(($filesop=fgetcsv($handle,1000,","))!==false)
	{
		if(empty($filesop[0])|| $filesop[0]=='SG' || $filesop[0]=='SageCode')
		{
			
		}		
		else
		{   
		    /*$sg=$filesop[0];
			$fc=$filesop[1];
			$loc='8';
			
			$q1="SELECT fgId AS ID,sage_code,focus_code FROM fg_master WHERE sage_code='$sg' AND focus_code='$fc' AND location_id='$loc'";
			//echo $q1."<br>";
			$stmt1=$mysql_online->prepare($q1);
			$stmt1->execute();
			$row1=$stmt1->fetch(PDO::FETCH_ASSOC);
			$fgId=$row1['ID'];
			$sgc=$row1['sage_code'];
			$fc=$row1['focus_code'];
			
			//echo 'Item Details : '.$fgId." - ".$sgc." - ".$fc."<Br>";
			
			$q2="SELECT ID,in_qty,lock_qty,out_qty,stk_qty FROM stock_tbl WHERE itemId='$fgId' AND locId='$loc'";
			//echo $q2."<br>";
			$stmt2=$mysql_online->prepare($q2);
			$stmt2->execute();
			$row2=$stmt2->fetch(PDO::FETCH_ASSOC);
			$stkId=$row2['ID'];
			$in=$row2['in_qty'];
			$out=$row2['out_qty'];
			$lc=$row2['lock_qty'];
			$stkq=$row2['stk_qty'];
			
			//echo 'Stock : '.$fgId." - ".$sgc." - ".$fc." => ".$stkId." - ".$in." - ".$out." - ".$lc.' - '.$stkq."<Br>";
			
			$q3="SELECT stkId,itemId,SUM(openstk) AS op,SUM(in_qty) AS inq, SUM(out_qty) AS outq,SUM(lock_qty) AS lockq,SUM(stk_qty) AS stkq FROM stock_tbl_2 WHERE itemId='$fgId' AND locId='$loc' AND sts='0' GROUP BY stkId,itemId";
			//echo $q3."<br>";
			$stmt3=$mysql_online->prepare($q3);
			$stmt3->execute();
			$row3=$stmt3->fetch(PDO::FETCH_ASSOC);
			$stkIds=$row3['stkId'];
			$op=$row3['op'];
			$in1=$row3['inq'];
			$out1=$row3['outq'];
			$lc1=$row3['lockq'];
			$stkq1=$row3['stkq'];
			
			
			//echo 'Stock Details : '.$fgId." - ".$sgc." - ".$fc." => ".$stkIds." - ".$op." - ".$in1." - ".$out1." - ".$lc1.' - '.$stkq1."<Br>";
			echo '---------------------------------------------------------------------------------------------------------------------------------------<br>';
			$q4="UPDATE stock_tbl SET in_qty='$stkq1',stk_qty='$stkq1' WHERE itemId='$fgId' AND locId='$loc' AND ID='$stkId'";
			echo $c." : ".$q4."<br>";
			$stmt4=$mysql_online->prepare($q4);
			//$stmt4->execute();
			echo '---------------------------------------------------------------------------------------------------------------------------------------<br>';
			$c++;*/
			$dt='2023-01-05';
			$sg=$filesop[0];
			$fc=$filesop[1];
			$lc=$filesop[2];
			$bc=$filesop[3];
			$dt1=$filesop[4];
			
			if (strpos($dt1, "/") !== false) 
            {
              $dt2=explode('/',$dt1);
              $expdt=$dt2[2]."-".$dt2[1]."-".$dt2[0];	
            }
            else
            {
              $dt2=explode('-',$dt1);
              $expdt=$dt2[2]."-".$dt2[1]."-".$dt2[0];	
            }
			
			$qt=$filesop[5];
			
			$q1="SELECT fgId AS ID,reorder_level_qty AS reord,rackNo AS rack FROM fg_master WHERE (sage_code='$sg' OR focus_code='$fc') AND location_id='$lc'";
			echo $q1."<br>";
			$stmt1=$mysql_online->prepare($q1);
			$stmt1->execute();
			$row1=$stmt1->fetch(PDO::FETCH_ASSOC);
			$fgId=$row1['ID'];
			$reord=$row1['reord'];
			$rack=$row1['rack'];
			
			echo 'Item Details : '.$fgId." - ".$sg." - ".$fc."<Br>";
			
			$q2="INSERT INTO stock_tbl(compId,locId,iType,itemId,in_qty,stk_qty,reord_qty,rackNo,uid)
			VALUES('1','$lc','2','$fgId','$qt','$qt','$reord','$rack','1')";
			echo $q2."<br>";
			$stmt2=$mysql_online->prepare($q2);
			$stmt2->execute();
			$stkId=$mysql_online->lastInsertId();
			$q3="INSERT INTO stock_tbl_2(dt,stkId,compId,locId,iType,itemId,batchNo,expdt,openstk,stk_qty,reord_qty,rackNo,uid)
			VALUES('$dt','$stkId','1','$lc','2','$fgId','$bc','$expdt','$qt','$qt','$reord','$rack','1')";
			echo $q3."<br>";
			$stmt3=$mysql_online->prepare($q3);
			$stmt3->execute();
		}
	}
$mysql_online=null;	
/*echo "<script>alert('Recored Inserted Successfully...!')</script>";
echo "<script>window.location.href='uploadaM.php'</script>";*/
}
?>