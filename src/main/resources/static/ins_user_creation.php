<?php
//if(isset($_POST['btnsub']))
include('mysql.connect.php');
$compId=$_POST['compId'];
$locId=$_POST['locId'];
$locType=$_POST['locType'];
$name=$_POST['txtname'];
$password=$_POST['txtpassword'];
$access=$_POST['selectval'];
$subaccess=$_POST['selectsubval'];
$actCreate=$_POST['txtaction_cr'];
$actEdit=$_POST['txtaction_ed'];
$actDelete=$_POST['txtaction_del'];
$actView=$_POST['txtaction_view'];
$iType=$_POST['iType'];
$userType=$_POST['userType'];

$qq="SELECT UserNm FROM admin_tbl WHERE UserNm='$name' AND compId='$compId' AND sts='0' AND iType='$iType' AND uType='$userType'";
$st=$mysql->prepare($qq);
$st->execute();
$row=$st->fetch(PDO::FETCH_ASSOC);
if($st->rowCount()>0)
{
	$mysql=null;
	/*echo '<script>alert("Username Already Exist...!")</script>';
	echo '<script>window.location.href="user_creation.php"</scr<em></em>ipt>';*/
	echo "Username Already Exist...!";
}
else
{
	$qry="INSERT INTO admin_tbl(UserNm,pwd,role,u_access,sub_access,act_edit,act_delete,compId,iType,act_create,act_view,uType)
	VALUES('$name','$password','User','$access','$subaccess','$actEdit','$actDelete','$compId','$iType','$actCreate','$actView','$userType')";
	//echo $qry."<br>";
	$stm=$mysql->prepare($qry);
	$stm->execute();
	$lastId=$mysql->lastInsertId();
	
	$cnt=count($locId);
	for($i=0;$i<$cnt;$i++)
	{
		$qry1="INSERT INTO admin_usr_loc(uid,locId,locType)VALUES('$lastId','$locId[$i]','$locType[$i]')";
		//echo $qry1."<br>";
		$stm1=$mysql->prepare($qry1);
		$stm1->execute();
	}
	
	$mysql=null;

	/*echo '<script>alert("Record Inserted Successfully...!")</script>';	
	echo '<script>window.location.href="user_creation.php"</script>';*/
	echo "Record Inserted Successfully...!";
}
?>