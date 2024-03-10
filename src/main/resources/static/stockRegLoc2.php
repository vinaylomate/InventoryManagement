<?php include('log_check.php');

$cmpId=$_SESSION['cmpId'];

$uiType=$_SESSION['iType'];

$userId=$_SESSION['uId'];

$uRole=$_SESSION['uRole'];

$uloc=$_SESSION['loc'];

$ulocType=$_SESSION['locType'];

//echo $cmpId."<Br>";

?>

<!DOCTYPE html>

<html lang="en">



<head>

 <?php  include("inc/meta.php"); ?>

<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

<link rel="stylesheet" href="selectcss/chosen.css">

 <style type="text/css" media="all">
/* fix rtl for demo */
.chosen-rtl .chosen-drop 
{ 
	left: -9000px;

	z-index: 1010;
}
.pagination-content{
 width:60%;
 text-align: justify;
 padding:10px;
}
	
.pagination{
 padding:10px;
}
.pagination b{
 text-decoration: none;
 padding: 5px 10px;
 box-shadow: 0px 0px 10px #0000001c;
 background: white;
 margin: 3px;
 color: #1f1e1e;
} 
	
.pagination b.active{
 background: #b02923;
 color: white;
} 
	
.pagination a.active{
 background: #f77404;
 color: white;
} 
	
.pagination a{
 text-decoration: none;
 padding: 5px 10px;
 box-shadow: 0px 0px 10px #0000001c;
 background: white;
 margin: 3px;
 color: #1f1e1e;
}
</style>

<script>

function getCategory()	

{

  //alert('hey chiru...CAT');

  if(document.getElementById('iType').value=='0')

  {

	 //alert('Plz, Select Product Category..!'); 

	 document.getElementById('iType').focus();

  }

  else	

  {

      var iType = document.getElementById('iType').value;

	  var scriptUrl ='getCategory.php?iType='+iType;

	  //alert(scriptUrl);

      $.ajax({url:scriptUrl,success:function(result)

      {	

	  	 //alert(result);

         //document.getElementById('location').innerHTML=result; 

		  $("#catId").html(result).trigger("chosen:updated.chosen");

      }}); 

  }

}

function dataReset()

{

	window.location.href='stockRegLoc2.php';

}	

 function view(id)

{

		//alert('hi');

	window.open("getinventoryview.php?ID="+id, "_blank", "toolbar=yes, scrollbars=yes, resizable=no, top=60, left=0, width=1000, height=600");

}

	

function getexcel()

{

	var compId,iType,catId,srch;

	if(document.getElementById('compId').value=='0')

	{

		compId="0";

	}

 	else

    {

		compId=document.getElementById('compId').value;

	}

 

 	if(document.getElementById('iType').value=='0')

	{

		iType="0";

	}

 	else

    {

		iType=document.getElementById('iType').value;

	}

	

	if(document.getElementById('catId').value=='0')

	{

		catId="0";

	}

 	else

    {

		catId=document.getElementById('catId').value;

	}

		

	if(document.getElementById('txtsearch').value=='')

	{

	  srch	='0';

	}

	else

	{

	  srch=document.getElementById('txtsearch').value;	

	}

 	

 	var uId=document.getElementById('uid').value;

	var uType=document.getElementById('uiType').value;

	var uRole=document.getElementById('urole').value;

 

 	var scriptUrl='stockRegLoc2Ex.php?compId='+compId+'&iType='+iType+'&uId='+uId+'&uiType='+uType+'&role='+uRole+'&srch='+srch+'&catId='+catId;

	//alert(scriptUrl);

 	//dataTable

 	window.open(scriptUrl, "toolbar=yes, scrollbars=yes, resizable=no, top=60, left=0, width=1000, height=600");

}	

	

function getpdf()

{

	var compId,iType,catId,srch;

	if(document.getElementById('compId').value=='0')

	{

		compId="0";

	}

 	else

    {

		compId=document.getElementById('compId').value;

	}

 

 	if(document.getElementById('iType').value=='0')

	{

		iType="0";

	}

 	else

    {

		iType=document.getElementById('iType').value;

	}

	

	if(document.getElementById('catId').value=='0')

	{

		catId="0";

	}

 	else

    {

		catId=document.getElementById('catId').value;

	}

		

	if(document.getElementById('txtsearch').value=='')

	{

	  srch	='0';

	}

	else

	{

	  srch=document.getElementById('txtsearch').value;	

	}

 	

 	var uId=document.getElementById('uid').value;

	var uType=document.getElementById('uiType').value;

	var uRole=document.getElementById('urole').value;

 	var scriptUrl='mpdf/print_files/stklock2_pdf.php?compId='+compId+'&iType='+iType+'&uId='+uId+'&uiType='+uType+'&role='+uRole+'&srch='+srch+'&catId='+catId;

	//alert(scriptUrl);

 	//dataTable

 	window.open(scriptUrl,  "toolbar=yes, scrollbars=yes, resizable=no, top=60, left=0, width=1000, height=600");

}		

</script>

</head>



<body id="page-top" onLoad="getCategory()">

<!-- Page Wrapper -->

<div id="wrapper">



<!-- Sidebar -->

<?php

include("inc/menu.php");

?>

<!-- End of Sidebar -->



<!-- Content Wrapper -->

<div id="content-wrapper" class="d-flex flex-column">



<!-- Main Content -->

<div id="content">



<!-- Topbar -->

<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">



<!-- Sidebar Toggle (Topbar) -->

<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">

<i class="fa fa-bars"></i>          </button>



<!-- Topbar Search -->





<!-- Topbar Navbar -->

<ul class="navbar-nav ml-auto">



<!-- Nav Item - Search Dropdown (Visible Only XS) -->





<!-- Nav Item - Alerts -->





<!-- Nav Item - Messages -->





<div class="topbar-divider d-none d-sm-block"></div>



<!-- Nav Item - User Information -->

<?php include('inc/header.php');?>

</ul>

</nav>

<!-- End of Topbar -->



<!-- Begin Page Content -->

<div class="container-fluid">



<!-- Page Heading -->

<div class="align-items-center justify-content-between mb-2" style="background-color:#3c8dbc;border-radius:5px;" align="center">

<h1 class="h3 mb-0 text-gray-801" style="padding-bottom: 5px;">Stock Report - Location Wise(FG)</h1>   

</div>

<input type="hidden" id="uid" name="uid" value="<?php echo $userId?>">

<input type="hidden" id="urole" name="urole" value="<?php echo $uRole;?>">

<input type="hidden" id="uiType" name="uiType" value="<?php echo $uiType;?>">

<input type="hidden" id="uloc" name="uloc" value="<?php echo $uloc;?>">	

<input type="hidden" id="ulocty" name="ulocty" value="<?php echo $ulocType;?>">

<!-- DataTales Example -->

<div class="card shadow mb-4">

<!--<div class="card-header py-3">

<h6 class="m-0 font-weight-bold text-primary">Inventory Register</h6>

</div>-->

<div class="card-body">

<div class="row">          

<div class="col-lg-12">

<div class="p-2">             

<table cellpadding="5px">

<tr>

<td valign="top"><label class="m-0 font-weight-bold text-primary">Company</label></td>	

<td valign="top">:</td>	

<td valign="top">

<select class="chosen-select form-control form-control-sm" id="compId" name="compId" tabindex="1" style="width:250px;" onChange="getdata();">

<?php

include("mysql.connect.php");

if($cmpId=='0')

{

	$q="SELECT ID,CONCAT(company_code,' - ', company_name) AS company_name FROM company_tbl WHERE sts='0'";

	echo '<option value="0">Select</option>';

}

else

{

	$q="SELECT ID,CONCAT(company_code,' - ', company_name) AS company_name FROM company_tbl WHERE sts='0' AND ID='$cmpId'";

}

$s=$mysql->prepare($q);

$s->setFetchMode(PDO::FETCH_ASSOC);

$s->execute();

while($r=$s->fetch())

{

  echo "<option value=".$r['ID'].">".$r['company_name']."</option>";

}

$mysql=null;

?>

</select>

</td>		



<td valign="top"><label class="m-0 font-weight-bold text-primary">Product Category</label></td>	

<td valign="top">:</td>	

<td valign="top">

<select class="chosen-select form-control form-control-sm" id="iType" name="iType" tabindex="2"  onChange="getCategory();getdata();" style="width:250px;" required>

<option value="2">FINISHED GOODS</option>

</select>

</td>	

	

<td valign="top"><label class="m-0 font-weight-bold text-primary">Category</label></td>	

<td valign="top">:</td>	

<td valign="top">

<select class="chosen-select form-control form-control-sm" id="catId" name="catId" tabindex="3" style="width:250px;" onChange="getdata();">

<option value="0">Select</option>	

</select>

</td>		

</tr>	

	

<tr>

<td valign="top"><label class="m-0 font-weight-bold text-primary">Search</label></td>	

<td valign="top">:</td>	

<td valign="top"><input type="text" id="txtsearch" name="txtsearch" class="form-control" tabindex="3.1" placeholder="Type keywords..." onkeyup="getdata();" style="width: 250px;"></td>		



<td valign="top"><!--<input type="button" id="btnsearch" name="btnsearch" class="btn btn-primary" onClick="searchFilter();" tabindex="5.2" value="Search">--></td>	

<td valign="top"></td>	

<td valign="top"></td>	

	

<td valign="top"></td>	

<td valign="top"></td>	

<td valign="top"></td>		

</tr>

</table>

</div>

</div>

</div>



<div align="right">

<input type="button" id="btnReset" name="btnReset" class="btn btn-warning" onClick="dataReset();" tabindex="4.3" value="Reset">	

<a href="javascript:getexcel();"><img src="img/EXCELIMG1.png" alt="download" title="download" style="width:50px; height:50px"></a>

<a href="javascript:getpdf();"><img src="img/pdf.png" alt="download" title="download" style="width:50px; height:50px"></a>

</div>				

<?php 
include('shripage1.php'); 
include('mysql.connect.php');

$baseURL = 'getStockRegLoc2.php'; 
$limit = 100;

if($uRole=='admin' && ($uiType=='3'||$uiType=='0'))
{
	$qq="SELECT f.focus_code,f.sage_code,CONCAT(f.descc,' - ',fu.uom) AS desp FROM stock_tbl AS a LEFT JOIN company_tbl AS c ON a.compId=c.ID LEFT JOIN location_tbl AS l ON a.locId=l.ID LEFT JOIN fg_master AS f ON a.itemId=f.fgId LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID LEFT JOIN category_master AS fg ON f.category_id=fg.catId WHERE a.sts!='2' AND f.sts!='2' AND a.iType='2' GROUP BY f.focus_code,f.sage_code,f.descc,fu.uom ORDER BY SUBSTRING(f.focus_code,1,9), SUBSTRING(f.focus_code,10)*1 LIMIT $limit ";

	$qqq="SELECT f.focus_code FROM stock_tbl AS a LEFT JOIN company_tbl AS c ON a.compId=c.ID LEFT JOIN location_tbl AS l ON a.locId=l.ID LEFT JOIN fg_master AS f ON a.itemId=f.fgId LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID LEFT JOIN category_master AS fg ON f.category_id=fg.catId WHERE a.sts!='2' AND f.sts!='2' AND a.iType='2' GROUP BY f.focus_code,f.sage_code,f.descc,fu.uom ORDER BY SUBSTRING(f.focus_code,1,9), SUBSTRING(f.focus_code,10)*1";	
}
else
{
	$qq="SELECT f.focus_code,f.sage_code,CONCAT(f.descc,' - ',fu.uom) AS desp FROM stock_tbl AS a LEFT JOIN company_tbl AS c ON a.compId=c.ID LEFT JOIN location_tbl AS l ON a.locId=l.ID LEFT JOIN fg_master AS f ON a.itemId=f.fgId LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID LEFT JOIN category_master AS fg ON f.category_id=fg.catId LEFT JOIN admin_usr_loc AS us ON l.ID=us.locId WHERE a.sts!='2' AND f.sts!='2' AND a.compId='$cmpId' AND us.uid='$userId' AND a.iType='2' GROUP BY f.focus_code,f.sage_code,f.descc,fu.uom ORDER BY SUBSTRING(f.focus_code,1,9), SUBSTRING(f.focus_code,10)*1 LIMIT $limit ";

	$qqq="SELECT f.focus_code FROM stock_tbl AS a LEFT JOIN company_tbl AS c ON a.compId=c.ID LEFT JOIN location_tbl AS l ON a.locId=l.ID LEFT JOIN fg_master AS f ON a.itemId=f.fgId LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID LEFT JOIN category_master AS fg ON f.category_id=fg.catId LEFT JOIN admin_usr_loc AS us ON l.ID=us.locId WHERE a.sts!='2' AND f.sts!='2' AND a.compId='$cmpId' AND us.uid='$userId' AND a.iType='2' GROUP BY f.focus_code,f.sage_code,f.descc,fu.uom ORDER BY SUBSTRING(f.focus_code,1,9), SUBSTRING(f.focus_code,10)*1";
}
//echo $qq.'<br>';
$query1   = $mysql->prepare($qqq); 
$query1->execute();
//$result1  = $query1->fetch(PDO::FETCH_ASSOC);
//$rowCount= $result1['rowNum']; 	
$rowCount = $query1->rowCount();	
$query=$mysql->prepare($qq);
$query->execute();	
$paginationData=$query->fetchAll();	
// Initialize pagination class 
if($uRole=='admin' && ($uiType=='3' || $uiType=='0'))
{
	$pagConfig = array( 
		'baseURL'=> $baseURL, 
		'totalRows'=> $rowCount, 
		'perPage'=> $limit, 
		'contentDiv'=> 'tbl', 
		'link_func'=> '',
		'keywords'=> '',
		'uiType'=> $uiType,
		'uRole'=> $uRole,
		'uId'=> $_SESSION['uId'],
		'srch'=> '',
		'sType'=> '0'
	); 
}
else
{
	$adparams=$cmpId."||".$uloc."||".$uiType."||0||0";
	
	$pagConfig = array( 
		'baseURL'=> $baseURL, 
		'totalRows'=> $rowCount, 
		'perPage'=> $limit, 
		'contentDiv'=> 'tbl', 
		'link_func'=> '',
		'keywords'=> '',
		'uiType'=> $uiType,
		'uRole'=> $uRole,
		'uId'=> $_SESSION['uId'],
		'srch'=> $adparams,
		'sType'=> '1'
	); 
} 
$pagination =  new Pagination($pagConfig);
?>



<div class="table-responsive">

<div id="tbl">

<div>    
<?php echo $pagination->createLinks(); ?>
</div>		

<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

<thead>

<tr style="background-color:#b02923">

<th style="color:#fff;">Focus Code</th>

<th style="color:#fff">Sage Code</th>

<th style="color:#fff;">Product</th>

<?php
if($cmpId!='0')
{
	$ql="SELECT ID,loc_code,location_name FROM location_tbl WHERE sts!='2' AND company_id='$cmpId' AND iType='2' ORDER BY loc_code";	
}
else
{
	$ql="SELECT ID,loc_code,location_name FROM location_tbl WHERE sts!='2' AND iType='2' ORDER BY loc_code";	
}
	

$stl=$mysql->prepare($ql);

$stl->execute();

$loc=array();

$l=0;

while($row1=$stl->fetch(PDO::FETCH_ASSOC))

{

$loc[$l]=$row1['ID'];

?>

<th style="color:#fff">

<?php echo $row1['loc_code']." - ".$row1['location_name'];?>

</th>

<?php

$l++;

}

?>

<th style="color:#fff;">Total</th>

</tr>

</thead>

<tbody>

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

	$qqq="SELECT f.focus_code,f.sage_code,f.descc,fu.uom,SUM(a.stk_qty) AS stk FROM stock_tbl AS a LEFT JOIN fg_master AS f ON a.itemId=f.fgId LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID WHERE a.sts!='2' AND f.sts!='2' AND a.iType='2' AND f.focus_code='".$row['focus_code']."' AND f.sage_code='".$row['sage_code']."' AND a.locId='$loc[$i]' GROUP BY f.focus_code,f.sage_code,f.descc,fu.uom";

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

</tbody>	  

<tfoot>

<tr style="background-color:#b02923">

<th style="color:#fff;"></th>

<th style="color:#fff"></th>

<th style="color:#fff;"></th>

<?php


if($cmpId!='0')
{
	$ql="SELECT ID,loc_code,location_name FROM location_tbl WHERE sts!='2' AND company_id='$cmpId' AND iType='2' ORDER BY loc_code";	
}
else
{
	$ql="SELECT ID,loc_code,location_name FROM location_tbl WHERE sts!='2' AND iType='2' ORDER BY loc_code";	
}	

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

?>

<th style="color:#fff;"><?php echo $a;?></th>

</tr> 

</tfoot>



</table>

</div>		    

</div>

</div>

</div>



</div>

<!-- /.container-fluid -->



</div>

<!-- End of Main Content -->



<!-- Footer -->

<?php



include("inc/footer.php");



?>

<!-- End of Footer -->



</div>

<!-- End of Content Wrapper -->



</div>

<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->

<a class="scroll-to-top rounded" href="#page-top">

<i class="fas fa-angle-up"></i>

</a>

<!-- Logout Modal-->  <!-- Bootstrap core JavaScript-->

<script src="vendor/jquery/jquery.min.js"></script>

<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>



<!-- Core plugin JavaScript-->

<script src="vendor/jquery-easing/jquery.easing.min.js"></script>



<!-- Custom scripts for all pages-->

<script src="js/sb-admin-2.min.js"></script>



<!-- Page level plugins -->

<script src="vendor/chart.js/Chart.min.js"></script>



<!-- Page level custom scripts -->

<script src="js/demo/chart-area-demo.js"></script>

<script src="js/demo/chart-pie-demo.js"></script>

<!-- Page level plugins -->

<!--<script src="vendor/datatables/jquery.dataTables.min.js"></script>

<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>



<script src="js/demo/datatables-demo.js"></script>-->



<script src="selectjs/chosen.jquery.js" type="text/javascript"></script>

<script src="selectjs/docsupport/prism.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript">

var config = {

'.chosen-select'           : {},

'.chosen-select-deselect'  : {allow_single_deselect:true},

'.chosen-select-no-single' : {disable_search_threshold:10},

'.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},

'.chosen-select-width'     : {width:"95%"}

}

for (var selector in config) {

$(selector).chosen(config[selector]);

}

	
function getdata()
{
	var page_num = page_num?page_num:0;
	var compId,iType,catId,srch;

	if(document.getElementById('compId').value=='0')

	{

		compId="0";

	}

 	else

    {

		compId=document.getElementById('compId').value;

	}

 

 	if(document.getElementById('iType').value=='0')

	{

		iType="0";

	}

 	else

    {

		iType=document.getElementById('iType').value;

	}

	

	if(document.getElementById('catId').value=='0')

	{

		catId="0";

	}

 	else

    {

		catId=document.getElementById('catId').value;

	} 	

 	var uId=document.getElementById('uid').value;

	var uType=document.getElementById('uiType').value;

	var uRole=document.getElementById('urole').value;
	var uloc= document.getElementById('uloc').value;
	
    var keywords = $('#txtsearch').val();
    var filterBy = $('#filterBy').val();
	//alert(urole);
		$.ajax({
			type: 'POST',
			url: 'getStockRegLoc2.php',
			data:'page='+page_num+'&keywords='+keywords+'&filterBy='+filterBy+'&compId='+compId+'&iType='+iType+'&uId='+uId+'&uiType='+uType+'&urole='+uRole+'&uloc='+uloc+'&catId='+catId+'&sType=0',
			beforeSend: function () {
			},
			success: function (html) {
				//alert(html);
				$('#tbl').html(html);
			}
		});
 	/*var scriptUrl='getStockRegLoc2.php?compId='+compId+'&iType='+iType+'&uId='+uId+'&uiType='+uType+'&role='+uRole+'&srch='+srch+'&catId='+catId;

	//alert(scriptUrl);

 	//dataTable

 	$('#tbl').load(scriptUrl);*/

}
</script> 

</body>

</html>