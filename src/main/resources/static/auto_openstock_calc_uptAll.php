<?php
include('mysql.connect.php');
date_default_timezone_set('Asia/Calcutta');
$j='2022-12-03';
$stdt=date('Y-m-d');
//$stdt='2022-12-28';
$itemId1='1'; 
$itemId2='200'; 
$k=1;

while($j<=$stdt)
{
    $q1="SELECT compId,locId,iType,itemId FROM stock_tbl WHERE sts='0' AND (itemId BETWEEN '$itemId1' AND '$itemId2') GROUP BY compId,locId,iType,itemId";
    //echo $q1."<Br>";
    $stmt1=$mysql->prepare($q1);
    $stmt1->execute();
    $data1=$stmt1->fetchAll();
    $dt=$j;
    $nxdt=date("Y-m-d", strtotime($dt."+ 1 day"));
    echo $dt." : ".$nxdt."<Br>";
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
    	
    	$q="SELECT dt,compId,locId,iType,itemId,SUM(openstk) AS opstk,SUM(in_qty) AS in_qty,SUM(out_qty) AS out_qty,SUM(lock_qty) AS lock_qty,SUM(stk_qty) AS stk_qty,reord_qty,rackNo,DATE_ADD(dt, INTERVAL 1 DAY) AS nxtdt FROM stock_tbl_2 WHERE sts='0' AND dt='$dt' AND compId='".$rw['compId']."' AND locId='".$rw['locId']."' AND iType='".$rw['iType']."' AND itemId='".$rw['itemId']."' GROUP BY dt,stkId,compId,locId,iType,itemId,reord_qty,rackNo";
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
$mysql=null;
?>