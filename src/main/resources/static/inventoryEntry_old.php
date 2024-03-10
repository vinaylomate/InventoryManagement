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
	{ left: -9000px;
	
	}
  </style>
<script type="text/javascript">
function getProductInfo()
{
  if(document.getElementById('iType').value=='0')
  {
	 alert('Plz, Select Product Category..!'); 
	 document.getElementById('iType').focus();
  }
  else	
  {	
	var iType=document.getElementById('iType').value;	
	var dt=document.getElementById('txtdt').value;	
	var rec=parseFloat(document.getElementById('rec').value);
	 //alert(iType+" : "+dt+" : "+rec);
	  var aa=new Array();
	if(rec==0)
	{
		
	}
	else
	{		
		for(var i=1;i<=rec;i++)
		{
			var itemId=document.getElementById('item_id'+i).value;
			aa.push(itemId);		
		}
		  alert(aa);
		var scripturl='getProductsInfo.php?iType='+iType+'&itemId='+aa+'&dt='+dt;
			alert(scripturl);
		  /*$.ajax({url:scripturl,success:function(res)
			{
				//alert(res);
				document.getElementById('expdt'+i).value=res;
				alert(document.getElementById('expdt'+i).value);
			}});*/	
	}
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

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="align-items-center justify-content-between mb-4" style="background-color:#3c8dbc;border-radius:5px;" align="center">
			<h1 class="h3 mb-0 text-gray-801">Inventory Form</h1>   
          </div>
<form class="user" action="#" method="POST" id="companyMaster" name="companyMaster" enctype="multipart/form-data">	
	<div class="card o-hidden border-0 shadow-lg my-5"><div class="card-body p-0">
        <!-- Nested Row within Card Body -->
 		 
         <input type="hidden" id="uid" name="uid" value="<?php echo $_SESSION['uId']?>">
        <!-- Formula First Start-->
        <div class="row">          
          <div class="col-lg-12">
            <div class="p-5">             
             
                <div class="form-group row">
                  
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label class="m-0 font-weight-bold text-primary">Company</label>
                    <select class="chosen-select form-control form-control-sm" id="compId" name="compId" tabindex="1" required onChange="getLoc()" >
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
                   <select class="chosen-select form-control form-control-sm" id="location" name="location" tabindex="2" onChange="getproduct();">
<option value="0">Select</option>
</select>
                  </div>
                </div>
                
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label class="m-0 font-weight-bold text-primary">Date</label>
                    <input type="date" class="form-control form-control-sm" id="txtdt" name="txtdt" value="<?php echo $dt?>" tabindex="3" onChange="getProductInfo();">
                  </div>
                  
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <?php 
			   include('mysql.connect.php');
			   $qry="SELECT MAX(docNo) AS `code` FROM doc_no_tbl";
			   $st=$mysql->prepare($qry);
			   $st->execute();
			   $row=$st->fetch(PDO::FETCH_ASSOC);
			   $code=$row['code'];
			   if($code<=9)
			   {
				   $s_code="DOC00000".($code+1);
			   }
			   
			   else if($code>9 && $code<99)
			   {
				   $s_code="DOC0000".($code+1);
			   }
			   else if($code>99 && $code<999)
			   {
				   $s_code="DOC000".($code+1);
			   }
			   else if($code>999 && $code<9999)
			   {
				   $s_code="DOC00".($code+1);
			   }
			   else if($code>9999 && $code<99999)
			   {
				   $s_code="DOC0".($code+1);
			   }
			   else 
			   {
				 $s_code="DOC".($code+1);
			   }
			   $mysql=null;
			   ?>
                  <label class="m-0 font-weight-bold text-primary">Doc. No</label>
                    <input type="text" class="form-control form-control-sm" id="txtserialno" name="txtserialno" value="<?php echo $s_code;?>" placeholder="Serial No" readonly>
                  
                  </div>
                  
                </div>
                
                <div class="form-group row">
                <div class="col-sm-6">
                    <label class="m-0 font-weight-bold text-primary">Product Category</label>
                    <select class="chosen-select form-control form-control-sm" id="iType" name="iType" tabindex="3" onChange="getproduct();" required>
                    <option value="0">Select</option>
                    <option value="1">RAW MATERIAL</option>
                    <option value="2">FINISHED GOODS</option>
                    </select>
                  </div>
                  <div class="col-sm-6">
                    <label class="m-0 font-weight-bold text-primary">Entry Type</label>
                    <select class="chosen-select form-control form-control-sm" id="eType" name="eType" tabindex="4" onChange="geteType()" required>
                    <option value="0">Select</option>
					<?php
                    include("mysql.connect.php");
					$q="SELECT entryId AS ID,entryNm FROM entry_type_tbl WHERE sts='0' ORDER BY entryNm";
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
                  </div>
                </div>
				
				<div class="form-group row">               
                  
                  <div class="col-sm-6">
					<div id="rmshow">
						<label class="m-0 font-weight-bold text-primary">Product</label>
                    <select class="chosen-select form-control form-control-sm" id="itemId" name="itemId" tabindex="4.1" onChange="getProductInfo();getInfo('tbl_prod','1')" required>
                    <option value="0">Select</option>
                    </select>
					  </div>  
					  <div id="fgbar" style="visibility: hidden;overflow: hidden;height: 0px;">					  
                  <label class="m-0 font-weight-bold text-primary">Barcode</label>
                    <input type="text" class="form-control form-control-sm" id="txtbar" name="txtbar" placeholder="Barcode" tabindex="4.1" value="" onChange="getInfo('tbl_prod','2')" required>
					  </div>
                  </div>
                
                  <div class="col-sm-6 mb-3 mb-sm-0">
					  <label class="m-0 font-weight-bold text-primary">
					</label> 
                  </div> 
                </div>
				
				<div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label class="m-0 font-weight-bold text-primary">References</label>
                    <textarea id="txtRemark" name="txtRemark" class="form-control form-control-sm" placeholder="Description" tabindex="7" required>-</textarea>
                  </div>  
                     <div class="col-sm-6 mb-3 mb-sm-0">
                 <label class="m-0 font-weight-bold text-primary">Note</label>
					<textarea id="txtnote" name="txtnote" class="form-control form-control-sm" placeholder="Description" tabindex="7.1" required>-</textarea> 
							 
                  </div>
                   
                  
                </div>
				
				<div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label class="m-0 font-weight-bold text-primary" style="font-size : 20px;"><b>Total Qty : </b></label>
                    <label class="m-0 font-weight-bold text-primary1" style="font-size : 30px;" id="counting"><b>0</b></label>
					  <input type="hidden" class="form-control form-control-sm" id="rec" name="rec" placeholder="" value="0" readonly>
                  </div>  
                     <div class="col-sm-6 mb-3 mb-sm-0">
                 	<label class="m-0 font-weight-bold text-primary"></label>
					<button type="button" id="btn" name="btn" class="btn btn-primary" tabindex="8.1">Save</button>	 
                  </div>
                   
                  
                </div>
             
            </div>
          </div>
        </div>
        <!-- Formula First End--> 
        <!-- Formula Second End-->
        
      </div>
    </div><!--end--> 
	
	<div class="card o-hidden border-0 shadow-lg my-5"><div class="card-body p-0">
        <!-- Nested Row within Card Body -->
 		 
         
        <!-- Formula First Start-->
        <div class="row">          
          <div class="col-lg-12">
            <div class="p-5">
				<div class="form-group row" align="right">
				<div class="col-sm-12 mb-3 mb-sm-0">	
				<button type="button" id="btndel" name="btndel" class="btn btn-warning" tabindex="8.1" onClick="delRows('tbl_prod')">Remove</button>	
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
					<th style="color:#fff;text-align:center">Qty</th>   
					<th style="color:#fff;text-align:center">Expiry Date</th>           
				   </tr>	  
				   </table> 
                  </div>
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
	 alert('Plz, Select Company Name..!'); 
	 document.getElementById('compId').focus();
  }
  else	
  {
      var id = document.getElementById('compId').value;
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
	  
function getproduct()	
{
  if(document.getElementById('iType').value=='0')
  {
	 //alert('Plz, Select Product Category..!'); 
	 document.getElementById('iType').focus();
    $("#iType").val(0).trigger("chosen:updated.chosen");
  }
  else if(document.getElementById('compId').value=='0')
  {
	 alert('Plz, Select Company..!'); 
	 document.getElementById('compId').focus();
    $("#iType").val(0).trigger("chosen:updated.chosen");
  }
  else if(document.getElementById('location').value=='0')
  {
	 alert('Plz, Select Location..!'); 
	 document.getElementById('location').focus();
    $("#iType").val(0).trigger("chosen:updated.chosen");
  }
  else	
  {
    if(document.getElementById('iType').value=='1')
	{
		document.getElementById('rmshow').style.visibility='visible';
		document.getElementById('rmshow').style.overflow='visible';
		document.getElementById('rmshow').style.height='auto';
		
		document.getElementById('fgbar').style.visibility='hidden';
		document.getElementById('fgbar').style.overflow='hidden';
		document.getElementById('fgbar').style.height='0px';
		
		var id = document.getElementById('iType').value;
        var compId = document.getElementById('compId').value;
        var locId = document.getElementById('location').value;
        var scriptUrl ='getProducts.php?iType='+id+'&compId='+compId+'&locId='+locId;
        //alert(scriptUrl);
        $.ajax({url:scriptUrl,success:function(result)
        {	
           //alert(result);
           //document.getElementById('location').innerHTML=result; 
            $("#itemId").html(result).trigger("chosen:updated.chosen");
        }}); 
	}
	  
	else
	{
		document.getElementById('fgbar').style.visibility='visible';
		document.getElementById('fgbar').style.overflow='auto';
		document.getElementById('fgbar').style.height='auto';
		document.getElementById('txtbar').focus();
		
		document.getElementById('rmshow').style.visibility='hidden';
		document.getElementById('rmshow').style.overflow='hidden';
		document.getElementById('rmshow').style.height='0px';
        $("#itemId").val(0).trigger("chosen:updated.chosen");
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
      }}); 
  }
}	  

function getInfo(tableID,iType)
{
	var b=0;
	
	if(iType=='1')
	{
		var id=document.getElementById('itemId').value;
		b=0;
	}
	else
	{
		var id=document.getElementById('txtbar').value;
		b=1;
	}
	
	if(id=='')
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
		
		var dt=document.getElementById('txtdt').value;	

        var scripturl='getProductsInfoN.php?iType='+iType+'&itemId='+id+'&dt='+dt+'&b='+b;
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

			var cell6 = row.insertCell(6);
			cell6.style.backgroundColor = "white";
			var element6 = document.createElement("input");
			element6.type = "text";
			element6.name="batch[]";
			element6.id="batch"+k;
			element6.value="-";
			element6.tabIndex='5.'+k;
			element6.style.width="80px";
			cell6.appendChild(element6);			

			var cell7 = row.insertCell(7);
			cell7.style.backgroundColor = "white";
			var element7 = document.createElement("input");
			element7.type = "text";
			element7.name="qty[]";
			element7.id="qty"+k;
			element7.value="1";
			element6.tabIndex='6.'+k;
			element7.style.width="50px";
			cell7.appendChild(element7);			

			var cell8 = row.insertCell(8);
			cell8.style.backgroundColor = "white";
			var element8 = document.createElement("input");
			element8.type = "date";
			element8.name="expdt[]";
			element8.id="expdt"+k;
			element8.value=expdt;
			element8.style.width="120px";
			element8.readOnly=true;
			cell8.appendChild(element8);

			counts=counts+1;
			document.getElementById('counting').innerHTML=counts;
			document.getElementById('rec').value=k;
        }});
	}
	
	if(iType=='1')
	{
		document.getElementById('itemId').focus();
        $("#itemId").val(0).trigger("chosen:updated.chosen");
	}
	else
	{
		document.getElementById('txtbar').value="";
		document.getElementById('txtbar').focus();
	}
}
	  
function delRows(tableID)
{
  var chkbox,cmpId,lcId,sg,fc,bar,item_id,desp,ety,eTypesId,batch,qty,expdt,tbl,len;
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
		  ++n;
	  }
	  //alert(count);
	  document.getElementById('rec').value = count;
  }	
}
	  
 $("#btn").click(function()
  {
    if($("#txtdt").val().trim() == "")
		{
			$("#txtdt").addClass("require");
			alert("Please Enter Date...!");
			$("#txtdt").focus();
			return false;
		}
		
		else if($("#compId").val().trim() == "0")
		{
			$("#txtpassword").addClass("require");
			alert("Please Select Company...!");
			$("#compId").focus();
			return false;
		}
		
		else if($("#location").val().trim() == "0" )
		{
			$("#location").addClass("require");
			alert("Please Select Location...!");
			$("#location").focus();
			return false;
		}
		
		else if($("#iType").val().trim() == "0")
		{
			$("#iType").addClass("require");
				alert("Please Select Product Category...!");
				$("#iType").focus();
				return false;
		}
		
		else if($("#eType").val().trim() == "0")
		{
			$("#eType").addClass("require");
				alert("Please Select Entry Type ...!");
				$("#eType").focus();
				return false;
		}
		
		else if(document.getElementById('counting').innerHTML.trim() == "0")
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
           alert(data);
           document.getElementById('btn').disabled=false;
           window.location.href='inventoryEntry.php';
           }
         });
     
      e.preventDefault(); 
    }
     // avoid to execute the actual submit of the form.
  }); 
  </script>
</body>

</html>