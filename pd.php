<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>weather</title>
</head>
<title>Weather Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image:url(weather.gif);
            margin: 0;
            padding: 0;
            /*display: flex;
            justify-content: center;
            align-items: center;*/
            min-height: 100vh;
        }
        
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color:white;
        }
        
        table {
            width: 80%;
            border-collapse: collapse;
            background-color:black;
            color:white;
            box-shadow: 0px 0px 10px white;
            margin: auto;
        }
        
        th, td {
            padding: 12px 15px;
            text-align: left;
        }
        
        th {
            background-color:black;
            color:white;
        }
    </style>
<body>
<?php
include "store.php";
// Create the connection
$serverName="localhost";
$username="root";
$password="";
$dbname="weather";
$conn = mysqli_connect($serverName,$username,$password,$dbname);
if (!$conn) {
    die("Connection failed: ". mysqli_connect_error());
}
$query = "SELECT * FROM weather_data";
$result = mysqli_query($conn, $query);

// Check if any data was retrieved
if (mysqli_num_rows($result) > 0) {
    // Fetch all rows and store them in an array
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // Output an HTML table
    echo "<h1>Gulariya's Past Weather Data</h1>";
    echo "<table>";
    echo "<tr><th>Date</th><th>Description</th><th>Temperature</th><th>Wind</th><th>Humidity</th><th>Pressure</th></tr>";

    foreach ($rows as $row) {
        echo "<tr>";
        echo "<td>" . $row['Date'] . "</td>";
        echo "<td>" . $row['Description'] . "</td>";
        echo "<td>" . $row['Temperature'] . "</td>";
        echo "<td>" . $row['Wind'] . "</td>";
        echo "<td>" . $row['Humidity'] . "</td>";
        echo "<td>" . $row['Pressure'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No data found";
}

// Close the database connection
mysqli_close($conn);
?>
</body>
</html>