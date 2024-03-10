 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="admin.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <!--<i class="fas fa-laugh-wink"></i>-->
        </div>
        <div class="sidebar-brand-text mx-3">RITVER <!--<sup>2</sup>--></div>
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
	  if($_SESSION['uAccess'] == "1,2,3" && $_SESSION['uRole'] == "User")
       {
      ?>      
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Master</span>        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <!--<h6 class="collapse-header">Custom Components:</h6>-->
            <a class="collapse-item" href="supplierMaster.php">Supplier Master</a>
            <a class="collapse-item" href="customerMaster.php">Customer Master</a>
			<a class="collapse-item" href="rmMaster.php">RM Master</a>
			<a class="collapse-item" href="fgMaster.php">FG Master</a>
            <a class="collapse-item" href="drumMaster.php">DRUM Master</a>  
			      </div>
        </div>
      </li>
      <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#purchase" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-fw fa-cog"></i>
      <span>Output Formula</span>        </a>
      <div id="purchase" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
      <!--<h6 class="collapse-header">Custom Components:</h6>-->
      <a class="collapse-item" href="outputFEntry.php">Output Formula Entry</a>
      <a class="collapse-item" href="outputFReg.php">Output Formula Register</a>
      
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
      <a class="collapse-item" href="RM_report.php">RM Report</a>
      <a class="collapse-item" href="drum_report.php">Drum Report</a>
      <a class="collapse-item" href="formula_report.php">FG Report 1</a>  
      <a class="collapse-item" href="FG_Report2.php">FG Report 2</a>  
      </div>
      </div>
      </li>
      <?php
       }
       else if($_SESSION['uAccess'] == "1" && $_SESSION['uRole'] == "User")
       {
		?>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Master</span>        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <!--<h6 class="collapse-header">Custom Components:</h6>-->
        <a class="collapse-item" href="supplierMaster.php">Supplier Master</a>
        <a class="collapse-item" href="customerMaster.php">Customer Master</a>
        <a class="collapse-item" href="rmMaster.php">RM Master</a>
        <a class="collapse-item" href="fgMaster.php">FG Master</a>
        <a class="collapse-item" href="drumMaster.php">DRUM Master</a>  
        </div>
        </div>
        </li>
      <?php
       }
	   else if($_SESSION['uAccess'] == "2" && $_SESSION['uRole'] == "User")
	   {
       ?>
       <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#purchase" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Output Formula</span>        </a>
        <div id="purchase" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <!--<h6 class="collapse-header">Custom Components:</h6>-->
        <a class="collapse-item" href="outputFEntry.php">Output Formula Entry</a>
        <a class="collapse-item" href="outputFReg.php">Output Formula Register</a>
        
        </div>
        </div>
        </li>
 	   <?php
       }
	   else if($_SESSION['uAccess'] == "3" && $_SESSION['uRole'] == "User")
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
        <a class="collapse-item" href="RM_report.php">RM Report</a>
        <a class="collapse-item" href="drum_report.php">Drum Report</a>
        <a class="collapse-item" href="formula_report.php">FG Report 1</a>  
        <a class="collapse-item" href="FG_Report2.php">FG Report 2</a>  
        </div>
        </div>
        </li>
       <?php
	   }
	    else if($_SESSION['uAccess'] == "1,2" && $_SESSION['uRole'] == "User")
	   {
       ?>
       <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Master</span>        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <!--<h6 class="collapse-header">Custom Components:</h6>-->
        <a class="collapse-item" href="supplierMaster.php">Supplier Master</a>
        <a class="collapse-item" href="customerMaster.php">Customer Master</a>
        <a class="collapse-item" href="rmMaster.php">RM Master</a>
        <a class="collapse-item" href="fgMaster.php">FG Master</a>
        <a class="collapse-item" href="drumMaster.php">DRUM Master</a>  
        </div>
        </div>
        </li>
       <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#purchase" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Output Formula</span>        </a>
        <div id="purchase" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <!--<h6 class="collapse-header">Custom Components:</h6>-->
        <a class="collapse-item" href="outputFEntry.php">Output Formula Entry</a>
        <a class="collapse-item" href="outputFReg.php">Output Formula Register</a>
        
        </div>
        </div>
        </li>
       <?php
	   }
	   else if($_SESSION['uAccess'] == "1,3" && $_SESSION['uRole'] == "User")
	   {
	   ?>
       <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Master</span>        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <!--<h6 class="collapse-header">Custom Components:</h6>-->
        <a class="collapse-item" href="supplierMaster.php">Supplier Master</a>
        <a class="collapse-item" href="customerMaster.php">Customer Master</a>
        <a class="collapse-item" href="rmMaster.php">RM Master</a>
        <a class="collapse-item" href="fgMaster.php">FG Master</a>
        <a class="collapse-item" href="drumMaster.php">DRUM Master</a>  
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
        <a class="collapse-item" href="RM_report.php">RM Report</a>
        <a class="collapse-item" href="drum_report.php">Drum Report</a>
        <a class="collapse-item" href="formula_report.php">FG Report 1</a>  
        <a class="collapse-item" href="FG_Report2.php">FG Report 2</a>  
        </div>
        </div>
        </li>
       <?php
	   }
	   else if($_SESSION['uAccess'] == "2,3" && $_SESSION['uRole'] == "User")
	   {
	   ?>
       <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#purchase" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Output Formula</span>        </a>
        <div id="purchase" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <!--<h6 class="collapse-header">Custom Components:</h6>-->
        <a class="collapse-item" href="outputFEntry.php">Output Formula Entry</a>
        <a class="collapse-item" href="outputFReg.php">Output Formula Register</a>
        
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
        <a class="collapse-item" href="RM_report.php">RM Report</a>
        <a class="collapse-item" href="drum_report.php">Drum Report</a>
        <a class="collapse-item" href="formula_report.php">FG Report 1</a>  
        <a class="collapse-item" href="FG_Report2.php">FG Report 2</a>  
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
        <a class="collapse-item" href="new_cat.php">New Category</a>
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
        <a class="collapse-item" href="supplierMaster.php">Supplier Master</a>
        <a class="collapse-item" href="customerMaster.php">Customer Master</a>
        <a class="collapse-item" href="rmMaster.php">RM Master</a>
        <a class="collapse-item" href="fgMaster.php">FG Master</a>
        <a class="collapse-item" href="drumMaster.php">DRUM Master</a>  
        </div>
        </div>
        </li>
        <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#purchase" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Output Formula</span>        </a>
        <div id="purchase" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <!--<h6 class="collapse-header">Custom Components:</h6>-->
        <a class="collapse-item" href="outputFEntry.php">Output Formula Entry</a>
        <a class="collapse-item" href="outputFReg.php">Output Formula Register</a>
        
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
        <a class="collapse-item" href="RM_report.php">RM Report</a>
        <a class="collapse-item" href="drum_report.php">Drum Report</a>
        <a class="collapse-item" href="formula_report.php">FG Report 1</a>  
        <a class="collapse-item" href="FG_Report2.php">FG Report 2</a>  
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