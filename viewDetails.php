<?php
session_start();
include('config/session.php');
include('config/head.php');
include('config/navbar.php');


?>
 <!-- Main Content -->
 <div class="main-content">
		<section class="section">
		
<?php
if(isset($_GET['view'])){
    $id = $_GET['view'];
    $sql = $conn->query("SELECT * FROM websites WHERE webId = '$id'");
    $row = $sql->fetch(PDO::FETCH_ASSOC);

    $detail = $conn->query("SELECT * FROM details WHERE webId = '$id' ");
    if(!$detail->fetch(PDO::FETCH_ASSOC)){
        ?>

        <section class="section-body">
			
            <div class="row">
          <div class="col-12 col-md-12 col-sm-12">
            <div class="card">
              <div class="card-header">
                <h4><?php echo $row['website']; ?> </h4>
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
                  <button type="button" class="btn btn-primary mt-4" data-toggle="modal"  data-id="<?php echo $row['website'] ?> " id="scan" data-target="#exampleModal">Scan Records </button>

                  <!-- <a href="#" class="btn btn-primary mt-4" data-toggle="modal" data-target="#basicModal">Add website</a> -->
                </div>
              </div>
            </div>
          </div>
            </div>
            </section>
            </section>

        <?php
        echo 'testing 1';
    }

    echo 'testing 2';
}
?>

<script>
    $(function(){
        $('#scan').click(function(){
            let url = $(this).data('id')
            let newStr = url.slice(4);

            $.ajax({
        method: 'GET',
        url: 'https://api.api-ninjas.com/v1/urllookup?url=' + url,
        headers: { 'X-Api-Key': 'YOUR_API_KEY'},
        contentType: 'application/json',
        beforeSend: function() {
            // Show loading text in modal
            $('.modal-title').text('Loading...');
        },
        success: function(result) {
            // Display API response in modal body
            $('.modal-body').html('<pre>' + JSON.stringify(result, null, 2) + '</pre>');
            // Update modal title
            $('.modal-title').text('Result');
            
            // Send the result to a PHP file
            $.ajax({
                method: 'POST',
                url: 'data.php',
                data: { result: result },
                success: function(response) {
                    console.log('Result sent to PHP file');
                },
                error: function(jqXHR) {
                    console.error('Error sending result to PHP file');
                }
            });
        },
        error: function(jqXHR) {
            // Display error message in modal body
            $('.modal-body').html('<div class="alert alert-danger" role="alert">Error: ' + jqXHR.responseText + '</div>');
            // Update modal title
            $('.modal-title').text('Error');
        }
    });
            // console.log('rest')
            // console.log(url)
            // console.log(newStr)
        })
    })

</script>


<?php
include('config/dashfooter.php');
?>
