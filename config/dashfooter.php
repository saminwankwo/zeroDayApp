<!-- include('config/models.php'); -->
<?php
include('modals.php')
?>
<!-- sidebar settings -->
		<div class="settingSidebar">
			<a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
			</a>
			<div class="settingSidebar-body ps-container ps-theme-default">
				<div class=" fade show active">
					<div class="setting-panel-header">Setting Panel
					</div>
					<div class="p-15 border-bottom">
						<h6 class="font-medium m-b-10">Select Layout</h6>
						<div class="selectgroup layout-color w-50">
							<label class="selectgroup-item">
								<input type="radio" name="value" value="1" class="selectgroup-input-radio select-layout" checked>
								<span class="selectgroup-button">Light</span>
							</label>
							<label class="selectgroup-item">
								<input type="radio" name="value" value="2" class="selectgroup-input-radio select-layout">
								<span class="selectgroup-button">Dark</span>
							</label>
						</div>
					</div>
					<div class="p-15 border-bottom">
						<h6 class="font-medium m-b-10">Sidebar Color</h6>
						<div class="selectgroup selectgroup-pills sidebar-color">
							<label class="selectgroup-item">
								<input type="radio" name="icon-input" value="1" class="selectgroup-input select-sidebar">
								<span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
									data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
							</label>
							<label class="selectgroup-item">
								<input type="radio" name="icon-input" value="2" class="selectgroup-input select-sidebar" checked>
								<span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
									data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
							</label>
						</div>
					</div>
					<div class="p-15 border-bottom">
						<h6 class="font-medium m-b-10">Color Theme</h6>
						<div class="theme-setting-options">
							<ul class="choose-theme list-unstyled mb-0">
								<li title="white" class="active">
									<div class="white"></div>
								</li>
								<li title="cyan">
									<div class="cyan"></div>
								</li>
								<li title="black">
									<div class="black"></div>
								</li>
								<li title="purple">
									<div class="purple"></div>
								</li>
								<li title="orange">
									<div class="orange"></div>
								</li>
								<li title="green">
									<div class="green"></div>
								</li>
								<li title="red">
									<div class="red"></div>
								</li>
							</ul>
						</div>
					</div>
					<div class="p-15 border-bottom">
						<div class="theme-setting-options">
							<label class="m-b-0">
								<input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
									id="mini_sidebar_setting">
								<span class="custom-switch-indicator"></span>
								<span class="control-label p-l-10">Mini Sidebar</span>
							</label>
						</div>
					</div>
					<div class="p-15 border-bottom">
						<div class="theme-setting-options">
							<label class="m-b-0">
								<input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
									id="sticky_header_setting">
								<span class="custom-switch-indicator"></span>
								<span class="control-label p-l-10">Sticky Header</span>
							</label>
						</div>
					</div>
					<div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
						<a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme">
							<i class="fas fa-undo"></i> Restore Default
						</a>
					</div>
				</div>
			</div>
		</div>

			</div>

<footer class="main-footer">
        <div class="footer-left">
          <!-- <a href="templateshub.net">Templateshub</a></a> -->
        </div>
        <div class="footer-right">
        </div>
      </footer>
    </div>
  </div>

  
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script> -->

<script src="config/assets/js/app.min.js"></script>
  
  <script src="config/assets/bundles/jquery-pwstrength/jquery.pwstrength.min.js"></script>
  <script src="config/assets/bundles/jquery-selectric/jquery.selectric.min.js"></script>
  
  <script src="config/assets/js/page/auth-register.js"></script>
  <script src="config/assets/bundles/apexcharts/apexcharts.min.js"></script>
  
  <script src="config/assets/bundles/izitoast/js/iziToast.min.js"></script>
  <!-- <script src="config/assets/js/page/toastr.js"></script> -->
  <!-- <script src="config/assets/bundles/sweetalert/sweetalert.min.js"></script>
  <!-- <script src="conassets/bundles/prism/prism.js"></script> -->
  <script src="config/assets/bundles/apexcharts/apexcharts.min.js"></script>
  <!-- Page Specific JS File -->
  <script src="config/assets/js/page/chart-apexcharts.js"></script>
  <!-- <script src="config/assets/bundles/amcharts4/core.js"></script>
  <script src="config/assets/bundles/amcharts4/charts.js"></script>
  <script src="config/assets/bundles/amcharts4/animated.js"></script>
  <script src="config/assets/bundles/amcharts4/worldLow.js"></script>
  <script src="config/assets/bundles/amcharts4/maps.js"></script> -->
  <!-- Page Specific JS File -->
  <script src="config/assets/js/page/chart-amchart.js"></script>

  <script src="config/assets/js/scripts.js"></script>
 
  <script>
		</script>
  <script src="config/assets/js/custom.js"></script>
  <script>
	function preview_image(event){
    var reader = new FileReader();
    reader.onload = function(){
        var output = document.getElementById('output_image');
        output.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}

$("#file").bind('change', function(){
    
    if(this.files[0].size/1024/1024 > 1){
        $("#filemessage").html(" File is too Large");
    }else{
        $("#filemessage").html("");
    }
})

  </script>
</body>



</html>