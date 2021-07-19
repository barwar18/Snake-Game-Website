<?php
    $user = $_POST["uname"];
    if(!isset($user))
    {
        header("Location: index.html"); // Forces users back to homepage if they haven't entered a username
    }
?>

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
        <!-- <nav class = "navbar navbar-inverse">
            <div class = "container-fluid">
                <div class = "navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>                        
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class = "nav navbar-nav">
                        <li><a href="index.html">Home</a></li>
                        <li class="active"><a href="gamePage.html">Snake Game</a></li>
                        <li><a href="scores.html">Top Scores</a></li>
                    </ul>
                </div>
            </div>
        </nav> -->
        <div class = "container">
            <div class = "row centered">
                <div class = "col-xs-12">
                <h4><?php echo $user ?></h4> <!-- Retrieve from php file -->
            </div>
            <div class = "row centered">
                <div class = "col-xs-12">
                    <div id ='score'>0</div>
                    <canvas id="snakeboard" width="400" height="400"></canvas>
                    
                    <script>
                        const board_border = 'black';
                        const board_background = "white";
                        const snake_col = 'lightblue';
                        const snake_border = 'darkblue';
                        
                        let snake = [
                          {x: 200, y: 200},
                          {x: 190, y: 200},
                          {x: 180, y: 200},
                          {x: 170, y: 200},
                          {x: 160, y: 200}
                        ]
                        
                        let dx = 10;
                        let dy = 0;
                        
                        let food_x;
                        let food_y;
                        
                        let score = 0;
                        
                        
                        const snakeboard = document.getElementById("snakeboard");
                    
                        const snakeboard_ctx = snakeboard.getContext("2d");
                        
                        main();
                        
                        generate_food();
                       
                        document.addEventListener("keydown", change_direction);
                    
                        
                        function main() {
                          
                              if(has_game_ended())
                            {
                              return;
                            }
                          
                            setTimeout(function onTick() {
                            clear_board();
                            move_snake();
                            drawSnake();
                            drawFood();
                            main();
                          }, 100)
                        }
                        
                        function clear_board() {
                    
                          snakeboard_ctx.fillStyle = board_background;
                          snakeboard_ctx.strokestyle = board_border;
                          snakeboard_ctx.fillRect(0, 0, snakeboard.width, snakeboard.height);
                          snakeboard_ctx.strokeRect(0, 0, snakeboard.width, snakeboard.height);
                        }
                        
                    
                        function drawSnake() {
                    
                          snake.forEach(drawSnakePart)
                        }
                        
                    
                        function drawSnakePart(snakePart) {
                          snakeboard_ctx.fillStyle = snake_col;
                          snakeboard_ctx.strokestyle = snake_border;
                          snakeboard_ctx.fillRect(snakePart.x, snakePart.y, 10, 10);
                          snakeboard_ctx.strokeRect(snakePart.x, snakePart.y, 10, 10);
                        }
                    
                        function move_snake() {
                          const head = {x: snake[0].x + dx, y: snake[0].y + dy};
                          
                          snake.unshift(head);
                          
                          const has_eaten_food = snake[0].x === food_x && snake[0].y === food_y;
                          
                          if(has_eaten_food)
                          {
                            generate_food();
                            score++;
                            document.getElementById('score').innerHTML = score;
                          } else
                          {
                            snake.pop();
                          }
                          
                        }
                        
                        
                        function change_direction(event)
                        {
                          const LEFT_KEY = 37;
                          const RIGHT_KEY = 39;
                          const UP_KEY = 40;
                          const DOWN_KEY = 38;
                          
                          const keyPressed = event.keyCode;
                          const goingUp = dy === 10;
                          const goingDown = dy ===-10;
                          const goingRight = dx === 10;
                          const goingLeft = dx === -10;
                          
                          if(keyPressed === LEFT_KEY && !goingRight)
                          {
                            dx = -10;
                            dy = 0;
                          }
                          
                          if(keyPressed === RIGHT_KEY && !goingLeft)
                          {
                            dx = 10;
                            dy = 0;
                          }
                          
                          if(keyPressed === UP_KEY && !goingDown)
                          {
                            dy = 10;
                            dx = 0;
                          }
                          
                          if(keyPressed === DOWN_KEY && !goingUp)
                          {
                            dy = -10;
                            dx = 0;
                          }
                          
                          
                          
                        }
                        
                        function has_game_ended()
                        {
                          for(let i = 4; i < snake.length; i++)
                          {
                            const has_collided = snake[i].x === snake[0].x && snake[i].y === snake[0].y;
                            if(has_collided){
                              return true;
                            }
                          }
                          
                          const hitLeftWall = snake[0].x < 0;
                          const hitRightWall = snake[0].x > snakeboard.width -10;
                          const hitTopWall = snake[0].y < 0;
                          const hitBottomWall = snake[0].y > snakeboard.height -10;
                          
                          return hitLeftWall || hitRightWall || hitTopWall || hitBottomWall;
                        }
                        
                        function randomize_food(min,max)
                        {
                          return Math.round((Math.random()*(max-min)+min)/10)*10;
                        }
                        
                        function generate_food()
                        {
                          food_x = randomize_food(0,snakeboard.width - 10);
                          food_y = randomize_food(0,snakeboard.height - 10);
                          snake.forEach(function has_snake_eaten_food(part)
                          {
                            const has_eaten = part.x === food_x && part.y === food_y;
                            if(has_eaten)
                            {
                              generate_food();
                            }
                          })
                            
                        }
                        
                        function drawFood()
                        {
                          snakeboard_ctx.fillStyle = 'red';
                          snakeboard_ctx.strokeStyle = 'black';
                          snakeboard_ctx.fillRect(food_x,food_y,10,10);
                          snakeboard_ctx.strokeRect(food_x,food_y,10,10);
                        }
                        
                        
                      </script>
                </div>
            </div>
            <div class = "row centered">
                <div class = "col-xs-12">
                    <a href = "index.html"><button class="btn btn-default"><span class = "glyphicon glyphicon-arrow-left"></span> <b>Back to Home</b></button></a>
                    <a href = "scores.html"><button class="btn btn-default"><b>Top ___ Scores</b> <span class = "glyphicon glyphicon-arrow-right"></span></button></a>
                </div>
            </div>
        </div>
    </div>
</body>