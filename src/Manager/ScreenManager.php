<?php

namespace App\Manager;

use App\Model\Coordinate;

class ScreenManager
{
    private Coordinate $size;

    /**
     * Methods
     */

    public function __construct(Coordinate $coordinate)
    {
        $this->size = $coordinate;
    }

    public function getSize(): Coordinate
    {
        return $this->size;
    }

    public function setSize(Coordinate $size): ScreenManager
    {
        $this->size = $size;

        return $this;
    }

    public function getHalfScreenSizeWidth(): int
    {
        $result = 1;
        if ($this->getSize()->getX() > 0) {
            $result = intval($this->getSize()->getX() / 2);
        }

        return $result;
    }

    public function getHalfScreenSizeHeight(): int
    {
        $result = 1;
        if ($this->getSize()->getY() > 0) {
            $result = intval($this->getSize()->getY() / 2);
        }

        return $result;
    }
}
