<?php
session_start();
include('config/session.php');
include('config/head.php');
include('config/navbar.php');
?>

<div class="main-content">
		<section class="section">
		<?php
                  if(isset($_SESSION['error'])){
                    echo "<div class='alert alert-danger text-center mt20'>
                        <span>".$_SESSION['error']."</span
                    </div>";
      
                    unset($_SESSION['error']);
                  }

                  if(isset($_SESSION['success'])){
                    echo "<div class='alert alert-success text-center mt20'>
                        <span>".$_SESSION['success']."</span
                    </div>";
      
                    unset($_SESSION['success']);
                  }
                ?>
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
						<form method="post" class="" action="actions.php?return=<?php echo basename(htmlspecialchars($_SERVER['PHP_SELF'])); ?>">
						  <div class="card-header">
							<h4>Edit Profile</h4>
						  </div>
						  <div class="card-body">
							<div class="row">
							  <div class="form-group col-md-6 col-12">
								<label>Full Name</label>
								<input type="text" class="form-control"  name ="fullName" value="<?php echo $fullname?>">
							   
							  </div>
							  <div class="form-group col-md-6 col-12">
								<label> Company Name </label>
								<input type="text" class="form-control" name ="companyName" value="<?php echo $boss['companyName']?>">
							   
							  </div>
							</div>
							<div class="row">
							  <div class="form-group col-md-7 col-12">
								<label>Phone</label>
								<input type="test" class="form-control"  name="phone" value="<?php echo $boss['phoneNumber']?> ">
								
							  </div>
							 
							</div>
						   
							
						  </div>
						  <div class="card-footer text-right">
							<button class="btn btn-primary" type="submit" name ="editProfile">Save Changes</button>
						  </div>
						</form>



						<form method="post" action="actions.php?return=<?php echo basename(htmlspecialchars($_SERVER['PHP_SELF'])); ?>">
						  <div class="card-header">
						  	<h4>Change Password</h4>
						  </div>

						  <div class="card-body">

						  	<div class="row">
								    <div class="form-group">
                    					<label for="password-confirm">Current Password</label>
                    					<input id="password-confirem" type="password" class="form-control" name="current-password" tabindex="2" required>
                  					</div>
							</div>

							<hr>

						  		<div class="row">
										<div class="form-group col-md-6 col-12">
											<label for="password">New Password</label>
											<input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password" tabindex="2" required>
											<div id="pwindicator" class="pwindicator">
												<div class="bar"></div>
												<div class="label"></div>
											</div>
										</div>

										<div class="form-group col-md-6 col-12">
											<label for="password-confirm">Confirm Password</label>
											<input id="password-confirm" type="password" class="form-control" name="confirm-password" tabindex="2" required>
										</div>
								</div>

								<div class="row">
									
								</div>
						  </div>

						  <div class="card-footer">
							<button class="btn btn-primary" type="submit" name="passwords">Update Password</button>
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