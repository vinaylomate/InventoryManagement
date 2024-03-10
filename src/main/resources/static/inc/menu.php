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

      <span>Dashboard</span></a>
  </li>



  <!-- Divider -->

  <hr class="sidebar-divider">



  <!-- Heading -->

  <div class="sidebar-heading">

    Interface

  </div>

  <script>
    function getAccess() {
      var data = {};
      data = JSON.parse(localStorage.getItem('user'));
      if (data == null) {
        window.location.href = 'index.php';
      }

      var page = [];
      page[0] = "User Create";
      page[1] = "Master";
      page[2] = "Stock Entry";
      page[3] = "Lock Quantity";
      page[4] = "Report";
      page[5] = "Report2";
      var subPage = [];
      subPage[0] = "Company Master";
      subPage[1] = "Location Master";
      subPage[2] = "Product Entry";
      subPage[3] = "Entry Type";
      subPage[4] = "Stock Entry";
      subPage[5] = "Stock Register";
      subPage[6] = "Stock Register - product";
      subPage[7] = "Lock Qty Entry";
      subPage[8] = "Lock Qty Register";
      subPage[9] = "Lock Qty Reg - product";
      subPage[10] = "Stock Report";
      subPage[11] = "Stock Report Batch/LOT";
      subPage[12] = "Re-order Report";
      subPage[13] = "Out of Stock Report";
      subPage[14] = "Expiry Report";
      subPage[15] = "In-Out Report";
      subPage[16] = "Fast Moving Item Report";
      subPage[17] = "Non Moving Item Report";
      subPage[18] = "Stock - Location";
      subPage[19] = "Stock - Location(FG)";
      subPage[20] = "Product Category";
      subPage[21] = "UOM Master";
      subPage[22] = "Rack Master";
      subPage[23] = "Upload Stock";
      var fileName = [];
      fileName[0] = "companyMaster.php";
      fileName[1] = "locationMaster.php";
      fileName[2] = "rmMaster.php";
      fileName[3] = "new_entryType.php";
      fileName[4] = "inventoryEntry.php";
      fileName[5] = "inventoryReg.php";
      fileName[6] = "inventoryReg2.php";
      fileName[7] = "lockQty_entry.php";
      fileName[8] = "lockQty_Reg.php";
      fileName[9] = "lockQty_Reg2.php";
      fileName[10] = "stockReg.php";
      fileName[11] = "stockReg_batch.php";
      fileName[12] = "stockReg_r.php";
      fileName[13] = "stockReg_ost.php";
      fileName[14] = "expiryReg.php";
      fileName[15] = "inoutReport.php";
      fileName[16] = "fastMovingItemRpt.php";
      fileName[17] = "nonMovingItemRpt.php";
      fileName[18] = "stockRegLoc.php";
      fileName[19] = "stockRegLoc2.php";
      fileName[20] = "new_cat.php";
      fileName[21] = "UOMMst.php";
      fileName[22] = "rackMaster.php";
      fileName[23] = "rmStockUpload.php";

      let access = document.getElementById('main');
      let flag = 0;
      let i = 0;
      if (data.User.userRole == 'ADMIN') {
        let row = `<li class="nav-item">
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse${i}" aria-expanded="true" aria-controls="collapse${i}">
                <i class="fas fa-fw fa-cog"></i>
                <span>${page[0]}</span> </a>
                  <div id="collapse${i}" class="collapse" aria-labelledby="heading${i}" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                      <a class="collapse-item" href="user_creation.php">User Creation</a>
                    </div>
                  </div>
              </li>`;
        access.innerHTML += row;
      }
      i++;
      data.User.pages.forEach((index) => {
        if (index == 1) {
          let row = `<li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse${i}" aria-expanded="true" aria-controls="collapse${i}">
              <i class="fas fa-fw fa-cog"></i>
              <span>${page[index]}</span> </a>
                <div id="collapse${i}" class="collapse" aria-labelledby="heading${i}" data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                    <div id="subAccess">
                    </div>
                  </div>
                </div>
            </li>`;
          access.innerHTML += row;
        } else {
          let row = `<li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse${i}" aria-expanded="true" aria-controls="collapse${i}">
              <i class="fas fa-fw fa-cog"></i>
              <span>${page[index]}</span> </a>
                <div id="collapse${i}" class="collapse" aria-labelledby="heading${i}" data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">`
          if (page[index] == 'Stock Entry') {
            row += `<a class="collapse-item" href="${fileName[4]}">${subPage[4]}</a>
                      <a class="collapse-item" href="${fileName[5]}">${subPage[5]}</a>
                      <a class="collapse-item" href="${fileName[6]}">${subPage[6]}</a>`
          } else if (page[index] == 'Lock Quantity') {
            row += `<a class="collapse-item" href="${fileName[7]}">${subPage[7]}</a>
                      <a class="collapse-item" href="${fileName[8]}">${subPage[8]}</a>
                      <a class="collapse-item" href="${fileName[9]}">${subPage[9]}</a>`
          } else if (page[index] == 'Report') {
            row += `<a class="collapse-item" href="${fileName[10]}">${subPage[10]}</a>
                      <a class="collapse-item" href="${fileName[11]}">${subPage[11]}</a>
                      <a class="collapse-item" href="${fileName[12]}">${subPage[12]}</a>
                      <a class="collapse-item" href="${fileName[13]}">${subPage[13]}</a>
                      <a class="collapse-item" href="${fileName[14]}">${subPage[14]}</a>
                      <a class="collapse-item" href="${fileName[15]}">${subPage[15]}</a>
                      <a class="collapse-item" href="${fileName[16]}">${subPage[16]}</a>
                      <a class="collapse-item" href="${fileName[17]}">${subPage[17]}</a>`
          } else if (page[index] == 'Report2') {
            row += `<a class="collapse-item" href="${fileName[18]}">${subPage[18]}</a>`
          }
          row += `</div>
                </div>
            </li>`;
          access.innerHTML += row;
        }
        i++;
      });

      let subAccessDD = document.getElementById('subAccess');
      data.User.subPages.forEach((index) => {
        let row = `<a class="collapse-item" href="${fileName[index-1]}">${subPage[index-1]}</a>`;
        subAccessDD.innerHTML += row;
      });

      if (data.User.userRole == 'ADMIN') {
          let row = `<a class="collapse-item" href="${fileName[20]}">${subPage[20]}</a>
          <a class="collapse-item" href="${fileName[21]}">${subPage[21]}</a>
          <a class="collapse-item" href="${fileName[22]}">${subPage[22]}</a>
          <a class="collapse-item" href="${fileName[23]}">${subPage[23]}</a>`;
          subAccessDD.innerHTML += row;
        }
    }
  </script>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      // Your code here
      getAccess();
    });
  </script>

  <div id="main">


  </div>

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

      <span>Log Out</span></a>
  </li>



  <!-- Divider -->

  <hr class="sidebar-divider d-none d-md-block">



  <!-- Sidebar Toggler (Sidebar) -->

  <div class="text-center d-none d-md-inline">

    <button class="rounded-circle border-0" id="sidebarToggle"></button>

  </div>



</ul>