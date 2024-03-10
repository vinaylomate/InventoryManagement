<?php
include ("mysql.connect.php");
date_default_timezone_set('Asia/Calcutta');
set_time_limit(0);
$filename="inoutReportSummeryEx_".date('d.m.Y H:i:s a').".xls";
$date=date('Y-m-d');
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: application/vnd.ms-excel");
$compId=$locId=$iType=$itemId='0';
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

	
if(empty($_GET['fdt']))
$fdt=date('Y-m-d');
else
$fdt=$_GET['fdt'];

if(empty($_GET['tdt']))
$fdt=date('Y-m-d');
else
$tdt=$_GET['tdt'];

//echo $locId."<Br>";
$itemId=$_GET['itemId'];
$str=$str2=$str3="";
if($compId=='0')
{
	if($iType!='0' && $itemId!='0')
	{
		$str=$str." AND b.iType='$iType' AND a.itemId='$itemId'";		
		$str3=$str3." AND a.iType='$iType' AND a.itemId='$itemId'";	
	}
	else if($iType=='0' && $itemId!='0')
	{
		$str=$str." AND a.itemId='$itemId' ";
		$str3=$str3." AND a.itemId='$itemId' ";	
	}
	else
	{
		$str="no data found";
	}
}
else if($uRole=='admin' && ($uiType=='3' || $uiType=='0'))
{
	if($compId!='0' && $iType!='0' && $itemId!='0' && $locId!='0')
	{
		$str=$str." AND b.compId='$compId' AND b.iType='$iType' AND a.itemId='$itemId' AND b.locId='$locId' ";	
		$str3=$str3." AND a.compId='$compId' AND a.iType='$iType' AND a.itemId='$itemId' AND a.locId='$locId' ";
	}	
	else if($compId!='0' && $iType!='0' && $itemId!='0' && $locId=='0')
	{
		$str=$str." AND b.compId='$compId' AND b.iType='$iType' AND a.itemId='$itemId' ";	
		$str3=$str3." AND a.compId='$compId' AND a.iType='$iType' AND a.itemId='$itemId' ";		
	}
	else if($compId!='0' && $iType=='0' && $itemId!='0' && $locId=='0')
	{
		$str=$str." AND b.compId='$compId' AND a.itemId='$itemId' ";	
		$str3=$str3." AND a.compId='$compId' AND a.itemId='$itemId' ";		
	}
	else if($compId=='0' && $iType=='0' && $itemId!='0' && $locId=='0')
	{
		$str=$str." AND a.itemId='$itemId' ";	
		$str3=$str3." AND a.itemId='$itemId' ";		
	}
	else
	{
		$str="no data found";
	}
}
else
{
	if($compId!='0' && $iType!='0' && $itemId!='0' && $locId!='0')
	{
		$str=$str." AND b.compId='$compId' AND b.iType='$iType' AND a.itemId='$itemId' AND b.locId='$locId' ";	
		$str3=$str3." AND a.compId='$compId' AND a.iType='$iType' AND a.itemId='$itemId' AND a.locId='$locId' ";
	}	
	else if($compId!='0' && $iType!='0' && $itemId!='0' && $locId=='0')
	{
		$str=$str." AND b.compId='$compId' AND b.iType='$iType' AND a.itemId='$itemId' ";	
		$str3=$str3." AND a.compId='$compId' AND a.iType='$iType' AND a.itemId='$itemId ";		
	}
	else if($compId!='0' && $iType=='0' && $itemId!='0' && $locId=='0')
	{
		$str=$str." AND b.compId='$compId' AND a.itemId='$itemId' ";	
		$str3=$str3." AND a.compId='$compId' ND a.itemId='$itemId' ";		
	}
	else if($compId=='0' && $iType=='0' && $itemId!='0' && $locId=='0')
	{
		$str=$str." AND a.itemId='$itemId' ";	
		$str3=$str3." AND a.itemId='$itemId' ";		
	}
	else
	{
		$str="no data found";
	}
}

$locNm="";		
if($locId!='0')
{
	include('mysql.connect.php');
    $qqLoc="SELECT CONCAT(loc_code,' - ',location_name) AS locNm FROM location_tbl WHERE ID='$locId' AND sts='0'";
    //echo $qqLoc."<Br>";
    $st12=$mysql->prepare($qqLoc);
    $st12->execute();
    $rw12=$st12->fetch(PDO::FETCH_ASSOC);
	$locNm=$rw12['locNm'];
	$mysql=null;
}

echo '<div>
			<table width="100%">
			<tr>
			<td colspan="6" align="center">
			 <div style="font-size:30px;font-weight:bold;" align="center">
           RITVER <span style="font-size:14px;">PAINTS & COATINGS</span>
				<hr>
            </div>
           
			</td>
			</tr>';		
			
			if($locId=='0')	
			{
			echo '<tr>	
				<td></td>	
				<td></td>	
				<td></td>	
				<td>Date</td>	
				<td>:</td>	
				<td>'.date('d-m-Y').'</td>
				</tr>';
			}
			else
			{
				echo '<tr>
				<td>Date</td>	
				<td>:</td>	
				<td>'.date('d-m-Y').'</td>	
				<td>Location</td>	
				<td>:</td>	
				<td>'.$locNm.'</td>	
				</tr>';
			}
			
			echo '<tr>
			<td>From Date</td>	
			<td>:</td>	
			<td>'.date('d-m-Y',strtotime($fdt)).'</td>	
			<td>To Date</td>	
			<td>:</td>	
			<td>'.date('d-m-Y',strtotime($tdt)).'</td>	
			</tr>
			</table>	
			<hr>
              
            <div style="margin-top:25px">';
			
            if($str=='no data found')
            {
				echo '<div align="center"><h1>no data found...</h1></div>';
            }
            else
            {
				include('mysql.connect.php');
				if($fdt<='2022-12-03')
				{
				    $qqOp="SELECT dt AS cdt,oqty FROM stock_op_tbl WHERE sts='0' AND itemId='$itemId' AND compId='$compId' AND locId='$locId' AND iType='$iType' AND dt='$fdt1'";
				}
				else
				{
				    $qqOp="SELECT cdt,oqty FROM stock_op_tbl WHERE sts='0' AND itemId='$itemId' AND compId='$compId' AND locId='$locId' AND iType='$iType' AND cdt='$fdt'";
				}
				//echo $qqOp."<Br>";
				$st1=$mysql->prepare($qqOp);
				$st1->execute();
				$rw1=$st1->fetch(PDO::FETCH_ASSOC);
				$opstk=$startop=$cdt=0;
				if(!empty($rw1['oqty']))
				{
					$opstk=$rw1['oqty'];
					$cdt=$rw1['cdt'];
					$startop=$opstk;
				}
				else	
				{
    				$opstk=0;
					$startop=$opstk;
					$cdt=$fdt;
				}
                echo '<table class="table table-bordered" id="dataTable" width="100%" border="1" cellspacing="0">';

                if($locId!='0')	
                {
                    echo'
                    <tr id="aa" style="background-color:#e1736e;">	
					<th style="color:#000">No</th>
					<th style="color:#000">Date</th>
					<th style="color:#000">Sage Reference</th>
					<th style="color:#000">Sage Code</th>
					<th style="color:#000">Focus Code</th>
					<th style="color:#000">Batch No</th>
					<th style="color:#000">Opening Stock</th>
					<th style="color:#000">IN</th>
					<th style="color:#000">OUT</th>
					<th style="color:#000">Running Stock</th>
					<th style="color:#000">Entry Type</th>
					</tr>
					<tr>	
					<th style="color:#000"></th>
					<th style="color:#000">'.date('d-m-Y',strtotime($cdt)).'</th>
					<th style="color:#000"></th>
					<th style="color:#000"></th>
					<th style="color:#000"></th>
					<th style="color:#000"></th>
					<th style="color:#000">'.$opstk.'</th>
					<th style="color:#000">0</th>
					<th style="color:#000">0</th>
					<th style="color:#000">0</th>
					<th style="color:#000"></th>
					</tr>';
  				}
                else
                {            			
                    echo '<tr id="aa" style="background-color:#e1736e;">					
                    <th style="color:#000">No</th>
                    <th style="color:#000">Date</th>
                    <th style="color:#000">Location</th>
                    <th style="color:#000">Sage Reference</th>	
                    <th style="color:#000">Sage Code</th>
                    <th style="color:#000">Focus Code</th>
                    <th style="color:#000">Batch No</th>
                    <th style="color:#000">Opening Stock</th>
                    <th style="color:#000">IN</th>
                    <th style="color:#000">OUT</th>
                    <th style="color:#000">Running Stock</th>
                    <th style="color:#000">Entry Type</th>
                    </tr>				
                    <tr>					
					<th style="color:#000"></th>
					<th style="color:#000"></th>
					<th style="color:#000"></th>
					<th style="color:#000"></th>	
					<th style="color:#000"></th>
					<th style="color:#000"></th>
					<th style="color:#000"></th>
					<th style="color:#000">'.$opstk.'</th>
					<th style="color:#000">0</th>
					<th style="color:#000">0</th>
					<th style="color:#000">0</th>
					<th style="color:#000"></th>
					</tr>';	
                }
				
				echo '<tbody>';
				$cnt=1;
				$totin=$totout=$cltot=$rq=$dt=0;
				$j=$fdt;
				while($j<=$tdt)
				{
					if($uRole=='admin' && ($uiType=='3' || $uiType=='0'))
					{
						$qq="SELECT a.ID,b.dt,a.itemId,IF(b.iType='1',r.focus_code,f.focus_code) AS focus_code,IF(b.iType='1',r.sage_code,f.sage_code) AS sage_code,IF(b.iType='1',CONCAT(rg.category_nm,' ',r.description,' ',rm_u.uom),CONCAT(fgg.category_nm,' ',f.brand,' ',f.descc,' ',f_u.uom)) AS desp,a.entryId,e.entryNm,a.eType,IF(a.eType='1','IN','OUT') AS eTypeNm,a.qty,a.batchNo,a.expdt,a.notes,l.loc_code,l.location_name,b.compId,b.locId,b.iType,b.ref,b.dt AS AAdt FROM inventory_info_tbl AS a LEFT JOIN inventory_tbl AS b ON a.invId=b.ID LEFT JOIN rm_master AS r ON a.itemId=r.rmId LEFT JOIN fg_master AS f ON a.itemId=f.fgId LEFT JOIN entry_type_tbl AS e ON a.entryId=e.entryId LEFT JOIN uom_tbl AS rm_u ON r.UOM=rm_u.ID LEFT JOIN uom_tbl AS f_u ON f.uom=f_u.ID LEFT JOIN category_master AS rg ON r.catId=rg.catId LEFT JOIN category_master AS fgg ON f.category_id=fgg.catId LEFT JOIN location_tbl AS l ON b.locId=l.ID WHERE b.sts!='2' ".$str." AND b.dt='$j' AND a.sts!='2' 
						UNION ALL
						SELECT a.ID,a.dt,a.itemId,IF(a.iType='1',r.focus_code,f.focus_code) AS focus_code,IF(a.iType='1',r.sage_code,f.sage_code) AS sage_code,IF(a.iType='1',CONCAT(rg.category_nm,' ',r.description,' ',rm_u.uom),CONCAT(fgg.category_nm,' ',f.brand,' ',f.descc,' ',f_u.uom)) AS desp,'0' AS entryId,'-' AS entryNm,'1' AS eType,'IN' AS eTypeNm,a.openstk AS qty,a.batchNo,a.expdt,'-' AS notes,l.loc_code,l.location_name,a.compId,a.locId,a.iType,'Uploaded Opening  Stock' AS ref ,a.dt AS AAdt FROM stock_tbl_2 AS a LEFT JOIN rm_master AS r ON a.itemId=r.rmId LEFT JOIN fg_master AS f ON a.itemId=f.fgId LEFT JOIN uom_tbl AS rm_u ON r.UOM=rm_u.ID LEFT JOIN uom_tbl AS f_u ON f.uom=f_u.ID LEFT JOIN category_master AS rg ON r.catId=rg.catId LEFT JOIN category_master AS fgg ON f.category_id=fgg.catId LEFT JOIN location_tbl AS l ON a.locId=l.ID WHERE a.sts!='2' ".$str3." AND a.dt='$j' AND a.openstk!='0' 
						ORDER BY AAdt";
					}
					else
					{
						$qq="SELECT a.ID,b.dt,a.itemId,IF(b.iType='1',r.focus_code,f.focus_code) AS focus_code,IF(b.iType='1',r.sage_code,f.sage_code) AS sage_code,IF(b.iType='1',CONCAT(rg.category_nm,' ',r.description,' ',rm_u.uom),CONCAT(fgg.category_nm,' ',f.brand,' ',f.descc,' ',f_u.uom)) AS desp,a.entryId,e.entryNm,a.eType,IF(a.eType='1','IN','OUT') AS eTypeNm,a.qty,a.batchNo,a.expdt,a.notes,l.loc_code,l.location_name,b.compId,b.locId,b.iType,b.ref,b.dt AS AAdt FROM inventory_info_tbl AS a LEFT JOIN inventory_tbl AS b ON a.invId=b.ID LEFT JOIN rm_master AS r ON a.itemId=r.rmId LEFT JOIN fg_master AS f ON a.itemId=f.fgId LEFT JOIN entry_type_tbl AS e ON a.entryId=e.entryId LEFT JOIN uom_tbl AS rm_u ON r.UOM=rm_u.ID LEFT JOIN uom_tbl AS f_u ON f.uom=f_u.ID LEFT JOIN category_master AS rg ON r.catId=rg.catId LEFT JOIN category_master AS fgg ON f.category_id=fgg.catId  LEFT JOIN location_tbl AS l ON b.locId=l.ID LEFT JOIN admin_usr_loc AS us ON l.ID=us.locId WHERE b.sts!='2' AND a.sts!='2' AND us.uid='$uId' ".$str." AND b.dt='$j' 
						UNION ALL
						SELECT a.ID,a.dt,a.itemId,IF(a.iType='1',r.focus_code,f.focus_code) AS focus_code,IF(a.iType='1',r.sage_code,f.sage_code) AS sage_code,IF(a.iType='1',CONCAT(rg.category_nm,' ',r.description,' ',rm_u.uom),CONCAT(fgg.category_nm,' ',f.brand,' ',f.descc,' ',f_u.uom)) AS desp,'0' AS entryId,'-' AS entryNm,'1' AS eType,'IN' AS eTypeNm,a.openstk AS qty,a.batchNo,a.expdt,'-' AS notes,l.loc_code,l.location_name,a.compId,a.locId,a.iType,'Uploaded Opening  Stock' AS ref ,a.dt AS AAdt FROM stock_tbl_2 AS a LEFT JOIN rm_master AS r ON a.itemId=r.rmId LEFT JOIN fg_master AS f ON a.itemId=f.fgId LEFT JOIN uom_tbl AS rm_u ON r.UOM=rm_u.ID LEFT JOIN uom_tbl AS f_u ON f.uom=f_u.ID LEFT JOIN category_master AS rg ON r.catId=rg.catId LEFT JOIN category_master AS fgg ON f.category_id=fgg.catId LEFT JOIN location_tbl AS l ON a.locId=l.ID LEFT JOIN admin_usr_loc AS us ON l.ID=us.locId 
						WHERE a.sts!='2' ".$str3." AND a.dt='$j' AND a.openstk!='0' AND us.uid='$uId' ORDER BY AAdt";
					}
					//echo $qq."<Br>";
					$stm=$mysql->prepare($qq);
					$stm->execute();

					while($rw=$stm->fetch(PDO::FETCH_ASSOC))
					{
						$inq=$outq=0;
						$dt=$rw['dt'];
						echo '<tr>';
						echo '<td style="background-color:#0d69f445;color:#000">'.$cnt.'</td>';
						echo '<td style="background-color:#0d69f445;color:#000">'.date('d-m-Y',strtotime($rw['dt'])).'</td>';
						if($locId=='0')	
						{	
							echo '<td style="background-color:#0d69f445;color:#000">'.$rw['loc_code'].'</td>';
						}
						echo '<td style="background-color:#f4b80d61;color:#000">'.$rw['ref'].'</td>';
						echo '<td style="background-color:#f4b80d61;color:#000">'.$rw['sage_code'].'</td>';
						echo '<td style="background-color:#f4b80d61;color:#000">'.$rw['focus_code'].'</td>';
						echo '<td style="background-color:#0d69f445;color:#000">'.$rw['batchNo'].'</td>';
						if($cnt==1)
						{				
							echo '<td style="background-color:#0d69f445;color:#000">0</td>';
						}
						else 
						{				
							if($dt==$rw['dt'])
							{
								$opstk=$rq;
								$rq=0;
							}
							else
							{
								$qqOp22="SELECT oqty FROM stock_op_tbl WHERE sts='0' AND cdt='".$j."' AND itemId='".$rw['itemId']."' AND compId='".$rw['compId']."' AND locId='".$rw['locId']."' AND iType='".$rw['iType']."'";
								//echo $qqOp22."<Br>";
								$st22=$mysql->prepare($qqOp22);
								$st22->execute();
								$rw22=$st22->fetch(PDO::FETCH_ASSOC);
								$opstk=0;
								if(!empty($rw22['oqty']))
								{
									$opstk=$rw22['oqty'];
								}
								else	
								{
									$opstk=0;
								}
							}
							echo '<td style="background-color:#0d69f445;color:#000">'.$opstk.'</td>';
						}	

						if($rw['eType']=='1')	
						{	
							echo '<td style="background-color:#0d69f445;color:#000">'.$rw['qty'].'</td>';
							$inq=$rw['qty'];
							$totin=$totin+$inq;
						}
						else
						{
							echo '<td style="background-color:#0d69f445;color:#000">0</td>';            
						}

						if($rw['eType']=='2')	
						{	
							echo '<td style="background-color:#0d69f445;color:#000">'.$rw['qty'].'</td>';
							$outq=$rw['qty'];
							$totout=$totout+$rw['qty'];
						}
						else
						{
							echo '<td style="background-color:#0d69f445;color:#000">0</td>';            
						}

						$rq=($opstk+$inq)-$outq;
						$cltot=$cltot+$rq;
						echo '<td style="background-color:#0d69f445;color:#000">'.$rq.'</td>';	
						echo '<td style="background-color:#0d69f445;color:#000">'.$rw['entryNm'].'</td>';
						echo '</tr>';
						$cnt++;
					}
					$time_original = strtotime($j);
					$time_add      = $time_original + (3600*24); //add seconds of one day
					$j = date("Y-m-d", $time_add);
				}
				echo '</tbody>';               
                echo '<tfoot>';

                if($locId!='0')	
                {
                    echo '<tr id="aa" style="background-color:#e1736e;">				
                    <th style="color:#000"></th>
                    <th style="color:#000"></th>
                    <th style="color:#000"></th>
                    <th style="color:#000"></th>
                    <th style="color:#000"></th>
                    <th style="color:#000">Total</th>
                    <th style="color:#000"></th>
                    <th style="color:#000">'.$totin.'</th>
                    <th style="color:#000">'.$totout.'</th>
                    <th style="color:#000">'.(($startop+$totin)-$totout).'</th>
                    <th style="color:#000"></th>
                    </tr>';
}
                else
                {
                    echo '<tr style="background-color:#e1736e;">					
                    <th style="color:#000"></th>
                    <th style="color:#000"></th>
                    <th style="color:#000"></th>
                    <th style="color:#000"></th>	
                    <th style="color:#000"></th>
                    <th style="color:#000"></th>
                    <th style="color:#000"></th>
                    <th style="color:#000">'.$totin.'</th>
                    <th style="color:#000">'.$totout.'</th>
                    <th style="color:#000">'.(($startop+$totin)-$totout).'</th>
                    <th style="color:#000"></th>
                    <th style="color:#000"></th>
                    </tr>';
}
                 echo '</tfoot>
                </table>';
            } 
echo '</div>
</div>';
$mysql=null;
?>