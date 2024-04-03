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
                <?php
                    $api_key = '9nLDbt1XJjdrETbNd6qBdg==v5SypDjkBib7KqNu';
                    $domain = substr($row['website'], 4);
                    
                    $url = 'https://api.api-ninjas.com/v1/dnslookup?domain=' . urlencode($domain);
                    $options = [
                      'http' => [
                        'method' => 'GET',
                        'header' => 'X-Api-Key: ' . $api_key . "\r\n" .
                                    'Content-Type: application/json',
                      ],
                    ];

                    $context = stream_context_create($options);
                    $response = file_get_contents($url, false, $context);

                    if($response === false){
                      echo 'Error fetching data';
                    } else {
                      $result = json_decode($response, true);
                      if($result){
                    try {

                          $insert = "INSERT INTO details (webId) VALUES (:fullname)";
                          if($ins = $conn->prepare($insert)){
                              $ins->bindParam(":fullname", $param_fullname, PDO::PARAM_STR);
                              $param_fullname = $id;

                              if($ins->execute()){
                                $last_id = $conn->lastInsertId();
                                $stmt = $conn->prepare('INSERT INTO dns_results 
                                (detailsId , record_type, value) VALUES 
                                (:domain, :record_type, :value)');
                                $more = $conn->prepare('INSERT INTO dns_results2 (
                                    detailsId , record_type, mname, rname, serial, refresh, retry, expire, ttl) VALUES 
                                    (:domain, :record_type, :mname, :rname, :serial, :refresh, :retry, :expire, :ttl)');

                                foreach($result as $record){
                                    if($record['record_type'] == 'A'){
                                        $stmt->execute([
                                          'domain' => $last_id,
                                          'record_type' => $record['record_type'],
                                          'value' => $record['value'],
                                      ]);
                                    } elseif ($record['record_type'] == 'NS') {
                                        $stmt->execute([
                                            'domain' => $last_id,
                                            'record_type' => $record['record_type'],
                                            'value' => $record['value'],
                                        ]);
                                    } elseif ($record['record_type'] == 'SOA') {
                                        $more->execute([
                                            'domain' => $last_id,
                                            'record_type' => $record['record_type'],
                                            'mname' => $record['mname'],
                                            'rname' => $record['rname'],
                                            'serial' => $record['serial'],
                                            'refresh' => $record['refresh'],
                                            'retry' => $record['retry'],
                                            'expire' => $record['expire'],
                                            'ttl' => $record['ttl'],
                                        ]);
                                    }
                                }

                          }
                        }
                        } catch (PDOException $e) {
                            echo 'Error: ' . $e->getMessage();
                        } } else {
                            echo 'Error decoding JSON.';
                        }}
                ?>
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
    } else {
      
    }

}
?>

<script>
    $(function(){
        $('#scan').click(async function(){
            // console.log('the data ', $())
            let BttData = $(this).data('id')
            const domain = BttData.slice(4);
            console.log('button data', domain)
            const apiKey = '9nLDbt1XJjdrETbNd6qBdg==v5SypDjkBib7KqNu'
            const url = `https://api.api-ninjas.com/v1/dnslookup?domain=${encodeURIComponent(domain)}`;

            try {
                const response = await fetch(url, {
                    method: 'GET',
                    headers: {
                        'X-Api-Key': apiKey,
                        'Content-Type': 'application/json'
                    }
                })

                if(!response.ok){
                    throw new Error('Network response was not ok');
                }

                const result = await response.json();
                
                const modalBody = document.getElementById('dnsResult');
                modalBody.innerHTML = '<pre>' + JSON.stringify(result, null, 2) + '</pre>';

                $('#dnsModal').modal('show');

                location.reload(true)

            } catch (error) {
                console.log('Error:', error)
            }
         
        })
        
         
    })

</script>


<?php
include('config/dashfooter.php');
?>
