
<?php 
	  session_start();
?>
<!DOCTYPE html>
<html>
<body>
	<?php
	  // Get score from HTML form
	  $score= $_POST['score'];

	  $user = $_SESSION["user"];

	  // echo "Favorite color is " . $_SESSION["user"] . ".<br>";
	  // Connect to database

	  DEFINE('DB_USERNAME', 'root');
	  DEFINE('DB_PASSWORD', 'root');
	  DEFINE('DB_HOST', 'localhost:3306');
	  DEFINE('DB_DATABASE', 'leaderboarddb');

	  $conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

	  if ($conn -> connect_errno) {
	    echo "Failed to connect: " . $conn->connect_error;
	    exit();
	  }

	 // echo 'Connected successfully.';
	
	// Insert values into database

	$sql = "INSERT INTO `leaderboard`(`user`, `score`) VALUES (\"$user\", $score )";

	if ($conn->query($sql) === TRUE) {
	  echo "New record created successfully";
	} else {
	  echo "Error: " . $sql . "<br>" . $conn->error;
	}
	 
	//echo $score

	// Close connection

	$conn->close();
?>
</body>
</html>