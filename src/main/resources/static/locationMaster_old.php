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
 <script>
 function edit(id,user)
	{
	//alert('hi');
	window.open("getlocation_details.php?ID="+id, "_blank", "toolbar=yes, scrollbars=yes, resizable=no, top=60, left=0, width=700, height=600");
	}
 
 function del(id,user)
 {

	var r = confirm("Do you want to Delete this Record....?");
	if (r == true) {
	var scriptUrl ='del_loc_master.php?id='+id+'&userId='+user;
	$.ajax({url:scriptUrl,success:function(result)
	{	
	alert('Record Deleted Successfully...');
	window.location.href='locationMaster.php';
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
            <h1 class="h4 mb-0 text-gray-800" style="height:0px">Location Master</h1>     
          </div>
          
          <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">          
          <div class="col-lg-12">
            <div class="p-5">  
            
               <div id="second">        
              <form class="user" action="#" method="post" id="locationMaster" name="locationMaster">
              <input type="hidden" id="uid" name="uid" value="<?php echo $_SESSION['uId']?>">
              <?php 
			   include('mysql.connect.php');
			   $qry="SELECT MAX(ID) AS code FROM cust_code";
			   $st=$mysql->prepare($qry);
			   $st->execute();
			   $row=$st->fetch(PDO::FETCH_ASSOC);
			   $code=$row['code'];
			   if($code<=9)
			   {
				   $c_code="SF0000".($code+1);
			   }
			   else if($code>9 && $code<99)
			   {
				   $c_code="SF000".($code+1);
			   }
			   else if($code>99 && $code<999)
			   {
				   $c_code="SF00".($code+1);
			   }
			   else if($code>999 && $code<9999)
			   {
				   $c_code="SF0".($code+1);
			   }
			   else 
			   {
				 $c_code="SF".($code+1);
			   }
			   $mysql=null;
			   ?>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label class="m-0 font-weight-bold text-primary">Company Name</label>
                   <select class="chosen-select form-control form-control-sm" id="company_id" name="company_id" tabindex="1">
                    <option value="0">Select</option>
                    <?php
                    include("mysql.connect.php");
                    $q="select * from company_tbl where sts='0'";
                    //echo $q."<br/>";
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
                    <label class="m-0 font-weight-bold text-primary">Location Code</label>
                    <input type="text" class="form-control form-control-sm" id="txtlcode" name="txtlcode" placeholder="Location Code" tabindex="2" onKeyUp="ChangeCase(this);" required>
                  </div>
                </div>
                
                <div class="form-group row">
				<div class="col-sm-6">
                    <label class="m-0 font-weight-bold text-primary">Location Name</label>
                    <input type="text" class="form-control form-control-sm" id="txtnm" name="txtnm" placeholder="Location Name" tabindex="2.1" onKeyUp="ChangeCase(this);" required>
                  </div>	
					
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label class="m-0 font-weight-bold text-primary">Description</label>
                    <textarea id="description" name="description" class="form-control form-control-sm" placeholder="Description" tabindex="3" onKeyUp="ChangeCase(this);" required></textarea>
                  </div>
                 
                </div>
                
                
                <button type="button" id="btnsubmit" name="btnsubmit" class="btn btn-primary" tabindex="4">Create</button>
               
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
              <h6 class="m-0 font-weight-bold text-primary">Location Register</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr style="background-color:#b02923">
                      <th style="color:#fff;text-align:center">Sr.No.</th>
                      <th style="color:#fff;text-align:center">Company Name</th>
                      <th style="color:#fff;text-align:center">Location Code</th>
                      <th style="color:#fff;text-align:center">Location Name</th>
                      <th style="color:#fff;text-align:center">Description</th>
                     
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
					
				  $qq="SELECT b.company_name,a.ID,a.location_name,a.location_description,a.loc_code FROM `location_tbl` AS a LEFT JOIN `company_tbl` AS b ON a.company_id=b.id WHERE a.sts='0'";
				  $stm=$mysql->prepare($qq);
				  $stm->execute();
				  $cnt=1;
				  while($row=$stm->fetch(PDO::FETCH_ASSOC))
				  {
					  $id=$row['ID'];
					  echo'<tr>';
					  echo '<td>'.$cnt.'</td>';
					  echo '<td>'.$row['company_name'].'</td>';
					  echo '<td>'.$row['loc_code'].'</td>';
					  echo '<td>'.$row['location_name'].'</td>';
					  echo '<td>'.$row['location_description'].'</td>';
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

    if($("#company_id").val().trim() =="0")
    {
      $("#company_id").addClass("require");
      alert("Please Select Company Name..!!");
      $("#company_id").focus();
      return false;
      //alert("bye");
    }
    else if($("#txtnm").val().trim()=="")
    {
      $("#txtnm").addClass("require");
      alert("Please Enter Location Name..!!");
      $("#txtnm").focus();
      return false;
    }
    else if($("#description").val().trim()=="")
    {
      $("#description").addClass("require");
      alert("Please Enter Description..!!");
      $("#description").focus();
      return false;
    }
    
    
    else
    {
      document.getElementById('btnsubmit').disabled=true;
            var url = "ins_location_master.php"; 
      //alert(url);
      // the script where you handle the form input.
      $.ajax({
           type: "POST",
           url: url,
           data: $("#locationMaster").serialize(), // serializes the form's elements.
           success: function(data)
           {
           alert(data);
           document.getElementById('btnsubmit').disabled=false;
           window.location.href='locationMaster.php';
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
function ChangeCase(elem)
{
	elem.value = elem.value.toUpperCase();
}	  
</script>
</body>

</html>