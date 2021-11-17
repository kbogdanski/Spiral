<?php

class Spiral
{
    /**
     * @var int
     */
    private $row;

    /**
     * @var int
     */
    private $col;

    /**
     * @var int
     */
    private $sizeRow;

    /**
     * @var int
     */
    private $sizeCol;

    /**
     * @var int
     */
    private $value;

    /**
     * @var array
     */
    private $matrix;

    /**
     * Spiral constructor.
     * @param int $row
     * @param int $col
     */
    public function __construct($row, $col)
    {
        $this->row = $this->sizeRow = $row;
        $this->col = $this->sizeCol = $col;
        $this->matrix = [];
        $this->value = 1;
    }

    public function createMatrix() {
        if ($this->sizeRow < 1 || $this->sizeCol < 1)
        {
            return;
        }

        $row = (int)(($this->row - $this->sizeRow)/2);
        $col = (int)(($this->col - $this->sizeCol)/2);
        if ($this->sizeRow === 1 && $this->sizeCol === 1)
        {
            $this->matrix[$row][$col] = $this->value;
            return;
        }

        //Right
        for($i=0; $i<$this->sizeCol-1; ++$i)
        {
            $this->matrix[$row][$col++] = $this->value++;
        }

        //Down
        for($i=0; $i<$this->sizeRow-1; ++$i)
        {
            $this->matrix[$row++][$col] = $this->value++;
        }

        //Left
        for($i=0; $i<$this->sizeCol-1; ++$i)
        {
            $this->matrix[$row][$col--] = $this->value++;
        }

        //Up
        for($i=0; $i<$this->sizeRow-1; ++$i)
        {
            $this->matrix[$row--][$col] = $this->value++;
        }

        $this->sizeRow = $this->sizeRow - 2;
        $this->sizeCol = $this->sizeCol - 2;
        $this->createMatrix();
    }


    public function drawMatrix()
    {
        for($x=0; $x<count($this->matrix); $x++) {
            for($y=0; $y<count($this->matrix[$x]); $y++) {
                echo $this->matrix[$x][$y] . "  ";
            }
            echo "\n";
        }
    }

}

echo "Number of row: ";
$handle = fopen ("php://stdin","r");
$row = fgets($handle);
if((int)trim($row) === 0){
    echo "Missing or invalid value\n";
    exit;
}

echo "Number of columns: ";
$handle = fopen ("php://stdin","r");
$col = fgets($handle);
if((int)trim($col) === 0){
    echo "Missing or invalid value\n";
    exit;
}

$spiral = new Spiral((int)$row, (int)$col);
$spiral->createMatrix();
$spiral->drawMatrix();

echo "\n";
echo "End...\n";