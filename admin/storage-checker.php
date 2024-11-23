<?php
            $got_storage = 0;
                    $size = 0;
                
                    foreach (glob(rtrim("../static/", '/').'/*', GLOB_NOSORT) as $each) {
                        $size += is_file($each) ? filesize($each) : 0;
                    }
                    $got_storage = ceil($size/(1024*1024));
                    $filled = 5000 - ($got_storage+40);
            
            ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, 
								initial-scale=1.0">
	<title></title>
	<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>

<body>
	<?php
        echo "
                
        <div>
		<h1 style='color:green;'>
			
		</h1>
		<h3>
			
		</h3>
		<div id='chart'>
		</div>
	</div>
   
	<script>
		var options = {
          series: [{$got_storage}, {$filled}],
          chart: {
          width: 380,
          type: 'polarArea'
        },
        labels: ['Xotiradan foydalanish', 'Bo\'sh joy'],
        fill: {
          opacity: 1
        },
        stroke: {
          width: 1,
          colors: undefined
        },
        yaxis: {
          show: false
        },
        legend: {
          position: 'bottom'
        },
        plotOptions: {
          polarArea: {
            rings: {
              strokeWidth: 0
            },
            spokes: {
              strokeWidth: 0
            },
          }
        },
        theme: {
          monochrome: {
            enabled: true,
            shadeTo: 'light',
            shadeIntensity: 0.6
          }
        }
        };

        var chart = new ApexCharts(document.querySelector('#chart'), options);
        chart.render();
	</script>
        
        ";
    
    ?>
</body>

</html>
