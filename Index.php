<?php
session_start();

$_SESSION['get'] = true;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
    <form action="lifegame.php" method="get">
        <h3>Still Life</h3>
        <input type="submit" name="preset" value="Block">
        <input type="submit" name="preset" value="Beehive">
        <input type="submit" name="preset" value="Loaf">
        <input type="submit" name="preset" value="Boat">
        <input type="submit" name="preset" value="Tub">
        <br>
        <h3>Oscillators</h3>
        <input type="submit" name="preset" value="Blinker">
        <input type="submit" name="preset" value="Toad">
        <input type="submit" name="preset" value="Beacon">
        <input type="submit" name="preset" value="Pulsar">
        <input type="submit" name="preset" value="Pentadecathlon">
        <br><br>
        <h3>Others</h3>
        <input type="submit" name="preset" value="Random">
        <br><br>
        <label for="speed">Speed: </label>
        <select name="Speed" id="speed">
            <option value="2">Slow</option>
            <option selected="selected" value="1">Normal</option>
            <option value="0.5">Fast</option>
        </select>
        <!--
        <h3>Spaceships</h3>
        <input type="submit" name="preset" value="Glider">
        <input type="submit" name="preset" value="Light-weight">
        <input type="submit" name="preset" value="Middle-weight">
        <input type="submit" name="preset" value="Heavy-weight">
        -->
    </form>
</body>
</html>