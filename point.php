<?php

/**
 * Created by PhpStorm.
 * User: bkwiatek
 * Date: 14.09.2015
 * Time: 14:44
 */
class Point
{
    private $x;
    private $y;
    private $escapes = [];
    private $no;

    /**
     * @param int $x
     * @param int $y
     */
    function __construct($x, $y)
    {
        $this->setCoords($x, $y);
    }

    /**
     * @param Point $escape
     * @return Point
     */
    public function addEscape(Point $escape)
    {
        $this->escapes[] = $escape;
        return $this;
    }

    /**
     * @param Point $escape
     * @return Point
     */
    public function removeEscape(Point $escape)
    {
        foreach ($this->escapes as $i => $e) {
            if ($e === $escape) {
                unset($this->escapes[$i]);
            }
        }
        return $this;
    }

    /**
     * @return array
     */
    public function getEscapes()
    {
        return $this->escapes;
    }

    /**
     * @return int
     */
    public function countEscapes()
    {
        return count($this->getEscapes());
    }

    /**
     * @return Point
     */
    public function updateEscapes()
    {
        foreach ($this->getEscapes() as $e) {
            $e->removeEscape($this);
        }
        return $this;
    }

    /**
     * @param int $x
     * @param int $y
     * @return Point
     */
    public function setCoords($x, $y)
    {
        $this->x = $x;
        $this->y = $y;
        return $this;
    }

    /**
     * @param int $x
     * @param int $y
     * @return bool
     */
    public function hasCoords($x, $y)
    {
        return ($this->x === $x && $this->y === $y) ? true : false;
    }

    /**
     * @return array
     */
    public function getCoords()
    {
        return [$this->x, $this - y];
    }

    /**
     * @param int $no
     * @return Point
     */
    public function setNo($no)
    {
        $this->no = $no;
        return $this;
    }

    /**
     * @return int
     */
    public function getNo()
    {
        return $this->no;
    }
}
