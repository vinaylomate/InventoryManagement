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
<?php
$ID=$_GET['ID'];
include('mysql.connect.php');
$qry="SELECT company_id,location_name,location_description,ID,loc_code FROM location_tbl WHERE ID='$ID'";
//echo $qry."<br>";
$st=$mysql->prepare($qry);
$st->execute();
$row=$st->fetch(PDO::FETCH_ASSOC);
$sId=$row['ID'];
$company_id=$row['company_id'];
$location_name=$row['location_name'];
$location_description=$row['location_description'];
$location_code=$row['loc_code'];
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
            <h1 class="h4 mb-0 text-gray-800" style="height:0px;margin-top:10px">Location Master</h1>     
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
                  <label class="m-0 font-weight-bold text-primary">Company Name</label>
                   <select name="company_id" id="company_id" class="chosen-select form-control form-control-sm" tabindex="1">
                    <?php
                      include("mysql.connect.php");
                      $q="select * from company_tbl where ID='$company_id'";
                      $s=$mysql->prepare($q);
                      $s->setFetchMode(PDO::FETCH_ASSOC);
                      $s->execute();
                      while($r=$s->fetch())
                      {
                        echo "<option value=".$r['ID'].">".$r['company_name']."</option>";
                      }
                      $q1="select * from company_tbl where ID!='$company_id'";
                      $s1=$mysql->prepare($q1);
                      $s1->setFetchMode(PDO::FETCH_ASSOC);
                      $s1->execute();
                      while($r1=$s1->fetch())
                      {
                        echo "<option value=".$r1['ID'].">".$r1['company_name']."</option>";
                      }

                      $mysql=null;
                    ?>
                   </select>
              <input type="hidden" id="pcompany_id" name="pcompany_id" value="<?php echo $company_id;?>">
                  </div>
					
					
                  <div class="col-sm-6">
                    <label class="m-0 font-weight-bold text-primary">Location Code</label>
                    <input type="text" class="form-control form-control-sm" id="txtlcode" name="txtlcode" placeholder="Location Code" onKeyUp="ChangeCase(this);" value="<?php echo $location_code;?>" readonly>
                  </div>
					
                  
                </div>
                
                <div class="form-group row">
				<div class="col-sm-6">
                    <label class="m-0 font-weight-bold text-primary">Location Name</label>
                    <input type="text" class="form-control form-control-sm" id="txtnm" name="txtnm" placeholder="Location Name" value="<?php echo $location_name;?>" tabindex="2" required>
                   
                    <input type="hidden" class="form-control form-control-sm" id="ptxtnm" name="ptxtnm" placeholder="Location Name" value="<?php echo $location_name;?>">
                  </div>	
					
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label class="m-0 font-weight-bold text-primary">Description</label>
                    <textarea id="txtdesc" name="txtdesc" class="form-control form-control-sm" placeholder="Supplier Address" tabindex="3" required><?php echo $location_description;?></textarea>
              <input type="hidden" id="ptxtdesc" name="ptxtdesc" value="<?php echo $location_description;?>">
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

    if($("#txtnm").val().trim() =="")
    {
      $("#txtnm").addClass("require");
      alert("Please Enter Location Name..!!");
      $("#txtnm").focus();
      return false;
      //alert("bye");
    }
    else if($("#txtdesc").val().trim()=="")
    {
      $("#txtdesc").addClass("require");
      alert("Please Enter Location Description..!!");
      $("#txtdesc").focus();
      return false;
    }
    
    
    else
    {
      document.getElementById('btnsubmit').disabled=true;
            var url = "edit_location_master.php"; 
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
           }
         });
     
      e.preventDefault(); 
    }
     // avoid to execute the actual submit of the form.
  });
</script>
</body>

</html>