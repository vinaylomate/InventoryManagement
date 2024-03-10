<?php

include("mysql.connect.php");

date_default_timezone_set('Asia/Calcutta');

$filename="stockRegEx_".date('d.m.Y H:i:s a').".xls";
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
->setCellValue('D1', 'Stock Report of the Date : '.date('d-m-Y',strtotime($date)))
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
->setCellValue('A3', 'LOCATION')
->setCellValue('B3', 'FOCUS CODE')
->setCellValue('C3', 'SAGE CODE')
->setCellValue('D3', 'PRODUCT')
->setCellValue('E3', 'PRODUCT CATEGORY')
->setCellValue('F3', 'IN')		
->setCellValue('G3', 'OUT')			 
->setCellValue('H3', 'LOCK QUANTITY')
->setCellValue('I3', 'AVAILABLE STOCK')		
->setCellValue('J3', 'RE-ORDER QUANTITY')			 
->setCellValue('K3', 'RE-ORDER REQUIRED')
->setCellValue('L3', 'RACK')	;

include("mysql.connect.php");
$compId=$locId=$iType='0';
if(!empty($_GET['compId']))
$compId=$_GET['compId'];

if(!empty($_GET['locId']))
$locId=$_GET['locId'];

if(!empty($_GET['iType']))
$iType=$_GET['iType'];

//echo "<Br>".$compId." : ".$iType." : ".$locId."<Br>";

$str="";

if($compId!='0' && $iType!='0' && $locId!='0')
{
	$str=$str." AND a.compId='$compId' AND a.iType='$iType' AND a.locId='$locId' ";
}
if($compId!='0' && $iType!='0' && $locId=='0')
{
	$str=$str." AND a.compId='$compId' AND a.iType='$iType' ";
}
else if($compId!='0' && $iType=='0' && $locId!='0')
{
	$str=$str." AND a.compId='$compId' AND a.locId='$locId' ";
}
else if($compId!='0' && $iType=='0' && $locId=='0')
{
	$str=$str." AND a.compId='$compId' ";
}
else if($compId=='0' && $iType!='0' && $locId!='0')
{
	$str=$str." a.locId='$locId' AND a.iType='$iType' ";
}
else if($compId=='0' && $iType=='0' && $locId!='0')
{
	$str=$str." a.locId='$locId' ";
}
else if($compId=='0' && $iType!='0' && $locId=='0')
{
	$str=$str." a.iType='$iType' ";
}		
										
$sql="SELECT a.ID,a.iType,IF(a.iType='1','RAW MATERIAL','FINISHED GOODS') AS iTypeNm,IF(a.iType='1',r.focus_code,f.focus_code) AS focus_code,IF(a.iType='1',r.sage_code,f.sage_code) AS sage_code,IF(a.iType='1',CONCAT(rg.category_nm,' - ',r.description,' - ',ru.uom),CONCAT(fgg.category_nm,' - ',f.brand,' ',f.descc,' - ',fu.uom)) AS desp,'0' AS openstk,a.in_qty AS IN_Qty,a.out_qty AS OUT_Qty,a.lock_qty AS Lock_Qty,a.stk_qty AS Closestk,IF(a.iType='1',r.rackNo,f.rackNo) AS rack,IF(a.iType='1',r.reorder_level_qty,f.reorder_level_qty) rorder,CONCAT(l.loc_code,' - ',l.location_name)AS locNm FROM stock_tbl AS a LEFT JOIN company_tbl AS c ON a.compId=c.ID LEFT JOIN location_tbl AS l ON a.locId=l.ID LEFT JOIN rm_master AS r ON a.itemId=r.rmId LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID LEFT JOIN fg_master AS f ON a.itemId=f.fgId LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID LEFT JOIN category_master AS rg ON r.catId=rg.catId LEFT JOIN category_master AS fgg ON f.category_id=fgg.catId WHERE a.sts!='2' AND IF(a.iType='1',r.sts!='2',f.sts!='2') ".$str." ORDER BY a.ID";
//echo $sql."<Br>";
$statement = $mysql->prepare($sql);
$statement->setFetchMode(PDO::FETCH_OBJ);
$statement->execute();
$i=4;


   set_time_limit(0);
   $a=$b=$c=$d=0;
   while($row1=$statement->fetch())
   {
	    //$id=$row1->ID;   
	   $rsts="No";
	   if($row1->Closestk<$row1->rorder)
	   {
		   $rsts="Yes";
	   }
	    $a=$a+$row1->IN_Qty;
	    $b=$b+$row1->OUT_Qty;  
	    $c=$c+$row1->Lock_Qty;
	    $d=$d+$row1->Closestk;
	   
		$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('A'.$i, $row1->locNm)
		->setCellValue('B'.$i, $row1->focus_code)
		->setCellValue('C'.$i, $row1->sage_code)
		->setCellValue('D'.$i, $row1->desp)
		->setCellValue('E'.$i, $row1->iTypeNm)
		->setCellValue('F'.$i, $row1->IN_Qty)
		->setCellValue('G'.$i, $row1->OUT_Qty)
		->setCellValue('H'.$i, $row1->Lock_Qty)
		->setCellValue('I'.$i, $row1->Closestk)
		->setCellValue('J'.$i, $row1->rorder)
		->setCellValue('K'.$i, $rsts)
		->setCellValue('L'.$i, $row1->rack);	
	   $i++;		
   }
$mysql=null;

$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('A'.$i, "")
		->setCellValue('B'.$i, "")
		->setCellValue('C'.$i, "")
		->setCellValue('D'.$i, "")
		->setCellValue('E'.$i, "Total")
		->setCellValue('F'.$i, $a)
		->setCellValue('G'.$i, $b)
		->setCellValue('H'.$i, $c)
		->setCellValue('I'.$i, $d)
		->setCellValue('J'.$i, "")
		->setCellValue('K'.$i, "")
		->setCellValue('L'.$i, "");
// Rename worksheet

$objPHPExcel->getActiveSheet()->setTitle('Stock Report');
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