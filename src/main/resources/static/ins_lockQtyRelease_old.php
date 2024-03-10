<?php
//if(isset($_POST['btnsub']))
include('mysql.connect.php');
date_default_timezone_set('Asia/Calcutta');
$cdt=date('Y-m-d');
$uId=$_POST['uid'];
$entryId=$_POST['entryId'];
$dt=$_POST['txtdtR'];
$compId=$_POST['compId'];
$locId=$_POST['location'];
$docNo=$_POST['txtserialnoR'];
$ref=$_POST['refR'];

if(empty($_POST['ntsR']) || $_POST['ntsR']=='')
$notes="-";
else
$notes=$_POST['ntsR'];

/*$compId=$_POST['cmpId'];
$locId=$_POST['lcId'];*/
$iType=$_POST['iType'];
$invId=$_POST['invId'];
$itemId=$_POST['item_id'];
$eTypeId=$_POST['eTypeR'];
$eType=$_POST['txteTypeR'];
$qty=$_POST['qty'];
$batchno=$_POST['batch'];
$expdt=$_POST['expdt'];
$yr=$_POST['yr'];
$yr2=$_POST['yr2'];
$rordqty=$_POST['rordqty'];
$rackNo=$_POST['rackNo'];
$stkIds=$_POST['stkId'];
$bstkId=$_POST['bstkId'];
$bentryId=$_POST['bentryId'];
$pout_Q=$_POST['pout_Q'];
$stkId_O2=$_POST['stkId_O2'];

//echo $uId." : ".$entryId." : ".$dt." : ".$compId." : ".$locId." : ".$docNo." : ".$ref." : ".$notes." : ".$iType." : ".$eType." : ".$eTypeId."<br>";
//echo $yr." : ".$yr2." : "."<Br>";

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

//$docNo=$lc_cd.$yr.'0'.$nos;
//end of series
//echo $docNo."<Br>";

//start of inventory_tbl
$qinv="INSERT INTO inventory_tbl(dt,compId,locId,iType,docNo,uid,yr,yr2,ref,notes,rsts)
VALUES('$dt','$compId','$locId','$iType','$docNo','$uId','$yr','$yr2','$ref','$notes','1')";
//echo $qinv."<Br>";
$stinv=$mysql->prepare($qinv);
$stinv->execute();
$invIds=$mysql->lastInsertId();
//end of inventory_tbl
//echo $invIds."<Br>";

//start of Prv. inventory_tbl Entry
$qinv2="UPDATE inventory_tbl SET rsts='1' WHERE ID='$entryId'";
//echo $qinv2."<Br>";
$stinv2=$mysql->prepare($qinv2);
$stinv2->execute();
//End of Prv. inventory_tbl Entry

$c=count($itemId);

for($i=0;$i<$c;$i++)
{
 /* echo " : s ".$invId[$i]." : ".$itemId[$i]." : ".$qty[$i]." : ".$batchno[$i]." : ".$expdt[$i]." : ".$rordqty[$i]." : ".$rackNo[$i]." : ".$stkIds[$i]." : ".$bstkId[$i]." : ".$bentryId[$i]."<Br>";*/		
  
  $qinvInfo="INSERT INTO inventory_info_tbl(invId,itemId,entryId,eType,qty,batchNo,expdt,lockinfoId)	VALUES('$invIds','$itemId[$i]','$eTypeId','$eType','$qty[$i]','$batchno[$i]','$expdt[$i]','$invId[$i]')";
  //echo $qinvInfo."<br>";	
  $stinvInfo=$mysql->prepare($qinvInfo);
  $stinvInfo->execute();
  $invIdInfo=$mysql->lastInsertId();

  $qinvInfo2="UPDATE inventory_info_tbl SET relinfoId='$invIdInfo' AND rsts='1' WHERE ID='$invId[$i]' AND sts!='2'";
  //echo $qinvInfo2."<br>";	
  $stinvInfo2=$mysql->prepare($qinvInfo2);
  $stinvInfo2->execute();	
	
  if($eType=='1')
  {
    if($stkIds[$i]=='0')
    {
        $qstk="SELECT ID,stk_qty,in_qty,lock_qty FROM stock_tbl WHERE compId='$compId' AND locId='$locId' AND iType='$iType' AND itemId='$itemId[$i]' AND sts!='2'";
    }
    else
    {
        $qstk="SELECT ID,stk_qty,in_qty,lock_qty FROM stock_tbl WHERE compId='$compId' AND locId='$locId' AND iType='$iType' AND itemId='$itemId[$i]' AND sts!='2' AND ID='$stkIds[$i]'";
    }
    //echo "IN - A : ".$qstk."<Br>";
    $stmtstk=$mysql->prepare($qstk);
    $stmtstk->execute();
    $rwstk=$stmtstk->fetch(PDO::FETCH_ASSOC);
    $stkId=$balQty=$in_qty=$lockq=0;
    if(empty($rwstk['ID']))
    {
      /*$qstk1="INSERT INTO stock_tbl(compId,locId,iType,itemId,in_qty,stk_qty,			  reord_qty,rackNo,uid)VALUES('$compId','$locId','$iType','$itemId[$i]','$qty[$i]','$qty[$i]','$rordqty[$i]','$rackNo[$i]','$uId')";
      //echo "IN - A : ".$qstk1."<Br>";	
      $stmtstk1=$mysql->prepare($qstk1);
      $stmtstk1->execute();	
      $stkId=$mysql->lastInsertId();

      $qstk2="INSERT INTO stock_tbl_2(dt,stkId,compId,locId,iType,itemId,in_qty,stk_qty,	  reord_qty,rackNo,uid,batchNo,expdt)VALUES('$dt','$stkId','$compId','$locId','$iType','$itemId[$i]','$qty[$i]','$qty[$i]','$rordqty[$i]','$rackNo[$i]','$uId','$batchno[$i]','$expdt[$i]')";
      //echo "IN - A : ".$qstk2."<Br>";	
      $stmtstk2=$mysql->prepare($qstk2);
      $stmtstk2->execute();*/		
    }
    else
    {
      $stkId=$rwstk['ID'];
      $balQty=$rwstk['stk_qty'];
      $in_qty=$rwstk['in_qty'];
      $lockq=$rwstk['lock_qty'];

      $balQty=$balQty+$qty[$i];	
      //$in_qty=$in_qty+$qty[$i];
      $lockq=$lockq-$qty[$i];		

      $qstk1="UPDATE stock_tbl SET lock_qty='$lockq',stk_qty='$balQty' WHERE ID='$stkId' AND sts!='2'";
      //echo "IN - AA : ".$qstk1."<Br>";	
      $stmtstk1=$mysql->prepare($qstk1);
      $stmtstk1->execute();
		
	  $qstk21="SELECT expdt FROM stock_tbl_2 WHERE ID='$bstkId[$i]'";
      //echo "IN - AA : ".$qstk21."<Br>";	
      $stmtstk21=$mysql->prepare($qstk21);
      $stmtstk21->execute();	
	  $rowexp=$stmtstk21->fetch(PDO::FETCH_ASSOC);
	  $expdt1=$rowexp['expdt'];

      $qstk2="INSERT INTO stock_tbl_2(dt,stkId,compId,locId,iType,itemId,in_qty,stk_qty,reord_qty,rackNo,uid,batchNo,expdt)
	  VALUES('$dt','$stkId','$compId','$locId','$iType','$itemId[$i]','$qty[$i]','$qty[$i]','$rordqty[$i]','$rackNo[$i]','$uId','$batchno[$i]','$expdt1')";
      //echo "IN - AA : ".$qstk2."<Br>";	
      $stmtstk2=$mysql->prepare($qstk2);
      $stmtstk2->execute();
	  $relstkId2=$mysql->lastInsertId();  	

      if($bentryId[$i]=='0')
      {

      }
      else
      {
          $qstk3="UPDATE stock_tbl_2 SET relId='$relstkId2',rsts='1' WHERE ID='$bentryId[$i]' AND sts!='2'";
          //echo "IN - AA : ".$qstk3."<Br>";	
          $stmtstk3=$mysql->prepare($qstk3);
          $stmtstk3->execute();	
      }	
    }

    //back data Entry IN - 1
    if($dt<=$cdt)
    {
       $b=$dt;
       while($b<=$cdt)
       {
          $bdt=$b;
          $bnxdt=date("Y-m-d", strtotime($bdt."+ 1 day"));
          //echo $bdt." : ".$bnxdt."<Br>";
          $qb1="SELECT compId,locId,iType,itemId FROM stock_tbl WHERE sts='0' AND itemId='$itemId[$i]' GROUP BY compId,locId,iType,itemId";
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
                           $q101="INSERT INTO stock_op_tbl(compId,locId,iType,itemId,dt,cqty,cdt,oqty)                           VALUES('".$rwb['compId']."','".$rwb['locId']."','".$rwb['iType']."','".$rwb['itemId']."','".$rowb['dt']."','$fstk','".$rowb['nxtdt']."','$fstk')";
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
	//back data Entry IN - 1			
  }
  else
  {
	  if($stkIds[$i]=='0')
      {
          $qstk="SELECT ID,stk_qty,out_qty,lock_qty FROM stock_tbl WHERE compId='$compId' AND locId='$locId' AND iType='$iType' AND itemId='$itemId[$i]' AND sts!='2'";
      }
      else
      {
          $qstk="SELECT ID,stk_qty,out_qty,lock_qty FROM stock_tbl WHERE compId='$compId' AND locId='$locId' AND iType='$iType' AND itemId='$itemId[$i]' AND ID='$stkIds[$i]' AND sts!='2'";
      }
      //echo "OUT - B : ".$qstk."<Br>";	
      $stmtstk=$mysql->prepare($qstk);
      $stmtstk->execute();
      $rwstk=$stmtstk->fetch(PDO::FETCH_ASSOC);
      $stkId=$balQty=$out_qty=$lock_qty=0;
      if(empty($rwstk['ID']))
      {
        /*$qstk1="INSERT INTO stock_tbl(compId,locId,iType,itemId,out_qty,stk_qty,			  reord_qty,rackNo,uid)VALUES('$compId','$locId','$iType','$itemId[$i]','$qty[$i]','$qty[$i]','$rordqty[$i]','$rackNo[$i]','$uId')";
        //echo "OUT - B : ".$qstk1."<Br>";	
        $stmtstk1=$mysql->prepare($qstk1);
        $stmtstk1->execute();	
        $stkId=$mysql->lastInsertId();

        $qstk2="INSERT INTO stock_tbl_2(dt,stkId,compId,locId,iType,itemId,out_qty,stk_qty,	  reord_qty,rackNo,uid,batchNo)VALUES('$dt','$stkId','$compId','$locId','$iType','$itemId[$i]','$qty[$i]','$qty[$i]','$rordqty[$i]','$rackNo[$i]','$uId','$batchno[$i]')";
        //echo "OUT - B : ".$qstk2."<Br>";	
        $stmtstk2=$mysql->prepare($qstk2);
        $stmtstk2->execute();	*/	
      }
      else
      {
        $stkId=$rwstk['ID'];
        $balQty=$rwstk['stk_qty'];
        $out_qty=$rwstk['out_qty'];
        $lock_qty=$rwstk['lock_qty'];

        //$balQty=$balQty-$qty[$i];	
        $out_qty=$out_qty+$qty[$i];		
        $lock_qty=$lock_qty-$qty[$i];	

        $qstk1="UPDATE stock_tbl SET out_qty='$out_qty',lock_qty='$lock_qty' WHERE ID='$stkId' AND sts!='2'";
        //echo "OUT - BB : ".$qstk1."<Br>";	
        $stmtstk1=$mysql->prepare($qstk1);
        $stmtstk1->execute();	

        $qstk2="INSERT INTO stock_tbl_2(dt,stkId,compId,locId,iType,itemId,out_qty,stk_qty,reord_qty,rackNo,uid,batchNo)
		VALUES('$dt','$stkId','$compId','$locId','$iType','$itemId[$i]','$qty[$i]','$qty[$i]','$rordqty[$i]','$rackNo[$i]','$uId','$batchno[$i]')";
        //echo "OUT - BB : ".$qstk2."<Br>";	
        $stmtstk2=$mysql->prepare($qstk2);
        $stmtstk2->execute();
		$relstkId2=$mysql->lastInsertId();

        if($bentryId[$i]=='0')
        {

        }
        else
        {
            $qstk3="UPDATE stock_tbl_2 SET relId='$relstkId2',rsts='1' WHERE ID='$bentryId[$i]' AND sts!='2'";
            //echo "OUT - BB : ".$qstk3."<Br>";	
            $stmtstk3=$mysql->prepare($qstk3);
            $stmtstk3->execute();	
        }
      }
	  
	  //back data Entry OUT - 2
      if($dt<=$cdt)
      {
         $bb=$dt;
         while($bb<=$cdt)
         {
            $bbdt=$bb;
            $bbnxdt=date("Y-m-d", strtotime($bbdt."+ 1 day"));
            //echo $bbdt." : ".$bbnxdt."<Br>";
            $qb1="SELECT compId,locId,iType,itemId FROM stock_tbl WHERE sts='0' AND itemId='$itemId[$i]' GROUP BY compId,locId,iType,itemId";
            $stmtb1=$mysql->prepare($qb1);
            $stmtb1->execute();
            $data1=$stmtb1->fetchAll();	
            foreach($data1 as $rwb)
            {
                  //Get Prv. Open Bal
                  $qqb="SELECT oqty FROM stock_op_tbl WHERE compId='".$rwb['compId']."' AND locId='".$rwb['locId']."' AND iType='".$rwb['iType']."' AND itemId='".$rwb['itemId']."' AND cdt='$bbdt'";
                  //echo "OUT : ".$qqb."<Br>";
                  $stb=$mysql->prepare($qqb);
                  $stb->execute();
                  $rwb1=$stb->fetch(PDO::FETCH_ASSOC);
                  $opstkbb=0;
                  if(!empty($rwb1['oqty']))
                  $opstkbb=$rwb1['oqty'];
                  //Get Prv. Open Bal

                  $qb="SELECT dt,compId,locId,iType,itemId,SUM(openstk) AS opstk,SUM(in_qty) AS in_qty,SUM(out_qty) AS out_qty,SUM(lock_qty) AS lock_qty,SUM(stk_qty) AS stk_qty,reord_qty,rackNo,DATE_ADD(dt, INTERVAL 1 DAY) AS nxtdt FROM stock_tbl_2 WHERE sts='0' AND dt='$bbdt' AND compId='".$rwb['compId']."' AND locId='".$rwb['locId']."' AND iType='".$rwb['iType']."' AND itemId='".$rwb['itemId']."' GROUP BY dt,stkId,compId,locId,iType,itemId,reord_qty,rackNo";
                  //echo "OUT : ".$qb."<Br>";
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
                          //echo "OUT - AA :".$qchk."<Br>";
                          $stchk=$mysql->prepare($qchk);
                          $stchk->execute();
                          $rowchk=$stchk->fetch(PDO::FETCH_ASSOC);
                          if(empty($rowchk['ID']))
                          {
                             $q101="INSERT INTO stock_op_tbl(compId,locId,iType,itemId,dt,cqty,cdt,oqty)                           VALUES('".$rwb['compId']."','".$rwb['locId']."','".$rwb['iType']."','".$rwb['itemId']."','".$rowb['dt']."','$fstkb','".$rowb['nxtdt']."','$fstkb')";
                             //echo "OUT - New : ".$q101."<Br>";
                             $stmt101=$mysql->prepare($q101);
                             $stmt101->execute(); 
                          }
                          else
                          {
                             $q101="UPDATE stock_op_tbl SET cqty='$fstkb',oqty='$fstkb' WHERE ID='".$rowchk['ID']."' AND sts='0'";
                             //echo "OUT - OLD : ".$q101."<Br>";
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
                      //echo "OUT - BB :".$qchk."<Br>";
                      $stchk=$mysql->prepare($qchk);
                      $stchk->execute();
                      $rowchk=$stchk->fetch(PDO::FETCH_ASSOC);
                      if(empty($rowchk['ID']))
                      {
                         $q101="INSERT INTO stock_op_tbl(compId,locId,iType,itemId,dt,cqty,cdt,oqty)
                         VALUES('".$rwb['compId']."','".$rwb['locId']."','".$rwb['iType']."','".$rwb['itemId']."','".$bbdt."','$fstkb2','".$bbnxdt."','$fstkb2')";
                         //echo "OUT - Else - New : ".$q101."<Br>";
                         $stmt101=$mysql->prepare($q101);
                         $stmt101->execute(); 
                      }
                      else
                      {
                         $q101="UPDATE stock_op_tbl SET cqty='$fstkb2',oqty='$fstkb2' WHERE ID='".$rowchk['ID']."' AND sts='0'";
                         //echo "OUT - Else - OLD : ".$q101."<Br>";
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
}
$mysql=null;
echo "Record Released Successfully...!"."||".$entryId;
?>