<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="admin.php">
<div class="sidebar-brand-icon rotate-n-15">
<!--<i class="fas fa-laugh-wink"></i>-->
</div>
<div class="sidebar-brand-text mx-3">Inventory Software<!--<sup>2</sup>--></div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
<a class="nav-link" href="admin.php">
<i class="fas fa-fw fa-tachometer-alt"></i>
<span>Dashboard</span></a>      </li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
Interface
</div>

<!-- Nav Item - Pages Collapse Menu -->

<?php 
	  //echo $_SESSION['uAccess']."<Br>";
	  //echo "sub-ac : ".$_SESSION['subAccess']."<Br>";
	  if($_SESSION['uAccess'] == "1,2,3,4,5")
      {
      ?>     
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Master</span>        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <!--<h6 class="collapse-header">Custom Components:</h6>-->
         <?php //Sub Master
          if($_SESSION['subAccess']=='1,2,3,4,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php
          }
          else if($_SESSION['subAccess'] == '1,2,3,4')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>  
         <?php
          }
          else if($_SESSION['subAccess'] == '1,2,3')
          {
           ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a> 
            
           <?php
		  }
		  else if($_SESSION['subAccess'] == '1,2,4')
		  {
		   ?> 
           <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>  
         <?php
          }
          else if($_SESSION['subAccess'] == '1,2,4,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php  
          }
          else if($_SESSION['subAccess'] == '1,2,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
            
           <?php
		  }
		  else if($_SESSION['subAccess'] == '2,3,4')
		  {
		   ?> 
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a> 
           
           <?php
		  	}
		   else if($_SESSION['subAccess'] == '2,3,5')
		   {
		   ?> 
           
           <a class="collapse-item" href="locationMaster.php">Location Master</a>
           <a class="collapse-item" href="rmMaster.php">RM Master</a>
           <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
           
           <?php
		   }
		   else if($_SESSION['subAccess'] == '2,4,5')
		   {
		   ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
           
         <?php
          }
          else if($_SESSION['subAccess'] == '1,3,4,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php 
          }
          else if($_SESSION['subAccess'] == '1,3,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a> 
            
          <?php
		  }
		  else if($_SESSION['subAccess'] == '1,3,4')
		  {
		  ?>  
           <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a> 
          
          <?php
		  }
		  else if($_SESSION['subAccess'] == '1,4,5')
		  {
		  ?>
         
         <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>
          <?php 
          }
          else if($_SESSION['subAccess'] == '1')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
         <?php
          }
          else if($_SESSION['subAccess'] == '2')
          {
          ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
         <?php 
          }
          else if($_SESSION['subAccess'] == '3')
          {
          ?>
            <a class="collapse-item" href="rmMaster.php">RM Master</a> 
         <?php
          }
          else if($_SESSION['subAccess'] == '4')
          {
          ?>
            <a class="collapse-item" href="fgMaster.php">FG Master</a>
         <?php
          }
          else if($_SESSION['subAccess'] == '5')
          {
          ?>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php  
          }
          else if($_SESSION['subAccess'] == '1,2')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a> 
          <?php  
          }
          else if($_SESSION['subAccess'] == '1,3')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
         <?php 
          }
          else if($_SESSION['subAccess'] == '1,4')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
         <?php
          }
          else if($_SESSION['subAccess'] == '1,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php  
          }
          else if($_SESSION['subAccess'] == '2,3')
          {
          ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>  
         <?php  
          }
          else if($_SESSION['subAccess'] == '2,4')
          {
          ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a> 
         <?php   
          }
          else if($_SESSION['subAccess'] == '2,5')
          {
          ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php 
          }
          else if($_SESSION['subAccess'] == '3,4')
          {
          ?>
            <a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a> 
         <?php 
          }
          else if($_SESSION['subAccess'] == '3,5')
          {
          ?>
            <a class="collapse-item" href="rmMaster.php">RM Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php 
          }
          else if($_SESSION['subAccess'] == '4,5')
          {
          ?>
            <a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php 
          }
          else
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a> 
           
 

         <?php    
          }
          //sub Master End
          //echo "subAccess=>".$_SESSION['subAccess'];
         ?>
		</div>
        </div>
      </li>
	 
      <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#purchase" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-fw fa-cog"></i>
      <span>Stock Entry</span>        </a>
      <div id="purchase" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
      <!--<h6 class="collapse-header">Custom Components:</h6>-->
      <a class="collapse-item" href="inventoryEntry.php">Stock Entry</a>
      <a class="collapse-item" href="inventoryReg.php">Stock Register</a>
      <a class="collapse-item" href="inventoryReg2.php">Stock Register -Product</a>
      
      </div>
      </div>
      </li>
	 
	  <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#lockQty" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Lock Quantity</span>        </a>
        <div id="lockQty" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <!--<h6 class="collapse-header">Custom Components:</h6>-->
        <a class="collapse-item" href="lockQty_entry.php">Lock Qty Entry</a>
        <a class="collapse-item" href="lockQty_Reg.php">Lock Qty Register</a>
     	<a class="collapse-item" href="lockQty_Reg2.php">Lock Qty Reg - Product</a>
        </div>
        </div>
        </li> 
	
	  <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#inquairy" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Report</span>        </a>
        <div id="inquairy" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <!--<h6 class="collapse-header">Custom Components:</h6>-->
        <!-- <a class="collapse-item" href="RM_report.php">RM Report</a>
        <a class="collapse-item" href="formula_report.php">Formula Report</a>-->
        <a class="collapse-item" href="stockReg.php">Stock Report</a>
			<a class="collapse-item" href="stockReg_batch.php">Stock Report - Batch / LOT</a>
      <a class="collapse-item" href="stockReg_r.php">Re-order Report</a>
      <a class="collapse-item" href="stockReg_ost.php">Out of Stock Report</a>  
      <a class="collapse-item" href="expiryReg.php">Expiry Report</a>   
      <a class="collapse-item" href="inoutReport.php">IN-OUT Report</a>    
      <a class="collapse-item" href="fastMovingItemRpt.php">Fast Moving Item Report</a>    
      <a class="collapse-item" href="nonMovingItemRpt.php">Non Moving Item Report</a>       
        </div>
        </div>
        </li>
	  
	  <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#inquairy2" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Report2</span>        </a>
        <div id="inquairy2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <!--<h6 class="collapse-header">Custom Components:</h6>-->
        <!-- <a class="collapse-item" href="RM_report.php">RM Report</a>
        <a class="collapse-item" href="formula_report.php">Formula Report</a>-->
        <a class="collapse-item" href="stockRegLoc.php">Stock - Location(RM)</a>
      <a class="collapse-item" href="stockRegLoc2.php">Stock - Location(FG)</a>
        </div>
        </div>
        </li>
       
      <?php 	
      }
      else if($_SESSION['uAccess'] == "1,2,3,4")
      {
      ?>     
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Master</span>        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <!--<h6 class="collapse-header">Custom Components:</h6>-->
         <?php //Sub Master
          if($_SESSION['subAccess']=='1,2,3,4,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php
          }
          else if($_SESSION['subAccess'] == '1,2,3,4')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>  
         <?php
          }
          else if($_SESSION['subAccess'] == '1,2,3')
          {
           ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a> 
            
           <?php
		  }
		  else if($_SESSION['subAccess'] == '1,2,4')
		  {
		   ?> 
           <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>  
         <?php
          }
          else if($_SESSION['subAccess'] == '1,2,4,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php  
          }
          else if($_SESSION['subAccess'] == '1,2,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
            
           <?php
		  }
		  else if($_SESSION['subAccess'] == '2,3,4')
		  {
		   ?> 
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a> 
           
           <?php
		  	}
		   else if($_SESSION['subAccess'] == '2,3,5')
		   {
		   ?> 
           
           <a class="collapse-item" href="locationMaster.php">Location Master</a>
           <a class="collapse-item" href="rmMaster.php">RM Master</a>
           <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
           
           <?php
		   }
		   else if($_SESSION['subAccess'] == '2,4,5')
		   {
		   ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
           
         <?php
          }
          else if($_SESSION['subAccess'] == '1,3,4,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php 
          }
          else if($_SESSION['subAccess'] == '1,3,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a> 
            
          <?php
		  }
		  else if($_SESSION['subAccess'] == '1,3,4')
		  {
		  ?>  
           <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a> 
          
          <?php
		  }
		  else if($_SESSION['subAccess'] == '1,4,5')
		  {
		  ?>
         
         <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>
          <?php 
          }
          else if($_SESSION['subAccess'] == '1')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
         <?php
          }
          else if($_SESSION['subAccess'] == '2')
          {
          ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
         <?php 
          }
          else if($_SESSION['subAccess'] == '3')
          {
          ?>
            <a class="collapse-item" href="rmMaster.php">RM Master</a> 
         <?php
          }
          else if($_SESSION['subAccess'] == '4')
          {
          ?>
            <a class="collapse-item" href="fgMaster.php">FG Master</a>
         <?php
          }
          else if($_SESSION['subAccess'] == '5')
          {
          ?>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php  
          }
          else if($_SESSION['subAccess'] == '1,2')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a> 
          <?php  
          }
          else if($_SESSION['subAccess'] == '1,3')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
         <?php 
          }
          else if($_SESSION['subAccess'] == '1,4')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
         <?php
          }
          else if($_SESSION['subAccess'] == '1,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php  
          }
          else if($_SESSION['subAccess'] == '2,3')
          {
          ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>  
         <?php  
          }
          else if($_SESSION['subAccess'] == '2,4')
          {
          ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a> 
         <?php   
          }
          else if($_SESSION['subAccess'] == '2,5')
          {
          ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php 
          }
          else if($_SESSION['subAccess'] == '3,4')
          {
          ?>
            <a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a> 
         <?php 
          }
          else if($_SESSION['subAccess'] == '3,5')
          {
          ?>
            <a class="collapse-item" href="rmMaster.php">RM Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php 
          }
          else if($_SESSION['subAccess'] == '4,5')
          {
          ?>
            <a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php 
          }
          else
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a> 
           
 

         <?php    
          }
          //sub Master End
          //echo "subAccess=>".$_SESSION['subAccess'];
         ?>
		</div>
        </div>
      </li>
	 
      <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#purchase" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-fw fa-cog"></i>
      <span>Stock Entry</span>        </a>
      <div id="purchase" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
      <!--<h6 class="collapse-header">Custom Components:</h6>-->
      <a class="collapse-item" href="inventoryEntry.php">Stock Entry</a>
      <a class="collapse-item" href="inventoryReg.php">Stock Register</a>
      <a class="collapse-item" href="inventoryReg2.php">Stock Register -Product</a>
      
      </div>
      </div>
      </li>
	 
	  <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#lockQty" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Lock Quantity</span>        </a>
        <div id="lockQty" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <!--<h6 class="collapse-header">Custom Components:</h6>-->
        <a class="collapse-item" href="lockQty_entry.php">Lock Qty Entry</a>
        <a class="collapse-item" href="lockQty_Reg.php">Lock Qty Register</a>
     	<a class="collapse-item" href="lockQty_Reg2.php">Lock Qty Reg - Product</a>
        </div>
        </div>
        </li> 
	
	  <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#inquairy" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Report</span>        </a>
        <div id="inquairy" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <!--<h6 class="collapse-header">Custom Components:</h6>-->
        <!-- <a class="collapse-item" href="RM_report.php">RM Report</a>
        <a class="collapse-item" href="formula_report.php">Formula Report</a>-->
        <a class="collapse-item" href="stockReg.php">Stock Report</a>
			<a class="collapse-item" href="stockReg_batch.php">Stock Report - Batch / LOT</a>
      <a class="collapse-item" href="stockReg_r.php">Re-order Report</a>
      <a class="collapse-item" href="stockReg_ost.php">Out of Stock Report</a>  
      <a class="collapse-item" href="expiryReg.php">Expiry Report</a>  
      <a class="collapse-item" href="inoutReport.php">IN-OUT Report</a>     
      <a class="collapse-item" href="fastMovingItemRpt.php">Fast Moving Item Report</a>    
      <a class="collapse-item" href="nonMovingItemRpt.php">Non Moving Item Report</a>     
        </div>
        </div>
        </li>
      <?php 	
      }
      else if($_SESSION['uAccess'] == "1,2,3,5")
      {
      ?>     
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Master</span>        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <!--<h6 class="collapse-header">Custom Components:</h6>-->
         <?php //Sub Master
          if($_SESSION['subAccess']=='1,2,3,4,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php
          }
          else if($_SESSION['subAccess'] == '1,2,3,4')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>  
         <?php
          }
          else if($_SESSION['subAccess'] == '1,2,3')
          {
           ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a> 
            
           <?php
		  }
		  else if($_SESSION['subAccess'] == '1,2,4')
		  {
		   ?> 
           <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>  
         <?php
          }
          else if($_SESSION['subAccess'] == '1,2,4,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php  
          }
          else if($_SESSION['subAccess'] == '1,2,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
            
           <?php
		  }
		  else if($_SESSION['subAccess'] == '2,3,4')
		  {
		   ?> 
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a> 
           
           <?php
		  	}
		   else if($_SESSION['subAccess'] == '2,3,5')
		   {
		   ?> 
           
           <a class="collapse-item" href="locationMaster.php">Location Master</a>
           <a class="collapse-item" href="rmMaster.php">RM Master</a>
           <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
           
           <?php
		   }
		   else if($_SESSION['subAccess'] == '2,4,5')
		   {
		   ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
           
         <?php
          }
          else if($_SESSION['subAccess'] == '1,3,4,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php 
          }
          else if($_SESSION['subAccess'] == '1,3,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a> 
            
          <?php
		  }
		  else if($_SESSION['subAccess'] == '1,3,4')
		  {
		  ?>  
           <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a> 
          
          <?php
		  }
		  else if($_SESSION['subAccess'] == '1,4,5')
		  {
		  ?>
         
         <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>
          <?php 
          }
          else if($_SESSION['subAccess'] == '1')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
         <?php
          }
          else if($_SESSION['subAccess'] == '2')
          {
          ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
         <?php 
          }
          else if($_SESSION['subAccess'] == '3')
          {
          ?>
            <a class="collapse-item" href="rmMaster.php">RM Master</a> 
         <?php
          }
          else if($_SESSION['subAccess'] == '4')
          {
          ?>
            <a class="collapse-item" href="fgMaster.php">FG Master</a>
         <?php
          }
          else if($_SESSION['subAccess'] == '5')
          {
          ?>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php  
          }
          else if($_SESSION['subAccess'] == '1,2')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a> 
          <?php  
          }
          else if($_SESSION['subAccess'] == '1,3')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
         <?php 
          }
          else if($_SESSION['subAccess'] == '1,4')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
         <?php
          }
          else if($_SESSION['subAccess'] == '1,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php  
          }
          else if($_SESSION['subAccess'] == '2,3')
          {
          ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>  
         <?php  
          }
          else if($_SESSION['subAccess'] == '2,4')
          {
          ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a> 
         <?php   
          }
          else if($_SESSION['subAccess'] == '2,5')
          {
          ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php 
          }
          else if($_SESSION['subAccess'] == '3,4')
          {
          ?>
            <a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a> 
         <?php 
          }
          else if($_SESSION['subAccess'] == '3,5')
          {
          ?>
            <a class="collapse-item" href="rmMaster.php">RM Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php 
          }
          else if($_SESSION['subAccess'] == '4,5')
          {
          ?>
            <a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php 
          }
          else
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a> 
           
 

         <?php    
          }
          //sub Master End
          //echo "subAccess=>".$_SESSION['subAccess'];
         ?>
		</div>
        </div>
      </li>
	 
      <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#purchase" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-fw fa-cog"></i>
      <span>Stock Entry</span>        </a>
      <div id="purchase" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
      <!--<h6 class="collapse-header">Custom Components:</h6>-->
      <a class="collapse-item" href="inventoryEntry.php">Stock Entry</a>
      <a class="collapse-item" href="inventoryReg.php">Stock Register</a>
      <a class="collapse-item" href="inventoryReg2.php">Stock Register -Product</a>
      
      </div>
      </div>
      </li>
	 
	  <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#lockQty" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Lock Quantity</span>        </a>
        <div id="lockQty" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <!--<h6 class="collapse-header">Custom Components:</h6>-->
        <a class="collapse-item" href="lockQty_entry.php">Lock Qty Entry</a>
        <a class="collapse-item" href="lockQty_Reg.php">Lock Qty Register</a>
     	<a class="collapse-item" href="lockQty_Reg2.php">Lock Qty Reg - Product</a>
        </div>
        </div>
        </li> 
	
	  
	  
	  <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#inquairy2" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Report2</span>        </a>
        <div id="inquairy2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <!--<h6 class="collapse-header">Custom Components:</h6>-->
        <!-- <a class="collapse-item" href="RM_report.php">RM Report</a>
        <a class="collapse-item" href="formula_report.php">Formula Report</a>-->
        <a class="collapse-item" href="stockRegLoc.php">Stock - Location(RM)</a>
      <a class="collapse-item" href="stockRegLoc2.php">Stock - Location(FG)</a>
        </div>
        </div>
        </li>
       
      <?php 	
      }
      else if($_SESSION['uAccess'] == "1,2,4,5")
      {
      ?>     
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Master</span>        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <!--<h6 class="collapse-header">Custom Components:</h6>-->
         <?php //Sub Master
          if($_SESSION['subAccess']=='1,2,3,4,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php
          }
          else if($_SESSION['subAccess'] == '1,2,3,4')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>  
         <?php
          }
          else if($_SESSION['subAccess'] == '1,2,3')
          {
           ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a> 
            
           <?php
		  }
		  else if($_SESSION['subAccess'] == '1,2,4')
		  {
		   ?> 
           <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>  
         <?php
          }
          else if($_SESSION['subAccess'] == '1,2,4,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php  
          }
          else if($_SESSION['subAccess'] == '1,2,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
            
           <?php
		  }
		  else if($_SESSION['subAccess'] == '2,3,4')
		  {
		   ?> 
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a> 
           
           <?php
		  	}
		   else if($_SESSION['subAccess'] == '2,3,5')
		   {
		   ?> 
           
           <a class="collapse-item" href="locationMaster.php">Location Master</a>
           <a class="collapse-item" href="rmMaster.php">RM Master</a>
           <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
           
           <?php
		   }
		   else if($_SESSION['subAccess'] == '2,4,5')
		   {
		   ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
           
         <?php
          }
          else if($_SESSION['subAccess'] == '1,3,4,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php 
          }
          else if($_SESSION['subAccess'] == '1,3,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a> 
            
          <?php
		  }
		  else if($_SESSION['subAccess'] == '1,3,4')
		  {
		  ?>  
           <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a> 
          
          <?php
		  }
		  else if($_SESSION['subAccess'] == '1,4,5')
		  {
		  ?>
         
         <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>
          <?php 
          }
          else if($_SESSION['subAccess'] == '1')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
         <?php
          }
          else if($_SESSION['subAccess'] == '2')
          {
          ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
         <?php 
          }
          else if($_SESSION['subAccess'] == '3')
          {
          ?>
            <a class="collapse-item" href="rmMaster.php">RM Master</a> 
         <?php
          }
          else if($_SESSION['subAccess'] == '4')
          {
          ?>
            <a class="collapse-item" href="fgMaster.php">FG Master</a>
         <?php
          }
          else if($_SESSION['subAccess'] == '5')
          {
          ?>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php  
          }
          else if($_SESSION['subAccess'] == '1,2')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a> 
          <?php  
          }
          else if($_SESSION['subAccess'] == '1,3')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
         <?php 
          }
          else if($_SESSION['subAccess'] == '1,4')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
         <?php
          }
          else if($_SESSION['subAccess'] == '1,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php  
          }
          else if($_SESSION['subAccess'] == '2,3')
          {
          ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>  
         <?php  
          }
          else if($_SESSION['subAccess'] == '2,4')
          {
          ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a> 
         <?php   
          }
          else if($_SESSION['subAccess'] == '2,5')
          {
          ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php 
          }
          else if($_SESSION['subAccess'] == '3,4')
          {
          ?>
            <a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a> 
         <?php 
          }
          else if($_SESSION['subAccess'] == '3,5')
          {
          ?>
            <a class="collapse-item" href="rmMaster.php">RM Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php 
          }
          else if($_SESSION['subAccess'] == '4,5')
          {
          ?>
            <a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php 
          }
          else
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a> 
           
 

         <?php    
          }
          //sub Master End
          //echo "subAccess=>".$_SESSION['subAccess'];
         ?>
		</div>
        </div>
      </li>
	 
      <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#purchase" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-fw fa-cog"></i>
      <span>Stock Entry</span>        </a>
      <div id="purchase" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
      <!--<h6 class="collapse-header">Custom Components:</h6>-->
      <a class="collapse-item" href="inventoryEntry.php">Stock Entry</a>
      <a class="collapse-item" href="inventoryReg.php">Stock Register</a>
      <a class="collapse-item" href="inventoryReg2.php">Stock Register -Product</a>
      
      </div>
      </div>
      </li>
	 
	  <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#inquairy" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Report</span>        </a>
        <div id="inquairy" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <!--<h6 class="collapse-header">Custom Components:</h6>-->
        <!-- <a class="collapse-item" href="RM_report.php">RM Report</a>
        <a class="collapse-item" href="formula_report.php">Formula Report</a>-->
        <a class="collapse-item" href="stockReg.php">Stock Report</a>
			<a class="collapse-item" href="stockReg_batch.php">Stock Report - Batch / LOT</a>
      <a class="collapse-item" href="stockReg_r.php">Re-order Report</a>
      <a class="collapse-item" href="stockReg_ost.php">Out of Stock Report</a>  
      <a class="collapse-item" href="expiryReg.php">Expiry Report</a>    
      <a class="collapse-item" href="inoutReport.php">IN-OUT Report</a>     
      <a class="collapse-item" href="fastMovingItemRpt.php">Fast Moving Item Report</a>    
      <a class="collapse-item" href="nonMovingItemRpt.php">Non Moving Item Report</a>
        </div>
        </div>
        </li>
	  
	  <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#inquairy2" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Report2</span>        </a>
        <div id="inquairy2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <!--<h6 class="collapse-header">Custom Components:</h6>-->
        <!-- <a class="collapse-item" href="RM_report.php">RM Report</a>
        <a class="collapse-item" href="formula_report.php">Formula Report</a>-->
        <a class="collapse-item" href="stockRegLoc.php">Stock - Location(RM)</a>
      <a class="collapse-item" href="stockRegLoc2.php">Stock - Location(FG)</a>
        </div>
        </div>
        </li>
       
      <?php 	
      }
      else if($_SESSION['uAccess'] == "1,3,4,5")
      {
      ?>     
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Master</span>        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <!--<h6 class="collapse-header">Custom Components:</h6>-->
         <?php //Sub Master
          if($_SESSION['subAccess']=='1,2,3,4,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php
          }
          else if($_SESSION['subAccess'] == '1,2,3,4')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>  
         <?php
          }
          else if($_SESSION['subAccess'] == '1,2,3')
          {
           ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a> 
            
           <?php
		  }
		  else if($_SESSION['subAccess'] == '1,2,4')
		  {
		   ?> 
           <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>  
         <?php
          }
          else if($_SESSION['subAccess'] == '1,2,4,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php  
          }
          else if($_SESSION['subAccess'] == '1,2,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
            
           <?php
		  }
		  else if($_SESSION['subAccess'] == '2,3,4')
		  {
		   ?> 
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a> 
           
           <?php
		  	}
		   else if($_SESSION['subAccess'] == '2,3,5')
		   {
		   ?> 
           
           <a class="collapse-item" href="locationMaster.php">Location Master</a>
           <a class="collapse-item" href="rmMaster.php">RM Master</a>
           <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
           
           <?php
		   }
		   else if($_SESSION['subAccess'] == '2,4,5')
		   {
		   ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
           
         <?php
          }
          else if($_SESSION['subAccess'] == '1,3,4,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php 
          }
          else if($_SESSION['subAccess'] == '1,3,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a> 
            
          <?php
		  }
		  else if($_SESSION['subAccess'] == '1,3,4')
		  {
		  ?>  
           <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a> 
          
          <?php
		  }
		  else if($_SESSION['subAccess'] == '1,4,5')
		  {
		  ?>
         
         <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>
          <?php 
          }
          else if($_SESSION['subAccess'] == '1')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
         <?php
          }
          else if($_SESSION['subAccess'] == '2')
          {
          ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
         <?php 
          }
          else if($_SESSION['subAccess'] == '3')
          {
          ?>
            <a class="collapse-item" href="rmMaster.php">RM Master</a> 
         <?php
          }
          else if($_SESSION['subAccess'] == '4')
          {
          ?>
            <a class="collapse-item" href="fgMaster.php">FG Master</a>
         <?php
          }
          else if($_SESSION['subAccess'] == '5')
          {
          ?>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php  
          }
          else if($_SESSION['subAccess'] == '1,2')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a> 
          <?php  
          }
          else if($_SESSION['subAccess'] == '1,3')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
         <?php 
          }
          else if($_SESSION['subAccess'] == '1,4')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
         <?php
          }
          else if($_SESSION['subAccess'] == '1,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php  
          }
          else if($_SESSION['subAccess'] == '2,3')
          {
          ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>  
         <?php  
          }
          else if($_SESSION['subAccess'] == '2,4')
          {
          ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a> 
         <?php   
          }
          else if($_SESSION['subAccess'] == '2,5')
          {
          ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php 
          }
          else if($_SESSION['subAccess'] == '3,4')
          {
          ?>
            <a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a> 
         <?php 
          }
          else if($_SESSION['subAccess'] == '3,5')
          {
          ?>
            <a class="collapse-item" href="rmMaster.php">RM Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php 
          }
          else if($_SESSION['subAccess'] == '4,5')
          {
          ?>
            <a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php 
          }
          else
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a> 
           
 

         <?php    
          }
          //sub Master End
          //echo "subAccess=>".$_SESSION['subAccess'];
         ?>
		</div>
        </div>
      </li>
	 
	  <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#lockQty" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Lock Quantity</span>        </a>
        <div id="lockQty" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <!--<h6 class="collapse-header">Custom Components:</h6>-->
        <a class="collapse-item" href="lockQty_entry.php">Lock Qty Entry</a>
        <a class="collapse-item" href="lockQty_Reg.php">Lock Qty Register</a>
     	<a class="collapse-item" href="lockQty_Reg2.php">Lock Qty Reg - Product</a>
        </div>
        </div>
        </li> 
	
	  <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#inquairy" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Report</span>        </a>
        <div id="inquairy" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <!--<h6 class="collapse-header">Custom Components:</h6>-->
        <!-- <a class="collapse-item" href="RM_report.php">RM Report</a>
        <a class="collapse-item" href="formula_report.php">Formula Report</a>-->
        <a class="collapse-item" href="stockReg.php">Stock Report</a>
			<a class="collapse-item" href="stockReg_batch.php">Stock Report - Batch / LOT</a>
      <a class="collapse-item" href="stockReg_r.php">Re-order Report</a>
      <a class="collapse-item" href="stockReg_ost.php">Out of Stock Report</a>  
      <a class="collapse-item" href="expiryReg.php">Expiry Report</a>   
      <a class="collapse-item" href="inoutReport.php">IN-OUT Report</a>      
      <a class="collapse-item" href="fastMovingItemRpt.php">Fast Moving Item Report</a>    
      <a class="collapse-item" href="nonMovingItemRpt.php">Non Moving Item Report</a>
        </div>
        </div>
        </li>
	  
	  <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#inquairy2" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Report2</span>        </a>
        <div id="inquairy2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <!--<h6 class="collapse-header">Custom Components:</h6>-->
        <!-- <a class="collapse-item" href="RM_report.php">RM Report</a>
        <a class="collapse-item" href="formula_report.php">Formula Report</a>-->
        <a class="collapse-item" href="stockRegLoc.php">Stock - Location(RM)</a>
      <a class="collapse-item" href="stockRegLoc2.php">Stock - Location(FG)</a>
        </div>
        </div>
        </li>
       
      <?php 	
      }
      else if($_SESSION['uAccess'] == "1,2,3")
      {
      ?>     
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Master</span>        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <!--<h6 class="collapse-header">Custom Components:</h6>-->
         <?php //Sub Master
          if($_SESSION['subAccess']=='1,2,3,4,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php
          }
          else if($_SESSION['subAccess'] == '1,2,3,4')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>  
         <?php
          }
          else if($_SESSION['subAccess'] == '1,2,3')
          {
           ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a> 
            
           <?php
		  }
		  else if($_SESSION['subAccess'] == '1,2,4')
		  {
		   ?> 
           <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>  
         <?php
          }
          else if($_SESSION['subAccess'] == '1,2,4,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php  
          }
          else if($_SESSION['subAccess'] == '1,2,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
            
           <?php
		  }
		  else if($_SESSION['subAccess'] == '2,3,4')
		  {
		   ?> 
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a> 
           
           <?php
		  	}
		   else if($_SESSION['subAccess'] == '2,3,5')
		   {
		   ?> 
           
           <a class="collapse-item" href="locationMaster.php">Location Master</a>
           <a class="collapse-item" href="rmMaster.php">RM Master</a>
           <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
           
           <?php
		   }
		   else if($_SESSION['subAccess'] == '2,4,5')
		   {
		   ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
           
         <?php
          }
          else if($_SESSION['subAccess'] == '1,3,4,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php 
          }
          else if($_SESSION['subAccess'] == '1,3,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a> 
            
          <?php
		  }
		  else if($_SESSION['subAccess'] == '1,3,4')
		  {
		  ?>  
           <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a> 
          
          <?php
		  }
		  else if($_SESSION['subAccess'] == '1,4,5')
		  {
		  ?>
         
         <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>
          <?php 
          }
          else if($_SESSION['subAccess'] == '1')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
         <?php
          }
          else if($_SESSION['subAccess'] == '2')
          {
          ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
         <?php 
          }
          else if($_SESSION['subAccess'] == '3')
          {
          ?>
            <a class="collapse-item" href="rmMaster.php">RM Master</a> 
         <?php
          }
          else if($_SESSION['subAccess'] == '4')
          {
          ?>
            <a class="collapse-item" href="fgMaster.php">FG Master</a>
         <?php
          }
          else if($_SESSION['subAccess'] == '5')
          {
          ?>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php  
          }
          else if($_SESSION['subAccess'] == '1,2')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a> 
          <?php  
          }
          else if($_SESSION['subAccess'] == '1,3')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
         <?php 
          }
          else if($_SESSION['subAccess'] == '1,4')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
         <?php
          }
          else if($_SESSION['subAccess'] == '1,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php  
          }
          else if($_SESSION['subAccess'] == '2,3')
          {
          ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>  
         <?php  

          }
          else if($_SESSION['subAccess'] == '2,4')
          {
          ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a> 
         <?php   
          }
          else if($_SESSION['subAccess'] == '2,5')
          {
          ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php 
          }
          else if($_SESSION['subAccess'] == '3,4')
          {
          ?>
            <a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a> 
         <?php 
          }
          else if($_SESSION['subAccess'] == '3,5')
          {
          ?>
            <a class="collapse-item" href="rmMaster.php">RM Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php 
          }
          else if($_SESSION['subAccess'] == '4,5')
          {
          ?>
            <a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php 
          }
          else
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a> 
           
 

         <?php    
          }
          //sub Master End
          //echo "subAccess=>".$_SESSION['subAccess'];
         ?>
		</div>
        </div>
      </li>
	 
      <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#purchase" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-fw fa-cog"></i>
      <span>Stock Entry</span>        </a>
      <div id="purchase" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
      <!--<h6 class="collapse-header">Custom Components:</h6>-->
      <a class="collapse-item" href="inventoryEntry.php">Stock Entry</a>
      <a class="collapse-item" href="inventoryReg.php">Stock Register</a>
      <a class="collapse-item" href="inventoryReg2.php">Stock Register -Product</a>
      
      </div>
      </div>
      </li>
	 
	  <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#lockQty" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Lock Quantity</span>        </a>
        <div id="lockQty" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <!--<h6 class="collapse-header">Custom Components:</h6>-->
        <a class="collapse-item" href="lockQty_entry.php">Lock Qty Entry</a>
        <a class="collapse-item" href="lockQty_Reg.php">Lock Qty Register</a>
     	<a class="collapse-item" href="lockQty_Reg2.php">Lock Qty Reg - Product</a>
        </div>
        </div>
        </li> 	  
       
      <?php 	
      }
      else if($_SESSION['uAccess'] == "1,2,4")
      {
      ?>     
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Master</span>        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <!--<h6 class="collapse-header">Custom Components:</h6>-->
         <?php //Sub Master
          if($_SESSION['subAccess']=='1,2,3,4,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php
          }
          else if($_SESSION['subAccess'] == '1,2,3,4')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>  
         <?php
          }
          else if($_SESSION['subAccess'] == '1,2,3')
          {
           ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a> 
            
           <?php
		  }
		  else if($_SESSION['subAccess'] == '1,2,4')
		  {
		   ?> 
           <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>  
         <?php
          }
          else if($_SESSION['subAccess'] == '1,2,4,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php  
          }
          else if($_SESSION['subAccess'] == '1,2,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
            
           <?php
		  }
		  else if($_SESSION['subAccess'] == '2,3,4')
		  {
		   ?> 
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a> 
           
           <?php
		  	}
		   else if($_SESSION['subAccess'] == '2,3,5')
		   {
		   ?> 
           
           <a class="collapse-item" href="locationMaster.php">Location Master</a>
           <a class="collapse-item" href="rmMaster.php">RM Master</a>
           <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
           
           <?php
		   }
		   else if($_SESSION['subAccess'] == '2,4,5')
		   {
		   ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
           
         <?php
          }
          else if($_SESSION['subAccess'] == '1,3,4,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php 
          }
          else if($_SESSION['subAccess'] == '1,3,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a> 
            
          <?php
		  }
		  else if($_SESSION['subAccess'] == '1,3,4')
		  {
		  ?>  
           <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a> 
          
          <?php
		  }
		  else if($_SESSION['subAccess'] == '1,4,5')
		  {
		  ?>
         
         <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>
          <?php 
          }
          else if($_SESSION['subAccess'] == '1')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
         <?php
          }
          else if($_SESSION['subAccess'] == '2')
          {
          ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
         <?php 
          }
          else if($_SESSION['subAccess'] == '3')
          {
          ?>
            <a class="collapse-item" href="rmMaster.php">RM Master</a> 
         <?php
          }
          else if($_SESSION['subAccess'] == '4')
          {
          ?>
            <a class="collapse-item" href="fgMaster.php">FG Master</a>
         <?php
          }
          else if($_SESSION['subAccess'] == '5')
          {
          ?>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php  
          }
          else if($_SESSION['subAccess'] == '1,2')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a> 
          <?php  
          }
          else if($_SESSION['subAccess'] == '1,3')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
         <?php 
          }
          else if($_SESSION['subAccess'] == '1,4')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
         <?php
          }
          else if($_SESSION['subAccess'] == '1,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php  
          }
          else if($_SESSION['subAccess'] == '2,3')
          {
          ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>  
         <?php  
          }
          else if($_SESSION['subAccess'] == '2,4')
          {
          ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a> 
         <?php   
          }
          else if($_SESSION['subAccess'] == '2,5')
          {
          ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php 
          }
          else if($_SESSION['subAccess'] == '3,4')
          {
          ?>
            <a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a> 
         <?php 
          }
          else if($_SESSION['subAccess'] == '3,5')
          {
          ?>
            <a class="collapse-item" href="rmMaster.php">RM Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php 
          }
          else if($_SESSION['subAccess'] == '4,5')
          {
          ?>
            <a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php 
          }
          else
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a> 
           
 

         <?php    
          }
          //sub Master End
          //echo "subAccess=>".$_SESSION['subAccess'];
         ?>
		</div>
        </div>
      </li>
	 
      <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#purchase" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-fw fa-cog"></i>
      <span>Stock Entry</span>        </a>
      <div id="purchase" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
      <!--<h6 class="collapse-header">Custom Components:</h6>-->
      <a class="collapse-item" href="inventoryEntry.php">Stock Entry</a>
      <a class="collapse-item" href="inventoryReg.php">Stock Register</a>
      <a class="collapse-item" href="inventoryReg2.php">Stock Register -Product</a>
      
      </div>
      </div>
      </li>
	
	  <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#inquairy" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Report</span>        </a>
        <div id="inquairy" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <!--<h6 class="collapse-header">Custom Components:</h6>-->
        <!-- <a class="collapse-item" href="RM_report.php">RM Report</a>
        <a class="collapse-item" href="formula_report.php">Formula Report</a>-->
        <a class="collapse-item" href="stockReg.php">Stock Report</a>
			<a class="collapse-item" href="stockReg_batch.php">Stock Report - Batch / LOT</a>
      <a class="collapse-item" href="stockReg_r.php">Re-order Report</a>
      <a class="collapse-item" href="stockReg_ost.php">Out of Stock Report</a>  
      <a class="collapse-item" href="expiryReg.php">Expiry Report</a>  
      <a class="collapse-item" href="inoutReport.php">IN-OUT Report</a>     
      <a class="collapse-item" href="fastMovingItemRpt.php">Fast Moving Item Report</a>    
      <a class="collapse-item" href="nonMovingItemRpt.php">Non Moving Item Report</a> 
        </div>
        </div>
        </li>
       
      <?php 	
      }
      else if($_SESSION['uAccess'] == "1,2,5")
      {
      ?>     
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Master</span>        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <!--<h6 class="collapse-header">Custom Components:</h6>-->
         <?php //Sub Master
          if($_SESSION['subAccess']=='1,2,3,4,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php
          }
          else if($_SESSION['subAccess'] == '1,2,3,4')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>  
         <?php
          }
          else if($_SESSION['subAccess'] == '1,2,3')
          {
           ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a> 
            
           <?php
		  }
		  else if($_SESSION['subAccess'] == '1,2,4')
		  {
		   ?> 
           <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>  
         <?php
          }
          else if($_SESSION['subAccess'] == '1,2,4,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php  
          }
          else if($_SESSION['subAccess'] == '1,2,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
            
           <?php
		  }
		  else if($_SESSION['subAccess'] == '2,3,4')
		  {
		   ?> 
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a> 
           
           <?php
		  	}
		   else if($_SESSION['subAccess'] == '2,3,5')
		   {
		   ?> 
           
           <a class="collapse-item" href="locationMaster.php">Location Master</a>
           <a class="collapse-item" href="rmMaster.php">RM Master</a>
           <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
           
           <?php
		   }
		   else if($_SESSION['subAccess'] == '2,4,5')
		   {
		   ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
           
         <?php
          }
          else if($_SESSION['subAccess'] == '1,3,4,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php 
          }
          else if($_SESSION['subAccess'] == '1,3,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a> 
            
          <?php
		  }
		  else if($_SESSION['subAccess'] == '1,3,4')
		  {
		  ?>  
           <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a> 
          
          <?php
		  }
		  else if($_SESSION['subAccess'] == '1,4,5')
		  {
		  ?>
         
         <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>
          <?php 
          }
          else if($_SESSION['subAccess'] == '1')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
         <?php
          }
          else if($_SESSION['subAccess'] == '2')
          {
          ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
         <?php 
          }
          else if($_SESSION['subAccess'] == '3')
          {
          ?>
            <a class="collapse-item" href="rmMaster.php">RM Master</a> 
         <?php
          }
          else if($_SESSION['subAccess'] == '4')
          {
          ?>
            <a class="collapse-item" href="fgMaster.php">FG Master</a>
         <?php
          }
          else if($_SESSION['subAccess'] == '5')
          {
          ?>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php  
          }
          else if($_SESSION['subAccess'] == '1,2')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a> 
          <?php  
          }
          else if($_SESSION['subAccess'] == '1,3')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
         <?php 
          }
          else if($_SESSION['subAccess'] == '1,4')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
         <?php
          }
          else if($_SESSION['subAccess'] == '1,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php  
          }
          else if($_SESSION['subAccess'] == '2,3')
          {
          ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>  
         <?php  
          }
          else if($_SESSION['subAccess'] == '2,4')
          {
          ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a> 
         <?php   
          }
          else if($_SESSION['subAccess'] == '2,5')
          {
          ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php 
          }
          else if($_SESSION['subAccess'] == '3,4')
          {
          ?>
            <a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a> 
         <?php 
          }
          else if($_SESSION['subAccess'] == '3,5')
          {
          ?>
            <a class="collapse-item" href="rmMaster.php">RM Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php 
          }
          else if($_SESSION['subAccess'] == '4,5')
          {
          ?>
            <a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php 
          }
          else
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a> 
           
 

         <?php    
          }
          //sub Master End
          //echo "subAccess=>".$_SESSION['subAccess'];
         ?>
		</div>
        </div>
      </li>
	 
      <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#purchase" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-fw fa-cog"></i>
      <span>Stock Entry</span>        </a>
      <div id="purchase" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
      <!--<h6 class="collapse-header">Custom Components:</h6>-->
      <a class="collapse-item" href="inventoryEntry.php">Stock Entry</a>
      <a class="collapse-item" href="inventoryReg.php">Stock Register</a>
      <a class="collapse-item" href="inventoryReg2.php">Stock Register - Product</a>
      
      </div>
      </div>
      </li>
	  
	  <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#inquairy2" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Report2</span>        </a>
        <div id="inquairy2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <!--<h6 class="collapse-header">Custom Components:</h6>-->
        <!-- <a class="collapse-item" href="RM_report.php">RM Report</a>
        <a class="collapse-item" href="formula_report.php">Formula Report</a>-->
        <a class="collapse-item" href="stockRegLoc.php">Stock - Location(RM)</a>
      <a class="collapse-item" href="stockRegLoc2.php">Stock - Location(FG)</a>
        </div>
        </div>
        </li>
       
      <?php 	
      }	
      else if($_SESSION['uAccess'] == "1,3,5")
      {
      ?>     
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Master</span>        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <!--<h6 class="collapse-header">Custom Components:</h6>-->
         <?php //Sub Master
          if($_SESSION['subAccess']=='1,2,3,4,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php
          }
          else if($_SESSION['subAccess'] == '1,2,3,4')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>  
         <?php
          }
          else if($_SESSION['subAccess'] == '1,2,3')
          {
           ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a> 
            
           <?php
		  }
		  else if($_SESSION['subAccess'] == '1,2,4')
		  {
		   ?> 
           <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>  
         <?php
          }
          else if($_SESSION['subAccess'] == '1,2,4,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php  
          }
          else if($_SESSION['subAccess'] == '1,2,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
            
           <?php
		  }
		  else if($_SESSION['subAccess'] == '2,3,4')
		  {
		   ?> 
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a> 
           
           <?php
		  	}
		   else if($_SESSION['subAccess'] == '2,3,5')
		   {
		   ?> 
           
           <a class="collapse-item" href="locationMaster.php">Location Master</a>
           <a class="collapse-item" href="rmMaster.php">RM Master</a>
           <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
           
           <?php
		   }
		   else if($_SESSION['subAccess'] == '2,4,5')
		   {
		   ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
           
         <?php
          }
          else if($_SESSION['subAccess'] == '1,3,4,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php 
          }
          else if($_SESSION['subAccess'] == '1,3,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a> 
            
          <?php
		  }
		  else if($_SESSION['subAccess'] == '1,3,4')
		  {
		  ?>  
           <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a> 
          
          <?php
		  }
		  else if($_SESSION['subAccess'] == '1,4,5')
		  {
		  ?>
         
         <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>
          <?php 
          }
          else if($_SESSION['subAccess'] == '1')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
         <?php
          }
          else if($_SESSION['subAccess'] == '2')
          {
          ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
         <?php 
          }
          else if($_SESSION['subAccess'] == '3')
          {
          ?>
            <a class="collapse-item" href="rmMaster.php">RM Master</a> 
         <?php
          }
          else if($_SESSION['subAccess'] == '4')
          {
          ?>
            <a class="collapse-item" href="fgMaster.php">FG Master</a>
         <?php
          }
          else if($_SESSION['subAccess'] == '5')
          {
          ?>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php  
          }
          else if($_SESSION['subAccess'] == '1,2')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a> 
          <?php  
          }
          else if($_SESSION['subAccess'] == '1,3')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
         <?php 
          }
          else if($_SESSION['subAccess'] == '1,4')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
         <?php
          }
          else if($_SESSION['subAccess'] == '1,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php  
          }
          else if($_SESSION['subAccess'] == '2,3')
          {
          ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>  
         <?php  
          }
          else if($_SESSION['subAccess'] == '2,4')
          {
          ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a> 
         <?php   
          }
          else if($_SESSION['subAccess'] == '2,5')
          {
          ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php 
          }
          else if($_SESSION['subAccess'] == '3,4')
          {
          ?>
            <a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a> 
         <?php 
          }
          else if($_SESSION['subAccess'] == '3,5')
          {
          ?>
            <a class="collapse-item" href="rmMaster.php">RM Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php 
          }
          else if($_SESSION['subAccess'] == '4,5')
          {
          ?>
            <a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php 
          }
          else
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a> 
           
 

         <?php    
          }
          //sub Master End
          //echo "subAccess=>".$_SESSION['subAccess'];
         ?>
		</div>
        </div>
      </li>
	
	  <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#lockQty" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Lock Quantity</span>        </a>
        <div id="lockQty" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <!--<h6 class="collapse-header">Custom Components:</h6>-->
        <a class="collapse-item" href="lockQty_entry.php">Lock Qty Entry</a>
        <a class="collapse-item" href="lockQty_Reg.php">Lock Qty Register</a>
     	<a class="collapse-item" href="lockQty_Reg2.php">Lock Qty Reg - Product</a>
        </div>
        </div>
        </li>   
	  
	  <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#inquairy2" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Report2</span>        </a>
        <div id="inquairy2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <!--<h6 class="collapse-header">Custom Components:</h6>-->
        <!-- <a class="collapse-item" href="RM_report.php">RM Report</a>
        <a class="collapse-item" href="formula_report.php">Formula Report</a>-->
        <a class="collapse-item" href="stockRegLoc.php">Stock - Location(RM)</a>
      <a class="collapse-item" href="stockRegLoc2.php">Stock - Location(FG)</a>
        </div>
        </div>
        </li>
       
      <?php 	
      }
      else if($_SESSION['uAccess'] == "1,3,4")
      {
      ?>     
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Master</span>        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <!--<h6 class="collapse-header">Custom Components:</h6>-->
         <?php //Sub Master
          if($_SESSION['subAccess']=='1,2,3,4,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php
          }
          else if($_SESSION['subAccess'] == '1,2,3,4')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>  
         <?php
          }
          else if($_SESSION['subAccess'] == '1,2,3')
          {
           ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a> 
            
           <?php
		  }
		  else if($_SESSION['subAccess'] == '1,2,4')
		  {
		   ?> 
           <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>  
         <?php
          }
          else if($_SESSION['subAccess'] == '1,2,4,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php  
          }
          else if($_SESSION['subAccess'] == '1,2,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
            
           <?php
		  }
		  else if($_SESSION['subAccess'] == '2,3,4')
		  {
		   ?> 
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a> 
           
           <?php
		  	}
		   else if($_SESSION['subAccess'] == '2,3,5')
		   {
		   ?> 
           
           <a class="collapse-item" href="locationMaster.php">Location Master</a>
           <a class="collapse-item" href="rmMaster.php">RM Master</a>
           <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
           
           <?php
		   }
		   else if($_SESSION['subAccess'] == '2,4,5')
		   {
		   ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
           
         <?php
          }
          else if($_SESSION['subAccess'] == '1,3,4,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php 
          }
          else if($_SESSION['subAccess'] == '1,3,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a> 
            
          <?php
		  }
		  else if($_SESSION['subAccess'] == '1,3,4')
		  {
		  ?>  
           <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a> 
          
          <?php
		  }
		  else if($_SESSION['subAccess'] == '1,4,5')
		  {
		  ?>
         
         <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>
          <?php 
          }
          else if($_SESSION['subAccess'] == '1')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
         <?php
          }
          else if($_SESSION['subAccess'] == '2')
          {
          ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
         <?php 
          }
          else if($_SESSION['subAccess'] == '3')
          {
          ?>
            <a class="collapse-item" href="rmMaster.php">RM Master</a> 
         <?php
          }
          else if($_SESSION['subAccess'] == '4')
          {
          ?>
            <a class="collapse-item" href="fgMaster.php">FG Master</a>
         <?php
          }
          else if($_SESSION['subAccess'] == '5')
          {
          ?>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php  
          }
          else if($_SESSION['subAccess'] == '1,2')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a> 
          <?php  
          }
          else if($_SESSION['subAccess'] == '1,3')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
         <?php 
          }
          else if($_SESSION['subAccess'] == '1,4')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
         <?php
          }
          else if($_SESSION['subAccess'] == '1,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php  
          }
          else if($_SESSION['subAccess'] == '2,3')
          {
          ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>  
         <?php  
          }
          else if($_SESSION['subAccess'] == '2,4')
          {
          ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a> 
         <?php   
          }
          else if($_SESSION['subAccess'] == '2,5')
          {
          ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php 
          }
          else if($_SESSION['subAccess'] == '3,4')
          {
          ?>
            <a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a> 
         <?php 
          }
          else if($_SESSION['subAccess'] == '3,5')
          {
          ?>
            <a class="collapse-item" href="rmMaster.php">RM Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php 
          }
          else if($_SESSION['subAccess'] == '4,5')
          {
          ?>
            <a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php 
          }
          else
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a> 
           
 

         <?php    
          }
          //sub Master End
          //echo "subAccess=>".$_SESSION['subAccess'];
         ?>
		</div>
        </div>
      </li>
	 
	  <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#lockQty" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Lock Quantity</span>        </a>
        <div id="lockQty" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <!--<h6 class="collapse-header">Custom Components:</h6>-->
        <a class="collapse-item" href="lockQty_entry.php">Lock Qty Entry</a>
        <a class="collapse-item" href="lockQty_Reg.php">Lock Qty Register</a>
     	<a class="collapse-item" href="lockQty_Reg2.php">Lock Qty Reg - Product</a>
        </div>
        </div>
        </li> 
	
	  <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#inquairy" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Report</span>        </a>
        <div id="inquairy" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <!--<h6 class="collapse-header">Custom Components:</h6>-->
        <!-- <a class="collapse-item" href="RM_report.php">RM Report</a>
        <a class="collapse-item" href="formula_report.php">Formula Report</a>-->
        <a class="collapse-item" href="stockReg.php">Stock Report</a>
			<a class="collapse-item" href="stockReg_batch.php">Stock Report - Batch / LOT</a>
      <a class="collapse-item" href="stockReg_r.php">Re-order Report</a>
      <a class="collapse-item" href="stockReg_ost.php">Out of Stock Report</a>  
      <a class="collapse-item" href="expiryReg.php">Expiry Report</a>     
      <a class="collapse-item" href="inoutReport.php">IN-OUT Report</a>     
      <a class="collapse-item" href="fastMovingItemRpt.php">Fast Moving Item Report</a>    
      <a class="collapse-item" href="nonMovingItemRpt.php">Non Moving Item Report</a>
        </div>
        </div>
        </li>
       
      <?php 	
      }
      else if($_SESSION['uAccess'] == "1,4,5")
      {
      ?>     
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Master</span>        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <!--<h6 class="collapse-header">Custom Components:</h6>-->
         <?php //Sub Master
          if($_SESSION['subAccess']=='1,2,3,4,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php
          }
          else if($_SESSION['subAccess'] == '1,2,3,4')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>  
         <?php
          }
          else if($_SESSION['subAccess'] == '1,2,3')
          {
           ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a> 
            
           <?php
		  }
		  else if($_SESSION['subAccess'] == '1,2,4')
		  {
		   ?> 
           <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>  
         <?php
          }
          else if($_SESSION['subAccess'] == '1,2,4,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php  
          }
          else if($_SESSION['subAccess'] == '1,2,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
            
           <?php
		  }
		  else if($_SESSION['subAccess'] == '2,3,4')
		  {
		   ?> 
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a> 
           
           <?php
		  	}
		   else if($_SESSION['subAccess'] == '2,3,5')
		   {
		   ?> 
           
           <a class="collapse-item" href="locationMaster.php">Location Master</a>
           <a class="collapse-item" href="rmMaster.php">RM Master</a>
           <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
           
           <?php
		   }
		   else if($_SESSION['subAccess'] == '2,4,5')
		   {
		   ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
           
         <?php
          }
          else if($_SESSION['subAccess'] == '1,3,4,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php 
          }
          else if($_SESSION['subAccess'] == '1,3,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a> 
            
          <?php
		  }
		  else if($_SESSION['subAccess'] == '1,3,4')
		  {
		  ?>  
           <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a> 
          
          <?php
		  }
		  else if($_SESSION['subAccess'] == '1,4,5')
		  {
		  ?>
         
         <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>
          <?php 
          }
          else if($_SESSION['subAccess'] == '1')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
         <?php
          }
          else if($_SESSION['subAccess'] == '2')
          {
          ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
         <?php 
          }
          else if($_SESSION['subAccess'] == '3')
          {
          ?>
            <a class="collapse-item" href="rmMaster.php">RM Master</a> 
         <?php
          }
          else if($_SESSION['subAccess'] == '4')
          {
          ?>
            <a class="collapse-item" href="fgMaster.php">FG Master</a>
         <?php
          }
          else if($_SESSION['subAccess'] == '5')
          {
          ?>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php  
          }
          else if($_SESSION['subAccess'] == '1,2')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a> 
          <?php  
          }
          else if($_SESSION['subAccess'] == '1,3')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
         <?php 
          }
          else if($_SESSION['subAccess'] == '1,4')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
         <?php
          }
          else if($_SESSION['subAccess'] == '1,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php  
          }
          else if($_SESSION['subAccess'] == '2,3')
          {
          ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>  
         <?php  
          }
          else if($_SESSION['subAccess'] == '2,4')
          {
          ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a> 
         <?php   
          }
          else if($_SESSION['subAccess'] == '2,5')
          {
          ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php 
          }
          else if($_SESSION['subAccess'] == '3,4')
          {
          ?>
            <a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a> 
         <?php 
          }
          else if($_SESSION['subAccess'] == '3,5')
          {
          ?>
            <a class="collapse-item" href="rmMaster.php">RM Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php 
          }
          else if($_SESSION['subAccess'] == '4,5')
          {
          ?>
            <a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php 
          }
          else
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a> 
           
 

         <?php    
          }
          //sub Master End
          //echo "subAccess=>".$_SESSION['subAccess'];
         ?>
		</div>
        </div>
      </li>
	
	  <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#inquairy" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Report</span>        </a>
        <div id="inquairy" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <!--<h6 class="collapse-header">Custom Components:</h6>-->
        <!-- <a class="collapse-item" href="RM_report.php">RM Report</a>
        <a class="collapse-item" href="formula_report.php">Formula Report</a>-->
        <a class="collapse-item" href="stockReg.php">Stock Report</a>
			<a class="collapse-item" href="stockReg_batch.php">Stock Report - Batch / LOT</a>
      <a class="collapse-item" href="stockReg_r.php">Re-order Report</a>
      <a class="collapse-item" href="stockReg_ost.php">Out of Stock Report</a>  
      <a class="collapse-item" href="expiryReg.php">Expiry Report</a>     
      <a class="collapse-item" href="inoutReport.php">IN-OUT Report</a>      
      <a class="collapse-item" href="fastMovingItemRpt.php">Fast Moving Item Report</a>    
      <a class="collapse-item" href="nonMovingItemRpt.php">Non Moving Item Report</a> 
        </div>
        </div>
        </li>
	  
	  <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#inquairy2" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Report2</span>        </a>
        <div id="inquairy2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <!--<h6 class="collapse-header">Custom Components:</h6>-->
        <!-- <a class="collapse-item" href="RM_report.php">RM Report</a>
        <a class="collapse-item" href="formula_report.php">Formula Report</a>-->
        <a class="collapse-item" href="stockRegLoc.php">Stock - Location(RM)</a>
      <a class="collapse-item" href="stockRegLoc2.php">Stock - Location(FG)</a>
        </div>
        </div>
        </li>
       
      <?php 	
      }	
      else if($_SESSION['uAccess'] == "2,3,4,5")
      {
      ?> 
      <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#purchase" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-fw fa-cog"></i>
      <span>Stock Entry</span>        </a>
      <div id="purchase" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
      <!--<h6 class="collapse-header">Custom Components:</h6>-->
      <a class="collapse-item" href="inventoryEntry.php">Stock Entry</a>
      <a class="collapse-item" href="inventoryReg.php">Stock Register</a>
      <a class="collapse-item" href="inventoryReg2.php">Stock Register - Product</a>
      
      </div>
      </div>
      </li>
	 
	  <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#lockQty" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Lock Quantity</span>        </a>
        <div id="lockQty" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <!--<h6 class="collapse-header">Custom Components:</h6>-->
        <a class="collapse-item" href="lockQty_entry.php">Lock Qty Entry</a>
        <a class="collapse-item" href="lockQty_Reg.php">Lock Qty Register</a>
     	<a class="collapse-item" href="lockQty_Reg2.php">Lock Qty Reg - Product</a>
        </div>
        </div>
        </li> 
	
	  <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#inquairy" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Report</span>        </a>
        <div id="inquairy" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <!--<h6 class="collapse-header">Custom Components:</h6>-->
        <!-- <a class="collapse-item" href="RM_report.php">RM Report</a>
        <a class="collapse-item" href="formula_report.php">Formula Report</a>-->
        <a class="collapse-item" href="stockReg.php">Stock Report</a>
			<a class="collapse-item" href="stockReg_batch.php">Stock Report - Batch / LOT</a>
      <a class="collapse-item" href="stockReg_r.php">Re-order Report</a>
      <a class="collapse-item" href="stockReg_ost.php">Out of Stock Report</a>  
      <a class="collapse-item" href="expiryReg.php">Expiry Report</a>    
      <a class="collapse-item" href="inoutReport.php">IN-OUT Report</a>     
      <a class="collapse-item" href="fastMovingItemRpt.php">Fast Moving Item Report</a>    
      <a class="collapse-item" href="nonMovingItemRpt.php">Non Moving Item Report</a>  
        </div>
        </div>
        </li>
	  
	  <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#inquairy2" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Report2</span>        </a>
        <div id="inquairy2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <!--<h6 class="collapse-header">Custom Components:</h6>-->
        <!-- <a class="collapse-item" href="RM_report.php">RM Report</a>
        <a class="collapse-item" href="formula_report.php">Formula Report</a>-->
        <a class="collapse-item" href="stockRegLoc.php">Stock - Location(RM)</a>
      <a class="collapse-item" href="stockRegLoc2.php">Stock - Location(FG)</a>
        </div>
        </div>
        </li>
       
      <?php 	
      }
      else if($_SESSION['uAccess'] == "2,3,4")
      {
      ?>        
	 
      <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#purchase" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-fw fa-cog"></i>
      <span>Stock Entry</span>        </a>
      <div id="purchase" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
      <!--<h6 class="collapse-header">Custom Components:</h6>-->
      <a class="collapse-item" href="inventoryEntry.php">Stock Entry</a>
      <a class="collapse-item" href="inventoryReg.php">Stock Register</a>
      <a class="collapse-item" href="inventoryReg2.php">Stock Register - Product</a>
      
      </div>
      </div>
      </li>
	 
	  <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#lockQty" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Lock Quantity</span>        </a>
        <div id="lockQty" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <!--<h6 class="collapse-header">Custom Components:</h6>-->
        <a class="collapse-item" href="lockQty_entry.php">Lock Qty Entry</a>
        <a class="collapse-item" href="lockQty_Reg.php">Lock Qty Register</a>
     	<a class="collapse-item" href="lockQty_Reg2.php">Lock Qty Reg - Product</a>
        </div>
        </div>
        </li> 
	
	  <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#inquairy" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Report</span>        </a>
        <div id="inquairy" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <!--<h6 class="collapse-header">Custom Components:</h6>-->
        <!-- <a class="collapse-item" href="RM_report.php">RM Report</a>
        <a class="collapse-item" href="formula_report.php">Formula Report</a>-->
        <a class="collapse-item" href="stockReg.php">Stock Report</a>
			<a class="collapse-item" href="stockReg_batch.php">Stock Report - Batch / LOT</a>
      <a class="collapse-item" href="stockReg_r.php">Re-order Report</a>
      <a class="collapse-item" href="stockReg_ost.php">Out of Stock Report</a>  
      <a class="collapse-item" href="expiryReg.php">Expiry Report</a>   
      <a class="collapse-item" href="inoutReport.php">IN-OUT Report</a>     
      <a class="collapse-item" href="fastMovingItemRpt.php">Fast Moving Item Report</a>    
      <a class="collapse-item" href="nonMovingItemRpt.php">Non Moving Item Report</a>  
        </div>
        </div>
        </li>
       
      <?php 	
      }
      else if($_SESSION['uAccess'] == "2,3,5")
      {
      ?> 	 
      <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#purchase" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-fw fa-cog"></i>
      <span>Stock Entry</span>        </a>
      <div id="purchase" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
      <!--<h6 class="collapse-header">Custom Components:</h6>-->
      <a class="collapse-item" href="inventoryEntry.php">Stock Entry</a>
      <a class="collapse-item" href="inventoryReg.php">Stock Register</a>
      <a class="collapse-item" href="inventoryReg2.php">Stock Register - Product</a>
      
      </div>
      </div>
      </li>
	 
	  <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#lockQty" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Lock Quantity</span>        </a>
        <div id="lockQty" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <!--<h6 class="collapse-header">Custom Components:</h6>-->
        <a class="collapse-item" href="lockQty_entry.php">Lock Qty Entry</a>
        <a class="collapse-item" href="lockQty_Reg.php">Lock Qty Register</a>
     	<a class="collapse-item" href="lockQty_Reg2.php">Lock Qty Reg - Product</a>
        </div>
        </div>
        </li> 	  
	  
	  <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#inquairy2" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Report2</span>        </a>
        <div id="inquairy2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <!--<h6 class="collapse-header">Custom Components:</h6>-->
        <!-- <a class="collapse-item" href="RM_report.php">RM Report</a>
        <a class="collapse-item" href="formula_report.php">Formula Report</a>-->
        <a class="collapse-item" href="stockRegLoc.php">Stock - Location(RM)</a>
      <a class="collapse-item" href="stockRegLoc2.php">Stock - Location(FG)</a>
        </div>
        </div>
        </li>
       
      <?php 	
      }
      else if($_SESSION['uAccess'] == "3,4,5")
      {
      ?> 	 
	  <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#lockQty" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Lock Quantity</span>        </a>
        <div id="lockQty" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <!--<h6 class="collapse-header">Custom Components:</h6>-->
        <a class="collapse-item" href="lockQty_entry.php">Lock Qty Entry</a>
        <a class="collapse-item" href="lockQty_Reg.php">Lock Qty Register</a>
     	<a class="collapse-item" href="lockQty_Reg2.php">Lock Qty Reg - Product</a>        
        </div>
        </div>
        </li> 
	
	  <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#inquairy" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Report</span>        </a>
        <div id="inquairy" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <!--<h6 class="collapse-header">Custom Components:</h6>-->
        <!-- <a class="collapse-item" href="RM_report.php">RM Report</a>
        <a class="collapse-item" href="formula_report.php">Formula Report</a>-->
        <a class="collapse-item" href="stockReg.php">Stock Report</a>
			<a class="collapse-item" href="stockReg_batch.php">Stock Report - Batch / LOT</a>
      <a class="collapse-item" href="stockReg_r.php">Re-order Report</a>
      <a class="collapse-item" href="stockReg_ost.php">Out of Stock Report</a>  
      <a class="collapse-item" href="expiryReg.php">Expiry Report</a>     
      <a class="collapse-item" href="inoutReport.php">IN-OUT Report</a>      
      <a class="collapse-item" href="fastMovingItemRpt.php">Fast Moving Item Report</a>    
      <a class="collapse-item" href="nonMovingItemRpt.php">Non Moving Item Report</a>
        </div>
        </div>
        </li>
	  
	  <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#inquairy2" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Report2</span>        </a>
        <div id="inquairy2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <!--<h6 class="collapse-header">Custom Components:</h6>-->
        <!-- <a class="collapse-item" href="RM_report.php">RM Report</a>
        <a class="collapse-item" href="formula_report.php">Formula Report</a>-->
        <a class="collapse-item" href="stockRegLoc.php">Stock - Location(RM)</a>
      <a class="collapse-item" href="stockRegLoc2.php">Stock - Location(FG)</a>
        </div>
        </div>
        </li>
       
      <?php 	
      }
      else if($_SESSION['uAccess'] == "1,2")
      {
      ?>     
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Master</span>        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <!--<h6 class="collapse-header">Custom Components:</h6>-->
         <?php //Sub Master
          if($_SESSION['subAccess']=='1,2,3,4,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php
          }
          else if($_SESSION['subAccess'] == '1,2,3,4')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>  
         <?php
          }
          else if($_SESSION['subAccess'] == '1,2,3')
          {
           ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a> 
            
           <?php
		  }
		  else if($_SESSION['subAccess'] == '1,2,4')
		  {
		   ?> 
           <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>  
         <?php
          }
          else if($_SESSION['subAccess'] == '1,2,4,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php  
          }
          else if($_SESSION['subAccess'] == '1,2,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
            
           <?php
		  }
		  else if($_SESSION['subAccess'] == '2,3,4')
		  {
		   ?> 
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a> 
           
           <?php
		  	}
		   else if($_SESSION['subAccess'] == '2,3,5')
		   {
		   ?> 
           
           <a class="collapse-item" href="locationMaster.php">Location Master</a>
           <a class="collapse-item" href="rmMaster.php">RM Master</a>
           <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
           
           <?php
		   }
		   else if($_SESSION['subAccess'] == '2,4,5')
		   {
		   ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
           
         <?php
          }
          else if($_SESSION['subAccess'] == '1,3,4,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php 
          }
          else if($_SESSION['subAccess'] == '1,3,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a> 
            
          <?php
		  }
		  else if($_SESSION['subAccess'] == '1,3,4')
		  {
		  ?>  
           <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a> 
          
          <?php
		  }
		  else if($_SESSION['subAccess'] == '1,4,5')
		  {
		  ?>
         
         <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>
          <?php 
          }
          else if($_SESSION['subAccess'] == '1')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
         <?php
          }
          else if($_SESSION['subAccess'] == '2')
          {
          ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
         <?php 
          }
          else if($_SESSION['subAccess'] == '3')
          {
          ?>
            <a class="collapse-item" href="rmMaster.php">RM Master</a> 
         <?php
          }
          else if($_SESSION['subAccess'] == '4')
          {
          ?>
            <a class="collapse-item" href="fgMaster.php">FG Master</a>
         <?php
          }
          else if($_SESSION['subAccess'] == '5')
          {
          ?>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php  
          }
          else if($_SESSION['subAccess'] == '1,2')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a> 
          <?php  
          }
          else if($_SESSION['subAccess'] == '1,3')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
         <?php 
          }
          else if($_SESSION['subAccess'] == '1,4')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
         <?php
          }
          else if($_SESSION['subAccess'] == '1,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php  
          }
          else if($_SESSION['subAccess'] == '2,3')
          {
          ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>  
         <?php  
          }
          else if($_SESSION['subAccess'] == '2,4')
          {
          ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a> 
         <?php   
          }
          else if($_SESSION['subAccess'] == '2,5')
          {
          ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php 
          }
          else if($_SESSION['subAccess'] == '3,4')
          {
          ?>
            <a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a> 
         <?php 
          }
          else if($_SESSION['subAccess'] == '3,5')
          {
          ?>
            <a class="collapse-item" href="rmMaster.php">RM Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php 
          }
          else if($_SESSION['subAccess'] == '4,5')
          {
          ?>
            <a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php 
          }
          else
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a> 
           
 

         <?php    
          }
          //sub Master End
          //echo "subAccess=>".$_SESSION['subAccess'];
         ?>
		</div>
        </div>
      </li>
	 
      <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#purchase" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-fw fa-cog"></i>
      <span>Stock Entry</span>        </a>
      <div id="purchase" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
      <!--<h6 class="collapse-header">Custom Components:</h6>-->
      <a class="collapse-item" href="inventoryEntry.php">Stock Entry</a>
      <a class="collapse-item" href="inventoryReg.php">Stock Register</a>
      <a class="collapse-item" href="inventoryReg2.php">Stock Register - Product</a>
      
      </div>
      </div>
      </li>       
      <?php 	
      }
      else if($_SESSION['uAccess'] == "1,3")
      {
      ?>     
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Master</span>        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <!--<h6 class="collapse-header">Custom Components:</h6>-->
         <?php //Sub Master
          if($_SESSION['subAccess']=='1,2,3,4,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php
          }
          else if($_SESSION['subAccess'] == '1,2,3,4')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>  
         <?php
          }
          else if($_SESSION['subAccess'] == '1,2,3')
          {
           ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a> 
            
           <?php
		  }
		  else if($_SESSION['subAccess'] == '1,2,4')
		  {
		   ?> 
           <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>  
         <?php
          }
          else if($_SESSION['subAccess'] == '1,2,4,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php  
          }
          else if($_SESSION['subAccess'] == '1,2,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
            
           <?php
		  }
		  else if($_SESSION['subAccess'] == '2,3,4')
		  {
		   ?> 
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a> 
           
           <?php
		  	}
		   else if($_SESSION['subAccess'] == '2,3,5')
		   {
		   ?> 
           
           <a class="collapse-item" href="locationMaster.php">Location Master</a>
           <a class="collapse-item" href="rmMaster.php">RM Master</a>
           <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
           
           <?php
		   }
		   else if($_SESSION['subAccess'] == '2,4,5')
		   {
		   ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
           
         <?php
          }
          else if($_SESSION['subAccess'] == '1,3,4,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php 
          }
          else if($_SESSION['subAccess'] == '1,3,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a> 
            
          <?php
		  }
		  else if($_SESSION['subAccess'] == '1,3,4')
		  {
		  ?>  
           <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a> 
          
          <?php
		  }
		  else if($_SESSION['subAccess'] == '1,4,5')
		  {
		  ?>
         
         <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>
          <?php 
          }
          else if($_SESSION['subAccess'] == '1')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
         <?php
          }
          else if($_SESSION['subAccess'] == '2')
          {
          ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
         <?php 
          }
          else if($_SESSION['subAccess'] == '3')
          {
          ?>
            <a class="collapse-item" href="rmMaster.php">RM Master</a> 
         <?php
          }
          else if($_SESSION['subAccess'] == '4')
          {
          ?>
            <a class="collapse-item" href="fgMaster.php">FG Master</a>
         <?php
          }
          else if($_SESSION['subAccess'] == '5')
          {
          ?>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php  
          }
          else if($_SESSION['subAccess'] == '1,2')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a> 
          <?php  
          }
          else if($_SESSION['subAccess'] == '1,3')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
         <?php 
          }
          else if($_SESSION['subAccess'] == '1,4')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
         <?php
          }
          else if($_SESSION['subAccess'] == '1,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php  
          }
          else if($_SESSION['subAccess'] == '2,3')
          {
          ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>  
         <?php  
          }
          else if($_SESSION['subAccess'] == '2,4')
          {
          ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a> 
         <?php   
          }
          else if($_SESSION['subAccess'] == '2,5')
          {
          ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php 
          }
          else if($_SESSION['subAccess'] == '3,4')
          {
          ?>
            <a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a> 
         <?php 
          }
          else if($_SESSION['subAccess'] == '3,5')
          {
          ?>
            <a class="collapse-item" href="rmMaster.php">RM Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php 
          }
          else if($_SESSION['subAccess'] == '4,5')
          {
          ?>
            <a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php 
          }
          else
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a> 
           
 

         <?php    
          }
          //sub Master End
          //echo "subAccess=>".$_SESSION['subAccess'];
         ?>
		</div>
        </div>
      </li>      
	 
	  <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#lockQty" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Lock Quantity</span>        </a>
        <div id="lockQty" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <!--<h6 class="collapse-header">Custom Components:</h6>-->
        <a class="collapse-item" href="lockQty_entry.php">Lock Qty Entry</a>
        <a class="collapse-item" href="lockQty_Reg.php">Lock Qty Register</a>
     	<a class="collapse-item" href="lockQty_Reg2.php">Lock Qty Reg - Product</a>
        </div>
        </div>
        </li> 
       
      <?php 	
      }
      else if($_SESSION['uAccess'] == "1,4")
      {
      ?>     
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Master</span>        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <!--<h6 class="collapse-header">Custom Components:</h6>-->
         <?php //Sub Master
          if($_SESSION['subAccess']=='1,2,3,4,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php
          }
          else if($_SESSION['subAccess'] == '1,2,3,4')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>  
         <?php
          }
          else if($_SESSION['subAccess'] == '1,2,3')
          {
           ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a> 
            
           <?php
		  }
		  else if($_SESSION['subAccess'] == '1,2,4')
		  {
		   ?> 
           <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>  
         <?php
          }
          else if($_SESSION['subAccess'] == '1,2,4,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php  
          }
          else if($_SESSION['subAccess'] == '1,2,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
            
           <?php
		  }
		  else if($_SESSION['subAccess'] == '2,3,4')
		  {
		   ?> 
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a> 
           
           <?php
		  	}
		   else if($_SESSION['subAccess'] == '2,3,5')
		   {
		   ?> 
           
           <a class="collapse-item" href="locationMaster.php">Location Master</a>
           <a class="collapse-item" href="rmMaster.php">RM Master</a>
           <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
           
           <?php
		   }
		   else if($_SESSION['subAccess'] == '2,4,5')
		   {
		   ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
           
         <?php
          }
          else if($_SESSION['subAccess'] == '1,3,4,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php 
          }
          else if($_SESSION['subAccess'] == '1,3,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a> 
            
          <?php
		  }
		  else if($_SESSION['subAccess'] == '1,3,4')
		  {
		  ?>  
           <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a> 
          
          <?php
		  }
		  else if($_SESSION['subAccess'] == '1,4,5')
		  {
		  ?>
         
         <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>
          <?php 
          }
          else if($_SESSION['subAccess'] == '1')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
         <?php
          }
          else if($_SESSION['subAccess'] == '2')
          {
          ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
         <?php 
          }
          else if($_SESSION['subAccess'] == '3')
          {
          ?>
            <a class="collapse-item" href="rmMaster.php">RM Master</a> 
         <?php
          }
          else if($_SESSION['subAccess'] == '4')
          {
          ?>
            <a class="collapse-item" href="fgMaster.php">FG Master</a>
         <?php
          }
          else if($_SESSION['subAccess'] == '5')
          {
          ?>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php  
          }
          else if($_SESSION['subAccess'] == '1,2')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a> 
          <?php  
          }
          else if($_SESSION['subAccess'] == '1,3')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
         <?php 
          }
          else if($_SESSION['subAccess'] == '1,4')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
         <?php
          }
          else if($_SESSION['subAccess'] == '1,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php  
          }
          else if($_SESSION['subAccess'] == '2,3')
          {
          ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>  
         <?php  
          }
          else if($_SESSION['subAccess'] == '2,4')
          {
          ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a> 
         <?php   
          }
          else if($_SESSION['subAccess'] == '2,5')
          {
          ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php 
          }
          else if($_SESSION['subAccess'] == '3,4')
          {
          ?>
            <a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a> 
         <?php 
          }
          else if($_SESSION['subAccess'] == '3,5')
          {
          ?>
            <a class="collapse-item" href="rmMaster.php">RM Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php 
          }
          else if($_SESSION['subAccess'] == '4,5')
          {
          ?>
            <a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php 
          }
          else
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a> 
           
 

         <?php    
          }
          //sub Master End
          //echo "subAccess=>".$_SESSION['subAccess'];
         ?>
		</div>
        </div>
      </li>
	
	  <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#inquairy" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Report</span>        </a>
        <div id="inquairy" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <!--<h6 class="collapse-header">Custom Components:</h6>-->
        <!-- <a class="collapse-item" href="RM_report.php">RM Report</a>
        <a class="collapse-item" href="formula_report.php">Formula Report</a>-->
        <a class="collapse-item" href="stockReg.php">Stock Report</a>
			<a class="collapse-item" href="stockReg_batch.php">Stock Report - Batch / LOT</a>
      <a class="collapse-item" href="stockReg_r.php">Re-order Report</a>
      <a class="collapse-item" href="stockReg_ost.php">Out of Stock Report</a>  
      <a class="collapse-item" href="expiryReg.php">Expiry Report</a>     
      <a class="collapse-item" href="inoutReport.php">IN-OUT Report</a>     
      <a class="collapse-item" href="fastMovingItemRpt.php">Fast Moving Item Report</a>    
      <a class="collapse-item" href="nonMovingItemRpt.php">Non Moving Item Report</a> 
        </div>
        </div>
        </li>
      <?php 	
      }
      else if($_SESSION['uAccess'] == "1,5")
      {
      ?>     
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Master</span>        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <!--<h6 class="collapse-header">Custom Components:</h6>-->
         <?php //Sub Master
          if($_SESSION['subAccess']=='1,2,3,4,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php
          }
          else if($_SESSION['subAccess'] == '1,2,3,4')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>  
         <?php
          }
          else if($_SESSION['subAccess'] == '1,2,3')
          {
           ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a> 
            
           <?php
		  }
		  else if($_SESSION['subAccess'] == '1,2,4')
		  {
		   ?> 
           <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>  
         <?php
          }
          else if($_SESSION['subAccess'] == '1,2,4,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php  
          }
          else if($_SESSION['subAccess'] == '1,2,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
            
           <?php
		  }
		  else if($_SESSION['subAccess'] == '2,3,4')
		  {
		   ?> 
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a> 
           
           <?php
		  	}
		   else if($_SESSION['subAccess'] == '2,3,5')
		   {
		   ?> 
           
           <a class="collapse-item" href="locationMaster.php">Location Master</a>
           <a class="collapse-item" href="rmMaster.php">RM Master</a>
           <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
           
           <?php
		   }
		   else if($_SESSION['subAccess'] == '2,4,5')
		   {
		   ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
           
         <?php
          }
          else if($_SESSION['subAccess'] == '1,3,4,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php 
          }
          else if($_SESSION['subAccess'] == '1,3,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a> 
            
          <?php
		  }
		  else if($_SESSION['subAccess'] == '1,3,4')
		  {
		  ?>  
           <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a> 
          
          <?php
		  }
		  else if($_SESSION['subAccess'] == '1,4,5')
		  {
		  ?>
         
         <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>
          <?php 
          }
          else if($_SESSION['subAccess'] == '1')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
         <?php
          }
          else if($_SESSION['subAccess'] == '2')
          {
          ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
         <?php 
          }
          else if($_SESSION['subAccess'] == '3')
          {
          ?>
            <a class="collapse-item" href="rmMaster.php">RM Master</a> 
         <?php
          }
          else if($_SESSION['subAccess'] == '4')
          {
          ?>
            <a class="collapse-item" href="fgMaster.php">FG Master</a>
         <?php
          }
          else if($_SESSION['subAccess'] == '5')
          {
          ?>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php  
          }
          else if($_SESSION['subAccess'] == '1,2')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a> 
          <?php  
          }
          else if($_SESSION['subAccess'] == '1,3')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
         <?php 
          }
          else if($_SESSION['subAccess'] == '1,4')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
         <?php
          }
          else if($_SESSION['subAccess'] == '1,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php  
          }
          else if($_SESSION['subAccess'] == '2,3')
          {
          ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>  
         <?php  
          }
          else if($_SESSION['subAccess'] == '2,4')
          {
          ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a> 
         <?php   
          }
          else if($_SESSION['subAccess'] == '2,5')
          {
          ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php 
          }
          else if($_SESSION['subAccess'] == '3,4')
          {
          ?>
            <a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a> 
         <?php 
          }
          else if($_SESSION['subAccess'] == '3,5')
          {
          ?>
            <a class="collapse-item" href="rmMaster.php">RM Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php 
          }
          else if($_SESSION['subAccess'] == '4,5')
          {
          ?>
            <a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php 
          }
          else
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a> 
           
 

         <?php    
          }
          //sub Master End
          //echo "subAccess=>".$_SESSION['subAccess'];
         ?>
		</div>
        </div>
      </li>
	  
	  <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#inquairy2" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Report2</span>        </a>
        <div id="inquairy2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <!--<h6 class="collapse-header">Custom Components:</h6>-->
        <!-- <a class="collapse-item" href="RM_report.php">RM Report</a>
        <a class="collapse-item" href="formula_report.php">Formula Report</a>-->
        <a class="collapse-item" href="stockRegLoc.php">Stock - Location(RM)</a>
      <a class="collapse-item" href="stockRegLoc2.php">Stock - Location(FG)</a>
        </div>
        </div>
        </li>
       
      <?php 	
      }
      else if($_SESSION['uAccess'] == "2,3")
      {
      ?>
      <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#purchase" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-fw fa-cog"></i>
      <span>Stock Entry</span>        </a>
      <div id="purchase" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
      <!--<h6 class="collapse-header">Custom Components:</h6>-->
      <a class="collapse-item" href="inventoryEntry.php">Stock Entry</a>
      <a class="collapse-item" href="inventoryReg.php">Stock Register</a>
      <a class="collapse-item" href="inventoryReg2.php">Stock Register - Product</a>
      
      </div>
      </div>
      </li>
	 
	  <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#lockQty" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Lock Quantity</span>        </a>
        <div id="lockQty" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <!--<h6 class="collapse-header">Custom Components:</h6>-->
        <a class="collapse-item" href="lockQty_entry.php">Lock Qty Entry</a>
        <a class="collapse-item" href="lockQty_Reg.php">Lock Qty Register</a>
     	<a class="collapse-item" href="lockQty_Reg2.php">Lock Qty Reg - Product</a>
        </div>
        </div>
        </li> 
       
      <?php 	
      }
      else if($_SESSION['uAccess'] == "2,4")
      {
      ?> 
      <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#purchase" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-fw fa-cog"></i>
      <span>Stock Entry</span>        </a>
      <div id="purchase" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
      <!--<h6 class="collapse-header">Custom Components:</h6>-->
      <a class="collapse-item" href="inventoryEntry.php">Stock Entry</a>
      <a class="collapse-item" href="inventoryReg.php">Stock Register</a>
      <a class="collapse-item" href="inventoryReg2.php">Stock Register - Product</a>
      
      </div>
      </div>
      </li>	   
	
	  <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#inquairy" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Report</span>        </a>
        <div id="inquairy" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <!--<h6 class="collapse-header">Custom Components:</h6>-->
        <!-- <a class="collapse-item" href="RM_report.php">RM Report</a>
        <a class="collapse-item" href="formula_report.php">Formula Report</a>-->
        <a class="collapse-item" href="stockReg.php">Stock Report</a>
			<a class="collapse-item" href="stockReg_batch.php">Stock Report - Batch / LOT</a>
      <a class="collapse-item" href="stockReg_r.php">Re-order Report</a>
      <a class="collapse-item" href="stockReg_ost.php">Out of Stock Report</a>  
      <a class="collapse-item" href="expiryReg.php">Expiry Report</a>   
      <a class="collapse-item" href="inoutReport.php">IN-OUT Report</a>      
      <a class="collapse-item" href="fastMovingItemRpt.php">Fast Moving Item Report</a>    
      <a class="collapse-item" href="nonMovingItemRpt.php">Non Moving Item Report</a> 
        </div>
        </div>
        </li>  
       
      <?php 	
      }
      else if($_SESSION['uAccess'] == "2,5")
      {
      ?>  
      <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#purchase" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-fw fa-cog"></i>
      <span>Stock Entry</span>        </a>
      <div id="purchase" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
      <!--<h6 class="collapse-header">Custom Components:</h6>-->
      <a class="collapse-item" href="inventoryEntry.php">Stock Entry</a>
      <a class="collapse-item" href="inventoryReg.php">Stock Register</a>
      <a class="collapse-item" href="inventoryReg2.php">Stock Register - Product</a>
      
      </div>
      </div>
      </li>
	  
	  <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#inquairy2" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Report2</span>        </a>
        <div id="inquairy2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <!--<h6 class="collapse-header">Custom Components:</h6>-->
        <!-- <a class="collapse-item" href="RM_report.php">RM Report</a>
        <a class="collapse-item" href="formula_report.php">Formula Report</a>-->
        <a class="collapse-item" href="stockRegLoc.php">Stock - Location(RM)</a>
      <a class="collapse-item" href="stockRegLoc2.php">Stock - Location(FG)</a>
        </div>
        </div>
        </li>
       
      <?php 	
      }
      else if($_SESSION['uAccess'] == "3,4")
      {
      ?> 
	  <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#lockQty" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Lock Quantity</span>        </a>
        <div id="lockQty" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <!--<h6 class="collapse-header">Custom Components:</h6>-->
        <a class="collapse-item" href="lockQty_entry.php">Lock Qty Entry</a>
        <a class="collapse-item" href="lockQty_Reg.php">Lock Qty Register</a>
     	<a class="collapse-item" href="lockQty_Reg2.php">Lock Qty Reg - Product</a>
        </div>
        </div>
        </li> 
	
	  <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#inquairy" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Report</span>        </a>
        <div id="inquairy" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <!--<h6 class="collapse-header">Custom Components:</h6>-->
        <!-- <a class="collapse-item" href="RM_report.php">RM Report</a>
        <a class="collapse-item" href="formula_report.php">Formula Report</a>-->
        <a class="collapse-item" href="stockReg.php">Stock Report</a>
			<a class="collapse-item" href="stockReg_batch.php">Stock Report - Batch / LOT</a>
      <a class="collapse-item" href="stockReg_r.php">Re-order Report</a>
      <a class="collapse-item" href="stockReg_ost.php">Out of Stock Report</a>  
      <a class="collapse-item" href="expiryReg.php">Expiry Report</a>   
      <a class="collapse-item" href="inoutReport.php">IN-OUT Report</a>     
      <a class="collapse-item" href="fastMovingItemRpt.php">Fast Moving Item Report</a>    
      <a class="collapse-item" href="nonMovingItemRpt.php">Non Moving Item Report</a>  
        </div>
        </div>
        </li>
      <?php 	
      }
      else if($_SESSION['uAccess'] == "3,5")
      {
      ?> 
	  <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#lockQty" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Lock Quantity</span>        </a>
        <div id="lockQty" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <!--<h6 class="collapse-header">Custom Components:</h6>-->
        <a class="collapse-item" href="lockQty_entry.php">Lock Qty Entry</a>
        <a class="collapse-item" href="lockQty_Reg.php">Lock Qty Register</a>
     	<a class="collapse-item" href="lockQty_Reg2.php">Lock Qty Reg - Product</a>
        </div>
        </div>
        </li> 
	  
	  <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#inquairy2" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Report2</span>        </a>
        <div id="inquairy2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <!--<h6 class="collapse-header">Custom Components:</h6>-->
        <!-- <a class="collapse-item" href="RM_report.php">RM Report</a>
        <a class="collapse-item" href="formula_report.php">Formula Report</a>-->
        <a class="collapse-item" href="stockRegLoc.php">Stock - Location(RM)</a>
      <a class="collapse-item" href="stockRegLoc2.php">Stock - Location(FG)</a>
        </div>
        </div>
        </li>
       
      <?php 	
      }
      else if($_SESSION['uAccess'] == "4,5")
      {
      ?>	
	  <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#inquairy" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Report</span>        </a>
        <div id="inquairy" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <!--<h6 class="collapse-header">Custom Components:</h6>-->
        <!-- <a class="collapse-item" href="RM_report.php">RM Report</a>
        <a class="collapse-item" href="formula_report.php">Formula Report</a>-->
        <a class="collapse-item" href="stockReg.php">Stock Report</a>
			<a class="collapse-item" href="stockReg_batch.php">Stock Report - Batch / LOT</a>
      <a class="collapse-item" href="stockReg_r.php">Re-order Report</a>
      <a class="collapse-item" href="stockReg_ost.php">Out of Stock Report</a>  
      <a class="collapse-item" href="expiryReg.php">Expiry Report</a>   
      <a class="collapse-item" href="inoutReport.php">IN-OUT Report</a>     
      <a class="collapse-item" href="fastMovingItemRpt.php">Fast Moving Item Report</a>    
      <a class="collapse-item" href="nonMovingItemRpt.php">Non Moving Item Report</a>   
        </div>
        </div>
        </li>
	  
	  <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#inquairy2" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Report2</span>        </a>
        <div id="inquairy2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <!--<h6 class="collapse-header">Custom Components:</h6>-->
        <!-- <a class="collapse-item" href="RM_report.php">RM Report</a>
        <a class="collapse-item" href="formula_report.php">Formula Report</a>-->
        <a class="collapse-item" href="stockRegLoc.php">Stock - Location(RM)</a>
      <a class="collapse-item" href="stockRegLoc2.php">Stock - Location(FG)</a>
        </div>
        </div>
        </li>
       
      <?php 	
      }
      else if($_SESSION['uAccess'] == "1")
      {
      ?>     
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Master</span>        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <!--<h6 class="collapse-header">Custom Components:</h6>-->
         <?php //Sub Master
          if($_SESSION['subAccess']=='1,2,3,4,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php
          }
          else if($_SESSION['subAccess'] == '1,2,3,4')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>  
         <?php
          }
          else if($_SESSION['subAccess'] == '1,2,3')
          {
           ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a> 
            
           <?php
		  }
		  else if($_SESSION['subAccess'] == '1,2,4')
		  {
		   ?> 
           <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>  
         <?php
          }
          else if($_SESSION['subAccess'] == '1,2,4,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php  
          }
          else if($_SESSION['subAccess'] == '1,2,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
            
           <?php
		  }
		  else if($_SESSION['subAccess'] == '2,3,4')
		  {
		   ?> 
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a> 
           
           <?php
		  	}
		   else if($_SESSION['subAccess'] == '2,3,5')
		   {
		   ?> 
           
           <a class="collapse-item" href="locationMaster.php">Location Master</a>
           <a class="collapse-item" href="rmMaster.php">RM Master</a>
           <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
           
           <?php
		   }
		   else if($_SESSION['subAccess'] == '2,4,5')
		   {
		   ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
           
         <?php
          }
          else if($_SESSION['subAccess'] == '1,3,4,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php 
          }
          else if($_SESSION['subAccess'] == '1,3,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a> 
            
          <?php
		  }
		  else if($_SESSION['subAccess'] == '1,3,4')
		  {
		  ?>  
           <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a> 
          
          <?php
		  }
		  else if($_SESSION['subAccess'] == '1,4,5')
		  {
		  ?>
         
         <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>
          <?php 
          }
          else if($_SESSION['subAccess'] == '1')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
         <?php
          }
          else if($_SESSION['subAccess'] == '2')
          {
          ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
         <?php 
          }
          else if($_SESSION['subAccess'] == '3')
          {
          ?>
            <a class="collapse-item" href="rmMaster.php">RM Master</a> 
         <?php
          }
          else if($_SESSION['subAccess'] == '4')
          {
          ?>
            <a class="collapse-item" href="fgMaster.php">FG Master</a>
         <?php
          }
          else if($_SESSION['subAccess'] == '5')
          {
          ?>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php  
          }
          else if($_SESSION['subAccess'] == '1,2')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a> 
          <?php  
          }
          else if($_SESSION['subAccess'] == '1,3')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
         <?php 
          }
          else if($_SESSION['subAccess'] == '1,4')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
         <?php
          }
          else if($_SESSION['subAccess'] == '1,5')
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php  
          }
          else if($_SESSION['subAccess'] == '2,3')
          {
          ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>  
         <?php  
          }
          else if($_SESSION['subAccess'] == '2,4')
          {
          ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a> 
         <?php   
          }
          else if($_SESSION['subAccess'] == '2,5')
          {
          ?>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php 
          }
          else if($_SESSION['subAccess'] == '3,4')
          {
          ?>
            <a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a> 
         <?php 
          }
          else if($_SESSION['subAccess'] == '3,5')
          {
          ?>
            <a class="collapse-item" href="rmMaster.php">RM Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php 
          }
          else if($_SESSION['subAccess'] == '4,5')
          {
          ?>
            <a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a>  
         <?php 
          }
          else
          {
          ?>
            <a class="collapse-item" href="companyMaster.php">Company Master</a>
            <a class="collapse-item" href="locationMaster.php">Location Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="new_entryType.php">Entry Type Master</a> 
           
 

         <?php    
          }
          //sub Master End
          //echo "subAccess=>".$_SESSION['subAccess'];
         ?>
		</div>
        </div>
      </li>
      <?php 	
      }
      else if($_SESSION['uAccess'] == "2")
      {
      ?> 	 
      <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#purchase" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-fw fa-cog"></i>
      <span>Stock Entry</span>        </a>
      <div id="purchase" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
      <!--<h6 class="collapse-header">Custom Components:</h6>-->
      <a class="collapse-item" href="inventoryEntry.php">Stock Entry</a>
      <a class="collapse-item" href="inventoryReg.php">Stock Register</a>
      <a class="collapse-item" href="inventoryReg2.php">Stock Register - Product</a>
      
      </div>
      </div>
      </li>
       
      <?php 	
      }
      else if($_SESSION['uAccess'] == "3")
      {
      ?>
	  <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#lockQty" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Lock Quantity</span>        </a>
        <div id="lockQty" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <!--<h6 class="collapse-header">Custom Components:</h6>-->
        <a class="collapse-item" href="lockQty_entry.php">Lock Qty Entry</a>
        <a class="collapse-item" href="lockQty_Reg.php">Lock Qty Register</a>
     	<a class="collapse-item" href="lockQty_Reg2.php">Lock Qty Reg - Product</a>
        </div>
        </div>
        </li> 
      <?php 	
      }
      else if($_SESSION['uAccess'] == "4")
      {
      ?>
	  <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#inquairy" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Report</span>        </a>
        <div id="inquairy" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <!--<h6 class="collapse-header">Custom Components:</h6>-->
        <!-- <a class="collapse-item" href="RM_report.php">RM Report</a>
        <a class="collapse-item" href="formula_report.php">Formula Report</a>-->
        <a class="collapse-item" href="stockReg.php">Stock Report</a>
			<a class="collapse-item" href="stockReg_batch.php">Stock Report - Batch / LOT</a>
      <a class="collapse-item" href="stockReg_r.php">Re-order Report</a>
      <a class="collapse-item" href="stockReg_ost.php">Out of Stock Report</a>  
      <a class="collapse-item" href="expiryReg.php">Expiry Report</a>  
      <a class="collapse-item" href="inoutReport.php">IN-OUT Report</a>     
      <a class="collapse-item" href="fastMovingItemRpt.php">Fast Moving Item Report</a>    
      <a class="collapse-item" href="nonMovingItemRpt.php">Non Moving Item Report</a>    
        </div>
        </div>
        </li> 
      <?php 	
      }
      else if($_SESSION['uAccess'] == "5")
      {
      ?> 	  
	  <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#inquairy2" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Report2</span>        </a>
        <div id="inquairy2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <!--<h6 class="collapse-header">Custom Components:</h6>-->
        <!-- <a class="collapse-item" href="RM_report.php">RM Report</a>
        <a class="collapse-item" href="formula_report.php">Formula Report</a>-->
        <a class="collapse-item" href="stockRegLoc.php">Stock - Location(RM)</a>
      <a class="collapse-item" href="stockRegLoc2.php">Stock - Location(FG)</a>
        </div>
        </div>
        </li>
       
      <?php 	
      }
	   else
	   {
	   ?>   
		<li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseone" aria-expanded="true" aria-controls="collapseone">
        <i class="fas fa-fw fa-cog"></i>
        <span>User</span>        </a>
        <div id="collapseone" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <!--<h6 class="collapse-header">Custom Components:</h6>-->
        <a class="collapse-item" href="user_creation.php">User Creation</a>
        <!--<a class="collapse-item" href="user_master.php">User Master</a>-->
        </div>
        </div>
        </li>
	
        <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Master</span>        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <!--<h6 class="collapse-header">Custom Components:</h6>-->
        <a class="collapse-item" href="companyMaster.php">Company Master</a>
        <a class="collapse-item" href="locationMaster.php">Location Master</a> 
        <a class="collapse-item" href="new_cat.php">New Category</a>
        <a class="collapse-item" href="rmMaster.php">RM Master</a>
        <a class="collapse-item" href="fgMaster.php">FG Master</a>
        <a class="collapse-item" href="new_entryType.php">Entry Type</a>
        <a class="collapse-item" href="UOMMst.php">UOM Master</a>
        <a class="collapse-item" href="rackMaster.php">Rack Master</a>
        <!--<a class="collapse-item" href="salesMan_entry.php">Salesman Master</a>-->
        <a class="collapse-item" href="rmStockUpload.php">Upload Stock -RM</a>
        <a class="collapse-item" href="fgStockUpload.php">Upload Stock -FG</a>
        </div>
        </div>
        </li>	  	
	 
        <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#purchase" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Stock Entry</span>        </a>
        <div id="purchase" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <!--<h6 class="collapse-header">Custom Components:</h6>-->
        <a class="collapse-item" href="inventoryEntry.php">Stock Entry</a>
        <a class="collapse-item" href="inventoryReg.php">Stock Register</a>
      <a class="collapse-item" href="inventoryReg2.php">Stock Register - Product</a>
        
        </div>
        </div>
        </li>
	 
	 	<li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#lockQty" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Lock Quantity</span>        </a>
        <div id="lockQty" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <!--<h6 class="collapse-header">Custom Components:</h6>-->
        <a class="collapse-item" href="lockQty_entry.php">Lock Qty Entry</a>
        <a class="collapse-item" href="lockQty_Reg.php">Lock Qty Register</a>
     	<a class="collapse-item" href="lockQty_Reg2.php">Lock Qty Reg - Product</a>
        </div>
        </div>
        </li>
	 
        <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#inquairy" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Report</span>        </a>
        <div id="inquairy" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <!--<h6 class="collapse-header">Custom Components:</h6>-->
        <!-- <a class="collapse-item" href="RM_report.php">RM Report</a>
        <a class="collapse-item" href="formula_report.php">Formula Report</a>-->
        <a class="collapse-item" href="stockReg.php">Stock Report</a>
        <a class="collapse-item" href="stockReg_batch.php">Stock Report - Batch / LOT</a>
      <a class="collapse-item" href="stockReg_r.php">Re-order Report</a>
      <a class="collapse-item" href="stockReg_ost.php">Out of Stock Report</a>  
      <a class="collapse-item" href="expiryReg.php">Expiry Report</a>  
      <a class="collapse-item" href="inoutReport.php">IN-OUT Report</a>      
      <a class="collapse-item" href="fastMovingItemRpt.php">Fast Moving Item Report</a>    
      <a class="collapse-item" href="nonMovingItemRpt.php">Non Moving Item Report</a>    
        </div>
        </div>
        </li>
	 
	 	<li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#inquairy2" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Report2</span>        </a>
        <div id="inquairy2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <!--<h6 class="collapse-header">Custom Components:</h6>-->
        <!-- <a class="collapse-item" href="RM_report.php">RM Report</a>
        <a class="collapse-item" href="formula_report.php">Formula Report</a>-->
        <a class="collapse-item" href="stockRegLoc.php">Stock - Location(RM)</a>
      <a class="collapse-item" href="stockRegLoc2.php">Stock - Location(FG)</a>
        </div>
        </div>
        </li>
       <?php
	   }
       ?>
       
	  
      
      

      <!-- Nav Item - Utilities Collapse Menu -->
      

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      

      <!-- Nav Item - Pages Collapse Menu -->
      

      <!-- Nav Item - Charts -->
      

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="logout.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Log Out</span></a>      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>