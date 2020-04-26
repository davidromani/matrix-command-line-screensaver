<?php

namespace App\Manager;

use App\Model\Coordinate;

class ScreenManager
{
    private Coordinate $size;
    private StreamsManager $sm;

    /**
     * Methods
     */

    public function __construct(Coordinate $coordinate)
    {
        $this->size = $coordinate;
        $this->sm = new StreamsManager();
        $this->sm->shuffleStreamPositions($coordinate->getX(), $coordinate->getY());
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

    public function getScreenWidth(): int
    {
        $result = 1;
        if ($this->getSize()->getX() > 0) {
            $result = $this->getSize()->getX();
        }

        return $result;
    }

    public function getScreenHeight(): int
    {
        $result = 1;
        if ($this->getSize()->getY() > 0) {
            $result = $this->getSize()->getY();
        }

        return $result;
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

    public function getSm(): StreamsManager
    {
        return $this->sm;
    }

    public function setSm(StreamsManager $sm): self
    {
        $this->sm = $sm;

        return $this;
    }
}
