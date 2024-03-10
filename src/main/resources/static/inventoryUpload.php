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
            <h1 class="h4 mb-0 text-gray-800" style="height:0px;padding-bottom: 10px;">Stock Entry Upload</h1>     
          </div>
          
<div class="card o-visible border-0 shadow-lg my-2">
<div class="card-body p-0">
<!-- Nested Row within Card Body -->
<div class="row">          
<div class="col-lg-12">
<div class="p-2"> 
<form class="user" action="inventoryUpload_ins.php" method="post" enctype="multipart/form-data"> 
<input type="hidden" id="euid" name="euid" value="<?php echo $_SESSION['uId']?>">
<div class="form-group row">
<div class="col-sm-6 mb-3 mb-sm-0">
<label class="m-0 font-weight-bold text-primary">Select CSV File.</label>
<input id="file" name="file" class="form-control"   type="file" required>
<!--<a href="Excel/fgstk.csv"><label style="color:#F00;margin-top:10px"><b>Click Here For Sample CSV</b></label></a><br>-->
</div>
</div>
<div class="form-group row">
<div class="col-sm-6 mb-3 mb-sm-0">
<input type="submit" id="btn" name="btn" class="btn btn-primary" value="Create" >
</div>
</div>
</form>



</div>
</div>
</div>
</div>
</div>
 
			
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
  </script>
    <script type="text/javascript">

  $("#btnsubmit").click(function()
  {
    /*alert("hi");
    alert(document.getElementById("desc").value);*/
    
    if($("#company_name").val().trim()=="0")
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
	else if($("#cat_id").val().trim() =="0")
    {
      $("#cat_id").addClass("require");
      alert("Please Select Category..!!");
      $("#cat_id").focus();
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
    else if($("#desc").val().trim()=="")
    {
      $("#desc").addClass("require");
      alert("Please Enter Description..!!");
      $("#desc").focus();
      return false;
    }
    else if($("#brand").val().trim()=="")
    {
      $("#brand").addClass("require");
      alert("Please Enter Brand..!!");
      $("#brand").focus();
      return false;
    }
    else if($("#uom").val().trim()=="0")
    {
      $("#uom").addClass("require");
      alert("Please Select UOM..!!");
      $("#uom").focus();
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
    else if($("#rackNo").val().trim()=="0")
    {
      $("#rackNo").addClass("require");
      alert("Please Select Rack No. ..!!");
      $("#rackNo").focus();
      return false;
    }    
    /*else if($("#barcode").val().trim()=="0")
    {
      $("#barcode").addClass("require");
      alert("Please Enter Barcode  ..!!");
      $("#barcode").focus();
      return false;
    }*/
    else
    {
      document.getElementById('btnsubmit').disabled=true;
            var url = "ins_fg_master.php"; 
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
           window.location.href='fgMaster.php';
           /* var a=data; 
            var str=a.split("*");
            alert(str[0]);
            alert(str[1]);
           // alert(a);
           myFunction(str[2],str[3],str[4],str[5],str[6],str[7]);
            window.location.href="sale_entry_n.php";*/
            
            //viewbill(a);
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
	  var scriptUrl ='getLocations.php?compId='+id+'&iType=2';
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