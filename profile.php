<?php
session_start();
include('config/session.php');
include('config/head.php');
include('config/navbar.php');
?>

<div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row mt-sm-4">
              <div class="col-12 col-md-12 col-lg-4">
                <div class="card author-box">
                  <div class="card-body">
                    <div class="author-box-center">
                      <img alt="image" src="config/assets/img/users/user-1.png" class="rounded-circle author-box-picture">
					  <!-- <a href="#" class="edit-image"><i class="fas fa-edit"></i></a> -->
					  <a href="#changeimage" class="btn-fab btn-fab-sm btn-default" data-toggle="modal" data-placement="top" title="Edit"><i class=" fas fa-edit"></i></a>
                      <div class="clearfix"></div>
                      <div class="author-box-name">
                        <a href="#"><?php echo $fullname?></a>
                      </div>
					 

                    </div>
                  
                  </div>
                </div>




              </div>
              <div class="col-12 col-md-12 col-lg-8">
                <div class="card">
                  <div class="padding-20">
                    <ul class="nav nav-tabs" id="myTab2" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="home-tab2" data-toggle="tab" href="#about" role="tab"
                          aria-selected="true">View Profile</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#settings" role="tab"
                          aria-selected="false">Edit Profile</a>
                      </li>
                    </ul>
                    <div class="tab-content tab-bordered" id="myTab3Content">
                      <div class="tab-pane fade show active" id="about" role="tabpanel" aria-labelledby="home-tab2">
                        <div class="row">
                          <div class="col-md-4 col-6 b-r">
                            <strong>Full Name</strong>
                            <br>
                            <p class="text-muted"> <?php echo $fullname?></p>
                          </div>
                          <div class="col-md-4 col-6 b-r">
                            <strong>Mobile</strong>
                            <br>
                            <p class="text-muted"><?php echo $boss['phoneNumber']?></p>
                          </div>
                          <div class="col-md-4 col-6 b-r">
                            <strong>Email</strong>
                            <br>
                            <p class="text-muted"><?php echo $boss['bizEmail']?></p>
                          </div>
                          
                        </div>

						<div class="row">
                          <div class="col-md-4 col-6 b-r">
                            <strong>company Name</strong>
                            <br>
                            <p class="text-muted"> <?php echo $boss['companyName']?></p>
                          </div>
                          <div class="col-md-4 col-6 b-r">
                            <strong>Account Created On</strong>
                            <br>
                            <p class="text-muted"><?php echo date('M d, Y, h:ia', strtotime($boss['addTime']));?></p>
                          </div>

						  <div class="col-md-4 col-6 b-r">
                            <strong>Account Type</strong>
                            <br>
                            <p class="text-muted"><?php echo $boss['securityType']?></p>
                          </div>

                          
                        </div>

                       
                      </div>

                      <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="profile-tab2">
                        <form method="post" class="needs-validation" action="">
                          <div class="card-header">
                            <h4>Edit Profile</h4>
                          </div>
                          <div class="card-body">
                            <div class="row">
                              <div class="form-group col-md-6 col-12">
                                <label>First Name</label>
                                <input type="text" class="form-control" value="John">
                                <div class="invalid-feedback">
                                  
                                </div>
                              </div>
                              <div class="form-group col-md-6 col-12">
                                <label>Last Name</label>
                                <input type="text" class="form-control" value="Deo">
                                <div class="invalid-feedback">
                                  Please fill in the last name
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="form-group col-md-7 col-12">
                                <label>Email</label>
                                <input type="email" class="form-control" value="test@example.com">
                                <div class="invalid-feedback">
                                  Please fill in the email
                                </div>
                              </div>
                              <div class="form-group col-md-5 col-12">
                                <label>Phone</label>
                                <input type="tel" class="form-control" value="">
                              </div>
                            </div>
                            <div class="row">
                              <div class="form-group col-12">
                                <label>Bio</label>
                                <textarea
                                  class="form-control summernote-simple">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur voluptatum alias molestias minus quod dignissimos.</textarea>
                              </div>
                            </div>
                            <div class="row">
                              <div class="form-group mb-0 col-12">
                                <div class="custom-control custom-checkbox">
                                  <input type="checkbox" name="remember" class="custom-control-input" id="newsletter">
                                  <label class="custom-control-label" for="newsletter">Subscribe to newsletter</label>
                                  <div class="text-muted form-text">
                                    You will get new information about products, offers and promotions
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="card-footer text-right">
                            <button class="btn btn-primary">Save Changes</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      

<?php
include('config/dashfooter.php');
?>