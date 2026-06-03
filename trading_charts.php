<?php
// connect to the database
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'login_register';
$conn = mysqli_connect($host, $username, $password, $dbname);
if (!$conn) {
    die('Could not connect: ' . mysqli_connect_error());
}

// retrieve the available cryptocurrencies
$crypto_query = "SELECT DISTINCT cryptocurrency FROM crypto_prices";
$crypto_result = mysqli_query($conn, $crypto_query);
$cryptocurrencies = array();
while ($row = mysqli_fetch_assoc($crypto_result)) {
    $cryptocurrencies[] = $row['cryptocurrency'];
}

// retrieve the historical price data for the selected cryptocurrency
if (isset($_GET['cryptocurrency'])) {
    $selected_crypto = $_GET['cryptocurrency'];
    $price_query = "SELECT timestamp, price FROM crypto_prices WHERE cryptocurrency='$selected_crypto' ORDER BY timestamp ASC";
    $price_result = mysqli_query($conn, $price_query);
    $price_data = array();
    while ($row = mysqli_fetch_assoc($price_result)) {
        $timestamp = strtotime($row['timestamp']) * 1000;
        $price = floatval($row['price']);
        $price_data[] = array($timestamp, $price);
    }
}

// close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Trading Charts</title>
    <!-- include the Highcharts library -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <!-- include the jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // initialize the chart
        var chart;
        $(document).ready(function() {
            chart = Highcharts.stockChart('container', {
                rangeSelector: {
                    selected: 1
                },
                title: {
                    text: '<?php echo isset($selected_crypto) ? $selected_crypto : "Select a Cryptocurrency"; ?>'
                },
                xAxis: {
                    type: 'datetime'
                },
                yAxis: {
                    title: {
                        text: 'Price'
                    }
                },
                series: [{
                    name: '<?php echo isset($selected_crypto) ? $selected_crypto : ""; ?>',
                    data: <?php echo isset($price_data) ? json_encode($price_data) : "[]"; ?>,
                    tooltip: {
                        valueDecimals: 2
                    }
                }]
            });
        });
        // update the chart when a cryptocurrency is selected
        function selectCrypto(crypto) {
            $.ajax({
                url: "trading_chart.php",
                data: { cryptocurrency : crypto },
                success: function(data) {
                    chart.setTitle({ text: crypto });
                    chart.series[0].setData(JSON.parse(data));
                }
            });
        }
    </script>
   <style>
        /* customize the look of the chart container */
        #container {
            height: 400px;
            min-width: 310px;
            max-width: 800px;
            margin: 0 auto;
        }
        /* customize the look of the cryptocurrency selector */
        #cryptocurrency {
            display: inline-block;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            cursor: pointer;
        }
        #cryptocurrency option {
            padding: 5px;
        }
    </style>
</head>
