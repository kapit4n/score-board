
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Hello World</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    </head>    <body>
        <h1>Hello World</h1>
        <p>
          <?php
require_once 'username.php';
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
	die("Connetion failed" . $conn->connect_error);
}

echo 'inside the function1';
$sql0 = "SELECT score_id, score_value, team_id FROM score";
echo 'inside the function1';
$result = $conn->query($sql0);
echo 'inside the function2';
if ($result->num_rows > 0) {
	echo "<table class='table table-condensed' >";
	echo "<thead> <tr> <th>Team Id</th> <th>Score</th> </tr> </thead> <tbody>";
	while ($row = $result->fetch_assoc()) {
		echo "<tr><td>" . $row["team_id"] . " </td><td>" . $row["score_value"] . " " . "</td></tr>";
	}
	echo "</table>";
	echo 'inside the function3';
} else {
	echo 'inside the function4';
	print_r($result);
	echo "0 results";
}

echo '
<form name="form1" method="post" action="">
  <p>
    <label>
      <input type="text" name="team" id="team">
    </label>
  </p>

  <p>
    <label>
      <input type="text" name="score" id="score">
    </label>
  </p>
  <p>
    <label>
      <input type="submit" name="button" id="button" value="Register match">
    </label>
  </p>
</form>';

if (isset($_POST['team'])) {
	echo 'inside the post';
	echo $_POST["team"];
	$sql = "INSERT INTO score (team_id, score_value)
  VALUES ('" . $_POST["team"] . "', '" . $_POST["score"] . "')";
	if (mysqli_query($conn, $sql)) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
}

?>
        </p>
    </body>
</html>

