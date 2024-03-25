<?php
session_start();

include('config/core.php');
include('config/head.php');
?>
 <div class="loader"></div>
 <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="card card-primary">
              <div class="card-header">
                <h4>Forgot Password</h4>
              </div>
              <div class="p-2">
                <?php
                if(isset($_SESSION['error'])){
                  echo "<div class='alert alert-danger text-center mt20'>
                    <span>".$_SESSION['error']."</span
                  </div>";
          
                  unset($_SESSION['error']);
                }
                ?>
              </div>
              <div class="card-body">
                <p class="text-muted">We will send a link to reset your password</p>
                <form method="POST" action="actions.php?return=<?php echo basename(htmlspecialchars($_SERVER['PHP_SELF'])); ?>">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                  </div>
                  <div class="form-group">
                    <button>Forgot Password</button>
                    <!-- <button type="submit" class="btn btn-primary btn-lg btn-block" name="forgotPass" tabindex="4">
                      Fordddgot Password
                    </button> -->
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
<?php
include('config/footer.php');
?>