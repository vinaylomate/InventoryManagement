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

{ left: -9000px;



}

</style> 

</head>



<body id="page-top" onLoad="getLoc();">



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

<h1 class="h3 mb-0 text-gray-801" style="padding-bottom: 5px;">Update Stock Info</h1>   

</div>

<form class="user" action="auto_openstock_calc_upt_ins.php" method="POST" id="companyMaster" name="companyMaster" enctype="multipart/form-data">	

<div class="card o-visible border-0 shadow-lg my-2"><div class="card-body p-0">

<!-- Nested Row within Card Body -->



<input type="hidden" id="uid" name="uid" value="<?php echo $_SESSION['uId']?>">

<input type="hidden" id="urole" name="urole" value="<?php echo $uRole;?>">

<input type="hidden" id="uiType" name="uiType" value="<?php echo $uiType;?>">

<input type="hidden" id="uloc" name="uloc" value="<?php echo $uloc;?>">	

<input type="hidden" id="ulocty" name="ulocty" value="<?php echo $ulocType;?>">

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

<select class="chosen-select form-control form-control-sm" id="location" name="location" tabindex="3" style="width:250px;">

<option value="0">Select</option>

</select>

</td>		

</tr>	

<tr>
<td valign="top"><label class="m-0 font-weight-bold text-primary" id="lbl1">Product</label></td>	

<td valign="top">:</td>	

<td valign="top">

<div id="rmshow">	

<div style="margin-bottom: 5px;">	

<input type="text" class="form-control form-control-sm" id="txtsearch" name="txtsearch" placeholder="Search" tabindex="4.1" value="" onChange="getproduct()">

</div>	

<select class="chosen-select form-control form-control-sm" id="itemId" name="itemId" tabindex="4.2" onChange="showOpClInfo()" style="width:250px;">

<option value="0">Select</option>

</select>

</div>  

</td>	

<td valign="top"><label class="m-0 font-weight-bold text-primary">Start Date</label></td>	

<td valign="top">:</td>	

<td valign="top">
<input type="date" class="form-control form-control-sm" id="txtdt" name="txtdt" value="<?php echo $dt?>" tabindex="4.3">
</td>
	
<td>
<button type="submit" id="btn" name="btn" class="btn btn-primary" tabindex="5">Update</button>			
</td>	
</tr>	
</table>

</div>

</div>

</div>

<div class="form-group row">                  

<div class="col-sm-6 mb-3 mb-sm-0 table-responsive" id="abc">

<table width="100%" id="tbl_prod" class="table table-bordered">
<tr style="background-color:#b02923">
<th style="color:#fff;text-align:center">No.</th>
<th style="color:#fff;text-align:center">Date</th>
<th style="color:#fff;text-align:center">Closing Stock</th>  
<th style="color:#fff;text-align:center">Next Date</th>
<th style="color:#fff;text-align:center">Opening Stock</th> 
</tr>
</table> 

</div>

</div>
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

	  var uloc= document.getElementById('uloc').value;

	  var uiType= document.getElementById('uiType').value;

	  var ulocty= document.getElementById('ulocty').value;

	  var urole= document.getElementById('urole').value;

	  var scriptUrl ='getLocations.php?compId='+id+'&iType='+iType+'&uiType='+uiType+'&uId='+uId+'&uloc='+uloc+'&ulocty='+ulocty+'&urole='+urole;

	  //alert(scriptUrl);

      $.ajax({url:scriptUrl,success:function(result)
      {	
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
  else if(document.getElementById('txtsearch').value=='')
  {
	 //alert('Plz, Select Location..!'); 
	 document.getElementById('txtsearch').focus();
     //$("#iType").val(0).trigger("chosen:updated.chosen");
  }
  else	
  {
    	var id = document.getElementById('iType').value;

        var compId = document.getElementById('compId').value;

        var locId = document.getElementById('location').value;

        var yr = document.getElementById('yr').value;

        var yr2 = document.getElementById('yr2').value;

	  	var srch =document.getElementById('txtsearch').value;

        var scriptUrl ='getProducts_n.php?iType='+id+'&compId='+compId+'&locId='+locId+'&yr='+yr+'&yr2='+yr2+'&srch='+srch;

        //alert(scriptUrl);

        $.ajax({url:scriptUrl,success:function(result)
        {	
            $("#itemId").html(result).trigger("chosen:updated.chosen");
			showOpClInfo();
			document.getElementById('txtsearch').value="";

        }}); 
  }
} 
	  
function showOpClInfo()	
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
  else if(document.getElementById('itemId').value=='0')
  {
	 //alert('Plz, Select Location..!'); 
	 document.getElementById('itemId').focus();
  }
  else	
  {
    	var id = document.getElementById('iType').value;

        var compId = document.getElementById('compId').value;

        var locId = document.getElementById('location').value;

        var itemId = document.getElementById('itemId').value;
	  
        var scriptUrl ='getopenstkInfo.php?iType='+id+'&compId='+compId+'&locId='+locId+'&itemId='+itemId;

        //alert(scriptUrl); 
	    $('#abc').load(scriptUrl);
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
    else
    {
	  var a=confirm("Do You Want Update Record....?");
	  //alert(a);
	  if(a==true)
	  {	
		  document.getElementById('btn').disabled=true;
		  var url = "auto_openstock_calc_upt_ins.php"; 
		  //alert(url);
		  // the script where you handle the form input.
		  $.ajax({

			   type: "POST",

			   url: url,

			   data: $("#companyMaster").serialize(), // serializes the form's elements.
			   success: function(data)
			   {
				   alert('Record Updated...!');
				   //document.getElementById('abc').innerHTML=data;
				   showOpClInfo();
				   document.getElementById('btn').disabled=false;
				   //window.location.href='auto_openstock_calc_upts.php';
			   }
});
		  e.preventDefault();
	  }
    }
     // avoid to execute the actual submit of the form.
  });

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