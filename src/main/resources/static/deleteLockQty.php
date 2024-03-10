<?php
//if(isset($_POST['btnsub']))
include('mysql.connect.php');
date_default_timezone_set('Asia/Calcutta');
$cdt=date('Y-m-d');
$uId=$_GET['uid'];
$entryId=$_GET['ID'];

//start of inventory_tbl
$qinv1="SELECT dt,compId,locId,iType,uid AS entryuId,rsts FROM inventory_tbl WHERE ID='$entryId' AND sts='0' AND lsts='1'";
$stinv1=$mysql->prepare($qinv1);
$stinv1->execute();
$rw1=$stinv1->fetchAll();
foreach($rw1 as $row1)
{
	$entrydt=$row1['dt'];
	$compId=$row1['compId'];
	$locId=$row1['locId'];
	$iType=$row1['iType'];
	$entryuId=$row1['entryuId'];
	$rsts=$row1['rsts'];
}

$qinv="UPDATE inventory_tbl SET sts='2' WHERE ID='$entryId'";
//echo $qinv."<Br>";
$stinv=$mysql->prepare($qinv);
$stinv->execute();

$qinv2="INSERT INTO inventory_tbl_del(invId,dt,entrydt,compId,locId,iType,entryuId,uid)VALUES('$entryId','$cdt','$entrydt','$compId','$locId','$iType','$entryuId','$uId')";
//echo $qinv2."<Br>";
$stinv2=$mysql->prepare($qinv2);
$stinv2->execute();
//end of inventory_tbl

$qinvInfod="SELECT ID,itemId,batchNo,qty,eType FROM inventory_info_tbl WHERE invId='$entryId' AND sts='0'";
//echo "Del - Info : ".$qinvInfod."<Br><Br>";
$stinvInfod=$mysql->prepare($qinvInfod);
$stinvInfod->execute();
$cnt=$stinvInfod->rowCount();
//echo $cnt."<Br>";
$rw=$stinvInfod->fetchAll();
foreach($rw as $row)
{
	//echo $row['itemId']." : ".$row['batchNo']." : ".$row['qty']." : ".$row['eType']."<Br>";
	$delId=$row['ID'];
	//stocktbl
	$qstk="SELECT ID,in_qty,out_qty,lock_qty,stk_qty FROM stock_tbl WHERE itemId='".$row['itemId']."' AND compId='$compId' AND locId='$locId' AND iType='$iType' AND sts='0'";
	//echo "Del - Stock : ".$qstk."<Br><Br>";
	$ststmt=$mysql->prepare($qstk);
	$ststmt->execute();
	$rowstk=$ststmt->fetch(PDO::FETCH_ASSOC);
	$stkId=$rowstk['ID'];
	$inq=$rowstk['in_qty'];
	$outq=$rowstk['out_qty'];
	$lockq=$rowstk['lock_qty'];
	$stkq=$rowstk['stk_qty'];
	//echo $stkId." : ".$inq." : ".$outq." : ".$lockq." : ".$stkq."<Br>";
	$binq=$boutq=$blockq=$bstkq=0;
	if($row['eType']=='1')
	{
		/*$binq=$inq-$row['qty'];
		$bstkq=$stkq-$row['qty'];
		
		$qstk1="UPDATE stock_tbl SET in_qty='$binq',stk_qty='$bstkq' WHERE ID='$stkId'";
		//echo "Del - Stock Upt : ".$qstk1."<Br><Br>";
		$ststmt1=$mysql->prepare($qstk1);
		$ststmt1->execute();
		
		$qstk2="INSERT INTO stock_upt_tbl(stkId,compId,locId,iType,itemId,inq,pinq,stkq,pstkq,uid)
		VALUES('$stkId','$compId','$locId','$iType','".$row['itemId']."','$binq','$inq','$bstkq','$stkq','$uId')";
		//echo "Del - Stock Upt Info: ".$qstk2."<Br><Br>";
		$ststmt2=$mysql->prepare($qstk2);
		$ststmt2->execute();*/
	}
	else
	{
		$blockq=$lockq-$row['qty'];
		$bstkq=$stkq+$row['qty'];
		if($rsts!='1')
		{
          $qstk1="UPDATE stock_tbl SET lock_qty='$blockq',stk_qty='$bstkq' WHERE ID='$stkId'";
          //echo "Del - Stock Upt : ".$qstk1."<Br><Br>";
          $ststmt1=$mysql->prepare($qstk1);
          $ststmt1->execute();

          $qstk2="INSERT INTO stock_upt_tbl(stkId,compId,locId,iType,itemId,plockq,lockq,pstkq,stkq,uid)
          VALUES('$stkId','$compId','$locId','$iType','".$row['itemId']."','$lockq','$blockq','$stkq','$bstkq','$uId')";
          //echo "Del - Stock Upt Info: ".$qstk2."<Br><Br>";
          $ststmt2=$mysql->prepare($qstk2);
          $ststmt2->execute();
		}
	}
	//stocktbl
	
	if($row['eType']=='1')
	{
		//stocktbl2
		/*$qstkk="SELECT ID FROM stock_tbl_2 WHERE dt='$entrydt' AND compId='$compId' AND locId='$locId' AND iType='$iType' AND itemId='".$row['itemId']."' AND batchNo='".$row['batchNo']."' AND in_qty='".$row['qty']."' AND sts='0'";
		//echo "Del - Stock2 : ".$qstkk."<Br><Br>";
		$ststmtt=$mysql->prepare($qstkk);
		$ststmtt->execute();
		$rowstkk=$ststmtt->fetch(PDO::FETCH_ASSOC);
		$stkId2=$rowstkk['ID'];
		//echo $stkId2."<Br>";
		
		$qstkk1="UPDATE stock_tbl_2 SET sts='2' WHERE ID='$stkId2'";
		//echo "Del IN - Stock21 : ".$qstkk1."<Br><Br>";
		$ststmtt1=$mysql->prepare($qstkk1);
		$ststmtt1->execute();		
		
		$qstkk12="INSERT INTO stock_tbl_2_del_tbl(stkId,stkId2,compId,locId,iType,itemId,batchNo,pbatchNo,pinq,inq,poutq,outq,plockq,lockq,uid)
		VALUES('$stkId','$stkId2','$compId','$locId','$iType','".$row['itemId']."','".$row['batchNo']."','".$row['batchNo']."','".$row['qty']."',
		'".$row['qty']."','0','0','0','0','$uId')";
		//echo "Del IN - Stock22Ins : ".$qstkk12."<Br><Br>";
		$ststmtt12=$mysql->prepare($qstkk12);
		$ststmtt12->execute();
		//stocktbl2*/
	}
	else
	{
		//stocktbl2
		$qstkk="SELECT ID FROM stock_tbl_2 WHERE dt='$entrydt' AND compId='$compId' AND locId='$locId' AND iType='$iType' AND itemId='".$row['itemId']."' AND batchNo='".$row['batchNo']."' AND lock_qty='".$row['qty']."' AND sts='0'";
		//echo "Del - Stock2 : ".$qstkk."<Br><Br>";
		$ststmtt=$mysql->prepare($qstkk);
		$ststmtt->execute();
		$rowstkk=$ststmtt->fetch(PDO::FETCH_ASSOC);
		$stkId2=$rowstkk['ID'];
		//echo $stkId2."<Br>";	
		
		$qstkk1="UPDATE stock_tbl_2 SET sts='2' WHERE ID='$stkId2'";
		//echo "Del - Stock21 : ".$qstkk1."<Br><Br>";
		$ststmtt1=$mysql->prepare($qstkk1);
		$ststmtt1->execute();
		
		
		$qstkk12="INSERT INTO stock_tbl_2_del_tbl(stkId,stkId2,compId,locId,iType,itemId,batchNo,pbatchNo,pinq,inq,poutq,outq,plockq,lockq,uid)
		VALUES('$stkId','$stkId2','$compId','$locId','$iType','".$row['itemId']."','".$row['batchNo']."','".$row['batchNo']."','0','0','0','0','".$row['qty']."',
		'".$row['qty']."','$uId')";
		//echo "Del - Stock22Ins : ".$qstkk12."<Br><Br>";
		$ststmtt12=$mysql->prepare($qstkk12);
		$ststmtt12->execute();
		//stocktbl2
		
		//stocktbl
		$qstkk2="SELECT ID,stk_qty FROM stock_tbl_2 WHERE compId='$compId' AND locId='$locId' AND iType='$iType' AND itemId='".$row['itemId']."' AND batchNo='".$row['batchNo']."' AND sts='0' AND (openstk!='0' OR in_qty!='0')";
		//echo "Del - Stock : ".$qstkk2."<Br><Br>";
		$ststmtt2=$mysql->prepare($qstkk2);
		$ststmtt2->execute();
		$rowstkk2=$ststmtt2->fetch(PDO::FETCH_ASSOC);
		$stkId3=$rowstkk2['ID'];
		$stkq3=$rowstkk2['stk_qty'];
		//echo $stkId3." : ".$stkq3."<Br>";
		$bstkq3=0;
		$bstkq3=$stkq3+$row['qty'];
		//echo $bstkq3."<br>";
		
		$qstkk21="UPDATE stock_tbl_2 SET stk_qty='$bstkq3' WHERE ID='$stkId3'";
		//echo "Del - Stock2_1 : ".$qstkk21."<Br><Br>";
		$ststmtt21=$mysql->prepare($qstkk21);
		$ststmtt21->execute();
		
		
		$qstkk22="INSERT INTO stock_tbl_2_upt_tbl(stkId,stkId2,compId,locId,iType,itemId,batchNo,pbatchNo,pstkq,stkq,uid)
		VALUES('$stkId','$stkId3','$compId','$locId','$iType','".$row['itemId']."','".$row['batchNo']."','".$row['batchNo']."','$stkq3','$bstkq3','$uId')";
		//echo "Del - Stock2_2Ins : ".$qstkk22."<Br><Br>";
		$ststmtt22=$mysql->prepare($qstkk22);
		$ststmtt22->execute();
		//stocktbl
	}	
			  
    $qinvInfod1="UPDATE inventory_info_tbl SET sts='2' WHERE ID='$delId' AND invId='$entryId' AND sts='0'";
    //echo "Del(OUT) - Single : ".$qinvInfod1."<Br><Br>";
    $stinvInfod1=$mysql->prepare($qinvInfod1);
    $stinvInfod1->execute();

    $qinvInfo2="INSERT INTO inventory_info_del_tbl(invId,infoId,uid)VALUES('$entryId','$delId','$uId')";
    //echo "Del(OUT) - Single : ".$qinvInfo2."<Br><Br>";
    $stinvInfo2=$mysql->prepare($qinvInfo2);
    $stinvInfo2->execute();
	
	//back data Entry OUT - 2
    if($entrydt<=$cdt)
    {
       $bb=$entrydt;
       while($bb<=$cdt)
       {
          $bbdt=$bb;
          $bbnxdt=date("Y-m-d", strtotime($bbdt."+ 1 day"));
          echo $bbdt." : ".$bbnxdt."<Br>";
          $qb1="SELECT compId,locId,iType,itemId FROM stock_tbl WHERE sts='0' AND itemId='".$row['itemId']."' GROUP BY compId,locId,iType,itemId";
          $stmtb1=$mysql->prepare($qb1);
          $stmtb1->execute();
          $data1=$stmtb1->fetchAll();	
          foreach($data1 as $rwb)
          {
                //Get Prv. Open Bal
                $qqb="SELECT oqty FROM stock_op_tbl WHERE compId='".$rwb['compId']."' AND locId='".$rwb['locId']."' AND iType='".$rwb['iType']."' AND itemId='".$rwb['itemId']."' AND cdt='$bbdt'";
                //echo "Open : ".$qqb."<Br>";
                $stb=$mysql->prepare($qqb);
                $stb->execute();
                $rwb1=$stb->fetch(PDO::FETCH_ASSOC);
                $opstkbb=0;
                if(!empty($rwb1['oqty']))
                $opstkbb=$rwb1['oqty'];
                //Get Prv. Open Bal

                /*$qb="SELECT dt,compId,locId,iType,itemId,SUM(openstk) AS opstk,SUM(in_qty) AS in_qty,SUM(out_qty) AS out_qty,SUM(lock_qty) AS lock_qty,SUM(stk_qty) AS stk_qty,reord_qty,rackNo,DATE_ADD(dt, INTERVAL 1 DAY) AS nxtdt FROM stock_tbl_2 WHERE sts='0' AND dt='$bbdt' AND compId='".$rwb['compId']."' AND locId='".$rwb['locId']."' AND iType='".$rwb['iType']."' AND itemId='".$rwb['itemId']."' GROUP BY dt,stkId,compId,locId,iType,itemId,reord_qty,rackNo";*/
			    $qb="SELECT dt,compId,locId,iType,itemId,SUM(openstk) AS opstk,SUM(in_qty) AS in_qty,SUM(out_qty) AS out_qty,SUM(lock_qty) AS lock_qty,SUM(stk_qty) AS stk_qty,reord_qty,rackNo,DATE_ADD(dt, INTERVAL 1 DAY) AS nxtdt FROM stock_tbl_2 WHERE sts='0' AND dt='$bbdt' AND compId='".$rwb['compId']."' AND locId='".$rwb['locId']."' AND iType='".$rwb['iType']."' AND itemId='".$rwb['itemId']."' GROUP BY dt,stkId,compId,locId,iType,itemId,reord_qty,rackNo 
				UNION ALL SELECT b.dt,b.compId,b.locId,b.iType,a.itemId,'0' AS opstk,IF(eType='1',SUM(a.qty),'0') AS in_qty,IF(eType='2',SUM(a.qty),'0') AS out_qty,'0' AS lock_qty,'0' AS stk_qty,IF(b.iType='1',r.reorder_level_qty,f.reorder_level_qty) AS reord_qty,IF(b.iType='1',r.rackNo,f.rackNo) AS rackNo,DATE_ADD(b.dt, INTERVAL 1 DAY) AS nxtdt FROM inventory_info_tbl AS a LEFT JOIN inventory_tbl AS b ON a.invId=b.ID LEFT JOIN rm_master AS r ON a.itemId=r.rmId LEFT JOIN fg_master AS f ON a.itemId=f.fgId WHERE b.dt='$bbdt' AND b.rsts='1' AND a.itemId='".$rwb['itemId']."' AND b.compId='".$rwb['compId']."' AND b.locId='".$rwb['locId']."' AND b.iType='".$rwb['iType']."' AND b.sts='0' AND a.sts='0' GROUP BY b.dt,b.compId,b.locId,b.iType,a.itemId,IF(b.iType='1',r.reorder_level_qty,f.reorder_level_qty),IF(b.iType='1',r.rackNo,f.rackNo)";
                //echo "Open : ".$qb."<Br>";
                $stmtb=$mysql->prepare($qb);
                $stmtb->execute();
                if($stmtb->rowCount()>0)
                {
                    $inqb=$outqb=$lockqb=$stkqb=0;
                    while($rowb=$stmtb->fetch(PDO::FETCH_ASSOC))
                    {
                        $inqb=$rowb['in_qty'];
                        $outqb=$rowb['out_qty'];
                        $lockqb=$rowb['lock_qty'];
                        $stkqb=$rowb['stk_qty'];

                        if($rowb['opstk']!='0')
                        $opstkbb=$rowb['opstk'];

                        $fstkb=($opstkbb+$inqb)-($outqb+$lockqb);
                        $qchk="SELECT ID FROM stock_op_tbl WHERE sts='0' AND dt='".$rowb['dt']."' AND cdt='".$rowb['nxtdt']."' AND itemId='".$rwb['itemId']."' AND compId='".$rwb['compId']."' AND locId='".$rwb['locId']."' AND iType='".$rwb['iType']."'";
                        //echo "Open - AA :".$qchk."<Br>";
                        $stchk=$mysql->prepare($qchk);
                        $stchk->execute();
                        $rowchk=$stchk->fetch(PDO::FETCH_ASSOC);
                        if(empty($rowchk['ID']))
                        {
                           $q101="INSERT INTO stock_op_tbl(compId,locId,iType,itemId,dt,cqty,cdt,oqty)                           VALUES('".$rwb['compId']."','".$rwb['locId']."','".$rwb['iType']."','".$rwb['itemId']."','".$rowb['dt']."','$fstkb','".$rowb['nxtdt']."','$fstkb')";
                           //echo "Open - New : ".$q101."<Br>";
                           $stmt101=$mysql->prepare($q101);
                           $stmt101->execute(); 
                        }
                        else
                        {
                           $q101="UPDATE stock_op_tbl SET cqty='$fstkb',oqty='$fstkb' WHERE ID='".$rowchk['ID']."' AND sts='0'";
                           //echo "Open - OLD : ".$q101."<Br>";
                           $stmt101=$mysql->prepare($q101);
                           $stmt101->execute(); 
                        }
                    }
                }
                else
                {
                    $inqb2=$outqb2=$lockqb2=$stkqb2=0;        
                    $fstkb2=($opstkbb+$inqb2)-($outqb2+$lockqb2);
                    $qchk="SELECT ID FROM stock_op_tbl WHERE sts='0' AND dt='$bbdt' AND cdt='".$bbnxdt."' AND itemId='".$rwb['itemId']."' AND compId='".$rwb['compId']."' AND locId='".$rwb['locId']."' AND iType='".$rwb['iType']."'";
                    //echo "Open - BB :".$qchk."<Br>";
                    $stchk=$mysql->prepare($qchk);
                    $stchk->execute();
                    $rowchk=$stchk->fetch(PDO::FETCH_ASSOC);
                    if(empty($rowchk['ID']))
                    {
                       $q101="INSERT INTO stock_op_tbl(compId,locId,iType,itemId,dt,cqty,cdt,oqty)
                       VALUES('".$rwb['compId']."','".$rwb['locId']."','".$rwb['iType']."','".$rwb['itemId']."','".$bbdt."','$fstkb2','".$bbnxdt."','$fstkb2')";
                       //echo "Open - Else - New : ".$q101."<Br>";
                       $stmt101=$mysql->prepare($q101);
                       $stmt101->execute(); 
                    }
                    else
                    {
                       $q101="UPDATE stock_op_tbl SET cqty='$fstkb2',oqty='$fstkb2' WHERE ID='".$rowchk['ID']."' AND sts='0'";
                       //echo "Open - Else - OLD : ".$q101."<Br>";
                       $stmt101=$mysql->prepare($q101);
                       $stmt101->execute(); 
                    }
                }
            }
          $time_original = strtotime($bb);
          $time_add      = $time_original + (3600*24); //add seconds of one day  
          $bb = date("Y-m-d", $time_add);
          //echo "OUT N Date : ".$bb."<Br>";
        }
    }	
    //back data Entry OUT - 2
}
//echo "<hr><br>";
$mysql=null;
echo "Record Deleted Successfully...!"."||".$entryId;
?>