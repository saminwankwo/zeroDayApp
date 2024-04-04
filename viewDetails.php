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
        $select = $conn->query("SELECT * FROM details LEFT JOIN dns_results2 ON details.detailsId=dns_results2.detailsId WHERE webId = '$id' ");
        $rows = $select->fetch(PDO::FETCH_ASSOC);

        $detail = $rows['detailsId'];
        $check = $conn->query("SELECT * FROM dns_results WHERE detailsId = '$detail' ");

        ?>
        <section class="section-body">
            <div class="row">
                <div class="col col-md col-sm">
                    <div class="card">
                        <div class="card-header">
                            Request
                        </div>
                        <div class="card-body">0</div>
                    </div>
                </div>

                <div class="col col-md col-sm">
                    <div class="card">
                        <div class="card-header">
                            Human Request
                        </div>
                        <div class="card-body">0</div>
                    </div>
                </div>

                <div class="col col-md col-sm">
                    <div class="card">
                        <div class="card-header">
                            BandWidth
                        </div>
                        <div class="card-body">0</div>
                    </div>
                </div>

                <div class="col col-md col-sm">
                    <div class="card">
                        <div class="card-header">
                            Request passed to origin
                        </div>
                        <div class="card-body">0</div>
                    </div>
                </div>

                <div class="col col-md col-sm">
                    <div class="card">
                        <div class="card-header">
                            Request from cache
                        </div>
                        <div class="card-body">0</div>
                    </div>
                </div>

                <div class="col col-md col-sm">
                    <div class="card">
                        <div class="card-header">
                            Request Blocked
                        </div>
                        <div class="card-body">0</div>
                    </div>
                </div>

                <div class="col col-md col-sm">
                    <div class="card">
                        <div class="card-header">
                            Enable Waiting
                        </div>
                        <div class="card-body">0 </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">Request/sec</div>
                                <div class="card-body">
                                    <canvas id="trafficChart"></canvas>
 
                                </div>
                            </div>
                        </div>


                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">BandWidth</div>
                                <div class="card-body">
                                    <canvas id="bandwith"></canvas>

                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">Response Time</div>
                                <div class="card-body">
                                    <canvas id="response"></canvas>

                                </div>
                            </div>
                        </div>

                    </div>
                    

                </div>

                <div class="col-6">
                    <div class="card">
                        <div class="card-header">Site Details</div>
                        <div class="card-body table-responsive"> 
                            <table class="table">
                                <tr>
                                    <td>Record type</td>
                                    <td>Record Value</td>
                                    <td>mname</td>
                                    <td>rname</td>
                                    <td>serial</td>
                                    <td>refresh</td>
                                    <td>retry</td>
                                    <td>expire</td>
                                </tr>
                                <?php
                                    while($rowing = $check->fetch()){
                                        echo '<tr>
                                        <td>'.$rowing['record_type'].'</td>
                                        <td>'.$rowing['value'].'</td>
                                        <td> - </td>
                                        <td> - </td>
                                        <td> - </td>
                                        <td> - </td>
                                        <td> - </td>
                                        <td> - </td>
                                        </tr>';
                                    }

                                    echo '<tr>
                                        <td>'.$rows['record_type'].'</td>
                                        <td> - </td>
                                        <td>'.$rows['mname'].'</td>
                                        <td>'.$rows['rname'].'</td>
                                        <td>'.$rows['serial'].'</td>
                                        <td>'.$rows['refresh'].'</td>
                                        <td>'.$rows['retry'].'</td>
                                        <td>'.$rows['expire'].'</td>
                                        <td>'.$rows['ttl'].'</td>
                                    </tr>'
                                    // echo 
                                ?>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </section>

      <?php
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
                setTimeout(() => {
                    location.reload(true);
                }, 5000);

            } catch (error) {
                console.log('Error:', error)
            }
         
        })
        
         
    })
    
function fetchDataAndRenderChart() {
    fetch('generate_traffic.php')
        .then(response => response.json())
        .then(data => {
            console.log(data)
            const labels = data.map(entry => entry.hour);
            const values = data.map(entry => entry.traffic);

            const ctx = document.getElementById('trafficChart').getContext('2d');
            if (window.chart) {
                window.chart.destroy(); // Destroy previous chart instance
            }
            window.chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Traffic Data',
                        data: values,
                        borderColor: 'rgb(75, 192, 192)',
                        tension: 0.1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

// Initial fetch and render
fetchDataAndRenderChart();


function fetchDataAndRenderChart() {
    fetch('generate_traffic.php')
        .then(response => response.json())
        .then(data => {
            console.log(data)
            const labels = data.map(entry => entry.hour);
            const values = data.map(entry => entry.traffic);

            const ctx = document.getElementById('bandwidth').getContext('2d');
            if (window.chart) {
                window.chart.destroy(); // Destroy previous chart instance
            }
            window.chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Traffic Data',
                        data: values,
                        borderColor: 'rgb(75, 192, 192)',
                        tension: 0.1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

// Initial fetch and render
fetchDataAndRenderChart();

// Update every 20 seconds
setInterval(fetchDataAndRenderChart, 20000);

</script>


<?php
include('config/dashfooter.php');
?>
