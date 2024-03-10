<?php
$compId=$locId=$iType='0';
if(!empty($_GET['compId']))
$compId=$_GET['compId'];

if(!empty($_GET['locId']))
$locId=$_GET['locId'];

if(!empty($_GET['iType']))
$iType=$_GET['iType'];	

$uId=$_GET['uId'];
$uiType=$_GET['uiType'];
$uRole=$_GET['role'];

if(empty($_GET['uloc']))
$uloc="0";
else
$uloc=$_GET['uloc'];

if(empty($_GET['srch']))
$srch="0";
else
$srch=$_GET['srch'];

	
if(empty($_GET['fdt']))
$fdt="0";
else
$fdt=$_GET['fdt'];

if(empty($_GET['tdt']))
$tdt="0";
else
$tdt=$_GET['tdt'];

//echo $locId."<Br>";
	
if($locId==0)
{
	$lcnt=0;
	if( strpos( $uloc, ',' ) !== false )
	{
		$locId=explode(',',$uloc);
		$lcnt=count($locId);
	}
	else
	{
		$locId=$uloc;
		if($uloc!='0')
		$lcnt=1;
	}
}
else
{
	$lcnt=1;
}


include('mysql.connect.php');
date_default_timezone_set('Asia/Calcutta');
$cdt=date('Y-m-d');
$str="";
if($lcnt==1)
{	
	if($compId!='0' && $locId!='0' && $srch=='0' && $iType!='0' && $fdt=='0' && $tdt=='0')
	{
		$str=$str." AND b.ID='$compId' AND c.ID='$locId' AND a.iType='$iType' ";
		//echo "Aa-1 : ".$str."<br>";
	}
	else if($compId!='0' && $locId!='0' && $srch!='0' && $iType!='0' && $fdt=='0' && $tdt=='0')
	{
      $str=$str." AND b.ID='$compId' AND c.ID='$locId'  AND a.iType='$iType' AND (a.docNo LIKE '%".$srch."%' OR b.company_code LIKE '%".$srch."%' OR b.company_name LIKE '%".$srch."%' OR c.loc_code LIKE '%".$srch."%' OR c.location_name LIKE '%".$srch."%' OR a.ref LIKE '%".$srch."%' OR a.notes LIKE '%".$srch."%')";
		//echo "Aa-2 : ".$str."<br>";
	}	
	else if($compId!='0' && $locId=='0' && $srch!='0' && $iType!='0' && $fdt=='0' && $tdt=='0')
	{
      $str=$str." AND b.ID='$compId' AND a.iType='$iType' AND (a.docNo LIKE '%".$srch."%' OR b.company_code LIKE '%".$srch."%' OR b.company_name LIKE '%".$srch."%' OR c.loc_code LIKE '%".$srch."%' OR c.location_name LIKE '%".$srch."%' OR a.ref LIKE '%".$srch."%' OR a.notes LIKE '%".$srch."%')";
		//echo "Aa-3 : ".$str."<br>";
	}	
	else if($compId!='0' && $locId=='0' && $srch!='0' && $iType=='0' && $fdt=='0' && $tdt=='0')
	{
      $str=$str." AND b.ID='$compId' AND (a.docNo LIKE '%".$srch."%' OR b.company_code LIKE '%".$srch."%' OR b.company_name LIKE '%".$srch."%' OR c.loc_code LIKE '%".$srch."%' OR c.location_name LIKE '%".$srch."%' OR a.ref LIKE '%".$srch."%' OR a.notes LIKE '%".$srch."%')";
		//echo "Aa-4 : ".$str."<br>";
	}	
	else if($compId!='0' && $locId=='0' && $srch=='0' && $iType!='0' && $fdt=='0' && $tdt=='0')
	{
		$str=$str." AND b.ID='$compId' AND a.iType='$iType' ";
		//echo "Aa-5 : ".$str."<br>";
	}
	else if($compId!='0' && $locId!='0' && $srch=='0' && $iType!='0' && $fdt!='0' && $tdt!='0')
	{
		$str=$str." AND b.ID='$compId' AND c.ID='$locId' AND a.iType='$iType' AND (a.dt BETWEEN '$fdt' AND '$tdt') ";
		//echo "Aa-1 : ".$str."<br>";
	}
	else if($compId!='0' && $locId!='0' && $srch!='0' && $iType!='0' && $fdt!='0' && $tdt!='0')
	{
      $str=$str." AND b.ID='$compId' AND c.ID='$locId'  AND a.iType='$iType' AND (a.docNo LIKE '%".$srch."%' OR b.company_code LIKE '%".$srch."%' OR b.company_name LIKE '%".$srch."%' OR c.loc_code LIKE '%".$srch."%' OR c.location_name LIKE '%".$srch."%' OR a.ref LIKE '%".$srch."%' OR a.notes LIKE '%".$srch."%') AND (a.dt BETWEEN '$fdt' AND '$tdt') ";
		//echo "Aa-2 : ".$str."<br>";
	}	
	else if($compId!='0' && $locId=='0' && $srch!='0' && $iType!='0' && $fdt!='0' && $tdt!='0')
	{
      $str=$str." AND b.ID='$compId' AND a.iType='$iType' AND (a.docNo LIKE '%".$srch."%' OR b.company_code LIKE '%".$srch."%' OR b.company_name LIKE '%".$srch."%' OR c.loc_code LIKE '%".$srch."%' OR c.location_name LIKE '%".$srch."%' OR a.ref LIKE '%".$srch."%' OR a.notes LIKE '%".$srch."%') AND (a.dt BETWEEN '$fdt' AND '$tdt') ";
		//echo "Aa-3 : ".$str."<br>";
	}	
	else if($compId!='0' && $locId=='0' && $srch!='0' && $iType=='0' && $fdt!='0' && $tdt!='0')
	{
      $str=$str." AND b.ID='$compId' AND (a.docNo LIKE '%".$srch."%' OR b.company_code LIKE '%".$srch."%' OR b.company_name LIKE '%".$srch."%' OR c.loc_code LIKE '%".$srch."%' OR c.location_name LIKE '%".$srch."%' OR a.ref LIKE '%".$srch."%' OR a.notes LIKE '%".$srch."%') AND (a.dt BETWEEN '$fdt' AND '$tdt') ";
		//echo "Aa-4 : ".$str."<br>";
	}	
	else if($compId!='0' && $locId=='0' && $srch=='0' && $iType!='0' && $fdt!='0' && $tdt!='0')
	{
		$str=$str." AND b.ID='$compId' AND a.iType='$iType'  AND (a.dt BETWEEN '$fdt' AND '$tdt') ";
		//echo "Aa-5 : ".$str."<br>";
	}	
	else if($compId!='0' && $locId=='0' && $srch=='0' && $iType=='0' && $fdt!='0' && $tdt!='0')
	{
		$str=$str." AND b.ID='$compId' AND (a.dt BETWEEN '$fdt' AND '$tdt') ";
		//echo "Aa-5 : ".$str."<br>";
	}
	else 
	{
		$str=$str." AND b.ID='$compId'";
		//echo "Aa-6 : ".$str."<br>";
	}
	
	//echo "<Br>";
    if($uRole=='admin' && ($uiType=='3' || $uiType=='0'))
	{
		$qq="SELECT a.ID,a.dt,a.compId,a.locId,a.iType,a.docNo,a.yr,a.yr2,b.company_code,b.company_name,c.loc_code,c.location_name,IF(a.iType='1','RAW MATERIAL','FINISHED GOODS') AS iTypeNm,ref,notes ,a.salemnId,s.UserNm AS salemanNm,a.rsts FROM inventory_tbl AS a LEFT JOIN company_tbl AS b ON a.compId=b.ID LEFT JOIN location_tbl AS c ON a.locId=c.ID LEFT JOIN admin_tbl AS s ON a.salemnId=s.id WHERE a.sts!='2' AND b.sts!='2' AND c.sts!='2' AND a.lsts='1' ".$str." AND s.sts!='2' GROUP BY a.ID,a.dt,a.compId,a.locId,a.iType,a.docNo,a.yr,a.yr2,b.company_code,b.company_name,c.loc_code,c.location_name,IF(a.iType='1','RAW MATERIAL','FINISHED GOODS'),ref,notes ,a.salemnId,s.UserNm ORDER BY SUBSTRING(a.docNo,1,9), SUBSTRING(a.docNo,10)*1 DESC";
		//echo "A : ".$qq."<br>";
	}
	else
	{
		$qq="SELECT a.ID,a.dt,a.compId,a.locId,a.iType,a.docNo,a.yr,a.yr2,b.company_code,b.company_name,c.loc_code,c.location_name,IF(a.iType='1','RAW MATERIAL','FINISHED GOODS') AS iTypeNm,ref,notes ,a.salemnId,s.UserNm AS salemanNm,a.rsts FROM inventory_tbl AS a LEFT JOIN company_tbl AS b ON a.compId=b.ID LEFT JOIN location_tbl AS c ON a.locId=c.ID LEFT JOIN admin_tbl AS s ON a.salemnId=s.id LEFT JOIN admin_usr_loc AS u ON c.ID=u.locId WHERE a.sts!='2' AND b.sts!='2' AND c.sts!='2' AND a.lsts='1' AND s.sts!='2' AND a.lsts='1' ".$str." AND u.uid='$uId' GROUP BY a.ID,a.dt,a.compId,a.locId,a.iType,a.docNo,a.yr,a.yr2,b.company_code,b.company_name,c.loc_code,c.location_name,IF(a.iType='1','RAW MATERIAL','FINISHED GOODS'),ref,notes ,a.salemnId,s.UserNm ORDER BY SUBSTRING(a.docNo,1,9), SUBSTRING(a.docNo,10)*1 DESC";
		//echo "B : ".$qq."<br>";
	}
	
	include('shripage.php');
    $totalRecordsPerPage=500;
    $paginationData=pagination_records($totalRecordsPerPage,$qq);
    //print_r($paginationData);
    $sn=pagination_records_counter($totalRecordsPerPage);
    $cnt=$sn;	
    $pagination=pagination($totalRecordsPerPage,$qq);
}
else
{	
	if($compId!='0' && $srch!='0' && $iType!='0' && $fdt=='0' && $tdt=='0')
	{
      $str=$str." AND b.ID='$compId' AND a.iType='$iType' AND (a.docNo LIKE '%".$srch."%' OR b.company_code LIKE '%".$srch."%' OR b.company_name LIKE '%".$srch."%' OR c.loc_code LIKE '%".$srch."%' OR c.location_name LIKE '%".$srch."%' OR a.ref LIKE '%".$srch."%' OR a.notes LIKE '%".$srch."%')";
	  //echo "AA-1 : ".$str."<br>";
	}
	else if($compId!='0' && $srch!='0' && $iType=='0' && $fdt=='0' && $tdt=='0')
	{
      $str=$str." AND b.ID='$compId' AND (a.docNo LIKE '%".$srch."%' OR b.company_code LIKE '%".$srch."%' OR b.company_name LIKE '%".$srch."%' OR c.loc_code LIKE '%".$srch."%' OR c.location_name LIKE '%".$srch."%' OR a.ref LIKE '%".$srch."%' OR a.notes LIKE '%".$srch."%')";
	  //echo "AA-2 : ".$str."<br>";
	}
	else if($compId!='0' && $srch=='0' && $iType!='0' && $fdt=='0' && $tdt=='0')
	{
      $str=$str." AND b.ID='$compId' AND a.iType='$iType' ";
	  //echo "AA-3 : ".$str."<br>";
	}
	else if($compId!='0' && $srch!='0' && $iType!='0' && $fdt!='0' && $tdt!='0')
	{
      $str=$str." AND b.ID='$compId' AND a.iType='$iType' AND (a.docNo LIKE '%".$srch."%' OR b.company_code LIKE '%".$srch."%' OR b.company_name LIKE '%".$srch."%' OR c.loc_code LIKE '%".$srch."%' OR c.location_name LIKE '%".$srch."%' OR a.ref LIKE '%".$srch."%' OR a.notes LIKE '%".$srch."%') AND (a.dt BETWEEN '$fdt' AND '$tdt') ";
	  //echo "AA-1 : ".$str."<br>";
	}
	else if($compId!='0' && $srch!='0' && $iType=='0' && $fdt!='0' && $tdt!='0')
	{
      $str=$str." AND b.ID='$compId' AND (a.docNo LIKE '%".$srch."%' OR b.company_code LIKE '%".$srch."%' OR b.company_name LIKE '%".$srch."%' OR c.loc_code LIKE '%".$srch."%' OR c.location_name LIKE '%".$srch."%' OR a.ref LIKE '%".$srch."%' OR a.notes LIKE '%".$srch."%') AND (a.dt BETWEEN '$fdt' AND '$tdt') ";
	  //echo "AA-2 : ".$str."<br>";
	}
	else if($compId!='0' && $srch=='0' && $iType!='0' && $fdt!='0' && $tdt!='0')
	{
      $str=$str." AND b.ID='$compId' AND a.iType='$iType'  AND (a.dt BETWEEN '$fdt' AND '$tdt') ";
	  //echo "AA-3 : ".$str."<br>";
	}
	else if($compId!='0' && $srch=='0' && $iType=='0' && $fdt!='0' && $tdt!='0')
	{
      $str=$str." AND b.ID='$compId' AND (a.dt BETWEEN '$fdt' AND '$tdt') ";
	  //echo "AA-3 : ".$str."<br>";
	}
	else 
	{
		$str=$str." AND b.ID='$compId'";
	  //echo "AA-4 : ".$str."<br>";
	}
	
	//echo "<Br>";
	
	if($compId=='0')
	{
		$qq="SELECT a.ID,a.dt,a.compId,a.locId,a.iType,a.docNo,a.yr,a.yr2,b.company_code,b.company_name,c.loc_code,c.location_name,IF(a.iType='1','RAW MATERIAL','FINISHED GOODS') AS iTypeNm,ref,notes ,a.salemnId,s.UserNm AS salemanNm,a.rsts FROM inventory_tbl AS a LEFT JOIN company_tbl AS b ON a.compId=b.ID LEFT JOIN location_tbl AS c ON a.locId=c.ID LEFT JOIN admin_tbl AS s ON a.salemnId=s.id WHERE a.sts!='2' AND b.sts!='2' AND c.sts!='2' AND a.lsts='1' AND s.sts!='2' GROUP BY a.ID,a.dt,a.compId,a.locId,a.iType,a.docNo,a.yr,a.yr2,b.company_code,b.company_name,c.loc_code,c.location_name,IF(a.iType='1','RAW MATERIAL','FINISHED GOODS'),ref,notes ,a.salemnId,s.UserNm ORDER BY SUBSTRING(a.docNo,1,9), SUBSTRING(a.docNo,10)*1 DESC";
	  //echo "AAC : ".$qq."<br>";
	}
	else
	{
		if($uRole=='admin' && ($uiType=='3' || $uiType=='0'))
		{
			$qq="SELECT a.ID,a.dt,a.compId,a.locId,a.iType,a.docNo,a.yr,a.yr2,b.company_code,b.company_name,c.loc_code,c.location_name,IF(a.iType='1','RAW MATERIAL','FINISHED GOODS') AS iTypeNm,ref,notes ,a.salemnId,s.UserNm AS salemanNm,a.rsts FROM inventory_tbl AS a LEFT JOIN company_tbl AS b ON a.compId=b.ID LEFT JOIN location_tbl AS c ON a.locId=c.ID LEFT JOIN admin_tbl AS s ON a.salemnId=s.id WHERE a.sts!='2' AND b.sts!='2' AND c.sts!='2' AND a.lsts='1' ".$str." AND s.sts!='2' GROUP BY a.ID,a.dt,a.compId,a.locId,a.iType,a.docNo,a.yr,a.yr2,b.company_code,b.company_name,c.loc_code,c.location_name,IF(a.iType='1','RAW MATERIAL','FINISHED GOODS'),ref,notes ,a.salemnId,s.UserNm ORDER BY SUBSTRING(a.docNo,1,9), SUBSTRING(a.docNo,10)*1 DESC";
	  		//echo "AABB : ".$qq."<br>";
		}
		else
		{
			$qq="SELECT a.ID,a.dt,a.compId,a.locId,a.iType,a.docNo,a.yr,a.yr2,b.company_code,b.company_name,c.loc_code,c.location_name,IF(a.iType='1','RAW MATERIAL','FINISHED GOODS') AS iTypeNm,ref,notes ,a.salemnId,s.UserNm AS salemanNm,a.rsts FROM inventory_tbl AS a LEFT JOIN company_tbl AS b ON a.compId=b.ID LEFT JOIN location_tbl AS c ON a.locId=c.ID LEFT JOIN admin_tbl AS s ON a.salemnId=s.id LEFT JOIN admin_usr_loc AS u ON c.ID=u.locId WHERE a.sts!='2' AND b.sts!='2' AND c.sts!='2' AND a.lsts='1' AND s.sts!='2' AND a.lsts='1' ".$str." AND u.uid='$uId' GROUP BY a.ID,a.dt,a.compId,a.locId,a.iType,a.docNo,a.yr,a.yr2,b.company_code,b.company_name,c.loc_code,c.location_name,IF(a.iType='1','RAW MATERIAL','FINISHED GOODS'),ref,notes ,a.salemnId,s.UserNm ORDER BY SUBSTRING(a.docNo,1,9), SUBSTRING(a.docNo,10)*1 DESC";
	  		//echo "AAB : ".$qq."<br>";
		}
	}
	//echo "hhh : ".$qq."<br>";
	
	include('shripage.php');
    $totalRecordsPerPage=500;
    $paginationData=pagination_records($totalRecordsPerPage,$qq);
    //print_r($paginationData);
    $sn=pagination_records_counter($totalRecordsPerPage);
    $cnt=$sn;	
    $pagination=pagination($totalRecordsPerPage,$qq);
}	
?>
<div class="pagination">    
<?php echo $pagination; ?>
</div>	
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
<thead>
<tr style="background-color:#b02923">
<th style="color:#fff;">Date</th>
<th style="color:#fff">Doc. No</th>
<th style="color:#fff">Company</th>
<th style="color:#fff">Location</th>
<th style="color:#fff">Product Category</th>
<th style="color:#fff">Salesman</th>
<th style="color:#fff">Reference</th>
<th style="color:#fff">Notes</th>
<th style="color:#fff">View</th>
<th style="color:#fff">Edit</th>
<th style="color:#fff">Delete</th>
</tr>
</thead>
<?php

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
foreach ($paginationData as $row) 
{
	$id=$row['ID'];	
    $loc_id=$row['locId'];
    if($uRole=='admin' || $uiType=='3')
    {
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
          if($ed==0)
          {
            echo '<td>-</td>';  
            echo '<td>-</td>';
          }
          else
          {
				if($row['rsts']=='0')
				{
					if($row['dt']==$cdt)
					{
						echo '<td align="center"><a href="javascript:edit('.$id.')"><i class="fa fa-edit"></i></a></td>';
					}
					else
					{
						echo '<td align="center">-</td>';
					}
					echo '<td align="center"><a href="javascript:deletes('.$id.')"><i class="fa fa-trash"></i></a></td>'; 
				}
				else
				{
				  echo '<td>-</td>';  
				  echo '<td>-</td>';
				}
            }
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
          if($ed==0)
          {
            echo '<td>-</td>';  
            echo '<td>-</td>';
          }
          else
          {
				if($row['rsts']=='0')
				{
					if($row['dt']==$cdt)
					{
						echo '<td align="center"><a href="javascript:edit('.$id.')"><i class="fa fa-edit"></i></a></td>';
					}
					else
					{
						echo '<td align="center">-</td>';
					}
					echo '<td align="center"><a href="javascript:deletes('.$id.')"><i class="fa fa-trash"></i></a></td>'; 
				}
				else
				{
				  echo '<td>-</td>';  
				  echo '<td>-</td>';
				}
            }
          echo '</tr>';
      }
      $cnt++;
    }
	else
	{
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
          if($ed==0)
          {
            echo '<td>-</td>';  
            echo '<td>-</td>';
          }
          else
          {
				if($row['rsts']=='0')
				{
					if($row['dt']==$cdt)
					{
						echo '<td align="center"><a href="javascript:edit('.$id.')"><i class="fa fa-edit"></i></a></td>';
					}
					else
					{
						echo '<td align="center">-</td>';
					}
					echo '<td align="center"><a href="javascript:deletes('.$id.')"><i class="fa fa-trash"></i></a></td>'; 
				}
				else
				{
				  echo '<td>-</td>';  
				  echo '<td>-</td>';
				}
            }
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
          if($ed==0)
          {
            echo '<td>-</td>';  
            echo '<td>-</td>';
          }
          else
          {
				if($row['rsts']=='0')
				{
					if($row['dt']==$cdt)
					{
						echo '<td align="center"><a href="javascript:edit('.$id.')"><i class="fa fa-edit"></i></a></td>';
					}
					else
					{
						echo '<td align="center">-</td>';
					}
					echo '<td align="center"><a href="javascript:deletes('.$id.')"><i class="fa fa-trash"></i></a></td>'; 
				}
				else
				{
				  echo '<td>-</td>';  
				  echo '<td>-</td>';
				}
            }
          echo '</tr>';
        }
        $cnt++;
	}
}
$mysql=null;	
?>	
</table>