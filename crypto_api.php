<?php
// Define the API endpoint and API key
$api_endpoint = "https://min-api.cryptocompare.com/data/";
$api_key = "<9931be8eebb68441904786bbfe4986a356adecb6f16477b2537e10ba54e86955>";

// Define the cryptocurrencies to display
$cryptocurrencies = array("BTC", "ETH", "XRP");

// Define the number of data points to retrieve for the chart
$data_points = 30;

// Loop through each cryptocurrency and retrieve its historical price data
foreach ($cryptocurrencies as $crypto) {
  // Define the API URL for retrieving historical price data
  $api_url = "{$api_endpoint}v2/histoday?fsym={$crypto}&tsym=USD&limit={$data_points}&api_key={$api_key}";

  // Retrieve the JSON data from the API
  $json_data = file_get_contents($api_url);

  // Decode the JSON data into an associative array
  $data = json_decode($json_data, true);

  // Extract the price data from the associative array
  $price_data = array();
  foreach ($data["Data"] as $point) {
    $price_data[] = array(strtotime($point["time"]) * 1000, $point["close"]);
  }

  // Output the trading chart for the cryptocurrency using Highcharts
  echo "
  <div id='{$crypto}-chart'></div>
  <script>
    Highcharts.chart('{$crypto}-chart', {
      chart: {
        zoomType: 'x'
      },
      title: {
        text: '{$crypto}/USD Price Chart'
      },
      xAxis: {
        type: 'datetime'
      },
      yAxis: {
        title: {
          text: 'Price (USD)'
        }
      },
      legend: {
        enabled: false
      },
      plotOptions: {
        area: {
          fillColor: {
            linearGradient: {
              x1: 0,
              y1: 0,
              x2: 0,
              y2: 1
            },
            stops: [
              [0, Highcharts.getOptions().colors[0]],
              [1, Highcharts.color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
            ]
          },
          marker: {
            radius: 2
          },
          lineWidth: 1,
          states: {
            hover: {
              lineWidth: 1
            }
          },
          threshold: null
        }
      },

      series: [{
        type: 'area',
        name: '{$crypto}/USD',
        data: " . json_encode($price_data) . "
      }]
    });
  </script>
  ";
}
?>
