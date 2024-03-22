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
    <section class="section-body">
				<div class="row">
              <div class="col-12 col-md-12 col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <h4>No Website yet</h4>
                  </div>
                  <div class="card-body">
                    <div class="empty-state" data-height="400">
                      <div class="empty-state-icon">
                        <i class="fas fa-question"></i>
                      </div>
                      <h2>We couldn't find any data</h2>
                      <p class="lead">
                        Sorry we can't find any data, to get rid of this message, make at least 1 entry.
                      </p>
					  <button type="button" class="btn btn-primary mt-4" data-toggle="modal" data-target="#basicModal">Add website 2</button>

                      <!-- <a href="#" class="btn btn-primary mt-4" data-toggle="modal" data-target="#basicModal">Add website</a> -->
                      <a href="#" class="mt-4 bb">Need Help?</a>
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

