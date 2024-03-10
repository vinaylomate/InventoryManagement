<?php ob_start();
$html='
		<html>
		<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<style>
					body {	
					font-family: sans-serif;
					font-size: 10pt; }
					
					p {	margin: 0pt; }

					table.gridtable { 
					font-family: verdana,arial,sans-serif;
					font-size:12px;
					color:#333333;
					border-width: 1px;
					border-color: #cdcdcd;
					border-collapse: collapse; }
					
					table.gridtable th {
					border-width: 1px;
					padding: 2px;
					border-style: solid;
					border-color: #cdcdcd;
					}

					table.gridtable td {
					border-width: 1px;
					padding: 2px;
					border-style: solid;
					border-color: #cdcdcd;
					 }
			</style>
		</head>
<body>

<!--mpdf
			<htmlpageheader name="myheader">	';
			
$html=$html.'	<div align="center" style="font-size:15px" >
<p align="center" ><img src="logo1.jpg" style="height:180px;width:100%"></p>
<hr><br>
					<table width="100%"><tr>
					<td width="30%"></td>
					<td align="center"><u> '.strtoupper("Stock Entry Report").' </u></td>
					<td align="right">Date : '.date('d-m-Y').'</td>
					</tr></table>
				</div>
				</htmlpageheader>
			';
	
$html = $html.'	<htmlpagefooter name="myfooter" >

 					<div style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top: 2mm; ">
					Page {PAGENO} of {nb}
					</div>

				</htmlpagefooter>	
				
					<sethtmlpageheader name="myheader" value="on" show-this-page="1" />
					<sethtmlpagefooter name="myfooter" value="on" />
mpdf-->		';

include("mysql.connect.php");
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
$uiType=$_GET['uiType'];
$uRole=$_GET['role'];

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

$sql="SELECT a.ID,a.dt,a.compId,a.locId,a.iType,a.docNo,a.yr,a.yr2,b.company_code,b.company_name,c.loc_code,c.location_name,IF(a.iType='1','RAW MATERIAL','FINISHED GOODS') AS iTypeNm,ref,notes FROM inventory_tbl AS a LEFT JOIN company_tbl AS b ON a.compId=b.ID LEFT JOIN location_tbl AS c ON a.locId=c.ID WHERE a.sts!='2' AND b.sts!='2' AND c.sts!='2' ".$str." AND a.lsts='0' ORDER BY a.dt DESC";
//$html=$html.$sql;
			$statement = $mysql->prepare($sql);
			$statement->setFetchMode(PDO::FETCH_OBJ);
			$statement->execute();
			$count=1;

$html=$html.'
					<table width="100%" class="gridtable" id="dataTable1"> 					
                    <thead>
                      <tr style="background-color:#b02923">
                      <th style="color:#fff;">Date</th>
                      <th style="color:#fff">Doc. No</th>
                      <th style="color:#fff">Company</th>
                      <th style="color:#fff">Location</th>
                      <th style="color:#fff">Product Category</th>
                      <th style="color:#fff">Reference</th>
                      <th style="color:#fff">Notes</th>
                      
                    </tr>
                    </thead>"';
					
					while($row=$statement->fetch())
					{						 
					  $id=$row->ID;	    	
        			  $loc_id=$row->locId;									
					  if($uRole=='admin' || $uiType=='3')
					  {	
						  if($row->iType=='1')
						  {  $html=$html.' 
							 <tr style="color:#000;font-weight:600;background-color:#96accd99;">
							  <td style="color:#000;font-weight:600;background-color:#96accd99;">'.date('d-m-Y',strtotime($row->dt)).'</td>
							 <td style="color:#000;font-weight:600;background-color:#96accd99;">'.$row->docNo.'</td>
							  <td style="color:#000;font-weight:600;background-color:#96accd99;">'.$row->company_code.' '.$row->company_name.'</td>
							 <td style="color:#000;font-weight:600;background-color:#96accd99;">'.$row->loc_code.' '.$row->location_name.'</td>

							 <td style="color:#000;font-weight:600;background-color:#96accd99;">'.$row->iTypeNm.'</td>
							 <td style="color:#000;font-weight:600;background-color:#96accd99;">'.$row->ref.'</td>
							 <td style="color:#000;font-weight:600;background-color:#96accd99;">'.$row->notes.'</td>

							 </tr>';  
						  }
						  else
						  {  
							  $html=$html.' 
							 <tr style="color:#000;font-weight:600;background-color:#edd18361;">
							  <td style="color:#000;font-weight:600;background-color:#edd18361;">'.date('d-m-Y',strtotime($row->dt)).'</td>
							 <td style="color:#000;font-weight:600;background-color:#edd18361;">'.$row->docNo.'</td>
							  <td style="color:#000;font-weight:600;background-color:#edd18361;">'.$row->company_code.' '.$row->company_name.'</td>
							 <td style="color:#000;font-weight:600;background-color:#edd18361;">'.$row->loc_code.' '.$row->location_name.'</td>

							 <td style="color:#000;font-weight:600;background-color:#edd18361;">'.$row->iTypeNm.'</td>
							 <td style="color:#000;font-weight:600;background-color:#edd18361;">'.$row->ref.'</td>
							 <td style="color:#000;font-weight:600;background-color:#edd18361;">'.$row->notes.'</td>

							 </tr>';  
						  }
					  }
					  else
					  {
						  $ql="SELECT locId FROM admin_usr_loc WHERE uid='$uId' AND sts='0'";
                          //echo $ql."<Br>";
                          $stl=$mysql->prepare($ql);
                          $stl->execute();
                          $cntl=$stl->rowCount();
						  //echo $cntl."<Br>";
                          if($cntl>1)
                          {
							 while($rowl=$stl->fetch(PDO::FETCH_ASSOC))
                			 {
                                $ulcId=$rowl['locId'];
								 var_dump($ulcId==$loc_id);
                                if($ulcId==$loc_id)
                                {
									if($row->iType=='1')
                                    {  
										$html=$html.' 
                                       <tr style="color:#000;font-weight:600;background-color:#96accd99;">
                                        <td style="color:#000;font-weight:600;background-color:#96accd99;">'.date('d-m-Y',strtotime($row->dt)).'</td>
                                       <td style="color:#000;font-weight:600;background-color:#96accd99;">'.$row->docNo.'</td>
                                        <td style="color:#000;font-weight:600;background-color:#96accd99;">'.$row->company_code.' '.$row->company_name.'</td>
                                       <td style="color:#000;font-weight:600;background-color:#96accd99;">'.$row->loc_code.' '.$row->location_name.'</td>

                                       <td style="color:#000;font-weight:600;background-color:#96accd99;">'.$row->iTypeNm.'</td>
                                       <td style="color:#000;font-weight:600;background-color:#96accd99;">'.$row->ref.'</td>
                                       <td style="color:#000;font-weight:600;background-color:#96accd99;">'.$row->notes.'</td>

                                       </tr>';  
                                    }
                                    else
                                    {  
                                        $html=$html.' 
                                       <tr style="color:#000;font-weight:600;background-color:#edd18361;">
                                        <td style="color:#000;font-weight:600;background-color:#edd18361;">'.date('d-m-Y',strtotime($row->dt)).'</td>
                                       <td style="color:#000;font-weight:600;background-color:#edd18361;">'.$row->docNo.'</td>
                                        <td style="color:#000;font-weight:600;background-color:#edd18361;">'.$row->company_code.' '.$row->company_name.'</td>
                                       <td style="color:#000;font-weight:600;background-color:#edd18361;">'.$row->loc_code.' '.$row->location_name.'</td>

                                       <td style="color:#000;font-weight:600;background-color:#edd18361;">'.$row->iTypeNm.'</td>
                                       <td style="color:#000;font-weight:600;background-color:#edd18361;">'.$row->ref.'</td>
                                       <td style="color:#000;font-weight:600;background-color:#edd18361;">'.$row->notes.'</td>

                                       </tr>';  
                                    }
								}
							 }
                          }
						  else
						  {
							    $rowl=$stl->fetch(PDO::FETCH_ASSOC);
							    $ulcId=$rowl['locId'];
							  	//echo $ulcId." : ".$loc_id."<Br>";
                                if($ulcId==$loc_id)
                                {
									if($row->iType=='1')
                                    {  
										$html=$html.' 
                                       <tr style="color:#000;font-weight:600;background-color:#96accd99;">
                                        <td style="color:#000;font-weight:600;background-color:#96accd99;">'.date('d-m-Y',strtotime($row->dt)).'</td>
                                       <td style="color:#000;font-weight:600;background-color:#96accd99;">'.$row->docNo.'</td>
                                        <td style="color:#000;font-weight:600;background-color:#96accd99;">'.$row->company_code.' '.$row->company_name.'</td>
                                       <td style="color:#000;font-weight:600;background-color:#96accd99;">'.$row->loc_code.' '.$row->location_name.'</td>

                                       <td style="color:#000;font-weight:600;background-color:#96accd99;">'.$row->iTypeNm.'</td>
                                       <td style="color:#000;font-weight:600;background-color:#96accd99;">'.$row->ref.'</td>
                                       <td style="color:#000;font-weight:600;background-color:#96accd99;">'.$row->notes.'</td>

                                       </tr>';  
                                    }
                                    else
                                    {  
                                        $html=$html.' 
                                       <tr style="color:#000;font-weight:600;background-color:#edd18361;">
                                        <td style="color:#000;font-weight:600;background-color:#edd18361;">'.date('d-m-Y',strtotime($row->dt)).'</td>
                                       <td style="color:#000;font-weight:600;background-color:#edd18361;">'.$row->docNo.'</td>
                                        <td style="color:#000;font-weight:600;background-color:#edd18361;">'.$row->company_code.' '.$row->company_name.'</td>
                                       <td style="color:#000;font-weight:600;background-color:#edd18361;">'.$row->loc_code.' '.$row->location_name.'</td>

                                       <td style="color:#000;font-weight:600;background-color:#edd18361;">'.$row->iTypeNm.'</td>
                                       <td style="color:#000;font-weight:600;background-color:#edd18361;">'.$row->ref.'</td>
                                       <td style="color:#000;font-weight:600;background-color:#edd18361;">'.$row->notes.'</td>

                                       </tr>';  
                                    }
								}
						  }
					  }
					}
					
					
		$html=$html.'</table>';
	
$html = $html.'</body>';


$html = $html.'</html>';
$mysql=null;
//echo $html."<Br>";
define('_MPDF_PATH','../');
include("../mpdf.php");
//include("/var/www/vhosts/darshanuniforms.com/pr.darshanuniforms.com/mpdf/mpdf.php");

$mpdf=new mPDF('c','A4','','',5,5,65,20,5,5);

//('defalt','A4','font-size','font-family','margin-left','margin-right','margin-top','margin-botm','mar-head','mar-foor','L/P') 
$mpdf->SetProtection(array('print'));
$mpdf->SetTitle("Stock Entry Register");
$mpdf->SetAuthor("");
$mpdf->SetWatermarkText("");
$mpdf->showWatermarkText = false;
$mpdf->watermark_font = 'DejaVuSansCondensed';
$mpdf->watermarkTextAlpha = 0.1;
$mpdf->SetDisplayMode('fullpage');
$mdf->setAutoBottonMargin = 'stretch';
$mdf->setAutoTopMargin = 'stretch';

$mpdf->WriteHTML($html);
ob_clean();
$mpdf->Output(); 
exit;
?>