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
$qry="SELECT entryId,entryNm,eType,IF(eType='1','IN','OUT') AS eTypeNm FROM entry_type_tbl WHERE entryId='$ID'";
//echo $qry."<br/>";
$st=$mysql->prepare($qry);
$st->execute();
$row=$st->fetch(PDO::FETCH_ASSOC);
$entryId=$row['entryId'];
$entry_type_nm=$row['entryNm'];
$etype_nm=$row['eTypeNm'];
$etype=$row['eType'];
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
            <h1 class="h4 mb-0 text-gray-800" style="height:0px;margin-top:10px">Entry Type Master</h1>     
          </div>
          
          <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">          
          <div class="col-lg-12">
            <div class="p-5">             
              <form class="user" action="#" method="post" name="companyMaster" id="companyMaster"> 
              <input type="hidden" id="eId" name="eId" value="<?php echo $entryId;?>">
              <input type="hidden" id="uid" name="uid" value="<?php echo $_SESSION['uId']?>">
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label class="m-0 font-weight-bold text-primary">Entry Type</label>
                  <input type="text" id="entry_type" name="entry_type" class="form-control form-control-sm" value="<?php echo $entry_type_nm?>">
				  <input type="hidden" id="pentry_type" name="pentry_type" class="form-control form-control-sm" value="<?php echo $entry_type_nm?>">	  
                  </div>
                   <div class="col-sm-6 mb-3 mb-sm-0">
                  <label class="m-0 font-weight-bold text-primary">Entry Type</label>
                  <select class="form-control form-control-sm" id="eType" name="eType" tabindex="2">
				  <?php
					if($etype=='0')
					{
				  ?>
                  <option value="0">Select</option>
                  <option value="1">IN</option>
                  <option value="2">OUT</option>
                  <!--<option value="3">BOTH</option>-->
				  <?php
					}
					else if($etype=='1')
					{
					?>
                  <option value="1">IN</option>
                  <option value="2">OUT</option>
                  <!--<option value="3">BOTH</option>-->						  
					<?php	
					}
					else
					{
					?>
					  <option value="2">OUT</option>
					  <option value="1">IN</option>
					  <!--<option value="3">BOTH</option>-->
					<?php
					}
					 ?>
                  </select>
				  <input type="hidden" id="peType" name="peType" class="form-control form-control-sm" value="<?php echo $etype?>">
                  </div>
                </div>
                
               
                
                <div class="form-group row">
                 
                  
                <button type="button" id="btnsubmit" name="btnsubmit" class="btn btn-primary btn-group-sm" tabindex="3">Save</button>
               
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

    if($("#entry_type").val().trim() =="")
    {
      $("#entry_type").addClass("require");
      alert("Please Enter Entry Type Name..!!");
      $("#entry_type").focus();
      return false;
      //alert("bye");
    }
    
    
    else
    {
      document.getElementById('btnsubmit').disabled=true;
            var url = "edit_entry_master.php"; 
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