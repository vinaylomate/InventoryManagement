<?php include('log_check.php');
$cmpId=$_SESSION['cmpId'];
$uiType=$_SESSION['iType'];
$userId=$_SESSION['uId'];
$uRole=$_SESSION['uRole'];
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
{ left: -9000px;

}
</style>
</head>

<body id="page-top" onLoad="getLoc()">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
<?php
include("inc/menu.php");
date_default_timezone_set('Asia/Calcutta');
$dt=date('Y-m-d');        
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
<?php  
	$yr=date('Y');
	$mnt=date('m',strtotime($yr));
	
	//echo $mnt;
	
	if(($mnt<'04'))
	{
		$financialyeardate= date('Y-04-01',strtotime('-1 year'));
		$financialyeardate2=date('Y-03-31');
		//echo "IF : ".$financialyeardate."<br>";
		//echo "IF : ".$financialyeardate2."<br>";
	}
	else
	{
		$financialyeardate= date('Y-04-01');
		$financialyeardate2=date('Y-03-31',strtotime('+1 year'));
		//echo "Else : ".$financialyeardate."<br>";
		//echo "Else : ".$financialyeardate2."<br>";	
	}
	$date3 = date('Y',strtotime($financialyeardate));
	//$curyear2=strftime('%y',$date2);
	$curyear3=strftime('%y',strtotime($financialyeardate));
	//echo $curyear3." : ";
	$date2 = strtotime($financialyeardate2);
	$date22 = strtotime($date3);
	
	
	$curyear2=strftime('%y',$date2);
	//$fiscalYr1=$date3.'-'.$curyear2;
    $fiscalYr1=$date3;		  
	//$fiscalYr=strftime('%y',$date22).$curyear2;
	$fiscalYr=strftime('%y',$date22);	  
?>
        <!-- Begin Page Content -->
<div class="container-fluid">
<!-- Page Heading -->
<div class="align-items-center justify-content-between mb-2" style="background-color:#3c8dbc;border-radius:5px;" align="center">
<h1 class="h3 mb-0 text-gray-801" style="padding-bottom: 5px;">Stock Entry Form</h1>   
</div>
<form class="user" action="#" method="POST" id="companyMaster" name="companyMaster" enctype="multipart/form-data">	
<div class="card o-visible border-0 shadow-lg my-2"><div class="card-body p-0">
<!-- Nested Row within Card Body -->

<input type="hidden" id="uid" name="uid" value="<?php echo $_SESSION['uId']?>">
<input type="hidden" id="urole" name="urole" value="<?php echo $uRole;?>">	
<input type="hidden" id="yr" name="yr" value="<?php echo $fiscalYr;?>">	
<input type="hidden" id="yr2" name="yr2" value="<?php echo $fiscalYr1;?>">	
<!-- Formula First Start-->
<div class="row">          
<div class="col-lg-12">
<div class="p-2">             
<table cellpadding="5px">
<tr>
<td valign="top"><label class="m-0 font-weight-bold text-primary">Company</label></td>	
<td valign="top">:</td>	
<td valign="top">
<select class="chosen-select form-control form-control-sm" id="compId" name="compId" tabindex="1" required onChange="getLoc()" style="width:250px;">
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
<select class="chosen-select form-control form-control-sm" id="iType" name="iType" tabindex="2" onChange="getLoc();getproduct();" style="width:250px;" required>
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
<select class="chosen-select form-control form-control-sm" id="location" name="location" tabindex="3" onChange="getproduct();" style="width:250px;">
<option value="0">Select</option>
</select>
</td>		
</tr>	
	
<tr>
<td valign="top"><label class="m-0 font-weight-bold text-primary">Doc. No</label></td>	
<td valign="top">:</td>	
<td valign="top">
<input type="text" class="form-control form-control-sm" id="txtserialno" name="txtserialno" value="<?php echo $s_code;?>" placeholder="Serial No" readonly>
</td>
	

<td valign="top"><label class="m-0 font-weight-bold text-primary">Date</label></td>	
<td valign="top">:</td>	
<td valign="top">
<input type="date" class="form-control form-control-sm" id="txtdt" name="txtdt" value="<?php echo $dt?>" tabindex="4">
</td>		
	
<td valign="top"><label class="m-0 font-weight-bold text-primary">Entry Type</label></td>	
<td valign="top">:</td>	
<td valign="top">
<select class="chosen-select form-control form-control-sm" id="eType" name="eType" tabindex="5" onChange="geteType()" required>
<option value="0">Select</option>
<?php
include("mysql.connect.php");
$q="SELECT entryId AS ID,entryNm FROM entry_type_tbl WHERE sts='0' AND (entryId!='10' AND entryId!='11' AND entryId!='12') ORDER BY entryNm";
$s=$mysql->prepare($q);
$s->setFetchMode(PDO::FETCH_ASSOC);
$s->execute();
while($r=$s->fetch())
{
  echo "<option value=".$r['ID'].">".$r['entryNm']."</option>";
}
$mysql=null;
?>	
</select>
<input type="hidden" class="form-control form-control-sm" id="txteType" name="txteType" value="0" readonly>
</td>		
</tr>	
	
<tr>
<td valign="top"></td>	
<td valign="top"></td>	
<td valign="top">
<input type="radio" id="rbmn" name="rb" value="0" tabindex="6" onChange="showProduct();" checked>
<label class="m-0 font-weight-bold text-primary">Manually</label>
<input type="radio" id="rbsc" name="rb" value="1" tabindex="6" onChange="showProduct();">
<label class="m-0 font-weight-bold text-primary">Scan Barcode</label>
<input type="hidden" class="form-control form-control-sm" id="typ" name="typ" value="0" readonly>	
</td>		

<td valign="top"><label class="m-0 font-weight-bold text-primary" id="lbl1">Product</label></td>	
<td valign="top">:</td>	
<td valign="top">
<div id="rmshow">
<select class="chosen-select form-control form-control-sm" id="itemId" name="itemId" tabindex="7.1" onChange="getProductInfo();" required>
<option value="0">Select</option>
</select>
</div>  
<div id="fgbar" style="visibility: hidden;overflow: hidden;height: 0px;">	
<input type="text" class="form-control form-control-sm" id="txtbar" name="txtbar" placeholder="Barcode" tabindex="7.1" value="" onChange="getInfo('tbl_prod')" required>
</div>
</td>	
	
<td valign="top"><label class="m-0 font-weight-bold text-primary" id="lblbct" style="visibility: hidden;overflow: hidden;height: 0px;">Batch No</label></td>	
<td valign="top"><label id="lblbct2" style="visibility: hidden;overflow: hidden;height: 0px;">:</label></td>
<td valign="top">
<div id="divbct" style="visibility: hidden;overflow: hidden;height: 0px;">
<select class="chosen-select form-control form-control-sm" id="bctNo" name="bctNo" tabindex="7.2">
<option value="0">Select</option>
</select>	
</div>	
</td>		
</tr>	
	
<tr>
<td valign="top"><label class="m-0 font-weight-bold text-primary">Reference</label></td>	
<td valign="top">:</td>	
<td valign="top">
<input type="text" class="form-control form-control-sm" id="ref" name="ref" value="-" placeholder="Reference" tabindex="13.1">
</td>
	

<td valign="top"><label class="m-0 font-weight-bold text-primary">Notes</label></td>	
<td valign="top">:</td>	
<td valign="top">
<input type="text" class="form-control form-control-sm" id="nts" name="nts" value="-" placeholder="Reference" tabindex="13.2">
</td>		
	
<td valign="top"><label class="m-0 font-weight-bold text-primary"></label></td>	
<td valign="top"></td>	
<td valign="top"><button type="button" id="btnAdd" name="btnAdd" class="btn btn-success" tabindex="8" onClick="getInfo('tbl_prod')">Add</button>
<button type="button" id="btndel" name="btndel" class="btn btn-warning" tabindex="15" onClick="delRows('tbl_prod')">Remove</button>	
</td>		
</tr>	
</table>
</div>
</div>
</div>
<!-- Formula First End--> 
<!-- Formula Second End-->

</div>
</div><!--end--> 

<div class="card o-hidden border-0 shadow-lg my-2"><div class="card-body p-0">
<!-- Nested Row within Card Body -->
	
<!-- Formula First Start-->
<div class="row">          
<div class="col-lg-12">
<div class="p-2">
<div class="form-group row">
<div class="col-sm-6 mb-3 mb-sm-0">
<label class="m-0 font-weight-bold text-primary" style="font-size : 20px;"><b>Total Qty : </b></label>
<label class="m-0 font-weight-bold text-primary1" style="font-size : 30px;" id="counting"><b>0</b></label>
<input type="hidden" class="form-control form-control-sm" id="rec" name="rec" placeholder="" value="0" readonly>	
</div>	
<div class="col-sm-6 mb-3 mb-sm-0" align="right">	
<button type="button" id="btn" name="btn" class="btn btn-primary" tabindex="14">Save</button>		
</div>	
</div>
<div class="form-group row">                  
<div class="col-sm-12 mb-3 mb-sm-0 table-responsive">
<table width="100%" id="tbl_prod" class="table table-bordered">
<tr style="background-color:#b02923">
<th style="color:#fff;text-align:center">No.</th>   
<th style="color:#fff;text-align:center">Sage Code</th>   
<th style="color:#fff;text-align:center">Focus Code</th>   
<th style="color:#fff;text-align:center">Barcode</th>   
<th style="color:#fff;text-align:center">Description</th>   
<th style="color:#fff;text-align:center">Entry Type</th>     
<th style="color:#fff;text-align:center">Batch No</th>     
<th style="color:#fff;text-align:center">Stock Qty</th>       
<th style="color:#fff;text-align:center">Qty</th>     
<th style="color:#fff;text-align:center">Bal. Qty</th>     
<th style="color:#fff;text-align:center">Expiry Date</th>    
<!--<th style="color:#fff;text-align:center">Reference</th>      
<th style="color:#fff;text-align:center">Notes</th>-->               
</tr>	  
</table> 
</div>
</div>
	
<div class="form-group row">
<div class="col-sm-6 mb-3 mb-sm-0">

</div>  
<div class="col-sm-6 mb-3 mb-sm-0">
<label class="m-0 font-weight-bold text-primary"></label>
 
</div>
<div id="abc"></div>

</div>	
</div>
</div>
</div>
<!-- Formula First End--> 
<!-- Formula Second End-->

</div>
</div><!--end--> 	
</form>  
<!-- DataTales Example -->
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
	  var scriptUrl ='getLocations.php?compId='+id+'&iType='+iType+'&uId='+uId;
	  //alert(scriptUrl);
      $.ajax({url:scriptUrl,success:function(result)
      {	
	  	 //alert(result);
         //document.getElementById('location').innerHTML=result;
		  $("#location").html(result).trigger("chosen:updated.chosen");
      }});
  }
}
	  
function getproduct()	
{
  if(document.getElementById('compId').value=='0')
  {
	 //alert('Plz, Select Company..!'); 
	 document.getElementById('compId').focus();
    //$("#iType").val(0).trigger("chosen:updated.chosen");
  }
  else if(document.getElementById('iType').value=='0')
  {
	 //alert('Plz, Select Product Category..!'); 
	 document.getElementById('iType').focus();
    //$("#iType").val(0).trigger("chosen:updated.chosen");
  }
  else if(document.getElementById('location').value=='0')
  {
	 //alert('Plz, Select Location..!'); 
	 document.getElementById('location').focus();
     //$("#iType").val(0).trigger("chosen:updated.chosen");
  }
  else	
  {
    	var id = document.getElementById('iType').value;
        var compId = document.getElementById('compId').value;
        var locId = document.getElementById('location').value;
        var yr = document.getElementById('yr').value;
        var yr2 = document.getElementById('yr2').value;
        var scriptUrl ='getProducts.php?iType='+id+'&compId='+compId+'&locId='+locId+'&yr='+yr+'&yr2='+yr2;
        //alert(scriptUrl);
        $.ajax({url:scriptUrl,success:function(result)
        {	
           //alert(result);
			var str=result.split('@');
           //document.getElementById('location').innerHTML=result; 
            $("#itemId").html(str[0]).trigger("chosen:updated.chosen");
			document.getElementById('txtserialno').value=str[1]; 
        }}); 
  }
}
	  
function getProductInfo()
{
	  if(document.getElementById('compId').value=='0')
	  {
		 alert('Plz, Select Company..!'); 
		 document.getElementById('compId').focus();
	  }
	  else if(document.getElementById('iType').value=='0')
	  {
		 alert('Plz, Select Product Category..!'); 
		 document.getElementById('iType').focus();
	  }
	  else if(document.getElementById('location').value=='0')
	  {
		 alert('Plz, Select Location..!'); 
		 document.getElementById('location').focus();
	  }
	  else if(document.getElementById('txteType').value=='0' || document.getElementById('txteType').value=='')
	  {
		 alert('Plz, Select Entry Type..!'); 
		 document.getElementById('eType').focus();
	  }
	  else if(document.getElementById('itemId').value=='0')
	  {
		 alert('Plz, Select Product..!'); 
		 document.getElementById('itemId').focus();
	  }
	  else	
	  {	
		var iType=document.getElementById('iType').value;	
		var compId=document.getElementById('compId').value;	
		var locId=document.getElementById('location').value;
		var eType=document.getElementById('txteType').value;
		var itemId=document.getElementById('itemId').value;
		if(eType=='2')
		{
			//alert(aa);
			var scripturl='getProductBctNo.php?iType='+iType+'&compId='+compId+'&locId='+locId+'&eType='+eType+'&itemId='+itemId;
			//alert(scripturl);
			$.ajax({url:scripturl,success:function(res)
			{
				//alert(res);
				$("#bctNo").html(res).trigger("chosen:updated.chosen");
			}});	
		}
	  }
}	  
	  
function geteType()
{
  if(document.getElementById('eType').value=='0')
  {
	 alert('Plz, Select Entry Type..!'); 
	 document.getElementById('eType').focus();
  }
  else	
  {
      var id = document.getElementById('eType').value;
	  var scriptUrl ='geteType.php?Id='+id;
	  //alert(scriptUrl);
      $.ajax({url:scriptUrl,success:function(result)
      {	
	  	 //alert(result);
		  document.getElementById('txteType').value=result; 
		  if(result=='2')
		  {
			  //lblbct,lblbct2,divbct,bctNo
			  document.getElementById('lblbct').style.visibility='visible';
			  document.getElementById('lblbct').style.overflow='visible';
			  document.getElementById('lblbct').style.height='auto';
			  
			  document.getElementById('lblbct2').style.visibility='visible';
			  document.getElementById('lblbct2').style.overflow='visible';
			  document.getElementById('lblbct2').style.height='auto';
			  
			  document.getElementById('divbct').style.visibility='visible';
			  document.getElementById('divbct').style.overflow='visible';
			  document.getElementById('divbct').style.height='auto';
		  }
		  else 
		  {
			  //lblbct,lblbct2,divbct,bctNo
			  document.getElementById('lblbct').style.visibility='hidden';
			  document.getElementById('lblbct').style.overflow='hidden';
			  document.getElementById('lblbct').style.height='0px';
			  
			  document.getElementById('lblbct2').style.visibility='hidden';
			  document.getElementById('lblbct2').style.overflow='hidden';
			  document.getElementById('lblbct2').style.height='0px';
			  
			  document.getElementById('divbct').style.visibility='hidden';
			  document.getElementById('divbct').style.overflow='hidden';
			  document.getElementById('divbct').style.height='0px';
		  }
      }}); 
  }
}	  

function getInfo(tableID)
{
	var b=0;	
	var typ=document.getElementById('typ').value;
	var iType = document.getElementById('iType').value;
	
	if(typ=='0')
	{
		var id=document.getElementById('itemId').value;
		b=0;
	}
	else
	{
		var id=document.getElementById('txtbar').value;
		b=1;
	}
	
	if(id=='' || id=='0')
	{}
	else if(document.getElementById('eType').value=='0')
	{
		alert('Plz, Select Entry Type...!');
		document.getElementById('eType').focus();
	}
	else
	{
		var e = document.getElementById("eType");
		var eTypeText = e.options[e.selectedIndex].text;
		var eType=eTypeText;
		var eTypeId=e.value;
		var txteType=document.getElementById('txteType').value;
		var compId=document.getElementById('compId').value;
		var locId=document.getElementById('location').value;
		var dt=document.getElementById('txtdt').value;
		var bctNo="";
		var stkId2=0;
		var stkId=0;
		
		if(txteType=='2')
		{
		  var btc11 = document.getElementById("bctNo");
          var bct = btc11.options[btc11.selectedIndex].text;
          var bctNo=bct;
          var bctId=btc11.value.split('||');
		  var stkId2=bctId[0];
		  var stkId=bctId[1];
		}
		
        var scripturl='getProductsInfoN.php?iType='+iType+'&itemId='+id+'&dt='+dt+'&b='+b+'&compId='+compId+'&locId='+locId+'&typ='+typ+'&stkId2='+stkId2+'&bct='+bctNo+'&eType='+txteType;
        //alert(scripturl);
        $.ajax({url:scripturl,success:function(res)
        {
            //alert(res);
			var str=res.split('||');
			var itemId=str[0].trim();
			var sagecd=str[1];
			var focuscd=str[2];
			var bar=str[3];
			var desp=str[4];
			var expdt=str[5];
			var stkqty=str[6];
			var rordqty=str[7];
			var rackNo=str[8];
			//alert('Stock Qty : '+stkqty);
			var pItemId= document.getElementsByName("item_id[]");
			var pcompId= document.getElementsByName("cmpId[]");
			var plcId= document.getElementsByName("lcId[]");//
			var peTypeId= document.getElementsByName("eTypesId[]");
			var batchdd= document.getElementsByName("batch[]");
			var pstkId= document.getElementsByName("stkId[]");
			var batchId= document.getElementsByName("stkId2[]");
			
			var flag=0;
			for(var i=0;i<pItemId.length;i++)
			{
				if(id==pItemId[i].value && compId==pcompId[i].value && locId==plcId[i].value && eTypeId==peTypeId[i].value && batchdd[i].value==bctNo && stkId==pstkId[i].value && stkId2==batchId[i].value)
				{
					flag++;
				}
			}
			
			if(flag==1)
			{
				alert("Product Already Added...!");
			}
			else
			{
				var table = document.getElementById(tableID);
				var rowCount = table.rows.length;
				var str=rowCount-1;
				var row = table.insertRow(rowCount);
				if(rowCount=='1')
				counts=0;

				var k=str+1;
				var cell0 = row.insertCell(0);
				cell0.style.backgroundColor = "white";
				var element = document.createElement("input");
				element.type = "checkbox";
				element.name="chkbox[]";
				element.id="chkbox"+k;
				element.style.color="black";
				element.style.fontWeight="bold";
				cell0.appendChild(element);	

				var element01 = document.createElement("input");
				element01.type = "hidden";
				element01.name="cmpId[]";
				element01.id="cmpId"+k;
				element01.value=document.getElementById('compId').value;
				cell0.appendChild(element01);	

				var element02 = document.createElement("input");
				element02.type = "hidden";
				element02.name="lcId[]";
				element02.id="lcId"+k;
				element02.value=document.getElementById('location').value;
				cell0.appendChild(element02);

				var cell1 = row.insertCell(1);
				cell1.style.backgroundColor = "white";
				var element1 = document.createElement("label");
				element1.id="sg"+k;
				element1.innerHTML=sagecd;
				element1.style.color="black";
				element1.style.fontWeight="bold";
				cell1.appendChild(element1);	

				var cell2 = row.insertCell(2);
				cell2.style.backgroundColor = "white";
				var element2 = document.createElement("label");
				element2.id="fc"+k;
				element2.innerHTML=focuscd;
				element2.style.color="black";
				element2.style.fontWeight="bold";
				cell2.appendChild(element2);	

				var cell3 = row.insertCell(3);
				cell3.style.backgroundColor = "white";
				var element3 = document.createElement("label");
				element3.id="bar"+k;
				element3.innerHTML=bar;
				element3.style.color="black";
				element3.style.fontWeight="bold";
				cell3.appendChild(element3);

				var element31 = document.createElement("input");
				element31.type = "hidden";
				element31.name="item_id[]";
				element31.id="item_id"+k;
				element31.value=itemId;
				cell3.appendChild(element31);	

				var cell4 = row.insertCell(4);
				cell4.style.backgroundColor = "white";
				var element4 = document.createElement("label");
				element4.id="desp"+k;
				element4.innerHTML=desp;
				element4.style.color="black";
				element4.style.fontWeight="bold";
				cell4.appendChild(element4);	

				var cell5 = row.insertCell(5);
				cell5.style.backgroundColor = "white";
				var element5 = document.createElement("label");
				element5.id="ety"+k;
				element5.style.color="black";
				element5.style.fontWeight="bold";
				element5.innerHTML=eType;
				cell5.appendChild(element5);	

				var element51 = document.createElement("input");
				element51.type = "hidden";
				element51.name="eTypesId[]";
				element51.id="eTypesId"+k;
				element51.value=eTypeId;
				cell5.appendChild(element51);	

				var element52 = document.createElement("input");
				element52.type = "hidden";
				element52.name="eTypes[]";
				element52.id="eTypes"+k;
				element52.value=txteType;
				cell5.appendChild(element52);
				
				if(txteType=='2')
				{
					var cell6 = row.insertCell(6);
					cell6.style.backgroundColor = "white";
					var element6 = document.createElement("input");
					element6.type = "text";
					element6.name="batch[]";
					element6.id="batch"+k;
					element6.value=bctNo;
					element6.readOnly=true;					
					element6.style.width="90px";	
					element6.style.backgroundColor="#c3c2c2";
					element6.style.fontWeight="bold";
					cell6.appendChild(element6);	
				}
				else
				{
					var cell6 = row.insertCell(6);
					cell6.style.backgroundColor = "white";
					var element6 = document.createElement("input");
					element6.type = "text";
					element6.name="batch[]";
					element6.id="batch"+k;
					element6.value=bctNo;
					element6.tabIndex='9.'+k;
					element6.style.width="90px";
					cell6.appendChild(element6);	
				}

				var cell7 = row.insertCell(7);
				cell7.style.backgroundColor = "white";
				var element7 = document.createElement("input");
				element7.type = "text";
				element7.name="stkqty[]";
				element7.id="stkqty"+k;
				element7.value=stkqty;
				element7.readOnly=true;		
				element7.style.backgroundColor="#c3c2c2";				
				element7.style.fontWeight="bold";
				element7.style.width="50px";
				cell7.appendChild(element7);

				var cell8 = row.insertCell(8);
				cell8.style.backgroundColor = "white";
				var element8 = document.createElement("input");
				element8.type = "text";
				element8.name="qty[]";
				element8.id="qty"+k;
				element8.value="1";				
				element8.style.fontWeight="bold";
				element8.tabIndex='10.'+k;
				element8.style.width="50px";
				element8.onchange = function()
				{
				  calc();
				}
				cell8.appendChild(element8);

				var cell9 = row.insertCell(9);
				cell9.style.backgroundColor = "white";
				var element9 = document.createElement("input");
				element9.type = "text";
				element9.name="bqty[]";
				element9.id="bqty"+k;
				element9.value=stkqty;	
				element9.style.backgroundColor="#c3c2c2";
				element9.readOnly=true;				
				element9.style.fontWeight="bold";
				element9.style.width="50px";
				cell9.appendChild(element9);
				
				var element91 = document.createElement("input");
				element91.type = "hidden";
				element91.name="rordqty[]";
				element91.id="rordqty"+k;
				element91.value=rordqty;
				element91.readOnly=true;
				element91.style.width="50px";
				cell9.appendChild(element91);
				
				var element92 = document.createElement("input");
				element92.type = "hidden";
				element92.name="rackNo[]";
				element92.id="rackNo"+k;
				element92.value=rackNo;
				element92.readOnly=true;
				element92.style.width="50px";
				cell9.appendChild(element92);
				
				if(txteType=='2')
				{				  
					var cell10 = row.insertCell(10);
					cell10.style.backgroundColor = "white";
					var element10 = document.createElement("input");
					element10.type = "text";
					element10.name="expdt[]";
					element10.id="expdt"+k;
					element10.value="-";
					element10.style.width="120px";
					element10.style.fontWeight="bold";
					element10.readOnly=true;
					element10.style.backgroundColor="#c3c2c2";
					cell10.appendChild(element10);	
				}
				else
				{				  
					var cell10 = row.insertCell(10);
					cell10.style.backgroundColor = "white";
					var element10 = document.createElement("input");
					element10.type = "date";
					element10.name="expdt[]";
					element10.id="expdt"+k;
					element10.value=expdt;
					element10.style.width="120px";
					element10.style.fontWeight="bold";
					element10.readOnly=true;
					cell10.appendChild(element10);	
				}
				
				var element11 = document.createElement("input");
				element11.type = "hidden";
				element11.name="stkId[]";
				element11.id="stkId"+k;
				element11.value=stkId;
				element11.style.width="50px";
				cell10.appendChild(element11);
				
				var element12 = document.createElement("input");
				element12.type = "hidden";
				element12.name="stkId2[]";
				element12.id="stkId2"+k;
				element12.value=stkId2;
				element12.style.width="50px";
				cell10.appendChild(element12);

				/*var cell11 = row.insertCell(11);
				cell11.style.backgroundColor = "white";
				var element11 = document.createElement("input");
				element11.type = "text";
				element11.name="ref[]";
				element11.id="ref"+k;
				element11.value="-";
				element11.tabIndex='11.'+k;
				element11.style.width="50px";
				cell11.appendChild(element11);

				var cell12 = row.insertCell(12);
				cell12.style.backgroundColor = "white";
				var element12 = document.createElement("input");
				element12.type = "text";
				element12.name="nts[]";
				element12.id="nts"+k;
				element12.value="-";
				element12.tabIndex='12.'+k;
				element12.style.width="50px";
				cell12.appendChild(element12);*/
				counts=counts+1;
				/*
				if(cnt==0)
				{
					document.getElementById('counting').innerHTML=counts;	
				}
				else
				{
					document.getElementById('counting').innerHTML=(counts+cnt);	
				}*/
				document.getElementById('rec').value=k;
				calc();				
			}
        }});
	}
	
	if(typ=='0')
	{
		document.getElementById('itemId').focus();
        $("#itemId").val(0).trigger("chosen:updated.chosen");
        $("#bctNo").val(0).trigger("chosen:updated.chosen");
	}
	else
	{
		document.getElementById('txtbar').value="";
		document.getElementById('txtbar').focus();
	}
}
	  
function calc()
{
	var rec=parseInt(document.getElementById('rec').value);
	var totqty=0;
	for(var i=1;i<=rec;i++)
	{
		var etype=parseFloat(document.getElementById('eTypes'+i).value);		
		var qty=parseFloat(document.getElementById('qty'+i).value);
		var stkqty=parseFloat(document.getElementById('stkqty'+i).value);
		var bqty=parseFloat(document.getElementById('bqty'+i).value);
		var bbqty=0;
		totqty=totqty+qty;
		if(etype=='1')
		{
			bbqty=qty+stkqty;
		}
		else
		{
			if(qty>stkqty)
			{
				alert('Enter less than Stock Qty...!');
				document.getElementById('qty'+i).value="0";
				document.getElementById('qty'+i).focus();
			}
			else
			{
				bbqty=stkqty-qty;
			}
		}
		document.getElementById('bqty'+i).value=bbqty;
		//alert("Qty : "+qty+"||Stock Qty : "+stkqty+"||Bal.Qty : "+bqty+"|| Entry Type : "+etype);
	}
	document.getElementById('counting').innerHTML=totqty;
}
	  
function delRows(tableID)
{
  var chkbox,cmpId,lcId,sg,fc,bar,item_id,desp,ety,eTypesId,batch,qty,expdt,tbl,len,stkqty,bqty,ref,nts;
  var count = parseInt(document.getElementById('rec').value);
  //alert('hi');
  tbl = document.getElementById(tableID);
  len = tbl.rows.length;
  //alert(len);	
  var n = 1; // assumes ID numbers start at zero
  for (var i = 1; i<=len; i++) 
  {
	  //alert(i+" : "+len);
	  chkbox = document.getElementById("chkbox" + i);
	  cmpId = document.getElementById("cmpId" + i);
	  lcId = document.getElementById("lcId" + i);
	  sg= document.getElementById("sg" + i);
	  fc = document.getElementById("fc" + i);
	  bar= document.getElementById("bar" + i);
	  item_id= document.getElementById("item_id" + i);
	  desp= document.getElementById("desp" + i);
	  ety= document.getElementById("ety" + i);
	  eTypesId= document.getElementById("eTypesId" + i);
	  batch= document.getElementById("batch" + i);
	  qty= document.getElementById("qty" + i);
	  expdt= document.getElementById("expdt" + i);
	  stkqty= document.getElementById("stkqty" + i);
	  bqty= document.getElementById("bqty" + i);
	  /*ref= document.getElementById("ref" + i);
	  nts= document.getElementById("nts" + i);*/
	  //alert("chkbox" + i+chkbox.checked);
	  if (chkbox.checked) 
	  { 
		  //alert('Del : '+n);
		  tbl.deleteRow(n);
		  count--;
	  }
	  else
	  {   //,,,,,,,,,
		  chkbox.id = "chkbox" + n;
		  cmpId.id = "cmpId" + n;
		  lcId.id = "lcId" + n;
		  sg.id = "sg" + n;
		  fc.id = "fc" + n;
		  bar.id = "bar" + n;
		  item_id.id = "item_id" + n;
		  desp.id = "desp" + n;
		  ety.id = "ety" + n;
		  eTypesId.id = "eTypesId" + n;
		  batch.id = "batch" + n;
		  qty.id = "qty" + n;
		  expdt.id = "expdt" + n;
		  stkqty.id = "stkqty" + n;
		  bqty.id = "bqty" + n;
		  /*ref.id = "ref" + n;
		  nts.id = "nts" + n;*/
		  ++n;
	  }
	  //alert(count);
	  document.getElementById('rec').value = count;
	  calc();
  }
  	
}
	  
 $("#btn").click(function()
  {		
	 	if($("#compId").val().trim() == "0")
		{
			$("#compId").addClass("require");
			alert("Please Select Company...!");
			$("#compId").focus();
			return false;
		}
		else if($("#txtdt").val().trim() == "")
		{
			$("#txtdt").addClass("require");
			alert("Please Enter Date...!");
			$("#txtdt").focus();
			return false;
		}
	 
		else if($("#iType").val().trim() == "0")
		{
			$("#iType").addClass("require");
				alert("Please Select Product Category...!");
				$("#iType").focus();
				return false;
		}
		
		else if($("#location").val().trim() == "0" )
		{
			$("#location").addClass("require");
			alert("Please Select Location...!");
			$("#location").focus();
			return false;
		}
		
		else if($("#eType").val().trim() == "0")
		{
			$("#eType").addClass("require");
				alert("Please Select Entry Type ...!");
				$("#eType").focus();
				return false;
		}
		
		else if(document.getElementById('counting').innerHTML.trim() == "<b>0</b>" || document.getElementById('counting').innerHTML.trim() == "0")
		{
				$("#eType").addClass("require");
				alert("Please Enter Quantity ...!");
				$("#eType").focus();
				return false;
		}
    else
    {
      document.getElementById('btn').disabled=true;
            var url = "ins_inventory.php"; 
      //alert(url);
      // the script where you handle the form input.
      $.ajax({
           type: "POST",
           url: url,
           data: $("#companyMaster").serialize(), // serializes the form's elements.
           success: function(data)
           {
			   //alert(data);
			   var str=data.split('||');
			   alert(str[0]);
			   //document.getElementById('abc').innerHTML=data;
			   document.getElementById('btn').disabled=false;
			   view(str[1].trim());
			   window.location.href='inventoryEntry.php';
           }
         });
     
      e.preventDefault(); 
    }
     // avoid to execute the actual submit of the form.
  }); 
 function view(id)
{
	//alert('hi');
	window.open("getinventoryview.php?ID="+id, "_blank", "toolbar=yes, scrollbars=yes, resizable=no, top=60, left=0, width=1000, height=600");
}	  
function showProduct()
{
	if(document.getElementById('rbmn').checked==true)
	{
		document.getElementById('typ').value="0";
		document.getElementById('lbl1').innerHTML='Product';
		document.getElementById('rmshow').style.visibility='visible';
		document.getElementById('rmshow').style.overflow='visible';
		document.getElementById('rmshow').style.height="auto";
		document.getElementById('fgbar').style.visibility='hidden';
		document.getElementById('fgbar').style.overflow='hidden';
		document.getElementById('fgbar').style.height="0px";
	}
	if(document.getElementById('rbsc').checked==true)
	{
		document.getElementById('typ').value="1";
		document.getElementById('lbl1').innerHTML='Barcode';
		document.getElementById('fgbar').style.visibility='visible';
		document.getElementById('fgbar').style.overflow='visible';
		document.getElementById('fgbar').style.height="auto";
		document.getElementById('rmshow').style.visibility='hidden';
		document.getElementById('rmshow').style.overflow='hidden';
		document.getElementById('rmshow').style.height="0px";
	}
}
  </script>
</body>

</html>