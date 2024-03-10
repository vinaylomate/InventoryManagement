<?php include('log_check.php')?>
<!DOCTYPE html>
<html lang="en">

<head>

 <?php
 include("inc/meta.php");
 ?>
 <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">
<?php
$ID=$_GET['ID'];
include('mysql.connect.php');
$qry="SELECT a.ID,a.dt,a.compId,a.locId,a.iType,a.docNo,a.yr,a.yr2,b.company_code,b.company_name,c.loc_code,c.location_name,IF(a.iType='1','RAW MATERIAL','FINISHED GOODS') AS iTypeNm,notes,ref,a.salemnId,s.salemanNm FROM inventory_tbl AS a LEFT JOIN company_tbl AS b ON a.compId=b.ID LEFT JOIN location_tbl AS c ON a.locId=c.ID LEFT JOIN salesman_tbl AS s ON a.salemnId=s.ID WHERE a.sts!='2' AND b.sts!='2' AND c.sts!='2' AND a.ID='$ID' AND a.lsts='1'";
$st=$mysql->prepare($qry);
$st->execute();
$row=$st->fetch(PDO::FETCH_ASSOC);
$dt=$row['dt'];
$serialno=$row['docNo'];
$comp=$row['company_code']." ".$row['company_name'];
$loc=$row['loc_code']." ".$row['location_name'];
$category=$row['iTypeNm'];
$ref=$row['ref'];
$salesman=$row['salemanNm'];

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
            <h1 class="h4 mb-0 text-gray-800" style="height:0px;margin-top:10px"></h1>     
          </div>
          
          <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        
        
        
        <div class="row" >          
          <div class="col-lg-12">
          <page id="getdata">
            <div class="p-5">
            <div style="padding-bottom:2px;font-size:30px;font-weight:bold;" align="center">
            <!--<img src="img/logo1.jpg" style="height:180px;width:100%">-->RITVER <span style="font-size:14px;">PAINTS & COATINGS</span>
			<hr>	
            </div>
				
            <div class="row">     
                <div class="col-md-6">
                      <div class="row">
                            <div class="col-md-4" style="font-weight:600">Date :</div>
                            <div class="col-md-8"><?php echo date('d-m-Y',strtotime($dt));?></div>
                       </div> 
                  </div>
                  
                  <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-4" style="font-weight:600">Document No. :</div>
                            <div class="col-md-8"><?php echo $serialno;?></div>
                        </div> 
                  </div>
                         
                  
              </div>
              
              <div class="row" style="margin-top:15px">     
                <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-4" style="font-weight:600">Company :</div>
                            <div class="col-md-8"><?php echo $comp;?></div>
                        </div> 
                  </div>
                  
                  <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-4" style="font-weight:600">Location :</div>
                            <div class="col-md-8"><?php echo $loc;?></div>
                        </div> 
                  </div>                         
                  
              </div>
				
			  <div class="row" style="margin-top:15px">  				  
				   <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-5" style="font-weight:600">Product Category :</div>
                            <div class="col-md-7"><?php echo $category;?></div>
                        </div> 
                  </div>
                         
                  <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6" style="font-weight:600">Salesman : </div>
                            <div class="col-md-6"><?php echo $salesman;?></div>
                        </div> 
                  </div>
              </div>	
				
			  <div class="row" style="margin-top:15px">                          
                  <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6" style="font-weight:600">Sage Reference</div>
                            <div class="col-md-6"><?php echo $ref;?></div>
                        </div> 
                  </div>
              </div>	
              <hr>
              
              <div style="margin-top:25px">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <tr id="aa" style="background-color:#e1736e">
                <th style="color:#000">No</th>
                <th style="color:#000">Focus Code</th>
                <th style="color:#000">Sage Code</th>
                <th style="color:#000">Description</th>
                <th style="color:#000">Batch No</th>
                <th style="color:#000">Qty</th>
                <th style="color:#000">Prod. Exp. Date</th>
                <th style="color:#000">Entry Type</th>
                </tr>
                <?php
				include('mysql.connect.php');
                $qq="SELECT a.ID,a.itemId,IF(b.iType='1',r.focus_code,f.focus_code) AS focus_code,IF(b.iType='1',r.sage_code,f.sage_code) AS sage_code,IF(b.iType='1',CONCAT(rg.category_nm,' ',r.description,' ',rm_u.uom),CONCAT(fgg.category_nm,' ',f.brand,' ',f.descc,' ',f_u.uom)) AS desp,a.entryId,e.entryNm,a.eType,IF(a.eType='1','IN','OUT') AS eTypeNm,a.qty,a.batchNo,a.expdt,a.ref,a.notes FROM inventory_info_tbl AS a LEFT JOIN inventory_tbl AS b ON a.invId=b.ID LEFT JOIN rm_master AS r ON a.itemId=r.rmId LEFT JOIN fg_master AS f ON a.itemId=f.fgId LEFT JOIN entry_type_tbl AS e ON a.entryId=e.entryId LEFT JOIN uom_tbl AS rm_u ON r.UOM=rm_u.ID LEFT JOIN uom_tbl AS f_u ON f.uom=f_u.ID LEFT JOIN category_master AS rg ON r.catId=rg.catId LEFT JOIN category_master AS fgg ON f.category_id=fgg.catId WHERE a.invId='$ID' AND b.sts!='2' AND a.sts!='2'";
				$stm=$mysql->prepare($qq);
				$stm->execute();
				
				$cnt=1;
				$tot=0;
				while($rw=$stm->fetch(PDO::FETCH_ASSOC))
				{
					echo '<tr>';
					echo '<td style="background-color:#0d69f445;color:#000">'.$cnt.'</td>';
					echo '<td style="background-color:#0d69f445;color:#000">'.$rw['focus_code'].'</td>';
					echo '<td style="background-color:#f4b80d61;color:#000">'.$rw['sage_code'].'</td>';
					echo '<td style="background-color:#0d69f445;color:#000">'.$rw['desp'].'</td>';
					echo '<td style="background-color:#0d69f445;color:#000">'.$rw['batchNo'].'</td>';
					echo '<td style="background-color:#0d69f445;color:#000">'.$rw['qty'].'</td>';
					if($rw['eType']=='2')
					{
					echo '<td style="background-color:#0d69f445;color:#000">-</td>';	
					}
					else
					{
					echo '<td style="background-color:#0d69f445;color:#000">'.date('d-m-Y',strtotime($rw['expdt'])).'</td>';
					}
					echo '<td style="background-color:#0d69f445;color:#000">LOCK QTY '.$rw['eTypeNm'].'</td>';
					echo '</tr>';
					$tot=$tot+$rw['qty'];
					$cnt++;
				}
				$mysql=null;
				?>
                <tfoot>
                <th></th>
                <th></th>
                <th style="color:#F00"></th>
                <th style="color:#F00"></th>
                <th style="color:#F00;text-align:right">Total </th>
                <th style="color:#F00"><?php echo $tot;?></th>
                <th style="color:#F00"></th>
                <th style="color:#F00"></th>
                </tfoot>
                </table>
                </div>
              
            </div>
            </page>
            <!--<div align="center" style="padding:5px">
            <input type="button" onClick="print2()" value="Print" class="btn btn-primary"/> 
            </div>-->
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
 <script>  
    $(window).load(function() {
   $('#tbl').DataTable({});
	});
	
	function print2()
	{
	  var printContents = document.getElementById('getdata').innerHTML;
	  var originalContents = document.body.innerHTML;	  
	  document.body.innerHTML = printContents; 
	  window.print();	  
	  document.body.innerHTML = originalContents;	
	  
	}
</script>
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