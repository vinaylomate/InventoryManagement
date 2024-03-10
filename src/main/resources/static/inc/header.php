<li class="nav-item dropdown no-arrow">
<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <?php
    /*include('mysql.connect.php');
    $q="SELECT UserNm FROM admin_tbl WHERE id='".$_SESSION['uId']."' AND sts='0'";
    $stm=$mysql->prepare($q);
    $stm->execute();
    $row=$stm->fetch(PDO::FETCH_ASSOC);
    $uuname=strtoupper($row['UserNm']);
    $mysql=null;*/
    ?>
<span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $uuname; ?></span>
</a>
<!-- Dropdown - User Information -->
<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

<!--<a class="dropdown-item" href="#">
<i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
Profile                </a>
<a class="dropdown-item" href="#">
<i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
Settings                </a>
<a class="dropdown-item" href="#">
<i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
Activity Log                </a>-->

<div class="dropdown-divider"></div>
<a class="dropdown-item" href="logout.php" >
<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
Logout                </a>
</div>
</li>