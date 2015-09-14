<?php

/**
 * Created by PhpStorm.
 * User: bkwiatek
 * Date: 13.09.2015
 * Time: 00:13
 */

require_once 'colors.php';
require_once 'point.php';

class matrixGenerator
{

    private $matrix = [];
    private $size;
    private $points;

    function __construct($size = 5, $points = 4)
    {
        $this->size = $size;
        $this->points = $points;
        $this->initMatrix();
        $this->initAllEscapes();
        $this->drawLine();
    }

    private function initMatrix()
    {
        for ($x = 1; $x <= $this->size; $x++) {
            for ($y = 1; $y <= $this->size; $y++) {
                $this->addMatrix($x, $y);
            }
        }
    }

    private function initAllEscapes()
    {
        for ($x = 1; $x <= $this->size; $x++) {
            for ($y = 1; $y <= $this->size; $y++) {
                $this->initMatrixEscape($x, $y);
            }
        }
    }

    private function initMatrixEscape($x, $y)
    {
        for ($xx = $x - 1; $xx <= $x + 1; $xx++) {
            for ($yy = $y - 1; $yy <= $y + 1; $yy++) {
                if ($this->getMatrixPoint($xx, $yy) && $this->getMatrixPoint($xx, $yy) !== $this->getMatrixPoint($x, $y)) {
                    $this->getMatrixPoint($x, $y)->addEscape($this->getMatrixPoint($xx, $yy));
                }
            }
        }
    }

    private function drawLine()
    {
        $matrix = null;
        for ($pi = 1; $pi <= $this->points; $pi++) {
            $matrix = $this->randomizePoint($pi, $matrix);
            if ($matrix === false) {
                break;
            }
        }
    }

    private function randomizePoint($pointNo, Point $matrix = null)
    {
        if (empty($matrix)) {
            $point = mt_rand(0, $this->countMatrix());
            $matrix = $this->matrix[$point];
        } else {
            $escapes = [];
            /** @var Point $e */
            foreach ($matrix->getEscapes() as $e) {
                $eMax = $e->countEscapes();
                for ($i = 0; $i < $eMax; $i++) {
                    $escapes[] = $e;
                }
            }
            if (count($escapes) > 0) {
                $point = mt_rand(0, count($escapes) - 1);
                $matrix = $escapes[$point];
            } else {
                return false;
            }
        }
        $matrix->updateEscapes();
        $matrix->setNo($pointNo);
        $this->display($pointNo);
        return $matrix;
    }

    /**
     * @param int $x
     * @param int $y
     */
    public function addMatrix($x, $y)
    {
        $this->matrix[] = new Point($x, $y);
    }

    /**
     * @param int $x
     * @param int $y
     * @return Point
     */
    public function getMatrixPoint($x, $y)
    {
        /** @var Point $matrix */
        foreach ($this->matrix as $matrix) {
            if ($matrix->hasCoords($x, $y)) {
                return $matrix;
            }
        }
        return false;
    }

    /**
     * @return int
     */
    public function countMatrix()
    {
        return count($this->matrix) - 1;
    }

    public function display($stepNo = false)
    {
        $len = strlen($this->points);
        $colors = new Colors();
        if (!empty($stepNo)) {
            echo $colors->getColoredString("Step " . $stepNo . "", 'light_cyan');
        } else {
            echo $colors->getColoredString("Matrix escapes", 'light_cyan');
        }
        echo "\n";
        for ($x = 1; $x <= $this->size; $x++) {
            for ($y = 1; $y <= $this->size; $y++) {
                $matrix = $this->getMatrixPoint($x, $y);
                if ($matrix->getNo()) {
                    $text = sprintf("%0" . $len . "d", $matrix->getNo());
                    echo $colors->getColoredString('(', 'red');
                    echo $colors->getColoredString($text, 'yellow');
                    echo $colors->getColoredString(')', 'red');
                } else {
                    $text = sprintf("%0" . $len . "d", $matrix->countEscapes());
                    echo $colors->getColoredString('[', 'red');
                    echo $colors->getColoredString($text, 'blue');
                    echo $colors->getColoredString(']', 'red');
                }
            }
            echo "\n";
        }
    }
}

$size = (!empty($argv[1]) && $argv[1] > 3) ? (int)$argv[1] : 3;
$points = (!empty($argv[2]) && $argv[2] >= 1) ? (int)$argv[2] : 5;
$m = new matrixGenerator($size, $points);
$m->display();
