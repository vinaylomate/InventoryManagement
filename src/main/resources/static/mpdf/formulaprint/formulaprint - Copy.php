<?php ob_start();
date_default_timezone_set('Asia/Calcutta');
include("mysql.connection.php");
$Id=$_GET['ID'];
$qry="SELECT a.*,b.item_code,c.c_nm FROM formula_tbl AS a LEFT JOIN fg_master AS b ON a.code_fg=b.fgId LEFT JOIN cust_tbl AS c ON a.custname=c.customer_code WHERE a.fId='$Id' AND a.sts='0' AND b.sts='0'";
$st=$mysql->prepare($qry);
$st->execute();
$row=$st->fetch(PDO::FETCH_ASSOC);
$dt=$row['dt'];
$code_fg=$row['item_code'];
$descc=$row['descc'];
$serialno=$row['serialno'];
$batch_no=$row['batch_no'];
$sgvalue=$row['sg_tot'];
$custname=$row['custname']."-".$row['c_nm'];
$category=$row['category'];
$batch_size=$row['batch_size'];
$final_sg_cost=$row['fg_finalcost'];
$theoretical_sg=$row['theoretical_sg'];

define('_MPDF_PATH','../');
include("../mpdf.php");
$stylesheet = file_get_contents('css/style.css');
$html='<html>
<head>
<style>
table.gridtable {
	font-family: verdana,arial,sans-serif;
	font-size:14px;
	color:#333333;
	border-width: 1px;
	border-color: #cdcdcd;
	border-collapse: collapse;
}
table.gridtable th {
	border-width: 1px;
	padding: 2px;
	border-style: solid;
	border-color: #cdcdcd;
	background-color: #0942e6;
}
table.gridtable td {
	border-width: 1px;
	padding: 2px;
	border-style: solid;
	border-color: #cdcdcd;
	background-color: #ffffff;
}

//Gridtable 2
table.gridtable2 {
	font-family: verdana,arial,sans-serif;
	
	color:#333333;
	border-width: 1px;
	border-color: #cdcdcd;
	border-collapse: collapse;
}
table.gridtable2 th {
	border-width: 1px;
	font-size:10px;
	padding: 2px;
	border-style: solid;
	border-color: #cdcdcd;
	background-color: #99bfe6;
}
table.gridtable2 td {
	font-size:11px;
	border-width: 1px;
	padding: 2px;
	border-style: solid;
	border-color: #cdcdcd;
	background-color: #ffffff;
}
//GridTable3

table.simTable {
    border-collapse: collapse;
}

table.simTable td {
    border: 1px solid black;
	padding:3px;
}

table.simTable th {
    border: 1px solid black;
	padding:3px;
}

table.simTable2 {
    border-collapse: collapse;
}

table.simTable2 td {
    border: 0px solid black;
	padding:3px;
}

table.simTable2 th {
    border: 0px solid black;
	padding:3px;
}
</style>
</head>
<body>
<!--mpdf
<htmlpageheader name="myheader">	';
$html=$html.' <p align="center" ><img src="logo1.jpg" style="height:180px;width:100%"></p>
<hr><br>
<table width="100%" cellpadding="3px" cellspacing="3px">';
$html=$html.'<tr>
<td width="33%"><b>Parent Code FG : </b><span style="font-size:15px;">';
$html=$html.$code_fg;
$html=$html.'</span></td>
<td width="40%" valign="top"><b>Serial No :  </b><span style="font-size:15px;margin-left:5px;">'.$serialno.'</span></td>
<td width="30%"><b>Date :</b><span style="font-size:15px;">'.date('d.m.Y',strtotime($dt)).'</span></td>
</tr>';

$html=$html.'<tr>
<td width="33%"><b>Description : </b><span style="font-size:15px;">';
$html=$html.$descc;
$html=$html.'</span></td>
<td width="50%" valign="top"><b>Batch No :  </b><span style="font-size:15px;margin-left:5px;">'.$batch_no.'</span></td>
<td width="33%"><b>Customer :</b><span style="font-size:15px;">'.$custname.'</span></td>
</tr>';

$html=$html.'<tr>
<td width="33%"><b>Batch Size : </b><span style="font-size:15px;">';
$html=$html.$batch_size;
$html=$html.'</span></td>
<td width="50%" valign="top"><b>Category :  </b><span style="font-size:15px;margin-left:5px;">'.$category.'</span></td>
<td width="33%"><b></b><span style="font-size:15px;"></span></td>
</tr>';

$html=$html.'</table>
</htmlpageheader>';
$html = $html.'	<htmlpagefooter name="myfooter" >

 					<!--<div style="border-top: 1px solid #fff; font-size: 9pt; text-align: center; padding-top: 2mm; ">
					Page {PAGENO} of {nb}
					</div>-->

				</htmlpagefooter>	
				
					<sethtmlpageheader name="myheader" value="on" show-this-page="1" />
					<sethtmlpagefooter name="myfooter" value="on" />
mpdf-->		';

$html=$html.'<div style="margin-top:25px">
              <table class="gridtable" id="dataTable" width="100%" cellspacing="0">
                <tr id="aa" style="background-color:#5377e0">
                <th style="color:#FFF">No</th>
                <th style="color:#FFF">RM Code</th>
                <th style="color:#FFF">Item</th>
                <th style="color:#FFF">Qty</th>
                <th style="color:#FFF">S.G</th>
                <th style="color:#FFF">Volume</th>
                <th style="color:#FFF">Rate</th>
                <th style="color:#FFF">Cost</th>
                <th style="color:#FFF">Stnd 100</th>
                </tr>';
                
                $qq="SELECT * FROM formula_first_tbl WHERE lastid='$Id' AND sts='0'";
				$stm=$mysql->prepare($qq);
				$stm->execute();
				
				$cnt=1;
				$tot=0;
				$voltot=0;
				$tot2=0;
				$tot3=0;
				$tot4=0;
				while($rw=$stm->fetch(PDO::FETCH_ASSOC))
				{
					$html=$html. '<tr>';
					$html=$html. '<td style="background-color:#a2c4f7c2;color:#000">'.$cnt.'</td>';
					$html=$html. '<td style="background-color:#a2c4f7c2;color:#000">'.$rw['item'].'</td>';
					$html=$html. '<td style="background-color:#ffe69ee8;color:#000">'.$rw['rm_code'].'</td>';
					$html=$html. '<td style="background-color:#a2c4f7c2;color:#000">'.$rw['qty'].'</td>';
					$html=$html. '<td style="background-color:#a2c4f7c2;color:#000">'.$rw['specific_gravity'].'</td>';
					$html=$html. '<td style="background-color:#a2c4f7c2;color:#000">'.$rw['volume'].'</td>';
					$html=$html. '<td style="background-color:#a2c4f7c2;color:#000">'.$rw['rate'].'</td>';
					$html=$html. '<td style="background-color:#a2c4f7c2;color:#000">'.$rw['cost'].'</td>';
					$html=$html. '<td style="background-color:#ffe69ee8;color:#000">'.$rw['stand'].'</td>';
					$html=$html. '</tr>';
					$tot=$tot+$rw['qty'];
					$voltot=$voltot+$rw['volume'];
					$tot2=$tot2+$rw['rate'];
					$tot3=$tot3+$rw['cost'];
					$tot4=$tot4+$rw['stand'];
					$cnt++;
				}				
                $html=$html.'<tfoot><tr>
                <th style="background-color:#fff;"></th>
                <th style="background-color:#fff;"></th>
                <th style="background-color:#fff;color:#F00;text-align:right">Total </th>
                <th style="background-color:#fff;color:#F00">'.$tot.'</th>
                <th style="background-color:#fff;color:#F00">'.$sgvalue.'</th>
                <th style="background-color:#fff;color:#F00">'.$voltot.'</th>
                <th style="background-color:#fff;color:#F00">'.$tot2.'</th>
                <th style="background-color:#fff;color:#F00">'.$tot3.'</th>
                <th style="background-color:#fff;color:#F00">'.$tot4.'</th>
                </tr>
                </tfoot>
                </table>';
                $html=$html.'<div style="margin-top:10px">
                <label style="font-weight:700">FG Final Cost/Kg : <span style="color:#f00">'.$final_sg_cost.'</span></span></label>
                </div>';

                $html=$html.'<div style="margin-top:5px">                
                <table class="gridtable" id="dataTable1" width="100%" cellspacing="0" style="margin-top:25px">
                
                <thead>
                <tr style="background-color:#5377e0">
                <th style="color:#FFF">No</th>
                <th style="color:#FFF">Capacity</th>
                <th style="color:#FFF">UOM</th>
                <th style="color:#FFF">Weight in KG</th>
                <th style="color:#FFF">Material Cost</th>
                <th style="color:#FFF">Drum Capacity</th>
                <th style="color:#FFF">Drum Cost</th>
                <th style="color:#FFF">Cost</th>
                <th style="color:#FFF">Overhead</th>
                <th style="color:#FFF">Sales Price</th>
                </tr>
                </thead>';

				$q="SELECT a.*,b.drum_cap FROM formula_second_tbl AS a LEFT JOIN drum_master AS b ON a.drum_capacity=b.dId WHERE a.lastId='$Id' AND a.sts='0'";
				//echo $q."<br>";
				$s=$mysql->prepare($q);
				$s->execute();
				$count=1;
				while($r=$s->fetch(PDO::FETCH_ASSOC))
				{
					$html=$html. '<tr>';
					$html=$html. '<td style="background-color:#a2c4f7c2;color:#000">'.$count.'</td>';
					$html=$html. '<td style="background-color:#ffe69ee8;color:#000">'.$r['capacity'].'</td>';
					$html=$html. '<td style="background-color:#a2c4f7c2;color:#000">'.$r['UOM'].'</td>';
					$html=$html. '<td style="background-color:#a2c4f7c2;color:#000">'.$r['weight_kg'].'</td>';
					$html=$html. '<td style="background-color:#a2c4f7c2;color:#000">'.$r['material_cost'].'</td>';
					$html=$html. '<td style="background-color:#a2c4f7c2;color:#000">'.$r['drum_cap'].'</td>';
					$html=$html. '<td style="background-color:#a2c4f7c2;color:#000">'.$r['drum_cost'].'</td>';
					$html=$html. '<td style="background-color:#a2c4f7c2;color:#000">'.$r['cost'].'</td>';
					$html=$html. '<td style="background-color:#ffe69ee8;color:#000">'.$r['overhead'].'</td>';
					$html=$html. '<td style="background-color:#a2c4f7c2;color:#000">'.$r['sale_price'].'</td>';
					$html=$html. '</tr>';
					$count++;
				}
				$mysql=null;
                $html=$html.'</table>
                </div>';	
                $html=$html.'</div>';
                
$html = $html.'</body>

</html>';
$mysql=null;
if($cnt<5)
{
    $mpdf=new mPDF('utf-8', 'A4-C','','',10,10,100,10,10,10);
}
else
{
    $mpdf=new mPDF('utf-8', 'A4-C','','',8,8,95,10,8,8);
}
$mpdf->WriteHTML($stylesheet, 1);
//('defalt','A4','font-size','font-family','margin-left','margin-right','margin-top','margin-botm','mar-head','mar-foor','L/P') 
$mpdf->SetProtection(array('print'));
$mpdf->SetTitle("Formula Printing - $serialno");
$mpdf->SetAuthor("");
$mpdf->SetWatermarkText("");
$mpdf->showWatermarkText = false;
$mpdf->watermark_font = 'DejaVuSansCondensed';
$mpdf->watermarkTextAlpha = 0.1;
$mpdf->SetDisplayMode('fullpage');
$mdf->setAutoBottonMargin = 'stretch';
$mdf->setAutoTopMargin = 'stretch';

$mpdf->WriteHTML($html);
ob_end_clean();
$mpdf->Output(); 
exit;
?>	