<?php

class LifeMatrix
{
    public array $matrix;
    public int $gen = 1;

    public function __construct($random, $row, $col, $preset = "")
    {
        // generate a random matrix
        if ($random)
            $this->matrix = $this->generate_matrix($row, $col);

        // get from presets
        else
            $this->matrix = $this->get_preset($preset);
    }

    /*
     * @param row -> the number of row in the new generated matrix
     * @param col -> the number of col in the new generated matrix
     * @param percent -> 100 / percent = percentage of true in the new generated matrix
     * return array -> matrix of bool
     */
    private function generate_matrix($row, $col, $percent = 4) : array
    {
        $matrix = array();

        for($c = 0; $c < $col; $c++)
            for($r = 0; $r < $row; $r++)
                $matrix[$r][$c] = rand(1, $percent) == $percent;

        return $matrix;
    }

    /*
     * @param preset -> name of preset (without extension)
     * return array -> the matrix of that preset
     */
    private function get_preset($preset) : array
    {
        return json_decode(file_get_contents('Presets/' . $preset . '.json'), true);
    }

    /*
     * update matrix on the next generation
     */
    public function update(): void
    {
        $this->gen++;
        $temp_matrix = $this->matrix;

        foreach ($this->matrix as $y => $row)
            foreach ($row as $x => $col)
                $temp_matrix[$y][$x] = $this->get_new_state($x, $y);

        $this->matrix = $temp_matrix;
    }

    /*
     * @param matrix -> the game table
     * @param x0 -> the x of the cell to check
     * @param y0 -> the y of the cell to check
     * return a bool -> true if the cell is alive and false if is dead
     */
    private function get_new_state($x0, $y0): bool
    {
        // the number of the alive cell around
        $life_around = $this->alive_around($x0, $y0);

        // dead cell rule
        if (!$this->matrix[$y0][$x0])
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
    private function alive_around($x0, $y0): int
    {
        // the number of the alive cell around
        $life_around = 0;

        for ($i = 0; $i < 360; $i += 45) {
            $x = $x0 + round(sin(deg2rad($i)));
            $y = $y0 + round(cos(deg2rad($i)));

            // if the cell is alive count it
            if (isset($this->matrix[$y][$x]))
                if ($this->matrix[$y][$x])
                    $life_around++;
        }

        return $life_around;
    }

    /*
     * @param matrix -> the game table
     * return string -> the matrix formatted as html table
     */
    function matrix2html_table(): string
    {
        $table = "<table>";

        foreach ($this->matrix as $y => $row) {
            $table .= "<tr>";
            foreach ($row as $x => $col)
                $table .= "<td class=' " . ($this->matrix[$y][$x] ? "alive" : "dead") . " '></td>";
        }

        return $table . "</tr></table>";
    }
}