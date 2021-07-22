<!DOCTYPE html>
<html>
<head>
	<title>Leaderboard</title>
</head>
<body>	
<?php
	
	  DEFINE('DB_USERNAME', 'root');
	  DEFINE('DB_PASSWORD', 'root');
	  DEFINE('DB_HOST', 'localhost:3306');
	  DEFINE('DB_DATABASE', 'leaderboarddb');

	  $conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

	  if ($conn -> connect_errno) {
	    echo "Failed to connect: " . $conn->connect_error;
	    exit();
	  }

	if ($result = $conn -> query("SELECT * FROM leaderboard ORDER BY score DESC")) {
		// $result -> free_result();
		// $result = $conn->query($sql);

			if ($result > 0) {
			  // output data of each row
			  while($row = $result->fetch_assoc()) {
			    echo "User: ". $row['user']. " Score: ". $row['score']. "<br>";
			  }
			} else {
			  echo "0 results";
			}
			
		}

	$conn->close();
?>
</body>
</html>
