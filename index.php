<?php
session_start();

include('config/core.php');
include('config/head.php');
?>
<body>
	<div class="loader"></div>
	<div class="section">
		<div class="container mt-5">
			<div class="row">
				<div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
				<div class="card card-primary">
					<div class="card-header">
					<h4>Create Your Account</h4>
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

					<div class="card-body" >
						<form method="POST" action="actions.php?return=<?php echo basename(htmlspecialchars($_SERVER['PHP_SELF'])); ?>">
							<div class="row">
								<div class="form-group col-6">
									<label for="frist_name">Full Name</label>
									<input id="frist_name" type="text" class="form-control" name="full_name" autofocus>
								</div>

								<div class="form-group col-6">
									<label for="last_name">Company Name</label>
									<input id="last_name" type="text" class="form-control" name="comp_name">
								</div>

							</div>

							<div class="form-group">
								<label for="email">Company Email</label>
								<input id="email" type="email" class="form-control" name="email">
								<div class="invalid-feedback"></div>
							</div>

							<div class="row">
								<div class="form-group col-6">
									<label for="phone" class="d-block">Phone Number</label>
									
									<div class="input-group">
										<div class="input-group-prepend">
											<div class="input-group-text">
												<i class="fas fa-phone"></i>
											</div>
										</div>
										<input type="text" class="form-control phone-number" name ="phone_number">
									</div>

								</div>

								<div class="form-group col-6 mt-3 custom-control custom-checkbox">
									<div class="pretty p-icon p-curve p-jelly">
										<input type="radio" name="sectype" class="form-control" value="Application">
										<div class="state p-primary">
										<i class="icon material-icons">done</i>
										<label>Application Security</label>
										</div>
									</div>
									
									<div class="pretty p-icon p-curve p-jelly">
										<input type="radio" name="sectype" class="form-control" value="cloud">
										<div class="state p-primary">
										<i class="icon material-icons">done</i>
										<label>Cloud Data Security</label>
										</div>
									</div>
									
								</div>

							</div>

							<div class="form-group">
								<div class="custom-control custom-checkbox">
									<input type="checkbox" name="agree" class="custom-control-input" id="agree" required>
									<label class="custom-control-label" for="agree">I agree with the terms and conditions</label>
								</div>
							</div>

							<div class="form-group">
								<button type="submit" class="btn btn-primary btn-lg btn-block" name="submit">
									Start Now
								</button>
							</div>

						</form>
					</div>

					<div class="mb-4 text-muted text-center">
						Already Registered? <a href="auth-login.php">Login</a>
					</div>
					

				</div>
				</div>
			</div>
		</div>
	</div>

</body>
<?php
include('config/footer.php');
?>