<?php
$compId=$locId=$iType='0';
if(!empty($_GET['compId']))
$compId=$_GET['compId'];

if(!empty($_GET['iType']))
$iType=$_GET['iType'];

$uId=$_GET['uId'];
$uiType=$_GET['uiType'];
$uRole=$_GET['role'];

if(empty($_GET['uloc']))
$uloc="0";
else
$uloc=$_GET['uloc'];
	
//echo "ABCYY : ".$uloc."<Br>";

if(empty($_GET['catId']))
$catId="0";
else
$catId=$_GET['catId'];

if(empty($_GET['srch']))
$srch="0";
else
$srch=$_GET['srch'];

$str=$strl="";

if($compId!='0' && $iType!='0' && $catId=='0' && $srch=='0')
{
	$str=$str." AND a.compId='$compId' AND a.iType='$iType'";
	$strl=$strl." AND company_id='$compId' AND iType='$iType'";
}
else if($compId!='0' && $iType!='0' && $catId!='0' && $srch=='0')
{
	$str=$str." AND a.compId='$compId' AND a.iType='$iType' AND f.category_id='$catId'";
	$strl=$strl." AND company_id='$compId' AND iType='$iType'";
}
else if($compId!='0' && $iType!='0' && $catId!='0' && $srch!='0')
{
	$str=$str." AND a.compId='$compId' AND a.iType='$iType' AND f.category_id='$catId' AND (
      fg.category_nm LIKE '%".$srch."%' OR f.sage_code LIKE '%".$srch."%' OR f.focus_code LIKE '%".$srch."%' 
	  OR f.descc LIKE '%".$srch."%' OR fu.uom LIKE '%".$srch."%')";
	$strl=$strl." AND company_id='$compId' AND iType='$iType'";
}
else if($compId!='0' && $iType!='0' && $catId=='0' && $srch!='0')
{
	$str=$str." AND a.compId='$compId' AND a.iType='$iType' AND (
      fg.category_nm LIKE '%".$srch."%' OR f.sage_code LIKE '%".$srch."%' OR f.focus_code LIKE '%".$srch."%' 
	  OR f.descc LIKE '%".$srch."%' OR fu.uom LIKE '%".$srch."%')";
	$strl=$strl." AND company_id='$compId' AND iType='$iType'";
}
else if($compId=='0' && $iType!='0' && $catId!='0' && $srch!='0')
{
	$str=$str." AND a.iType='$iType' AND f.category_id='$catId' AND (
      fg.category_nm LIKE '%".$srch."%' OR f.sage_code LIKE '%".$srch."%' OR f.focus_code LIKE '%".$srch."%' 
	  OR f.descc LIKE '%".$srch."%' OR fu.uom LIKE '%".$srch."%')";
	$strl=$strl." AND company_id='$compId' AND iType='$iType'";
}
else if($compId=='0' && $iType!='0' && $catId!='0' && $srch=='0')
{
	$str=$str." AND a.iType='$iType' AND f.category_id='$catId' ";
	$strl=$strl." AND company_id='$compId' AND iType='$iType'";
}
else if($compId=='0' && $iType!='0' && $catId=='0' && $srch!='0')
{
	$str=$str." AND a.iType='$iType' AND (
      fg.category_nm LIKE '%".$srch."%' OR f.sage_code LIKE '%".$srch."%' OR f.focus_code LIKE '%".$srch."%' 
	  OR f.descc LIKE '%".$srch."%' OR fu.uom LIKE '%".$srch."%')";
	$strl=$strl." AND company_id='$compId' AND iType='$iType'";
}
else	
{
	$str=$str." AND a.iType='$iType' ";
	$strl=$strl." AND iType='$iType' ";
}

if($uRole=='admin' && ($uiType=='3'||$uiType=='0'))
{		
	$qq="SELECT f.focus_code,f.sage_code,CONCAT(f.descc,' - ',fu.uom) AS desp FROM stock_tbl AS a LEFT JOIN company_tbl AS c ON a.compId=c.ID LEFT JOIN location_tbl AS l ON a.locId=l.ID LEFT JOIN fg_master AS f ON a.itemId=f.fgId LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID LEFT JOIN category_master AS fg ON f.category_id=fg.catId WHERE a.sts!='2' AND f.sts!='2' ".$str." GROUP BY f.focus_code,f.sage_code,f.descc,fu.uom ORDER BY SUBSTRING(f.focus_code,1,9), SUBSTRING(f.focus_code,10)*1";
}
else
{		
	$qq="SELECT f.focus_code,f.sage_code,CONCAT(f.descc,' - ',fu.uom) AS desp FROM stock_tbl AS a LEFT JOIN company_tbl AS c ON a.compId=c.ID LEFT JOIN location_tbl AS l ON a.locId=l.ID LEFT JOIN fg_master AS f ON a.itemId=f.fgId LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID LEFT JOIN category_master AS fg ON f.category_id=fg.catId LEFT JOIN admin_usr_loc AS us ON l.ID=us.locId WHERE a.sts!='2' AND f.sts!='2' ".$str." AND us.uid='$uId' GROUP BY f.focus_code,f.sage_code,f.descc,fu.uom ORDER BY SUBSTRING(f.focus_code,1,9), SUBSTRING(f.focus_code,10)*1";
}
//echo $qq."<Br>";
include('shripage.php');
$totalRecordsPerPage=500;
$paginationData=pagination_records($totalRecordsPerPage,$qq);
//print_r($paginationData);
$sn=pagination_records_counter($totalRecordsPerPage);
$cnt=$sn;	
$pagination=pagination($totalRecordsPerPage,$qq);
?>

<div class="pagination">    
<?php echo $pagination; ?>
</div>	
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
<thead>
<tr style="background-color:#b02923">	
<th style="color:#fff;">Focus Code</th>
<th style="color:#fff">Sage Code</th>
<th style="color:#fff;">Product</th>
<?php
include('mysql.connect.php');
$ql="SELECT ID,loc_code,location_name FROM location_tbl WHERE sts!='2' ".$strl." ORDER BY loc_code";	
$stl=$mysql->prepare($ql);
$stl->execute();
$loc=array();
$l=0;	
while($row1=$stl->fetch(PDO::FETCH_ASSOC))
{
$loc[$l]=$row1['ID'];
?>
<th style="color:#fff"><?php echo $row1['loc_code']." - ".$row1['location_name'];?></th>
<?php
$l++;
}
?>
<th style="color:#fff;">Total</th>
</tr>
</thead>
<?php 

$cnt=1;
$a=$b=$c=$d=$e=0;	
$lcount=count($loc);
foreach ($paginationData as $row) 
{
//$id=$row['ID'];
echo'<tr style="color:#000;font-weight:600;">';
echo '<td style="background-color:#f4b80d61;color:#000">'.$row['focus_code'].'</td>';
echo '<td style="background-color:#f4b80d61;color:#000">'.$row['sage_code'].'</td>';
echo '<td style="background-color:#f4b80d61;color:#000">'.$row['desp'].'</td>';

$tot=0;
for($i=0;$i<$lcount;$i++)
{
	$qqq="	SELECT f.focus_code,f.sage_code,f.descc,fu.uom,SUM(a.stk_qty) AS stk FROM stock_tbl AS a LEFT JOIN fg_master AS f ON a.itemId=f.fgId LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID WHERE a.sts!='2' AND f.sts!='2' AND a.iType='2' AND f.focus_code='".$row['focus_code']."' AND f.sage_code='".$row['sage_code']."' AND a.locId='$loc[$i]' GROUP BY f.focus_code,f.sage_code,f.descc,fu.uom";
	//if($row['focus_code']=='AC001' || $row['sage_code']=='RMSL-AC0001-000K0001')
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
	echo '<td style="background-color:#f4b80d61;color:#000">'.$stk.'</td>';
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
$mysql=null;
?>
<th style="color:#fff;"><?php echo $a;?></th>
</tr>
</tfoot>
					
</table>	

 <!-- Page level plugins -->
<!--  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <script src="js/demo/datatables-demo.js"></script>-->