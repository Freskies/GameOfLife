<?php
// Giacchini Valerio - 5AIN
// TODO check errors (in url get)
require "LifeMatrix.php";

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

    // create and initialize the matrix
    if ($_GET['preset'] == "Random")
        $_SESSION['matrix'] = new LifeMatrix(true, 20, 20);

    else
        $_SESSION['matrix'] = new LifeMatrix(false, 0, 0, $_GET['preset']);
}

else
    $_SESSION["matrix"]->update();
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
<h1>Generation <?php echo $_SESSION["matrix"]->gen ?></h1>
<?php echo $_SESSION["matrix"]->matrix2html_table(); ?>
</body>
</html>