<?php
session_start();
include('config/session.php');
include('config/head.php');
include('config/navbar.php');


?>
  <div class="main-content">
        <section class="section">
          <div class="section-body">
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

                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">Bot Attack</div>
                                <div class="card-body">
                                    <canvas id="response"></canvas>

                                </div>
                            </div>
                        </div>


                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">Bot Request</div>
                                <div class="card-body">
                                    <canvas id="response"></canvas>

                                </div>
                            </div>
                        </div>

                    </div>
        </div>
        </section></div>


        <script>
          function fetchDataAndRenderChart1() {
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
fetchDataAndRenderChart1();
setInterval(fetchDataAndRenderChart, 20000);

        </script>
<?php
include('config/dashfooter.php');
?>