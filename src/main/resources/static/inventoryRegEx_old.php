<?php

include("mysql.connect.php");

date_default_timezone_set('Asia/Calcutta');

$filename="invetoryRegEx_".date('d.m.Y H:i:s a').".xls";
$date=date('Y-m-d');


error_reporting(E_ALL);

ini_set('display_errors', TRUE);

ini_set('display_startup_errors', TRUE);

date_default_timezone_set('Asia/Calcutta');



if (PHP_SAPI == 'cli')

	die('This example should only be run from a Web Browser');



/** Include PHPExcel */

require_once dirname(__FILE__) . '/Classes/PHPExcel.php';





// Create new PHPExcel object

$objPHPExcel = new PHPExcel();



// Set document properties

$objPHPExcel->getProperties()->setCreator("RAR")

							 ->setLastModifiedBy("RAR")

							 ->setTitle("Office 2007 XLSX Test Document")

							 ->setSubject("Office 2007 XLSX Test Document")

							 ->setDescription("RAR document for Office 2007 XLSX, generated using PHP classes.")

							 ->setKeywords("office 2007 openxml php")

							 ->setCategory("RAR file");







// Add some data
// Add some data
$objPHPExcel->setActiveSheetIndex(0)
->setCellValue('A1', '')
->setCellValue('B1', '')
->setCellValue('C1', '')
->setCellValue('D1', 'Inventory Report of the Date : '.date('d-m-Y',strtotime($date)))
->setCellValue('E1', '')			 
->setCellValue('F1', '')
->setCellValue('G1', '');

$sql=0;

$objPHPExcel->setActiveSheetIndex(0)
->setCellValue('A2', '')
->setCellValue('B2', '')
->setCellValue('C2', '')
->setCellValue('D2', '')
->setCellValue('E2', '')			 
->setCellValue('F2', '')
->setCellValue('G2', '');			

$objPHPExcel->setActiveSheetIndex(0)
->setCellValue('A3', 'Date')
->setCellValue('B3', 'Doc. No')
->setCellValue('C3', 'Company')
->setCellValue('D3', 'Location')
->setCellValue('E3', 'Product Category')
->setCellValue('F3', 'Reference')			 
->setCellValue('G3', 'Notes');

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
//echo $str."<Br>";
//echo "<Br>";

$sql="SELECT a.ID,a.dt,a.compId,a.locId,a.iType,a.docNo,a.yr,a.yr2,b.company_code,b.company_name,c.loc_code,c.location_name,IF(a.iType='1','RAW MATERIAL','FINISHED GOODS') AS iTypeNm,ref,notes FROM inventory_tbl AS a LEFT JOIN company_tbl AS b ON a.compId=b.ID LEFT JOIN location_tbl AS c ON a.locId=c.ID WHERE a.sts!='2' AND b.sts!='2' AND c.sts!='2' ".$str." AND a.lsts='0' ORDER BY a.dt DESC";

$statement = $mysql->prepare($sql);
$statement->setFetchMode(PDO::FETCH_OBJ);
$statement->execute();
$i=4;


   set_time_limit(0);
   while($row1=$statement->fetch())
   {
	    $id=$row1->ID; 	    	
        $loc_id=$row1->locId;
        if($uRole=='admin' || $uiType=='3')
		{
			$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A'.$i, date('d-m-Y',strtotime($row1->dt)))
			->setCellValue('B'.$i, $row1->docNo)
			->setCellValue('C'.$i, $row1->company_code.' '.$row1->company_name)
			->setCellValue('D'.$i, $row1->location_name)
			->setCellValue('E'.$i, $row1->iTypeNm)
			->setCellValue('F'.$i, $row1->ref)
			->setCellValue('G'.$i, $row1->notes);	
			$i++;		
		}
	    else
		{
			$ql="SELECT locId FROM admin_usr_loc WHERE uid='$uId' AND sts='0'";
            //echo $ql."<Br>";
            $stl=$mysql->prepare($ql);
            $stl->execute();
            $cntl=$stl->rowCount();
            if($cntl>1)
			{
				while($rowl=$stl->fetch(PDO::FETCH_ASSOC))
                {
                  $ulcId=$rowl['locId'];
                  if($ulcId==$loc_id)
                  {
					$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A'.$i, date('d-m-Y',strtotime($row1->dt)))
					->setCellValue('B'.$i, $row1->docNo)
					->setCellValue('C'.$i, $row1->company_code.' '.$row1->company_name)
					->setCellValue('D'.$i, $row1->location_name)
					->setCellValue('E'.$i, $row1->iTypeNm)
					->setCellValue('F'.$i, $row1->ref)
					->setCellValue('G'.$i, $row1->notes);	
					$i++;  
				  }
                }
			}
			else
			{
				$rowl=$stl->fetch(PDO::FETCH_ASSOC);
				$ulcId=$rowl['locId'];
				if($ulcId==$loc_id)
				{
					$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A'.$i, date('d-m-Y',strtotime($row1->dt)))
					->setCellValue('B'.$i, $row1->docNo)
					->setCellValue('C'.$i, $row1->company_code.' '.$row1->company_name)
					->setCellValue('D'.$i, $row1->location_name)
					->setCellValue('E'.$i, $row1->iTypeNm)
					->setCellValue('F'.$i, $row1->ref)
					->setCellValue('G'.$i, $row1->notes);	
					$i++;
				}
			}
		}
   }
$mysql=null;
// Rename worksheet

$objPHPExcel->getActiveSheet()->setTitle('Stock Entry');
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
// Redirect output to a client's web browser (Excel5)

header('Content-Type: application/vnd.ms-excel');

header('Content-Disposition: attachment;filename="'.$filename.'"');

header('Cache-Control: max-age=0');

// If you're serving to IE 9, then the following may be needed

header('Cache-Control: max-age=1');



// If you're serving to IE over SSL, then the following may be needed

header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past

header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified

header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1

header ('Pragma: public'); // HTTP/1.0



$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

$objWriter->save('php://output');

exit;

?>