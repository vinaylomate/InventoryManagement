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

$ptxtcategory=$_POST['ptxtcategory'];
$category=$_POST['txtcategory'];

$ptxtdesc=$_POST['ptxtdesc'];
$desc=$_POST['txtdesc'];

$ptxtuom=$_POST['ptxtuom'];
$uom=$_POST['txtuom'];

$preordQty=$_POST['preorder_level_qty'];
$reordQty=$_POST['reorder_level_qty'];

$qry="UPDATE fg_master SET category_id='$category',descc='$desc',uom='$uom',reorder_level_qty='$reordQty' WHERE fgId='$eId'";
//echo $qry."<br>";
$stm=$mysql->prepare($qry);
$stm->execute();

$q="INSERT INTO edit_fg_master(fgId,uid,p_category_id,category_id,p_descc,
descc,p_uom,uom,p_reorder_level_qty,reorder_level_qty)
VALUES('$eId','$uid','$ptxtcategory','$category','$ptxtdesc','$desc','$ptxtuom','$uom',
'$preordQty','$reordQty')";
//echo $q."<Br>";
$s=$mysql->prepare($q);
$s->execute();

$mysql=null;
echo "<script> alert('Record Updated Successfully...!')</script>";
echo "<script>refreshAndClose(); </script>";
echo "<script>self.opener.location.reloadAndClose(); </script>";
echo '<script>window.location.href="fgMaster.php"</script>';
?>