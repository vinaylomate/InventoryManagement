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
		if(empty($filesop[0]) || $filesop[0]=='Opening Date')
		{
			
		}		
		else
		{   
			$d=$filesop[0];
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
		    $comp=$filesop[1];
			$loc=$filesop[2];
			$iType=2;
			$fc=$filesop[3];
			$sg=$filesop[4];
			$batch=$filesop[5];
			$qty=$filesop[6];
			$exp1=$filesop[7];
			
			if (strpos($exp1, "/") !== false) 
			{
			  $expp=explode('/',$exp1);
			  $exp=$expp[2]."-".$expp[1]."-".$expp[0];	
			}
			else
			{
			  $expp=explode('-',$exp1);
			  $exp=$expp[2]."-".$expp[1]."-".$expp[0];	
			}
			
			$rord=$filesop[8];			
			$rack=$filesop[9];
			$uid=$_POST['euid'];
			
			
			
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
			
			$qItem="SELECT fgId FROM fg_master WHERE sage_code='$sg' AND focus_code='$fc' AND company_id='$compId' AND location_id='$locId' AND sts!='2'";
			$stItem=$mysql->prepare($qItem);
			$stItem->execute();
			$rwItem=$stItem->fetch(PDO::FETCH_ASSOC);
			$itemId=0;
			if(!empty($rwItem['fgId']))
			$itemId=$rwItem['fgId'];	
			
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
			
			if($itemId!='0')
			{
				$q2="SELECT ID,stkqty FROM stock_upload_fg WHERE opdt='$dt' AND compId='$compId' AND iType='$iType' AND itemId='$itemId' AND batchNo='$batch' AND stkqty='$qty' AND expdt='$exp' AND rordqty='$rord' AND rackNo='$rack'";
				$st2=$mysql->prepare($q2);
				$st2->execute();
				$rowup=$st2->fetch(PDO::FETCH_ASSOC);
				if(empty($rowup['ID']))
				{
					$q11="SELECT ID,in_qty,stk_qty FROM stock_tbl WHERE compId='$compId' AND locId='$locId' AND iType='$iType' AND itemId='$itemId' AND sts!='2'";	
					//echo "Stock Check : ".$q11."<Br>";
					$st11=$mysql->prepare($q11);
					$st11->execute();
					$row1=$st11->fetch(PDO::FETCH_ASSOC);
					$stkId=0;	
					//print_r($row1);
					if(empty($row1['ID']))
					{
						$qstk="INSERT INTO stock_tbl(compId,locId,iType,itemId,in_qty,stk_qty,reord_qty,rackNo,uid)
						VALUES('$compId','$locId','$iType','$itemId','$qty','$qty','$rord','$rack','$uid')";
						$stk1=$mysql->prepare($qstk);
						//echo "IF : ".$qstk."<Br>";
						$stk1->execute();
						$stkId=$mysql->lastInsertId();
					}
					else
					{
						$stkId=$row1['ID'];
						$inqty=$row1['in_qty'];
						$pinqty=$row1['in_qty'];
						$stkqty=$row1['stk_qty'];
						$pstkqty=$row1['stk_qty'];
						$inqty=$inqty+$qty;
						$stkqty=$stkqty+$qty;
						if($pstkqty!=$qty)
						{
							$qstk="UPDATE stock_tbl SET in_qty='$inqty',stk_qty='$stkqty' WHERE ID='$stkId' AND compId='$compId' AND locId='$locId' AND iType='$iType' AND itemId='$itemId' AND sts!='2'";
							//echo "Else : ".$qstk."<Br>";
							$stk1=$mysql->prepare($qstk);
							$stk1->execute();

							$qstk11="INSERT INTO stock_upt_tbl(stkId,compId,locId,iType,itemId,inq,pinq,stkq,pstkq,uid)
							VALUES('$stkId','$compId','$locId','$iType','$itemId','$inqty','$pinqty','$stkqt','$pstkqty','$uid')";
							//echo "Stock Upt - BB : ".$qstk11."<Br>";	
							$stmtstk11=$mysql->prepare($qstk11);
							$stmtstk11->execute();
						}
					}

					$q112="SELECT ID,dt,openstk,stk_qty FROM stock_tbl_2 WHERE compId='$compId' AND locId='$locId' AND iType='$iType' AND itemId='$itemId' AND sts!='2' AND stkId='$stkId' AND dt='$dt' AND batchNo='$batch'";	
					//echo "Stock Check - 2 : ".$q112."<Br>";				
					$st112=$mysql->prepare($q112);
					$st112->execute();
					$row12=$st112->fetch(PDO::FETCH_ASSOC);
					$stkId2=$fopstk=$fstk=0;	
					if(empty($row12['ID']))
					{
						$qstk2="INSERT INTO stock_tbl_2(dt,stkId,compId,locId,iType,itemId,batchNo,expdt,openstk,
						stk_qty,reord_qty,rackNo,uid)VALUES('$dt','$stkId','$compId','$locId','$iType','$itemId',
						'$batch','$exp','$qty','$qty','$rord','$rack','$uid')";
						//echo $qstk2."<Br>";
						$stk2=$mysql->prepare($qstk2);
						$stk2->execute();
						$stkId2=$mysql->lastInsertId();
					}
					else
					{
						$stkId2=$row12['ID'];
						$opstk=$row12['openstk'];
						$stkqt=$row12['stk_qty'];

						if($opstk==$qty)
						{
							$fopstk=$opstk;
							$fstk=$stkqt;
						}
						else if($opstk>$qty)
						{
							$diff=$opstk-$qty;
							$fopstk=$opstk-$diff;	
							if($opstk==$stkqt)
							{
								$fstk=$stkqt-$diff;
							}
							else 
							{
								$fstk=$stkqt+$diff;
							}
						}
						else
						{
							$diff=$qty-$opstk;
							$fopstk=$opstk+$diff;	
							$fstk=$stkqt+$diff;
						}

						if($opstk!=$fopstk)
						{
							$qstk2="UPDATE stock_tbl_2 SET openstk='$inqty',stk_qty='$stkqty' WHERE ID='$stkId2' AND compId='$compId' AND locId='$locId' AND iType='$iType' AND itemId='$itemId' AND sts!='2'";
							//echo "Else : ".$qstk2."<Br>";
							$stk12=$mysql->prepare($qstk2);
							$stk12->execute();

							$qstk22="INSERT INTO stock_tbl_2_upt_tbl(stkId,stkId2,compId,locId,iType,itemId,				batchNo,pbatchNo,stkq,pstkq,uid)VALUES('$stkId','$stkId2','$compId','$locId','$iType','$itemId','$batch','$batch','$fstk','$stkqt','$uid')";
							//echo "Stock_tbl_2_Upt - BB : ".$qstk22."<Br>";	
							$stmtstk22=$mysql->prepare($qstk22);
							$stmtstk22->execute();
						}
					}

					$qstk21="INSERT INTO stock_upload_fg(entrydt,opdt,compId,iType,locId,itemId,batchNo,stkqty,expdt,rordqty,rackNo,uid,stkId,stkId2)VALUES('$date','$dt','$compId','$iType','$locId','$itemId','$batch','$qty','$exp','$rord','$rack','$uid','$stkId','$stkId2')";
					//echo $qstk21."<Br>";
					$stk21=$mysql->prepare($qstk21);
					$stk21->execute();

					//back data Entry - Upload
					if($dt<=$date)
					{
					   $b=$dt;
					   while($b<=$date)
					   {
						  $bdt=$b;
						  $bnxdt=date("Y-m-d", strtotime($bdt."+ 1 day"));
						  //echo $bdt." : ".$bnxdt."<Br>";
						  $qb1="SELECT compId,locId,iType,itemId FROM stock_tbl WHERE sts='0' AND itemId='$itemId' GROUP BY compId,locId,iType,itemId";
						  $stmtb1=$mysql->prepare($qb1);
						  $stmtb1->execute();
						  $data1=$stmtb1->fetchAll();	
						  foreach($data1 as $rwb)
						  {
								//Get Prv. Open Bal
								$qqb="SELECT oqty FROM stock_op_tbl WHERE compId='".$rwb['compId']."' AND locId='".$rwb['locId']."' AND iType='".$rwb['iType']."' AND itemId='".$rwb['itemId']."' AND cdt='$bdt'";
								//echo $qqb."<Br>";
								$stb=$mysql->prepare($qqb);
								$stb->execute();
								$rwb1=$stb->fetch(PDO::FETCH_ASSOC);
								$opstkb=0;
								if(!empty($rwb1['oqty']))
								$opstkb=$rwb1['oqty'];
								//Get Prv. Open Bal

								$qb="SELECT dt,compId,locId,iType,itemId,SUM(openstk) AS opstk,SUM(in_qty) AS in_qty,SUM(out_qty) AS out_qty,SUM(lock_qty) AS lock_qty,SUM(stk_qty) AS stk_qty,reord_qty,rackNo,DATE_ADD(dt, INTERVAL 1 DAY) AS nxtdt FROM stock_tbl_2 WHERE sts='0' AND dt='$bdt' AND compId='".$rwb['compId']."' AND locId='".$rwb['locId']."' AND iType='".$rwb['iType']."' AND itemId='".$rwb['itemId']."' GROUP BY dt,stkId,compId,locId,iType,itemId,reord_qty,rackNo";
								//echo "AAA".$qb."<Br>";
								$stmtb=$mysql->prepare($qb);
								$stmtb->execute();
								if($stmtb->rowCount()>0)
								{
									$inq=$outq=$lockq=$stkq=0;
									while($rowb=$stmtb->fetch(PDO::FETCH_ASSOC))
									{
										$inq=$rowb['in_qty'];
										$outq=$rowb['out_qty'];
										$lockq=$rowb['lock_qty'];
										$stkq=$rowb['stk_qty'];

										if($rowb['opstk']!='0')
										$opstkb=$rowb['opstk'];

										$fstk=($opstkb+$inq)-($outq+$lockq);
										$qchk="SELECT ID FROM stock_op_tbl WHERE sts='0' AND dt='".$rowb['dt']."' AND cdt='".$rowb['nxtdt']."' AND itemId='".$rwb['itemId']."' AND compId='".$rwb['compId']."' AND locId='".$rwb['locId']."' AND iType='".$rwb['iType']."'";
										$stchk=$mysql->prepare($qchk);
										$stchk->execute();
										$rowchk=$stchk->fetch(PDO::FETCH_ASSOC);
										if(empty($rowchk['ID']))
										{
										   $q101="INSERT INTO stock_op_tbl(compId,locId,iType,itemId,dt,cqty,cdt,oqty)                           VALUES('".$rwb['compId']."','".$rwb['locId']."','".$rwb['iType']."','".$rwb['itemId']."','".$bdt."','$fstk','".$rowb['nxtdt']."','$fstk')";
										   //echo $k." - New : ".$q101."<Br>";
										   $stmt101=$mysql->prepare($q101);
										   $stmt101->execute(); 
										}
										else
										{
										   $q101="UPDATE stock_op_tbl SET cqty='$fstk',oqty='$fstk' WHERE ID='".$rowchk['ID']."' AND sts='0'";
										   //echo $k." - OLD : ".$q101."<Br>";
										   $stmt101=$mysql->prepare($q101);
										   $stmt101->execute(); 
										}
									}
								}
								else
								{
									$inq=$outq=$lockq=$stkq=0;        
									$fstk=($opstkb+$inq)-($outq+$lockq);
									$qchk="SELECT ID,cqty FROM stock_op_tbl WHERE sts='0' AND dt='$bdt' AND cdt='".$bnxdt."' AND itemId='".$rwb['itemId']."' AND compId='".$rwb['compId']."' AND locId='".$rwb['locId']."' AND iType='".$rwb['iType']."'";
									//echo "BBB".$qchk."<Br>";
									$stchk=$mysql->prepare($qchk);
									$stchk->execute();
									$rowchk=$stchk->fetch(PDO::FETCH_ASSOC);
									if(empty($rowchk['ID']))
									{
									   $q101="INSERT INTO stock_op_tbl(compId,locId,iType,itemId,dt,cqty,cdt,oqty)
									   VALUES('".$rwb['compId']."','".$rwb['locId']."','".$rwb['iType']."','".$rwb['itemId']."','".$bdt."','$fstk','".$bnxdt."','$fstk')";
									   //echo $k." - Else - New : ".$q101."<Br>";
									   $stmt101=$mysql->prepare($q101);
									   $stmt101->execute(); 
									}
									else
									{
									   $q101="UPDATE stock_op_tbl SET cqty='$fstk',oqty='$fstk' WHERE ID='".$rowchk['ID']."' AND sts='0'";
									   //echo $k." - Else - OLD : ".$q101."<Br>";
									   $stmt101=$mysql->prepare($q101);
									   $stmt101->execute(); 
									}
								}
							}
						  $time_original = strtotime($b);
						  $time_add      = $time_original + (3600*24); //add seconds of one day  
						  $b = date("Y-m-d", $time_add);
						  //echo "N dt : ".$b."<br>"; 
						}
					}	
					//back data Entry - Upload
					$c++;
				}
				else
				{
					$c--;
				}
			}			
		}
	}
$mysql=null;	
if($c>0)
{
	echo "<script>alert('Recored Inserted Successfully...!')</script>";
}
else
{
	echo "<script>alert('Recored Already Exists...!')</script>";
}
echo "<script>window.location.href='fgStockUpload.php'</script>";
}
?>