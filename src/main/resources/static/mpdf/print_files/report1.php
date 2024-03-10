<?php 
date_default_timezone_set('Asia/Calcutta');

//Marathi Solution url : https://stackoverflow.com/questions/51038440/how-to-use-hindi-fonts-in-mpdf-library//
ob_start();
include("mysql.connect.php");

define('_MPDF_PATH','../');
include("../mpdf.php");

$stylesheet = file_get_contents('css/style.css');
$html='
		<html>
		<head>
			
		</head>
<body>

<!--mpdf
			<htmlpageheader name="myheader">	';
	  //$html=$html."<b>".$memberNm."</b><br>";
			
$html=$html.' 
<p style="text-align:center"><span style="font-size:22px;color:red;text-align:center"><b>RM Report</b></span><br>
</p>

</htmlpageheader>';


$html = $html.'	<htmlpagefooter name="myfooter" >

<!--<div style="border-top: 1px solid #fff; font-size: 9pt; text-align: center; padding-top: 2mm; ">
Page {PAGENO} of {nb}
</div>-->

</htmlpagefooter>	

<sethtmlpageheader name="myheader" value="on" show-this-page="1" />
<sethtmlpagefooter name="myfooter" value="on" />
mpdf-->		';



$html=$html.'<div style="padding-left:40px;">
<table width="100%" class="gridtable " cellspacing="10px" cellpadding="10px">
 <thead>
               <tr style="background-color:#4e73df">   
               <th style="color:#fff;text-align:center">No</th>
               <th style="color:#fff;text-align:center">Date</th>
               <th style="color:#fff;text-align:center">Code</th>
               <th style="color:#fff;text-align:center">Item Code</th>
               <th style="color:#fff;text-align:center">Supplier</th>
               <th style="color:#fff;text-align:center">Price</th>
               </tr>
               </thead>';
$html=$html.'<tbody>';


					include("mysql.connection.php");
					$qry="SELECT a.*,b.s_nm FROM rm_master_history AS a LEFT JOIN supplier_tbl AS b ON a.supplier_code=b.supplier_code";
					
					$stmt=$mysql->prepare($qry);
					$stmt->setFetchMode(PDO::FETCH_ASSOC);
					$stmt->execute();
					$cnt=1;
					while($row=$stmt->fetch())
					{
						$html=$html."<tr>
						<td>".$cnt."</td>
						<td>".date('d-m-Y',strtotime($row['dt']))."</td>
						<td>".$row['code']."</td>
						<td>".$row['item_code']."</td>
						<td>".$row['supplier_code']."</td>
						<td align='center' style='background-color:#f4b80d61;color:#000'>".$row['price']."</td>
						
						<tr>";
						$cnt++;
					}	
					
$html=$html.'</tbody></table></div>';
?>
<script type="text/javascript" src="canvasjs.js"></script>

<?php
$html=$html.'<div id="chartContainer" style="height: 300px; width: auto;padding:10px;"></div>';	
?>
<script>

$(document).ready(function () {
            showGraph();
			
        });

 function showGraph()
        {		{
                /*var v=document.getElementById('txtitemcode').value;
				var v1=document.getElementById('txtsupplier').value;*/
				//alert(v);
			   /* if(v=='0')
				{
					v='-1';
				}*/
				var v='-1';
				var scriptUrl="RMchart_report.php?item_code="+v+'&suppliercode='+v1;
				//alert(scriptUrl);				
				$.post(scriptUrl,
                function (data2)
                {
					var chart = new CanvasJS.Chart("chartContainer", {
		
						
					  title:{
						text: "RM PRICE"
					  },
					  data: [//array of dataSeries
						{ //dataSeries object
				
						 /*** Change type "column" to "bar", "area", "line" or "pie" or "pie" doughnut***/
						 type: "line",						 
						 dataPoints:data2 
					   }]
					   });
				chart.render();
				});
            }
        }
</script>   
<?


	
		/*$html=$html.'<div style="padding:30px;"></div><div align="right"><table align="right" width="50%" cellpadding="6px" cellspacing="5px">
		<tr>
		<td></td>
		<td width="30%"><b>कामगारांची सही</b></td>
		<td></td>
		</tr>
		
			
		</table></div>';*/
$html = $html.'</body>

</html>';


$mysql=null;

$mpdf=new mPDF('utf-8', 'A4-L','','',5,5,40,5,5,5);
$mpdf->WriteHTML($stylesheet, 1);
//('defalt','A4','font-size','font-family','margin-left','margin-right','margin-top','margin-botm','mar-head','mar-foor','L/P') 
$mpdf->SetProtection(array('print'));
$mpdf->SetTitle("FPS BANK DETAILS REPORT");
$mpdf->SetAuthor("");
$mpdf->SetWatermarkText("");
$mpdf->showWatermarkText = false;
$mpdf->watermark_font = 'DejaVuSansCondensed';
$mpdf->watermarkTextAlpha = 0.1;
$mpdf->SetDisplayMode('fullpage');
$mpdf->setAutoBottonMargin = 'stretch';
$mpdf->setAutoTopMargin = 'stretch';

$mpdf->WriteHTML($html);
ob_end_clean();
$mpdf->Output(); 
exit;

?>		
