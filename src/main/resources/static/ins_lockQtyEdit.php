<?php
//if(isset($_POST['btnsub']))
include('mysql.connect.php');
$uId=$_POST['uid'];
$entryId=$_POST['entryId'];
$dt=$_POST['txtdt'];
$pdt=$_POST['ptxtdt'];
$compId=$_POST['compId'];
$pcompId=$_POST['pcompId'];
$locId=$_POST['location'];
$plocId=$_POST['plocId'];	
$docNo=$_POST['txtserialno'];
$ref=$_POST['ref'];
$pref=$_POST['pref'];
$notes=$_POST['nts'];
$pnotes=$_POST['pnts'];	
/*$compId=$_POST['cmpId'];
$locId=$_POST['lcId'];*/
$iType=$_POST['iType'];
$invId=$_POST['invId'];
$itemId=$_POST['item_id'];
$eTypeId=$_POST['eTypesId'];
$eType=$_POST['eTypes'];
$qty=$_POST['qty'];
$pqty=$_POST['pqty'];
$batchno=$_POST['batch'];
$pbatchno=$_POST['pbatch'];
$expdt=$_POST['expdt'];
$stkqty=$_POST['stkqty'];
$bqty=$_POST['bqty'];
$yr=$_POST['yr'];
$yr2=$_POST['yr2'];
$rordqty=$_POST['rordqty'];
$rackNo=$_POST['rackNo'];
$stkIds=$_POST['stkId'];
$bstkId=$_POST['bstkId'];
$bentryId=$_POST['bentryId'];
$pout_Q=$_POST['pout_Q'];
$stkId_O2=$_POST['stkId_O2'];
$delId=$_POST['delId'];


//start of inventory_tbl
$qinv="UPDATE inventory_tbl SET dt='$dt',compId='$compId',locId='$locId',iType='$iType',docNo='$docNo',uid='$uId',ref='$ref',notes='$notes' WHERE ID='$entryId'";
//echo $qinv."<Br>";
$stinv=$mysql->prepare($qinv);
$stinv->execute();

$qinv2="INSERT INTO inventory_upt_tbl(invId,dt,pdt,compId,locId,iType,docNo,ref,
pref,notes,pnotes,uid,lsts)VALUES('$entryId','$dt','$pdt','$compId','$locId','$iType','$docNo','$ref','$pref','$notes','$pnotes','$uId','0')";
//echo $qinv2."<Br>";
$stinv2=$mysql->prepare($qinv2);
$stinv2->execute();
//end of inventory_tbl
//echo $delId."<Br>";

if($delId!='0')
{
	if( strpos( $delId, ',' ) !== false ) 
	{
		$delIdF=explode(",",$delId);
		$d=count($delIdF);
		//echo $delIdF."<Br>";
		for($j=0;$j<$d;$j++)
		{
		  if($delIdF[$j]=='-1')
		  {}
		  else
		  {			  
			$qinvInfod="SELECT itemId,batchNo,qty,eType FROM inventory_info_tbl WHERE ID='$delIdF[$j]' AND sts='0'";
			//echo "Del - Multiple : ".$qinvInfod."<Br><Br>";
			$stinvInfod=$mysql->prepare($qinvInfod);
			$stinvInfod->execute();
			$rowInfod=$stinvInfod->fetch(PDO::FETCH_ASSOC);
			$delItemId=$rowInfod['itemId'];
			$delbatchNo=$rowInfod['batchNo'];
			$delqty=$rowInfod['qty'];
			$deleType=$rowInfod['eType'];

			//echo "Del - Single Info Details : ".$delIdF[$j]." : ".$delItemId." : ".$delbatchNo." : ".$delqty." : ".$deleType."<Br>";

			if($deleType=='2')
			{
				$qinvInfodstk="SELECT ID,in_qty,lock_qty,stk_qty FROM stock_tbl WHERE itemId='$delItemId' AND compId='$compId' AND locId='$locId' AND iType='$iType' AND sts='0'";
				//echo "Del(OUT) - Multiple Stock : ".$qinvInfodstk."<Br><Br>";
				$stinvInfodstk=$mysql->prepare($qinvInfodstk);
				$stinvInfodstk->execute();
				$rowInfodstk=$stinvInfodstk->fetch(PDO::FETCH_ASSOC);
				$delstkId=$rowInfodstk['ID'];
				$deliq=$rowInfodstk['in_qty'];
				$deloq=$rowInfodstk['lock_qty'];
				$fdeloq=$deloq-$delqty;
				$delstkq=$rowInfodstk['stk_qty'];
				$fdelstkq=$delstkq+$delqty;

				//Update
				$qinvInfodstk11="UPDATE stock_tbl SET lock_qty='$fdeloq',stk_qty='$fdelstkq' WHERE ID='$delstkId' AND sts!='2'";
				//echo "Del(OUT) - Multiple Stock Update: ".$qinvInfodstk11."<Br><Br>";
				$stinvInfodstk11=$mysql->prepare($qinvInfodstk11);
				$stinvInfodstk11->execute();

				$qinvInfodstk12=" INSERT INTO stock_upt_tbl(stkId,compId,locId,iType,itemId,lockq,plockq,stkq,pstkq,uid) VALUES('$delstkId','$compId','$locId','$iType','$delItemId','$fdeloq','$deloq','$fdelstkq','$delstkq','$uId')";
				//echo "Del(OUT) - Multiple Stock Update Log: ".$qinvInfodstk12."<Br><Br>";
				$stinvInfodstk12=$mysql->prepare($qinvInfodstk12);
				$stinvInfodstk12->execute();
				//update
				//echo "Del(OUT) - Multiple Stock Details : ".$delstkId." : ".$deliq." : ".$deloq." : ".$delstkq."<Br>";

				$qinvInfodstk2="SELECT ID,stk_qty FROM stock_tbl_2 WHERE stkId='$delstkId' AND compId='$compId' AND locId='$locId' AND iType='$iType' AND itemId='$delItemId' AND batchNo='$delbatchNo' AND sts='0' AND lock_qty='0' AND stk_qty!='0'";
				//echo "Del(OUT) - Multiple Stock 2: ".$qinvInfodstk2."<Br><Br>";
				$stinvInfodstk2=$mysql->prepare($qinvInfodstk2);
				$stinvInfodstk2->execute();
				$rowInfodstk2=$stinvInfodstk2->fetch(PDO::FETCH_ASSOC);
				$delstkId2=$rowInfodstk2['ID'];
				$delstkq2=$rowInfodstk2['stk_qty'];
				$fdelstkq2=$delstkq2+$delqty;

				//Update 2
				$qinvInfodstk22="UPDATE stock_tbl_2 SET stk_qty='$fdelstkq2' WHERE ID='$delstkId2' AND sts!='2'";
				//echo "Del(OUT) - Multiple Stock 2 Update: ".$qinvInfodstk22."<Br><Br>";
				$stinvInfodstk22=$mysql->prepare($qinvInfodstk22);
				$stinvInfodstk22->execute();

				$qinvInfodstk23="INSERT INTO stock_tbl_2_upt_tbl(stkId,stkId2,compId,locId,iType,itemId, batchNo,pbatchNo,stkq,pstkq,uid)VALUES('$delstkId','$delstkId2','$compId','$locId','$iType','$delItemId','$delbatchNo','$delbatchNo','$fdelstkq2','$delstkq2','$uId')";
				//echo "Del(OUT) - Multiple Stock 2 Update Log: ".$qinvInfodstk23."<Br><Br>";
				$stinvInfodstk23=$mysql->prepare($qinvInfodstk23);
				$stinvInfodstk23->execute();
				//Update 2
				//echo "Del(OUT) - Multiple Stock2 Details : ".$delstkId2." : ".$delstkq2."<Br>";

				$qinvInfodstk21="SELECT ID,out_qty FROM stock_tbl_2 WHERE stkId='$delstkId' AND compId='$compId' AND locId='$locId' AND iType='$iType' AND itemId='$delItemId' AND batchNo='$delbatchNo' AND dt='$dt' AND sts='0' AND in_qty='0'";
				//echo "Del(OUT) - Multiple Stock 2_Out: ".$qinvInfodstk21."<Br><Br>";
				$stinvInfodstk21=$mysql->prepare($qinvInfodstk21);
				$stinvInfodstk21->execute();
				$rowInfodstk21=$stinvInfodstk21->fetch(PDO::FETCH_ASSOC);
				$delstkId21=$rowInfodstk21['ID'];
				$deloutq21=$rowInfodstk21['out_qty'];
				//Update 2.1
				$qinvInfodstk24="UPDATE stock_tbl_2 SET sts='2' WHERE ID='$delstkId21' AND sts!='2'";
				//echo "Del(OUT) - Multiple Stock 2_Out Update: ".$qinvInfodstk24."<Br><Br>";
				$stinvInfodstk24=$mysql->prepare($qinvInfodstk24);
				$stinvInfodstk24->execute();

				$qinvInfodstk25="INSERT INTO stock_tbl_2_del_tbl(stkId,stkId2,compId,locId,iType,itemId, batchNo,pbatchNo,lockq,plockq,uid)VALUES('$delstkId','$delstkId21','$compId','$locId','$iType','$delItemId','$delbatchNo','$delbatchNo','$deloutq21','$delqty','$uId')";
				//echo "Del(OUT) - Multiple Stock 2_Out Update Log: ".$qinvInfodstk25."<Br><Br>";
				$stinvInfodstk25=$mysql->prepare($qinvInfodstk25);
				$stinvInfodstk25->execute();
				//Update 2.1
				//echo "Del(OUT) - Multiple Stock2_Out Details : ".$delstkId21." : ".$deloutq21."<Br>";

				$qinvInfod1="UPDATE inventory_info_tbl SET sts='2' WHERE ID='$delIdF[$j]' AND invId='$entryId' AND sts='0'";
				//echo "Del(OUT) - Multiple : ".$qinvInfod1."<Br><Br>";
				$stinvInfod1=$mysql->prepare($qinvInfod1);
				$stinvInfod1->execute();

				$qinvInfo2="INSERT INTO inventory_info_del_tbl(invId,infoId,uid)VALUES('$entryId','$delIdF[$j]','$uId')";
				//echo "Del(OUT) - Multiple : ".$qinvInfo2."<Br><Br>";
				$stinvInfo2=$mysql->prepare($qinvInfo2);
				$stinvInfo2->execute();
			}
			else
			{}
		  }
		}
	}
	else
	{
		$qinvInfod="SELECT itemId,batchNo,qty,eType FROM inventory_info_tbl WHERE ID='$delId' AND sts='0'";
        //echo "Del - Single : ".$qinvInfod."<Br><Br>";
        $stinvInfod=$mysql->prepare($qinvInfod);
        $stinvInfod->execute();
		$rowInfod=$stinvInfod->fetch(PDO::FETCH_ASSOC);
		$delItemId=$rowInfod['itemId'];
		$delbatchNo=$rowInfod['batchNo'];
		$delqty=$rowInfod['qty'];
		$deleType=$rowInfod['eType'];
		
		//echo "Del - Single Info Details : ".$delId." : ".$delItemId." : ".$delbatchNo." : ".$delqty." : ".$deleType."<Br>";
		
		if($deleType=='2')
		{
			$qinvInfodstk="SELECT ID,in_qty,lock_qty,stk_qty FROM stock_tbl WHERE itemId='$delItemId' AND compId='$compId' AND locId='$locId' AND iType='$iType' AND sts='0'";
			//echo "Del(OUT) - Single Stock : ".$qinvInfodstk."<Br><Br>";
			$stinvInfodstk=$mysql->prepare($qinvInfodstk);
			$stinvInfodstk->execute();
			$rowInfodstk=$stinvInfodstk->fetch(PDO::FETCH_ASSOC);
			$delstkId=$rowInfodstk['ID'];
			$deliq=$rowInfodstk['in_qty'];
			$deloq=$rowInfodstk['lock_qty'];
			$fdeloq=$deloq-$delqty;
			$delstkq=$rowInfodstk['stk_qty'];
			$fdelstkq=$delstkq+$delqty;
			
			//Update
			$qinvInfodstk11="UPDATE stock_tbl SET lock_qty='$fdeloq',stk_qty='$fdelstkq' WHERE ID='$delstkId' AND sts!='2'";
			//echo "Del(OUT) - Single Stock Update: ".$qinvInfodstk11."<Br><Br>";
			$stinvInfodstk11=$mysql->prepare($qinvInfodstk11);
			$stinvInfodstk11->execute();
			
			$qinvInfodstk12=" INSERT INTO stock_upt_tbl(stkId,compId,locId,iType,itemId,lockq,plockq,stkq,pstkq,uid) VALUES('$delstkId','$compId','$locId','$iType','$delItemId','$fdeloq','$deloq','$fdelstkq','$delstkq','$uId')";
			//echo "Del(OUT) - Single Stock Update Log: ".$qinvInfodstk12."<Br><Br>";
			$stinvInfodstk12=$mysql->prepare($qinvInfodstk12);
			$stinvInfodstk12->execute();
			//update
			//echo "Del(OUT) - Single Stock Details : ".$delstkId." : ".$deliq." : ".$deloq." : ".$delstkq."<Br>";
			
			$qinvInfodstk2="SELECT ID,stk_qty FROM stock_tbl_2 WHERE stkId='$delstkId' AND compId='$compId' AND locId='$locId' AND iType='$iType' AND itemId='$delItemId' AND batchNo='$delbatchNo' AND sts='0' AND lock_qty='0' AND stk_qty!='0'";
			//echo "Del(OUT) - Single Stock 2: ".$qinvInfodstk2."<Br><Br>";
			$stinvInfodstk2=$mysql->prepare($qinvInfodstk2);
			$stinvInfodstk2->execute();
			$rowInfodstk2=$stinvInfodstk2->fetch(PDO::FETCH_ASSOC);
			$delstkId2=$rowInfodstk2['ID'];
			$delstkq2=$rowInfodstk2['stk_qty'];
			$fdelstkq2=$delstkq2+$delqty;
			
			//Update 2
			$qinvInfodstk22="UPDATE stock_tbl_2 SET stk_qty='$fdelstkq2' WHERE ID='$delstkId2' AND sts!='2'";
			//echo "Del(OUT) - Single Stock 2 Update: ".$qinvInfodstk22."<Br><Br>";
			$stinvInfodstk22=$mysql->prepare($qinvInfodstk22);
			$stinvInfodstk22->execute();
			
			$qinvInfodstk23="INSERT INTO stock_tbl_2_upt_tbl(stkId,stkId2,compId,locId,iType,itemId, batchNo,pbatchNo,stkq,pstkq,uid)VALUES('$delstkId','$delstkId2','$compId','$locId','$iType','$delItemId','$delbatchNo','$delbatchNo','$fdelstkq2','$delstkq2','$uId')";
			//echo "Del(OUT) - Single Stock 2 Update Log: ".$qinvInfodstk23."<Br><Br>";
			$stinvInfodstk23=$mysql->prepare($qinvInfodstk23);
			$stinvInfodstk23->execute();
			//Update 2
			//echo "Del(OUT) - Single Stock2 Details : ".$delstkId2." : ".$delstkq2."<Br>";

			$qinvInfodstk21="SELECT ID,lock_qty FROM stock_tbl_2 WHERE stkId='$delstkId' AND compId='$compId' AND locId='$locId' AND iType='$iType' AND itemId='$delItemId' AND batchNo='$delbatchNo' AND dt='$dt' AND sts='0' AND in_qty='0'";
			//echo "Del(OUT) - Single Stock 2_Out: ".$qinvInfodstk21."<Br><Br>";
			$stinvInfodstk21=$mysql->prepare($qinvInfodstk21);
			$stinvInfodstk21->execute();
			$rowInfodstk21=$stinvInfodstk21->fetch(PDO::FETCH_ASSOC);
			$delstkId21=$rowInfodstk21['ID'];
			$deloutq21=$rowInfodstk21['out_qty'];
			//Update 2.1
			$qinvInfodstk24="UPDATE stock_tbl_2 SET sts='2' WHERE ID='$delstkId21' AND sts!='2'";
			//echo "Del(OUT) - Single Stock 2_Out Update: ".$qinvInfodstk24."<Br><Br>";
			$stinvInfodstk24=$mysql->prepare($qinvInfodstk24);
			$stinvInfodstk24->execute();
			
			$qinvInfodstk25="INSERT INTO stock_tbl_2_del_tbl(stkId,stkId2,compId,locId,iType,itemId, batchNo,pbatchNo,lockq,plockq,uid)VALUES('$delstkId','$delstkId21','$compId','$locId','$iType','$delItemId','$delbatchNo','$delbatchNo','$deloutq21','$delqty','$uId')";
			//echo "Del(OUT) - Single Stock 2_Out Update Log: ".$qinvInfodstk25."<Br><Br>";
			$stinvInfodstk25=$mysql->prepare($qinvInfodstk25);
			$stinvInfodstk25->execute();
			//Update 2.1
			//echo "Del(OUT) - Single Stock2_Out Details : ".$delstkId21." : ".$deloutq21."<Br>";
			  
            $qinvInfod1="UPDATE inventory_info_tbl SET sts='2' WHERE ID='$delId' AND invId='$entryId' AND sts='0'";
            //echo "Del(OUT) - Single : ".$qinvInfod1."<Br><Br>";
            $stinvInfod1=$mysql->prepare($qinvInfod1);
            $stinvInfod1->execute();

            $qinvInfo2="INSERT INTO inventory_info_del_tbl(invId,infoId,uid)VALUES('$entryId','$delId','$uId')";
            //echo "Del(OUT) - Single : ".$qinvInfo2."<Br><Br>";
            $stinvInfo2=$mysql->prepare($qinvInfo2);
            $stinvInfo2->execute();
		}
		else
		{}
	}
}
//echo "<hr><br>";
//start of inventoryinfo_tbl & stock
$c=count($itemId);
$r=$k=0;
for($i=0;$i<$c;$i++)
{
  if($invId[$i]=='-1')
  {
	  $qinvInfo="INSERT INTO inventory_info_tbl(invId,itemId,entryId,eType,qty,batchNo,expdt)	VALUES('$entryId','$itemId[$i]','$eTypeId[$i]','$eType[$i]','$qty[$i]','$batchno[$i]','$expdt[$i]')";
	  $stinvInfo=$mysql->prepare($qinvInfo);
	  //echo $qinvInfo."<Br>";
	  $stinvInfo->execute();

	  if($eType[$i]=='1')
	  {}
	  else
	  {
		  if($stkIds[$i]=='0')
		  {
			  $qstk="SELECT ID,stk_qty,lock_qty FROM stock_tbl WHERE compId='$compId' AND locId='$locId' AND iType='$iType' AND itemId='$itemId[$i]' AND sts!='2'";
		  }
		  else
		  {
			  $qstk="SELECT ID,stk_qty,lock_qty FROM stock_tbl WHERE compId='$compId' AND locId='$locId' AND iType='$iType' AND itemId='$itemId[$i]' AND ID='$stkIds[$i]' AND sts!='2'";
		  }
		 // echo "OUT - B : ".$qstk."<Br>";	
		  $stmtstk=$mysql->prepare($qstk);
		  $stmtstk->execute();
		  $rwstk=$stmtstk->fetch(PDO::FETCH_ASSOC);
		  $stkId=$balQty=$out_qty=0;
		  if(empty($rwstk['ID']))
		  {
				
		  }
		  else
		  {
			$stkId=$rwstk['ID'];
			$balQty=$rwstk['stk_qty'];
			$out_qty=$rwstk['lock_qty'];

			$balQty=$balQty-$qty[$i];	
			$out_qty=$out_qty+$qty[$i];	

			$qstk1="UPDATE stock_tbl SET lock_qty='$out_qty',stk_qty='$balQty' WHERE ID='$stkId' AND sts!='2'";
			//echo "OUT - B : ".$qstk1."<Br>";	
			$stmtstk1=$mysql->prepare($qstk1);
			$stmtstk1->execute();	

			$qstk2="INSERT INTO stock_tbl_2(dt,stkId,compId,locId,iType,itemId,lock_qty,stk_qty,reord_qty,rackNo,uid,batchNo)
			VALUES('$dt','$stkId','$compId','$locId','$iType','$itemId[$i]','$qty[$i]','0','$rordqty[$i]','$rackNo[$i]','$uId','$batchno[$i]')";
			//echo "OUT - B : ".$qstk2."<Br>";	
			$stmtstk2=$mysql->prepare($qstk2);
			$stmtstk2->execute();				

            if($bstkId[$i]=='0')
            {
				$qstk21="SELECT ID,stk_qty FROM stock_tbl_2 WHERE sts='0' AND itemId='$itemId[$i]' AND stkId='$stkId' AND out_qty='0'";
                //echo "OUT - B : ".$qstk21."<Br>";	
                $stmtstk21=$mysql->prepare($qstk21);
                $stmtstk21->execute();	 
                $rwstk21=$stmtstk21->fetch(PDO::FETCH_ASSOC);
                if(!empty($rwstk21['ID']))  
                {
                    $btchstkId=$rwstk21['ID'];
					$btchQty=$rwstk21['stk_qty'];
                    $fbtchQty=$btchQty-$qty[$i];

                    $qstk3="UPDATE stock_tbl_2 SET stk_qty='$fbtchQty' WHERE ID='$btchstkId' AND sts!='2'";
                    //echo "OUT - B : ".$qstk3."<Br>";	
                    $stmtstk3=$mysql->prepare($qstk3);
                    $stmtstk3->execute();

                    $qstk22="INSERT INTO stock_tbl_2_upt_tbl(stkId,stkId2,compId,locId,iType,itemId,				batchNo,pbatchNo,stkq,pstkq,uid)VALUES('$stkId','$btchstkId','$compId','$locId','$iType','$itemId[$i]','$batchno[$i]','$pbatchno[$i]','$fbtchQty','$btchQty','$uId')";
                    //echo "OUT - B : ".$qstk22."<Br>";	
                    $stmtstk22=$mysql->prepare($qstk22);
                    $stmtstk22->execute();
                }
            }
			$k++;
		  }
	  }
  }
  else
  {
	  if($qty[$i]==$pqty[$i])
	  {
		  $r++;
	  }
	  else
	  {
		  $qinvInfo="UPDATE inventory_info_tbl SET qty='$qty[$i]',batchNo='$batchno[$i]' WHERE ID='$invId[$i]' AND invId='$entryId' AND sts='0'";
		  //echo $qinvInfo."<Br>";
		  $stinvInfo=$mysql->prepare($qinvInfo);
		  $stinvInfo->execute();

		  $qinvInfo2="INSERT INTO inventory_info_upt_tbl(invId,infoId,itemId,entryId,eType,qty,pqty,batchNo,
		  pbatchNo,expdt,pexpdt,uid)VALUES('$invId[$i]','$itemId[$i]','$eTypeId[$i]',
		  '$eType[$i]','$qty[$i]','$pqty[$i]','$batchno[$i]','$expdt[$i]','$expdt[$i]','$uId')";
		  //echo $qinvInfo2."<Br>";
		  $stinvInfo2=$mysql->prepare($qinvInfo2);
		  $stinvInfo2->execute();

		  if($eType[$i]=='1')
		  {
			  
		  }
		  else
		  {
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
					
			  }
			  else
			  {
				$stkId=$rwstk['ID'];
				$balQty=$rwstk['stk_qty'];
				$pbalQty=$rwstk['stk_qty'];
				  
				$out_qty=$rwstk['lock_qty'];
				$pout_qty=$rwstk['lock_qty'];
				  
				$balQtys=$baloutq=$actQstk=0;
				  
				//echo $qty[$i]." : ".$pqty[$i]." : ".$pbalQty." : ".$balQty." : p : ".$pout_qty." : ".$out_qty." || Diff : ".$actQstk."<br>";  
							  
				if($qty[$i]>$pqty[$i])
				{
					$actQstk=$qty[$i]-$pqty[$i];
					$baloutq=$out_qty+$actQstk;
					$balQtys=$balQty-$actQstk;
					//echo 'BB1 : '.$actQstk." : ".$out_qty." : ".$baloutq." : ".$balQtys."<Br>";
				}
				else if($pqty[$i]>$qty[$i])
				{
					$actQstk=$pqty[$i]-$qty[$i];
					$baloutq=$out_qty-$actQstk;
					$balQtys=$balQty+$actQstk;
					//echo 'BB2 : '.$actQstk." : ".$out_qty." : ".$baloutq." : ".$balQtys."<Br>";
				}
				else
				{
					
				}
				  
				//echo $qty[$i]." : ".$pout_qty." : ".$baloutq."<Br>";  
				  
				
				$balQty=$balQtys;	
				$out_qty=$baloutq; 
				//echo $pbalQty." : ".$balQtys." : ".$pout_qty." : ".$out_qty." || Diff : ".$actQstk."<br>";
					
				$qstk1="UPDATE stock_tbl SET lock_qty='$out_qty',stk_qty='$balQtys' WHERE ID='$stkId' AND sts!='2'";
				//echo "OUT - BB- Main Stock : ".$qstk1."<Br>";	
				$stmtstk1=$mysql->prepare($qstk1);
				$stmtstk1->execute();	

				$qstk11="INSERT INTO stock_upt_tbl(stkId,compId,locId,iType,itemId,lockq,plockq,stkq,pstkq,uid)
				VALUES('$stkId','$compId','$locId','$iType','$itemId[$i]','$out_qty','$pout_qty','$balQty','$pbalQty','$uId')";
				//echo "OUT - BB : ".$qstk11."<Br>";	
				$stmtstk11=$mysql->prepare($qstk11);
				$stmtstk11->execute();
				  
				//echo $bstkId[$i]."<Br>";

				if($bstkId[$i]=='0')
				{

				}
				else
				{
					$qstk2_1="SELECT ID,lock_qty FROM stock_tbl_2 WHERE sts='0' AND itemId='$itemId[$i]' AND stkId='$stkId' AND batchNo='$batchno[$i]' AND dt='$dt'";
					//echo "OUT - BB_DD: ".$qstk2_1."<Br>";	
					$stmtstk2_1=$mysql->prepare($qstk2_1);
					$stmtstk2_1->execute();	 
					$rwstk2_1=$stmtstk2_1->fetch(PDO::FETCH_ASSOC);
					if(!empty($rwstk2_1['lock_qty']))  
					{
						$stkId2=$rwstk2_1['ID'];
						$lockq=$rwstk2_1['lock_qty'];
						
						//echo $stkId2." : ".$lockq."<Br>";
						$actlq=$lckq=0;
						if($lockq>$qty[$i])
						{
							$actlq=$lockq-$qty[$i];
							$lckq=$lockq-$actlq;
							//echo " Lock Q - AA : ".$actlq." : ".$lockq."<Br>";
						}
						else if($qty[$i]>$lockq)
						{
							$actlq=$qty[$i]-$lockq;
							$lckq=$lockq+$actlq;
							//echo " Lock Q - BB : ".$actlq." : ".$lockq."<Br>";
						}
						else
						{
							
						}
						
						$qstk2_2="UPDATE stock_tbl_2 SET lock_qty='$lckq' WHERE ID='$stkId2'";
						//echo "OUT - BB_DD_2: ".$qstk2_2."<Br>";	
						$stmtstk2_2=$mysql->prepare($qstk2_2);
						$stmtstk2_2->execute();
						
						$qstk2_3="INSERT INTO stock_tbl_2_upt_tbl(stkId,stkId2,compId,locId,iType,itemId,batchNo,pbatchNo,lockq,plockq,uid)
						VALUES('$stkId','$stkId2','$compId','$locId','$iType','$itemId[$i]','$batchno[$i]','$pbatchno[$i]','$lckq','$lockq','$uId')";
						//echo "OUT - BB_DD_2: ".$qstk2_3."<Br>";	
						$stmtstk2_3=$mysql->prepare($qstk2_3);
						$stmtstk2_3->execute();
					}
					
					$qstk21="SELECT stk_qty FROM stock_tbl_2 WHERE ID='$bstkId[$i]' AND sts='0' AND itemId='$itemId[$i]' AND stkId='$stkId' AND batchNo='$batchno[$i]'";
					//echo "OUT - BBDD 1: ".$qstk21."<Br>";	
					$stmtstk21=$mysql->prepare($qstk21);
					$stmtstk21->execute();	 
					$rwstk21=$stmtstk21->fetch(PDO::FETCH_ASSOC);
					if(!empty($rwstk21['stk_qty']))  
					{
						$stkqty2=$rwstk21['stk_qty'];
						$stkqq2=0;
						if($lockq>$qty[$i])
						{
							$stkqq2=$stkqty2+$actlq;
						}
						else if($qty[$i]>$lockq)
						{
							$stkqq2=$stkqty2-$actlq;
						}
						//echo "OUT - BBDD EE: ".$stkqty2." : ".$stkqq2."<br>";
						
						$qstk22="UPDATE stock_tbl_2 SET stk_qty='$stkqq2' WHERE ID='$bstkId[$i]'";
						//echo "OUT - BBDD 2: ".$qstk22."<Br>";	
						$stmtstk22=$mysql->prepare($qstk22);
						$stmtstk22->execute();	
						
						$qstk23="INSERT INTO stock_tbl_2_upt_tbl(stkId,stkId2,compId,locId,iType,itemId,batchNo,pbatchNo,stkq,pstkq,uid)
						VALUES('$stkId','$bstkId[$i]','$compId','$locId','$iType','$itemId[$i]','$batchno[$i]','$pbatchno[$i]','$stkqq2','$stkqty2','$uId')";
						//echo "OUT - BB_DD3: ".$qstk23."<Br>";	
						$stmtstk23=$mysql->prepare($qstk23);
						$stmtstk23->execute(); 
					}
				}
			  }
		  }
		  $k++;
	  }
  }
}
//end of inventoryinfo_tbl & stock
$mysql=null;
echo "Record Updated Successfully...!"."||".$entryId;
?>