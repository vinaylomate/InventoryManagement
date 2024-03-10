<?php 
if(isset($_POST['page']))
{ 
	date_default_timezone_set('Asia/Calcutta');
	$cdt=date('Y-m-d');
    // Include pagination library file 
    include('shripage1.php'); 
     
    // Include database configuration file 
    include('mysql.connect.php'); 
     
    // Set some useful configuration 
    $baseURL = 'getinventoryReg.php'; 
    $offset = !empty($_POST['page'])?$_POST['page']:0; 
    $limit = 100; 
	
	$compId=$locId=$iType=$kw=$sType='0';
	
	if($_POST['sType']=='1')
	{
		$sType=$_POST['sType'];
		//$adparams=$compId."||".$locId."||".$iType."||".$fdt."||".$tdt;		
		$srch1=$_POST['srch'];
		$srch=explode("||",$srch1);
		
		$compId=$srch[0];

		$locId=$srch[1];

		$iType=$srch[2];	

		$uId=$_POST['uId'];
		$uiType=$_POST['uiType'];
		$uRole=$_POST['urole'];
		
		$fdt=$srch[3];
		$tdt=$srch[4];
	}
	else
	{
		$sType=$_POST['sType'];
	
		if(!empty($_POST['compId']))
		$compId=$_POST['compId'];

		if(!empty($_POST['locId']))
		$locId=$_POST['locId'];

		if(!empty($_POST['iType']))
		$iType=$_POST['iType'];	

		$uId=$_POST['uId'];
		$uiType=$_POST['uiType'];
		$uRole=$_POST['urole'];

		if(empty($_POST['uloc']))
		$uloc="0";
		else
		$uloc=$_POST['uloc'];


		if(empty($_POST['fdt']))
		$fdt="0";
		else
		$fdt=$_POST['fdt'];

		if(empty($_POST['tdt']))
		$tdt="0";
		else
		$tdt=$_POST['tdt'];
	}
    // Set conditions for search 
	
	
	
	//echo $fdt." : ".$tdt."<Br>";
	
	$adparams=$compId."||".$locId."||".$iType."||".$fdt."||".$tdt;
	
	//echo "S Type : ".$sType." : ".$adparams."<br>";
	
	
    if(empty($_POST['keywords']))
	$kw="0";
	else
	$kw=$_POST['keywords'];
	
    if(isset($_POST['filterBy']) && $_POST['filterBy'] != ''){ 
        /*$whereSQL .= (strpos($whereSQL, 'WHERE') !== false)?" AND ":" WHERE "; 
        $whereSQL .= " sts = ".$_POST['filterBy']; */
    } 
     
    // Count of all records 
    //$query   = $mysql->prepare("SELECT COUNT(*) as rowNum FROM users ".$whereSQL); 
	
	if($compId!='0' && $locId!='0' && $iType!='0' && $fdt=='0' && $tdt=='0')
	{
		$str=$str." AND b.ID='$compId' AND c.ID='$locId' AND a.iType='$iType' ";
		//echo "Aa-1 : ".$str."<br>";
	}	
	else if($compId!='0' && $locId=='0' && $iType!='0' && $fdt=='0' && $tdt=='0')
	{
      $str=$str." AND b.ID='$compId' AND a.iType='$iType' ";
		//echo "Aa-3 : ".$str."<br>";
	}	
	else if($compId!='0' && $locId=='0' && $iType=='0' && $fdt=='0' && $tdt=='0')
	{
      $str=$str." AND b.ID='$compId' ";
		//echo "Aa-4 : ".$str."<br>";
	}
	else if($compId!='0' && $locId!='0' && $iType!='0' && $fdt!='0' && $tdt!='0')
	{
		$str=$str." AND b.ID='$compId' AND c.ID='$locId' AND a.iType='$iType' AND (a.dt BETWEEN '$fdt' AND '$tdt') ";
		//echo "Aa-1 : ".$str."<br>";
	}	
	else if($compId!='0' && $locId=='0' && $iType!='0' && $fdt!='0' && $tdt!='0')
	{
      $str=$str." AND b.ID='$compId' AND a.iType='$iType' AND (a.dt BETWEEN '$fdt' AND '$tdt') ";
		//echo "Aa-3 : ".$str."<br>";
	}	
	else if($compId!='0' && $locId=='0' && $iType=='0' && $fdt!='0' && $tdt!='0')
	{
      $str=$str." AND b.ID='$compId' AND (a.dt BETWEEN '$fdt' AND '$tdt') ";
		//echo "Aa-4 : ".$str."<br>";
	}	
	else if($compId!='0' && $locId=='0' && $iType=='0' && $fdt!='0' && $tdt!='0')
	{
		$str=$str." AND b.ID='$compId' AND (a.dt BETWEEN '$fdt' AND '$tdt') ";
		//echo "Aa-5 : ".$str."<br>";
	}	
	else if($compId=='0' && $locId=='0' && $iType=='0' && $fdt!='0' && $tdt!='0')
	{
		$str=$str." AND (a.dt BETWEEN '$fdt' AND '$tdt') ";
		//echo "Aa-5 : ".$str."<br>";
	}
	else 
	{
		$str=$str."";
		//echo "Aa-6 : ".$str."<br>";
	}
	
	if($kw!='0')
	{
		$str=$str." AND (a.docNo LIKE '%".$_POST['keywords']."%' OR b.company_code LIKE '%".$_POST['keywords']."%' OR b.company_name LIKE '%".$_POST['keywords']."%' OR c.loc_code LIKE '%".$_POST['keywords']."%' OR c.location_name LIKE '%".$_POST['keywords']."%' OR a.ref LIKE '%".$_POST['keywords']."%' OR a.notes LIKE '%".$_POST['keywords']."%')";
	}

    //echo $str."<Br>";

    //echo "ROLE : ".$uRole."<br>";

    if($uRole=='admin' && ($uiType=='3' || $uiType=='0'))
    {
        $qq="SELECT a.ID,a.dt,a.compId,a.locId,a.iType,a.docNo,a.yr,a.yr2,b.company_code,b.company_name,c.loc_code,c.location_name,IF(a.iType='1','RAW MATERIAL','FINISHED GOODS') AS iTypeNm,ref,notes FROM inventory_tbl AS a LEFT JOIN company_tbl AS b ON a.compId=b.ID LEFT JOIN location_tbl AS c ON a.locId=c.ID WHERE a.sts!='2' AND b.sts!='2' AND c.sts!='2' AND a.lsts='0' ".$str." ORDER BY substring(a.docNo,1,9), substring(a.docNo,10)*1 DESC LIMIT $offset,$limit";

        $qqq="SELECT COUNT(a.ID) AS rowNum FROM inventory_tbl AS a LEFT JOIN company_tbl AS b ON a.compId=b.ID LEFT JOIN location_tbl AS c ON a.locId=c.ID WHERE a.sts!='2' AND b.sts!='2' AND c.sts!='2' AND a.lsts='0' ".$str." ORDER BY substring(a.docNo,1,9), substring(a.docNo,10)*1 DESC";
		$query1=$mysql->prepare($qqq);
        $query1->execute();
        $result  = $query1->fetch(PDO::FETCH_ASSOC); 
        $rowCount= $result['rowNum'];
        //echo "A : ".$qq."<br>";
    }
    else
    {
        $qq="SELECT a.ID,a.dt,a.compId,a.locId,a.iType,a.docNo,a.yr,a.yr2,b.company_code,b.company_name,c.loc_code,c.location_name,IF(a.iType='1','RAW MATERIAL','FINISHED GOODS') AS iTypeNm,a.ref,a.notes FROM inventory_tbl AS a LEFT JOIN company_tbl AS b ON a.compId=b.ID LEFT JOIN location_tbl AS c ON a.locId=c.ID LEFT JOIN admin_usr_loc AS us ON c.ID=us.locId WHERE a.sts!='2' AND b.sts!='2' AND c.sts!='2' AND a.lsts='0' ".$str." AND us.uid='$uId' ORDER BY substring(a.docNo,1,9), substring(a.docNo,10)*1 DESC LIMIT $offset,$limit";

        $qqq="SELECT COUNT(a.ID) AS rowNum FROM inventory_tbl AS a LEFT JOIN company_tbl AS b ON a.compId=b.ID LEFT JOIN location_tbl AS c ON a.locId=c.ID LEFT JOIN admin_usr_loc AS us ON c.ID=us.locId WHERE a.sts!='2' AND b.sts!='2' AND c.sts!='2' AND a.lsts='0' ".$str." AND us.uid='$uId' ORDER BY substring(a.docNo,1,9), substring(a.docNo,10)*1 DESC";
		$query1=$mysql->prepare($qqq);
        $query1->execute();
        $result  = $query1->fetch(PDO::FETCH_ASSOC); 
        $rowCount= $result['rowNum'];
        //echo "B : ".$qq."<br>";
    }
	 
     
    // Initialize pagination class 
    $pagConfig = array( 
    'baseURL'=> $baseURL, 
    'totalRows'=> $rowCount, 
    'perPage'=> $limit, 
    'currentPage'=> $offset, 
    'contentDiv'=> 'tbl', 
    'link_func'=> '',
    'keywords'=> $_POST['keywords'],
    'uiType'=> $uiType,
    'uRole'=> $uRole,
    'uId'=> $uId,
    'srch'=> $adparams,
    'sType'=> '1'
    ); 
    $pagination =  new Pagination($pagConfig); 
 
    // Fetch records based on the offset and limit 
    /*$query = $mysql->prepare("SELECT * FROM users $whereSQL ORDER BY id DESC LIMIT $offset,$limit");
	$query->execute();*/
	
	//echo $q."<Br>";	
	$query = $mysql->prepare($qq); 
	$query->execute();
	$paginationData=$query->fetchAll();	
	echo $pagination->createLinks(); 
	
	//admin_tbl 
$qEditDel="SELECT act_edit AS ed,act_delete AS del FROM admin_tbl WHERE sts='0' AND id='".$uId."'";
//echo $qEditDel."<Br>";	
$stmEditDel=$mysql->prepare($qEditDel);
$stmEditDel->execute();
$rowEditDel=$stmEditDel->fetch(PDO::FETCH_ASSOC);
$ed=$rowEditDel['ed'];
$dels=$rowEditDel['del'];	
//admin_tbl
?> 
    <!-- Data list container --> 
    
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
<thead>
<tr style="background-color:#b02923">
<th style="color:#fff;">Date</th>
<th style="color:#fff">Doc. No</th>
<!--<th style="color:#fff">Company</th>-->
<th style="color:#fff">Location</th>
<th style="color:#fff">Product Category</th>
<th style="color:#fff">Reference</th>
<th style="color:#fff">Notes</th>
<th style="color:#fff">View</th>
<th style="color:#fff">Edit</th>
<th style="color:#fff">Delete</th>
</tr>
</thead>
<?php
//print_r($paginationData);	
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
          //echo '<td>'.$row['company_code'].' '.$row['company_name'].'</td>';
          echo '<td>'.$row['loc_code'].' '.$row['location_name'].'</td>';
          echo '<td>'.$row['iTypeNm'].'</td>';
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
          echo '</tr>';
      }
      else
      {
          echo'<tr style="color:#000;font-weight:600;background-color:#f4b80d61;">';
          echo '<td>'.date('d-m-Y',strtotime($row['dt'])).'</td>';
          echo '<td>'.$row['docNo'].'</td>';
          //echo '<td>'.$row['company_code'].' '.$row['company_name'].'</td>';
          echo '<td>'.$row['loc_code'].' '.$row['location_name'].'</td>';
          echo '<td>'.$row['iTypeNm'].'</td>';	
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
          //echo '<td>'.$row['company_code'].' '.$row['company_name'].'</td>';
          echo '<td>'.$row['loc_code'].' '.$row['location_name'].'</td>';
          echo '<td>'.$row['iTypeNm'].'</td>';
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
          echo '</tr>';
        }
        else
        {
          echo'<tr style="color:#000;font-weight:600;background-color:#f4b80d61;">';
          echo '<td>'.date('d-m-Y',strtotime($row['dt'])).'</td>';
          echo '<td>'.$row['docNo'].'</td>';
          //echo '<td>'.$row['company_code'].' '.$row['company_name'].'</td>';
          echo '<td>'.$row['loc_code'].' '.$row['location_name'].'</td>';
          echo '<td>'.$row['iTypeNm'].'</td>';	
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
          echo '</tr>';
        }
        $cnt++;
	}
}
$mysql=null;	
?>	
</table>
    <!-- Display pagination links --> 
<?php 
} 
?>