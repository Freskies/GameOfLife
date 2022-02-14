<?php
// Giacchini Valerio - 5AIN
// TODO check errors (in url get)
require "logic.php";
session_start();
header("Refresh: " . ($_SESSION['speed'] ?? 1));

/*
 * CREATE JSON
$_SESSION["matrix"] = array();
for($i = 0; $i < 11; $i++)
    for($j = 0; $j < 18; $j++)
        $_SESSION["matrix"][$i][$j] = false;

$_SESSION["matrix"][4][6] = true;

file_put_contents("Pentadecathlon.json", json_encode($_SESSION["matrix"]));
*/

// first time
if (isset($_SESSION['get'])) {
    unset($_SESSION['get']);
    $_SESSION['Speed'] = $_GET['Speed'];
    $_SESSION['gen'] = 1;

    // create and initialize the matrix
    if ($_GET['preset'] == "Random") {
        $_SESSION["matrix"] = array();
        for($i = 0; $i < 20; $i++)
            for($j = 0; $j < 20; $j++)
                $_SESSION["matrix"][$i][$j] = rand(1, 4) == 4;
    }
    else
        $_SESSION["matrix"] = json_decode(file_get_contents('Presets/' . $_GET['preset'] . '.json'), true);
}

else {
    $_SESSION['gen']++;
    $temp_matrix = $_SESSION["matrix"];

    foreach ($_SESSION["matrix"] as $y => $row)
        foreach ($row as $x => $col)
            $temp_matrix[$y][$x] = get_new_state($_SESSION["matrix"], $x, $y);

    $_SESSION["matrix"] = $temp_matrix;
}
?>
<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Life Game</title>
    <style>
        td, tr {
            height: 20px;
            width: 20px;
        }
        td.dead {
            background-color: lightgray;
        }
        td.alive {
            background-color: lightcoral;
        }
    </style>
</head>
<body>
<h1>Generation <?php echo $_SESSION['gen'] ?></h1>
<?php echo matrixToHtmlTable($_SESSION["matrix"]); ?>
</body>
</html>