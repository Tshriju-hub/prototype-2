<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
// Create the connection
$conn = mysqli_connect("localhost", "root", "", "weather");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch data from the API
$json_data = file_get_contents("https://api.openweathermap.org/data/2.5/weather?q=gulariya&appid=5e0508b3fe1d11466deb56f03a8aea50");
// Convert into JSON format
$data = json_decode($json_data, true);

// Access the data
$description = $data['weather'][0]['description'];
$date = date("y:m:d", $data['dt']); // Convert the timestamp to a formatted date
$temp_kelvin= $data['main']['temp'];
$temp=$temp_kelvin - 273.15;
$humidity = $data['main']['humidity'];
$pressure = $data['main']['pressure'];
$speed = $data['wind']['speed'];

// Query
$sql = "INSERT INTO weatherdata(`Date`,`Description`,`Temperature`,`Wind`,`Humidity`,`Pressure`) 
        VALUES ('$date', '$description', '$temp', '$speed', '$humidity', '$pressure')";

// Run the query
if (mysqli_query($conn, $sql)) {
    echo "";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}


// Close the connection
mysqli_close($conn);
    ?>
</body>
</html>
