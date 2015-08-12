
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Bolivian football</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    </head>    <body>

        <div class="container">
        <div class="jumbotron">
        <h3>Bolivian football</h3>
          <?php
require_once 'username.php';
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
	echo "Error to connect to mysql ";
	die("Connetion failed" . $conn->connect_error);
}

$sql = "SELECT id, name, total_goals, total_points, logo FROM team ORDER BY total_points DESC";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
	echo "<table class='table table-condensed' >";
	echo "<thead> <tr> "
	. " <th style='background-color: black; color: white;'>#</th> "
	. "<th style='background-color: black; color: white;'>Name</th> "
	. "<th style='background-color: black; color: white;'>Total Points</th> "
	. "<th style='background-color: black; color: white;'>Total Goals</th> "
	. "</tr> </thead> <tbody>";
	$position = 1;
	while ($row = $result->fetch_assoc()) {
		echo "<tr style='background-image: linear-gradient(#e6e6e6, #fff 20%, #fff);'>"
		. "<td>" . $position . " </td>"
		. "<td> <div style='width: 35px; display: inline-block;'> <img src='" . $row["logo"] . "' style='max-height: 30px; max-width: 30px;'> </div>" . $row["name"] . "</td> "
		. "<td> <span class='badge' style='background-color: #9f4221;'>" . $row["total_points"] . "</span></td> "
		. "<td> <span class='badge' style='background-color: green;'>" . $row["total_goals"] . "</span></td> "
		. "</tr>";
		$position++;
	}
	echo "</table>";
} else {
	print_r($result);
	echo "0 results";
}
?>
</div>
        </div>
    </body>
</html>

