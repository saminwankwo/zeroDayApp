<?php
session_start();

include('config/core.php');
include('config/head.php');

if($_SESSION['setpassword']){
    $user = $_SESSION['setpassword'];
}

// $_SESSION['action'] = 'reset'

if($_SESSION['action']){
  $action = $_SESSION['action'];
}

?>
<body>
    <div class="loader"></div>
    <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="card card-primary">
              <div class="card-header">
                <h4>Set Password</h4>
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
                <p class="text-muted">Enter Your New Password</p>
                <form method="POST" action="actions.php?return=<?php echo basename(htmlspecialchars($_SERVER['PHP_SELF'])); ?>">
                    <input type="hidden" name="bus" value="<?php echo $user ?>"> 
                    <input type="hidden" name="action" value="<?php echo $action ?>"> 
                  <div class="form-group">
                    <label for="password">New Password</label>
                    <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator"
                      name="password" tabindex="2" required>
                    <div id="pwindicator" class="pwindicator">
                      <div class="bar"></div>
                      <div class="label"></div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="password-confirm">Confirm Password</label>
                    <input id="password-confirm" type="password" class="form-control" name="confirm-password"
                      tabindex="2" required>
                  </div>
                  <?php
                    if($_SESSION['action'] == 'set'){
                      echo '
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4" name="newpassword">
                          Set Password
                        </button>
                      </div>
                      ';
                    } else {
                      echo '
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4" name="resetPassword">
                          Save Password
                        </button>
                      </div>

                      ';
                    }
                  ?>


                </form>
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