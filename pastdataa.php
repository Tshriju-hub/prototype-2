<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    body {
        font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-image: url(weatheer.gif);
        }
    h1 {
        text-align: center;
        margin:5px auto;
        color:White;
        text-shadow:0 3px 10px black;
        }
    .weather-card {
        border: 1px solid white;
        border-radius: 30px;
        box-shadow: 0 3px 10px rgb(255, 255, 255);
        background-color:black;
        padding: 20px;
        margin: 10px;
        width: 300px;
        display: inline-block;
        color:White;
        }
    .nav{
    display: flex;
    width: 100%;
    justify-content:flex-start;
    height: 70px;
    line-height:50px;
    margin:20px;
    }
    </style>
    <title>Gulariya's Weather Data</title>
</head>
<body>
<div class=nav>
<form action="weather__2358158.html">
<button type="submit"><img src="weatherr.png" alt="Logo" width="70" height="70"></button>
 </form>
 <h1>Gulariya's Past Weather Data</h1>
</div>
<?php
include "stored.php";
$serverName = "localhost";
$username = "root";
$password = "";
$dbname = "weather";
$conn = mysqli_connect($serverName, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$query = "SELECT * FROM weatherdata";
$result = mysqli_query($conn, $query);

// Check if any data was retrieved
if (mysqli_num_rows($result) > 0) {
    // Fetch all rows and store them in an array
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // Output weather data as cards
    foreach ($rows as $row) {
        echo "<div class='weather-card'>";
        echo "<h2>" . $row['Date'] . "<br> Weather in Gulariya </h2>";
        echo "<p><strong>Description:</strong> " . $row['Description'] . "</p>";
        echo "<p><strong>Temperature:</strong> " . $row['Temperature'] . " &#8451;</p>"; // Celsius symbol
        echo "<p><strong>Wind:</strong> " . $row['Wind'] . "Km/h</p>"; // Kilometer per hour
        echo "<p><strong>Humidity:</strong> " . $row['Humidity'] . " %</p>"; // Percentage
        echo "<p><strong>Pressure:</strong> " . $row['Pressure'] . " mb</p>"; // millibar
        echo "</div>";
    } 
} else {
    echo "No data found";
}

// Close the database connection
mysqli_close($conn);
?>

</body>
</html>
