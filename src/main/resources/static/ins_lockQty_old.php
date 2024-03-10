<?php
//if(isset($_POST['btnsub']))
include('mysql.connect.php');
$uId=$_POST['uid'];
$dt=$_POST['txtdt'];
$compId=$_POST['compId'];
$locId=$_POST['location'];	
$docNo=$_POST['txtserialno'];	
/*$compId=$_POST['cmpId'];
$locId=$_POST['lcId'];*/
$iType=$_POST['iType'];
$itemId=$_POST['item_id'];
$eTypeId=$_POST['eTypesId'];
$eType=$_POST['eTypes'];
$qty=$_POST['qty'];
$batchno=$_POST['batch'];
$ref=$_POST['ref'];

if(empty($_POST['nts']) || $_POST['nts']=='')
$notes="-";
else
$notes=$_POST['nts'];

$expdt=$_POST['expdt'];
$stkqty=$_POST['stkqty'];
$bqty=$_POST['bqty'];
$yr=$_POST['yr'];
$yr2=$_POST['yr2'];
$rordqty=$_POST['rordqty'];
$rackNo=$_POST['rackNo'];
$stkIds=$_POST['stkId'];
$stkId2=$_POST['stkId2'];
$salemanId=$_POST['smId'];

$qq="SELECT ID FROM inventory_tbl WHERE dt='$dt' AND compId='$compId' AND locId='$locId' AND iType='$iType' AND docNo='$docNo' AND uid='$uId' AND sts!='2' AND lsts='1'";
$st=$mysql->prepare($qq);
$st->execute();
$row=$st->fetch(PDO::FETCH_ASSOC);
if($st->rowCount()>0)
{
	$mysql=null;
	echo "Record Already Exist...!";
}
else
{	
	//start of series
	$qq="SELECT loc_code FROM location_tbl WHERE sts!='2' AND ID='$locId'";
	$st=$mysql->prepare($qq);
	$st->execute();
	$roww=$st->fetch(PDO::FETCH_ASSOC);
	$lc_cd=$roww['loc_code'];
	$docNo="";
	
	$qq1="SELECT ID,docNo AS nos FROM doc_no_tbl WHERE locId='$locId' AND yr='$yr2' ORDER BY docNo";
	$st1=$mysql->prepare($qq1);
	$st1->execute();
	$roww1=$st1->fetch(PDO::FETCH_ASSOC);
	$nos=$nosId=0;
	if(empty($roww1['nos']))
	{
		$nos=1;
		$nosId=0;
	}
	else
	{
		$nosId=$roww1['ID'];
		$nos=($roww1['nos']+1);
	}
	
	if($nosId==0)
	{
	  $qnos="INSERT INTO doc_no_tbl(docNo,locId,yr)VALUES('$nos','$locId','$yr2')";	
	}
	else
	{
	  $qnos="UPDATE doc_no_tbl SET docNo='$nos' WHERE locId='$locId' AND yr='$yr2' AND ID='$nosId'";		
	}
	$stnos=$mysql->prepare($qnos);
	$stnos->execute();	
	
	$len=strlen($nos);
	if($len==1)
	{
		$docNo=$lc_cd.$yr.'0000'.$nos;
	}
	else if($len>1)
	{
		$docNo=$lc_cd.$yr.'0000'.$nos;
	}
	else if($len>2)
	{
		$docNo=$lc_cd.$yr.'000'.$nos;
	}
	else if($len>3)
	{
		$docNo=$lc_cd.$yr.'00'.$nos;
	}
	else if($len>4)
	{
		$docNo=$lc_cd.$yr.'0'.$nos;
	}
	else
	{
		$docNo=$lc_cd.$yr.$nos;
	}
	//end of series
	
	//start of inventory_tbl
	$qinv="INSERT INTO inventory_tbl(dt,compId,locId,iType,docNo,uid,yr,yr2,ref,notes,lsts,salemnId)	VALUES('$dt','$compId','$locId','$iType','$docNo','$uId','$yr','$yr2','$ref','$notes','1','$salemanId')";
	//echo $qinv."<Br>";
	$stinv=$mysql->prepare($qinv);
	$stinv->execute();
	$invId=$mysql->lastInsertId();
	//end of inventory_tbl
	
	//start of inventoryinfo_tbl & stock
	$c=count($itemId);
	for($i=0;$i<$c;$i++)
	{
		/*$qinvInfo="INSERT INTO inventory_info_tbl(invId,itemId,entryId,eType,qty,batchNo,expdt,ref,notes)	VALUES('$invId','$itemId[$i]','$eTypeId[$i]','$eType[$i]','$qty[$i]','$batchno[$i]','$expdt[$i]','$ref[$i]','$notes[$i]')";*/
		$qinvInfo="INSERT INTO inventory_info_tbl(invId,itemId,entryId,eType,qty,batchNo,expdt)	VALUES('$invId','$itemId[$i]','$eTypeId[$i]','$eType[$i]','$qty[$i]','$batchno[$i]','$expdt[$i]')";
		$stinvInfo=$mysql->prepare($qinvInfo);
		//echo $qinvInfo."<Br>";		
		$stinvInfo->execute();
		
			if($stkIds[$i]=='0')
			{
				$qstk="SELECT ID,stk_qty,lock_qty FROM stock_tbl WHERE compId='$compId' AND locId='$locId' AND iType='$iType' AND itemId='$itemId[$i]' AND sts!='2'";
			}
			else
			{
				$qstk="SELECT ID,stk_qty,lock_qty FROM stock_tbl WHERE compId='$compId' AND locId='$locId' AND iType='$iType' AND itemId='$itemId[$i]' AND ID='$stkIds[$i]' AND sts!='2'";
			}
			//echo "OUT - B : ".$qstk."<Br>";	
			$stmtstk=$mysql->prepare($qstk);
			$stmtstk->execute();
			$rwstk=$stmtstk->fetch(PDO::FETCH_ASSOC);
			$stkId=$balQty=$out_qty=0;
			if(empty($rwstk['ID']))
			{
			  $qstk1="INSERT INTO stock_tbl(compId,locId,iType,itemId,lock_qty,stk_qty,			  reord_qty,rackNo,uid)VALUES('$compId','$locId','$iType','$itemId[$i]','$qty[$i]','$qty[$i]','$rordqty[$i]','$rackNo[$i]','$uId')";
			  //echo "OUT - B : ".$qstk1."<Br>";	
			  $stmtstk1=$mysql->prepare($qstk1);
			  $stmtstk1->execute();	
			  $stkId=$mysql->lastInsertId();
				
			  $qstk2="INSERT INTO stock_tbl_2(dt,stkId,compId,locId,iType,itemId,lock_qty,stk_qty,	  reord_qty,rackNo,uid,batchNo)VALUES('$dt','$stkId','$compId','$locId','$iType','$itemId[$i]','$qty[$i]','$qty[$i]','$rordqty[$i]','$rackNo[$i]','$uId','$batchno[$i]')";
			  //echo "OUT - B : ".$qstk2."<Br>";	
			  $stmtstk2=$mysql->prepare($qstk2);
			  $stmtstk2->execute();		
			}
			else
			{
			  $stkId=$rwstk['ID'];
			  $balQty=$rwstk['stk_qty'];
			  $out_qty=$rwstk['lock_qty'];
				
			  $balQty=$balQty-$qty[$i];	
			  $out_qty=$out_qty+$qty[$i];	
			 	
			  $qstk1="UPDATE stock_tbl SET lock_qty='$out_qty',stk_qty='$balQty' WHERE ID='$stkId' AND sts!='2'";
			  //echo "OUT - BB : ".$qstk1."<Br>";	
			  $stmtstk1=$mysql->prepare($qstk1);
			  $stmtstk1->execute();	
				
			  $qstk2="INSERT INTO stock_tbl_2(dt,stkId,compId,locId,iType,itemId,lock_qty,stk_qty,	  reord_qty,rackNo,uid,batchNo)VALUES('$dt','$stkId','$compId','$locId','$iType','$itemId[$i]','$qty[$i]','$qty[$i]','$rordqty[$i]','$rackNo[$i]','$uId','$batchno[$i]')";
			  //echo "OUT - BB : ".$qstk2."<Br>";	
			  $stmtstk2=$mysql->prepare($qstk2);
			  $stmtstk2->execute();	
				
			  if($stkId2[$i]=='0')
			  {
				  
			  }
			  else
			  {
				  $qstk3="UPDATE stock_tbl_2 SET stk_qty=stk_qty-'$qty[$i]' WHERE ID='$stkId2[$i]' AND sts!='2'";
                  //echo "OUT - BB : ".$qstk3."<Br>";	
                  $stmtstk3=$mysql->prepare($qstk3);
                  $stmtstk3->execute();	
			  }
			}
	}
	//end of inventoryinfo_tbl & stock
	$mysql=null;
	echo "Record Inserted Successfully...!"."||".$invId;
}
?>