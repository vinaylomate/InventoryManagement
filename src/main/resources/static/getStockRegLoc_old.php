<?php
include('mysql.connect.php');
$compId=$locId=$iType='0';
if(!empty($_GET['compId']))
$compId=$_GET['compId'];

if(!empty($_GET['iType']))
$iType=$_GET['iType'];

$str=$strl="";

if($compId!='0' && $iType!='0')
{
	$str=$str." AND a.compId='$compId' AND a.iType='$iType'";
	$strl=$strl." AND company_id='$compId' AND iType='$iType'";
}
else	
{
	$str=$str." a.iType='$iType' ";
	$strl=$strl." AND iType='$iType' ";
}
?>
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
<thead>
<tr style="background-color:#b02923">	
<th style="color:#fff;">Focus Code</th>
<th style="color:#fff">Sage Code</th>
<th style="color:#fff;">Product</th>
<?php
$ql="SELECT loc_code,location_name FROM location_tbl WHERE sts!='2' ".$strl." ORDER BY loc_code";	
$stl=$mysql->prepare($ql);
$stl->execute();
while($row1=$stl->fetch(PDO::FETCH_ASSOC))
{
?>
<th style="color:#fff"><?php echo $row1['loc_code']." - ".$row1['location_name'];?></th>
<?php
}
?>
<th style="color:#fff;">Total</th>
</tr>
</thead>

<?php 
//echo "<Br>";
//admin_tbl 
$qEditDel="SELECT act_edit AS ed,act_delete AS del FROM admin_tbl WHERE sts='0' AND id='".$_SESSION['uId']."'";
//echo $qEditDel."<Br>";	
$stmEditDel=$mysql->prepare($qEditDel);
$stmEditDel->execute();
$rowEditDel=$stmEditDel->fetch(PDO::FETCH_ASSOC);
$ed=$rowEditDel['ed'];
$dels=$rowEditDel['del'];	
//admin_tbl	

$qq="SELECT a.iType,a.itemId,IF(a.iType='1',r.focus_code,f.focus_code) AS focus_code,IF(a.iType='1',r.sage_code,f.sage_code) AS sage_code,IF(a.iType='1',CONCAT(rg.category_nm,' ',r.description,' - ',ru.uom),CONCAT(fgg.category_nm,' ',f.brand,' ',f.descc,' - ',fu.uom)) AS desp FROM stock_tbl AS a LEFT JOIN company_tbl AS c ON a.compId=c.ID LEFT JOIN location_tbl AS l ON a.locId=l.ID LEFT JOIN rm_master AS r ON a.itemId=r.rmId LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID LEFT JOIN fg_master AS f ON a.itemId=f.fgId LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID LEFT JOIN category_master AS rg ON r.catId=rg.catId LEFT JOIN category_master AS fgg ON f.category_id=fgg.catId WHERE a.sts!='2' AND IF(a.iType='1',r.sts!='2',f.sts!='2') ".$str." ORDER BY a.ID";
//echo $qq."<br>";
$stm=$mysql->prepare($qq);
$stm->execute();
$cnt=1;
$a=$b=$c=$d=$e=0;	
while($row=$stm->fetch(PDO::FETCH_ASSOC))
{

  //$id=$row['ID'];
  $itemId=$row['itemId'];
  echo'<tr style="color:#000;font-weight:600;">';
  echo '<td style="background-color:#0d69f445;color:#000">'.$row['focus_code'].'</td>';
  echo '<td style="background-color:#0d69f445;color:#000">'.$row['sage_code'].'</td>';
  echo '<td style="background-color:#0d69f445;color:#000">'.$row['desp'].'</td>';

  $ql="SELECT ID FROM location_tbl WHERE sts!='2' ".$strl." ORDER BY loc_code";	
  //echo $ql."<Br>";
  $stl=$mysql->prepare($ql);
  $stl->execute();
  $tot=0;
  while($row1=$stl->fetch(PDO::FETCH_ASSOC))
  {
      $locId=$row1['ID'];
      $qqq="SELECT SUM(a.stk_qty) AS stk FROM stock_tbl AS a LEFT JOIN company_tbl AS c ON a.compId=c.ID LEFT JOIN location_tbl AS l ON a.locId=l.ID LEFT JOIN rm_master AS r ON a.itemId=r.rmId LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID LEFT JOIN fg_master AS f ON a.itemId=f.fgId LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID WHERE a.sts!='2' AND IF(a.iType='1',r.sts!='2',f.sts!='2') AND  a.iType='1' AND a.locId='$locId' AND a.itemId='$itemId' ORDER BY a.ID";
	  //echo $qqq."<Br>";
      $stl1=$mysql->prepare($qqq);
      $stl1->execute();
      $row11=$stl1->fetch(PDO::FETCH_ASSOC);
      $stk=0;
      if(!empty($row11['stk']))
      {
        $stk=$row11['stk'];
		$tot=$tot+$stk;
      }
      echo '<td style="background-color:#0d69f445;color:#000">'.$stk.'</td>';
  }
  echo '<td style="background-color:#0d69f445;color:#000">'.$tot.'</td>';
  $a=$a+$tot;
  echo '</tr>';  

  $cnt++;
}

?>
<tfoot>
<tr style="background-color:#b02923">
<th style="color:#fff;"></th>
<th style="color:#fff"></th>
<th style="color:#fff;"></th>
<?php
$ql="SELECT loc_code,location_name FROM location_tbl WHERE sts!='2' ".$strl." ORDER BY loc_code";	
$stl=$mysql->prepare($ql);
$stl->execute();
$ct=$stl->rowCount();
$k=1;
while($row1=$stl->fetch(PDO::FETCH_ASSOC))
{
  if($k==$ct)
  {
    echo '<th style="color:#fff">Total</th> '; 
  }
  else
  {
     echo '<th style="color:#fff"></th> ';  
  }
$k++;  
}
?>
<th style="color:#fff;"><?php echo $a;?></th>
</tr>
</tfoot>
					
</table>	

 <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>