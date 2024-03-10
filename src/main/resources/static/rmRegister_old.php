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

<?php include("inc/meta.php");?>
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
function edit(id)
{
//alert('hi');
window.open("getrmmaster_details.php?ID="+id, "_blank", "toolbar=yes, scrollbars=yes, resizable=no, top=60, left=0, width=700, height=600");
}
function erate(id)
{
//alert('hi');
window.open("rm_price_history.php?ID="+id, "_blank", "toolbar=yes, scrollbars=yes, resizable=no, top=60, left=0, width=700, height=600");
}	

function del(id,user)
{


var r = confirm("Do you want to Delete this Record....?");
if (r == true) {
var scriptUrl ='del_rmMaster.php?id='+id+'&userId='+user;
$.ajax({url:scriptUrl,success:function(result)
{	
alert('Record Deleted Successfully...');
window.location.href='rmMaster.php';
}});

} 
else {
txt = "You Pressed Cancel!";
}

}
	
function dataReset()
{
	window.location.href='rmRegister.php';
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
<div class="d-sm-flex align-items-center justify-content-between mb-4">   
<table width="100%">
<tr>
<td><h1 class="h4 mb-0 text-gray-800" style="height:0px;padding-bottom: 10px;">RM Master Register</h1> </td>	
<td align="right"><a href="rmMaster.php" class="btn btn-warning" style="text-decoration: none;">Goto RM Master Entry</a></td>	
</tr>  
</table>	
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
<div class="card-body">
<form>
<input type="hidden" id="uid" name="uid" value="<?php echo $_SESSION['uId']?>">
<input type="hidden" id="urole" name="urole" value="<?php echo $uRole;?>">
<input type="hidden" id="uiType" name="uiType" value="<?php echo $uiType;?>">
<input type="hidden" id="uloc" name="uloc" value="<?php echo $uloc;?>">
<input type="hidden" id="ulocty" name="ulocty" value="<?php echo $ulocType;?>">	
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
	
	
<td valign="top"><label class="m-0 font-weight-bold text-primary">Location</label></td>	
<td valign="top">:</td>	
<td valign="top">
<select class="chosen-select form-control form-control-sm" id="location" name="location" tabindex="3" style="width:230px;" onChange="getdata()">
<option value="0">Select</option>	
</select>
</td>
	
<td valign="top"><label class="m-0 font-weight-bold text-primary">Search</label></td>	
<td valign="top">:</td>	
<td valign="top">
<input type="text" id="txtsearch" name="txtsearch" class="form-control" tabindex="3.1">
</td>	
<td>
<input type="button" id="btnsearch" name="btnsearch" class="btn btn-primary" onClick="getdata();" tabindex="3.2" value="Search">
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
<td valign="top">
</td>		
</tr>	
	
<tr>	
<td>
<input type="button" id="btnReset" name="btnReset" class="btn btn-warning" onClick="dataReset();" tabindex="3.3" value="Reset">
</td>
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
	
</table>
</div>
</div>
</div>	
</form>	
<?php 
$totalRecordsPerPage=0;	
include('mysql.connect.php');
//admin_tbl 
$qEditDel="SELECT act_edit AS ed,act_delete AS del FROM admin_tbl WHERE sts='0' AND id='".$_SESSION['uId']."'";
//echo $qEditDel."<Br>";	
$stmEditDel=$mysql->prepare($qEditDel);
$stmEditDel->execute();
$rowEditDel=$stmEditDel->fetch(PDO::FETCH_ASSOC);
$ed=$rowEditDel['ed'];
$dels=$rowEditDel['del'];	
//admin_tbl
if($uRole=='admin' && ($uiType=='3' || $uiType=='0'))
{
	$qq="SELECT a.rmId,a.sage_code,a.focus_code,a.description,b.uom AS unit_name,CONCAT(c.company_code,' - ',c.company_name) AS company_name,CONCAT(d.loc_code,' - ',d.location_name) AS location_name,a.reorder_level_qty,a.product_expiry,a.rackNo,e.category_nm,a.location_id FROM `rm_master` AS a LEFT JOIN `uom_tbl` AS b ON a.UOM=b.ID LEFT JOIN `company_tbl` AS c ON a.company_id=c.ID LEFT JOIN `location_tbl` AS d ON a.location_id=d.ID LEFT JOIN category_master AS e ON a.catId=e.catId WHERE a.sts='0' ORDER BY a.rmId";
	//echo $qq."<Br>";
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
	$qq="SELECT a.rmId,a.sage_code,a.focus_code,a.description,b.uom AS unit_name,CONCAT(c.company_code,' - ',c.company_name) AS company_name,CONCAT(d.loc_code,' - ',d.location_name) AS location_name,a.reorder_level_qty,a.product_expiry,a.rackNo,e.category_nm ,a.location_id FROM `rm_master` AS a LEFT JOIN `uom_tbl` AS b ON a.UOM=b.ID LEFT JOIN `company_tbl` AS c ON a.company_id=c.ID LEFT JOIN `location_tbl` AS d ON a.location_id=d.ID LEFT JOIN category_master AS e ON a.catId=e.catId LEFT JOIN admin_usr_loc AS us ON a.location_id=us.locId WHERE a.sts='0' AND c.ID='$cmpId' AND us.uid='$userId'  ORDER BY a.rmId";
	//echo "Else  - ".$qq."<Br>";
	
	//echo $qq."<Br>";
	include('shripage.php');
    $totalRecordsPerPage=500;
    $paginationData=pagination_records($totalRecordsPerPage,$qq);
    //print_r($paginationData);
    $sn=pagination_records_counter($totalRecordsPerPage);
    $cnt=$sn;	
    $pagination=pagination($totalRecordsPerPage,$qq);
}	
?>	
<div class="table-responsive">
<div id="tbl">
<div class="pagination">    
<?php echo $pagination; ?>
</div>	
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
<thead>
<tr style="background-color:#b02923;font-size:14px;">
<th style="color:#fff;text-align:center">Sr.No.</th>
<th style="color:#fff;text-align:center">Category</th>
<th style="color:#fff;text-align:center">Sage Code</th>
<th style="color:#fff;text-align:center">Focus Code</th>
<th style="color:#fff;text-align:center">Description</th>
<th style="color:#fff;text-align:center">Pack. Size / UOM</th>
<th style="color:#fff;text-align:center">Company</th>
<th style="color:#fff;text-align:center">Location</th>
<th style="color:#fff;text-align:center">Reorder Level Qty</th>
<th style="color:#fff;text-align:center">Prod. Expiry</th>
<th style="color:#fff;text-align:center">Rack No.</th>
<th style="color:#fff;text-align:center">Edit</th>
<th style="color:#fff;text-align:center">Delete</th>
</tr>
</thead>
<?php 
foreach ($paginationData as $row) 
{
	$id=$row['rmId'];
	$loc_id=$row['location_id'];
	
	if($uRole=='admin' && $uiType=='3')
	{
      echo'<tr style="color:#000;font-weight:600;">';
      echo '<td>'.$cnt.'</td>';
      echo '<td>'.$row['category_nm'].'</td>';
      echo '<td>'.$row['sage_code'].'</td>';
      echo '<td>'.$row['focus_code'].'</td>';
      echo '<td>'.$row['description'].'</td>';
      echo '<td>'.$row['unit_name'].'</td>';
      echo '<td>'.$row['company_name'].'</td>';
      echo '<td>'.$row['location_name'].'</td>';
      echo '<td>'.$row['reorder_level_qty'].'</td>';
      echo '<td>'.$row['product_expiry'].'</td>';
      echo '<td>'.$row['rackNo'].'</td>';
      /*echo '<td align="center"><a href="javascript:erate('.$id.')"><i class="fa fa-eye"></i></a></td>';*/
      if($ed==0)
      {
      echo '<td>-</td>';  
      }
      else
      {
      echo '<td align="center"><a href="javascript:edit('.$id.')"><i class="fa fa-edit"></i></a></td>';
      }
      if($dels==0)
      {
      echo '<td>-</td>';  
      }
      else
      {
      echo '<td align="center"><a href="javascript:del('.$id.','.$userId.')"><i class="fa fa-trash" style="color:#F00"></i></a></td>';
      }
      echo '</tr>';
      $cnt++;	
	}
	else
	{
      echo'<tr style="color:#000;font-weight:600;">';
      echo '<td>'.$cnt.'</td>';
      echo '<td>'.$row['category_nm'].'</td>';
      echo '<td>'.$row['sage_code'].'</td>';
      echo '<td>'.$row['focus_code'].'</td>';
      echo '<td>'.$row['description'].'</td>';
      echo '<td>'.$row['unit_name'].'</td>';
      echo '<td>'.$row['company_name'].'</td>';
      echo '<td>'.$row['location_name'].'</td>';
      echo '<td>'.$row['reorder_level_qty'].'</td>';
      echo '<td>'.$row['product_expiry'].'</td>';
      echo '<td>'.$row['rackNo'].'</td>';
      /*echo '<td align="center"><a href="javascript:erate('.$id.')"><i class="fa fa-eye"></i></a></td>';*/
      if($ed==0)
      {
      echo '<td>-</td>';  
      }
      else
      {
      echo '<td align="center"><a href="javascript:edit('.$id.')"><i class="fa fa-edit"></i></a></td>';
      }
      if($dels==0)
      {
      echo '<td>-</td>';  
      }
      else
      {
      echo '<td align="center"><a href="javascript:del('.$id.','.$userId.')"><i class="fa fa-trash" style="color:#F00"></i></a></td>';
      }
      echo '</tr>';
      $cnt++;
	}
}
$mysql=null;
?>
<!--<tfoot>
<tr>
<th>Sr.No.</th>
<th>Customer Code</th>
<th>Customer Name</th>
<th>Address</th>
<th>Contact No</th>
<th>Mobile No</th>
<th>Country</th>
</tr>
</tfoot>-->

</table>
<div class="pagination">    
<?php echo $pagination; ?>
</div>	
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
'.chosen-select-width'     : {width:"95%"},
}
for (var selector in config) {
$(selector).chosen(config[selector]);
}
</script>
<script type="text/javascript">
$( document ).ready(function() {
    
});	
	

$("#btnsubmit").click(function()
{
	/*alert("hi");
	alert(document.getElementById("desc").value);*/
	if($("#company_name").val().trim() =="0")
	{
		$("#company_name").addClass("require");
		alert("Please Select Company..!!");
		$("#company_name").focus();
		return false;
		//alert("bye");
	}
	else if($("#location").val().trim() =="0")
	{
		$("#location").addClass("require");
		alert("Please Select Location..!!");
		$("#location").focus();
		return false;
		//alert("bye");
	}
	else if($("#sage_code").val().trim() =="")
	{
		$("#sage_code").addClass("require");
		alert("Please Enter Sage Code..!!");
		$("#sage_code").focus();
		return false;
		//alert("bye");
	}
	else if($("#focus_code").val().trim()=="")
	{
		$("#focus_code").addClass("require");
		alert("Please Enter Focus Code..!!");
		$("#focus_code").focus();
		return false;
	}
	else if($("#txtdesc").val().trim()=="")
	{
		$("#txtdesc").addClass("require");
		alert("Please Enter Description..!!");
		$("#txtdesc").focus();
		return false;
	}
	else if($("#uom").val().trim()=="0")
	{
		$("#uom").addClass("require");
		alert("Please Select UOM..!!");
		$("#uom").focus();
		return false;
	}
	else if($("#company_name").val().trim()=="0")
	{
		$("#company_name").addClass("require");
		alert("Please Select Company Name..!!");
		$("#company_name").focus();
		return false;
	}
	else if($("#location").val().trim()=="0")
	{
		$("#location").addClass("require");
		alert("Please Select Location Name..!!");
		$("#location").focus();
		return false;
	}
	else if($("#reorder_level_qty").val().trim()=="")
	{
		$("#reorder_level_qty").addClass("require");
		alert("Please Enter Reorder Level Qty..!!");
		$("#reorder_level_qty").focus();
		return false;
	}
	else if($("#product_expiry").val().trim()=="")
	{
		$("#product_expiry").addClass("require");
		alert("Please Enter Product Expiry..!!");
		$("#product_expiry").focus();
		return false;
	}
	else if($("#rackNo").val().trim()=="")
	{
		$("#rackNo").addClass("require");
		alert("Please Select Rack No. ..!!");
		$("#rackNo").focus();
		return false;
	}
	else
	{
		document.getElementById('btnsubmit').disabled=true;
		var url = "ins_rm_master.php"; 
		//alert(url);
		// the script where you handle the form input.
		$.ajax({
		type: "POST",
		url: url,
		data: $("#rmMaster").serialize(), // serializes the form's elements.
		success: function(data)
		{
			alert(data);
			document.getElementById('btnsubmit').disabled=false;
			window.location.href='rmMaster.php';
		}
		});
		e.preventDefault(); 
	}
	// avoid to execute the actual submit of the form.
});
	
function getLoc()	
{
  if(document.getElementById('compId').value=='0')
  {
	if(document.getElementById('urole').value=='admin')
    {
	  
    }
	else
	{
	  alert('Plz, Select Company Name..!'); 	
	  document.getElementById('compId').focus();	
	}
  }
  else	
  {
      var id = document.getElementById('compId').value;
	  var uId= document.getElementById('uid').value;
	  var uloc= document.getElementById('uloc').value;
	  var uiType= document.getElementById('uiType').value;
	  var ulocty= document.getElementById('ulocty').value;
	  var urole= document.getElementById('urole').value;
	  var scriptUrl ='getLocations.php?compId='+id+'&iType=1'+'&uiType='+uiType+'&uId='+uId+'&uloc='+uloc+'&ulocty='+ulocty+'&urole='+urole;
	  //alert(scriptUrl);
      $.ajax({url:scriptUrl,success:function(result)
      {	
	  	 //alert(result);
         //document.getElementById('location').innerHTML=result;
		  $("#location").html(result).trigger("chosen:updated.chosen");
      }}); 
  }
}		
	
function getdata()
{
	var compId,locId,iType,srch;
	//alert('hey chiru...');
	if(document.getElementById('compId').value=='0')
	{
		compId="0";
	}
 	else
    {
		compId=document.getElementById('compId').value;
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
 	
	//alert('hey chiru...');
 	var uId=document.getElementById('uid').value;
	var uType=document.getElementById('uiType').value;
	var uRole=document.getElementById('urole').value;
	var uloc=document.getElementById('uloc').value;
 	var scriptUrl='getrmRegister.php?compId='+compId+'&iType=1'+'&locId='+locId+'&uId='+uId+'&uiType='+uType+'&role='+uRole+'&uloc='+uloc+'&srch='+srch;
	//alert(scriptUrl);
 	//dataTable
 	$('#tbl').load(scriptUrl);
}
</script>
</body>

</html>