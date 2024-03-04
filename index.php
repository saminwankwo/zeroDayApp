<?php
session_start();

include('config/core.php');
include('config/head.php');
?>
<body>
    <div class="loader"></div>
	<div class="main-content">
        <section class="section">
          <div class="section-body">

		  <?php
                            if (isset($_SESSION['error'])) {
                                echo "<div id='toastr-4'>
                                                <span>".$_SESSION['error']."</span
                                        </div>";

                                unset($_SESSION['error']);
                            }
                            ?>

        <div class="row">

              <div class="col-12 col-sm col-lg">
                <div class="card">
                 
                  <div class="card-body">

                    <ul class="nav nav-pills" id="myTab3" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="home-tab3" data-toggle="tab" href="#home3" role="tab"
                          aria-controls="home" aria-selected="true">Application Security</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#profile3" role="tab"
                          aria-controls="profile" aria-selected="false">Cloud Data Security</a>
                      </li>

                      <!-- <li class="nav-item">
                        <a class="nav-link" id="contact-tab3" data-toggle="tab" href="#contact3" role="tab"
                          aria-controls="contact" aria-selected="false">Contact</a>
                      </li> -->

                    </ul>


                    <div class="tab-content" id="myTabContent2">
                      <div class="tab-pane fade show active" id="home3" role="tabpanel" aria-labelledby="home-tab3">
						
					  <div class="p-5">
							
						<form role="form" method="POST" action="actions.php?return=<?php echo basename(htmlspecialchars($_SERVER['PHP_SELF'])); ?>">
											<input type="hidden" name="plan" value="appSec">
											<div class="row form-group">
												<div class="col-md form-group">
													<label >Full Name</label>
												</div>
												<div class="col-md-8 form-group">
													<input type="text" class="form-control">
												</div>
											</div>
	
											<div class="row form-group">
												<div class="col-md form-group">
													<label >Business Email</label>
												</div>
												<div class="col-md-8 form-group">
													<input type="text" class="form-control">
												</div>
											</div>
	
											<div class="row form-group">
												<div class="col-md form-group">
													<label >Company Name</label>
												</div>
												<div class="col-md-8 form-group">
													<input type="text" class="form-control">
												</div>
											</div>
	
											<div class="row form-group">
												<div class="col-md form-group">
													<label>Phone Number </label>
												</div>
	
												<div class="col-md-8">
													
													<div class="input-group">
														<div class="input-group-prepend">
															<div class="input-group-text">
																<i class="fas fa-phone"></i>
															</div>
														</div>
														<input type="text" class="form-control phone-number">
													</div>
												</div>
	
											</div>


											<div class="form-group">
												<div class="custom-control custom-checkbox">
													<input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
													<label class="custom-control-label" for="remember-me">Remember Me</label>
												</div>
                  							</div>

											<div class="form-group">
												<button type="submit" class="btn btn-primary btn-lg btn-block" name="register" tabindex="4">
												 Start Now
												</button>
											</div>
										
										</form>
										
									
              
           				</div>


                      </div>

                      <div class="tab-pane fade" id="profile3" role="tabpanel" aria-labelledby="profile-tab3">
                    
					  	<div class="p-5">
							<!-- <div class="col-12 col-md col-lg p-5" > -->
								<!-- <div class="card p-5"> -->
								
									<!-- <div class="card-body"> -->
									<form role="form" method="POST" action="actions.php?return=<?php echo basename(htmlspecialchars($_SERVER['PHP_SELF'])); ?>">
										<input type="hidden" name="plan" value="cloud">

											<div class="row form-group">
												<div class="col-md form-group">
													<label >Full Name</label>
												</div>
												<div class="col-md-8 form-group">
													<input type="text" class="form-control">
												</div>
											</div>
	
											<div class="row form-group">
												<div class="col-md form-group">
													<label >Business Email</label>
												</div>
												<div class="col-md-8 form-group">
													<input type="text" class="form-control">
												</div>
											</div>
	
											<div class="row form-group">
												<div class="col-md form-group">
													<label >Company Name</label>
												</div>
												<div class="col-md-8 form-group">
													<input type="text" class="form-control">
												</div>
											</div>
	
											<div class="row form-group">
												<div class="col-md form-group">
													<label>Phone Number (US Format)</label>
												</div>
	
												<div class="col-md-8">
													
													<div class="input-group">
														<div class="input-group-prepend">
															<div class="input-group-text">
																<i class="fas fa-phone"></i>
															</div>
														</div>
														<input type="text" class="form-control phone-number">
													</div>
												</div>
	
											</div>
										
										</form>
										
									<!-- </div> -->
								<!-- </div> -->

								
							<!-- </div> -->
              
           				</div>



                      </div>
					

                    </div>
                  </div>
                </div>
              </div>
        
            </div>

        </section>
    </section>

    </div>
<?php
include('config/footer.php');
?>
