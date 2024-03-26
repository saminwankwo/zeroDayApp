<?php 
session_start();
include('config/session.php');
include('config/head.php');
include('config/navbar.php');

// echo 'Welcome to dashboard';/

$sql = $conn->query("SELECT * FROM websites WHERE bizId = '$bizId'");


	if(isset($_SESSION['error'])){
	echo "<div class='alert alert-danger text-center mt20'>
		<span>".$_SESSION['error']."</span
	</div>";

	unset($_SESSION['error']);
	}

	if(isset($_SESSION['success'])){
	echo " 
	<script>
		function testName() {
			iziToast.success({
			title: 'Hello, world!',
			message: 'This awesome plugin is made by iziToast',
			position: 'topRight'
			});
		}
	</script>
	";

	unset($_SESSION['success']);
	}

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
                    <h4>No Record yet</h4>
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
					  <button type="button" class="btn btn-primary mt-4" data-toggle="modal" data-target="#basicModal">Add website </button>

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
				?>
				<div class="row">
					<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              			<div class="card">
                			<div class="card-statistic-4">
                  				<div class="align-items-center justify-content-between">
                    				<div class="row ">
                      					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        					<div class="card-content">
												<h5 class="font-15">New Booking</h5>
												<h2 class="mb-3 font-18">258</h2>
												<p class="mb-0"><span class="col-green">10%</span> Increase</p>
											</div>
                      					</div>
                      					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
											<div class="banner-img">
												<img src="config/assets/img/banner/1.png" alt="">
											</div>
                      					</div>
                    				</div>
                  				</div>
                			</div>
              			</div>
            		</div>
				</div>

				<div class="row">
					<div class="col-12">
						<div class="card">
							<div class="card-header">
								<h4></h4>
							</div>

							<div class="card-body">
								<div class="table-responsive">
					  				<button type="button" class="btn btn-primary mt-4 float-right" data-toggle="modal" data-target="#basicModal">Add New website </button>

									<table class="table table-striped" id="table-1">
										<thead>
											<tr>
												<th class="text-center">
													SN
												</th>
												<th>
													Website
												</th>
												<th>
													Added On
												</th>
												<th>
													
												</th>
											</tr>
										</thead>

										<tbody>
											<?php
											try {
												$list = "SELECT * FROM websites WHERE bizId = '$bizId'";
												$result = $conn->query($list);

												while ($row = $result->fetch()) {
													echo '<tr>
														<td>'.$sn++.'</td>
														<td>'.$row['website'].'</td>
														<td>'.date('M d, Y', strtotime($row['addTime'])) .'</td>
														<td>
														<a href = "viewDetails.php?view='.$row['webId'].'"  class="btn btn-success"><i class="far fa-eye"></i>  Monitor</a> 
														<button class="btn btn-primary advanceDns data-toggle="tooltip" data-id="'.$row['webId'].'" data-placement="top" title="Configure Advance DNS"><i class="fas fa-globe"></i> Configure Advanced DNS</button> 
														<button class="btn btn-danger deletesite" data-toggle="tooltip" data-id="'.$row['webId'].'" data-placement="top" title="Delete Website"><i class=" fas fa-trash"></i> Delete</button>
														</td>
													</tr>';
												}

											} catch (PDOException $e) {
												echo $e->getMessage();
											} 
											?>
											
										</tbody>

									</table>
								</div>
							</div>

						</div>
					</div>
				</div>

				</section>
		<?php
			}
		
		?>

		<script>
			$(function(){
				
				$('#table-1').on('click', '.advanceDns', function(e){
					e.preventDefault();
					$('#advanceDNS').modal('show');
					let id = $(this).data('id');
					getDNS(id);
					getRow(id);
				});

				$('#table-1').on('click', '.deletesite', function(e){
					e.preventDefault();
					$('#deleteDNS').modal('show');
					let id = $(this).data('id');
					getRow(id);
					getDNS(id);
				});
  

			});

			function getRow(app){
				$.ajax({
					type:'POST',
					url:'data.php',
					data:{app:app},
					dataType:  'json',
					success: function(response){
						$('.web').val(response.webId);
					}
				})
			}

			function getDNS(DNS){
				$.ajax({
					type:'POST',
					url:'data.php',
					data:{DNS:DNS},
					dataType:  'json',
					success: function(response){
						$('.dns').val(response.dnsId);
						$('#dns1').val(response.DNS1)
						$('#dns2').val(response.DNS2)
						$('#dns3').val(response.DNS3)
					}
				})
			}

		</script>
			



<?php
include('config/dashfooter.php');
?>