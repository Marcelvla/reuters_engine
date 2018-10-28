
<html>
<body>
  <!-- <script type="text/javascript" src="testdata.json"></script> -->
  <!--  Following array simulates a PHP request for testing purposes.-->
  <?php
    $php_dates = array("12 NOV 1955", "10 JUN 1961", "05 APR 1959", "11 SEP 2001", "21 AUG 1955");
  ?>

  <script type="text/javascript">
    var js_dates = <?php echo json_encode($php_dates); ?>;
    // document.getElementById("yo").innerHTML =js_dates[1];
    var js_counts = {};
    var date_len = js_dates.length;
    // Makes a counttable of every date from the results of the query.
    for( var i=0; i<date_len; i++ ){
      if (js_dates[i] in js_counts) {
        js_counts[js_dates[i]] += 1;
      } else {
        js_counts[js_dates[i]] = 1;
      }
    }
    // Takes the keys and values as a list.
    var key_dates = Object.keys(js_counts);
    var value_dates = Object.values(js_counts);
    var datelist = [];
    // Turn the date strings into usable Date objects.
    for( var i=0; i<key_dates.length; i++ ){
      datelist[i] = { x: new Date(key_dates[i]), y: value_dates[i] };
    }
    // Sort by date.
    datelist.sort(function(a,b){
      return a.x - b.x;
    });
    key_dates = datelist.map(function(dd){return dd.x;});
    // Make labels for the dates in the DD-MM format.
    datelabels = key_dates.map(function(el){ var day = el.getDate();
                                            var mon = el.getMonth() +1;
                                            return day + '-' + mon});
  </script>

  <canvas id="timeline" width=800, height=200></canvas>
  <script src="./node_modules/chart.js/dist/Chart.js"></script>
  <script>
  var ctx = document.getElementById("timeline");
  var timeline = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: datelabels,
      datasets: [{
        label: 'N results per year:',
        data: datelist,
        backgroundcolor: 'rgba(165, 232, 255)',
        borderColor: 'rgba(89, 165, 191)',
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
        type: 'time',
        time: {
          displayFormats: {
            day: 'MMM D'
          }
        },
        distribution: 'series',
        categoryPercentage: 0.3,
        barPercentage: 0.9,
        barThickness: 3,
      }
    }
  })
  </script>
</body>
</html>
