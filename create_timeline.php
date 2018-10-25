
<html>
<body>
  <!-- <script type="text/javascript" src="testdata.json"></script> -->
  <?php
    $php_dates = array("1955", "1961", "1959", "1965", "1951", "1954", "1962",
    "1952", "1935", "1946", "1961", "1926", "1925", "1932", "1980", "1920",
    "1923", "1955", "1950", "1932");
  ?>

  <script type="text/javascript">
    var js_dates = <?php echo json_encode($php_dates); ?>;
    document.getElementById("yo").innerHTML =js_dates[1];
    var js_counts = {};
    var date_len = js_dates.length;
    for (var i = 0; i < date_len; i++ ){
      if (js_dates[i] in js_counts) {
        js_counts[js_dates[i]] += 1;
      } else {
        js_counts[js_dates[i]] = 1;
      }
    }
    var key_dates = Object.keys(js_counts);
    var value_dates = Object.values(js_counts);
  </script>

  <h2>Nice graph</h2>
  <canvas id="timeline" width=800, height=200></canvas>
  <script src="./node_modules/chart.js/dist/Chart.js"></script>
  <script>

  var ctx = document.getElementById("timeline");
  var timeline = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: key_dates,
      xAxisID: 'Years',
      datasets: [{
        label: 'Amount of results per year',
        data: value_dates,
        backgroundColor:'rgba(200, 0, 0)',
        borderColor: 'rgba(255, 0, 0)',
        borderWidth: 1
      }]
    },
    options: {
      layout: {
        padding: {
          'left': 20,
          'right': 40,
          'top': 20,
          'bottom': 10
        }
      },
      responsive: 0,
      scales: {
        xAxes: [{
          categoryPercentage: 0.3,
          barPercentage: 0.9,
          // barThickness: 3,
          ticks: {
            gridLines: {
                offsetGridLines: true

          }
        }}],
        yAxes: [{
          ticks: {
            beginAtZero:true
          }
        }]
      }
    }
  });
  </script>
</body>
</html>
