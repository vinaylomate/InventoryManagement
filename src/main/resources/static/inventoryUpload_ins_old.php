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
	while(($filesop=fgetcsv($handle,1000,","))!==false)
	{
		if(empty($filesop[0]) || $filesop[0]=='COMPANY CODE')
		{
		}
		
		else
		{
			$comp=$filesop[0];
			
			if($filesop[1]=='FG' || $filesop[1]=='Fg' || $filesop[1]=='fg')
			$iType=2;
			else
			$iType=1;
			
			$loc=$filesop[2];
			
			$d=$filesop[3];
			if (strpos($d, "/") !== false) 
			{
			  $d1=explode('/',$d);
			  $dt=$d1[2]."-".$d1[1]."-".$d1[0];	
			}
			else
			{
			  $d1=explode('-',$d);
			  $dt=$d1[2]."-".$d1[1]."-".$d1[0];	
			}
			//echo $d." : ".$dt."<Br>";
			$sgref=$filesop[4];
			
			if(empty($filesop[5]) || $filesop[5]=='0')
			$nts="-";
			else
			$nts=$filesop[5];
			
			$sg=$filesop[6];			
			$fc=$filesop[7];
			$batch=$filesop[8];
			$eTypeNm=$filesop[9];
			$qty=$filesop[10];
			$uid=$_POST['euid'];
			
			$eType=0;
			if($qty<0)
			{
				$eType=2;
				$qty=abs($qty);
			}
			else
			{
				$eType=1;
			}
			
			$expdt="-";
			
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
			
			if($iType=='1')
			{
				$qItem="SELECT rmId AS ID,product_expiry FROM rm_master WHERE sage_code='$sg' AND focus_code='$fc' AND company_id='$compId' AND location_id='$locId' AND sts!='2'";
			}
			else
			{
				$qItem="SELECT fgId AS ID,product_expiry FROM fg_master WHERE sage_code='$sg' AND focus_code='$fc' AND company_id='$compId' AND location_id='$locId' AND sts!='2'";
			}	
			$stItem=$mysql->prepare($qItem);
			$stItem->execute();
			$rwItem=$stItem->fetch(PDO::FETCH_ASSOC);
			$itemId=$expyr=0;
			if(!empty($rwItem['ID']))
			{
				$itemId=$rwItem['ID'];
				$expyr=$rwItem['product_expiry'];
			}
			
			$qEntry="SELECT entryId FROM entry_type_tbl WHERE LOWER(entryNm) LIKE '%".strtolower($eTypeNm)."%' AND eType='$eType'";
			//echo $qEntry."<br>";
			$stEntry=$mysql->prepare($qEntry);
			$stEntry->execute();
			$rwEntry=$stEntry->fetch(PDO::FETCH_ASSOC);
			$entryId=0;
			if(!empty($rwEntry['entryId']))
			$entryId=$rwEntry['entryId'];
			
			if($eType==1)
			{
			
				if( strpos( $expyr, 'Year' ) !== false || strpos( $expyr, 'YEAR' ) !== false || strpos( $expyr, 'year' ) !== false) 
				{
					$v=explode(" ",$expyr);
					$expdt=date('Y-m-d', strtotime('+'.$v[0].' year', strtotime($dt)));
					//$expdt=date('Y-m-d', strtotime('+'.$v[0].' year - 1day', strtotime($dt)));
				}
				else if( strpos( $expyr, 'Month' ) !== false || strpos( $expyr, 'MONTH' ) !== false || strpos( $expyr, 'month' ) !== false) 
				{
					$v=explode(" ",$expyr);
					$expdt=date('Y-m-d', strtotime('+'.$v[0].' month', strtotime($dt)));
				}
				else
				{
					$v=explode(" ",$expyr);
					$expdt=date('Y-m-d', strtotime('+'.$v[0].' year', strtotime($dt)));
					//$expdt=date('Y-m-d', strtotime('+'.$v[0].' year - 1day', strtotime($dt)));
				}
			}
			
			//Stock Tbl
			$qstk="SELECT ID,in_qty,out_qty,stk_qty,reord_qty,rackNo FROM stock_tbl WHERE compId='$compId' AND locId='$locId' AND iType='$iType' AND itemId='$itemId' AND sts='0'";
			//echo $qstk."<br>";
			$stmtstk=$mysql->prepare($qstk);
			$stmtstk->execute();
			$rwstk=$stmtstk->fetch(PDO::FETCH_ASSOC);
			$stkId=$inq=$oq=$stkq=$roq=$rk="0";
			if(!empty($rwstk['ID']))
			{
				$stkId=$rwstk['ID'];
				$inq=$rwstk['in_qty'];
				$oq=$rwstk['out_qty'];
				$stkq=$rwstk['stk_qty'];
				$roq=$rwstk['reord_qty'];
				$rk=$rwstk['rackNo'];
			}
			//Stock Tbl
			
			//Stock Tbl2
			
			$qstk2chk="SELECT ID,in_qty,out_qty,stk_qty FROM stock_tbl_2 WHERE dt='$dt' AND stkId='$stkId' AND compId='$compId' AND locId='$locId' AND iType='$iType' AND itemId='$itemId' AND batchNo='$batch' AND sts='0'";
			//echo qstk2chk."<br>";
			$stmtstkchk=$mysql->prepare($qstk2chk);
			$stmtstkchk->execute();
			$rwstkchk=$stmtstkchk->fetch(PDO::FETCH_ASSOC);
			$stkId2=$inq2=$oq2=$stkq2="0";
			if(!empty($rwstk['ID']))
			{
				$stkId2=$rwstk['ID'];
				$inq2=$rwstk['in_qty'];
				$oq2=$rwstk['out_qty'];
				$stkq2=$rwstk['stk_qty'];
			}			
			
			if($eType=='1')
			{
				$qstk="SELECT ID,in_qty,out_qty,stk_qty,reord_qty,rackNo FROM stock_tbl WHERE compId='$compId' AND locId='$locId' AND iType='$iType' AND itemId='$itemId' AND sts='0'";
			}
			else
			{
				
			}
			//echo $qstk."<br>";
			$stmtstk=$mysql->prepare($qstk);
			$stmtstk->execute();
			$rwstk=$stmtstk->fetch(PDO::FETCH_ASSOC);
			$stkId=$inq=$oq=$sqt=$roq=$rk="0";
			if(!empty($rwstk['ID']))
			{
				$stkId=$rwstk['ID'];
				$inq=$rwstk['in_qty'];
				$oq=$rwstk['out_qty'];
				$stkq=$rwstk['stk_qty'];
				$roq=$rwstk['reord_qty'];
				$rk=$rwstk['rackNo'];
			}
			//Stock Tbl2
			
			//Inventry
			$qInv="SELECT ID FROM inventory_tbl WHERE compId='$compId' AND locId='$locId' AND iType='$iType' AND ref='$sgref' AND sts='0' AND dt='$dt'";
			$stmtInv=$mysql->prepare($qInv);
			$stmtInv->execute();
			$rowInv=$stmtInv->fetch(PDO::FETCH_ASSOC);
			if(empty($rowInv['ID']))
			{
				if($invId==0)
				{
					$invId=-1;
				}
				else
				{
					$invId=$invId;
				}
			}
			else
			{
			  $invId=$rowInv['ID']	;
			}
			//Inventry
			
			//Inventry Info
			$qInvInfo="SELECT ID FROM inventory_info_tbl WHERE invId='$invId' AND itemId='$itemId' AND entryId='$entryId' AND eType='$eType' AND qty='$qty' AND batchNo='$batch' AND expdt='$expdt' AND sts='0'";
			$stmtInvInfo=$mysql->prepare($qInvInfo);
			$stmtInvInfo->execute();
			$rowInvInfo=$stmtInvInfo->fetch(PDO::FETCH_ASSOC);
			$invInfoId=0;
			if(empty($rowInvInfo['ID']))
			{
				$invInfoId=-1;
			}
			else
			{
			  $invInfoId=$rowInvInfo['ID']	;
			}
			//Inventry Info
			
			echo "<b>Basic Data =></b><span style='color:#f00;font-weight:bold;'> CompId - ".$compId." || LocId - ".$locId." || Date - ".$dt." || Sage Ref - ".$sgref." || Notes - ".$nts." || ItemId - ".$itemId." || Entry TypeNm - ".$eTypeNm." || Entry Type - ".$eType." || Entry Id - ".$entryId." || Quantity - ".$qty." || Exp. Yr - ".$expyr." || Exp. Dt - ".$expdt."</span><Br>";
			echo "<b>Stock Data =></b><span style='color:green;font-weight:bold;'> Stock Id - ".$stkId." || INQty - ".$inq." || OUTQTY - ".$oq." || STKQTY - ".$stkq." || RORQ - ".$roq." || RK - ".$rk."</span><Br>";
			echo "<b>Stock2 Data =></b><span style='color:blue;font-weight:bold;'> Stock Id2 - ".$stkId2." || INQty2 - ".$inq2." || OUTQTY2 - ".$oq2." || STKQTY2 - ".$stkq2."</span><Br>";
			echo "<b>Inventory Data =></b><span style='color:orange;font-weight:bold;'> InvId - ".$invId."</span><Br>";
			echo "<b>Inventory Info Data =></b><span style='color:maroon;font-weight:bold;'> InvInfoId - ".$invInfoId."</span><Br>";
			
		}
	}
$mysql=null;	
/*echo "<script>alert('Recored Inserted Successfully...!')</script>";
echo "<script>window.location.href='fgStockUpload.php'</script>";*/
}
?>