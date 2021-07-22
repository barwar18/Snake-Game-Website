<!DOCTYPE html>
<html>
<head>
<title> Pass1 </title>
</head>
<body>

<!-- Already in gamepage.php 
<script>
  let score = 71
</script>
-->

<!-- Create hidden & read only HTML form to submit with javascript - sends score variable to PHP file -->

 <form action="recordscore.php" id="inputform" method="post">
  <label for="score"></label>
  <input type="text" id="scoreinput" name="score" readonly hidden><br><br>
  <input type="submit" value="Submit Score" hidden>
</form> 


<!-- Button to submit score -->
<div id="submitscore"
     style="text-align: right; width: 100%; background-color: white;">
    <button type="submit"
            class='input_submit'
            style="margin-right: 15px;"
            onClick="submitscore()">Submit Score
    </button>
</div>

<script>
  // Call this function to set the form field to the score variable and submit it
  function submitscore() {
  // Set input in the HTML form to the score variable
  document.getElementById("scoreinput").value = score;
  // Submit the form 
  document.getElementById("inputform").submit();
  }
  
</script>

</body>
</html>