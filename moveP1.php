<?php
function display($a)
{
    echo "<p>";
    for ($i = 7; $i >= 5; $i--)
        echo $a[$i] . " ";
    echo "</p>";

    echo "<p>" . $a[0] . " " .  $a[8] . " " . $a[4] . "</p><p>";

    for ($i = 1; $i <= 3; $i++)
        echo $a[$i] . " ";
    echo "</p>";
}

function start()
{
    // initializing the path variables.
    $arr = array();
    for ($i = 0; $i < 9; $i++)
        array_push($arr, 0);

    // setting the safe spots
    $spot = array(0, 4);

    // starting point
    global $pos1;
    global $pos2;

    // to take into consideration the array by other player
    $arr[$pos2] = 2;

    // input of steps for player 1
    $dice = (int) $_POST['player1']; // Retrieve input value from the form
    echo "<p>P1 move: " . $dice . "</p><br>";
    // Checking the end condition
    if (8 - $pos1 >= $dice) {

        // Fixing the current position
        if ($arr[$pos1] != 12)
            $arr[$pos1] = 0;
        else
            $arr[$pos1] = 2;

        $pos1 += $dice;
    }

    // Mark the position of p1 while checking for p2;


    if ($arr[$pos1] == 2) {
        // Safe spot
        if (array_search($pos1, $spot) != false) {
            $arr[$pos1] = 12;
        }
        // Not a safe spot
        else {
            $pos2 = 0;
            $arr[$pos2] = 2;
            $arr[$pos1] = 1;
        }
    } else {
        $arr[$pos1] = 1;
    }

    // Show the matrix
    display($arr);
    echo "<br />";


    if ($arr[8] != 0) {
        echo "<p>Game is over!</p><br>";
        if ($arr[8] == 1)
            echo "<p>Player 1 has won!</p>";
        else
            echo "<p>Player 2 has won!</p>";
        $pos1 = 0;
        $pos2 = 0;
    }

    // save positions to file
    $file = fopen("positions.txt", "w+");
    fwrite($file, $pos1 . PHP_EOL);
    fwrite($file, $pos2 . PHP_EOL);
    fclose($file);
}

$file_content = fopen('positions.txt', 'r') or die("unable to open file");
$pos1 = (int) fgets($file_content);
$pos2 = (int) fgets($file_content);

start();
