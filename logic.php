<?php
// Giacchini Valerio - 5AIN

/*
 * @param matrix -> the game table
 * @param x -> the x of the cell to check
 * @param y -> the y of the cell to check
 * return a bool -> true if the cell is alive and false if is dead
 */
function get_new_state($matrix, $x0, $y0): bool
{
    // the number of the alive cell around
    $life_around = alive_around($matrix, $x0, $y0);

    // dead cell rule
    if (!$matrix[$y0][$x0])
        return $life_around == 3;

    // alive cell rules
    return !($life_around < 2 || $life_around > 3);
}

/*
 * @param matrix -> the game table
 * @param x -> the x of the cell to check
 * @param y -> the y of the cell to check
 * return int -> the number of the cells alive around the cell to check
 */
function alive_around($matrix, $x0, $y0): int
{
    // the number of the alive cell around
    $life_around = 0;

    for ($i = 0; $i < 360; $i += 45) {
        $x = $x0 + round(sin(deg2rad($i)));
        $y = $y0 + round(cos(deg2rad($i)));

        // if the cell is alive count it
        if (isset($matrix[$y][$x]))
            if ($matrix[$y][$x])
                $life_around++;
    }

    return $life_around;
}

/*
 * @param matrix -> the game table
 * return string -> the matrix formatted as html table
 */
function matrixToHtmlTable($matrix): string
{
    $table = "<table>";

    foreach ($_SESSION["matrix"] as $y => $row) {
        $table .= "<tr>";
        foreach ($row as $x => $col)
            $table .= "<td class=' " . ($matrix[$y][$x] ? "alive" : "dead") . " '></td>";
    }

    return $table . "</tr></table>";
}