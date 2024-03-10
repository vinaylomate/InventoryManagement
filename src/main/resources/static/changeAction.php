<?php include('log_check.php')?>
<!DOCTYPE html>
<html lang="en">

<head>

 <?php
 include("inc/meta.php");
 ?>
 <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
 
 <script>
function getCreateAct()	
{
  if(document.getElementById('rbYes').checked==true)
  {
	 document.getElementById('txtaction_cr').value=1;
  }
  
  if(document.getElementById('rbNo').checked==true)
  {
	 document.getElementById('txtaction_cr').value=0;
  }	
}
	 
function getEditAct()
{
  if(document.getElementById('rbYes').checked==true)
  {
	 document.getElementById('txtaction_ed').value=1;
  }
  
  if(document.getElementById('rbNo').checked==true)
  {
	 document.getElementById('txtaction_ed').value=0;
  }	
}
	
function getDeleteAct()
{
  if(document.getElementById('rbdYes').checked==true)
  {
	 document.getElementById('txtaction_del').value=1;
  }
  
  if(document.getElementById('rbdNo').checked==true)
  {
	 document.getElementById('txtaction_del').value=0;
  }	
}
	
function getViewAct()
{
  if(document.getElementById('rbVYes').checked==true)
  {
	 document.getElementById('txtaction_vw').value=1;
  }
  
  if(document.getElementById('rbVNo').checked==true)
  {
	 document.getElementById('txtaction_vw').value=0;
  }	
} 
 </script>
</head>

<body id="page-top">
<?php
$ID=$_GET['ID'];	
include('mysql.connect.php');
$qry="SELECT id,UserNm,act_edit AS ed,act_delete AS del,act_create AS cr,act_view AS vw FROM admin_tbl WHERE sts='0' AND id='$ID'";
$st=$mysql->prepare($qry);
$st->execute();
$row=$st->fetch(PDO::FETCH_ASSOC);
$cId=$row['id'];
$nm=$row['UserNm'];
$ed=$row['ed'];
$dels=$row['del'];
$cr=$row['cr'];
$vw=$row['vw'];
//echo $cr."<Br>";	
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
            <h1 class="h4 mb-0 text-gray-800" style="height:0px;margin-top:10px">User Creation - Action Change</h1>     
          </div>
          
          <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">          
          <div class="col-lg-12">
            <div class="p-5">             
             <form class="user" action="changeAction_edit.php" method="post">
             <input type="hidden" id="eId" name="eId" value="<?php echo $cId;?>">
             <input type="hidden" id="uid" name="uid" value="<?php echo $_SESSION['uId']?>">
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label class="m-0 font-weight-bold text-primary">User Name</label>
                    <input type="text" class="form-control form-control-sm" id="txtcode" name="txtcode" value="<?php echo $nm;?>" placeholder="Customer Code" readonly >
                  </div>
                  
                </div>
                
                <div class="form-group row">
<div class="col-sm-6">
<label class="m-0 font-weight-bold text-primary">Action</label>
<br>
<table class="table-bordered">
<tr>
<td>
<div id="Select_values">
<label class="m-0 font-weight-bold">Create</label>
<?php if($cr==1)
{
?>
<input id="rbYes" name="rbCreate" type="radio" value="1" checked onclick = "getCreateAct()"/>&nbsp;&nbsp;Yes
<input id="rbNo" name="rbCreate" type="radio" value="0" onclick = "getCreateAct()"/>&nbsp;&nbsp;No
<?php
}
else
{
?>	
<input id="rbYes" name="rbCreate" type="radio" value="1" onclick = "getCreateAct()"/>&nbsp;&nbsp;Yes
<input id="rbNo" name="rbCreate" type="radio" value="0" checked onclick = "getCreateAct()"/>&nbsp;&nbsp;No	
<?php
}
?>
<input type="hidden" id="txtaction_cr" name="txtaction_cr" value="<?php echo $ed;?>"> 
<input type="hidden" id="txtaction_crp" name="txtaction_crp" value="<?php echo $ed;?>">	
<br />
</div>
</td>	
	
<td>
<div id="Select_values">
<label class="m-0 font-weight-bold">Edit</label>
<?php if($ed==1)
{
?>
<input id="rbYes" name="rbAction" type="radio" value="1" checked onclick = "getEditAct()"/>&nbsp;&nbsp;Yes
<input id="rbNo" name="rbAction" type="radio" value="0" onclick = "getEditAct()"/>&nbsp;&nbsp;No
<?php
}
else
{
?>	
<input id="rbYes" name="rbAction" type="radio" value="1" onclick = "getEditAct()"/>&nbsp;&nbsp;Yes
<input id="rbNo" name="rbAction" type="radio" value="0" checked onclick = "getEditAct()"/>&nbsp;&nbsp;No	
<?php
}
?>
<input type="hidden" id="txtaction_ed" name="txtaction_ed" value="<?php echo $ed;?>"> 
<input type="hidden" id="txtaction_edp" name="txtaction_edp" value="<?php echo $ed;?>">	
<br />
</div>
</td>
	
<td style="padding:5px;">
<div id="Select_values">
<label class="m-0 font-weight-bold">Delete</label>
<?php
if($dels==1)
{
?>
<input id="rbdYes" name="rbActionDel" type="radio" value="1" checked onclick = "getDeleteAct()"/>&nbsp;&nbsp;Yes
<input id="rbdNo" name="rbActionDel" type="radio" value="0" onclick = "getDeleteAct()"/>&nbsp;&nbsp;No
<?php
}
else
{
?>
<input id="rbdYes" name="rbActionDel" type="radio" value="1" onclick = "getDeleteAct()"/>&nbsp;&nbsp;Yes
<input id="rbdNo" name="rbActionDel" type="radio" value="0" checked onclick = "getDeleteAct()"/>&nbsp;&nbsp;No	
<?php
}
?>
<input type="hidden" id="txtaction_del" name="txtaction_del" value="<?php echo $dels;?>">  
<input type="hidden" id="txtaction_delp" name="txtaction_delp" value="<?php echo $dels;?>"> 	
<br />
</div>
</td>	
	
<td style="padding:5px;">
<div id="Select_values">
<label class="m-0 font-weight-bold">View</label>
<?php
if($vw==1)
{
?>
<input id="rbVYes" name="rbActionView" type="radio" value="1" checked onclick = "getViewAct()"/>&nbsp;&nbsp;Yes
<input id="rbVNo" name="rbActionView" type="radio" value="0" onclick = "getViewAct()"/>&nbsp;&nbsp;No
<?php
}
else
{
?>
<input id="rbVYes" name="rbActionView" type="radio" value="1" onclick = "getViewAct()"/>&nbsp;&nbsp;Yes
<input id="rbVNo" name="rbActionView" type="radio" value="0" checked onclick = "getViewAct()"/>&nbsp;&nbsp;No	
<?php
}
?>
<input type="hidden" id="txtaction_vw" name="txtaction_vw" value="<?php echo $vw;?>">  
<input type="hidden" id="txtaction_vwp" name="txtaction_vwp" value="<?php echo $vw;?>"> 	
<br />
</div>
</td>	
</tr>
</table>	
</div>
</div>
                
                
                <button type="submit" id="btn" name="btn" class="btn btn-primary" tabindex="6">Save</button>
               
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
</body>

</html>