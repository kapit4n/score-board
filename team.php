<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Team</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    </head>    <body>
        <div class="container">
<?php
require_once 'username.php';

echo '
<form name="form1" method="post" action="" role="form">
  <div class="form-group">
    <label for="name">
      Team Name
    </label>
    <input class="form-control" type="text" name="name" id="name" placeholder="Team name">
  </div>

  <div class="form-group">
    <label for="logo"> Team Logo URL </label>
    <input type="text" class="form-control" name="logo" id="logo" placeholder="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Club_Jorge_Wilstermann.svg/2000px-Club_Jorge_Wilstermann.svg.png">
  </div>
  <button type="submit" class="btn btn-default">Register Team</button>
</form>';

echo '<h1>Team List</h1>';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
	die("Connetion failed" . $conn->connect_error);
}

$sql0 = "SELECT id, name, logo FROM team ORDER BY name DESC";

$result = $conn->query($sql0);
if ($result->num_rows > 0) {
	echo "<table class='table table-condensed' >";
	echo "<thead> <tr> "
	. "<th style='background-color: black; color: white;'>Team Id</th> "
	. " <th style='background-color: black; color: white;'>Local Name</th>  "
	. "<th style='background-color: black; color: white;'>Logo</th> "
	. "</tr> </thead> <tbody>";
	while ($row = $result->fetch_assoc()) {
		echo "<tr>"
		. "<td>" . $row["id"] . " </td> "
		. "<td>" . $row["name"] . "</td> "
		. "<td> <img src='" . $row["logo"] . "' height='30' ></td> "
		. "</tr>";
	}
	echo "</table>";
} else {
	echo "0 results";
}

if (isset($_POST['name'])) {
	$sql = "INSERT INTO team (name, logo) VALUES ('" . $_POST["name"] . "', '" . $_POST["logo"] . "')";
	if (mysqli_query($conn, $sql)) {
		echo "New team created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
}

?>
        </div>
    </body>
</html>

