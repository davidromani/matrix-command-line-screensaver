<?php

namespace App\Manager;

use App\Model\Coordinate;
use App\Model\Stream;

class StreamsManager
{
    const MIN_LENGTH = 5;
    const MAX_LENGTH = 30;

    private int $length;
    private array $streams;

    /**
     * StreamsManager constructor.
     */
    public function __construct()
    {
        $this->length = rand(self::MIN_LENGTH, self::MAX_LENGTH);
        $this->streams = [];
        for ($i = 0; $i <= $this->length; $i++) {
            $this->addStream(new Stream());
        }
    }

    public function getLength(): int
    {
        return $this->length;
    }

    public function setLength(int $length): self
    {
        $this->length = $length;

        return $this;
    }

    public function getStreams(): array
    {
        return $this->streams;
    }

    public function setStreams(array $streams): self
    {
        $this->streams = $streams;

        return $this;
    }

    public function addStream(Stream $stream): self
    {
        $this->streams[] = $stream;

        return $this;
    }

    public function shuffleStreamPositions(int $maxCol, int $maxRow)
    {
        /** @var Stream $stream */
        foreach ($this->getStreams() as $stream) {
            $coordinate = new Coordinate(rand(0, $maxCol), rand(1 - $stream->getLength(), $maxRow));
            $stream->setPosition($coordinate);
        }
    }

    public function moveStreamStepForward(Stream $stream)
    {
        $stream->moveStringDown();
    }

    public function refreshDeadStream(Stream $stream, Coordinate $screenSize)
    {
        $stream->refresh();
        $stream->setPosition(new Coordinate(rand(0, $screenSize->getX()), 1 - $stream->getLength()));
    }
}
