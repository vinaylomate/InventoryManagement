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
 function edit(id)
  {
    //alert('hi');
  window.open("getfgmaster_details.php?ID="+id, "_blank", "toolbar=yes, scrollbars=yes, resizable=no, top=60, left=0, width=700, height=600");
  }
function erate(id)
  {
    //alert('hi');
  window.open("rm_price_history.php?ID="+id, "_blank", "toolbar=yes, scrollbars=yes, resizable=no, top=60, left=0, width=700, height=600");
  } 
 
 function del(id,user)
 {

  
  var r = confirm("Do you want to Delete this Record....?");
  if (r == true) {
  var scriptUrl ='del_fgMaster.php?id='+id+'&userId='+user;
  $.ajax({url:scriptUrl,success:function(result)
  { 
	  alert('Record Deleted Successfully...');
	  window.location.href='fgMaster.php';
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
            <h1 class="h4 mb-0 text-gray-800" style="height:0px">FG Master</h1>     
          </div>
          
          <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">          
          <div class="col-lg-12">
            <div class="p-5">    
          <!--  <div>
                <span style="padding-right:10px;">
                <input type="radio" id="csvfile" name="csvfile" value="1" onClick="getrbtn()" required>&nbsp;&nbsp;Excel File Upload
                </span>
            </div>  -->
            
           <!-- <div id="first" style="visibility:hidden;overflow:hidden;height:0px;margin-top:20px">
             <form class="user" action="upload_RMMaster_excel.php" method="post" enctype="multipart/form-data"> 
               <input type="hidden" id="euid" name="euid" value="<?php echo $_SESSION['uId']?>">
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label class="m-0 font-weight-bold text-primary">Select CSV File.</label>
                   <input id="file" name="file" class="form-control"   type="file" required>
                   <a href="Excel/RM.csv"><label style="color:#F00;margin-top:10px"><b>Click Here For Sample CSV</b></label></a>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <input type="submit" id="btn" name="btn" class="btn btn-primary" value="Create" >
                  </div>
                </div>
            </form>
            </div>-->
                   
               <div id="second">    
              <form class="user" action="#" method="post" name="rmMaster" id="rmMaster">
              <input type="hidden" id="uid" name="uid" value="<?php echo $_SESSION['uId']?>">
			<div class="form-group row">
			 <div class="col-sm-6 mb-3 mb-sm-0">
                  <label class="m-0 font-weight-bold text-primary">Company Name</label>
                    <select name="company_name" id="company_name" class="chosen-select form-control form-control-sm" tabindex="1" onChange="getLoc()">
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
                  <select class="chosen-select form-control form-control-sm" id="location" name="location" tabindex="2" >
                    <option value="0">Select</option>
                    </select>
                    
                  </div>
                 	  
			</div>	  
				  
                <div class="form-group row">
                 <div class="col-sm-6">
                    <label class="m-0 font-weight-bold text-primary">Category</label>                    
                   <select name="cat_id" id="cat_id" class="chosen-select form-control form-control-sm" tabindex="3">
                    <option value="0">Select</option>
                    <?php
                    include("mysql.connect.php");
                    $q="SELECT catId,category_nm FROM category_master WHERE sts='0'";
                    echo $q."<br/>";
                    $s=$mysql->prepare($q);
                    $s->setFetchMode(PDO::FETCH_ASSOC);
                    $s->execute();
                    while($r=$s->fetch())
                    {
                      echo "<option value=".$r['catId'].">".$r['category_nm']."</option>";
                    }
                    $mysql=null;
                    ?>
                   </select>
                  </div>
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label class="m-0 font-weight-bold text-primary">Sage Code</label>                    
                   <input type="text" id="sage_code" name="sage_code" class="form-control form-control-sm" placeholder="Sage Code" tabindex="4">
                  </div>
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  
                  </div>
                  
                </div>
                
                <div class="form-group row">
                  <div class="col-sm-6">
                   <label class="m-0 font-weight-bold text-primary">Focus Code</label>
                    <input type="text" class="form-control form-control-sm" id="focus_code" name="focus_code" placeholder="Focus Code" tabindex="5">
                  </div>
					
				<div class="col-sm-6 mb-3 mb-sm-0">
                  <label class="m-0 font-weight-bold text-primary">Brand</label>
                    <input type="text" id="brand" name="brand" class="form-control form-control-sm" placeholder="Brand" tabindex="6">
                  </div>                  
                </div>

                

                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label class="m-0 font-weight-bold text-primary">Capacity / UOM</label>
                    <select name="uom" id="uom" class="chosen-select  form-control form-control-sm" tabindex="7">
                      <option value="0">Select</option>
                      <?php
                      include("mysql.connect.php");
                      $q="SELECT ID,uom FROM uom_tbl where sts='0'";
                      $s=$mysql->prepare($q);
                      $s->setFetchMode(PDO::FETCH_ASSOC);
                      $s->execute();
                      while($r=$s->fetch())
                       {
                        echo "<option value=".$r['ID'].">".$r['uom']."</option>";
                       }   
                      $mysql=null;
                      ?>
                    </select>
                  </div>
                  
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label class="m-0 font-weight-bold text-primary">Description</label>
                    <textarea name="desc" id="desc" class="form-control form-control-sm" placeholder="Description" tabindex="8"></textarea>
                  </div>
                 </div>
                
                
                 
                 <div class="form-group row">                
                  
                 <div class="col-sm-6">
                    <label class="m-0 font-weight-bold text-primary">Reorder Level(Qty)</label>
                    <input type="text" id="reorder_level_qty" name="reorder_level_qty" tabindex="9" class="form-control form-control-sm" placeholder="Reorder Level(Qty)">
                    
                  </div>
					 
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label class="m-0 font-weight-bold text-primary">Product Expiry</label>
                  <select class="chosen-select form-control form-control-sm" id="product_expiry" name="product_expiry" tabindex="10">
                  <option value="1 Year">1 Year</option>
                  <option value="6 Months">6 Months</option>
                  </select>	
                  </div>		 
                 </div>
                
                <div class="form-group row">
                
                <div class="col-sm-6 mb-3 mb-sm-0">
				<label class="m-0 font-weight-bold text-primary">Rack No.</label>
				<select class="form-control chosen-select form-control-sm" id="rackNo" name="rackNo" tabindex="11">
				<option value="0">Select</option>
				<?php
				include("mysql.connect.php");
				$q="SELECT rackNo FROM rack_tbl WHERE sts='0' AND iType='2' ORDER BY rackNo";
				$s=$mysql->prepare($q);
				$s->setFetchMode(PDO::FETCH_ASSOC);
				$s->execute();
				while($r=$s->fetch())
				{
				echo "<option value=".$r['rackNo'].">".$r['rackNo']."</option>";
				}   
				$mysql=null;
				?>
				</select>	
				</div>
                
                    <div class="col-sm-6">
                    <label class="m-0 font-weight-bold text-primary">Barcode</label>
					<input type="text" id="barcode" name="barcode" tabindex="11.1" class="form-control form-control-sm" placeholder="Barcode">	
                    </div> 
                 </div>
                 
                <button type="button" id="btnsubmit" name="btnsubmit" class="btn btn-primary" tabindex="12">Create</button>
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
              <h6 class="m-0 font-weight-bold text-primary">FG Register</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr style="background-color:#b02923">
                      <th style="color:#fff;text-align:center">Sr.No.</th>
                      <th style="color:#fff;text-align:center">Category</th>
                      <th style="color:#fff;text-align:center">Sage Code</th>
                      <th style="color:#fff;text-align:center">Focus Code</th>
                      <th style="color:#fff;text-align:center">Barcode</th>
                      <th style="color:#fff;text-align:center">Description</th>
                     <th style="color:#fff;text-align:center">Brand</th>
                      <th style="color:#fff;text-align:center">UOM</th>
                      <th style="color:#fff;text-align:center">Company Name</th>
                      <th style="color:#fff;text-align:center">Location Name</th>
                      <th style="color:#fff;text-align:center">Reorder Level Qty</th>
                      <th style="color:#fff;text-align:center">Product Expiry</th>
                      <th style="color:#fff;text-align:center">Rack No.</th>
                      <!--<th style="color:#fff;text-align:center">View</th>-->
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
          
          $qq="SELECT a.fgId,a.category_id,a.uom,a.company_id,a.location_id,b.category_nm,a.sage_code,a.focus_code,a.descc,a.brand,c.uom AS unit_name,CONCAT(d.company_code,' - ',d.company_name) AS company_name,CONCAT(e.loc_code,' - ',e.location_name) AS location_name,a.reorder_level_qty,a.product_expiry,a.rackNo,a.barcode FROM `fg_master` AS a
LEFT JOIN `category_master` AS b ON a.category_id=b.catId
LEFT JOIN `uom_tbl` AS c ON a.uom=c.ID
LEFT JOIN `company_tbl` AS d ON a.company_id=d.ID
LEFT JOIN `location_tbl` AS e ON a.location_id=e.ID
WHERE a.sts='0'";
          $stm=$mysql->prepare($qq);
          $stm->execute();
          $cnt=1;
          while($row=$stm->fetch(PDO::FETCH_ASSOC))
          {
            
            $id=$row['fgId'];
            echo'<tr>';
            echo '<td>'.$cnt.'</td>';
            echo '<td>'.$row['category_nm'].'</td>';
            echo '<td>'.$row['sage_code'].'</td>';
            echo '<td>'.$row['focus_code'].'</td>';
            echo '<td>'.$row['barcode'].'</td>';
            echo '<td>'.$row['descc'].'</td>';
            echo '<td>'.$row['brand'].'</td>';
            echo '<td>'.$row['unit_name'].'</td>';
            echo '<td>'.$row['company_name'].'</td>';
            echo '<td>'.$row['location_name'].'</td>';
            echo '<td>'.$row['reorder_level_qty'].'</td>';
            echo '<td>'.$row['product_expiry'].'</td>';
            echo '<td>'.$row['rackNo'].'</td>';
            /*echo '<td align="center"><a href="javascript:erate('.$id.')"><i class="fa fa-eye"></i></a></td>';*/
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
    if($("#cat_id").val().trim() =="0")
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
    else if($("#company_name").val().trim()=="0")
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
    
    else if($("#barcode").val().trim()=="0")
    {
      $("#barcode").addClass("require");
      alert("Please Enter Barcode  ..!!");
      $("#barcode").focus();
      return false;
    }
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
</script>
</body>

</html>