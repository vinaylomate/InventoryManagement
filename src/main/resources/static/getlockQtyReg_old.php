<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
<thead>
<tr style="background-color:#b02923">	
<th style="color:#fff;">Date</th>
<th style="color:#fff">Doc. No</th>
<th style="color:#fff">Company</th>
<th style="color:#fff">Location</th>
<th style="color:#fff">Product Category</th>
<th style="color:#fff">Saleman</th>
<th style="color:#fff">Reference</th>
<th style="color:#fff">Notes</th>
<th style="color:#fff">View</th>
<!--<th style="color:#fff">Edit</th>-->
</tr>
</thead>

<?php 
$compId=$locId=$iType=$fdt=$tdt='0';
if(!empty($_GET['compId']))
$compId=$_GET['compId'];

if(!empty($_GET['locId']))
$locId=$_GET['locId'];

if(!empty($_GET['iType']))
$iType=$_GET['iType'];

if(!empty($_GET['fdt']))
$fdt=$_GET['fdt'];

if(!empty($_GET['tdt']))
$tdt=$_GET['tdt'];	

$uId=$_GET['uId'];

//echo "<Br>".$compId." : ".$iType." : ".$locId."<Br>";

$str="";
if($compId!='0' && $iType!='0' && $locId!='0' && $fdt!='0' && $tdt!='0')
{
	$str=$str." AND a.compId='$compId' AND a.iType='$iType' AND a.locId='$locId' AND (a.dt BETWEEN '$fdt' AND '$tdt')";
}
else if($compId!='0' && $iType!='0' && $locId=='0' && $fdt!='0' && $tdt!='0')
{
	$str=$str." AND a.compId='$compId' AND a.iType='$iType' AND (a.dt BETWEEN '$fdt' AND '$tdt')";
}
else if($compId!='0' && $iType=='0' && $locId=='0' && $fdt!='0' && $tdt!='0')
{
	$str=$str." AND a.compId='$compId' AND (a.dt BETWEEN '$fdt' AND '$tdt')";
}
else if($compId!='0' && $iType=='0' && $locId!='0' && $fdt!='0' && $tdt!='0')
{
	$str=$str." AND a.compId='$compId' AND a.locId='$locId' AND (a.dt BETWEEN '$fdt' AND '$tdt')";
}
else if($compId=='0' && $iType!='0' && $locId!='0' && $fdt!='0' && $tdt!='0')
{
	$str=$str." AND a.iType='$iType' AND a.locId='$locId' AND (a.dt BETWEEN '$fdt' AND '$tdt')";
}
else if($compId=='0' && $iType!='0' && $locId=='0' && $fdt!='0' && $tdt!='0')
{
	$str=$str." AND a.iType='$iType' AND (a.dt BETWEEN '$fdt' AND '$tdt')";
}
else if($compId=='0' && $iType=='0' && $locId=='0' && $fdt!='0' && $tdt!='0')
{
	$str=$str." AND (a.dt BETWEEN '$fdt' AND '$tdt')";
}
else if($compId!='0' && $iType!='0' && $locId!='0' && $fdt=='0' && $tdt=='0')
{
	$str=$str." AND a.compId='$compId' AND a.iType='$iType' AND a.locId='$locId' ";
}
if($compId!='0' && $iType!='0' && $locId=='0' && $fdt=='0' && $tdt=='0')
{
	$str=$str." AND a.compId='$compId' AND a.iType='$iType' ";
}
else if($compId!='0' && $iType=='0' && $locId!='0' && $fdt=='0' && $tdt=='0')
{
	$str=$str." AND a.compId='$compId' AND a.locId='$locId' ";
}
else if($compId!='0' && $iType=='0' && $locId=='0' && $fdt=='0' && $tdt=='0')
{
	$str=$str." AND a.compId='$compId' ";
}
else if($compId=='0' && $iType!='0' && $locId!='0' && $fdt=='0' && $tdt=='0')
{
	$str=$str."AND a.locId='$locId' AND a.iType='$iType' ";
}
else if($compId=='0' && $iType=='0' && $locId!='0' && $fdt=='0' && $tdt=='0')
{
	$str=$str."AND a.locId='$locId' ";
}
else if($compId=='0' && $iType!='0' && $locId=='0' && $fdt=='0' && $tdt=='0')
{
	$str=$str."AND a.iType='$iType' ";
}
//echo "<Br>";
include('mysql.connect.php');
//admin_tbl 
$qEditDel="SELECT act_edit AS ed,act_delete AS del FROM admin_tbl WHERE sts='0' AND id='".$uId."'";
//echo $qEditDel."<Br>";	
$stmEditDel=$mysql->prepare($qEditDel);
$stmEditDel->execute();
$rowEditDel=$stmEditDel->fetch(PDO::FETCH_ASSOC);
$ed=$rowEditDel['ed'];
$dels=$rowEditDel['del'];	
//admin_tbl	

$qq="SELECT a.ID,a.dt,a.compId,a.locId,a.iType,a.docNo,a.yr,a.yr2,b.company_code,b.company_name,c.loc_code,c.location_name,IF(a.iType='1','RAW MATERIAL','FINISHED GOODS') AS iTypeNm,ref,notes ,a.salemnId,s.salemanNm FROM inventory_tbl AS a LEFT JOIN company_tbl AS b ON a.compId=b.ID LEFT JOIN location_tbl AS c ON a.locId=c.ID LEFT JOIN salesman_tbl AS s ON a.salemnId=s.ID WHERE a.sts!='2' AND b.sts!='2' AND c.sts!='2' AND a.lsts='1' AND s.sts!='2' ".$str." ORDER BY a.dt DESC";
//echo $qq."<br>";
$stm=$mysql->prepare($qq);
$stm->execute();
$cnt=1;
while($row=$stm->fetch(PDO::FETCH_ASSOC))
{
  $id=$row['ID'];
  if($row['iType']=='1')
  {
    echo'<tr style="color:#000;font-weight:600;background-color:#0d69f445;">';
    echo '<td>'.date('d-m-Y',strtotime($row['dt'])).'</td>';
    echo '<td>'.$row['docNo'].'</td>';
    echo '<td>'.$row['company_code'].' '.$row['company_name'].'</td>';
    echo '<td>'.$row['loc_code'].' '.$row['location_name'].'</td>';
    echo '<td>'.$row['iTypeNm'].'</td>';
    echo '<td>'.$row['salemanNm'].'</td>';
    echo '<td>'.$row['ref'].'</td>';					  
    echo '<td>'.$row['notes'].'</td>';					  					  
    echo '<td align="center"><a href="javascript:view('.$id.')"><i class="fa fa-eye"></i></a></td>';
    /*if($ed==0)
    {
      echo '<td>-</td>';  
    }
    else
    {
    echo '<td align="center"><a href="javascript:edit('.$id.')"><i class="fa fa-edit"></i></a></td>';
    }*/
    echo '</tr>';
  }
  else
  {
    echo'<tr style="color:#000;font-weight:600;background-color:#f4b80d61;">';
    echo '<td>'.date('d-m-Y',strtotime($row['dt'])).'</td>';
    echo '<td>'.$row['docNo'].'</td>';
    echo '<td>'.$row['company_code'].' '.$row['company_name'].'</td>';
    echo '<td>'.$row['loc_code'].' '.$row['location_name'].'</td>';
    echo '<td>'.$row['iTypeNm'].'</td>';	
    echo '<td>'.$row['salemanNm'].'</td>';
    echo '<td>'.$row['ref'].'</td>';					  
    echo '<td>'.$row['notes'].'</td>';					  
    echo '<td align="center"><a href="javascript:view('.$id.')"><i class="fa fa-eye"></i></a></td>';
    /*if($ed==0)
    {
      echo '<td>-</td>';  
    }
    else
    {
    echo '<td align="center"><a href="javascript:edit('.$id.')"><i class="fa fa-edit"></i></a></td>';
    }*/
    echo '</tr>';
  }
    $cnt++;
}
$mysql=null;
?>
<tbody>
</tbody>					
</table>	

 <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>