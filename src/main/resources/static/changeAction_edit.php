<script type="text/javascript">
    function refreshAndClose() {
        window.opener.location.reload(true);
        window.close();
    }
</script>
<?php
if(isset($_POST['btn']))
include('mysql.connect.php');
$eId=$_POST['eId'];
$uid=$_POST['uid'];
$actCreate =$_POST['txtaction_cr'];
$pactCreate =$_POST['txtaction_crp'];
$actEdit=$_POST['txtaction_ed'];
$pactEdit=$_POST['txtaction_edp'];
$actDel =$_POST['txtaction_del'];
$pactDel =$_POST['txtaction_delp'];
$actView =$_POST['txtaction_vw'];
$pactview =$_POST['txtaction_vwp'];

$qry="UPDATE admin_tbl SET act_edit='$actEdit',act_delete='$actDel',act_create='$actCreate',act_view='$actView' WHERE id='$eId'";
//echo $qry."<br>";
$stm=$mysql->prepare($qry);
$stm->execute();


$qq="INSERT INTO edit_admin_tbl_act(eId,userId,actEdit,pactEdit,actDel,pactDel,actCreate,
pactCreate,actView,pactView)					VALUES('$eId','$uid','$actEdit','$pactEdit','$actDel','$pactDel','$actCreate','$pactCreate','$actView','$pactview')";
//echo $qq."<br>";
$ss=$mysql->prepare($qq);
$ss->execute();

$mysql=null;

echo "<script> alert('Record Updated Successfully...!')</script>";
echo "<script>refreshAndClose(); </script>";
echo "<script>self.opener.location.reloadAndClose(); </script>";
echo '<script>window.location.href="user_creation.php"</script>';
?>