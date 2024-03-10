<?php
include('mysql.connect.php');
$username=$_POST['userNm'];
$password=$_POST['pwd'];

$qry="SELECT id,UserNm,pwd,role,u_access,sub_access,compId,iType FROM admin_tbl WHERE UserNm='$username' AND pwd='$password' AND sts='0'";
//echo $qry."<Br>";
$stm=$mysql->prepare($qry);
$stm->execute();
$row=$stm->fetch(PDO::FETCH_ASSOC);
$uname=$row['UserNm'];
$pass=$row['pwd'];
$ID=$row['id'];
$role=$row['role'];
$access=$row['u_access'];
$saccess=$row['sub_access'];
$cmpId=$row['compId'];
$iType=$row['iType'];
//echo $cmpId." : ".$iType."<Br>";
if($uname == $username && $pass == $password)
{
	session_start();
	$_SESSION['uId']=$ID;
	$_SESSION['uRole']=$role;
	$_SESSION['uAccess']=$access;
    $_SESSION['subAccess']=$saccess;
	$_SESSION['cmpId']=$cmpId;
    $_SESSION['iType']=$iType;
	
	$qloc="SELECT locId,locType FROM admin_usr_loc WHERE uid='$ID' AND sts='0'";
	//echo $qloc."<Br>";
	$stmt1=$mysql->prepare($qloc);
	$stmt1->execute();
	$lcnt=$stmt1->rowCount();
	//echo $lcnt."<Br>";
	$loc="";
	$locType="";
	if($lcnt==1)
	{
		$rowlc=$stmt1->fetch(PDO::FETCH_ASSOC);
		$loc=$rowlc['locId'];
		$locType=$rowlc['locType'];
	}
	else if($lcnt==0)
	{
		$loc="0";
		$locType="0";
	}
	else
	{
		$j=0;
		while($rowlc=$stmt1->fetch(PDO::FETCH_ASSOC))
		{
			if($j=='0')
			{
				$loc=$rowlc['locId'];
				$locType=$rowlc['locType'];
			}
			else if($j<($lcnt-1))
			{
				$loc=$loc.",".$rowlc['locId'];
				$locType=$locType.",".$rowlc['locType'];
			}
			else
			{
				$loc=$loc.",".$rowlc['locId'];
				$locType=$locType.",".$rowlc['locType'];
			}
			$j++;
		}
	}
	//echo $loc."<Br>";
    $_SESSION['loc']=$loc;
    $_SESSION['locType']=$locType;
	
	//echo $cmpId." || ".$_SESSION['cmpId']." : ".$_SESSION['iType'].$iType."<Br>";
	$mysql=null;
	echo '<script>window.location.href="admin.php"</script>';
}
else
{
	$mysql=null;
	echo '<script>alert("Incorrect Username OR Password...!")</script>';	
	echo '<script>window.location.href="index.php"</script>';
}
?>