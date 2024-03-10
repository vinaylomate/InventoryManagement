<?php include('log_check.php')?>
<!DOCTYPE html>
<html lang="en">

<head>

 <?php
 include("inc/meta.php");
 ?>
 <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
 <script>
 function contactvalidation()
  {
	var contact=document.getElementById('txtph').value;
	//alert(s_name);
	var scriptUrl='getph.php?txtcontact='+contact;
	  $.ajax({url:scriptUrl,success:function(result)
		  {
		      //alert(result);
			 var str = result;
			 if(str == 1)
			 {
				 alert('This Contact No Already Exist..!');
				 document.getElementById('txtph').value='';
				 document.getElementById('txtph').focus();
			 }
			 
		   // $("#s_id").html(str);
		  }
		  });
  }
  
function mobvalidation()
  {
	var mobile=document.getElementById('txtmob').value;
	//alert(mobile);
	var scriptUrl='getmob.php?txtmob='+mobile;
	  $.ajax({url:scriptUrl,success:function(result)
		  {
		      //alert(result);
			 var str = result;
			 if(str == 1)
			 {
				 alert('This Mobile No Already Exist..!');
				 document.getElementById('txtmob').value='';
				 document.getElementById('txtmob').focus();
			 }
			 
		   // $("#s_id").html(str);
		  }
		  });

  }
 
 </script>
</head>

<body id="page-top">
<?php
$ID=$_GET['ID'];
include('mysql.connect.php');
$qry="SELECT ID,uom,desp FROM uom_tbl WHERE ID='$ID'";
//echo $qry."<br/>";
$st=$mysql->prepare($qry);
$st->execute();
$row=$st->fetch(PDO::FETCH_ASSOC);
$sId=$row['ID'];
$unit_name=$row['uom'];
$desp=$row['desp'];
$mysql=null;
?>
  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
  
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
       
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h4 mb-0 text-gray-800" style="height:0px;margin-top:10px">UOM / Packing Size / Capacity Master</h1>     
          </div>
          
          <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">          
          <div class="col-lg-12">
            <div class="p-5">             
              <form class="user" action="#" method="post" name="companyMaster" id="companyMaster"> 
              <input type="hidden" id="eId" name="eId" value="<?php echo $sId;?>">
              <input type="hidden" id="uid" name="uid" value="<?php echo $_SESSION['uId']?>">
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label class="m-0 font-weight-bold text-primary">Unit Name</label>
                  <input type="text" id="unit_name" name="unit_name" class="form-control form-control-sm" value="<?php echo $unit_name?>">
                  </div>
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label class="m-0 font-weight-bold text-primary">Description</label>
                    <textarea id="desc" name="desc" class="form-control form-control-sm" placeholder="Description" tabindex="2" onKeyUp="ChangeCase(this);" required><?php echo $desp?></textarea>
                  </div>
                </div>
                
               
                
                <div class="form-group row">
                 
                  
                <button type="button" id="btnsubmit" name="btnsubmit" class="btn btn-primary btn-group-sm" tabindex="3">Update</button>
               
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
    <script type="text/javascript">

  $("#btnsubmit").click(function()
  {
    /*alert("hi");
    alert(document.getElementById("desc").value);*/

    if($("#unit_name").val().trim() =="")
    {
      $("#unit_name").addClass("require");
      alert("Please Enter Unit Name..!!");
      $("#unit_name").focus();
      return false;
      //alert("bye");
    }
    
    
    else
    {
      document.getElementById('btnsubmit').disabled=true;
            var url = "edit_unit_master.php"; 
      //alert(url);
      // the script where you handle the form input.
      $.ajax({
           type: "POST",
           url: url,
           data: $("#companyMaster").serialize(), // serializes the form's elements.
           success: function(data)
           {
           alert(data);
           document.getElementById('btnsubmit').disabled=false;
           window.opener.location.reload();
           window.close();
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
</script>
</body>

</html>