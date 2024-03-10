<?php
//if(isset($_POST['btnsub']))
include('mysql.connect.php');
$txtcatnm=$_POST['txtcatnm'];
$iType=$_POST['iType'];
$uid=$_POST['uid'];

$qry="INSERT INTO category_master(category_nm,uid,iType)VALUES('$txtcatnm','$uid','$iType')";
//echo $qry."<br>";
$stm=$mysql->prepare($qry);
$stm->execute();
$mysql=null;
echo "Record Inserted Successfully...!";
/*echo '<script>alert("Record Inserted Successfully...!")</script>';	
echo '<script>window.location.href="new_cat.php"</script>';*/
?>