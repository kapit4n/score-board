
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
        <div class="container">


          <?php
require_once 'username.php';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
	die("Connetion failed" . $conn->connect_error);
}

$sql0 = "SELECT match_id, visitor_team, visitor_score, local_team, local_score, match_date FROM team_match ORDER BY match_date DESC";
$sql1 = "SELECT id, name, logo FROM team";

$result = $conn->query($sql0);
$result1 = $conn->query($sql1);

$teamMapAux = array();

$options = "";

updateAuxValues($result1, $options, $teamMapAux);

echo '
<form name="form1" method="post" action=""  action="" role="form">

  <div class="form-group">
    <label  for="local_team">
      visitor team </label>
       <select type="text" name="local_team" id="local_team" class="form-control" >
        ' . $options . '
      </select>

  </div>

  <div class="form-group">
    <label  for="local_score"> visitor score </label>
      <input type="text" name="local_score" id="local_score" class="form-control" >

  </div>

  <div class="form-group">
    <label  for="visitor_team">
      local team </label>
      <select type="text" name="visitor_team" id="visitor_team" class="form-control" >
        ' . $options . '
      </select>

  </div>

  <div class="form-group">
    <label  for="visitor_score"> local score </label>
      <input type="text" name="visitor_score" id="visitor_score" class="form-control" >

  </div>
  <button type="submit" class="btn btn-default">Register Match</button>
</form>';

echo '<h1>Match</h1>';

if ($result->num_rows > 0) {
	echo "<table class='table table-condensed' >";
	echo "<thead> <tr> "
	. " <th style='background-color: black; color: white;'>Id</th> "
	. " <th style='background-color: black; color: white;'>Local</th> "
	. " <th style='background-color: black; color: white;'>Score</th> "
	. " <th style='background-color: black; color: white;'>Visitor</th> "
	. " <th style='background-color: black; color: white;'>Score</th> "
	. " <th style='background-color: black; color: white;'>Date</th> "
	. "</tr> </thead> <tbody>";
	while ($row = $result->fetch_assoc()) {
		echo "<tr>"
		. "<td>" . $row["match_id"] . " </td> "
		. "<td>" . $teamMapAux[$row["local_team"]] . "</td> "
		. "<td>" . $row["local_score"] . "</td> "
		. "<td>" . $teamMapAux[$row["visitor_team"]] . "</td> "
		. "<td>" . $row["visitor_score"] . "</td> "
		. "<td>" . $row["match_date"] . "</td> "
		. "</tr>";
	}
	echo "</table>";
	echo 'inside the function3';
} else {
	echo 'inside the function4';
	print_r($result);
	echo "0 results";
}

if (isset($_POST['local_score'])) {
	echo 'inside the post';
	echo $_POST["local_team"];
	echo $_POST["visitor_team"];
	$sql = "INSERT INTO team_match (visitor_team, visitor_score, local_team, local_score)
VALUES ('" . $_POST["visitor_team"] . "', '" . $_POST["visitor_score"] . "', '" . $_POST["local_team"] . "', '" . $_POST["local_score"] . "')";
	if (mysqli_query($conn, $sql)) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
}

function updateAuxValues($resultParam, &$options, &$teamMapAux) {
	while ($row = $resultParam->fetch_assoc()) {
		echo 'inside te update Aux While';
		$options = $options . '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
		$teamMapAux[$row["id"]] = $row["name"];
	}
}

?>
        </div>
    </body>
</html>

