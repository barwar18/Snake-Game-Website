<!DOCTYPE html>
	<html>
		<head>
			<title>Leaderboard</title>
			<link rel="shortcut icon" type="image/x-icon" href="images/snake.png">

			<!-- Bootstrap Framework Import -->
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
			<link rel="stylesheet" type="text/css" href="style.css">
		</head>
		<body>	
			<div class = "container">
				<div class = "row centered">
					<div class = "col-xs-12 ">
						<table>
							<tr>
								<th class = "rank">Place</th>
								<th>Username</th>
								<th>Score</th>
							</tr>
							<?php
				
								DEFINE('DB_USERNAME', 'root');
								DEFINE('DB_PASSWORD', 'root');
								DEFINE('DB_HOST', 'localhost:3306');
								DEFINE('DB_DATABASE', 'leaderboarddb');
								
								$rank = 1;
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
											echo "<tr><td class = \"rank\">". $rank. "</td><td class = \"uname\">". $row['user']. "</td><td class = \" score right\">". $row['score']. "</td></tr>";
											$rank++;
										}
										} else {
										echo "0 results";
										}
										
									}

								$conn->close();
							?>
						</table>
					</div>
				</div>
				<div class = "row centered">
					<div class = "col-xs-12">
						<a href = "index.php"><button class="btn btn-info"><span class = "glyphicon glyphicon-arrow-left"></span> <b>Back to Home</b></button></a>
					</div>
				</div>
			</div>
		</body>
	</html>