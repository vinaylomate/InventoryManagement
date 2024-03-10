<!DOCTYPE html>
<html lang="en">
<head>
  <?php include('inc/meta.php');?>
</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-12 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">			
			<div class="col-lg-3 d-none d-lg-block bg-register-image"></div>	
			 
			  <div class="col-lg-5">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Login Form</h1>
                  </div>
                  <form class="user" action="log.php" method="post" enctype="multipart/form-data"> 
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="userNm" name="userNm" aria-describedby="emailHelp" placeholder="Enter User Name..." autofocus required>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="pwd" name="pwd" placeholder="Password" required>
                    </div>                    
                    <input type="submit" id="btnlogin" name="btnlogin" class="btn btn-primary btn-user btn-block" value="Login">                   
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="forgot-password.html">Forgot Password?</a>
                  </div>
                 
                </div>
              </div>  
           		<div class="col-lg-4 d-none d-lg-block bg-login-image"></div>	
            </div>
          </div>
        </div>

      </div>

    </div>


 


  </div>
<!-- Footer -->
      <?php
	  include("inc/footer.php");
	  
	  ?>
      <!-- End of Footer -->
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>