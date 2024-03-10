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
 <script>
 function del(id,user)
 {  
  var r = confirm("Do you want to Delete this Record....?");
  if (r == true) {
  var scriptUrl ='del_salemanMaster.php?id='+id+'&userId='+user;
  $.ajax({url:scriptUrl,success:function(result)
  { 
	  alert('Record Deleted Successfully...');
  }});
  
  } 
  else {
  txt = "You Pressed Cancel!";
  }
	 window.location.href='salesMan_entry.php';
}

function getLoc()	
{
  if(document.getElementById('company_id').value=='0')
  {
	if(document.getElementById('urole').value=='admin')
    {
	  
    }
	else
	{
	  alert('Plz, Select Company Name..!'); 	
	  document.getElementById('company_id').focus();	
	}
  }
  else if(document.getElementById('iType').value=='0')
  {
	 //alert('Plz, Select Product Category..!'); 
	 document.getElementById('iType').focus();
  }
  else	
  {
      var id = document.getElementById('company_id').value;
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
	  	 //alert(result);
         //document.getElementById('location').innerHTML=result;
		  $("#locatn").html(result).trigger("chosen:updated.chosen");
		  getproduct();
      }});
  }
}
 </script>
</head>

<body id="page-top" onLoad="getLoc()">

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
            <h1 class="h4 mb-0 text-gray-800" style="height:0px;padding-bottom: 10px;">Sales Man Master</h1>     
          </div>
          
          <div class="card o-visible border-0 shadow-lg my-2">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">          
          <div class="col-lg-12">
            <div class="p-2">  
            
               <div id="second">        
              <form class="user" action="#" method="post" id="salesM_Master" name="salesM_Master">
              <input type="hidden" id="uid" name="uid" value="<?php echo $_SESSION['uId']?>">
              <input type="hidden" id="urole" name="urole" value="<?php echo $uRole;?>">
              <input type="hidden" id="uiType" name="uiType" value="<?php echo $uiType;?>">
              <input type="hidden" id="uloc" name="uloc" value="<?php echo $uloc;?>">	
              <input type="hidden" id="ulocty" name="ulocty" value="<?php echo $ulocType;?>">
              <input type="hidden" id="yr" name="yr" value="<?php echo $fiscalYr;?>">	
              <input type="hidden" id="yr2" name="yr2" value="<?php echo $fiscalYr1;?>">		
              
              	<table cellpadding="5px" align="center">
				<tr>
				<td>
				<label class="m-0 font-weight-bold text-primary">Company Name  </label>	
				</td>
				<td>:</td>	
				<td>
				<select class="chosen-select form-control form-control-sm" id="company_id" name="company_id" tabindex="1" style="width:220px;" onChange="getLoc()">
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
				</td>
				<td>
				<label class="m-0 font-weight-bold text-primary">Product Category </label>	
				</td>
				<td>:</td>		
				<td>
				<select class="chosen-select form-control form-control-sm" id="iType" name="iType" onChange="getLoc();" tabindex="1.1" style="width250px;" required>
                <?php
				if($uiType=='0')
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
				</tr>  
					
				<tr>
				<td>
				<label class="m-0 font-weight-bold text-primary">Location  </label>
				</td>
				<td>:</td>	
				<td>
				<select class="chosen-select form-control form-control-sm" id="locatn" name="locatn" tabindex="2" style="width250px;" required>
                    <option value="0">Select</option>
                    
                    </select>	
				</td>
				<td>
				<label class="m-0 font-weight-bold text-primary">Salesman Name  </label>	
				</td>
				<td>:</td>		
				<td>
				<input type="text" class="form-control form-control-sm" id="txtnm" name="txtnm" placeholder="Sales Man Name" tabindex="2.1" onKeyUp="ChangeCase(this);" required>	
				</td>	
				</tr>	
					
				<tr>
				
				<td>
				<button type="button" id="btnsubmit" name="btnsubmit" class="btn btn-primary" tabindex="4">Create</button>
				</td>
				<td></td>
				</tr>	
				</table>
                
                
               
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
            
              <h6 class="m-0 font-weight-bold text-primary">Sales Man Register</h6>
            </div>
            <div class="card-body">
            <!--<div align="right"><a href="getExcel/locMst_excl.php" target="_blank"><img src="img/EXCELIMG1.png" alt="download" title="download" style="width:50px; height:50px"></a><a href="mpdf/reports/locMst_pdf.php" target="_blank"><img src="img/pdf.png" alt="download" title="download" style="width:50px; height:50px">

   </a>
      </div>-->
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr style="background-color:#b02923">
                      <th style="color:#fff;text-align:center">Sr.No.</th>
                      <th style="color:#fff;text-align:center">Company Name</th>
                      <th style="color:#fff;text-align:center">Product Category</th>
                      <th style="color:#fff;text-align:center">Location</th>
                      <th style="color:#fff;text-align:center">SalesMan Name</th>
                      <th style="color:#fff;text-align:center">Delete</th>
                      
                    </tr>
                  </thead>
                  <tbody>
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
					
				  /*$qq="SELECT b.company_name,a.ID,a.location_name,a.location_description,a.loc_code,IF(a.iType='1','RAW MATERIAL','FINISHED GOODS') AS cat FROM `location_tbl` AS a LEFT JOIN `company_tbl` AS b ON a.company_id=b.id WHERE a.sts='0' ORDER BY a.ID";*/
				  $qq="SELECT b.company_code,b.company_name,s.ID,l.loc_code,l.location_name,s.salemanNm AS SalesMan_nm,IF(s.iType='1','RM','FG') AS cat FROM `salesman_tbl` AS s LEFT JOIN `company_tbl` AS b ON s.compId=b.id LEFT JOIN location_tbl AS l ON s.locId=l.ID  WHERE s.sts='0' ORDER BY s.ID";	
				  $stm=$mysql->prepare($qq);
				  $stm->execute();
				  $cnt=1;
				  while($row=$stm->fetch(PDO::FETCH_ASSOC))
				  {
					  $id=$row['ID'];
					  echo'<tr style="color:#000;font-weight:600;">';
					  echo '<td>'.$cnt.'</td>';
					  echo '<td>'.$row['company_code'].' - '.$row['company_name'].'</td>';
					  echo '<td>'.$row['cat'].'</td>';
					  echo '<td>'.$row['loc_code'].' - '.$row['location_name'].'</td>';
					  echo '<td>'.$row['SalesMan_nm'].'</td>';
					  
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
				  $mysql=null;
				  ?>
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
	else if($("#iType").val().trim() =="0")
    {
      $("#iType").addClass("require");
      alert("Please Select Product Category..!!");
      $("#iType").focus();
      return false;
      //alert("bye");
    }  
	else if($("#locatn").val().trim() =="0")
    {
      $("#locatn").addClass("require");
      alert("Please Salect Location ..!!");
      $("#locatn").focus();
      return false;
      //alert("bye");
    }  
    else if($("#txtnm").val().trim()=="")
    {
      $("#txtnm").addClass("require");
      alert("Please Enter Sales Man Name..!!");
      $("#txtnm").focus();
      return false;
    }
    else
    {
      document.getElementById('btnsubmit').disabled=true;
            var url = "salesMan_ins.php"; 
      //alert(url);
      // the script where you handle the form input.
      $.ajax({
           type: "POST",
           url: url,
           data: $("#salesM_Master").serialize(), // serializes the form's elements.
           success: function(data)
           {
           alert(data);
           document.getElementById('btnsubmit').disabled=false;
           window.location.href='salesMan_entry.php';
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
	   
function getcodeLen()
{
	var cd=document.getElementById('txtlcode').value;
	//if(cd.length<6 || cd.length>6)
	if(cd.length>6)
	{
		alert("Plz, Enter Location Code 6 Characters Only...!")	;
		document.getElementById('txtlcode').value="";
		document.getElementById('txtlcode').focus();
	}	
}
</script>
</body>

</html>