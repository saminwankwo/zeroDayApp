<?php
session_start();
include('config/session.php');
include('config/head.php');
include('config/navbar.php');


?>
  <div class="main-content">
        <section class="section">
          <div class="section-body">
          <div class="row clearfix">
              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-6">
                <div class="card">
                  <div class="card-header">
                    <h4></h4>
                  </div>
                  <div class="card-body">
                    <div class="recent-report__chart">
                      <div id="lineChart"></div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-6">
                <div class="card">
                  <div class="card-header">
                    <h4></h4>
                  </div>
                  <div class="card-body">
                    <div class="recent-report__chart">
                      <div id="chart5"></div>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
        </section></div>
<?php
include('config/dashfooter.php');
?>