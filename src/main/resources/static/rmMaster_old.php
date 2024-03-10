<?php include('log_check.php')?>
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
</script>

<script>
function getrbtn()
{
if(document.getElementById('csvfile').checked==true)
{
document.getElementById('first').style.visibility="visible";
document.getElementById('first').style.overflow="visible";
document.getElementById('first').style.height="auto";

document.getElementById('second').style.visibility="hidden";
document.getElementById('second').style.overflow="visible";
document.getElementById('second').style.height="0px";
}
else
{
document.getElementById('first').style.visibility="hidden";
document.getElementById('first').style.overflow="hidden";
document.getElementById('first').style.height="0px";

document.getElementById('first').style.visibility="hidden";
document.getElementById('first').style.overflow="hidden";
document.getElementById('first').style.height="0px";
}

}
</script>
</head>

<body id="page-top">

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
<h1 class="h4 mb-0 text-gray-800" style="height:0px">RM Master</h1>     
</div>

<div class="card o-hidden border-0 shadow-lg my-5">
<div class="card-body p-0">
<!-- Nested Row within Card Body -->
<div class="row">          
<div class="col-lg-12">
<div class="p-5">
<div id="second">    
<form class="user" action="#" method="post" name="rmMaster" id="rmMaster">
<input type="hidden" id="uid" name="uid" value="<?php echo $_SESSION['uId']?>">
<div class="form-group row">
<div class="col-sm-6 mb-3 mb-sm-0">
<label class="m-0 font-weight-bold text-primary">Company Name</label>
<select name="company_name" id="company_name" class="chosen-select form-control form-control-sm" tabindex="1" onChange="getLoc()">
<option value="0">Select</option>
<?php
include("mysql.connect.php");
$q="SELECT ID,CONCAT(company_code,' - ', company_name) AS company_name FROM company_tbl WHERE sts='0'";
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
</div>
	
<div class="col-sm-6">
<label class="m-0 font-weight-bold text-primary">Location</label>
<select class="chosen-select form-control form-control-sm" id="location" name="location" tabindex="2" >
<option value="0">Select</option>
</select>
</div>

</div>	
	
<div class="form-group row">

<div class="col-sm-6">
<label class="m-0 font-weight-bold text-primary">Sage Code</label>                    
<input type="text" id="sage_code" name="sage_code" class="form-control form-control-sm" placeholder="Sage Code" tabindex="3">
</div>
<div class="col-sm-6 mb-3 mb-sm-0">
<label class="m-0 font-weight-bold text-primary">Focus Code</label>
<input type="text" class="form-control form-control-sm" id="focus_code" name="focus_code" placeholder="Focus Code" tabindex="4">
</div>

</div>

<div class="form-group row">
<div class="col-sm-6">
<label class="m-0 font-weight-bold text-primary">Description</label>
<textarea class="form-control form-control-sm" id="txtdesc" name="txtdesc" placeholder="Description" tabindex="5" >
</textarea>
</div>

<!--<div class="col-sm-6 mb-3 mb-sm-0">
<label class="m-0 font-weight-bold text-primary">Packing Size</label>
<input type="text" class="form-control form-control-sm" id="packing_size" name="packing_size" placeholder="Packing Size" tabindex="4" >
</div>-->
<div class="col-sm-6 mb-3 mb-sm-0">
<label class="m-0 font-weight-bold text-primary">Packing Size / UOM</label>
<select name="uom" id="uom" class="chosen-select form-control form-control-sm" tabindex="6">
<option value="0">Select</option>
<?php
include("mysql.connect.php");
$q="SELECT ID,uom FROM uom_tbl WHERE sts='0'";
$s=$mysql->prepare($q);
$s->setFetchMode(PDO::FETCH_ASSOC);
$s->execute();
while($r=$s->fetch())
{
echo "<option value=".$r['ID'].">".$r['uom']."</option>";
}   
$mysql=null;
?>
</select>
</div>
</div>

<div class="form-group row">
<div class="col-sm-6">
<label class="m-0 font-weight-bold text-primary">Reorder Level(Qty)</label>
<input type="text" id="reorder_level_qty" name="reorder_level_qty" tabindex="7" class="form-control form-control-sm" placeholder="Reorder Level(Qty)">
</div>
	
<div class="col-sm-6 mb-3 mb-sm-0">
<label class="m-0 font-weight-bold text-primary">Product Expiry</label>
<select class="chosen-select form-control form-control-sm" id="product_expiry" name="product_expiry" tabindex="9">
<option value="1 Year">1 Year</option>
<option value="6 Months">6 Months</option>
</select>	
</div>	
</div>
	
<div class="form-group row">	
<div class="col-sm-6 mb-3 mb-sm-0">
<label class="m-0 font-weight-bold text-primary">Rack No.</label>
<select class="form-control chosen-select form-control-sm" id="rackNo" name="rackNo" tabindex="9.1">
<option value="0">Select</option>
<?php
include("mysql.connect.php");
$q="SELECT rackNo FROM rack_tbl WHERE sts='0' AND iType='1' ORDER BY rackNo";
$s=$mysql->prepare($q);
$s->setFetchMode(PDO::FETCH_ASSOC);
$s->execute();
while($r=$s->fetch())
{
echo "<option value=".$r['rackNo'].">".$r['rackNo']."</option>";
}   
$mysql=null;
?>
</select>	
</div>
	
<div class="col-sm-6">
<label class="m-0 font-weight-bold text-primary"></label>
<button type="button" id="btnsubmit" name="btnsubmit" class="btn btn-primary" tabindex="10">Create</button>
</div>	
</div>	

</form>  
</div>

</div>
</div>
</div>
</div>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
<div class="card-header py-3">
<h6 class="m-0 font-weight-bold text-primary">RM Register</h6>
</div>
<div class="card-body">
<div class="table-responsive">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
<thead>
<tr style="background-color:#b02923">
<th style="color:#fff;text-align:center">Sr.No.</th>
<th style="color:#fff;text-align:center">Sage Code</th>
<th style="color:#fff;text-align:center">Focus Code</th>
<th style="color:#fff;text-align:center">Description</th>
<th style="color:#fff;text-align:center">Packing Size / UOM</th>
<th style="color:#fff;text-align:center">Company Name</th>
<th style="color:#fff;text-align:center">Location Name</th>
<th style="color:#fff;text-align:center">Reorder Level Qty</th>
<th style="color:#fff;text-align:center">Product Expiry</th>
<th style="color:#fff;text-align:center">Rack No.</th>
<th style="color:#fff;text-align:center">Edit</th>
<th style="color:#fff;text-align:center">Delete</th>
</tr>
</thead>
<?php 
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

$qq="SELECT a.rmId,a.sage_code,a.focus_code,a.description,b.uom AS unit_name,CONCAT(c.company_code,' - ',c.company_name) AS company_name,CONCAT(d.loc_code,' - ',d.location_name) AS location_name,a.reorder_level_qty,a.product_expiry,a.rackNo FROM `rm_master` AS a
LEFT JOIN `uom_tbl` AS b ON a.UOM=b.ID
LEFT JOIN `company_tbl` AS c ON a.company_id=c.id
LEFT JOIN `location_tbl` AS d ON a.location_id=d.id
WHERE a.sts='0'";
//echo $qq."<Br>";
$stm=$mysql->prepare($qq);
$stm->execute();
$cnt=1;
while($row=$stm->fetch(PDO::FETCH_ASSOC))
{

$id=$row['rmId'];
echo'<tr>';
echo '<td>'.$cnt.'</td>';
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
echo '<td align="center"><a href="javascript:del('.$id.','.$_SESSION['uId'].')"><i class="fa fa-trash" style="color:#F00"></i></a></td>';
}
echo '</tr>';
$cnt++;
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
<tbody>
</tbody>
</table>
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
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>
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
</script>
<script type="text/javascript">

$("#btnsubmit").click(function()
{
	/*alert("hi");
	alert(document.getElementById("desc").value);*/

	if($("#sage_code").val().trim() =="")
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
  if(document.getElementById('company_name').value=='0')
  {
	 alert('Plz, Select Company Name..!'); 
	 document.getElementById('company_name').focus();
  }
  else	
  {
      var id = document.getElementById('company_name').value;
	  var scriptUrl ='getLocations.php?compId='+id;
	  //alert(scriptUrl);
      $.ajax({url:scriptUrl,success:function(result)
      {	
	  	 //alert(result);
         //document.getElementById('location').innerHTML=result;
		  $("#location").html(result).trigger("chosen:updated.chosen");
      }}); 
  }
}	
</script>
</body>

</html>