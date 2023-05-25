<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Game</title>
    <link rel='stylesheet' href='css/style.css'>
</head>

<body>
    <div class='form-class'>
        <form method="post" action="">
            <label for="player1">Player 1:</label>
            <input type="number" name="player1" id="player1" min="1" max="3">
            <input type='submit' name= "p1Submit" value='submit'>
            <br>
            <label for="player2">Player 2:</label>
            <input type="number" name="player2" id="player2" min="1" max="3">
            <input type='submit' name= "p2Submit" value='submit'>
            <br>
            <input type="submit" value="Submit" name="submit">
            <input type="submit" value="Reset" name="reset">
        </form>
    </div>
    <div class='board'>
        <h3>The board goes here: </h3>
        <br />
        <div class="main-board">
            <?php
            if (array_key_exists('submit', $_POST))
                include 'game.php';
            if (array_key_exists('reset', $_POST)) {
                $file = fopen("positions.txt", "w+");
                fwrite($file, "0" . PHP_EOL);
                fwrite($file, "0" . PHP_EOL);
                fclose($file);
            }

            if(array_key_exists('p1Submit', $_POST)){
                include 'moveP1.php';
            }
            if(array_key_exists('p2Submit', $_POST)){
                include 'moveP2.php';
            }
            ?>
        </div>
</body>

</html>