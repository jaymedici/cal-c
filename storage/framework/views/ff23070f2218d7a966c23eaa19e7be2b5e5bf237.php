<div class="container">
   <div class="row">
   <div class="card card-success col-md-6">
        <div class="card-header">
            <h4 class="card-title"><?php echo e($project->name); ?> Project Visit Status Chart/Graph</h4>
        </div>
        <div class="card-body">
           <canvas id="barChart" class="rounded shadow"></canvas>
        </div>
    </div>

    <div class="card card-success col-md-6">
        <div class="card-header">
            <h4 class="card-title"><?php echo e($project->name); ?> Project, Pending and On Window Visit Status Chart/Graph</h4>
        </div>
        <div class="card-body">
           <canvas id="powChart" class="rounded shadow"></canvas>
        </div>
    </div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

<script>
    var ctx = document.getElementById('barChart').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',
// The data for our dataset
        data: {
            labels:  <?php echo json_encode($chart->labels); ?> ,
            datasets: [
                {
                    label: 'Count of Visits status',
                    backgroundColor: <?php echo json_encode($chart->colours); ?> ,
                    data:  <?php echo json_encode($chart->dataset); ?> ,
                },
            ]
        },
// Configuration options go here
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        callback: function(value) {if (value % 1 === 0) {return value;}}
                    },
                    scaleLabel: {
                        display: false
                    }
                }]
            },
            legend: {
                labels: {
                    // This more specific font property overrides the global property
                    fontColor: '#122C4B',
                    fontFamily: "'Muli', sans-serif",
                    padding: 25,
                    boxWidth: 25,
                    fontSize: 14,
                }
            },
            layout: {
                padding: {
                    left: 10,
                    right: 10,
                    top: 0,
                    bottom: 10
                }
            }
        }
    });
</script>   





<script>
    var ctx = document.getElementById('powChart').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',
// The data for our dataset
        data: {
            labels:  <?php echo json_encode($chart1->labels); ?> ,
            datasets: [
                {
                    label: 'Count of Visits status',
                    backgroundColor: <?php echo json_encode($chart1->colours); ?> ,
                    data:  <?php echo json_encode($chart1->dataset); ?> ,
                },
            ]
        },
// Configuration options go here
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        callback: function(value) {if (value % 1 === 0) {return value;}}
                    },
                    scaleLabel: {
                        display: false
                    }
                }]
            },
            legend: {
                labels: {
                    // This more specific font property overrides the global property
                    fontColor: '#122C4B',
                    fontFamily: "'Muli', sans-serif",
                    padding: 25,
                    boxWidth: 25,
                    fontSize: 14,
                }
            },
            layout: {
                padding: {
                    left: 10,
                    right: 10,
                    top: 0,
                    bottom: 10
                }
            }
        }
    });
</script>   

<?php /**PATH C:\xampp\htdocs\Visitcallender\resources\views/charts/projectDataChart.blade.php ENDPATH**/ ?>