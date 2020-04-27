<?php

namespace App\Manager;

use App\Model\Coordinate;
use App\Model\Stream;
use Symfony\Component\Console\Cursor;
use Symfony\Component\Console\Output\OutputInterface;

class ScreenManager
{
    private Coordinate $size;
    private StreamsManager $sm;

    /**
     * ScreenManager constructor.
     *
     * @param Coordinate $coordinate
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

    public function handleStreams(OutputInterface $output, Cursor $cursor)
    {
        /** @var Stream $stream */
        foreach ($this->sm->getStreams() as $stream) {
            $this->drawStream($output, $cursor, $stream);
            $this->moveStreamStepForward($stream);
            $this->refreshIfDeadStream($stream);
        }
    }

    public function drawStream(OutputInterface $output, Cursor $cursor, Stream $stream)
    {
        $yDelta = 0;
        /** @var string $char */
        foreach ($stream->getString() as $char) {
            $y = $stream->getPosition()->getY() + $yDelta;
            if ($y >= 0 && $y < $this->getScreenHeight()) {
                $cursor->moveToPosition($stream->getPosition()->getX(), $y);
                $output->write($char);
            }
            ++$yDelta;
        }
    }

    public function moveStreamStepForward(Stream $stream)
    {
        $this->sm->moveStreamStepForward($stream);
    }

    public function refreshIfDeadStream(Stream $stream)
    {
        if ($stream->getPosition()->getY() > $this->getScreenHeight()) {
            $this->sm->refreshDeadStream($stream, $this->size);
        }
    }
}
