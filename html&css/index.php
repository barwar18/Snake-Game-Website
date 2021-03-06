<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Snake Game</title>
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
            <div class = "row">
                <div class = "col-xs-12">
                    <div class = "jumbotron">
                        <h1>The Snake Game</h1>
                    </div>
                </div>
            </div>
            <div class = "row">
                <div class = col-sm-6>
                    <p class = "overview">The objective of The Snake Game is to collect the apples (small red dots) by adjusting the direction of the snake. As you eat more apples, the snake will get longer. You can't run into
                        another part of the snake or the game border or the game will end.
                    </p>
                </div>
                <div class = "col-sm-6 centered">
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
										while(($row = $result->fetch_assoc()) && $rank <= 5) {
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
                    <a href = "leaderboard.php"><button class="btn btn-info"><b>Scores</b> <span class = "glyphicon glyphicon-arrow-right"></span></button></a>
                </div>
            </div>
            <div  id = "playGame" class = "row centered">
                <div class = "col-sm-4"></div>
                <div class = "col-sm-4 login">
                    <h4>Enter a Username</h4>
                    <form action = "gamePage.php" method = "post">
                        <div class="form-group">
                          <input type="text" class="form-control" placeholder="Username" name = "uname" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Play Game</button>
                    </form>
                </div>
                <div class = "col-sm-4"></div>
            </div>
            <hr>
            <div class = "row centered">
                <div class = "col-xs-12">
                    <h1>Directions</h1>
                </div>
            </div>
            <span class = "directions overview">
                <div class = "row">
                    <div class = "col-xs-8">
                        <p>This is the game window. You control the light-blue chain of boxes, called the snake.</p>
                    </div>
                    <div class = "col-xs-4">
                        <img src = "images/loadIn.png" alt = "Game window after loading in" />
                    </div>
                </div>
                <div class = "row">
                    <div class = "col-xs-8">
                        <p>Use the arrow keys to change the snake's direction to run into the red dots, called apples.</p>
                    </div>
                    <div class = "col-xs-4">
                        <img src = "images/collectApples.png" alt = "Snake about to collect an apple" />
                    </div>
                </div>
                <div class = "row">
                    <div class = "col-xs-8">
                        <p>As you collect apples your score will increase. Your score is displayed above the playing area.</p>
                    </div>
                    <div class = "col-xs-4">
                        <img src = "images/score.png" alt = "Playing window with score visible" />
                    </div>
                </div>
                <div class = "row">
                    <div class = "col-xs-8">
                        <p>Hitting the edge of the playing area will end the game.</p>
                    </div>
                    <div class = "col-xs-4">
                        <img src = "images/hittingWall.png" alt = "Snake hitting a wall" />
                    </div>
                </div>
                <div class = "row">
                    <div class = "col-xs-8">
                        <p>Running into your tail will also end the game.</p>
                    </div>
                    <div class = "col-xs-4">
                        <img src = "images/hittingTail.png" alt = "Snake running into its tail" />
                    </div>
                </div>
            </span>
            <div class = "row centered bottom">
                <div class = "col-xs-12">
                    <a href = "#playGame"><button class = "btn btn-primary">Play Game</button></a>
                </div>
            </div>
        </div>
    </body>
</html>