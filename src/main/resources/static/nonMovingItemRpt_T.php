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



<?php

include("inc/meta.php");

?>

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

function getLoc()	

{

  //alert('hey chiru...');

  if(document.getElementById('compId').value=='0')

  {

	 if(document.getElementById('urole').value=='admin')

    {

	  

    }

	else

	{

	  alert('Plz, Select Company Name..!'); 	

	  document.getElementById('company_name').focus();	

	}

  }

  else if(document.getElementById('iType').value=='0')

  {

	 //alert('Plz, Select Product Category..!'); 

	 document.getElementById('iType').focus();

  }

  else	

  {

      var id = document.getElementById('compId').value;

	  var iType = document.getElementById('iType').value;

	  var uId= document.getElementById('uid').value;

	  var uloc= document.getElementById('uloc').value;

	  var uiType= document.getElementById('uiType').value;

	  var ulocty= document.getElementById('ulocty').value;

	  var urole= document.getElementById('urole').value;

	  var scriptUrl ='getLocations.php?compId='+id+'&iType='+iType+'&uId='+uId+'&uiType='+uiType+'&uId='+uId+'&uloc='+uloc+'&ulocty='+ulocty+'&urole='+urole;

	  //alert(scriptUrl);

      $.ajax({url:scriptUrl,success:function(result)

      {	

	  	 //alert(result);

         //document.getElementById('location').innerHTML=result; 

		  $("#location").html(result).trigger("chosen:updated.chosen");

      }}); 

  }

}	

function dataReset()

{

	window.location.href='nonMovingItemRpt.php';

}

	

function getexcel()

{

	var compId,locId,iType,srch,fdt,tdt;

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

 

 	if(document.getElementById('location').value=='0')

	{

		locId="0";

	}

 	else

    {

		locId=document.getElementById('location').value;

	}

	

	if(document.getElementById('txtsearch').value=='')

	{

	  srch	='0';

	}

	else

	{

	  srch=document.getElementById('txtsearch').value;	

	}

	

	if(document.getElementById('fdt').value=='')

    {

    	fdt="0";

    }

    else

    {

    	fdt=document.getElementById('fdt').value;

    }



    if(document.getElementById('tdt').value=='')

    {

    	tdt="0";

    }

    else

    {

    	tdt=document.getElementById('tdt').value;

    }

 	

 	var uId=document.getElementById('uid').value;

	var uType=document.getElementById('uiType').value;

	var uRole=document.getElementById('urole').value;

	var uloc= document.getElementById('uloc').value;

 	var scriptUrl='nonMovingItemEx.php?compId='+compId+'&iType='+iType+'&locId='+locId+'&uId='+uId+'&uiType='+uType+'&role='+uRole+'&srch='+srch+'&uloc='+uloc+'&fdt='+fdt+'&tdt='+tdt;

 	

	//alert(scriptUrl);

 	//dataTable

 	window.open(scriptUrl, "toolbar=yes, scrollbars=yes, resizable=no, top=60, left=0, width=1000, height=600");

}



function getpdf()

{

	var compId,locId,iType,srch,fdt,tdt;

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

 

 	if(document.getElementById('location').value=='0')

	{

		locId="0";

	}

 	else

    {

		locId=document.getElementById('location').value;

	}

	

	if(document.getElementById('txtsearch').value=='')

	{

	  srch	='0';

	}

	else

	{

	  srch=document.getElementById('txtsearch').value;	

	}

	

	if(document.getElementById('fdt').value=='')

    {

    	fdt="0";

    }

    else

    {

    	fdt=document.getElementById('fdt').value;

    }



    if(document.getElementById('tdt').value=='')

    {

    	tdt="0";

    }

    else

    {

    	tdt=document.getElementById('tdt').value;

    }

 	

 	var uId=document.getElementById('uid').value;

	var uType=document.getElementById('uiType').value;

	var uRole=document.getElementById('urole').value;

	var uloc= document.getElementById('uloc').value;

	

 	var scriptUrl='mpdf/print_files/nonMovingItem_pdf.php?compId='+compId+'&iType='+iType+'&locId='+locId+'&uId='+uId+'&uiType='+uType+'&role='+uRole+'&srch='+srch+'&uloc='+uloc+'&fdt='+fdt+'&tdt='+tdt;

	//alert(scriptUrl);

 	//dataTable

 	window.open(scriptUrl,  "toolbar=yes, scrollbars=yes, resizable=no, top=60, left=0, width=1000, height=600");

}

	

 function view(id)

{

		//alert('hi');

	window.open("getinventoryview.php?ID="+id, "_blank", "toolbar=yes, scrollbars=yes, resizable=no, top=60, left=0, width=1000, height=600");

}	

</script>

</head>

<body id="page-top" onLoad="getLoc();">

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

<i class="fa fa-bars"></i>

</button>



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

<h1 class="h3 mb-0 text-gray-801" style="padding-bottom: 5px;">Non Moving Item Report</h1>   

</div>







<!-- DataTales Example -->

<div class="card shadow mb-4">

<!--<div class="card-header py-3">

<h6 class="m-0 font-weight-bold text-primary">Inventory Register</h6>

</div>-->

<form>

<input type="hidden" id="uid" name="uid" value="<?php echo $userId?>">

<input type="hidden" id="urole" name="urole" value="<?php echo $uRole;?>">

<input type="hidden" id="uiType" name="uiType" value="<?php echo $uiType;?>">

<input type="hidden" id="uloc" name="uloc" value="<?php echo $uloc;?>">	

<input type="hidden" id="ulocty" name="ulocty" value="<?php echo $ulocType;?>">

<div class="card-body">

<div class="row">          

<div class="col-lg-12">

<div class="p-2">             

<table cellpadding="5px">

<tr>

<td valign="top"><label class="m-0 font-weight-bold text-primary">Company</label></td>	



<td valign="top">:</td>	

<td valign="top">

<select class="chosen-select form-control form-control-sm" id="compId" name="compId" tabindex="1" style="width:250px;" onChange="getLoc();getdata();">

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

<select class="chosen-select form-control form-control-sm" id="iType" name="iType" tabindex="2"  onChange="getLoc();getdata();" style="width:250px;" required>

<?php

if($uiType=='0' || $uiType=='3')

{

?>

<option value="0">Select</option>

<option value="1">RAW MATERIAL</option>

<option value="2">FINISHED GOODS</option>

<?php

}

else if($uiType=='1')

{

?>

<option value="1">RAW MATERIAL</option>

<?php	

}

else

{

?>

<option value="2">FINISHED GOODS</option>

<?php	

}

?>

</select>

</td>	



<td valign="top"><label class="m-0 font-weight-bold text-primary">Location</label></td>	

<td valign="top">:</td>	

<td valign="top">

<select class="chosen-select form-control form-control-sm" id="location" name="location" tabindex="3" style="width:230px;" onChange="getdata()">

<option value="0">Select</option>

<?php

/*include("mysql.connect.php");

$q="SELECT ID,CONCAT(loc_code,' - ', location_name) AS location_name FROM location_tbl WHERE sts='0'";

$s=$mysql->prepare($q);

$s->setFetchMode(PDO::FETCH_ASSOC);

$s->execute();

while($r=$s->fetch())

{

echo "<option value=".$r['ID'].">".$r['location_name']."</option>";

}

$mysql=null;*/

?>	

</select>

</td>		

</tr>



<tr>

<td valign="top"><label class="m-0 font-weight-bold text-primary">From Date</label></td>	

<td valign="top">:</td>	

<td valign="top">

<input type="date" class="form-control form-control-sm" id="fdt" name="fdt" value="" onChange="getdata();" tabindex="4">

</td>		



<td valign="top"><label class="m-0 font-weight-bold text-primary">To Date</label></td>	

<td valign="top">:</td>	

<td valign="top">

<input type="date" class="form-control form-control-sm" id="tdt" name="tdt" value="" onChange="getdata();" tabindex="5">

</td>



			

</tr>	

	

<tr>

<td valign="top"></td>	

<td valign="top"></td>	

<td valign="top"></td>	

<td valign="top"></td>	

<td valign="top"></td>	

<td valign="top"></td>

<td valign="top"></td>	

<td valign="top"></td>	

<td valign="top"></td>		

</tr>



<tr>

<td valign="top"><label class="m-0 font-weight-bold text-primary">Search</label></td>	

<td valign="top">:</td>	

<td valign="top">

<input type="text" id="txtsearch" name="txtsearch" class="form-control" tabindex="3.1" placeholder="Type keywords..." onkeyup="getdata();" style="width: 250px;">

</td>	

<td>

<!--<input type="button" id="btnsearch" name="btnsearch" class="btn btn-primary" onClick="searchFilter();" tabindex="5.2" value="Search">-->

</td>	

<td valign="top"></td>	

<td valign="top"></td>

<td valign="top">

	<a href="javascript:getexcel();"><img src="img/EXCELIMG1.png" alt="download" title="download" style="width:50px; height:50px"></a>



</td>	

<td valign="top">

	<a href="javascript:getpdf();"><img src="img/pdf.png" alt="download" title="download" style="width:50px; height:50px"></a>



</td>	

<td valign="top"><input type="button" id="btnReset" name="btnReset" class="btn btn-warning" onClick="dataReset();" tabindex="3.3" value="Reset"></td>	

</tr>



</table>

</div>

</div>

</div>



<!--<div align="right">

<a href="javascript:getexcel();"><img src="img/EXCELIMG1.png" alt="download" title="download" style="width:50px; height:50px"></a>

<a href="javascript:getpdf();"><img src="img/pdf.png" alt="download" title="download" style="width:50px; height:50px"></a>

</div>-->

<?php

$totalRecordsPerPage=0;	

include('shripage1.php'); 
include('mysql.connect.php');

$baseURL = 'getnonMovingItemT.php'; 
$limit = 100;


//admin_tbl 

;	

//admin_tbl

if($uRole=='admin' && ($uiType=='3' || $uiType=='0'))
{
	$qq="SELECT a.ID,a.compId,a.locId,l.loc_code,l.location_name AS locNm,a.iType,a.itemId,SUM(b.in_qty+b.openstk) AS in_qty,SUM(a.stk_qty) AS stk_qty FROM stock_tbl AS a LEFT JOIN stock_tbl_2 AS b ON a.ID=b.stkId LEFT JOIN location_tbl AS l ON a.locId=l.ID WHERE a.in_qty=a.stk_qty AND (a.out_qty='0' OR a.lock_qty='0') GROUP BY a.ID,a.compId,a.locId,a.iType,a.itemId ORDER BY SUM(a.stk_qty) DESC LIMIT $limit ";

	//echo $qq."<Br>";
	$qqq="SELECT a.ID FROM stock_tbl AS a LEFT JOIN stock_tbl_2 AS b ON a.ID=b.stkId LEFT JOIN location_tbl AS l ON a.locId=l.ID WHERE a.in_qty=a.stk_qty AND (a.out_qty='0' OR a.lock_qty='0') GROUP BY a.ID,a.compId,a.locId,a.iType,a.itemId ORDER BY SUM(a.stk_qty) DESC";
}
else
{
	$qq="SELECT a.ID,a.compId,a.locId,l.loc_code,l.location_name AS locNm,a.iType,a.itemId,SUM(b.in_qty+b.openstk) AS in_qty,SUM(a.stk_qty) AS stk_qty FROM stock_tbl AS a LEFT JOIN stock_tbl_2 AS b ON a.ID=b.stkId LEFT JOIN location_tbl AS l ON a.locId=l.ID LEFT JOIN admin_usr_loc AS u ON l.ID=u.locId WHERE u.uid='$userId' AND a.in_qty=a.stk_qty AND (a.out_qty='0' OR a.lock_qty='0') GROUP BY a.ID,a.compId,a.locId,a.iType,a.itemId ORDER BY SUM(a.stk_qty) DESC LIMIT $limit ";

	//echo "Else  - ".$qq."<Br>";
	$qqq="SELECT a.ID FROM stock_tbl AS a LEFT JOIN stock_tbl_2 AS b ON a.ID=b.stkId LEFT JOIN location_tbl AS l ON a.locId=l.ID LEFT JOIN admin_usr_loc AS u ON l.ID=u.locId WHERE u.uid='$userId' AND a.in_qty=a.stk_qty AND (a.out_qty='0' OR a.lock_qty='0') GROUP BY a.ID,a.compId,a.locId,a.iType,a.itemId ORDER BY SUM(a.stk_qty) DESC";
}				
//echo $qq.'<br>';
$query1   = $mysql->prepare($qqq); 
$query1->execute();
//$result1  = $query1->fetch(PDO::FETCH_ASSOC);
//$rowCount= $result1['rowNum']; 	
$rowCount=$query1->rowCount();	
	
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

<table class="table table-bordered" id="dataTable" cellspacing="0">

<thead>

<tr style="background-color:#b02923">

<th style="color:#fff;">Location</th>

<th style="color:#fff;">Focus Code</th>

<th style="color:#fff">Sage Code</th>

<th style="color:#fff;">Product</th>

<!--<th style="color:#fff">Opening Stock</th>-->

<th style="color:#fff;">Stock Qty</th>



</tr>

</thead>

<?php
$a=$b=$c=$d=$e=0;	
foreach ($paginationData as $row) 
{

	//$id=$row['ID'];

	



	if($row['iType']=='1')
	{

		$qi="SELECT r.focus_code AS fc,r.sage_code AS sg,rc.category_nm AS catNm,r.description AS desp,ru.uom AS uom FROM rm_master AS r LEFT JOIN category_master AS rc ON r.catId=rc.catId LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID WHERE location_id='".$row['locId']."' AND rmId='".$row['itemId']."' AND r.sts='0'";

		//echo "iType : 1 = ".$qi."<Br>";

		$si=$mysql->prepare($qi);

		$si->execute();

		$rowi=$si->fetch(PDO::FETCH_ASSOC);

				

		echo'<tr style="color:#000;font-weight:600;">';

		echo '<td style="background-color:#0d69f445;color:#000">'.$row['locNm'].'</td>';

		echo '<td style="background-color:#0d69f445;color:#000">'.$rowi['fc'].'</td>';

		echo '<td style="background-color:#0d69f445;color:#000">'.$rowi['sg'].'</td>';

		echo '<td style="background-color:#0d69f445;color:#000">'.$rowi['desp'].'</td>';

		/*echo '<td style="background-color:#0d69f445;color:#000">'.$row['openstk'].'</td>';*/

		echo '<td style="background-color:#0d69f445;color:#000">'.$row['stk_qty'].'</td>';

		

		echo '</tr>';  

	}
	else
	{
		$qi="SELECT f.focus_code AS fc,f.sage_code AS sg,fc.category_nm AS catNm,f.descc AS desp,fu.uom AS uom FROM fg_master AS f LEFT JOIN category_master AS fc ON f.category_id=fc.catId LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID WHERE location_id='".$row['locId']."' AND fgId='".$row['itemId']."' AND f.sts='0'";

		//echo "iType : 2 = ".$qi."<Br>";

		$si=$mysql->prepare($qi);

		$si->execute();

		$rowi=$si->fetch(PDO::FETCH_ASSOC);

		

		echo'<tr style="color:#000;font-weight:600;">';

		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['locNm'].'</td>';

		echo '<td style="background-color:#f4b80d61;color:#000">'.$rowi['fc'].'</td>';

		echo '<td style="background-color:#f4b80d61;color:#000">'.$rowi['sg'].'</td>';

		echo '<td style="background-color:#f4b80d61;color:#000">'.$rowi['desp'].'</td>';

		/*echo '<td style="background-color:#f4b80d61;color:#000">'.$row['openstk'].'</td>';*/

		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['stk_qty'].'</td>';

		

		echo '</tr>';  

	}				  

	$cnt++;	

}	

$mysql=null;	

?>

</table>

	

</div>		    

</div>

</div>

</form>			  	

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

  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>-->



  <!-- Page level custom scripts -->

  <!--<script src="js/demo/datatables-demo.js"></script>-->

  

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

function searchFilter(page_num)
{
    page_num = page_num?page_num:0;
	var len = document.getElementById('txtsearch').value.length;
	//alert(len);
	var compId,locId,iType;

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



 	if(document.getElementById('location').value=='0')

	{

		locId="0";

	}

 	else

    {

		locId=document.getElementById('location').value;

	}
 
 	var uId=document.getElementById('uid').value;

	var uType=document.getElementById('uiType').value;

	var urole=document.getElementById('urole').value;

	var uloc= document.getElementById('uloc').value;
//alert(urole);
	
    var keywords = $('#txtsearch').val();
    var filterBy = $('#filterBy').val();
	if(len>=3)
	{
		$.ajax({
			type: 'POST',
			url: 'getnonMovingItemT.php',
			data:'page='+page_num+'&keywords='+keywords+'&filterBy='+filterBy+'&compId='+compId+'&iType='+iType+'&locId='+locId+'&uId='+uId+'&uiType='+uType+'&urole='+urole+'&uloc='+uloc,
			beforeSend: function () {
			},
			success: function (html) {
				//alert(html);
				$('#tbl').html(html);
			}
		});
	}
	else
	{
		//alert('1');
	}
}

function getdata()

{

	var compId,locId,iType,srch,fdt,tdt;

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

 

 	if(document.getElementById('location').value=='0')

	{

		locId="0";

	}

 	else

    {

		locId=document.getElementById('location').value;

	}

	

	if(document.getElementById('txtsearch').value=='')

	{

	  srch	='0';

	}

	else

	{

	  srch=document.getElementById('txtsearch').value;	

	}

	

	if(document.getElementById('fdt').value=='')

    {

    	fdt="0";

    }

    else

    {

    	fdt=document.getElementById('fdt').value;

    }



    if(document.getElementById('tdt').value=='')

    {

    	tdt="0";

    }

    else

    {

    	tdt=document.getElementById('tdt').value;

    }

 	
	var page_num = page_num?page_num:0;
 	var uId=document.getElementById('uid').value;

	var uType=document.getElementById('uiType').value;

	var uRole=document.getElementById('urole').value;

	var uloc= document.getElementById('uloc').value;
 	var keywords = $('#txtsearch').val();
    var filterBy = $('#filterBy').val();
	
	$.ajax({
			type: 'POST',
			url: 'getnonMovingItemT.php',
			data:'page='+page_num+'&keywords='+keywords+'&filterBy='+filterBy+'&compId='+compId+'&iType='+iType+'&locId='+locId+'&uId='+uId+'&uiType='+uType+'&urole='+uRole+'&uloc='+uloc+'&fdt='+fdt+'&tdt='+tdt+'&sType=0',
			beforeSend: function () {
			},
			success: function (html) {
				//alert(html);
				$('#tbl').html(html);
			}
		});

 	/*var scriptUrl='getnonMovingItemT.php?compId='+compId+'&iType='+iType+'&locId='+locId+'&uId='+uId+'&uiType='+uType+'&role='+uRole+'&srch='+srch+'&uloc='+uloc+'&fdt='+fdt+'&tdt='+tdt;

	//alert(scriptUrl);

 	//dataTable

 	$('#tbl').load(scriptUrl);*/

}
</script> 

</body>

</html>