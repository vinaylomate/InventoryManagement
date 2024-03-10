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
		if($filesop[0]=='Header')
		{
		}
		
		else
		{			
			$expdt="-";	
			$uId=$_POST['euid'];
			$head=$filesop[0];			
			//echo $head."<Br>";	
			if($head=='0')
			{		
				$compId=$locId=$invId=0;
				//CompId
				$comp=$filesop[1];
				$qc="SELECT ID FROM company_tbl WHERE company_code='$comp' AND sts!='2'";
				$stc=$mysql->prepare($qc);
				$stc->execute();
				$rwc=$stc->fetch(PDO::FETCH_ASSOC);
				$compId=$rwc['ID'];
				//CompId

				if($filesop[2]=='FG' || $filesop[2]=='Fg' || $filesop[2]=='fg')
				$iType=2;
				else
				$iType=1;

				//locId
				$loc=$filesop[3];
				$qlc="SELECT ID FROM location_tbl WHERE loc_code='$loc' AND company_id='$compId' AND sts!='2' AND iType='$iType'";
				$stlc=$mysql->prepare($qlc);
				$stlc->execute();
				$rwlc=$stlc->fetch(PDO::FETCH_ASSOC);
				$locId=$rwlc['ID'];
				//locId		


				$d=$filesop[4];
				$yr2="";
				if (strpos($d, "/") !== false) 
				{
				  $d1=explode('/',$d);
				  $dt=$d1[2]."-".$d1[1]."-".$d1[0];	
				  $yr2=$d1[2];
				}
				else
				{
				  $d1=explode('-',$d);
				  $dt=$d1[2]."-".$d1[1]."-".$d1[0];	
				  $yr2=$d1[2];
				}
				$sgref=$filesop[5];
			
				if(empty($filesop[6]) || $filesop[6]=='0')
				$nts="-";
				else
				$nts=$filesop[6];
				
				//Inventry
				$qInv="SELECT ID FROM inventory_tbl WHERE compId='$compId' AND locId='$locId' AND iType='$iType' AND ref='$sgref' AND sts='0' AND dt='$dt' AND docNo='$docNo'";
				//echo $qInv."<Br>";
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
				
				if($invId=='-1')
				{				
					$date3 = date('Y',strtotime($dt));
					$date22 = strtotime($date3);
					$fiscalYr=strftime('%y',$date22);
					$yr=$fiscalYr;
					//start of series
					$lc_cd=$loc;
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
					//echo $qnos."<Br>";
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

					//$docNo=$lc_cd.$yr.'0'.$nos;
					//end of series	
				}
				
				//start of inventory_tbl
				$qinvs="INSERT INTO inventory_tbl(dt,compId,locId,iType,docNo,uid,yr,yr2,ref,notes)
				VALUES('$dt','$compId','$locId','$iType','$docNo','$uId','$yr','$yr2','$sgref','$nts')";
				//echo $qinvs."<Br>";
				$stinvs=$mysql->prepare($qinvs);
				$stinvs->execute();
				$invId=$mysql->lastInsertId();
				//end of inventory_tbl
				
				$sgref=$nts="";
				//echo "<b>Inventory Data =></b><span style='color:darkorange;font-weight:bold;'> InvId - ".$invId." || Doc No - ".$docNo." || Yr - ".$fiscalYr." || Yr2 - ".$yr2."</span><Br>";
				
				if(empty($filesop[7]))
				{
					
				}
			}
			else
			{
				
				$docNo=$docNo;
				$dt=$dt;
				$compId=$compId;
				$locId=$locId;
				$invId=$invId;
				$sg=$filesop[7];			
				$fc=$filesop[8];
				$batch=$filesop[9];
				$eTypeNm=$filesop[10];
				$qty=$filesop[11];
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

				//echo "DATE : ".$dt."<Br>";

				if($fc=='' || empty($fc))
				{
					if($iType=='1')
					{
						$qItem="SELECT rmId AS ID,product_expiry,reorder_level_qty AS roq,rackNo AS rk  FROM rm_master WHERE sage_code='$sg' AND company_id='$compId' AND location_id='$locId' AND sts!='2'";
					}
					else
					{
						$qItem="SELECT fgId AS ID,product_expiry,reorder_level_qty AS roq,rackNo AS rk FROM fg_master WHERE sage_code='$sg' AND company_id='$compId' AND location_id='$locId' AND sts!='2'";
					}	
				}
				else
				{
					if($iType=='1')
					{
						$qItem="SELECT rmId AS ID,product_expiry,reorder_level_qty AS roq,rackNo AS rk  FROM rm_master WHERE sage_code='$sg' AND focus_code='$fc' AND company_id='$compId' AND location_id='$locId' AND sts!='2'";
					}
					else
					{
						$qItem="SELECT fgId AS ID,product_expiry,reorder_level_qty AS roq,rackNo AS rk FROM fg_master WHERE sage_code='$sg' AND focus_code='$fc' AND company_id='$compId' AND location_id='$locId' AND sts!='2'";
					}	
				}
				//echo $qItem."<Br>";
				$stItem=$mysql->prepare($qItem);
				$stItem->execute();
				$rwItem=$stItem->fetch(PDO::FETCH_ASSOC);
				$itemId=$expyr=$roq=$rk=0;
				if(!empty($rwItem['ID']))
				{
					$itemId=$rwItem['ID'];
					$expyr=$rwItem['product_expiry'];
					$roq=$rwItem['roq'];
					$rk=$rwItem['rk'];
				}

				$qEntry="SELECT entryId FROM entry_type_tbl WHERE LOWER(entryNm) LIKE '%".strtolower($eTypeNm)."%' AND eType='$eType'";
				//echo $qEntry."<br>";
				$stEntry=$mysql->prepare($qEntry);
				$stEntry->execute();
				$rwEntry=$stEntry->fetch(PDO::FETCH_ASSOC);
				$entryId=0;
				if(!empty($rwEntry['entryId']))
				$entryId=$rwEntry['entryId'];

				//echo "DT : ".$dt."<Br>";
				
				if($eType=='1')
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
				//echo $expdt."<Br>";	

				//Inventry Info
				$qInvInfo="SELECT ID FROM inventory_info_tbl WHERE invId='$invId' AND itemId='$itemId' AND entryId='$entryId' AND eType='$eType' AND qty='$qty' AND batchNo='$batch' AND expdt='$expdt' AND sts='0'";
				$stmtInvInfo=$mysql->prepare($qInvInfo);
				$stmtInvInfo->execute();
				$rowInvInfo=$stmtInvInfo->fetch(PDO::FETCH_ASSOC);
				$invInfoId=0;
				if(empty($rowInvInfo['ID']))
				{
					$qinvInfo2="INSERT INTO inventory_info_tbl(invId,itemId,entryId,eType,qty,batchNo,expdt)	VALUES('$invId','$itemId','$entryId','$eType','$qty','$batch','$expdt')";
					//echo $qinvInfo2."<Br>";
					$stinvInfo2=$mysql->prepare($qinvInfo2);
					$stinvInfo2->execute();
					$invInfoId=$mysql->lastInsertId();
				}
				else
				{
				  $invInfoId=$rowInvInfo['ID'];
				}
				
				if($eType=='1')
				{
					//echo 'IN : <Br>';
					//Stock Tbl
                    $qstk="SELECT ID,in_qty,out_qty,stk_qty,reord_qty,rackNo FROM stock_tbl WHERE compId='$compId' AND locId='$locId' AND iType='$iType' AND itemId='$itemId' AND sts='0'";
                    //echo $qstk."<br>";
                    $stmtstk=$mysql->prepare($qstk);
                    $stmtstk->execute();
                    $rwstk=$stmtstk->fetch(PDO::FETCH_ASSOC);
                    $stkId=$inq=$oq=$stkq="0";
                    if(!empty($rwstk['ID']))
                    {
                        $stkId=$rwstk['ID'];
                        $inq=$rwstk['in_qty'];
                        $oq=$rwstk['out_qty'];
                        $stkq=$rwstk['stk_qty'];
                        $roq=$rwstk['reord_qty'];
                        $rk=$rwstk['rackNo'];
						
						$inq=$inq+$qty;
						$stkq=$stkq+$qty;
						
						$qstkins="UPDATE stock_tbl SET in_qty='$inq',stk_qty='$stkq' WHERE ID='$stkId' AND compId='$compId' AND locId='$locId' AND iType='$iType' AND itemId='$itemId' AND sts='0'";
						//echo $qstkins."<br>";
						$stmtstkins=$mysql->prepare($qstkins);
						$stmtstkins->execute();
						
						$qstkins2="INSERT INTO stock_tbl_2(dt,stkId,compId,locId,iType,itemId,batchNo,expdt,in_qty,stk_qty,reord_qty,rackNo,uid)
						VALUES('$dt','$stkId','$compId','$locId','$iType','$itemId','$batch','$expdt','$qty','$qty','$roq','$rk','$uId')";
						//echo $qstkins2."<br>";
						$stmtstkins2=$mysql->prepare($qstkins2);
						$stmtstkins2->execute();
                    }
					else
					{
						$qstkins="INSERT INTO stock_tbl(compId,locId,iType,itemId,in_qty,stk_qty,reord_qty,rackNo,uid)
						VALUES('$compId','$locId','$iType','$itemId','$qty','$qty','$roq','$rk','$uId')";
						//echo $qstkins."<br>";
						$stmtstkins=$mysql->prepare($qstkins);
						$stmtstkins->execute();
						$stkId=$mysql->lastInsertId();
						
						$qstkins2="INSERT INTO stock_tbl_2(dt,stkId,compId,locId,iType,itemId,batchNo,expdt,in_qty,stk_qty,reord_qty,rackNo,uid)
						VALUES('$dt','$stkId','$compId','$locId','$iType','$itemId','$batch','$expdt','$qty','$qty','$roq','$rk','$uId')";
						//echo $qstkins2."<br>";
						$stmtstkins2=$mysql->prepare($qstkins2);
						$stmtstkins2->execute();
					}
                    //Stock Tbl
				}
				else
				{	
					//echo 'out : <Br>';
					//Stock Tbl
                    $qstk="SELECT ID,in_qty,out_qty,stk_qty,reord_qty,rackNo FROM stock_tbl WHERE compId='$compId' AND locId='$locId' AND iType='$iType' AND itemId='$itemId' AND sts='0'";
                    //echo $qstk."<br>";
                    $stmtstk=$mysql->prepare($qstk);
                    $stmtstk->execute();
                    $rwstk=$stmtstk->fetch(PDO::FETCH_ASSOC);
                    $stkId=$inq=$oq=$stkq="0";
                    if(!empty($rwstk['ID']))
                    {
                        $stkId=$rwstk['ID'];
                        $inq=$rwstk['in_qty'];
                        $oq=$rwstk['out_qty'];
                        $stkq=$rwstk['stk_qty'];
                        $roq=$rwstk['reord_qty'];
                        $rk=$rwstk['rackNo'];
						
						//echo "At Start - Stock Qty : ".$stkq."<Br>";						
						$oq=$oq+$qty;
						$stkq=$stkq-$qty;
						//echo "At End - Stock Qty : ".$stkq."<Br>";
						$qstkins="UPDATE stock_tbl SET out_qty='$oq',stk_qty='$stkq' WHERE ID='$stkId' AND compId='$compId' AND locId='$locId' AND iType='$iType' AND itemId='$itemId' AND sts='0'";
						//echo $qstkins."<br>";
						$stmtstkins=$mysql->prepare($qstkins);
						$stmtstkins->execute();
						
						$qstkins2="INSERT INTO stock_tbl_2(dt,stkId,compId,locId,iType,itemId,batchNo,expdt,out_qty,stk_qty,reord_qty,rackNo,uid)
						VALUES('$dt','$stkId','$compId','$locId','$iType','$itemId','$batch','$expdt','$qty','$qty','$roq','$rk','$uId')";
						//echo $qstkins2."<br>";
						$stmtstkins2=$mysql->prepare($qstkins2);
						$stmtstkins2->execute();
						
						/*$qstk2chk="SELECT ID,in_qty,out_qty,stk_qty FROM stock_tbl_2 WHERE dt='$dt' AND stkId='$stkId' AND compId='$compId' AND locId='$locId' AND iType='$iType' AND itemId='$itemId' AND batchNo='$batch' AND sts='0' AND in_qty!='0'";*/
						$qstk2chk="SELECT ID,in_qty,out_qty,stk_qty FROM stock_tbl_2 WHERE stkId='$stkId' AND compId='$compId' AND locId='$locId' AND iType='$iType' AND itemId='$itemId' AND batchNo='$batch' AND sts='0' AND (in_qty!='0' OR openstk!='0')";
						//echo $qstk2chk."<br>";
						$stmtstkchk=$mysql->prepare($qstk2chk);
						$stmtstkchk->execute();
						$rwstkchk=$stmtstkchk->fetch(PDO::FETCH_ASSOC);
						$stkId2=$inq2=$oq2=$stkq2="0";
						if(!empty($rwstkchk['ID']))
						{
							$stkId2=$rwstkchk['ID'];
							$inq2=$rwstkchk['in_qty'];
							$oq2=$rwstkchk['out_qty'];
							$stkq2=$rwstkchk['stk_qty'];
							$pstkq2=$rwstkchk['stk_qty'];
							
							//echo "At Start - Stock2 Qty : ".$pstkq2."<Br>";
							$stkq2=$stkq2-$qty;
							//echo "At Start - Stock2 Qty : ".$stkq2."<Br>";
							
							$qstkins22="UPDATE stock_tbl_2 SET stk_qty='$stkq2' WHERE ID='$stkId2' AND stkId='$stkId' AND compId='$compId' AND locId='$locId' AND iType='$iType' AND itemId='$itemId' AND batchNo='$batch' AND sts='0'";
							//echo $qstkins22."<br>";
							$stmtstkins22=$mysql->prepare($qstkins22);
							$stmtstkins22->execute();
						}
						
						
                    }
					else
					{
						$qstkins="INSERT INTO stock_tbl(compId,locId,iType,itemId,in_qty,stk_qty,reord_qty,rackNo,uid)
						VALUES('$compId','$locId','$iType','$itemId','$qty','$qty','$roq','$rk','$uId')";
						//echo $qstkins."<br>";
						$stmtstkins=$mysql->prepare($qstkins);
						$stmtstkins->execute();
						$stkId=$mysql->lastInsertId();
						
						$qstkins2="INSERT INTO stock_tbl_2(dt,stkId,compId,locId,iType,itemId,batchNo,expdt,in_qty,stk_qty,reord_qty,rackNo,uid)
						VALUES('$dt','$stkId','$compId','$locId','$iType','$itemId','$batch','$expdt','$qty','$qty','$roq','$rk','$uId')";
						//echo $qstkins2."<br>";
						$stmtstkins2=$mysql->prepare($qstkins2);
						$stmtstkins2->execute();
					}
                    //Stock Tbl
				
				}
				
				//Inventry Info

				/*echo "<b>Basic Data =></b><span style='color:#f00;font-weight:bold;'> CompId - ".$compId." || LocId - ".$locId." || Date - ".$dt." || Sage Ref - ".$sgref." || Notes - ".$nts." || ItemId - ".$itemId." || Entry TypeNm - ".$eTypeNm." || Entry Type - ".$eType." || Entry Id - ".$entryId." || Quantity - ".$qty." || Exp. Yr - ".$expyr." || Exp. Dt - ".$expdt."</span><Br>";
				echo "<b>Stock Data =></b><span style='color:green;font-weight:bold;'> Stock Id - ".$stkId." || INQty - ".$inq." || OUTQTY - ".$oq." || STKQTY - ".$stkq." || RORQ - ".$roq." || RK - ".$rk."</span><Br>";
				echo "<b>Stock2 Data =></b><span style='color:blue;font-weight:bold;'> Stock Id2 - ".$stkId2." || INQty2 - ".$inq2." || OUTQTY2 - ".$oq2." || STKQTY2 - ".$stkq2."</span><Br>";
				
				echo "<b>Inventory Info Data =></b><span style='color:maroon;font-weight:bold;'> InvInfoId - ".$invInfoId."</span><Br>";-*/
				//echo "-------------------------------------------------------------------------------------------------------------------------------------------<br>";
			}
			
			
		}
	}
$mysql=null;	
echo "<script>alert('Recored Uploaded Successfully...!')</script>";
echo "<script>window.location.href='inventoryUpload.php'</script>";
}
?>