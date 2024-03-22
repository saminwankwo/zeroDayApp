<?php 
session_start();
include('config/session.php');
include('config/head.php');
include('config/navbar.php');

// echo 'Welcome to dashboard';/

$sql = $conn->query("SELECT * FROM websites WHERE bizId = '$bizId'");


?>
 <!-- Main Content -->
 <div class="main-content">
		<section class="section">

		<?php 
			if (!$sql->fetch(PDO::FETCH_ASSOC)) {
				?>
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
		</section>
				

				<?php
			} else {
				echo 'show na';
			}
		
		// echo $bizId;
		?>

		

			<!-- <div class="row">
				<div class="col-12 col-sm-12 col-lg-12">
					<div class="card ">
						<div class="card-header">
							<h4>Revenue chart</h4>
							<div class="card-header-action">
								<div class="dropdown">
									<a href="#" data-toggle="dropdown" class="btn btn-warning dropdown-toggle">Options</a>
									<div class="dropdown-menu">
										<a href="#" class="dropdown-item has-icon"><i class="fas fa-eye"></i> View</a>
										<a href="#" class="dropdown-item has-icon"><i class="far fa-edit"></i> Edit</a>
										<div class="dropdown-divider"></div>
										<a href="#" class="dropdown-item has-icon text-danger"><i class="far fa-trash-alt"></i>
											Delete</a>
									</div>
								</div>
								<a href="#" class="btn btn-primary">View All</a>
							</div>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-lg-9">
									<div id="chart1"></div>
									<div class="row mb-0">
										<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
											<div class="list-inline text-center">
												<div class="list-inline-item p-r-30"><i data-feather="arrow-up-circle"
														class="col-green"></i>
													<h5 class="m-b-0">$675</h5>
													<p class="text-muted font-14 m-b-0">Weekly Earnings</p>
												</div>
											</div>
										</div>
										<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
											<div class="list-inline text-center">
												<div class="list-inline-item p-r-30"><i data-feather="arrow-down-circle"
														class="col-orange"></i>
													<h5 class="m-b-0">$1,587</h5>
													<p class="text-muted font-14 m-b-0">Monthly Earnings</p>
												</div>
											</div>
										</div>
										<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
											<div class="list-inline text-center">
												<div class="list-inline-item p-r-30"><i data-feather="arrow-up-circle"
														class="col-green"></i>
													<h5 class="mb-0 m-b-0">$45,965</h5>
													<p class="text-muted font-14 m-b-0">Yearly Earnings</p>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-3">
									<div class="row mt-5">
										<div class="col-7 col-xl-7 mb-3">Total customers</div>
										<div class="col-5 col-xl-5 mb-3">
											<span class="text-big">8,257</span>
											<sup class="col-green">+09%</sup>
										</div>
										<div class="col-7 col-xl-7 mb-3">Total Income</div>
										<div class="col-5 col-xl-5 mb-3">
											<span class="text-big">$9,857</span>
											<sup class="text-danger">-18%</sup>
										</div>
										<div class="col-7 col-xl-7 mb-3">Project completed</div>
										<div class="col-5 col-xl-5 mb-3">
											<span class="text-big">28</span>
											<sup class="col-green">+16%</sup>
										</div>
										<div class="col-7 col-xl-7 mb-3">Total expense</div>
										<div class="col-5 col-xl-5 mb-3">
											<span class="text-big">$6,287</span>
											<sup class="col-green">+09%</sup>
										</div>
										<div class="col-7 col-xl-7 mb-3">New Customers</div>
										<div class="col-5 col-xl-5 mb-3">
											<span class="text-big">684</span>
											<sup class="col-green">+22%</sup>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-12 col-sm-12 col-lg-4">
					<div class="card">
						<div class="card-header">
							<h4>Chart</h4>
						</div>
						<div class="card-body">
							<div id="chart4" class="chartsh"></div>
						</div>
					</div>
				</div>
				<div class="col-12 col-sm-12 col-lg-4">
					<div class="card">
						<div class="card-header">
							<h4>Chart</h4>
						</div>
						<div class="card-body">
							<div class="summary">
								<div class="summary-chart active" data-tab-group="summary-tab" id="summary-chart">
									<div id="chart3" class="chartsh"></div>
								</div>
								<div data-tab-group="summary-tab" id="summary-text">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-sm-12 col-lg-4">
					<div class="card">
						<div class="card-header">
							<h4>Chart</h4>
						</div>
						<div class="card-body">
							<div id="chart2" class="chartsh"></div>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h4>Assign Task Table</h4>
							<div class="card-header-form">
								<form>
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Search">
										<div class="input-group-btn">
											<button class="btn btn-primary"><i class="fas fa-search"></i></button>
										</div>
									</div>
								</form>
							</div>
						</div>
						<div class="card-body p-0">
							<div class="table-responsive">
								<table class="table table-striped">
									<tr>
										<th class="text-center">
											<div class="custom-checkbox custom-checkbox-table custom-control">
												<input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad"
													class="custom-control-input" id="checkbox-all">
												<label for="checkbox-all" class="custom-control-label">&nbsp;</label>
											</div>
										</th>
										<th>Task Name</th>
										<th>Members</th>
										<th>Task Status</th>
										<th>Assigh Date</th>
										<th>Due Date</th>
										<th>Priority</th>
										<th>Action</th>
									</tr>
									<tr>
										<td class="p-0 text-center">
											<div class="custom-checkbox custom-control">
												<input type="checkbox" data-checkboxes="mygroup" class="custom-control-input"
													id="checkbox-1">
												<label for="checkbox-1" class="custom-control-label">&nbsp;</label>
											</div>
										</td>
										<td>Create a mobile app</td>
										<td class="text-truncate">
											<ul class="list-unstyled order-list m-b-0 m-b-0">
												<li class="team-member team-member-sm"><img class="rounded-circle"
														src="assets/img/users/user-8.png" alt="user" data-toggle="tooltip" title=""
														data-original-title="Wildan Ahdian"></li>
												<li class="team-member team-member-sm"><img class="rounded-circle"
														src="assets/img/users/user-9.png" alt="user" data-toggle="tooltip" title=""
														data-original-title="John Deo"></li>
												<li class="team-member team-member-sm"><img class="rounded-circle"
														src="assets/img/users/user-10.png" alt="user" data-toggle="tooltip" title=""
														data-original-title="Sarah Smith"></li>
												<li class="avatar avatar-sm"><span class="badge badge-primary">+4</span></li>
											</ul>
										</td>
										<td class="align-middle">
											<div class="progress-text">50%</div>
											<div class="progress" data-height="6">
												<div class="progress-bar bg-success" data-width="50%"></div>
											</div>
										</td>
										<td>2018-01-20</td>
										<td>2019-05-28</td>
										<td>
											<div class="badge badge-success">Low</div>
										</td>
										<td><a href="#" class="btn btn-outline-primary">Detail</a></td>
									</tr>
									<tr>
										<td class="p-0 text-center">
											<div class="custom-checkbox custom-control">
												<input type="checkbox" data-checkboxes="mygroup" class="custom-control-input"
													id="checkbox-2">
												<label for="checkbox-2" class="custom-control-label">&nbsp;</label>
											</div>
										</td>
										<td>Redesign homepage</td>
										<td class="text-truncate">
											<ul class="list-unstyled order-list m-b-0 m-b-0">
												<li class="team-member team-member-sm"><img class="rounded-circle"
														src="assets/img/users/user-1.png" alt="user" data-toggle="tooltip" title=""
														data-original-title="Wildan Ahdian"></li>
												<li class="team-member team-member-sm"><img class="rounded-circle"
														src="assets/img/users/user-2.png" alt="user" data-toggle="tooltip" title=""
														data-original-title="John Deo"></li>
												<li class="avatar avatar-sm"><span class="badge badge-primary">+2</span></li>
											</ul>
										</td>
										<td class="align-middle">
											<div class="progress-text">40%</div>
											<div class="progress" data-height="6">
												<div class="progress-bar bg-danger" data-width="40%"></div>
											</div>
										</td>
										<td>2017-07-14</td>
										<td>2018-07-21</td>
										<td>
											<div class="badge badge-danger">High</div>
										</td>
										<td><a href="#" class="btn btn-outline-primary">Detail</a></td>
									</tr>
									<tr>
										<td class="p-0 text-center">
											<div class="custom-checkbox custom-control">
												<input type="checkbox" data-checkboxes="mygroup" class="custom-control-input"
													id="checkbox-3">
												<label for="checkbox-3" class="custom-control-label">&nbsp;</label>
											</div>
										</td>
										<td>Backup database</td>
										<td class="text-truncate">
											<ul class="list-unstyled order-list m-b-0 m-b-0">
												<li class="team-member team-member-sm"><img class="rounded-circle"
														src="assets/img/users/user-3.png" alt="user" data-toggle="tooltip" title=""
														data-original-title="Wildan Ahdian"></li>
												<li class="team-member team-member-sm"><img class="rounded-circle"
														src="assets/img/users/user-4.png" alt="user" data-toggle="tooltip" title=""
														data-original-title="John Deo"></li>
												<li class="team-member team-member-sm"><img class="rounded-circle"
														src="assets/img/users/user-5.png" alt="user" data-toggle="tooltip" title=""
														data-original-title="Sarah Smith"></li>
												<li class="avatar avatar-sm"><span class="badge badge-primary">+3</span></li>
											</ul>
										</td>
										<td class="align-middle">
											<div class="progress-text">55%</div>
											<div class="progress" data-height="6">
												<div class="progress-bar bg-purple" data-width="55%"></div>
											</div>
										</td>
										<td>2019-07-25</td>
										<td>2019-08-17</td>
										<td>
											<div class="badge badge-info">Average</div>
										</td>
										<td><a href="#" class="btn btn-outline-primary">Detail</a></td>
									</tr>
									<tr>
										<td class="p-0 text-center">
											<div class="custom-checkbox custom-control">
												<input type="checkbox" data-checkboxes="mygroup" class="custom-control-input"
													id="checkbox-4">
												<label for="checkbox-4" class="custom-control-label">&nbsp;</label>
											</div>
										</td>
										<td>Android App</td>
										<td class="text-truncate">
											<ul class="list-unstyled order-list m-b-0 m-b-0">
												<li class="team-member team-member-sm"><img class="rounded-circle"
														src="assets/img/users/user-7.png" alt="user" data-toggle="tooltip" title=""
														data-original-title="John Deo"></li>
												<li class="team-member team-member-sm"><img class="rounded-circle"
														src="assets/img/users/user-8.png" alt="user" data-toggle="tooltip" title=""
														data-original-title="Sarah Smith"></li>
												<li class="avatar avatar-sm"><span class="badge badge-primary">+4</span></li>
											</ul>
										</td>
										<td class="align-middle">
											<div class="progress-text">70%</div>
											<div class="progress" data-height="6">
												<div class="progress-bar" data-width="70%"></div>
											</div>
										</td>
										<td>2018-04-15</td>
										<td>2019-07-19</td>
										<td>
											<div class="badge badge-success">Low</div>
										</td>
										<td><a href="#" class="btn btn-outline-primary">Detail</a></td>
									</tr>
									<tr>
										<td class="p-0 text-center">
											<div class="custom-checkbox custom-control">
												<input type="checkbox" data-checkboxes="mygroup" class="custom-control-input"
													id="checkbox-5">
												<label for="checkbox-5" class="custom-control-label">&nbsp;</label>
											</div>
										</td>
										<td>Logo Design</td>
										<td class="text-truncate">
											<ul class="list-unstyled order-list m-b-0 m-b-0">
												<li class="team-member team-member-sm"><img class="rounded-circle"
														src="assets/img/users/user-9.png" alt="user" data-toggle="tooltip" title=""
														data-original-title="Wildan Ahdian"></li>
												<li class="team-member team-member-sm"><img class="rounded-circle"
														src="assets/img/users/user-10.png" alt="user" data-toggle="tooltip" title=""
														data-original-title="John Deo"></li>
												<li class="team-member team-member-sm"><img class="rounded-circle"
														src="assets/img/users/user-2.png" alt="user" data-toggle="tooltip" title=""
														data-original-title="Sarah Smith"></li>
												<li class="avatar avatar-sm"><span class="badge badge-primary">+2</span></li>
											</ul>
										</td>
										<td class="align-middle">
											<div class="progress-text">45%</div>
											<div class="progress" data-height="6">
												<div class="progress-bar bg-cyan" data-width="45%"></div>
											</div>
										</td>
										<td>2017-02-24</td>
										<td>2018-09-06</td>
										<td>
											<div class="badge badge-danger">High</div>
										</td>
										<td><a href="#" class="btn btn-outline-primary">Detail</a></td>
									</tr>
									<tr>
										<td class="p-0 text-center">
											<div class="custom-checkbox custom-control">
												<input type="checkbox" data-checkboxes="mygroup" class="custom-control-input"
													id="checkbox-6">
												<label for="checkbox-6" class="custom-control-label">&nbsp;</label>
											</div>
										</td>
										<td>Ecommerce website</td>
										<td class="text-truncate">
											<ul class="list-unstyled order-list m-b-0 m-b-0">
												<li class="team-member team-member-sm"><img class="rounded-circle"
														src="assets/img/users/user-8.png" alt="user" data-toggle="tooltip" title=""
														data-original-title="Wildan Ahdian"></li>
												<li class="team-member team-member-sm"><img class="rounded-circle"
														src="assets/img/users/user-9.png" alt="user" data-toggle="tooltip" title=""
														data-original-title="John Deo"></li>
												<li class="team-member team-member-sm"><img class="rounded-circle"
														src="assets/img/users/user-10.png" alt="user" data-toggle="tooltip" title=""
														data-original-title="Sarah Smith"></li>
												<li class="avatar avatar-sm"><span class="badge badge-primary">+4</span></li>
											</ul>
										</td>
										<td class="align-middle">
											<div class="progress-text">30%</div>
											<div class="progress" data-height="6">
												<div class="progress-bar bg-orange" data-width="30%"></div>
											</div>
										</td>
										<td>2018-01-20</td>
										<td>2019-05-28</td>
										<td>
											<div class="badge badge-info">Average</div>
										</td>
										<td><a href="#" class="btn btn-outline-primary">Detail</a></td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>


		</section>-->



<?php
include('config/dashfooter.php');
?>