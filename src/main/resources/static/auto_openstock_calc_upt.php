<?php
include('mysql.connect.php');
date_default_timezone_set('Asia/Calcutta');
$j='2022-12-03';
$stdt=date('Y-m-d');
//$stdt='2023-01-20';
$itemId="0";
echo $_GET['ItemId']."<Br>";
if(!empty($_GET['ItemId']))
{
$itemId=trim($_GET['ItemId']); 
$k=1;	     
while($j<=$stdt)
{
$dt=$j;
$nxdt=date("Y-m-d", strtotime($dt."+ 1 day"));
echo $dt." : ".$nxdt."<Br>";
$q1="SELECT compId,locId,iType,itemId FROM stock_tbl WHERE sts='0' AND itemId='$itemId' GROUP BY compId,locId,iType,itemId";
$stmt1=$mysql->prepare($q1);
$stmt1->execute();
$data1=$stmt1->fetchAll();	
foreach($data1 as $rw)
{
	$qq="SELECT oqty FROM stock_op_tbl WHERE compId='".$rw['compId']."' AND locId='".$rw['locId']."' AND iType='".$rw['iType']."' AND itemId='".$rw['itemId']."' AND cdt='$dt'";
	//echo $qq."<Br>";
	$st=$mysql->prepare($qq);
	$st->execute();
	$rw1=$st->fetch(PDO::FETCH_ASSOC);
	$opstk=0;
    if(!empty($rw1['oqty']))
    $opstk=$rw1['oqty'];
	
	$q="SELECT dt,compId,locId,iType,itemId,SUM(openstk) AS opstk,SUM(in_qty) AS in_qty,SUM(out_qty) AS out_qty,SUM(lock_qty) AS lock_qty,SUM(stk_qty) AS stk_qty,reord_qty,rackNo,DATE_ADD(dt, INTERVAL 1 DAY) AS nxtdt FROM stock_tbl_2 WHERE sts='0' AND dt='$dt' AND compId='".$rw['compId']."' AND locId='".$rw['locId']."' AND iType='".$rw['iType']."' AND itemId='".$rw['itemId']."' GROUP BY dt,stkId,compId,locId,iType,itemId,reord_qty,rackNo UNION ALL 
	SELECT b.dt,b.compId,b.locId,b.iType,a.itemId,'0' AS opstk,IF(eType='1',SUM(a.qty),'0') AS in_qty,IF(eType='2',SUM(a.qty),'0') AS out_qty,'0' AS lock_qty,'0' AS stk_qty,IF(b.iType='1',r.reorder_level_qty,f.reorder_level_qty) AS reord_qty,IF(b.iType='1',r.rackNo,f.rackNo) AS rackNo,DATE_ADD(b.dt, INTERVAL 1 DAY) AS nxtdt FROM inventory_info_tbl AS a LEFT JOIN inventory_tbl AS b ON a.invId=b.ID LEFT JOIN rm_master AS r ON a.itemId=r.rmId LEFT JOIN fg_master AS f ON a.itemId=f.fgId WHERE b.dt='$dt' AND b.rsts='1' AND a.itemId='".$rw['itemId']."' AND b.compId='".$rw['compId']."' AND b.locId='".$rw['locId']."' AND b.iType='".$rw['iType']."' AND b.sts='0' AND a.sts='0' GROUP BY b.dt,b.compId,b.locId,b.iType,a.itemId,IF(b.iType='1',r.reorder_level_qty,f.reorder_level_qty),IF(b.iType='1',r.rackNo,f.rackNo)";
	/*if($dt=='2023-01-30')
	echo $q."<Br>";*/
	$stmt=$mysql->prepare($q);
	$stmt->execute();
	
	if($stmt->rowCount()>0)
	{
	  $inq=$outq=$lockq=$stkq=0;
	  while($row=$stmt->fetch(PDO::FETCH_ASSOC))
      {
          $inq=$row['in_qty'];
          $outq=$row['out_qty'];
          $lockq=$row['lock_qty'];
          $stkq=$row['stk_qty'];
          
          if($row['opstk']!='0')
          $opstk=$row['opstk'];
          
          $fstk=($opstk+$inq)-($outq+$lockq);
          
          if($j=='2022-12-03')
          echo $fstk."<br>";
		  
		  $qchk="SELECT ID FROM stock_op_tbl WHERE sts='0' AND dt='".$row['dt']."' AND cdt='".$row['nxtdt']."' AND itemId='".$rw['itemId']."' AND compId='".$rw['compId']."' AND locId='".$rw['locId']."' AND iType='".$rw['iType']."'";
		  $stchk=$mysql->prepare($qchk);
		  $stchk->execute();
		  $rowchk=$stchk->fetch(PDO::FETCH_ASSOC);
		  if(empty($rowchk['ID']))
		  {
			 $q101="INSERT INTO stock_op_tbl(compId,locId,iType,itemId,dt,cqty,cdt,oqty)
			 VALUES('".$rw['compId']."','".$rw['locId']."','".$rw['iType']."','".$rw['itemId']."','".$row['dt']."','$fstk','".$row['nxtdt']."','$fstk')";
			 echo $k." - New : ".$q101."<Br>";
			 $stmt101=$mysql->prepare($q101);
			 $stmt101->execute(); 
		  }
		  else
		  {
			 $q101="UPDATE stock_op_tbl SET cqty='$fstk',oqty='$fstk' WHERE ID='".$rowchk['ID']."' AND sts='0'";
			 echo $k." - OLD : ".$q101."<Br>";
			 $stmt101=$mysql->prepare($q101);
			 $stmt101->execute(); 
		  }	
		$k++;
      }	
	}
	else
	{
		$inq=$outq=$lockq=$stkq=0;        
        $fstk=($opstk+$inq)-($outq+$lockq);
		$qchk="SELECT ID FROM stock_op_tbl WHERE sts='0' AND dt='$dt' AND cdt='".$nxdt."' AND itemId='".$rw['itemId']."' AND compId='".$rw['compId']."' AND locId='".$rw['locId']."' AND iType='".$rw['iType']."'";
        $stchk=$mysql->prepare($qchk);
        $stchk->execute();
        $rowchk=$stchk->fetch(PDO::FETCH_ASSOC);
        if(empty($rowchk['ID']))
        {
           $q101="INSERT INTO stock_op_tbl(compId,locId,iType,itemId,dt,cqty,cdt,oqty)
           VALUES('".$rw['compId']."','".$rw['locId']."','".$rw['iType']."','".$rw['itemId']."','".$dt."','$fstk','".$nxdt."','$fstk')";
           echo $k." - Else - New : ".$q101."<Br>";
           $stmt101=$mysql->prepare($q101);
           $stmt101->execute(); 
        }
        else
        {
           $q101="UPDATE stock_op_tbl SET cqty='$fstk',oqty='$fstk' WHERE ID='".$rowchk['ID']."' AND sts='0'";
           echo $k." - Else - OLD : ".$q101."<Br>";
           $stmt101=$mysql->prepare($q101);
           $stmt101->execute(); 
        }
		$k++;	
	}
}
	$time_original = strtotime($j);
	$time_add      = $time_original + (3600*24); //add seconds of one day  
	$j = date("Y-m-d", $time_add);	 	
}
}
$mysql=null;
?>