<?php

namespace App\Model;

class Stream
{
    const MIN_LENGTH = 5;
    const MAX_LENGTH = 20;

    private int $length;
    private array $string;
    private Coordinate $position;

    /**
     * Stream constructor.
     */
    public function __construct()
    {
        $this->position = new Coordinate(0, 0);
        $this->length = rand(self::MIN_LENGTH, self::MAX_LENGTH);
        $this->string = [];
        $this->buildStream();
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

    public function getString(): array
    {
        return $this->string;
    }

    public function setString(array $string): self
    {
        $this->string = $string;

        return $this;
    }

    public function buildStream(): self
    {
        for ($i = 0; $i <= $this->length; $i++) {
            $this->addCharacter($this->getRandomCharacter());
        }

        return $this;
    }

    public function addCharacter(string $character): self
    {
        $this->string[] = $character;

        return $this;
    }

    public function getPosition(): Coordinate
    {
        return $this->position;
    }

    public function setPosition(Coordinate $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function moveStringDown(): self
    {
        $newStringTailChar = $this->getRandomCharacter();
        $this->addCharacter($newStringTailChar);
        $this->position->incY();
        array_shift($this->string);

        return $this;
    }

    public function refresh(): self
    {
        $this->setLength(rand(self::MIN_LENGTH, self::MAX_LENGTH));
        $this->string = [];
        $this->buildStream();

        return $this;
    }

    public function __toString(): string
    {
        return implode('', $this->string);
    }

    private function getRandomCharacter(): string
    {
        return mb_chr(rand(33, 126), 'UTF-8');
    }
}
