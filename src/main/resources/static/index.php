<html lang="en">

<head>

  <?php include('inc/meta.php'); ?>

</head>



<body class="bg-gradient-primary">



  <div class="container-fluid">



    <!-- Outer Row -->

    <div class="row justify-content-center">



      <div id="abc" class="col-xl-5 col-lg-4 col-md-4">



        <div class="card o-hidden border-0 shadow-lg my-5">

          <div class="card-body p-0">

            <!-- Nested Row within Card Body -->

            <div class="row">

              <!--<div class="col-lg-3 d-none d-lg-block bg-register-image"></div>-->

              <div class="col-lg-5 d-none d-lg-block bg-login-image"></div>

              <div class="col-lg-6">

                <div class="p-5">

                  <div class="text-center">

                    <h1 class="h4 text-gray-900 mb-4">Login Form</h1>

                  </div>

                  <form class="user" action="log.php" method="post" enctype="multipart/form-data" style="text-align: center;">

                    <div class="form-group">

                      <input type="text" class="form-control form-control-user" id="userNm" name="userNm" aria-describedby="emailHelp" placeholder="Enter User Name..." autofocus required>

                    </div>

                    <div class="form-group">

                      <input type="password" class="form-control form-control-user" id="pwd" name="pwd" placeholder="Password" required>

                    </div>

                    <button type="button" id="btnsubmit" name="btnsubmit" class="btn btn-primary" tabindex="10" style="width: 100%; background-color: #b02923; border: none;">Login</button>

                  </form>

                  <hr>

                  <div class="text-center">

                    <a class="small" href="forgot-password.html">Forgot Password?</a>

                  </div>



                </div>

              </div>

              <!--<div class="col-lg-4 d-none d-lg-block bg-login-image"></div>-->

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

  <script type="text/javascript">

    $("#btnsubmit").click(async function(e) {
      if ($("#userNm").val().trim() == "0") {
        $("#userNm").addClass("userNm");
        alert("Please write Username..!!");
        $("#userNm").focus();
        return false;
        //alert("bye");
      } else if ($("#pwd").val().trim() == "0") {
        $("#pwd").addClass("require");
        alert("Please write password..!!");
        $("#pwd").focus();
        return false;
        //alert("bye");
      } else {
        let usernameA = document.getElementById('userNm').value;
        let passwordA =document.getElementById('pwd').value;

        var url = `http://localhost:8080/login`;
        let jsonData = {
          "username": usernameA,
          "password": passwordA
        };
        await $.ajax({
          type: "POST",
          url: url,
          data: JSON.stringify(jsonData),
          contentType: 'application/json',
          success: function(data) {
            localStorage.setItem("user", JSON.stringify(data));
            window.location.href = 'admin.php';
          },
          error: function(error) {
            console.log(error);
          }
        });
        e.preventDefault();
      }
      // avoid to execute the actual submit of the form.
    });

    var width = $(window).width();

    var height = $(window).height()



    if (width > 1600)

    {

      //$("abc").toggleClass('col-xl-5 col-lg-4 col-md-4 col-xl-8 col-lg-4 col-md-4');

      $('#abc').addClass('col-xl-5 col-lg-4 col-md-4');

      $("#abc").removeClass("col-xl-8 col-lg-4 col-md-4")

      //alert('Chiru is back...\n'+width+" X "+height);	

    } else

    {

      $('#abc').addClass('col-xl-8 col-lg-4 col-md-4');

      $("#abc").removeClass("col-xl-5 col-lg-4 col-md-4")

      //alert('Boss is back...\n'+width+" X "+height);	

    }

    /*$(window).resize(function() {

    	alert("window");

      if ($(window).width() > 991) {

        alert("window");

        $( "abc" ).removeClass( "col-xl-5 col-lg-4 col-md-4" ).addClass( "col-xl-8 col-lg-4 col-md-4" );

        $("abc").toggleClass('col-xl-5 col-lg-4 col-md-4 col-xl-8 col-lg-4 col-md-4');

      }

    });*/
  </script>

</body>



</html>