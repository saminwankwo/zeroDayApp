<?php
session_start(); 
include('config/head.php');
// if($_SESSION['su']){
//     $user = $_SESSION['setpassword'];
// }
?>

<body>
    <div class="loader"></div>
    <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-6 offset-xl-3">
            <div class="login-brand">
              CybZero Pro
            </div>
            <div class="card card-primary">
              <div class="card-header ">
                <!-- <h4 class="text-center">Congratulation</h4> -->
              </div>
              <div class="card-body">

              <div class="container">
                <div class="col-xl-8 mx-lg-auto p-t-b-80">
                    <header class="text-center mb-5">
                        <i class="fas fa-check s-256 text-success"></i>
                        <h4 class="text-success">Congratulations!</h4>
                        <p class="section-subtitle">Account Creation Successful</p>
                        <p class="s-14">Please Check your email for further instructions</p>
                        <p class="text-primary bold">
                        </p> 
                </header>

              
                        
                      
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </section>
    </div>
</body>

<?php
include('config/footer.php');
?>

