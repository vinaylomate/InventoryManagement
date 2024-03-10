<?php include('log_check.php');
$cmpId=$_SESSION['cmpId'];
$uiType=$_SESSION['iType'];
$userId=$_SESSION['uId'];
$uRole=$_SESSION['uRole'];
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
            <table width="100%">
			<tr>
			<td><h1 class="h4 mb-0 text-gray-800" style="height:0px;padding-bottom: 10px;">FG Master Register</h1> </td>	
			<td align="right"><a href="fgMaster.php" class="btn btn-warning" style="text-decoration: none;">Goto FG Master Entry</a></td>	
			</tr>  
			</table>    
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
                      <th style="color:#fff;text-align:center">Company</th>
                      <th style="color:#fff;text-align:center">Location </th>
                      <th style="color:#fff;text-align:center">Reorder Level Qty</th>
                      <th style="color:#fff;text-align:center">Prod. Expiry</th>
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
          if($uRole=='admin' || $uiType=='3')
          {
			  $qq="SELECT a.fgId,a.category_id,a.uom,a.company_id,a.location_id,b.category_nm,a.sage_code,a.focus_code,a.descc,a.brand,c.uom AS unit_name,CONCAT(d.company_code,' - ',d.company_name) AS company_name,CONCAT(e.loc_code,' - ',e.location_name) AS location_name,a.reorder_level_qty,a.product_expiry,a.rackNo,a.barcode,a.location_id FROM `fg_master` AS a
			  LEFT JOIN `category_master` AS b ON a.category_id=b.catId
			  LEFT JOIN `uom_tbl` AS c ON a.uom=c.ID
			  LEFT JOIN `company_tbl` AS d ON a.company_id=d.ID
			  LEFT JOIN `location_tbl` AS e ON a.location_id=e.ID
			  WHERE a.sts='0'";
          }
		  else
		  {
			  $qq="SELECT a.fgId,a.category_id,a.uom,a.company_id,a.location_id,b.category_nm,a.sage_code,a.focus_code,a.descc,a.brand,c.uom AS unit_name,CONCAT(d.company_code,' - ',d.company_name) AS company_name,CONCAT(e.loc_code,' - ',e.location_name) AS location_name,a.reorder_level_qty,a.product_expiry,a.rackNo,a.barcode,a.location_id FROM `fg_master` AS a
			  LEFT JOIN `category_master` AS b ON a.category_id=b.catId LEFT JOIN `uom_tbl` AS c ON a.uom=c.ID LEFT JOIN `company_tbl` AS d ON a.company_id=d.ID LEFT JOIN `location_tbl` AS e ON a.location_id=e.ID WHERE a.sts='0' AND a.company_id='$cmpId'";
          }
          $stm=$mysql->prepare($qq);
          $stm->execute();
          $cnt=1;
		  
          while($row=$stm->fetch(PDO::FETCH_ASSOC))
          {            
            $id=$row['fgId'];	
			$loc_id=$row['location_id'];

			if($uRole=='admin' || $uiType=='3')
			{
			  echo'<tr style="color:#000;font-weight:600;">';
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
              echo '<td align="center"><a href="javascript:del('.$id.','.$userId.')"><i class="fa fa-trash" style="color:#F00"></i></a></td>';
              }
              echo '</tr>';
              $cnt++;	
			}
			else
			{
				$ql="SELECT locId FROM admin_usr_loc WHERE uid='$userId' AND sts='0'";
				$stl=$mysql->prepare($ql);
				$stl->execute();
				$cntl=$stl->rowCount();
				if($cntl>1)
				{
					while($rowl=$stl->fetch(PDO::FETCH_ASSOC))
					{
						$ulcId=$rowl['locId'];
						if($ulcId==$loc_id)
						{
							echo'<tr style="color:#000;font-weight:600;">';
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
							echo '<td align="center"><a href="javascript:del('.$id.','.$userId.')"><i class="fa fa-trash" style="color:#F00"></i></a></td>';
							}
							echo '</tr>';
							$cnt++;
						}
					}
				}
				else
				{	
					$rowl=$stl->fetch(PDO::FETCH_ASSOC);
					$ulcId=$rowl['locId'];
					if($ulcId==$loc_id)
					{
                      echo'<tr style="color:#000;font-weight:600;">';
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
                      echo '<td align="center"><a href="javascript:del('.$id.','.$userId.')"><i class="fa fa-trash" style="color:#F00"></i></a></td>';
                      }
                      echo '</tr>';
                      $cnt++;
                    }
				}
			} 
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
	 if(document.getElementById('urole').value=='admin')
    {
	  
    }
	else
	{
	  alert('Plz, Select Company Name..!'); 	
	  document.getElementById('company_name').focus();	
	}
  }
  else	
  {
      var id = document.getElementById('company_name').value;
	  var uId= document.getElementById('uid').value;
	  var scriptUrl ='getLocations.php?compId='+id+'&iType=2'+'&uId='+uId;
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