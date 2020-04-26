<?php

namespace App\Manager;

use App\Model\Coordinate;

class ScreenManager
{
    private Coordinate $size;

    /**
     * Methods
     */

    public function __construct()
    {
        $this->size = new Coordinate(0, 0);
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
}
