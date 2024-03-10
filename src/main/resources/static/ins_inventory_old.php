<?php
//if(isset($_POST['btnsub']))
include('mysql.connect.php');
$uId=$_POST['uid'];
$dt=$_POST['txtdt'];
$compId=$_POST['compId'];
$locId=$_POST['location'];
$docNo=$_POST['txtserialno'];
$iType=$_POST['iType'];
$itemId=$_POST['itemId'];
$eTypeId=$_POST['eType'];
$eType=$_POST['txteType'];
$qty=$_POST['txtqty'];
$batchno=$_POST['txtbatchno'];
$remark=$_POST['txtRemark'];
$expdt=$_POST['expdt'];

$qq=" SELECT ID FROM inventory_tbl WHERE compId='$compId' AND locId='$locId' AND itemId='$itemId' AND entryId='$eTypeId' AND eType='$eType' AND dt='$dt' AND sts='0'";
$st=$mysql->prepare($qq);
$st->execute();
$row=$st->fetch(PDO::FETCH_ASSOC);
if($st->rowCount()>0)
{
	$mysql=null;
	/*echo '<script>alert("Username Already Exist...!")</script>';
	echo '<script>window.location.href="user_creation.php"</script>';*/
	echo "Record Already Exist...!";
}
else
{
    $qry1="SELECT MAX(docNo)+1 AS `code` FROM doc_no_tbl";
    $st1=$mysql->prepare($qry1);
    $st1->execute();
    $row1=$st1->fetch(PDO::FETCH_ASSOC);
    $code=$row1['code'];
    if($code<=9)
    {
    	$s_code="DOC00000".($code);
    }

    else if($code>9 && $code<99)
    {
    	$s_code="DOC0000".($code);
    }
    else if($code>99 && $code<999)
    {
    	$s_code="DOC000".($code);
    }
    else if($code>999 && $code<9999)
    {
    	$s_code="DOC00".($code);
    }
    else if($code>9999 && $code<99999)
    {
    	$s_code="DOC0".($code);
    }
    else 
    {
    	$s_code="DOC".($code);
    }
	
	$qry2="INSERT INTO doc_no_tbl(docNo)VALUES('$code')";
	$st2=$mysql->prepare($qry2);
	$st2->execute();

    $qry=" INSERT INTO inventory_tbl(dt,compId,locId,docNo,iType,itemId,entryId,eType,qty,batchNo,
	remark,expdt,uid)VALUES('$dt','$compId','$locId','$s_code','$iType','$itemId','$eTypeId',
	'$eType','$qty','$batchno','$remark','$expdt','$uId')";
    //echo $qry."<br>";
    $stm=$mysql->prepare($qry);
    $stm->execute();
    $mysql=null;

    /*echo '<script>alert("Record Inserted Successfully...!")</script>';	
    echo '<script>window.location.href="user_creation.php"</script>';*/
    echo "Record Inserted Successfully...!";
}
?>